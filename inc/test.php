<?php 
$url= "http://sparql.bioontology.org/sparql/?format=";
//$url.= urlencode('application/rdf+xml');
$url.= urlencode('rdfxml');
$url.= '&query='.urlencode('prefix p_1: <http://purl.obolibrary.org/obo/>
prefix p_2: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
prefix p_3: <http://www.w3.org/2000/01/rdf-schema#>
prefix p_4: <http://www.w3.org/2002/07/owl#>
CONSTRUCT {
	p_1:VO_0000025 p_2:type ?o1.
	p_1:VO_0000025 p_3:subClassOf ?o2.
}
FROM p_1:VO.owl
WHERE { 
 {p_1:VO_0000025 p_2:type ?o1}
 UNION
 {p_1:VO_0000025 p_3:subClassOf ?o2}
}
');

print(file_get_contents($url));
?>