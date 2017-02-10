<?php
header("Content-Type: text/plain");
//$str=file_get_contents('http://vaccineontology.svn.sourceforge.net/viewvc/vaccineontology/trunk/src/ontology/VO.owl?revision=616');
$str=file_get_contents('http://vaccineontology.svn.sourceforge.net/viewvc/vaccineontology/trunk/src/ontology/VO.owl');


$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
                        <owl:someValuesFrom rdf:resource="&obo;NCBITaxon_(\d+)"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;VO_0003355"/>
<owl:someValuesFrom rdf:resource="&obo;NCBITaxon_$1"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);



$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0001243"/>
                        <owl:someValuesFrom rdf:resource="&obo;NCBITaxon_(\d+)"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;VO_0001243"/>
<owl:someValuesFrom rdf:resource="&obo;NCBITaxon_$1"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);

$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                        <owl:someValuesFrom rdf:resource="&obo;PATO_0000719"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);


$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;bearer_of"/>
                        <owl:someValuesFrom rdf:resource="&obo;VO_0000812"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;bearer_of"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000812"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);




$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000051"/>
                                <owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
                            </owl:Restriction>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:unionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;PATO_0001422"/>
                                            <rdf:Description rdf:about="&obo;VO_0000211"/>
                                        </owl:unionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);
		
		
$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000051"/>
                                <owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
                            </owl:Restriction>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                <owl:someValuesFrom rdf:resource="&obo;PATO_0000719"/>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);
		
		
$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <owl:Class>
                                <owl:unionOf rdf:parseType="Collection">
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&obo;BFO_0000051"/>
                                                <owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
                                            </owl:Restriction>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                                <owl:someValuesFrom rdf:resource="&obo;PATO_0000719"/>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000051"/>
                                        <owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
                                    </owl:Restriction>
                                </owl:unionOf>
                            </owl:Class>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:unionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;PATO_0001422"/>
                                            <rdf:Description rdf:about="&obo;VO_0000211"/>
                                        </owl:unionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
</owl:Restriction>
        </rdfs:subClassOf>
		<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);
		
		

		
$strfrom='<rdfs:subClassOf>
            <owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_\d+"/>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <owl:Class>
                                <owl:unionOf rdf:parseType="Collection">
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000051"/>
                                        <owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
                                    </owl:Restriction>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                        <owl:someValuesFrom rdf:resource="&obo;PATO_0000719"/>
                                    </owl:Restriction>
                                </owl:unionOf>
                            </owl:Class>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000086"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:unionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;PATO_0001422"/>
                                            <rdf:Description rdf:about="&obo;VO_0000211"/>
                                        </owl:unionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:intersectionOf>
            </owl:Class>
        </rdfs:subClassOf>';


$strto='<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000126"/>
</owl:Restriction>
        </rdfs:subClassOf>
		<rdfs:subClassOf>
<owl:Restriction>
<owl:onProperty rdf:resource="&obo;BFO_0000051"/>
<owl:someValuesFrom rdf:resource="&obo;VO_0000395"/>
</owl:Restriction>
        </rdfs:subClassOf>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);
		
		



print($str);
?>