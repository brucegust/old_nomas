<?php require_once("../sitelokregister.php"); ?>
<html>
<head><title>Register</title></head>
<body>
<?php if ($registermsg!="") print $registermsg; ?><br>
<form name="sitelokregisteruser" action="registerapprove.php" method="POST">
<?php registeruser("CLIENT","365","/members/registerthanks.php","pending.htm","pendingadmin.htm","No","YNYYYY"); ?>
Name<br>
<input type="text" name="name" maxlength="50" size="30" value="<?php echo $name; ?>"><br><br>
Email<br>
<input type="text" name="email" maxlength="50" size="30" value="<?php echo $email; ?>"><br><br>
What kind of digital camera do you use<br>
<input type="text" name="custom1" maxlength="255" size="30" value="<?php echo $custom1; ?>"><br><br>
Where did you hear about us<br>
<input type="text" name="custom2" maxlength="255" size="30" value="<?php echo $custom2; ?>"><br><br>
<input type="submit" name="Button1" value="Register">
</form>
</body>
</html>
