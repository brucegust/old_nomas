<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

// FOR PROMOTING SPECIAL EVENTS 
$pageTitle    = $pageSubTitle = "";
$pageTitle    = "Latest News:";
$pageSubTitle = ($today <= $sympEndDate) ? '<a href="symp_2015.php">2015 Symposium: "Practical Clinics in Neonatal Feeding"<br />October 27-30, Holiday Inn-Orlando, Florida, (in the Disney World Resort)</a>' : "";
$pageSubTitle = "";
$showTrainingSked = checkTrainingSked($thisYear); // returns T or F 

//*****************************************************************
//*****************************************************************
//*****************************************************************

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<meta name="viewport" content="width=device-width" />
<title>NOMAS International - Infant Feeding - Home Page</title>
<meta name="description" content="The NOMAS&reg; was developed in 1983 and has since become a reliable tool for evaluating neonatal sucking patterns in pre-term infants. The NOMAS&reg; provides a comprehensive description of infant feeding patterns. It enables an examiner to identify normal oral-motor patterns and to differentiate organized from dysfunctional patterns.">
<meta name="keywords" content="NOMAS,neonatal feeding,infant feeding,pediatric feeding,feeding disorders,infant feeding disorders">
<meta name="author" content="Peter O.E. Bekker, SignalCorps.com Multimedia">
<link href="favicon.ico" rel="shortcut icon" />
<link href="_css/css_cms.css" rel="stylesheet" type="text/css" />
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css" />
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-61070902-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
   
   <!--SOCIAL-->  
   <div class='social_links'>
      <?php showSocialLinks($socialLinks) ?>
   </div><!--ed social box-->   
  
   <div class='clearAll'></div>  
    
   <!-- CONTENT -->
   <div id='nomas_content'>
    
       <div id='nomas_page_headlines'>
          <?php
	      if ( isset($pageTitle) && $pageTitle > '') {
		     echo "<div class='pageTitle'>" . $pageTitle . "</div>";
	      }
          if (isset($pageSubTitle) && $pageSubTitle > '') {
             echo "<div class='pageSubTitle' style='line-height:150%;'>" . $pageSubTitle . "</div>";
	      } 
	      ?>
       </div><!--end nomas_page_headlines-->  
                  
       <!-- LEFT COLUMN-->
       <div id='column_left'>
       
          <div class='l_item'>
             <h1>Welcome to NOMAS<sup>&reg;</sup> International</h1>
             <div class='text'>
               Here you will find an exciting community for neonatal and pediatric feeding professionals. Among the resources available on this site are a lively bulletin board for discussion of 
               feeding issues; online training courses for occupational therapists, speech pathologists and nurses that may be taken for CEU credits from AOTA, ASHA and the California Board of 
               Registered Nursing; information about how to become a licensed NOMAS<sup>&reg;</sup> practitioner and also information 
               for institutions about how to license the NOMAS protocol and incorporate it into neonatal and pediatric practices.                              
             </div><!--end text-->
          </div><!--end l_item-->  
          
          <div class='spacer_36'></div>
          
          <div class='l_item'>
             <h1>About the NOMAS<sup>&reg;</sup></h1>
             <div class='text'>
               <img src="_grafix/punky-150.jpg" width="124" height="150" alt="MMP"> 
               The NOMAS (Neonatal Oral-Motor Assesment Scale) was developed in 1983 by Marjorie Meyer Palmer MA, CCC-SLP and has since become a reliable tool for the evaluation 
               of neonatal sucking patterns in pre-term 
               and term infants. The NOMAS provides a comprehensive description of the infant's feeding patterns and enables the examiner to identify normal oral-motor patterns and 
               to differentiate disorganized from dysfunctional patterns. The NOMAS is used for pre and post-test measurements to determine treatment effectiveness; to record 
               developmental and changing patterns; and to confirm oral-motor dysfunction or disorganization in the poor feeder. It is important to accurately identify the infant's feeding pattern 
               so that appropriate treatment may be prescribed. Performance on the NOMAS is predictive of developmental outcome at 24 months of age.  
				<br><br>
				<a href="https://www.drbrownsbaby.com/medical/" target="_blank"><img src="_grafix/logo-dr-brown.jpg" border="0" style="float:right;"></a>
             </div><!--end text-->
          </div><!--end l_item-->      
          
          <div class='spacer_26'></div>
          
       </div><!--END COLUMN LEFT-->             
       
       <!---------------------------------------------------------------------------------------------------------------------------------------------->
       <!---------------------------------------------------------------------------------------------------------------------------------------------->
       <!---------------------------------------------------------------------------------------------------------------------------------------------->
       <!---------------------------------------------------------------------------------------------------------------------------------------------->

       <!--RIGHT COLUMN -->
       <div id='column_right'>     
       
          <!--NOMAS TRAINING SKED BOX-->
          <?php trainingSked($showTrainingSked); ?>	                     
          <!--END NOMAS TRAINING SKED BOX-->  			  

          <div class='spacer_26'></div>
          
          <!--FORUM SIGN-IN BOX-->            
          <?php // feedingForumLogin(); ?>	                     
          <!--END FORUM SIGN-IN BOX-->      
        
       </div><!--END COLUMN RIGHT-->
    <div class='clearAll'></div>
    </div><!-- end lower_content-->
    
    <!--FOOTER-->
    <div id="footer"> 
       <?php showBottomMenu(); showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
    <div class='clearAll'></div>

</div><!-- end #playround -->
</body>
</html>
