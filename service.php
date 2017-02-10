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
 
set_time_limit(60*60);
include('getExternalCore.php');


if ($vali->getErrorMsg()!='') {
	print("<!-- Error: " . $vali->getErrorMsg() . "-->");
}
else {
	if (file_exists("userfiles/$finalFile.owl")) {
		readfile("$userfiles/$finalFile.owl");		
		if (!empty($a_missing_term)) {
			print("<!--
Notice: All the OBO ontologies have changed the term URI format from http://purl.org/obo/owl/ontology#ontology_nnnnnnn to http://purl.obolibrary.org/obo/ontology_nnnnnnn. Please make sure your input files are updated.
The following terms do not have any related axioms in the source ontology:
");
			foreach($a_missing_term as $missing_term_iri => $tmp) {
				print($missing_term_iri. "\n");
			}
			print("-->");
		}
	}
	else {
		print("<!-- Error: Unknown error occured, please try again. Query ID: $finalFile.-->");
	}
}
?>