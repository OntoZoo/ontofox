<?php 
include_once('inc/functions.php');


$vali=new Validation($_REQUEST);
$keywords = $vali->getInput('term', 'Keywords', 1, 60, true);

$ontology = $vali->getInput('ontology', 'Ontology', 0, 60, true);

$jason=array();

$array_property=array();
$array_property[]='http://www.w3.org/2000/01/rdf-schema#label';
$array_property[]='http://purl.obolibrary.org/obo/IAO_0000111';
$array_property[]='http://purl.obolibrary.org/obo/IAO_0000118';

if ($vali->getErrorMsg()=='') {

	$db = ADONewConnection($driver);
	$db->Connect($host, $username, $password, $database);
	
	$strSql="select ontology_abbrv, ontology_graph_url from ontology where loaded='y'";
	$rs=$db->Execute($strSql);

	
	
	$terms=array();
	
	$array_ontology=array();
	foreach ($rs as $row) {
		$array_ontology[$row['ontology_graph_url']]=$row['ontology_abbrv'];
	}
	
	if ($ontology!='') {
		$settings = getSettings($ontology);
		
		if (preg_match('/[a-zA-Z]+[:_]\d{7,}/', $keywords)) {
			$search_term_url='http://purl.obolibrary.org/obo/'.preg_replace('/:/', '_', $keywords);
			$querystring="SELECT *
from <{$settings['ns_main']}>
WHERE{
?s ?p ?o .
filter (?p in (<".join('>,<', $array_property).">)).
filter (?s in (<$search_term_url>)).
}
limit 50
";
		}
		else {
			$querystring="SELECT *
from <{$settings['ns_main']}>
WHERE{
?s ?p ?o .
filter (?p in (<".join('>,<', $array_property).">)).
FILTER (isIRI(?s)).
?o bif:contains \"'$keywords*'\".
}
limit 5000
";
		}
	}
	else {
		if (preg_match('/[a-zA-Z]+[:_]\d{7,}/', $keywords)) {
			$search_term_url='http://purl.obolibrary.org/obo/'.preg_replace('/:/', '_', $keywords);
			$querystring="SELECT *
WHERE{
graph ?g 
{
?s ?p ?o .
filter (?p in (<".join('>,<', $array_property).">)).
filter (?s in (<$search_term_url>)).
}
}
limit 50
";
		}
		else {
			$querystring="SELECT *
WHERE{
graph ?g 
{
?s ?p ?o .
filter (?p in (<".join('>,<', $array_property).">)).
FILTER (isIRI(?s)).
?o bif:contains \"'$keywords*'\".
}
}
limit 5000
";
		}
	}
	
//	print ($querystring);
	
	$results = json_query($querystring, $default_end_point);

	$count=0;
	$results2=array();
	foreach ($results as $result) {
		if (strtolower($result['o'])==strtolower($keywords)) {
			$show_term=true;
			if (isset($result['g'])) {
				if (isset($array_ontology[$result['g']])) {
					$ontology_tmp= $array_ontology[$result['g']];
				}
				else {
					$show_term=false;
				}
			}
			else {
				$ontology_tmp= $ontology;
			}
			
			if ($show_term) {
				$term_id=array_pop(preg_split('/[\/#]/', $result['s']));
					
				if (!isset($terms[$ontology_tmp.';'.$result['o']])) {
					$count++;
					$jason[]=array('id'=>$ontology_tmp.':::'.myUrlEncode($result['s']), 'value'=>$result['o'], 'label'=>$result['o'].' ('.$ontology_tmp.': '.$term_id.')');
					$terms[$ontology_tmp.';'.$result['o']]=1;
				}
			}
		}
		else {
				$results2[]=$result;
		}
	}

	$results3=array();
	foreach ($results2 as $result) {
		if ($count>100) break;
		if (strpos(strtolower($result['o']), strtolower($keywords))===0) {
			$show_term=true;
			if (isset($result['g'])) {
				if (isset($array_ontology[$result['g']])) {
					$ontology_tmp= $array_ontology[$result['g']];
				}
				else {
					$show_term=false;
				}
			}
			else {
				$ontology_tmp= $ontology;
			}
			
			if ($show_term) {
				$term_id=array_pop(preg_split('/[\/#]/', $result['s']));
					
				if (!isset($terms[$ontology_tmp.';'.$result['o']])) {
					$count++;
					$jason[]=array('id'=>$ontology_tmp.':::'.myUrlEncode($result['s']), 'value'=>$result['o'], 'label'=>$result['o'].' ('.$ontology_tmp.': '.$term_id.')');
					$terms[$ontology_tmp.';'.$result['o']]=1;
				}
			}
		}
		else {
				$results3[]=$result;
		}
	}

	foreach ($results3 as $result) {
		if ($count>100) break;
		$show_term=true;
		if (isset($result['g'])) {
			if (isset($array_ontology[$result['g']])) {
				$ontology_tmp= $array_ontology[$result['g']];
			}
			else {
				$show_term=false;
			}
		}
		else {
			$ontology_tmp= $ontology;
		}
		
		if ($show_term) {
			$term_id=array_pop(preg_split('/[\/#]/', $result['s']));
				
			if (!isset($terms[$ontology_tmp.';'.$result['o']])) {
				$count++;
				$jason[]=array('id'=>$ontology_tmp.':::'.myUrlEncode($result['s']), 'value'=>$result['o'], 'label'=>$result['o'].' ('.$ontology_tmp.': '.$term_id.')');
				$terms[$ontology_tmp.';'.$result['o']]=1;
			}
		}
	}
	
}

print(json_encode($jason));
?>
