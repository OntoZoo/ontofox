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
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../introduction.php" class="topnav">Introduction</a><a href="../tutorial/index.php" class="topnav">Tutorial</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../references.php" class="topnav">References</a><a href="../download.php" class="topnav">Download</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact</a><a href="../acknowledge.php" class="topnav">Acknowledge</a><a href="../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<form action="do_upgrade.php" method="post" enctype="multipart/form-data" target="_blank">

<table border="0">
  <tr>
    <td><h3 class="header_darkred">Upgrade BFO ontology</h3>
      <p>How this works:<br>
        Input: A user needs to provide a URI of an input ontology (e.g., VO) or upload a local OWL file. <br>
        Output: a downloadable OWL file that is an updated ontology OWL file. All the terms in the updated version are now under the new BFO terms. <br>
        Note: If a BFO 1.1 was imported in the old version, the user now needs to remove the import.<br>
         Goal: This page can be used to update from the previous BFO 1.1 to current BFO 2.0. This is important for many ontologies (e.g., OBI, VO, &hellip;) that import BFO as top ontology.<br>
        Acknowledgements: The program is developed by Allen Xiang in He Group. The information of the mapping between BFO 1.1 and 2.0 was provided by Jie Zheng.  </p>
      <p><a href="terms_mapping.txt">Term mapping table</a>.</p>
<p>&nbsp;</p>
      <strong style="margin-left:16px;">(1) Please specify the  target OWL file (<span class="darkred">RDF/XML format</span>):</strong></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Online URL:
      <input name="target_owl_url" id="target_owl_url" size="70"></td>
  </tr>
  <tr>
    <td style="padding-left:16px">Or file upload:
      <input name="target_owl" type="file" id="target_owl" size="60"></td>
  </tr>
  <tr>
    <td align="center" style="padding-top:12px"><input type="submit" name="Submit1" value="Get OWL(RDF/XML) Output File" />
      <input type="reset" name="Submit3" value="Reset" style="margin-left:40px;"></td>
  </tr>
</table>

</form>
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
