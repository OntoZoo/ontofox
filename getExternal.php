<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>OntoFox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->

<p><span class="header_darkred">Retrieving Results</span></p>
<?
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

$outputURI = '';
$outputFile = 'import.owl';

$finalFile = createRandomPassword();

$str_inputs = array();

$array_ns = array();

//ontology original URIs
$array_original_ns = array();

//SPARQL endpoint servers
$array_server = array();

$array_imports = array();


$strSql= "select * from ontology where to_list='y'";
$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$rs = $db->Execute($strSql);

foreach($rs as $row) {
	$array_ns[$row['ontology_abbrv']]=$row['ontology_graph_url'];
	$array_original_ns[$row['ontology_abbrv']]=$row['ontology_url'];
	$array_server[$row['ontology_abbrv']]=$row['end_point'];
}

$strSql= "select * from import";
$rs = $db->Execute($strSql);

foreach($rs as $row) {
	if (isset($array_ns[$row['ontology_abbrv']])) {
		if ($row['import_graph_url']!='') {
			$array_imports[$array_ns[$row['ontology_abbrv']]][]=$row['import_graph_url'];
		}
		else {
			$array_imports[$array_ns[$row['ontology_abbrv']]][]=$row['import_url'];
		}
	}
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

		if (strpos($line, '#')===0) {
			//ignore comments
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

}
else {
	$ontology= $vali->getInput('ontology', 'Ontology', 0, 128);
	$ontology2 = $vali->getInput('ontology2', 'Your own ontology', 0, 1024);
	$ontology = trim($ontology . "\n" . $ontology2);
	$term_iris = $vali->getInput('term_iris', 'Lower level term IRIs to be imported', 0, 81920);
	$top_term_iris = $vali->getInput('top_term_iris', 'Top level term IRIs to be imported', 0, 8192);
	$top_term_iris2 = $vali->getInput('top_term_iris2', 'Top level term IRIs to be imported', 0, 8192);
	$retrieval_setting = $vali->getInput('retrieval_setting', 'Source term retrieval setting', 0, 128);
	$outputURI = $vali->getInput('output_iri', 'URI of the OWL(RDF/XML) output file', 0, 128);
	$annotation_iris = $vali->getInput('annotation_iris', 'annotation IRIs to be included', 0, 8192);
	
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
[Branch extractions from source term URIs and target direct superclass URIs]
$top_term_iris2
[Source annotation URIs]
$annotation_iris";

	file_put_contents("$userfiles/$finalFile.txt", $str_inputs[0]);
}


$fileNames=array();

$str_inputs2=array();

foreach ($str_inputs as $str_input) {

	$lines = preg_split('/[\r\n]+/', $str_input);
	$current_tag = '';
	foreach ($lines as $line) {
		$line = trim($line);
		if (strpos($line, '[')===0) {
			foreach($section_tags as $section_tag_var => $section_tag_txt){
				if (strpos($line, $section_tag_txt)===0) {
					$current_tag = $section_tag_var;
					eval("$current_tag = '';");
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
				eval("$current_tag .= \"$line\\n\";");
			}
		}
	}
	
	if ($term_iris!='')  {
		$str_inputs2[] = "[Source ontology]
$ontology
[Low level source term URIs]
$term_iris
[Top level source term URIs and target direct superclass URIs]
$top_term_iris
[Source term retrieval setting]
$retrieval_setting
[Source annotation URIs]
$annotation_iris";
	}
	if (isset($top_term_iris2) && $top_term_iris2!='')  {
		$str_inputs2[] = "[Source ontology]
$ontology
[Top level source term URIs and target direct superclass URIs]
$top_term_iris2
[Source annotation URIs]
$annotation_iris";
	}
}

if (empty($str_inputs2)) {
	$vali->concatError("You didn't specify any ontology or terms");
}


foreach ($str_inputs2 as $str_input) {
//	print_r("<!--$str_input-->");
	
	foreach($section_tags as $section_tag_var => $section_tag_txt){
		eval("$section_tag_var = '';");
	}

	$lines = preg_split('/[\r\n]+/', $str_input);
	$current_tag = '';
	foreach ($lines as $line) {
		$line = trim($line);
		if (strpos($line, '[')===0) {
			foreach($section_tags as $section_tag_var => $section_tag_txt){
				if (strpos($line, $section_tag_txt)===0) {
					$current_tag = $section_tag_var;
					eval("$current_tag = '';");
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
				eval("$current_tag .= \"$line\\n\";");
			}
		}
	}
	
	if (!isset($term_iris)) $term_iris='';
	if (!isset($top_term_iris)) $top_term_iris='';
	
	if (strlen($term_iris)<10 && strlen($top_term_iris)<10) {
		$vali->concatError("At least one lower level term IRI is required for individual term extraction or at least one top level term IRI is required for branch extraction.");
	}


	if (!isset($ontology) || strlen($ontology)<2) {
		$vali->concatError("Ontology is required.");
	}
	
//	print("<!--$ontology-->");
	
	//Get source ontology
	if ($vali->getErrorMsg()=='') {
		$extractBranch=false;
		
		if ($term_iris=='') {
			$extractBranch=true;
		}
	
		//parse ontology
		$lines = preg_split('/[\r\n]+/', trim($ontology));
		
		$ontology_uri = '';
		$ontology_original_uri='';
		$server_import = '';
		
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
						$server_import = $array_server[$line];
					}
					else {
						$ontology_uri = $line;
						$ontology_original_uri= $line;
					}
				}
				else {
					$line = trim(str_replace('fromEndpoint ', '', $line));
					$server_import = $line;
				}
			}
		}
		
		
		$retrieval_setting = isset($retrieval_setting) ? trim($retrieval_setting) : '';
		if ($retrieval_setting=='') {
			$retrieval_setting='includeNoIntermediates';
		}
		
		if ($extractBranch) {
			//for branch extraction
			$retrieval_setting='includeAllIntermediates';
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
		
		$included_iris = array(); 
		
		$parent_included_iris = array(); 
		$terms_to_keep = array();
		
		
		$top_term_iris=trim($top_term_iris);
		
		//By default, don't retrive structure.
		if ($top_term_iris=='') {
			$top_term_iris = $term_iris;
		}
		
		//Special case to help lazy people.
		if ((strpos($top_term_iris, 'subClassOf ')===0 || strpos($top_term_iris, 'subPropertyOf ')===0 || strpos($top_term_iris, 'type ')===0) && !preg_match('/[\r\n]+/', $top_term_iris)) {
			$top_term_iris = preg_replace('/[\r\n]+/',  "\n" . $top_term_iris . "\n", $term_iris) . "\n" . $top_term_iris;
		}
		
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

						$strOutput.="
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

						$strOutput.="
		  <rdf:Description rdf:about=\"$current_iri\">
			<rdfs:subPropertyOf rdf:resource=\"$line\"/>
		  </rdf:Description>
		";
					}
				}
				elseif (strpos($line, 'type ')===0) {
					$line = trim(str_replace('type ', '', $line));
					if ($current_iri!='') {

						$terms_to_keep[$line] = 1;		

						$strOutput.="
		  <rdf:Description rdf:about=\"$current_iri\">
			<rdf:type rdf:resource=\"$line\"/>
		  </rdf:Description>
		";
					}
				}
				else {
					$parent_included_iris[$line] = 'NA';
					$current_iri=$line;
					$terms_to_keep[$line] = 1;		
					
				}
			}
		}
		
		//Get annotation URLs user wish to include
		$annotation_iris_to_include = array();
		$annotation_iris_to_include['http://www.w3.org/1999/02/22-rdf-syntax-ns#type'] = array('action'=>'', 'iri'=>'');

		if (!$extractBranch) {
			$annotation_iris_to_include['http://www.w3.org/2000/01/rdf-schema#subClassOf'] = array('action'=>'', 'iri'=>'');
			$annotation_iris_to_include['http://www.w3.org/2000/01/rdf-schema#subPropertyOf'] = array('action'=>'', 'iri'=>'');
			$annotation_iris_to_include['http://www.w3.org/2002/07/owl#equivalentClass'] = array('action'=>'', 'iri'=>'');
		}
		
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
		
	
		$imported_ontologies = array(); 
		
		$settings['remote_store_endpoint']=$server_import;
		
		$num_queries = 0;
		
		$unprocessed_iris = array();
		$processed_iris = array(); 
		
		//print_r($parent_included_iris);
		
		if ($extractBranch) {
			foreach ($parent_included_iris as $import_term=>$tmpLabel) {
				$terms_to_keep[$import_term] =1;
				
				if (!isset($processed_iris[$import_term]) && !isset($included_iris[$import_term])) {
					$results = array($import_term => 'NA');
					
					getSubClassAndProperty($ontology_uri, $results, $import_term);
					
					
					foreach ($results as $term_iri => $term_label) {
						if (!isset($processed_iris[$term_iri])) {
							$unprocessed_iris[$term_iri] = $term_label;
						}
					}
				}
			}
		}
		else {
			//process term URIs to be imported and get super classes/properties.
			$lines = preg_split('/[\r\n]+/', trim($term_iris));
			
			foreach ($lines as $line) {
				if (strpos($line, '#')===0) {
					//ignore comments
				}
				else {
					if (strpos($line, ' #')!==false) {
						$line = trim(substr($line, 0, strpos($line, ' #')));
					}
					$import_term=trim($line);
					
					$terms_to_keep[$import_term] =1;
					
					if (!isset($processed_iris[$import_term]) && !isset($included_iris[$import_term])) {
						$results = array($import_term => 'NA');
						if (!isset($parent_included_iris[$import_term])) {
							getSupClassAndProperty($ontology_uri, $results, $import_term);
							//error_log("!!!\n", 3, '/tmp/error.log');
							
							foreach ($results as $term_iri => $term_label) {
								if (!isset($processed_iris[$term_iri])) {
									$unprocessed_iris[$term_iri] = $term_label;
								}
							}
						}
						else {
							if (!isset($processed_iris[$import_term])) {
								$unprocessed_iris[$import_term] = 'NA';
							}
						}
					}
				}
			}		
		}
		


		$related_terms=array();

		//Send query to servers and process response.
		while (!empty($unprocessed_iris)) {
			$tmp_results = array();
			
			$num_terms_per_query = 20;
			if (!empty($annotation_iris_to_include)) {
				$num_terms_per_query = round($num_terms_per_query/sizeof($annotation_iris_to_include));
				if ($num_terms_per_query <2) $num_terms_per_query =2;
			}
			
			$array_iris = array_chunk($unprocessed_iris, $num_terms_per_query, true);
		
			foreach ($array_iris as $iris) {
				$querystring = "
CONSTRUCT {
";
				$i = 0;
				foreach ($iris as $tmp_iri=>$tmp_label) {
					if ($includeAllAxioms || $includeAllAxiomsRecursively || strpos($tmp_iri, 'nodeID')!==false) {
						$i++;
						$querystring .= "	<$tmp_iri> ?p{$i} ?o{$i}.
";
					}
					else {
						foreach ($annotation_iris_to_include as $annotation_iri => $mapping) {
							$i++;
							if ($mapping['action']=='copyTo') {
								$querystring .= "	<$tmp_iri> <$annotation_iri> ?o{$i}.
";
								$querystring .= "	<$tmp_iri> <{$mapping['iri']}> ?o{$i}.
";
							}
							elseif ($mapping['action']=='mapTo') {
								$querystring .= "	<$tmp_iri> <{$mapping['iri']}> ?o{$i}.
";
							}
							else {
								$querystring .= "	<$tmp_iri> <$annotation_iri> ?o{$i}.
";
							}
						}
						
						if ($includeAllAnnotationProperties) {
							$i++;
							$querystring .= "	<$tmp_iri> ?p{$i} ?o{$i}.
";
						}
					}
					
				}
		
				$querystring .= "
}

FROM <$ontology_uri>";

				if (isset($array_imports[$ontology_uri])) {
					foreach ($array_imports[$ontology_uri] as $import_graph_uri) {
						
						$querystring .= "
FROM <$import_graph_uri>
";
					}
				}

				$querystring .= "
WHERE { 
";
				$i = 0;
				foreach ($iris as $tmp_iri=>$tmp_label) {
					if ($includeAllAxioms || $includeAllAxiomsRecursively || strpos($tmp_iri, 'nodeID')!==false) {
						$i++;
						if ($i>1) $querystring .= " UNION";
						$querystring .= "
 {<$tmp_iri> ?p{$i} ?o{$i}}
";
					}
					else {
						foreach ($annotation_iris_to_include as $annotation_iri=>$mapping) {
							$i++;
							if ($i>1) $querystring .= " UNION";
		
							if (!preg_match('/nodeID:/', $tmp_iri) && $mapping['action']=='copyTo') {
								$querystring .= "
 {<$tmp_iri> <$annotation_iri> ?o{$i}}
";
							}
							elseif (!preg_match('/nodeID:/', $tmp_iri) && $mapping['action']=='mapTo') {
								$querystring .= "
 {<$tmp_iri> <$annotation_iri> ?oa{$i} .
 ?oa{$i} <http://www.w3.org/2000/01/rdf-schema#label> ?o{$i}}
";
							}
							else {
								$querystring .= "
 {<$tmp_iri> <$annotation_iri> ?o{$i}}
";
							}
							
						}
						
						if ($includeAllAnnotationProperties) {
							$i++;
							if ($i>1) $querystring .= " UNION";
							$querystring .= "	{<$tmp_iri> ?p{$i} ?o{$i}.
?p{$i} <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://www.w3.org/2002/07/owl#AnnotationProperty>}
";
						}
					}
				}
		
				$querystring .= "
}";
				$querystring = formatQuery($querystring);

		
				foreach ($iris as $tmp_iri => $label) {
					$processed_iris[$tmp_iri] = $label;
				}

				if ($server_import=='http://sparql.obo.neurocommons.org/sparql') {
					//$querystring = str_replace('nodeID://b', 'nodeID://', $querystring);
				}

				$fields = array();
				$fields['default-graph-uri'] = $ontology_uri;
				$fields['format'] = 'application/rdf+xml';
				$fields['debug'] = 'on';
				$fields['query'] = $querystring;
				
//				print("<!--$querystring-->\n");
				
				$rdf = curl_post_contents($server_import, $fields);
//				print("<!--$rdf-->\n");
				
				//$rdf = preg_replace('/rdf:nodeID="b/', 'rdf:nodeID="', $rdf);
		
				if (preg_match_all('/<rdf:Description.*?rdf:Description>/', $rdf, $matches)){
					$lines=$matches[0];
					$num_lines = sizeof($lines);
					
					for($i=$num_lines-1; $i>=0; $i--) {
						foreach ($parent_included_iris as $parent_included_iri => $parent_included_label) {
							if (strpos($lines[$i], '<rdf:Description rdf:about="'.$parent_included_iri.'"><rdfs:subClassOf')!==false) {
//								print("<!--{$lines[$i]}-->");
								unset($lines[$i]); 
								break;
							}
							if (strpos($lines[$i], '<rdf:Description rdf:about="'.$parent_included_iri.'"><rdfs:subPropertyOf')!==false) {
//								print("<!--{$lines[$i]}-->");
								unset($lines[$i]); 
								break;
							}
						}
					}


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
					
					//drop hasDbXref to avoid importing too many terms
					for($i=$num_lines-1; $i>=0; $i--) {
						if (isset($lines[$i]) && strpos($lines[$i], 'hasDbXref')!==false) {
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
							if (!isset($processed_iris[$tmp_iri]) && !isset($included_iris[$tmp_iri]) && !iriImported($tmp_iri)) {
								$tmp_results[$tmp_iri] = 'NA';
							}
						}
					}

					//fix for "n0pred" beening used for diffrent xmlnss.
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
//print("<!-$output-->\n");
					
					$strOutput .= "\n$output";
				
					preg_match_all('/nodeID="(\S+)"/', $output, $matches);
					foreach ($matches[1] as $match) {
						if (!isset($processed_iris['nodeID://'.$match])) {
							$tmp_results['nodeID://'.$match] = 'NA';
						}
					}
			
					if ($includeAllAxiomsRecursively) {
						preg_match_all('/resource="(.+?)"/', $output, $matches);
						foreach ($matches[1] as $match) {
							if (!isset($processed_iris[$match]) && !isset($included_iris[$match]) && !iriImported($match)) {
								$tmp_results[$match] = 'NA';
							}
						}
					}
					
					
					//get labels and types for related terms
					if ($includeAllAxioms) {
						preg_match_all('/resource="(.+?)"/', $output, $matches);
						foreach ($matches[1] as $match) {
							if (!isset($processed_iris[$match]) && !isset($included_iris[$match]) && !iriImported($match)) {
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
			}
			
			$unprocessed_iris = $tmp_results;
		}
		
		
		//retrieve label & type for related terms.
		if (!empty($related_terms)) {
			foreach ($related_terms as $tmp_iri=>$tmp_label) {
				$querystring = "
CONSTRUCT {
<$tmp_iri> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?o.
<$tmp_iri> <http://www.w3.org/2000/01/rdf-schema#label> ?o1
}

FROM <$ontology_uri>";

				if (isset($array_imports[$ontology_uri])) {
					foreach ($array_imports[$ontology_uri] as $import_graph_uri) {
						
						$querystring .= "
FROM <$import_graph_uri>
";
					}
				}
			
				$querystring .= "
WHERE { 
{<$tmp_iri> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> ?o}
UNION {<$tmp_iri> <http://www.w3.org/2000/01/rdf-schema#label> ?o1}
}";
				$fields = array();
				$fields['default-graph-uri'] = $ontology_uri;
				$fields['format'] = 'application/rdf+xml';
				$fields['debug'] = 'on';
				$fields['query'] = $querystring;
				
//				print("<!--$querystring-->\n");
				
				$rdf = curl_post_contents($server_import, $fields);
				
//				print("<!--$rdf-->\n");
				if (preg_match_all('/<rdf:Description.*?rdf:Description>/', $rdf, $matches)){
					foreach ($matches[0] as $line) {
						$strOutput .= "\n$line";
					}
				}
			}
		}

		
		if (empty($fileNames) && sizeof($str_inputs2)==1) {
			$fileName=$finalFile;
		}
		else {
			$fileName=createRandomPassword();
		}
		
		
		$tmpOutputURI="http://ontofox.hegroup.org/$fileName.owl";
		if (empty($fileNames) && $outputURI!='' && sizeof($str_inputs2)==1) {
			$tmpOutputURI = $outputURI;
		}
		 
		$strOutput .= "
		<owl:Ontology rdf:about=\"$tmpOutputURI\"/>
		</rdf:RDF>";
		
		
		foreach ($outputNSs as $NSTmp => $prefixTmp) {
			$strOutput = "
		xmlns:$prefixTmp=\"$NSTmp\"" . $strOutput;
		}
		
		$strOutput = '<?xml version="1.0" encoding="utf-8" ?>
<rdf:RDF
'. $strOutput;
		
//		$strOutput = preg_replace('/rdf:nodeID="/', 'rdf:nodeID="b', $strOutput);
		
		file_put_contents("$userfiles/$fileName.in.owl", $strOutput);
		
		$json_settings = array();
		$json_settings['termsToKeep'] = array_keys($terms_to_keep);
		$json_settings['inputFile'] = "$userfiles/$fileName.in.owl";
		$json_settings['outputFile'] = "$userfiles/$fileName.owl";
		$json_settings['retrievalSetting'] = $retrieval_setting;
		$json_settings['ontologyURI'] = $tmpOutputURI;
		 
		
		file_put_contents("$userfiles/$fileName.settings", json_encode($json_settings));
	
		//Reformat the owl file to make it tight.
		system("java -cp .:./OWL.jar org.hegroup.OWLReformat $userfiles/$fileName.settings");

		//unlink("$userfiles/$fileName.in.owl");
		$fileNames[$fileName] = 1;
	}
}

if ($vali->getErrorMsg()!='') {
?>
<p style="color:#FF1F55">Error: <?=$vali->getErrorMsg()?></p>
<?
}
else {
	if (sizeof($fileNames)>1) {
		$json_settings = array();
		$json_settings['inputFiles'] = array();
		foreach ($fileNames as $fileName=>$tmpv) {
			$json_settings['inputFiles'][]="$userfiles/$fileName.owl";
		}
		$json_settings['outputFile'] = "$userfiles/$finalFile.owl";
		$json_settings['ontologyURI'] = $outputURI=='' ? "http://ontofox.hegroup.org/$finalFile.owl" : $outputURI;
		
		file_put_contents("$userfiles/$finalFile.settings", json_encode($json_settings));
	
		system("java -cp .:./OWL.jar org.hegroup.OWLMerge $userfiles/$finalFile.settings");
		
		$fileNames[$finalFile]=1;
	}
	
	if (file_exists("userfiles/$finalFile.owl")) {
?>
<p><strong>Finished retrieving process. Please download <a href="userfiles/<?=$finalFile?>.owl" target="_blank">the output file</a>.</strong></p>
<?
		if (isset($_SESSION['GALAXY_URL']) && $_SESSION['GALAXY_URL']!='') {
?>    

    <form method="post" action="<?=$_SESSION['GALAXY_URL']?>" enctype="multipart/form-data" name="galaxyform">
      <input type="hidden" name="id" value="<?=$finalFile?>"></input>
      <input type="hidden" name="tool_id" value="get_obo"></input>
      <input type="hidden" name="URL" value="http://ontofox.hegroup.org/userfiles/<?=$finalFile?>.owl"></input>

      <b>OWL2 format</b>
     <input name="submit" type="submit" value="Export to Galaxy"></input></form>

<?
		}
	}
	else {
?>
<p><strong>An error has occured during the retrieval process, please try again or <a href="contactus.php">contact us</a>.</strong></p>
<?
	}
?>
<p>Your input file should be located at http://ontofox.hegroup.org/userfiles/<?=$finalFile?>.txt and your output file should be located at http://ontofox.hegroup.org/userfiles/<?=$finalFile?>.owl. Please includes these two links in your email if you need our assistance.</p>
<p>These files will be destroyed at 3:00 AM EST (New York time). If you wish to destroy these files now, please <a href="remove.php?f=<?=join(',', array_keys($fileNames))?>">click here</a>. </p>
<p><a href="http://survey.hegroup.org/index.php?sid=46454&lang=en">OntoFox Survey</a>:  your feedback on OntoFox is welcome and important for us to improvie this service. This survey contains 16 questions and will take approximately 5 minutes. Thank you!</p>
<?	

	$strSql="UPDATE counter SET count=count+1 WHERE page='getExternal.php'";

	$db = ADONewConnection($driver);
	$db->Connect($host, $username, $password, $database);

	$db->Execute($strSql);

}
?>
<!--p>Your input file can be retrieved from <a href="userfiles/<?=$finalFile?>.txt" target="_blank">http://ontofox.hegroup.org/userfiles/<?=$finalFile?>.txt</a>. Please provide us this link if you encounter any error so that we can take a look at.</p-->
<!-- InstanceEndEditable --></div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="Images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4869243-8");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
