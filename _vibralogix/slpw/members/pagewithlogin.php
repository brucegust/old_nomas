<?php
$groupswithaccess="PUBLIC";
$loginpage="pagewithlogin.php";
$logoutpage="pagewithlogin.php";
$loginredirect=2;
require_once("../sitelokpw.php");
?>
<html>
<head>
<title>Page with login</title>
</head>
<body>
This page can be seen by anyone who visits.
<?php if ($slpublicaccess) { ?>
<p> You can log in using the form below if you wish.</p>
<p></p>
<?php if ($msg!="") print $msg; ?>
<form name="siteloklogin" action="<?php print $startpage; ?>" method="POST" onSubmit="return validatelogin()">
<?php siteloklogin(); ?>
Username<br>
<input type="text" name="username" value="" maxlength="50" size="20"><br>
Password<br>
<input type="password" name="password" value="" maxlength="50" size="20"><br>
<input type="Submit" name="login" value="Login"><br>
<a href="javascript: void forgotpw()"
title="Forgot your password? Enter username or email &amp; click link">
Forgot your password?</a>
</form>
<?php } ?>
<p>This text can be seen by all visitors</p>
<?php if (!$slpublicaccess) { ?>
<p>This part can only be seen by logged in members.</p>
<p>You are logged in as <?php echo $slusername; ?></p>
<p>click here to <a href="<?php siteloklogout()?>">Logout</a></p>
<?php } ?>
</body>
</html>
