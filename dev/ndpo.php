<?php 
header("Content-Type: text/plain");
ini_set("memory_limit", "2048M");
set_time_limit(60*60);

include_once('../inc/functions.php');

$endpoint='http://sparql.hegroup.org/sparql/sparql';

$toexclude=array();
$toexclude[]='http://www.w3.org/1999/02/22-rdf-syntax-ns#';
$toexclude[]='http://www.w3.org/2002/07/owl#';
$toexclude[]='http://purl.obolibrary.org/obo/';
$toexclude[]='http://purl.org/dc/elements/1.1/';
$toexclude[]='http://ccdb.ucsd.edu/NDPO/1.0/NDPO.owl';
$toexclude[]='http://ontology.neuinfo.org/NIF/nif.owl';


$querystring="
SELECT *
FROM <http://ccdb.ucsd.edu/NDPO/1.0/NDPO.owl>
WHERE 
{?s ?p ?o}
";

//print($querystring);

$fields = array();
$fields['default-graph-uri'] = '';
$fields['format'] = 'application/sparql-results+json';
$fields['debug'] = 'on';
$fields['query'] = $querystring;
$results = json_decode(curl_post_contents($endpoint, $fields));

$urls = array();

if(!empty($results->results->bindings)){
	foreach ($results->results->bindings as $result) {
		$term_url=$result->s->value;
		$property_value=$result->o->value;
		
		$tokeep=true;
		foreach ($toexclude as $pattern) {
			if (strpos($term_url, $pattern)===0) {
				$tokeep=false;
			}
		}
		
		if ($tokeep && preg_match('/^http:/', $term_url)) {
			$urls[$term_url] = 1;
		}

		$tokeep=true;
		foreach ($toexclude as $pattern) {
			if (strpos($property_value, $pattern)===0) {
				$tokeep=false;
			}
		}
		
		if ($tokeep && preg_match('/^http:/', $property_value)) {
			$urls[$property_value] = 1;
		}
	}
}

ksort($urls);
//print(join("\n", array_keys($urls)));

?>
[Source ontology]
http://ontology.neuinfo.org/NIF/nif_full.owl
fromEndpoint http://sparql.hegroup.org/sparql/sparql

[Low level source term URIs]
<?php print(join("\n", array_keys($urls)));?>


[Top level source term URIs and target direct superclass URIs]

[Source term retrieval setting]
includeComputedIntermediates

[Source annotation URIs]
includeAllAxioms

<?php 


$ontos=array();
foreach (array_keys($urls) as $url) {
	$tokens=preg_split('/#/', $url);
	$ontos[$tokens[0]][]=$url;
}

//print_r($ontos);
/*

foreach ($ontos as $onto => $urls) {
	if (strpos($onto, 'http://ontology.neuinfo.org/NIF')===0) {
?>
[Source ontology]
<?php print($onto);?>

fromEndpoint http://sparql.hegroup.org/sparql/sparql

[Low level source term URIs]
<?php print(join("\n", $urls));?>


[Top level source term URIs and target direct superclass URIs]

[Source term retrieval setting]
includeComputedIntermediates

[Source annotation URIs]
includeAllAxioms

<?php
	}
}

foreach ($ontos as $onto => $urls) {
	if (strpos($onto, 'http://ontology.neuinfo.org/NIF')===false) {
?>
[Source ontology]
<?php print($onto);?>


[Low level source term URIs]
<?php print(join("\n", $urls));?>


[Top level source term URIs and target direct superclass URIs]

[Source term retrieval setting]
includeComputedIntermediates

[Source annotation URIs]
includeAllAxioms

<?php
	}
}
*/

?>