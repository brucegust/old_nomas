<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_licensees_1.php"; // top nav menu
include_once "_inc/inc_app_licensees.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // located in inc/cms_always.php
check_permission($pg_level,$u_token); // located in inc/cms_always.php

$limitTo  = '';
$errorMsg = array();

//*****************************************************************
//*****************************************************************
//*****************************************************************  

// DATES
$todayIs           = date("l, F jS, Y");

if($link = db_connect_site()) {
   $totalMemsL        = getMemTotalL();
   $totalMemsU        = getMemTotalU();
   $totalMems         = ($totalMemsL + $totalMemsU);
   $usaMemsL          = getMemUSAL();
   $usaMemsU          = getMemUSAU();
   $totalMemsUsa      = ($usaMemsL + $usaMemsU);
   $usaStates         = getUsaStates();
   $usaCities         = getUsaCities();
   $intlMemsL         = getMemIntlL();
   $intlMemsU         = getMemIntlU();
   $totalMemsIntl     = ($intlMemsL + $intlMemsU);   
   $intlCountries     = getIntlCountries();
   $intlCities        = getIntlCities();
   
   $pageTitle         = $totalMems . " NOMAS<sup>&reg;</sup> Practice Videos";
   $pageSubTitle      = "Click on a link to view a video and to display link that you'll send to a student in order to view it. To give a student access to all of the videos in a series, click on either &quot;Flaccid Tongue&quot; or &quot;Retracted Tongue&quot;.";
} else {
   	$pageTitle         = "Practitioners database currently unavailable";
    $pageSubTitle      = "Try again later";
}
 		  
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
<link href="_css/css_tables_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">

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
      ?>
      
      <div class='clearAll'></div>    
      
      <?php	echo "<div class='clearAll'></div>\n"; ?>
      
      <table class='list_table'>
         <thead>
         <tr>
            <th class='th_2'>VIDEOS</th>
         </tr>  
         </thead>
         <tbody> 
		 <tr>
			<td class="td_1" style="background-color:#000000; color:#fff;"><a href="../display_video.php?video=flaccid" style="color:#fff;">Flaccid Tongue</a></td>
		</tr>
         <tr>
            <td class='td_1'><a href="../display_video.php?video=1">Video #1</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=2">Video #2</a></td>
         </tr> 	
		<tr>
            <td class='td_1'><a href="../display_video.php?video=3">Video #3</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=4">Video #4</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=5">Video #5</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=6">Video #6</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=7">Video #7</a></td>
         </tr> 	
		<tr>
            <td class='td_1'><a href="../display_video.php?video=8">Video #8</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=9">Video #9</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=10">Video #10</a></td>
         </tr>  	
		<tr>
				<td class="td_1" style="background-color:#000000; color:#fff;"><a href="../display_video.php?video=retracted" style="color:#fff;">Retracted Tongue</a></td>
		</tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=11">Video #1</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=12">Video #2</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=13">Video #3</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=14">Video #4</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=15">Video #5</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=16">Video #6</a></td>
         </tr> 
		<tr>
            <td class='td_1'><a href="../display_video.php?video=17">Video #7</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=18">Video #8</a></td>
         </tr>  
		<tr>
            <td class='td_1'><a href="../display_video.php?video=19">Video #9</a></td>
         </tr>
		<tr>
            <td class='td_1'><a href="../display_video.php?video=20">Video #10</a></td>
         </tr>		 
         </tbody>
      </table>

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
