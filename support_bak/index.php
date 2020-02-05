<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

require_once "_inc/_always.php";

if(session_id() == '') { session_start(); }

//*****************************************************************
//*****************************************************************
//*****************************************************************

$pageTitle    = "NOMAS<sup>&reg;</sup> International";
$pageSubTitle = "Please Login:";
$fname = $lname = $password = '';  

//*****************************************************************
//*****************************************************************
//*****************************************************************

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
   if (isset($_POST['fname'])    && $_POST['fname'] > '' && 
       isset($_POST['lname'])    && $_POST['lname'] > '' && 
	   isset($_POST['password']) && $_POST['password'] > '') {	  
       $errorMsg = cms_login($_POST);
       $fname = $lname = $password = '';  
	   unset($_POST);
   } else {   
	   $errorMsg = "All fields required";
       $fname = $lname = $password = '';  
	   unset($_POST);	   
   }	
}  
//*****************************************************************
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="cleartype" content="on" />
<title>NOMAS International CMS</title>
<meta name="viewport" content="width=device-width" />
<meta name="robots" content="noindex">
<link href="_css/css_login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="playground">

  <div id='header'><?php showSmallLogo(); ?></div>
  
  <div class='clearAll'></div>
    
    <!-- RIGHT COL  CONTENT -->
    <div id='playpen'>
    
      <div class='pageTitle'><?php echo $pageTitle ?></div>
      
      <?php if (isset($pageSubTitle) && $pageSubTitle > '') {
         echo "<div class='pageSubTitle'>" . $pageSubTitle . "</div>";
	  } ?>
      
      <?php if (isset($errorMsg) && $errorMsg > '') {
         echo "<div class='error_msg'>" . $errorMsg . "</div>";
	  } ?>            
      
      <form id="form_login" action='<?php echo "{$_SERVER['PHP_SELF']}"?>' method="POST">
      
         <label>First Name:</label>
         <input name="fname" type="text" value="<?php echo $fname ?>" size="70" maxlength="20">
         
         <label>Last Name:</label>
         <input name="lname" type="text" value="<?php echo $lname ?>" size="70" maxlength="20">
         
         <label>Password:</label>
         <input name="password" type="password" value="<?php echo $password ?>" size="70" maxlength="16">
         
         <button type="submit" name="submit" value="submit">LogIn</button>
         
      </form>
        
    </div> <!-- playpen -->
    
  
  <div class='clearAll'></div>
  
  <!--FOOTER-->
  <div id="footer"> 
    <?php showCopyright($thisYear); ?>
  </div><!-- end footer -->
  
</div><!-- CONTENT BOX -->

<div class='clearAll'></div>

</div><!-- end #playround -->

</body>
</html>
