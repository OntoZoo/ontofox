<?php 
include_once('../../inc/functions.php');



$querystring="select distinct ?link ?label
from <http://purl.obolibrary.org/obo/clo_merged.owl> 

WHERE
{
  {
    SELECT ?s ?o ?label
    WHERE
    {{
        ?s rdfs:subClassOf ?o .
        FILTER (isURI(?s)).
        OPTIONAL {?s rdfs:label ?label}
      }
      UNION
	  {
        ?s owl:equivalentClass ?s1 .
        ?s1 owl:intersectionOf ?s2 .
        ?s2 rdf:first ?o  .
        FILTER (isURI(?s))
        OPTIONAL {?s rdfs:label ?label}
      }
    }
  } OPTION (TRANSITIVE, t_in(?o), t_out(?s), t_step (?s) as ?link, t_step ('path_id') as ?path, t_min(1)).
  FILTER (?o=<http://purl.obolibrary.org/obo/CLO_0000001>)
}";


$results = json_query($querystring, 'http://sparql.hegroup.org/sparql');

$array_cell_line = array();
foreach($results as $result) {
	$array_cell_line[$result['label']]=$result['link'];
}

//print_r($array_cell_line);


$querystring="select distinct ?link ?label
from <http://purl.obolibrary.org/obo/clo_merged.owl> 

WHERE
{
  {
    SELECT ?s ?o ?label
    WHERE
    {{
        ?s rdfs:subClassOf ?o .
        FILTER (isURI(?s)).
        OPTIONAL {?s rdfs:label ?label}
      }
      UNION
	  {
        ?s owl:equivalentClass ?s1 .
        ?s1 owl:intersectionOf ?s2 .
        ?s2 rdf:first ?o  .
        FILTER (isURI(?s))
        OPTIONAL {?s rdfs:label ?label}
      }
    }
  } OPTION (TRANSITIVE, t_in(?o), t_out(?s), t_step (?s) as ?link, t_step ('path_id') as ?path, t_min(1)).
  FILTER (?o= <http://www.ebi.ac.uk/efo/EFO_0000408>)
}";


$results = json_query($querystring, 'http://sparql.hegroup.org/sparql');

$array_disease = array();
foreach($results as $result) {
	$array_disease[$result['label']]=$result['link'];
}

//print_r($array_disease);

$array_taxon=array();
$str_lines=file('taxon.txt');
foreach ($str_lines as $line) {
	$tokens = preg_split('/\t/', $line);
	$label = trim(trim($tokens[0], '" '));
	
	//print_r($tokens);
	
	if ($tokens[2]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', trim($tokens[2]));
		$array_taxon[$label]='http://purl.obolibrary.org/obo/NCBITaxon_'.$taxon_id;
	}
	elseif ($tokens[4]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', trim($tokens[4]));
		$array_taxon[$label]='http://purl.obolibrary.org/obo/NCBITaxon_'.$taxon_id;
	}
	elseif ($tokens[6]!='') {
		$taxon_id=str_replace('NCBITaxon:', '', trim($tokens[6]));
		$array_taxon[$label]='http://purl.obolibrary.org/obo/NCBITaxon_'.$taxon_id;
	}
}

//print_r($array_taxon);


$array_cell_tissue=array();
$str_lines=file('cell_tissue.txt');
foreach ($str_lines as $line) {
	$tokens = preg_split('/\t/', $line);
	$label = trim(trim($tokens[0], '" '));
	
	//print_r($tokens);
	$score=0;
	$id='';
	for($i=2; $i<=15; $i+=3) {
	
		if ($tokens[$i]!='' && is_numeric($tokens[$i])) {
			$c_score=floatval($tokens[$i]);
			if ($c_score>$score) {
				$c_score=$score;
				$id=$tokens[$i+1];
				$id=preg_replace('/CL:/', 'http://purl.obolibrary.org/obo/CL_', $id);
				$id=preg_replace('/UBERON:/', 'http://purl.obolibrary.org/obo/UBERON_', $id);
			}
		}
	}
	
	if (preg_match('/http/', $id)) {
		$array_cell_tissue[$label]=$id;
	}
}

//print_r($array_cell_tissue);


$str_growth="adherent  	http://purl.obolibrary.org/obo/CLO_0000003
adherent on coated surface  	http://purl.obolibrary.org/obo/CLO_0000009
adherent on feeder cells  	http://purl.obolibrary.org/obo/CLO_0000013
adherent, patchy  	http://purl.obolibrary.org/obo/CLO_0000014
aherent	http://purl.obolibrary.org/obo/CLO_0000003
clusters in  suspension	http://purl.obolibrary.org/obo/CLO_0000034
clusters in sus-  	http://purl.obolibrary.org/obo/CLO_0000034
clusters in suspension	http://purl.obolibrary.org/obo/CLO_0000034
loosely adherent  	http://purl.obolibrary.org/obo/CLO_0000016
mixed  	http://purl.obolibrary.org/obo/CLO_0000032
mixed suspen-  	http://purl.obolibrary.org/obo/CLO_0000033
mixed suspension  	http://purl.obolibrary.org/obo/CLO_0000033
suspension  	http://purl.obolibrary.org/obo/CLO_0000002
suspension with feeder cells	http://purl.obolibrary.org/obo/CLO_0000040
suspension, multicell aggregates	http://purl.obolibrary.org/obo/CLO_0000041
suspenson  	http://purl.obolibrary.org/obo/CLO_0000002";

$array_growth=array();

$lines = preg_split('/[\r\n]+/', $str_growth);

foreach ($lines as $line) {
	$tokens = preg_split('/\t/', $line);

	$array_growth[trim($tokens[0])]=trim($tokens[1]);
}


//print_r($array_growth);

$str_lines = file('CLKB_data.txt');

unset($str_lines[0]);

$i=0;
foreach ($str_lines as $line) {
	$i++;
	$tokens = preg_split('/\t/', $line);

	$cell_line=trim(trim($tokens[0]), '" ');
	$cell_tissue=trim(trim($tokens[2]), '" ');
	$disease=trim(trim($tokens[4]), '" ');
	if($disease=='NULL') $disease='';
	$organism=trim(trim($tokens[1]), '" ');
	$growth=trim(trim($tokens[5]), '" ');

	if(isset($array_cell_line[$cell_line]) && $organism!='NULL'){
		$cell_line_id=$array_cell_line[$cell_line];
		$organism_id=$array_taxon[$organism];
?>
<rdf:Description rdf:about="<?php echo $cell_line_id?>">
<?php 
		if (isset($array_growth[$growth])) {
?>
        <rdfs:subClassOf>
            <owl:Restriction>
                <owl:onProperty rdf:resource="&obo;OBI_0000295"/>
                <owl:someValuesFrom rdf:resource="<?php echo $array_growth[$growth]?>"/>
            </owl:Restriction>
        </rdfs:subClassOf>

<?php 
		}
		
		if($cell_tissue=='NULL') $cell_tissue='';
		
		$cell_tissue.=" cell";
//		print($cell_tissue);
		if($cell_tissue!='' && isset($array_cell_tissue[$cell_tissue])) {
			$cell_tissue_id=$array_cell_tissue[$cell_tissue];
			
			if(strpos($cell_tissue_id, 'CL#CL_')!==false) {
				if(isset($array_disease[$disease])){
					$disease_id = $array_disease[$disease];
?>
        <rdfs:subClassOf>
            <owl:Restriction>
                <owl:onProperty rdf:resource="&ro;derives_from"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="<?php echo $cell_tissue_id?>"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="<?php echo $organism_id?>"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&OBO_REL;has_disposition"/>
                                                <owl:someValuesFrom rdf:resource="<?php echo $disease_id?>"/>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>
        </rdfs:subClassOf>
<?php 					
				}
				else{
?>
        <rdfs:subClassOf>
            <owl:Restriction>
                <owl:onProperty rdf:resource="&ro;derives_from"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="<?php echo $cell_tissue_id?>"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                <owl:someValuesFrom rdf:resource="<?php echo $organism_id?>"/>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>
        </rdfs:subClassOf>
<?php 
					if($disease!='') {

?>
		<rdfs:comment>disease: <?php echo UTF_to_Unicode($disease)?></rdfs:comment>

<?php 				
					}
				}
			}
			elseif(strpos($cell_tissue_id, 'UBERON#UBERON_')!==false) {
				if(isset($array_disease[$disease])){
					$disease_id = $array_disease[$disease];
?>
        <rdfs:subClassOf>
            <owl:Restriction>
                <owl:onProperty rdf:resource="&ro;derives_from"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="&CL;CL_0000000"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="<?php echo $cell_tissue_id?>"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                                <owl:someValuesFrom>
                                                    <owl:Class>
                                                        <owl:intersectionOf rdf:parseType="Collection">
                                                            <rdf:Description rdf:about="<?php echo $organism_id?>"/>
                                                            <owl:Restriction>
                                                                <owl:onProperty rdf:resource="&OBO_REL;has_disposition"/>
                                                                <owl:someValuesFrom rdf:resource="<?php echo $disease_id?>"/>
                                                            </owl:Restriction>
                                                        </owl:intersectionOf>
                                                    </owl:Class>
                                                </owl:someValuesFrom>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>
        </rdfs:subClassOf>

<?php 					
				}
				else{
?>
        <rdfs:subClassOf>
            <owl:Restriction>
                <owl:onProperty rdf:resource="&ro;derives_from"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="&CL;CL_0000000"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="<?php echo $cell_tissue_id?>"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&OBO_REL;part_of"/>
                                                <owl:someValuesFrom rdf:resource="<?php echo $organism_id?>"/>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>
        </rdfs:subClassOf>
<?php 					
					if($disease!='') {

?>
		<rdfs:comment>disease: <?php echo UTF_to_Unicode($disease)?></rdfs:comment>

<?php 
					}
				}
			}
				
		}
?>
</rdf:Description>
<?php 
	}

//if ($i>10) break;
}
?>

