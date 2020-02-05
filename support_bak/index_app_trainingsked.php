<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_trainingsked_1.php"; // top nav menu
include_once "_inc/inc_app_trainingsked.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // located in _always.php
check_permission($pg_level,$u_token); // located in _always.php

//*****************************************************************
//*****************************************************************
//*****************************************************************
$todayIs      = date("l, F jS, Y");
$errorMsg     = array();
$pageTitle    = "Edit Two-Day Course Schedule that appears on the website";
$pageSubTitle = "Click 'Site' to edit course dates or make the site visible/invisible on the website. To add a new training site, click 'Add a New Training Location' above.";
 		  
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
<link href="_css/css_forms_cms.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n"; 
echo $jq_ui_themes . "\n";
echo $jq_slidemenu . "\n"; 
?>
<script>
<!--
  $(document).ready(function() {
    $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
  });
-->  
</script>
</head>
<body>
<div id="playground">
  <div id='header'><?php showBigLogo(); ?></div>
  <div class='clearAll'></div>
  <!--TOP NAV-->  
  <div id='nav_box'>
     <div id='slidemenu' class='jqueryslidemenu'>
        <?php showTopNav($topNav) ?>
     </div>      
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
      
	  $showallSites = getandShowSites();

	  if(is_array($showallSites) && count($showallSites) > 0) {
		 if(in_array("No info available", $showallSites) || in_array("Database problem", $showallSites)) {
         $errorMsg = $showallSites;
		 echo "<table class='sked_table'>";
		 echo "<tr><td colspan='8'>";	
		 echo "<div class='error_msg'>";
		 foreach($errorMsg as $val) {
			echo $val . "<br>";
		  }
		  echo "</div></td></tr>";
		  echo " </table>";
		  exit;
		 }
	  } 
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
