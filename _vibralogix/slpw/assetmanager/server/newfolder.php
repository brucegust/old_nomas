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
// End of mod
$newfolder = $root . $_POST["folder"];
// Check if path is inside email folder and not demo mode
if ((0===strpos($newfolder,$EmailLocation)) && (!$DemoMode))
{
  $parent = dirname($newfolder);
  
  if(!is_writable($parent)) {
  	echo "Write permission required";
  	exit();
  }
  
  if(!file_exists ($newfolder)) {
  	//create the folder
  	mkdir($newfolder);
  } else {
  	echo "Folder already exists.";
  }
}
?>