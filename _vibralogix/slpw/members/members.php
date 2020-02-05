<?php
$groupswithaccess="CLIENT";
require_once("../sitelokpw.php");
?>
<html>
<head>
<title>Members only page 1</title>
</head>
<body>
<p>Hello <?php echo $slfirstname; ?>! This page is visible to members only.</p>
<p>You can visit another members only page by <a href="members2.php">clicking here</a>.</p>
<br>
<br>
<br>
<p><a href="update.php">Modify Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php siteloklogout()?>">Logout</a>
</p>
</body>
</html>
