<?php
$groupswithaccess="ADMIN";
$startpage="../../index.php";
require("../../sitelokpw.php");
?><?php
// Mod as DOCUMENT_ROOT is not alwyas correct on some servers
//$root=$_SERVER["DOCUMENT_ROOT"];
if ($EmailURL!="")
  $locfromroot=GetRelativeToRoot($EmailURL);
else
  $locfromroot="/slpw/email";
$root=str_replace($locfromroot,"",$EmailLocation);
$root=RemoveLastSlash($root);

function GetRelativeToRoot($a)
{
  $pos=strpos($a,"/",8);
  if (is_integer($pos))
    $a=substr($a,$pos);
  else
    return("/");
  if ($a!="/")    
    $a=RemoveLastSlash($a);
  return($a);    
} 
function RemoveLastSlash($a)
{
  if (substr($a,strlen($a)-1,1)=="/")
    $a=substr($a,0,strlen($a)-1);  
  return($a);     
}

// Check if path is inside email folder and not demo mode
if ((0===strpos($root.dirname($_POST['file'])."/",$EmailLocation)) && (!$DemoMode))
{
  // End of mod
  $file = $root . $_POST["file"];
  if(file_exists ($file)) {
  	unlink($file);
  } else {
  
  }
}

echo $_POST["file"];

?>