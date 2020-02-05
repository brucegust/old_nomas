<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = " ";
$pageSubTitle = " ";

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
<title>NOMAS International - Renew Your NOMAS&reg; License</title>
<meta name="description" content="Licenses expire every two years. Here is how to renew.">
<link href="favicon.ico" rel="shortcut icon" >
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
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
  
   <!--TOP BLUE-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->   
   <!--end top blue-->
  
   <!--SOCIAL-->  
   <div class='social_links'>
      <?php showSocialLinks($socialLinks) ?>
   </div><!--end social box--> 
     
   <div class='clearAll'></div>  
    
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
       </div><!--end nomas_page_headlines-->  
      
       <!--COLUMN-->
       <div id='column_left_wide'>
       
          <div class='l_item'>
             <h1>NOMAS<sup>&reg;</sup> License Renewal and Reliability Testing</h1>
             <div class='reg_text'>       
                <br>NOMAS<sup>&reg;</sup> Practitioners are licensed for two-year periods to use the protocol in their practices. Biennial license renewal can be accomplished on this website. 
                Renewal assures that practitioners are up-to-date on the correct adminstration of the NOMAS.<br><br>
                Another significant benefit of current licensing: complimentary membership in the <span class='bld'>NOMAS Infant Feeding Forum</span> where every day, neonatal feeding professionals 
                benefit from the experiences and advice of peers and other professionals.<br><br>
                Renewal and Reliability testing are by pre-arrangement. <strong><?php echo $pleaseContact; ?></strong> to proceed!
             </div>
          </div>
          
          <div style='clear:both;width:100%;height:12px;'></div>   

       </div><!--END COLUMN-->             
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
