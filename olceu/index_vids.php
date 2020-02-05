<?php 
header("Cache-Control: no-cache, must-revalidate");
header('Pragma: no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') {session_start(); }
require_once "_inc/_always.php";  // procedures and vars

$u_token = getToken(); 
check_permission($u_token);

//*****************************************************************
//*****************************************************************
//*****************************************************************

if(isset($_REQUEST['id']) && !empty($_REQUEST['id']))
   $id = $_REQUEST['id'];
   
if(!$link = db_connect_site()) {
  $errorMsg = "System temporarily unavailable. Please try again later."; 
} else {
  $sql = "SELECT * FROM $ceuproductsTBL WHERE id = '$id' LIMIT 1;";
  if(!$result = mysqli_query($link,$sql)) {
   	 $errorMsg = "System temporarily unavailable. Please try again later."; 	
  } else {
	 if(mysqli_num_rows($result) == 0) {
		$errorMsg = "Product database empty. Please notify NOMAS International";
	 } else {
		if(mysqli_num_rows($result) > 0) { 
		   while ($row = mysqli_fetch_assoc($result)) {
			  $id          = $row['id'];
			  $description = $row['description'];
			  $location    = $row['location'];
			  $vidlocation = $row['vidlocation'];				  
		   }
		}	 
	 } 	  
  }
}
   
if(!$link = db_connect_site()) {
  $errorMsg = "Course Objectives system temporarily unavailable. Please try again later."; 
} else {
  $sql = "SELECT * FROM $ceuobjectivesTBL WHERE id = '$id' LIMIT 1";
  if(!$result = mysqli_query($link,$sql)) {
	 $errorMsg = "Course Objectives system temporarily unavailable. Please try again later."; 	
   } else {
	  if(mysqli_num_rows($result) == 0) {
	     $errorMsg = "Course Objectives database empty. Please notify NOMAS International";
	  } else {
         if(mysqli_num_rows($result) > 0) { 
		    while ($row = mysqli_fetch_assoc($result)) {
			   $id         = $row['id'];
			   $objectives = $row['objectives'];
			   $summary    = $row['summary'];
		    }
	     }
	  }
   }
}

if(isset($ceuVideoPath) && !empty($ceuVideoPath) && isset($vidlocation) && !empty($vidlocation))  
{
	// if the $id is od1, dictate the $vidlocation
	if($id=="od1")
	{
		$vidlocation="http://www.nomasinternational.org/_video/NOMAS Online.mp4";
	}
	else
	{
		$vidlocation = $ceuVideoPath . $vidlocation;  
	}
   $chkvidloc = '"' . $vidlocation . '"'; 
} 
else 
{ 
	$errorMsg = "Cannot find videos. Please notify NOMAS International"; 
}

//*****************************************************************
//*****************************************************************
//*****************************************************************	   

$pageTitle    = (isset($id) && !empty($id)) ? "Video For Course: " . $id : "Online Continuing Education Video";
$pageSubTitle = (isset($description) && !empty($description)) ? ucwords($description) : ' ';

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
<title>NOMAS International</title>
<meta name="viewport" content="width=device-width" />
<link href="_css/olce.css" rel="stylesheet" type="text/css">
<?php 
echo $jq_google . "\n";
echo $swfobj22 . "\n";
echo $jwplayer . "\n";
?>
</head>
<body>
<div id="playground">
   <div id='site_logo'><?php showBigLogo(); ?></div>  
   <div class='clearAll'></div>
  
   <!--TOP BLUE-->  
   <div id='nav_box'>&nbsp;</div>   
   <!--end top blue-->
  
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
      
       <!--COLUMN-->
       <div id='column_left_wide'>          
          <div class='l_item'>
             <div class='reg_text'> 
                <span class='bld'>Course Objectives:</span><br>
                <?php echo $objectives; ?>
                <br><br>
                <span class='bld'>Course Summary:</span><br>
                <?php echo $summary; ?>
             </div>
          </div>
          
          <div class='spacer_26'></div>   
          
          <?php if(isset($errorMsg) && !empty($errorMsg)) { ?>
          <!--ERROR MESSAGES-->
          <table class='problem_msg_table'>
             <tr>
                <td><?php echo $errorMsg; ?></td>
             </tr>             
          </table>			  
		  <?php } ?>

          <!--video player-->
          <div style='width:100%;margin:26px 0px;'>  
          <table style='margin-left:auto;margin-right:auto;'> 
             <tr>
                <td>
                   <div id='vidBox' style='color:red;'>Please install the Flash Plugin</div>	
                      <script type="text/javascript">
                    <?php
                      $video_width = '640';
                      $video_height = '520';

                      // Different video size for newer videos
                      if (strpos($id, 'cpf') !== false){
                        $video_width = '720';
                        $video_height = '520';
                      }
                    ?>

                      jwplayer('vidBox').setup({
                         'id': 'playerID',
                         'width': '<?php echo $video_width; ?>',
                         'height': '<?php echo $video_height; ?>',
                         'file': '<?php echo $vidlocation; ?>',
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
                <td style='font-family:Georgia,Times New Roman,Times,serif;font-size:1.3em;font-weight:bold;color:#999;text-align:center;padding-top:12px;'>
                   <a href="javascript:window.close();">[ Close Video Window ]</a>
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
       <?php showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
</div><!-- end #playround -->
</body>
</html>
