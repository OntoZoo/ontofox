<?php 
include_once('inc/functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
/**
 * Author: Zuoshuang Xiang
 * The University Of Michigan
 * He Group
 * Date: 2010-03-04
 *
 * OntoFox: A web server that facilitates ontology development by automatically
 * fetching ontology terms and their annotations from existing ontologies and 
 * saving the results in an importable RDF/OWL format. (Note: OntoFox was 
 * previously named OntoFetch.) OntoFox is developed based on the MIREOT principle.
 * This is the user interface for entering different parameters.
 */
-->
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>OntoFox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->

<script language="JavaScript" type="text/javascript">
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}


function eg1() {
	document.getElementById("ontology").value="NCBITaxon";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/NCBITaxon_9606 #Homo sapiens";
	document.getElementById("top_term_iris").value="http://purl.obolibrary.org/obo/NCBITaxon_2759 #Eukaryota\nsubClassOf http://purl.obolibrary.org/obo/OBI_0100026 #organism";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("ontology2").value = '';
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/NCBITaxon_import.owl';
}

function eg2() {
	document.getElementById("ontology").value="OBI";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/OBI_0000323";
	document.getElementById("top_term_iris").value="";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/OBI_import.owl';
}

function eg3() {
	document.getElementById("ontology").value="MP";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/MP_0000026\nhttp://purl.obolibrary.org/obo/MP_0000037\nhttp://purl.obolibrary.org/obo/MP_0000179\nhttp://purl.obolibrary.org/obo/MP_0000188\nhttp://purl.obolibrary.org/obo/MP_0000202\nhttp://purl.obolibrary.org/obo/MP_0000217\nhttp://purl.obolibrary.org/obo/MP_0000218";
	document.getElementById("top_term_iris").value="http://purl.obolibrary.org/obo/MP_0000001";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/MP_import.owl';
}

function eg4() {
	document.getElementById("ontology").value="PATO";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/PATO_0000918 #volume";
	document.getElementById("top_term_iris").value="http://purl.obolibrary.org/obo/PATO_0001241 #quality of continuant\nsubClassOf http://www.ifomis.org/bfo/1.1/snap#Quality";
	document.getElementById("annotation_iris").value="http://www.w3.org/2000/01/rdf-schema#label\ncopyTo http://purl.obolibrary.org/obo/IAO_0000111\nhttp://www.geneontology.org/formats/oboInOwl#hasDefinition\nmapTo http://purl.obolibrary.org/obo/IAO_0000115";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/PATO_import.owl';
}

function eg5() {
	document.getElementById("ontology").value="VO";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/VO_0000025\nincludeAllChildren";
	document.getElementById("top_term_iris").value="";
	document.getElementById("annotation_iris").value="http://www.w3.org/2000/01/rdf-schema#label";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/VO_import.owl';
}


function addRemove(iri) {
	annotation_iris = document.getElementById("annotation_iris").value;
	
	if (iri=='includeAllAxioms' || iri=='includeAllAxiomsRecursively' || iri=='includeAllAnnotationProperties') {
		if (annotation_iris.trim()==iri) {
			document.getElementById("annotation_iris").value = '';
		}
		else {
			document.getElementById("annotation_iris").value = iri;
			if (document.getElementById("retrieval_setting").value != 'includeAllIntermediates' && iri=='includeAllAxiomsRecursively') {
				alert(iri+" conflicts with " + document.getElementById("retrieval_setting").value + ", " + document.getElementById("retrieval_setting").value + " has been changed to includeAllIntermediates.");
				document.getElementById("retrieval_setting").value = 'includeAllIntermediates';
			}
		}
	}
	else {
		if (annotation_iris.indexOf('includeAllAnnotationProperties')>-1) {
			annotation_iris = annotation_iris.replace('includeAllAnnotationProperties', '');
			annotation_iris = annotation_iris.replace(/[\r\n]{2,}/, "\n");
			document.getElementById("annotation_iris").value = annotation_iris.trim();
		}
		if (annotation_iris.indexOf('includeAllAxiomsRecursively')>-1) {
			annotation_iris = annotation_iris.replace('includeAllAxiomsRecursively', '');
			annotation_iris = annotation_iris.replace(/[\r\n]{2,}/, "\n");
			document.getElementById("annotation_iris").value = annotation_iris.trim();
		}
		if (annotation_iris.indexOf('includeAllAxioms')>-1) {
			annotation_iris = annotation_iris.replace('includeAllAxioms', '');
			annotation_iris = annotation_iris.replace(/[\r\n]{2,}/, "\n");
			document.getElementById("annotation_iris").value = annotation_iris.trim();
		}

		if (annotation_iris.indexOf(iri)>-1) {
			annotation_iris = annotation_iris.replace(/[\r\n]{2,}/, "\n");
			annotation_iris = annotation_iris.replace('\ncopyTo '+iri, '______');
			annotation_iris = annotation_iris.replace('\nmapTo '+iri, '______');
			annotation_iris = annotation_iris.replace(iri+'\ncopyTo ', '______');
			annotation_iris = annotation_iris.replace(iri+'\nmapTo ', '______');
			annotation_iris = annotation_iris.replace(/.+______/, '');
			annotation_iris = annotation_iris.replace(/______.+/, '');
			annotation_iris = annotation_iris.replace(iri, '');
			annotation_iris = annotation_iris.replace(/[\r\n]{2,}/, "\n");
			document.getElementById("annotation_iris").value = annotation_iris.trim();
		}
		else {
			annotation_iris = annotation_iris.trim() + "\n" + iri;
			document.getElementById("annotation_iris").value = annotation_iris.trim();
		}
	}
}

function clearElement(elementID) {
	document.getElementById(elementID).value = '';
}


function egb1() {
	document.getElementById("ontology").value="";
	document.getElementById("ontology2").value="http://purl.org/science/graph/obo/PATO\nfromEndpoint http://sparql.obo.neurocommons.org/sparql";
	document.getElementById("term_iris").value="";
	document.getElementById("top_term_iris").value="";
	document.getElementById("annotation_iris").value="";
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = '';
}

function checkOntology1() {
	if (document.getElementById("ontology").value!='') {
		document.getElementById("ontology2").value="";
	}
	dojo.byId('termsearch1').value = '';
	dojo.byId('termsearch2').value = '';
	dojo.byId('termid1').value = '';
	dojo.byId("termid1").onchange();
	dojo.byId('termid2').value = '';
	dojo.byId("termid2").onchange();
}

function checkOntology2() {
	if (document.getElementById("ontology2").value.trim()!='') {
		document.getElementById("ontology").value="";
	}
}


</script>

<meta charset="utf-8">
<link rel="stylesheet" href="js/jquery/themes/base/jquery.ui.all.css">
<script src="js/jquery/jquery-1.7.1.js"></script>
<script src="js/jquery/ui/jquery.ui.core.js"></script>
<script src="js/jquery/ui/jquery.ui.widget.js"></script>
<script src="js/jquery/ui/jquery.ui.position.js"></script>
<script src="js/jquery/ui/jquery.ui.autocomplete.js"></script>
<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
</style>
<script>
$(function() {
		function split( val ) {
			return val.split( /,\s*/ );
		}
		
		function extractLast( term ) {
			return split( term ).pop();
		}
		
		$( "#termsearch1" ).autocomplete({
		source: function( request, response ) {
					if ($( "#ontology" ).val()=="") {
						alert("Please select an ontology!");
					}
					else {
						$.getJSON( "getTerm.php?ontology=" + $( "#ontology" ).val(), {
							term: extractLast( request.term )
						}, response );
					}
				},								  
		minLength: 3,
		select: function( event, ui ) {
			var params = ui.item.id.split( /:::/ );
			var termOntology1 = params.shift();
			var termUrl1 = params.shift();
			var termLbl1 = ui.item.value;
			
			$( "#termLink1" ).html(termUrl1);
			$( "#termLink1" ).prop("href", "http://www.ontobee.org/browser/rdf.php?o="+termOntology1+"&iri="+termUrl1);
			$( "#termUrl1" ).val(termUrl1);
			$( "#termLbl1" ).val(termLbl1);
			
			$( "#btnAddterm1" ).prop("disabled", "");
			
			
			//window.location = "/browser/rdf.php?o=" + params.shift() + "&iri=" + params.shift();
		}
	});
});

function addterm1 () {
	var termLbl1 = document.getElementById("termLbl1").value;
	var termUrl1 =document.getElementById("termUrl1").value;
	var terms1=document.getElementById("term_iris").value.trim();
	if (terms1.indexOf(termUrl1)<0) {
		terms1 += "\n"+termUrl1 + " #" + termLbl1;
		document.getElementById("term_iris").value = terms1.trim();
	}
}


$(function() {
		function split( val ) {
			return val.split( /,\s*/ );
		}
		
		function extractLast( term ) {
			return split( term ).pop();
		}
		
		$( "#termsearch2" ).autocomplete({
		source: function( request, response ) {
					if ($( "#ontology" ).val()=="") {
						alert("Please select an ontology!");
					}
					else {
						$.getJSON( "getTerm.php?ontology=" + $( "#ontology" ).val(), {
							term: extractLast( request.term )
						}, response );
					}
				},								  
		minLength: 3,
		select: function( event, ui ) {
			var params = ui.item.id.split( /:::/ );
			var termOntology2 = params.shift();
			var termUrl2 = params.shift();
			var termLbl2 = ui.item.value;
			
			$( "#termLink2" ).html(termUrl2);
			$( "#termLink2" ).prop("href", "http://www.ontobee.org/browser/rdf.php?o="+termOntology2+"&iri="+termUrl2);
			$( "#termUrl2" ).val(termUrl2);
			$( "#termLbl2" ).val(termLbl2);
			
			$( "#btnAddterm2" ).prop("disabled", "");
			
			
			//window.location = "/browser/rdf.php?o=" + params.shift() + "&iri=" + params.shift();
		}
	});
});

function addterm2() {
	var termLbl2 = document.getElementById("termLbl2").value;
	var termUrl2 =document.getElementById("termUrl2").value;
	var terms2=document.getElementById("top_term_iris").value.trim();
	if (terms2.indexOf(termUrl2)<0) {
		terms2 += "\n"+termUrl2 + " #" + termLbl2;
		terms2 += "\nsubClassOf ";
		document.getElementById("top_term_iris").value = terms2.trim();
	}
}


</script>

<!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="download.php" class="topnav">Download</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<?php 
$vali=new Validation($_REQUEST);

$GALAXY_URL = $vali->getInput('GALAXY_URL', 'GALAXY_URL', 0, 100, true);

$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$strSql="select * from ontology where loaded='y' order by ontology_fullname";
$rs=$db->Execute($strSql);
?>
<form action="getExternal.php" method="post" enctype="multipart/form-data" name="formMain" target="_blank" id="formMain">

<input name="GALAXY_URL" type="hidden" value="<?php echo $GALAXY_URL?>">
<table border="0">
	<tr>
		<td><h3 class="head3_darkred">OntoFoxGO</h3>
		  <p><strong>OntoFoxGO</strong> is a web-based  <strong>Onto</strong>logy tool that <strong>F</strong>etches <strong>o</strong>ntology terms and a<strong>x</strong>ioms. OntoFox   supports ontology reuse. It  allows users to input terms, fetch selected properties, annotations, and certain classes of related terms from  source ontologies and save the results using the RDF/XML serialization of the OWL. </p>
		  <p>OntoFox is implemented using one of the following three methods, based on how data is input and whether the OntoFox web interface is used:</p>
		  	<p><span class="header_darkred">1. Data input using web forms:</span> 
		  <br/>
		  <span style="margin-left:16px;">Examples: <a href="javascript:eg1()">Example 1</a>, <a href="javascript:eg2()">example 2</a>, <a href="javascript:eg3()">example 3</a>, <a href="javascript:eg4()">example 4</a>, <a href="javascript:eg5()">example 5</a></span></p>
	    <strong style="margin-left:16px;">(1) Select one ontology:</strong></td>
	</tr>
	
	<tr>
		<td><select name="ontology" id="ontology" style="margin-left:16px;" onChange="checkOntology1()">
			<option value="" selected>Please select an ontology</option>
<?php 
foreach ($rs as $row){

?>
<option value="<?php echo $row['ontology_abbrv']?>"><?php echo $row['ontology_fullname']?> (<?php echo $row['ontology_abbrv']?>)</option>
<?php 
}
?>
		</select></td>
	  </tr>
	<tr>
		<td style="padding-left:16px"><strong>(2) Term specification:</strong></td>
	  </tr>
	<tr>
		<td><table width="100%" border="0" style="margin-left:32px">
		  <tr>
		    <td><strong>(a) Include low level source term URIs:<br>
(One URI per line. To include all child terms of  a source term (extract the whole branch), enter &quot;includeAllChildren&quot; in the line next to the source term)</strong><br>
		      <label for="termsearch1">Search a term:</label>
		      <input id="termsearch1">
		      <a id="termLink1" target="_blank"></a>
		      <input type="button" value="Add" onClick="addterm1()" id="btnAddterm1" disabled="disabled">
		      <input type="hidden" name="termUrl1" id="termUrl1">
		      <input type="hidden" name="termLbl1" id="termLbl1">		      </td>
		    </tr>
		  <tr>
		    <td><textarea name="term_iris" cols="70" rows="4" id="term_iris"></textarea></td>
		    </tr>
		  <tr>
		    <td><span><strong>(b) Include top level source term URIs and target direct superclass URIs (One URI per line, optional): </strong> <br>
                <label for="termsearch2">Search a term:</label>
		      <input id="termsearch2">
		      <a id="termLink2" target="_blank"></a>
		      <input type="button" value="Add" onClick="addterm2()" id="btnAddterm2" disabled="disabled">
		      <input type="hidden" name="termUrl2" id="termUrl2">
		      <input type="hidden" name="termLbl2" id="termLbl2">
		    </span></td>
		    </tr>
		  <tr>
		    <td><textarea name="top_term_iris" cols="70" rows="4" id="top_term_iris"></textarea></td>
		    </tr>
		  <tr>
		    <td><strong>(c)</strong><strong> Select a setting for retrieving  intermediate source terms: </strong></td>
		    </tr>
		  <tr>
		    <td><select name="retrieval_setting" id="retrieval_setting">
		      <option value="includeNoIntermediates" selected>includeNoIntermediates</option>
		      <option value="includeComputedIntermediates">includeComputedIntermediates</option>
		      <option value="includeAllIntermediates">includeAllIntermediates</option>
		      </select></td>
		    </tr>
	    </table></td>
	  </tr>
	<tr>
		<td><strong style="margin-left:16px;">(3) Annotation/Axiom Specification: Include source annotation URIs (One URI per line, optional):  </strong> 
	    <br/>
	    <span style="margin-left:16px;">Examples:  <a href="javascript:addRemove('http://www.w3.org/2000/01/rdf-schema#label')">rdfs:label</a><a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasDefinition')"></a>, <a href="javascript:addRemove('http://purl.obolibrary.org/obo/IAO_0000111 #iao:preferredTerm')">iao:preferredTerm</a>, <a href="javascript:addRemove('http://purl.obolibrary.org/obo/IAO_0000115 #iao:definition')">iao:definition</a>, <a href="javascript:addRemove('http://purl.obolibrary.org/obo/IAO_0000118 #iao:alternative term')">iao:alternative term</a>, <a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasDefinition')">oboInOwl:hasDefinition</a>, <a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasSynonym')">oboInOwl:hasSynonym</a>, <a href="javascript:addRemove('http://www.w3.org/2002/07/owl#equivalentClass')">owl:equivalentClass</a>. <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The default is no annotation to be assigned. Use <a href="javascript:addRemove('includeAllAnnotationProperties');">includeAllAnnotationProperties</a> to include all annotations. Use <a href="javascript:addRemove('includeAllAxioms');">includeAllAxioms</a> to include all annotations and other related axioms.  Use <a href="javascript:addRemove('includeAllAxiomsRecursively');">includeAllAxiomsRecursively</a> to include all axioms for the specified terms and the related terms recursively. </span></td>
	</tr>
	<tr>
		<td><textarea name="annotation_iris" cols="70" rows="4" id="annotation_iris" style="margin-left:16px;"></textarea></td>
	</tr>
	<tr>
	  <td><strong style="margin-left:16px;">(4) Annotation/Axiom to be excluded (One URI per line, optional): </strong> <br/></td>
	  </tr>
	<tr>
	  <td><textarea name="excluding_annotation_iris" cols="70" rows="2" id="excluding_annotation_iris" style="margin-left:16px;"></textarea></td>
	  </tr>
	<tr>
	  <td><strong style="margin-left:16px;">(5) URI of the OWL(RDF/XML) output file: </strong> <br/>
	    <span style="margin-left:16px;">Example:http://purl.obolibrary.org/obo/vo/external/NCBITaxon_import.owl. </span></td>
	  </tr>
	<tr>
	  <td><input name="output_iri" type="text" id="output_iri" style="margin-left:16px;" value="" size="100"></td>
	  </tr>
		<tr>
		<td align="center"><input type="submit" name="Submit1" value="Get OWL (RDF/XML) Output File" onClick="javascript: document.getElementById('formMain').action='getExternal.php';" />
	  <input type="submit" name="Submit2" value="Generate OntoFox Input File" style="margin-left:40px;" onClick="javascript: document.getElementById('formMain').action='getInput.php';" />
			<input type="reset" name="Submit3" value="Reset" style="margin-left:40px;"></td>
		</tr>
</table>
</form>
<br/>
<form action="getExternal.php" method="post" enctype="multipart/form-data" name="formMain2" target="_blank" id="formMain">
<table border="0">
	<tr>
		<td><p><span class="header_darkred">2. Data input using local text file: </span>
		<br/>
		<span style="margin-left:16px;">Example: <a href="format.txt" target="_blank">Sample file</a> (Data format <a href="tutorial/index.php#input_format" target="_blank">description</a>) </span></p>	    </td>
	</tr>
	<tr>
		<td><span style="margin-left:16px;"><strong>Upload input  file: </strong></span>
		  <input name="file" type="file" size="50" /></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="Submit1" value="Get OWL (RDF/XML) Output File" />
		<input type="reset" name="Submit3" value="Reset" style="margin-left:40px;"></td>
	  </tr>
</table>
</form>

<p>&nbsp;</p>
<p><span>Your <a href="feedback/index.php">feedback</a> on OntoFox is welcome and important for us to improvie this service. Thank you!</span></p>
<!-- InstanceEndEditable -->
</div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="Images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
	</tr>
</table>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4869243-8");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
