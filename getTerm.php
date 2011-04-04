<?
include_once('inc/functions.php');

$vali=new Validation($_REQUEST);
$keywords = $vali->getInput('keywords', 'Keywords', 1, 60, true);

$ontology = $vali->getInput('ontology', 'Ontology', 1, 60, true);

$jason=array('identifier'=> 'url', 'label'=>'name', 'items'=>array());

if ($vali->getErrorMsg()=='') {
	
	$strSql="SELECT terms.term_id, terms.property_value, url_base.url_base FROM terms join url_base on terms.term_url_base_id = url_base.url_base_id WHERE ontology_abbrv='$ontology' AND property_value like '$keywords%' limit 500";

	$db = ADONewConnection($driver);
	$db->Connect($host, $username, $password, $database);

	$rs = $db->Execute($strSql);
	
	$terms=array();
	
	$i=0;
	foreach ($rs as $row) {
		if (!isset($terms[$row['property_value']])) {
			$jason['items'][]=array('url'=>$i.'_'.$row['url_base'].$row['term_id'], 'name'=>$row['property_value']);
			$i++;
			$terms[$row['property_value']]=1;
		}
	}
}

print(json_encode($jason));
?>
