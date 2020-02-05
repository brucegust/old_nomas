<?php
$groupswithaccess="CLIENT";
require_once("../sitelokpw.php");
?>
<html>
<head>
<title>Members only page 2</title>
</head>
<body>
<p>Hello <?php echo $slfirstname; ?>! I hope you are enjoying using your <?php echo $slcustom1; ?> camera.</p>
<p>You can visit another members only page by <a href="members.php">clicking here</a>.</p>
<br>
<br>
<br>
<p><a href="update.php">Modify Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php siteloklogout()?>">Logout</a>
</p>
</body>
</html>
