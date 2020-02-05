<?php
// This is required as the normal sitelokpw.php can't be called here as the session is not passed through
@error_reporting (E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_USER_DEPRECATED);
require_once("../../slconfig.php");
$cursess=$_GET['cursess'];
session_id($cursess);
if ($SessionName!="")
session_name($SessionName);	    
session_start();
if (($_SESSION['ses_slloginkey']!="LOGGEDIN") || (false===strpos($_SESSION['ses_slusergroups'],"ADMIN")))
  exit;
?><?php
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (!empty($_FILES))
{
// Mod as DOCUMENT_ROOT is not alwyas correct on some servers
if ($_SESSION['ses_EmailURL']!="")
  $locfromroot=GetRelativeToRoot($_SESSION['ses_EmailURL']);
else
  $locfromroot="/slpw/email";
$root=str_replace($locfromroot,"",$_SESSION['ses_EmailLocation']);
$root=RemoveLastSlash($root);

// $root now replaces the $_SERVER['DOCUMENT_ROOT'] below
// End of mod


	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $root . $_REQUEST['folder'] . '/';
	// Check if path is inside email folder and not demo mode

	if ((0!==strpos($targetPath,$_SESSION['ses_EmailLocation'])) || ($DemoMode))
    exit;

	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];

//   $allowedExt = isset($_REQUEST['fileext']) ? $_REQUEST['fileext'] : "";
//	 $fileTypes  = str_replace('*.','',$allowedEx);
//	 $fileTypes  = str_replace(';','|',$fileTypes);
//	 $typesArray = split('\|',$fileTypes);
   $fileParts  = pathinfo($_FILES['Filedata']['name']);

//$allowedExt="notblank";
$typesArray=array('gif','jpg','png','wma','wmv','swf','doc','zip','pdf','txt');

	 if (in_array(strtolower($fileParts['extension']),$typesArray))
	 {
		 // Uncomment the following line if you want to make the directory if it doesn't exist
		 // mkdir(str_replace('//','/',$targetPath), 0755, true);

		 move_uploaded_file($tempFile,$targetFile);
		 echo str_replace($root,'',$targetFile);
	 }
	 else
	 {
	   echo 'Invalid file type.';
	 }
}
// Mod
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
?>
