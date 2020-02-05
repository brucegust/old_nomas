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
$pageTitle    = "Edit Training Site Date and Information";
$pageSubTitle = "On this page you can delete/add NOMAS training dates and other information for this location";

$continue     = true;

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(isset($_REQUEST['loc_id']) && $_REQUEST['loc_id'] > '') {	
    $loc_id = $_REQUEST['loc_id'];
}     

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_facility'])) {
   $_POST['visible']  = (isset($_POST['visible']) )  ? "1" : "0";	
   $errorMsg = update_facility($_POST);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['replace_url'])) {
   $errorMsg = update_location_url($_POST);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_indy'])) {
   $holder = $_POST['del_indy'];
   if(count($holder)) {	   
      $errorMsg = delete_location_dates($holder,$_POST['loc_id']);
   } else { $_GET['ok_dates'] = "No dates checked"; }  
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_dates'])) {
   if(isset($_POST['date_0']) && !empty($_POST['date_0'])) {
	   $errorMsg = add_course_date($_POST);
   } else { $_GET['no_date'] = "Make sure date is entered entered correctly: YYYY-MM-DD.";};
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['no_save'])) {
   $redir = $trainingskedMain;
   header("Location: $redir"); 
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_all'])) {
   $errorMsg = delete_location($_POST);
} 

//*****************************************************************
//*****************************************************************
//*****************************************************************

if($link = db_connect_site()) {   	
   if($result = mysqli_query($link, "SELECT * FROM $trainingSitesTBL WHERE loc_id = '$loc_id' LIMIT 1")) {	
      if (mysqli_num_rows($result) > 0 ) {
         while($row = mysqli_fetch_assoc($result)) {
		    $id = $rid = $row['id'];
			$loc_city  = $row['loc_city'];
			$loc       = $row['loc'];
			$loc_url   = $row['loc_url'];			
			$loc_id    = $lid = $row['loc_id'];		
			$visible   = $row['visible'];
			$vizChk    = ($row['visible'] == '1') ? "checked='checked'" : "";				 
		 }		  
		 if(!isset($loc_url) || empty($loc_url)) {
			$_GET['no_url'] = 'No URL Stored';
		 }
		 mysqli_free_result($result);
	  } else { $errorMsg['dbf_empty'] = "Site Database empty"; }
   } else { $errorMsg['dbf_query'] = "Site Database problem"; $continue = false; }   
} else { $errorMsg['no_connect'] = "Cannot connect to Sites database"; $continue = false; }

if($continue) {
   if($link = db_connect_site()) {   	
	  if($result = mysqli_query($link, "SELECT * FROM $trainingDatesTBL WHERE loc_id = '$loc_id' ORDER BY starts DESC")) {	
		 if (mysqli_num_rows($result) > 0 ) {
			while($row = mysqli_fetch_assoc($result)) {
			   $starts[$row['did']] .= $row['starts'];
			}		  
			mysqli_free_result($result);
		 } else { $_GET['dbf_empty'] = "No Dates Stored"; }
	  } else { $errorMsg['dbf_query'] = "Date Database problem"; $continue = false; }   
   } else { $errorMsg['no_connect'] = "Cannot connect to Dates database"; $continue = false; }		
} // continue	   
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
		    $pageTitle = $loc . " - " . $loc_city;
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
		 
	  <?php if($continue) { ?>
      
         <!--DELETE COURSE START DATES-->  
         <form name="facility" id="facility" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate />
            <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
            <table class='edit_training_table'>         
               <tr>
                  <th colspan='3'>The Training Site</th>
               </tr>   

               <tr>
                  <td><label for='loc'>Facility Name:</label></td>
                  <td><input type="text" name="loc" value="<?php echo htmlspecialchars($loc); ?>" size="70" maxlength="50"></td>
                  <td>&nbsp;</td>
               </tr>
               
               <tr>
                  <td><label for='loc_city'>City:</label></td>
                  <td><input type="text" name="loc_city" value="<?php echo htmlspecialchars($loc_city); ?>" size="70" maxlength="50"></td>
                  <td>&nbsp;</td>
               </tr>            
               <tr>
                  <td><label for='visible'>Visible on website?</label></td>
                  <td><input style='width:3%;height:18px;' type="checkbox" name="visible" value="<?php echo $visible; ?>" <?php echo $vizChk ?> size="10" maxlength="5"></td>
                  <td>&nbsp;</td>
               </tr>                     
               <tr><td colspan='3'>&nbsp;</td></tr>            
               
               <tr>
                  <td colspan='3'>
                     <button type="input" name="edit_facility" value="edit_facility">Click to save facility info</button>
                  </td>
               </tr>             
               <?php if($_GET['ok_facility'] == 'Updated OK') { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['ok_facility']; ?></td>
               </tr>                
               <?php } ?>                           
            </table> 
         </form>	                 
	     
         <!--DELETE COURSE START DATES-->  
         <form name="del-dates" id="del-dates" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
            <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
            <input type="hidden" name="loc_city" value="<?php echo $loc_city; ?>" />
            <input type="hidden" name="loc" value="<?php echo $loc; ?>" />
            <table class='edit_training_table'>         
               <tr>
                  <th>These are the existing course start dates for <?php echo $loc; ?>:</th><th>DELETE</th><th>&nbsp;</th>
               </tr>   
               <?php 			
			   $del_indy = array();
               foreach ($starts as $key=>$val) { ?>
                  <tr>
                     <td><label for='del_indy'><?php echo "Course start date: " . date("n/j/Y", strtotime($val)); ?></label></td>
                     <td><input type="checkbox" name="del_indy[]" value="<?php echo $key; ?>"<?php echo $key; ?>></td>
                     <td>&nbsp;</td>
                  </tr>
               <?php }	?>                
               
               <tr><td colspan='3'>&nbsp;</td></tr>            
               
               <tr>
                  <td colspan='3'>
                     <button type="input" name="delete_indy" value="delete_indy">Checkmark date(s) to delete, then click here.</button>
                  </td>
               </tr>             
               <?php if($_GET['ok_dates'] == 'Deleted OK') { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['ok_dates']; ?></td>
               </tr>                
               <?php } ?>   
               
               <?php if(isset($_GET['dbf_empty']) && !empty($_GET['dbf_empty'])) { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['dbf_empty']; ?></td>
               </tr>                
               <?php } ?>                  
            </table> 
         </form>	                                  

         <!--ADD COURSE START DATES-->  
         <form name="nu-dates" id="nu-dates" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
            <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
            <input type="hidden" name="loc_city" value="<?php echo $loc_city; ?>" />
            <input type="hidden" name="loc" value="<?php echo $loc; ?>" />
            <table class='edit_training_table'> 
               <tr>
                  <th colspan='3'>Enter new start dates for <?php echo htmlspecialchars($loc); ?> (yyyy-mm-dd):</th>                  
               </tr>   
               <tr>
                  <td colspan='3'>
                  <?php $startTitle = "<label for='date_0'>Click inside the box to enter a date using the pop-up calendar. Make sure you're in the right year!</label> "; ?>
                  <?php echo $startTitle; ?> &nbsp; <input id="datepicker0" type="text" name="date_0" value="<?php echo htmlspecialchars($date_0); ?>"> 
                  </td>               
               </tr>   
               <tr><td colspan='3'>&nbsp;</td></tr>            
               <tr>
                  <td colspan='3'>
                     <button type="input" name="add_dates" value="add_dates">Click to save the start date</button>
                  </td>
               </tr>   
               <?php if(isset($_GET['no_date']) && !empty($_GET['no_date']) ) { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['no_date']; ?></td>
               </tr>                
               <?php } ?>   
               <?php if(isset($_GET['ok_date']) && $_GET['ok_date'] == "Date Added") { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['ok_date']; ?></td>
               </tr>                
               <?php } ?> 
            </table> 
         </form>		
         
         <!--URL-->  
         <form name="change-url" id="change-url" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
            <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
            <input type="hidden" name="loc_city" value="<?php echo $loc_city; ?>" />
            <input type="hidden" name="loc" value="<?php echo $loc; ?>" />
            <table class='edit_training_table'>
               <tr>
                  <th colspan='3'>Travel directions to the location. Copy and paste URL from the location's website. Clear box and save if URL is unavailable:</th>
               </tr>
               <tr>
                  <td><label for='loc_url'>URL:</label></td>
                  <td colspan='2'><input type="text" name="loc_url" value="<?php echo htmlspecialchars($loc_url); ?>" maxlength="200" style='width:840px;' /></td>
               </tr>      
               <tr><td colspan='3'>&nbsp;</td></tr>            
               <tr>
                  <td colspan='3'>
                     <button type="input" name="replace_url" value="replace_url">Click to save the URL</button>
                  </td>
               </tr>    
               <?php if($_GET['ok_url'] == 'URL Saved') { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['ok_url']; ?></td>
               </tr>                
               <?php } ?> 
               <?php if(isset($_GET['no_url']) && !empty($_GET['no_url'])) { ?>
               <tr>
                  <td colspan='3' style='color:#006600;font-weight:bold;'><?php echo $_GET['no_url']; ?></td>
               </tr>                
               <?php } ?>                      
            </table> 
         </form>			               

         <!--CANCEL-->         
         <form name="no_save" id="no_save" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
            <table class='edit_training_table'>                                                                                                       
               <tr>
                  <td colspan='3'>
                     <button type="input" name="no_save" value="no_save">Return to List of Facilities (NO SAVE)</button>
                  </td>
               </tr>                      
            </table> 
         </form>			                   
                  
         <form name="del-all" id="del-all" class='edit_training_form' method='POST' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" accept-charset="utf-8" novalidate>
            <input type="hidden" name="loc_id" value="<?php echo $loc_id; ?>" />
            <input type="hidden" name="loc_city" value="<?php echo $loc_city; ?>" />
            <input type="hidden" name="loc" value="<?php echo $loc; ?>" />
            <table class='edit_training_table'>                                                                                                       
               <tr>
                  <td colspan='3'>
                     <button type="input" class="red_button" name="delete_all" value="delete_all">PERMANENTLY DELETE<br><?php echo htmlspecialchars($loc); ?></button>
                  </td>
               </tr>                      
            </table> 
         </form>			 

	  <?php } // end continue ?>       
	        
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
