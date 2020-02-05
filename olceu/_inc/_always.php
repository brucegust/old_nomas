<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log','../_docs/errors/errors_olceu.log');
date_default_timezone_set('America/Los_Angeles');

$environment = "WEB"; // WEB or LCL
$sendToWho   = "PUNKY"; // PUNKY or PETER
$punkyEmail  = "marjorie@nomasinternational.org";
$peterEmail  = "peterbe@verizon.net";
$sendToEmail = ($sendToWho == "PETER")? $peterEmail : $punkyEmail;

// Admin accounts can always view materials (don't expire)
$adminsDontExpire = true;
//$adminAccounts = array('joshua.winn@gmail.com','marjorie@nomasinternational.org');
$adminAccounts = array('CourseTest@nomasinternational.org');

// Connect to databases
require_once "../_inc/_connect.php";


// PUNKY - OLCEU
// *********************************************************************
// *********************************************************************
// *********************************************************************

// define email destination
$pleaseContact     = "<a href='http://www.nomasinternational.org/contact.php'>Please contact NOMAS International</a>";

// JQuery & meta links
$jq_google         = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
$jq_ui             = '<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet"  />
                      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>';
$jq_slidemenu      = '<script type="text/javascript" src="../_js/jquery.slidemenu.js"></script>';
$swfobj22          = '<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>';
$jwplayer          = '<script type="text/javascript" src="../_js/jwplayer.js" ></script>';

// PATHS
$logo_main         = "_grafix/logo-nomas-960.jpg";
$ceuHandoutsPath   = "olceu_pdf/";
$ceuQuizPath       = "olceu_quiz/";
$ceuVideoPath      = ($environment == "LCL") ? "olceu_vids/" : "http://web29.streamhoster.com/marjorie/olceu/";
$copyright720      = "_grafix/copyright-nomas-720.jpg";
$renewScoreSheet   = "_docs/nomas_score_sheet_2015.pdf";

// TABLES
$activityTBL       = "apps_activity";
$testskedTBL       = "apps_testsked_users";
$ceuordersTBL      = "ceu_orders";
$ceuproductsTBL    = "ceu_products";
$ceuusersTBL       = "ceu_users";
$ceuquizzesTBL     = "ceu_quizzes";
$ceuresultsTBL     = "ceu_results";
$ceuobjectivesTBL  = "ceu_objectives";

// PAGES
$nomasHomePage     = "../index.php";
$ceuSignInPage     = "index.php";
$ceuHomePage       = "index_ceu.php";
$ceuVideoPage      = "index_olceu_vids.php";
$ceuQuizPage       = "index_quiz.php"; 
$renewHomePage     = "index_renew.php";
$renewLoginPage    = "index_renew_login.php";
$renewVidsPage     = "index_renew_vids.php";

// COURSES & QUIZZES
$all_v_quizzes     = array('v00');
$all_v_courses     = array('v01','v02','v03','v04','v05','v06','v07','v08','v09','v10','v11');
$all_s_quizzes     = array('s01','s02','s03','s04','s05','s06','s07','s08','s09','s10','s11','s12');
$all_s_courses     = array('s01','s02','s03','s04','s05','s06','s07','s08','s09','s10','s11','s12');
$all_cpf_courses   = array('cpf01','cpf01');
$all_quizzes       = array('v00','s01','s02','s03','s04','s05','s06','s07','s08','s09','s10','s11','s12');
$all_courses       = array('v01','v02','v03','v04','v05','v06','v07','v08','v09','v10','v11','s01','s02','s03','s04','s05','s06','s07','s08','s09','s10','s11','s12');
$all_products      = array('p01','p02','p03','p04','p05');

// MISC
$today             = date("Y-m-d");
$thisYear          = date("Y");
$minTestNum        = "2";
$maxTestNum        = "5";
$errorMsg          = "";
$topNav            = "";


//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function getToken() {

    $token = '';
	if(isset($_SESSION['u_token']) && !empty($_SESSION['u_token'])) 
	   $token = $_SESSION['u_token'];		   
    return $token;
	exit;
}

//**************************************************************************************************
//******************** each page checked for session status and user access level ******************
//**************************************************************************************************

function check_permission($u_token) {
global $nomasHomePage;

   if(isset($_SESSION['u_name']) && !empty($_SESSION['u_name']) && isset($_SESSION['u_token']) && !empty($_SESSION['u_token']) && $_SESSION['u_token'] == $u_token ) {
      return true; 
	  exit;
   }
   $_SESSION = array();
   session_destroy();
   header("Location: $nomasHomePage");
}

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

// RENEW USER LOGIN TO ONLINE CEU
function renew_login($hash) 
{  
  global $testskedTBL, $activityTBL, $renewVidsPage, $minTestNum, $maxTestNum, $today;
  global $adminsDontExpire, $adminAccounts;

  // connect to db?
  if(!$link = db_connect_site()) {
	  return "System Temporarily unavailable. Please try again later.";
      exit;
  }     
  
  $form_vals = array_map("trim",$hash);     
  
  // all fields populated?
  if($form_vals['email'] == '' || $form_vals['order_num'] == '') {
     return 'All fields required';
     exit;  
  }
  
  // is email value in an email format?
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
     return "Please check email format and try again.";
	 exit;
  }  
  
  // validate length
  if( strlen($form_vals['email']) > 100 ) {
	 return "Please check email format and try again.";
	 exit;
  }    
  
  // is order number all numeric?
  if(!is_numeric($form_vals['order_num']) || strlen(trim($form_vals['order_num'])) > 15 ) {
     return "Please check Order Number and try again.";
	 exit;
  }
  
  // look up query
  if(!mysqli_real_escape_string($link,$form_vals['email']))
     $form_vals['email'] = addslashes($form_vals['email']);
	 
  if(!mysqli_real_escape_string($link,$form_vals['order_num']))
     $form_vals['order_num'] = addslashes($form_vals['order_num']);
  
  if($result = mysqli_query($link,"SELECT * FROM $testskedTBL WHERE email='{$form_vals['email']}' AND ordernum='{$form_vals['order_num']}' LIMIT 1")) {  
	 if(mysqli_num_rows($result) == 0) {
		 return "Cannot find you. Please check your entries and try again";
		 exit;
     }	   	 
	 while ($row = mysqli_fetch_assoc($result)) {
		$entered   = $row['entered'];
		$name      = $row['name']; 
		$email     = $row['email'];
		$ordernum  = $row['ordernum'];
		$testnum   = $row['testnum'];
		$weekopen  = $row['weekopen'];
		$weekclose = $row['weekclose'];
		$winopen   = $row['winopen'];
		$winclose  = $row['winclose'];
	 } 
  } else { return "Database temporarily unavailable. Please try again later."; exit; }	
   	    
  // client name found?
  if(!isset($name) || empty($name)) {
	  return "Client name not found.";
	  exit;  
  }
    
  // check that orders exist
  if(!isset($testnum) || empty($testnum)  || !is_numeric($testnum)) {
     return "Test number not found.";
	 exit;
  }
  
  if(isset($testnum) && $testnum < $minTestNum || $testnum > $maxTestNum) {
     return "Test number incorrect.";
	 exit;
  }      
  

  // --------------------- ACCESS PERIOD ---------------------------------------
 
  // Allow admins access if access period has expired. Otherwise, check for expirations
  if ( $adminsDontExpire == false || !in_array($form_vals['email'],$adminAccounts) )
  {
    // check legitimacy of login by access dates
    if(!isset($weekopen) || empty($weekopen)) {
       return "Missing a 'Week Opens' date.";
     exit;
    }
    
    if(!isset($weekclose) || empty($weekclose)) {
       return "Missing a 'Week Closes' date.";
     exit;
    }    
   
    // enter window open value if necessary
    if(!isset($winopen) || empty($winopen) || $winopen == '0000-00-00'){
     $winopen   = date("Y-m-d");
     $winclose  = date("Y-m-d",strtotime("+2 days"));  
     
     if($winopen < $weekopen) {
          return 'Today is ' . date("j M, Y") . '. Your Access Period opens on ' . date_format(date_create($weekopen),"j M, Y");
      exit;
     }
     
     if($winopen > $weekclose) {
          return 'Today is ' . date("j M, Y") . '. Your Access Period closed on ' . date_format(date_create($weekclose),"j M, Y");
      exit;
     }   

       if(!$result = mysqli_query($link,"UPDATE $testskedTBL SET winopen = '$winopen', winclose = '$winclose' WHERE ordernum = '$ordernum' LIMIT 1")) {
        return "Update problem with availability window.";
          exit;      
     }
    }
    
    // if winopen already set, make sure login attempt falls within valid period.
    if($winopen < $weekopen) {
     return 'Today is ' . date("j M, Y") . '. Your Access Period opens on ' . date_format(date_create($weekopen),"j M, Y");
     exit;
    }
    
    if($winopen > $weekclose) {
     return 'Today is ' . date("j M, Y") . '. Your Access Period closed on ' . date_format(date_create($weekclose),"j M, Y");
     exit;
    }  

    // check that the window is still "open"
    $ended = (isset($winclose) && !empty($winclose) && $winclose !== '0000-00-00') ? date_format(date_create($winclose),"l, F jS") : '';  

    if ( $ended == '' || $today > $winclose ) {
       return ($ended == '') ? "Your access period has ended" : "Your access period ended " . $ended;       
     exit;
    } 
  }


  // Create and save SESSION values ---------------------------	 
  $remoteAddress = $_SERVER['REMOTE_ADDR'];
  $serverAddress = $_SERVER['SERVER_ADDR'];      	
  if(!mysqli_real_escape_string($link,$name)) 
     $name = addslashes($name);     
  $u_token = makeSecureUUID();  		  
  // save SESSIONS vars
  $_SESSION['u_token'] = $u_token;
  $_SESSION['u_name']  = $name;
  $_SESSION['u_sid']   = $ordernum;
  $entered = date("Y-m-d H:i:s");  
  $action  = 'ON';    
    
  // Insert login into Usage Table ---------------------------  
  $sql = "INSERT INTO `$activityTBL` (id,uuid,sid,name,entered,server_addr,remote_addr,action) VALUES (NULL,'$u_token','$ordernum','$name','$entered','$serverAddress','$remoteAddress','$action')";
  if(!$result = mysqli_query($link,$sql)) {
	//echo "<br>Problem storing avtivity. Errorcode: " . mysqli_errno($link);  
	//exit;
  };
  
  // REDIRECT PAGE ---------------------------  
  $sid   = (isset($_SESSION['u_sid']) && $_SESSION['u_sid'] > '' ) ? $_SESSION['u_sid'] : '';
  $redir = $renewVidsPage . "?sid=$sid";  
  header("Location: $redir");
  exit;
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function renew_logout() {
global $renewLoginPage, $activityTBL;

  $name          = $_SESSION['u_name'];
  $uuid          = $_SESSION['u_token'];
  $sid           = $_SESSION['u_sid'];
  
  $remoteAddress = $_SERVER['REMOTE_ADDR'];
  $serverAddress = $_SERVER['SERVER_ADDR'];    
  $action        = "OFF";
  $entered       = date("Y-m-d H:i:s");
  
  // insert login into Usage Table
  if($link = db_connect_site()) {
	 $sql = "INSERT INTO `$activityTBL` (id,uuid,sid,name,entered,server_addr,remote_addr,action) VALUES (NULL,'$uuid','$sid','$name','$entered','$serverAddress','$remoteAddress','$action')"; 
     if($result=mysqli_query($link,$sql)); 
        db_disconnect($link);
  }

  unset($_SESSION['u_name']);
  unset($_SESSION['u_token']);
  unset($_SESSION['u_sid']); 	
  unset($u_token);
  
  $_SESSION = array();
  session_destroy();
  header("Location: $renewLoginPage");
  exit;  
}	 

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

// LOG IN TO VIEW ORDERED MATERIALS - ONLINE CONTINUING EDUCATION
// User attemping log in with email and order number (/olceu/index.php)
function olce_login($hash) 
{  
  global $ceuusersTBL, $activityTBL, $ceuHomePage, $pw_salt, $today;
  global $adminsDontExpire, $adminAccounts;

  // connect to db?
  if(!$link = db_connect_site()) {
	  return "System Temporarily unavailable. Please try again later.";
      exit;
  }     

  $form_vals = array_map("trim",$hash);   
  
  // all fields populated?
  if($form_vals['email'] == '' || $form_vals['order_num'] == '') {
     return 'All fields required';
     exit;  
  }
  
  // is order number all numeric?
  if(!is_numeric($form_vals['order_num']) || strlen($form_vals['order_num']) > 10) {
     return "Please check entries and try again.";
	 exit;
  }
  
  // is email value in an email format?
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $form_vals['email'])) {
     return "Please check email format and try again.";
	 exit;
  }  
  
  // validate length
  if( strlen($form_vals['email']) > 100 ) {
	 return "Please check email format and try again.";
	 exit;
  }  
  
  if($form_vals['occupation'] > '') {
     if(strlen($form_vals['occupation']) > 100 ) {
	    return "Please shorten entry for Occupation and try again.";
	    exit;	  
	 }
  }
  
  // look up query
  if(!mysqli_real_escape_string($link,$form_vals['email']))
     $form_vals['email'] = addslashes($form_vals['email']);	 
  
  if($result = mysqli_query($link,"SELECT * FROM $ceuusersTBL WHERE email='{$form_vals['email']}' AND orderno='{$form_vals['order_num']}' LIMIT 1")) {  
	 if(mysqli_num_rows($result) == 0) {
		 return "Cannot find you. Please check your entries and try again";
		 exit;
     }	

	 while ($row = mysqli_fetch_assoc($result)) {   
		$orderno     = $row['orderno'];
		$name        = $row['name'];
		$orderstatus = $row['orderstatus'];
		$occupation  = strtoupper($row['occupation']);
		$sid         = $row['sid'];
		$itemnumber  = explode("|",$row['itemnumber']);
		$wopen       = $row['winopen'];
		$wclose      = $row['winclose'];
	 } 
  } else { return "Database temporarily unavailable. Please try again later."; exit; }	 
  
  // check for or create SID
  if(!isset($sid) || empty($sid) ) {
	 $sid = (function_exists('sha1')) ? sha1($orderno.$pw_salt) : md5($orderno.$pw_salt);
  }   	      
  
  // if occupation info is not currently stored, return if occupation info is not in the form data, otherwise set $occupation to form field data.
  if(!isset($occupation) || empty($occupation)) { 
     // check login form to see if occupation info is included; store it if so  
	 if(!isset($form_vals['occupation']) || empty($form_vals['occupation'])) { 	 
        return "Please provide your occupation for CEU credit.";
        exit;	 		
	 }
  }
  
  // create window open/close values if necessary
  if(!isset($wopen) || empty($wopen) || $wopen == '0000-00-00') {
	 $wopen  = date("Y-m-d");
	 $wclose = date("Y-m-d",strtotime("+7 days"));  
  }

  // ACCESS PERIOD --------
  // Allow admins access if access period has expired. Otherwise, check for expirations
  if ( $adminsDontExpire == false || !in_array($form_vals['email'],$adminAccounts) )
  {
    // create error message in case access period has elapsed
    $ended = (isset($wclose) && !empty($wclose) && $wclose !== '0000-00-00') ? date_format(date_create($wclose),"l, F jS") : '';  

    // test validity of access period. Return if access period has elapsed.
    if ( $ended == '' || $today > $wclose ) {
       return "Your access period ended " . $ended;       
     exit;
    }   
  }
    
  // client name found?
  if(!isset($name) || empty($name)) {
	  return "Client name not found.";
	  exit;  
  }
  
  // order payment status
  if(!isset($orderstatus) || empty($orderstatus) || $orderstatus !== "OK") {
     return "Problem with order status: (" . $orderstatus . "). ";
     exit;	      	  	 					
  }         
  
  // Have courses been ordered?
  if(!isset($itemnumber) || !is_array($itemnumber) || count($itemnumber) < 1) {
     return "Course or product number(s) not found.";
	 exit;
  }    

  // prevent a login if only products (and no courses) are ordered
  // obtain total number of products ordered
  $products = $courses = '0'; 
  foreach($itemnumber as $val) {
	 if(substr($val,0,1) == "p" ) {
	    $products++;
	 }
  } 
   
  // obtain total number of courses ordered 
  foreach($itemnumber as $val) {
	 //if(substr($val,0,1) == "v" || substr($val,0,1) == "s" ) {
	 if(substr($val,0,1) == "v" || substr($val,0,1) == "s"  || substr($val,0,1) == "n"  || substr($val,0,1) == "c") {
	    $courses++;
	 }
  }      
  
  // if products are in the mix, make sure courses are too - otherwise, return to login screen with error 
  if($products > '0') {
	 if($courses == '0') {
	    return "No courses ordered.";
		exit;
	 }
  } 
      
  // ************************
  // STORE IF NECESSARY
  // ************************
  
  // assure that SID is stored  
  if(!$result = mysqli_query($link,"UPDATE $ceuusersTBL SET sid = '$sid' WHERE orderno='$orderno' LIMIT 1")) {
     return "Creation problem: SID.";
     exit;	 
  }	      
  
  // assure that Occupation is stored  
  if(isset($occupation) && !empty($occupation) && isset($form_vals['occupation']) && !empty($form_vals['occupation'])) {	  
     if(strtoupper($occupation) !== strtoupper($form_vals['occupation']) ) {
        if($result = mysqli_query($link,"UPDATE $ceuusersTBL SET occupation = '{$form_vals['occupation']}' WHERE orderno='$orderno' LIMIT 1")) {
		   $occupation = strtoupper($form_vals['occupation']);
		} else { return "Update problem for Occupation 1."; exit; }               		 							
     }	  
	 	  
  } elseif (!isset($occupation) || empty($occupation) && isset($form_vals['occupation']) && !empty($form_vals['occupation'])) { 
  
     if($result = mysqli_query($link,"UPDATE $ceuusersTBL SET occupation = '{$form_vals['occupation']}' WHERE orderno='$orderno' LIMIT 1")) {
	    $occupation = strtoupper($form_vals['occupation']);
     } else { return "Update problem for Occupation 2."; exit; }               		 							
  }	     
  
  // assure that open & close window dates are stored
  if(!$result = mysqli_query($link,"UPDATE $ceuusersTBL SET winopen = '$wopen', winclose = '$wclose' WHERE orderno = '$orderno' LIMIT 1")) {
     return "Update problem with availability windows.";
     exit;  	     
  }  
		 	 
  // Create and save SESSION values	------------------------	 
  $remoteAddress = $_SERVER['REMOTE_ADDR'];
  $serverAddress = $_SERVER['SERVER_ADDR'];      	
  if(!mysqli_real_escape_string($link,$name)) 
     $name = addslashes($name);     
  $u_token = makeSecureUUID();  		  
  // save SESSIONS vars
  $_SESSION['u_token'] = $u_token;
  $_SESSION['u_sid']   = $sid;
  $_SESSION['u_name']  = $name;
  $_SESSION['u_orderno'] = $orderno;
  $entered = date("Y-m-d H:i:s");  
  $action  = 'ON';    
  // Insert login into Usage Table ------------------------
  $sql = "INSERT INTO `$activityTBL` (id,uuid,sid,name,entered,server_addr,remote_addr,action) VALUES (NULL,'$u_token','$sid','$name','$entered','$serverAddress','$remoteAddress','$action')"; 	        	 
  if(!$result = mysqli_query($link,$sql)) {};
  // Redirect page ------------------------
  $the_sid=trim($sid);
  $redir = $ceuHomePage . "?sid=$the_sid&ordno=$orderno";  
  header("Location: $redir");
  exit();
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function log_out() {
global $ceuSignInPage, $activityTBL;

  $name          = $_SESSION['u_name'];
  $uuid          = $_SESSION['u_token'];
  $sid           = $_SESSION['u_sid'];
  
  $remoteAddress = $_SERVER['REMOTE_ADDR'];
  $serverAddress = $_SERVER['SERVER_ADDR'];    
  $action        = "OFF";
  $entered       = date("Y-m-d H:i:s");
  
  // insert login into Usage Table
  if($link = db_connect_site()) {
	 $sql = "INSERT INTO `$activityTBL` (id,uuid,sid,name,entered,server_addr,remote_addr,action) VALUES (NULL,'$uuid','$sid','$name','$entered','$serverAddress','$remoteAddress','$action')"; 
     if($result=mysqli_query($link,$sql)); 
        db_disconnect($link);
  }

  unset($_SESSION['u_token']);
  unset($_SESSION['u_sid']); 	 
  unset($_SESSION['u_name']);
  unset($_SESSION['u_orderno']); 	
   
  $_SESSION = array();
  session_destroy();
  header("Location: $ceuSignInPage");
  exit;  
}	 

//*****************************************************************
//*****************************************************************
//*****************************************************************

function makeSecureUUID() {

   if (function_exists('com_create_guid')) 
      return trim(com_create_guid(), "{}");
      
   return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', 
          mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
   exit;		  
}

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function storeQuizzes($sid) {
global $ceuresultsTBL, $ceuusersTBL, $all_quizzes, $all_v_quizzes, $all_s_quizzes;

  // connect to db?
  if(!$link = db_connect_site()) {
	  return "System Temporarily unavailable. Please try again later.";
      exit;
  }     

  // check for presence of this client's order in quiz results table. Add the order if not present.
  if(!$result = mysqli_query($link,"SELECT * FROM $ceuresultsTBL WHERE sid = '$sid'")) {  
     return "Problem with quiz creation.";
	 exit;
	 
  } else {
  
     // no quizzes found? Create and store them, else skip this if quizzes found
	 if(mysqli_num_rows($result) == 0) { 
	 
		// check for presence of this client's order in quiz results table. Add the order if not present.
		if(!$result = mysqli_query($link,"SELECT * FROM $ceuusersTBL WHERE sid = '$sid'")) {  
		   return "Problem with quiz creation.";
		   exit;	 
		}
	 
		if(mysqli_num_rows($result) > 0) { 
		
           while ($row = mysqli_fetch_assoc($result)) {   
		      $itemnumber  = explode("|",$row['itemnumber']);
		   } 	 
		   
		   $sqlids = array();
	   
		   // if all 11 NOMAS courses ordered, add designator v00 (single CEU test) to quiz table
		   if(in_array("v00",$itemnumber) && in_array("s00",$itemnumber)) {	
   
		      $sqlids = $all_quizzes;
			  
		   } elseif (in_array("v00",$itemnumber) && !in_array("s00",$itemnumber)) {		 
		   
		      $sqlids = $all_v_quizzes;
			  
		   } elseif (in_array("s00",$itemnumber) && !in_array("v00",$itemnumber)) {	
		   
			  $sqlids = $all_s_quizzes;
			  
		   } 
		   
		   if (in_array("v03",$itemnumber)) {
			  $sqlids[] = "v02";
			  $sqlids[] = "v03";
		   }  
		   
		   if (in_array("v10",$itemnumber)) {
			  $sqlids[] = "v09";
			  $sqlids[] = "v10";
		   }
		   
		   // add tests that are not in either comprehensive category; filter out products
		   $filter_products = array('s00','v00','v03','v10');
		   foreach ($itemnumber as $id) {
			  if(!in_array($id,$filter_products)) {
			     if(substr($id,0,1) !== "p") {
				    $sqlids[] = "$id";
				 }
			  }
		   }		
		   
		   // store
		   if (isset($sqlids) && count($sqlids > 0)) {
			  asort($sqlids);
			  foreach($sqlids as $val) {		
			     if(!$result = mysqli_query($link,"INSERT INTO $ceuresultsTBL (sid,itemnumber) VALUES ('$sid','$val')")) {
				    return "Problem storing quizzes.";
					exit;
				 }
			  }    		
		   }
		} // $result > 0	   
	 } // $result == 0
  } // else
  return true;
  exit;
}

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function getDescription($id) {
global $ceuproductsTBL;	

  $description = '';
  if($link = db_connect_site()) {
     if($result = mysqli_query($link,"SELECT * FROM $ceuproductsTBL WHERE id = '$id' LIMIT 1")) {
		if(mysqli_num_rows($result) > 0) {
           $results = mysqli_fetch_row($result);	  
           $description = $results[1];
		} else { $description = "Database empty."; }
	 } else { $description = "Database problem."; }
  } else { $description = "Could not connect to database."; }
  
  return $description;
  exit; 
}  

//**************************************************************************************************
//**************************************************************************************************
//**************************************************************************************************

function checkQuizStatus($sid,$id) {
global $ceuresultsTBL;	

  $status = '';
  if($link = db_connect_site()) {
     if($result = mysqli_query($link,"SELECT * FROM $ceuresultsTBL WHERE sid = '$sid' AND itemnumber = '$id' LIMIT 1")) {
		if(mysqli_num_rows($result) > 0) {
           $results = mysqli_fetch_row($result);	  
           $status  = array("attempts" => $results[5], "pass" => $results[6]);
		} else { $status = "Database empty."; }
	 } else { $status = "Database problem."; }
  } else { $status = "Could not connect to database."; }
  
  return $status;
  exit; 
}  

// *********************************************************
// *********************************************************
// *********************************************************

function checkAskedAnswered($post) {
   
   $numasked = $numanswered = $numdifference = $ans = '';
   if(isset($post) && is_array($post) && count($post)) {	   
	  $post_vals = $post;	   
	  if(isset($post_vals['qt']) && !empty($post_vals['qt'])) {		   
	     $numasked    = checkNumAsked($post_vals['qt']);   
         $numanswered = checkNumAnswered($post);
		 if($numasked <> $numanswered) {
            $numdifference = ($numasked - $numanswered);
	        $ans = ($numdifference == '1') ? $numdifference . " question unanswered." : $numdifference . " questions unanswered.";
		 }
	  }
   }
   return $ans;
   exit;
} 

// *********************************************************
// *********************************************************
// *********************************************************

function checkNumAsked($numasked) {

   $ans = '';	      
   switch ($numasked) {
	  case 'qt12' :
		 $ans = "13";
		 break;
	  case 'qt11' :
		 $ans = "11";
		 break;
	  case 'qtv' :
		 $ans = "10";
		 break;
	  case 'qts' :
	     $ans = "5";
	     break;
   }  // switch    				 
   return $ans;
   exit;	   
}

// *********************************************************
// *********************************************************
// *********************************************************

function checkNumAnswered($post) {
  
   $ans = '';
   $numans = array();   
   foreach(array_keys($post) as $val ) {
      if(substr($val,0,2) == "ua") {
	     $numans[] = $val;
      }
   }
   $ans = (is_array($numans)) ? count($numans) : '';
   return $ans;
   exit;
}

// *********************************************************
// *********************************************************
// *********************************************************

function initPostVars($id,$qt,$sid) {	
	
global $q_1,$q_2,$q_3,$q_4,$q_5,$q_6,$q_7,$q_8,$q_9,$q_10,$q_11,
       $a_1,$a_2,$a_3,$a_4,$a_5,$a_6,$a_7,$a_8,$a_9,$a_10,$a_11,
       $e_1,$e_2,$e_3,$e_4,$e_5,$e_6,$e_7,$e_8,$e_9,$e_10,$e_11,
       $ua_1,$ua_2,$ua_3,$ua_4,$ua_5,$ua_6,$ua_7,$ua_8,$ua_9,$ua_10,$ua_11;

    // QUESTIONS
	$id  = (isset($_POST["id"])  && !empty($_POST["id"]))  ? $_POST["id"]  : $id;
	$qt  = (isset($_POST["qt"])  && !empty($_POST["qt"]))  ? $_POST["qt"]  : $qt;
	$sid = (isset($_POST["sid"]) && !empty($_POST["sid"])) ? $_POST["sid"] : $sid;
	$q_1 = (isset($_POST["q_1"]) && !empty($_POST["q_1"])) ? $_POST["q_1"] : "";
	$q_2 = (isset($_POST["q_2"]) && !empty($_POST["q_2"])) ? $_POST["q_2"] : "";
	$q_3 = (isset($_POST["q_3"]) && !empty($_POST["q_3"])) ? $_POST["q_3"] : "";
	$q_4 = (isset($_POST["q_4"]) && !empty($_POST["q_4"])) ? $_POST["q_4"] : "";
	$q_5 = (isset($_POST["q_5"]) && !empty($_POST["q_5"])) ? $_POST["q_5"] : "";
	if($qt <> 'qts') {
	   $q_6  = (isset($_POST["q_6"])  && !empty($_POST["q_6"]))  ? $_POST["q_6"]  : "";
	   $q_7  = (isset($_POST["q_7"])  && !empty($_POST["q_7"]))  ? $_POST["q_7"]  : "";
	   $q_8  = (isset($_POST["q_8"])  && !empty($_POST["q_8"]))  ? $_POST["q_8"]  : "";
	   $q_9  = (isset($_POST["q_9"])  && !empty($_POST["q_9"]))  ? $_POST["q_9"]  : "";
	   $q_10 = (isset($_POST["q_10"]) && !empty($_POST["q_10"])) ? $_POST["q_10"] : "";
	   if($qt == 'qt11' || $qt == 'qt12') {
		  $q_11 = (isset($_POST["q_11"])  && !empty($_POST["q_11"]))  ? $_POST["q_11"]  : "";
	   }
	} 
   // ANSWERS
   $a_1  = (isset($_POST["a_1"])  && $_POST["a_1"] > '')  ? $_POST["a_1"]  : "";
   $a_2  = (isset($_POST["a_2"])  && $_POST["a_2"] > '')  ? $_POST["a_2"]  : "";
   $a_3  = (isset($_POST["a_3"])  && $_POST["a_3"] > '')  ? $_POST["a_3"]  : "";
   $a_4  = (isset($_POST["a_4"])  && $_POST["a_4"] > '')  ? $_POST["a_4"]  : "";
   $a_5  = (isset($_POST["a_5"])  && $_POST["a_5"] > '')  ? $_POST["a_5"]  : "";
   if($qt <> 'qts') {
	  $a_6  = (isset($_POST["a_6"])  && $_POST["a_6"] > '')  ? $_POST["a_6"]  : "";
	  $a_7  = (isset($_POST["a_7"])  && $_POST["a_7"] > '')  ? $_POST["a_7"]  : "";
	  $a_8  = (isset($_POST["a_8"])  && $_POST["a_8"] > '')  ? $_POST["a_8"]  : "";
	  $a_9  = (isset($_POST["a_9"])  && $_POST["a_9"] > '')  ? $_POST["a_9"]  : "";
	  $a_10 = (isset($_POST["a_10"]) && $_POST["a_10"] > '') ? $_POST["a_10"] : "";
	  if($qt == 'qt11' || $qt == 'qt12') {
		 $a_11 = (isset($_POST["a_11"]) && $_POST["a_11"] > '') ? $_POST["a_11"] : "";
	  }	  
   }
   // HINTS
   if(substr($id,0,1) == "v") {	
	  $e_1  = (isset($_POST["e_1"])   && !empty($_POST["e_1"]))   ? $_POST["e_1"]   : "";
	  $e_2  = (isset($_POST["e_2"])   && !empty($_POST["e_2"]))   ? $_POST["e_2"]   : "";
	  $e_3  = (isset($_POST["e_3"])   && !empty($_POST["e_3"]))   ? $_POST["e_3"]   : "";
	  $e_4  = (isset($_POST["e_4"])   && !empty($_POST["e_4"]))   ? $_POST["e_4"]   : "";
	  $e_5  = (isset($_POST["e_5"])   && !empty($_POST["e_5"]))   ? $_POST["e_5"]   : "";
	  $e_6  = (isset($_POST["e_6"])   && !empty($_POST["e_6"]))   ? $_POST["e_6"]   : "";
	  $e_7  = (isset($_POST["e_7"])   && !empty($_POST["e_7"]))   ? $_POST["e_7"]   : "";
	  $e_8  = (isset($_POST["e_8"])   && !empty($_POST["e_8"]))   ? $_POST["e_8"]   : "";
	  $e_9  = (isset($_POST["e_9"])   && !empty($_POST["e_9"]))   ? $_POST["e_9"]   : "";
	  $e_10 = (isset($_POST["e_10"])  && !empty($_POST["e_10"]))  ? $_POST["e_10"]  : "";
	  if($qt == 'qt11' || $qt == 'qt12') {
	     $e_11 = (isset($_POST["e_11"])  && !empty($_POST["e_11"]))  ? $_POST["e_11"]  : "";
	  }	
   }
   // USER ANSWERS
   $ua_1  = (isset($_POST["ua_1"])  && $_POST["ua_1"] > '')  ? $_POST["ua_1"]  : "";
   $ua_2  = (isset($_POST["ua_2"])  && $_POST["ua_2"] > '')  ? $_POST["ua_2"]  : "";
   $ua_3  = (isset($_POST["ua_3"])  && $_POST["ua_3"] > '')  ? $_POST["ua_3"]  : "";
   $ua_4  = (isset($_POST["ua_4"])  && $_POST["ua_4"] > '')  ? $_POST["ua_4"]  : "";
   $ua_5  = (isset($_POST["ua_5"])  && $_POST["ua_5"] > '')  ? $_POST["ua_5"]  : "";
   if($qt <> 'qts') {
	  $ua_6  = (isset($_POST["ua_6"])  && $_POST["ua_6"] > '')  ? $_POST["ua_6"]  : "";
	  $ua_7  = (isset($_POST["ua_7"])  && $_POST["ua_7"] > '')  ? $_POST["ua_7"]  : "";
	  $ua_8  = (isset($_POST["ua_8"])  && $_POST["ua_8"] > '')  ? $_POST["ua_8"]  : "";
	  $ua_9  = (isset($_POST["ua_9"])  && $_POST["ua_9"] > '')  ? $_POST["ua_9"]  : "";
	  $ua_10 = (isset($_POST["ua_10"]) && $_POST["ua_10"] > '') ? $_POST["ua_10"] : "";
	  if($qt == 'qt11' || $qt == 'qt12') {
		 $ua_11 = (isset($_POST["ua_11"]) && $_POST["ua_11"] > '') ? $_POST["ua_11"] : "";
	  }	  
   }
}

// *********************************************************
// *********************************************************
// *********************************************************

function initQuestionVars($id,$qt) {
global $ceuquizzesTBL,$id,$description,
       $q_1,$q_2,$q_3,$q_4,$q_5,$q_6,$q_7,$q_8,$q_9,$q_10,$q_11,
	   $a_1,$a_2,$a_3,$a_4,$a_5,$a_6,$a_7,$a_8,$a_9,$a_10,$a_11,
	   $e_1,$e_2,$e_3,$e_4,$e_5,$e_6,$e_7,$e_8,$e_9,$e_10,$e_11;
	
   if(!$link = db_connect_site()) {
	   return "Quiz system temporarily unavailable. Please try again later.";
   } else {
	  if(!$result = mysqli_query($link,"SELECT * FROM $ceuquizzesTBL WHERE id = '$id' LIMIT 1")) {  
		 return "Quiz system temporarily unavailable. Please try again later.";
	  } else {
		 if(mysqli_num_rows($result) == 0) {
			return "Cannot find your quiz.";
		 } else {		 
			while ($row = mysqli_fetch_assoc($result)) {
			   $id = $row['id'];
			   $description = $row['description'];
			   $q_1 = $row['q_1'];
			   $q_2 = $row['q_2'];
			   $q_3 = $row['q_3'];
			   $q_4 = $row['q_4'];
			   $q_5 = $row['q_5'];
			   if($qt <> 'qts' ) {
				  $q_6 = $row['q_6'];
				  $q_7 = $row['q_7'];
				  $q_8 = $row['q_8'];
				  $q_9 = $row['q_9'];
				  $q_10 = $row['q_10'];
				  if($qt == 'qt11' || $qt == 'qt12') {
					 $q_11 = $row['q_11'];
				  }
			   }
			   // answers
			   $a_1 = $row['a_1'];
			   $a_2 = $row['a_2'];
			   $a_3 = $row['a_3'];
			   $a_4 = $row['a_4'];
			   $a_5 = $row['a_5'];
			   if($qt <> 'qts' ) {
				  $a_6 = $row['a_6'];
				  $a_7 = $row['a_7'];
				  $a_8 = $row['a_8'];
				  $a_9 = $row['a_9'];
				  $a_10 = $row['a_10'];
				  if($qt == 'qt11' || $qt == 'qt12') {
					 $a_11 = $row['a_11'];	
				  }
			   }
			   // hints			   
			   $e_1 = $row['e_1'];
			   $e_2 = $row['e_2'];
			   $e_3 = $row['e_3'];
			   $e_4 = $row['e_4'];
			   $e_5 = $row['e_5'];
			   if($qt <> 'qts' ) {
				  $e_6 = $row['e_6'];
				  $e_7 = $row['e_7'];
				  $e_8 = $row['e_8'];
				  $e_9 = $row['e_9'];
				  $e_10 = $row['e_10'];
				  if($qt == 'qt11' || $qt == 'qt12') {
					 $e_11 = $row['e_11'];
				  }
			   }
			}		 
		 } 
	  } 
   }
   if(is_resource($result)) 
      mysqli_free_result($result);
}

// *********************************************************
// *********************************************************
// *********************************************************

function prepEmail($sid,$passFail,$id) {
global$ceuusersTBL;
  
   if($link = db_connect_site()) {
      if($result = mysqli_query($link,"SELECT * FROM $ceuusersTBL WHERE sid = '$sid' LIMIT 1")) {
	     if(mysqli_num_rows($result) > 0) {            
		    $userInfo = array();
			while($row = mysqli_fetch_assoc($result)) {
               $userInfo['sid']        = $sid; 
	           $userInfo['id']         = $id;			   
               $userInfo['name']       = $row['name']; 
               $userInfo['occupation'] = $row['occupation']; 
               $userInfo['email']      = $row['email'];
               $userInfo['invoice']    = $row['invoice'];
               $userInfo['orderno']    = $row['orderno'];
	           $userInfo['status']     = $passFail;	
			}
	        sendEmail($userInfo);			
		    return; exit;
		 } else { return "Database empty!"; }
	  } else { return "Database problem."; }
   } else { return "Database connection problem."; }
}  	 			

// *********************************************************
// *********************************************************
// *********************************************************

function sendEmail($userInfo) {
global $environment,$ceuresultsTBL,$sendToEmail,$today;	

   if (is_array($userInfo) && count($userInfo) > 0) {
	  $sid     = $userInfo['sid'];
	  $id      = $userInfo['id'];
	  $name    = $userInfo['name'];
	  $occu    = strtoupper($userInfo['occupation']);
	  $email   = $userInfo['email'];
	  $invoice = $userInfo['invoice'];
	  $orderno = $userInfo['orderno'];
	  $status  = $userInfo['status'];
	  
	  $toEmail  = $sendToEmail; 
	  $Subject  = "QUIZ REPORT: $name $status Quiz $id"; 
	  $tmo      = "NOMAS International Website";
	  $today    = date("Y-m-d");  
	  
	  $body     = "Dear Punky! Here is a client Quiz Report.\n";
	  $body    .= "----------------------------------------\n";
	  $body    .= "Client    : $name\n";
	  $body    .= "Status    : $status\n";
	  $body    .= "Course    : $id\n";
	  $body    .= "Order #   : $orderno\n";
	  $body    .= "PayPal TXN: $invoice\n";
	  $body    .= "----------------------------------------\n";		
	  $body    .= "Occupation: $occu\n";
	  $body    .= "Email     : $email\n";
	  $body    .= "----------------------------------------\n";		
	  $body    .= "REMINDER. Course numbers are preceded by the letters 'v' or 's' or 'n'.\n";
	  $body    .= "'v' courses are in the Marjorie Meyer Palmer series.\n";
	  $body    .= "'v00' indicates that all 11 Marjorie Meyer Palmer talks were taken.\n";
      $body    .= "'s' courses are in the Symposia series.\n";	
	  $body    .= "'n' courses are the Nomas Onlline series.\n";	
      $body    .= "'cpf' courses are in the Clinics in Pediatric Feeding series.\n";
      $body    .= "'s00' indicates that all 12 Symposia talks were taken.\n";	
      $body    .= "The number following 'v' or 's' in this report is its course number.\n";	  	  	  
	  $headers  = "From: $tmo <$email>\r\n";
	  $headers .= "Reply-To: $toEmail\r\n";
	  $headers .= "X-Mailer: PHP/\r\n";
	  $headers .= "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	  
	  $sql = "UPDATE $ceuresultsTBL SET quiz_date = '$today', status = '$status' WHERE sid = '$sid' AND itemnumber = '$id' LIMIT 1";
	  
	  if($environment == "WEB") {
		 if(mail($toEmail, $Subject, $body, $headers)) {
		 } else { return "Could not send email."; }		 
	  } 		  
	  
      if($link = db_connect_site()) {
	     if(mysqli_query($link,$sql))
		    db_disconnect($link);
	  }
   }	 	 
}

// *********************************************************
// ******************* SHOW LOGOS***************************
// *********************************************************

function showSmallLogo() {
global $logo_small,$logo_main,$ceuHomePage;

   $logo = '';
   if(is_file($logo_small)) {	
      $logo = "<img src=" . "'" . $logo_small . "'" . " name='logo' alt='logo' title='Home Page'>";
   }
   echo $logo;  
}

function showBigLogo() {
global $logo_main, $ceuHomePage;

   $logo = '';
   if(is_file($logo_main)) {	
      $logo = "<a href='#'><img src=" . "'" . $logo_main . "'" . " name='logo' alt='logo' title='Home Page'></a>";
   }
   echo $logo;  
}

function showForumLogo() {
global $logo_forum, $feedingForum;

   $logo = '';
   if(is_file($logo_forum)) {	
      $logo = "<a href=" . "'" . $feedingForum . "'><img src=" . "'" . $logo_forum . "'" . " name='logo' alt='logo' title='Home Page'></a>";
   }
   echo $logo;  
}

// *********************************************************
// ******************* SHOW COPYRIGHT **********************
// *********************************************************

function showCopyright($thisYear) {
   $copy = "<div class='copy'>Copyright &copy; 1983-" . $thisYear . " - Marjorie Meyer Palmer</div>";  
   echo $copy;  
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
          $clean_array[] = mysqli_real_escape_string($link,$val);
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

// *********************************************************
// ***************** DIFFERENCE BETWEEN TWO DATES***********
// *********************************************************

function dateDiff($start, $end) {
	
  $start_ts = strtotime($start);
  $end_ts   = strtotime($end);
  $diff     = $end_ts - $start_ts;
  return round($diff / 86400);
}

?>