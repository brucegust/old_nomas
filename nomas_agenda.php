<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle        = "NOMAS<sup>&reg;</sup> Training Agenda For " . $thisYear;
$pageSubTitle     = "Assessment of Infant Sucking Patterns: Normal, Disorganized, and Dysfunctional";
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
<title>NOMAS International - NOMAS&reg; Training Agenda</title>
<meta name="description" content="Agenda for the two-day NOMAS infant feeding training course.">
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
          <div class='l_item'>
             <table class='agenda'>
                <!--DAY 1-->
                <tr>
                   <th colspan='2'>Day 1 of the NOMAS<sup>&reg;</sup> Certification Course</th>
                </tr>
                <tr>         
                   <td style="width:12%;">09:00 a.m.</td><td>Introduction</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">09:15 a.m.</td><td>Anatomy and Physiology of the Infant Oral Mechanism: Reflexive to Volitional (Birth to Six Months)</td>
                </tr>                
                <tr>         
                   <td style="width:12%;">10:30 a.m.</td><td>Break</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">10:45 a.m.</td><td>Introduction  to the NOMAS</td>
                </tr> 
                <tr>                
                   <td style="width:12%;">12:15 p.m.</td><td>Lunch</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">01:15 p.m.</td><td>Practice Evaluation with NOMAS: Review Videotapes</td>
                </tr> 
                <tr>                
                   <td style="width:12%;">02:45 p.m.</td><td>Break</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">03:00 p.m.</td><td>Use of NOMAS with Bottle vs. Breast Feeding</td>
                </tr>   
                <tr>                
                   <td style="width:12%;">03:30 p.m.</td><td>Sensory Aspects of Neonatal Sucking</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">04:00 p.m.</td><td>Diagnostic-Based Treatment for Infants with Disorganized and Dysfunctional Sucking Patterns</td>
                </tr>                                 
                <tr>
                   <td colspan='2' style="color:#550000;font-weight:bold;border-bottom:1px solid #000;">DAY 1 contains 6.0 hours of teaching</td>
                </tr>    
                
                <!--DAY 2-->
                <tr>
                   <th colspan='2'>Day 2 of the NOMAS<sup>&reg;</sup> Certification Course (Class divides into three groups)</th>
                </tr>                                            
                <tr>                
                   <td style="width:12%;">08:30 a.m.</td><td>Group A: Bedside observation in NICU | Groups B + C: Video Assessment</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">10:00 a.m.</td><td>Group B: Bedside observation in NICU | Groups A + C: Video Assessment</td>
                </tr>                
                <tr>                  
                   <td style="width:12%;">11:30 a.m.</td><td>Group C: Bedside observation in NICU | Groups A + B: Video Assessment</td>
                </tr> 
                <tr>                
                   <td style="width:12%;">01:00 p.m.</td><td>Lunch</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">02:00 p.m.</td><td>Video Assessment and Discussion</td>
                </tr>   
                <tr>
                   <td colspan='2' style="color:#550000;font-weight:bold;border-bottom:1px solid #000;">DAY 2 contains 6.5 hours of teaching</td>
                </tr>      
                
                <!--DAY 3-->                
                <tr>
                   <th colspan='2'>Day 3 of the NOMAS<sup>&reg;</sup> Certification Course (Class divides into three groups)</th>
                </tr>                            
                <tr>                
                   <td style="width:12%;">08:30 a.m.</td><td>Group A: Bedside observation in NICU | Groups B + C: Video Assessment</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">10:00 a.m.</td><td>Group B: Bedside observation in NICU | Groups A + C: Video Assessment</td>
                </tr>                
                <tr>                  
                   <td style="width:12%;">11:30 a.m.</td><td>Group C: Bedside observation in NICU | Groups A + B: Video Assessment</td>
                </tr> 
                <tr>                
                   <td style="width:12%;">01:00 p.m.</td><td>Lunch</td>
                </tr>
                <tr>                  
                   <td style="width:12%;">02:00 p.m.</td><td>Review Tape; Q&A</td>
                </tr>   
                <tr>                  
                   <td style="width:12%;">02:30 p.m.</td><td>Reliability Test</td>
                </tr>                   
                <tr>
                   <td colspan='2' style="color:#550000;font-weight:bold;border-bottom:1px solid #000;">DAY 3 contains 6.0 hours of teaching</td>
                </tr>                                    
             </table>          
          </div>
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
