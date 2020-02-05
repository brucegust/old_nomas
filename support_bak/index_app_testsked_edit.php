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

$pageTitle    = "Edit a License Renewal or Reliability Test";
$pageSubTitle = "<span style='font-weight:bold;'>To extend the time a test can be taken: Change 'Window Closes' to the new closing date. Save the entry.</span>";
$errorMsg     = array();

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(isset($_REQUEST['mid'])) {
  $mid = $_REQUEST['mid'];
}

// vars for tests
$id         = (isset($_POST["id"])        && !empty($_POST["id"]))        ? $_POST["id"]        : $mid;
$entered    = (isset($_POST['entered'])   && !empty($_POST['entered']))   ? $_POST['entered']   : '';
$name       = (isset($_POST['name'])      && !empty($_POST['name']))      ? $_POST['name']      : '';
$email      = (isset($_POST['email'])     && !empty($_POST['email']))     ? $_POST['email']     : '';
$ordernum   = (isset($_POST['ordernum'])  && !empty($_POST['ordernum']))  ? $_POST['ordernum']  : '';
$testnum    = (isset($_POST['testnum'])   && !empty($_POST['testnum']))   ? $_POST['testnum']   : '';
$weekopen   = (isset($_POST['weekopen'])  && !empty($_POST['weekopen']))  ? $_POST['weekopen']  : '';
$weekclose  = (isset($_POST['weekclose']) && !empty($_POST['weekclose'])) ? $_POST['weekclose'] : '';
$winopen    = (isset($_POST['winopen'])   && !empty($_POST['winopen']))   ? $_POST['winopen']   : '';
$winclose   = (isset($_POST['winclose'])  && !empty($_POST['winclose']))  ? $_POST['winclose']  : '';

if(isset($mid) && !empty($mid)) {
	
   if($link = db_connect_site()) {
	   
	  if($result = mysqli_query($link,"SELECT * FROM $testskedTBL WHERE id = $mid LIMIT 1")) {	
   
		 if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);  
			$id = $mid = $row['id'];
			$entered   = $row['entered'];
			$name      = $row['name'];
			$email     = $row['email'];
			$ordernum  = $row['ordernum'];
			$testnum   = $row['testnum'];  
			$weekopen  = $row['weekopen'];
			$weekclose = $row['weekclose'];
			$winopen   = $row['winopen'];
			$winclose  = $row['winclose'];   
		  } else { $errorMsg['dbf_empty1'] = "Database empty"; }	
	  } else { $errorMsg['dbf_error'] = "Database problem. Cancel edit and try again."; }
   } else { $errorMsg['no_connect'] = "Cannot connect to database"; }
}

// Cancel ops
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cancel'])) {
  header("Location: $testskedMain");
  exit;
}    

// save edited data to web_briefs table and return to index_website_briefs.php if success
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $errorMsg = updateTest($_POST, $testskedEdit);	   
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
  $(document).ready(function() {
    $("#datepicker1").datepicker({ dateFormat: 'yy-mm-dd' });
  });  
  $(document).ready(function() {
    $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
  });
  $(document).ready(function() {
    $("#datepicker3").datepicker({ dateFormat: 'yy-mm-dd' });
  });
  $(document).ready(function() {
    $("#datepicker4").datepicker({ dateFormat: 'yy-mm-dd' });
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
	       echo "<div class='ok_msg'>" . $okMsg . "<br></div>\n";	
		   exit;		
	    }  	 	  		  
	    echo "</div>";
	    ?>     
      
        <!-- DISPLAY TEST INFO-->
        <div class='testsked_form_add_box'>
        
            <form id="testsked_add" action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST" novalidate>
                
                <input name="id" type="hidden" value="<?php echo $id ?>">                     
                
                <div style='clear:both;height:26px; width:90%;'></div>                
                
                <label for="entered">Entered:</label>
                <input name="entered" id="datepicker0" type="text" value="<?php echo $entered ?>">  
                <div class='caption'>Date this test was entered. Click date to change (yyyy-mm-dd).</div>               
                
                <label for="testnum">Test Number:</label>
                <select name="testnum">
                   <option value="<?php echo $testnum;?>"><?php echo $testnum;?></option>                   
                   <option value="2">#2 - Reliability Test</option>
                   <option value="3">#3 - Reliability Test</option>
                   <option value="4">#4 - NOMAS<sup>&reg;</sup> License Renewal</option>           
                </select>
                <?php $testnum = $_POST['selected']; ?>                
                <div class='caption'>Click to select. Reliability = 2 or 3. Re-licensing = 4.</div>
                
                <div style='clear:both;height:6px; width:90%;'></div>
                
                <label for="name">Name:</label>
                <input name="name" type="text" value="<?php echo $name ?>" size="30" maxlength="100">       
                <div class='caption'>First and Last.</div>
                
                <div style='clear:both;height:6px; width:90%;'></div>
                
                <label for="email">Client Email:</label>
                <input name="email" type="text" value="<?php echo $email ?>" size="30" maxlength="100">        
                <div class='caption'>Required for login.</div>   
                
                <div style='clear:both;height:6px; width:90%;'></div>     
                
                <label for="ordernum">Order Number:</label>
                <input name="ordernum" type="text" value="<?php echo $ordernum ?>" size="30" maxlength="20">        
                <div class='caption'>Required for login. Change this number only if you know what you are doing.</div>                        
                             
                <div style='clear:both;height:6px; width:90%;'></div>
                               
                <label for="weekopen">Week Begins:</label>
                <input name="weekopen" id="datepicker1" type="text" value="<?php echo $weekopen ?>" size="30" maxlength="10">    
                <div class='caption'>Click date for pop-up calendar. Manual entry must be formatted "yyyy-mm-dd".</div>  
                
                <label for="weekclose">Week Ends:</label>
                <input name="weekclose" id="datepicker2" type="text" value="<?php echo $weekclose ?>" size="30" maxlength="10">   
                <div class='caption'>Click date for pop-up calendar. Manual entry must be formatted "yyyy-mm-dd".</div>    
                
                <label for="winopen">Window Opens:</label>
                <input name="winopen" id="datepicker3" type="text" value="<?php echo $winopen ?>" size="30" maxlength="10">    
                <div class='caption'>Click date for pop-up calendar. Manual entry must be formatted "yyyy-mm-dd".</div>  
                
                <label for="winclose">Window Closes:</label>
                <input name="winclose" id="datepicker4" type="text" value="<?php echo $winclose ?>" size="30" maxlength="10">   
                <div class='caption'>Click date for pop-up calendar. Manual entry must be formatted "yyyy-mm-dd".</div>                                 
                            
                <div style='clear:both;height:6px; width:90%;'></div>                        
                
                <button type="submit" name="submit" value="submit">Save Entry</button>            
                <button type="submit" name="cancel" value="submit">Cancel Entry (No save)</button>        
                
                <div style='clear:both;height:18px; width:90%;'></div>     
   
            </form>
            
        <div style='clear:both;height:18px; width:90%;'></div>     
                        
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
