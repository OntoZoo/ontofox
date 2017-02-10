<?php 
ini_set("memory_limit", "8192M");
set_time_limit(60*60);

include_once('../inc/functions.php');
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
<div id="topnav"><a href="../index.php" class="topnav">Home</a><a href="../introduction.php" class="topnav">Introduction</a><a href="../tutorial/index.php" class="topnav">Tutorial</a><a href="../faqs.php" class="topnav">FAQs</a><a href="../references.php" class="topnav">References</a><a href="../download.php" class="topnav">Download</a><a href="../links.php" class="topnav">Links</a><a href="../contactus.php" class="topnav">Contact</a><a href="../acknowledge.php" class="topnav">Acknowledge</a><a href="../news.php" class="topnav">News</a></div>
<div id="mainbody">
<!-- InstanceBeginEditable name="Main" -->
<?php

/*
SELECT * 
from <http://purl.obolibrary.org/obo/merged/BFO>

WHERE {  ?s rdf:type ?o .
?s rdfs:label ?l.
filter (regex(?s, 'BFO'))
}
*/

$array_mapping=array();

$lines=file('terms_mapping.txt');

foreach($lines as $line) {
	$tokens=explode("\t", $line);
	$array_mapping['"'.trim($tokens[0]).'"']='"'.trim($tokens[1]).'"';
	$array_mapping[' '.trim($tokens[0]).' ']=' '.trim($tokens[1]).' ';
}


$vali=new Validation($_REQUEST);

if (isset($_FILES['target_owl']) && is_uploaded_file($_FILES['target_owl']['tmp_name'])){
}
else {
	$vali->concatError('Please upload a zip file');
}

if ($vali->getErrorMsg()=='') {
	chdir($userfiles);

	$work_dir=createRandomPassword();
	mkdir("$userfiles/$work_dir");
	exec("unzip ".$_FILES['target_owl']['tmp_name']. " -d $userfiles/$work_dir");
	$files = glob("$userfiles/$work_dir/*.owl");
	
	foreach ($files as $filename) {
		$target_owl_text=file_get_contents($filename);
		preg_match_all('/<!ENTITY (\S+) "(\S+)" >/', $target_owl_text, $matches);
		//print_r($matches);
		
		$array_prefix=array();
		
		for ($i=0; $i<sizeof($matches[2]); $i++) {
			$array_prefix['&'.$matches[1][$i].';']=$matches[2][$i];
		}
		
		
		$target_owl_text=str_replace(array_keys($array_prefix), $array_prefix, $target_owl_text);
		
		$target_owl_text=str_replace('<owl:imports rdf:resource="http://www.ifomis.org/bfo/1.1"/>', '<owl:imports rdf:resource="http://purl.obolibrary.org/obo/bfo.owl"/>', $target_owl_text);
		
		
		
		
		$target_owl_text=str_replace(array_keys($array_mapping), $array_mapping, $target_owl_text);
		
		//update to new OBO uri format
		$target_owl_text=preg_replace('/http:\/\/purl.org\/obo\/owl\/\w+#(\w+_\d+)/', 'http://purl.obolibrary.org/obo/$1', $target_owl_text);
		
		
		file_put_contents($filename, $target_owl_text);
	}

	$files = glob("$userfiles/$work_dir/*.txt");
	
	foreach ($files as $filename) {
		$target_owl_text=file_get_contents($filename);
		
		$target_owl_text=str_replace(array_keys($array_mapping), $array_mapping, $target_owl_text);
		
		//update to new OBO uri format
		$target_owl_text=preg_replace('/http:\/\/purl.org\/obo\/owl\/\w+#(\w+_\d+)/', 'http://purl.obolibrary.org/obo/$1', $target_owl_text);
		
		
		file_put_contents($filename, $target_owl_text);
	}
	
	exec("zip $work_dir $work_dir/*");


	if (file_exists("$userfiles/$work_dir.zip")) {
?>
<p><strong>Finished upgrading process. Please download <a href="../userfiles/<?php echo $work_dir?>.zip" target="_blank">the output file</a>.</strong></p>
<?php 

	}
}

if ($vali->getErrorMsg()!='') {
	include('inc/input_error.php');
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
