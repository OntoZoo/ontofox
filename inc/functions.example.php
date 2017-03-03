<?php  
/**
 * Author: Zuoshuang Xiang
 * The University Of Michigan
 * He Group
 * Date: 2010-03-04
 *
 * This file include some global variables and functions.
 */
 
 if (array_key_exists('REMOTE_ADDR', $_SERVER)){
	if ($_SERVER['REMOTE_ADDR']=='141.211.38.150' || $_SERVER['REMOTE_ADDR']=='141.214.194.57') {
		ini_set("display_errors", "1"); 
		ini_set("display_startup_errors", "1"); 
		error_reporting(E_ALL);
	}
}
else {
	ini_set("display_errors", "1"); 
	ini_set("display_startup_errors", "1"); 
	error_reporting(E_ALL);
}


//Globle Varibles.
$driver = 'mysql';
$host = '';
$username = '';
$password = '';
$database = '';


//For database and content side
$adminEmail = "";
//For programming side
$webmasterEmail = "";
$webmasterName = "";
$webmasterPhone = '';
$systemEmailFlag = '';
$mail_relay_host = '';

$userfiles = '/data/var/www/html/ontofox/userfiles';

include('adodb5/adodb-errorhandler.inc.php');
include('adodb5/adodb.inc.php');


$default_end_point="http://sparql.hegroup.org/sparql";

$section_tags=array();
$section_tags['ontology']='[Source ontology]';
$section_tags['term_iris']='[Low level source term URIs]';
$section_tags['signature_term_iris']='[User-specified signature term URIs from source ontology]';
$section_tags['top_term_iris']='[Top level source term URIs and target direct superclass URIs]';
$section_tags['retrieval_setting']='[Source term retrieval setting]';
$section_tags['annotation_iris']='[Source annotation URIs]';
$section_tags['excluding_annotation_iris']='[Source annotation URIs to be excluded]';
//$section_tags['$outputURI']='[URI of the OWL(RDF/XML) output file]';


$retrieval_setting_options = array();
$retrieval_setting_options[] = 'includeComputedIntermediaries';
$retrieval_setting_options[] = 'includeAllIntermediaries';
$retrieval_setting_options[] = 'includeNoIntermediaries';



function myUrlDecode ($url) {
	return(urldecode($url));
	//return(preg_replace('/_p_/', '#', $url));
}

function myUrlEncode ($url) {
//	return(urlencode($url));
	return(preg_replace('/#/', '%23', $url));
}

function getSettings($ontology_abbrv) {
	global $driver, $host, $username, $password, $database;
	$settings = array();
	$strSql= "select * from ontology where ontology_abbrv='$ontology_abbrv'";
	$db = ADONewConnection($driver);
	$db->Connect($host, $username, $password, $database);
	
	$row = $db->GetRow($strSql);
	if(!empty($row)) {
		$settings['ontology_name'] = $row['ontology_abbrv'];
		$settings['ontology_fullname'] = $row['ontology_fullname'];
		$settings['ns_main'] = $row['ontology_graph_url'];
		$settings['ns_main_original'] = $row['ontology_url'];
		$settings['remote_store_endpoint'] = $row['end_point'];
	}
	
	$settings['ns_rdf'] = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
	$settings['ns_rdfs'] = 'http://www.w3.org/2000/01/rdf-schema#';
	$settings['ns_owl'] = 'http://www.w3.org/2002/07/owl#';
	
	$settings['base_oboInOwl'] = 'http://www.geneontology.org/formats/oboInOwl#';
	
	
	$settings['core_terms'] = array();
	$strSql= "select * from key_terms where ontology_abbrv='$ontology_abbrv' ORDER BY term_label";
	$results = $db->GetAll($strSql);
	
	if ($results!=false) {
		foreach($results as $result) {
			if ($result['is_root']==1) {
				$settings['core_terms'][$result['term_url']]=$result['term_label'] .' (root class)';
			}
			else {
				$settings['core_terms'][$result['term_url']]=$result['term_label'];
			}
		}
	}
	
	
	return($settings);
}

function UTF_to_Unicode($input, $array=False) {

 $bit1  = pow(64, 0);
 $bit2  = pow(64, 1);
 $bit3  = pow(64, 2);
 $bit4  = pow(64, 3);
 $bit5  = pow(64, 4);
 $bit6  = pow(64, 5);
 
 $value = '';
 $val   = array();
 
 for($i=0; $i< strlen( $input ); $i++){
 
     $ints = ord ( $input[$i] );
    
     $z = ord ( $input[$i] );

     if( $ints >= 0 && $ints <= 127 ){
        // 1 bit
        //$value .= '&#'.($z * $bit1).';';
		$value .= htmlentities($input[$i]);
        $val[]  = $value;
     }
     if( $ints >= 192 && $ints <= 223 ){
        $y = ord ( $input[$i+1] ) - 128;
        // 2 bit
        $value .= '&#'.(($z-192) * $bit2 + $y * $bit1).';';
        $val[]  = $value;
     }   
     if( $ints >= 224 && $ints <= 239 ){
        $y = ord ( $input[$i+1] ) - 128;
        $x = ord ( $input[$i+2] ) - 128;
        // 3 bit
        $value .= '&#'.(($z-224) * $bit3 + $y * $bit2 + $x * $bit1).';';
        $val[]  = $value;
     }    
     if( $ints >= 240 && $ints <= 247 ){
        $y = ord ( $input[$i+1] ) - 128;
        $x = ord ( $input[$i+2] ) - 128;
        $w = ord ( $input[$i+3] ) - 128;
        // 4 bit
        $value .= '&#'.(($z-240) * $bit4 + $y * $bit3 + $x * $bit2 + $w * $bit1).';';
        $val[]  = $value;       
     }    
     if( $ints >= 248 && $ints <= 251 ){
        $y = ord ( $input[$i+1] ) - 128;
        $x = ord ( $input[$i+2] ) - 128;
        $w = ord ( $input[$i+3] ) - 128;
        $v = ord ( $input[$i+4] ) - 128;
        // 5 bit
        $value .= '&#'.(($z-248) * $bit5 + $y * $bit4 + $x * $bit3 + $w * $bit2 + $v * $bit1).';';
        $val[]  = $value;  
     }
     if( $ints == 252 && $ints == 253 ){
        $y = ord ( $input[$i+1] ) - 128;
        $x = ord ( $input[$i+2] ) - 128;
        $w = ord ( $input[$i+3] ) - 128;
        $v = ord ( $input[$i+4] ) - 128;
        $u = ord ( $input[$i+5] ) - 128;
        // 6 bit
        $value .= '&#'.(($z-252) * $bit6 + $y * $bit5 + $x * $bit4 + $w * $bit3 + $v * $bit2 + $u * $bit1).';';
        $val[]  = $value;
     }
     if( $ints == 254 || $ints == 255 ){
       echo 'Wrong Result!<br>';
     }
    
 }
 
 if( $array === False ){
    return $unicode = $value;
 }
 if($array === True ){
     $val     = str_replace('&#', '', $value);
     $val     = explode(';', $val);
     $len = count($val);
     unset($val[$len-1]);
    
     return $unicode = $val;
 }
 
}


//Reformat a construction SPARQL query to make it shorter by using prefix.
function formatQuery($strSparql) {
	list($str_prefix, $str_body) = preg_split('/CONSTRUCT/', $strSparql);
	$array_prefix=array();
	preg_match_all('/<(http:\/\/.+?)>/', $str_body, $matches);
	if (sizeof($matches[1])>0) {
		$i=0;
		foreach ($matches[1] as $match) {
			$pos = strrpos($match, '#');
			if ($pos===false) {
				$pos = strrpos($match, '/');
			}
			if($pos!==false) {
				$tmp_prefix = substr($match, 0, $pos+1);
				if (!in_array($tmp_prefix, $array_prefix)) {
					$i++;
					$array_prefix['p_'. $i]=$tmp_prefix;
				}
			}
		}
		
		arsort($array_prefix);
		
		foreach($array_prefix as $prefix => $tmp_iri) {
			$str_prefix = "prefix $prefix: <$tmp_iri>\n" . $str_prefix;
			$str_body = str_replace('<'.$tmp_iri, $prefix.':', $str_body);
			
		}
		
		$str_body = preg_replace('/(p_\d+:\S*)>/', '$1', $str_body);
		
	}
	return(preg_replace('/[\r\n]+/', "\n", $str_prefix.'CONSTRUCT'.$str_body));
}

//Reformat a construction SPARQL query to make it shorter by using prefix.
function formatQuerySelect($strSparql) {
	list($str_prefix, $str_body) = preg_split('/SELECT/i', $strSparql, 2);
	$array_prefix=array();
	preg_match_all('/<(http:\/\/.+?)>/', $str_body, $matches);
	if (sizeof($matches[1])>0) {
		$i=0;
		foreach ($matches[1] as $match) {
			$pos = strrpos($match, '#');
			if ($pos===false) {
				$pos = strrpos($match, '/');
			}
			if($pos!==false) {
				$tmp_prefix = substr($match, 0, $pos+1);
				if (!in_array($tmp_prefix, $array_prefix)) {
					$i++;
					$array_prefix['p_'. $i]=$tmp_prefix;
				}
			}
		}
		
		arsort($array_prefix);
		
		foreach($array_prefix as $prefix => $tmp_iri) {
			$str_prefix = "prefix $prefix: <$tmp_iri>\n" . $str_prefix;
			$str_body = str_replace('<'.$tmp_iri, $prefix.':', $str_body);
			
		}
		
		$str_body = preg_replace('/(p_\d+:\S*)>/', '$1', $str_body);
		
	}
	return(preg_replace('/[\r\n]+/', "\n", $str_prefix.'SELECT'.$str_body));
}



//Generate a random string of certain length
function createRandomPassword($chars = "abcdefghijkmnopqrstuvwxyz023456789", $length=8) {
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i < $length) {
		$num = rand() % strlen($chars);
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;    
	}    
	return $pass;
}

//Use curl to do a post request
function curl_post_contents($url, $fields) {
	//open connection
	$ch = curl_init();
	
	if (strpos($url, '.bioontology.org/sparql')!==false) $fields['apikey']='e88ab994-8670-4613-98af-d96b73b6f775';
	
//	print_r($fields);
	$fields_string = http_build_query($fields);
	
//	print($fields_string);
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	
	//execute post
	$result = curl_exec($ch);
	
	if ($result===false) {
		error_log('Curl error: ' . curl_error($ch));
	}
	
	//close connection
	curl_close($ch);
	
	return(trim($result));
}


//Use curl to do multithreading post requests
function curl_multi_post_contents($url, $a_fields) {
	// create the multi curl handle
	$mh = curl_multi_init();
	$handles = array();
	$a_result = array();
	
	foreach($a_fields as $fields_key => $fields){
		if ($url=='http://sparql.bioontology.org/sparql/') $fields['apikey']='e88ab994-8670-4613-98af-d96b73b6f775';
		// create a new single curl handle
		$ch = curl_init();
		
		$fields_string = http_build_query($fields);
		// setting several options like url, timeout, returntransfer
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		
		// add this handle to the multi handle
		curl_multi_add_handle($mh,$ch);
		
		// put the handles in an array to loop this later on
		$handles[$fields_key] = $ch;
	}
	
	// execute the multi handle
	$running=NULL;
	do {
		curl_multi_exec($mh,$running);
		// added a usleep for 0.01 seconds to reduce load
		usleep (1000);
	} while ($running > 0);
	
	// get the content of the urls (if there is any)
	foreach($handles as $fields_key => $handle)	{
		// get the content of the handle
		$a_result[$fields_key] = curl_multi_getcontent($handle);
		
		// remove the handle from the multi handle
		curl_multi_remove_handle($mh,$handle);
	}
	
	// close the multi curl handle to free system resources
	curl_multi_close($mh);	
	
	return($a_result);
}

function parse_json_query($str_json){
	$json = json_decode($str_json, true);
	$results = array();
	if (isset($json['results']['bindings'])){
		foreach ($json['results']['bindings'] as $binding) {
			$result = array();
			foreach ($binding as $key=>$value) {
				$result[$key] = $value['value'];
			}
			$results[] = $result;
		}
	}

	return($results);
}




function json_query($querystring, $endpoint='http://sparql.hegroup.org/sparql'){
	$fields = array();
	$fields['default-graph-uri'] = '';
	$fields['format'] = 'application/sparql-results+json';
	$fields['debug'] = 'on';
	$fields['query'] = $querystring;
	
	
//error_log($querystring, 3, '/tmp/error.log');
	$json = curl_post_contents($endpoint, $fields);
	
	return (parse_json_query($json));
}


//A class for some basic input checking
class Validation{
	var $request;
	var $strErrorMsg;
	
	function Validation($request){
		$this->request=$request;
	}
	
	function getInput($strInput,$strCName, $intMin, $intMax, $toTrim = true) {
		$blflag=True;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		
		if ($toTrim) {
			$strTmp=trim($strTmp);
		}


		if (strlen($strTmp)>$intMax) {
			$blflag=False;
			$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
		}
		
		if (strlen($strTmp)<$intMin) {
			if ($strTmp=='') {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " is required<br>" ;
			}
			else {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
			}
		}

		return $strTmp;
	}

	function getArray($strInput ,$strCName, $isRequired = true) {
		$blflag=True;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}

		if (!is_array($strTmp)){
			$blflag=False;
		}

		if ($blflag==False && $isRequired==True)
			$this->strErrorMsg=$this->strErrorMsg . $strCName . " is required<br>" ;
		return $strTmp;
	}

	function getAccount($strInput,$strCName, $isRequired = true) {
		$intMax=20;
		$intMin=3;
		$blflag=True;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		$strTmp=trim($strTmp);

		if (strlen($strTmp)>$intMax) {
			$blflag=False;
			$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
		}
		
		if (strlen($strTmp)<$intMin) {
			$blflag=False;
			$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
		}

		$regex = '/^[^ ,\']+$/';
		if (preg_match($regex, $strTmp)) {
			$blflag = true;
		}
		else {
			$blflag = false;
			$this->strErrorMsg=$this->strErrorMsg . $strCName . " contains illegal charactors (Space, comma or apostrophe) <br>" ;
		}

		return $strTmp;
	}

	function getPhone($strInput, $strCName, $isRequired = false) {
		$blflag=True;
		$intMax=20;
		$intMin=5;

		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		$strTmp=trim($strTmp);


		$strAllow="0123456789-,.() ";

		if ($isRequired==True || strlen($strTmp)>0 ){
			if (strlen($strTmp)>$intMax) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
			}
			
			if (strlen($strTmp)<$intMin) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
			}
	
			$regex = '/^[\d -_,\(\)\.]+$/';
			if (preg_match($regex, $strTmp)) {
				$blflag = true;
			}
			else {
				$blflag = false;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " contains illegal charactors (allowed charactors are: \"0123456789 -,.()\") <br>" ;
			}
		}

		return $strTmp;
	}

	function getEmail($strInput,$strCName,$isRequired = true) {
		$blflag=True;
		$intMax=50;
		$intMin=5;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		$strTmp=trim($strTmp);

		if ($isRequired==True || strlen($strTmp)>0 ){
			if (strlen($strTmp)>$intMax) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
			}
			
			if (strlen($strTmp)<$intMin) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
			}
	
			//$regex = '/^[\d-_\w\.@]{5,10}$/';
			$regex = '&^(?:                                               # recipient:
         ("\s*(?:[^"\f\n\r\t\v\b\s]+\s*)+")|                          #1 quoted name
         ([-\w!\#\$%\&\'*+~/^`|{}]+(?:\.[-\w!\#\$%\&\'*+~/^`|{}]+)*)) #2 OR dot-atom
         @(((\[)?                     #3 domain, 4 as IPv4, 5 optionally bracketed
         (?:(?:(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:[0-1]?[0-9]?[0-9]))\.){3}
               (?:(?:25[0-5])|(?:2[0-4][0-9])|(?:[0-1]?[0-9]?[0-9]))))(?(5)\])|
         ((?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)*[a-z](?:[-a-z0-9]*[a-z0-9])?))  #6 domain as hostname
         $&xi';
			if (preg_match($regex, $strTmp)) {
				$blflag = true;
			}
			else {
				$blflag = false;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " does not look like an real eamil address<br>" ;
			}
		}

		return $strTmp;
	}

	function getZipCode($strInput, $strCName, $isRequired = false) {
		$blflag=True;
		$intMax=10;
		$intMin=5;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		$strTmp=trim($strTmp);

		if ($isRequired==True || strlen($strTmp)>0 )	{
			if (strlen($strTmp)>$intMax) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
			}
			
			if (strlen($strTmp)<$intMin) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
			}

			if (preg_match('/^[\w-]+$/', $strTmp)) {
				$blflag = true;
			}
			else {
				$blflag = false;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " contains illegal charactors (allowed charactors are: \"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-\") <br>" ;
			}
		}

		if ($blflag==False)
			$this->strErrorMsg=$this->strErrorMsg . $strCName . "<br>" ;
		return $strTmp;
	}

	function getNumber($strInput, $strCName, $intMin, $intMax, $isRequired = false) {
		$blflag=True;
		if (array_key_exists($strInput, $this->request)) {
			$strTmp=$this->request[$strInput]; 
		}
		else {
			$strTmp='';
		}
		$strTmp=trim($strTmp);
		
		if ($isRequired==True || strlen($strTmp)>0 )	{
			if (strlen($strTmp)>$intMax) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too long (maximum length: $intMax)<br>" ;
			}
			elseif (strlen($strTmp)<$intMin) {
				$blflag=False;
				$this->strErrorMsg=$this->strErrorMsg . $strCName . " too short (minimum length: $intMin)<br>" ;
			}
			else {
				$strReg = '/^[\d-\.]+$/';
				if (!preg_match($strReg, $strTmp)) {
					$blflag = false;
					$this->strErrorMsg=$this->strErrorMsg . $strCName . " contains illegal charactors<br>" ;
				}
			}
		}

		return $strTmp;
	}
  
	function concatError($strError) {
		$this->strErrorMsg .= $strError . "<br>" ;
	}
  
	function getErrorMsg(){
		return $this->strErrorMsg;
	}
}
?>
