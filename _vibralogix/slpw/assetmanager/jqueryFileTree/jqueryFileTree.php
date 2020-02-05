<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//

// Mod as DOCUMENT_ROOT not always corect on some servers
//$root=$_SERVER["DOCUMENT_ROOT"];
$groupswithaccess="ADMIN";
$startpage="../index.php";
require("../../sitelokpw.php");
$_POST['dir'] = urldecode($_POST['dir']);
if ($EmailURL!="")
  $locfromroot=GetRelativeToRoot($EmailURL);
else
  $locfromroot="/slpw/email";
$root=str_replace($locfromroot,"",$EmailLocation);
$root=RemoveLastSlash($root);
// Check if path is inside email folder
if (0===strpos($root.$_POST['dir'],$EmailLocation))
{
  //$_POST['dir'] = urldecode($_POST['dir']);
  // End of mod
  
  if( file_exists($root . $_POST['dir']) ) {
  	$files = scandir($root . $_POST['dir']);
  	natcasesort($files);
  	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
  		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
  		// All dirs
  		foreach( $files as $file ) {
  			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
  				echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
  			}
  		}
  		// All files
  		foreach( $files as $file ) {
  			if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
  				$ext = preg_replace('/^.*\./', '', $file);
  				echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
  			}
  		}
  		echo "</ul>";
  	}
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