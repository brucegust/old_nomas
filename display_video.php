<?php
if($_GET['video']==1)
{
	$video_file="video_1.mp4";
	$video_title="VIDEO #1";
	$group="FLACCID";
}
	elseif($_GET['video']==2)
	{
		$video_file="video_2.mp4";
		$video_title="VIDEO #2";
		$group="FLACCID";
	}
	elseif($_GET['video']==3)
	{
		$video_file="video_3.mp4";
		$video_title="VIDEO #3";
		$group="FLACCID";
	}
	elseif($_GET['video']==4)
	{
		$video_file="video_4.mp4";
		$video_title="VIDEO #4";
		$group="FLACCID";
	}
	elseif($_GET['video']==5)
	{
		$video_file="video_5.mp4";
		$video_title="VIDEO #5";
		$group="FLACCID";
	}
	elseif($_GET['video']==6)
	{
		$video_file="video_6.mp4";
		$video_title="VIDEO #6";
		$group="FLACCID";
	}
	elseif($_GET['video']==7)
	{
		$video_file="video_7.mp4";
		$video_title="VIDEO #7";
		$group="FLACCID";
	}
	elseif($_GET['video']==8)
	{
		$video_file="video_8.mp4";
		$video_title="VIDEO #8";
		$group="FLACCID";
	}
	elseif($_GET['video']==9)
	{
		$video_file="video_9.mp4";
		$video_title="VIDEO #9";
		$group="FLACCID";
	}
	elseif($_GET['video']==10)
	{
		$video_file="video_10.mp4";
		$video_title="VIDEO #10";
		$group="FLACCID";
	}
	elseif($_GET['video']==11)
	{
		$video_file="video_11.mp4";
		$video_title="VIDEO #1";
		$group="RETRACTED";
	}
	elseif($_GET['video']==12)
	{
		$video_file="video_12.mp4";
		$video_title="VIDEO #2";
		$group="RETRACTED";
	}
	elseif($_GET['video']==13)
	{
		$video_file="video_13.mp4";
		$video_title="VIDEO #3";
		$group="RETRACTED";
	}
	elseif($_GET['video']==14)
	{
		$video_file="video_14.mp4";
		$video_title="VIDEO #4";
		$group="RETRACTED";
	}
	elseif($_GET['video']==15)
	{
		$video_file="video_15.mp4";
		$video_title="VIDEO #5";
		$group="RETRACTED";
	}
	elseif($_GET['video']==16)
	{
		$video_file="video_16.mp4";
		$video_title="VIDEO #6";
		$group="RETRACTED";
	}
	elseif($_GET['video']==17)
	{
		$video_file="video_17.mp4";
		$video_title="VIDEO #7";
		$group="RETRACTED";
	}
	elseif($_GET['video']==18)
	{
		$video_file="video_18.mp4";
		$video_title="VIDEO #8";
		$group="RETRACTED";
	}
	elseif($_GET['video']==19)
	{
		$video_file="video_9.mp4";
		$video_title="VIDEO #9";
		$group="RETRACTED";
	}
	elseif($_GET['video']==20)
	{
		$video_file="video_20.mp4";
		$video_title="VIDEO #10";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="flaccid")
	{
		$video_title="Flaccid Video 1 of 10";
		$video_file="video_1.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_2";
		$video_link_back="";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_2")
	{
		$video_title="Flaccid Video 2 of 10";
		$video_file="video_2.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_3";
		$video_link_back="flaccid";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_3")
	{
		$video_title="Flaccid Video 3 of 10";
		$video_file="video_3.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_4";
		$video_link_back="flaccid_2";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_4")
	{
		$video_title="Flaccid Video 4 of 10";
		$video_file="video_4.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_5";
		$video_link_back="flaccid_3";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_5")
	{
		$video_title="Flaccid Video 5 of 10";
		$video_file="video_5.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_6";
		$video_link_back="flaccid_4";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_6")
	{
		$video_title="Flaccid Video 6 of 10";
		$video_file="video_6.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_7";
		$video_link_back="flaccid_5";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_7")
	{
		$video_title="Flaccid Video 7 of 10";
		$video_file="video_7.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_8";
		$video_link_back="flaccid_6";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_8")
	{
		$video_title="Flaccid Video 8 of 10";
		$video_file="video_8.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_9";
		$video_link_back="flaccid_7";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_9")
	{
		$video_title="Flaccid Video 9 of 10";
		$video_file="video_9.mp4";
		$video_text="Flaccid";
		$video_link_forward="flaccid_10";
		$video_link_back="flaccid_8";
		$group="FLACCID";
	}
	elseif($_GET['video']=="flaccid_10")
	{
		$video_title="Flaccid Video 10 of 10";
		$video_file="video_10.mp4";
		$video_text="Flaccid";
		$video_link_forward="";
		$video_link_back="flaccid_9";
		$group="FLACCID";
	}
	elseif($_GET['video']=="retracted")
	{
		$video_title="Retracted Video 1 of 10";
		$video_file="video_11.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_2";
		$video_link_back="";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_2")
	{
		$video_title="Retracted Video 2 of 10";
		$video_file="video_12.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_3";
		$video_link_back="retracted";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_3")
	{
		$video_title="Retracted Video 3 of 10";
		$video_file="video_13.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_4";
		$video_link_back="retracted_2";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_4")
	{
		$video_title="Retracted Video 4 of 10";
		$video_file="video_14.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_5";
		$video_link_back="retracted_3";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_5")
	{
		$video_title="Retracted Video 5 of 10";
		$video_file="video_15.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_6";
		$video_link_back="retracted_4";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_6")
	{
		$video_title="Retracted Video 6 of 10";
		$video_file="video_16.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_7";
		$video_link_back="retracted_5";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_7")
	{
		$video_title="Retracted Video 7 of 10";
		$video_file="video_17.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_8";
		$video_link_back="retracted_6";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_8")
	{
		$video_title="Retracted Video 8 of 10";
		$video_file="video_18.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_9";
		$video_link_back="retracted_7";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_9")
	{
		$video_title="Retracted Video 9 of 10";
		$video_file="video_19.mp4";
		$video_text="Retracted";
		$video_link_forward="retracted_10";
		$video_link_back="retracted_8";
		$group="RETRACTED";
	}
	elseif($_GET['video']=="retracted_10")
	{
		$video_title="Retracted Video 10 of 10";
		$video_file="video_20.mp4";
		$video_text="Retracted";
		$video_link_forward="";
		$video_link_back="retracted_9";
		$group="RETRACTED";
	}
	
	
else
{
	$video_file="";
	$video_title="";
}

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
<link href="_vibralogix/vibracart/vibracartstyle1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="_vibralogix/vibracart/settingsstyle1.js"></script>
<script type="text/javascript" src="_vibralogix/vibracart/sarissa.js"></script>
<script type="text/javascript" src="_vibralogix/vibracart/vibracart.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet"  />
                      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="_js/jquery.slidemenu.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="_js/jwplayer.js" ></script>
<script type="text/javascript" src="_js/spry.js"></script>
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

   <div id='site_logo'><a href='index.php'><img src='_grafix/logo-nomas-960.jpg' name='logo' alt='logo' title='Home Page'></a></div>
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
      <div id='slidemenu' class='jqueryslidemenu'><ul>
	   <li><a href='index.php'>Home</a></li>
	   <li><a href='practitioners.php?sid=all'>Practitioners</a>
		 <ul>		
			<li><a href='practitioners.php?sid=all'>Practitioners Worldwide</a></li>
			<li><a href='practitioners.php?sid=usa'>USA Practitioners</a></li>
			<li><a href='practitioners.php?sid=intl'>International Practitioners</a></li>
			<li><a href='about_training.php'>Become a Practitioner</a></li>			 
		 </ul>   		   
	   </li>			
	   <li><a href='about_training.php'>NOMAS<sup>&reg;</sup> Training/Testing</a>
		  <ul>
			<li><a href='about_training.php'>Training & Testing Info</a></li>
			<li><a href='nomas_agenda.php'>NOMAS Training Agenda</a></li>
			<li><a href='renew.php'>License Renewal Info</a></li>
			<li><a href='olceu/index.php'>Feeding Disorders Login</a></li>		   
			<li><a href='olceu/index_renew_login.php'>Renewal/Reliability Login</a></li>		
		  </ul>
	   </li>
	   <li><a href='ceu_0001.php'>Online CEU</a></li>
	   
	   <li><a href='about_mmp.php'>About</a>
		 <ul>		
			<li><a href='about_mmp.php'>Marjorie Meyer Palmer</a></li>
			<li><a href='about_stories.php'>NOMAS Success Stories</a></li>
		 </ul>   		   		
	   </li>
	   <li><a href='contact.php'>Contact</a></li>
	   <li><a href='http://www.nomasinternational.org/_smf/'>Infant Feeding Forum</a></li>
   </ul></div>      
   </div><!--end top nav box-->
   
   <!--SOCIAL-->  
   <div class='social_links'>
      <a href='https://www.facebook.com/nomasinternational' target='_blank'><img class='social_logo' src='_grafix/social_fb.png' width='20' height='20' alt='fblogo' title='NOMAS on FB'></a>
   <a href='http://twitter.com/NOMAS_INTL' target='_blank'><img class='social_logo' src='_grafix/social_tw.png' width='20' height='20' alt='twlogo' title='NOMAS on Twitter'></a>
   <a href='http://www.linkedin.com/company/3600249' target='_blank'><img class='social_logo' src='_grafix/social_li.png' width='20' height='20' alt='lilogo' title='NOMAS on LinkedIn'></a>   </div><!--end social box-->    
  
   <div class='clearAll'></div>  
    
   <div id='nomas_content'>
    
      <div id='nomas_page_headlines'>
         <div class='pageTitle'>NOMAS<sup>&reg;</sup> International Online Continuing Education</div><div class='pageSubTitle'>Online CEU instruction for Occupational Therapy, Speech Pathology and Nursing professionals</div>       </div><!--end nomas_page_headlines--> 
      
       <!-- LEFT COLUMN-->
       <div id='column_left_wide'>
       
          <div class='l_item'>
             <div class='reg_text_serif'></div>   
          </div><!--end l_item-->
          
          <div class='item_sep_dots'></div>
       
          <div class='l_item'>
              <div class="heading">
				<?php
					if($_GET['video']=="flaccid" OR $_GET['video']=="flaccid_2" OR $_GET['video']=="flaccid_3" OR $_GET['video']=="flaccid_4" OR $_GET['video']=="flaccid_5" OR $_GET['video']=="flaccid_6" OR $_GET['video']=="flaccid_7" OR $_GET['video']=="flaccid_8" OR $_GET['video']=="flaccid_9" OR $_GET['video']=="flaccid_10")
					{
					?>
						<h1>DIAGNOSIS: DYSFUNCTIONAL SUCK PATTERN WITH FLACCID TONGUE - <?php echo $video_title;?> </h1>
					<?php
					}
					if($_GET['video']=="retracted" OR $_GET['video']=="retracted_2" OR $_GET['video']=="retracted_3" OR $_GET['video']=="retracted_4" OR $_GET['video']=="retracted_5" OR $_GET['video']=="retracted_6" OR $_GET['video']=="retracted_7" OR $_GET['video']=="retracted_8" OR $_GET['video']=="retracted_9" OR $_GET['video']=="retracted_10")
					{
					?>
						<h1>DIAGNOSIS: DYSFUNCTIONAL SUCK PATTERN WITH RETRACTED TONGUE - <?php echo $video_title;?> </h1>
					<?php
					}
					?>
				</div>
                    <!--flaccid and retracted group videos -->
				<?php 
				if($_GET['video']=="flaccid" OR $_GET['video']=="flaccid_2" OR $_GET['video']=="flaccid_3" OR $_GET['video']=="flaccid_4" OR $_GET['video']=="flaccid_5" OR $_GET['video']=="flaccid_6" OR $_GET['video']=="flaccid_7" OR $_GET['video']=="flaccid_8" OR $_GET['video']=="flaccid_9" OR $_GET['video']=="flaccid_10" OR $_GET['video']=="retracted" OR $_GET['video']=="retracted_2" OR $_GET['video']=="retracted_3" OR $_GET['video']=="retracted_4" OR $_GET['video']=="retracted_5" OR $_GET['video']=="retracted_6" OR $_GET['video']=="retracted_7" OR $_GET['video']=="retracted_8" OR $_GET['video']=="retracted_9" OR $_GET['video']=="retracted_10")
				{
				?>
				<div style="width:95%; height:auto; margin-left:12px;"><div class="reg_text">
				  Hello and Welcome!
				  <br><br>
				  This is the "Display Video" page attached to the admin suite. It's also a model of what the student will see after they've entered their password and accessed this kind of page that displays the video. 
				  <br><br>
				  In this instance, since you're giving them access to every "<?php echo $video_text;?>" video, they'll get a page like this that displays one video at a time with arrows at the bottom that will allow them to move forward or backward.
				  <br><br>
				  To send this video to a student, email them two things:
				  <br>
				 -  the password, which is "Secret"
				 <br>
				 - the link, which is going to be:
				 <br><br>
				 <div style="width:auto; height:25px; padding:5px; border:1px solid #cccccc; text-align:center;">http://nomasinternational.org/video_login.php?video=<?php echo $_GET['video'];?></div>
				  <br>
				  To return to the admin page, click <a href="support/index_app_videos.php">here</a>.
				  </div></div>
				  <br><br>
					<div style="width:95%; margin:auto; height:auto; padding:10px; text-align:center;">
						<table style="width:90%; padding:5px;">
							<tr>
								<td colspan="2">
									<table style="width:100%;">
										<tr>
											<td style="width:95px;">&nbsp;</td>
											<td>
												 <div id='vidBox'>Please install the Flash Plugin</div>	
													 <script type="text/javascript">
													 <!--
													 jwplayer('vidBox').setup({
													 'id': 'playerID',
													 'width': '600',
													 'height': '480',
													 'file': '_video/<?php echo $video_file;?>',
													 'image': '_video/images/videoTitleSlide.jpg',
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
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><br>
									<div class="reg_text" style="margin-left:-80px;">
										<?php 
										if($video_link_back<>"")
										{
										?>	
											click <a href="display_video.php?video=<?php echo $video_link_back;?>">here</a> to view previous video...
										<?php
										}
										?>
									</div>
								</td>
								<td style="text-align:right;"><br>
									<div class="reg_text">
										<?php 
											if($video_link_forward<>"")
											{
											?>	
												click <a href="display_video.php?video=<?php echo $video_link_forward;?>">here</a> to view next video...
											<?php
											}
											?>
										</div>
								</td>
							</tr>
						</table>
					</div>
					 <!--VIDEO-->
				<?php
				}
				else
				{
				?>
              <!--regular single video -->
                 <!--VIDEO-->
				 <table style="width:95%; margin:auto;">
                  <div style='width:40%;float:left;display:inline;'>
                     <div id='vidBox'>Please install the Flash Plugin</div>	
                     <script type="text/javascript">
                     <!--
                     jwplayer('vidBox').setup({
                     'id': 'playerID',
                     'width': '300',
                     'height': '240',
                     'file': '_video/<?php echo $video_file;?>',
                     'image': '_video/images/videoTitleSlide.jpg',
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
			  <div style='width:55%;float:left;display:inline;margin-left:12px;'><div class='reg_text'>                                                            
              Hello and Welcome!
			  <br><br>
			  This is the "Display Video" page attached to the admin suite. It's also a model of what the student will see after they've entered their password and accessed this kind of page that displays the video. 
			  <br><br>
			  To send this video to a student, email them two things:
			  <br>
			 -  the password, which is "Secret"
			 <br>
			 - the link, which is going to be:
			 <br><br>
			 <div style="width:auto; height:25px; padding:5px; border:1px solid #cccccc; text-align:center;">http://nomasinternational.org/video_login.php?video=<?php echo $_GET['video'];?></div>
			  <br>
			  To return to the admin page, click <a href="support/index_app_videos.php">here</a>.
			  <br><br>
			  Here's the text your student will see...
			  <br><br>
			  <span style="font-weight:bold;">You're getting ready to watch, "DIAGNOSIS: DYSFUNCTIONAL SUCK PATTERN WITH <?php echo $group;?> TONGUE - <?php echo $video_title;?> !" If you have any questions, please contact NOMAS<sup>&reg;</sup> by clicking <a href="contact.php" style="color:#000; text-decoration:underline;">here</a>.
			  <br><br>
			  Thanks!</span>
              
              </div></div><!--end STYLE & reg_text-->                 
              
              <div class='clearAll'></div> 
              <?php
			}
			?>
         
           </div><!--end Content-->
        </div><!--end panel-->    

       <div class='clearAll'></div>                      
       <div class='spacer_26'></div>                                             
          
       </div><!--end column_left_wide-->    
       <div class='clearAll'></div>

   </div> <!-- end nomas_content  -->  
  
   <!--FOOTER-->
   <div id="footer"> 
      <div class='menu'>
	   <a href='index.php'>Home</a> &middot; 
	   <a href='about_training.php'>NOMAS<sup>&reg;</sup> Training</a> &middot; 
	   <a href='ceu_0001.php'>Online CEU</a> &middot; 
	   <a href='renew.php'>Re-Licensing / Reliability Testing</a> &middot; 
	   <a href='contact.php'>Contact</a> 
   </div>
<div class='copy'>Copyright &copy; 1983-2018 - Marjorie Meyer Palmer</div>
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