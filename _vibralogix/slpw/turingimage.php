<?php
  @error_reporting (E_ERROR);
  @include("slconfig.php");
  if ($ValidCaptchaChars=="")
    $ValidCaptchaChars="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  if ($SessionName!="")
    session_name($SessionName);
  session_start();
  $validchars  = $ValidCaptchaChars;
  // Generate a random code word
  $turingcode="";
  for ($k=0;$k<5;$k++)
    $turingcode.=substr($validchars,mt_rand(0,strlen($ValidCaptchaChars)-1),1);
  if ($_SESSION['ses_slturingcode']!="")
    $_SESSION['ses_slpreviousturingcode']=$_SESSION['ses_slturingcode'];  
  $_SESSION['ses_slturingcode']=$turingcode;  
  // Choose a random background image  
  $bg=mt_rand(1,4);
  $image = imagecreatefromjpeg("turingbg$bg.jpg");
  // Select black text
  $txtcolor = imagecolorallocate ($image, 0, 0, 0);
  // Add text to background
  imagestring ($image, 5, 5, 8,  $turingcode, $txtcolor);
  // Send image to browser
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  header('Content-type: image/jpeg');
  imagejpeg($image);
  imagedestroy($image);
?>
