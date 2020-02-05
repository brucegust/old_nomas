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
       <div id='column_left_wide'>
       
          <div class='l_item'>
             <div class='reg_text_serif'>
                Welcome! These online courses focus on evaluation, treatment and therapeutic intervention in the NICU  for neonates and subsequently for  older infants and children who present 
                with feeding disorders.<br><br>
                Individuals who provide services to these patients may come from a variety of educational and professional backgrounds but all have one goal in common: to resolve oral, 
                pharyngeal, and esophageal phase swallowing and feeding disorders in the neonatal and pediatric populations. These courses are designed to help you meet that goal.
             </div>   
          </div><!--end l_item-->
          
          <div class='item_sep_dots'></div>
       
			<!-- SERIES IV --> 
           <div class='l_item'>
              <div class="heading">
                <h1>SERIES FOUR - (Course of 6 talks)</h1>
                <div class='sub_hed'>"NOMAS<sup>&reg;</sup> Online Day 1</div>         
              </div>
               <div style="width:900px; margin:auto; height:auto; padding:5px; display:inline-block; border:1px solid #cccccc; font-family:Verdana, Geneva, sans-serif; font-size:9pt; "><img src="_grafix/asha.jpg" style="width:900px;">
			   <br><br>
			   <span style="font-weight:bold;">ASHA:</span><br>
				This course is offered for 7 ASHA CEUs (7 Contact Hours) (Advanced Level, Professional Area) for successful completion of the 
				full course of 6 talks. ASHA does not offer credit for individual talks in this Series. 
				<br><br>
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
                <div style='width:auto;float:right; margin:10px; display:inline;'>
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
              <br><span class='bld'>Course Description</span>:<br><br>This course provides an opportunity to attend the lecture portion offered to participants in
			the 3-day NOMAS® Certification Course. It will discuss the true nature of neonatal reflexive sucking; the differentiation of subtle movements of the jaw and tongue during active nutritive sucking; the clinical signs of sensory problems during non-nutritive sucking; and how to begin to recognize the characteristics of disorganized and dysfunctional sucking patterns and the way in which they compare to normal. This course will provide six lectures, each of which includes slides, video and five pages of downloadable handouts. The lectures include:
			<br><br>1) Anatomy and Physiology of the Infant Oral Mechanism;<br>
			2) Introduction to the NOMAS<sup>&reg;</sup> (Neonatal Oral-Motor Assessment Scale);<br>
			3) Differentiation of Normal, Disorganized, and Dysfunctional Sucking with a review of the administration and scoring of the NOMAS<sup>&reg;</sup>;<br>
			4) A Look at Breastfeeding: similarities and differences between breast and bottle feeding based on the NOMAS<sup>&reg;</sup>;<br>
			5) Sensory Aspects of Neonatal Sucking;<br>
			6) Therapeutic Intervention for the Disorganized and Dysfunctional Feeder
			<br><br>
			Upon completion of the entire course participants must complete a True/False quiz with 100% accuracy in two attempts and submit it online in order to be granted a Certificate of Completion.
			<br><br>
			Each participant must sign and submit the Letter of Agreement before the course can be made available.
			<br><br>
			This course will be offered for _____AOTA CEUs.
			<br><br>
			This course will be offered for _____CEUs for the California Board of Registered Nursing.
			<br><br>
			THIS ONLINE COURSE DOES NOT PROVIDE BEDSIDE PRACTICUM IN THE NICU, RELIABILITY TESTING, OR CERTIFICATION AND LICENSING IN THE USE OF THE NOMA<sup>&reg;</sup>.
			<br><br>
			Once you have completed this NOMAS<sup>&reg;</sup> Online: Day 1 course you will be eligible to complete the 3-day Certification Course in one of the following ways:
			<br><br>
			1) register at one of the NOMAS® training sites for just days 2 and 3 of the course for a pro-rated tuition rate;<br>
			2) schedule days 2 and 3 to be held at your NICU with a Licensed NOMAS® Instructor. It is recommended that for this option you have 8-10 people per course.<br>
			3) Sponsor a 3-day NOMA<sup>&reg;</sup> Certification Course at your hospital for which you may attend with a full tuition waiver.
			<br><br>
			Please <a name="series_four">contact</a> <a href="mailto:Marjorie@nomasinternational.org" target="_blank">Marjorie@nomasinternational.org</a> for additional information on options listed above.
              <?php                       
              echo (is_file($nomas_series_4_pic)) ? "</div></div><!--end STYLE & reg_text-->" : '</div><!--end reg_text-->'; 			
              ?>       
                <br>
              <div class='clearAll'></div>   	  
				
                    <div class='items_box'>
						<table class='items' style="width:100%;">
							<tr>
								<td colspan="2">
								<span style="font-weight:bold;">SERIES FOUR - NOMAS<sup>&reg;</sup> Online: Day 1</span><br><br>
								In an effort to disseminate information and to further educate professionals in the field about neonatal sucking based upon the NOMAS® and the diagnosis of sucking patterns the first day of the 3-day NOMAS<sup>&reg;</sup> Certification Course will be offered online.
								<br><br>This course does NOT provide the bedside practicum in the NICU or the Reliability  that is required for Certification and NOMAS® Licensure, pre-requisites for the Administration and Scoring of the NOMAS<sup>&reg;</sup>.*
								<br><br>
								The NOMAS<sup>&reg;</sup> Online: Day 1 includes slides, videos, and lecture on the following:
								<br><br>
								Anatomy/physiology of the infant oral mechanism
								Introduction to NOMAS<sup>&reg;</sup>
								Administration of NOMAS<sup>&reg;</sup> and scoring of 9 practice babies on video
								Sensory aspects of neonatal sucking
								Similarities/differences between breast and bottle feeding
								Diagnostic-Based intervention strategies for infants with a disorganized and dysfunctional suck
								<br><br>
								PARTICIPANTS WHO COMPLETE ONLY THE NOMAS<sup>&reg;</sup> ONE DAY ONLINE COURSE ARE NOT QUALIFIED TO USE THE NOMAS<sup>&reg;</sup> FOR THE DIAGNOSIS OF NEONATAL SUCKING PATTERNS<sup>*</sup>
								<br><br>
								<sup>*</sup>In order to obtain Reliability and Licensure in the Administration and Scoring of the NOMAS<sup>&reg;</sup> a participant will be required to schedule two days in their NICU for a Licensed NOMAS<sup>&reg;</sup>Instructor to conduct the bedside practicum and reliability.  This may be scheduled with each participant individually and can accommodate up to four participants at bedside who have completed the NOMAS<sup>&reg;</sup> ONLINE: DAY ONE Course. Participants may also make arrangements to attend a previously scheduled NOMAS<sup>&reg;</sup> Certification Course.
								<br><br>
								<div style="width:100%; text-align:center; height:auto; display:inline-block">
									<div style="background-color:#000000; color:#ffffff; height:`5px; width:250px ;padding:10px; border-radius:10pt; text-align:center; display:inline-block;">click <a href="http://www.nomasinternational.org/olceu/olceu_pdf/online_day_one.pdf" target="_blank" style="color:#ffffff; text-decoration:underline;">here</a> to view the Course Handouts.</div>&nbsp;&nbsp;<div style="background-color:#000000; color:#ffffff; height:`5px; width:250px ;padding:10px; border-radius:10pt; text-align:center; display:inline-block;">click <a href="http://www.nomasinternational.org/olceu/series_four_video.php" target="_blank" style="color:#ffffff; text-decoration:underline;">here</a> to view the Course Video.</div>&nbsp;&nbsp;<div style="background-color:#000000; color:#ffffff; height:`5px; width:250px ;padding:10px; border-radius:10pt; text-align:center; display:inline-block;">click <a href="http://www.nomasinternational.org/olceu/_docs/ONLINE_quiz.pdf" target="_blank" style="color:#ffffff; text-decoration:underline;">here</a> to view the Course Quiz.</div>
								</div>
								</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td colspan="2"></td>
							</tr>
						</table><br><br>
                    </div><!-- end items_box-->                                     
                <br><br>
           </div><!--end Content-->
        </div><!--end panel-->    

       <div class='clearAll'></div>                      
       <div class='spacer_26'></div>                                             
          
       </div><!--end column_left_wide-->    

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
	  case 8: cost=1, item_number="day1a8"; break;
	  case 7: cost=70, item_number="day1a7"; break;
	  case 6: cost=60, item_number="day1a6"; break;
	  case 5: cost=50, item_number="day1a5"; break;
	  case 4: cost=40, item_number="day1a4"; break;
	  case 3: cost=25, item_number="day1a3"; break;
	  case 2: cost=20, item_number="day1a2"; break;
	  case 1: cost=10, item_number="day1a1"; break;
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