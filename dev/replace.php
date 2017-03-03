<?php
header("Content-Type: text/plain");
//$str=file_get_contents('http://vaccineontology.svn.sourceforge.net/viewvc/vaccineontology/trunk/src/ontology/VO.owl?revision=616');
$str=file_get_contents('http://vaccineontology.svn.sourceforge.net/viewvc/vaccineontology/trunk/src/ontology/VO.owl');


$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000278"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom>
                                                                            <owl:Class>
                                                                                <owl:unionOf rdf:parseType="Collection">(.+?)</owl:unionOf>
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
                                </owl:intersectionOf>
                            </owl:Class>
                        </owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
						<owl:someValuesFrom>
							<owl:Class>
								<owl:unionOf rdf:parseType="Collection">$2</owl:unionOf>
							</owl:Class>
						</owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);

$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000452"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom>
                                                                            <owl:Class>
                                                                                <owl:unionOf rdf:parseType="Collection">(.+?)</owl:unionOf>
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
                                </owl:intersectionOf>
                            </owl:Class>
                        </owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
						<owl:someValuesFrom>
							<owl:Class>
								<owl:unionOf rdf:parseType="Collection">$2</owl:unionOf>
							</owl:Class>
						</owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);


$str=preg_replace('/'.$strfrom.'/s', $strto, $str);


$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000452"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000490"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom>
                                                                            <owl:Class>
                                                                                <owl:unionOf rdf:parseType="Collection">(.+?)</owl:unionOf>
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
                                </owl:intersectionOf>
                            </owl:Class>
                        </owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
						<owl:someValuesFrom>
							<owl:Class>
								<owl:unionOf rdf:parseType="Collection">$2</owl:unionOf>
							</owl:Class>
						</owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);


$str=preg_replace('/'.$strfrom.'/s', $strto, $str);

            

$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000278"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom rdf:resource="&obo;([^"]+)"/>
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
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
                        <owl:someValuesFrom rdf:resource="&obo;$2"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);


$str=preg_replace('/'.$strfrom.'/s', $strto, $str);

            


$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000452"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom>
                                                                            <owl:Class>
                                                                                <owl:intersectionOf rdf:parseType="Collection">(.+?)</owl:intersectionOf>
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
                                </owl:intersectionOf>
                            </owl:Class>
                        </owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
						<owl:someValuesFrom>
							<owl:Class>
								<owl:unionOf rdf:parseType="Collection">$2</owl:unionOf>
							</owl:Class>
						</owl:someValuesFrom>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);


$strfrom='<owl:Restriction>
                <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="&obo;VO_0000278"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;VO_0000494"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                <owl:someValuesFrom>
                                                    <owl:Class>
                                                        <owl:intersectionOf rdf:parseType="Collection">
                                                            <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                            <owl:Restriction>
                                                                <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                <owl:someValuesFrom rdf:resource="&obo;([^"]+)"/>
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
            </owl:Restriction>';


$strto='<owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
                        <owl:someValuesFrom rdf:resource="&obo;$1"/>
                    </owl:Restriction>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);


$strfrom='<owl:Restriction>
                <owl:onProperty rdf:resource="&obo;OBI_0000295"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="&obo;VO_0000002"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;VO_0001274"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&obo;role_of"/>
                                                <owl:someValuesFrom rdf:resource="&obo;([^"]+)"/>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>';


$strto='<owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0001243"/>
                        <owl:someValuesFrom rdf:resource="&obo;$1"/>
                    </owl:Restriction>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);



$strfrom='<owl:Restriction>
                <owl:onProperty rdf:resource="&obo;OBI_0000295"/>
                <owl:someValuesFrom>
                    <owl:Class>
                        <owl:intersectionOf rdf:parseType="Collection">
                            <rdf:Description rdf:about="&obo;VO_0000002"/>
                            <owl:Restriction>
                                <owl:onProperty rdf:resource="&obo;OBI_0000293"/>
                                <owl:someValuesFrom>
                                    <owl:Class>
                                        <owl:intersectionOf rdf:parseType="Collection">
                                            <rdf:Description rdf:about="&obo;([^"]+)"/>
                                            <owl:Restriction>
                                                <owl:onProperty rdf:resource="&obo;BFO_0000087"/>
                                                <owl:someValuesFrom rdf:resource="&obo;OBI_0000725"/>
                                            </owl:Restriction>
                                        </owl:intersectionOf>
                                    </owl:Class>
                                </owl:someValuesFrom>
                            </owl:Restriction>
                        </owl:intersectionOf>
                    </owl:Class>
                </owl:someValuesFrom>
            </owl:Restriction>';


$strto='<owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0001243"/>
                        <owl:someValuesFrom rdf:resource="&obo;$1"/>
                    </owl:Restriction>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);



$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;BFO_0000085"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000452"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000054"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                                        <owl:someValuesFrom>
                                                            <owl:Class>
                                                                <owl:intersectionOf rdf:parseType="Collection">
                                                                    <rdf:Description rdf:about="&obo;VO_0001275"/>
                                                                    <owl:Restriction>
                                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                                        <owl:someValuesFrom rdf:resource="&obo;([^"]+)"/>
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
                </owl:intersectionOf>
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0003355"/>
                        <owl:someValuesFrom rdf:resource="&obo;$2"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);


$strfrom='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_(\d+)"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;OBI_0000295"/>
                        <owl:someValuesFrom>
                            <owl:Class>
                                <owl:intersectionOf rdf:parseType="Collection">
                                    <rdf:Description rdf:about="&obo;VO_0000494"/>
                                    <owl:Restriction>
                                        <owl:onProperty rdf:resource="&obo;BFO_0000055"/>
                                        <owl:someValuesFrom>
                                            <owl:Class>
                                                <owl:intersectionOf rdf:parseType="Collection">
                                                    <rdf:Description rdf:about="&obo;VO_0001274"/>
                                                    <owl:Restriction>
                                                        <owl:onProperty rdf:resource="&obo;role_of"/>
                                                        <owl:someValuesFrom rdf:resource="&obo;([^"]+)"/>
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
            </owl:Class>';


$strto='<owl:Class>
                <owl:intersectionOf rdf:parseType="Collection">
                    <rdf:Description rdf:about="&obo;VO_$1"/>
                    <owl:Restriction>
                        <owl:onProperty rdf:resource="&obo;VO_0001243"/>
                        <owl:someValuesFrom rdf:resource="&obo;$2"/>
                    </owl:Restriction>
                </owl:intersectionOf>
            </owl:Class>';

$strfrom=str_replace('/', '\/', $strfrom);
$strfrom=preg_replace('/\s+/', '\s+', $strfrom);

$str=preg_replace('/'.$strfrom.'/s', $strto, $str);

print($str);
?>