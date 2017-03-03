<?php include_once('../inc/functions.php');

$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$strSql = "select * from ontology where loaded='y' order by ontology_abbrv";
$rs = $db->Execute($strSql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontofox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="../styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.screenshot {
	border: 1px dashed rgb(153, 153, 153); padding: 8px;
}
-->
</style>

<!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="../Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../introduction.php" class="topnav">Introduction</a><a href="index.php" class="topnav">Tutorial</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../references.php" class="topnav">References</a><a href="../download.php" class="topnav">Download</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact</a><a href="../acknowledge.php" class="topnav">Acknowledge</a><a href="../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<h3 class="head3_darkred">Tutorial</h3>

<p>Here we provide a tutorial of how Ontofox can be applied for your research and ontology development:   </p>
<p>Many more details about Ontofox and how to use it can be found from our Ontofox manuscript: <a href="http://www.ncbi.nlm.nih.gov/sites/pubmed/20569493">PubMed ID: 20569493</a></p>
<p style="font-weight:bold">Table of Contents</p>
<ol>
	<li><a href="#toc1">Source Ontologies and their namespaces</a></li>
	<li><a href="#toc2">Ontofox execution using web input forms</a></li>
	<li><a href="#input_format">Ontofox data input format</a></li>
	<li><a href="#toc4">Four  &quot;directives&quot; used in Ontofox</a></li>
	<li><a href="#toc5">Four settings used in Ontofox</a></li>
	<li><a href="hands_on.php">Ontofox hands-on demo</a></li>
	<li><a href="use_case.php">Ontofox use case demonstrations</a></li>
	<li><a href="import_Ontofox_output_file.php">Import an Ontofox output file into a target ontology</a></li>
	<li><a href="#service">Ontofox access without using Ontofox web site</a></li>
    <li><a href="#includeAllChildren">How to correctly use 'includeAllChildren' </a></li>
    <li><a href="#merge">Can we merge Ontofox files for different source ontologies? </a></li>
    <li><strong>New: </strong><a href="http://ontopro.com/blog/posts-output/2016-02-12-term-extraction-using-MIREOT.html">Sivaram's short tutorial on using Ontofox</a> </li>
</ol>
<p><span class="header_darkred" id="toc1">1. Source Ontologies and their namespaces: </span><br/>
<span style="margin-left:16px;">Ontofox includes many source ontologies for query.  Ontofox uses  standardized namespaces of source ontologies following OBO Foundry recommendations. These namespaces are also used in ontology servers like Neurocommons.org: </span></p>
<blockquote>
  <table border="0" cellpadding="5" cellspacing="1" bgcolor="#333333">
    <tr>
      <th bgcolor="#FFFFFF">#</th>
      <th bgcolor="#FFFFFF">Ontology</th>
      <th bgcolor="#FFFFFF">Ontology Full Name</th>
      <th bgcolor="#FFFFFF">Term URI example </th>
    </tr>


<?php
$i=1;
foreach($rs as $row) {
	if (in_array($row['ontology_abbrv'], array('CARO', 'CHEBI', 'CL', 'DOID', 'ENVO', 'FMA', 'GO', 'IDO', 'MP', 'NCBITaxon', 'OBI', 'PATO', 'PRO', 'SO', 'VO'))) {
?>
    <tr>
      <th bgcolor="#FFFFFF" style="width:60px"><?php echo $i?></th>
      <th bgcolor="#FFFFFF"><a href="http://www.ontobee.org/browser/index.php?o=<?php echo $row['ontology_abbrv']?>"><?php echo $row['ontology_abbrv']?></a></th>
      <td bgcolor="#FFFFFF"><?php echo $row['ontology_fullname']?></th>
      <td bgcolor="#FFFFFF"><?php echo $row['url_eg']?></th>    </tr>
<?php
		$i++;
	}
}
?>
  </table>
<p><strong>Note: </strong>The compelete ontologies included in Ontofox is <a href="lists.php">listed here</a>.</p>
</blockquote>

  
<p>&nbsp;</p>
<p><span class="header_darkred" id="toc2">2. Ontofox execution using  web input forms:</span> <br/>
  <span style="margin-left:16px;">Data for each component can be input using the web input form in the Ontofox home page. Ontofox needs the following information as input from users: </span></p>
<p><span style="margin-left:16px;"><strong>(1) Source ontology: </strong></span>The ontology where a list of terms will be retrieved from. </p>
<p><span style="margin-left:16px;"><strong>(2) Class term specification:</strong></span></p>
<p><span style="margin-left:48px;"><strong> (a) Low level source term URIs</strong></span><strong>: </strong>The URIs of low level term from source ontologies.To include all child terms of a source term, enter &quot;includeAllChildren&quot; in the line next to the source term. This feature is designed to extract all terms of an ontology hierarchy branch under a specific ontology term. </p>
<p><span style="margin-left:48px;"><strong>(b) Top level source term URIs and target direct superclass URIs</strong></span><strong>: </strong>The URIs of top  level term from source ontologies and their direct superclass URIs from a target ontology (i.e., the ontology that will import the terms from the source ontologies). The top level source term URI can be the same as the low level source term URI. In this case, a single source term will be fetched. If no top level source term is specified, by default the top level source term is the same as the low level source term. Since each top level source term has its own superclass in the target ontology, each target direct superclass of a top level source term should be specified. In OntoFecth, we specify the target direct superclass in a new line, following the sign &quot;subClassOf &quot;. </p>
<p><span style="margin-left:48px;"><strong>(c) Setting for retrieving intermediate source terms: </strong></span> Three options are available for retrieving intermediate terms: (a) <strong>includeNoIntermediates</strong>: no intermediate source terms are retrieved.  (b) <strong>includeComputedIntermediates</strong>: Sensible intermediate source terms are retrieved. Sensible intermediates include those intermediate terms that are closest ancestors of more than one low level source terms. (c) <strong>includeAllIntermediates</strong>: All intermediate source terms are retrieved.</p>
<p><span style="margin-left:16px;"><strong>(3) Source annotation URIs: </strong></span>The annotation URIs for the source terms used in the source ontologies. To map or wrap an annotation to a new one, please specify &quot;copyTo&quot; or &quot;mapTo&quot; in the new line following the orignal annotation URL, followed by the new annotation URI. </p>
<p><span style="margin-left:16px;">The Ontofox home page provide many examples. These examples can be used to quickly learn how to use the Ontofox web forms for Ontofox implementation.  </span></p>
<p id="commonURI"><span style="margin-left:16px;">Common annotation URIs: </span></p>
<blockquote>
<table cellpadding="3" cellspacing="1" bgcolor="#333333">
	<tr>
		<td bgcolor="#FFFFFF">rdfs:label</td>
		<td bgcolor="#FFFFFF">http://www.w3.org/2000/01/rdf-schema#label</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasSynonym</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasSynonym</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasExactSynonym</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasExactSynonym</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasRelatedSynonym</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasRelatedSynonym</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasNarrowSynonym</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasNarrowSynonym</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasBroadSynonym</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasBroadSynonym</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">oboInOwl:hasDefinition</td>
		<td bgcolor="#FFFFFF">http://www.geneontology.org/formats/oboInOwl#hasDefinition</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">iao:preferredTerm</td>
		<td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/IAO_0000111</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">iao:definition</td>
		<td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/IAO_0000115</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">iao:alternative term</td>
		<td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/IAO_0000118</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">owl:equivalentClass</td>
		<td bgcolor="#FFFFFF">http://www.w3.org/2002/07/owl#equivalentClass</td>
	</tr>
</table>
</blockquote>
<p><span style="margin-left:16px;"><strong>NOTE: &quot;owl:equivalentClass&quot; is now a separate option</strong>: Use this option will include owl equivalence class, ie, the logical definition of a specific ontology term. In addition, those  terms that are part of the logical definition will be extracted also. This means some new classes will appear in the final output. In the old version, this option was turned on by default.</span> In the updated version now it is a separate option which is not included by default.</p>
<p><span style="margin-left:16px;"><strong>(4) URI of the OWL(RDF/XML) output file:   </strong></span>This is a newly added feature that is designed to simplify the user's work after getting the Ontofox output file. After a URI of the OWL output file is specified, the URI will be automatically added to the Ontofox output file. The user can then put the Ontofox output file in a specified location. Once the target ontology includes the same information, the Ontofox output results  can be directly shown in the target ontology in an OWL editor such as Protege. So basically, this URI is used so that later you don't need to modify this Ontofox-generated output file anymore. This indeed saves the user's time and avoids mistakes.<br/>
</p>
<p><span class="header_darkred" id="input_format">3. Ontofox data  input format: </span> <br/>
    <span style="margin-left:16px;">An example of Ontofox data input file is here: </span></p>
	<blockquote>
<p>[URI of the OWL(RDF/XML) output file]<br>
  http://purl.obolibrary.org/obo/example.owl</p>
<p>[Source ontology]<br>
  #comment here<br>
  NCBITaxon<br>
  </p>
<p>[Low level source term URIs]<br>
  http://purl.obolibrary.org/obo/NCBITaxon_263 #Francisella tularensis <br>
  http://purl.obolibrary.org/obo/NCBITaxon_234 #Brucella<br>
  <strong>includeAllChildren</strong><br>
</p>
<p>[Top  level source term URIs and  target direct superclass URIs]<br>
  http://purl.obolibrary.org/obo/NCBITaxon_2 #Bacteria <br>
  <strong>subClassOf</strong> http://purl.obolibrary.org/obo/OBI_0100026 #organism, this term is from target ontology <br>
  </p>
<p>[Source term retrieval setting]<br>
  <strong>includeNoIntermediates</strong> #or: includeAllIntermediates, inincludeComputedIntermediates </p>
<p>  [Source annotation URIs]<br>
  http://www.w3.org/2000/01/rdf-schema#label<br>
  <strong>copyTo</strong> http://purl.obolibrary.org/obo/IAO_0000111<br>
  http://www.geneontology.org/formats/oboInOwl#hasDefinition<br>
  <strong>mapTo</strong> http://purl.obolibrary.org/obo/IAO_0000115<br>
  http://www.geneontology.org/formats/oboInOwl#hasSynonym<br>
  <br>
</p>
</blockquote>
<p><span style="margin-left:16px;">As you can tell, the Ontofox data input format contains the following components:
</span>
<ol type="i" >
  <li><strong>Headings:</strong> Each heading contains a text description quoted inside parenthesis &quot;[ ]&quot;. Five headings represent the four components of Ontofox execution. Please use the exact same text in all headings. </li>
  <li><strong>URI of the OWL(RDF/XML) output file</strong> <strong>under the first heading</strong>: This provides a URI for the Ontofox output OWL file.</li>
  <li><strong>Source ontology list.</strong> This is required. If using web forms, one or many ontologies can be selected. Currently, the ontologies we have tested and included in Ontofox include: OBI, NCBITaxon, MP, PATO, GO, DOID, IDO, CHEBI, SO, PRO, CL, ENVO, and CARO. </li>
  <li><strong>Low level source term URIs:</strong> At least one source term URI is required.  </li>
  <li><strong>Top level source term URIs and target direct superclass URIs:</strong> Since each top level source term has its own direct superclass in the target ontology, URIs of target direct superclasses of individual top level source terms are input together with the top level source term with a new line starting with &quot;<strong>subClassOf</strong>&quot;. To get a single class from source ontology, you do not need to specify any top level source term, or you can specify the top level source term URI as the same as the low level source term URI.</li>
  <li><strong>Source term retrieval setting:</strong> Choose one of three settings for retrieving intermediate source ontology terms:: includeNoIntermediates,  includeAllIntermediates, and inincludeComputedIntermediates. See description below. </li>
  <li><strong>Source annotation URIs:</strong> The source term annotation URIs are requested in case only limited annotations are needed. If no annotation URI is assigned, no annotations associated with a specific ontology term will be fetched. To include all possible annotations, you can put &quot;<strong>includeAllAxioms</strong>&quot;on one line, and all the annotations associated with a specific ontology term will be fetched. To map or wrap an annotation to a new one, please specify &quot;copyTo&quot; or &quot;mapTo&quot; in the new line following the orignal annotation URL, followed by the new annotation URI.<br/>
  </li>
  <li><strong>Comments:</strong> The sign &quot;#&quot; as the first letter of a line or as a letter after a space in the middle of a line is an indicator of a comment. All text after this sign within one line is considered comment and will not be used for Ontofox analysis. </li>
  </ol>
  <br/>
  <p><span class="header_darkred" id="toc4">4. Five &quot;directives&quot; used in Ontofox: <br/>
    </span><span style="margin-left:16px;">Four </span> directives are designed as unique Ontofox  commands to guide users to provide consistent and readable input data in  Ontofox web forms or input text format
  <ol type="i" >
    <li><strong>&quot;includeAllChildren&quot;</strong>: To include all child terms of a source term, enter &quot;includeAllChildren&quot; in the line next to the source term. This feature is designed to extract all terms of an ontology hierarchy branch under a specific ontology term. To include all child terms of a source term, enter "includeAllChildren" in the line after the line with the source term. </li>
    <li><strong>&quot;fromEndpoint&quot;: </strong> This directive is generated to indicate a SPARQL  endpoint from which a source ontology is retrieved by Ontofox. It is used at  the beginning of a line, followed by a web-accessible URL of a particular  SPARQL endpoint. The line above this &lsquo;fromEndpoint&rsquo; statement is the URI of a  source ontology. </li>
    <li><strong>&quot;subClassOf&quot;: </strong>This is a directive that is used in defining the target direct superclass (Box 3). This directive should be the first word in a line, followed by a target ontology URI that will be the superclass of the source ontology term listed in the previous line. </li>
    <li><strong>&quot;copyTo&quot;:  </strong>This is a directive that is used in mapping for ontology term annotation (Box 4). This directive should be the first word in a line, followed by an annotation URI used in  target ontology. The use of this directive would lead to  addition of an  annotation to an imported term which includes an annotation with  annotation URI specified in the line before &quot;copyTo&quot;. For example, the &quot;copyTo&quot; in the above example will provide an additional annotation http://purl.obolibrary.org/obo/IAO_0000111 (preferred_term) with the same content as the &quot;label&quot; (http://www.w3.org/2000/01/rdf-schema#label).  <br/>
    </li>
    <li><strong>&quot;mapTo&quot;: </strong>This is a directive that is used in wrapping  for ontology term annotation (Box 4).  This directive should be the first word in a line, followed by an annotation URI used in  target ontology. The use of this directive would lead to  replacement of an  annotation (specified by the annotation URI in the line before) of  an imported term with  another annotation specified in the URI following &quot;mapTo&quot;. For example, the &quot;mapTo&quot; in the above example will replace  source ontology annotation term URI &quot;http://www.geneontology.org/formats/oboInOwl#hasDefinition&quot; with target ontology annotation term URI &quot;http://purl.obolibrary.org/obo/IAO_0000115&quot; (IAO definition).  </li>
  </ol>
  <br/>
  <p><span class="header_darkred" id="toc5">5. Six settings used in Ontofox: <br/>
  </span><span style="margin-left:16px;">To allow Ontofox server parse needed information desired by a</span> user.
  <p><span style="margin-left:16px;">Three Ontofox settings are  for retrieving intermediate classes. Any of these Ontofox settings stands alone and does not procede or follow any statements:</span>
  <ol type="i" >
    <li><strong>&quot;includeNoIntermediates&quot;</strong>: no intermediate source terms are retrieved. </li>
    <li><strong>&quot;includeComputedIntermediates&quot;</strong>: Computed intermediate source terms include those intermediate terms that are closest ancestors of more than one low level source terms. Those intermediate terms that have only one parent term and one child term each are removed. This setting provides an option to get less intermediate ontology terms then that with the setting &lsquo;includeAllIntermediates&quot;  and still fulfills many users&rsquo; requirement. This option is the default usage for many  ontologies (e.g., VO and OBI). </li>
    <li><strong>&quot;includeAllIntermediates&quot;</strong>: All intermediate source terms are retrieved. </li>
  </ol>
<p><span style="margin-left:16px;">Several annotation settings for ontology class annotations have also been designed in Ontofox: </span></p>
<ol type="i" >
  <li><strong>&quot;includeAllAnnotationProperties&quot;: </strong>By default, if no annotation URI is assigned, no annotations associated with a specific ontology term will be fetched. To include all possible annotations, you can put &quot;<strong>includeAllAnnotationProperties</strong>&quot;on one line, and all the annotations associated with a specific ontology term will be fetched. </li>
  <li><strong>&quot;includeAllAxioms&quot;: </strong>To include all possible annotations and related axioms for a specified term(s), you can put &quot;<strong>includeAllAxioms</strong>&quot;on one line, and all the axioms associated with a specific ontology term(s) will be fetched. This is the same idea of <a href="http://www.w3.org/Submission/2004/SUBM-CBD-20040930/">CBD</a> (Concise Bounded Description).</li>
  <li><strong>&quot;includeAllAxiomsRecursively&quot;: </strong>To include all possible annotations and related axioms for a specified term(s) and its associated terms recursively, you can enter &quot;<strong>includeAllAxiomsRecursively</strong>&quot;on one line. More information about the differences between these two settings is described below in the section of <span id="ontofoxview">Ontofox-View introduction</span>. <span class="darkred">Note:</span> &quot;<strong>includeNoIntermediates</strong>&quot; and <strong>&quot;includeComputedIntermediates&quot;</strong> have higher priority and will override <strong>&quot;includeAllAxiomsRecursively&quot;</strong>. </li>
</ol>
  <p><span style="margin-left:16px;">Several common annotation URIs for ontology class annotations are listed in <a href="#commonURI">the above table</a>. </span></p>
  <p><span class="header_darkred">6. Ontofox hands-on demo</span><span style="margin-left:16px;">
    <br/>
  <span style="margin-left:16px;">Here we provide <a href="hands_on.php">hands-on demo</a> for Ontofox usage. </span></p>
  <p><span class="header_darkred">7. Ontofox use case demo: </span>
  <br/>
  <span style="margin-left:16px;">Here we provide <a href="use_case.php">use case demos</a> for Ontofox usage.</span></p>
  <p><span class="header_darkred" id="import">8. Import an Ontofox output file into a target ontology</span><br/>
  <span style="margin-left:16px;">For many Ontofox users and general ontology developers, one typical question is how to import an external ontology, e.g.,  an Ontofox output file into a target ontology. To illustrate this, here we provide <a href="import_Ontofox_output_file.php">a detailed instruction on how to import Ontofox output file</a>.</span></p>
  <p><span class="header_darkred" id="service">9. Remote Ontofox access without using the Ontofox web page: <br/>
    </span><span style="margin-left:16px;">We understand that there probably is a need to access Ontofox programmatically without coming to Ontofox web page. For this purpose, we have generated a new php script: http://ontofox.hegroup.org/service.php. For example, a user can use the following command line code to get the result:
    &quot;curl -s -F file=@/tmp/input.txt -o /tmp/output.owl http://ontofox.hegroup.org/service.php&quot;. Alternatively, a user can also develop code using Perl, Java or other programming languages. In this case, a user will need use "put" to access this page. </span></p>
  <p><span class="header_darkred" id="includeAllChildren">10. How to correctly use includeAllChildren: <br/>
    </span><span style="margin-left:16px;">The feature "includeAllChildren" is designed to extract all terms of an ontology hierarchy branch under a   specific ontology term. To include all child terms  of a source term, enter "includeAllChildren" in the line after the the   line with source term. Don't put them in the same line. For example:   <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://purl.obolibrary.org/obo/NCBITaxon_4565 #wheat <br/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;includeAllChildren <br/>
      It's noted that all directives are case   sensitive.  It means that the first "i" in "includeAllChildren"   should be lower case. </span></p>
	  <p><span class="header_darkred" id="merge">11. Can we merge Ontofox files for different source ontologies?  <br/>
    </span><span style="margin-left:16px;">Yes. You can put all of your import terms in ONE Ontofox input file. Later on, after you make any changes to the input file, just upload this file to Ontofox and get the updated version of the owl output file. Please refer a section above for detail about the input file format. For multiple source ontologies, just repeat section [Source ontology] to [Source annotation URIs].</span></p>
  <p>&nbsp;</p>
<!-- InstanceEndEditable --></div>
<div id="footer">
  <div id="footer_hl"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><div id="footer_left"><a href="http://www.hegroup.org" target="_blank">He Group</a><br>
University of Michigan Medical School<br>
Ann Arbor, MI 48109</div></td>
		<td width="300"><div id="footer_right"><a href="http://www.umich.edu" target="_blank"><img src="../Images/wordmark_m_web.jpg" alt="UM Logo" width="166" height="20" border="0"></a></div></td>
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
