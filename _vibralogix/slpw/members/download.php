<?php
$groupswithaccess="CLIENT";
require_once("../sitelokpw.php");
?>
<html>
<head>
<title>Download</title>
</head>
<body>
<p>This page contains an example Sitelok download link. To test this you need to upload<br>
a file called test.zip to the folder created on your server for downloads which is<br>
defined in the File Location setting in Sitelok admin.</p>
<p>To download the file click here <a href="<?php siteloklink('test.zip',1)?>">test.zip</a></p>
<p><a href="<?php siteloklogout()?>">Logout</a>
</p>
</body>
</html>
