<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }
require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = "Online Training for CEUs and Other Great Resources";
$pageSubTitle = 'NOMAS training and licensing courses transferring from successfulfeeding.com this weekend.';

//*****************************************************************
//*****************************************************************
//*****************************************************************

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<title>NOMAS International</title>
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_slidemenu . "\n"; 
?>
</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
  
   <div class='clearAll'></div>  
    
   <!-- CONTENT -->
    
   <div id='nomas_content'>
    
       <div id='nomas_page_headlines'>    
          <?php
	      if ( isset($pageTitle) && $pageTitle > '') {
		     echo "<div class='pageTitle'>" . $pageTitle . "</div>";
	      }
          if (isset($pageSubTitle) && $pageSubTitle > '') {
             echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	      } 
	      ?>
       </div>   
      
       <!-- LEFT COLUMN-->
       <div id='column_left_wide'>
          <div class='l_item'>
             <div class='text'>
                We are in the final stages of fully launching a comprehensive online training destination for professional neonatal, infant and toddler feeding specialists 
                here at nomasinternational.org. More than 20 online courses will be available that can be taken via PC or tablet computer. Most of the courses, if completed successfully, 
                will qualify for CEU credits offered by ASHA, AOTA and the California Board of Registered Nursing.<br><br>
                
                This training has until recently been available at successfulfeeding.com which, with the launch of this website, has been closed. You are now visiting the official online home of
                the NOMAS<sup>&reg;</sup>.<br><br>
                
                Most material from the old site has already been transferred here. This weekend, we will unveil the NOMAS International Feeding Forum, a virtual gathering sport for 
                professional neonatal, infant and toddler feeding specialists. The Forum will allow members to ask and answer questions and help colleagues from 
                around the world to be better providers of service to our tiny patients.<br><br>
                
                Feeding is a huge issue for these little ones and an obstacle that frequently stands in their way of going home to join their families.  
                As feeding specialists we are always striving to “do it better”.  Hence, we hope that the NOMAS International Infant Feeding Forum 
                will provide us all with a means to better communicate with our colleagues.<br><br>
                
                Reliability testing and NOMAS license renewals will also be available here, soon.
             </div><!--end text-->
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div>
          
       </div><!--END COLUMN LEFT-->   
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
