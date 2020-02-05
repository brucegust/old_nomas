<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";

$pg_level = $lvl_2;
$u_token  = getToken(); // located in inc/_always.php
check_permission($pg_level,$u_token);

//*****************************************************************

$pageTitle = "NOMAS<sup>&reg;</sup> International";
$pageSubTitle = "Please select an activity:";

//*****************************************************************
//*****************************************************************
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
<link href="_css/css_main_menu.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="playground">

   <div id='header'><?php showSmallLogo(); ?></div>    
  
   <div class='clearAll'></div>

   <div id='playpen'>
    
      <div class='pageTitle'><?php echo $pageTitle ?></div>
      
      <?php if (isset($pageSubTitle) && $pageSubTitle > '') {
         echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	  } ?>
      
      <!-- select options menu -->
      <div class='options'>    
         <ul class="option_nav">         
            <li class='title'>THE NOMAS<sup>&reg;</sup> REGISTRY</li>
            <li><a href="index_app_licensees.php">Work with the Registry / see practitioner status</a></li>            
            <li><a href="index_app_licensees_add.php">Add a new NOMAS practitioner</a></li>            
            <li class='title'>&nbsp;</li>            
            <li class='title'>RELIABILITY & LICENSING TESTS</li>
            <li><a href="index_app_testsked.php">Summary report & 'access window' extensions</a></li>            
            <li><a href="index_app_testsked_add.php">Schedule a new Reliability or Licensing test</a></li>                                    
            <li class='title'>&nbsp;</li>
            <li class='title'>TWO-DAY AND SYMPOSIA TESTS</li>
            <li><a href="index_app_testsked_olceu_list.php">Summary report & 'access window' extensions</a></li>            
            <li class='title'>&nbsp;</li>
            <li class='title'>WEBSITE TRAINING SCHEDULE</li>
            <li><a href="index_app_trainingsked.php">Manage facilities and dates for NOMAS training</a></li> 
            <li class='title'>&nbsp;</li>
            <li style='font-weight:bold;'><a href="index_exit.php">LOG OUT</a></li>
         </ul>   
      </div> <!--end left nav-->
              
      <div class='clearAll'></div>
   </div> <!-- end playpen-->
  
   <div class='clearAll'></div>
  
   <!--FOOTER-->
   <div id="footer"><?php showCopyright($thisYear); ?></div><!-- end footer -->
  
   <div class='clearAll'></div>

</div><!-- end #playround -->
</body>
</html>
