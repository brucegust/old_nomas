<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_testsked_1.php"; // top nav menu
include_once "_inc/inc_app_testsked.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // located in _always.php
check_permission($pg_level,$u_token); // located in _always.php

//*****************************************************************
//*****************************************************************
//*****************************************************************
$todayIs      = date("l, F jS, Y");
$errorMsg     = array();
$pageTitle    = "NOMAS<sup>&reg;</sup> Relicensing and Reliability Testing Summary";
$pageSubTitle = "Click buttons above or links below to work with specific tests.";
//*****************************************************************
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
      
	  <?php
      $testHeaders = getTestNumsArray();
	  if(array_key_exists('dbf_problem', $testHeaders) || array_key_exists('table_empty', $testHeaders)) {
	     $errorMsg = $testHeaders;	
	  }
	  ?>
      
      <?php if(isset($errorMsg) && count($errorMsg) > 0) { ?>
      <table class='error_table'>
         <tr>
            <td>
            <?php foreach($errorMsg as $val) { echo $val; } ?>				
            </td>
         </tr>         
      </table>
      <div class='clearAll'></div>
      
      <?php exit; } ?>
                 
      <table class='list_table'>
         <thead>
         <tr>
            <th class='th_1'>RELIABILITY</th>            
            <th class='th_2'>Total Assigned</th>
            <th class='th_3'>Underway</th>
            <th class='th_4'>Completed</th>
         </tr>  
         </thead>
         <tbody>         
         <?php      
		 $testnum = "Test number ";
	     foreach($testHeaders as $v ) {
			 if($v == '2' || $v == '3') {
			    $test_is    = $v;
			    $test_tot   = getTestTot($v);
			    $test_begun = getTestStatus($v,"winopen");
			    $test_done  = getTestStatus($v,"winclose");			 
			    echo "<tr>";
			    echo "<td class='td_1'><a href='index_app_testsked_list.php?sid=$v'>" . $testnum . $v . ":</a></td>";
			    echo "<td class='td_2'>" . $test_tot . "</td>";
			    echo "<td class='td_3'>" . $test_begun . "</td>";
			    echo "<td class='td_4'>" . $test_done . "</td>";
			    echo "</tr>";		  		  
			 }
	     }      
         ?>         
         </tbody>       
      </table>
      
      <div class='clearAll'></div>
                 
      <table class='list_table'>
         <thead>
         <tr>
            <th class='th_1'>RELICENSING</th>            
            <th class='th_2'>Total Assigned</th>
            <th class='th_3'>Underway</th>
            <th class='th_4'>Completed</th>
         </tr>  
         </thead>
         <tbody>         
         <?php      
		 $testnum = "Test number ";
	     foreach($testHeaders as $v ) {
			 if($v == '4' || $v == '5') {
			    //$test_is    = $v;
			    $test_tot   = getTestTot($v);
			    $test_begun = getTestStatus($v,"winopen");
			    $test_done  = getTestStatus($v,"winclose");		
				$test_show  = ($v == '4') ? "1" : "2";
			    echo "<tr>";
			    echo "<td class='td_1'><a href='index_app_testsked_list.php?sid=$v'>" . $testnum . $test_show . ":</a></td>";
			    echo "<td class='td_2'>" . $test_tot . "</td>";
			    echo "<td class='td_3'>" . $test_begun . "</td>";
			    echo "<td class='td_4'>" . $test_done . "</td>";
			    echo "</tr>";		  		  
			 }
		 }
         ?>         
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
