<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";
include_once "_nav/nav_app_testsked_0.php";
include_once "_inc/inc_app_testsked.php";

$pg_level = $lvl_2;
$u_token  = getToken(); 
check_permission($pg_level,$u_token);

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Schedule a NOMAS<sup>&reg;</sup> License Renewal or Reliability Test";
$pageSubTitle = "Make entries as required, click 'Save Entry' to preserve, 'Cancel Entry' to quit without saving.";
$errorMsg     = array();

$tallBreak    = "<div style='clear:both;height:1px; width:90%;'></div>";
$tallerBreak  = "<div style='clear:both;height:5px; width:90%;'></div>";

//*****************************************************************
//*****************************************************************
//*****************************************************************

$ordernum   = time();

// vars for form
$id         = (isset($_POST['id'])        && !empty($_POST['id']))        ? $_POST['id']        : '';
$entered    = (isset($_POST['entered'])   && !empty($_POST['entered']))   ? $_POST['entered']   : $today;
$name       = (isset($_POST['name'])      && !empty($_POST['name']))      ? $_POST['name']      : '';
$email      = (isset($_POST['email'])     && !empty($_POST['email']))     ? $_POST['email']     : '';
$ordernum   = (isset($_POST['ordernum'])  && !empty($_POST['ordernum']))  ? $_POST['ordernum']  : $ordernum;
$testnum    = (isset($_POST['testnum'])   && !empty($_POST['testnum']))   ? $_POST['testnum']   : '';
$weekopen   = (isset($_POST['weekopen'])  && !empty($_POST['weekopen']))  ? $_POST['weekopen']  : $today;

// Cancel ops
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cancel'])) {
  header("Location: $testskedMain");
  exit;
}    

// save edited data to web_briefs table and return to index_website_briefs.php if success
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $errorMsg = addTest($_POST, $testskedAdd);	     
}  

if(isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
   $msg   = "Test Scheduled Successfully! Click 'Main Menu' above to proceed.";
   $okMsg = (isset($_REQUEST['name']) && !empty($_REQUEST['name'])) ? $_REQUEST['name'] . " " . $msg : $msg;
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
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
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
        if (isset($errorMsg) && count($errorMsg) > 0 ) {
		   echo "<div class='error_box'>\n";
           echo "<table class='problem_msg_table'>\n";
		   echo "<tr><td>ENTRY NOT SAVED!</td></tr>\n";
		   foreach($errorMsg as $val) {
		      echo "<tr><td>" . $val . "</td></tr>\n";
		   }
           echo "</table>\n";                 
        }
		  
	    // add another entry
	    if(isset($okMsg) && !empty($okMsg)) {
	       echo "<div class='ok_msg'>" . $okMsg . "<br></div>\n"; exit;			
	    }  	 	  		  
	    echo "</div>";
	    ?>     
      
        <!-- DISPLAY TEST INFO-->
        <div class='testsked_form_add_box'>
        
            <form id="testsked_add" action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST" novalidate>
                
                <input name="id" type="hidden" value="<?php echo $id; ?>">
                <input name="entered" type="hidden" value="<?php echo $entered; ?>">                                          
                
                <?php echo $tallBreak; ?>                
                
                <label for="testnum">Test Number:</label>
                <select name="testnum">
                   <option value="<?php echo $testnum;?>"><?php echo $testnum;?></option>                   
                   <option value="2">Reliability Test #2</option>
                   <option value="3">Reliability Test #3</option>
                   <option value="4">Re-Licensing Test #1</option>
                   <option value="5">Re-Licensing Test #2</option>
                </select>
                <?php $testnum = $_POST['selected']; ?>                
                <div class='caption'>Click dropdown to select.</div>
                
                <?php echo $tallBreak; ?>                
                
                <label for="name">Name:</label>
                <input name="name" type="text" value="<?php echo $name ?>" size="30" maxlength="100">       
                <div class='caption'>First and Last.</div>
                
                <?php echo $tallBreak; ?>                
                
                <label for="email">Client Email:</label>
                <input name="email" type="text" value="<?php echo $email ?>" size="30" maxlength="100">        
                <div class='caption'>Required for client login.</div>   
                
                <?php echo $tallBreak; ?>                
                
                <label for="ordernum">Order Number:</label>
                <input name="ordernum" type="text" value="<?php echo $ordernum ?>" size="30" maxlength="20">        
                <div class='caption'>DO NOT CHANGE. Give this number to the client for login.</div>                        
                             
                <?php echo $tallBreak; ?>                
                               
                <label for="weekopen">Week Begins:</label>
                <input name="weekopen" id="datepicker0" type="text" value="<?php echo $weekopen ?>" size="30" maxlength="10">    
                <div class='caption'>Click date for pop-up calendar. This date starts the 7-day availability period.<br>Manual entry must be formatted "yyyy-mm-dd".</div>  
                            
                <?php echo $tallerBreak; ?>                
                
                <button type="submit" name="submit" value="submit">Save Entry (Click only once!)</button>            
                <button type="submit" name="cancel" value="submit">Cancel Entry (No save)</button>      
                <?php echo $tallerBreak; ?>                 
                <?php echo $tallerBreak; ?>                 
            </form>

            
        </div><!--end textsked_box-->     
                
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
