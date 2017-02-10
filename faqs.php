<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontofox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="download.php" class="topnav">Download</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<h3 class="head3_darkred">Frequently Asked Questions</h3>
<p><strong>1. What is Ontofox? </strong></p>
<p> Ontofox is a web server that automatically extract annotations and intermediate layers of bio-ontologies.  </p>
<p><strong>2.</strong><strong> Who are primary   users of Ontofox?</strong></p>
<p> Bio-ontology developers, and bioinformaticians who are using bio-ontologies for different applications.  </p>
<p><strong>3.</strong><strong> What is URI?</strong></p>
<p> A Uniform Resource Identifier (URI) is defined in [<a href="http://www.ietf.org/rfc/rfc3986.txt">RFC3986</a>] as a sequence of characters chosen from a limited subset of the repertoire of US-ASCII [ASCII] characters. URIs refer to resources.</p>
<p><strong>4.</strong><strong> Where are the source ontologies used in Ontofox stored?</strong></p>
<p> Ontofox uses source ontologies stored in RDF format in <a href="http://sparql.hegroup.org/sparql">He Group SPARQL endpoint</a> in University of Michigan Medical School. The contents of source  ontologies are stored in RDF triples and available for SPARQL query. Theoretically, Ontofox is able to fetch any ontology in a SPARQL queriable RDF server through internet.  </p>
<p><strong>5.</strong><strong> How can we use Ontofox to get a single class  from source ontology without including a hierarchy of superclasses?</strong></p>
<p> To get a single class using Ontofox,   you can specify the top level source term URI the same as the low level source term URI. Or , you don't need to specify any top level source term URI. By default, Ontofox fetches a single class unless a top level superclass is specified. </p>
<p><strong>6.</strong><strong> Can we use Ontofox for ontologies developed using OBO format?</strong></p>
<p> Ontofox is developed based on OWL format. Currently there are many converters that can convert OBO format to OWL format or vice versa. With the help of some converter, it is possible to use Ontofox for development of a new ontology based on OBO format.</p>
<p><strong>7.</strong><strong> How can I use Ontofox to add new terms and update annotations?</strong></p>
<p>It is recommended that you run Ontofox again when you like to update your annotations. You may consider to keep one master Ontofox input file. Whenever you like to add new terms from external ontologies, you can update the Ontofox input file by adding new term URIs and other related information, and then rerun Ontofox using our file upload option. </p>
<p><strong>8.</strong><strong> Who has used Ontofox for ontology development? Any successful stories? </strong></p>
<p>Ontofox has been routinely used for development of the <a href="http://www.violinet.org/vaccineontology/">Vaccine Ontology (VO)</a>, the <a href="http://sourceforge.net/projects/bo-ontology/">Brucellosis Ontology (BO)</a>, and the <a href="http://sourceforge.net/projects/clo-ontology/">Cell Line Ontology (CLO)</a>. We have also  tested Ontofox successfully for importing external ontology terms for development of the <a href="http://obi-ontology.org/">Ontology for Biomedical Investigations (OBI)</a>. Ontofox is also being used by many other ontology developers. </p>
<p><strong>9.</strong><strong>  Why are Basic Formal Ontology (BFO) and Relation Ontology (RO) are better to be imported as a whole?</strong></p>
<p> <a href="http://www.ifomis.org/bfo">BFO</a> is the  upper level ontology which have been adopted by many domain ontologies developed for scientific research, including those in the OBO Foundry. Similarly, <a href="http://www.obofoundry.org/ro/">RO</a> is an ontology of core relations used by OBO Foundry ontologies and many other ontologies.  Both BFO and RO have  relatively small sizes but  are essential for ontology development. If you use BFO and RO, you would like to import them as a  whole. However, we have also included BFO and RO as source ontologies for Ontofox importing in case you only want partial importing.  </p>
<p><strong>10.</strong><strong> How are the  input and output files provided by the users stored on Ontofox servers? </strong></p>
<p>The input and output files are not stored permanently on the Ontofox servers. They will be stored for up to 24 hours with a unique file name which consists of 8 random characters. These files will be automatically destroyed at 3:00 am EST (New York time) by an internal script. The temporary storage is for users to come back to the input and result files, and it also provides a way for our Ontofox developers to debug any possible errors. For those users who do have concerns on privacy and security, the users can select to destroy the input and output files immediately in the end of the Ontofox execution. </p>
<p><strong>11. Can I add more than one term in the Ontofox input at one time?</strong></p>
<p>Yes. You can add multiple terms in the Ontofox input file or in the Ontofox input web form. </p>
<p><strong>12. In Ontofox input, if I have many low level source ontology terms and many  top level source ontology term URIs, how can Ontofox knows which top level source term URLs are for each low level terms?  </strong></p>
<p>Ontofox can automatically check the hierarchical structure and determine which top level source ontology term URIs can be used for which low level source ontology terms. </p>
<p><strong>13. Is it </strong><strong> possible to enter a favorite source ontology and SPARQL end point and then select a different ontology via the drop-down menu? </strong></p>
<p>We do not allow the option of using a favorite source ontology and SPARQL endpoint and at the same time using a different ontology via the drop-down menu. Ontofox prevents a user from providing two ontology sources. Specifically, when a favorite source ontology and SPARQL endpoint are provided, the drop-down menu does not show any specific ontology. If a different ontology is selected from the drop-down menu, any text in the favorite source ontology input box will automatically be cleared.</p>
<p><strong>14. Is it possible to access Ontofox programmatically?</strong></p>
<p>  Yes. To access Ontofox without using the Ontofox web page, try this: curl -s -F file=@/tmp/input.txt -o /tmp/output.owl http://ontofox.hegroup.org/service.php</p>
<p><strong>15. What's the new annotation setting &quot;owl:equivalentClass&quot;?</strong></p>
<p>The  annotation setting &quot;owl:equivalentClass&quot; was added on June 9, 2011 to allow the automatic extraction of equivalent class of a specific ontology term(s). Before this setting was separately added, this function of extracting equivalent classes was implemented by default. However, it may generate some confusions, esp. for those who don't know or don't like it. By having it as an individual annotation settign in Ontofox, we provide users more flexibility. </p>
<p><strong>16. In which cases can the setting &quot;includeAllAxiomsRecursively&quot; be useful?</strong></p>
<p>As described above and in <a href="http://ontofox.hegroup.org/tutorial/index.php#OntoMod_twoOptions">Tutorial</a>, the setting can recursively retrieve all axioms associated with user-specified signature terms. It will in most cases retrieve all results than the setting &quot;includeAllAxioms&quot;. Why this feature is useful? It is because often we like  to have a more complete view and all terms and annotations directly and  indirectly associated with the original signature terms. For example, we may like to have a  <a href="http://www.mged.org/">Functional Genomics Data Society</a> (FGED) view of OBI  and use it for the FGED community. In this case, it is better to have a thorough retrieval of all axioms associated with a list of terms specified by FGED. This will allow the implementation of systematic automated reasoning. </p>
<p><strong>17. Do Ontofox-View and Ontofox use  the OWLAPI modularization code?</strong></p>
<p>No. Neither Ontofox-View nor the general Ontofox method uses the OWL API modularization code. Our programs are developed based on SPARQL and PHP coding. </p>
<p><strong>18. What is ontology axiom?</strong></p>
<p>Ontology axioms are the statements  that provide  explicit  logical assertions about three types of things - classes, individuals and  properties. The other facts which are implicitly contained in the ontology can be inferred using  a piece of software called a reasoner. See reference: (i) <a href="http://dior.ics.muni.cz/~makub/owl/">http://dior.ics.muni.cz/~makub/owl/</a>; (ii) <a href="http://www.w3.org/TR/owl2-syntax/#Axioms">http://www.w3.org/TR/owl2-syntax/#Axioms</a>; and (iii) <a href="http://en.wikipedia.org/wiki/Ontology_components">http://en.wikipedia.org/wiki/Ontology_components</a>.</p>
<p><strong>19. How to keep updating  Ontofox output results?</strong></p>
<p>The Ontofox process can be executed at different times to import updated   information of external ontology terms. By storing and updating the   original Ontofox input text file, users can subsequently query the   Ontofox server on a regular basis and get up to date information with   little effort.</p>
<p><strong>20. Why my Ontofox execuation did not work? Is it possible that the web browser type makes a difference? </strong></p>
<p>There may be different reasons why your Ontofox execuation did not work. It is possible that your inputformat does not fit in with the required Ontofox format. On June 30, 2015, Oliver He found that Google Chrome worked fine with the includeAllChildren setting but Firebox did not work out. We tried Firefox before and it worked out fine. Therefore, it is likely that the Ontofox may have some issue with the current Firefox. If it does not work with you, try another web browser. If you still have some issue, please contact us. </p>
<p><strong>21. Can we use  Ontofox to extract instance data? </strong></p>
<p>Yes or no. You can extract instance data. Don't set up parents, then what you get is instance. After that, you may need to make some changes.</p>
<p> Note that we plan to  formally add an option for extracting  instances, probably by having an option &quot;instanceOf&quot;.</p>
<p><strong>22. Can we support sub property?  </strong></p>
<p>Yes. You can use &quot;subPropertyOf&quot;. </p>
<p><br>
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
