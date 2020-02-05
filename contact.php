<?php 
header("Cache-Control: no-cache, must-revalidate");
header('Pragma: no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
if(session_id() == '') { session_start(); }

require_once "_inc/_always.php";  // frequently used procedural functions
include_once "_inc/mail_functions.php";
include_once "_nav/nav_site_001.php"; // top nav menu

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "Contact NOMAS<sup>&reg;</sup> International";
$pageSubTitle = 'We do not share, sell or disclose any of your information to third parties. ';

//*****************************************************************
//*****************************************************************
//*****************************************************************

$toEmail    = $sendToEmail; // set in _always
$Subject    = "NOMAS INTL. WEBSITE INQUIRY"; 
$formError  = array();
$sent       = '';

$date_in    = $today;
$renew      = "";
$nomas      = "";
$olce       = "";
$update     = "";
$other      = "";
$ch0        = "unchecked";
$ch1        = "unchecked";
$ch2        = "unchecked";
$ch3        = "unchecked";
$ch4        = "unchecked";
$name       = (isset($_POST["name"])    || !empty($_POST["name"]))    ? trim($_POST["name"])    : '';
$addr1      = (isset($_POST["addr1"])   || !empty($_POST["addr1"]))   ? trim($_POST["addr1"])   : '';
$addr2      = (isset($_POST["addr2"])   || !empty($_POST["addr2"]))   ? trim($_POST["addr2"])   : '';
$city       = (isset($_POST["city"])    || !empty($_POST["city"]))    ? trim($_POST["city"])    : '';
$state      = (isset($_POST["state"])   || !empty($_POST["state"]))   ? trim($_POST["state"])   : '';
$country    = (isset($_POST["country"]) || !empty($_POST["country"])) ? trim($_POST["country"]) : '';
$zip        = (isset($_POST["zip"])     || !empty($_POST["zip"]))     ? trim($_POST["zip"])     : '';
$email      = (isset($_POST["email"])   || !empty($_POST["email"]))   ? trim($_POST["email"])   : '';
$phone      = (isset($_POST["phone"])   || !empty($_POST["phone"]))   ? trim($_POST["phone"])   : '';
$message    = (isset($_POST["message"]) || !empty($_POST["message"])) ? trim($_POST["message"]) : '';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   $_POST['renew']  = (isset($_POST['ch0']) && $_POST['ch0'] == "renew")  ? "YES" : "NO";
   $_POST['nomas']  = (isset($_POST['ch1']) && $_POST['ch1'] == "nomas")  ? "YES" : "NO";
   $_POST['olce']   = (isset($_POST['ch2']) && $_POST['ch2'] == "olce")   ? "YES" : "NO";
   $_POST['update'] = (isset($_POST['ch3']) && $_POST['ch3'] == "update") ? "YES" : "NO";
   $_POST['other']  = (isset($_POST['ch4']) && $_POST['ch4'] == "other")  ? "YES" : "NO";
   
   $sent = checkContact($_POST);
} 

if (isset($_POST['ch0'])) {
   $ch0 = $_POST['ch0'];
   if ($ch0 == 'renew') {
       $ch0 = 'checked';
   }
}

if (isset($_POST['ch1'])) {
   $ch1 = $_POST['ch1'];
   if ($ch1 == 'nomas') {
       $ch1 = 'checked';
   }
}

if (isset($_POST['ch2'])) {
   $ch2 = $_POST['ch2'];
   if ($ch2 == 'olce') {
       $ch2 = 'checked';
   }
}

if (isset($_POST['ch3'])) {
   $ch3 = $_POST['ch3'];
   if ($ch3 == 'update') {
      $ch3 = 'checked';
   }
}

if (isset($_POST['ch4'])) {
   $ch4 = $_POST['ch4'];
   if ($ch4 == 'other') {
      $ch4 = 'checked';
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
<title>NOMAS International - Contact Us</title>
<meta name="description" content="Email contact page for NOMAS&reg; International.">
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

   <div id='site_logo'><?php showBigLogo(); ?></div>
  
   <div class='clearAll'></div>
  
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
             <div class='reg_text'>       
                Please place a check-mark next to the program or programs in which you are interested. A NOMAS<sup>&reg;</sup> brochure will be sent only if you provide a mailing address. 
                All other responses will be sent to the email address you provide.<br><br>
                Certified NOMAS<sup>&reg;</sup> practitioners may wish to keep their contact information current in our official registry. Filling out this form completely is a handy way to do that.<br>
             </div>
          </div>
          
          <div class='spacer_26'></div>     
          <div class='item_sep_dots_pink'></div>
                  
          <div class='l_item'>
             
             <div id='contact_form_box'>
              
                <form class='contact_form' action="<?php echo "{$_SERVER['PHP_SELF']}" ?>" method="POST" accept-charset="utf-8">                       
                  <input type="hidden" name="date_in" value="<?php echo $date_in; ?>" />                   
                              
                   <?php 	  	
                   if (isset($formError) && count($formError)) {
                     echo "<table class='problem_msg_table'><tr><td>";
                     echo "<div class='error'>";	
                     echo "Oops! Problem. Please see below";
                     echo "</div>";
                     echo "</td></tr></table>";
                   }	  						
                      
                   if (isset($formError['problem']) && $formError['problem'] > '') {
                     echo "<table class='problem_msg_table'><tr><td>";
                     echo "<div class='error'>";	
                     echo $formError['problem'];
                     echo "</div>";
                     echo "</td></tr></table>";
                   }	                       					 
                              
                   if (isset($sent) && $sent == 'OK') {
                     echo "<table class='problem_msg_table'><tr><td>";
                     echo "<div class='sent'>";	
                     echo "Your message has been sent. Thank you!";
                     echo "</div>";
                     echo "</td></tr></table>";
                  }	  
                  ?>                                     
                  
                  <table class='contact'>
                     <tr>
                        <th colspan='2'>Please place a check-mark to indicate the purpose of your email:</th>
                     </tr>

                     <tr>
                        <td colspan='2'><input type="checkbox" name="ch0" value="renew"<?php echo $ch0; ?>>      
                        <label for "ch0">NOMAS<sup>&reg;</sup> License Renewal</label></td>
                     </tr>                           

                     <tr>
                        <td colspan='2'><input type="checkbox" name="ch1" value="nomas"<?php echo $ch1; ?>>      
                        <label for "ch1">NOMAS<sup>&reg;</sup> Training (send brochure or ask question)</label></td>
                     </tr>                         
                     
                     <tr>
                        <td colspan='2'><input type="checkbox" name="ch2" value="olce"<?php echo $ch2; ?>>      
                        <label for "ch2">Online Continuing Education (questions/problems)</label></td>
                     </tr>  
                     
                     <tr>
                        <td colspan='2'><input type="checkbox" name="ch3" value="update"<?php echo $ch3; ?>>      
                        <label for "ch3">Update my NOMAS<sup>&reg;</sup> Registry listing</label></td>
                     </tr>  
                     
                     <tr>
                        <td colspan='2'><input type="checkbox" name="ch4" value="other"<?php echo $ch4; ?>>      
                        <label for "ch4">Other</label></td>
                     </tr>                                                                                
                     <tr>
                        <td colspan='2'></td>
                     </tr>                                        
                     <tr>
                        <th colspan='2'><span class='red_dot'>*</span> Required Information</th>
                     </tr>
                     <tr>
                        <td><label for "name"><span class='red_dot'>*</span> Name:</label></td>
                        <td><input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['name']) || !empty($formError['name'])) ? "<tr><td></td><td><div class='error'>" . $formError['name'] . "</div></td></tr>" : '' ?>   
                     
                     <tr>
                        <td><label for "email"><span class='red_dot'>*</span> Email:</label></td>
                        <td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['email']) || !empty($formError['email'])) ? "<tr><td></td><td><div class='error'>" . $formError['email'] . "</div></td></tr>" : '' ?>                     
                     
                     <tr>
                        <td><label for "addr1">Address 1:</label></td>
                        <td><input type="text" name="addr1" value="<?php echo htmlspecialchars($addr1); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['addr1']) || !empty($formError['addr1'])) ? "<tr><td></td><td><div class='error'>" . $formError['addr1'] . "</div></td></tr>" : '' ?>   
                     
                     <tr>
                        <td><label for "addr2">Address 2:</label></td>
                        <td><input type="text" name="addr2" value="<?php echo htmlspecialchars($addr2); ?>" maxlength="50" /></td>
                     </tr>
                     
                     <tr>
                        <td><label for "city">City:</label></td>
                        <td><input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['city']) || !empty($formError['city'])) ? "<tr><td></td><td><div class='error'>" . $formError['city'] . "</div></td></tr>" : '' ?>
                                          
                     <tr>
                        <td><label for "state">State/Province:</label></td>
                        <td><input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['state']) || !empty($formError['state'])) ? "<tr><td></td><td><div class='error'>" . $formError['state'] . "</div></td></tr>" : '' ?>
    
                     <tr>
                        <td><label for "country">Country:</label></td>
                        <td><input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['country']) || !empty($formError['country'])) ? "<tr><td></td><td><div class='error'>" . $formError['country'] . "</div></td></tr>" : '' ?>
                     
                     <tr>
                        <td><label for "zip">Postal Code:</label></td>
                        <td><input type="text" name="zip" value="<?php echo htmlspecialchars($zip); ?>" maxlength="15" /></td>
                     </tr>
                     <?php echo (isset($formError['zip']) || !empty($formError['zip'])) ? "<tr><td></td><td><div class='error'>" . $formError['zip'] . "</div></td></tr>" : '' ?>                     
                     
                     <tr>
                        <td><label for "phone">Phone:</label></td>
                        <td><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" maxlength="50" /></td>
                     </tr>
                     <?php echo (isset($formError['phone']) || !empty($formError['phone'])) ? "<tr><td></td><td><div class='error'>" . $formError['phone'] . "</div></td></tr>" : '' ?>                        
                     <tr><td colspan='2'></td></tr>
    
                     <tr>
                        <th colspan='2'><span class='red_dot'>*</span> Message:</th>
                     </tr>
    
                     <tr>
                        <td colspan='2'><textarea cols="70" rows="15" name="message"><?php echo htmlspecialchars($message)?></textarea></td>
                     </tr>
                     <?php echo (isset($formError['message']) || !empty($formError['message'])) ? "<tr><td></td><td><div class='error'>" . $formError['message'] . "</div></td></tr>" : '' ?>
                  </table>                                                                              		        
                                                               
                  <div class='clearAll'></div>         
                  <div class='spacer_26'></div>	
                  
                  <div>
                     <img id="captcha" src="_inc/securimage/securimage_show.php" alt="CAPTCHA Image" />
                     <a href="#" onclick="document.getElementById('captcha').src = '_inc/securimage/securimage_show.php?' + Math.random(); this.blur(); return false">
                     <img style='padding:16px 20px;' src="_inc/securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" border="0"></a>                   
                     <br style='clear:both'><br>
                     <label for="captcha">Please enter below the anti-spam code from above. NOT CASE SENSITIVE.<br>(If code is too obscure, click circular arrows for another one):</label><br><br>
                     <input style='width:20%;' type="text" name="captcha_code" maxlength="6" />  
                  </div>                   
                   <?php echo (isset($formError['captcha_code']) && !empty($formError['captcha_code'])) 
                   ? "<div class='error'>" . $formError['captcha_code'] . "</div></td></tr>" : ""; ?> 
                  
                  <button type="submit" name="submit" value="submit">Send Message</button>        
                  </form>
                  
             </div><!--end contact_form_box-->   
        </div><!--end l_item-->          
        <div class='clearAll'></div>
                       
    </div><!--END COLUMN LEFT-->             

    <div class='clearAll'></div>

    </div> <!-- end content  -->
  
    <!--FOOTER-->
    <div id="footer"> 
       <?php showBottomMenu(); showCopyright($thisYear); ?>
    </div><!-- end footer -->
 

</div><!-- end #playround -->
</body>
</html>
