<?
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

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/dojo/1.4/dijit/themes/tundra/tundra.css">

<script language="JavaScript" type="text/javascript">
String.prototype.trim = function () {
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}


function eg1() {
	document.getElementById("ontology").value="NCBITaxon";
	document.getElementById("term_iris").value="http://purl.org/obo/owl/NCBITaxon#NCBITaxon_9606 #Homo sapiens";
	document.getElementById("top_term_iris").value="http://purl.org/obo/owl/NCBITaxon#NCBITaxon_2759 #Eukaryota\nsubClassOf http://purl.obolibrary.org/obo/OBI_0100026 #organism";
	document.getElementById("top_term_iris2").value="";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("ontology2").value = '';
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/NCBITaxon_import.owl';
}

function eg2() {
	document.getElementById("ontology").value="OBI";
	document.getElementById("term_iris").value="http://purl.obolibrary.org/obo/OBI_0000323";
	document.getElementById("top_term_iris").value="";
	document.getElementById("top_term_iris2").value="";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/OBI_import.owl';
}

function eg3() {
	document.getElementById("ontology").value="MP";
	document.getElementById("term_iris").value="http://purl.org/obo/owl/MP#MP_0000026\nhttp://purl.org/obo/owl/MP#MP_0000037\nhttp://purl.org/obo/owl/MP#MP_0000179\nhttp://purl.org/obo/owl/MP#MP_0000188\nhttp://purl.org/obo/owl/MP#MP_0000202\nhttp://purl.org/obo/owl/MP#MP_0000217\nhttp://purl.org/obo/owl/MP#MP_0000218";
	document.getElementById("top_term_iris").value="http://purl.org/obo/owl/MP#MP_0000001";
	document.getElementById("top_term_iris2").value="";
	document.getElementById("annotation_iris").value="includeAllAxioms";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/MP_import.owl';
}

function eg4() {
	document.getElementById("ontology").value="PATO";
	document.getElementById("term_iris").value="http://purl.org/obo/owl/PATO#PATO_0000918 #volume";
	document.getElementById("top_term_iris").value="http://purl.org/obo/owl/PATO#PATO_0001241 #quality of continuant\nsubClassOf http://www.ifomis.org/bfo/1.1/snap#Quality";
	document.getElementById("top_term_iris2").value="";
	document.getElementById("annotation_iris").value="http://www.w3.org/2000/01/rdf-schema#label\ncopyTo http://purl.obolibrary.org/obo/IAO_0000111\nhttp://www.geneontology.org/formats/oboInOwl#hasDefinition\nmapTo http://purl.obolibrary.org/obo/IAO_0000115";
	document.getElementById("ontology2").value = '';
	document.getElementById("retrieval_setting").value="includeAllIntermediates";
	document.getElementById("output_iri").value = 'http://purl.obolibrary.org/obo/your_ontology/external/PATO_import.owl';
}

function eg5() {
	document.getElementById("ontology").value="VO";
	document.getElementById("term_iris").value="";
	document.getElementById("top_term_iris").value="";
	document.getElementById("top_term_iris2").value="http://purl.obolibrary.org/obo/VO_0000025";
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
			document.getElementById("retrieval_setting").value = 'includeAllIntermediates';
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/dojo/1.4/dojo/dojo.xd.js" djConfig="parseOnLoad: true"></script>
<script type="text/javascript">
	dojo.require("dijit.form.FilteringSelect");
	dojo.require("dojo.data.ItemFileReadStore");

	function termchange1 () {
		var termids=document.getElementsByName("termid1_0");
		document.getElementById("termid1").value= termids[0].value;
	}
	
	function addterm1 () {
		var termids=document.getElementsByName("termid1_0");
		var term_to_add = termids[0].value.replace(/^\d+_http/, "http");
		
		var terms1=document.getElementById("term_iris").value.trim();
		if (terms1.indexOf(term_to_add)<0) {
			terms1 += "\n"+termids[0].value.replace(/^\d+_http/, "http") + " #" + dijit.byId('termsearch1').attr('displayedValue');
			document.getElementById("term_iris").value = terms1.trim();
		}
	}
	

	dojo.addOnLoad(function() {

            var filteringSelect = new dijit.form.FilteringSelect({
                id: "termsearch1",
                name: "termid1_0",
                value: "",
                store: new dojo.data.ItemFileReadStore({
					url: 'getTerm.php'
					}),
				autoComplete: true,
				style: "width: 270px;",
				onKeyUp: function(key) {
					if (dojo.byId('ontology').value=='') {
						if (dojo.byId('termsearch1').value!='') {
							alert("Please select an ontology first.");
							dojo.byId('termsearch1').value='';
						}
					}
					else {
						if(dojo.byId('termsearch1').value.trim().length>=3) {
							dijit.byId('termsearch1').attr('store', new dojo.data.ItemFileReadStore({url: 'getTerm.php?keywords='+dojo.byId('termsearch1').value+'&ontology='+dojo.byId('ontology').value}));
						}
					}
					},
				onChange: function () {
					var termids=document.getElementsByName("termid1_0");
					var tokens=termids[0].value.split(/[\/#]/);
					dojo.byId("termid1").value= tokens[tokens.length-1];
					dojo.byId("termid1").onchange();
					},
                searchAttr: "name"
            },
            "termsearch1");
	});
	

	function termchange2 () {
		var termids=document.getElementsByName("termid2_0");
		document.getElementById("termid2").value= termids[0].value;
	}
	
	function addterm2 () {
		var termids=document.getElementsByName("termid2_0");
		var term_to_add = termids[0].value.replace(/^\d+_http/, "http");
		
		var terms2=document.getElementById("top_term_iris").value.trim();
		if (terms2.indexOf(term_to_add)<0) {
			terms2 += "\n"+termids[0].value.replace(/^\d+_http/, "http") + " #" + dijit.byId('termsearch2').attr('displayedValue');
			terms2 += "\nsubClassOf";
			document.getElementById("top_term_iris").value = terms2.trim();
		}
	}
	
	function addterm3 () {
		var termids=document.getElementsByName("termid3_0");
		var term_to_add = termids[0].value.replace(/^\d+_http/, "http");
		
		var terms3=document.getElementById("top_term_iris2").value.trim();
		if (terms3.indexOf(term_to_add)<0) {
			terms3 += "\n"+termids[0].value.replace(/^\d+_http/, "http") + " #" + dijit.byId('termsearch3').attr('displayedValue');
			terms3 += "\nsubClassOf";
			document.getElementById("top_term_iris2").value = terms3.trim();
		}
	}
	
	function showterm (index) {
		var termids=document.getElementsByName("termid"+ index +"_0");
		var term_to_add = termids[0].value.replace(/^\d+_http/, "http").replace(/#/, "%23");
		
		var o = dojo.byId('ontology').value.toLowerCase();
		
		var url='http://ontobee.hegroup.org/browser/rdf.php?o='+o+'&iri='+term_to_add;
		switch (o) {
			case "vo":
			url = term_to_add;
			break;
			case "ncbitaxon":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/NCBITaxon%23NCBITaxon_/, 'http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?id=');
			break;
			case "chebi":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/CHEBI%23CHEBI_/, 'http://www.ebi.ac.uk/chebi/searchId.do?chebiId=CHEBI:');
			break;
			case "fma":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/FMA%23FMA_/, 'http://fme.biostr.washington.edu:8089/FME/body.jsp?selID=');
			break;
			case "go":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/GO%23GO_/, 'http://amigo.geneontology.org/cgi-bin/amigo/term-details.cgi?term=GO:');
			break;
			case "pro":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/PRO%23PRO_/, 'http://pir.georgetown.edu/cgi-bin/pro/entry_pro?id=PRO:');
			break;
			
			case "doid":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/DOID%23DOID_/, 'http://www.ebi.ac.uk/ontology-lookup/?termId=DOID:');
			break;
			
			case "mp":
			url = term_to_add.replace(/http:\/\/purl\.org\/obo\/owl\/MP%23MP_/, 'http://www.informatics.jax.org/searches/Phat.cgi?id=MP:');
			break;
			
		}
		
		window.open(url,'','');
	}
	

	dojo.addOnLoad(function() {
		var filteringSelect = new dijit.form.FilteringSelect({
			id: "termsearch2",
			name: "termid2_0",
			value: "",
			store: new dojo.data.ItemFileReadStore({
				url: 'getTerm.php'
				}),
			autoComplete: true,
			style: "width: 270px;",
			onKeyUp: function(key) {
				if (dojo.byId('ontology').value=='') {
					if (dojo.byId('termsearch2').value!='') {
						alert("Please select an ontology first.");
						dojo.byId('termsearch2').value='';
					}
				}
				else {
					if(dojo.byId('termsearch2').value.trim().length>=3) {
						dijit.byId('termsearch2').attr('store', new dojo.data.ItemFileReadStore({url: 'getTerm.php?keywords='+dojo.byId('termsearch2').value+'&ontology='+dojo.byId('ontology').value}));
					}
				}
				},
			onChange: function () {
				var termids=document.getElementsByName("termid2_0");
				var tokens=termids[0].value.split(/[\/#]/);
				dojo.byId("termid2").value= tokens[tokens.length-1];
				dojo.byId("termid2").onchange();
				},
			searchAttr: "name"
		},
		"termsearch2");
	});
	

	dojo.addOnLoad(function() {
		var filteringSelect = new dijit.form.FilteringSelect({
			id: "termsearch3",
			name: "termid3_0",
			value: "",
			store: new dojo.data.ItemFileReadStore({
				url: 'getTerm.php'
				}),
			autoComplete: true,
			style: "width: 270px;",
			onKeyUp: function(key) {
				if (dojo.byId('ontology').value=='') {
					if (dojo.byId('termsearch3').value!='') {
						alert("Please select an ontology first.");
						dojo.byId('termsearch3').value='';
					}
				}
				else {
					if(dojo.byId('termsearch3').value.trim().length>=3) {
						dijit.byId('termsearch3').attr('store', new dojo.data.ItemFileReadStore({url: 'getTerm.php?keywords='+dojo.byId('termsearch3').value+'&ontology='+dojo.byId('ontology').value}));
					}
				}
				},
			onChange: function () {
				var termids=document.getElementsByName("termid3_0");
				var tokens=termids[0].value.split(/[\/#]/);
				dojo.byId("termid3").value= tokens[tokens.length-1];
				dojo.byId("termid3").onchange();
				},
			searchAttr: "name"
		},
		"termsearch3");
	});
	

	dojo.addOnLoad(function() {document.body.className="tundra"});

	function toggleBtn(index) {
		if (dojo.byId("termid"+index).value=='') {
			dojo.byId("btnAddterm"+index).disabled="true";
			dojo.byId("btnShowterm"+index).disabled="true";
		}
		else {
			dojo.byId("btnAddterm"+index).disabled=false;
			dojo.byId("btnShowterm"+index).disabled=false;
		}
	}
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<?
$vali=new Validation($_REQUEST);

$GALAXY_URL = $vali->getInput('GALAXY_URL', 'GALAXY_URL', 0, 100, true);

if ($GALAXY_URL!='') {
	if (isset($_SESSION)) {
		$_SESSION['GALAXY_URL']=$GALAXY_URL;
	}
}


$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$strSql="select * from ontology where to_list='y' order by ontology_fullname";
$rs=$db->Execute($strSql);
?>
<form action="getExternal.php" method="post" enctype="multipart/form-data" name="formMain" target="_blank" id="formMain">
<table border="0">
	<tr>
		<td><p><strong>OntoFox</strong> is a web-based system to support ontology reuse. It  allows users to input terms, fetch selected properties, annotations, and certain classes of related terms from  source ontologies and save the results using the RDF/XML serialization of the OWL. OntoFox follows and expands the <a href="http://obi-ontology.org/page/MIREOT">MIREOT</a> principle. Inspired by existing ontology modularization techniques, OntoFox also develops a new SPARQL-based ontology term extraction algorithym that extracts terms related to a given set of signature terms. In addition, OntoFox provides an option to extract the hierarchy rooted at a specified ontology term. OntoFox is implemented using one of the following three methods, based on how data is input and whether the OntoFox web interface is used:</p>
		  	<p><span class="header_darkred">1. Data input using web forms:</span> 
		  <br/>
		  <span style="margin-left:16px;">Examples: <a href="javascript:eg1()">Example 1</a>, <a href="javascript:eg2()">example 2</a>, <a href="javascript:eg3()">example 3</a>, <a href="javascript:eg4()">example 4</a>, <a href="javascript:eg5()">example 5</a></span></p>
	    <strong style="margin-left:16px;">(1) Select one ontology:</strong></td>
	</tr>
	
	<tr>
		<td><select name="ontology" id="ontology" style="margin-left:16px;" onChange="checkOntology1()">
			<option value="" selected>Please select an ontology</option>
<?
foreach ($rs as $row){

?>
<option value="<?=$row['ontology_abbrv']?>"><?=$row['ontology_fullname']?> (<?=$row['ontology_abbrv']?>)</option>
<?
}
?>
		</select></td>
	  </tr>
	<tr>
		<td><strong style="margin-left:16px;">Or enter your favorite source ontology and SPARQL endpoint: </strong><a href="javascript:egb1()">Example</a></td>
	</tr>
	<tr>
		<td><textarea name="ontology2" cols="70" rows="2" id="ontology2" style="margin-left:16px;" onChange="checkOntology2()"></textarea></td>
	</tr>
	<tr>
		<td style="padding-left:16px"><strong>(2) Class term specification:</strong></td>
	  </tr>
	<tr>
		<td style="padding-left:16px"><strong>Section A: Bottom up term specification</strong></td>
	  </tr>
	<tr>
		<td><table width="100%" border="0" style="margin-left:32px">
		  <tr>
		    <td><strong>(a) Include low level source term URIs (One URI per line):</strong> <br>
		      <label for="termsearch1">Search a term:</label>
		      <input id="termsearch1">
		      <label for="termid1">Term ID:</label>
		      <input type="text" name="termid1" id="termid1" disabled="disabled" style="background-color:#CCCCCC" size="12" onChange="toggleBtn('1')">
		      <input name="input" type="button" value="Detail" onClick="showterm('1')" id="btnShowterm1" disabled="disabled">
		      <input type="button" value="Add" onClick="addterm1()" id="btnAddterm1" disabled="disabled"></td>
		    </tr>
		  <tr>
		    <td><textarea name="term_iris" cols="70" rows="4" id="term_iris"></textarea></td>
		    </tr>
		  <tr>
		    <td><span><strong>(b) Include top level source term URIs and target direct superclass URIs (One URI per line, optional): </strong> <br>
                <label for="termsearch2">Search a term:</label>
                <input id="termsearch2">
                <label for="termid2">Term ID:</label>
                <input type="text" name="termid2" id="termid2" disabled="disabled" style="background-color:#CCCCCC" size="12" onChange="toggleBtn('2')">
                <input name="input2" type="button" value="Detail" onClick="showterm('2')" id="btnShowterm2" disabled>
                <input type="button" value="Add" onClick="addterm2()" id="btnAddterm2" disabled>
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
		    <td style="padding-left:16px"><strong>Section B: Top down branch module extraction</strong></td>
		    </tr>
	<tr>
		<td><table width="100%" border="0" style="margin-left:32px">
		  <tr>
		    <td><span><strong>(a) Include top level source term URIs and target direct superclass URIs (One URI per line): </strong> <br>
		      <label for="termsearch3">Search a term:</label>
		      <input id="termsearch3">
		      <label for="termid3">Term ID:</label>
		      <input type="text" name="termid3" id="termid3" disabled="disabled" style="background-color:#CCCCCC" size="12" onChange="toggleBtn('3')">
		      <input name="btnShowterm" type="button" value="Detail" onClick="showterm('3')" id="btnShowterm3" disabled>
		      <input type="button" value="Add" onClick="addterm3()" id="btnAddterm3" disabled>
		      </span></td>
		    </tr>
		  <tr>
		    <td><textarea name="top_term_iris2" cols="70" rows="4" id="top_term_iris2"></textarea></td>
		    </tr>
	    </table></td>
	</tr>
	<tr>
		<td><strong style="margin-left:16px;">(3) Annotation/Axiom Specification: Include source annotation URIs (One URI per line, optional):  </strong> 
	    <br/>
	    <span style="margin-left:16px;">Examples:  <a href="javascript:addRemove('http://www.w3.org/2000/01/rdf-schema#label')">rdfs:label</a><a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasDefinition')"></a>, <a href="javascript:addRemove('http://purl.obolibrary.org/obo/IAO_0000111')">iao:preferredTerm</a>, <a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasDefinition')">oboInOwl:hasDefinition</a>, <a href="javascript:addRemove('http://purl.obolibrary.org/obo/IAO_0000115')">iao:definition</a>, <a href="javascript:addRemove('http://www.geneontology.org/formats/oboInOwl#hasSynonym')">oboInOwl:hasSynonym</a>. <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The default is no annotation to be assigned. Use <a href="javascript:addRemove('includeAllAnnotationProperties');">includeAllAnnotationProperties</a> to include all annotations. Use <a href="javascript:addRemove('includeAllAxioms');">includeAllAxioms</a> to include all annotations and other related axioms.  Use <a href="javascript:addRemove('includeAllAxiomsRecursively');">includeAllAxiomsRecursively</a> to include all axioms for the specified terms and the related terms recursively. </span></td>
	</tr>
	<tr>
		<td><textarea name="annotation_iris" cols="70" rows="4" id="annotation_iris" style="margin-left:16px;"></textarea></td>
	</tr>
	<tr>
	  <td><strong style="margin-left:16px;">(4) URI of the OWL(RDF/XML) output file: </strong> <br/>
	    <span style="margin-left:16px;">Example:http://purl.obolibrary.org/obo/vo/external/NCBITaxon_import.owl. </span></td>
	  </tr>
	<tr>
	  <td><input name="output_iri" type="text" id="output_iri" style="margin-left:16px;" value="" size="120"></td>
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
		<span style="margin-left:16px;">Example: <a href="format.txt">Sample file</a> (Data format <a href="tutorial/index.php#input_format">description</a>) </span></p>	    </td>
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

<br/>
<p><span class="header_darkred">3. Remote OntoFox access without using the OntoFox web page:</span> 
	    <br/>
    <span style="margin-left:16px;">For those users who like to access OntoFox programmatically without coming to OntoFox web page, we have generated a new php script: http://ontofox.hegroup.org/service.php.  An example  command line code to use  this script is here: &quot; curl -s -F file=@/tmp/input.txt -o /tmp/output.owl http://ontofox.hegroup.org/service.php&quot;.</span> 
    <br/><span style="margin-left:16px;">A Perl script (or a program based on Java or other language) can also be developed. In this case, a user will need use &quot;put&quot; to access this page.</span>
</p>
<p><strong>Publication: </strong>Xiang Z, Courtot M, Brinkman RR, Ruttenberg A, He Y. <a href="http://www.biomedcentral.com/1756-0500/3/175">OntoFox: web-based support for ontology reuse</a>. <em>BMC Research Notes</em>. 2010, <strong>3:</strong>175. [PMID: <a href="http://www.ncbi.nlm.nih.gov/pubmed/20569493">20569493</a>] </p>
<p><span><a href="http://survey.hegroup.org/index.php?sid=46454&lang=en"><strong>OntoFox Survey</strong></a><strong>:</strong> your feedback on OntoFox is welcome and important for us to improvie this service. This survey contains 16 questions and will take approximately 5 minutes. Thank you!</span></p>
<!-- InstanceEndEditable --></div>
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
