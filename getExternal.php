<?php
set_time_limit(60*60);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><!-- InstanceBegin template="/Templates/default.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ontofox</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="styleMain.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" -->
<script language="javascript">
function switch_sparql(){
	var div_sparql=document.getElementById("div_sparql");
	var href_switch_sparql=document.getElementById("href_switch_sparql");
	if (div_sparql.style.display=="none") {
		div_sparql.style.display="";
		href_switch_sparql.innerHTML="Hide SPARQL queries used in this page";
	}
	else {
		div_sparql.style.display="none";
		href_switch_sparql.innerHTML="Show SPARQL queries used in this page";
	}
}

</script>
<!-- InstanceEndEditable -->
</head>

<body>
<div id="topbanner"><a href="/index.php"><img src="Images/logo.gif" alt="Logo" width="280" height="50" border="0"></a></div>
<div id="topnav"><a href="index.php" class="topnav">Home</a><a href="introduction.php" class="topnav">Introduction</a><a href="tutorial/index.php" class="topnav">Tutorial</a><a href="faqs.php" class="topnav">FAQs</a><a href="references.php" class="topnav">References</a><a href="download.php" class="topnav">Download</a><a href="links.php" class="topnav">Links</a><a href="contactus.php" class="topnav">Contact</a><a href="acknowledge.php" class="topnav">Acknowledge</a><a href="news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->

<p><span class="header_darkred">Retrieving Results</span></p>
<?php 
include('getExternalCore.php');

/**
 * Author: Zuoshuang Xiang
 * The University Of Michigan
 * He Group
 * Date: 2010-03-04
 *
 * This is the main program for processing user inputs, form queries, 
 * process query resuslt and output final results.
 */
 
if ($vali->getErrorMsg()!='') {
?>
<p style="color:#FF1F55">Error: <?php echo $vali->getErrorMsg()?></p>
<?php 
}
else {

	if (file_exists("userfiles/$finalFile.owl")) {
?>
<p><strong>Finished retrieving process. Please download <a href="userfiles/<?php echo $finalFile?>.owl" target="_blank">the output file</a>.</strong></p>
<?php 

		if (!empty($a_missing_term)) {
?>
<p>The following terms do not have any related axioms in the source ontology:<br>
<?php
			foreach($a_missing_term as $missing_term_iri => $tmp) {
				print($missing_term_iri. "</br>\n");
			}
?>
</p>
		  <p class="darkred" style="font-size:150%"><strong>Notice:</strong> All the OBO ontologies have changed the term URI format from http://purl.org/obo/owl/ontology#ontology_nnnnnnn to http://purl.obolibrary.org/obo/ontology_nnnnnnn. Please make sure your input files are updated.</p>
<?php
		}

		if ($GALAXY_URL!='') {
?>    

    <form method="post" action="<?php echo $GALAXY_URL?>" enctype="multipart/form-data" name="galaxyform">
      <input type="hidden" name="id" value="<?php echo $finalFile?>"></input>
      <input type="hidden" name="tool_id" value="get_obo"></input>
      <input type="hidden" name="URL" value="http://ontofox.hegroup.org/userfiles/<?php echo $finalFile?>.owl"></input>

      <b>OWL2 format</b>
     <input name="submit" type="submit" value="Export to Galaxy"></input></form>

<?php 
		}
	}
	else {
?>
<p><strong>An error has occured during the retrieval process, please try again or <a href="contactus.php">contact us</a>.</strong></p>
<?php 
	}
?>
<p>Your input file should be located at http://ontofox.hegroup.org/userfiles/<?php echo $finalFile?>.txt and your output file should be located at http://ontofox.hegroup.org/userfiles/<?php echo $finalFile?>.owl. Please includes these two links in your email if you need our assistance.</p>
<p>These files will be destroyed at 3:00 AM EST (New York time). If you wish to destroy these files now, please <a href="remove.php?f=<?php echo join(',', array_keys($fileNames))?>">click here</a>. </p>
<p><a href="http://survey.hegroup.org/index.php?sid=46454&lang=en">Ontofox Survey</a>:  your feedback on Ontofox is welcome and important for us to improvie this service. This survey contains 16 questions and will take approximately 5 minutes. Thank you!</p>
    <div><a href="javascript:switch_sparql();" id="href_switch_sparql">Show SPARQL queries used in this page</a></div>
    <div id="div_sparql" style="display:none">
    <pre>
<?php  print (htmlspecialchars($strQueryPrint));?>
    </pre>
    </div>

<?php 	

}
?>
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
