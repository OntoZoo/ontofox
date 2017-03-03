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
<h3 class="head3_darkred">Tutorial: How to import an Ontofox output file (or any OWL File) into a target ontology</h3>

<p><br/>
  <span style="margin-left:16px;">Here we provide a tutorial  on how to import an Ontofox output file (or any OWL file) into a target ontology. There are basically two methods </span>for you to choose:</span></p>
<p style="font-weight:bold">Table of Contents</p>
<p style="font-weight:bold"></p>
<ol>
  <li><a href="#toc1">Import Ontofox output file to a target ontology using Protege OWL editor. </a></li>
  <li><a href="#toc2">Import Ontofox output file to a target ontology by modifying the OWL text file. </a></li>
</ol>
<p><strong>Below is to provide more detail for each of these method:</strong></p>
<p><span class="header_darkred" id="toc1">1. METHOD #1: Import Ontofox output file to a target ontology using Protege OWL editor: </span><br/>
  <span style="margin-left:16px;">Note:</span> the tutorial material was provided by Ms. Melanie Courtot (Thanks!) on 12/14/2012: </p>
<p><span style="margin-left:16px;">To  import a file into Protege, you should follow these steps:</span></p>
<p> <strong>Step 1: Open protege</strong>:<br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In  the tab active ontology (see the following screenshot), at the bottom you have section called  &quot;imported ontologies&quot;. Click on the small grey &quot;+&quot; button  next to &quot;direct imports&quot;<br>
</p>
<p><img src="import_Ontofox_output_file_clip_image001.png" alt="import Ontofox ouptput file clip image 001" width="98%" apple-width="yes" apple-height="yes"></p>
<p>&nbsp;</p>
<p><strong>Step 2: This will open a new window (see the following screenshot), in which you would select  &quot;import an ontology contained in a specific file&quot;</strong>:</p>
<p><br>
  <img src="import_Ontofox_output_file_clip_image002.png" alt="import Ontofox ouptput file clip image 002" width="811" height="623" apple-width="yes" apple-height="yes"></p>
<p>&nbsp;</p>
<p><strong>Step 3: The  following screenshot shows the window allowing you to select the file on your local  hard drive:</strong><br>
</p>
<p><img src="import_Ontofox_output_file_clip_image003.png" alt="import Ontofox ouptput file clip image 003" width="814" height="617" apple-width="yes" apple-height="yes"></p>
<p>&nbsp;</p>
<p><strong>Step 4: The  following screenshot  is a summary of what will happen - if it is correct just click  &quot;finish&quot;</strong></p>
<p>&nbsp;</p>
<p><img src="import_Ontofox_output_file_clip_image004.png" alt="import Ontofox ouptput file clip image 004" width="814" height="624" apple-width="yes" apple-height="yes"></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>The above first method does not require you to modify the OWL text file directly. However, if you are familiar with the OWL file and are confident with the direct modification of the file, you can follow the following second method: </p>
<p><span class="header_darkred" id="toc2">2. METHOD #2: Import Ontofox output file to a target ontology by modifying the OWL text file:</span> <br/>
</p>
<p><span style="margin-left:16px;">First we introduce a use case:</span></p>
<p><span style="margin-left:16px;"><strong>Task: </strong>Use Ontofox to import the bold OBI terms: </span><img src="images/example1_protege_screenshot.jpg" alt="Example protege screenshot" width="216" height="153" align="middle" style="border:1px solid black;" > (Note: this is part of the Ontofox output  shown in Protege)  </p>
<p>&nbsp;</p>
<p><span style="margin-left:16px;">To a target ontology (e.g.,   <a href="bfo-1.1.owl">BFO 1.1</a> as a target ontology): </span><img src="images/BFO1.1_screenshot.jpg" alt="BFO 1.1 screenshot" align="middle" style="border:1px solid black;">. </p>
<p>&nbsp;</p>
<p><span style="margin-left:16px;">Basically, we have two scenarios: one is to use our Ontofox setting &quot;<strong>URI of the OWL(RDF/XML) output file </strong>&quot;, the other is not to use this setting. Based on this subtle difference, the Ontofox input file can be  slightly different. The <a href="example1_input.txt">Ontofox input file with the special setting</a> is copied here:</span></p>
<p><span style="margin-left:16px;">:</span> <img src="images/example1_input_with_outputURI.jpg" width="539" height="307" alt="Ontofox input file with setting &quot;URI of the OWL (RDF/XML) output file&quot;" style="border:1px solid black;""></p>
<p><span style="margin-left:16px;">If the special setting (see the second line in the above file image) is not specified, then we have an <a href="example1_input_withNo_outputURI.txt">Ontofox input file without this setting</a>, </span></p>
<p><span class="header_darkred">1. By using the setting &quot;<strong>URI of the OWL(RDF/XML) output file</strong>&quot;</span><span style="margin-left:16px;"> <br/>
  <span style="margin-left:16px;">Again, here is <a href="example1_input.txt">the Ontofox input file with this setting</a>.</span></p>
<p><span style="margin-left:16px;">The first few lines of the output file without the output file URI is here:</span></p>
<p><span style="margin-left:16px;">:</span> <img src="images/example1_output_with_outputURI.jpg" width="619" height="242" alt="Output with Output file URI" style="border:1px solid black;" ></p>
<p><span style="margin-left:16px;">It is noted that the last line has no  defined OWL file URI, but  the xml:base has an OWL file URI randomly assigend by Ontofox.</span> </p>
<p> <span style="margin-left:16px;"><strong>NOTE: Please save the above  output file using the same file name &quot;example1_import.owl&quot; in an appropriate folder as indicated by the URL. The updated Protege use an XML file (catalog-v001.xml) to track the mapping of the phicial location and the URI of an imported owl file. So it is not mandatory to save the out file using the same directory layout.</strong></span></p>
<p><span style="margin-left:16px;">Here is a screenshot of the first few lines of the <a href="bfo-1.1.owl">BFO 1.1</a> as the target ontology: </span></p>
<p><span style="margin-left:16px;">: </span><img src="images/example1_BFO_as_targetOntology.jpg" alt="BFO 1.1 as a target ontology" style="border:1px solid black;"></p>
<p><span style="margin-left:16px;">Basically, what we need to do is to add one child element under owl:Ontology:</span></p>
<p><span class="darkred" style="margin-left:16px;"> &lt;owl:imports rdf:resource=&quot;http://purl.obolibrary.org/obo/your_ontology/external/example1_import.owl&quot;/&gt;</span></p>
<p><span style="margin-left:16px;">: </span><img src="images/example1_BFO_as_targetOntology_with_import.jpg" width="789" height="432" style="border:1px solid black;"><br>
</p>
<p><span class="header_darkred">2. A more general case, if you don't use this Ontofox setting.  </span>  <br/>
  <span style="margin-left:16px;">Again, here  is the <a href="example1_input_withNo_outputURI.txt">Ontofox input file without using the above setting</a>.</span></p>
<p><span style="margin-left:16px;"> The first few lines of the output file without the output file URI is here:</span></p>
<p><span style="margin-left:16px;">: <img src="images/example1_output_withNo_outputURI.jpg" style="border:1px solid black;" alt="output file without output file URI">.</span></p>
<p><span style="margin-left:16px;">It is noted that the last line has no defined OWL file URI, and the xml:base has an OWL file URI randomly assigned by Ontofox.  </span>Please change this URI manually in the Ontofox output OWL file and add a new URI (representing the name and location of the   Ontofox output OWL file) to the target ontology as demonstrated above. For example, the new URI can be: <span class="darkred">http://purl.obolibrary.org/obo/your_ontology/external/example1_import.owl</span>. This URI means that the Ontofox output OWL file is named &quot;example1_import.owl&quot;, and it is located on the folder of &quot;your ontology/external/&quot;. <strong>Note: </strong>it would be fine if you just put the imported owl file in the same folder as your target ontology because it is considered as a default folder when the Protege ontology editor is looking for the imported ontology.</p>
<p><span class="header_darkred" style="margin-left:16px;">Note: </span>The same method as described here can be used to import any OWL file or existing ontologies to a target ontology.  </p>
<p><span class="header_darkred" >Final merged ontology OWL file:  </span>The final merged ontology OWL file is <a href="bfo-1.1_with_import.owl">HERE</a>. </p>
<p>&nbsp;</p>
<p><span style="margin-left:16px;">Does this tutorial help? Any <a href="../feedback/index.php">suggestions and comments</a> are welcome!</span></p>
<!-- InstanceEndEditable -->
</div>
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
