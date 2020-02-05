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

$pageTitle = " ";
$pageSubTitle = 'NOMAS International Infant Feeding Forum';

//*****************************************************************
//*****************************************************************
//*****************************************************************

$groupswithaccess = "PUBLIC";
$loginpage        = "feeding_forum.php";
$logoutpage       = "feeding_forum.php";
$dbupdate         = true;
$loginredirect    = 2;
require_once "_vibralogix/slpw/sitelokpw.php";

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

    <div id='site_logo'><?php showForumLogo(); ?></div>
    <div class='clearAll'></div>
  
    <!--TOP NAV-->  
    <div id='nav_box'>
       <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
    </div><!--end top nav box-->
    
    <div class='clearAll'></div>  
    
   <!-- CONTENT -->
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
      </div>   

      <div id='column_left_wide'>        
       
         <div class='l_item'>
            <div class='text'>
               This Forum is for you to ask and answer and to help your colleagues from around the world to be better providers of service to our tiny patients. Feeding, as you know, is a huge issue 
               for these little ones and an obstacle that frequently stands in their way of going home to join their families. As Feeding Specialists we are always striving to “do it better.”  
               Hence, I hope that this International Infant Feeding Forum will provide us all with a means to better communicate with and among our colleagues. Membership in the Infant Feeding Forum 
               is free for NOMAS practitioners in good standing. Others may join for $25 per year. <?php echo $pleaseContact; ?>.
            </div><!--end text-->
         </div><!--end nomas_item_box-->  
         
         <!--LOGIN ITEM -->
		 <?php if ($slpublicaccess) { ?>  
            <br style='clear:both;'><br>                  
            <div class='l_item'>
               <h1>Please login:</h1><br>
               <div class='login_msg_box'><?php if ($msg!="") print "Note: " . $msg; ?></div>
               <form id='mem_login_form' name="siteloklogin" action="<?php print $startpage; ?>" method="POST" onSubmit="return validatelogin()">
            
                  <?php siteloklogin(); ?>
               
                  <label for "username">Username (one word) or registered Email address:</label><br>
                  <input type="text" name="username" value="" maxlength="50" size="30"><br><br>
               
                  <label for "password">Password:</label><br>
                  <input type="password" name="password" value="" maxlength="50" size="30"><br><br>
                  <!--
                  <label for "turing">Enter anti-spam code from below:</label><br>
                  <input type="text" name="turing" value="">               
                  <div class='captcha_box'>
                     <img src="slpw/turingimage.php" width="60" height="30">
                  </div>
                  -->                 
                  <button type="submit" name="login" value="Login">Login</button><br><br>            
                  <!--<input type="Submit" name="login" class='button' value="Login">-->
               
                  <div class='forgot_msg_box'>
                     Forgot password? Enter your email address, clear password box and <a href="javascript: void forgotpw()" title="Enter email address click this link.">click here.</a>
                  </div>
             </form>
            </div><!--end login item-->                       
         <?php } //end public access ?>               
         
         <?php if (!$slpublicaccess) {  
 	        if(sl_isactivememberof("FORUM") || sl_isactivememberof("NOMAS") || sl_isactivememberof("ADMIN")) { ?>
               <div class='l_item'>
                  <div class='text'><br>
                     <?php
                        echo $slfirstname . ", "; ?>
                        <a href='_smf/index.php'>click here to return to the forum</a>. Or, to logoff completely, <a href="<?php siteloklogout(); ?>">click here</a>.		
                   </div>
                </div>   
            <?php } ?>   
      <?php } ?>

      </div> <!-- end column_left_wide  -->
      
      <div class='clearAll'></div>      
      
   </div><!--end nomas_content-->
   
    <!--FOOTER-->
    <div id="footer"> 
       <?php showBottomMenu(); showCopyright($thisYear); ?>
    </div><!-- end footer -->
 
    <div class='clearAll'></div>
    
</div><!-- end #playround -->
</body>
</html>
