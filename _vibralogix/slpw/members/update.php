<?php require_once("../sitelokpw.php"); ?>
<html>
<head><title>Update registration details</title></head>
<body>
<?php if ($msg!="") print $msg; ?>
<br>
<form name="sitelokmodify" method="post" action="<?php print $thispage; ?>">
<?php sitelokmodify("updateuser.htm","updateuseradmin.htm","","NYYYYY"); ?>
New Password (leave blank to not change it) <br>
<input type="password" name="newpassword" maxlength="50" size="30"><br>
Verify Password<br>
<input type="password" name="verifynewpassword" maxlength="50" size="30"><br>
Name<br>
<input type="text" name="newname" maxlength="50" size="30" value="<?php echo $newname; ?>"><br><br>
Email<br>
<input type="text" name="newemail" maxlength="50" size="30" value="<?php echo $newemail; ?>"><br><br>
What kind of digital camera do you use<br>
<input type="text" name="newcustom1" maxlength="250" size="30" value="<?php echo $newcustom1; ?>"><br><br>
Where did you hear about us<br>
<input type="text" name="newcustom2" maxlength="250" size="30" value="<?php echo $newcustom2; ?>"><br><br>
<input type="submit" value="Save Changes">
</form>
<p><a href="members.php">Members Home</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php siteloklogout()?>">Logout</a>
</body>
</html>
