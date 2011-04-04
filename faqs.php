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
<h3 class="head3_darkred">Frequently Asked Questions</h3>
<p><strong>1. What is OntoFox? </strong></p>
<p> OntoFox is a web server that automatically extract annotations and intermediate layers of bio-ontologies.  </p>
<p><strong>2.</strong><strong> Who are primary   users of OntoFox?</strong></p>
<p> Bio-ontology developers, and bioinformaticians who are using bio-ontologies for different applications.  </p>
<p><strong>3.</strong><strong> What is URI?</strong></p>
<p> A Uniform Resource Identifier (URI) is defined in [<a href="http://www.ietf.org/rfc/rfc3986.txt">RFC3986</a>] as a sequence of characters chosen from a limited subset of the repertoire of US-ASCII [ASCII] characters. URIs refer to resources.</p>
<p><strong>4.</strong><strong> Where are the source ontologies used in OntoFox stored?</strong></p>
<p> OntoFox uses source ontologies stored in RDF format in <a href="http://neurocommons.org/page/Main_Page">Neurocommons</a> and a RDF server in <a href="http://www.hegroup.org/">He Group</a> in University of Michigan Medical School. The contents of source  ontologies are stored in RDF triples and available for SPARQL query. Theoretically, OntoFox is able to fetch any ontology in a SPARQL queriable RDF server through internet.  </p>
<p><strong>5.</strong><strong> How can we use OntoFox to get a single class  from source ontology without including a hierarchy of superclasses?</strong></p>
<p> To get a single class using OntoFox,   you can specify the top level source term URI the same as the low level source term URI. Or , you don't need to specify any top level source term URI. By default, OntoFox fetches a single class unless a top level superclass is specified. </p>
<p><strong>6.</strong><strong> Can we use OntoFox for ontologies developed using OBO format?</strong></p>
<p> OntoFox is developed based on OWL format. Currently there are many converters that can convert OBO format to OWL format or vice versa. With the help of some converter, it is possible to use OntoFox for development of a new ontology based on OBO format.</p>
<p><strong>7.</strong><strong> How can I use OntoFox to add new terms and update annotations?</strong></p>
<p>It is recommended that you run OntoFox again when you like to update your annotations. You may consider to keep one master OntoFox input file. Whenever you like to add new terms from external ontologies, you can update the OntoFox input file by adding new term URIs and other related information, and then rerun OntoFox using our file upload option. </p>
<p><strong>8.</strong><strong> Who has used OntoFox for ontology development? Any successful stories? </strong></p>
<p>OntoFox has been routinely used for <a href="http://www.violinet.org/vaccineontology/">Vaccine Ontology (VO)</a> development. We have also  tested OntoFox successfully for importing external ontology terms for development of the  <a href="http://obi-ontology.org/">Ontology for Biomedical Investigations (OBI)</a>. </p>
<p><strong>9.</strong><strong>  Why are Basic Formal Ontology (BFO) and Relation Ontology (RO) imported as a whole, rather than being included in OntoFox as source ontologies for mireoting?</strong></p>
<p> <a href="http://www.ifomis.org/bfo">BFO</a> is the  upper level ontology which have been adopted by many domain ontologies developed for scientific research, including those in the OBO Foundry. Similarly, <a href="http://www.obofoundry.org/ro/">RO</a> is an ontology of core relations used by OBO Foundry ontologies and many other ontologies.  Both BFO and RO have  relatively small sizes but  are essential for ontology development. If you use BFO and RO, you would like to import them as a  whole. Therefore, we don't include BFO and RO as source ontologies for OntoFox mireoting. </p>
<p><strong>10.</strong><strong> How are the  input and output files provided by the users stored on OntoFox servers? </strong></p>
<p>The input and output files are not stored permanently on the OntoFox servers. They will be stored for up to 24 hours with a unique file name which consists of 8 random characters. These files will be automatically destroyed at 3:00 am EST (New York time) by an internal script. The temporary storage is for users to come back to the input and result files, and it also provides a way for our OntoFox developers to debug any possible errors. For those users who do have concerns on privacy and security, the users can select to destroy the input and output files immediately in the end of the OntoFox execution. </p>
<p><strong>11. Is it </strong><strong> possible to enter a favorite source ontology and SPARQL end point and then select a different ontology via the drop-down menu? </strong></p>
<p>We do not allow the option of using a favorite source ontology and SPARQL endpoint and at the same time using a different ontology via the drop-down menu. OntoFox prevents a user from providing two ontology sources. Specifically, when a favorite source ontology and SPARQL endpoint are provided, the drop-down menu does not show any specific ontology. If a different ontology is selected from the drop-down menu, any text in the favorite source ontology input box will automatically be cleared.</p>
<p><strong>12: Is it possible to access OntoFox programmatically?</strong></p>
<p>  Yes. To access OntoFox without using the OntoFox web page, try this: curl -s -F file=@/tmp/input.txt -o /tmp/output.owl http://ontofox.hegroup.org/service.php<br>
  See more information in <a href="tutorial/index.php#service">Tutorial</a>.</p>
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
