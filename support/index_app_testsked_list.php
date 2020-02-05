<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_testsked_2.php"; // top nav menu
include_once "_inc/inc_app_testsked.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // make sure user's token hasn't changed
check_permission($pg_level,$u_token); // check valid for this page level

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Testing Appointments";
$pageSubTitle = "Click Name to edit. Click column headers to sort. To delete, check box and confirm at page bottom. Deletion is permanent!";
$errorMsg     = array();

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_test'])) {
   $errorMsg = deleteTest($_POST['del_me']);
   unset($_POST['delete_test']);
}		

if(isset($_REQUEST['sid'])) {
  $sid = $_REQUEST['sid'];
  if(isset($sid) && !empty($sid)) {
     $sid_msg = getSidMsg($sid);  
  }
  $pageTitle = $pageTitle . " For " . $sid_msg;
} else {
  $pageTitle = "All " . $pageTitle;   	
}

$showSked = getSked($sid); // retrieves any scheduled testing; returns as resource if success; returns as string on error
 		  
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
echo $jq_tablesorter . "\n";
?>
<script>
<!--
$(document).ready(function() {
	$("#myTable") .tablesorter({
        headers: { 8: { sorter: false }}, 	
	    widgets: ['zebra']}
	);
});

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
      ?>
      
      <div class='clearAll'></div>  
      
      <?php
      
	  // display error if no connect or database is empty
      if(!is_object($showSked) || mysqli_num_rows($showSked) == '0') {
  
          echo "<table class='member_table'>";
          if(isset($errorMsg) && count($errorMsg)) {
             echo "<tr><td><div class='error_msg'>";
             foreach($errorMsg as $val) {
                echo "Please check: " . $val . "<br>";
             }
             echo "</div></td></tr>";
          }				
          echo "<tr><td>No entries found.</td></tr>";
          echo "</table>";	   
          
      } else {
      
          $shown = mysqli_num_rows($showSked);		
          
          // MEMBERS LIST DISPLAY 
          echo "<form method='POST'>\n";
          // display errors for validation, etc
          if(isset($errorMsg) && count($errorMsg) > 0) {
             echo "<table class='member_table'>\n";		  
             echo "<tr><td><div class='error_msg'>";
             foreach($errorMsg as $val) {
                echo $val . "<br>";
             }
             echo "</div></td></tr></table>\n";
          }	
		  
          echo "<div class='clearAll'></div>";		  	  
		  
		  // includes jquery tablesorter
          echo "<table id='myTable' class='member_table'>\n";		  
		  echo "<THEAD>\n";
          echo "<tr>";
          echo "<th width='20%'>Name</th>";
          echo "<th width='20%'>Email</th>";
          echo "<th width='13%'>Week Begins</th>";
          echo "<th width='13%'>Window Opened</th>";
          echo "<th width='13%'>Window Closed</th>";
          echo "<th width='10%'>DELETE</th></tr>\n"; 
		  echo "</THEAD>\n";
  
          // display table contents
		  echo "<TBODY>\n";            
          while ($row = mysqli_fetch_assoc($showSked)) {
            $mid        = $row['id'];
            $name       = $row['name'];
            $testnum    = $row['testnum'];
            $email      = $row['email'];			
            $weekopen   = ($row['weekopen'] == '0000-00-00' || empty($row['weekopen'])) ? "" : date("m/d/Y",strtotime($row['weekopen']));
 			$winopen    = ($row['winopen'] == '0000-00-00' || empty($row['winopen'])) ? "" : date("m/d/Y",strtotime($row['winopen']));
			$winclose   = ($row['winclose'] == '0000-00-00' || empty($row['winclose'])) ? "" : date("m/d/Y",strtotime($row['winclose']));   					
            $editPage   = $testskedEdit . "?mid=$mid";
			
            echo "<tr>\n";
            echo "<td width='20%'><a href='" . $editPage . "'>"  . $name . "</a></td>";
            echo "<td width='20%'>"  . $email . "</td>";
            echo ($weekopen == '') ? "<td width='13%'>&nbsp;</td>"  : "<td width='13%'>"  . $weekopen . "</td>"; 
            echo ($winopen == '') ? "<td width='13%'>NOT STARTED</td>"  : "<td width='13%'>"  . $winopen . "</td>"; 
            echo ($winclose == '')   ? "<td width='13%'>NOT FINISHED</td>"  : "<td width='13%'>"  . $winclose   . "</td>";
            echo "<td width='10%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='del_me[]' value=$mid></td>";			 
            echo "</tr>\n";	
          } // end while
		  echo "</TBODY>\n";     		  
          echo "<tr><td colspan='5'>&nbsp;</td><td><input name='delete_test' type='submit' class='delete_button' title='This cannot be undone!' value='DELETE' ></td></tr>\n";		  
          echo "<tr><th colspan='6' align='center' style='text-decoration:none;'>Total: " . $shown . "</th></tr>\n";
          echo "</table>\n";
          echo "</form>\n";		  
      
      } //main IF
  
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
