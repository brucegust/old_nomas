<?php

$the_link="http://www.nomasinternational.org/olceu/index_quiz.php?id=od1&sid=";
$the_link.=$_GET['the_sid'];
$the_link.="&qt=qtv&at=";
$the_link.=$_GET['the_at'];

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
<link href="_css/olce.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="../_js/jwplayer.js" ></script>
<style>
td.pageSubTitle {
	font-family:Verdana, Geneva, sans-serif;
	font-size:1.7em;
	font-weight:bold;
	color:#333;
}

td.videoCell {
	font-family:Arial;
	font-size:10pt;
	font-weight:bold;
	color:#333;
}
</style>
</head>
<body>
<div id="playground">
   <div id='site_logo'><a href='#'><img src='_grafix/logo-nomas-960.jpg' name='logo' alt='logo' title='Home Page'></a></div>  
   <div class='clearAll'></div>
  
   <!--TOP BLUE-->  
   <div id='nav_box'>&nbsp;</div>   
   <!--end top blue-->
  
   <div class='clearAll'></div>  
    
   <div id='nomas_content'>    
      <div id='nomas_page_headlines'>
         <div class='pageTitle'>Video and Handouts for Course od1</div>
		 <div class='pageSubTitle'>NOMAS<sup>&reg;</sup> Online: Day One</div> 
		<div class="pageSubTitle" style="font-size:12pt; margin-top:-5px;">Course Objectives:</div>
		<!--course objectives -->
		<ol style="font-family: Verdana, Geneva, sans-serif; font-size:10pt; margin-left:12px; line-height:20px;">
		<li>1) Explain anatomy and physiology of the infant oral mechanism;</li>
		<li>2) Identify the components and types of neonatal sucking;</li>
		<li>3) Differentiate normal from disorganized and dysfunctional sucking;</li>
		<li>4) Outline similarities and differences with breast and bottle feeding;</li>
		<li>5) List three types of sensory feeding problems in the neonate;</li>
		<li>6) Identify &quot;diagnostic-based&quot; treatment strategies for infants with a 
		disorganized and dysfunctional suck;</ol>
		<!--end of course objectives -->
	 </div><!--end nomas_page_headlines-->  
      
       <!--COLUMN-->
       <div id='column_left_wide'>          
          <div class='l_item'>
          </div>
          
          <div class='spacer_26'></div>   
          
          
          <!--video player-->
          <div style='width:100%;margin:26px 0px;'>  
          <table style='margin-left:auto;margin-right:auto;'> 
			<tr>
				<td class="pageSubTitle"><u>Talk #1</u></td>
			</tr>
			<tr>
				<td>&nbsp;<br></td>
			</tr>
			<tr>
				<td class="videoCell">Talk #1 Handout: click <a href="http://www.nomasinternational.org/olceu/olceu_pdf/od1_talk_one.pdf" target="_blank" style="font-family:Arial, sans-serif; font-size:10pt; font-weight:bold; color:#333; text-decoration:underline;">here</a> to view the handout for Talk #1</td>
			</tr>
			<tr>
				<td>&nbsp;<br></td>
			</tr>
			<tr>
				<td class="videoCell">Talk #1 Video...<br><br></td>
			</tr>
             <tr>
                <td>
                   <div id='vidBox' style='color:red;'>Please install the Flash Plugin</div>	
                      <script type="text/javascript">
                    
                      jwplayer('vidBox').setup({
                         'id': 'playerID',
                         'width': '640',
                         'height': '520',
                         'file': 'http://www.nomasinternational.org/_video/od1_talk_one.mp4',
                         'provider': 'http',
                         'image': '',
                         'controlbar.position': 'bottom',
                         'modes': [  
                            {type: 'html5'},                                                           
                            {type: 'flash', src: '../_js/player.swf'}
                          ]
                       });
                       </script>
                </td>
             </tr>
			 <tr>
				<td>&nbsp;<br><br></td>
			</tr>
			<tr>
				<td class="videoCell" style="text-align:center;">click on the links below to advance to the next video...</td>
			<tr>
			<tr>
				<td>&nbsp;<br><br></td>
			</tr>
			<tr>
				<td>
					<table style="width:100%;">
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td style="text-align:left;">&nbsp;</td>
							<td class="videoCell" style="text-align:right;"><a href="series_four_video_2.php?the_sid=<?php echo $_GET['the_sid'];?>&the_at=<?php echo $_GET['the_at'];?>" style="color:#000000; text-decoration:none;">Talk #2</a>&nbsp;<span style="font-size:18px;">&#9658;</span></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
					</table>
				</td>
			</tr>
             <tr>
                <td style='font-family:Georgia,Times New Roman,Times,serif;font-size:1.3em;font-weight:bold;color:#999;text-align:center;padding-top:12px;'>
                   <a href="javascript:window.close();"><img src="_grafix/close.jpg" border="0"></a>
                </td>
             </tr> 
          </table>                
          </div><!--end Video player-->         
          
          <div class='clearAll'></div>                       
          <div class='spacer_12'></div>
          
       </div><!--END COLUMN-->             
       <div class='clearAll'></div>
    </div> <!-- end content  -->
  
    <!--FOOTER-->
    <div id="footer"> 
       <div class='copy'>Copyright &copy; 1983-2017 - Marjorie Meyer Palmer</div>    </div><!-- end footer -->
 
</div><!-- end #playround -->
</body>
</html>

