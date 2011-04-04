<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>OntoFox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<h3 class="head3_darkred">Introduction</h3>

<p>Developing a biomedical ontology covering a specific domain (e.g., OBI for biomedical investigations, VO for vaccine) is often an ambitious project. <a href="http://obofoundry.org/crit.shtml">OBO Foundry  principles</a> have been developed to ensure collaborative ontology development and interoperability among ontologies. Examples of these principles include: a) ontologies are developed in a collaborative effort, b) ontologies use 
  common relations that are unambiguously defined, c) ontologies provide procedures for user feedback and for 
  identifying successive versions, and d) ontologies have a clearly bounded subject-matter. </p>
<p>To avoid duplication of effort during ontology development, it  is advised to import pre-existing ontology terms and knowledge into a new ontology if possible. The Web Ontology Language (OWL) provides a mechanism to import ontologies. This approach leads to import of the whole ontology. However, importing a whole ontology may not be practical and needed, especially when the source ontology is very large and in most cases not relevant. For example, the Ontology for Biomedical Investigations (OBI) studies  investigations in different biomedical areas and uses many terms from other biomedical ontologies. It is impractical to import all  these other ontologies as a whole into OBI. The development of Vaccine Ontology (VO) requires importing  of a large number of NCBI taxonomy terms. It is laborious  to manually import the relevant information and practically impossible to keep update the manually imported information. </p>
<p>To address this challenge, the OBI Consortium proposes a method to allow selective use of classes from external ontologies that are of direct interest to OBI. The principle of <a href="http://obi-ontology.org/page/MIREOT">MIREOT</a> (Minimum Information to Reference External Ontology Terms) is eventually developed.  A set of MIREOT guidelines  have also been recommended for consistent reference of an external term. The MIREOT guideline suggests the following minimal set: (1) source ontology URI; (2) source term URI; and (3) target direct superclass URI. The MIREOT guideline has been applied in an OBI MIREOT program using scripts  and command lines. However, the OBI MIREOT was developed for  helping OBI development and cannot be used for development of other ontologies without modification. Its usage also requires programming using SPARQL, scripts, and command lines. This restricts its wide uses among  interesting ontology developers. </p>
<p>OntoFox is a web-based system that follows and extends the MIREOT guidelines. OntoFox requests the following  data input: (1) Source ontology URI. (2) Low level source term URI (equivalent to &quot;source term URI&quot; in the MIREOT guideline). (3) Top  level source term URI. Compared to the minimum data set from the MIREOT guideline, the top level source term URI is added in order to automatically retrieve any intermediate ontology terms between the low and top level source terms in the source ontology. (4) URI of target direct superclass of top level source term. Since each top level source term has its own direct superclass in the target ontology, this data is input together with the top level source term in OntoFox input format. (5) Source term annotation URIs.   The source term annotation URIs are requested in case only limited annotations are needed. If no annotation URI is assigned, all annotations associated with a specific ontology term will be fetched. </p>
<p> OntoFox also develops a new SPARQL-based ontology term extraction algorithm. Our algorithm allows extraction of external ontology terms relevant to a given set of signature terms, implemented by SPARQL query of associated RDF triples. Effectively the algorithm takes the union of the concise bounded description (cite http://www.w3.org/Submission/CBD/) of the terms. This algorithm  extracts additional terms that are not in the is-a hierarchies of signature terms. This SPARQL modularization algorithm is execuated in OntoFox after a user selects the setting &ldquo;includeAllAxioms&rdquo;. The benefit of using SPARQL is that it is highly scalable &ndash; current modularization algorithms use in-memory representations.</p>
<p>OntoFox can extract the whole branch ontology terms below a specific ontology term. This feature is particularly useful when all terms in the hierarchy under a specific ontology term are useful for the target ontology. </p>
<p>The output RDF/OWL file can be directly imported in the target ontology using the OWL import function. The output file can be visualized using  Protege or other OWL editors. The annotation information of  low level source term, top level source term,  all terms in between the low and top level source terms in the ontology hierarchy, and terms and annotations that are related to the signature terms but may not in the is_a hierarchies will all be fetched by OntoFox. </p>
<p>Since source ontologies may be under active development and updates,  it is advised that the OntoFox process is implemented periodically to import  most up-to-date information of external ontology terms.</p>
<p>With more ontologies being developed, OntoFox offers a timely web-based package of solutions for ontology imports via MIREOT and related ontology term extraction. OntoFox provides an efficient approach to promote ontology sharing and interoperability. It is easy to use and does not require knowledge of SPARQL, script programming, and command line operation. OntoFox is developed to serve the ontology community for ontology reuse. It is freely available under <a href="http://www.apache.org/licenses/LICENSE-2.0.html">the Apache License 2.0</a>. </p>
<p>Suggestions and comments are welcome. Thank you!</p>
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
