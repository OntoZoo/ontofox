<?php 
include_once('../inc/functions.php');

$strSql="SELECT * FROM counter WHERE page='getExternal.php'";

$db = ADONewConnection($driver);
$db->Connect($host, $username, $password, $database);

$rs = $db->Execute($strSql);
?>
OntoFox has been used to generate <?php echo $rs->fields('count')?> output files.