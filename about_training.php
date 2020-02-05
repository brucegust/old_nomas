<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle        = "NOMAS<sup>&reg;</sup> Training and Licensing For Individuals and Institutions";
$pageSubTitle     = "<a href='" . $nomasAgendaPage . "'>See the NOMAS Training Course Three Day Agenda</a>";
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
<title>NOMAS International - About NOMAS&reg; Training</title>
<meta name="description" content="Information about the two-day NOMAS infant feeding training course for individuals and institutions.">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
echo $swfobj22 . "\n"; 
echo $jwplayer . "\n"; 
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
   </div><!--end social box-->    
  
   <div class='clearAll'></div> 
    
    <!-- CONTENT -->
    
    <div id='nomas_content'>
    
       <div id='nomas_page_headlines'>    
          <?php
	      if ( isset($pageTitle) && $pageTitle > '') {
		     echo "<div class='pageTitle'>" . $pageTitle . "</div>\n";
	      }
          if (isset($pageSubTitle) && $pageSubTitle > '') {
             echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>\n";
	      } 
	      ?>
       </div>   
      
       <!-- LEFT COLUMN-->
       <div id='column_left'>
       
          <div class='l_item' style="margin-top:1.8em;">
             <h1>Training for the Individual</h1>
             <div class='text'>
               A three-day training course that provides a background in infant anatomy and physiology as it relates to neonatal sucking. The course describes the jaw and tongue movements
               that occur during normal reflexive nutritive sucking and explains how to make a differential diagnosis between disorganized and dysfunctional sucking based on the 28 characteristics 
               of the Neonatal Oral-Motor Assessment Scale (NOMAS<sup>&reg;</sup>). This course also outlines similarities and differences between breast and bottle feeding and discusses the 
               sensory characteristics of the infant with an “altered sensory system.” Treatment techniques for both the disorganized and dysfunctional feeder are outlined.<br><br>
               All participants are required to participate in a bedside practicum in the intensive care nursery where they will learn to diagnose the suck pattern of several infants during the 
               first two minutes of a routine feeding. Once the Reliability Test is passed the participant will receive Certification as well as a non-exclusive copyright license to use the 
               material. Please <a href="contact.php">contact us</a> for more information.                              
             </div><!--end text-->
          </div><!--end l_item-->  
          
          <div class='spacer_36'></div>
          
          <div class='l_item'>
             <h1>Institutional Licensing</sup></h1>
             <div class='text'>
               An institution may elect to host a NOMAS<sup>&reg;</sup> Certification Course taught by a licensed NOMAS<sup>&reg;</sup> course instructor who will provide instruction to hospital
               staff in the facility's NICU.  An institution may also elect to become a Licensed NOMAS<sup>&reg;</sup> Training Site which allows several NOMAS<sup>&reg;</sup> 
               Certification Courses to be taught each year at their facility and opens those courses to professionals from other institutions, both in the United States
               and from other countries.  For additional information please contact 
               <a href="mailto:<?php echo $punkyEmail; ?>?subject=NOMAS Training Inquiry" target="_blank">Marjorie Meyer Palmer</a>, M.A., CCC-SLP (<?php echo $punkyEmail; ?>), 
               or use the <a href="contact.php">contact form on this website</a>.                              
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
            
		  <?php if(is_file($nomas_orientation))	{ ?>
          <div style='width:100%;'>
             <div id='vidBox'>Please install the Flash Plugin</div>	
                <script type="text/javascript">
                <!--
                jwplayer('vidBox').setup({
                'id': 'playerID',
                'width': '298',
                'height': '238',
                'file': '<?php echo $nomas_orientation; ?>',
                'image': '<?php echo $nomas_training_pic; ?>',
                'skin': '',
                'controlbar.position': 'bottom',
                'modes': [ 
                   {type: 'html5'},								
                   {type: 'flash', src: '_js/player.swf'}
                ]
                });
                -->
                </script>
          </div>
          <?php } ?>              
        
       </div><!--END COLUMN RIGHT-->
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
