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

$playerWidth  = "840";
$playerHeight = "520";

$sid = (isset($_REQUEST['sid']) && !empty($_REQUEST['sid'])) ? $_REQUEST['sid'] : $_SESSION['u_sid'];   // Order Number
   
if(!$link = db_connect_site()) {
  $errorMsg = "System temporarily unavailable (1). Please try again later."; 
} else {
  $sql = "SELECT * FROM $testskedTBL WHERE ordernum = '$sid' LIMIT 1;";
  if(!$result = mysqli_query($link,$sql)) {
   	 $errorMsg = "System temporarily unavailable (2). Please try again later."; 	
  } else {
	 if(mysqli_num_rows($result) == 0) {
		$errorMsg = "Database empty. Please notify NOMAS International";
	 } else {
		if(mysqli_num_rows($result) > 0) { 
		   while ($row = mysqli_fetch_assoc($result)) {
			  $name          = $row['name'];
			  $email         = $row['email'];
			  $ordernum      = $row['ordernum'];
			  $testnum       = $row['testnum'];
			  $wopen         = $row['winopen'];
			  $wclose        = $row['winclose'];
		   }
		}	 
	 } 	  
  }
}

if(isset($name) && $name > '' && isset($testnum) && $testnum > '' && isset($wclose) && !empty($wclose)) {
	
   $wcloseMSG = date_format(date_create($wclose),"l n/j");
   
   switch($testnum)	{
	   case '2' :
	   case '3' :
	      $pageTitle = "Reliability Videos For " . $name;
		  $pageSubTitle = "Access through " . $wcloseMSG;
	      break;   
	   case '4' :
	   case '5' :
	      $pageTitle = "License Renewal Videos For " . $name;
		  $pageSubTitle = "Access through " . $wcloseMSG;
	      break;  			  	  
   }

} else {
		  
   $pageTitle    = "Problem With Testing Server";
   $pageSubTitle = "Please try again later";
   
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logoff'])) {
   $errorMsg = renew_logout($_POST);  
}

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
	     if ( isset($pageTitle) && $pageTitle > '' || isset($pageSubTitle) && $pageSubTitle > '') {
			echo "<div>";
			if(isset($pageTitle) && $pageTitle > '')
			   echo "<span class='pageTitle'>" . $pageTitle . "</span> ";
			if(isset($pageSubTitle) && $pageSubTitle > '')
			   echo "<span class='pageSubTitle'>" . $pageSubTitle . "</span>";			   		   			   			   			
			echo "</div>";
		 }
	     ?>
       </div><!--end nomas_page_headlines-->  
      
       <!--COLUMN-->
       <div id='column_left_wide'>          
          <div class='l_item'>
             <div class='reg_text'> 
                <span class='bld'>Score Sheets:</span><br>
                <ul class='pink'>
                   <li class='pink'>Please <a href="<?php echo $renewScoreSheet ?>" target="_blank">print and complete</a> a Score Sheet form for each baby. 
                   (TIP: print 5 copies of the score sheet before viewing videos).</li>
                   <li class='pink'>Number each sheet "Baby 1, Baby 2", etc.) FAX or mail your completed score sheets to NOMAS International:</li>
                   <li class='pink'>FAX: 831-623-9007 | MAIL: NOMAS International, 1528 Merrill Road, San Juan Bautista, CA 95045.</li>
                   <li class='pink'>Videos are SILENT (no audio).</li>
                </ul>
                <?php $display = false; if($display) { ?>
                <span class='bld'>Course Summary:</span><br> <?php echo $ordernum; ?>
                <?php } $display = true; ?>
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
          <?php if($testnum == '2') { ?>
             <!--Reliability Test 2-->
             <div style='width:100%;margin:26px 0px;'>  
                <table class='vidBoxTable'> 
                   <tr>
                      <td>
                         <div id='vidBox'>Please install the Flash Plugin</div>	
                         <script type="text/javascript">
                          <!--
                          jwplayer('vidBox').setup({
                            'id': 'playerID',
                            'width': '<?php echo $playerWidth; ?>',
                            'height': '<?php echo $playerHeight; ?>',
                            'image': '<?php echo $copyright720; ?>',							 
                            'provider': 'http',
                            'controlbar.position': 'bottom',
                            'modes': [  
                               {type: 'flash', src: '../_js/player.swf'},					  
                               {type: 'html5'}
                               ],
                            'playlist.position': 'right',
                            'playlist.size': '200',
                            'playlist': [		
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_1_1.mp4"; ?>',
                                   'title': 'Baby 1'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_1_2.mp4"; ?>',
                                   'title': 'Baby 2'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_1_3.mp4"; ?>',
                                   'title': 'Baby 3'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_1_4.mp4"; ?>',
                                   'title': 'Baby 4'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_1_5.mp4"; ?>',
                                   'title': 'Baby 5'
                                }							
                            ]
                          });
                          -->
                          </script>
                      </td>
                   </tr>
                   <tr>
                      <td>
                         <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
                            <button type="submit" name="logoff" value="logoff">Quit Videos and Logoff</button>
                         </form>                   
                      </td>
                   </tr>   
                </table>
             </div><!--end Video player div-->       
          <?php } ?>
          
          <!--video player-->
          <?php if($testnum == '3') { ?>
          <!--Reliability test 3-->
             <div style='width:100%;margin:26px 0px;'>  
                <table class='vidBoxTable'> 
                   <tr>
                      <td>
                         <div id='vidBox'>Please install the Flash Plugin</div>	
                          <script type="text/javascript">
                          <!--
                          jwplayer('vidBox').setup({
                            'id': 'playerID',
                            'width': '<?php echo $playerWidth; ?>',
                            'height': '<?php echo $playerHeight; ?>',
                            'provider': 'http',
                            'image': '<?php echo $copyright720; ?>',
                            'controlbar.position': 'bottom',
                            'modes': [  
                               {type: 'flash', src: '../_js/player.swf'},
                               {type: 'html5'}  	
                               ],
                            'playlist.position': 'right',
                            'playlist.size': '150',
                            'playlist': [
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_2_1.mp4"; ?>',
                                   'title': 'Baby One'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_2_2.mp4"; ?>',
                                   'title': 'Baby Two'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_2_3.mp4"; ?>',
                                   'title': 'Baby Three'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_2_4.mp4"; ?>',
                                   'title': 'Baby Four'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_rel_2_5.mp4"; ?>',
                                   'title': 'Baby Five'
                                }							
                            ]
                          });
                          -->
                          </script>
                      </td>
                   </tr>
                   <tr>
                      <td>
                         <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
                            <button type="submit" name="logoff" value="logoff">Quit Videos and Logoff</button>
                         </form>                   
                      </td>
                   </tr>   
                </table>
             </div><!--end Video player-->     
          <?php } ?>
          
          <!--video player-->
          <?php if($testnum == '4') { ?>
          <!--License renewal test-->
             <div style='width:100%;margin:26px 0px;'>  
                <table class='vidBoxTable'> 
                   <tr>
                      <td>
                         <div id='vidBox'>Please install the Flash Plugin</div>	
                          <script type="text/javascript">
                          <!--
                          jwplayer('vidBox').setup({
                            'id': 'playerID',
                            'width': '<?php echo $playerWidth; ?>',
                            'height': '<?php echo $playerHeight; ?>',
                            'provider': 'http',
                            'image': '<?php echo $copyright720; ?>',							 
                            'controlbar.position': 'bottom',
                            'modes': [  
                               {type: 'flash', src: '../_js/player.swf'},
                               {type: 'html5'}  	
                               ],
                            'playlist.position': 'right',
                            'playlist.size': '150',
                            'playlist': [
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_1_1.mp4"; ?>',
                                   'title': 'Baby One'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_1_2.mp4"; ?>',
                                   'title': 'Baby Two'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_1_3.mp4"; ?>',
                                   'title': 'Baby Three'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_1_4.mp4"; ?>',
                                   'title': 'Baby Four'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_1_5.mp4"; ?>',
                                   'title': 'Baby Five'
                                }							
                            ]
                          });
                          -->
                          </script>
                      </td>
                   </tr>
                   <tr>
                      <td>
                         <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
                            <button type="submit" name="logoff" value="logoff">Quit Videos and Logoff</button>
                         </form>                   
                      </td>
                   </tr>   
                </table>
             </div><!--end Video player-->       
          <?php } ?>
          
          <!--video player-->
          <?php if($testnum == '5') { ?>
          <!--License renewal test-->
             <div style='width:100%;margin:26px 0px;'>  
                <table class='vidBoxTable'> 
                   <tr>
                      <td>
                         <div id='vidBox'>Please install the Flash Plugin</div>	
                          <script type="text/javascript">
                          <!--
                          jwplayer('vidBox').setup({
                            'id': 'playerID',
                            'width': '<?php echo $playerWidth; ?>',
                            'height': '<?php echo $playerHeight; ?>',
                            'provider': 'http',
                            'image': '<?php echo $copyright720; ?>',							 
                            'controlbar.position': 'bottom',
                            'modes': [  
                               {type: 'flash', src: '../_js/player.swf'},
                               {type: 'html5'}  	
                               ],
                            'playlist.position': 'right',
                            'playlist.size': '150',
                            'playlist': [
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_2_1.mp4"; ?>',
                                   'title': 'Baby One'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_2_2.mp4"; ?>',
                                   'title': 'Baby Two'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_2_3.mp4"; ?>',
                                   'title': 'Baby Three'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_2_4.mp4"; ?>',
                                   'title': 'Baby Four'
                                },
                                {
                                   'file': '<?php echo $ceuVideoPath . "test_lic_2_5.mp4"; ?>',
                                   'title': 'Baby Five'
                                }							
                            ]
                          });
                          -->
                          </script>
                      </td>
                   </tr>
                   <tr>
                      <td>
                         <form class='signin_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">
                            <button type="submit" name="logoff" value="logoff">Quit Videos and Logoff</button>
                         </form>                   
                      </td>
                   </tr>   
                </table>
             </div><!--end Video player-->                   
          <?php } ?>
          
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
