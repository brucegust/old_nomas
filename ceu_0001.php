<?php 
header("Cache-Control: no-cache, must-revalidate");
header('Pragma: no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "NOMAS<sup>&reg;</sup> International Online Continuing Education";
$pageSubTitle = "Online CEU instruction for Occupational Therapy, Speech Pathology and Nursing professionals";

// define INVOICE NUMBER variable and include in each button. Stores as 'name="invoice"' 
$orderno  = time();

//*****************************************************************
//*****************************************************************
//*****************************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta name="robots" content="noindex">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<meta name="viewport" content="width=device-width" />
<title>NOMAS International - Online Training for CEU's</title>
<meta name="description" content="Take online courses in infant feeding for Continuing Education Units.">
<link href="_css/css_cms.css" rel="stylesheet" type="text/css">
<link href="_css/css_courses.css" rel="stylesheet" type="text/css">
<link href="_css/css_nav_top.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<?php 
echo $vibracart . "\n";
echo $jq_google . "\n";
echo $jq_ui . "\n";
echo $jq_slidemenu . "\n"; 
echo $swfobj22 . "\n"; 
echo $jwplayer . "\n"; 
echo $cms_spry . "\n";
?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-61070902-1', 'auto');
  ga('send', 'pageview');
</script>

<style>
#tc_background {
	display:none;
	position:fixed;
	z-index:1;
	background: rgba(49, 51, 53, 0.5);
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	text-display:center;
}

#tc_header {
	display:none;
	background-color:#ffffff;
	border:1px solid #cccccc;
	border-radius:10pt;
	/* box-shadow: 10px 10px 5px #cccccc; */	
	position:relative;
	top:50px;
	left:50%;
	margin-left:-340px;
	z-index:10;
	width:680px;
	height:auto;
	padding:10px;	
	font-family:Arial;
	font-size:10pt;
}

</style>

</head>
<body>
<div id="playground">

   <div id='site_logo'><?php showBigLogo(); ?></div>
   <div class='clearAll'></div>
   
 <!--letter of Recommendation -->
 
<div id="tc_background">
	<div id="tc_header"><div style="display:inline-block; width:100%; text-align:right;"><a href="#series_four" onclick="popup_close()" style="text-decoration:none; color:#000000;">&nbsp;<span style="font-size:18pt;">&otimes;</span></a></div><br>
	As a participant of the NOMAS® ONLINE: Day 1 course I understand that I will not be Certified or Licensed upon completion of this course and, therefore, will not have earned Certification or Licensure in the administration and scoring of the NOMAS®. Since I will not be Licensed, I understand that I will not be qualified or permitted to use the NOMAS® for the purpose of diagnosing neonatal sucking patterns and will not represent myself as a Licensed NOMAS® Professional.  In addition, since I will not be reliable in the administration and scoring of the NOMAS® I agree that it is unethical for me to use the NOMAS® for research purposes.  
	<br><br>
	I am taking this course for the sole purpose of expanding my knowledge in the area of neonatal feeding.
	<br><br>
	<div style="background-color:#000000; color:#ffffff; width:auto; height:auto; padding:10px; border-radius:10pt; text-align:center;">By clicking <a href="#series_four" onclick="series_four_button_display()" style="text-decoration:underline; color:yellow; font-weight:bold;">here</a>, I am agreeing to the above stated terms.</div><br>	
	</div>
</div>		
  
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
       <div id='column_left_wide'><div style="font-style: normal;
		font-variant-ligatures: normal;
		font-variant-caps: normal;
		font-variant-numeric: normal;
		font-variant-east-asian: normal;
		font-weight: normal;
		font-stretch: normal;
		font-size: 1.4em;
		line-height: 1.4em;
		font-family: Verdana, Geneva, sans-serif;"><div style="width:400px; height:auto; padding:10px; margin:10px; border:1px solid #cccccc; border-radius:10pt; float:right; background-color:#000000; color:#ffffff; text-align:center; box-shadow:5px 5px 3px #ccc;">PLEASE BE AWARE...<br><br>You have access to the course content for seven days only. You may sign in and out as often as you like during that time frame, but you are limited to seven days beginning the day you first sign in.<br><br></div>Welcome! These online courses focus on evaluation, treatment and therapeutic intervention in the NICU  for neonates and subsequently for  older infants and 
				children who present with feeding disorders.<br><br>
                Individuals who provide services to these patients may come from a variety of educational and professional backgrounds but all have one goal in common: to resolve oral, 
                pharyngeal, and esophageal phase swallowing and feeding disorders in the neonatal and pediatric populations. These courses are designed to help you meet that goal. 
</div>
         <!--end l_item-->
          
          <div class='item_sep_dots'></div>
       
          <div class='l_item'>
              <div class="heading">
                <h1>SERIES ONE - (Course of 11 talks)</h1>
                <div class='sub_hed'>"Neonatal and Pediatric Feeding Disorders: Evaluation and Treatment in the NICU and After Discharge."</div>
              </div>
              <!--ASHA block -->
			 <div style="width:900px; margin:auto; height:auto; padding:5px; display:inline-block; border:1px solid #cccccc; font-family:Verdana, Geneva, sans-serif; font-size:9pt; "><img src="_grafix/asha.jpg" style="width:900px;">
				<br><br></div><br><br><span style="font-size:10pt; font-family:Verdana, Geneva, sans-serif;  font-weight:bold;">This course is offered for 0.85 ASHA CEUs (Advanced Level, Professional Area)</span><br><br> 
              <?php
              if(is_file($nomas_ceu_excerpt)) { 
			  echo "\n";
              ?>
                 <!--VIDEO-->
                  <div style='width:40%;float:left;display:inline;'>
                     <div id='vidBox'>Please install the Flash Plugin</div>	
                     <script type="text/javascript">
                     <!--
                     jwplayer('vidBox').setup({
                     'id': 'playerID',
                     'width': '300',
                     'height': '240',
                     'file': '<?php echo $nomas_ceu_excerpt; ?>',
                     'image': '<?php echo $nomas_series_1_pic; ?>',
                     'skin': '',
                     'controlbar.position': 'bottom',
                     'modes': [     
                        {type: 'html5'},								
                        {type: 'flash', src: '_js/player.swf'}
                     ]
                     });
                     -->
                     </script>
                  </div><!--end vid player-->
                  <!--END VIDEO-->
			  <?php   
              }    					  						
              echo (is_file($nomas_ceu_excerpt)) ? "<div style='width:55%;float:left;display:inline;margin-left:12px;'><div class='reg_text'>" : "<div class='reg_text'>"; 			
              ?>
                                                            
              For successful completion one quiz must be passed at the end. To receive ASHA CEUs the participant must DOWNLOAD, complete, and either FAX, mail, or send electronically OR just provide your ASHA membership number.<br><br><span class='bld'>Course Description</span>:<br><br>The 11 talks in this online course focus on feeding difficulties in term and preterm infants, evaluation and 
              treatment of sensory and motor-based feeding problems after discharge from NICU or special care nursery, videofluoroscopic studies of infants and children showing examples, 
              procedure and diagnosis, and weaning from tube to oral feeding using a sensory-based protocol.<br><br>
              The full course is made up of all 11 talks. Each talk runs about 1 hour. Talks may also be purchased and viewed individually with some exceptions. Please see CEU statements below, for CEU details.
              
              <?php                       
              echo (is_file($nomas_ceu_excerpt)) ? "</div></div><!--end STYLE & reg_text-->" : '</div><!--end reg_text-->'; 			
              ?>                 
              
              <div class='clearAll'></div> 
              
              <div id="series-one" class="CollapsibleCourses">

                <div class="buttons">
                  <div class="btn with-icon CollapsibleCoursesTab" tabindex="0">
                    <span class="icon plus">&plus;</span>
                    View SERIES ONE Courses 
                    <span>Learning Outcomes, and Order Talks</span>
                  </div>
                </div>

                 <div class="CollapsibleCoursesContent">     

                   <div class='half_box_l'>     
                      <ul class="pink">
                         <span class='hed'>Series One Learning Outcomes:</span>
                         <li>&nbsp;</li>
                         <li class='pink'>Describe the changing anatomy and physiology of the infant oral mechanism and its impact on feeding.</li>
                         <li class='pink'>Analyze disorganized and dysfunctional sucking patterns in the poor feeder as described by the NOMAS<sup>&reg;</sup>.</li>
                         <li class='pink'>Identify specific feeding problems in the NICU so as to implement Diagnostic-Based Intervention.</li>
                         <li class='pink'>Differentiate sensory from motor-based feeding disorders.</li>
                         <li class='pink'>Explain the relationship between gastroesophageal reflux and esophageal motility as it relates to the intake of solid food.</li>
                         <li class='pink'>Discuss the Palmer Protocol for Sensory-Based Weaning from tube to oral feeding.</li>
                      </ul>                                                         
                   </div><!-- end half_box_l-->   
                                    
                   <div class='half_box_r'>    
                      <div class='text'>
                         <div class="hed">Presenter: Marjorie Meyer Palmer M.A., CCC-SLP</div><br>
                         <img src="_grafix/palmer-marjorie-80.jpg" width="80" height="80" alt="GRAPHIC"> 
                         <span class="bld">Non-financial disclosure:</span> founder and director of NOMAS<sup>&reg;</sup> International; current member, 
                         the American Academy of Cerebral Palsy and the NIDCAP Federation International.
                         <br><br>
                         <span class="bld">Financial disclosure:</span> Ms. Palmer is financially compensated for teaching live courses on feeding and online continuing education courses 
                         on feeding. She conducts certification courses for the NOMAS<sup>&reg;</sup> and administers the non-exclusive copyright license renewal program 
                         for NOMAS<sup>&reg;</sup> Certified Professionals. She is sole distributor of the "Fantastic Feeding Dropper."
                      </div>   
                   </div><!-- end half_box_r-->   
                   
                   <div class='clearAll'></div>                      
                   <div class="item_sep_dots_pink"></div>      
                   
                   <div class='refund_box'>
                      <div class='refund_text'>
                         <span class='refund_bld'>NOTE:
                         Talk 2 may be taken alone but Talk 3 must be taken with Talk 2. Talk 9 may be taken alone but Talk 10 must be taken with Talk 9.</span><br>
                      </div><!--end tiny_text-->                   
                   </div><!--end tiny_text_box-->  
                   
                   <br style='clear:both;'>
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                All 11 Series One Talks
                              </h3>
                            </td>
                         </tr>
                         <tr>
                          <td>
                            <img style='float:left;border:none;margin-right:12px;' src="_grafix/all_11.gif" width="75" height="75" alt="GRAPHIC">
                            
                            SPECIAL - Order all 11 talks in Series One for <?php echo $price_all_11; ?>!
                            <br><br>
                            Introductory, intermediate and advanced material<br>($850 if taken individually)

                          </td>
                         </tr>
                         <tr>
                            <td class='button'>
                             <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                             <input type="hidden" name="cmd" value="_cart">
                             <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                             <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">                             
                             <input type="hidden" name="lc" value="US">
                             <input type="hidden" name="item_name" value="All 11 Talks">
                             <input type="hidden" name="item_number" value="v00">
                             <input type="hidden" name="amount" value="375.00">
                             <input type="hidden" name="currency_code" value="USD">
                             <input type="hidden" name="button_subtype" value="products">
                             <input type="hidden" name="no_note" value="0">
                             <input type="hidden" name="cn" value="Add special instructions to the seller:">
                             <input type="hidden" name="no_shipping" value="2">
                             <input type="hidden" name="add" value="1">
                             <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                             <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                             <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                             <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">                             
                             <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                             <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                             </form>                            
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                                    
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div> 
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                1. Anatomy and Physiology of the Oral Mechanism: Reflexive to Volitional.
                                <span class="sub-title">$40. Introductory. Runs: 44:16</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. List the Six Primitive Oral Reflexes.<br>
                            2. Explain Changes in Oral Anatomy: Birth to Six Months.<br>
                            3. Describe Volitional Bolus Transfer During the Management of Solid Food.
                            </td>
                         </tr>                            
                         <tr>
                            <td>
                            Describes anatomical/physiologic changes that occur during the first six months of life and beyond. Discussed: primitive oral reflexes, the first transition 
                            in feeding, and the development of the volitional bolus transfer. Participants will view changing oral-motor patterns from reflexive to volitional. 
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Anatomy/Physiology of the Oral Mechanism">
                            <input type="hidden" name="item_number" value="v01">
                            <input type="hidden" name="amount" value="40.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">                         
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">  
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                    
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                2. Evaluation of Neonatal Sucking Based upon the NOMAS<sup>&reg;</sup>.
                                <span class="sub-title">$95. Advanced. Runs: 45:19</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. List the Two Types of Normal Suck Patterns.<br>
                            2. List Three Characteristics of Jaw &amp; Tongue Movement in the Disorganized Suck.<br>
                            3. Describe at least Four Characteristics of Dysfunctional Suck.
                            </td>
                         </tr>                                                            
                         <tr>
                            <td>
                            Introduces sucking patterns of the neonate based on the NOMAS<sup>&reg;</sup>. Describes observable characteristics of jaw and tongue function during 
                            dysfunctional suck; coordination of suck / swallow / breathe; disorganized suck; and evaluation process.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Eval of Neonatal Sucking Based upon the NOMAS">
                            <input type="hidden" name="item_number" value="v02">
                            <input type="hidden" name="amount" value="95.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                   
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                3. Diagnostic Based Treatment for the Infant with Feeding Disorders (must be taken with #2).
                                <span class="sub-title">$190. Advanced (includes courses #2 and #3). Runs: 49:33 </span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Suggest Ways to Improve Neonatal Feeding in the NICU.<br>
                            2. Difference between External Pacing and Regulation For the Disorganized Feeder.<br>
                            3. Use of Therapeutic Techniques for the Dysfunctional Feeder.
                            </td>
                         </tr>                                        
                         <tr>
                            <td>
                            Prescriptive treatment based on diagnosis of suck pattern. Discusses therapeutic techniques to improve feeding with infants who present with dysfunctional 
                            suck and intervention strategies for those infants with disorganized suck. Describes when use of particular techniques is contra-indicated. 
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Diagnostic Based Treatment, Talks 2 & 3">
                            <input type="hidden" name="item_number" value="v03">
                            <input type="hidden" name="amount" value="190.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">                            
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>


                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>                                       
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                4. Sensory and Motor Aspects of Neonatal Sucking.
                                <span class="sub-title">$55. Intermediate. Runs: 52:44</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Recognize the differences between motor and sensory disorders of neonatal sucking.<br>
                            2. Identify four characteristics of a motor based feeding disorder.<br>
                            3. Describe three types of sensory feeding problems.
                            </td>
                         </tr>                              
                         <tr>
                            <td>
                            View aspects of sensory/motor function during non-nutritive/nutritive suck. Discusses deviant oral-motor patterns; clinical signs of an “altered sensory system” 
                            including perseveration, habituation, poor adaptability; visceral hyperalgesia.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Sensory and Motor Aspects of Neonatal Sucking">
                            <input type="hidden" name="item_number" value="v04">
                            <input type="hidden" name="amount" value="55.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>                    
                                      
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                5. Dysphagia versus Prematurity.
                                <span class="sub-title">$75. Advanced. Runs: 43:26</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Describe the feeding difficulty for a premature infant with a disorganized suck.<br>
                            2. Recognize the clinical signs of dysphagia.<br>
                            3. Know when to appropriately refer for an MBS study.
                            </td>
                         </tr>                            
                         <tr>
                            <td>
                            View clinical and videofluoroscopic presentations of premature infants from 31 weeks PCA and compare their performance to infants with dysphagia secondary to such 
                            medical conditions as TEF, esophageal stricture, neurological issues, GER and dysmotility.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Dysphagia versus Prematurity">
                            <input type="hidden" name="item_number" value="v05">
                            <input type="hidden" name="amount" value="75.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>                                       

                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                6. Neonatal and Pediatric Swallow Studies: Procedure, Interpretation, and Diagnosis.
                                <span class="sub-title">$95. Advanced. Runs: 41:34</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Properly Select Position, Utensil, And Consistencies For The MBS.<br>
                            2. Describe The Oral, Pharyngeal, And Esophageal Phases Of Swallow.<br>
                            3. Accurately Diagnose The Problem.
                            </td>
                         </tr>                                                    
                         <tr>
                            <td>
                            View a variety of modified barium swallow (MBS) studies with neonatal/pediatric patients; analyze oral, pharyngeal, esophageal phases of swallow; examples of 
                            dysphagia in all phases will be viewed.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Neonatal and Pediatric Swallow Studies">
                            <input type="hidden" name="item_number" value="v06">
                            <input type="hidden" name="amount" value="95.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                    
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>                    
         
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                7. Differential Diagnosis of Motor vs. Sensory-Based Feeding Disorders.
                                <span class="sub-title">$40. Introductory. Runs: 42:46</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Describe jaw and tongue movements of the child with hypertonicity.<br>
                            2. Explain persistent oral-motor patterns in a child with hypotonicity.<br>
                            3. Identify clinical signs of sensory-based oral feeding disorder.
                            </td>
                         </tr>                                 
                         <tr>
                            <td>
                            Discusses deviant oral-motor patterns secondary to both oro-facial hypotonia and hypertonia; sensory-based oral feeding aversion; underlying etiologies; and 
                            differential diagnosis.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Differential Diagnosis of Motor vs. Sensory-Based">
                            <input type="hidden" name="item_number" value="v07">
                            <input type="hidden" name="amount" value="40.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                   
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div> 
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                8. Treatment and Transitions for Sensory-Based Feeding Disorders.
                                <span class="sub-title">$65. Intermediate. Runs: 64:41</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Explain the use of "incremental progression" as a treatment strategy.<br>
                            2. Outline the "wheat germ" program.<br>
                            3. Identify clinical signs of sensory-based oral feeding disorder.
                            </td>
                         </tr>                            
                         <tr>
                            <td>
                             Introduction to “Incremental Progression” as a therapeutic intervention strategy for management of sensory-based oral feeding problems. Uses case studies to 
                             outline subtle changes in placement, volume, texture, utensils. Discusses the CHEW program for development of mastication; “Wheat Germ Program” for transition 
                             from pureed foods to solids.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Treatment and Transitions">
                            <input type="hidden" name="item_number" value="v08">
                            <input type="hidden" name="amount" value="65.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                   
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>   
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                9. Gastroesophageal Reflux and Esophageal Dysmotility: ID and Management, Part I.
                                <span class="sub-title">$95. Advanced. Runs: 57:51</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Describe the correlation between gastroesophageal reflux and esophageal dysmotility.<br>
                            2. Conduct a competent clinical (bedside) feeding evaluation.<br>
                            3. Accurately diagnose esophageal phase dysphagia when it is the underlying etiology of an oral feeding disorder.
                            </td>
                         </tr>                                                     
                         <tr>
                            <td>
                             Outlines types of GER; provides examples of relationship between GER/esophageal dsymotility; discusses clinical signs of esophageal dysmotility; view MBS studies.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Gastroesophageal Reflux and Esophageal Dysmotility: ID and Management, Part I">
                            <input type="hidden" name="item_number" value="v09">
                            <input type="hidden" name="amount" value="95.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                   
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>    
                   
                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                10. Gastroesophageal Reflux and Esophageal Dysmotility: ID and Management, Part II (must be taken with #9).
                                <span class="sub-title">$185 (includes #9 and #10). Advanced. Runs: 36:02</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Describe the three types of gastroesophageal reflux.<br>
                            2. Explain esophageal dysmotility and its impact on the transition onto solids.<br>
                            3. Plan effective intervention strategies for progression onto solids.
                            </td>
                         </tr>                                 
                         <tr>
                            <td>
                             Discusses therapeutic management for esophageal phase dysphagia using “Incremental Progression” to implement subtle changes in consistency, volume, bolus size 
                             while insuring adequate caloric intake/weight gain; provides review of underlying etiologies, preferred texture consistencies.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Gastroesophageal Reflux and Esophageal Dysmotility: ID and Management, Talks 9 & 10">
                            <input type="hidden" name="item_number" value="v10">
                            <input type="hidden" name="amount" value="185.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>
          
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>  
                   <div class="item_sep_dots_pink"></div>                                                                             
                                               
                   <div class='items_box' style="height:auto;">
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                11. Weaning from Gastrostomy Tube onto Oral Feeding.
                                <span class="sub-title">$95. Advanced. Runs: 45:30</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. Describe the process of transitioning from continuous drip feeding onto bolus.<br>
                            2. Determine when it is appropriate to implement a 60-hour wean.<br>
                            3. Be able to select the appropriate candidate for weaning.
                            </td>
                         </tr>                               
                         <tr>
                            <td>
                             Discusses the Palmer Protocol for Sensory-Based Weaning in detail; outlines five phases of progression; case studies presented.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                            <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                            <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="item_name" value="Weaning from Gastrostomy Tube onto Oral Feeding">
                            <input type="hidden" name="item_number" value="v11">
                            <input type="hidden" name="amount" value="95.00">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="button_subtype" value="products">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                            <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                            <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </form>                  
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                   <div class='clearAll'></div>   
                 </div><!--end Panel Content-->
              </div><!--end panel-->       
        
           <div class='clearAll'></div> 
           <div class='spacer_26'></div>                                                                                                                                                         


           <!-- SERIES II -->            
           <div class='l_item'>
              <div class="heading">
                <h1>SERIES TWO - (Course of 12 talks)</h1>
                <div class='sub_hed'>"NOMAS<sup>&reg;</sup> International Symposia Talks"</div>         
              </div>
                
              <?php
              if(is_file($nomas_ceu_excerpt)) {
              echo "\n";				
              ?>
                <!--VIDEO-->
                <div style='width:40%;float:left;display:inline;'>
                   <div id='vidBox1'>Please install the Flash Plugin</div>	
                       <script type="text/javascript">
                       <!--
                       jwplayer('vidBox1').setup({
                       'id': 'playerID',
                       'width': '300',
                       'height': '240',
                       'file': '<?php echo $nomas_symp_excerpt; ?>',
                       'image': '<?php echo $nomas_series_2_pic; ?>',
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
                   <!--END VIDEO-->
              <?php   
              }    								
              echo (is_file($nomas_ceu_excerpt)) ? "<div style='width:55%;float:left;display:inline;margin-left:12px;'><div class='reg_text'>" : "<div class='reg_text'>"; 			
              ?>
                                                              
              <span class='bld'>Course Description</span>:<br><br>The 12 talks in this online course focus on the etiology, diagnosis, and treatment of feeding difficulties in the term and 
              preterm infant. Evaluation and treatment strategies for the “difficult to feed” infant both in the NICU or special care nursery are discussed as well as those feeding issues that 
              persist after discharge.<br><br>
              The full course is made up of all 12 talks. Each talk runs about 1 hour. The talks may be viewed for CEU course credit either individually or as a group.
                
              <?php                       
              echo (is_file($nomas_ceu_excerpt)) ? "</div></div><!--end STYLE & reg_text-->" : '</div><!--end reg_text-->'; 			
              ?>       
                
              <div class='clearAll'></div>                   
                
              <div id="series-two" class="CollapsibleCourses">

                <div class="buttons">
                  <div class="btn with-icon CollapsibleCoursesTab" tabindex="0">
                    <span class="icon plus">&plus;</span>
                    View SERIES TWO Courses 
                    <span>Learning Outcomes, and Order Talks</span>
                  </div>
                </div>

                <div class="CollapsibleCoursesContent">
                    <div class='items_box'>
                       <table class='items'>
                          <tr>
                            <td class='hed'><img style='float:left;border:none;margin-right:12px;' src="_grafix/all_12.gif" width="75" height="75" alt="GRAPHIC">
                            SPECIAL - Order all 12 talks in Series Two for <?php echo $price_all_11; ?>!<br><br>
                            Introductory, intermediate and advanced material<br>(Save $45)!
                            </td>
                           </tr>
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="All 12 Courses">
                              <input type="hidden" name="item_number" value="s00">
                              <input type="hidden" name="amount" value="375.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>                            
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                                     
                
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>   
                                                   
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                1. Diseases and medical conditions of the infant that interfere with successful feeding.
                                <span class="sub-title">$35. Intermediate instructional level. Runs: 53:00. CEU: .05</span>
                              </h3>
                            </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/botas-carlos-75.jpg" alt="Botas">
                              <span class='bld'>Course Objectives</span><br>
                              1. Identify infants at high risk for feeding difficulties.<br>
                              2. Identify strategies for supporting successful feedings.<br>
                              3. Identify infants appropriate for referral to a feeding specialist.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Identify infants at risk for feeding difficulties and explain strategies for supporting successful feeding.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Carlos Botas M.D.</span>, Director, Neonatal Services Kaiser Permanente Medical Center; Associate Clinical Professor of Pediatrics, 
                              UC San Francisco School of Medicine. <span class='ital'>Dr. Botas has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Diseases and medical conditions">
                              <input type="hidden" name="item_number" value="s01">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>          
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>  
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                2. Non-nutritive suck (NNS): measurement, context, and use in predicting feeding skills.
                                <span class="sub-title">$35. Advanced instructional level. Runs: 59:30. CEU: .1</span>
                              </h3>
                            </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/bingham-peter-75.jpg" alt="Bingham">
                              <span class='bld'>Course Objectives</span><br>
                              1. Understand rationale for measurement, and tools and validation for measuring non-nutritive suck in the NICU.<br>
                              2. Understand qualitative and quantitative aspects of NNS ontogeny in premature newborns.<br>
                              3. How NNS evaluation relates to feeding performance in light of immediate/contextual factors that influence NNS behavior.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the qualitative and quantitative aspects of NNS ontogeny in premature infants and how these relate to feeding performance.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Peter Bingham M.D. </span>, Associate Professor of Neurology and Pediatrics, University of VT, Burlington, VT. 
                              <span class='ital'>Dr. Bingham has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Non-nutritive suck (NNS)">
                              <input type="hidden" name="item_number" value="s02">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>  
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                3. Maturation of the gastrointestinal tract: when is baby ready to feed?
                                <span class="sub-title">$35. Advanced instructional level. Runs: 44:00. CEU: .05</span>
                              </h3>
                            </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/berseth-carol-lynn-75.jpg" alt="Berseth">
                              <span class='bld'>Course Objectives</span><br>
                              1.  Describe the normal maturation of gastrointestinal motility in the premature.<br>
                              2.  Describe the normal maturation of digestion and absorption in the premature.<br>
                              3.  Describe disorders that impact upon the normal developmental process and interfere with feeding.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the normal maturation of gastrointestinal motility in the premature infant and identify disorders that impact the normal developmental process.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Carol Lynn Berseth, M.D. </span>, Director, Medical Affairs North America, Mead Johnson Nutrition. 
                              <span class='ital'>Dr. Berseth is a salaried employee of Mead Johnson Nutrition and has no nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Maturation of the gastrointestinal tract">
                              <input type="hidden" name="item_number" value="s03">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>   
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  4. Development of self-regulation in the NICU newborn.
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 37:00. CEU:  .05</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/vandenberg-kathleen-75.jpg" alt="VandenBerg">
                              <span class='bld'>Course Objectives</span><br>
                              1. Describe self regulation and identify regulatory behaviors of full term newborns or less mature or premature newborns.<br>
                              2. Describe factors which impact infant self regulation.<br>
                              3. Identify and describe developmental recommendations to facilitate self regulation.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Explain self-regulation in the newborn and describe factors that impact the development of regulatory behaviors.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Kathleen A. VandenBerg, PhD. </span>, Master NIDCAP Trainer; Director, Neurodevelopmental Center Division of Neonatology, Department of 
                              Pediatrics, University of California San Francisco School of Medicine.
                              <span class='ital'>Dr. VandenBerg has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Development of self-regulation">
                              <input type="hidden" name="item_number" value="s04">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>     
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  5. Maturation of the premature infant: sleeping, breathing, and feeding.
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 39:00. CEU:  .05</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/dusick-anna-75.jpg" alt="Dusick">
                              <span class='bld'>Course Objectives</span><br>
                              1. Identify the components of state, breathing, and oral control needed for feeding.<br>
                              2. Correctly identify immature breathing and apnea that will interfere with feeding.<br>
                              3. Identify risk factors for aspiration and how to diagnose aspiration.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the components of state, breathing, and feeding in the premature infant and identify risk factors for aspiration.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Anna Dusick, M.D. </span>, formerly, Medical Director, Waisman Center; Visiting Professor of Pediatrics, University of Wisconsin School of 
                              Medicine and Public Health.
                              <span class='ital'>Dr. Dusick has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Maturation of the premature infant">
                              <input type="hidden" name="item_number" value="s05">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>    
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  6. Cue-based, co-regulated approach to feeding.
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 38:00. CEU: .05</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/thoyre-suzanne-75.jpg" alt="Thoyre">
                              <span class='bld'>Course Objectives</span><br>
                              1. Describe the significance of focused feeding assessment.<br>
                              2. Identify short-term effectiveness of using a co-regulated feeding approach with enhanced auditory assessment.<br>
                              3. Describe the skill of infant oral feeding using a dynamic systems theory framework.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the skill of infant oral feeding using a focused feeding assessment.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Suzanne Thoyre, PhD. </span>, Director, Doctoral and Post-Doctoral Programs; Associate Professor, University of North Carolina, Chapel Hill.
                              <span class='ital'>Dr. Thoyre has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Cue-based, co-regulated approach">
                              <input type="hidden" name="item_number" value="s06">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  7. Kangaroo Care: Science underlying practice and issues of implementation.
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 60:00. CEU: .1</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/helm-james-75.jpg" alt="Helm">
                              <span class='bld'>Course Objectives</span><br>
                              1. Describe the literature that establishes importance of experience on the fetal brain.<br>
                              2. Describe the benefits of kangaroo care for both infants and mothers.<br>
                              3. Discuss the issues associated with early and often kangaroo care in high-tech nurseries.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Explain the benefits of kangaroo care for both infants and mothers.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>James M. Helm, PhD. </span>, Infant Development Specialist, Clinical Assoc. Professor of Pediatrics, Adjunct Assistant Professor Special 
                              Education, University of North Carolina School of Medicine. <span class='ital'>Dr. Helm has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Kangaroo Care">
                              <input type="hidden" name="item_number" value="s07">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div> 
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  8. Effects of cranial shape and pharyngeal arch function in the preterm and high-risk infant.
                                  <span class="sub-title">$35. Advanced instructional level. Runs: 87:00. CEU:  .1</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/chappel-james-75.jpg" alt="Chappel">
                              <span class='bld'>Course Objectives</span><br>
                              1. Appreciate the impact of developmental care-giving on the synactive development of first order neurons and cranial nerves in response to head shape.<br>
                              2. Discuss the neurodevelopmental differences between oral-tracheo and naso-tracheal intubation.<br>
                              3. Plan appropriate care-giving strategies to impact synactive development of the head and neck areas.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the differences between oro-tracheo and naso-tracheal intubation and their impact on early feeding in the context of the synactive development of the head and neck.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>John Chappel, M.A., RPT. </span>, NIDCAP Certified Pediatric Physical Therapist, Morristown Memorial Hospital, Morristown, New Jersey. 
                              <span class='ital'>Mr. Chappel has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>   
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Effects of cranial shape and pharyngeal arch function">
                              <input type="hidden" name="item_number" value="s08">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>

                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  9. Olfaction: the unexplored sense and its relationship to early feeding.
                                  <span class="sub-title">$35. Advanced instructional level. Runs: 68:20. CEU:  .1</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/bingham-peter-75.jpg" alt="Bingham">
                              <span class='bld'>Course Objectives</span><br>
                              1. Review basic neuroanatomy and developmental neurobiology of olfaction.<br>
                              2. Discuss the ways in which odors affect newborn behavior.<br>
                              3. Discuss how knowledge of these effects might contribute to supporting early growth and development of sick newborns.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Explain the ways in which odors may affect newborn feeding performance.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Peter Bingham M.D. </span>, Associate Professor of Neurology and Pediatrics, University of VT, Burlington, VT. 
                              <span class='ital'>Dr. Bingham has no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>    
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Olfaction: the unexplored sense">
                              <input type="hidden" name="item_number" value="s09">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>

                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  10. Feeding in the typical newborn: breast feeding and bottle feeding, Part I
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 66:00. CEU:  .1</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/dusick-anna-75.jpg" alt="Dusick">
                              <span class='bld'>Course Objectives</span><br>
                                1. Describe a typical feeding and the reasons it is efficient.<br>
                                2. Describe how feeding matures for increased intake in the infant.<br>
                                3. Identify problems that can occur with the flow rate of the feeding.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Explain the maturation of feeding skills in the normal newborn.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Anna Dusick, M.D. </span>, formerly, Medical Director, Waisman Center; Visiting Professor of Pediatrics, University of Wisconsin School of 
                              Medicine and Public Health. <span class='ital'>Dr. Dusick had no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>    
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Feeding in the typical newborn">
                              <input type="hidden" name="item_number" value="s10">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  11. Feeding in the atypical newborn: breast feeding and bottle feeding, Part II
                                  <span class="sub-title">$35. Intermediate instructional level. Runs: 63:00. CEU: .1</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/dusick-anna-75.jpg" alt="Dusick">
                              <span class='bld'>Course Objectives</span><br>
                              1. Identify feeding problems that can be unsafe for the infant’s health.<br>
                              2. Identify support to assist oral feeding in the infant with atypical development.<br>
                              3. Explain using tube feedings in the least intrusive and most developmentally helpful manner to support growth in the infant with atypical development.
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Identify feeding problems in the atypical infant and describe the use of supportive interventions that may be used to assist the infant.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Anna Dusick, M.D. </span>, formerly, Medical Director, Waisman Center; Visiting Professor of Pediatrics, University of Wisconsin School of 
                              Medicine and Public Health. <span class='ital'>Dr. Dusick had no financial or nonfinancial relationships to disclose.</span>
                              </td>
                           </tr>    
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Feeding in the atypical newborn">
                              <input type="hidden" name="item_number" value="s11">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                    <div class="item_sep_dots_pink"></div>
                    
                    <div class='items_box'>
                       <table class='items'>
                           <tr>
                              <td class='hed'>
                                <h3 class="course-title">
                                  12. Visceral hyperlgesia and esophageal dysmotility for solids in older infants secondary to gastroesophageal reflux.
                                  <span class="sub-title">$35. Advanced instructional level. Runs: 42:00. CEU:  .05</span>
                                </h3>
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <img style='float:left;margin-right:8px;' src="_grafix/palmer-marjorie-75.jpg" alt="Palmer">
                              <span class='bld'>Course Objectives</span><br>
                              1.  Define characteristics and recognize visceral hyperalgesia in the older infant.<br>
                              2.  Explain correlation between gastroesophageal reflux and visceral hyperalgesia.<br>
                              3.  Understand why the feeding problems of these patients are often mis-diagnosed as “behavioral.”
                              </td>
                           </tr>                            
                           <tr>
                              <td>
                              <span class='bld'>Learning Outcome:</span><br>
                              Describe the characteristics of visceral hyperalgesia and explain why infants with this condition are often mis-diagnosed as having behaviorally based feeding problems.
                              </td>
                           </tr>
                           <tr>
                              <td>
                              <span class='bld'>Marjorie Meyer Palmer, M.A., CCC-SLP</span>, Neonatal/Pediatric Feeding Specialist.
                              <span class='ital'>Ms. Palmer's disclosures can be found in the Series One Talks.</span>
                              </td>
                           </tr>    
                           <tr>
                              <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                              <input type="hidden" name="cmd" value="_cart">
                              <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                              <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
                              <input type="hidden" name="lc" value="US">
                              <input type="hidden" name="item_name" value="Visceral hyperlgesia and esophageal dysmotility">
                              <input type="hidden" name="item_number" value="s12">
                              <input type="hidden" name="amount" value="35.00">
                              <input type="hidden" name="currency_code" value="USD">
                              <input type="hidden" name="button_subtype" value="products">
                              <input type="hidden" name="no_note" value="0">
                              <input type="hidden" name="cn" value="Add special instructions to the seller:">
                              <input type="hidden" name="no_shipping" value="2">
                              <input type="hidden" name="rm" value="1">
                              <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                              <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                              <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
                              <input type="hidden" name="add" value="1">
                              <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>
                              </td>
                           </tr>                               
                       </table>
                    </div><!-- end items_box-->                     
                   
                    <div class='clearAll'></div>  
                     
                 </div><!--end Panel Content-->
              </div><!--end panel-->                                  
           <div class='clearAll'></div> 
           <div class='spacer_26'></div>                    

          <!-- SERIES 3 -->
          <div class='l_item'>
              <div class="heading">
                <h1>SERIES THREE - (Course of 2 talks)</h1>
                <div class='sub_hed'>"Clinics in Pediatric Feeding"</div>
              </div>
              
              <?php
              if(is_file($nomas_ceu_excerpt)) { 
        echo "\n";
              ?>
                 <!--VIDEO-->
                  <div style='width:40%;float:left;display:inline;'>
                     <div id='vidBox3'>Please install the Flash Plugin</div> 
                     <script type="text/javascript">
                     <!--
                     jwplayer('vidBox3').setup({
                     'id': 'playerID',
                     'width': '330',
                     'height': '220',
                     'file': '<?php echo $nomas_cpf_excerpt; ?>',
                     'image': '<?php echo $nomas_cpf_pic; ?>',
                     'skin': '',
                     'controlbar.position': 'bottom',
                     'modes': [     
                        {type: 'html5'},                
                        {type: 'flash', src: '_js/player.swf'}
                     ]
                     });
                     -->
                     </script>
                  </div><!--end vid player-->
                  <!--END VIDEO-->
        <?php   
              }                           
              echo (is_file($nomas_ceu_excerpt)) ? "<div style='width:55%;float:left;display:inline;margin-left:12px;'><div class='reg_text'>" : "<div class='reg_text'>";      
              ?>
                                                            
              <span class='bld'>Course Description</span>:<br><br>
              This series addresses those challenging issues that frequently arise during feeding therapy with
pediatric patients. Such issues include but are not limited to difficulty with the transition from
liquids to pureed foods, an inability to transition onto age appropriate solids, lack of the
development of mastication, and sensory-based feeding aversion. Each clinic addresses a
primary issue and presents one or more case studies with evaluation results and treatment
strategies for the remediation of the primary feeding problem. Other issues may be discussed
that are beyond the scope of the main subject but are important considerations when providing feeding
therapy. These may include issues such as inadequate tongue base retraction, pharyngeal
pooling, gastroesophageal reflux, esophageal dysmotility, and/or a hypersensitive gag resulting
in a sensory-based oral feeding aversion.

              
              <?php                       
              echo (is_file($nomas_ceu_excerpt)) ? "</div></div><!--end STYLE & reg_text-->" : '</div><!--end reg_text-->';       
              ?>                 
              
              <div class='clearAll'></div> 
              
              <div id="series-three" class="CollapsibleCourses">
                <div class="buttons">
                  <div class="btn with-icon CollapsibleCoursesTab" tabindex="0">
                    <span class="icon plus">&plus;</span>
                    View SERIES THREE Courses 
                    <span>Learning Outcomes, and Order Talks</span>
                  </div>
                </div>

                 <div class="CollapsibleCoursesContent"> 
                
                   <div class='half_box_l'>     
                      <ul class="pink">
                         <span class='hed'>Series Three Learning Outcomes:</span>
                         <li>&nbsp;</li>
                         <li class='pink'>List a minimum of three etiologies that underlie a sensory-based oral feeding aversion.</li>
                         <li class='pink'>Identify two characteristics of feeding difficulty that occur during the esophageal phase of swallow.</li>
                         <li class='pink'>Describe three variables that can be modified as part of a feeding program to help a child make the transition from liquids to pureed foods.</li>
                         <li class='pink'>List two oral-motor issues and two oral-sensory issues that interfere with the successful transition from pureed food to solids.</li>
                         <li class='pink'>Explain the Feeding Transition Readiness assessment tool.</li>
                         <li class='pink'>Define three different categories of foods that may be used in a feeding program.</li>
                      </ul>                                                         
                   </div><!-- end half_box_l-->   
                                    
                   <div class='half_box_r'>    
                      <div class='text'>
                         <div class="hed">Presenter: Marjorie Meyer Palmer M.A., CCC-SLP</div><br>
                         <img src="_grafix/palmer-marjorie-80.jpg" width="80" height="80" alt="GRAPHIC"> 
                         <span class="bld">Non-financial disclosure:</span> founder and director of NOMAS<sup>&reg;</sup> International; current member, 
                         the American Academy of Cerebral Palsy and the NIDCAP Federation International.
                         <br><br>
                         <span class="bld">Financial disclosure:</span> Ms. Palmer is financially compensated for teaching live courses on feeding and online continuing education courses 
                         on feeding. She conducts certification courses for the NOMAS<sup>&reg;</sup> and administers the non-exclusive copyright license renewal program 
                         for NOMAS<sup>&reg;</sup> Certified Professionals. She is sole distributor of the "Fantastic Feeding Dropper."
                      </div>   
                   </div><!-- end half_box_r-->   
                   
                   <div class='clearAll'></div>                      
                   <div class="item_sep_dots_pink"></div>   

                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                1. Transition from Liquids to Pureed Food and Beyond. 
                                <span class="sub-title">Cost: $105. Runs: 1 hour. Offered for 0.1 CEUs (Occupational Therapists, and Nurses only).</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. List a minimum of three etiologies that underlie a sensory-based oral feeding aversion.<br>
                            2. Identify two characteristics of feeding difficulty that occur during the esophageal phase of swallow.<br>
                            3. Describe three variables that can be modified as part of a feeding program to help a child make the transition from liquids to pureed foods.
                            </td>
                         </tr>                            
                         <tr>
                            <td>
                            This course focuses on the evaluation and treatment of children 
                            who have not yet been able to transition from liquids to pureed foods. 
                            A therapeutic program is outlined and a checklist is provided for data 
                            collection. Five pages of downloadable handouts are included.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                                <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                                <input type="hidden" name="lc" value="US">
                                <input type="hidden" name="item_name" value="Transition from Liquids to Pureed Food and Beyond">
                                <input type="hidden" name="item_number" value="cpf01">
                                <input type="hidden" name="amount" value="105.00">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="button_subtype" value="products">
                                <input type="hidden" name="no_note" value="0">
                                <input type="hidden" name="cn" value="Add special instructions to the seller:">
                                <input type="hidden" name="no_shipping" value="2">
                                <input type="hidden" name="rm" value="1">                         
                                <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                                <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                                <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">  
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>                    
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>


                   <div class='items_box'>
                      <table class='items'>
                         <tr>
                            <td class='hed'>
                              <h3 class="course-title">
                                2. Transition from Pureed Food to Solids. 
                                <span class="sub-title">Cost: $135. Runs: 2 hours. Offered for 0.2 CEUs (Occupational Therapists, and Nurses only).</span>
                              </h3>
                            </td>
                         </tr>
                         <tr>
                            <td>
                            <span class='bld'>Course Objectives</span><br>
                            1. List two oral-motor issues and two oral-sensory issues that interfere with the successful transition from pureed food to solids.<br>
                            2. Explain the Feeding Transition Readiness assessment tool.<br>
                            3. Define three different categories of foods that may be used in a feeding program.<br>
                            </td>
                         </tr>                            
                         <tr>
                            <td>
                            This course discusses the child who has not yet made the transition from pureed food to solids 
                            and outlines both sensory and motor issues. Treatment strategies are outlined and a Feeding 
                            Transition Readiness tool is explained and included in the five pages of handouts.
                            </td>
                         </tr>
                         <tr>
                            <td class='button'>
                              <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="business" value="4AF3KNQK7BY9C">
                                <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">   
                                <input type="hidden" name="lc" value="US">
                                <input type="hidden" name="item_name" value="Transition from Pureed Food to Solids">
                                <input type="hidden" name="item_number" value="cpf02">
                                <input type="hidden" name="amount" value="135.00">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="button_subtype" value="products">
                                <input type="hidden" name="no_note" value="0">
                                <input type="hidden" name="cn" value="Add special instructions to the seller:">
                                <input type="hidden" name="no_shipping" value="2">
                                <input type="hidden" name="rm" value="1">                         
                                <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
                                <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
                                <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">  
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                              </form>                    
                            </td>
                         </tr>                               
                      </table>
                   </div><!-- end items_box-->                                     
                  
                   <div class='clearAll'></div>


                 </div>
              </div>
			   
			<!-- SERIES IV --> 
           <div class='l_item'>
              <div class="heading">
                <h1>SERIES FOUR - (Course of 6 talks)</h1>
                <div class='sub_hed'>"NOMAS<sup>&reg;</sup> Online Day 1</div>         
              </div>
                 <div style="width:900px; margin:auto; height:auto; padding:5px; display:inline-block; border:1px solid #cccccc; font-family:Verdana, Geneva, sans-serif; font-size:9pt; "><img src="_grafix/asha.jpg" style="width:900px;">
			   <br><br>
			   <span style="font-weight:bold;">ASHA:</span><br>
				This course is offered for .7 ASHA CEUs (Advanced Level, Professional Area).
				<br>
				ASHA does not offer credit for individual talks in this Series. 
				<br>
				For successful completion a quiz must be passed for all 6 talks. To receive ASHA CEUs, the participant must download, fill out, and mail or FAX the CEU Participant Form OR just provide their ASHA Membership Number.<br><br></div> 
              <?php
				/*
				$nomas_series_4_pic = "_grafix/title-excerpt-series-4.jpg";
				$nomas_series_4_video = "_video/Introduction & Disclosures (web).mp4";
				*/
              if(is_file($nomas_series_4_pic )) {
			 //this is looking to see whether a hardcoded variable that points to a resource on the server exists
              echo "\n";				
              ?>
                <!--VIDEO-->
                <div style='width:auto;float:left; margin:10px; display:inline;'>
                   <div id='vidBox4'>Please install the Flash Plugin</div>	
                       <script type="text/javascript">
                       <!--
                       jwplayer('vidBox4').setup({
                       'id': 'playerID',
                       'width': '300',
                       'height': '240',
                       'file': '<?php echo $nomas_series_4_video; ?>',
                       'image': '<?php echo $nomas_series_4_pic ; ?>',
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
                   <!--END VIDEO-->
              <?php   
              }    								
              echo (is_file($nomas_series_4_pic)) ? "<div style='width:100%;'><div class='reg_text'>" : "<div class='reg_text'>"; 			
              ?>
               <br>                                              
              <span class='bld'>Course Description</span>:<br><br>This course provides an opportunity to attend the lecture portion offered to participants in
			the 3-day NOMAS® Certification Course. It will discuss the true nature of neonatal reflexive sucking; the differentiation of subtle movements of the jaw and tongue during active nutritive sucking; the clinical signs of sensory problems during non-nutritive sucking; and how to begin to recognize the characteristics of disorganized and dysfunctional sucking patterns and the way in which they compare to normal. This course will provide six lectures, each of which includes slides, video and five pages of downloadable handouts. The lectures include:<br>
			<br><br>1) Anatomy and Physiology of the Infant Oral Mechanism;<br>
			2) Introduction to the NOMAS® (Neonatal Oral-Motor Assessment Scale);<br>
			3) Differentiation of Normal, Disorganized, and Dysfunctional Sucking with a review of the administration and scoring of the NOMAS®;<br>
			4) A Look at Breastfeeding: similarities and differences between breast and bottle feeding based on the NOMAS<sup>&reg;</sup>;<br>
			5) Sensory Aspects of Neonatal Sucking;<br>
			6) Therapeutic Intervention for the Disorganized and Dysfunctional Feeder;
			<br><br>
			Upon completion of the entire course participants must complete a True/False quiz with 100% accuracy in two attempts and submit it online in order to be granted a Certificate of Completion.
			<br><br>
			Each participant must sign and submit the Letter of Agreement before the course can be made available.
			<br><br>
			This course will be offered for .7 ASHA CEUs. For ASHA you must download, complete and send the ASHA CE Participant form that is available on the website.
			<br><br>
			This course will be offered for .7 AOTA CEUs.
			<br><br>
			This course will be offered for .7 CEUs for the California Board of Registered Nursing.
			<br><br>
			THIS ONLINE COURSE DOES NOT PROVIDE BEDSIDE PRACTICUM IN THE NICU, RELIABILITY TESTING, OR CERTIFICATION AND LICENSING IN THE USE OF THE NOMAS®.
			<br><br>
			Once you have completed this NOMAS® Online: Day 1 course you will be eligible to complete the 3-day Certification Course in one of the following ways:
			<br><br>
			1) register at one of the NOMAS® training sites for just days 2 and 3 of the course for a pro-rated tuition rate;<br>
			2) schedule days 2 and 3 to be held at your NICU with a Licensed NOMAS® Instructor. It is recommended that for this option you have 8-10 people per course;<br>
			3) Sponsor a 3-day NOMAS® Certification Course at your hospital for which you may attend with a full tuition waiver;
			<br><br>
			Please <a name="series_four">contact</a> <a href="mailto:Marjorie@nomasinternational.org" target="_blank">Marjorie@nomasinternational.org</a> for additional information on options listed above.
			<br><br>
			 <div style="width:95% height:auto; padding:10px; margin:auto; text-align:center; background-color:#ffffff; border-radius:10pt; border:1px solid #cccccc; box-shadow:10px 10px 5px #cccccc; font-weight:bold; font-size:10pt;">Don't miss the <a name="nomas_online" style="font-weight:bold; text-decoration:none;">NOMAS&reg;</a> ONLINE: Day 1 related professional articles authored by Marjorie Meyer Palmer. Click on the "View SERIES FOUR Courses" button below!</div>
              <?php                       
              echo (is_file($nomas_series_4_pic)) ? "</div></div><!--end STYLE & reg_text-->" : '</div><!--end reg_text-->'; 			
              ?>       
                
              <div class='clearAll'></div>   	  
                
              <div id="series-four" class="CollapsibleCourses">

                <div class="buttons">
                  <div class="btn with-icon CollapsibleCoursesTab" tabindex="0">
                    <span class="icon plus">&plus;</span>
                    View SERIES FOUR Courses 
                    <span>Learning Outcomes, and Order Talks</span>
                  </div>
                </div>

                <div class="CollapsibleCoursesContent" style="height:auto;">
				  <div class='half_box_l'>   
<ul class="pink">
                         <span class='hed'>Series Four Learning Outcomes:</span>
                         <li>&nbsp;</li>
                         <li class='pink'>Explain anatomy and physiology of the infant oral mechanism.</li>
                         <li class='pink'>Identify the components and types of neonatal sucking;</li>
                         <li class='pink'>Differentiate normal from disorganized and dysfunctional sucking.</li>
                         <li class='pink'>Outline similarities and differences with breast and bottle feeding.</li>
                         <li class='pink'>List three types of sensory feeding problems in the neonate.</li>
                         <li class='pink'>Identify &quot;diagnostic-based&quot; treatment strategies for infants with a 
							disorganized and dysfunctional suck.</li>
                      </ul>     				    
                   </div><!-- end half_box_l-->   
                                    
                   <div class='half_box_r'>    
                      <div class='text'>
                         <div class="hed">Presenter: Marjorie Meyer Palmer M.A., CCC-SLP</div><br>
                         <img src="_grafix/palmer-marjorie-80.jpg" width="80" height="80" alt="GRAPHIC"> 
                         <span class="bld">Non-financial disclosure:</span> founder and director of NOMAS<sup>&reg;</sup> International; current member, 
                         the American Academy of Cerebral Palsy and the NIDCAP Federation International.
                         <br><br>
                         <span class="bld">Financial disclosure:</span> Ms. Palmer is financially compensated for teaching live courses on feeding and online continuing education courses 
                         on feeding. She conducts certification courses for the NOMAS<sup>&reg;</sup> and administers the non-exclusive copyright license renewal program 
                         for NOMAS<sup>&reg;</sup> Certified Professionals. She is sole distributor of the "Fantastic Feeding Dropper."
                      </div>   
                   </div><!-- end half_box_r-->   
                   
                   <div class='clearAll'></div>                      
                   <div class="item_sep_dots_pink"></div>  
				   
                    <div class='items_box'>
						<table class='items' style="width:100%;">
							<tr>
								<td colspan="2">
								<span style="font-weight:bold;">SERIES FOUR - NOMAS<sup></sup> Online: Day 1</span><br><br>
								In an effort to disseminate information and to further educate professionals in the field about neonatal sucking based upon the NOMAS® and the diagnosis of sucking patterns the first day of the 3-day NOMAS® Certification Course will be offered online.
								<br><br>This course does NOT provide the bedside practicum in the NICU or the Reliability  that is required for Certification and NOMAS® Licensure, pre-requisites for the Administration and Scoring of the NOMAS®.*
								<br><br>
								The NOMAS® Online: Day 1 includes slides, videos, and lecture on the following:
								<br><br>
								Anatomy/physiology of the infant oral mechanism;<br>
								Introduction to NOMAS®;<br>
								Administration of NOMAS® and scoring of 9 practice babies on video;<br>
								Sensory aspects of neonatal sucking;<br>
								Similarities/differences between breast and bottle feeding;<br>
								Diagnostic-Based intervention strategies for infants with a disorganized and dysfunctional suck;
								<br><br>
								PARTICIPANTS WHO COMPLETE ONLY THE NOMAS® ONE DAY ONLINE COURSE ARE NOT QUALIFIED TO USE THE NOMAS® FOR THE DIAGNOSIS OF NEONATAL SUCKING PATTERNS<sup>*</sup>
								<br><br>
								<sup>*</sup>In order to obtain Reliability and Licensure in the Administration and Scoring of the NOMAS® a participant will be required to schedule two days in their NICU for a Licensed NOMAS®Instructor to conduct the bedside practicum and reliability.  This may be scheduled with each participant individually and can accommodate up to four participants at bedside who have completed the NOMAS® ONLINE: DAY ONE Course. Participants may also make arrangements to attend a previously scheduled NOMAS® Certification Course.
								</td>
							</tr>
							<tr id="purchase_button">
								<td colspan="2"><div style="width:525px; background-color:black; margin:auto; color:#ffffff; border-radius:10pt; height:auto; 
								padding:10px; text-align:center; box-shadow:5px 5px 8px #cccccc;">
								To purchase, the &quot;SERIES FOUR - NOMAS® Online Day 1 course,&quot; click <a href="#series_four" onclick="display_letter()" style="color:#ffffff; text-decoration:underline;">here</a></div></td>
							</tr>
							<tr id="series_four_button" style="display:none;">
								<td colspan="2">
									<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="business" value="4AF3KNQK7BY9C">
									<input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
									<input type="hidden" name="lc" value="US">
									<input type="hidden" name="item_name" value="SERIES 4: NOMAS ONLINE: Day 1">
									<input type="hidden" name="item_number" value="n01">
									<input type="hidden" name="amount" value="425.00">
									<input type="hidden" name="currency_code" value="USD">
									<input type="hidden" name="button_subtype" value="products">
									<input type="hidden" name="no_note" value="0">
									<input type="hidden" name="cn" value="Add special instructions to the seller:">
									<input type="hidden" name="no_shipping" value="2">
									<input type="hidden" name="rm" value="1">
									<input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
									<input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
									<input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
									<input type="hidden" name="add" value="1">
									<input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
									<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</form>                           
								</td>
							</tr> 
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td colspan="2"><span style="font-weight:bold;">NOMAS® ONLINE: Day 1 related professional articles authored by Marjorie Meyer Palmer </span><br><br>
								NOMAS® ONLINE: Day 1 related professional articles available for download in pdf format when purchased by placing order in the cart. 
								<br><br>Please specify the email address to which the pdf file should be sent. Check articles selected.
								<br><br>
								$10.00 per article; $25.00 for any three articles; $60.00 for all eight articles.
								</td>
							</tr>
							<tr>
								<td>
								<div id="avail1">
								<input type="checkbox" class="article_checkbox"><span class="article_span">1. Developmental continuum of neonatal sucking performance based on the NOMAS®. Developmental Observer. 2015. Volume 8, No. 1, p. 11-15.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">2. Developmental outcome for neonates with dysfunction and disorganized sucking patterns: preliminary findings. Infant-Toddler Intervention; The Transdisciplinary Journal. 1999, Vol. 9, No. 3, p. 299-308.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">3. A closer look at neonatal sucking. Neonatal Network. March 1998. Vol. 17, No. 2, p. 77-79.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">4. Weaning from gastrostomy tube feeding: commentary on oral aversion. Pediatric Nursing. Sept-Oct. 1998, Vol. 23, No. 5, p. 475-478.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">5. Identification and Management of the transitional suck pattern in premature infants. Journal of Perinatal and Neonatal Nursing. 1993. Vol. 7, No. 1., p. 66-75.</span><br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">6. The Neonatal Oral-Motor Assessment Scale: A Reliability Study. Journal of Perinatology. 1993. Vol. 13, No. 1., p. 28-35.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">7. Assessment and treatment of sensory versus motor-based feeding problems in very young children, Infants and Young Children. October 1993, 6(2), p. 67-73.</span>
								<br><br>
								<input type="checkbox" class="article_checkbox"><span class="article_span">8. A pilot study of oral-motor dysfunction in “at-risk” infants. Physical and Occupational Therapy in Pediatrics. Winter 1985/1986, Vol. 5 (4). P. 13-25.</span>
								</div>
								<br>
								<div style="width:85%; height:auto; padding:5px; font-weight:bold; text-align:center; margin:auto; border:1px solid #cccccc; border-radius:10pt;"><i>Put a check mark alongside each of the articles you're interested in purchasing and then click on the button below to view the items you're getting ready to order as well as the combined price. Once you're satisfied with what you've selected, click on the yellow "add to cart" button to add your items to your shopping cart.</div>
								<br>
								<button onclick="orderArticles()" style="width:250px; background-color:black; color:#ffffff; border-radius:10pt; height:auto; 
								padding:10px; text-align:center; box-shadow:5px 5px 8px #cccccc;">To view selected articles, click here</button>
								</td>
							</tr>
							<tr>
								<td>
								<span style="font-weight:bold;">Selected Articles and Total Cost...</span>
								<div id="ordered" style="border:1px solid #cccccc; height:465px; width:auto; padding:5px;"></div>
								</td>
							</tr>
							<tr>
								<td class='button'>
									  <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
									  <input type="hidden" name="cmd" value="_cart">
									  <input type="hidden" name="business" value="4AF3KNQK7BY9C">
									  <input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
									  <input type="hidden" name="lc" value="US">
									  <input type="hidden" name="item_name" id="hidden_title_field">
									  <input type="hidden" name="item_number" id="the_item_number">
									  <input type="hidden" name="amount" id="hidden_cost_field">
									  <input type="hidden" name="currency_code" value="USD">
									  <input type="hidden" name="button_subtype" value="products">
									  <input type="hidden" name="no_note" value="0">
									  <input type="hidden" name="cn" value="Add special instructions to the seller:">
									  <input type="hidden" name="no_shipping" value="2">
									  <input type="hidden" name="rm" value="1">
									  <input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
									  <input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
									  <input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
									  <input type="hidden" name="add" value="1">
									  <input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
									  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									  </form>
								 </td>       
							</tr>
							<tr>
								<td>
									<div id="hidden_cost_field"></div>
								</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td>
								<br>
								<span style="font-weight:bold;">"Feeding in the NICU", Chapter Five of the book, <span style="font-style:italic;">Effective SLP Interventions for Children with Cerebral Palsy</span></span>
								<br><br>
								"Feeding in the NICU" - authored by Marjorie Palmer, this is chapter five of the book <span style="font-style:italic;">Effective SLP Interventions for Children with Cerebral Palsy</span> (Plural Publishing, 2014. Chapter 5. P. 131-163) - Book Chapter available for $25.00 per pdf file
								</td>
							</tr>
							<tr>
								<td colspan="2">
								<tr>
								<td colspan="2">
									<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" >
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="business" value="4AF3KNQK7BY9C">
									<input type="hidden" name="invoice" value="<?php echo $orderno; ?>">
									<input type="hidden" name="lc" value="US">
									<input type="hidden" name="item_name" value="Feeding in the NICU Chapter pdf">
									<input type="hidden" name="item_number" value="p14">
									<input type="hidden" name="amount" value="1.00">
									<input type="hidden" name="currency_code" value="USD">
									<input type="hidden" name="button_subtype" value="products">
									<input type="hidden" name="no_note" value="0">
									<input type="hidden" name="cn" value="Add special instructions to the seller:">
									<input type="hidden" name="no_shipping" value="2">
									<input type="hidden" name="rm" value="1">
									<input type="hidden" name="return" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipnret.php">
									<input type="hidden" name="cancel_return" value="http://www.nomasinternational.org/ceu_0001.php">
									<input type="hidden" name="notify_url" value="http://www.nomasinternational.org/_vibralogix/vibralinklokipn/linklokipn.php">
									<input type="hidden" name="add" value="1">
									<input type="hidden" name="bn" value="PP-ShopCartBF:btn_cart_SM.gif:NonHosted">
									<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</form>                           
								</td>
							</tr> 
							<tr>
								<td colspan="2"></td>
							</tr>
						</table><br><br>
                    </div><!-- end items_box-->                                     
                <br><br>
                    <div class='clearAll'></div>  
                     
                 </div><!--end Panel Content-->
              </div><!--end panel-->   
              
              <div class='tiny_text_box'>
                 <div class='tiny_text'>
                 <span class='bld'>AOTA - Target Audience, Occupational Therapists:</span><br><br>
                 The <span style="font-weight:bold;">Series One</span> course is offered for .85 CEUs (8.5 Contact Hours) for successful completion (quizzes passed) of the full course. .15 CEUs (1.5 Contact Hours) is granted for successful completion (quizzes passed) of any two talks. 
				 <br><br>
				 The <span style="font-weight:bold;">Series Two</span> course is approved for .9 CEUs (1 contact hour is granted for successful completion (quizzes passed) of any two talks less than one (1) hour in length. Total course of all 12 talks is 9 contact hours (quizzes passed). 
				 <br><br>
				 <span style="font-weight:bold;">Series Three</span> is offered for up to 0.3 CEUs (up to 3 contact hours). For successful completion a quiz must be taken at the end of each course.
				 <br><br>
				 <span style="font-weight:bold;">Series Four</span> is offered for .7 ASHA CEUs. For successful completion one quiz must be taken at the end of this course which consists of six separate talks. 
				 <br><br>
				 AOTA does not endorse specific course content, products, or clinical procedures. Provider #6555.
                 </div>
              </div>
              
              <div class='tiny_text_box'>
                 <div class='tiny_text'>
                 <span class='bld'>California Board of Registered Nursing:</span><br><br>
                 The <span style="font-weight:bold;">Series One</span> course is offered for .85 CEUs (8.5 Contact Hours) for successful completion of the full course. 
                 .15 CEUs (1.5 Contact Hours) is granted for successful completion of any two talks. Provider #CEP 13879.
				 <br><br>
				 The <span style="font-weight:bold;">Series Two</span> courses approved for .9 CEUs (1 contact hour is granted for successful completion of any two talks less than one (1) hour in length. Total course of all 12 talks is 9 contact hours. Provider #CEP 13879.
				 <br><br>
				  <span style="font-weight:bold;">Series Three</span> is offered for up to 0.3 CEUs (up to 3 contact hours). For successful completion a quiz must be taken at the end of each course. Provider #CEP 13879.
				  <br><br>
				  <span style="font-weight:bold;">Series Four</span> is offered for .7 ASHA CEUs. For successful completion one quiz must be taken at the end of this course which consists of six separate talks. There is no continuing education credit awarded for single talks. Provider #CEP 13879.
                 </div>
              </div>  			  
           <div class='spacer_26'></div>
		   <!-- refund note-->
           <div class='refund_box'>
              <div class='refund_text'>
                 <span class='refund_bld'>REFUNDS:</span> 
                 <a href='contact.php'>Refunds may be requested</a> for any reason but only if the course for which a refund is sought has not been accessed. 
                 A course is considered "accessed" when an initial login has been performed.<br><br>
                 <span class='refund_bld'>ACCESS PERIODS:</span> Customers are reminded that courses must be accessed (initial login performed) within seven consecutive days of purchase. 
                 Once accessed, courses must be completed within another period of seven consecutive days following the initial access.<br><br>                 
                 <span class='refund_bld'>DISCONTINUATION:</span> Courses offered on this website do not expire. If visibly for sale on this site, courses are viable for their access periods.
              </div><!--end tiny_text-->                   
           </div><!--end tiny_text_box-->
			 <div class='spacer_26'></div>
           <!-- CEU CREDITS -->
           <div class='l_item ceu-section'>   
              <div class="heading">
                <h1>ASHA CEU Credits</h1>
                <div class='sub_hed'>Form download and submission information</div>         
              </div>

               <div id="CEUs" class="CollapsibleCourses">
                  <div class="buttons">
                    <div class="btn alt with-icon CollapsibleCoursesTab" tabindex="0">
                      <span class="icon plus">&plus;</span>  
                      Download / Submit ASHA CEU Application Form
                      <span>MUST be submitted to receive ASHA CEU credits.</span>
                    </div>
                  </div>

                  <div class="CollapsibleCoursesContent"> 
                     <div class='reg_text'>
                       <br>
                       <h2>ASHA CEU Application Form</h2>
                       <br>The ASHA CEU Participant form is in PDF format. Adobe Reader is required to view and print the form. 
                       If you do not have Reader on your computer, it is available as a 
                       <a href="http://get.adobe.com/reader/" target="_blank">quick download</a>, 
                       free of charge, from Adobe software.<br><br>
                       INSTRUCTIONS:<br>
                       <span class="download-text"><a href="<?php echo $ashaCeuForm; ?>"><img style='height:20px; width:20px;' src='_grafix/icon_pdf.png'> Download the ASHA CEU FORM</a>.</span><br>
                       Print, fill-out and fax completed form to: 831-623-9007 OR mail form to:<br><br>
                       Therapeutic Media<br>1528 Merrill Road<br>
                       San Juan Bautusta, CA 95045-9602.<br><br>
                       Therapeutic Media will forward completed forms to ASHA along with course results. 
                       <span style='font-weight:bold'>ASHA CEU credit will not be given unless the CEU form is completed and submitted</span>.<br><br>
                     </div><!--end reg_text-->
                  </div><!--end Content-->
               </div><!--end panel-->    
           </div><!-- end l_item-->       

            
      <!-- FEEDING DROPPER -->  
      
      <div id="dropper" class="l_item">

        <div class="dropper-content"> 
           <div class='items_box'>
              
		   <br><br>
		   <div style="width:95% height:auto; padding:10px; margin:auto; text-align:center; background-color:#ffffff; border-radius:10pt; border:1px solid #cccccc; box-shadow:10px 10px 5px #cccccc; font-weight:bold; font-size:10pt;">Don't miss the NOMAS&reg; ONLINE: Day 1 related professional articles authored by Marjorie Meyer Palmer. Click <a href="#nomas_online" style="font-weight:bold; text-decoration:none;">here</a> to learn more!</div>
           </div><!-- end items_box-->                     
       
           <div class='clearAll'></div>
         
           </div><!--end Content-->
        </div><!--end panel-->    

       <div class='clearAll'></div>                      
       <div class='spacer_26'></div>                                             
          
       </div><!--end column_left_wide-->    
       <div class='clearAll'></div>

   </div> <!-- end nomas_content  -->  
  
   <!--FOOTER-->
   <div id="footer"> 
      <?php showBottomMenu(); showCopyright($thisYear); ?>
   </div><!-- end footer -->
 
   <div class='clearAll'></div>

</div><!-- end #playround -->

<script type="text/javascript">

// Enable to process payments at testing sandbox
//var usesandbox = true;

// Expand / Collapse Areas
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("series-one",{ contentIsOpen:false });
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("series-two",{ contentIsOpen:false });
var CollapsiblePanel3 = new Spry.Widget.CollapsiblePanel("series-three",{ contentIsOpen:false });
var CollapsiblePanel4 = new Spry.Widget.CollapsiblePanel("CEUs",{ contentIsOpen:false });
var CollapsiblePanel5 = new Spry.Widget.CollapsiblePanel("dropper",{ contentIsOpen:true });
var CollapsiblePanel6 = new Spry.Widget.CollapsiblePanel("series-four",{ contentIsOpen:false });

// Start JS Cart
startcart();

function display_letter() {
		document.getElementById('tc_background').style.display='block';
		document.getElementById('tc_header').style.display='block';
}	

function series_four_button_display() {
	document.getElementById('tc_background').style.display='none';
	document.getElementById('tc_header').style.display='none';
	document.getElementById('series_four_button').style.display='block';
	document.getElementById('purchase_button').style.display='none';
}

function popup_close() {
	document.getElementById('tc_background').style.display='none';
	document.getElementById('tc_header').style.display='none';
	//document.getElementById('purchase_button').style.cssText="display:block; margin:auto;";
}

function orderArticles()
{
	//alert("Button Click");
	
	var cks = document.getElementsByClassName("article_checkbox"),
	sns = document.getElementsByClassName("article_span"),
	cart=[],
	cart_desc=[],
	cost=0,
	out1='';
	item_number='';
	ordered_title='';
	the_ordered_title='';
	slice='';
	
	for (var c=0;c<cks.length;++c) 
	{
		if(cks[c].checked) 
		{
			//cart.push(sns[c].innerHTML.substr(0, 1));
			cart.push(sns[c].innerHTML);
			cart_desc.push(sns[c].innerHTML.substr(0, 1));
		}
	}
	
	if(!cart.length)
	{
		alert("No Items Checked, NO ORDER"); 
		return
	}
	
	switch(cart.length) 
	{
	  case 8: cost=1, item_number="p13"; break;
	  case 7: cost=70, item_number="p12"; break;
	  case 6: cost=60, item_number="p11"; break;
	  case 5: cost=50, item_number="p10"; break;
	  case 4: cost=40, item_number="p09"; break;
	  case 3: cost=25, item_number="p08"; break;
	  case 2: cost=20, item_number="p07"; break;
	  case 1: cost=10, item_number="p06"; break;
	  default: cost=0, item_number="";
	}
	  
	if(!cost)
	{
		alert("No Items Checked, NO ORDER"); 
		return
	}

	//out1 += "<b>Your Total Cost for "+cart.length+" Articles is $"+cost+".00</b><br />Articles Ordered -<p>";
	out1="<br>";
	
	for (c=0;c<cart.length;++c) 
	{
		out1 +=cart[c]+"<br><br>";
		ordered_title +=cart_desc[c]+", ";
	}
	
	//clean up the tail end of ordered_title
	var slice = ordered_title.slice(0, -2);
	if(slice.length>1)
	{
		var the_ordered_title= "articles " + slice;
	}
	else
	{
		var the_ordered_title="article " + slice;
	}
	
	out1 += "<span style=\"font-weight:bold;\">Your Total Cost for "+cart.length+" Articles is $"+cost+".00</span><br><br>";
	out1 += "<div style=\"margin:auto; text-align:center; color:#ffffff; width:auto; height:auto; background-color:#000000; border-radius:5pt; padding:5px;\">To add your selections to your Shopping Cart, click on the yellow \"Add to Cart\" button below</div>"

	document.getElementById("ordered").innerHTML = out1;

	document.getElementById("the_item_number").value = item_number; //this is the item number that's based on the number of articles that were selected
	/*this is the description the customer will see that displays all of the articles they've ordered as well as the "special instructions" that will cue the administrator as far as what articles need to be emailed to the customer*/
	document.getElementById("hidden_title_field").value = the_ordered_title;
	document.getElementById("hidden_cost_field").value = cost; //this is the cost and any discount that might be justified
}

</script>
</body>
</html>