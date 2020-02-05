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

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   if(isset($_POST['limitTo']) && $_POST['limitTo'] > '' ) {
		$redir = $membersList . "?limitTo=" . trim($_POST['limitTo']);
		header("location: $redir");
        exit;
   }
}    

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
   
   $pageTitle         = $totalMems . " NOMAS<sup>&reg;</sup> Trained Practitioners as of " . $todayIs;
   $pageSubTitle      = "Click buttons above or links below to see and work with information of interest";
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
      
	  <form method='POST' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
	  <table>
         <tr>
           <td colspan='8' class='search_txt'><?php echo $searchTitle ?>
           <input type='text' name='limitTo' />
           <button type='submit' name='submit' value='submit' class='submit'>GO</button> 
           </td>
         </tr>
      </table>
	  </form>	  	  	  
      
      <?php	echo "<div class='clearAll'></div>\n"; ?>
      
      <table class='list_table'>
         <thead>
         <tr>
            <th class='th_1'>&nbsp;</th>
            <th class='th_2'>TOTAL</th>
            <th class='th_3'>LICENSED</th>
            <th class='th_4'>EXPIRED</th>
         </tr>  
         </thead>
         <tbody> 
         <tr>
            <td class='td_1'>ALL Practitioners:</td>
            <td class='td_2'><a href='index_app_licensees_list.php?sid=all'><?php echo $totalMems; ?></a></td>
            <td class='td_3'><a href='index_app_licensees_list.php?sid=licensed'><?php echo $totalMemsL; ?></a></td>
            <td class='td_4'><a href='index_app_licensees_list.php?sid=unlicensed'><?php echo $totalMemsU; ?></a></td>
         </tr>                  
         <tr>
            <td class='td_1'>USA Practitioners:</td>
            <td class='td_2'><a href='index_app_licensees_list.php?sid=usa'><?php echo $totalMemsUsa; ?></a></td>
            <td class='td_3'><a href='index_app_licensees_list.php?sid=usa_l'><?php echo $usaMemsL; ?></a></td>
            <td class='td_4'><a href='index_app_licensees_list.php?sid=usa_u'><?php echo $usaMemsU; ?></a></td>
         </tr>
         <tr>
            <td class='td_1'>INTL Practitioners:</td>
            <td class='td_2'><a href='index_app_licensees_list.php?sid=intl'><?php echo $totalMemsIntl; ?></a></td>
            <td class='td_3'><a href='index_app_licensees_list.php?sid=intl_l'><?php echo $intlMemsL; ?></a></td>
            <td class='td_4'><a href='index_app_licensees_list.php?sid=intl_u'><?php echo $intlMemsU; ?></a></td>
         </tr>         
         <tr>
            <td class='td_5' colspan='4'>Practicing in</td>
         </tr>   
         <tr>
            <td class='td_1'>USA States:</td>
            <td class='td_2'><?php echo $usaStates; ?></td>
            <td class='td_3'>&nbsp;</td>
            <td class='td_4'>&nbsp;</td>
         </tr>
         <tr>
            <td class='td_1'>USA Cities:</td>
            <td class='td_2'><?php echo $usaCities; ?></td>
            <td class='td_3'>&nbsp;</td>
            <td class='td_4'>&nbsp;</td>
         </tr>
         <tr>
            <td class='td_1'>INTL Countries:</td>
            <td class='td_2'><?php echo $intlCountries; ?></td>
            <td class='td_3'>&nbsp;</td>
            <td class='td_4'>&nbsp;</td>         
         </tr>
         <tr>
            <td class='td_1'>INTL Cities:</td>
            <td class='td_2'><?php echo $intlCities; ?></td>
            <td class='td_3'>&nbsp;</td>
            <td class='td_4'>&nbsp;</td>         
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
