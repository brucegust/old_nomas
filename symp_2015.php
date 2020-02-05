<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_inc/mail_functions.php";
include_once "_nav/nav_site_001.php"; // top nav menu

// ******************************************************************

// EVENT
$sympCity          = "Orlando";
$sympCityState     = "Orlando, Florida";
$earlyBirdEnds     = date("2015-07-15");
$hotelEarlyEnds    = "September 20th";
$hotelName         = "the Holiday Inn Orlando-Lake Buena Vista, located in the Walt Disney World Resort";
$hotelPhone        = "877-394-5765";
$hotelCode         = "NIS";
$hotelURL          = "http://bit.ly/1d23FYz";

// Prices          

// FULL CONFERENCE
$f_lic             = $today <= $earlyBirdEnds ? "750" : "775"; // full licensed
$f_exp             = $today <= $earlyBirdEnds ? "785" : "810"; // full expired license
$f_not             = $today <= $earlyBirdEnds ? "820" : "845"; // full no license
$pf_lic            = floor($f_lic * (1 + (3.5 / 100))); // paypal - full licensed
$pf_exp            = floor($f_exp * (1 + (3.5 / 100))); // paypal - full expired
$pf_not            = floor($f_not * (1 + (3.5 / 100))); // paypal - full no license
// MAIN CONFERENCE
$m_lic             = $today <= $earlyBirdEnds ? "600" : "625"; // main licensed
$m_exp             = $today <= $earlyBirdEnds ? "625" : "650"; // main expired license
$m_not             = $today <= $earlyBirdEnds ? "650" : "675"; // main expired license 
$pm_lic            = floor($m_lic * (1 + (3.5 / 100))); // paypal - main licensed
$pm_exp            = floor($m_exp * (1 + (3.5 / 100))); // paypal - main expired
$pm_not            = floor($m_not * (1 + (3.5 / 100))); // paypal - main no license
// ONE DAY
$one_lic           = $today <= $earlyBirdEnds ? "200" : "215"; // 1-Day licensed
$one_exp           = $today <= $earlyBirdEnds ? "210" : "225"; // 1-Day expired license
$one_not           = $today <= $earlyBirdEnds ? "220" : "235"; // 1-Day no license
$pone_lic          = floor($one_lic * (1 + (3.5 / 100))); // paypal - 1-Day licensed
$pone_exp          = floor($one_exp * (1 + (3.5 / 100))); // paypal - 1-Day expired
$pone_not          = floor($one_not * (1 + (3.5 / 100))); // paypal - 1-Day no license


// MASTER SWITCHES
$display           = false;  
$comingSoon        = false;
$showBrochure      = true;
$showDload         = ($today <= '2014-07-15') ? true : false; // switch to display presentation download page
$pwordCheck        = false;  // used for sign-in to download symposium presentations
$showLineUp        = true;
$showSponsors      = true;
$showObjectives    = true;
$showPhoto         = true;
$showFaculty       = true;
$showRegisterHowTo = true;
$showCirriculum    = true;
$showRegisterForm  = true;
$showHotel         = true;
$showPayPal        = true;
$showCEU           = true;
$showBottomAd      = false;

$comingSoonMSG     = "Complete information and sign-up material coming soon!";
$brochureURL       = "_docs/symposia_brochures/2015-NOMAS-symposium.pdf";
$dloadPass         = "nomas2015"; // password to access download presentations page
$dloadRedir        = 'symp_2015_dloads.php'; // page name for presentations downloads
$thisPage          = "http://www.nomasinternational.org/symp_2015.php";

// LINKS

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

$pageTitle    = "The Fifth Annual NOMAS<sup>&reg;</sup> International Symposium in " . $sympCityState;
$pageSubTitle = 'The Only Four Day <em>Advanced Level Conference</em> that is "ALL ABOUT FEEDING" - October 27-30th, 2015';

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
	  $message     = '';	   
	  unset($_POST);
	  unset($_POST['submit']);
   }
} 
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
<link href="_css/symp_2015.css" rel="stylesheet" type="text/css">
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

   <div style="width:100%;height:30px;">&nbsp;</div>
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
      
      <!--COMING SOON - BROCHURE-->
      <?php if($comingSoon) { ?>
         <div class='dload_brochure'>
            <span class='label' style='font-size:2em;'>
            <?php echo $comingSoonMSG; ?>
            </span>
         </div> 
      <?php } ?>     
            
      <?php if($showBrochure && file_exists($brochureURL)) { ?>
         <div class='text_hed'>
            <a href="<?php echo $brochureURL; ?>" target="_blank">Click to download/print Symposium brochure</a>
         </div>
      <?php } ?> 
      
      <!-- DOWNLOAD PRESENTATIONS-->
      <?php if($showDload) { 
      $comingSoon = false; ?>
      <div class='dload_brochure'>
         <form class='dload_pword' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST">  
            <label for 'dloadPass'>Enter password to download slides & presentations:</label>                
            <input type="password" name="dloadPass" maxlength='12' size='9' value="<?php echo htmlspecialchars($dloadPass); ?>" />
            <input type="submit" name="dload" value="Enter">
         </form>                  
      </div>  
	  <?php } ?>
      
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
       
      <!-- GREETING-->
      <div class="item">
         <div class="text" style="float:left;display:inline;">
            This year's Symposium at the Holiday Inn-Disney World Resort in Orlando, Florida, will include a day of evaluation, 
            a day of treatment, and a 'Reflective Learning' experience where you will have the opportunity to diagnose the problems, 
            identify the feeding issues, and plan the intervention strategies for a specific infant. This will truly be a <strong>unique learning 
            experience</strong>, one in which you will be able to share and learn from your colleagues in the field.  Presenters and team leaders 
            will include experts from the fields of Neonatology, Pediatric Neurology, Developmental Medicine, Speech Pathology, Occupational Therapy, 
            Physical Therapy, and NIDCAP Developmental Specialists. I look forward to seeing you at this unique and valuable learning 
            experience!<br><br>
         </div>     
      </div>
      
      <div class="clearAll"></div>
        
      <div class='item'>     
         <div class='text' style="width:30%;">
            <img src="_grafix/palmer-marjorie-outdoor-150.jpg" width="150" height="150" alt="MMP">
         </div>
         <div class='text' style="float:left;display:inline;width:30%;">
            Sincerely,<br>
            <img src="_grafix/punky-signature.jpg" width="72" height="44" alt="GRAPHIC">
            <br><br>Marjorie Meyer Palmer, M.A., CCC-SLP<br>
            Founder/Director<br>NOMAS<sup>&reg;</sup> International
         </div>  
         <div class='text' style="width:30%;float:right;border:none;">
            <img src="_grafix/nidcap-logo.jpg" width="213" height="100" alt="GRAPHIC"><br>
            Endorsed by the NIDCAP Federation International, Inc.
         </div>              
      </div><!--end item-->   
        
      <div class='spacer_26'>&nbsp;</div>
      <div class='pink_dot_repeat'>&nbsp;</div>
      <div class='spacer_12'>&nbsp;</div>
      
      <?php if($showLineUp) { ?>
      <!-- This Year's Line-up-->  
      <div class='item' style="width:97%;padding:12px;background-color:#ebebeb;">
        <div class='text'>              
           <span style='color:#550000;font-style:italic;font-size:1.3em;'>This Year's Line-Up</span><br><br>
           Submit a Poster Presentation: Focus on Neonatal Feeding-share a project, study, clinical model, new idea, 
           treatment technique, intervention strategy.<br><br>              
           <div style='width:90%;margin-left:auto;margin-right:auto;padding:0 5%;'>
              <ul class="b">        
                 <li class='b'>October 27: Join Dr. Nils Bergman in "Bringing the latest neuroscience 
                 to the infant in the NICU for better feeding outcomes".</li><br>
                 
                 <li class='b'>October 28: Evaluation and Treatment Strategies for the Poor Feeder in 
                 the NICU: Learn about Developmental Care with gretchen Lawhon, PhD; the Early Feeding Scale (EFS) with 
                 Suzanne Thoyre, PhD; and the NOMAS<sup>&reg;</sup> (Neonatal Oral-Motor Assessment Scale) with 
                 Marjorie Meyer Palmer, M.A. CCC-SLP.</li><br>
                 
                 <li class='b'>October 29: Develop Therapeutic Intervention and Treatment Strategies with 
                 Kristy Fuller, OTR; John Chappel, RPT;  and Marjorie Meyer Palmer, M.A., CCC-SLP. 
                 Experience NOMAS Grand Rounds with a panel of professionals who will diagnose, formulate treatment plans, 
                 and discuss prognostic indicators for successful feeding.</li><br>
                 
                 <li class='b'>October 30: Reflective Learning Experience with audience participation in problem solving: 
                 Medical (Peter Bingham, MD; Suzanne Thoyre, PhD, RN). 
                 Developmental (Linda Lowman, MEd; John Chappel, RPT) Therapeutic (Kristy Fuller, OTR; Dawn Jernigan, M.A., CCC-SLP).</li><br>  
                 
                 <li class='b'>For the afternoon: select: infant feeding management, videofluoroscopy, or NOMAS® Refresher 
                 course (for those who qualify).</li><br>
             </ul>
          </div><!-- end UL div--> 
        </div><!-- end text-->                                     
      </div><!-- end item-->   
      <?php } ?>

      <?php if($showSponsors) { ?>                        
      <div class='item'>  
         <div style='float:left;display:inline;margin-bottom:21px;'>                              
            <p class='sponsor_title' style='color:#CC9900;'>GOLD SPONSOR</p><br><br>
            <img style='float:left;border:none;display:inline;' src="_grafix/logo-mead-johnson.jpg" width="330" height="120" alt="MMP">
         </div>
         <div style='float:right;display:inline;margin-bottom:21px;'>                              
            <p class='sponsor_title' style='color:#A78B58;'>BRONZE SPONSORS</p><br><br>
            <img style='float:left;border:none;display:inline;' src="_grafix/logo-dr-brown.jpg" width="250" height="106" alt="MMP">     
            <img style='float:left;border:none;display:inline;' src="_grafix/logo-medelia.jpg" width="267" height="100" alt="MMP">     
         </div><!--end text-->        
      </div>
        
      <div class='spacer_12'>&nbsp;</div>
      <div class='pink_dot_repeat'>&nbsp;</div>
      <div class='spacer_6'>&nbsp;</div>
      <?php } ?>              
      
      <?php if($showObjectives) { ?>                                             
      <!--OBJECTIVES-->        
      <h1>Symposium Objectives</h1>        
      <div class='item'>
         <div class='text'>              
            <ul class="b">
               <li class='b'>Identify and treat early feeding problems in infants with a variety of medical diagnoses.</li>
               <li class='b'>Describe developmental care in the nursery and the way in which it influences oral feeding for the NICU infant.</li>
               <li class='b'>Outline the characteristics of disorganized and dysfunctional sucking and the differences in therapeutic intervention
                and treatment strategies recommended based upon sucking pattern to insure successful feeding.</li>
               <li class='b'>Describe ways in which developmental care can be implemented during VFSS (MBS) to facilitate successful swallowing 
               and to prevent aspiration in the premature infant.</li>
               <li class='b'>Explain the Early Feeding Skills (EFS) Checklist and its relevance to the NICU infant.</li>
           </ul>
         </div><!-- end text-->                                     
      </div>           
      <?php } ?>        
      
      <?php if($showFaculty) { ?>
      <div id="faculty">
         <h3>Click to See This Year's Faculty and Their Financial Disclosures</h3>
         <div class="ui-accordion">
            <div class="list">
               <span style="font-weight:bold;">Nils Bergman, M.D., Visiting Guest Lecturer</span><br>
               Public Health Physician, Honorary Research Associate, Honorary Senior Lecturer<br>
               University of Cape Town, Cape Town, South Africa<br>
               <span class="list_finc">Financial Disclosure: Dr. Bergman is the owner of NINO Academy for which he has intellectual property 
               rights and a management position.  As such he receives financial reimbursement in the form of speaking fees, 
               royalty, and honoraria and receives an honorarium for his presentation at the Fifth Annual NOMAS 
               International Symposium. He will have relevant products available for purchase at the Symposium.<br>
               Non-financial Disclosure: No relationships to disclose.           
               </span><br><br>

               <span style="font-weight:bold;">Peter Bingham, M.D., Professor of Neurology and Pediatrics</span><br>
               University of Vermont, Burlington, Vermont<br>
               <span class="list_finc">Financial Disclosure: Dr. Bingham receives an honorarium for his presentation at the Fifth Annual 
               NOMAS International Symposium.<br> 
               Non-Financial Disclosure: No relationships to disclose.
               </span><br><br>
               
               <span style="font-weight:bold;">John Chappel, M.A., RPT, NIDCAP Certified Pediatric Physical Therapist</span><br>
               Meta-Physical Therapeutics, Easthampton, New York<br>
               Director, Synactive Pediatrics, URSA Educational Institute for Manual Therapy, Sacramento, California<br>
               <span class="list_finc">Financial Disclosure: Mr. Chappel receives an honorarium for his presentation at the 
               Fifth Annual NOMAS International Symposium.<br>
               Non-Financial Disclosure: No relationships to disclose.
               </span><br><br>
               
               <span style="font-weight:bold;">Kristy Fuller, OTR/L, Occupational Therapist/Feeding Specialist</span><br>
               Unity Point Health, Neonatal Intensive Care Unit<br>
               St. Luke's Hospital, Cedar Rapids, Iowa<br>
               <span class="list_finc">Financial Disclosure: Ms. Fuller receives an honorarium for her presentation at the 
               Fifth Annual NOMAS International Symposium.<br>
               Non-Financial Disclosure: Ms. Fuller has training in the EFS, NOMAS, Prechtl's General Movement, 
               Dr. Brown's, VIDA, Avent 2-flo health videos and may have a bias toward these.               
               </span><br><br>
               
               <span style="font-weight:bold;">Dawn Jernigan, M.A., CCC-SLP, Speech-Language Pathologist, NOMAS® Course Instructor</span><br>
               Lead NICU Therapist, Wellstar Kennestone Hospital, Marietta, Georgia<br>
               <span class="list_finc">Financial Disclosure: Ms. Jernigan is a Licensed NOMAS Instructor and receives financial reimbursement 
               for teaching NOMAS Certification Courses. She receives an honorarium for her presentation at the Fifth Annual NOMAS 
               International Symposium.<br>
               Non-Financial Disclosure: No relationships to disclose.
               </span><br><br>
               
               <span style="font-weight:bold;">gretchen Lawhon, PhD, RN, CBC, FAAN, Clinical Nurse Specialist, NIDCAP Master Trainer</span><br>     
               President, NIDCAP Federation International, West Coast NIDCAP and APIB Training Center<br>
               University of California-San Francisco, San Francisco, California<br>
               <span class="list_finc">Financial Disclosure: Dr. Lawhon receives an honorarium for her presentation 
               at the Fifth Annual NOMAS International Symposium.<br>
               Non-Financial Disclosure: Dr. Lawhon is President of the Board of Directors of the NIDCAP Federation International, 
               a non-profit organization which influences her theoretical presentation.               
               </span><br><br>
               
               <span style="font-weight:bold;">Linda Lowman, M.Ed., NIDCAP Certified Developmental Specialist, NOMAS® Course Instructor</span>
               <br>Alexander Center for Neonatology, Winnie Palmer Hospital for Women & Babies, Orlando, Florida<br>
               <span class="list_finc">Financial Disclosure: Ms. Lowman has no financial relationships to disclose.<br>
               Non-Financial Disclosure: Ms. Lowman is a Licensed NOMAS Instructor, and a NIDCAP Certified Developmental Specialist.               
               </span><br><br>
               
               <span style="font-weight:bold;">Marjorie Meyer Palmer, M.A., CCC-SLP, Neonatal/Pediatric Feeding Specialist</span><br>
               Retired Clinical Instructor, Department of Pediatrics, Division of Gastroenterology, Hepatology, and Nutrition<br>
               University of California-San Francisco School of Medicine<br>
               Founder/Director, NOMAS® International, San Juan Bautista, California<br>
               <span class="list_finc">Financial Disclosure: Ms. Marjorie Meyer Palmer receives financial compensation for teaching 
               live courses on feeding, online continuing education courses in feeding offered at 
               www.nomasinternational.org, teaching Certification Courses in the NOMAS, and non-exclusive Copyright License 
               Renewal of NOMAS Certified Professionals.  She is the sole distributor of the Fantastic Feeding Dropper. 
               She receives an honorarium for her presentations at the Fifth Annual NOMAS International Symposium.<br>
               Non-Financial disclosure: Ms. Palmer is the Founder and Director of NOMAS International, a current 
               member of the American Academy of Cerebral Palsy, and the NIDCAP Federation International.                
               </span><br><br>
               
               <span style="font-weight:bold;">M. Kathleen Philbin, RN, PhD; Clinical Nurse Scientist, Educator, Trainer</span><br>
               Retired Adjunct Associate Professor of Nursing, School of Nursing, University of Pennsylvania<br>
               Philadelphia, Pennsylavania<br>
               <span class="list_finc">Financial Disclosure: Dr. Philbin receives an honorarium for her presentation at the Fifth 
               Annual NOMAS International Symposium. She receives royalties from a book that she has published that is related to 
               this presentation and also receives consulting fees for work that is related. Her handbook may be available for 
               purchase at the Symposium.<br>
               Non-Financial Disclosure: Dr. Philbin has no relevant non-financial relationships to disclose.   
               </span><br><br>
 
               <span style="font-weight:bold;">Suzanne M. Thoyre, PhD, RN, FAAN, Francis Hill Fox Distinguished Term Professor</span><br>
               School of Nursing, University of North Carolina at Chapel Hill, Chapel Hill, North Carolina<br>
               <span class="list_finc">Financial Disclosure: Dr. Thoyre receives financial reimbursement for her presentation at the 
               Fifth Annual NOMAS International Symposium.<br>
               Non-Financial Disclosure: Dr. Thoyre has not relevant non-financial relationships to disclose.                     
               </span><br><br>
               
               <span style="font-weight:bold;">Thomas E. Young, M.D.</span><br>
               Medical Director, Neonatal Intensive Care Unit, Wake Med-Raleigh Campus Medical Center<br>
               Adjunct Professor of Pediatrics, University of North Carolina School of Medicine, Chapel Hill, North Carolina<br>
               <span class="list_finc">Financial Disclosure: Dr. Young receives financial reimbursement for his presentation at the 
               Fifth Annual NOMAS International Symposium.<br>
               Non-Financial Disclosure: No non-financial relationships to disclose.               
               </span><br><br>
            </div>           
         </div>
      </div>   
      <div class='spacer_12'>&nbsp;</div>
      <div class='pink_dot_repeat'>&nbsp;</div>
      <div class='spacer_6'>&nbsp;</div>        
      <?php } ?>        
                    
      <?php if($showPhoto) { ?>
      <img style="width:910px;height:300px;" src="_grafix/sympos-audience-r.jpg" width="959" height="322" alt="GRAPHIC">      
      <div class='spacer_6'>&nbsp;</div>
      <div class='pink_dot_repeat'>&nbsp;</div>
      <div class='spacer_6'>&nbsp;</div>              
      <?php } ?>          
      
      <?php if($showRegisterHowTo) { ?>  
      <h1>How to Register For The Symposium</h1> 
      <div style="width:96%;background-color:#E6FFE6;padding:21px 12px 1px 25px;">    
         <div class='item'>
            <div class='text'>              
               <ul class="a">
                  <li class="a">1) Browse the curriculum, below, and jot down the days and talks you would like to attend.</li>
                  <li class="a">2) Register for the Symposium using the form, below.</li>                                 
                  <li class="a">3) Pay using the PayPal/credit/debit card form, or mail check along with the  
                  <a href="<?php echo $brochure; ?>" target="_blank"> form found in the brochure</a>.</li>
                  <li class="a">4) Click the hotel logo, below, to reserve rooms at the Symposium discount 
                  (by <?php echo $hotelEarlyEnds; ?>!)</li>
               </ul>
            </div><!-- end text-->
         </div><!--end item-->        
      </div>                        
      <div class='clearAll'>&nbsp;</div> 
      <?php } ?>             
      
      <?php if($showCirriculum) { ?>
      <!--CIRRICULUM-->
      <div class='spacer_6'>&nbsp;</div>       
      <h1>1. Browse The Symposium Curriculum (click a day to see/hide events)</h1>      
      <div id="cirriculum">
         <h3>Day 1 - PRE-CONFERENCE - Tuesday, October 27th</h3>
         <div class="ui-accordion">
            <br><span class="text">
            7:00 to 8:00 - Registration and coffee.<br><br>
            Bringing The Latest Neuroscience to The Infant in The NICU For Better Feeding Outcomes – Nils Bergman. M.D. Topics will include:</span>
            <br><br>
            <ul>
               <li>Basic neuroscience and the foundational role of sleep, biological clocks, and rhythms.</li>
               <li>Role of skin-to-skin contact in sleep, rhythms, regulation and sucking behavior.</li>
               <li>Effects of maternal neonate separation, early and late, and on suckling.</li>
               <li>Recognizing separation physiology and restoring regulation.</li>
               <li>Differentiating neonatal suckling behavior from adult ingestion, and timing of weaning.</li>
               <li>Linking maternal neuroendocrine behavior to infant regulation and breastfeeding.</li>
               <li>Practical aspects and implications to support feeding in the real world of the NICU.</li>
               <li>Impact of early perinatal care on long term bonding and attachment.</li>             
            </ul>                   
         </div>
         
         <h3>Day 2 - EVALUATION - Wednesday, October 28th</h3>              
         <div class="ui-accordion">
           <table class='list'>
              <tr><td colspan='2' class='mod'>Evaluation: Identifying the feeding problem and what is going wrong</td></tr>
              <tr>
                 <td colspan='2'>7:00-8:00 a.m.  Registration, Coffee, Exhibits, Poster Sessions.</td></tr>
              <tr>
                 <td colspan='2'>8:00-8:15 a.m. Welcome – Marjorie Meyer Palmer, M.A., CCC-SLP</td></tr>
              <!--A-->
              <tr><td class='valine'>8:15-10:15</td>
                 <td>
                 <span class='bld'>Developmental Assessment of the Infant: the Science of Compassion - gretchen Lawhon, PhD, RN, CBC, FAAN.</span><br>
                 Learn to: identify key components of the synactive theory of newborn development; strategies in the integration of 
                 developmental assessment through relationship based care; and ways in which developmental assessment of the 
                 infant provides incidental teaching and validation to parents.
                 </td></tr>         
              <!--B-->
              <tr><td class='valine'>10:15-10:45</td>
                 <td>BREAK</td></tr>         
              <!--C-->        
              <tr><td class='valine'>10:45-12:45</td>
                 <td>
                 <span class='bld'>Early Feeding Skills (EFS) Checklist - Suzanne Thoyre, PhD, RN, FAAN</span><br>
                 Learn to: Identify infant adaptations to the challenge of feeding; describe infant responses that represent 
                 readiness for oral feeding; and explain the ability to organize swallowing, and maintain physiologic stability.
                 </td></tr>                     
              <!--D-->
              <tr><td class='valine'>12:45-2:00</td>
                 <td>LUNCH</td></tr>         
              <!--E-->                                                           
              <tr><td class='valine'>2:00-3:00</td>
                 <td>
                 <span class='bld'>Diagnosis of Neonatal Sucking Patterns: normal, disorganized, dysfunctional based on the NOMAS®
                 Neonatal Oral-Motor Assessment Scale) - Marjorie Meyer Palmer, M.A, CCC-SLP.</span><br>
                 Learn to: Identify infant adaptations to the challenge of feeding; describe infant responses that represent 
                 readiness for oral feeding; and explain the ability to organize swallowing, and maintain physiologic stability.
                 </td></tr>                     
              <!--F-->              
              <tr><td class='valine'>5:00</td>
                 <td>ADJOURN</td></tr>                  
           </table>
         </div><!--accordion-->
         
         <h3>Day 3 - TREATMENT - Thursday, October 29th</h3>              
         <div class="ui-accordion">
           <table class='list'>
              <tr><td colspan='2' class='mod'>Treatment: Intervention Strategies to "Fix the Problem"</td></tr>
              <tr>
                 <td colspan='2'>7:15-8:15 a.m. Coffee, Exhibits, Poster Sessions.</td></tr>
              <!--A-->
              <tr><td class='valine'>8:15-10:15</td>
                 <td>
                 <span class='bld'>Developmental Interventions to Promote Successful Feeding – Kristy Fuller, OTR/L.</span><br>
                 Learn to: list supportive pre-feeding and feeding readiness strategies that provide a foundation for optimal oral feeding 
                 performance for all babies in the NICU; identify signs of stress and their impact on suck/swallow/breathe coordination; 
                 and discuss interventions that support safe and successful feeding interactions.
                 </td></tr>         
              <!--B-->
              <tr><td class='valine'>10:15-10:45</td>
                 <td>BREAK</td></tr>         
              <!--C-->        
              <tr><td class='valine'>10:45-12:45</td>
                 <td>
                 <span class='bld'>Positioning the Infant for Optimal Feeding Success – John Chappel, M.A., RPT.</span><br>
                 Learn to: conceptualize diaphragmatic morphology as it pertains to developing better infant respiratory efficiency; 
                 identify methods to promote function in the respiratory system of ELBW infants through analyzing posture and positioning; 
                 and define specific problems that interfere with the acquisition of aerodigestive functions and feeding in the NICU infant.
                 </td></tr>                     
              <!--D-->
              <tr><td class='valine'>12:45-2:00</td>
                 <td>LUNCH</td></tr>         
              <!--E-->                                                           
              <tr><td class='valine'>2:00-3:00</td>
                 <td>
                 <span class='bld'>Diagnostic-Based Intervention for Infants with a Disorganized or Dysfunctional Suck – Marjorie 
                 Meyer Palmer, M.A., CCC-SLP.</span><br>
                 Learn to: describe four intervention strategies to aid the coordination of respiration in the infant with a disorganized 
                 suck; outline four therapeutic techniques for the infant with a dysfunctional suck; and explain ways to help the infant 
                 who demonstrates a sensory feeding issue.
                 </td></tr>                     
              <!--F-->              
              <tr><td class='valine'>3:00 to 3:30</td>
                 <td>BREAK</td></tr>     
              <!--G-->                                                           
              <tr><td class='valine'>3:30-5:00</td>
                 <td>
                 <span class='bld'>NOMAS® GRAND ROUNDS:</span><br>
                 Videos of infant feeding viewed and evaluated followed by a discussion of intervention strategies presented by a 
                 multidisciplinary panel of professionals that includes: Neonatologist (Dr. Thomas Young), Pediatric Neurologist
                 (Dr. Peter Bingham), Nurse (Dr. Suzanne Thoyre, PhD., RN, FAAN), Developmental Specialist (Ms. Linda Lowman, M.Ed), 
                 Physical Therapist (Mr. John Chappel, M.A., RPT), Occupational Therapist( Ms. Kristy Fuller, OTR/L), and Speech 
                 Pathologist (Ms. Marjorie Meyer Palmer, M.A., CCC-SLP) as Moderator.
                 </td></tr>                     
              <!--H-->              
              <tr><td class='valine'>5:00</td>
                 <td>ADJOURN</td></tr>                                                                                                    
           </table>
         </div><!--accordion-->         
         
         <h3>Day 4 - REFLECTIVE LEARNING - Friday, October 30th</h3>              
         <div class="ui-accordion">
           <table class='list'>
              <tr><td colspan='2' class='mod'>Reflective Learning Experience</td></tr>
              <tr>
                 <td colspan='2'>7:00-8:00 a.m. Coffee. (Also from 9:30 to 10:00).</td></tr>
              <!--A-->
              <tr><td class='valine'>8:00-11:30</td>
                 <td>
                 Take part in small discussion groups and participate in the learning process while you view infant videos that help you 
                 to understand infant behavior, stress cues, distress signals, readiness to feed, events that contribute to successful 
                 or unsuccessful feeding performances, variations in sucking patterns, and the importance of respiration in feeding. 
                 Discuss with colleagues intervention strategies and therapeutic techniques that work, why, and when. 
                 <span class="ital">Find out why that one infant in the NICU just can't seem to feed</span>. Learn to problem solve 
                 those strategies, techniques, positions, nipples, environments that are most helpful and in which situations, and those 
                 that are not. Develop your diagnostic skills that will help you find your own way.<br><br>
                 This experience is designed to help you to become a more competent and successful clinician and not about using a 
                 particular technique. Each group will view the same infant video clips.<br><br>
                 Select the Reflective Learning Experience that best suits your needs.
                 </td></tr>   

              <tr><td class='valine'>A</td>
                 <td>
                 Medical Perspective moderated by Dr. Peter Bingham and Dr. Suzanne Thoyre, PhD, RN, FAAN
                 </td></tr>
                 
              <tr><td class='valine'>B</td>
                 <td>
                 Developmental Perspective moderated by Mr. John Chappel, M.A., RPT and Ms. Linda Lowman, M.Ed
                 </td></tr>
                 
              <tr><td class='valine'>C</td>
                 <td>
                 Therapeutic Perspective moderated by Ms. Kristy Fuller, OT R/L and Ms. Dawn Jernigan, M.A., CCC-SLP
                 </td></tr>                                                         

              <tr><td>&nbsp;</td>
                 <td style="font-style:italic;">
                 *If you would like to videotape your baby in the NICU for this learning experience and sharing please contact:
                 <a href="contact.php">marjorie@nomasinternational.org</a>
              </td></tr>
              
              <tr><td colspan="2">&nbsp;</td></tr>
                                 
              <tr><td class='valine'>11:30 to 1:00</td>
                 <td>LUNCH</td></tr>         
              <!--C-->        
              
              <tr><td colspan='2' class='mod'>Concurrent Sessions (1:00 to 3:00)</td></tr>
              <tr><td class='valine'>A</td>
                 <td>
                 <span class="bld">It's Never Too Late: NOMAS® Refresher Course - Linda Lowman, M.Ed, NOMAS&reg; Course Instructor.</span><br>
                 For those NOMAS&reg; Certified Professionals who have let their licenses lapse OR if you are someone who has taken the 
                 NOMAS&reg; Certification Course but did not achieve Reliability this is your opportunity to try again. There is no extra 
                 fee for this opportunity and, after completing Reliability you will have the benefit of group discussion as you view
                 neonatal sucking patterns on video.
                 </td></tr>
                 
              <tr><td class='valine'>B</td>
                 <td>
                 <span class="bld">Feeding Preterm and Fragile Infants: Science, Myth, Misleading Research – Kathleen Philbin, PhD., RN.</span><br>
                 A review of the literature and research studies that describe how, when, and why to feed premature and sick term newborns 
                 in the NICU. Learn to evaluate whether an article about feeding is focused on quantity fed or quality of the experience; describe 
                 the problem of measuring feeding success by the postmenstrual age of "full bottle feedings", and explain the distinction 
                 between "ready to feed" as a developmental achievement and "ready to feed" as an event at a particular time.
                 </td></tr>
                 
              <tr><td class='valine'>C</td>
                 <td>
                 <span class="bld">It's About the Baby not the Protocol; a developmental approach to videofluoroscopy with premature 
                 infants – Marjorie Meyer Palmer, M.A., CCC-SLP</span><br>
                 Infants can breathe, they can swallow, and they can suck but often cannot coordinate all three. It is for this reason 
                 that neonates so frequently aspirate and perform poorly on VFSS. Learn techniques to maximize their potential for successful 
                 feeding without aspiration during swallow studies and methods that may be used to continue oral feeding both in the NICU and 
                 at home. Learn compensatory feeding strategies for those infants with anatomical defects and neurological issues.
                 </td></tr>                                                         
                           
              <!--H-->              
              <tr><td class='valine'>3:00</td>
                 <td>ADJOURN</td></tr>   
           </table>
        </div><!--accordion-->                                
      </div><!--end cirriculum-->
      <div class='spacer_12'>&nbsp;</div>
      <div class='pink_dot_repeat' style='width:100%;'>&nbsp;</div>
      <div class='spacer_12'>&nbsp;</div>       
      <?php } ?>              
      
      <?php if($showRegisterForm) { ?>  
      <a name='errors'></a>
      <h1>2. Symposium Registration Form</h1>      
      
      <!-- CONTACT CONTAINER -->
      <!--        <div class='form_section'> -->
      <div class='form_box' style="background-color:#F0F0FF;border:1px solid #000000;">     
         <form class='signUp' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">

            <?php if (isset($formError['problem']) && $formError['problem'] > '') {
               echo "<div class='error'>";	
               echo $formError['problem'];
               echo "</div>";
            } ?>      
                          
            <input type="hidden" name="date_in" value="<?php echo $date_in; ?>" />
            <input type="hidden" name="symp_year" value="<?php echo $symp_year; ?>" />
            
            <label for="check_amt">Amount you will send by CHECK (if not sending a check, please leave first box blank):</label><br>
            <input style='width:15%;' type="text" name="check_amt" value="<?php echo htmlentities($check_amt); ?>" maxlength="25" /><br>                
            <?php echo (isset($formError['check_amt']) || !empty($formError['check_amt'])) ? 
			"<div class='error_msg'>" . $formError['check_amt'] . "</div>" : '' ?>
            
            <label for="name">Your Name:</label><br>
            <input  style='width:50%;' type="text" name="name" value="<?php echo htmlentities($name); ?>" maxlength="50" />
            <br>                
            <?php echo (isset($formError['name']) || !empty($formError['name'])) ? 
			"<div class='error_msg'>" . $formError['name'] . "</div>" : '' ?> 
            
            <label for="profession">Your Profession:</label><br>
            <input style='width:70%;' type="text" name="profession" value="<?php echo htmlentities($profession); ?>" maxlength="100" /><br>
            <?php echo (isset($formError['profession']) || !empty($formError['profession'])) ?
			"<div class='error_msg'>" . $formError['profession'] . "</div>" : '' ?>
            
            <label for="employer">Your Employer:</label><br>
            <input style='width:70%;' type="text" name="employer" value="<?php echo htmlentities($employer); ?>" maxlength="100" /><br>                
            <?php echo (isset($formError['employer']) || !empty($formError['employer'])) ? 
			"<div class='error_msg'>" . $formError['employer'] . "</div>" : '' ?> 
            
            <label for="city_state">Employer City, State (for your Symposium badge):</label><br>
            <input placeholder="Orlando, Florida" style='width:50%;' type="text" name="city_state" 
            value="<?php echo htmlentities($city_state); ?>" maxlength="100" /><br>   
                         
            <?php echo (isset($formError['city_state']) || !empty($formError['city_state'])) ? 
			"<div class='error_msg'>" . $formError['city_state'] . "</div>" : '' ?>  
                                       
            <label for="phone1">Best Phone:</label><br>
            <input placeholder="xxx-xxx-xxxx" style='width:50%;' type="text" name="phone1" 
            value="<?php echo htmlentities($phone1); ?>" maxlength="25" /><br>                
            <?php echo (isset($formError['phone1']) || !empty($formError['phone1'])) ? 
			"<div class='error_msg'>" . $formError['phone1'] . "</div>" : '' ?>
            
            <label for="email">Email:</label><br>
            <input style='width:70%;' type="text" name="email" value="<?php echo htmlentities($email); ?>" maxlength="100" /><br>                
            <?php echo (isset($formError['email']) || !empty($formError['email'])) ? 
			"<div class='error_msg'>" . $formError['email'] . "</div>" : '' ?> 
            
            <label for="home_addr">Home Address:</label><br>
            <textarea cols="75" rows="5" name="home_addr"><?php echo htmlentities($home_addr)?></textarea><br>                
            <?php echo (isset($formError['home_addr']) || !empty($formError['home_addr'])) ? 
			"<div class='error_msg'>" . $formError['home_addr'] . "</div>" : '' ?>         
                                               
            <label for="nomas_num">NOMAS License Number (for registration discount):</label><br>
            <input style='width:30%;' type="text" name="nomas_num" value="<?php echo htmlentities($nomas_num); ?>" maxlength="25" /><br>
            <?php echo (isset($formError['nomas_num']) || !empty($formError['nomas_num'])) ? 
			"<div class='error_msg'>" . $formError['nomas_num'] . "</div>" : '' ?> 
                                               
            <label for="nurses_num">California Registered Nurses Number (for registration discount):</label><br>
            <input style='width:30%;' type="text" name="nurses_num" value="<?php echo htmlentities($nurses_num); ?>" maxlength="25" /><br>    
            <?php echo (isset($formError['nurses_num']) || !empty($formError['nurses_num'])) ? 
			"<div class='error_msg'>" . $formError['nurses_num'] . "</div>" : '' ?>  
            
            <div class='spacer_6'>&nbsp;</div>
            <div class='pink_dot_repeat' style='width:90%;'>&nbsp;</div>                       
            <div class='spacer_12'>&nbsp;</div>                       
            
            <div class='hed'>Please enter numbers 1 to 3 to indicate your preference for the two Day 4 events:</div>
            <div class="text">
            <label for="s_1">Reflective Learning (8:00-11:30 a.m.)</label><br>
            1st Choice: <input style='width:5%;' type="text" name="s1_a" value="<?php echo htmlentities($s1_a); ?>" maxlength="1" />
            2nd Choice: <input style='width:5%;' type="text" name="s1_b" value="<?php echo htmlentities($s1_b); ?>" maxlength="1" />
            3rd Choice: <input style='width:5%;' type="text" name="s1_c" value="<?php echo htmlentities($s1_c); ?>" maxlength="1" /><br>
            <?php echo (isset($formError['s1']) || !empty($formError['s1'])) ? "<div class='error_msg'>" . $formError['s1'] . "</div>" : '' ?>       
            
            <div class='text'>
            1 - Medical Perspective moderated by Dr. Peter Bingham and Dr. Suzanne Thoyre, PhD, RN, FAAN.<br>
            2 - Developmental Perspective moderated by Mr. John Chappel, M.A., RPT and Ms. Linda Lowman, M.Ed.<br>
            3 - Therapeutic Perspective moderated by Ms. Kristy Fuller, OT R/L and Ms. Dawn Jernigan, M.A., CCC-SLP.
            </div><br><br>
            
            <label for="s_2">Concurrent Sessions (1:00-3:00 p.m.)</label><br>
            1st Choice: <input style='width:5%;' type="text" name="s2_a" value="<?php echo htmlentities($s2_a); ?>" maxlength="1" />
            2nd Choice: <input style='width:5%;' type="text" name="s2_b" value="<?php echo htmlentities($s2_b); ?>" maxlength="1" />
            3rd Choice: <input style='width:5%;' type="text" name="s2_c" value="<?php echo htmlentities($s2_c); ?>" maxlength="1" /><br>
            <?php echo (isset($formError['s2']) || !empty($formError['s2'])) ? "<div class='error_msg'>" . $formError['s2'] . "</div>" : '' ?>  
            </div>     
            
            <div class='text'>
            1 - It's Never Too Late: NOMAS® Refresher Course - Linda Lowman, M.Ed, NOMAS® Course Instructor.<br>
            2 - Feeding Preterm and Fragile Infants: Science, myth, misleading research – Kathleen Philbin, PhD., RN.<br>
            3 - It's About the Baby not the Protocol: a developmental approach to videofluoroscopy with premature infants – Marjorie Meyer Palmer, MA, CCC-SLP.
            </div>                
            
            <div class='spacer_6'>&nbsp;</div>	
                              
            <label for="message">Note or questions for Symposium organizer?</label><br>
            <textarea cols="90" rows="5" name="message"><?php echo htmlentities($message)?></textarea>
                                                                               
            <div class='spacer_12'>&nbsp;</div>
            <div class='pink_dot_repeat' style='width:90%;'>&nbsp;</div>                       
            <div class='spacer_12'>&nbsp;</div>            
                                                                 
            <button type="submit" name="submit" value="submit">Send Registration</button>        
         </form><br><br>        
         <div class='clearAll'>&nbsp;</div>                          
      </div><!-- end form_section-->  
      <div class='spacer_6'>&nbsp;</div>
      <?php } ?>            
      
      <?php if($showPayPal) { ?>
      <a name='pay'></a>
      <h1>3. Registration Payment</h1>         
      <div class="paypal_section" style="width:97%;">        
         <div class='text' style="width:98%;background-color:#ebebeb;padding:8px;">
            <?php if($today < $earlyBirdEnds) { ?>
               <span class='bold'>Early registration. Prices rise after July 15th:</span><br><br>
            <?php } else { ?>
			   <span class='bold'>Registration Information:</span><br><br>
			<?php } ?>   			   	   				   
            <p class="bold">Because of fees assessed by credit card companies, prices are lower if you send a check or money order.</p>
            To pay by check, complete the online registration form, above, and send a check separately. Or, use the registration form in the 
            <a href="<?php echo $brochure; ?>" target="_blank">downloadable brochure</a> and send with your payment to:<br><br>
            NOMAS International<br>
            1528 Merrill Road<br>
            San Juan Bautista CA 95045<br><br>          
            
            <span class='bold'>By check - current NOMAS license; expired NOMAS license; not licensed:</span><br><br>
              
            Full Conference (4 days): NOMAS License: 
            $<?php echo $f_lic; ?>&nbsp;&nbsp;
            Expired License: $<?php echo $f_exp; ?>&nbsp;&nbsp;
            No License: $<?php echo $f_not; ?><br>
            Main Conference (3 days): 
            NOMAS License: $<?php echo $m_lic; ?>&nbsp;&nbsp;
            Expired License: $<?php echo $m_exp; ?>&nbsp;&nbsp;
            No License: $<?php echo $m_not; ?><br>                  
            Pre-Conference&nbsp;&nbsp;(1 day):
            NOMAS License: $<?php echo $one_lic; ?>&nbsp;&nbsp;
            Expired License: $<?php echo $one_exp; ?>&nbsp;&nbsp;
            No License: $<?php echo $one_not; ?>                  
         </div><!--end text-->  
         
         <div class='spacer_6'>&nbsp;</div>            
         
         <div class="text">
            <p class="bold">To Pay By Credit Card (3.5% PayPal fee added):</p><br>
            <p class="bold">Full Conference (4 Days):</p>
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Licensed ($<?php echo $pf_lic; ?>)</td>
                  </tr>
                  <tr>
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="4 Days Licensed">
                              <input type="hidden" name="item_number" value="s4lic">
                              <input type="hidden" name="amount" value="<?php echo $pf_lic; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>
                  </tr>   
               </table>
            </div>
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Expired License ($<?php echo $pf_exp; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="4 Days Expired License">
                              <input type="hidden" name="item_number" value="s4exp">
                              <input type="hidden" name="amount" value="<?php echo $pf_exp; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>      
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>No License ($<?php echo $pf_not; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="4 Days No License">
                              <input type="hidden" name="item_number" value="s4not">
                              <input type="hidden" name="amount" value="<?php echo $pf_not; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>                 
            <div class='spacer_6'>&nbsp;</div>                 
         </div><!--end text-->
                                                       
         <div class="text">
            <p class="bold">Main Conference (3 Days):</p>
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Licensed ($<?php echo $pm_lic; ?>)</td>
                  </tr>
                  <tr>
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Main Licensed">
                              <input type="hidden" name="item_number" value="m3lic">
                              <input type="hidden" name="amount" value="<?php echo $pm_lic; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>
                  </tr>   
               </table>
            </div>
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Expired License($<?php echo $pm_exp; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Main Expired License">
                              <input type="hidden" name="item_number" value="m3exp">
                              <input type="hidden" name="amount" value="<?php echo $pm_exp; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>      
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>No License ($<?php echo $pm_not; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Main No License">
                              <input type="hidden" name="item_number" value="m3not">
                              <input type="hidden" name="amount" value="<?php echo $pm_not; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>                 
            <div class='spacer_6'>&nbsp;</div>                 
         </div><!--end text-->
         
         <div class="text">
            <p class="bold">Pre-Conference (1 Day):</p>
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Licensed ($<?php echo $pone_lic; ?>)</td>
                  </tr>
                  <tr>
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="One Day Licensed">
                              <input type="hidden" name="item_number" value="o1lic">
                              <input type="hidden" name="amount" value="<?php echo $pone_lic; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>
                  </tr>   
               </table>
            </div>
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>Expired License($<?php echo $pone_exp; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="One Day Expired">
                              <input type="hidden" name="item_number" value="o1exp">
                              <input type="hidden" name="amount" value="<?php echo $pone_exp; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>      
            
            <div class='paypal_box'>  
               <table>
                  <tr>
                     <td>No License ($<?php echo $pone_not; ?>)</td>
                  </tr>
                  <tr>                  
                     <td>
                           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="One Day No License">
                              <input type="hidden" name="item_number" value="o1not">
                              <input type="hidden" name="amount" value="<?php echo $pone_not; ?>">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Question for the organizer?">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="cancel_return" value="<?php echo $thisPage; ?>">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - 
                              The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                           </form>      
                     </td>                     
                  </tr>   
               </table>
            </div>                 
            <div class='spacer_6'>&nbsp;</div>                 
         </div><!--end text-->         
         
      </div><!-- end PayPal Section--> 
                                                       
      <div class='spacer_6'>&nbsp;</div>      
      
      <div class='paypal_section'>   
         <div class='text'>
            <span class='bold'>Cancellation Policy:</span> a written request for a full refund must be received by NOMAS 
            International no later than 21 business days prior to the start of the Symposium. Written requests received after 
            the deadline may result in a 50% refund; No refund will be issued with fewer than 72 hours notice. NOMAS International
            reserves the right to cancel the event seven days prior to the published start of the event and assumes no 
            responsibility for pre-purchased airline tickets.
         </div>               
      </div>   
      
      <div class='spacer_6'>&nbsp;</div>
      <?php } //end showPayPal ?>      
       
      <?php if($showHotel) { ?>            
      <a name='hotel'></a>
      <h1>4. Click the hotel logo to reserve rooms at the special Symposium rate</h1> 
      <div class='clearAll'>&nbsp;</div><br>           
      <div class='hotel_box'>
         <div class='text'>
            <a href="<?php echo $hotelURL; ?>" target="_blank">
               <img src="_grafix/logo-holiday-inn.jpg" width="138" height="100" alt="IMG"> 
            </a>
            The Fifth Annual NOMAS International Symposium will be held at <?php echo $hotelName ?>.
            For those who register by <?php echo $hotelEarlyEnds ?>, a block of rooms has been reserved 
            at the special rate of $119/night for standard; $129/night for pool view; and $139/night for Disney view, plus tax. 
            YOU MUST RESERVE YOUR ROOM BY <?php echo $hotelEarlyEnds ?> to obtain the discount. Based on availability. 
            Please click hotel logo to make your room reservation or phone <?php echo $hotelPhone ?>. Enter check-in & check-out 
            dates and Group Code "<?php echo $hotelCode ?>" if registering online</a>.           
         </div>  
      <div class='clearAll'>&nbsp;</div>            
      </div>          
      <div class='spacer_12'>&nbsp;</div>
      <div class='pink_dot_repeat' style='width:100%;'>&nbsp;</div>
      <?php } ?>      
                          
      <!--LOGO BLOCK-->        
      <!--<h1>Authorization to provide CEU Credits is pending</h1>-->
      <div class='clearAll'>&nbsp;</div>        
                  
      <?php if($showCEU) { ?>
      <div class='ceu_section'>        
         <div class='ceu_asha_logo_box'>
            <img src="_grafix/logo-asha-approved-2013.gif" width="600" height="143" alt="logo">
            <div class='caption'>
               Three day course offered for 1.80 ASHA CEUs (Advanced Level, Professional Area) and one day for 0.60 CEUs. ASHA Provider #AAYZ.
            </div><!-- end caption-->
         </div><!-- end ceu_logo_box-->
         
         <div class='spacer_6'>&nbsp;</div>           
         
         <div class='ceu_logo_box'>
            <img src="_grafix/logo-aota-provider.gif" width="378" height="94" alt="logo">
            <div class='caption'>
               Three day course offered for 1.80 ASHA CEUs and one day for 0.60 CEUs. ASHA Provider #AAYZ
               Therapeutic Media is an AOTA Approved Provider of Continuing Education. 
               AOTA does not endorse specific course content, products, or clinical procedures.
            </div><!-- end caption-->
         </div><!-- end ceu_logo_box--> 
         <!--
         <div class='ceu_sponsor_box'>
            <img src="_grafix/logo-geddes.jpg" width="100" height="100" alt="MMP">
         </div>    
         -->                       
         <div class='spacer_6'>&nbsp;</div>           
         
         <div class='ceu_logo_box'>
            <img src="_grafix/logo-ca-nurses.gif" width="168" height="94" alt="logo">
            <div class='caption'>
               Days 1-4 (inclusive) 24 Contact Hours.
               Therapeutic Media is a Provider for Continuing Education by the California Board of Registered Nursing, 
               Provider #CEP 13879.                 
            </div><!-- end caption-->
         </div><!-- end logo_box-->            
         <?php } ?>
         
         <?php if($showBottomAd) { ?>
         <div class='ceu_sponsor_box'>
            <img src="_grafix/logo-medelia.jpg" width="267" height="100" alt="MMP">
         </div>                  
         <div class='spacer_6'>&nbsp;</div>
         <div class'clearAll'>&nbsp;</div>            
         <?php } ?>
      </div><!--end ceu section-->  
        
   
   </div> <!-- END CONTENT  -->
  
   <div class='clearAll'>&nbsp;</div>
  
   <!--FOOTER-->
   <div id="footer"> 
      <?php showBottomMenu(); ?>
      <?php showCopyright($thisYear); ?>
   </div><!-- end footer -->
 
   <div class='clearAll'>&nbsp;</div>

</div><!-- END PLAYGROUND -->
<script>
<!--
startcart()

$( "#faculty" ).accordion({
 heightStyle: "content",
 collapsible: true,
 active: false	
});

$( "#cirriculum" ).accordion({
 heightStyle: "content",
 collapsible: true,
 active: false	
});
-->  
</script>
</body>
</html>
