<?php
include_once('../inc/functions.php');

$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>OntoFox</title>
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
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../introduction.php" class="topnav">Introduction</a><a href="index.php" class="topnav">Tutorial</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../references.php" class="topnav">References</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact</a><a href="../acknowledge.php" class="topnav">Acknowledge</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<h3 class="head3_darkred">Tutorial</h3>

<p>Here we provide a tutorial of how OntoFox can be applied for your research and ontology development:   </p>
<p>Many more details about OntoFox and how to use it can be found from our OntoFox manuscript: <a href="http://www.ncbi.nlm.nih.gov/sites/pubmed/20569493">PubMed ID: 20569493</a></p>
<p style="font-weight:bold">Table of Contents</p>
<ol>
	<li><a href="#toc1">Source Ontologies and their namespaces</a></li>
	<li><a href="#toc2">OntoFox execution using web input forms</a></li>
	<li><a href="#input_format">OntoFox data input format</a></li>
	<li><a href="#toc4">Four  &quot;directives&quot; used in OntoFox</a></li>
	<li><a href="#toc5">Four settings used in OntoFox</a></li>
	<li><a href="hands_on.php">OntoFox hands on demo</a></li>
	<li><a href="use_case.php">OntoFox use case demostrations </a></li>
	<li><a href="#service">OntoFox access without using OntoFox web site</a></li>
</ol>
<p><span class="header_darkred" id="toc1">1. Source Ontologies and their namespaces: </span><br/>
<span style="margin-left:16px;">OntoFox includes many source ontologies for query.  OntoFox uses  standardized namespaces of source ontologies following OBO Foundry recommendations. These namespaces are also used in ontology servers like Neurocommons.org: </span></p>
<blockquote>
  <table border="0" cellpadding="5" cellspacing="1" bgcolor="#333333">
    <tr>
      <th bgcolor="#FFFFFF">#</th>
      <th bgcolor="#FFFFFF">Ontology</th>
      <th bgcolor="#FFFFFF">Base URI</th>
      <th bgcolor="#FFFFFF">Term URI example </th>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>1</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.obofoundry.org/cgi-bin/detail.cgi?id=caro">CARO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CARO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CARO#CARO_0000040</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>2</strong></th>
      <th bgcolor="#FFFFFF"><strong><a href="http://chebi.wiki.sourceforge.net/">CHEBI</a></strong></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CHEBI</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CHEBI#CHEBI_48999</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>3</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.obofoundry.org/cgi-bin/detail.cgi?id=cell">CL</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CL</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/CL#CL_0000799</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>4</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://diseaseontology.sourceforge.net/">DOID</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/DOID</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/DOID#DOID_12685</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>5</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://environmentontology.org/">ENVO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/ENVO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/ENVO#ENVO_00000483</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>6</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://sig.biostr.washington.edu/projects/fm/index.html">FMA</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/FMA</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/FMA#FMA_9712</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>7</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.geneontology.org">GO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/GO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/GO#GO_0043152</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>8</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.bioontology.org/wiki/index.php/Infectious_Disease_Ontology">IDO</a></th>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/</td>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/IDO_0000064</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>9</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.informatics.jax.org/searches/MP_form.shtml">MP</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/MP</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/MP#MP_0000026</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>10</strong></th>
      <th bgcolor="#FFFFFF"><strong><a href="http://www.ncbi.nlm.nih.gov/Taxonomy/">NCBITaxon</a></strong></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/NCBITaxon</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/NCBITaxon#NCBITaxon_263</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>11</strong></th>
      <th bgcolor="#FFFFFF"><strong><a href="http://obi-ontology.org">OBI</a></strong></th>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/</td>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/OBI_0100026</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>12</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.obofoundry.org/cgi-bin/detail.cgi?id=quality">PATO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/PATO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/PATO#PATO_0001793</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>13</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.obofoundry.org/cgi-bin/detail.cgi?id=protein">PRO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/PRO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/PRO#PRO_000001795</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>14</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.sequenceontology.org/">SO</a></th>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/SO</td>
      <td bgcolor="#FFFFFF">http://purl.org/obo/owl/SO#SO_0001288</td>
    </tr>
    <tr>
      <th bgcolor="#FFFFFF"><strong>15</strong></th>
      <th bgcolor="#FFFFFF"><a href="http://www.violinet.org/vaccineontology/">VO</a></th>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/</td>
      <td bgcolor="#FFFFFF">http://purl.obolibrary.org/obo/VO_0000001</td>
    </tr>
  </table>
<p><strong>Note: </strong>The compelete ontologies included in OntoFox is <a href="lists.php">listed here</a>.</p>
</blockquote>

  
<p>&nbsp;</p>
<p><span class="header_darkred" id="toc2">2. OntoFox execution using  web input forms:</span> <br/>
  <span style="margin-left:16px;">Data for each component can be input using the web input form in the OntoFox home page. OntoFox needs the following information as input from users: </span></p>
<p><span style="margin-left:16px;"><strong>(1) Source ontology: </strong></span>The ontology where a list of terms will be retrieved from. </p>
<p><span style="margin-left:16px;"><strong>(2) Class term specification:</strong></span></p>
<p><span style="margin-left:32px;"><strong>Section A: Bottom up term specification</strong></span></p>
<p><span style="margin-left:48px;"><strong> (Section A - a) Low level source term URIs</strong></span><strong>: </strong>The URIs of low level term from source ontologies. </p>
<p><span style="margin-left:48px;"><strong>(Section A - b) Top level source term URIs and<strong> target direct superclass URIs</strong></strong></span><strong>: </strong>The URIs of top  level term from source ontologies and their direct superclass URIs from a target ontology (i.e., the ontology that will import the terms from the source ontologies). The top level source term URI can be the same as the low level source term URI. In this case, a single source term will be fetched. If no top level source term is specified, by default the top level source term is the same as the low level source term. Since each top level source term has its own superclass in the target ontology, each target direct superclass of a top level source term should be specified. In OntoFecth, we specify the target direct superclass in a new line, following the sign &quot;subClassOf &quot;. </p>
<p><span style="margin-left:48px;"><strong>(Section A - c) Setting for retrieving intermediate source terms: </strong></span> Three options are available for retrieving intermediate terms: (a) <strong>includeNoIntermediates</strong>: no intermediate source terms are retrieved.  (b) <strong>includeComputedIntermediates</strong>: Sensible intermediate source terms are retrieved. Sensible intermediates include those intermediate terms that are closest ancestors of more than one low level source terms. (c) <strong>includeAllIntermediates</strong>: All intermediate source terms are retrieved.</p>
<p><span style="margin-left:32px;"><strong>Section B: Top down branch module extraction: 
  </strong></span></p>
<p><span style="margin-left:48px;"><strong>(Section B - a) Include top level source term URIs and target direct superclass URIs (One URI per line):</strong> This feature is designed to extract all terms of an ontology hierarchy branch under a specific ontology term. For this purpose, the top level source term and it's diret superclass URI from the target ontology are needed.</span></p>
<p><span style="margin-left:16px;"><strong>(3) Source annotation URIs: </strong></span>The annotation URIs for the source terms used in the source ontologies. To map or wrap an annotation to a new one, please specify &quot;copyTo&quot; or &quot;mapTo&quot; in the new line following the orignal annotation URL, followed by the new annotation URI. </p>
<p><span style="margin-left:16px;">The OntoFox home page provide many examples. These examples can be used to quickly learn how to use the OntoFox web forms for OntoFox implementation.  </span></p>
<p><span style="margin-left:16px;">Common annotation URIs: </span></p>
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
</table>
<p>&nbsp;</p>
<p><span style="margin-left:16px;"><strong>(4) URI of the OWL(RDF/XML) output file:   </strong></span>This is a newly added feature that is designed to simplify the user's work after getting the OntoFox output file. After a URI of the OWL output file is specified, the URI will be automatically added to the OntoFox output file. The user can then put the OntoFox output file in a specified location. Once the target ontology includes the same information, the OntoFox output results  can be directly shown in the target ontology in an OWL editor such as Protege. So basically, this URI is used so that later you don't need to modify this OntoFox-generated output file anymore. This indeed saves the user's time and avoids mistakes.<br/>
</p>
<p><span class="header_darkred" id="input_format">3. OntoFox data  input format: </span> <br/>
    <span style="margin-left:16px;">An example of OntoFox data input file is here: </span></p>
	<blockquote>
<p>-----------------------</p>
<p>[URI of the OWL(RDF/XML) output file]<br>
  http://purl.obolibrary.org/obo/example.owl</p>
<p>[Source ontology]<br>
  #comment here<br>
  #List of ontologies: OBI, NCBITaxon, MP, PATO, GO, DOID, IDO, CHEBI, SO, PRO, CL, ENVO, CARO <br>
  NCBITaxon<br>
  OBI #another comment here</p>
<p>[Low level source term URIs]<br>
  http://purl.org/obo/owl/NCBITaxon#NCBITaxon_263 #Francisella tularensis <br>
  http://purl.org/obo/owl/NCBITaxon#NCBITaxon_234 #Brucella<br>
  http://purl.org/obo/owl/PATO#PATO_0001793 #right side of <br>
  http://purl.org/obo/owl/PATO#PATO_0001792 #left side of</p>
<p>[Top  level source term URIs and  target direct superclass URIs]<br>
  http://purl.org/obo/owl/NCBITaxon#NCBITaxon_2 #Bacteria <br>
  subClassOf http://purl.obolibrary.org/obo/OBI_0100026 #organism, this term is from target ontology <br>
  http://purl.org/obo/owl/PATO#PATO_0001238 <br>
  subClassOf http://www.ifomis.org/bfo/1.1/snap#Quality #Note: Use  designated sign &quot;subClassOf&quot; </p>
<p>[Source term retrieval setting]<br>
  includeNoIntermediates #or: includeAllIntermediates, inincludeComputedIntermediates </p>
<p>  [Branch extractions from source term URIs and target direct superclass URIs]</p>
<p>[Source annotation URIs]<br>
  http://www.w3.org/2000/01/rdf-schema#label<br>
  copyTo http://purl.obolibrary.org/obo/IAO_0000111<br>
  http://www.geneontology.org/formats/oboInOwl#hasDefinition<br>
  mapTo http://purl.obolibrary.org/obo/IAO_0000115<br>
  http://www.geneontology.org/formats/oboInOwl#hasSynonym<br>
  <br>
  -----------------------</p>
</blockquote>
<p><span style="margin-left:16px;">As you can tell, the OntoFox data input format contains the following components:
</span>
<ol type="i" >
  <li><strong>Headings:</strong> Each heading contains a text description quoted inside parenthesis &quot;[ ]&quot;. Five headings represent the four components of OntoFox execution. Please use the exact same text in all headings. </li>
  <li><strong>URI of the OWL(RDF/XML) output file</strong> <strong>under the first heading</strong>: This provides a URI for the OntoFox output OWL file.</li>
  <li><strong>Source ontology list.</strong> This is required. If using web forms, one or many ontologies can be selected. Currently, the ontologies we have tested and included in OntoFox include: OBI, NCBITaxon, MP, PATO, GO, DOID, IDO, CHEBI, SO, PRO, CL, ENVO, and CARO. </li>
  <li><strong>Low level source term URIs:</strong> At least one source term URI is required.  </li>
  <li><strong>Top level source term URIs and target direct superclass URIs:</strong> Since each top level source term has its own direct superclass in the target ontology, URIs of target direct superclasses of individual top level source terms are input together with the top level source term with a new line starting with &quot;<strong>subClassOf</strong>&quot;. To get a single class from source ontology, you do not need to specify any top level source term, or you can specify the top level source term URI as the same as the low level source term URI.</li>
  <li><strong>Source term retrieval setting:</strong> Choose one of three settings for retrieving intermediate source ontology terms:: includeNoIntermediates,  includeAllIntermediates, and inincludeComputedIntermediates. See description below. </li>
  <li><strong>Branch extractions from source term URIs and target direct superclass URIs: </strong> The information is needed if a user wants to extract a whole ontology hierarchy branch under a specific term(s) from a souce ontology.</li>
  <li><strong>Source annotation URIs:</strong> The source term annotation URIs are requested in case only limited annotations are needed. If no annotation URI is assigned, no annotations associated with a specific ontology term will be fetched. To include all possible annotations, you can put &quot;<strong>includeAllAxioms</strong>&quot;on one line, and all the annotations associated with a specific ontology term will be fetched. To map or wrap an annotation to a new one, please specify &quot;copyTo&quot; or &quot;mapTo&quot; in the new line following the orignal annotation URL, followed by the new annotation URI.<br/>
  </li>
  <li><strong>Comments:</strong> The sign &quot;#&quot; as the first letter of a line or as a letter after a space in the middle of a line is an indicator of a comment. All text after this sign within one line is considered comment and will not be used for OntoFox analysis. </li>
  </ol>
  <br/>
  <p><span class="header_darkred" id="toc4">4. Four &quot;directives&quot; used in OntoFox: <br/>
    </span><span style="margin-left:16px;">Four </span> directives are designed as unique OntoFox  commands to guide users to provide consistent and readable input data in  OntoFox web forms or input text format
  <ol type="i" >
    <li><strong>&quot;fromEndpoint&quot;: </strong> This directive is generated to indicate a SPARQL  endpoint from which a source ontology is retrieved by OntoFox. It is used at  the beginning of a line, followed by a web-accessible URL of a particular  SPARQL endpoint. The line above this &lsquo;fromEndpoint&rsquo; statement is the URI of a  source ontology. </li>
    <li><strong>&quot;subClassOf&quot;: </strong>This is a directive that is used in defining the target direct superclass (Box 3). This directive should be the first word in a line, followed by a target ontology URI that will be the superclass of the source ontology term listed in the previous line. </li>
    <li><strong>&quot;copyTo&quot;:  </strong>This is a directive that is used in mapping for ontology term annotation (Box 4). This directive should be the first word in a line, followed by an annotation URI used in  target ontology. The use of this directive would lead to  addition of an  annotation to an imported term which includes an annotation with  annotation URI specified in the line before &quot;copyTo&quot;. For example, the &quot;copyTo&quot; in the above example will provide an additional annotation http://purl.obolibrary.org/obo/IAO_0000111 (preferred_term) with the same content as the &quot;label&quot; (http://www.w3.org/2000/01/rdf-schema#label).  <br/>
    </li>
    <li><strong>&quot;mapTo&quot;: </strong>This is a directive that is used in wrapping  for ontology term annotation (Box 4).  This directive should be the first word in a line, followed by an annotation URI used in  target ontology. The use of this directive would lead to  replacement of an  annotation (specified by the annotation URI in the line before) of  an imported term with  another annotation specified in the URI following &quot;mapTo&quot;. For example, the &quot;mapTo&quot; in the above example will replace  source ontology annotation term URI &quot;http://www.geneontology.org/formats/oboInOwl#hasDefinition&quot; with target ontology annotation term URI &quot;http://purl.obolibrary.org/obo/IAO_0000115&quot; (IAO definition).  </li>
  </ol>
  <br/>
  <p><span class="header_darkred" id="toc5">5. Six settings used in OntoFox: <br/>
    </span><span style="margin-left:16px;">Four OntoFox settings are designed to allow OntoFox server parse needed information. Any of these OntoFox settings stands alone and does not procede or follow any statements:</span>
  <ol type="i" >
    <li><strong>&ldquo;includeNoIntermediates&rdquo;</strong>: no intermediate source terms are retrieved. </li>
    <li><strong>&ldquo;includeComputedIntermediates&rdquo;</strong>: Computed intermediate source terms include those intermediate terms that are closest ancestors of more than one low level source terms. Those intermediate terms that have only one parent term and one child term each are removed. This setting provides an option to get less intermediate ontology terms then that with the setting &lsquo;includeAllIntermediates&rdquo;  and still fulfills many users&rsquo; requirement. This option is the default usage for many  ontologies (e.g., VO and OBI). </li>
    <li><strong>&ldquo;includeAllIntermediates&rdquo;</strong>: All intermediate source terms are retrieved. </li>
    <li><strong>&quot;includeAllAnnotationProperties&quot;: </strong>By default, if no annotation URI is assigned, no annotations associated with a specific ontology term will be fetched. To include all possible annotations, you can put &quot;<strong>includeAllAnnotationProperties</strong>&quot;on one line, and all the annotations associated with a specific ontology term will be fetched. </li>
    <li><strong>&quot;includeAllAxioms&quot;: </strong>To include all possible annotations and related axioms, you can put &quot;<strong>includeAllAxioms</strong>&quot;on one line, and all the axioms associated with a specific ontology term will be fetched. This is the same idea of <a href="http://www.w3.org/Submission/2004/SUBM-CBD-20040930/">CBD</a> (Concise Bounded Description).</li>
    <li><strong>&quot;includeAllAxiomsRecursively&quot;: </strong>To include all Axioms recursively for all the specified terms and the related terms, you can enter &quot;<strong>includeAllAxiomsRecursively</strong>&quot;on one line. <span class="darkred">Note:</span> &quot;<strong>includeNoIntermediates</strong>&quot; and  <strong>&ldquo;includeComputedIntermediates&rdquo;</strong> have higher priority and will override <strong>&quot;includeAllAxiomsRecursively&quot;</strong>. </li>
  </ol>
  <p><span class="header_darkred">6. OntoFox hands on demo</span><span style="margin-left:16px;">
    <br/>
  <span style="margin-left:16px;">Here we provide <a href="hands_on.php">hands on demo</a> for OntoFox usage. </span></p>
  <p><span class="header_darkred">7. OntoFox use case demo: </span>
  <br/>
  <span style="margin-left:16px;">Here we provide <a href="use_case.php">use case demos</a> for OntoFox usage.</span></p>
  <p><span class="header_darkred" id="service">8. Remote OntoFox access without using the OntoFox web page: <br/>
    </span><span style="margin-left:16px;">We understand that there probably is a need to access OntoFox programmatically without coming to OntoFox web page. For this purpose, we have generated a new php script: http://ontofox.hegroup.org/service.php. For example, a user can use the following command line code to get the result:
    &quot;curl -s -F file=@/tmp/input.txt -o /tmp/output.owl http://ontofox.hegroup.org/service.php&quot;. Alternatively, a user can also develop code using Perl, Java or other programming languages. In this case, a user will need use "put" to access this page. </span></p>
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
