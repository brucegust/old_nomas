<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";
include_once "_nav/nav_app_testsked_0.php";
include_once "_inc/inc_app_testsked_olceu.php";

$pg_level = $lvl_2;
$u_token  = getToken(); 

check_permission($pg_level,$u_token);

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Edit Two-Day / Symposia Access Windows";
$pageSubTitle = "<span style='font-weight:bold;'>To extend the time a test can be taken: Change 'Window Closes' to the new closing date. Save the entry.</span>";
$errorMsg     = "";

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(isset($_REQUEST['mid'])) {
  $mid = $_REQUEST['mid'];
}

// vars for tests
$orderno   = (isset($_POST['orderno'])  && !empty($_POST['orderno']))  ? $_POST['orderno']  : $mid;
$name      = (isset($_POST['name'])     && !empty($_POST['name']))     ? $_POST['name']     : '';
$datetime  = (isset($_POST['datetime']) && !empty($_POST['datetime'])) ? $_POST['datetime'] : '';
$winopen   = (isset($_POST['winopen'])  && !empty($_POST['winopen']))  ? $_POST['winopen']  : '';
$winclose  = (isset($_POST['winclose']) && !empty($_POST['winclose'])) ? $_POST['winclose'] : '';

if(isset($mid) && !empty($mid)) {
	
   if($link = db_connect_site()) {
	   
	  if($result = mysqli_query($link,"SELECT * FROM $ceuusersTBL WHERE orderno = '$orderno' LIMIT 1")) {	
   
		 if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);  
			$orderno = $id = $mid = $row['orderno'];
			$name       = $row['name'];
			$itemnumber = $row['itemnumber'];
			$winopen    = $row['winopen'];
			$winclose   = $row['winclose'];    
		  } else { $errorMsg = "Database empty"; }	
	  } else { $errorMsg = "Cannot connect to database"; }
   } else { $errorMsg = "Cannot connect to databases"; }
}

// Cancel ops
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cancel'])) {
  header("Location: $testskedolceuMain");
  exit;
}    

// save edited data to web_briefs table and return to index_website_briefs.php if success
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $errorMsg = updateTest($_POST, $testskedolceuEdit);	   
}  

if(isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
   $msg   = "Update Successful! Click an option on the menu above to proceed.";
   $okMsg = (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) ? $_REQUEST['name'] . " " . $msg : $msg;
}
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
    $("#datepicker0").datepicker({ dateFormat: 'yy-mm-dd' });
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
      
    <!-- CONTENT -->
    
    <div id='content'>
    
        <?php 
	    if(isset($pageTitle) && $pageTitle > '') {
          echo "<div class='pageTitle'>" . $pageTitle . " " . $fname . " " . $lname . "</div>\n";
	    }
        if(isset($pageSubTitle) && $pageSubTitle > '') {
           echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
	    } 	  

	    //error messages
        if (isset($errorMsg) && !empty($errorMsg)) {
		   echo "<div class='error_box'>\n";
           echo "<table class='problem_msg_table'>\n";
		   echo "<tr><td>ENTRY NOT SAVED! " . $errorMsg . "</td></tr>\n";
           echo "</table>\n";                 
        }
		  
	    if(isset($okMsg) && !empty($okMsg)) {
	       echo "<div class='ok_msg'>" . $okMsg . "<br></div>\n";	
		   exit;		
	    }  	 	  		  
	    echo "</div>";
	    ?>     
      
        <!-- DISPLAY TEST INFO-->
        <div class='testsked_form_add_box'>
        
            <form id="testsked_add" action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST" novalidate>
                
                <div style='clear:both;height:12px; width:90%;'></div>                
                
                <div class='display_hidden'>Name: <?php echo $name; ?></div>
                <div class='display_hidden'>Order: <?php echo $orderno; ?></div>
                <div class='display_hidden'>Items: <?php echo $itemnumber; ?></div>
                
                <div style='clear:both;height:6px; width:90%;'></div>                

                <input name="name" type="hidden" value="<?php echo $name ?>" size="30" maxlength="100">       
                <input name="orderno" type="hidden" value="<?php echo $orderno ?>" size="30" maxlength="100">       
                <input name="itemnumber" type="hidden" value="<?php echo $itemnumber ?>" size="30" maxlength="100">       
                
                <label for="winclose">Window Closes:</label>
                <input name="winclose" id="datepicker0" type="text" value="<?php echo $winclose ?>" size="30" maxlength="10">   
                <div class='caption'>Click date for pop-up calendar to enter a new 'Window' closes date.<br>If entering the new date by hand, format must be "yyyy-mm-dd".</div>                                 
                            
                <div style='clear:both;height:12px; width:90%;'></div>                        
                
                <button type="submit" name="submit" value="submit">Save Change</button>            
                <button type="submit" name="cancel" value="submit">Cancel (No save)</button>   
                
                <div style='clear:both;height:18px; width:90%;'></div>
        
            </form>
                        
        </div><!--end textsked_box-->     
    
    </div> <!-- end content  -->
  
  <!--FOOTER-->
  <div id="footer"> 
    <?php showBottomMenu(); showCopyright($thisYear); ?>
  </div><!-- end footer -->
 
<div class='clearAll'></div>

</div><!-- end #playround -->

</body>
</html>
