<?php
session_cache_limiter('none');
require_once("getconfig.php");
// Don't change message text here. Change the settings in slconfig.php if necessary
if (!defined('MSG_ACCDEN'))
  define("MSG_ACCDEN","Access Denied");
if (!defined('MSG_DOWNAUTH'))
  define("MSG_DOWNAUTH","Permission to download denied. Authentication failed");
if (!defined('MSG_DOWNEXP'))
  define("MSG_DOWNEXP","Sorry but this download link has expired");
if (!defined('MSG_FILEOPEN')) 
  define("MSG_FILEOPEN","Sitelok could not open the file");

$auth="";
$authe="";
if (isset($_REQUEST['auth']))
  $auth=$_REQUEST['auth'];
if (isset($_REQUEST['authe']))
  $authe=$_REQUEST['authe'];  
if ($authe!="")
{ 
  // Remove any /filename from end
  $pos=strrpos($authe,"/");
  if (is_integer($pos))
  	$decauthe=substr($authe,0,$pos);
  $decauthe = rawurldecode($decauthe);
  $decauthe=base64_decode($decauthe);
  $filename = strtok($decauthe, ",");
  $expiry = strtok(",");
  $username = strtok(",");
  $hash = md5($SiteKey . $filename . $expiry . $username);
  $verifyhash = strtok(",");
  $verifyhash = trim($verifyhash); // Clean up problem with strtok
  $filename=strtok($filename,":");
  $loc=strtok(":");	  
  if ($verifyhash != $hash)
  {
    sl_ShowMessage($MessagePage, MSG_DOWNAUTH);
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$username,"Download link authentication failed for ".$filename);
    exit;
  } 
  $downloadbackground="";
  if (file_exists($SitelokLocation."emaildownloadpage.php"))
    $downloadbackground=$SitelokLocation."emaildownloadpage.php";
  if ($downloadbackground!="")
  {
    $page="";
    ob_start();
    include $downloadbackground;
    $page = ob_get_contents(); 
    ob_end_clean();    
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
      $page = str_replace("!!!link!!!", $SitelokLocationURL."linkloksl.php?auth=".$authe, $page);
      $page = str_replace("!!!filename!!!", $filename, $page);
      $page = str_replace("!!!username!!!", $username, $page);
      print $page;
      exit;      
    }
    else
      $auth=$authe;
  }
  else
    $auth=$authe;
}  
if ($auth!="")
{
  // Remove any /filename from end
  $pos=strrpos($auth,"/");
  if (is_integer($pos))
  	$auth=substr($auth,0,$pos);
  $auth = rawurldecode($auth);
  $auth=base64_decode($auth);
  $filename = strtok($auth, ",");
  $expiry = strtok(",");
  $username = strtok(",");
  $hash = md5($SiteKey . $filename . $expiry . $username);
  $verifyhash = strtok(",");
  $verifyhash = trim($verifyhash); // Clean up problem with strtok
  $filename=strtok($filename,":");
  $loc=strtok(":");	  
  if ($verifyhash != $hash)
  {
    sl_ShowMessage($MessagePage, MSG_DOWNAUTH);
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$username,"Download link authentication failed for ".$filename);
    exit;
  } 
  // auth is OK but we should now check if link expired
  if ($expiry != 0)
  {
    $curtime = time();
    if ($curtime > $expiry)
    {
      sl_ShowMessage($MessagePage, MSG_DOWNEXP);
      if (substr($LogDetails,4,1)=="Y")
  		  sl_AddToLog("Download Problem",$username,"Download link expired for ".$filename);
      exit;
    }
  }
  // Close session to allow parallel downloads
  session_write_close();
  // Everything is OK so we can allow download of file
  if ($loc=="")
    $link=$FileLocation.$filename;
  else
    $link=$FileLocations[$loc].$filename;
  // Replace any ; with | to handle S3 locations
  $link=str_replace(";","|",$link);  
  // If download path is for S3 then handle it now
  if (substr(trim(strtolower($link)),0,3)=="s3|")
  {
    // Event point
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onDownloadEmail[$p]))
        call_user_func($slplugin_event_onDownloadEmail[$p],$slpluginid[$p],$username,$link,$loc);
    }
    // Call user event handler    
    if (function_exists("sl_onDownloadEmail"))
      sl_onDownloadEmail($username,$link,$loc);    
    $url=sl_get_s3_url($link,time()+$ServerTimeAdjust,"GET");
    if (substr($LogDetails,3,1)=="Y")
  	  sl_AddToLog("Download",$username,$filename);
    header("Location: ".$url);
    exit;
  }              
  $pos = strpos(strtolower($link), "http://");
  if (is_integer($pos))
  {
    $s=sl_filesize_remote($link);
    if (is_integer($s))
    	$size=$s;
  }
  else
    $size = @filesize($link);
  // If download link is php page then just include it.
  $ext = sl_fileextension($link);
  $fname = basename($link);
  // If download link is html or php page then just include it.
  if (($ext==".php") || ($ext==".html") || ($ext==".htm"))
  {
    // If there are any GET variables in the filename then set those in $_GET and $_REQUEST
    $pos=strpos($link,"?");
    if (is_integer($pos))
    {
      $fquery=substr($link,$pos+1);
      $link=substr($link,0,$pos);
    }
    if ($fquery!="")
    {
      $fvars=explode("&",$fquery);
      for ($k=0;$k<count($fvars);$k++)
      {
        $fvar=strtok($fvars[$k],"=");
        $fval=strtok("=");
        if ($fvar!="")
        {
          $_GET[$fvar]=$fval;
          $_REQUEST[$fvar]=$fval;
        }
          
      }
    }
    include ($link);
    exit;
  }
  $mimetype=sl_getmimetype($link);
  // Event point
  // Allow event handler or plugin to handle the actual download (not S3 or .html or .php though)
  // The download transfer handler should log the download, session_write_close(); and exit if handled.
  // Call plugin event
  $paramdata['username']=$username;
  $paramdata['link']=$link;
  $paramdata['loc']=$loc;
  $paramdata['param1']="";
  $paramdata['param2']="";
  $paramdata['dialog']="";
  $paramdata['expirytime']=$expiry;
  $paramdata['timenow']=time();
  $paramdata['mime']=$mimetype;
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onDownloadTransferEmail[$p]))
      call_user_func($slplugin_event_onDownloadTransferEmail[$p],$slpluginid[$p],$paramdata);
  }
  // Call user event handler 
  if (function_exists("sl_onDownloadTransferEmail"))
    sl_onDownloadTransferEmail($paramdata);  
  // Check file exists
  if (!is_readable($link))
  {
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$slusername,"Could not open ".$fname);
    sl_ShowMessage($MessagePage,MSG_FILEOPEN);
    exit;
  }    	   
  header("Content-disposition: attachment; filename=\"".basename($link)."\"\n");
  if ($mimetype!="")
    header("Content-type: ".$mimetype."\n");      
  else 
    header("Content-type: application/octet-stream\n");          
  header("Content-transfer-encoding: binary\n");  
  // See if link is local path or URL
  $pos = strpos(strtolower($link), "http://");
  if (!is_integer($pos))
  {
    $fsize = $size;
    /* is resume requested? */
  	if (isset($_SERVER['HTTP_RANGE']))
    {
    	$fp = @fopen($link, 'rb');
      if ($fp===false)
      {
        if (substr($LogDetails,4,1)=="Y")
    		  sl_AddToLog("Download Problem",$slusername,"Could not open ".$fname);
        sl_ShowMessage($MessagePage,MSG_FILEOPEN);
        exit;
      }    	 
    	$size   = filesize($link); // File size
    	$length = $size;           // Content length
    	$start  = 0;               // Start byte
    	$end    = $size - 1;       // End byte
    	 /* Multiple ranges requires some more work to ensure it works correctly
    	 * and comply with the specifications: http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
    	 *
    	 * Multirange support annouces itself with:
    	 * header('Accept-Ranges: bytes');
    	 *
    	 * Multirange content must be sent with multipart/byteranges mediatype,
    	 * (mediatype = mimetype)
    	 * as well as a boundry header to indicate the various chunks of data.
    	 */
//    	header("Accept-Ranges: 0-$length");
    	header("Accept-Ranges: bytes");
    	// header('Accept-Ranges: bytes');
    	// multipart/byteranges
    	// http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html#sec19.2
    	if (isset($_SERVER['HTTP_RANGE'])) {
     
    		$c_start = $start;
    		$c_end   = $end;
    		// Extract the range string
    		list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    		// Make sure the client hasn't sent us a multibyte range
    		if (strpos($range, ',') !== false) {
     
    			// (?) Shoud this be issued here, or should the first
    			// range be used? Or should the header be ignored and
    			// we output the whole content?
    			header('HTTP/1.1 416 Requested Range Not Satisfiable');
    			header("Content-Range: bytes $start-$end/$size");
    			// (?) Echo some info to the client?
    			exit;
    		}
    		// If the range starts with an '-' we start from the beginning
    		// If not, we forward the file pointer
    		// And make sure to get the end byte if specified
    		if ($range0 == '-')
    		{
          // Call plugin event
          for ($p=0;$p<$slnumplugins;$p++)
          {
            if (function_exists($slplugin_event_onDownloadEmail[$p]))
              call_user_func($slplugin_event_onDownloadEmail[$p],$slpluginid[$p],$username,$link,$loc);
          }
          // Call user event handler          
          if (function_exists("sl_onDownloadEmail"))
            sl_onDownloadEmail($username,$link,$loc);            
          if (substr($LogDetails,3,1)=="Y")
        	  sl_AddToLog("Download",$username,$filename);
    			// The n-number of the last bytes is requested
    			$c_start = $size - substr($range, 1);
    		}
    		else
    		{
    			$range  = explode('-', $range);
    			$c_start = $range[0];
    			$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
    		}
    		/* Check the range and make sure it's treated according to the specs.
    		 * http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
    		 */
    		// End bytes can not be larger than $end.
    		$c_end = ($c_end > $end) ? $end : $c_end;
    		// Validate the requested range and return an error if it's not correct.
    		if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
     
    			header('HTTP/1.1 416 Requested Range Not Satisfiable');
    			header("Content-Range: bytes $start-$end/$size");
    			// (?) Echo some info to the client?
    			exit;
    		}
    		$start  = $c_start;
    		$end    = $c_end;
    		$length = $end - $start + 1; // Calculate new content length
    		fseek($fp, $start);
    		header('HTTP/1.1 206 Partial Content');
    	}
    	// Notify the client the byte range we'll be outputting
    	header("Content-Range: bytes $start-$end/$size");
    	header("Content-Length: $length");	
    	// Start buffered download
      if ($sldownloadbuffer>0)
        $buffer=$sldownloadbuffer;
      else    
    	  $buffer = 1024 * 8;
      // Close session to allow parallel downloads
      session_write_close();	  
      @set_time_limit(86400); 
    	while(!feof($fp) && ($p = ftell($fp)) <= $end)
    	{
    		if ($p + $buffer > $end) {
     
    			// In case we're only outputting a chunk, make sure we don't
    			// read past the length
    			$buffer = $end - $p + 1;
    		}
    		echo fread($fp, $buffer);
        ob_flush();
    		flush(); // Free up memory. Otherwise large files will trigger PHP's memory limit.
        if ($sldownloadbuffer>10000)
           sleep(1);  
    	}
    	fclose($fp);
    }
    else
    {
      // Event point
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onDownloadEmail[$p]))
          call_user_func($slplugin_event_onDownloadEmail[$p],$slpluginid[$p],$username,$link,$loc);
      }
      // Call user event handler          
      if (function_exists("sl_onDownloadEmail"))
        sl_onDownloadEmail($username,$link,$loc);    
      if (!($fh = @fopen($link, "rb")))
      {
        if (substr($LogDetails,4,1)=="Y")
    		  sl_AddToLog("Download Problem",$username,"Could not open ".$filename);
        sl_ShowMessage($MessagePage, MSG_FILEOPEN);
        exit;
      }
    	header("Accept-Ranges: bytes");
      if ((strtolower(ini_get('zlib.output_compression'))!="on") && (ini_get('zlib.output_compression')!="1"))
        header("Content-Length: " . $size . "\n");
      if (substr($LogDetails,3,1)=="Y")
    	  sl_AddToLog("Download",$username,$filename);
      sl_xfpassthru($fh);
    }
  }
  else
  {
    // link is a URL rather than local path so do simple download
    // Event point
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onDownloadEmail[$p]))
        call_user_func($slplugin_event_onDownloadEmail[$p],$slpluginid[$p],$username,$link,$loc);
    }
    // Call user event handler    
    if (function_exists("sl_onDownloadEmail"))
      sl_onDownloadEmail($username,$link,$loc);    
		$link=str_replace(" ","%20",$link);	
    if (!($fh = @fopen($link, "rb")))
    {
      if (substr($LogDetails,4,1)=="Y")
  		  sl_AddToLog("Download Problem",$username,"Could not open ".$filename);
      sl_ShowMessage($MessagePage, MSG_FILEOPEN);
      exit;
    }
    if ((strtolower(ini_get('zlib.output_compression'))!="on") && (ini_get('zlib.output_compression')!="1"))
    {
      if ((int)$size > 0)
        header("Content-Length: " . $size . "\n");
    }  
    if (substr($LogDetails,3,1)=="Y")
  	  sl_AddToLog("Download",$username,$filename);
    sl_xfpassthru($fh);
  }
  exit;
}
else
{
    sl_ShowMessage($MessagePage,MSG_ACCDEN);
}
?>