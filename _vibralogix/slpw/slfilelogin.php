<?php
$groupswithaccess="ALL";
require_once("sitelokpw.php");
if ((!isset($_GET['slfilelogin'])) || (trim($_GET['slfilelogin'])==""))
{
  print "access denied";
  exit;
}
$download=trim($_GET['slfilelogin']);
$download=rawurldecode($download);	
$download=base64_decode($download);
$fields=explode(",",$download);
if (count($fields)==3)
{
  $returnpage=$fields[0];
  $groupsallowed=$fields[1];
  $hash=$fields[2];
  $verifyhash=md5("filelogin".$SiteKey.$returnpage.$groupsallowed);
  if ($verifyhash!=$hash)
  {
    print "access denied";
    exit;
  }
  // If groups listed then check user is active member of one of them
  if ($groupsallowed!="")
  {
    $gwa=explode(",",$groupsallowed);
    $match=false;
    for($k=0;$k<count($gwa);$k++)
    {
      if (sl_isactivememberof(trim($gwa[$k])))
      {
        $match=true;
        break;
      }  
    }
    if (!$match)
    {
      if ($WrongGroupPage!="")
      {
        if ((strtolower(substr($WrongGroupPage,0,7))=="http://") || (strtolower(substr($WrongGroupPage,0,8))=="https://"))
          header("Location: ".$WrongGroupPage);      
        else              
      		include $WrongGroupPage;
      }
    	else
  	    sl_ShowMessage($MessagePage,MSG_WRONGGROUP);    
      exit;
    }
  }
  header("Location: ".$returnpage);
  exit;
}
if (count($fields)==9)
{
  $fname=$fields[0];
  $expirytime=$fields[1];
  $param1=$fields[2];
  $param2=$fields[3];
  $dialog=$fields[4];
  $timenow=$fields[5];
  $returnpage=$fields[6];
  $groupsallowed=$fields[7];
  $hash=$fields[8];
  $verifyhash=md5("filelogin".$SiteKey.$fname.$expirytime.$dialog.$param1.$param2.$timenow.$returnpage.$groupsallowed);
  if ($verifyhash!=$hash)
  {
    print "access denied";
    exit;
  }
  // If groups listed then check user is active member of one of them
  if ($groupsallowed!="")
  {
    $gwa=explode(",",$groupsallowed);
    $match=false;
    for($k=0;$k<count($gwa);$k++)
    {
      if (sl_isactivememberof(trim($gwa[$k])))
      {
        $match=true;
        break;
      }  
    }
    if (!$match)
    {
      if ($WrongGroupPage!="")
      {
        if ((strtolower(substr($WrongGroupPage,0,7))=="http://") || (strtolower(substr($WrongGroupPage,0,8))=="https://"))
          header("Location: ".$WrongGroupPage);      
        else              
      		include $WrongGroupPage;
      }
    	else
  	    sl_ShowMessage($MessagePage,MSG_WRONGGROUP);    
      exit;
    }
  }  
  // Adjust expiry to be based on original timenow
  if (($expiry != 0) && (strlen($expiry) == 12))
  {
    if (time()>=$timenow)
    {
      print "This link has expired";
      exit;
    }
    $expiry=$expiry-((time()-$timenow)/60);
  }
  $downloadlink=sl_siteloklink($fname,$dialog,$expiry,$param1,$param2);
  $downloadlink=$SitelokLocationURL."sitelokpw.php".$downloadlink;
  // Get rid of location part of filename
  $filename=strtok($fname,":");
  // Now get page template to insert details into
  $page="";
  // See if background page is html or php
  $dialog=$SitelokLocation.$dialog;
  $ext = sl_fileextension($dialog);  
  if ($ext == ".php")
  {
    ob_start();
    include($dialog);
    $page = ob_get_contents(); 
    ob_end_clean(); 
  }
  else
  {
    if ($fh = @fopen($dialog, "r"))
    {
      $page = fread ($fh, 200000);
      fclose($fh);
    }
  }
  if ($page!="")
  {  
    $page = str_replace("<body", "<body onLoad=\"setTimeout('download()',5000); \"", $page);      
    $redirectcode ="<script type=\"text/javascript\">\n";
    $redirectcode.="function download()\n";
    $redirectcode.="{\n";
    $redirectcode.="  window.location=\"!!!link!!!\"\n";
    $redirectcode.="}\n";
    $redirectcode.="</script>\n";
    $redirectcode.="</body>\n";  
    $page = str_replace("</body>", $redirectcode, $page);
    $page = str_replace("!!!link!!!", $downloadlink, $page);
    $page = str_replace("!!!filename!!!", $filename, $page);    
    $page = str_replace("!!!returnpage!!!", $returnpage, $page);    
    print $page;
    exit;      
  }  
  print $page;
  exit;
}
print "access denied";
?>