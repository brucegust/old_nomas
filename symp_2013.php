<?php 
header("Cache-Control: max-age=2592000, public"); // 30-days (60sec * 60min * 24hours * 30days)
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_inc/mail_functions.php";
include_once "_nav/nav_site_001.php"; // top nav menu

// ******************************************************************

$dloadCode  = (isset($_POST["dloadCode"])  || !empty($_POST["dloadCode"]))  ? trim($_POST["dloadCode"])  : '';
$dloadPass  = "nomas2013";
$pwordCheck = false;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['dload'])) {
   $pwordCheck = checkDloadCode($_POST);
   if($pwordCheck) {
      $redir = 'symp_2013_dloads.php';
      header("Location: $redir");
      exit;	   	
   }
} 

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "The Third Annual NOMAS<sup>&reg;</sup> International Symposium in Las Vegas - October 16-20th, 2013";
$pageSubTitle = "<a href='_docs/symposia_brochures/2013-NOMAS-symposium.pdf' target='_blank'>Click Here to View/Download the 2013 Symposium Brochure</a>";

// ******************************************************************
// ******************************************************************
// ******************************************************************

$toEmail     = $sendToEmail; 
$Subject     = "SYMPOSIUM REGISTRATION"; 
$formError   = array();
$sent        = '';

$date_in     = (isset($_POST["date_in"])    || !empty($_POST["date_in"]))    ? trim($_POST["date_in"])    : $today;
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
$message     = (isset($_POST["message"])    || !empty($_POST["message"]))    ? trim($_POST["message"])    : '';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $sent = checkSymposium2013($_POST);	
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
<title>NOMAS International</title>
<meta name="viewport" content="width=device-width" />
<link href="_css/symp_2013.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
echo $cms_spry  . "\n";
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
  <div id='header'><?php showBigLogo(); ?></div>
  <div class='clearAll'></div>
  <!--TOP NAV-->  
  <div id='nav_box'>
     <div id='slidemenu' class='jqueryslidemenu'>
        <?php showTopNav($topNav) ?>
     </div>      
  </div><!--end top nav box-->
  
  <div class='clearAll'></div>  
    
    <!-- CONTENT -->
  
  <div id='content'>
  
     <div id='content_header'>    
        <?php
        if ( isset($pageTitle) && $pageTitle > '') {
           echo "<div class='pageTitle'>" . $pageTitle . "</div>";
        }
        if (isset($pageSubTitle) && $pageSubTitle > '') {
           echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
        } 
        ?>
     </div>   
     
     <!-- ENABLE THIS TO ALLOW DOWNLOADING OF SYMPOSIUM PRESENTATIONS
     <div class='dload_brochure'>
       <form style='font-size:1.3em;font-weight:bold;margin-top:15px;margin-bottom:26px;' action="<?php //echo "{$_SERVER['PHP_SELF']}" ?>" method="POST">  
          <label for 'dloadCode' style='padding-left:12px;'>Enter password to download slides & presentations:</label>                
          <input type="password" name="dloadCode" maxlength='12' size='9' value="<?php //echo htmlspecialchars($dloadCode); ?>">
          <input type="submit" name="dload" value="Enter">
       </form>                  
     </div>  -->
     
     
	 <?php 	  		
        if (isset($formError) && count($formError)) {
		   echo "<div class='error'>";	
           echo "There was a problem with your submission. <a href='#errors'>Click to see details.</a>";
		   echo "</div>";
        }	  
     ?>      
     
     <?php 	  		
        if (isset($sent) && $sent == 'OK') {
		   echo "<div class='sent'>";	
           echo "Your submission has been sent. See you in Las Vegas!<br>";
		   echo "<span class='text'><a href='#hotel'>Click to make hotel reservations.</a></span>";
		   echo "</div>";
        }	  
     ?>                                          
    
     <!-- LEFT COLUMN-->
     <div id='column'>
     
        <div class='item'>
           <div class='text'>             
             Many thanks for your attendance at the third NOMAS International Symposium. You were joined by the most knowledgeable and experienced professionals in the fields of neonatal 
             and pediatric feeding disorders. The multi-disciplinary approach to feeding 
             brought  together professionals from three continents with backgrounds in Neonatology, Pediatric Neurology, Pediatric Gastroenterology, Developmental Pediatrics, Nursing 
             and Lactation, NIDCAP Certified Developmental Specialists, Physical Therapy, Occupational Therapy, Nutrition, and Speech Pathology. A wonderful time was had by all!<br><br>
             
             <div>
             <img style='float:left;border:none;display:inline;margin-right:16px;' src="_grafix/punky_124.jpg" width="124" height="150" alt="MMP">
                <div style='float:left;line-height:1.2em'>
                   Sincerely,<br>
                   <img style='margin:1em 0 1em 0;border:none;' src="_grafix/punky-signature.jpg" width="72" height="44" alt="GRAPHIC"><br>
                   Marjorie Meyer Palmer, M.A., CCC-SLP<br>Founder/Director<br>NOMAS<sup>&reg;</sup> International              
                </div>
             </div>
           </div><!--end text-->
        </div><!--end l_item-->   
        
        <div class='clearAll'></div>         
        <div class='spacer_36'></div>
        
        <hr><br><br>                       
        
        <h1>Symposium Objectives</h1>
        
        <div class='item'>
           <div class='text'>              
              <ul class="b">
                 <li class='b'>Identify challenges and problems for the poor feeder in the NICU and after discharge.</li>
                 <li class='b'>Describe infant stress cues and individualized developmental care strategies that assist feeding.</li>
                 <li class='b'>Discuss evaluation procedures to determine underlying etiologies and causes of feeding problems.</li>
                 <li class='b'>Provide effective intervention strategies for motor and sensory-based feeding problems in the infant and toddler.</li>
             </ul>
           </div><!-- end text-->       
           
        <div class='clearAll'></div>                                
           
           <div id="more-objectives" class="CollapsibleShort">
             <div class="CollapsibleShortTab" tabindex="0">More reasons to have attended...</div>
             <div class="CollapsibleShortContent">             
                <ul class="b">
                  <li class='b'>Professionals from various disciplines shared their expertise and perspectives on feeding infants.</li>
                  <li class='b'>Lessons in identifying and treating motor and sensory-based feeding problems in the neonate.</li>
                  <li class='b'>Compare and contrast breast and bottle feeding by examining the advantages and disadvantages of each.</li>
                  <li class='b'>Become familiar with developmental care and cue-based feeding and the use of video fluoroscopy to diagnosis dysphagia.</li>
                  <li class='b'>Earn 'professional area' CEU's from organizations such as ASHA, AOTA and the California Board of Registered Nurses.</li>
                </ul>                                          
             </div>
          </div>            
        </div><!--end item-->
        
        <div class='clearAll'></div>         
        <div class='spacer_36'></div>
        
        <!--<hr><br><br>-->
        
        <h1>The 2013 Symposium Faculty</h1>          
        
        <div class='item'>
           <div id="faculty" class="CollapsibleShort">
              <div class="CollapsibleShortTab" tabindex="0">Click to see/hide Symposium presenters and their financial and non-financial disclosures...</div>
              <div class="CollapsibleShortContent"> 
                 <div class='faculty_box_l'><br>
                    <span class='strong'>Ira Adams-Chapman, M.D., MPH</span><br>
                    <span class='tight'>Assistant Professor of Pediatrics<br>
                    Director, Developmental Program Clinic<br>
                    Emory University School of Medicine<br>
                    Atlanta, Georgia</span>
                 </div>                   
                 <div class='faculty_box_r'><br>
                    <span class='strong'>Laura Niemann, OTR/L</span><br>
                    <span class='tight'>Occupational Therapist/Feeding Specialist<br>
                    NOMAS Course Instructor<br>
                    Neonatal Intensive Care Unit<br>
                    Children’s of Alabama<br>
                    Birmingham, Alabama</span>
                 </div>
                 
                 <div class='clearAll'></div>         
                 
                 <div class='faculty_box_l'>
                    <span class='strong'>Joan Arvedson, PhD, CCC-SLP, BRS-S</span><br>
                    <span class='tight'>Program Coordinator, Feeding and Swallowing Services<br>
                    Children’s Hospital of Wisconsin<br>
                    Clinical Professor, Department of Pediatrics<br>
                    Division of Gastroenterology<br>
                    Medical College of Wisconsin<br>
                    Milwaukee, Wisconsin</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Marjorie Meyer Palmer, M.A., CCC-SLP</span><br>
                    <span class='tight'>Neonatal/Pediatric Feeding Specialist<br>
                    Formerly Clinical Instructor, Department of Pediatrics<br>
                    Division of Gastroenterology, Hepatology, and Nutrition<br>
                    University of California-San Francisco School of Medicine<br>
                    Founder and Director, NOMAS International<br>
                    San Juan Bautista, California</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Nils Bergman, M.D. Visiting Guest Lecturer</span><br>
                    <span class='tight'>Public Health Physician<br>
                    Honorary Research Associate<br>
                    Honorary Senior Lecturer<br>
                    University of Cape Town<br>
                    Cape Town, South Africa</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Marie Augusta Reilly, PhD., PT</span><br>
                    <span class='tight'>Pediatric Physical Therapist<br>
                    Neonatal Intensive Care Nursery and Follow-up Clinic<br>
                    Wake Med-Raleigh Campus<br>
                    Raleigh, North Carolina</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Carol Lynn Berseth, M.D.</span><br>
                    <span class='tight'>Senior Medical Director<br>
                    Global Clinical Nutrition<br>
                    Mead Johnson Nutrition<br>
                    Evansville, Illinois</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Cheryl Scott, PhD, RN, IBCLC</span><br>
                    <span class='tight'>Lactation Consultant, Intensive Care Nursery<br>
                    Kaiser Permanente Medical Center<br>
                    Roseville, California<br>
                    Adjunct Investigator, Breastfeeding Medicine<br>
                    Sacramento State University</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Peter M. Bingham, M.D.</span><br>
                    <span class='tight'>Pediatric Neurologist<br>
                    Associate Professor of Neurology and Pediatrics<br>
                    University of Vermont<br>
                    Burlington, Vermont</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Mary Stanford, M.S., CCC-SLP</span><br>
                    <span class='tight'>Doctoral Candidate, Columbia University<br>
                    Neonatal Feeding Specialist, NICU<br>
                    Supervisor, Neonatal Developmental Team<br>
                    Department of Rehabilitation<br>
                    Northside Hospital<br>
                    Atlanta, Georgia</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>John Chappel, PT, M.A.</span><br>
                    <span class='tight'>NICDAP Certified Pediatric Physical Therapist<br>
                    J. Chappel Neonatal and Pediatric Physical Therapy Interventions<br>
                    East Hampton, New York</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Chrysty Sturdivant, OTR/L</span><br>
                    <span class='tight'>Occupational Neonatal Therapist<br>
                    Baylor University Medical Center<br>
                    President, Neonatal Therapy Solutions, LLC<br>
                    Dallas, Texas</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Joan Dietrich Comrie, M.S., CCC-SLP</span><br>
                    <span class='tight'>Speech-Language Pathologist<br>
                    Private Practice<br>
                    Raleigh, North Carolina</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Kathleen A. VandenBerg, PhD</span><br>
                    <span class='tight'>Academic Administrator/Center Director<br>
                    NIDCAP Master Trainer<br>
                    West Coast NIDCAP & APIB Training Center<br>
                    Department of Pediatrics, Division of Neonatology<br>
                    University of California- San Francisco<br>
                    San Francisco, California</span>
                 </div>
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Pamela Dodrill, PhD, Visiting Guest Lecturer</span><br>
                    <span class='tight'>Speech Pathologist/Health Research Fellow<br>
                    Royal Children’s Hospital<br>
                    Brisbane, Queensland, Australia</span>
                 </div>                   
                 <div class='faculty_box_r'>
                    <span class='strong'>Shelley Bolt Wilkins, MS, MPH, CSP, RD, LDN</span><br>
                    <span class='tight'>Clinical Dietitian<br>
                    Intensive Care Nursery<br>
                    Wake Med-Raleigh Campus<br>
                    Raleigh, North Carolina</span>
                 </div>  
                 <div class='clearAll'></div>         
                 <div class='faculty_box_l'>
                    <span class='strong'>Kristy Fuller, OTR/L</span><br>
                    <span class='tight'>Occupational Therapist/Feeding Specialist<br>
                    Neonatal Intensive Care Unit<br>
                    St. Luke’s Hospital<br>
                    Cedar Rapids, Iowa</span>
                 </div>
                 <div class='faculty_box_r'>
                    <span class='strong'>Thomas E. Young, M.D.</span><br>
                    <span class='tight'>Medical Director, Neonatal ICU<br>
                    Wake Med Raleigh Hospital<br>
                    Adjunct Professor of Pediatrics<br>
                    School of Medicine<br>
                    University of North Carolina<br>
                    Chapel Hill, North Carolina</span>
                 </div>                           
                 <div class='clearAll'></div>                            
                 <div class='faculty_box_l'>
                    <span class='strong'>Ira H. Gewolb, M.D.</span><br>
                    <span class='tight'>Professor and Chief, Division of Neonatology<br>
                    Associate Chair for Research, Department of Pediatrics<br>
                    And Human Development<br>
                    Michigan State University<br>
                    College of Human Medicine<br>
                    Lansing, Michigan</span>
                 </div>                                     
                 <div class='faculty_box_r'>
                    <span class='strong'>Paul E. Hyman, M.D.</span><br>
                    <span class='tight'>Chief, Pediatric Gastroenteology<br>
                    Children’s Hospital<br>
                    Professor of Pediatrics<br>
                    Louisiana State University Health Sciences Center<br>
                    New Orleans, Louisiana</span>
                 </div>
                 
                 <div class='clearAll'></div><br>
                 
                 <div class='hed'>Faculty Disclosures - Financial and Non-Financial:</div><br>
                 
                 <span class='strong'>Dr. Joan Arvedson</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Joan Arvedson receives royalties from Cengage Learning, Pearson Publishing, and Northern Speech Services. She receives an honorarium for 
                 presenting at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Ira Adams-Chapman</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Ira Adams-Chapman receives an honorarium for presenting at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Nils Bergman</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Nils Bergman is the owner of NINO Academy for which he has intellectual property rights and a management position. As such he receives financial 
                 reimbursement in the form of speaking fees, royalty, and Honoraria and receives an honorarium for his presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Carol Lynn Berseth</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Carol Lynn Berseth receives a salary for employment at Mead Johnson Nutrition.<br><br>
                 
                 <span class='strong'>Dr. Peter Bingham</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Peter Bingham receives an honorarium for his presentation at the Third Annual NOMAS International Symposium<br><br>
                 
                 <span class='strong'>Mr. John Chappel</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Mr. John Chappel receives an honorarium for his presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Ms. Joan Comrie</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Joan Comrie has no financial relationships to disclose.<br><br>
                 
                 <span class='strong'>Dr. Pamela Dodrill</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Pamela Dodrill receives a salary for employment at Royal Children’s Hospital and receives a consulting fee and grants for teaching and speaking 
                 for the University of Queensland.<br><br>
                 
                 <span class='strong'>Ms. Kristine Fuller</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Kristine Fuller receives an honorarium for her presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Ira H. Gewolb</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Ira H. Gewolb receives an honorarium for his presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Paul Hyman</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Paul Hyman receives an honorarium for his presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Ms. Laura Niemann</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Laura Niemann receives a salary for employment at Childrens of Alabama and receives an honorarium for speaking and teaching for NOMAS International. 
                 She receives an honorarium for her presentation at the Third Annual NOMAS International Symposium. <br><br>
                 
                 <span class='strong'>Ms. Marjorie Meyer Palmer</span> non-financial disclosure: the Founder and Director of NOMAS International, a current member of the American Academy of Cerebral Palsy, 
                 and the NIDCAP Federation International. Financial Disclosure: Ms. Marjorie Meyer Palmer receives financial compensation for teaching live courses on feeding, online continuing education 
                 courses in feeding offered at www.nomasinternational.org, teaching Certification Courses in the NOMAS, and non-exclusive Copyright License Renewal of NOMAS Certified Professionals.  
                 She is the sole distributor of the Fantastic Feeding Dropper. She receives an honorarium for her presentations at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Marie Augusta Reilly</span> has no non-financial relationship to disclose.<br>
                 Financial Disclosure: Dr. Marie Augusta Reilly receives an honorarium for her presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Ms. Mary Stanford</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Mary Stanford has no financial relationships to disclose.<br><br>
                 
                 <span class='strong'>Dr. Cheryl Scott</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Cheryl Scott receives a salary for employment at Kaiser Permanente and an honorarium for her presentation at the Third Annual 
                 NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Ms. Chrysty Sturdivant</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Chrysty Sturdivant is the President of Neonatal Therapy Solutions, LLC and will be a vendor at the NOMAS International Symposium. 
                 Her company provides NICU training courses.<br><br>
                 
                 <span class='strong'>Dr. Kathleen A. VandenBerg</span> non-financial disclosure: a volunteer member of the Board of Directors of the NFI.<br>
                 Financial Disclosure: Dr. Kathleen A. VandenBerg receives consulting fees and speaking fees for both teaching and consulting for the Newborn Individualized Developmental Care and 
                 Assessment Program (NIDCAP). She receives an honorarium for her presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Ms. Shelley Wilkins</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Ms. Shelley Wilkins has received a speaking/teaching fee from Mead Johnson Nutrition. She also received an honorarium for her presentation at the Third 
                 Annual NOMAS International Symposium.<br><br>
                 
                 <span class='strong'>Dr. Thomas E. Young</span> has no non-financial relationships to disclose.<br>
                 Financial Disclosure: Dr. Thomas E. Young receives an honorarium for his presentation at the Third Annual NOMAS International Symposium.<br><br>
                 
              </div><!--end short content-->
           </div><!-- end short panel-->             
        </div><!-- end item-->
        
        <div class='clearAll'></div>         
        <div class='spacer_36'></div>
        
        <!--<hr><br><br>-->
                  
        <!--<h1>How to Register For The Symposium</h1>     
             
        <div class='item'>
           <div class='text'>              
             <ul class="a">
                <li class="a">1) Browse the Symposium curriculum and jot down the days and talks you would like to attend.</li>
                <li class="a">2) Pay for the talks using the PayPal (credit/debit card) form, below, or send a check.</li>
                <li class="a">3) Register for your selected talks using the registration form, below.</li>                 
                <li class="a">4) Click the hotel logo to reserve rooms at the symposium rate.</li>
             </ul>
           </div><!-- end text                    
        </div><!--end item-->
                                             
        
       <h1>Browse The Symposium Curriculum (click a day to see/hide events).</h1> 
        <h2>Note: Three attendance options - all five days; days 1-3; days 4 & 5</h2>
        
       <div class='clearAll'></div><br>      
        
        <div class='item'>
          <div id="day_1" class="CollapsiblePanel">
            <div class="CollapsiblePanelTab" tabindex="0">Day 1 - October 16th (Main Conference) - Wednesday</div>
            <div class="CollapsiblePanelContent">
                <span class='strong'>MORNING SESSIONS</span><br>
                08:00 a.m. - Welcome - Marjorie Meyer Palmer, M.A., CCC-SLP, Founder and Director, NOMAS International.<br>
                08:15 a.m. - Nils Bergman, M.D., <span class='ital'>The Context of the NICU Newborn: impact on developmental outcome</span>.<br>
                11:00 a.m. - Carol Lynn Berseth, M.D., <span class='ital'>Gastrointestinal Tract in the Preterm Infant: when is baby ready to eat?</span><br><br>
                <span class='strong'>AFTERNOON SESSIONS</span><br>
                12:00 p.m. - Thomas E. Young, M.D., <span class='ital'>Thickening Feedings for the NICU Infant: precaution or protocol?</span><br>
                01:00 p.m. - Faculty Panel: discussion, questions and answers.<br>
                02:45 p.m. - Ira H. Gewolb, M.D., <span class='ital'>Respiration: the necessary component for successful feeding.</span><br>
                04:15 p.m. - Marjorie Meyer Palmer, <span class='ital'>Evaluation of Neonatal Sucking Patterns based on the NOMAS.</span><br><br>
            </div>
          </div>
          
          <div id="day_2" class="CollapsiblePanel">
            <div class="CollapsiblePanelTab" tabindex="1">Day 2 - October 17th (Learning Modules) - Thursday</div>
            <div class="CollapsiblePanelContent">
            <span class='strong'>SESSION 1: MEDICAL MODULE - 8:00-9:30 a.m.</span><br><br>
            <span class='strong'>A. Olfaction: the forgotten sense and its relationship to successful oral feeding in the newborn.</span><br>
            <span class='strong'>Peter M. Bingham, M.D.</span><br>
            Both premature and term newborns have a keen sense of smell. From the first days of life newborns are attracted to the scent of amniotic fluid and form an early attraction to 
            the scent of breast milk. We will discuss the ways in which odors affect newborn behavior and how knowledge of these effects might contribute to supporting early growth and 
            development of sick newborns.<br><br>
            <span class='strong'>B. Methods of diagnosing gastroesophageal reflux in infants: a new Accelerometric Technique.</span><br>
            <span class='strong'>Ira H. Gewolb, M.D.</span><br>
            Current methods of diagnosing gastroesophageal reflux in infants are invasive, cumbersome, and often lack reproducibility. These methods will be reviewed and a new non-invasive 
            technology that can assess both acid and non-acid reflux will be introduced.<br><br>
            <span class='strong'>C. Pharmocological. Treatment of feeding intolerance.</span><br>
            <span class='strong'>Thomas E. Young, M.D.</span><br>
            Possible benefits and known adverse effects of using metoclopromide in premature infants will be identified and the rationale for using erythromycin in selected premature infants 
            with feeding intolerance will be discussed. We will also outline the effects of pre- and pro-biotics on gastrointestinal motility.<br><br><br>
            
            <span class='strong'>SESSION 2: DEVELOPMENTAL MODULE - 10:00-11:30 a.m.</span><br><br>
            <span class='strong'>A. Total body development and its relationship to feeding.</span><br>
            <span class='strong'>John Chappel, RPT</span><br>
            The somato-sensory stressors impairing aero-digestive functions will be identified and enumerated. The participant will be guided through a conceptualization of the role of synactive 
            functions and how they allow feeding to occur in the presence of stressors. Specific action plans to facilitate vagal/autonomic controls to aid digestion and absorption for the infant 
            will be described.<br><br>
            <span class='strong'>B. Successful feeding in the NICU: Developing individualized feeding plans.</span><br>
            <span class='strong'>Kristy Fuller, OTR/L</span><br>
            Supportive pre-feeding and feeding strategies that provide a foundation for optimal oral feeding performance for all NICU infants will be described as well as strategies to support unit 
            practice in order to emphasize qualitative versus quantitative feeding performance. The process for developing individualized feeding plans and methods for implementation in the NICU 
            will be discussed.<br><br>
            <span class='strong'>C. Newborn Individualized Developmental Care (NIDCAP) in the NICU: What is it?</span><br>
            <span class='strong'>Kathleen A. VandenBerg, PhD</span><br>
            Theoretical background and core neuro-developmental concepts necessary to understand the NIDCAP approach in the NICU will be identified. Competencies, sensitivities, and self-regulatory 
            behaviors in high-risk newborns will be described as well as the impact of stress and environment on newborn behavior. Suggestions for implementing individualized developmental 
            family-centered care and behavioral strategies that will serve to stabilize and support the newborn in the NICU and during the transition from hospital to home will be discussed.<br><br><br>
            
            <span class='strong'>SESSION 3: THERAPEUTIC MODULE - 1:00-2:30 p.m.</span><br><br>
            <span class='strong'>A. Therapeutic Intervention for the poor feeder.</span><br>
            <span class='strong'>John Chappel, RPT</span><br>
            Planning specific interventions for more efficient feeding outcomes will be discussed and the true interaction of respiratory components and their relationship to successful feeding will be 
            explained. The participant will learn to analyze and implement strategies and interventions for specific follow-up problems such as colic and constipation.<br><br>
            <span class='strong'>B. Evaluation and treatment of feeding disorders in the cardiac infant.</span><br>
            <span class='strong'>Laura Niemann, OTR/L</span><br>
            Cardiac defects and subsequent surgical procedures that may impact infant feeding will be identified and the basic neurophysiology of sensory processing as it relates to neonatal feeding 
            will be described. Evaluation tools to assess components that impact cardiac infant feeding and treatment techniques to improve, enhance, or develop functional oral motor and safe feeding 
            for these infants will be discussed.<br><br>
            <span class='strong'>C. Neonatal swallow function: assessing the use and efficacy of the videofluoroscopic swallow study.</span><br>
            <span class='strong'>Mary Stanford, M.S., CCC-SLP</span><br>
            Anatomy and physiology of the swallowing mechanism in the neonate will be described. Formulation of an individualized feeding assessment plan based on typical progression of feeding skill 
            development and related co-morbidities that may impact swallow function will be outlined. Clinical practice standards for indications for use of videofluoroscopy in the identification of 
            neonatal swallow dysfunction and methods to support optimal feeding skills during VFSS assessment will be discussed.<br><br><br> 
            
            <span class='strong'>SESSION 4: NURTURING, NURSING, AND NUTRITION MODULE - 3:00-4:30 p.m.</span><br><br>
            <span class='strong'>A. Cue-Based, Co-Occupation: an approach to oral feeding in the NICU.</span><br>
            <span class='strong'>Chrysty Sturdivant, OTR/L</span><br>
            Co-occupation as it applies to feeding the infant in the NICU will be defined. Subtle signs of stress that may be observed in the preterm infant during feeding will be described and family 
            interventions that can be used to assist the feeding situation for the preterm infant will be discussed.<br><br>
            <span class='strong'>B. Trouble shooting common breastfeeding challenges.</span><br>
            <span class='strong'>Cheryl Scott, PhD, RN</span><br>
            Evidenced-based methods to support the NICU mother’s milk supply will be discussed as well as methods of breast massage and hand expression to enhance milk supply. The participant will learn 
            how to help the NICU mother to foster mother-baby bonding with safe skin-to-skin techniques.<br><br>
            <span class='strong'>C. Strategies for adequate nutrition and growth in the human milk fed premature infant.</span><br>
            <span class='strong'>Shelley Bolt Wilkins, MPH, RD, CSP, LDN</span><br>
            Nutrients in human milk that may be insufficient to meet the nutritional needs of the preterm infant will be outlined and methods to increase calories/protein/minerals in the human milk fed 
            infant will be discussed. The rate of acceptable growth and adequate growth for the hospitalized newborn with respect to calories and protein will be discussed.<br><br>
            </div>
          </div>
          
          <div id="day_3" class="CollapsiblePanel">
            <div class="CollapsiblePanelTab" tabindex="2">Day 3 - October 18th (Mini Courses) - Friday</div>
            <div class="CollapsiblePanelContent">
              08:30 a.m. - Kathleen A. VandenBerg, PhD.<br>Supporting emerging development of self-regulation in the newborn.<br><br>
              10:30 a.m. - Peter Bingham, M.D.<br>Significance of the Non-Nutritive Suck (NNS) in the successful development of oral feeding.<br><br>            
              01:30 p.m. - Pamela Dodrill, PhD.<br>Factors associated with the age of attainment of initial oral feeding milestones in premature infants.<br><br>
              03:00 p.m. - Marjorie Meyer Palmer, M.A., CCC-SLP<br>Diagnostic-based treatment strategies for the poor feeder.<br><br>
            </div>
          </div>
          
          <div id="day_4" class="CollapsiblePink">
            <div class="CollapsiblePinkTab" tabindex="3">Day 4 - October 19th ("Day of Evaluation") - Saturday</div>
            <div class="CollapsiblePinkContent">
               08:00 a.m. - Welcome - Marjorie Meyer Palmer, M.A., CCC-SLP, Founder and Director, NOMAS International.<br><br>
               08:15 a.m. - Ira Adams-Chapman, M.D.<br>Predictors of Adverse Developmental Outcome.<br><br>
               09:15 a.m. - Paul E. Hyman, M.D.<br>Moving from Tube to Oral Feeding in Medically Fragile Infants and Toddlers: Recognizing and Treating Dyspepsia and Dysphagia.<br><br>
               11:00 a.m. - Marie Augusta Reilly, PhD.<br>Motor concerns seen in High-Risk Follow-Up Clinic often associated with Feeding Disorders.<br><br>
               01:30 p.m. - Pamela Dodrill, PhD<br>Relationship between Feeding Skills, Diet, and Growth in Preterm Infants during First Year Post Discharge.<br><br>
               03:00 p.m. - Joan Arvedson, PhD.<br>Instrumental Assessment: Why, When, How, and Interpretation Leading to Decision.<br><br>
            </div>
          </div>
          
          <div id="day_5" class="CollapsiblePink">
            <div class="CollapsiblePinkTab" tabindex="4">Day 5 - October 20th ("Day of Treatment") - Sunday</div>
            <div class="CollapsiblePinkContent">
               08:00 a.m. - Joan Arvedson, PhD.<br>Management Decisions for Infants after Discharge with Complex Feeding and Swallowing Problems.<br><br>
               10:45 a.m. - Joan Dietrich Comrie, M.S., CCC-SLP<br>Treatment of Motor-Based Feeding Disorders after Discharge.<br><br>
               01:30 p.m. - Pamela Dodrill, PhD.<br>Behavioral Feeding Intervention for Children 1-6 Years who present with Persistent Feeding Disorders.<br><br>
               03:00 p.m. - Marjorie Meyer Palmer, M.A., CCC-SLP<br>Use of Incremental Progression for Sensory-Based Feeding Aversion.<br>
            </div>
          </div>                                                
        </div><!--end cirriculum item-->          
        
        <div class='clearAll'></div>         
        
        <!--<hr><br><br> -->
        
        <!--<h1>2) Pay for the talks using PayPal (credit/debit card) or send check/money order.</h1> 
        <h2>Note: select from only one of the three price lists below, according to your status as a NOMAS<sup>&reg;</sup> licensee.</h2>
        
        <div class='clearAll'></div><br>       
        
        <div class='notices_section'>
           <div class='box'>
              <div class='text'>
                 We hope to have <span class='strong'>Symposium presentations</span> available for download two weeks prior to October 16th. Upon registration you will be sent a password. 
                 You may return here and use the password to download the presentations. If you would prefer to receive a <span class='strong'>printed course syllabus</span> please add it to your 
                 cart during check-out, below. Because of the expense in time and effort involved, the printed syllabus must be pre-paid here. Regrettably, you will not be able to order a printed 
                 syllabus later.                
              </div>   
           </div>        
        </div>                    
        
        <div class='clearAll'></div>
        
        <div class='paypal_section'>        
            <div class='text_l'>
               Note: prices are somewhat lower if you send a check or money order rather than use a credit/debit card or PayPal.<br>To pay by check, fill-out the online registration form in
               Section 3 and send a check separately, payable to:<br><br>
               NOMAS International<br>
               1528 Merrill Road<br>
               San Juan Bautista CA 95045<br><br>   
               If you elect to send a check for registration and would like a pre-printed syllabus,<br>you must order and pay for the syllabus now using PayPal/credit/debit card.<br>
               Order the printed syllabus using any of the drop-down menus, below.
               <br><br><br>                              
               REGISTRATION IF PAYING BY CHECK OR MONEY ORDER:
            </div>                   
           
            <div class='paypal_box'>  
                <div class='hed'>NOMAS<sup>&reg;</sup> Licensee:</div>  
              <span class='text'>
                All five days: $680.00<br>
                Days 1-3 only: $445.00<br>
                Days 4&5 only: $285.00
                </span>
            </div><!--end paypal_box
            
            <div class='paypal_box'>
                <div class='hed'>Expired NOMAS<sup>&reg;</sup> License:</div>      
              <span class='text'>
                All five days: $750.00<br>
                Days 1-3 only: $465.00<br>
                Days 4&5 only: $310.00
                </span>
            </div><!--end paypal_box
            
            <div class='paypal_box'>     
            <div class='hed'>Not a NOMAS<sup>&reg;</sup> Licensee:</div>         
              <span class='text'>
                All five days: $780.00<br>
                Days 1-3 only: $485.00<br>
                Days 4&5 only: $335.00
                </span>
            </div><!--end paypal_box  
                        
            <div class='clearAll'></div>  
            
            <div class='text'><br>REGISTRATION WITH PAYPAL/CREDIT/DEBIT CARD AND/OR TO ORDER THE PRINTED SYLLABUS:</div>
                            
            <div class='paypal_box'>  
                <div class='hed'>NOMAS<sup>&reg;</sup> Licensee:</div>      
                  <form class='paypal_form' target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="U9QYAYLJXPYJG">
                  <table class='paypal_table'>
                  <tr><td><input type="hidden" name="on0" value="Select Attendance Tier">Select Attendance Tier</td></tr><tr><td><select name="os0">
                      <option value="All Five Days">All Five Days $720.40 USD</option>
                      <option value="Days 1 - 3 Only">Days 1 - 3 Only $458.35 USD</option>
                      <option value="Days 4 &amp; 5 Only">Days 4 &amp; 5 Only $293.55 USD</option>
                      <option value="Printed syllabus">Printed syllabus $65.00 USD</option>
                  </select> </td></tr>
                  </table>
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>        
            </div><!--end paypal_box
            
            <div class='paypal_box'>
                <div class='hed'>Expired NOMAS<sup>&reg;</sup> License:</div>      
                  <form class='paypal_form'  target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="JACXMCZX3HSKW">
                  <table class='paypal_table'>
                  <tr><td><input type="hidden" name="on0" value="Select Attendance Tier">Select Attendance Tier</td></tr><tr><td><select name="os0">
                      <option value="All Five Days">All Five Days $772.50 USD</option>
                      <option value="Days 1 - 3 Only">Days 1 - 3 Only $478.95 USD</option>
                      <option value="Days 4 &amp; 5 Only">Days 4 &amp; 5 Only $319.30 USD</option>
                      <option value="Printed syllabus">Printed syllabus $65.00 USD</option>
                  </select> </td></tr>
                  </table>
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>
            </div><!--end paypal_box
            
            <div class='paypal_box'>     
            <div class='hed'>Not a NOMAS<sup>&reg;</sup> Licensee:</div>         
              <form class='paypal_form' target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="RDKZ3DY89NCS8">
              <table class='paypal_table'>
              <tr><td><input type="hidden" name="on0" value="Select Attendance Tier">Select Attendance Tier</td></tr><tr><td><select name="os0">
                  <option value="All Five Days">All Five Days $803.40 USD</option>
                  <option value="Days 1 - 3 Only">Days 1 - 3 Only $499.55 USD</option>
                  <option value="Days 4 &amp; 5 Only">Days 4 &amp; 5 Only $345.05 USD</option>
                  <option value="Printed syllabus">Printed syllabus $65.00 USD</option>
              </select> </td></tr>
              </table>
              <input type="hidden" name="currency_code" value="USD">
              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
              </form>
            </div><!--end paypal_box            
            <div class='clearAll'></div>                         
       </div><!--end paypal section-->        
        
       <!--<div class='notices_section'>
           <div class='box'>
              <div class='text'>
                 <span class='strong'>Cancellation Policy:</span> a written request for a full refund must be received by NOMAS International no later than 21 business days prior
                 to the start of the course. Written requests later than 21 days will result in a 50% refund; 72 hours or less, no refund. NOMAS International
                 reserves the right to cancel the event seven days prior to the course date and assumes no responsibility for pre-purchased airline tickets.
              </div>   
           </div>        
        </div>         
        
        <div class='clearAll'></div>         
        <div class='spacer_36'></div>
        <hr><br><br>  
        
        <a name='errors'></a>
        <h1>3) Register for the Symposium:</h1>      
        
        <!-- CONTACT CONTAINER 
        <div class='form_section'>
           <div class='box'>

              <form class='signUp' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
              
                <div class='hed'>Symposium Registration Form</div>              
              
                <?php 	  		
                if (isset($formError['problem']) && $formError['problem'] > '') {
		           echo "<div class='error'>";	
                   echo $formError['problem'];
		           echo "</div>";
                }	  
                ?>      
                                
                <input type="hidden" name="date_in" value="<?php echo $date_in; ?>" />                               
                
                <label for="check_amt">Amount you will send by check (if not sending a check, please leave blank):</label><br>
                <input style='width:15%;' type="text" name="check_amt" value="<?php echo stripslashes($check_amt); ?>" maxlength="25" /><br>                
                <?php echo (isset($formError['check_amt']) || !empty($formError['check_amt'])) ? "<div class='error_msg'>" . $formError['check_amt'] . "</div>" : '' ?>
                
                <label for="name">Your Name:</label><br>
                <input style='width:50%;' type="text" name="name" value="<?php echo stripslashes($name); ?>" maxlength="50" /><br>                
                <?php echo (isset($formError['name']) || !empty($formError['name'])) ? "<div class='error_msg'>" . $formError['name'] . "</div>" : '' ?> 
                
                <label for="profession">Your Profession:</label><br>
                <input style='width:70%;' type="text" name="profession" value="<?php echo stripslashes($profession); ?>" maxlength="100" /><br>                
                <?php echo (isset($formError['profession']) || !empty($formError['profession'])) ? "<div class='error_msg'>" . $formError['profession'] . "</div>" : '' ?>
                
                <label for="employer">Your Employer:</label><br>
                <input style='width:70%;' type="text" name="employer" value="<?php echo stripslashes($employer); ?>" maxlength="100" /><br>                
                <?php echo (isset($formError['employer']) || !empty($formError['employer'])) ? "<div class='error_msg'>" . $formError['employer'] . "</div>" : '' ?> 
                
                <label for="city_state">Employer CITY, STATE (for your Symposium badge):</label><br>
                <input style='width:50%;' type="text" name="city_state" value="<?php echo stripslashes($city_state); ?>" maxlength="100" /><br>                
                <?php echo (isset($formError['city_state']) || !empty($formError['city_state'])) ? "<div class='error_msg'>" . $formError['city_state'] . "</div>" : '' ?>  
                                             
                <label for="phone1">Best Phone:</label><br>
                <input style='width:50%;' type="text" name="phone1" value="<?php echo stripslashes($phone1); ?>" maxlength="25" /><br>                
                <?php echo (isset($formError['phone1']) || !empty($formError['phone1'])) ? "<div class='error_msg'>" . $formError['phone1'] . "</div>" : '' ?>
                
                <label for="email">Email:</label><br>
                <input style='width:80%;' type="text" name="email" value="<?php echo stripslashes($email); ?>" maxlength="100" /><br>                
                <?php echo (isset($formError['email']) || !empty($formError['email'])) ? "<div class='error_msg'>" . $formError['email'] . "</div>" : '' ?> 
                
                <label for="home_addr">Home Address:</label><br>
                <input style='width:80%;' type="text" name="home_addr" value="<?php echo stripslashes($home_addr); ?>" maxlength="100" /><br>                
                <?php echo (isset($formError['home_addr']) || !empty($formError['home_addr'])) ? "<div class='error_msg'>" . $formError['home_addr'] . "</div>" : '' ?>         
                                                     
                <label for="nomas_num">NOMAS License Number (for registration discount):</label><br>
                <input style='width:30%;' type="text" name="nomas_num" value="<?php echo stripslashes($nomas_num); ?>" maxlength="25" /><br>                
                <?php echo (isset($formError['nomas_num']) || !empty($formError['nomas_num'])) ? "<div class='error_msg'>" . $formError['nomas_num'] . "</div>" : '' ?> 
                                                     
                <label for="nurses_num">California Registered Nurses Number (for registration discount):</label><br>
                <input style='width:30%;' type="text" name="nurses_num" value="<?php echo stripslashes($nurses_num); ?>" maxlength="25" /><br>                
                <?php echo (isset($formError['nurses_num']) || !empty($formError['nurses_num'])) ? "<div class='error_msg'>" . $formError['nurses_num'] . "</div>" : '' ?>       
                
                <div class='hed'>Please Enter Numbers 1 to 3 to indicate your preference for the 10/17 Learning Module sessions</div>
                
                <label for="s_1">Session 1 - Medical Module - 8:00 a.m. to 9:30 a.m.</label><br>
                A. <input style='width:5%;' type="text" name="s1_a" value="<?php echo stripslashes($s1_a); ?>" maxlength="1" />
                B. <input style='width:5%;' type="text" name="s1_b" value="<?php echo stripslashes($s1_b); ?>" maxlength="1" />
                C. <input style='width:5%;' type="text" name="s1_c" value="<?php echo stripslashes($s1_c); ?>" maxlength="1" /><br>
                <?php echo (isset($formError['s1']) || !empty($formError['s1'])) ? "<div class='error_msg'>" . $formError['s1'] . "</div>" : '' ?>       
                
                <div class='text'>
                A - Olfaction: the forgotten sense and its relationship to successful oral feeding in the newborn.<br>
                B - Methods of diagnosing gastroesophageal reflux in infants: a new Accelerometric Technique.<br>
                C - Pharmocological. Treatment of feeding intolerance.
                </div><br><br>
                
                <label for="s_2">Session 2 - Develpomental Module - 10:00 a.m. to 11:30 a.m.</label><br>
                A. <input style='width:5%;' type="text" name="s2_a" value="<?php echo stripslashes($s2_a); ?>" maxlength="1" />
                B. <input style='width:5%;' type="text" name="s2_b" value="<?php echo stripslashes($s2_b); ?>" maxlength="1" />
                C. <input style='width:5%;' type="text" name="s2_c" value="<?php echo stripslashes($s2_c); ?>" maxlength="1" /><br>
                <?php echo (isset($formError['s2']) || !empty($formError['s2'])) ? "<div class='error_msg'>" . $formError['s2'] . "</div>" : '' ?>       
                
                <div class='text'>
                A - Total body development and its relationship to feeding.<br>
                B - Successful feeding in the NICU: Developing individualized feeding plans.<br>
                C - Newborn Individualized Developmental Care (NIDCAP) in the NICU: What is it?
                </div><br><br>                                               
                
                <label for="s_3">Session 3 - Therapeutic Module - 1:00 p.m. to 2:30 p.m.</label><br>
                A. <input style='width:5%;' type="text" name="s3_a" value="<?php echo stripslashes($s3_a); ?>" maxlength="1" />
                B. <input style='width:5%;' type="text" name="s3_b" value="<?php echo stripslashes($s3_b); ?>" maxlength="1" />
                C. <input style='width:5%;' type="text" name="s3_c" value="<?php echo stripslashes($s3_c); ?>" maxlength="1" /><br> 
                <?php echo (isset($formError['s3']) || !empty($formError['s3'])) ? "<div class='error_msg'>" . $formError['s3'] . "</div>" : '' ?>                       
                
                <div class='text'>
                A - Therapeutic Intervention for the poor feeder.<br>
                B - Evaluation and treatment of feeding disorders in the cardiac infant.<br>
                C - Investigation of neonatal swallow function: assessing the use and efficacy of the videofluoroscopic swallow study.
                </div><br><br>                     
                
                <label for="s_4">Session 4 - Nurturing, Nursing and Nutrition Module - 3:00 p.m. to 4:30 p.m.</label><br>
                A. <input style='width:5%;' type="text" name="s4_a" value="<?php echo stripslashes($s4_a); ?>" maxlength="1" />
                B. <input style='width:5%;' type="text" name="s4_b" value="<?php echo stripslashes($s4_b); ?>" maxlength="1" />
                C. <input style='width:5%;' type="text" name="s4_c" value="<?php echo stripslashes($s4_c); ?>" maxlength="1" /><br>
               <?php echo (isset($formError['s4']) || !empty($formError['s4'])) ? "<div class='error_msg'>" . $formError['s4'] . "</div>" : '' ?>       
                
                <div class='text'>
                A - Cue-Based, Co-Occupation: an approach to oral feeding in the NICU.<br>
                B - Trouble shooting common breastfeeding challenges.<br>
                C - Strategies for adequate nutrition and growth in the human milk fed premature infant.
                </div><br><br>                    
                
                <label for="message">Note to Symposium organizer?</label><br>
		        <textarea cols="65" rows="10" name="message"><?php echo stripslashes($message)?></textarea>
                                                             
                <div class='clearAll'></div>         
                <div class='spacer_26'></div>	
                
                <!--
                <div class='captcha_box'>
                   <img id="captcha" src="_inc/securimage/securimage_show.php" alt="CAPTCHA Image" />
                   <a href="#" onclick="document.getElementById('captcha').src = '_inc/securimage/securimage_show.php?' + Math.random(); this.blur(); return false">
                   <img style='padding:16px 20px;' src="_inc/securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" border="0"></a>                   
                   <br style='clear:both'><br>
                   <label for="captcha_code">Please enter below the anti-spam code from above. NOT CASE SENSITIVE.<br>(If too obscure, click circular arrows for a new anti-spam code):</label><br><br>
                   <input style='width:20%;' type="text" name="captcha_code" maxlength="6" />                     
                </div>                   
                
                <?php //echo (isset($formError['captcha_code']) || !empty($formError['captcha_code'])) ? "<div class='error_msg'>" . $formError['captcha_code'] . "</div>" : '' ?>       
                
                
                <button type="submit" name="submit" value="submit">Send Registration</button>
        
                </form><br><br>-->
            </div><!-- end form_box-->  
           <div class='clearAll'></div>                          
        </div><!-- end form_section-->                      

        <div class='clearAll'></div>         
        <div class='spacer_36'></div>
        <hr><br><br>        
                  
        <!--<a name='hotel'></a>
        <h1>4) Click the hotel logo to reserve rooms at the Symposium special rate:</h1>      
        
        <div class='notices_section_1'>
           <div class='box'>
              <div class='text'>
                 <a href="http://www.totalrewards.com/hotel-reservations?propCode=FLV&groupCode=SFNOM3" target="_blank">
                 <img src="_grafix/logo-flamingo.gif" width="120" height="53" alt="IMG"> 
                 </a>
                 The Symposium will be held at the <span class='strong'>Flamingo Las Vegas Hotel and Casino</span>, 3555 Las Vegas Blvd South, Las Vegas, NV, 89109. 
                 For those who register by July 15, a block of rooms has been reserved at the special rate of $55 per night for Oct 15-17 and $125 per night for Oct 18 and 19, 
                 on availability. YOU MUST RESERVE YOUR ROOM BY September 16 to obtain the discount. Phone hotel directly at: 888-373-9855.                 
              </div>   
           </div>        
        </div>                             
                
        <div class='clearAll'></div>         
        <div class='spacer_36'></div>  
        <hr><br><br>-->
        
       <div class='item'>
           <div class='logo_box'>
              <img src="_grafix/logo-asha-approved-2013.gif" width="600" height="143" alt="logo">
              <div class='caption'>
                 Days 1 - 3 (inclusive) are offered for 1.75 ASHA CEU's. Various levels; Professional Area.<br>
                 Days 4 & 5 (inclusive) are offered for 1.15 ASHA CEU's. Various levels; Professional Area.<br>
              </div><!-- end caption-->        
           </div><!-- end logo_box_1-->   
        </div><!-- end item-->
        
        <div class='clearAll'></div>
        
        <div class='item'>
           <div class='logo_box'>
              <img src="_grafix/logo-aota-provider.gif" width="" height="" alt="logo">
              <div class='caption'>
                 <span class='caption_b'>
                    Therapeutic Media is an AOTA Approved Provider of<br>Continuing Education. AOTA does not endorse specific <br>course content, products, or clinical procedures.
                 </span><br>
                 Days 1 - 3 (inclusive) are offered for 1.7 AOTA CEU's.<br>
                 Days 4 & 5 (inclusive) are offered for 1.1 AOTA CEU's.<br>
              </div><!-- end caption-->   
           </div><!-- end logo_box_1-->                                 
        </div><!-- end item-->        
        
        <div class='logo_box_1'>
           <img src="_grafix/logo-ca-nurses.gif" width="" height="" alt="logo">
           <div class='caption'>
              <span class='caption_b'>
                 Therapeutic Media is a Provider<br> for Continuing Education by the<br>California Board of Registered<br>Nursing, Provider #CEP 13879.
              </span><br>
              Days 1 - 3 (inclusive): 17 Contact Hours.<br>
              Days 4 & 5 (inclusive): 11 Contact Hours.<br>
           </div><!-- end caption-->
        </div><!-- end logo_box_1-->
        
     </div><!--END COLUMN LEFT-->             
  </div> <!-- end content  -->
  
  <div class='clearAll'></div>
  
  <!--FOOTER-->
  <div id="footer"> 
     <?php showBottomMenu(); ?>
     <?php showCopyright($thisYear); ?>
  </div><!-- end footer -->
 
  <div class='clearAll'></div>

</div><!-- end #playround -->
<script type="text/javascript">
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("more-objectives", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("day_1", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("day_2", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("day_3", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("day_4", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("day_5", { contentIsOpen: false });
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("faculty", { contentIsOpen: false });
-->
</script>
</body>
</html>
