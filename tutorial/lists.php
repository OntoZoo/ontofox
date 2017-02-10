<?php include_once('../inc/functions.php');

$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);


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

<p>&nbsp;</p>

<?php $strSql = "select * from ontology where loaded='y' order by ontology_abbrv";
$rs = $db->Execute($strSql);

if(!$rs->EOF) {
?>
<p><strong>Full list of  ontologies included in Ontofox.</strong></p>
  <table border="0" cellpadding="3" cellspacing="1" bgcolor="#333333">
    <tr>
      <th bgcolor="#FFFFFF">#</th>
      <th bgcolor="#FFFFFF">Ontology</th>
      <th bgcolor="#FFFFFF">Ontology Full Name</th>
      <th bgcolor="#FFFFFF">Term URI example</th>
    </tr>
<?php 	$i=0;
	foreach ($rs as $row) {
		$i++;
?>
    <tr>
      <th bgcolor="#FFFFFF" style="width:60px"><?php echo $i?></th>
      <th bgcolor="#FFFFFF"><a href="http://www.ontobee.org/browser/index.php?o=<?php echo $row['ontology_abbrv']?>"><?php echo $row['ontology_abbrv']?></a></th>
      <td bgcolor="#FFFFFF"><?php echo $row['ontology_fullname']?></th>
      <td bgcolor="#FFFFFF"><?php echo $row['url_eg']?></th>
    </tr>
<?php 
	}
?>
  </table>

<?php }
?>
  
<p>&nbsp;</p>
<p>&nbsp;</p>
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
