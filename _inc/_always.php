<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log','_docs/errors/errors_site.log');

$environment = "WEB"; // WEB or LCL
$sendToWho   = "PUNKY"; // PUNKY or PETER
$punkyEmail  = "marjorie@nomasinternational.org";
$peterEmail  = "peterbe@verizon.net";
//$sendToEmail = ($sendToWho == "PETER")? $peterEmail : $punkyEmail;
$sendToEmail = "marjorie@nomasinternational.org";

$db_pword    = "Edzp0DyR7H";
$pw_salt     = "DiN#l1h-Z53@7_29x"; // salt for passwords
$today       = date("Y-m-d");
$thisYear    = date("Y");
$sympEndDate = "2015-10-30"; // last day of symposium plus one

// *********************************************************************
// *********************************************************************
// *********************************************************************

// JQuery meta links
$jq_google         = '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
$jq_ui             = '<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet"  />
                      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>';
$jq_ui_accordion   = '<link href="_css/jq-ui-accordion.css" rel="stylesheet" />';
$jq_slidemenu      = '<script type="text/javascript" src="_js/jquery.slidemenu.js"></script>';
$jq_tablesorter    = '<script type="text/javascript" src="_js/jquery.tablesorter.min.js"></script>';
$swfobj22          = '<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>';
$jwplayer          = '<script type="text/javascript" src="_js/jwplayer.js" ></script>';
$cms_spry          = '<script type="text/javascript" src="_js/spry.js"></script>';
$vibracart         = '<link href="_vibralogix/vibracart/vibracartstyle1.css" rel="stylesheet" type="text/css">' . "\n" . 
                     '<script type="text/javascript" src="_vibralogix/vibracart/settingsstyle1.js"></script>' . "\n" .
					 '<script type="text/javascript" src="_vibralogix/vibracart/sarissa.js"></script>' . "\n" .
					 '<script type="text/javascript" src="_vibralogix/vibracart/vibracart.js"></script>';

// TABLE NAMES
$symposiumRegTBL   = "apps_symp_registration";
$trainingSitesTBL  = "apps_trainingsites";
$trainingDatesTBL  = "apps_trainingdates";
$practitionersTBL  = "apps_practitioners";
$ceuordersTBL      = "ceu_orders";
$ceuproductsTBL    = "ceu_products";

// SITE PAGES
$comingSoonPage     = "coming_soon.php";
$homePage           = "index.php";
$contactPage        = "contact.php";
$aboutMmpPage       = "about_mmp.php";
$successStoriesPage = "about_stories.php";
$nomasTrainingPage  = "about_training.php";
$nomasAgendaPage    = "nomas_agenda.php";
//$feedingForumPage   = "feeding_forum.php";
$feedingForumPage   = "http://www.nomasinternational.org/smf/";
$ceuPage            = "ceu_0001.php";
$practitionersPage  = "practitioners.php";
$symp2013Page       = "symp_2013.php";
$symp2014Page       = "symp_2014.php";
$symp2015Page       = "symp_2015.php";
$testingPage        = "renew.php";
$testingLoginPage   = "olceu/index_renew_login.php";
$olceuLoginPage     = "olceu/index.php";

// VIDEOS
$nomas_orientation  = "_video/nomas-orientation.mp4";
$nomas_ceu_excerpt  = "_video/nomas-ceu-excerpt.mp4";
$nomas_symp_excerpt = "_video/nomas-symp-excerpt.mp4";
$nomas_cpf_excerpt  = "_video/Clinics_in_Pediatric_Feeding_1_excerpt.mp4";
$nomas_series_1_pic = "_grafix/title-excerpt-series-1.jpg";
$nomas_series_2_pic = "_grafix/title-excerpt-series-2.jpg";
$nomas_training_pic = "_grafix/title-intro-to-nomas-training.jpg";
$nomas_cpf_pic      = "_grafix/title-excerpt-clinics-pediatric.jpg";
$nomas_series_4_pic = "_grafix/title-excerpt-series-4.jpg";
$nomas_series_4_video = "_video/Introduction & Disclosures (web).mp4";

// Security / Page Access
$lvl_1           = "1"; // user-level user page
$lvl_2           = "2"; // admin-level user page
$u_lvl_min       = "1"; // minimum user level available for this version of this app
$u_lvl_max       = "2"; // maximum user level available for this version of this app

// Reliability test number range
$min_test_num    = "2"; // lowest numbered reliability/licensing test
$max_test_num    = "4"; // highest numbered reliability/licensing test
$rlli_numbers    = "2, 3 or 4";
$rlli_array      = array('2','3','4');

// VARIOUS VARS
$price_all_11    = "$375";
$logo_main       = "_grafix/logo-nomas-960.jpg";
$logo_forum      = "_grafix/logo-nomas-960.jpg";
$logo_mybb       = "_mybb/images/logo-nomas-910.jpg";
$logo_small      = "_grafix/logo-nomas-small.png";
$ashaCeuForm     = "_docs/asha_claim/olce_asha_ceu_credit_form.pdf";
$pleaseContact   = "<a href='http://www.nomasinternational.org/contact.php'>Please contact NOMAS International</a>";

$topNav          = "";
$footer          = "";
$errorMsg        = "";

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

function db_disconnect($link) {
  mysqli_close($link);
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function checkTrainingSked($year) {
  
  $pingSites = pingSites();
  $pingDates = pingDates($year);  
  $answer    = (isset($pingSites) && isset($pingDates) && ($pingSites + $pingDates >= '2') ) ? true : false;  
  
  return $answer;
  exit;
              				 	   	      	   		   
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function pingSites() {
global $trainingSitesTBL;	

  $link = db_connect_site();   		  
  if($result = mysqli_query($link, "SELECT * FROM $trainingSitesTBL WHERE visible LIMIT 1")) {	
     $answer = mysqli_num_rows($result);
	 mysqli_free_result($result);	  
  }

  return $answer;
  exit;               				 	   	      	   		   
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function pingDates($thisYear) {
global $trainingDatesTBL;
   
  $nextYear = $thisYear + 1;
  $link = db_connect_site();   		  
  if($result = mysqli_query($link, "SELECT * FROM $trainingDatesTBL WHERE year = '$thisYear' OR year = '$nextYear'")) {	
     $answer = mysqli_num_rows($result);
	 mysqli_free_result($result);	  
  }
  return $answer;
  exit;               				 	   	      	   		   
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function trainingSked($visible) {
global $trainingSitesTBL, $feedingForumPage, $trainingDatesTBL, $thisYear, $today, $contactPage, $testingPage, $nomasAgendaPage;

if(!$visible) {
	
   echo "<div class='r_item_box'>";     
   echo "<div class='r_item'>";  
   echo "<h1>NOMAS<sup>&reg;</sup> Training Calendar</h1>";
   echo "<div class='text'>Schedule temporarily unavailable.</div>";
   echo "</div><!--end r_item-->";
   echo "</div><!--end r_item_box-->";
   
} else {
	
   echo "<div class='r_item_box'>\n";     
   echo "<div class='r_item'>\n";  
   echo "<h1>NOMAS<sup>&reg;</sup> Training Calendar</h1>\n";	

   // GET TRAINING SITES
   $link = db_connect_site();   		  
   if($result_s = mysqli_query($link, "SELECT * FROM $trainingSitesTBL WHERE visible AND loc_id IN (SELECT loc_id from $trainingDatesTBL where starts >= '$today')")) {	
      if (mysqli_num_rows($result_s) > '0' ) {
         while($row = mysqli_fetch_assoc($result_s)) {
		    $row = array_map("stripslashes", $row);			
			$city     = $row['loc_city'];
			$location = $row['loc'];
			$url      = $row['loc_url'];			
			$site_id  = $row['loc_id'];

			echo "<div class='hed'>" . $city . "</div>\n";
			echo (!empty($url)) ? "<div class='text'><span class='ital'><a href='" . $url . "' target='_blank'>" . $location . "</a></span></div>\n" : "<div class='text'>" . $location . "</div>\n";

			// GET COURSE DATES ASSOCIATED WITH EACH TRAINING SITE
			if($result_d = mysqli_query($link, "SELECT starts FROM $trainingDatesTBL WHERE loc_id = '{$site_id}' AND starts >= '$today' ORDER BY starts ASC")) {
               if (mysqli_num_rows($result_d) > '0' ) {
                  while($row = mysqli_fetch_assoc($result_d)) {
					 $starts    = strtotime($row['starts']);
					 $ends      = strtotime("+2 days",$starts);
	                 $starts    = date("M j, Y", $starts);
	                 $ends      = date("M jS.", $ends);
	                 $date_line = $starts . " to " . $ends;		
					 echo "<div class='text'>" . $date_line . "</div>\n";				     		
				  } // while 
			   }// if
               echo "<br>";				   
			} // if					  										 
		 } // master while	  	 
         mysqli_free_result($result_s);	  
         mysqli_free_result($result_d);		 
      } else {}
   } else {}
   echo "<div class='hed'>&nbsp;</div>\n";
   echo "<!--MORE INFO and SIGN UP-->\n";
   echo "<h2 style='margin-bottom:0px;'><a href='" . $nomasAgendaPage . "'>See NOMAS training agenda</a></h2><br>\n";
   echo "<h2 style='margin-bottom:0px;'><a href='" . $contactPage . "'>Sign-up for NOMAS training</a></h2><br>\n";
   echo "<h2 style='margin-top:0px;'><a href='" . $feedingForumPage . "'>Join the Infant Feeding Forum</a></h2><br>\n";
   echo "<div class='hed'>&nbsp;</div>\n";
   echo "<h1>NOMAS<sup>&reg;</sup> Related Links</h1>";
   echo "<h3><a href='" . $testingPage . "'>Renew your NOMAS license</a></h3>\n";
   echo "<h3><a href='" . $testingPage . "'>NOMAS reliability testing</a></h3><br>\n";
   echo "</div><!--end r_item-->\n";
   echo "</div><!--end r_item_box-->\n";                       
   }
}

//*****************************************************************
//*****************************************************************
//*****************************************************************

function feedingForumLogin() {
  
echo "<div class='r_item_box'>";
   echo "<div class='r_item'>";    
	  echo "<h1>Login: Infant Feeding Forum</h1>";
	  echo '<form id="login_small" action="';
		 echo htmlentities($_SERVER['PHP_SELF']);
		 echo '" method="POST" accept-charset="UTF-8">';
		 echo '<label for="uname">Username:</label><br>';
		 echo '<input type="text" name="uname" value="" size="60" maxlength="60" />';
		 echo '<label for="pword">Password:</label><br>';
		 echo '<input type="password" name="pword" size="60" maxlength="16" />';
		 echo '<span class="link"><a href="coming_soon.php" class="title">Sign-up for the Forum</a></span>';
		 echo '<button type="submit" name="submit" value="Login" />Login</button>';
	  echo '</form>';
   echo '</div> <!--end r_item-->';
echo '</div> <!--end r_item_box-->';
echo '<!--END FORUM SIGN-IN-->';
}

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

  if( $_SESSION['cms']['u_token'] <> $u_token ) {
    log_out(); // logout if token has changed since initially set at login
  }  
  
  if( $_SESSION['cms']['u_level'] < $page_level ) {
    log_out(); // logout if unser-level is inappropriate for the particular page
  }  
  
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

function log_out() {
global $loginPage, $activityTBL;
	
  $logout_url    = $loginPage;	
  $lname         = $_SESSION['cms']['u_lname'];
  $uuid          = $_SESSION['cms']['u_token'];
  $remoteAddress = $_SERVER['SERVER_ADDR'];
  $serverAddress = $_SERVER['REMOTE_ADDR'];    
  $action        = "OFF";
  $when          = date("Y-m-d H:i:s");
  
  // insert login into Usage Table
  $link   = db_connect_site();
  $lname  = mysqli_real_escape_string($link,$lname);  
  $result = mysqli_query($link,"INSERT INTO $activityTBL (id, uuid, lname, u_date, server_addr, remote_addr, action) 
                                VALUES (NULL, '$uuid', '$lname', '$when', '$serverAddress', '$remoteAddress', '$action')");  
			 
  db_disconnect($link);
  
  $_SESSION['cms'] = array();
  session_destroy();
  header("location: $logout_url");
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
// ***************** FORMAT PHONE NUMBER *******************
// *********************************************************

function formatPhone($num) {
	
   $num = preg_replace('/[^0-9]/', '', $num); 
   $len = strlen($num);
   
   if($len >= 7 && $len < 10 )
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

// *********************************************************
// ******************* SHOW LOGOS***************************
// *********************************************************

function showSmallLogo() {
global $logo_small;

   $logo = '';
   if(is_file($logo_small)) {	
      $logo = "<img src=" . "'" . $logo_small . "'" . " name='logo' alt='logo' title='Home Page'>";
   }
   echo $logo;  
}

function showBigLogo() {
global $logo_main, $homePage;

   $logo = '';
   if(is_file($logo_main)) {	
      $logo = "<a href=" . "'" . $homePage . "'><img src=" . "'" . $logo_main . "'" . " name='logo' alt='logo' title='Home Page'></a>";
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
// ******************* SHOW LOGO ***************************
// *********************************************************
function showSocialLinks($links) {

   $slinks = 	
	
   "<a href='https://www.facebook.com/nomasinternational' target='_blank'><img class='social_logo' src='_grafix/social_fb.png' width='20' height='20' alt='fblogo' title='NOMAS on FB'></a>
   <a href='http://twitter.com/NOMAS_INTL' target='_blank'><img class='social_logo' src='_grafix/social_tw.png' width='20' height='20' alt='twlogo' title='NOMAS on Twitter'></a>
   <a href='http://www.linkedin.com/company/3600249' target='_blank'><img class='social_logo' src='_grafix/social_li.png' width='20' height='20' alt='lilogo' title='NOMAS on LinkedIn'></a>";
   
   echo $slinks;	
	
}

// *********************************************************
// ******************* SHOW LOGO ***************************
// *********************************************************

function showCopyright($thisYear) {
   $copy = "<div class='copy'>Copyright &copy; 1983-" . $thisYear . " - Marjorie Meyer Palmer</div>\n";  
   echo $copy;  
}

?>