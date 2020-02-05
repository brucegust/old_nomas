<html>
<head>
<title>Login</title>
</head>
<body>
<?php if ($msg!="") print $msg; ?>
<form name="siteloklogin" action="<?php print $startpage; ?>" method="POST" onSubmit="return validatelogin()">
<?php siteloklogin(); ?>
Username<br>
<input type="text" name="username" value="<?php print $slcookieusername; ?>" maxlength="50" size="20">
<br>
Password<br>
<input type="password" name="password" value="<?php print $slcookiepassword; ?>" maxlength="50" size="20">
<br>
Remember me 
<input name="remember" type="checkbox" value="1" <?php if ($slcookielogin=="1") print "CHECKED"; ?>>
<br>
Security code <br>
<input name="turing" type="text" value="" maxlength="5" size="8">&nbsp;<img src="/slpw/turingimage.php" width="60" height="30" align="absmiddle">
<br>
<input type="Submit" name="login" value="Login"><br>
<a href="javascript: void forgotpw()"
title="Forgot your password? Enter username or email &amp; click link">
Forgot your password?</a>
</form>
</body>
</html>
