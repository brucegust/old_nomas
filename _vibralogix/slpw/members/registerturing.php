<?php require_once("../sitelokregister.php"); ?>
<html>
<head><title>Register</title></head>
<body>
To use this example registration form you must enable the Turing Register<br>
option in Sitelok Admin - Configuration.<br>
<?php if ($registermsg!="") print $registermsg; ?><br>
<form name="sitelokregisteruser" action="registerturing.php" method="POST">
<?php registeruser("CLIENT","365","/members/registerthanks.php","newuser.htm","newuseradmin.htm","Yes","YNYYYY"); ?>
Name<br>
<input type="text" name="name" maxlength="50" size="30" value="<?php echo $name; ?>"><br><br>
Email<br>
<input type="text" name="email" maxlength="50" size="30" value="<?php echo $email; ?>"><br><br>
What kind of digital camera do you use<br>
<input type="text" name="custom1" maxlength="255" size="30" value="<?php echo $custom1; ?>"><br><br>
Where did you hear about us<br>
<input type="text" name="custom2" maxlength="255" size="30" value="<?php echo $custom2; ?>"><br><br>
Please enter the security code<br>
<input type="text" name="turing" maxlength="5" size="8" value="">&nbsp;<img src="../turingimage.php" width="60" height="30" align="absmiddle"><br>
<br>
<input type="submit" name="Button1" value="Register">
</form>
</body>
</html>
