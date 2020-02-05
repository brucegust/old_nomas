<?php 

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";				// frequently used procedural functions
include_once "_nav/nav_app_trainingsked_1.php";	// top nav menu
include_once "_inc/inc_app_trainingsked.php";	// local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // located in _always.php
check_permission($pg_level,$u_token); // located in _always.php

//*****************************************************************
//*****************************************************************
//*****************************************************************

$errorMsg     = array();
$pageTitle    = "Add a NOMAS<sup>&reg;</sup> Training Site";
$pageSubTitle = "Adds a facility and city to your training site database";

//*****************************************************************
//*****************************************************************
//*****************************************************************
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $errorMsg = add_training_site($_POST);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['no_save'])) {
   $redir = $trainingskedMain;
   header("Location: $redir"); 
}

// connect
if(!$link = db_connect_site()) {   	
   $errorMsg['no_connect'] = "Cannot connect to the database"; }

// get max loc_id	  
if(!$result = mysqli_query($link, "SELECT MAX(loc_id) FROM $trainingSitesTBL LIMIT 1")) {	
   $errorMsg['dbf_query'] = "Sites Database access error"; }
      
// increment highest loc number for this entry
if(mysqli_num_rows( $result ) == 1 ) {
   while($row = mysqli_fetch_row($result)) {;  
      $loc_id = $row[0] + 1;
   }
} else { $loc_id = '100'; }

// form vars
$id        = (isset($_POST["id"])        && !empty($_POST["id"]))        ? $_POST["id"]        : "";
$loc       = (isset($_POST["loc"])       && !empty($_POST["loc"]))       ? $_POST["cert_num"]  : "";
$loc_id    = (isset($_POST["loc_id"])    && !empty($_POST["loc_id"]))    ? $_POST["loc_id"]    : $loc_id;
$loc_city  = (isset($_POST["loc_city"])  && !empty($_POST["loc_city"]))  ? $_POST["loc_city"]  : "";
$loc_url   = (isset($_POST["loc_url"])   && !empty($_POST["loc_url"]))   ? $_POST["loc_url"]   : "";
$visible   = (isset($_POST["visible"])   && !empty($_POST["visible"]))   ? $_POST["visible"]   : 1;
$date_0    = (isset($_POST["date_0"])    && !empty($_POST["date_0"]))    ? $_POST["date_0"]    : '';
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
echo $jq_slidemenu . "\n"; 
?>
<script>
<!--
$(document).ready(function() {
   $("#datepicker0").datepicker({ dateFormat: 'yy-mm-dd' });
});
-->  
</script>
</head>

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
		 if($continue) {
		    $pageTitle = $loc . " " . $loc_city;
		 }
         echo "<div class='pageTitle'>" . $pageTitle . "</div>\n";
      }
	     
      if (isset($pageSubTitle) && $pageSubTitle > '') {
         echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
      } 
	  ?>
      
      <?php 
	  // show errors from array
	  if (isset($errorMsg) && !empty($errorMsg)) { ?>
      <table class='sked_table'>
	     <tr>
		    <td colspan='8'>
               <div class='error_msg'>
               <?php foreach($errorMsg as $val) { echo $val . '<br>'; } ?>
               </div>
            </td>
         </tr>
	  </table>	  
      <?php } ?>
      
      <div class='clearAll'></div>	    
		 	     
      <!--NEW TRAINING SITEENTRY-->  
      <form name="new_site" id="new_site" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
         <input type="hidden" name="id" value="<?php echo $id; ?>" />
         <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
         <input type="hidden" name="visible" value="<?php echo $visible; ?>" />
         
         <table class='edit_training_table'>         
            <tr>
               <th colspan='2'>Enter information about this training site:</th>
            </tr>
            
            <tr><td colspan='2'>&nbsp;</td></tr>            
            
            <tr>   
               <td><label for='loc_id'>Site ID:</label></td><td><?php echo $loc_id; ?></td>
            </tr>
            <tr>
               <td><label for='loc'>Facility Name:</label></td>      
               <td><input name="loc" type="text" value="<?php echo htmlspecialchars($loc) ?>" size="100" maxlength="100"></td>
            </tr>
            <tr>
               <td><label for='loc_city'>City, State (xxxx, XX):</label></td>
               <td><input name="loc_city" type="text" value="<?php echo htmlspecialchars($loc_city) ?>" size="100" maxlength="100"></td>
            </tr>
            <tr>
               <td><label for='loc_url'>URL*:</label></td>
               <td><input name="loc_url" type="text" value="<?php echo htmlspecialchars($loc_url) ?>" size="100" maxlength="250"></td>
            </tr>                 
            <tr>
               <td><label for='loc_url'>Training Start Date?</label></td>
               <td><input id="datepicker0" type="text" name="date_0" value="<?php echo htmlspecialchars($date_0); ?>"></td>               
            </tr> 
               
            <tr><td colspan='2'>&nbsp;</td></tr>            
            
            <tr>
               <td colspan='2' class='caption'>*URL - directions to the facility, usually available on the facility's website. Copy & paste the link from the facility's site to the URL box.</td>
            </tr>   
            <tr><td colspan='2'>&nbsp;</td></tr>            
            
            <tr>
               <td colspan='3'>
                  <button style='float:left;' type="input" name="submit" value="submit">Click to SAVE this training site</button>
                  <button style='float:right;margin-right:20px;' type="input" name="no_save" value="no_save">Return to List of Facilities (NO SAVE)</button>
               </td>
            </tr>                
         </table> 
      </form>	                                      
	        
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
