<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log','../_docs/errors/errors_support.log');

$environment     = "WEB"; // WEB or LCL
$sendToWho       = "PUNKY"; // PUNKY or PETER
$punkyEmail      = "marjorie@nomasinternational.org";
$peterEmail      = "peterbe@verizon.net";
$sendToEmail     = ($sendToWho == "PETER")? $peterEmail : $punkyEmail;

$db_pword        = "Edzp0DyR7H";
$pw_salt         = "DiN#l1h-Z53@7_29x"; // salt for passwords

// JQuery meta links
$jq_google         = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
$jq_ui             = '<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet"  />
                      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>';
$jq_slidemenu     = '<script type="text/javascript" src="../_js/jquery.slidemenu.js"></script>';
$jq_tablesorter   = '<script type="text/javascript" src="../_js/jquery.tablesorter.min.js"></script>';
$cms_spry         = '<script type="text/javascript" src="../_js/spry.js"></script>';
//require_once "../_vibralogix/slpw/sitelokapi.php";


// PUNKY-NEW SUPPORT
// *********************************************************************
// *********************************************************************
// *********************************************************************

// TABLE NAMES
$loginTBL          = "apps_login";
$activityTBL       = "apps_activity";
$trainingSitesTBL  = "apps_trainingsites";
$trainingDatesTBL  = "apps_trainingdates";
$practitionersTBL  = "apps_practitioners";
$testskedTBL       = "apps_testsked_users";
$ceuordersTBL      = "ceu_orders";
$ceuproductsTBL    = "ceu_products";
$ceuusersTBL       = "ceu_users";
$ceuquizzesTBL     = "ceu_quizzes";
$ceuresultsTBL     = "ceu_results";
$ceuobjectivesTBL  = "ceu_objectives";
$sitelokTBL        = "sitelok";

// SITE PAGES
$quit              = "index_exit.php";
$loginPage         = "index.php";
$homeMenuPage      = "index_cms_home.php";
$membersMain       = "index_app_licensees.php";
$membersList       = "index_app_licensees_list.php";
$membersEdit       = "index_app_licensees_edit.php";
$membersAdd        = "index_app_licensees_add.php";
$testskedMain      = "index_app_testsked.php";
$testskedAdd       = "index_app_testsked_add.php";
$testskedEdit      = "index_app_testsked_edit.php";
$testskedolceuMain = "index_app_testsked_olceu_list.php";
$testskedolceuEdit = "index_app_testsked_olceu_edit.php";
$trainingskedMain  = "index_app_trainingsked.php";
$trainingskedEDIT  = "index_app_trainingsked_edit.php";
$trainingskedADD   = "index_app_trainingsked_add.php";

// Security / Page Access

$lvl_1           = "1"; // user-level user page
$lvl_2           = "2"; // admin-level user page
$u_lvl_min       = "1"; // minimum user level available for this version of this app
$u_lvl_max       = "2"; // maximum user level available for this version of this app

// Reliability test number range
$min_test_num    = "2"; // lowest numbered reliability/licensing test
$max_test_num    = "5"; // highest numbered reliability/licensing test
$rlli_numbers    = "2, 3 or 4, 5";
$rlli_array      = array('2','3','4','5');

// VARIOUS VARS
$today           = date("Y-m-d");
$thisYear        = date("Y");

$logo_main       = "_grafix/logo-nomas-big.png";
$logo_small      = "_grafix/logo-nomas-small.png";

$topNav          = $leftNav = $footer = '';
$errorMsg        = "";
$searchTitle     = 'SEARCH: Last Name, Letter, Year or License #:&nbsp;&nbsp;';

// *************************************************************************************************************
// ******************** retrieve and return session token ******************************************************
// *************************************************************************************************************

function getToken() {
	
	$u_token = (isset($_SESSION['cms']['u_token']) && $_SESSION['cms']['u_token'] > '' ) ? $_SESSION['cms']['u_token'] : '';
	return $u_token;
}

// *************************************************************************************************************
// ******************** each page checked for session status and user access level *****************************
// *************************************************************************************************************

function check_permission($page_level, $u_token) {

  if( $_SESSION['cms']['u_token'] !== $u_token ) {
    log_out(); // logout if token has changed since initially set at login
  }  
  
  if( $_SESSION['cms']['u_level'] < $page_level ) {
    log_out(); // logout if unser-level is inappropriate for the particular page
  }  
  
}

// *************************************************************************************************************
// ********************************* LOGIN TO APPLICATION ******************************************************
// *************************************************************************************************************

function cms_login($hash) {  
global $loginTBL, $activityTBL, $homeMenuPage, $loginPage, $u_lvl_min, $u_lvl_max, $today, $pw_salt;
  
  $form_vals = array_map('trim', $hash);  
 
  // validate length
  if(strlen($form_vals['fname']) > 20 || strlen($form_vals['lname']) > 20 ) {
	 return "Please try again 1";
	 exit;
  }
  
  // validate length
  if(strlen($form_vals['password']) > 16 ) {
	 return "Please try again 2";
	 exit;
  }    
  
  // strip html tags from fname,lname; encrypt pword for comparison to stored pword  
  $form_vals = array_map('strip_tags',$form_vals);
  //hash('sha256', str_replace(" ", "", $form_vals['password']) . $pw_salt);

  // connect to db
  if(!$link = db_connect_site()) {
	  return "Temporarily unavailable. Please try again later.";
      exit;
  }  
  
  // define & send query
  $sql = "SELECT * FROM $loginTBL WHERE fname='{$form_vals['fname']}' AND lname='{$form_vals['lname']}' AND pword='{$form_vals['password']}' LIMIT 1";		  
  if($result = mysqli_query($link,$sql)) {  						  					 
     while ($row = mysqli_fetch_assoc($result)) {        
	    $fname = $row['fname'];
        $lname = $row['lname'];		
        $level = is_numeric($row['level']) ? $row['level'] : '0';
     }
	 
  } else {
	  
     return 'Please try again 3';
     exit;
	 
  }  
			 
  // if User Level has not been previously entered or is not "1" or "2", don't log in
  if ( $level < $u_lvl_min || $level > $u_lvl_max ) {
	return 'Sorry, not able to log you in.';
	exit;
  }	 

  $remoteAddress = $_SERVER['SERVER_ADDR'];
  $serverAddress = $_SERVER['REMOTE_ADDR'];      			
			
  // save user and user-level to SESSIONS  
  $uuid = makeSecureUUID();
  $_SESSION['cms']['u_token'] = $uuid;
  $_SESSION['cms']['u_name']  = $name = $fname . " " . $lname;
  $_SESSION['cms']['u_level'] = $level;
  $action = 'ON';    
  $when   = date("Y-m-d H:i:s");    
  
  // insert login into Usage Table
  $name  = mysqli_real_escape_string($link,$name);  
  
  $sql = "INSERT INTO `$activityTBL` (uuid,name,entered,server_addr,remote_addr,action) VALUES ('$uuid','$name','$when','$serverAddress','$remoteAddress','$action')";
  if(!$result = mysqli_query($link,$sql)) {
     return "Activity storage problem"; exit; }
   
  $gotoPage = ($level > $u_lvl_min) ? $homeMenuPage : $loginPage;     	  
  header("Location: $gotoPage");
  exit;
 
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function log_out() {
global $loginPage, $activityTBL;
	
  $logout_url    = $loginPage;	
  $name          = $_SESSION['cms']['u_name'];
  $uuid          = $_SESSION['cms']['u_token'];
  $remoteAddress = $_SERVER['SERVER_ADDR'];
  $serverAddress = $_SERVER['REMOTE_ADDR'];    
  $action        = "OFF";
  $when          = date("Y-m-d H:i:s");
  
  // insert login into Usage Table
  if($link = db_connect_site()) {
     $name  = mysqli_real_escape_string($link,$name);  
     if($result = mysqli_query($link,"INSERT INTO $activityTBL (uuid, name, entered, server_addr, remote_addr, action) 
                                      VALUES ('$uuid', '$name', '$when', '$serverAddress', '$remoteAddress', '$action')"));
     db_disconnect($link);
  }
									  
  $_SESSION['cms'] = array();
  session_destroy();
  header("location: $logout_url");
  exit;  
}	 

// *************************************************************************************************************
// **************** CREATES UNIQUE RFC SECURE STRING 32 HEX CHARS and 4 HYPHENS IN LENGTH **********************
// ************************************************************************************************************* 

function makeSecureUUID() {

   if (function_exists('com_create_guid') === true) {
      return trim(com_create_guid(), '{}');
   }
   
   return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
          mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

// *************************************************************************************************************
// ********************************* GENERATE RANDOM SALT VALUE ************************************************
// *************************************************************************************************************

function makeSalt() {
    $string = md5(uniqid(rand(), true));
    return substr($string, 0, 3);
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function unSession() {
	
   if (isset($_SESSION['cms']['evid']))	{
       unset($_SESSION['cms']['evid']);
   }
   if (isset($_SESSION['cms']['gid']))	{
       unset($_SESSION['cms']['gid']);	
   }
}	 

//*****************************************************************
//*****************************************************************
//*****************************************************************

function cms_add_admin($hash,$nextPage) {  
global $loginTBL, $pw_salt, $today;
  
  $form_vals = array_map('trim', $hash);    
  $link      = db_connect();  
  $form_vals = realEscape($form_vals, $link);
  
  $form_vals['password'] = sha1($pw_salt . $form_vals['password']);
  
  // see if already in the database
  $result = mysql_query("SELECT COUNT(*) AS count FROM $loginTBL WHERE fname='{$form_vals['fname']}' AND lname='{$form_vals['lname']}' AND pword='{$form_vals['password']}'");  
  
  if(!$result){
    return "System unavailable.";
	exit;
  }	
  
  $row = mysql_fetch_assoc($result);
  
  if($row['count'] > 0 ) {  
    return "User already exists.";
	exit;
  }	
  
  $result = mysql_query("INSERT INTO $loginTBL (id,in_date,fname,lname,pword,level) 
                         VALUES (
						 NULL,
						 '$today',
						 '{$form_vals['fname']}',
						 '{$form_vals['lname']}',
						 '{$form_vals['password']}',
						 '{$form_vals['level']}' 
						 )"
						 );
  
  if(mysql_affected_rows() <> 1 ) {
    return "Problem creating user.";
	exit;
  }	
			
  db_disconnect($link);  			
  
  header("Location: $nextPage");
  exit;
}


//*****************************************************************
//*****************************************************************
//*****************************************************************

function realEscape($hash,$link) {   


  if (!get_magic_quotes_gpc()) {
    while (list($key, $value) = each($hash)) {
      if (!is_array($value)) {
        $hash[$key] = mysqli_real_escape_string($link, $value);
      } else {
        $clean_array = array();
        foreach ($value as $val) {
          $clean_array[]  = mysqli_real_escape_string($link,$val);
          $hash[$key] = $clean_array;
        } 
      }
    }
  }	else {
    while (list($key, $value) = each($hash)) {
      if (!is_array($value)) {
        $hash[$key] = addslashes($value);
      } else {
        $clean_array = array();
        foreach ($value as $val) {
          $clean_array[]  = addslashes($val);
          $hash[$key] = $clean_array;
        } 
      }
    }	  
  }	  	  
  return $hash;  
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function flatten(array $array) {
	
    $result = array();

    if (is_array($array)) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $result = array_merge($result, flatten($v));
            } else {
                $result[] = $v;
            }
        }
    }

    return $result;
}
// *********************************************************
// ******************* SHOW LOGOS***************************
// *********************************************************

function showSmallLogo() {
global $logo_small;

   $logo = '';
   if(is_file($logo_small)) {	
      $logo = "<img src=" . "'" . $logo_small . "'" . " id='logo' name='logo' alt='logo' title='Home Page'>";
   }
   echo $logo;  
}

function showBigLogo() {
global $logo_main;

   $logo = '';
   if(is_file($logo_main)) {	
      $logo = "<img src=" . "'" . $logo_main . "'" . " id='logo' name='logo' alt='logo' title='Home Page'>";
   }
   echo $logo;  
}

// *********************************************************
// ******************* SHOW LOGO ***************************
// *********************************************************

function showCopyright($thisYear) {
   $copy = "<div class='copy'>Copyright &copy; 2008-" . $thisYear . " Marjorie Meyer Palmer</div";  
   echo $copy;  
}

// *********************************************************
// ***************** FORMAT PHONE NUMBER *******************
// *********************************************************

function formatPhone($num) {
	
   $num = preg_replace('/[^0-9]/', '', $num); 
   $len = strlen($num);
   
   if($len == 7)
      $num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $num);
   elseif($len == 10)
      $num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '$1-$2-$3', $num);
 
   return $num;
   exit;
}

// *********************************************************
// ***************** DIFFERENCE BETWEEN TWO DATES***********
// *********************************************************

function dateDiff($start, $end) {
	
  $start_ts = strtotime($start);
  $end_ts   = strtotime($end);
  $diff     = $end_ts - $start_ts;
  return round($diff / 86400);
}

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function db_connect_site() {
global $environment,$db_pword;
   
   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_punkysite";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases."; }
}

//**************************************************************************************************

function db_connect_smf() {
global $environment,$db_pword;

   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_smf";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_smf";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases."; }
}

//**************************************************************************************************

function db_connect_sitelok() {
global $environment,$db_pword;

   if($environment == "LCL") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_sitelokpw";
      $g_db_username = "root";
      $g_db_password = "";
   } elseif($environment == "WEB") {
      $g_db_hostname = "localhost";
      $g_db_name     = "nomasint_sitelokpw";
      $g_db_username = "nomasint_s0r3n";
      $g_db_password = $db_pword;
   }
	  	   
   if($link = mysqli_connect($g_db_hostname, $g_db_username, $g_db_password, $g_db_name)) {
      mysqli_set_charset($link, 'utf8'); 
      return $link;
   } else { return "Cannot connect to databases. Please try again later"; }
}

//**************************************************************************************************

function db_disconnect($link) {
  mysqli_close($link);
}

?>