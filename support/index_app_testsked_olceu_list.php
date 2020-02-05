<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";           // frequently used procedural functions
include_once "_nav/nav_app_testsked_olceu_1.php"; // top nav menu
include_once "_inc/inc_app_testsked_olceu.php";   // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // make sure user's token hasn't changed
check_permission($pg_level,$u_token); // check valid for this page level

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Two-Day and Symposia Testing";
$pageSubTitle = "Click 'Name' to extend test availability window. Click column headers below, to sort. To delete, check box and confirm at page bottom.<br> 
                 <span class='red'>Deleting an entry is permanent!</span>";
$errorMsg     = "";
$deleteMsg    = array();

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_test'])) {
   $deleteMsg = deleteTest($_POST['del_me']);
   unset($_POST['delete_test']);
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
-->  
</script>
</head>
<body>
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
            echo "<div class='pageTitle'>" . $pageTitle . "</div>\n";
        }
        if (isset($pageSubTitle) && $pageSubTitle > '') {
           echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
        } 
      ?>
      
      <div class='clearAll'></div>  
      
      <?php if($link = db_connect_site()) { ?>
      
         <?php
         $sql = "SELECT * FROM $ceuusersTBL ORDER BY winopen DESC";
         if($result = mysqli_query($link, $sql)) {
             if(mysqli_num_rows($result) == 0) {
                 $errorMsg = "No tests scheduled or underway. Database is empty.";
             } else {
				 $shown = mysqli_num_rows($result);
				 echo "<form method='POST' novalidate>";
				 echo "<table id='myTable' class='member_table'>\n";		  
				 echo "<THEAD>\n";
				 echo "<tr>";
				 echo "<th width='15%'>Name</th>";
				 echo "<th width='10%'>Test(s)</th>";
				 echo "<th width='10%'>Order Num</th>";
				 echo "<th width='20%'>Email</th>";
				 echo "<th width='10%'>Window Opened</th>";
				 echo "<th width='10%'>Window Closed</th>";
				 echo "<th width='10%'>DELETE</th></tr>\n"; 
				 echo "</THEAD>\n";
				 // display table contents
				 echo "<TBODY>\n";       
	             while($row = mysqli_fetch_assoc($result)) {
                    $orderno = $mid = $row['orderno'];
                    $name       = $row['name'];
                    $email      = $row['email'];
                    $itemnumber = $row['itemnumber'];
                    $winopen    = $row['winopen'];
                    $winclose   = $row['winclose'];			   
				    $editPage = $testskedolceuEdit . "?mid=$mid";
				    echo "<tr>\n";
				    echo "<td width='15%'><a href='" . $editPage . "'>"  . $name . "</a></td>";
				    echo "<td width='10%' class='rgt'>&nbsp;&nbsp;&nbsp;"  . $itemnumber . "</td>";
				    echo "<td width='10%' class='rgt'>&nbsp;&nbsp;&nbsp;"  . $orderno . "</td>";
				    echo "<td width='20%'>"  . $email . "</td>";
				    echo ($winopen == '' || $winopen == '0000-00-00') ? "<td width='10%'>NOT STARTED</td>"  : "<td width='10%'>"  . $winopen . "</td>"; 
				    echo ($winclose == '' || $winclose == '0000-00-00') ? "<td width='10%'>NOT FINISHED</td>"  : "<td width='10%'>"  . $winclose   . "</td>";
				    echo "<td width='10%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='del_me[]' value=$mid></td>";			 
				    echo "</tr>\n";	
				 }
				 echo "</TBODY>\n";				     		  
				 echo "<tr><td colspan='6'>&nbsp;</td><td><input name='delete_test' type='submit' class='delete_button' title='This cannot be undone!' value='DELETE' ></td></tr>\n";		  
				 echo "<tr><th colspan='7' align='center' style='text-decoration:none;'>Total: " . $shown . "</th></tr>\n";
				 echo "</table>\n";
				 echo "</form>\n";
				 
                 mysqli_free_result($result);
             }
                 
         }  else { $errorMsg = "Can't connect to the database"; }
      
      } else { $errorMsg = "Can't connect to databases"; }      
                  
	  // display error if no connect or database is empty
      if(!empty($errorMsg) && count($errorMsg) > 0 ) {
         echo "<table class='member_table'>";
         echo "<tr><td><div class='error_msg'>" . $errorMsg . "</div></td></tr>";
         echo "</table>";	   	
	     echo "<div class='clearAll'></div>";		  	  		 		 
		 exit;
      }				         	   
	  
	  // display delete msg
      if(!empty($deleteMsg) && count($deleteMsg) > 0 ) {
         echo "<table class='member_table'>";
		 foreach($deleteMsg as $val) {
            echo "<tr><td><div class='error_msg'>" . $val . "</div></td></tr>";
		 }
         echo "</table>";	   	
	     echo "<div class='clearAll'></div>";		  	  		 		 
		 exit;
      }				         	  
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
