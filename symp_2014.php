<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_inc/mail_functions.php";
include_once "_nav/nav_site_001.php"; // top nav menu

// ******************************************************************

// SWITCHES
$display       = true;
$pwordCheck    = true;

// LINKS
$brochureURL   = "_docs/symposia_brochures/2014-NOMAS-symposium.pdf";
$hotelLink     = "https://www.ihg.com/holidayinn/hotels/us/en/san-francisco/sfofw/hoteldetail";
$dloadRedir    = 'symp_2014_dloads.php';

// SYMPOSIA INFO
$earlyBirdEnds = date("2014-07-15");
$sympCity      = "San Francisco";

// DOWNLOAD PRESENTATION DECKS
$dloadCode     = (isset($_POST["dloadCode"]) || !empty($_POST["dloadCode"])) ? trim($_POST["dloadCode"]) : '';
$dloadPass     = "nomas2014";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['dload'])) {
   $pwordCheck = checkDloadCode($_POST);
   if($pwordCheck) {
      $redir = $dloadRedir;
      header("Location: $redir");
      exit;	   	
   }
} 

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "The Fourth Annual NOMAS<sup>&reg;</sup> International Symposium in " . $sympCity;
$pageSubTitle = '"It\'s All About Feeding!" - October 10-12th, 2014';

// ******************************************************************
// ******************************************************************
// ******************************************************************

$toEmail     = $sendToEmail; 
$Subject     = "SYMPOSIUM REGISTRATION"; 
$formError   = array();
$sent        = '';

$date_in     = (isset($_POST["date_in"])    || !empty($_POST["date_in"]))    ? trim($_POST["date_in"])    : $today;
$symp_year   = (isset($_POST["symp_year"])  || !empty($_POST["symp_year"]))  ? trim($_POST["symp_year"])  : $thisYear;
$check_amt   = (isset($_POST["check_amt"])  || !empty($_POST["check_amt"]))  ? trim($_POST["check_amt"])  : '';
$name        = (isset($_POST["name"])       || !empty($_POST["name"]))       ? trim($_POST["name"])       : '';
$profession  = (isset($_POST["profession"]) || !empty($_POST["profession"])) ? trim($_POST["profession"]) : '';
$employer    = (isset($_POST["employer"])   || !empty($_POST["employer"]))   ? trim($_POST["employer"])   : '';
$city_state  = (isset($_POST["city_state"]) || !empty($_POST["city_state"])) ? trim($_POST["city_state"]) : '';
$phone1      = (isset($_POST["phone1"])     || !empty($_POST["phone1"]))     ? trim($_POST["phone1"])     : '';
$phone2      = (isset($_POST["phone2"])     || !empty($_POST["phone2"]))     ? trim($_POST["phone2"])     : '';
$email       = (isset($_POST["email"])      || !empty($_POST["email"]))      ? trim($_POST["email"])      : '';
$home_addr   = (isset($_POST["home_addr"])  || !empty($_POST["home_addr"]))  ? trim($_POST["home_addr"])  : '';
$nomas_num   = (isset($_POST["nomas_num"])  || !empty($_POST["nomas_num"]))  ? trim($_POST["nomas_num"])  : '';
$nurses_num  = (isset($_POST["nurses_num"]) || !empty($_POST["nurses_num"])) ? trim($_POST["nurses_num"]) : '';
$s1_a        = (isset($_POST["s1_a"])       || !empty($_POST["s1_a"]))       ? trim($_POST["s1_a"])       : '';
$s1_b        = (isset($_POST["s1_b"])       || !empty($_POST["s1_b"]))       ? trim($_POST["s1_b"])       : '';
$s1_c        = (isset($_POST["s1_c"])       || !empty($_POST["s1_c"]))       ? trim($_POST["s1_c"])       : '';
$s2_a        = (isset($_POST["s2_a"])       || !empty($_POST["s2_a"]))       ? trim($_POST["s2_a"])       : '';
$s2_b        = (isset($_POST["s2_b"])       || !empty($_POST["s2_b"]))       ? trim($_POST["s2_b"])       : '';
$s2_c        = (isset($_POST["s2_c"])       || !empty($_POST["s2_c"]))       ? trim($_POST["s2_c"])       : '';
$s3_a        = (isset($_POST["s3_a"])       || !empty($_POST["s3_a"]))       ? trim($_POST["s3_a"])       : '';
$s3_b        = (isset($_POST["s3_b"])       || !empty($_POST["s3_b"]))       ? trim($_POST["s3_b"])       : '';
$s3_c        = (isset($_POST["s3_c"])       || !empty($_POST["s3_c"]))       ? trim($_POST["s3_c"])       : '';
$s4_a        = (isset($_POST["s4_a"])       || !empty($_POST["s4_a"]))       ? trim($_POST["s4_a"])       : '';
$s4_b        = (isset($_POST["s4_b"])       || !empty($_POST["s4_b"]))       ? trim($_POST["s4_b"])       : '';
$s4_c        = (isset($_POST["s4_c"])       || !empty($_POST["s4_c"]))       ? trim($_POST["s4_c"])       : '';
$d_a         = (isset($_POST["d_a"])        || !empty($_POST["d_a"]))        ? trim($_POST["d_a"])        : '';
$d_b         = (isset($_POST["d_b"])        || !empty($_POST["d_b"]))        ? trim($_POST["d_b"])        : '';
$d_c         = (isset($_POST["d_c"])        || !empty($_POST["d_c"]))        ? trim($_POST["d_c"])        : '';
$d_d         = (isset($_POST["d_d"])        || !empty($_POST["d_d"]))        ? trim($_POST["d_d"])        : '';
$message     = (isset($_POST["message"])    || !empty($_POST["message"]))    ? trim($_POST["message"])    : '';
   
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $sent = checkSymposiumForm($_POST);
   if($sent == "OK") {
	  $date_in     = '';
	  $symp_year   = '';
	  $check_amt   = '';
	  $name        = '';
	  $profession  = '';
	  $employer    = '';
	  $city_state  = '';
	  $phone1      = '';
	  $phone2      = '';
	  $email       = '';
	  $home_addr   = '';
	  $nomas_num   = '';
	  $nurses_num  = '';
	  $s1_a        = '';
	  $s1_b        = '';
	  $s1_c        = '';
	  $s2_a        = '';
	  $s2_b        = '';
	  $s2_c        = '';
	  $s3_a        = '';
	  $s3_b        = '';
	  $s3_c        = '';
	  $s4_a        = '';
	  $s4_b        = '';
	  $s4_c        = '';
	  $d_a         = '';
	  $d_b         = '';
	  $d_c         = '';
	  $d_d         = '';
	  $message     = '';	   
	  unset($_POST);
	  unset($_POST['submit']);
   }
} 
// ******************************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<meta name="viewport" content="width=device-width" />
<title>NOMAS International - Infant Feeding Symposium</title>
<meta name="description" content="Multi-day symposium on neonatal and infant feeding">
<link href="_css/symp_2014.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $vibracart . "\n";
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_ui_accordion . "\n";
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
   
   <!--TOP NAV-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav); ?></div>      
   </div><!--end top nav box-->
   
   <!--SOCIAL-->  
   <div class='social_links'>
      <?php showSocialLinks($socialLinks); ?>
   </div><!--end social box-->   
    
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
      
      <?php if(file_exists($brochure)) { ?>
      <div class='item'>
         <span class='text' style='font-size:2em;'><a href="<?php echo $brochureURL; ?>" target="_blank">Click to download/print Symposium brochure</a></span><br>
         <span class='dload_brochure' style='font-size:1.5em;font-style:italic;'>Slide decks for most presentations will be available for download here, two weeks before the event.</span>               
      </div>
	  <?php } ?>
      
      <?php $display = ($today <= '2014-10-15') ? true : false;
      // <!-- ENABLE THIS TO ALLOW DOWNLOADING OF SYMPOSIUM PRESENTATIONS-->
      if($display) {  ?>
      <div class='dload_brochure'>
         <form class='dload_pword' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST">  
            <label for 'dloadCode'>Enter password to download slides & presentations:</label>                
            <input type="password" name="dloadCode" maxlength='12' size='9' value="<?php echo htmlspecialchars($dloadCode); ?>" />
            <input type="submit" name="dload" value="Enter">
         </form>                  
      </div>  
	  <?php } ?>
      <?php $display = true; ?>
      
      <!--form and D/L errors-->
	  <?php 	  		
      if (isset($formError) && count($formError)) {
	     echo "<div class='error'>";	
         echo "There was a problem with your submission. <a href='#errors'>Click to see details.</a>";
     	 echo "</div>";
      }	  
      if (isset($sent) && $sent == 'OK') {
	     echo "<div class='sent'>";	
         echo "Your registration has been sent. See you in " . $sympCity . "!<br>";
		 echo "<span class='text'>Click to <a href='#pay'>pay for registration</a> and/or to make hotel reservations.</span>";
		 echo "</div>";
      }	  
      ?>                             
      <!-- end error & success messages-->             
    
      <!-- LEFT COLUMN-->
      <div id='column'>
      
        <!-- GREETING-->
        <div class='item'>
           <div class='text' style='float:left;display:inline;'>
             <span style='color:#550000;font-style:italic;font-size:1.3em;'>Thanks for attending! If you were not able to join us, here's what you missed:</span><br><br>
             Join professionals from many disciplines and three continents as they share their expertise and perspectives on feeding NICU infants.      
             The 2014 NOMAS International Symposium - the fourth annual - will take place in San Francisco in October. Bringing together the most knowledgeable and experienced professionals 
             in the fields of neonatal and pediatric feeding disorders, the symposium is a multi-disciplinary approach to feeding with presentations by Neonatologists, Pediatric Neurologists, 
             Pediatric Gastroenterologists, Developmental Pediatricians, Nursing and Lactation specialists, NIDCAP Certified Developmental Specialists, Physical Therapy, Occupational Therapy, 
             Nutrition, and Speech Pathologists.<br><br>
           </div>             
           <div>
              <img style='float:left;border:none;display:inline;margin-right:16px;' src="_grafix/palmer-marjorie-outdoor-150.jpg" width="150" height="150" alt="MMP">
              <div class='text' style='float:left;line-height:1.2em'>
                 Sincerely,<br>
                 <img style='margin:1em 0 1em 0;border:none;' src="_grafix/punky-signature.jpg" width="72" height="44" alt="GRAPHIC"><br>
                 Marjorie Meyer Palmer, M.A., CCC-SLP<br>Founder/Director<br>NOMAS<sup>&reg;</sup> International              
              </div>       
           </div>
        </div><!--end item-->   
        
        <div class='spacer_26'>&nbsp;</div>
        <div class='pink_dot_repeat'>&nbsp;</div>
        <div class='spacer_12'>&nbsp;</div>
        
        <div style='float:left;display:inline;margin-bottom:21px;'>                              
           <p class='sponsor_title' style='color:#CC9900;'>GOLD SPONSOR</p><br><br>
           <img style='float:left;border:none;display:inline;' src="_grafix/logo-mead-johnson.jpg" width="330" height="120" alt="MMP">
        </div>
        <div style='float:left;display:inline;margin-left:100px;margin-bottom:21px;'>                              
           <p class='sponsor_title' style='color:#A78B58;'>BRONZE SPONSOR</p><br><br>
           <img style='float:left;border:none;display:inline;' src="_grafix/logo-prolacta.jpg" width="239" height="100" alt="MMP">        
        </div><!--end text-->        
        
        <div class='spacer_12'>&nbsp;</div>
        <div class='pink_dot_repeat'>&nbsp;</div>
        <div class='spacer_12'>&nbsp;</div>
                
        <!--OBJECTIVES-->        
        <h1>Symposium Objectives</h1>
        
        <div class='item'>
           <div class='text'>              
              <ul class="b">
                 <li class='b'>Identify and treat early feeding problems in infants with a variety of medical diagnoses</li>
                 <li class='b'>Outline differences in early sucking that are indicative of an "altered sensory system"</li>
                 <li class='b'>Describe developmental care in the nursery and its relevance to successful feeding</li>
                 <li class='b'>Explain dysphagia in the infant and predictors of adverse developmental outcome and feeding difficulties</li>
                 <li class='b'>Differentiate when laryngeal penetration in a NICU infant is significant and when it is not</li>
             </ul>
           </div><!-- end text-->                                     
        </div>   
        
        <img src="_grafix/sympos-audience.jpg" width="900" height="302" alt="GRAPHIC">
        
        <div class='spacer_12'>&nbsp;</div>        
        
        <!--2014 CIRRICULUM-->
        <h1>1. Browse The Symposium Curriculum (click a day to see/hide events)</h1>         
        
        <div id="accordion">
           <h3>Day 1 - MAIN CONFERENCE - Friday, October 10th</h3>
           <div class="ui-accordion">
              <table class='list'>
                 <tr><td>08:00</td><td class='bld'>Welcome! Marjorie Meyer Palmer, M.A., CCC-SLP Founder and Director, NOMAS International.</td></tr>
                 <tr><td>08:15</td><td class='bld'>Context of the NICU Newborn: struggle for self-regulation in preparation for oral feeding. <span class='ital'>Kathleen A. VandenBerg, PhD.</span></td></tr>
                 <tr><td>09:15</td><td class='bld'>Gastrointestinal Development: implications for infant feeding. <span class='ital'>Josef Neu, M.D.</span></td></tr>
                 <tr><td>10:15</td><td>BREAK</td></tr>
                 <tr><td>10:45</td><td class='bld'>Biorhythms of Suck/Swallow/Breathe during Infant Feeding. <span class='ital'>Ira H. Gewolb, M.D.</span></td></tr>
                 <tr><td>11:45</td><td class='bld'>Is it Neurologic?: dysphagia and neurologic disease in the newborn and young infant <span class='ital'>Peter Bingham, M.D.</span></td></tr>
                 <tr><td>12:45</td><td class='bld'>Panel Discussion; questions and answers.</td></tr>
                 <tr><td>1:15</td><td>LUNCH</td></tr>
                 <tr><td>2:30</td><td class='bld'>Predictors of  Adverse Developmental Outcome and Feeding Difficulties. <span class='ital'>Ira Adams-Chapman, M.D.</span></td></tr>
                 <tr><td>3:30</td><td>BREAK</td></tr>
                 <tr><td>4:00</td><td class='bld'>Sensory Aspects of Neonatal Sucking: early identification. <span class='ital'>Marjorie Meyer Palmer, M.A., CCC-SLP</span></td></tr>
                 <tr><td>5:00</td><td>ADJOURN</td></tr>                                  
              </table>
           </div>
           
           <h3>Day 2 - MEDICAL, NURSING, DEVELOPMENTAL, THERAPEUTIC MODULES - Saturday, October 11th</h3>              
           <div class="ui-accordion">
              <table class='list'>
                 <tr><td colspan='2'>7:00 Coffee / exhibits.</td></tr>
                 <tr><td colspan='2' class='mod'>MEDICAL MODULE (8:00-9:30)</td></tr>
                 <!--A-->
                 <tr><td class='valine'>A.</td><td class='bld'>Olfaction and Early Feeding - Peter H. Bingham, M.D.</td></tr>
                 <tr><td colspan='2'>
                    There is evidence that newborns and premature infants have a good sense of smell that helps organize their behavior. The way in which odors influence feeding
                    responses of sick newborns in the NICU will be explained and suggestions for the modification of the olfactory environment of the sick newborn and young infant in
                    order to promote their healthy growth will be discussed.
                 </td></tr>         
                 <!--B-->
                 <tr><td class='valine'>B.</td><td class='bld'>Diagnosing GER in Infants: a new accelerometric technique - Ira H. Gewolb, M.D.</td></tr>
                 <tr><td colspan='2'>
                    Current methods of diagnosing gastroesophageal reflux in infants are invasive, cumbersome, and often lack reproducibility. The advantages and disadvantages of these
                    current methods will be discussed and a new technology will be introduced. This new non-invasive technology can assess both acid and non-acid reflux and the ways in which
                    it can benefit the field of early diagnosis of gastroesophageal reflux in infants will be discussed.
                 </td></tr>         
                 <!--C-->
                 <tr><td class='valine'>C.</td><td class='bld'>Diagnostic Criteria for Infant Feeding Disorders – Paul E. Hyman, M.D.</td></tr>
                 <tr><td colspan='2'>
                    NICU conditions and prematurity predispose infants to having functional feeding disorders. The reasons for using symptom-based diagnostic criteria for infant feeding
                    disorders will be discussed and the ways in which early recognition of infant feeding disorders will improve patient care will be reviewed.
                 </td></tr>         
                 <tr><td colspan='2'>BREAK (9:30)</td></tr>                                  
                 
                 <tr><td colspan='2' class='mod'>NURSING MODULE (10:00-11:30)</td></tr>
                 <!--A-->
                 <tr><td class='valine'>A.</td><td class='bld'>Co-Regulation as a Strategy for Successful Feeding in the NICU – Suzanne Thoyre, PhD, RN, FAAN</td></tr>
                 <tr><td colspan='2'>
                    The emergent skill of infant oral feeding will be described using a dynamic systems framework. Shifts in system complexity as a necessary component of assessment will be
                    identified along with key skills required of the parent or professional for provision of an infant-guided, co-regulated feeding approach.
                 </td></tr>         
                 <!--B-->
                 <tr><td class='valine'>B.</td><td class='bld'>Improving Breast Feeding Success for the Preterm Infant - Kittie Frantz, RN, CPNP-PC</td></tr>
                 <tr><td colspan='2'>
                    Skin to Skin maternal "laid back position" with "baby-led" attachment for the facilitation of better breast feeding in the preterm infant will be explained. Components of the infant
                    suckle at the breast will be described and suggestions will be given for improved feeding for those infants who have difficulty. Ways to assist the nursing mother to improve her
                    milk supply will be discussed.
                 </td></tr>         
                 <!--C-->
                 <tr><td class='valine'>C.</td><td class='bld'>Assessment of Readiness to Feed from a Nursing Perspective - gretchen Lawhon, PhD, RN, CBC, FAAN</td></tr>
                 <tr><td colspan='2'>
                    The necessary organizational stability within the synactive theory for an infant to feed will be described and observable behaviors in the infant who is showing readiness to feed
                    will be identified. Strategies to support the infant in actively participating in feeding will be explained.
                 </td></tr>         
                 
                 <tr><td colspan='2'>LUNCH (11:30-1:00)</td></tr>                                  
                 
                 <tr><td colspan='2' class='mod'>DEVELOPMENTAL MODULE (1:00-2:30)</td></tr>
                 <!--A-->
                 <tr><td class='valine'>A.</td><td class='bld'>Total Body Development and its Relationship to Early Feeding - John Chappel,M.A., PT</td></tr>
                 <tr><td colspan='2'>
                    The unique network of the aero-digestive system kinematics as it pertains to feeding difficulties will be explained and the inter-relationships and co-morbidities in the cervical
                    spine and cranium that are impacted by the birth process, prematurity, and intubation will be described. Examples will be provided and participants will have the opportunity to
                    analyze strategies that proactively will serve to prevent feeding and digestive problems in the NICU infant.
                 </td></tr>         
                 <!--B-->
                 <tr><td class='valine'>B.</td><td class='bld'>Understanding the NIDCAP Approach in the NICU and its Relationship to Successful Oral Feeding - Kathleen A. VandenBerg, PhD</td></tr>
                 <tr><td colspan='2'>
                    The theoretical background and core neurodevelopmental concepts necessary to understand the NIDCAP approach in the NICU will be explained. Competencies,
                    sensitivities, and self-regulatory behaviors related to successful oral feeding in high-risk infants will be identified as well as the impact of stress and the environment on feeding
                    behavior. Specific individualized developmental family-centered care and behavioral strategies to stabilize and support oral feeding skills will be described.
                 </td></tr>         
                 <!--C-->
                 <tr><td class='valine'>C.</td><td class='bld'>Successful Feeding in the NICU: a preventative model - Kristy Fuller, OTR</td></tr>
                 <tr><td colspan='2'>
                    Supportive pre-feeding and feeding strategies that provide a foundation for optimal oral feeding performance for all babies in the NICU will be outlined. Strategies to support
                    unit practice with an emphasis on "qualitative" rather than "quantitative" feeding performance will be described and case studies will be utilized to help explain a
                    preventative model that supports feeding success and ways to assist the NICU team and family in the implementation of this model.
                 </td></tr>         
                 
                 <tr><td colspan='2'>BREAK (2:30-3:00)</td></tr>                                  
                 
                 <tr><td colspan='2' class='mod'>THERAPEUTIC MODULE (3:00-4:30)</td></tr>
                 <!--A-->
                 <tr><td class='valine'>A.</td><td class='bld'>Feeding Difficulties in Preterm Infants: evaluation procedures and treatment strategies – Pamela Dodrill, PhD</td></tr>
                 <tr><td colspan='2'>
                    The potential impact of gestational age and co-morbidities on the attainment of early oral feeding milestones in preterm neonates will be described. A variety of
                    assessment tools that can be used to evaluate oral feeding in this population will be reviewed and participants will learn evidence-based intervention techniques that
                    can be used to assist with the establishment of early oral feeding.
                 </td></tr>         
                 <!--B-->
                 <tr><td class='valine'>B.</td><td class='bld'>Evaluation and Treatment of Feeding Disorders in Infants with Cardiac Disease - Laura Niemann, OTR/L</td></tr>
                 <tr><td colspan='2'>
                    Common cardiac diagnoses and their impact on feeding will be identified and available assessment tools used for the complex neonate in the cardiac unit will
                    be reviewed. Participants will develop an understanding of OT Pathways for both evaluation and treatment as it relates to feeding neonates in a cardiac unit.
                 </td></tr>         
                 <!--C-->
                 <tr><td class='valine'>C.</td><td class='bld'>Premature Infant Swallowing: patterns of tongue-soft palate coordination based upon videofluoroscopy - Kara Fletcher Larson, M.S., CCC-SLP</td></tr>
                 <tr><td colspan='2'>
                    Videofluoroscopic findings of laryngeal penetration will be discussed and participants will learn when it is and is not clinically significant. Abnormal
                    patterns of infant swallow will be identified and management strategies for pharyngeal reflux will be discussed.
                 </td></tr>         
                 <tr><td colspan='2'>ADJOURN (4:30)</td></tr>                                                          
              </table>
           </div><!--accordion-->
           
           <h3>Day 3 - IN-DEPTH FOCUS GROUPS (8:00-11:30) / DISCUSSION (3:00-3:30) - Sunday, October 12th</h3>              
           <div class="ui-accordion">
              <table class='list'>
                 <tr><td colspan='2'>07:30 - 8:00 Coffee / exhibits.</td></tr>
                 <tr><td colspan='2' class='mod'>IN-DEPTH FOCUS GROUPS (8:00-11:30)</td></tr>
                 <!--A-->
                 <tr><td class='valine'>A.</td><td class='bld'>Introduction to the EFS (Early Feeding Skills) Checklist -Suzanne Thoyre, PhD, RN, FAAN</td></tr>
                 <tr><td colspan='2'>
                    The Early Feeding Skills checklist will be described as a means of identifying infant adaptations to the challenge of feeding. Participants will learn to identify the infant
                    feeding responses that represent readiness for oral feeding, oral motor skills, the ability to organize swallowing, and the ability to engage in sufficient breathing to maintain
                    physiologic stability. Behavioral patterns that infants adopt to protect their airway and attain sufficient breathing during feeding will be reviewed.
                 </td></tr>         
                 <!--B-->
                 <tr><td class='valine'>B.</td><td class='bld'>Clinical Application of the NNNS and its relationship to Feeding- Rosemarie Bigsby, Sc.D., OTR, FAOTA</td></tr>
                 <tr><td colspan='2'>
                    The dynamical systems theory and its application to neonatal feeding will be explained. The components of the NICU Network Neurobehavioral Scale (NNNS) and summary
                    scores will be reviewed and participants will learn how the NNNS can contribute to a contextual systems approach to infant feeding, incorporating autonomic, sensory,
                    physiologic, motor, postural, and behavioral observations.
                 </td></tr>         
                 <!--C-->
                 <tr><td class='valine'>C.</td><td class='bld'>Training in Infant Feeding Management: a simulation to assist in interpreting vital signs during feeding – Pamela Dodrill, PhD</td></tr>
                 <tr><td colspan='2'>
                    Normal and abnormal physiologic parameters for preterm neonates during feeding will be described. Participants will learn to accurately interpret case history information, identify
                    medical equipment, and interpret vital signs monitors used to monitor preterm neonates during feeding. The benefits of human patient simulation in developing and maintaining
                    clinical skills for monitoring during feeding will be outlined.
                 </td></tr>         
                 <tr><td colspan='2' class='bld'>LUNCH (11:30-1:00)</td></tr>   
                 <tr><td colspan='2' class='mod'>DISCUSSION: Questions and Answers With Nils Bergman, M.D. (3:00-3:30)</td></tr>
                 <!--D-->
                 <tr><td colspan='2' class='bld'>What it means to feed an infant in the NICU: what is successful feeding?</td></tr>
                 <tr><td colspan='2'>
                    Neurobehavioral techniques to support breast feeding in preterm infants will be described and the validity of the data provided to justify stomach
                    capacity in the neonate and preterm feeding frequency will be addressed. Some of the consequences of failure to abide by biologically expected
                    parameters for infant feeding that are easily predictable will be discussed.
                 </td></tr>         
                 <tr><td colspan='2' class='bld'>ADJOURN (3:30)</td></tr>                                  
              </table>              
           </div><!--accordion-->                         
        </div><!--ui-accordion--> 
       
        <div class='spacer_12'>&nbsp;</div>
        <div class='pink_dot_repeat' style='width:100%;'>&nbsp;</div>
        <div class='spacer_12'>&nbsp;</div>
        
        <?php $display = false; 
        if($display) {
		?>        
               
        <h1>How to Register For The Symposium</h1>     
        <div class='item'>
           <div class='text'>              
             <ul class="a">
                <li class="a">1) Browse the curriculum and jot down the days and talks you would like to attend.</li>
                <li class="a">2) Register for the Symposium using the form, below.</li>                                 
                <li class="a">3) Pay using the PayPal/credit/debit card form, further below, or mail check and form found in <a href="<?php echo $brochure; ?>" target="_blank">the brochure</a>.</li>
                <li class="a">4) Click the hotel logo, below, to reserve rooms at the Symposium discount (by August 15th!)</li>
             </ul>
           </div><!-- end text-->
        </div><!--end item-->                          
        
        <div class='clearAll'>&nbsp;</div>        
        
        <a name='errors'></a>
        <h1>2. Symposium Registration Form</h1>      
        
        <!-- CONTACT CONTAINER -->
        <div class='form_section'>
           <div class='box'>     
              <form class='signUp' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
             
                  <?php 	  		
                  if (isset($formError['problem']) && $formError['problem'] > '') {
                   echo "<div class='error'>";	
                   echo $formError['problem'];
                   echo "</div>";
                  }	  
                  ?>      
                                
                  <input type="hidden" name="date_in" value="<?php echo $date_in; ?>" />
                  <input type="hidden" name="symp_year" value="<?php echo $symp_year; ?>" />
                  
                  <label for="check_amt">Amount you will send by check (if not sending a check, please leave blank):</label><br>
                  <input style='width:15%;' type="text" name="check_amt" value="<?php echo htmlentities($check_amt); ?>" maxlength="25" /><br>                
                  <?php echo (isset($formError['check_amt']) || !empty($formError['check_amt'])) ? "<div class='error_msg'>" . $formError['check_amt'] . "</div>" : '' ?>
                  
                  <label for="name">Your Name:</label><br>
                  <input style='width:50%;' type="text" name="name" value="<?php echo htmlentities($name); ?>" maxlength="50" /><br>                
                  <?php echo (isset($formError['name']) || !empty($formError['name'])) ? "<div class='error_msg'>" . $formError['name'] . "</div>" : '' ?> 
                  
                  <label for="profession">Your Profession:</label><br>
                  <input style='width:70%;' type="text" name="profession" value="<?php echo htmlentities($profession); ?>" maxlength="100" /><br>                
                  <?php echo (isset($formError['profession']) || !empty($formError['profession'])) ? "<div class='error_msg'>" . $formError['profession'] . "</div>" : '' ?>
                  
                  <label for="employer">Your Employer:</label><br>
                  <input style='width:70%;' type="text" name="employer" value="<?php echo htmlentities($employer); ?>" maxlength="100" /><br>                
                  <?php echo (isset($formError['employer']) || !empty($formError['employer'])) ? "<div class='error_msg'>" . $formError['employer'] . "</div>" : '' ?> 
                  
                  <label for="city_state">Employer CITY, STATE (for your Symposium badge):</label><br>
                  <input style='width:50%;' type="text" name="city_state" value="<?php echo htmlentities($city_state); ?>" maxlength="100" /><br>                
                  <?php echo (isset($formError['city_state']) || !empty($formError['city_state'])) ? "<div class='error_msg'>" . $formError['city_state'] . "</div>" : '' ?>  
                                             
                  <label for="phone1">Best Phone:</label><br>
                  <input style='width:50%;' type="text" name="phone1" value="<?php echo htmlentities($phone1); ?>" maxlength="25" /><br>                
                  <?php echo (isset($formError['phone1']) || !empty($formError['phone1'])) ? "<div class='error_msg'>" . $formError['phone1'] . "</div>" : '' ?>
                  
                  <label for="email">Email:</label><br>
                  <input style='width:80%;' type="text" name="email" value="<?php echo htmlentities($email); ?>" maxlength="100" /><br>                
                  <?php echo (isset($formError['email']) || !empty($formError['email'])) ? "<div class='error_msg'>" . $formError['email'] . "</div>" : '' ?> 
                  
                  <label for="home_addr">Home Address:</label><br>
                  <textarea cols="100" rows="5" name="home_addr"><?php echo htmlentities($home_addr)?></textarea><br>                
                  <?php echo (isset($formError['home_addr']) || !empty($formError['home_addr'])) ? "<div class='error_msg'>" . $formError['home_addr'] . "</div>" : '' ?>         
                                                     
                  <label for="nomas_num">NOMAS License Number (for registration discount):</label><br>
                  <input style='width:30%;' type="text" name="nomas_num" value="<?php echo htmlentities($nomas_num); ?>" maxlength="25" /><br>                
                  <?php echo (isset($formError['nomas_num']) || !empty($formError['nomas_num'])) ? "<div class='error_msg'>" . $formError['nomas_num'] . "</div>" : '' ?> 
                                                     
                  <label for="nurses_num">California Registered Nurses Number (for registration discount):</label><br>
                  <input style='width:30%;' type="text" name="nurses_num" value="<?php echo htmlentities($nurses_num); ?>" maxlength="25" /><br>                
                  <?php echo (isset($formError['nurses_num']) || !empty($formError['nurses_num'])) ? "<div class='error_msg'>" . $formError['nurses_num'] . "</div>" : '' ?>  
                  
                  <div class='spacer_12'>&nbsp;</div>
                  <div class='pink_dot_repeat' style='width:90%;'>&nbsp;</div>                       
                  <div class='spacer_12'>&nbsp;</div>                       
                  
                  <div class='hed'>Please Enter Numbers 1 to 3 to indicate your preference for the 10/11 Module sessions</div>
                  
                  <label for="s_1">Session 1 - Medical Module - 8:00 a.m. to 9:30 a.m.</label><br>
                  A. <input style='width:5%;' type="text" name="s1_a" value="<?php echo htmlentities($s1_a); ?>" maxlength="1" />
                  B. <input style='width:5%;' type="text" name="s1_b" value="<?php echo htmlentities($s1_b); ?>" maxlength="1" />
                  C. <input style='width:5%;' type="text" name="s1_c" value="<?php echo htmlentities($s1_c); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['s1']) || !empty($formError['s1'])) ? "<div class='error_msg'>" . $formError['s1'] . "</div>" : '' ?>       
                  
                  <div class='text'>
                  A - Olfaction and Early Feeding - Peter H. Bingham, M.D.<br>
                  B - Diagnosing GER in Infants: a new accelerometric technique - Ira H. Gewolb, M.D.<br>
                  C - Diagnostic Criteria for Infant Feeding Disorders – Paul E. Hyman, M.D.</div><br><br>
                  
                  <label for="s_2">Session 2 - NURSING MODULE (10:00-11:30)</label><br>
                  A. <input style='width:5%;' type="text" name="s2_a" value="<?php echo htmlentities($s2_a); ?>" maxlength="1" />
                  B. <input style='width:5%;' type="text" name="s2_b" value="<?php echo htmlentities($s2_b); ?>" maxlength="1" />
                  C. <input style='width:5%;' type="text" name="s2_c" value="<?php echo htmlentities($s2_c); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['s2']) || !empty($formError['s2'])) ? "<div class='error_msg'>" . $formError['s2'] . "</div>" : '' ?>       
                  
                  <div class='text'>
                  A - Co-Regulation as a Strategy for Successful Feeding in the NICU – Suzanne Thoyre, PhD, RN, FAAN<br>
                  B - Improving Breast Feeding Success for the Preterm Infant - Kittie Frantz, RN, CPNP-PC<br>
                  C - Assessment of Readiness to Feed from a Nursing Perspective - gretchen Lawhon, PhD, RN, CBC, FAAN
                  </div><br><br>                                               
                  
                  <label for="s_3">Session 3 - DEVELOPMENTAL MODULE (1:00-2:30)</label><br>
                  A. <input style='width:5%;' type="text" name="s3_a" value="<?php echo htmlentities($s3_a); ?>" maxlength="1" />
                  B. <input style='width:5%;' type="text" name="s3_b" value="<?php echo htmlentities($s3_b); ?>" maxlength="1" />
                  C. <input style='width:5%;' type="text" name="s3_c" value="<?php echo htmlentities($s3_c); ?>" maxlength="1" /><br> 
                  <?php echo (isset($formError['s3']) || !empty($formError['s3'])) ? "<div class='error_msg'>" . $formError['s3'] . "</div>" : '' ?>                       
                  
                  <div class='text'>
                  A - Total Body Development and its Relationship to Early Feeding - John Chappel,M.A., PT<br>
                  B - Understanding the NIDCAP Approach in the NICU and its Relationship to Successful Oral Feeding - Kathleen A. VandenBerg, PhD<br>
                  C - Successful Feeding in the NICU: a preventative model - Kristy Fuller, OTR
                  </div><br><br>                     
                  
                  <label for="s_4">Session 4 - THERAPEUTIC MODULE (3:00-4:30)</label><br>
                  A. <input style='width:5%;' type="text" name="s4_a" value="<?php echo htmlentities($s4_a); ?>" maxlength="1" />
                  B. <input style='width:5%;' type="text" name="s4_b" value="<?php echo htmlentities($s4_b); ?>" maxlength="1" />
                  C. <input style='width:5%;' type="text" name="s4_c" value="<?php echo htmlentities($s4_c); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['s4']) || !empty($formError['s4'])) ? "<div class='error_msg'>" . $formError['s4'] . "</div>" : '' ?>       
                  
                  <div class='text'>
                  A - Feeding Difficulties in Preterm Infants: evaluation procedures and treatment strategies – Pamela Dodrill, PhD<br>
                  B - Evaluation and Treatment of Feeding Disorders in Infants with Cardiac Disease - Laura Niemann, OTR/L<br>
                  C - Premature Infant Swallowing: patterns of tongue-soft palate coordination based upon videofluoroscopy - Kara Fletcher Larson, M.S., CCC-SLP
                  </div>              
                  
                  <div class='spacer_12'>&nbsp;</div>
                  <div class='pink_dot_repeat' style='width:90%;'>&nbsp;</div>                       
                  <div class='spacer_12'>&nbsp;</div>
                  
                  <!--10/12 IN DEPTH FOCUS-->
                  
                  <div class='hed'>Please Enter Numbers 1 to 3 to indicate your preference for the 10/12 In-Depth Focus Groups</div>
                  <div class='spacer_6'>&nbsp;</div>
                  
                  <label for="d_a">A. Introduction to the EFS (Early Feeding Skills) Checklist - Suzanne Thoyre, PhD, RN, FAAN</label><br>
                  <span class='text'>Enter preference (1-3) for Group A:</span>&nbsp;&nbsp <input style='width:5%;' type="text" name="d_a" value="<?php echo htmlentities($d_a); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['da']) || !empty($formError['da'])) ? "<div class='error_msg'>" . $formError['da'] . "</div>" : '' ?>                         
                  
                  <label for="d_b">B. Clinical Application of the NNNS and its relationship to Feeding - Rosemarie Bigsby, Sc.D., OTR, FAOTA</label><br>
                  <span class='text'>Enter preference (1-3) for Group B:</span>&nbsp;&nbsp <input style='width:5%;' type="text" name="d_b" value="<?php echo htmlentities($d_b); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['db']) || !empty($formError['db'])) ? "<div class='error_msg'>" . $formError['db'] . "</div>" : '' ?>       
                                    
                  <label for="d_c">C. Training in Infant Feeding Management: a simulation to assist in interpreting vital signs during feeding – Pamela Dodrill, PhD</label><br>
                  <span class='text'>Enter preference (1-3) for Group C:</span>&nbsp;&nbsp <input style='width:5%;' type="text" name="d_c" value="<?php echo htmlentities($d_c); ?>" maxlength="1" /><br> 
                  <?php echo (isset($formError['dc']) || !empty($formError['dc'])) ? "<div class='error_msg'>" . $formError['dc'] . "</div>" : '' ?>                       
                                    
                  <?php $display = false; if($display) { ?>
                  <label for="d_d">D. What it means to feed an infant in the NICU: what is successful feeding? - Nils Bergman, M.D.</label><br>
                  <span class='text'>Enter preference (1-4) for Group D:</span>&nbsp;&nbsp <input style='width:5%;' type="text" name="d_d" value="<?php echo htmlentities($d_d); ?>" maxlength="1" /><br>
                  <?php echo (isset($formError['dd']) || !empty($formError['dd'])) ? "<div class='error_msg'>" . $formError['dd'] . "</div>" : '' ?>     
                  <?php } $display = true;?>
                    
                  <div class='spacer_6'>&nbsp;</div>	
                                    
                  <label for="message">Note or questions for Symposium organizer?</label><br>
                  <textarea cols="100" rows="5" name="message"><?php echo htmlentities($message)?></textarea>
                                                             
                  <div class='spacer_6'>&nbsp;</div>	
                  
                  <div class='captcha_box'>
                   <img id="captcha" src="_inc/securimage/securimage_show.php" alt="CAPTCHA Image" />
                   <a href="#" onclick="document.getElementById('captcha').src = '_inc/securimage/securimage_show.php?' + Math.random(); this.blur(); return false">
                   <img style='padding:16px 20px;' src="_inc/securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" border="0"></a>                   
                   <br style='clear:both'><br>
                   <label for="captcha_code">Please enter below the anti-spam code from above. NOT CASE SENSITIVE.<br>(If too obscure, click circular arrows for a new anti-spam code):</label><br><br>
                   <input style='width:20%;' type="text" name="captcha_code" maxlength="6" />                     
                  </div>                   
                  
                  <?php echo (isset($formError['captcha_code']) || !empty($formError['captcha_code'])) ? "<div class='error_msg'>" . $formError['captcha_code'] . "</div>" : '' ?>                       
                  <button type="submit" name="submit" value="submit">Send Registration</button>        
               </form><br><br>
            </div><!-- end form_box-->  
           <div class='clearAll'>&nbsp;</div>                          
        </div><!-- end form_section-->               
        
        <a name='pay'></a>
        <h1>3. Registration Payment</h1>         
        <div class='paypal_section'>        
            <div class='text'>
               <?php if($today < $earlyBirdEnds) { ?>
                  <span class='bold'>Early registration. Prices rise after July 15th:</span><br><br>
               <?php } ?>   			   	   				   
               Note: because of fees assessed by credit card companies, prices are lower if you send a check or money order. 
               To pay by check, complete the online registration form and send a check separately or, use the registration form in the 
               <a href="<?php echo $brochure; ?>" target="_blank">downloadable brochure</a> and send with your payment to:<br><br>
               NOMAS International<br>
               1528 Merrill Road<br>
               San Juan Bautista CA 95045                            
            </div>                
            
            <div style='padding:8px;'>                   
                                    
            <div class='text' style='font-weight:bold;'>Pay with credit/debit card or PayPal:</div>
            
            <div class='paypal_box'>  
               <div class='text'>NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$617" : "$643"; ?></div>                             
            </div><!--end paypal_box-->
            
            <div class='paypal_box'>  
               <div class='text'>Expired NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$643" : "$669"; ?></div>                             
            </div><!--end paypal_box-->
            
            <div class='paypal_box'>  
               <div class='text'>Not a NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$669" : "$695"; ?></div>                             
            </div><!--end paypal_box-->  
                                  
            <?php if($today < $earlyBirdEnds) { ?>            
            <div class='paypal_box'>  
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium EARLY Licensed">
                  <input type="hidden" name="item_number" value="sel">
                  <input type="hidden" name="amount" value="617.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>      
            </div>
            <div class='paypal_box'>                                     
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium EARLY Expired">
                  <input type="hidden" name="item_number" value="see">
                  <input type="hidden" name="amount" value="643.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>                                          
            </div>
            <div class='paypal_box'>                               
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium EARLY No License">
                  <input type="hidden" name="item_number" value="sen">
                  <input type="hidden" name="amount" value="669.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"> 
                  </form>
            </div>      
            
            <?php } else { ?>
            
            <div class='paypal_box'>                               
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium Licensed">
                  <input type="hidden" name="item_number" value="sl">
                  <input type="hidden" name="amount" value="643.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>
            </div>               
            <div class='paypal_box'>                               
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium Expired">
                  <input type="hidden" name="item_number" value="se">
                  <input type="hidden" name="amount" value="669.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>   
            </div>                                
             <div class='paypal_box'>                               
                  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                  <input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                  <input type="hidden" name="invoice" value="">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Symposium No License">
                  <input type="hidden" name="item_number" value="sn">
                  <input type="hidden" name="amount" value="695.00">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="button_subtype" value="products">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="cn" value="Add special instructions to the seller:">
                  <input type="hidden" name="no_shipping" value="2">
                  <input type="hidden" name="rm" value="1">
                  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/symp_2014.php.php">
                  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                  <input type="hidden" name="add" value="1">
                  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>                                                                             
            </div>
            <?php } ?>
            
            <div class='clearAll'>&nbsp;</div>                             
            
            <div class='text' style='font-weight:bold;'>Pay by check:</div>
            
            <div class='paypal_box'>  
               <div class='text'>NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$600" : "$625"; ?></div>
            </div><!--end paypal_box-->
            <div class='paypal_box'>
               <div class='text'>Expired NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$625" : "$650"; ?></div>      
            </div><!--end paypal_box-->
            <div class='paypal_box'>     
               <div class='text'>Not a NOMAS Licensee: <?php echo ($today < $earlyBirdEnds) ? "$650" : "$675"; ?></div>         
            </div><!--end paypal_box-->  
                        
            </div><!--end pad-->
            
            <div class='spacer_12'>&nbsp;</div>
            
            <div class='text'>
               <span class='strong'>Cancellation Policy:</span> a written request for a full refund must be received by NOMAS International no later than 21 business days prior
               to the start of the Symposium. Written requests received after the deadline may result in a 50% refund; No refund will be issued with fewer than 72 hours notice. NOMAS International
               reserves the right to cancel the event seven days prior to the published start of the event and assumes no responsibility for pre-purchased airline tickets.
            </div>               
       </div><!--end PayPal Section-->
       
        <div class='spacer_6'>&nbsp;</div>
                  
        <a name='hotel'></a>
        <h1>4. Click the hotel logo to reserve rooms at the Symposium special rate</h1> 
        <div class='clearAll'>&nbsp;</div>     
        
        <div class='hotel_box'>
           <div class='img_box'>
              <a href="<?php echo $hotelLink; ?>" target="_blank">
                 <img src="_grafix/logo-holiday-inn.jpg" width="138" height="100" alt="IMG"> 
              </a>
           </div>   
           <div class='text'>
              The Symposium will be held at the Holiday Inn Fisherman's Wharf, 1300 Columbus Avenue, San Francisco, CA, 94133. For those who register by August 20th, a block of rooms 
              has been reserved at the special rate of $249/night for single/double. Triples available for $269/night. Quads at $289/night.
              YOU MUST RESERVE YOUR ROOM BY AUGUST 20th to obtain the discount. Phone hotel directly at: 800-942-7348. 
              Enter check-in & check-out dates and Group Code "NMS" if <a href="<?php echo $hotelLink; ?>" target="_blank">registering online</a>.
           </div>  
           <div class='clearAll'>&nbsp;</div>            
        </div>          
                            
        <div class='spacer_12'>&nbsp;</div>
        <div class='pink_dot_repeat' style='width:100%;'>&nbsp;</div>
        
        <?php } $display - true; ?>
                        
        <!--LOGO BLOCK-->        
        <!--<h1>Authorization to provide CEU Credits is pending</h1>-->
        <div class='clearAll'>&nbsp;</div>                    
        <div class='ceu_section'>        
           <div class='ceu_asha_logo_box'>
              <img src="_grafix/logo-asha-approved-2013.gif" width="600" height="143" alt="logo">
              <div class='caption'>
                 Days 1-3 (inclusive) are offered for 1.85 ASHA CEU's. Various levels; Professional Area.
              </div><!-- end caption-->
           </div><!-- end ceu_logo_box-->
        
           <div class='spacer_6'>&nbsp;</div>           
        
           <div class='ceu_logo_box'>
              <img src="_grafix/logo-aota-provider.gif" width="378" height="94" alt="logo">
              <div class='caption'>
                 Days 1-3 (inclusive) are offered for 1.8 AOTA CEU's.
                 Therapeutic Media is an AOTA Approved Provider of Continuing Education. AOTA does not endorse specific course content, products, or clinical procedures.
              </div><!-- end caption-->
           </div><!-- end ceu_logo_box--> 
           <div class='ceu_sponsor_box'>
              <img src="_grafix/logo-geddes.jpg" width="100" height="100" alt="MMP">
           </div>    
                                    
           <div class='spacer_6'>&nbsp;</div>           
           
           <div class='ceu_logo_box'>
              <img src="_grafix/logo-ca-nurses.gif" width="168" height="94" alt="logo">
              <div class='caption'>
                 Days 1-3 (inclusive) 18 Contact Hours.
                 Therapeutic Media is a Provider for Continuing Education by the California Board of Registered Nursing, Provider #CEP 13879.                 
              </div><!-- end caption-->
           </div><!-- end logo_box-->   
           <div class='ceu_sponsor_box'>
              <img src="_grafix/logo-medelia.jpg" width="267" height="100" alt="MMP">
           </div>                  
           <div class='spacer_6'>&nbsp;</div>
           <div class'clearAll'>&nbsp;</div>            
        </div><!--end ceu section-->  
        
      </div><!--END COLUMN LEFT-->             
   </div> <!-- end content  -->
  
   <div class='clearAll'>&nbsp;</div>
  
   <!--FOOTER-->
   <div id="footer"> 
      <?php showBottomMenu(); ?>
      <?php showCopyright($thisYear); ?>
   </div><!-- end footer -->
 
   <div class='clearAll'>&nbsp;</div>

</div><!-- end #playround -->
<script>
<!--
startcart()

$( "#accordion" ).accordion({
 heightStyle: "content",
 collapsible: true,
 active: false	
});

$( "#accordion1" ).accordion({
 heightStyle: "content",
 collapsible: true,
 active: false	
});
-->  
</script>
</body>
</html>
