<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Directory of NOMAS<sup>&reg;</sup> Practitioners ";
$pageSubTitle = "Practitioner list temporarily unavailable";
$expiredMsg   = '<h1>Entries in red indicate a NOMAS<sup>&reg;</sup> certified practitioner whose NOMAS<sup>&reg;</sup> license has expired.</h1>';
$errorMsg     = '';

//*****************************************************************
//*****************************************************************
//*****************************************************************

$sidArray     = array('usa','all','intl');
$sid          = (isset($_REQUEST['sid']) && $_REQUEST['sid'] > '' ) ? $_REQUEST['sid'] : 'all';
$sid          = (!in_array($sid,$sidArray)) ? 'all' : $sid;
$scope        = getScope($sid,$sidArray); // on success, returns a table search resource. Otherwise returns string for error or empty database.

if(is_object($scope)) {	

   $practitioners = countPractitioners($sid); // returns numerical total or string error.
   $countries     = ($sid <> 'usa') ? countCountries($sid) : ''; // returns numerical total or string error.   
   $cities        = countCities($sid); // returns numerical total or string error.
   $scopeName     = getScopeName($sid); // returns string to add to $pageTitle defined above, or "" if title doesn't need to be amended
   $pageTitle     = $pageTitle . $scopeName; // concatenation.
   $showTotals    = (is_numeric($practitioners) && is_numeric($cities)) ? true : false; // test to determine whether search data can be displayed

   if($sid == 'all' || $sid == 'intl') { // re-initialize $pageSubTotal to display counts. Overseas total include number of countries.
   
      $pageSubTitle  = ($showTotals) ? $practitioners . " trained practitioners in " . $cities . " cities in " . $countries . " countries" : "";
	  
   } elseif ($sid == 'usa') { // USA totals do not include number of countries.
   
      $pageSubTitle  = ($showTotals) ? $practitioners . " trained practitioners in " . $cities . " cities" : "";
	  
   }
   
} else { $showTotals = false; } // <= debug: set to $errorMsg = $scope

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************
   
function getScope($sid,$sidArray) {
global $practitionersTBL;

   if(!$link = db_connect_site()) {
      return 'Database offline. Please try again later.'; 
      exit;
   }  
   
   switch($sid) {
      case 'all':
	     $sql = "SELECT * FROM $practitionersTBL ORDER BY country,city ASC";
	     break;
	  
	  case 'usa';
         $sql = "SELECT * FROM $practitionersTBL WHERE country = 'USA' ORDER BY region_state,lname ASC";
         break;	
	  
      case 'intl':
         $sql = "SELECT * FROM $practitionersTBL WHERE country <> 'USA' ORDER BY country,city ASC";
         break;	      	   
   }	  
   
   if($result = mysqli_query($link,$sql)) {
	  if(mysqli_num_rows($result) > 0 ) {
		return $result;
		exit;
	  } else { return "Database is empty."; exit; }
   } else { return 'Database problem. Please try again later.'; exit;}        
 
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function countPractitioners($sid) {
global $practitionersTBL;
   
   switch($sid) {
	   case 'all':
	      $sql = "SELECT COUNT(*) AS answer FROM $practitionersTBL LIMIT 1";
	      break;
		
	   case 'usa';
	      $sql = "SELECT COUNT(*) AS answer FROM $practitionersTBL WHERE country = 'USA' LIMIT 1";
	      break;	
		
	   case 'intl':
	      $sql = "SELECT COUNT(*) AS answer FROM $practitionersTBL WHERE country <> 'USA' LIMIT 1";
	      break;	      	   		
	}
 
	if($link = db_connect_site() ) {
		
	   if($result = mysqli_query($link,$sql)) {	
	      while ($row = mysqli_fetch_assoc($result)) {
             $answer = $row['answer'];
	      }     
		  mysqli_free_result($result);	  	 		  
	   } else { $answer = "Sorry, database problem."; }
	   
	} else { $answer = "Sorry, database temporarily unavailable."; }
  
	return $answer;
	exit;            
}

///**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function countCountries($sid) {
global $practitionersTBL;

	switch($sid) {
		case 'all':
		$sql = "SELECT COUNT(DISTINCT country) AS answer FROM $practitionersTBL LIMIT 1";
		break;
		
		case 'intl':
		$sql = "SELECT COUNT(DISTINCT country) AS answer FROM $practitionersTBL WHERE country <> 'USA' LIMIT 1";
		break;	      	   
	}
 
	if($link = db_connect_site()) {   		  
	   if($result = mysqli_query($link, $sql)) {	
		  while ($row = mysqli_fetch_assoc($result)) {
			 $answer = $row['answer'];
		  }     
		  mysqli_free_result($result);	  	 
	   } else { $answer = "Sorry, database problem."; }
	} else { $answer = "Sorry, database temporarily unavailable."; }
  
   return $answer;
   exit;               
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function countCities($sid) {
global $practitionersTBL;

	switch($sid) {
	   case 'all':
	   $sql = "SELECT COUNT(DISTINCT city) AS answer FROM $practitionersTBL LIMIT 1";
	   break;
		
	   case 'usa';
	   $sql = "SELECT COUNT(DISTINCT city) AS answer FROM $practitionersTBL WHERE country = 'USA' LIMIT 1";
	   break;	
		
	   case 'intl':
	   $sql = "SELECT COUNT(DISTINCT city) AS answer FROM $practitionersTBL WHERE country <> 'USA' LIMIT 1";
	   break;	      	   
	}
 
	if($link = db_connect_site()) {   		  
	   if($result = mysqli_query($link, $sql)) {	
		  while ($row = mysqli_fetch_assoc($result)) {
			$answer = $row['answer'];
		  }     
		  mysqli_free_result($result);	  	 
	   } else { $answer = "Sorry, database temporarily unavailable."; }
	} else { $answer = "Sorry, database problem."; }
  
	return $answer;   
	exit;          
}

//**********************************************************************************************
//**********************************************************************************************
//**********************************************************************************************

function getScopeName($sid) {
	
   switch($sid) {	   
	  case 'all':
	  return "Worldwide";
	  break;
	
	  case 'usa';
	  return "in the USA";
	  break;	
	
	  case 'intl':
	  return "Outside the USA";
	  break;	      	   
 }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<meta name="viewport" content="width=device-width" />
<title>NOMAS International - NOMAS&reg; Practitioner Registry</title>
<meta name="description" content="Worldwide listing of licensed NOMAS&reg; practitioners.">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<link href="_css/css_tablesorter.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
echo $jq_tablesorter . "\n";
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-61070902-1', 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript">
<!--
$(document).ready(function() {
	$("#practitioner") .tablesorter({
        headers: { 7: { sorter: false }}, 	
	    widgets: ['zebra']}
	);
});
//-->
</script>
</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
   
   <!--SOCIAL-->  
   <div class='social_links'>
      <?php showSocialLinks($socialLinks) ?>
   </div><!--end social box-->    
  
   <div class='clearAll'></div>  
    
    <div id='nomas_content'>
    
       <div id='nomas_page_headlines'>
          <?php
	      if ( isset($pageTitle) && $pageTitle > '') {
		     echo "<div class='pageTitle'>" . $pageTitle . "</div>";
	      }
          if (isset($pageSubTitle) && $pageSubTitle > '') {
             echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	      } 
	      ?>
       </div><!--end nomas_page_headlines-->  
   
       <?php    
       if (isset($errorMsg) && $errorMsg > '' ) {
          echo "<table class='problem_msg_table'><tr><td>";
          echo $errorMsg;
          echo "</td></tr></table>";      
          $showTotals = false; 
       }
       ?>
       
       <div id='column_left_wide' style='width:97%;'>
       <div class='l_item'>
          <div class='reg_text_serif'>
          NOMAS<sup>&reg;</sup> practitioners have completed a comprehensive three-day training course and are proven to be reliable in the administration of the protocol.
          Practitioners are licensed for two-year periods to use the protocol in their practices. Biennial license renewal can be accomplished on this website. Renewal assures that practitioners 
          are up-to-date on the correct adminstration of the NOMAS<sup>&reg;</sup>. Another significant benefit of current licensing: 
          complimentary membership in the NOMAS<sup>&reg;</sup> Feeding Forum where every day, neonatal feeding professionals benefit from the experiences and advice of peers and other professionals.
          </div>
       </div>

       <div class='spacer_26'></div>                    
      
       <?php
	   if (isset($scope) && is_object($scope)) {
		  if($showTotals) { 
			 $countall = '0';
			 $countitems = '0';
			 echo "<div class='practitioner_box'>";
				echo $expiredMsg;
				echo "<table id='practitioner' class='tablesorter'>";
				echo "<thead>";
				echo "<tr><th>Name</th><th>City</th>";
				if($sid == 'all') {
			       echo "<th>Region/State</th>";
				} elseif ($sid == 'intl') {
				   echo "<th>Region</th>";
				} else {
				   echo "<th>State</th>" ;
				}
				echo "<th>Country</th><th>Discipline</th><th>Certified</th><th></th></tr>";
				echo "</thead>";
				echo "<tfoot>";
				echo "<tr><th colspan='7' style='text-decoration:none;'>Total number of practitioners found: " . $practitioners . ".</th></tr>";
				echo "</tfoot>";
				echo "<tbody>";			   
				while($row = mysqli_fetch_assoc($scope)) {
					$licensed = $row['license'];
					echo "<tr>";
					echo ($licensed) ? "<td class='pct20'>" . $row['lname'] . ", " . $row['fname'] . "</td>" : "<td  class='pct20' style='color:#900;'>" . $row['lname'] . ", " . $row['fname'] . "</td>";
					//echo "<td class='pct10'>" . substr($row['addr1'],0,9) . '...'  . "</td>";
					echo "<td class='pct20'>" . $row['city'] . "</td>";
					echo "<td class='pct20'>" . $row['region_state'] . "</td>";
					echo "<td class='pct10'>" . $row['country'] . "</td>";
					echo "<td class='pct15'>" . $row['discipline']  . "</td>";
					echo "<td class='ctr pct05'>" . $row['cert_year']    . "</td>";
					if($countitems >= '30') {
						$countitems = '0';
						echo "<td class='pct05'><a href='practitioners.php?sid=$sid'><img src='_grafix/arrow-up-1.gif' height='16' width='16'>&nbsp;&nbsp;Top</a></td>";
					} else {
						 echo "<td class='pct05'>&nbsp;</td>";
					}
					echo "</tr>";
					$countitems++; $countall++;
				}		  
				echo "</tbody>";
				echo "</table>";					  
			 echo "</div><!--end practitioner_box-->";            
		  } 
	   }
	 ?>
    </div>      
  
    <div class='clearAll'></div>
    </div> <!-- end content  -->
  
    <!--FOOTER-->
    <div id="footer"> 
       <?php showBottomMenu(); showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
    <div class='clearAll'></div>

</div><!-- end #playround -->
</body>
</html>
