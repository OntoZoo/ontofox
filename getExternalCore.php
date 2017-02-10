<?php 
/**
 * Author: Zuoshuang Xiang
 * The University Of Michigan
 * He Group
 * Date: 2010-03-04
 *
 * This is the main program for processing user inputs, form queries, 
 * process query resuslt and output final results.
 */
 
set_time_limit(60*60);
include('inc/functions.php');

$vali=new Validation($_REQUEST);
$GALAXY_URL = $vali->getInput('GALAXY_URL', 'GALAXY_URL', 0, 100, true);

$num_queries = 0;
$outputURI = '';
$outputFile = 'import.owl';

$finalFile = createRandomPassword();

$str_inputs = array();

$array_ns = array();

//ontology original URIs
$array_original_ns = array();

$a_missing_term =array();

//SPARQL endpoint servers
$array_server = array();

$strQueryPrint = '';


$strSql= "select * from ontology where loaded='y'";
$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$rs = $db->Execute($strSql);

foreach($rs as $row) {
	$array_ns[$row['ontology_abbrv']]=$row['ontology_graph_url'];
	$array_original_ns[$row['ontology_abbrv']]=$row['ontology_url'];
	$array_server[$row['ontology_abbrv']]=$row['end_point'];
}


//If user upload a file, parse the file and seperate into individual ontologies.
if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
	$data = trim(file_get_contents($_FILES['file']['tmp_name']));
	
	file_put_contents("$userfiles/$finalFile.txt", $data);
	
	$lines = preg_split('/[\r\n]+/', $data);
	
	$str_input='';
	$output_iri_next = false;
	foreach($lines as $line) {
		if (strpos($line, ' #')!==false) {
			$line = trim(substr($line, 0, strpos($line, ' #')));
		}

		if (strpos($line, '#')===0 || trim($line)=='') {
			//ignore comments or empty lines
		}
		elseif (strpos($line, '[Source ontology]')===0) {
			if (strpos($str_input, '[Source ontology]')===0) {
				$str_inputs[] = $str_input;
			}
			$str_input = '[Source ontology]';
		}
		elseif (strpos($line, '[URI of the OWL(RDF/XML) output file]')===0) {
			$output_iri_next = true;
		}
		elseif ($line!='' && $output_iri_next == true) {
			$outputURI = $line;
			$output_iri_next = false;
		}
		else {
			$str_input .= "\n" . $line;
		}
		
		if (strpos($line, '[')===0 && strpos($line, '[URI of the OWL(RDF/XML) output file]')===false) {
			$output_iri_next = false;
		}
	}
	
	
	if (strpos($str_input, '[Source ontology]')===0) {
		$str_inputs[] = $str_input;
	}
	
//	print_r($str_inputs);

}
else {
	$ontology= $vali->getInput('ontology', 'Ontology', 0, 128);
	$ontology2 = $vali->getInput('ontology2', 'Your own ontology', 0, 1024);
	$ontology = trim($ontology . "\n" . $ontology2);
	$term_iris = $vali->getInput('term_iris', 'Lower level term IRIs to be imported', 10, 81920);
	$top_term_iris = $vali->getInput('top_term_iris', 'Top level term IRIs to be imported', 0, 8192);
	$retrieval_setting = $vali->getInput('retrieval_setting', 'Source term retrieval setting', 0, 128);
	$outputURI = $vali->getInput('output_iri', 'URI of the OWL(RDF/XML) output file', 0, 128);
	$annotation_iris = $vali->getInput('annotation_iris', 'annotation IRIs to be included', 0, 8192);
	$excluding_annotation_iris = $vali->getInput('excluding_annotation_iris', 'annotation IRIs to be excluded', 0, 8192);
	
	$str_inputs[] = "[URI of the OWL(RDF/XML) output file]
$outputURI
[Source ontology]
$ontology
[Low level source term URIs]
$term_iris
[Top level source term URIs and target direct superclass URIs]
$top_term_iris
[Source term retrieval setting]
$retrieval_setting
[Source annotation URIs]
$annotation_iris
[Source annotation URIs to be excluded]
$excluding_annotation_iris";

	file_put_contents("$userfiles/$finalFile.txt", $str_inputs[0]);
}


$fileNames=array();


foreach ($str_inputs as $str_input) {
//	print_r("<!--$str_input-->");
	
	$section_values['ontology']='';
	$section_values['term_iris']='';
	$section_values['signature_term_iris']='';
	$section_values['top_term_iris']='';
	$section_values['retrieval_setting']='';
	$section_values['annotation_iris']='';
	$section_values['excluding_annotation_iris']='';

	$lines = preg_split('/[\r\n]+/', $str_input);
	$current_tag = '';
	foreach ($lines as $line) {
		$line = trim($line);
		if (strpos($line, '[')===0) {
			foreach($section_tags as $section_tag_var => $section_tag_txt){
				if (strpos($line, $section_tag_txt)===0) {
					$current_tag = $section_tag_var;
					$section_values[$current_tag]='';
				}
			}
		}
		elseif (strpos($line, '#')===0) {
			//ignore comments
		}
		else {
			if (strpos($line, ' #')!==false) {
				$line = trim(substr($line, 0, strpos($line, ' #')));
			}

			if ($current_tag!='' && $line!='') {
				$section_values[$current_tag].=$line."\n";
			}
		}
	}
	
	$ontology = $section_values['ontology'];
	$term_iris = $section_values['term_iris'];
	$signature_term_iris = $section_values['signature_term_iris'];
	$top_term_iris = $section_values['top_term_iris'];
	$retrieval_setting = $section_values['retrieval_setting'];
	$annotation_iris = $section_values['annotation_iris'];
	$excluding_annotation_iris = $section_values['excluding_annotation_iris'];

	
	if (strlen($term_iris)<10) {
		$vali->concatError("At least one lower level term IRI is required.");
	}


	if (!isset($ontology) || strlen($ontology)<2) {
		$vali->concatError("Ontology is required.");
	}
	
//	print("<!--$ontology-->");
	
	//Get source ontology
	if ($vali->getErrorMsg()=='') {
		
		//parse ontology
		$lines = preg_split('/[\r\n]+/', trim($ontology));
		
		$ontology_uri = '';
		$ontology_original_uri='';
		$server_endpoint = '';
		
		foreach ($lines as $line) {
			$line = trim($line);
			if (strpos($line, '#')===0) {
				//ignore comments
			}
			else {
				if (strpos($line, ' #')!==false) {
					$line = trim(substr($line, 0, strpos($line, ' #')));
				}
				
				if (strpos($line, 'fromEndpoint ')===false) {
					$ontology = $line;
					if (isset($array_ns[$line])) {
						$ontology_uri = $array_ns[$line];
						$ontology_original_uri = $array_original_ns[$line];
						$server_endpoint = $array_server[$line];
					}
					else {
						$ontology_uri = $line;
						$ontology_original_uri= $line;
					}
				}
				else {
					$line = trim(str_replace('fromEndpoint ', '', $line));
					$server_endpoint = $line;
				}
			}
		}
		
		
		$retrieval_setting = isset($retrieval_setting) ? trim($retrieval_setting) : '';
		if ($retrieval_setting=='') {
			$retrieval_setting='includeNoIntermediates';
		}
		
	
		$outputNSs = array();
		$outputNSs['http://www.w3.org/1999/02/22-rdf-syntax-ns#'] = 'rdf';
		$outputNSs['http://www.w3.org/2002/07/owl#'] = 'owl';
		$outputNSs['http://purl.obolibrary.org/obo/'] = 'obo';
		$outputNSs['http://www.w3.org/2000/01/rdf-schema#'] = 'rdfs';
		

		$strOutput='>

  <owl:AnnotationProperty rdf:about="http://purl.obolibrary.org/obo/IAO_0000412">
	<rdfs:label xml:lang="en">imported from</rdfs:label>
  </owl:AnnotationProperty>

	';
	
		$ns_rdf = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
		$ns_rdfs = 'http://www.w3.org/2000/01/rdf-schema#';
		$ns_owl = 'http://www.w3.org/2002/07/owl#';
		
		
		$unprocessed_iris = array();
		$processed_iris = array(); 
		
		$parent_included_iris = array(); 
		$terms_to_keep = array();
		
		
		$top_term_iris=trim($top_term_iris);
		
		//By default, don't retrive structure.
		if ($top_term_iris=='') {
			$top_term_iris = str_replace('includeAllChildren', '', $term_iris);
		}
		
		$a_parent_axoim=array();
		
		//add top level source terms
		$lines = preg_split('/[\r\n]+/', trim($top_term_iris));
		$current_iri ='';
		foreach ($lines as $line) {
			$line = trim($line);
			if (strpos($line, '#')===0) {
				//ignore comments
			}
			else {
				if (strpos($line, ' #')!==false) {
					$line = trim(substr($line, 0, strpos($line, ' #')));
				}
				
				if (strpos($line, 'subClassOf ')===0) {
					$line = trim(str_replace('subClassOf ', '', $line));
					if ($current_iri!='') {

						$terms_to_keep[$line] = 1;		

						$a_parent_axoim[$current_iri]="
		  <rdf:Description rdf:about=\"$current_iri\">
			<rdfs:subClassOf rdf:resource=\"$line\"/>
		  </rdf:Description>
		";
					}
				}
				elseif (strpos($line, 'subPropertyOf ')===0) {
					$line = trim(str_replace('subPropertyOf ', '', $line));
					if ($current_iri!='') {

						$terms_to_keep[$line] = 1;		

						$a_parent_axoim[$current_iri]="
		  <rdf:Description rdf:about=\"$current_iri\">
			<rdfs:subPropertyOf rdf:resource=\"$line\"/>
		  </rdf:Description>
		";
					}
				}
				else {
					$parent_included_iris[$line] = 'NA';
					$unprocessed_iris[$line] = 'NA';
					$current_iri=$line;
					$terms_to_keep[$line] = 1;		
					
				}
			}
		}
		
		
		//Get annotation URLs user wish to include
		$annotation_iris_to_include = array();
		$annotation_iris_to_include['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'] = array('action'=>'', 'iri'=>'');

		$annotation_iris_to_include['http://www.w3.org/2000/01/rdf-schema#subClassOf'] = array('action'=>'', 'iri'=>'');
		$annotation_iris_to_include['http://www.w3.org/2000/01/rdf-schema#subPropertyOf'] = array('action'=>'', 'iri'=>'');
//		$annotation_iris_to_include['http://www.w3.org/2002/07/owl#equivalentClass'] = array('action'=>'', 'iri'=>'');
		
		$includeAllAxioms=false;
		$includeAllAnnotationProperties=false;
		$includeAllAxiomsRecursively=false;
		
		if ($annotation_iris!='') {
			$lines = preg_split('/[\r\n]+/', trim($annotation_iris));
			$current_iri ='';
		
			foreach ($lines as $line) {
				$line = trim($line);
				if (strpos($line, '#')===0) {
					//ignore comments
				}
				else {
					if (strpos($line, ' #')!==false) {
						$line = trim(substr($line, 0, strpos($line, ' #')));
					}
					
					//get all Axioms
					if ($line=='includeAllAxioms') {
						$includeAllAxioms=true;
						
						break;
					}
		
					//get all Axioms
					if ($line=='includeAllAnnotationProperties') {
						$includeAllAnnotationProperties=true;
						
						break;
					}
		
					//get all Axioms recusively
					if ($line=='includeAllAxiomsRecursively') {
						$includeAllAxiomsRecursively=true;
						
						break;
					}
		
					if(strpos($line, 'copyTo ')!==false) {
						$line = trim(str_replace('copyTo ', '', $line));
						$annotation_iris_to_include[$current_iri] = array('action'=>'copyTo', 'iri'=>$line);
						$strOutput.="  <owl:AnnotationProperty rdf:about=\"$line\"/>\n";
					}
					elseif(strpos($line, 'mapTo ')!==false) {
						$line = trim(str_replace('mapTo ', '', $line));
						$annotation_iris_to_include[$current_iri] = array('action'=>'mapTo', 'iri'=>$line);
						$strOutput.="  <owl:AnnotationProperty rdf:about=\"$line\"/>\n";
					}
					else {
						$annotation_iris_to_include[$line] = array('action'=>'', 'iri'=>'');
						$current_iri= $line;
					}
				}
			}
		}
		
	
		$annotation_iris_to_exclude=array();
		if (trim($excluding_annotation_iris)!='') {
			$annotation_iris_to_exclude = preg_split('/[\r\n]+/', trim($excluding_annotation_iris));
		}
		
		
		
		//print_r($parent_included_iris);
		
		//process term URIs to be imported and get super classes/properties.
		$lines = preg_split('/[\r\n]+/', trim($term_iris));
		
		$a_term_include_children=array();
		
		
		$current_iri ='';
		foreach ($lines as $line) {
			if (strpos($line, '#')===0) {
				//ignore comments
			}
			else {
				if (strpos($line, ' #')!==false) {
					$line = trim(substr($line, 0, strpos($line, ' #')));
				}
				
				if (strpos($line, 'includeAllChildren')===0) {
					$a_term_include_children[$current_iri]=1;
				}
				else {
					$import_term=trim($line);
					$current_iri=$import_term;
					
					$terms_to_keep[$import_term] =1;
					
					if (!isset($processed_iris[$import_term])) {
						$results = array($import_term => 'NA');
						if (!isset($parent_included_iris[$import_term])) {

							$unprocessed_iris[$import_term] = 'NA';


							$querystring = "
PREFIX rdf: <$ns_rdf>
PREFIX rdfs: <$ns_rdfs>
PREFIX owl: <$ns_owl>

SELECT distinct ?s

FROM <$ontology_uri>
	
WHERE
{
  {
    SELECT ?s ?o
    WHERE
    {
		{
			?o rdfs:subClassOf ?s 
		}
		UNION
		{
			?o owl:equivalentClass ?s1 .
			?s1 owl:intersectionOf ?s2 .
			?s2 rdf:first ?s 
		}
		UNION
		{
			?o rdfs:subPropertyOf ?s 
		}
		UNION
		{
			?o owl:equivalentProperty ?s1 .
			?s1 owl:intersectionOf ?s2 .
			?s2 rdf:first ?s 
		}
    }
  } OPTION (TRANSITIVE, t_in(?o), t_out(?s)).
  FILTER (?o= <$import_term>)
}";

							$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";
							
							$tmp_results = json_query($querystring, $server_endpoint);
							//print("\n\n<!--\n$querystring-->\n\n");
							
							
//							print_r($tmp_results);
						
							$num_queries++;
							
							foreach($tmp_results as $tmp_result) {
								$tmp_iri = $tmp_result['s'];
								if(!isset($processed_iris[$tmp_iri]) && !isset($parent_included_iris[$tmp_iri])) {
									$unprocessed_iris[$tmp_iri] = '';
								}
								else {
									break;
								}
								
							}
						}
						else {
							if (!isset($processed_iris[$import_term])) {
								$unprocessed_iris[$import_term] = '';
							}
						}
					}
				}
			}
		}		

		
		$querystring = "SELECT DISTINCT ?s
FROM <$ontology_uri>
WHERE {
	?s ?p ?o.
	FILTER (?s in (<http://null>, <". join(">
, <", array_keys($terms_to_keep)) .">))
}
";

		$querystring = formatQuerySelect($querystring);
		$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";
		
		$a_existing_term = json_query($querystring, $server_endpoint);
	
		$a_missing_term = array_merge($a_missing_term, $terms_to_keep);
		if (!empty($a_existing_term)) {
			foreach ($a_existing_term as $existing_term) {
				if (isset($a_missing_term[$existing_term['s']])) unset($a_missing_term[$existing_term['s']]);
			}
		}
		
//Retrieve children terms
		if (!empty($a_term_include_children)) {
			foreach ($a_term_include_children as $import_term=>$tmpLabel) {
				$terms_to_keep[$import_term] =1;
				
				if (!isset($processed_iris[$import_term])) {
					$results = array($import_term => 'NA');
					
					$querystring="
PREFIX rdf: <$ns_rdf>
PREFIX rdfs: <$ns_rdfs>
PREFIX owl: <$ns_owl>

SELECT distinct ?o

FROM <$ontology_uri>
	
WHERE
{
  {
    SELECT ?s ?o
    WHERE
    {
		{
			?o rdfs:subClassOf ?s 
		}
		UNION
		{
			?o owl:equivalentClass ?s1 .
			?s1 owl:intersectionOf ?s2 .
			?s2 rdf:first ?s 
		}
		UNION
		{
			?o rdfs:subPropertyOf ?s 
		}
		UNION
		{
			?o owl:equivalentProperty ?s1 .
			?s1 owl:intersectionOf ?s2 .
			?s2 rdf:first ?s 
		}
    }
  } OPTION (TRANSITIVE, t_in(?s), t_out(?o)).
  FILTER (?s= <$import_term>)
}";


					$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";
	
	
					$tmp_results = json_query($querystring, $server_endpoint);
			//print("\n\n<!--\n$querystring-->\n\n");
			
					$num_queries++;
					
					foreach($tmp_results as $tmp_result) {
						$unprocessed_iris[$tmp_result['o']]='';
						$terms_to_keep[$tmp_result['o']] =1;
					}
				}
			}
		}


		$related_terms=array();


		$loop_num=0;

		//Send query to servers and process response.
		while (!empty($unprocessed_iris)) {
			$loop_num++;
			if ($loop_num>10000) {
				print("Dead loop???");
				exit();
			}
			
			
			$tmp_unprocessed_iris=array();			
			$rdf='';
			if ($includeAllAxioms || $includeAllAxiomsRecursively) {
				$querystring = "
DEFINE sql:describe-mode \"CBD\" 
DESCRIBE <".join('>
 <', array_keys($unprocessed_iris)).">

FROM <$ontology_uri>";

				$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";

				$fields = array();
				$fields['default-graph-uri'] = $ontology_uri;
				$fields['format'] = 'application/rdf+xml';
				$fields['debug'] = 'on';
				$fields['query'] = $querystring;
//				print("<!--$querystring-->\n");
				
				$rdf .= curl_post_contents($server_endpoint, $fields);
			}
			else {
				if ($includeAllAnnotationProperties) {
					$querystring = "
CONSTRUCT {?s ?p ?o}
FROM <$ontology_uri>
WHERE {
{?s ?p ?o.
?p <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.w3.org/2002/07/owl#AnnotationProperty>.
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}
UNION 
{?s ?p ?o.
FILTER (?p in (<http://www.w3.org/2000/01/rdf-schema#label>)).
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}
}
";					
					$querystring = formatQuery($querystring);
					$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";
		
					$fields = array();
					$fields['default-graph-uri'] = $ontology_uri;
					$fields['format'] = 'application/rdf+xml';
					$fields['debug'] = 'on';
					$fields['query'] = $querystring;
//					print("<!--$querystring-->\n");
					
					$rdf .= curl_post_contents($server_endpoint, $fields);
				}
				
				foreach ($annotation_iris_to_include as $annotation_iri => $mapping) {
					if ($mapping['action']=='copyTo') {
						$querystring = "
CONSTRUCT {
?s <$annotation_iri> ?o.
?s <{$mapping['iri']}> ?o
}
FROM <$ontology_uri>
WHERE {?s <$annotation_iri> ?o.
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}
";		
					}
					elseif ($mapping['action']=='mapTo') {
						$querystring = "
CONSTRUCT {
?s <{$mapping['iri']}> ?o.
?s <{$mapping['iri']}> ?o2
}
FROM <$ontology_uri>
WHERE {
{?s <$annotation_iri> ?oa .
?oa <http://www.w3.org/2000/01/rdf-schema#label> ?o.
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}
UNION
{?s <$annotation_iri> ?o2.
FILTER (isLiteral(?o2)).
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}
}
";		
					}
					else {
						$querystring = "
CONSTRUCT {
?s <$annotation_iri> ?o
}
FROM <$ontology_uri>
WHERE {
?s <$annotation_iri> ?o.
FILTER (?s in (<".join('>
, <', array_keys($unprocessed_iris)).">))
}

";		
						
					}
					
					$querystring = formatQuery($querystring);
					$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";
		
					$fields = array();
					$fields['default-graph-uri'] = $ontology_uri;
					$fields['format'] = 'application/rdf+xml';
					$fields['debug'] = 'on';
					$fields['query'] = $querystring;
	//				print("<!--$querystring-->\n");
					
					$rdf .= curl_post_contents($server_endpoint, $fields);
				}
			}
			
			
			foreach ($unprocessed_iris as $tmp_iri => $label) {
				$processed_iris[$tmp_iri] = $label;
			}
			
			
	
			if (preg_match_all('/<rdf:Description.*?rdf:Description>/', $rdf, $matches)){
				$lines=$matches[0];
				$num_lines = sizeof($lines);
				
				for($i=$num_lines-1; $i>=0; $i--) {
					foreach ($parent_included_iris as $parent_included_iri => $parent_included_label) {
						if (strpos($lines[$i], '<rdf:Description rdf:about="'.$parent_included_iri.'"><rdfs:subClassOf rdf:resource="http://')!==false) {
//								print("<!--{$lines[$i]}-->");
							unset($lines[$i]); 
							break;
						}
						if (strpos($lines[$i], '<rdf:Description rdf:about="'.$parent_included_iri.'"><rdfs:subPropertyOf rdf:resource="http://')!==false) {
//								print("<!--{$lines[$i]}-->");
							unset($lines[$i]); 
							break;
						}
					}
				}
				
//					print_r($lines);


				if (!$includeAllAxioms && !$includeAllAxiomsRecursively) {
					//drop this kind of supperclass to avoid importing too many terms
					for($i=$num_lines-1; $i>=0; $i--) {
						if (isset($lines[$i]) && strpos($lines[$i], '<rdfs:subClassOf rdf:nodeID="')!==false) {
							unset($lines[$i]); 
						}
						if (isset($lines[$i]) && strpos($lines[$i], '<rdfs:subPropertyOf rdf:nodeID="')!==false) {
							unset($lines[$i]); 
						}
					}
				}


			

				//drop disjointWith to avoid importing too many terms
				for($i=$num_lines-1; $i>=0; $i--) {
					if (isset($lines[$i]) && strpos($lines[$i], 'disjointWith')!==false) {
						unset($lines[$i]); 
					}
				}
				
				//drop owl:Thing
				for($i=$num_lines-1; $i>=0; $i--) {
					if (isset($lines[$i]) && strpos($lines[$i], '<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Thing"/>')!==false) {
						unset($lines[$i]); 
					}
				}
				

				for($i=$num_lines-1; $i>=0; $i--) {
					if (isset($lines[$i]) && preg_match('/\w+:(\w+?) xmlns:\w+="([^"]+?)"/', $lines[$i], $match)){
						$tmp_iri=$match[2].$match[1];
						if (!isset($processed_iris[$tmp_iri])) {
							$tmp_unprocessed_iris[$tmp_iri] = 'NA';
						}
					}
				}

				//fix for "n0pred" beening used for different xmlnss.
				for($i=$num_lines-1; $i>=0; $i--) {
					if (isset($lines[$i]) && strpos($lines[$i], '<n0pred:')!==false) {
						preg_match('/xmlns:n0pred="(\S+)"/', $lines[$i], $matches);
						$NSTmp=$matches[1];
						
						if (array_key_exists($NSTmp, $outputNSs)) {
							$prefixTmp = $outputNSs[$NSTmp];
						}
						else {
							$tokens = preg_split('/\//', trim($NSTmp));
							$prefixTmp = preg_replace('/[[:^alnum:]]/', '', array_pop($tokens));
							if (preg_match('/^\d+$/', $prefixTmp)) {
								$prefixTmp = preg_replace('/[[:^alnum:]]/', '', array_pop($tokens).$prefixTmp);
							}
							$prefixTmp='p_'.$prefixTmp;
							
							if (in_array($prefixTmp, $outputNSs)) {
								$j=1;
								while (in_array($prefixTmp.$j, $outputNSs)) {
									$j++;
								}
								
								$prefixTmp .= $j;
							}
						}
						
						$outputNSs[$NSTmp] = $prefixTmp;
						
						$lines[$i] = str_replace('n0pred:', $prefixTmp.':', $lines[$i]);
						$lines[$i] = preg_replace('/xmlns:n0pred="(\S+)"/', '', $lines[$i]);
					}
				}
				
				
				$output = join("\n", $lines);
				
				$strOutput .= "\n$output";
				
				
//					print("<!--$output-->\r\n\r\n\r\n\r\n\r\n");
		
				if ($includeAllAxiomsRecursively) {
					preg_match_all('/resource="(.+?)"/', $output, $matches);
					foreach ($matches[1] as $match) {
						if (!isset($processed_iris[$match]) && !isset($included_iris[$match])) {
							$tmp_unprocessed_iris[$match] = 'NA';
						}
					}
				}
				
				
				//get labels and types for related terms
				if ($includeAllAxioms) {
					preg_match_all('/resource="(.+?)"/', $output, $matches);
					foreach ($matches[1] as $match) {
						if (!isset($processed_iris[$match]) && !isset($included_iris[$match])) {
							$related_terms[$match] = 'NA';
						}
					}
				}

				preg_match_all('/<rdf:Description rdf:about="([^"]+?)"><rdf:type rdf:resource="http:\/\/www.w3.org\/2002\/07\/owl#Class"\/><\/rdf:Description>/', $output, $matches);
				foreach ($matches[1] as $match) {
					$strOutput .= "  <rdf:Description rdf:about=\"$match\">
<obo:IAO_0000412 rdf:resource=\"$ontology_original_uri\"/>
</rdf:Description>
";
				}
				
				preg_match_all('/<rdf:Description rdf:about="([^"]+?)"><rdf:type rdf:resource="http:\/\/www.w3.org\/2002\/07\/owl#ObjectProperty"\/><\/rdf:Description>/', $output, $matches);
				foreach ($matches[1] as $match) {
					$strOutput .= "  <rdf:Description rdf:about=\"$match\">
<obo:IAO_0000412 rdf:resource=\"$ontology_original_uri\"/>
</rdf:Description>
";
				}
				
				preg_match_all('/<rdf:Description rdf:about="([^"]+?)"><rdf:type rdf:resource="http:\/\/www.w3.org\/2002\/07\/owl#DatatypeProperty"\/><\/rdf:Description>/', $output, $matches);
				foreach ($matches[1] as $match) {
					$strOutput .= "  <rdf:Description rdf:about=\"$match\">
<obo:IAO_0000412 rdf:resource=\"$ontology_original_uri\"/>
</rdf:Description>
";
				}
			}
			$unprocessed_iris = $tmp_unprocessed_iris;
		}
	
		
		//retrieve label & type for related terms.
		if (!empty($related_terms)) {
			$querystring = "
PREFIX rdf: <$ns_rdf>
PREFIX rdfs: <$ns_rdfs>
PREFIX owl: <$ns_owl>

CONSTRUCT {
?s rdf:type ?o
}
FROM <$ontology_uri>
WHERE { 
?s rdf:type ?o. 
FILTER (?s in (<".join('>
, <', array_keys($related_terms)).">))
}
";
			$querystring = formatQuery($querystring);
			$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";

			$fields = array();
			$fields['default-graph-uri'] = $ontology_uri;
			$fields['format'] = 'application/rdf+xml';
			$fields['debug'] = 'on';
			$fields['query'] = $querystring;
			
			$rdf = curl_post_contents($server_endpoint, $fields);
			
			if (preg_match_all('/<rdf:Description.*?rdf:Description>/', $rdf, $matches)){
				foreach ($matches[0] as $line) {
					$strOutput .= "\n$line";
				}
			}
			
			$querystring = "
PREFIX rdf: <$ns_rdf>
PREFIX rdfs: <$ns_rdfs>
PREFIX owl: <$ns_owl>

CONSTRUCT {
?s rdfs:label ?o
}
FROM <$ontology_uri>
WHERE { 
?s rdfs:label ?o. 
FILTER (?s in (<".join('>
, <', array_keys($related_terms)).">))
}
";
			$querystring = formatQuery($querystring);
			$strQueryPrint .= $querystring . "\n\n====================================================================\n\n";

			$fields = array();
			$fields['default-graph-uri'] = $ontology_uri;
			$fields['format'] = 'application/rdf+xml';
			$fields['debug'] = 'on';
			$fields['query'] = $querystring;
			
			$rdf = curl_post_contents($server_endpoint, $fields);
			
			if (preg_match_all('/<rdf:Description.*?rdf:Description>/', $rdf, $matches)){
				foreach ($matches[0] as $line) {
					$strOutput .= "\n$line";
				}
			}
		}
		
		if (empty($fileNames) && sizeof($str_inputs)==1) {
			$fileName=$finalFile;
		}
		else {
			$fileName=createRandomPassword();
		}
		
		
		$tmpOutputURI="http://ontofox.hegroup.org/$fileName.owl";
		if (empty($fileNames) && $outputURI!='' && sizeof($str_inputs)==1) {
			$tmpOutputURI = $outputURI;
		}

		foreach($a_parent_axoim as $tmp_c_iri=>$tmp_p_output) {
			if (!isset($a_missing_term[$tmp_c_iri])) {
				$strOutput.=$tmp_p_output;
			}
		}



		$strOutput .= "
		<owl:Ontology rdf:about=\"$tmpOutputURI\"/>
		</rdf:RDF>";
		
		
		$strOutput = preg_replace('/<rdf:Description rdf:about="(\S+)"><rdf:type rdf:resource="http:\/\/www.w3.org\/2002\/07\/owl#ObjectProperty"\/><\/rdf:Description>/', "<owl:ObjectProperty rdf:about=\"$1\"/>", $strOutput);
		
		foreach ($outputNSs as $NSTmp => $prefixTmp) {
			$strOutput = "
		xmlns:$prefixTmp=\"$NSTmp\"" . $strOutput;
		}
		
		$strOutput = '<?xml version="1.0" encoding="utf-8" ?>
<rdf:RDF
'. $strOutput;
		
		file_put_contents("$userfiles/$fileName.in.owl", $strOutput);
		
		$json_settings = array();
		$json_settings['termsToKeep'] = array_keys($terms_to_keep);
		$json_settings['inputFile'] = "$userfiles/$fileName.in.owl";
		$json_settings['outputFile'] = "$userfiles/$fileName.owl";
		$json_settings['retrievalSetting'] = $retrieval_setting;
		$json_settings['ontologyURI'] = $tmpOutputURI;
		$json_settings['annotationIrisToExclude'] = $annotation_iris_to_exclude;
		 
		
		file_put_contents("$userfiles/$fileName.settings", json_encode($json_settings));
	
		//Reformat the owl file to make it tight.
		exec("java -cp .:./libs/* org.hegroup.ontofox.OWLReformat $userfiles/$fileName.settings");

		//unlink("$userfiles/$fileName.in.owl");
		$fileNames[$fileName] = 1;
	}
}

if ($vali->getErrorMsg()=='') {
	if (sizeof($fileNames)>1) {
		$json_settings = array();
		$json_settings['inputFiles'] = array();
		foreach ($fileNames as $fileName=>$tmpv) {
			$json_settings['inputFiles'][]="$userfiles/$fileName.owl";
		}
		$json_settings['outputFile'] = "$userfiles/$finalFile.owl";
		$json_settings['ontologyURI'] = $outputURI=='' ? "http://ontofox.hegroup.org/$finalFile.owl" : $outputURI;
		
		file_put_contents("$userfiles/$finalFile.settings", json_encode($json_settings));
	
		exec("java -cp .:./libs/* org.hegroup.ontofox.OWLMerge $userfiles/$finalFile.settings");
		
		$fileNames[$finalFile]=1;
	}
	
	$strSql="UPDATE ontofox_counter SET count=count+1 WHERE page='getExternal.php'";

	$db = ADONewConnection($driver);
	$db->Connect($host, $username, $password, $database);

	$db->Execute($strSql);
}
?>
