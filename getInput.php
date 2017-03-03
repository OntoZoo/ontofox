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
header("Content-Type: text/plain");
include('inc/functions.php');

$vali=new Validation($_REQUEST);


$ontology= $vali->getInput('ontology', 'Ontology', 0, 128);
$ontology2 = $vali->getInput('ontology2', 'Your own ontology', 0, 1024);
$ontology = trim($ontology . "\n" . $ontology2);
$term_iris = $vali->getInput('term_iris', 'Lower level term IRIs to be imported', 0, 81920);
$top_term_iris = $vali->getInput('top_term_iris', 'Top level term IRIs to be imported', 0, 8192);
$top_term_iris2 = $vali->getInput('top_term_iris2', 'Top level term IRIs to be imported', 0, 8192);
$retrieval_setting = $vali->getInput('retrieval_setting', 'Source term retrieval setting', 0, 128);
$annotation_iris = $vali->getInput('annotation_iris', 'annotation IRIs to be included', 0, 8192);
$outputURI = $vali->getInput('output_iri', 'URI of the OWL(RDF/XML) output file', 0, 128);
$excluding_annotation_iris = $vali->getInput('excluding_annotation_iris', 'annotation IRIs to be excluded', 0, 8192);


$str_inputs = "[URI of the OWL(RDF/XML) output file]
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


print($str_inputs);
?>