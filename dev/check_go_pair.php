<?php 
include('../inc/functions.php');

$str1='0016740; 0019842; 0048037; 0016853; 0005737; 0006807; 0046483; 0051186; 0003824';

$str2='0006732; 0006783; 0009231; 0006747; 0009102; 0009435; 0006744; 0009234; 0009228; 0042823; 0009236; 0015937';



$tokens1=preg_split('/; /', $str1);
$tokens2=preg_split('/; /', $str2);

foreach ($tokens1 as $token1) {
	$strSparql='SELECT ?link ?o  

From <http://purl.org/science/graph/obo/GO>


WHERE
{
  {
    SELECT ?s  ?o
    WHERE
    {
      ?s ?p ?o.
      FILTER (?p in (rdfs:subClassOf, rdfs:subPropertyOf, rdf:first, rdf:rest, owl:intersectionOf, owl:equivalentClass, owl:someValuesFrom, owl:someValuesFrom, owl:onProperty))
    }
  } OPTION (TRANSITIVE, t_in(?s), t_out(?o), t_step(?s) as ?link).
  FILTER (?s= <http://purl.obolibrary.org/obo/GO_'.$token1.'>)
}
';

//print($strSparql);

	$results=json_query($strSparql, 'http://sparql.obo.neurocommons.org/sparql');
//	print_r($results);

	foreach ($results as $result) {
		foreach ($tokens2 as $token2) {
			//print($result['link'].'::'.$result['o']);
			if(strpos($result['link'], 'GO_'.$token2)!==false || strpos($result['o'], 'GO_'.$token2)!==false ){
				
				print($token1 . '==>' . $token2);
			}
	
		}
	}
}

?>