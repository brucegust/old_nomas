<?php 
header("Cache-Control: no-cache, must-revalidate");
header('Pragma: no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') {session_start(); }

require_once "_inc/_always.php";  // procedures and vars
include_once "_nav/nav_site_001.php"; // top nav menu


//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle = "Online Continuing Education";
$pageSubTitle = "Welcome!";

//*****************************************************************
//*****************************************************************
//*****************************************************************

$errorMsg   = "";
$email      = (isset($_POST['email'])      && $_POST['email'] > '' )      ? $_POST['email']      : '';
$order_num  = (isset($_POST['order_num'])  && $_POST['order_num'] > '' )  ? $_POST['order_num']  : '';
$occupation = (isset($_POST['occupation']) && $_POST['occupation'] > '' ) ? $_POST['occupation'] : '';

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logon'])) {
   $errorMsg = olce_login($_POST);  
}
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
<link href="../_css/css_nav_top.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="playground">
   <div id='site_logo'><?php showBigLogo(); ?></div>  
   
   <div class='clearAll'></div>
  
   <!--TOP BLUE-->  
   <div id='nav_box'>
      <div id='slidemenu' class='jqueryslidemenu'><?php showTopNav($topNav) ?></div>      
   </div><!--end top nav box-->   
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
                <div style="width:250px; height:auto; padding:10px; margin:10px; border:1px solid #cccccc; border-radius:10pt; float:right; background-color:#000000; color:#ffffff; text-align:center; box-shadow:5px 5px 3px #ccc;">PLEASE BE AWARE...<br><br>You have access to the course content for seven days only. You may sign in and out as often as you like during that time frame, but you are limited to seven days beginning the day you first sign in.<br><br></div>To sign-in, enter your email address and order number exactly as they appear on your confirmation email.<br><br>
                <span class='bld'>IMPORTANT:</span> Access to courses and materials is available only for a limited time as explained in our terms.<br> 
                <span class='bld'>The access period begins when you first sign-in</span>. You may sign-in and out as often as you wish during your access period.<br><br>
                For CEU purposes you are asked to enter your occupation. You need do that only when signing-in the first time. You need not enter occupation during subsequent
                sign-ins unless you would like to change the information.<br><br>

                Once signed-in, please allow time to:<br><br>                        
                
                <ul class='pink'>
                   <li class='pink'>Download and print course materials.</li>
                   <li class='pink'>View the video course(s).</li>
                   <li class='pink'>For CEU credit you must complete and pass a short quiz or quizzes on the material covered.</li>
                </ul>   
                
                <br>Problems or questions? <?php echo $pleaseContact; ?>
             </div>
          </div>
          
          <div class='spacer_12'></div>   
          <div class='item_sep_dots_pink'></div>
                  
          <div class='l_item'>
             <div class='signin_form_box'>              
                <form class="signin_form" action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">                       
                   <table class='signin_table'>
                      <tr>
                         <th colspan='2'>Please Sign-In:</th>
                      </tr>
                      <tr>
                         <td><label for "email">Email:</label></td>
                         <td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" maxlength="100" /></td>
                      </tr>
                      <tr>
                         <td><label for "order_num">Order Number:</label></td>
                         <td><input type="text" name="order_num" value="<?php echo htmlspecialchars($order_num); ?>" maxlength="50" /></td>
                      </tr>
                      <tr>
                         <td><label for "occupation">Occupation:</label></td>
                         <td><input type="text" name="occupation" value="<?php echo htmlspecialchars($occupation); ?>" maxlength="50" /></td>
                      </tr>	
                   </table>                                                                              		        
                   <div class='clearAll'></div>         
                   <div class='spacer_26'></div>
                   <?php
				   if(isset($errorMsg) && $errorMsg > '') { ?>
                   <table class='problem_msg_table'>
                      <tr>
                         <td><?php echo $errorMsg; ?></td>
                      </tr>   
                   </table>
                   <?php } ?>
                   <button type="submit" name="logon" value="logon">Sign In</button>
                   <!--<input type="image" name="logon" value="logon" src="_grafix/sign-in.png" style="width:100px; height:34px;border:none;" alt="Sign In">-->
                   <br>                   
                </form>                  
             </div><!--end form_box-->   
          </div><!--end l_item-->          
          <div class='clearAll'></div>                       
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
