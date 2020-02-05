<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_trainingsked_0.php"; // top nav menu
//include_once "_inc/inc_app_trainingsked.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // located in _always.php
check_permission($pg_level,$u_token); // located in _always.php

//*****************************************************************
//*****************************************************************
//*****************************************************************
$todayIs      = date("l, F jS, Y");
$errorMsg     = array();
$pageTitle    = "NOMAS<sup>&reg;</sup> TRAINING SITES & SCHEDULES (For Website Display)";
$pageSubTitle = "Click city, below, to edit or delete a site. To add a new training site, click 'ADD A NEW TRAINING SITE' above.";  
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<title>NOMAS International CMS</title>
<meta name="viewport" content="width=device-width" />
<meta name="robots" content="noindex">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<link href="_css/css_tables_cms.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n"; 
echo $jq_slidemenu . "\n"; 
?>
</head>
<body>
<div id="playground">
   <div id='header'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
  
   <div class='clearAll'></div>  
    
   <!-- CONTENT -->
   <div id='content'>        
      <?php
      if ( isset($pageTitle) && $pageTitle > '') {
         echo "<div class='pageTitle'>" . $pageTitle . "</div>\n";
      }
      if (isset($pageSubTitle) && $pageSubTitle > '') {
         echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
      } 
      
      echo "<div class='clearAll'></div>";  
      
	  if($link = db_connect_site()) {   	
		  
	  if($result_s = mysqli_query($link, "SELECT * FROM $trainingSitesTBL ORDER BY loc_city")) {	
		 if (mysqli_num_rows($result_s) > 0 ) {
			echo "<table class='sked_table' style='margin:30px 0px;'>\n";
			echo "<thead>\n";
			echo "<tr>\n";
			echo "<th class='th_1'>City (click to edit)</th>";
			echo "<th class='th_2'>Facility</th>";
			echo "<th class='th_3'>Start Dates</th>";
			echo "<th class='th_4'>Visible?</th>";
			echo "</tr>\n";
			echo "</thead>\n";	
			echo "<tbody>\n";
			// define venue vars from Training Sites table
			while($row = mysqli_fetch_assoc($result_s)) {
			   $id = $rid = $row['id'];
			   $city      = $row['loc_city'];
			   $url       = $row['loc_url'];	
			   $loc       = $row['loc'];			   	
			   $loc_id    = $lid = $row['loc_id'];
			   $visible   = (isset($row['visible']) && $row['visible'] == 1) ? "YES" : "NO";
			   
			   //define date vars for the venue from Training Dates table
			   if($result_d = mysqli_query($link,"SELECT * FROM $trainingDatesTBL WHERE loc_id = '$loc_id' ORDER BY year DESC,starts ASC")) {
				  if (mysqli_num_rows($result_d) > 0 ) {
	  
				     $date_show = '';
					 while($row = mysqli_fetch_assoc($result_d)) {					  
					    $year      = $row['year'];
						$starts    = strtotime($row['starts']);
						$ends      = strtotime("+2 days",$starts);
						$starts    = date("n/j/Y", $starts);
						$ends      = date("n/j/Y", $ends);						
						$date_line = $starts;		
						$date_show = $date_show . $date_line . "&nbsp;&nbsp;&nbsp;";
					 } // endwhile training date info is available
	  
				  } else { $date_show = "None scheduled"; } // endif mysqli_num_rows($result_d) > 0
				  
				  echo "<tr>\n";
				  echo "<td class='td_1'><a href='" . $trainingskedEDIT . "?loc_id=$loc_id'>" . $city . "</a></td>";
				  echo "<td class='td_2'>" . $loc . "</td>";
				  echo "<td class='td_3'>" . $date_show . "</td>";
				  echo "<td class='td_4'>" . $visible . "</td>";
				  echo "</tr>\n";	
				
			   } else { echo "<tr><td colspan='4'>Database problem</td></tr>\n";} 
			}
			echo "</tbody>\n";
			echo "</table>\n"; 
		 } else { $errorMsg['dbf_empty'] = "No info available"; return $errorMsg; exit; }
	   } else { $errorMsg['dbf_prob'] = "Database problem"; return $errorMsg; exit; }	
	  } else { $errorMsg['no_connect'] = "Cannot Connect to Database";return $errorMsg;exit; }
	  mysqli_free_result($result_s);
	  mysqli_free_result($result_d);
      ?>
      	       	  	        
      <div class='clearAll'></div>

   </div> <!-- end content  -->
  
   <div class='clearAll'></div>
  
   <!--FOOTER-->
   <div id="footer"> 
     <?php showBottomMenu(); showCopyright($thisYear); ?>
   </div><!-- end footer -->
 
<div class='clearAll'></div>

</div><!-- end #playround -->
</body>
</html>
