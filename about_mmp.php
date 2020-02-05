<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = " ";
$pageSubTitle = 'Marjorie Meyer Palmer, M.A., CCC-SLP. Speech Pathologist. Pediatric Feeding Specialist.';

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
<title>NOMAS International - About Marjorie Meyer Palmer</title>
<meta name="description" content="Professional biography of NOMAS&reg; International founder Marjorie Meyer Palmer.">
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
  
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->
   
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
      
       <!-- LEFT COLUMN-->
       <div id='column_left_wide'>
       
          <div class='l_item'>
             <div class='text'>
               <img src="_grafix/punky_skylar.jpg" width="" height="" alt="MMP">              
               Marjorie Meyer Palmer, M.A., is a Speech Pathologist, Pediatric Feeding Specialist and consultant to a number of San Francisco area intensive care nurseries. 
               Certified in Neuro-Developmental Treatment, Ms. Palmer has published and lectured throughout the US, Canada, Europe and the Middle East on neonatal feeding disorders, 
               sensory versus motor aspects of oral feeding and weaning from tube to oral feeds.
               She is the author of the NOMAS<sup>&reg;</sup> (Neonatal Oral-Motor Assessment Scale) and she conducts quarterly courses at her training sites for certification in the administration
               and scoring of the NOMAS<sup>&reg;</sup>. She also teaches the certification course at client training sites, by invitation.
               Ms. Palmer was Clinical Instructor in the Department of Pediatrics at the University of California San Francisco School of Medicine from 1988 to 2005 and at the Department 
               of Rehabilitation Medicine, Boston University School of Medicine, from 1979 to 1984.
               She is author of the "Palmer Protocol for Sensory-Based Weaning" and is certified in the use of Neuromuscular Electrical Stimulation (NMES) for dysfunctional swallow 
               (dysphagia) with pediatric patients.                               
             </div><!--end text-->
          </div><!--end l_item-->  
          
          <div class='spacer_26'></div>     
          <div class='item_sep_dots_pink'></div>
                    
          <div class='l_item'>
             <h1>Publications / References</h1>
             <div class='text'><br>
                <ul class='pink'>
                
                   <li class='pink'>Feeding in the NICU.<br>
                   <span class='smaller'>Effective SLP Interventions for Children With Cerebral Palsy. Plural Publishing, 2014, Ch. 5, Pgs. 131-163.</span></li>
                   
                   <br><li class='pink'>Developmental continuum of Neonatal Sucking Performance Based on the NOMAS.<br>                   
                   <span class='smaller'>Developmental Observer, 2015, Volume 8, No. 1, Pages 11-15.</span></li>                
                   
                   <br><li class='pink'>A Pilot Study of Oral Motor Dysfunction in "At-Risk" Infants.<br>                   
                   <span class='smaller'>Physical & Occupational Therapy in Pediatrics, Vol 5(4) Winter 1985/1986</span></li>
                   
                   <br><li class='pink'>A Closer Look at Neonatal Sucking.<br>
                   <span class='smaller'>Neonatal Network March 1998, Vol. 17, No. 2</span></li>
                   
                   <br><li class='pink'>Identification and Management of the Transitional Suck Pattern in Premature Infants.<br>                   
                   <span class='smaller'>Journal of Prenatal and Neonatal Nursing, 1993, Vol. 7, No. 1, P. 66–75</span></li>
                   
                   <br><li class='pink'>The Neonatal Oral-Motor Assessment Scale: A Reliability Study.<br>
                   <span class='smaller'>Journal of Perintology, 1983 Vol. 13, No. 1, p. 28–35</span></li>
                   
                   <br><li class='pink'>Assessment and Treatment of Sensory-Versus Motor-Based feeding Problems in Very Young Children.<br>
                   <span class='smaller'>Infants and Young Children, October 1993</span></li>
                   
                   <br><li class='pink'>Ready, Get Set, Grow.<br>
                   <span class='smaller'>Parenting, February 1995</span></li>
                   
                   <br><li class='pink'>The Effects of Sensory-Based Treatment of Drooling in Children: A Preliminary Study.<br>
                   <span class='smaller'>Physical Occupational Therapy in Pediatrics, 1998 Vol. 18(3/4)</span></li>
                   
                   <br><li class='pink'>Weaning from Gastrostomy Tube Feeding: Commentary on Oral Aversion.<br>
                   <span class='smaller'>Pediatric Nursing, Sept.–Oct. 1998 Vol. 23, No. 5</span></li>
                   
                   <br><li class='pink'>Recognizing and Resolving Infant Suck Difficulties.<br>
                   <span class='smaller'>Journal of Human Lactation, 2002 Vol. 18(2)</span></li>
                   
                   <br><li class='pink'>Developmental Outcome for Neonates with Dysfunctional and Disorganized Sucking Patterns: Preliminary Findings.<br>
                   <span class='smaller'>Infant-Toddler Intervention, the Transdisciplinary Journal, 1999 Vol. 9, No. 3, p.299–308</span></li>
                   
                   <br><li class='pink'>Approach to Sensory-Based Feeding Disorders.<br>
                   <span class='smaller'>Pediatric Feeding Disorders 2012 (pp. 277-297). Framingham, MA: Therapro Inc.</span></li>
                   
                   <br><li class='pink'>Weaning from Tube Feeding using the Palmer Procotol.<br>
                   <span class='smaller'>Pediatric Feeding Disorders 2012 (pp. 233-256). Framingham, MA: Therapro Inc.</span></li>
                        
                </ul>               
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
