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
<h3 class="head3_darkred">Tutorial (Continued)</h3>

<p><br/>
</p>
<p><strong><span class="header_darkred" id="toc6">6. OntoFox hands on demo: <br/>
</span><span style="margin-left:16px;"></span>Step1:</strong> Specify an ontology to import terms from. You can select an ontolgy from the dropdown list (Fig 1.1) or enter the URL and the SPARQL endpoint in the textarea (Fig 1.2)</p>
<p><img class="screenshot" width=611 height=297 id="Picture 7"
src="images/image001.jpg"></p>
<p>Fig 1.1 </p>

<p><img
src="images/image001_1.jpg" alt="Image" width=598 height=125 class="screenshot" id="Picture "></p>
<p>Fig 1.2</p>
<p><strong><span style="margin-left:16px;"></span>Step 2:</strong> Enter the URI of the low level source term you wish to import. Or you can search a term by entering keywords related to the term (term label or synonyms, partial words supported). When you entered three or more characters in the searching box, a list of terms which mathing your input will be dynamically added to the dropdown list (Fig 2.1). Aftern selecting a term, the short term ID will be shown. Click detail button, the detailed information about the term will be shown in a seperate page (Fig 2.2). For some of the ontologies, the detail pages are links to the individual ontolog browsers provided by their corresponding developers. Others are linked to our OntoBee ontology browser (<a href="http://ontobee.hegroup.org/">http://ontobee.hegroup.org/</a>).</p>
<p>Once you found the term, click &quot;Add&quot; button, the term URI and it's label will be added to the textarea (Fig 2.3).</p>
<p><img class="screenshot" width=619 height=270 id="Picture 4"
src="images/image002.jpg"></p>

<p>Fig 2.1</p>

<p><img class="screenshot" width=624 height=427 id="Picture 13"
src="images/image003.jpg"></p>
<p>Fig 2.2</p>

<p><img class="screenshot" width=613 height=137 id="Picture 16"
src="images/image004.jpg"></p>

<p>Fig 2.3</p>
<p><strong><span style="margin-left:16px;"></span>Step 3:</strong> Enter the URI of the top level source term you wish to import. You can use the same technique to search the terms as shown in step 2 (Fig 3.1). </p>
<p>Once you found the term, click &quot;Add&quot; button, the term URI and it's label will be added to the textarea (Fig 3.2). You can enter the target direct superclass URI for the term (Fig 3.3) or remove the text &quot;subClassOf&quot; if don't want to specify the target direct superclass for the term.</p>
<p></p>
<p><img class="screenshot" width=608 height=136 id="Picture 19"
src="images/image005.jpg"></p>

<p>Fig 3.1</p>

<p><img class="screenshot" width=608 height=136 id="Picture 22"
src="images/image006.jpg"></p>

<p>Fig 3.2</p>
<p><img class="screenshot" width=608 height=137 id="Picture 25"
src="images/image007.jpg"></p>
<p>Fig 3.3</p>
<p><strong><span style="margin-left:16px;"></span>Step 4:</strong> Sepcify setting for retrieving intermediate source terms. Select one of the options listed in the dropdown list (Fig 4.1).</p>

<p><img class="screenshot" width=599 height=91 id="Picture 34"
src="images/image008.jpg"></p>

<p>Fig 4.1</p>
<p><strong><span style="margin-left:16px;"></span>Step 5:</strong> Specify to be included annotation for the source terms. We have provided some commonly used annoations for you to choose. Click &quot;rdfs:label&quot;, the URI for annotation rdfs:label will be added to the textarea (Fig 5.1). If you wish to include &quot;iao:preferredTerm&quot;, click the link, the corresponding URI will be added to the textarea (Fig 5.2).</p>

<p><img class="screenshot" width=589 height=144 id="Picture 37"
src="images/image009.jpg"></p>

<p>Fig 5.1</p>

<p><img class="screenshot" width=594 height=141 id="Picture 40"
src="images/image010.jpg"></p>

<p>Fig 5.2</p>
<p><strong><span style="margin-left:16px;"></span>Final Step:</strong> After filling ou the form, click &quot;Generate OntoFox Input File&quot; (Fig 6.1), a text file show the input file which can be saved for later use will be desplayed (Fig 6.2). Click &quot;Generate OWL (RDF/XML) File&quot; (Fig 6.3), a page with the link to the OWL output file will be displayed (Fig 6.4). You can save the OWL output file by right click the link and select the menu item &quot;Save Link As&quot;(Fig 6.4). Our server will store the input and output files for around 24 hours and the locations of these files are also shown in the result page.You can destory these files if you don't like them to be temporarily stored on our server (Fig 6.5).</p>

<p><img class="screenshot" width=529 height=36 id="Picture 43"
src="images/image011.jpg"></p>

<p>Fig 6.1</p>

<p><img class="screenshot" width=515 height=258 id="Picture 49"
src="images/image013.jpg"></p>
<p>Fig 6.2</p>

<p><img class="screenshot" width=533 height=38 id="Picture 46"
src="images/image012.jpg"></p>
<p>Fig 6.3</p>

<p><img class="screenshot" width=624 height=152 id="Picture 55"
src="images/image014.jpg"></p>

<p>Fig 6.4</p>

<p><img class="screenshot" width=624 height=143 id="Picture 58"
src="images/image015.jpg"></p>
<p>Fig 6.5</p>
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
