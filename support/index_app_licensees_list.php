<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

include_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_app_licensees_2.php"; // top nav menu
include_once "_inc/inc_app_licensees.php"; // local procedural functions

$pg_level = $lvl_2;
$u_token  = getToken(); // make sure user's token hasn't changed
check_permission($pg_level,$u_token); // check valid for this page level

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Registry of NOMAS<sup>&reg;</sup> International Practitioners";
$pageSubTitle = "Click practitioner NAME to edit their information. Click any column header below to sort.<br>To un or re-license, check box and confirm by clicking button at bottom of page.";

$limitTo      = (isset($_REQUEST['limitTo']) && $_REQUEST['limitTo'] > '' ) ? $_REQUEST['limitTo'] : '';
$errorMsg     = array();

//*****************************************************************
//*****************************************************************
//*****************************************************************

// hide licensee
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['remove_license'])) {
  $errorMsg = removeLicense($_POST['del_me']);
  unset($_POST['remove_license']);
}			 

// unhide licensee
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['restore_license'])) {
  $errorMsg = restoreLicense($_POST['del_me']);
  unset($_POST['restore_license']);
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
<link href="_css/css_tablesorter.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
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
		  echo "<div class='pageTitle'>" . $pageTitle . "</div>";
	  }
      if (isset($pageSubTitle) && $pageSubTitle > '') {
         echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	  } 
	  ?>            
    
    <div class='clearAll'></div>  

    <?php // limitTo is set as a submit command in the form, below. It searches for records by partial name or license number, returning a resource
	
    if(isset($limitTo) && $limitTo > '' ) {
	
       $findMe = (is_numeric($limitTo)) ? "cert_num" : "lname";
	   
       if($link = db_connect_site()) {	   
          if(!$limitTo = mysqli_real_escape_string($link,$limitTo))
		    $limitTo = addslashes($limitTo);	   
		  	 
          if(!$result = mysqli_query($link,"SELECT * FROM $practitionersTBL WHERE $findMe LIKE '%$limitTo%' ORDER BY lname ASC")) {
	         echo "<table class='member_table'>";
	         echo "<tr><td colspan='8'>Search database problem.</td></tr>";
	         echo "</table>";	
		     exit;		   
		  }
			 
	      if(mysqli_num_rows($result) == 0) {
	         echo "<table class='member_table'>";
	         echo "<tr><td colspan='8'>Cannot find '" . strtoupper($limitTo) . "'</td></tr>";
	         echo "</table>";	
		     exit;		   
		  }
	   }
    }		
	
	// scope id - $sid - check to see if it's set from a menu option; default to 'all' if not.
	$sid = (isset($_REQUEST['sid']) && $_REQUEST['sid'] > '' ) ? $_REQUEST['sid'] : 'all';
	
	if(is_object($result)) {
       $showScope = (isset($findMe) && strlen($findMe) > 0) ? $result : getScope($sid);
	} else {
       $showScope = getScope($sid);
	}

    // display error if no connect or database is empty	
	$scopeMsg = '';
	if(!is_object($showScope) || mysqli_num_rows($showScope) == 0 || $showScope == '0' )
	   $scopeMsg = "No enries found"; 
	   
	if(isset($scopeMsg) && $scopeMsg > '' ) {
	   echo "<table class='member_table'>";
       echo "<tr><td colspan='8'><div class='error_msg'>" . $scopeMsg . "</div></td></tr>";
	   echo "</table>";			   
		
	} else {
	
		$shown     = mysqli_num_rows($showScope); // number of records retrieved		
		$scopeName = getScopeName($sid); // meta for records retrieved		
		
		// LICENSEE LIST DISPLAY
		echo "<form method='POST'>";
				  	  	  
		// show search box for single member lname or license number
		echo "<table>";
		echo "<tr>";
		echo "<td colspan='8' class='search_txt'>" . $searchTitle . "<input type='text' name='limitTo' value=''>
		      <input type='submit' value='GO'>" . str_repeat("&nbsp; ",4);
		echo "<span class='showing'>Showing " . $shown . " " . $scopeName . "</span>";
		echo "</td></tr>";
		echo "</table><br>";

		echo "<div class='clearAll'></div>";	
		
        // includes jquery tablesorter - 8 COLUMNS
		echo "<div class='tablesorter_box'>";
        echo "<table id='myTable' class='tablesorter'>";		  
        // results display header
		echo "<tfoot>";
		echo "<tr><th colspan='8'>Total: " . $shown . " &nbsp;&nbsp <a href='index_app_licensees_list.php?sid=$sid'><span style='color:#FFF;'>(Back to top)</span></a></th></tr>\n";
		echo "</tfoot>";
        echo "<THEAD>";		
		echo "<tr>";
		echo "<th width='30%'>Name</th>";
		echo "<th width='5%'>License</th>";
		echo "<th width='12%'>City</th>";
        if($sid == 'all') {
		   echo "<th width='12%'>Region/State</th>";
        } elseif ($sid == 'intl' || $sid == 'intl_l' || $sid == 'intl_u') {
           echo "<th width='12%'>Region</th>";
		} else {
           echo "<th width='12%'>State</th>" ;
        }		
		echo "<th width='15%'>Country</th>";
		echo "<th width='10%'>Discipline</th>";
		echo "<th width='15%'>Email</th>";
		if($sid == 'all' || $sid == 'usa' || $sid == 'intl') {
			echo "<th width='1%' style='text-decoration:none;'>&#160;</th>";
		} elseif($sid == "unlicensed" || $sid == 'usa_u' || $sid == 'intl_u') {
			echo "<th width='1%' class='rgt'>RELICENSE</th>";
		} elseif ($sid == "licensed" || $sid == 'usa_l' || $sid == 'intl_l') {	
		    echo "<th width='1%' class='ctr'>UNLICENSE</th>";			
		}			 
		echo "</tr>";
        echo "</THEAD>";		
        echo "<TBODY>";		
		// display table contents
		$cnt = 0;
		while ($row = mysqli_fetch_assoc($showScope)) {		  	
		  $mid        = $row['id'];
		  $mnm        = $row['cert_num'];
		  $memName    = trim($row['lname']) . ", " . trim($row['fname']);
		  $discipline = $row['discipline'];
		  $memEmail   = $row['email'];
		  $memPhone   = $row['phone'];
		  $country    = $row['country'];
		  $state      = $row['region_state'];
		  $city       = $row['city'];
		  $license    = $row{'license'};
		  $editPage   = $membersEdit . "?mnm=$mnm&mid=$mid&sid=$sid";
		  echo "<tr>";
		  echo ($editPage == '') ? "<td width='30%'>NOT FOUND</a></td>" : "<td width='30%'><a href='" . $editPage . "'>" . $memName . "</a></td>";
		  if($license) {
		     echo ($mnm == '')   ? "<td width='5%'>&nbsp;</td>" : "<td width='5%' class='green'>"  . $mnm . "</td>";
		  } else {
		     echo ($mnm == '')   ? "<td width='5%'>&nbsp;</td>" : "<td width='5%' class='red'>"  . $mnm . "</td>";
		  }
		  echo ($city == '')           ? "<td width='12%'>&nbsp;</td>"        : "<td width='12%'>" . $city       . "</td>";
		  echo (strlen($state) >= 12)  ? "<td width='12%'>" . substr($state,0,12) . '...' . "</td>" : "<td width='12%'>" . $state . "</td>";
		  echo (strlen($country) >= 15)    ? "<td width='15%'>" . substr($country,0,15) . '...' . "</td>" : "<td width='15%'>" . $country . "</td>";			
		  echo (strlen($discipline) >= 10) ? "<td width='10%'>" . substr($discipline,0,10) . '...' . "</td>" : "<td width='10%'>" . $discipline . "</td>"; 
		  echo (strlen($memEmail) > 0) ? "<td width='15%'><a href='mailto:" . $memEmail . "'>" . $memEmail . "</a></td>" : "<td width='15%'>&nbsp;</td>";
		  if($sid == "unlicensed" || $sid == "licensed" || $sid == "usa_l"|| $sid == "usa_u" || $sid == "intl_l" || $sid == "intl_u") {
		     echo "<td width='1%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='del_me[]' value='$mnm'></td>";	 
		  } else {
			 echo "<td width='1%'>&nbsp;</td>";				  
		  }
		  echo "</tr>\n";	
		  $cnt++;
		  //if($cnt > 20) {
		  //   echo "<tr><td colspan='8' class='btt'><a href='index_app_licensees_list.php?sid=$sid'>BACK TO TOP</a></td></tr>";
		//	 $cnt = 0;
		//  }
		} // end while
		echo "</TBODY>";
		// label action button with "UNLICENCE or RELICENCE as appropriate	
		if($sid == 'all') {
			echo "<tr><td colspan='8'>&nbsp;</td></tr>";
		} elseif($sid == "unlicensed" || $sid == "usa_u" || $sid == "intl_u") {
			echo "<tr><td colspan='7'>&nbsp;</td><td><input name='restore_license' type='submit' value='RELICENSE' ></td></tr>\n";
		} elseif ($sid == "licensed" || $sid == "usa_l" || $sid == "intl_l") {	
		    echo "<tr><td colspan='7'>&nbsp;</td><td><input name='remove_license' type='submit' value='UNLICENSE' ></td></tr>\n";
		}			 		
		echo "</table>";
		echo "</div>";
		echo "</form>\n";
	
	} //main IF
    ?>
    
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
