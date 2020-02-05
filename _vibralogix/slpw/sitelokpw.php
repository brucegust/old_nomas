<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sitelok (Password Version) V4.0                                                                       //
// Copyright 2003-2013 Vibralogix                                                                        //
// You are licensed to use this on one domain only. Contact us for extra licenses	         		        	 //
// www.vibralogix.com																					                                           //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
@error_reporting (E_ERROR);
reset($_GET);
reset($_POST);
if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
require_once("getconfig.php");
require_once("sitelokapi.php"); 
// Don't change message text here. Change the settings in slconfig.php if necessary
if (!defined('MSG_ACCDEN'))
  define("MSG_ACCDEN","Access Denied");
if (!defined('MSG_DBPROB'))  
  define("MSG_DBPROB","There was a database problem");  
if (!defined('MSG_WRONGGROUP')) 
  define("MSG_WRONGGROUP","Your membership does not allow access to this page");
if (!defined('MSG_EXPIRED')) 
  define("MSG_EXPIRED","Access to this page is blocked because your membership has expired");
if (!defined('MSG_ACCESSFILE')) 
  define("MSG_ACCESSFILE","You are not allowed access to this file");
if (!defined('MSG_FILEOPEN')) 
  define("MSG_FILEOPEN","Sitelok could not open the file");
if (!defined('MSG_DOWNEXP'))
  define("MSG_DOWNEXP","Sorry but this download link has expired");
if (!defined('MSG_TURING1')) 
  define("MSG_TURING1","CAPTCHA code did not match");
if (!defined('MSG_PASSEMAIL')) 
  define("MSG_PASSEMAIL","Your login details have been emailed to you");
if (!defined('MSG_NOMATCH')) 
  define("MSG_NOMATCH","No match for username or email");
if (!defined('MSG_AUTHFAIL')) 
  define("MSG_AUTHFAIL","Authentication failed");
if (!defined('MSG_DISABLED')) 
  define("MSG_DISABLED","Access is currently disabled");
if (!defined('MSG_ACCESSLOC')) 
  define("MSG_ACCESSLOC","Access not allowed from this location");
if (!defined('MSG_SESSEXP')) 
  define("MSG_SESSEXP","Session has expired");
if (!defined('MSG_INACTEXP')) 
  define("MSG_INACTEXP","Session was inactive and expired");
if (!defined('MSG_ENTERUSER')) 
  define("MSG_ENTERUSER","Please enter your username");
if (!defined('MSG_ENTERPASS')) 
  define("MSG_ENTERPASS","Please enter your password");
if (!defined('MSG_ENTERTURING')) 
  define("MSG_ENTERTURING","Please enter the displayed CAPTCHA code");
if (!defined('MSG_FORGOT1')) 
  define("MSG_FORGOT1","Please enter your username or email address and the display CAPTCHA code");
if (!defined('MSG_FORGOT2')) 
  define("MSG_FORGOT2","Please enter your username or email address");
if (!defined('MSG_PASS5')) 
  define("MSG_PASS5","Password must be at least 5 characters long");
if (!defined('MSG_PASSNG')) 
  define("MSG_PASSNG","Password contains invalid characters");
if (!defined('MSG_PASSVER')) 
  define("MSG_PASSVER","Verify password does not match");
if (!defined('MSG_ENTERNAME')) 
  define("MSG_ENTERNAME","Please enter your name");
if (!defined('MSG_ENTEREMAIL')) 
  define("MSG_ENTEREMAIL","Please enter your valid email address");
if (!defined('MSG_USERNG'))   
  define("MSG_USERNG","Username contains invalid characters");
if (!defined('MSG_EMAILNG'))   
  define("MSG_EMAILNG","Email address is not valid");    
if (!defined('MSG_PROFUPDATED'))   
  define("MSG_PROFUPDATED","Your profile has been updated");
if (!defined('MSG_PROFPROBLEM'))   
  define("MSG_PROFPROBLEM","An error occurred and your profile was NOT updated");
if (!defined('MSG_USEREXISTS'))
  define("MSG_USEREXISTS","Sorry this username already exists");
if (!defined('MSG_UPLOADERROR'))
  define("MSG_UPLOADERROR","File upload failed");
if (!defined('MSG_UPLOADTYPE'))
  define("MSG_UPLOADTYPE","Files of this type cannot be uploaded");
if (!defined('MSG_EXPASSREQ'))
  define("MSG_EXPASSREQ","You must enter your existing password");
if (!defined('MSG_PROFUPDATEDVEREMAIL'))
  define("MSG_PROFUPDATEDVEREMAIL","Your profile has been updated. A confirmation link has been sent for you to verify the email address change.");
if (!defined('MSG_EMAILEXISTS'))
  define("MSG_EMAILEXISTS","Sorry this email address is already registered");
if (!defined('MSG_LOGINLINKHASH'))
  define("MSG_LOGINLINKHASH","Login link not valid");
if (!defined('MSG_LOGINLINKEXPIRED'))
  define("MSG_LOGINLINKEXPIRED","Login link has expired");
  
  
$found=false;
if (!empty($_REQUEST))
{
  reset($_REQUEST);
  while(list($namepair, $valuepair) = each($_REQUEST))
  {
    $namepair=strtolower($namepair);
  	if ($namepair=="dbpassword") $found=true;
  	if ($namepair=="thispage") $found=true;
  	if ($namepair=="sitelokloginkey") $found=true;
  	if ($namepair=="groupswithaccess") $found=true;
  	if ($namepair=="userswithaccess") $found=true;
  	if ($namepair=="maxsessiontime") $found=true;
  	if ($namepair=="maxinactivitytime") $found=true;
  	if ($namepair=="filelocation") $found=true;
  	if ($namepair=="expiredpage") $found=true;
  	if ($namepair=="wronggrouppage") $found=true;
  	if ($namepair=="noaccesspage") $found=true;
  	if ($namepair=="loginpage") $found=true;
  	if ($namepair=="messagepage") $found=true;
  	if ($namepair=="logoutpage") $found=true;
  	if ($namepair=="allowexpireduser") $found=true;
  	if ($namepair=="startpage") $found=true;  	
  	if ($namepair=="dbupdate") $found=true;  	
  	if ($namepair=="demomode") $found=true;  	
  	if ($namepair=="allowsearchengine") $found=true;    	
  	if ($namepair=="searchenginegroup") $found=true;    	
  	if ($namepair=="manualloginonly") $found=true;    	
  	if ($namepair=="profilepassrequired") $found=true;    	
  	if ($namepair=="emailconfirmrequired") $found=true;    	
  	if ($namepair=="emailconfirmtemplate") $found=true;    	
  	if ($namepair=="emailunique") $found=true;    	
  	if ($namepair=="loginredirect") $found=true;    	
  	if ($namepair=="redirectafterlogin") $found=true;    	
  	if ($namepair=="logembedded") $found=true;    	
  	if ($namepair=="sl_cookiesecure") $found=true;    	
  	if ($namepair=="sl_cookiehttponly") $found=true;    	
  	if ($namepair=="sl_nocaptchawithhash") $found=true;    	
  }
}
if ($found)
{
  sl_ShowMessage($MessagePage,MSG_ACCDEN);
  exit;
}
$thispage=htmlentities($_SERVER['PHP_SELF'],ENT_QUOTES,strtoupper($MetaCharSet));

// Trim username and password
if (isset($username))
  $username=trim($username);
if (isset($password))
  $password=trim($password);
if (isset($extralogindata1))
  $extralogindata1=trim($extralogindata1);
if (isset($extralogindata2))
  $extralogindata2=trim($extralogindata2);
if (isset($extralogindata3))
  $extralogindata3=trim($extralogindata3);
if (isset($extralogindata4))
  $extralogindata4=trim($extralogindata4);
if (isset($extralogindata5))
  $extralogindata5=trim($extralogindata5);
if (isset($extralogindata6))
  $extralogindata6=trim($extralogindata6);
  
// See if page has requested an override for a setting
if (isset($loginpage))
  $LoginPage=$loginpage;
if (isset($expiredpage))
  $ExpiredPage=$expiredpage;
if (isset($wronggrouppage))
  $WrongGroupPage=$wronggrouppage;
if (isset($noaccesspage))
  $NoAccessPage=$noaccesspage;
if (isset($logoutpage))
  $LogoutPage=$logoutpage;
if (isset($messagepage))
  $MessagePage=$messagepage;
if (isset($maxsessiontime))
  $MaxSessionTime=$maxsessiontime;
if (isset($maxinactivitytime))
  $MaxInactivityTime=$maxinactivitytime;
if (isset($filelocation))
  $FileLocation=$filelocation;
if (!isset($RedirectAfterLogin))
  $RedirectAfterLogin=1;
if (!isset($manualloginonly))
  $manualloginonly=0;
if (!isset($LogEmbedded))
  $LogEmbedded=false;
if (!isset($startpage))
{
  $startpage=$thispage;  
  if ($_SERVER['REQUEST_URI']!="")
    $startpage=$_SERVER['REQUEST_URI'];
  else
  {
    if ($_SERVER['SCRIPT_NAME']!="")
    {
      $startpage=$_SERVER['SCRIPT_NAME'];
      if ($_SERVER['QUERY_STRING']!="")
        $startpage=$startpage."?".$_SERVER['QUERY_STRING'];
    }
  }
  $startpage=str_replace("\"","\\\"",$startpage);
  $startpage=str_replace("'","\'",$startpage);
  $startpageoveridden=false;   
}
else
  $startpageoveridden=true;
// Clean $startpage  
$startpage=strip_tags($startpage);
if (isset($allowsearchengine))
  $AllowSearchEngine=$allowsearchengine;
if (isset($searchenginegroup))
  $SearchEngineGroup=$searchenginegroup;
if (isset($searchenginepublicaccess))
  $SearchEnginePublicAccess=$searchenginepublicaccess;
if (isset($profilepassrequired))
  $ProfilePassRequired=$profilepassrequired;     
if (isset($emailconfirmrequired))
  $EmailConfirmRequired=$emailconfirmrequired;     
if (isset($emailconfirmtemplate))
  $EmailConfirmTemplate=$emailconfirmtemplate;     
if (isset($emailunique))
  $EmailUnique=$emailunique;     
$PHPSESSID="";
if (!isset($loginredirect))
  $loginredirect=0;
// Detect and authenticate search engine access if required
$slsearchengine=false;
$slsearchenginebot="";
if (($AllowSearchEngine) && ($groupswithaccess!="ADMIN") && ($groupswithaccess!="DEMOADMIN"))
{
  // Check that group is allowed first
  $segroupallowed=false;
  $sumg=explode(",",$SearchEngineGroup);
  $aug=explode(",",$groupswithaccess);
  for ($k=0;$k<count($aug);$k++)
  {
    for ($j=0;$j<count($sumg);$j++)
    {
      if (($aug[$k]=="ALL") || ($aug[$k]==""))
        $segroupallowed=true;
      if ($sumg[$j]=="ALL")
        $segroupallowed=true;
      if ($sumg[$j]==$aug[$k])
        $segroupallowed=true;                
    }
  }
  if ($userswithaccess!="")
  {
    $seuwa=explode(",",$userswithaccess);
    if (!in_array("searchenginebot",$seuwa))
      $segroupallowed=false;
  }
  if (($segroupallowed) || (in_array("PUBLIC",$aug)))
  {
    $botname=sl_issearchengine(trim(strtok($_SERVER['REMOTE_ADDR'],",")),$_SERVER['HTTP_USER_AGENT']);
    if ($botname!="")
    {
      $slsearchengine=true;
      $slsearchenginebot=$botname;
      $slusername="searchenginebot";
      $sluserid="";
      $slpassword="";
      $slpasswordclue="";
      $slpasswordhash="";
      $slname="Search Engine";
      $slusergroups=$SearchEngineGroup;
      $slcustom1="";
      $slcustom2="";
      $slcustom3="";
      $slcustom4="";
      $slcustom5="";
      $slcustom6="";
      $slcustom7="";
      $slcustom8="";
      $slcustom9="";
      $slcustom10="";
      $slcustom11="";
      $slcustom12="";
      $slcustom13="";
      $slcustom14="";
      $slcustom15="";
      $slcustom16="";
      $slcustom17="";
      $slcustom18="";
      $slcustom19="";
      $slcustom20="";
      $slcustom21="";
      $slcustom22="";
      $slcustom23="";
      $slcustom24="";
      $slcustom25="";
      $slcustom26="";
      $slcustom27="";
      $slcustom28="";
      $slcustom29="";
      $slcustom30="";
      $slcustom31="";
      $slcustom32="";
      $slcustom33="";
      $slcustom34="";
      $slcustom35="";
      $slcustom36="";
      $slcustom37="";
      $slcustom38="";
      $slcustom39="";
      $slcustom40="";
      $slcustom41="";
      $slcustom42="";
      $slcustom43="";
      $slcustom44="";
      $slcustom45="";
      $slcustom46="";
      $slcustom47="";
      $slcustom48="";
      $slcustom49="";
      $slcustom50="";
      $slfirstname="Search";
      $sllastname="Engine";
      $slemail=$SiteEmail;
      $slstarttime=time();
      $slaccesstime=time();
      $slcreated=time();
      $sljustloggedin=false;
      $slpublicaccess=false;
      $slordercustom="";
      $sumg=explode(",",$SearchEngineGroup);
      for ($k=0;$k<count($sumg);$k++)
      {
       $slgroupname[]=$sumg[$k];
       if ($GroupNames[$sumg[$k]]!="")
         $slgroupdesc[]=$GroupNames[$sumg[$k]];
       else
         $slgroupdesc[]=$sumg[$k]." members area";  
      	 $slgroupexpiry[]="Unlimited";
      	 $slgroupexpiryts[]=0;
      	 $slgroupexpirytsbyname[$sumg[$k]]=0;
      	 $slgroupexpirybyname[$sumg[$k]]="Unlimited";
      }
      $slpublicaccess=false;
      if (in_array("PUBLIC",$aug))
      {
       if ((in_array("PUBLIC",$aug)) && (!$segroupallowed))          	 
         $slpublicaccess=true;
       if ($groupswithaccess=="PUBLIC")
         $slpublicaccess=false;            	   
      }
    }
  }    
}  
// End of search engine detection  

if ($slsearchengine==false)
{
  if ($_SESSION['ses_sljustloggedin']==true)
  {
    $sljustloggedin=true;
    $_SESSION['ses_sljustloggedin']=false;
  }
  else
    $sljustloggedin=false;

  // See if username and login saved in client cookie
  $sitelokcookie=$_COOKIE['SITELOKPW'.$SessionName];
  $slcookieusername="";
  $slcookiepassword="";
  $slcookielogin="";  
  if ($sitelokcookie!="")
  {
  	$sitelokcookie=base64_decode($sitelokcookie);
  	// See if cookie is an old one
  	$cookiedata=explode("|",$sitelokcookie);
  	if (count($cookiedata)!=3)
  	{
    	$sitelokcookie=sl_rc4two($sitelokcookie,"ckl".$SiteKey,false);
    	$cookiedata=explode("|",$sitelokcookie);
  	}
  	if (count($cookiedata)==3)
  	{
    	$slcookieusername=$cookiedata[0];
    	$slcookiepassword=$cookiedata[1];
    	$slcookielogin=$cookiedata[2];
    }	
    // if login type in cookie (remember me or auto login) doesn't match system then delete cookie
    if (($CookieLogin>0) && ($slcookielogin!=$CookieLogin))
    {
      if ($sl_cookiehttponly)
        setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
      else  
        setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);
    	$slcookieusername="";
    	$slcookiepassword="";
    	$slcookielogin="";        
    }
  }
  
/*  
  // If downloading file then the session_cache_limiter is required because of a bug in IE when using SSL
if ((isset($_REQUEST['sldownload'])) || ($_REQUEST['act']=="exportselected") || ($_REQUEST['logmanageact']=="export"))
  	session_cache_limiter('public');
  if ($SessionName!="")
    session_name($SessionName);	
  session_start();
*/  
  $sitelokloginkey=$_SESSION['ses_slloginkey'];
  // If $groupswithaccess is not set then make it ALL
  if ((!isset($groupswithaccess)) || ($groupswithaccess==""))
    $groupswithaccess="ALL";
  // See if page has public access
  $gwa=explode(",",$groupswithaccess);
  $i=array_search("PUBLIC",$gwa);
  if (is_integer($i))
  {
    $publicaccess=true;
    unset($gwa[$i]);
    $groupswithaccess=implode(",",$gwa);
  }  
  else
    $publicaccess=false;  
  $logindetailsfromcookie=false;    
  $PHPSESSID=$_COOKIE['PHPSESSID'];
  if (($slcookielogin=="2") && ($LoginType=="NORMAL") && ($CookieLogin==2) && ($password==""))
  {
    $username=$slcookieusername;
    $password=$slcookiepassword;
    if ($username!=="")
      $logindetailsfromcookie=true;
    // See if auto login for this page is blocked
    if (($manualloginonly==1) && ($sluserautologgedin) && ($_SESSION['ses_slloginkey']=="LOGGEDIN"))
    {    
      $_SESSION['ses_slloginkey']="";
      $sitelokloginkey="";
      $username="";
      $password="";
    }      
  }
  // In the case of a PUBLIC download link handle that here as no login required
  if (isset($_REQUEST['sldownload']))
	{
	  //See if PUBLIC link
	  $download=$_REQUEST['sldownload'];
    $pos=strrpos($download,"/");
    if (is_integer($pos))
    	$download=substr($download,0,$pos);
    $download=base64_decode($download);
    $fields=explode(",",$download);
    if ($fields[2]=="")
    {
      sitelokgetfile($_REQUEST['sldownload']);
      exit;      
    }
  }
  
  if ($sitelokaction=="logout")
  {
    if (($_SESSION['ses_slusername']!="") && (substr($LogDetails,0,1)=="Y"))
  	  sl_AddToLog("Logout",$_SESSION['ses_slusername'],"");
    if ($_SESSION['ses_slusername']!="")  
	    sl_processlogout($_SESSION['ses_slusername']);
    @session_destroy();
    if ($sl_cookiehttponly)
      setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure,true);
    else
      setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure);      
  //  session_start();
    // We need to send login page to browser
  //  $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,"");
    if ($slcookielogin=="2")
    {
      if ($sl_cookiehttponly)
        setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
      else  
        setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);
    }  
    if ($_GET['page']!="")
      $LogoutPage=$_GET['page'];
    if (false===strpos($LogoutPage,"?"))
      $LogoutPage.="?loggedout=1";
    else    
      $LogoutPage.="&loggedout=1";
    header("Location: ".$LogoutPage);
    exit;
  }

  $loginallowed=false;
     
  if ((($sitelokloginkey!="LOGGEDIN") && ($sitelokloginkey!="EXTRALOGIN") && ($sitelokhash=="") && ($password=="") && ($publicaccess==false) && ($forgotpassword!="forgotten-it")))
  {
    // Update last page visited
    sl_storerequestpage();
    // Call event handler to see if login can be processed externally (such as Facebook login)
    $paramdata['username']="";
    $paramdata['userid']="";
    // Call plugin event
    $preloginresult=false;
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (!$preloginresult)
      {
        if (function_exists($slplugin_event_onPreLogin[$p]))
          $preloginresult=call_user_func($slplugin_event_onPreLogin[$p],$slpluginid[$p],$paramdata);
      }  
    }
    // Call user event handler
    if (!$preloginresult)
    {
      if (function_exists("sl_onPreLogin"))
        $preloginresult=sl_onPreLogin($paramdata);      
    }  
    if (!$preloginresult)      
    {  
      if ($NoAccessPage!="")
      {
        if ((strtolower(substr($NoAccessPage,0,7))=="http://") || (strtolower(substr($NoAccessPage,0,8))=="https://"))
          header("Location: ".$NoAccessPage);      
        else
          include $NoAccessPage;
        exit;    
      }
      // We need to send login page to browser unless we are doing download. In this case show warning.
      if ((isset($_REQUEST['sldownload'])) || ($_REQUEST['act']=="exportselected") || ($_REQUEST['logmanageact']=="export"))
    	{
    	  sl_ShowMessage($MessagePage,"Please login to access this file.\n");
    	}
    	else
    	{
    	  $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,"");
      }
      exit;
    }
  }
  // Handle forgotten password
  if (($sitelokloginkey!="LOGGEDIN") && ($forgotpassword=="forgotten-it"))
  {
    if ($TuringLogin==1)
    {
      $turingmatch=false;
      $turingtested=false;
      // First see if plugin will verify code 
      // Call event handlers for failed login
      $paramdata['username']=$username;
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onCaptchaVerify[$p]))
        {
          $turingtested=true;
          if (call_user_func($slplugin_event_onCaptchaVerify[$p],$slpluginid[$p],$paramdata))
            $turingmatch=true;
          break;
        }
      }
      // Call user event handler
      if ((!$turingtested) && (function_exists("sl_onCaptchaVerify")))
      {
        $turingtested=true;
        if (sl_onCaptchaVerify($paramdata))
          $turingmatch=true; 
      }
      if (!$turingtested)
      {
        if ((strtolower($_SESSION['ses_slturingcode'])==strtolower(trim($turing))) && ($_SESSION['ses_slturingcode']!=""))
        {
          $turingmatch=true;
          $_SESSION['ses_slturingcode']="";
        }
        else if ((strtolower($_SESSION['ses_slpreviousturingcode'])==strtolower(trim($turing))) && ($_SESSION['ses_slpreviousturingcode']!=""))
        {
          $turingmatch=true;
          $_SESSION['ses_slpreviousturingcode']="";
        }
      }
      if (!$turingmatch)
      {
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_TURING1);
        exit;      
      }
    }
    // User forgot password so try to match username with username or email address in database
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_DBPROB);
      exit;
    }
    $sqlquery="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
    $mysql_result=mysqli_query($mysql_link,$sqlquery);
  	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  	if ($row==false)
  	{
    	// If username not found then try email field
    	$sqlquery="SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($username);
    	$mysql_result=mysqli_query($mysql_link,$sqlquery);
    	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  	}
    if ($row!=false)
    {
      $fus=$row[$UsernameField];
      $fpw=$row[$PasswordField];
      $fnm=$row[$NameField];
      $fem=$row[$EmailField];
      $fug=$row[$UsergroupsField];
      $fcu1=$row[$Custom1Field];
      $fcu2=$row[$Custom2Field];
      $fcu3=$row[$Custom3Field];
      $fcu4=$row[$Custom4Field];
      $fcu5=$row[$Custom5Field];
      $fcu6=$row[$Custom6Field];
      $fcu7=$row[$Custom7Field];
      $fcu8=$row[$Custom8Field];
      $fcu9=$row[$Custom9Field];
      $fcu10=$row[$Custom10Field];
      $fcu11=$row[$Custom11Field];
      $fcu12=$row[$Custom12Field];
      $fcu13=$row[$Custom13Field];
      $fcu14=$row[$Custom14Field];
      $fcu15=$row[$Custom15Field];
      $fcu16=$row[$Custom16Field];
      $fcu17=$row[$Custom17Field];
      $fcu18=$row[$Custom18Field];
      $fcu19=$row[$Custom19Field];
      $fcu20=$row[$Custom20Field];
      $fcu21=$row[$Custom21Field];
      $fcu22=$row[$Custom22Field];
      $fcu23=$row[$Custom23Field];
      $fcu24=$row[$Custom24Field];
      $fcu25=$row[$Custom25Field];
      $fcu26=$row[$Custom26Field];
      $fcu27=$row[$Custom27Field];
      $fcu28=$row[$Custom28Field];
      $fcu29=$row[$Custom29Field];
      $fcu30=$row[$Custom30Field];
      $fcu31=$row[$Custom31Field];
      $fcu32=$row[$Custom32Field];
      $fcu33=$row[$Custom33Field];
      $fcu34=$row[$Custom34Field];
      $fcu35=$row[$Custom35Field];
      $fcu36=$row[$Custom36Field];
      $fcu37=$row[$Custom37Field];
      $fcu38=$row[$Custom38Field];
      $fcu39=$row[$Custom39Field];
      $fcu40=$row[$Custom40Field];
      $fcu41=$row[$Custom41Field];
      $fcu42=$row[$Custom42Field];
      $fcu43=$row[$Custom43Field];
      $fcu44=$row[$Custom44Field];
      $fcu45=$row[$Custom45Field];
      $fcu46=$row[$Custom46Field];
      $fcu47=$row[$Custom47Field];
      $fcu48=$row[$Custom48Field];
      $fcu49=$row[$Custom49Field];
      $fcu50=$row[$Custom50Field];
  //  mysqli_close($mysql_link);
      if ($MD5passwords!=true)
      {
    		if ($ForgottenEmail!="")
    		{
          sl_ReadEmailTemplate($ForgottenEmail,$subject,$mailBody,$htmlformat);
        }
        else
        {
    	    $subject=$SiteName." login details";
    	    $mailBody= "Your login details for $SiteName are as follows:-\n\n";
    	    $mailBody.="Username: ".$fus."\n";
    	    $mailBody.="Password: ".$fpw."\n\n";
    	    $mailBody.="If you have any further problems please email us at ".$SiteEmail.".\n";
    	    $htmlformat="";
        }
        sl_SendEmail($fem,$mailBody,$subject,$htmlformat,$fus,$fpw,$fnm,$fem,$fug,$fcu1,$fcu2,$fcu3,$fcu4,$fcu5,$fcu6,$fcu7,$fcu8,$fcu9,$fcu10,
        $fcu11,$fcu12,$fcu13,$fcu14,$fcu15,$fcu16,$fcu17,$fcu18,$fcu19,$fcu20,$fcu21,$fcu22,$fcu23,$fcu24,$fcu25,$fcu26,$fcu27,$fcu28,$fcu29,$fcu30,
        $fcu31,$fcu32,$fcu33,$fcu34,$fcu35,$fcu36,$fcu37,$fcu38,$fcu39,$fcu40,$fcu41,$fcu42,$fcu43,$fcu44,$fcu45,$fcu46,$fcu47,$fcu48,$fcu49,$fcu50);
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_PASSEMAIL);
        if (substr($LogDetails,2,1)=="Y")
        {
    	    sl_AddToLog("Password Requested",$fus,"User forgot password");
    	  }  
      }
      else
      {
    		if ($ForgottenEmail!="")
    		{
          sl_ReadEmailTemplate($ForgottenEmail,$subject,$mailBody,$htmlformat);
        }
        else
        {
    	    $newpw=sl_CreatePassword($RandomPasswordMask);
          if ($SitelokLocationURL!="")
            $slpwURL=$SitelokLocationURL;
          else  
            $slpwURL="http://".$_SERVER['HTTP_HOST']."/slpw/";
          $newpwhash=md5($SiteKey."3".$fus.md5($fpw.$SiteKey).$newpw);
          $newpwauth="3,".$fus.",".md5($fpw.$SiteKey).",".$newpw.",".$newpwhash;
          $newpwauth = base64_encode($newpwauth);
          $newpwauth = rawurlencode($newpwauth);  
    	    $subject=$SiteName." login details";
          $mailBody ="<html>\n";
          $mailBody.="<head>\n";
          $mailBody.="<title>Login details</title>\n";
          $mailBody.="</head>\n";
          $mailBody.="<body>\n";
          $mailBody.="Login details for $SiteName. To activate your new password please click the link below.<br>\n";
          $mailBody.="<br>\n";
          $mailBody.="Username: ".$fus."<br>\n";
          $mailBody.="Password: ".$newpw."<br><br>\n";
          $mailBody.="<a href=\"".$slpwURL."linkprocess.php?auth=".$newpwauth."\">Activate Now</a><br><br>\n";
          $mailBody.="If you have any further questions or problems please email us at <a href=\"mailto:".$SiteEmail."\">".$SiteEmail."</a>.<br>\n";
          $mailBody.="</body>\n";
          $mailBody.="</html>\n";
    	    $htmlformat="Y";
        }
        sl_SendEmail($fem,$mailBody,$subject,$htmlformat,$fus,$fpw,$fnm,$fem,$fug,$fcu1,$fcu2,$fcu3,$fcu4,$fcu5,$fcu6,$fcu7,$fcu8,$fcu9,$fcu10,
        $fcu11,$fcu12,$fcu13,$fcu14,$fcu15,$fcu16,$fcu17,$fcu18,$fcu19,$fcu20,$fcu21,$fcu22,$fcu23,$fcu24,$fcu25,$fcu26,$fcu27,$fcu28,$fcu29,$fcu30,
        $fcu31,$fcu32,$fcu33,$fcu34,$fcu35,$fcu36,$fcu37,$fcu38,$fcu39,$fcu40,$fcu41,$fcu42,$fcu43,$fcu44,$fcu45,$fcu46,$fcu47,$fcu48,$fcu49,$fcu50);
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_PASSEMAIL);
        if (substr($LogDetails,2,1)=="Y")
    	    sl_AddToLog("Password Requested",$username,"User forgot password");      
      }
    }
    else
    {
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_NOMATCH);
    }
    exit;
  }
  
  
  // Handle checking of first level login details entered and also see if second level required
  if ( (($sitelokloginkey!="LOGGEDIN") && ($sitelokloginkey!="EXTRALOGIN") && ($password!="")) || (($sitelokloginkey!="EXTRALOGIN") && ($password!="") && ($loginredirect==2)) )
  {
    // Give priority to username and password send in POST. This stops user getting blocked when hash link in URL fails
    if ((isset($_POST['username'])) && ($_POST['username']!=""))
      $username=$_POST['username'];
    if ((isset($_POST['password'])) && ($_POST['password']!=""))
      $password=$_POST['password'];
    // If time limited password hash entered then check still valid and get password from it
    $passwordlinkused=false;
    $passwordlinkexpired=false;
    if (strlen($password)>50)
    {
      $tmp=rawurldecode($password);	
      $tmp=base64_decode($tmp);
      $fields=explode(",",$tmp,3);
      $hash=$fields[0];
      $exptime=$fields[1];
      $password=$fields[2];
      $vhash=md5($SiteKey.$exptime.$password);
      if ($hash!=$vhash)
      {
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_LOGINLINKHASH);
        exit;
      } 
      if ($exptime>0)
      {                   
        if (time()>$exptime)
        {
          $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_LOGINLINKEXPIRED);
          exit;
        }
      }
      $passwordlinkused=true;
    }      
    $slpublicaccess=true;
    // Clear stored Login Key to stop second attempt with same key
    $_SESSION['ses_slloginkey']="";
    // If captcha enabled for login then set that as we are using secure password link
    if ((!$passwordlinkused) || (!$sl_nocaptchawithhash))
    {
      // Check Turing code if required
      if ($TuringLogin==1)
      {
        $turingmatch=false;
        $turingtested=false;
        // First see if plugin will verify code 
        // Call event handlers for failed login
        $paramdata['username']=$username;
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onCaptchaVerify[$p]))
          {
            $turingtested=true;
            if (call_user_func($slplugin_event_onCaptchaVerify[$p],$slpluginid[$p],$paramdata))
              $turingmatch=true;
            break;
          }
        }
        // Call user event handler
        if ((!$turingtested) && (function_exists("sl_onCaptchaVerify")))
        {
          $turingtested=true;
          if (sl_onCaptchaVerify($paramdata))
            $turingmatch=true; 
        }
        if (!$turingtested)
        {
          if ((strtolower($_SESSION['ses_slturingcode'])==strtolower(trim($turing))) && ($_SESSION['ses_slturingcode']!=""))
          {
            $turingmatch=true;
            $_SESSION['ses_slturingcode']="";
          }
          else if ((strtolower($_SESSION['ses_slpreviousturingcode'])==strtolower(trim($turing))) && ($_SESSION['ses_slpreviousturingcode']!=""))
          {
            $turingmatch=true;
            $_SESSION['ses_slpreviousturingcode']="";
          }
        }
        if (!$turingmatch)
        {
          $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_TURING1);
          exit;      
        }
      }
    }
    // First lookup username and get details
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_DBPROB);
      exit;
    }
    if (($LoginWithEmail==1) && (sl_validate_email($username)))
      $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username)." OR ".$EmailField."=".sl_quote_smart($username);      
    else
      $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
    $mysql_result=mysqli_query($mysql_link,$query);
    if (mysqli_num_rows($mysql_result)==0)
    {
  //    mysqli_close($mysql_link);
      if ($slcookielogin=="2")
      {
        if ($sl_cookiehttponly)      
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
        else	
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);
      }
      // Call event handlers for failed login
      $paramdata['failedtype']=0;
      $paramdata['username']=$username;
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onLoginFailure[$p]))
          call_user_func($slplugin_event_onLoginFailure[$p],$slpluginid[$p],$paramdata);
      }
      // Call user event handler
      if (function_exists("sl_onLoginFailure"))
        sl_onLoginFailure($paramdata);      
      	
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_AUTHFAIL);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Username does not exist");
      exit;
    }
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $created=$row[$CreatedField];
      $username=$row[$UsernameField];
      $UserId=$row[$IdField];
      $Passphrase=$row[$PasswordField];
      $Name=$row[$NameField];
      $Enabled=$row[$EnabledField];
      $Email=$row[$EmailField];
      $Usergroups=$row[$UsergroupsField];
      $Custom1=$row[$Custom1Field];
      $Custom2=$row[$Custom2Field];
      $Custom3=$row[$Custom3Field];
      $Custom4=$row[$Custom4Field];
      $Custom5=$row[$Custom5Field];
      $Custom6=$row[$Custom6Field];
      $Custom7=$row[$Custom7Field];
      $Custom8=$row[$Custom8Field];
      $Custom9=$row[$Custom9Field];
      $Custom10=$row[$Custom10Field];
      $Custom11=$row[$Custom11Field];
      $Custom12=$row[$Custom12Field];
      $Custom13=$row[$Custom13Field];
      $Custom14=$row[$Custom14Field];
      $Custom15=$row[$Custom15Field];
      $Custom16=$row[$Custom16Field];
      $Custom17=$row[$Custom17Field];
      $Custom18=$row[$Custom18Field];
      $Custom19=$row[$Custom19Field];
      $Custom20=$row[$Custom20Field];
      $Custom21=$row[$Custom21Field];
      $Custom22=$row[$Custom22Field];
      $Custom23=$row[$Custom23Field];
      $Custom24=$row[$Custom24Field];
      $Custom25=$row[$Custom25Field];
      $Custom26=$row[$Custom26Field];
      $Custom27=$row[$Custom27Field];
      $Custom28=$row[$Custom28Field];
      $Custom29=$row[$Custom29Field];
      $Custom30=$row[$Custom30Field];
      $Custom31=$row[$Custom31Field];
      $Custom32=$row[$Custom32Field];
      $Custom33=$row[$Custom33Field];
      $Custom34=$row[$Custom34Field];
      $Custom35=$row[$Custom35Field];
      $Custom36=$row[$Custom36Field];
      $Custom37=$row[$Custom37Field];
      $Custom38=$row[$Custom38Field];
      $Custom39=$row[$Custom39Field];
      $Custom40=$row[$Custom40Field];
      $Custom41=$row[$Custom41Field];
      $Custom42=$row[$Custom42Field];
      $Custom43=$row[$Custom43Field];
      $Custom44=$row[$Custom44Field];
      $Custom45=$row[$Custom45Field];
      $Custom46=$row[$Custom46Field];
      $Custom47=$row[$Custom47Field];
      $Custom48=$row[$Custom48Field];
      $Custom49=$row[$Custom49Field];
      $Custom50=$row[$Custom50Field];
      $OpenSession=$row[$SessionField];
      // Verify password hash matches
      $hash=md5($Passphrase.$sitelokloginkey);
      $hash=strtolower($hash);
      $loginpassed=false;
      if (($LoginType=="SECURE") && ($sitelokhash==$hash))
        $loginpassed=true;
      if (($LoginType=="NORMAL") && ($MD5passwords==false) && (($password==$Passphrase) || ($password==md5(md5($Passphrase.$SiteKey).$SiteKey))))
        $loginpassed=true;
      if (($LoginType=="NORMAL") && ($MD5passwords==true) && ((md5($password.$SiteKey)==$Passphrase) || ($password==md5(md5($Passphrase.$SiteKey).$SiteKey))  || ($password==md5($Passphrase.$SiteKey))))
        $loginpassed=true;
      if ($loginpassed==true)
        break;  
    }
    //  mysqli_close($mysql_link);
    if (!$loginpassed)  
    {
      if ($slcookielogin=="2")
      {
        if ($sl_cookiehttponly)
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
       else
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);        	
      }	      	
      // Call event handlers for failed login
      $paramdata['failedtype']=1;
      $paramdata['passwordentered']=$password;
      $paramdata['username']=$username;
      $paramdata['userid']=$UserId;
      $paramdata['password']=$Passphrase;
      $paramdata['enabled']=$Enabled;
      $paramdata['name']=$Name;
      $paramdata['email']=$Email;
      $paramdata['usergroups']=$Usergroups;
      $paramdata['custom1']=$Custom1;
      $paramdata['custom2']=$Custom2;
      $paramdata['custom3']=$Custom3;
      $paramdata['custom4']=$Custom4;
      $paramdata['custom5']=$Custom5;
      $paramdata['custom6']=$Custom6;
      $paramdata['custom7']=$Custom7;
      $paramdata['custom8']=$Custom8;
      $paramdata['custom9']=$Custom9;
      $paramdata['custom10']=$Custom10;
      $paramdata['custom11']=$Custom11;
      $paramdata['custom12']=$Custom12;
      $paramdata['custom13']=$Custom13;
      $paramdata['custom14']=$Custom14;
      $paramdata['custom15']=$Custom15;
      $paramdata['custom16']=$Custom16;
      $paramdata['custom17']=$Custom17;
      $paramdata['custom18']=$Custom18;
      $paramdata['custom19']=$Custom19;
      $paramdata['custom20']=$Custom20;
      $paramdata['custom21']=$Custom21;
      $paramdata['custom22']=$Custom22;
      $paramdata['custom23']=$Custom23;
      $paramdata['custom24']=$Custom24;
      $paramdata['custom25']=$Custom25;
      $paramdata['custom26']=$Custom26;
      $paramdata['custom27']=$Custom27;
      $paramdata['custom28']=$Custom28;
      $paramdata['custom29']=$Custom29;
      $paramdata['custom30']=$Custom30;
      $paramdata['custom31']=$Custom31;
      $paramdata['custom32']=$Custom32;
      $paramdata['custom33']=$Custom33;
      $paramdata['custom34']=$Custom34;
      $paramdata['custom35']=$Custom35;
      $paramdata['custom36']=$Custom36;
      $paramdata['custom37']=$Custom37;
      $paramdata['custom38']=$Custom38;
      $paramdata['custom39']=$Custom39;
      $paramdata['custom40']=$Custom40;
      $paramdata['custom41']=$Custom41;
      $paramdata['custom42']=$Custom42;
      $paramdata['custom43']=$Custom43;
      $paramdata['custom44']=$Custom44;
      $paramdata['custom45']=$Custom45;
      $paramdata['custom46']=$Custom46;
      $paramdata['custom47']=$Custom47;
      $paramdata['custom48']=$Custom48;
      $paramdata['custom49']=$Custom49;
      $paramdata['custom50']=$Custom50;          
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onLoginFailure[$p]))
          call_user_func($slplugin_event_onLoginFailure[$p],$slpluginid[$p],$paramdata);
      }
      // Call user event handler
      if (function_exists("sl_onLoginFailure"))
        sl_onLoginFailure($paramdata);      
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_AUTHFAIL);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Authentication failed");
      exit;
    }
    // Login has passed
	  // See if user wants to remember login and handle depending on whether login form was manually used
	  if ($loginformused=="1")
	  {
	    if (($remember=="1") && ($LoginType=="NORMAL") && ($CookieLogin=="1"))
	    {
  	    if ($sl_cookiehttponly)    
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".$password."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure,true);
        else  
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".$password."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure);
	    }
	    if (($remember=="2") && ($LoginType=="NORMAL") && ($CookieLogin=="2"))
	    {
  	    if ($sl_cookiehttponly)    
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".sl_passwordhash(0,$password)."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure,true);
        else  
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".sl_passwordhash(0,$password)."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure);
	    }
	    // Delete cookie if user didn't select remember me
	    if (($remember=="") && ($LoginType=="NORMAL") && ($CookieLogin=="1"))
	    {
        if ($sl_cookiehttponly)
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
        else
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);        	
	    }	    
      $_SESSION['ses_UserAutoLoggedIn']="0";
	  }
	  else
	  {
	    if (($remember=="2") && ($LoginType=="NORMAL") && ($CookieLogin=="2"))
	    {
  	    if ($sl_cookiehttponly)    
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".sl_passwordhash(0,$password,false)."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure,true);
        else  
          setcookie("SITELOKPW".$SessionName,base64_encode(sl_rc4two($username."|".sl_passwordhash(0,$password,false)."|".$CookieLogin,"ckl".$SiteKey,true)),2147483647,"/","",$sl_cookiesecure);
	    }	  
	    // Flag in session whether login was manual (using form) or automatic
	    if ($slcookielogin=="2")
        $_SESSION['ses_UserAutoLoggedIn']="1";
    }    
    // See if extra login required
    $extralogintype=0;
    if (function_exists("sl_CheckforLogin2"))
    {
      $paramdata['username']=$username;
      $paramdata['userid']=$UserId;
      $paramdata['password']=$Passphrase;
      $paramdata['enabled']=$Enabled;
      $paramdata['name']=$Name;
      $paramdata['email']=$Email;
      $paramdata['usergroups']=$Usergroups;
      $paramdata['custom1']=$Custom1;
      $paramdata['custom2']=$Custom2;
      $paramdata['custom3']=$Custom3;
      $paramdata['custom4']=$Custom4;
      $paramdata['custom5']=$Custom5;
      $paramdata['custom6']=$Custom6;
      $paramdata['custom7']=$Custom7;
      $paramdata['custom8']=$Custom8;
      $paramdata['custom9']=$Custom9;
      $paramdata['custom10']=$Custom10;
      $paramdata['custom11']=$Custom11;
      $paramdata['custom12']=$Custom12;
      $paramdata['custom13']=$Custom13;
      $paramdata['custom14']=$Custom14;
      $paramdata['custom15']=$Custom15;
      $paramdata['custom16']=$Custom16;
      $paramdata['custom17']=$Custom17;
      $paramdata['custom18']=$Custom18;
      $paramdata['custom19']=$Custom19;
      $paramdata['custom20']=$Custom20;
      $paramdata['custom21']=$Custom21;
      $paramdata['custom22']=$Custom22;
      $paramdata['custom23']=$Custom23;
      $paramdata['custom24']=$Custom24;
      $paramdata['custom25']=$Custom25;
      $paramdata['custom26']=$Custom26;
      $paramdata['custom27']=$Custom27;
      $paramdata['custom28']=$Custom28;
      $paramdata['custom29']=$Custom29;
      $paramdata['custom30']=$Custom30;
      $paramdata['custom31']=$Custom31;
      $paramdata['custom32']=$Custom32;
      $paramdata['custom33']=$Custom33;
      $paramdata['custom34']=$Custom34;
      $paramdata['custom35']=$Custom35;
      $paramdata['custom36']=$Custom36;
      $paramdata['custom37']=$Custom37;
      $paramdata['custom38']=$Custom38;
      $paramdata['custom39']=$Custom39;
      $paramdata['custom40']=$Custom40;
      $paramdata['custom41']=$Custom41;
      $paramdata['custom42']=$Custom42;
      $paramdata['custom43']=$Custom43;
      $paramdata['custom44']=$Custom44;
      $paramdata['custom45']=$Custom45;
      $paramdata['custom46']=$Custom46;
      $paramdata['custom47']=$Custom47;
      $paramdata['custom48']=$Custom48;
      $paramdata['custom49']=$Custom49;
      $paramdata['custom50']=$Custom50;          
      $extralogintype=sl_CheckforLogin2($paramdata);
    }
    if ($extralogintype>0)
    {
      $_SESSION['ses_slextralogintype']=$extralogintype;
      $_SESSION['ses_slloginkey']="EXTRALOGIN";
      $_SESSION['ses_slextraloginusername']=$username;      
      $paramdata['username']=$username;
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onGetLogin2Data[$p]))
        {
          $res=call_user_func($slplugin_event_onGetLogin2Data[$p],$slpluginid[$p],$extralogintype,$paramdata);
          if ($res)
            exit;  // Login 2 page displayed so exit and wait for them to submit it.
        }  
      }
    }
    else
    {
      $_SESSION['ses_slextralogintype']=0;
      $_SESSION['ses_slextraloginusername']="";      
      $loginallowed=true;
    }
    if (($Enabled!="Yes") && ($extralogintype==0))
    {
      // If user was autologged in and the page is public access then don't display error. Just set as public user
      if (($logindetailsfromcookie) && ($publicaccess))
      {
        $loginallowed=false;         
      }
      else
      {
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_DISABLED);
        if (substr($LogDetails,1,1)=="Y")
    	    sl_AddToLog("Login Problem",$username,"User access disabled");
        exit;
      }  
    }
  }
  // Check extra login data entered if required
  if ($sitelokloginkey=="EXTRALOGIN")
  { 
    $slpublicaccess=true;
    // First lookup username and get details
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_DBPROB);
      exit;
    }
    $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($_SESSION['ses_slextraloginusername']);
    $mysql_result=mysqli_query($mysql_link,$query);
    if (!$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
  //    mysqli_close($mysql_link);
      if ($slcookielogin=="2")
      {
        if ($sl_cookiehttponly)
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
       else
        	setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);        	
      }	
      
      // Call Login failed event handler
      $paramdata['failedtype']=0;
      $paramdata['username']=$_SESSION['ses_slextraloginusername'];      	
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onLoginFailure[$p]))
          call_user_func($slplugin_event_onLoginFailure[$p],$slpluginid[$p],$paramdata);
      }
      // Call user event handler
      if (function_exists("sl_onLoginFailure"))
        sl_onLoginFailure($paramdata);           	
      	
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_AUTHFAIL);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$_SESSION['ses_slextraloginusername'],"Username does not exist");
      exit;
    }
    $created=$row[$CreatedField];
    $username=$row[$UsernameField];
    $UserId=$row[$IdField];
    $Passphrase=$row[$PasswordField];
    $Name=$row[$NameField];
    $Enabled=$row[$EnabledField];
    $Email=$row[$EmailField];
    $Usergroups=$row[$UsergroupsField];
    $Custom1=$row[$Custom1Field];
    $Custom2=$row[$Custom2Field];
    $Custom3=$row[$Custom3Field];
    $Custom4=$row[$Custom4Field];
    $Custom5=$row[$Custom5Field];
    $Custom6=$row[$Custom6Field];
    $Custom7=$row[$Custom7Field];
    $Custom8=$row[$Custom8Field];
    $Custom9=$row[$Custom9Field];
    $Custom10=$row[$Custom10Field];
    $Custom11=$row[$Custom11Field];
    $Custom12=$row[$Custom12Field];
    $Custom13=$row[$Custom13Field];
    $Custom14=$row[$Custom14Field];
    $Custom15=$row[$Custom15Field];
    $Custom16=$row[$Custom16Field];
    $Custom17=$row[$Custom17Field];
    $Custom18=$row[$Custom18Field];
    $Custom19=$row[$Custom19Field];
    $Custom20=$row[$Custom20Field];
    $Custom21=$row[$Custom21Field];
    $Custom22=$row[$Custom22Field];
    $Custom23=$row[$Custom23Field];
    $Custom24=$row[$Custom24Field];
    $Custom25=$row[$Custom25Field];
    $Custom26=$row[$Custom26Field];
    $Custom27=$row[$Custom27Field];
    $Custom28=$row[$Custom28Field];
    $Custom29=$row[$Custom29Field];
    $Custom30=$row[$Custom30Field];
    $Custom31=$row[$Custom31Field];
    $Custom32=$row[$Custom32Field];
    $Custom33=$row[$Custom33Field];
    $Custom34=$row[$Custom34Field];
    $Custom35=$row[$Custom35Field];
    $Custom36=$row[$Custom36Field];
    $Custom37=$row[$Custom37Field];
    $Custom38=$row[$Custom38Field];
    $Custom39=$row[$Custom39Field];
    $Custom40=$row[$Custom40Field];
    $Custom41=$row[$Custom41Field];
    $Custom42=$row[$Custom42Field];
    $Custom43=$row[$Custom43Field];
    $Custom44=$row[$Custom44Field];
    $Custom45=$row[$Custom45Field];
    $Custom46=$row[$Custom46Field];
    $Custom47=$row[$Custom47Field];
    $Custom48=$row[$Custom48Field];
    $Custom49=$row[$Custom49Field];
    $Custom50=$row[$Custom50Field];
    $OpenSession=$row[$SessionField];
  //  mysqli_close($mysql_link);
    $loginpassed=false;
    if ($_SESSION['ses_slextralogintype']>0)
    {
      $paramdata['extralogindata1']=$extralogindata1;
      $paramdata['extralogindata2']=$extralogindata2;
      $paramdata['extralogindata3']=$extralogindata3;
      $paramdata['extralogindata4']=$extralogindata4;
      $paramdata['extralogindata5']=$extralogindata5;
      $paramdata['extralogindata6']=$extralogindata6;
      $paramdata['username']=$username;
      $paramdata['userid']=$UserId;
      $paramdata['password']=$Passphrase;
      $paramdata['enabled']=$Enabled;
      $paramdata['name']=$Name;
      $paramdata['email']=$Email;
      $paramdata['usergroups']=$Usergroups;
      $paramdata['custom1']=$Custom1;
      $paramdata['custom2']=$Custom2;
      $paramdata['custom3']=$Custom3;
      $paramdata['custom4']=$Custom4;
      $paramdata['custom5']=$Custom5;
      $paramdata['custom6']=$Custom6;
      $paramdata['custom7']=$Custom7;
      $paramdata['custom8']=$Custom8;
      $paramdata['custom9']=$Custom9;
      $paramdata['custom10']=$Custom10;
      $paramdata['custom11']=$Custom11;
      $paramdata['custom12']=$Custom12;
      $paramdata['custom13']=$Custom13;
      $paramdata['custom14']=$Custom14;
      $paramdata['custom15']=$Custom15;
      $paramdata['custom16']=$Custom16;
      $paramdata['custom17']=$Custom17;
      $paramdata['custom18']=$Custom18;
      $paramdata['custom19']=$Custom19;
      $paramdata['custom20']=$Custom20;
      $paramdata['custom21']=$Custom21;
      $paramdata['custom22']=$Custom22;
      $paramdata['custom23']=$Custom23;
      $paramdata['custom24']=$Custom24;
      $paramdata['custom25']=$Custom25;
      $paramdata['custom26']=$Custom26;
      $paramdata['custom27']=$Custom27;
      $paramdata['custom28']=$Custom28;
      $paramdata['custom29']=$Custom29;
      $paramdata['custom30']=$Custom30;
      $paramdata['custom31']=$Custom31;
      $paramdata['custom32']=$Custom32;
      $paramdata['custom33']=$Custom33;
      $paramdata['custom34']=$Custom34;
      $paramdata['custom35']=$Custom35;
      $paramdata['custom36']=$Custom36;
      $paramdata['custom37']=$Custom37;
      $paramdata['custom38']=$Custom38;
      $paramdata['custom39']=$Custom39;
      $paramdata['custom40']=$Custom40;
      $paramdata['custom41']=$Custom41;
      $paramdata['custom42']=$Custom42;
      $paramdata['custom43']=$Custom43;
      $paramdata['custom44']=$Custom44;
      $paramdata['custom45']=$Custom45;
      $paramdata['custom46']=$Custom46;
      $paramdata['custom47']=$Custom47;
      $paramdata['custom48']=$Custom48;
      $paramdata['custom49']=$Custom49;
      $paramdata['custom50']=$Custom50;      
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onVerifyLogin2Data[$p]))
        {
          $res=call_user_func($slplugin_event_onVerifyLogin2Data[$p],$slpluginid[$p],$_SESSION['ses_slextralogintype'],$paramdata);
          if ($res==1)
          {
            $loginpassed=true;
            break;
          }  
        }  
      }
    }
    if (!$loginpassed)  
    {      
      if ($slcookielogin=="2")
      {
        if ($sl_cookiehttponly)
      	  setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
      	else
      	  setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);      	  
      }	
      	
      // Call Login failed event handler
      $paramdata['failedtype']=2;
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onLoginFailure[$p]))
          call_user_func($slplugin_event_onLoginFailure[$p],$slpluginid[$p],$paramdata);
      }
      // Call user event handler
      if (function_exists("sl_onLoginFailure"))
        sl_onLoginFailure($paramdata);           	
      	
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_AUTHFAIL);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Extra Authentication failed");
      exit;
    }
    // Extra login has passed
    if ($Enabled!="Yes")
    {
      $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_DISABLED);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"User access disabled");
      exit;
    }
    $loginallowed=true; 
  }

  // Perform login itself if all allowed
  if ($loginallowed==true)  
  {
    // Mod to limit access to X locations using cookie. The count is stored in $CookieAccessLimit custom field.
    if (($CookieAccessLimit!="") && ($row[$CookieAccessLimit]!=""))
    {  
      $accesscount=$row[$CookieAccessLimit];
      // Access cookie required for access
      // See if cookie exists and value correct
      $slaccesscookiename="SITELOKACCESS_".$username;
      $slaccesscookievalue=$_COOKIE[$slaccesscookiename];
      if (($slaccesscookievalue!=md5($username.$SiteKey)) && ($accesscount<1))
      {
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_ACCESSLOC);
        if (substr($LogDetails,1,1)=="Y")
    	    sl_AddToLog("Login Problem",$username,"Access not allowed from this location");
        exit;        
      }
      if (($slaccesscookievalue!=md5($username.$SiteKey)) && ($accesscount>0))
      {
        // Create access cookie for this location and decrement count in custom field
        if ($sl_cookiehttponly)
          setcookie("SITELOKACCESS_".$username,md5($username.$SiteKey),2147483647,"/","",$sl_cookiesecure,true);
        else  
          setcookie("SITELOKACCESS_".$username,md5($username.$SiteKey),2147483647,"/","",$sl_cookiesecure);
        $accesscount=$accesscount-1;
        $query="UPDATE ".$DbTableName." SET ".$CookieAccessLimit."=".sl_quote_smart($accesscount)." WHERE ".$UsernameField."=".sl_quote_smart($username);
        $mysql_result=mysqli_query($mysql_link,$query);               
      }
    }
    // Here we should give custom code or plugins the final decision about the login
    $paramdata['username']=$username;
    $paramdata['userid']=$UserId;    
    $paramdata['password']=$Passphrase;
    $paramdata['enteredpassword']=$password; // Useful if md5 password being used but won't work for two level login
    $paramdata['enabled']=$Enabled;
    $paramdata['name']=$Name;
    $paramdata['email']=$Email;
    $paramdata['usergroups']=$Usergroups;
    $paramdata['custom1']=$Custom1;
    $paramdata['custom2']=$Custom2;
    $paramdata['custom3']=$Custom3;
    $paramdata['custom4']=$Custom4;
    $paramdata['custom5']=$Custom5;
    $paramdata['custom6']=$Custom6;
    $paramdata['custom7']=$Custom7;
    $paramdata['custom8']=$Custom8;
    $paramdata['custom9']=$Custom9;
    $paramdata['custom10']=$Custom10;
    $paramdata['custom11']=$Custom11;
    $paramdata['custom12']=$Custom12;
    $paramdata['custom13']=$Custom13;
    $paramdata['custom14']=$Custom14;
    $paramdata['custom15']=$Custom15;
    $paramdata['custom16']=$Custom16;
    $paramdata['custom17']=$Custom17;
    $paramdata['custom18']=$Custom18;
    $paramdata['custom19']=$Custom19;
    $paramdata['custom20']=$Custom20;
    $paramdata['custom21']=$Custom21;
    $paramdata['custom22']=$Custom22;
    $paramdata['custom23']=$Custom23;
    $paramdata['custom24']=$Custom24;
    $paramdata['custom25']=$Custom25;
    $paramdata['custom26']=$Custom26;
    $paramdata['custom27']=$Custom27;
    $paramdata['custom28']=$Custom28;
    $paramdata['custom29']=$Custom29;
    $paramdata['custom30']=$Custom30;
    $paramdata['custom31']=$Custom31;
    $paramdata['custom32']=$Custom32;
    $paramdata['custom33']=$Custom33;
    $paramdata['custom34']=$Custom34;
    $paramdata['custom35']=$Custom35;
    $paramdata['custom36']=$Custom36;
    $paramdata['custom37']=$Custom37;
    $paramdata['custom38']=$Custom38;
    $paramdata['custom39']=$Custom39;
    $paramdata['custom40']=$Custom40;
    $paramdata['custom41']=$Custom41;
    $paramdata['custom42']=$Custom42;
    $paramdata['custom43']=$Custom43;
    $paramdata['custom44']=$Custom44;
    $paramdata['custom45']=$Custom45;
    $paramdata['custom46']=$Custom46;
    $paramdata['custom47']=$Custom47;
    $paramdata['custom48']=$Custom48;
    $paramdata['custom49']=$Custom49;
    $paramdata['custom50']=$Custom50;    
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onCheckLogin[$p]))
      {
        $logincheckmsg=call_user_func($slplugin_event_onCheckLogin[$p],$slpluginid[$p],$paramdata);
        if ($logincheckmsg!="")
        {
          $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,$logincheckmsg);
          if (substr($LogDetails,1,1)=="Y")
      	    sl_AddToLog("Login Problem",$username,$logincheckmsg);
          exit;        
        }        
      }  
    }
    // Call user event handler
    if (function_exists("sl_onCheckLogin"))
    {
      $logincheckmsg=sl_onCheckLogin($paramdata);      
      if ($logincheckmsg!="")
      {
        $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,$logincheckmsg);
        if (substr($LogDetails,1,1)=="Y")
    	    sl_AddToLog("Login Problem",$username,$logincheckmsg);
        exit;        
      }        
    }  
    $ThisSession=session_id();
    // Check if user currently has session open. If so destroy that session if concurrent logins not allowed.
    if (($ConcurrentLogin==false) && ($OpenSession!="") && ($OpenSession!=$ThisSession))
    {
      session_id($OpenSession);
      @session_destroy();
      if ($SessionName!="")
        session_name($SessionName);
      session_id($ThisSession);
      session_start();
    }

    // Regenerate session at login for security
//    session_regenerate_id();
    // Instead of using the above function we handle it manually to keep IE8 happy.
    $old_session = $_SESSION;
    @session_destroy();
    session_write_close();
    if ($sl_cookiehttponly)
      setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure,true);
    else
      setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure);      
    if ($SessionName!="")
      session_name($SessionName);
    session_id(sha1(mt_rand()));
    session_start();
    $_SESSION = $old_session;

    // Store session id
    $ThisSession=session_id();
    $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SessionField."='".$ThisSession."' WHERE ".$UsernameField."=".sl_quote_smart($username));  
	  $_SESSION['ses_slloginkey']="LOGGEDIN";
	  $sitelokloginkey="LOGGEDIN";
	  $slusername=$username;
	  $sluserid=$UserId;
	  $slpassword=$Passphrase;
	  $slpasswordclue=sl_passwordclue($slpassword);
	  $slpasswordhash=md5(md5($slpassword.$SiteKey).$SiteKey);
	  $slusergroups=$Usergroups;
	  $slname=$Name;
    $namesarray=explode(" ",trim($name));
    $slfirstname=$namesarray[0];
    $sllastname=$namesarray[count($namesarray)-1];  	  
	  $slemail=$Email;
	  $slstarttime=time();
	  $slaccesstime=time();
    $slcreated=gmmktime(0,0,0,substr($created,2,2),substr($created,4,2),substr($created,0,2));
	  $slenabled=$Enabled;
	  $slcustom1=$Custom1;
	  $slcustom2=$Custom2;
	  $slcustom3=$Custom3;
	  $slcustom4=$Custom4;
	  $slcustom5=$Custom5;
	  $slcustom6=$Custom6;
	  $slcustom7=$Custom7;
	  $slcustom8=$Custom8;
	  $slcustom9=$Custom9;
	  $slcustom10=$Custom10;
	  $slcustom11=$Custom11;
	  $slcustom12=$Custom12;
	  $slcustom13=$Custom13;
	  $slcustom14=$Custom14;
	  $slcustom15=$Custom15;
	  $slcustom16=$Custom16;
	  $slcustom17=$Custom17;
	  $slcustom18=$Custom18;
	  $slcustom19=$Custom19;
	  $slcustom20=$Custom20;
	  $slcustom21=$Custom21;
	  $slcustom22=$Custom22;
	  $slcustom23=$Custom23;
	  $slcustom24=$Custom24;
	  $slcustom25=$Custom25;
	  $slcustom26=$Custom26;
	  $slcustom27=$Custom27;
	  $slcustom28=$Custom28;
	  $slcustom29=$Custom29;
	  $slcustom30=$Custom30;
	  $slcustom31=$Custom31;
	  $slcustom32=$Custom32;
	  $slcustom33=$Custom33;
	  $slcustom34=$Custom34;
	  $slcustom35=$Custom35;
	  $slcustom36=$Custom36;
	  $slcustom37=$Custom37;
	  $slcustom38=$Custom38;
	  $slcustom39=$Custom39;
	  $slcustom40=$Custom40;
	  $slcustom41=$Custom41;
	  $slcustom42=$Custom42;
	  $slcustom43=$Custom43;
	  $slcustom44=$Custom44;
	  $slcustom45=$Custom45;
	  $slcustom46=$Custom46;
	  $slcustom47=$Custom47;
	  $slcustom48=$Custom48;
	  $slcustom49=$Custom49;
	  $slcustom50=$Custom50;
	  $slordercustom=sl_ordercustom($slusername,$IPaddr);	
    if ($slusergroups!="")
    {
      $slgroupname=array();
      $slgroupdesc=array();
      $slgrouploginaction=array();
      $slgrouploginvalue=array();
      $slgroupexpiry=array();
      $slgroupexpirybyname=array();
      $slgroupexpiryts=array();
      $slgroupexpirytsbyname=array();  
    	$umg=explode("^",$slusergroups);
    	for ($k=0;$k<count($umg);$k++)
    	{
       	$usrgrp=strtok($umg[$k],":");
        $grpexp=trim(strtok(":"));
        $slgroupname[$k]=$usrgrp;
        $slgroupdesc[$k]=$_SESSION['ses_slgroupdesc_'.$usrgrp];
        $slgrouploginaction[$k]=$_SESSION['ses_slgrouploginaction_'.$usrgrp];
        $slgrouploginvalue[$k]=$_SESSION['ses_slgrouploginvalue_'.$usrgrp];
        if ($grpexp!="")
        {
          if ($DateFormat=="DDMMYY")
          {
            $day=substr($grpexp,0,2);
            $month=substr($grpexp,2,2);
            $year=substr($grpexp,4,2);
    	      $slgroupexpiry[$k]=$day."/".$month."/".$year;
    	      $slgroupexpirybyname[$usrgrp]=$day."/".$month."/".$year;
    	      $slgroupexpiryts[$k]=gmmktime(23,59,59,intval($month),intval($day),intval($year)+2000);
    	      $slgroupexpirytsbyname[$usrgrp]=gmmktime(23,59,59,intval($month),intval($day),intval($year)+2000);
          }
          if ($DateFormat=="MMDDYY")
          {
            $month=substr($grpexp,0,2);
            $day=substr($grpexp,2,2);
            $year=substr($grpexp,4,2);
    	      $slgroupexpiry[$k]=$month."/".$day."/".$year;
    	      $slgroupexpirybyname[$usrgrp]=$month."/".$day."/".$year;
    	      $slgroupexpiryts[$k]=gmmktime(23,59,59,intval($month),intval($day),intval($year)+2000);
    	      $slgroupexpirytsbyname[$usrgrp]=gmmktime(23,59,59,intval($month),intval($day),intval($year)+2000);
          }
        }
        else
        {
  				$slgroupexpiry[$k]="Unlimited";
  				$slgroupexpiryts[$k]=0;
  				$slgroupexpirybyname[$usrgrp]="Unlimited";
  				$slgroupexpirytsbyname[$usrgrp]=0;  				
        }
    	}
    }
	      	  
	  $_SESSION['ses_slusername']=$slusername;
	  $_SESSION['ses_sluserid']=$sluserid;	  
	  $_SESSION['ses_slpassword']=$slpassword;
	  $_SESSION['ses_slstarttime']=$slstarttime;
	  $_SESSION['ses_slaccesstime']=$slaccesstime;
	  $_SESSION['ses_slcreated']=$slcreated;
	  $_SESSION['ses_slenabled']=$slenabled;
	  $_SESSION['ses_slusergroups']=$Usergroups;
	  $_SESSION['ses_slname']=$Name;
	  $_SESSION['ses_slemail']=$Email;
	  $_SESSION['ses_slcustom1']=$Custom1;
	  $_SESSION['ses_slcustom2']=$Custom2;
	  $_SESSION['ses_slcustom3']=$Custom3;
	  $_SESSION['ses_slcustom4']=$Custom4;
	  $_SESSION['ses_slcustom5']=$Custom5;
	  $_SESSION['ses_slcustom6']=$Custom6;
	  $_SESSION['ses_slcustom7']=$Custom7;
	  $_SESSION['ses_slcustom8']=$Custom8;
	  $_SESSION['ses_slcustom9']=$Custom9;
	  $_SESSION['ses_slcustom10']=$Custom10;
	  $_SESSION['ses_slcustom11']=$Custom11;
	  $_SESSION['ses_slcustom12']=$Custom12;
	  $_SESSION['ses_slcustom13']=$Custom13;
	  $_SESSION['ses_slcustom14']=$Custom14;
	  $_SESSION['ses_slcustom15']=$Custom15;
	  $_SESSION['ses_slcustom16']=$Custom16;
	  $_SESSION['ses_slcustom17']=$Custom17;
	  $_SESSION['ses_slcustom18']=$Custom18;
	  $_SESSION['ses_slcustom19']=$Custom19;
	  $_SESSION['ses_slcustom20']=$Custom20;
	  $_SESSION['ses_slcustom21']=$Custom21;
	  $_SESSION['ses_slcustom22']=$Custom22;
	  $_SESSION['ses_slcustom23']=$Custom23;
	  $_SESSION['ses_slcustom24']=$Custom24;
	  $_SESSION['ses_slcustom25']=$Custom25;
	  $_SESSION['ses_slcustom26']=$Custom26;
	  $_SESSION['ses_slcustom27']=$Custom27;
	  $_SESSION['ses_slcustom28']=$Custom28;
	  $_SESSION['ses_slcustom29']=$Custom29;
	  $_SESSION['ses_slcustom30']=$Custom30;
	  $_SESSION['ses_slcustom31']=$Custom31;
	  $_SESSION['ses_slcustom32']=$Custom32;
	  $_SESSION['ses_slcustom33']=$Custom33;
	  $_SESSION['ses_slcustom34']=$Custom34;
	  $_SESSION['ses_slcustom35']=$Custom35;
	  $_SESSION['ses_slcustom36']=$Custom36;
	  $_SESSION['ses_slcustom37']=$Custom37;
	  $_SESSION['ses_slcustom38']=$Custom38;
	  $_SESSION['ses_slcustom39']=$Custom39;
	  $_SESSION['ses_slcustom40']=$Custom40;
	  $_SESSION['ses_slcustom41']=$Custom41;
	  $_SESSION['ses_slcustom42']=$Custom42;
	  $_SESSION['ses_slcustom43']=$Custom43;
	  $_SESSION['ses_slcustom44']=$Custom44;
	  $_SESSION['ses_slcustom45']=$Custom45;
	  $_SESSION['ses_slcustom46']=$Custom46;
	  $_SESSION['ses_slcustom47']=$Custom47;
	  $_SESSION['ses_slcustom48']=$Custom48;
	  $_SESSION['ses_slcustom49']=$Custom49;
	  $_SESSION['ses_slcustom50']=$Custom50;	  
    if (substr($LogDetails,0,1)=="Y")
	    sl_AddToLog("Login",$slusername,"");
	  $sljustloggedin=true;
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onLogin[$p]))
        call_user_func($slplugin_event_onLogin[$p],$slpluginid[$p],$paramdata);
    }
    // Call user event handler
    if (function_exists("sl_onLogin"))
      sl_onLogin($paramdata);      
	  $_SESSION['ses_sljustloggedin']=true;  	    
	  if ((!$startpageoveridden) && ($loginredirect!=0))
	  {
  	  // if user is member of group then see if it has login redirect set. Only use first group listed
  	  if ($slusergroups!="")
  	  {
  	    $tmp=sl_getstartpage();
  	    if ($tmp!="")
 	        $startpage=$tmp;
  	  }
	  }
	  if ($RedirectAfterLogin==1)
	  {
	    // If login page credentials sent by GET then remove the query data for security
      $pos=strpos($startpage,"?");
      if (is_integer($pos))
      {
        $query=substr($startpage,$pos+1);
        $queryarray=explode("&",$query);
        $newquery="";
        for ($k=0;$k<count($queryarray);$k++)
        {
          if ((substr($queryarray[$k],0,9)!="username=") && (substr($queryarray[$k],0,9)!="password="))
          {
            if ($newquery!="")
              $newquery.="&";
            $newquery.=$queryarray[$k];
          }
        }
        if ($newquery!="")
          $newquery="?".$newquery;
        $startpage=substr($startpage,0,$pos).$newquery;
      }
      header("Location: ".$startpage);  
      exit;
	  }
  }
  
  // Valid session started already
  // Setup variables that user can include in secured pages
  if (($dbupdate==true) || ($DBupdate==true) || ($_SESSION['ses_UserReload']=="reload"))
  {
    if (!sl_UpdateUserVariables($_SESSION['ses_slusername'],true))
  	  sl_ShowMessage($MessagePage,MSG_DBPROB);
  }
  else
    sl_UpdateUserVariables($_SESSION['ses_slusername'],false);
  // If $userswithaccess is set then check current username (unless current user is ADMIN)
  if ($DemoMode)
    $admingroupname="DEMOADMIN";
  else
    $admingroupname="ADMIN";  
  if ($userswithaccess!="")
  {
    $match=0;
    $umg=explode("^",$slusergroups);
    for ($k=0;$k<count($umg);$k++)
  	{
     	$usrgrp=strtok($umg[$k],":");
     	if ($usrgrp==$admingroupname)
     	{
     	  $match=1;
     	  break;
     	}
  	}  
  	if ($match==0)
  	{
      $uwa=explode(",",$userswithaccess);
      for ($k=0;$k<count($uwa);$k++)
    	{
    	  if (strtolower($slusername)==strtolower(trim($uwa[$k])))
    	  {
    	    $match=1;
    	    break;
    	  }
    	}
  	}
  	if ($match==0)
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
  $sldateexpired=0;
  if ($groupswithaccess!="")
  {
    $match=0;
    $gmexpired=0;
    $slpublicaccess=false;
    if ($slusergroups!="")
    {
  	  $gwa=explode(",",$groupswithaccess);
  	  $umg=explode("^",$slusergroups);
  	  for ($k=0;$k<count($gwa);$k++)
  	  {
  	    for ($j=0;$j<count($umg);$j++)
  	    {
        	$usrgrp=strtok($umg[$j],":");
          $grpexp=trim(strtok(":"));
          $gwa[$k]=trim($gwa[$k]);
          if (($usrgrp==$gwa[$k]) || (($usrgrp=="ALL") && ($gwa[$k]!=$admingroupname)) || ($usrgrp==$admingroupname) || ($gwa[$k]=="ALL"))
          {
          	if ($grpexp!="")
            {
            	if ($DateFormat=="DDMMYY")
              {
  							$day=substr($grpexp,0,2);
  							$month=substr($grpexp,2,2);
  							$year=substr($grpexp,4,2);
              }
            	if ($DateFormat=="MMDDYY")
              {
  							$month=substr($grpexp,0,2);
  							$day=substr($grpexp,2,2);
  							$year=substr($grpexp,4,2);
              }
              $exptime=gmmktime(23,59,59,intval($month),intval($day),intval($year)+2000);
              if (time()>$exptime)
              {
              	$gmexpired=1;
              	$slexpiredgroup=$usrgrp;
              	$sldateexpired=$exptime;
              }
              else
              {
              	$match=1;
                break;
              }
            }
            else
            {
  	          $match=1;
    	        break;
            }
          }
  	    }
        if ($match==1)
          break;
  	  }
    }
    if (($match==0) && ($gmexpired==0) && ($publicaccess==false))
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
    if (($match==0) && ($gmexpired==0) && ($publicaccess==true))
    {
      // If group not allowed access but page is PUBLIC then allow public access only
      $slpublicaccess=true;
    }
    if (($match==0) && ($gmexpired==1) && ($publicaccess==true))
    {
      // If group not allowed access but page is PUBLIC then allow public access only
      $slpublicaccess=true;
    }         
    if (($allowexpireduser!="Y") && ($publicaccess!=true))
    {
      if (($match==0) && ($gmexpired==1))
      {
        if (substr($LogDetails,6,1)=="Y")
    	    sl_AddToLog("Membership Expired",$slusername,"Membership expired");
//      @session_destroy();
        if ($ExpiredPage!="")
        {
          if ((strtolower(substr($ExpiredPage,0,7))=="http://") || (strtolower(substr($ExpiredPage,0,8))=="https://"))
            header("Location: ".$ExpiredPage);      
          else          
      		  include $ExpiredPage;
        }
      	else
    	    sl_ShowMessage($MessagePage,MSG_EXPIRED);
        exit;
      }
    }  
  }
  else
  {
    // Handle if $groupswithaccess is empty (or was originally set with just PUBLIC)
    if ($slusername!="")
      $slpublicaccess=false;
    else
      $slpublicaccess=true;    
  }
  // See if session has timed out
  if (($MaxSessionTime!=0) && ($publicaccess==false))
  {
    if ((time()-$slstarttime)>$MaxSessionTime)
  	{
  	  if (substr($LogDetails,0,1)=="Y")
  		  sl_AddToLog("Logout",$slusername,"Session expired");
		  sl_processlogout($slusername);  
  		@session_destroy();
  		if ($sl_cookiehttponly)  		
    		setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure,true);
    	else
    		setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure);    		
  	  // If downloading file then the session_cache_limiter is required because of a bug in IE when using SSL
      if ((isset($_REQUEST['sldownload'])) || ($_REQUEST['act']=="exportselected") || ($_REQUEST['logmanageact']=="export"))
  	    session_cache_limiter('public');
      if ($SessionName!="")
        session_name($SessionName);	    
      session_start();
  	  // We need to send login page to browser
  	  $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_SESSEXP);
  	  exit;
    }
  }
  if (($MaxSessionTime!=0) && ($publicaccess==true))
  {
    if ((time()-$slstarttime)>$MaxSessionTime)
  	{
      $slpublicaccess=true;
  	}
  }
  // See if session was inactive too long
  if (($MaxInactivityTime!=0) && ($publicaccess==false))
  {
    if ((time()-$slaccesstime)>$MaxInactivityTime)
  	{
  	  if (substr($LogDetails,0,1)=="Y")
  		  sl_AddToLog("Logout",$slusername,"Session was inactive and expired");
		  sl_processlogout($slusername);  
  		@session_destroy();
	    if ($sl_cookiehttponly)
    		setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure,true);
    	else
    		setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure);    		
  	  // If downloading file then the session_cache_limiter is required because of a bug in IE when using SSL
      if ((isset($_REQUEST['sldownload'])) || ($_REQUEST['act']=="exportselected") || ($_REQUEST['logmanageact']=="export"))
  	    session_cache_limiter('public');
      if ($SessionName!="")
        session_name($SessionName);
      session_start();
  	  // We need to send login page to browser
  	  $sitelokloginkey=DisplayLoginPage($LoginPage,$LoginType,MSG_INACTEXP);
  	  exit;
    }
  }
  if (($MaxInactivityTime!=0) && ($publicaccess==true))
  {
    if ((time()-$slaccesstime)>$MaxInactivityTime)
  	{
      $slpublicaccess=true;
  	}
  }
  $slaccesstime=time();
  $_SESSION['ses_slaccesstime']=$slaccesstime;
  // Access to page allowed
  if (isset($_REQUEST['sldownload']))
  {
    sitelokgetfile($_REQUEST['sldownload']);
    exit;
  }
  // if not update form submission set newcustom etc variables for form prefill
  if ($sitelokaction!="modifyprofile")
  {
    $clientemail=sl_cleandata($clientemail);
    $adminemail=sl_cleandata($adminemail);
    $allowed=sl_cleandata($allowed);
    $modsuccesspage=sl_cleandata($modsuccesspage);
    $hash=sl_cleandata($hash);
    $newusername=sl_cleandata($slusername);
    $newpassword=sl_cleandata($newpassword);
    $verifynewpassword=sl_cleandata($verifynewpassword);
    $newname=sl_cleandata($slname);
    $newemail=sl_cleandata($slemail);
    $verifynewemail=sl_cleandata($verifynewemail);
    for ($k=1;$k<51;$k++)
    {
      $cusvar="newcustom".$k;
      $cusvar2="slcustom".$k;
      $$cusvar=sl_cleandata($$cusvar2);    
    }
  }  	  
  if ($sitelokaction=="modifyprofile")
  {
    // Handle array fields    
    for ($k=1;$k<51;$k++)
    {
      $cusvar="newcustom".$k;
      $cusdelimvar="slcustom".$k."delimiter";
      if (!isset($$cusdelimvar))
        $$cusdelimvar=",";
      if (is_array($_REQUEST[$cusvar]))
      {    
        $_REQUEST[$cusvar]=implode($$cusdelimvar,$_REQUEST[$cusvar]);  
        $$cusvar=$_REQUEST[$cusvar];
      }  
    }
    // Strip slashes from form prefill variables if necessary
    if (get_magic_quotes_gpc())
    {
      $newusername=stripslashes($newusername);
      $newname=stripslashes($newname);
      $newemail=stripslashes($newemail);
      for ($k=1;$k<51;$k++)
      {
        $cusvar="newcustom".$k;
        $$cusvar=stripslashes($$cusvar);
      }
    }
    // Decode data that was cleaned for prefill display in page
    $clientemail=sl_uncleandata($clientemail);
    $adminemail=sl_uncleandata($adminemail);
    $allowed=sl_uncleandata($allowed);
    $modsuccesspage=sl_uncleandata($modsuccesspage);
    $hash=sl_uncleandata($hash);
    $newusername=sl_uncleandata($newusername);
    $newpassword=sl_uncleandata($newpassword);
    $verifynewpassword=sl_uncleandata($verifynewpassword);
    $newusername=sl_uncleandata($newusername);
    $newname=sl_uncleandata($newname);
    $newemail=sl_uncleandata($newemail);
    $verifynewemail=sl_uncleandata($verifynewemail);
    for ($k=1;$k<51;$k++)
    {
      $cusvar="newcustom".$k;
      $$cusvar=sl_uncleandata($$cusvar);
    }
    $msg="";
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      sl_ShowMessage($MessagePage,MSG_DBPROB);
      exit;
    }
    if (md5($clientemail.$adminemail.$allowed.$SiteKey)==$hash)
    {
      // First see if existing password required for any changes
      if (($ProfilePassRequired==1) && ($existingpassword!=$slpassword))
      {
        if ($msg=="")
          $msg=MSG_EXPASSREQ;      
      }     
      // Check that input is allowed
      // Validate Username
      if ((isset($_REQUEST['newusername'])) && (substr($allowed,0,1)=="Y"))
      {
        if (($msg=="") && ($newusername==""))
          $msg=MSG_USERNG;
        // Call plugin and eventhandler validation function
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (($msg=="") && (function_exists($slplugin_event_onUsernameValidate[$p])))
            $msg=call_user_func($slplugin_event_onUsernameValidate[$p],$slpluginid[$p],$newusername,1);
        }
        if ($msg=="")
        {
          if (function_exists("sl_onUsernameValidate"))
            $msg=sl_onUsernameValidate($newusername,1);
        }
        if (!((strspn($newusername, $ValidUsernameChars) == strlen($newusername))))
        {
          if ($msg=="")
     	      $msg=MSG_USERNG;
     	  }  
      }
      
      // Validate password
      if ((substr($allowed,1,1)=="Y") && (isset($_REQUEST['newpassword'])) && ($newpassword!=""))
      {
          // Call plugin and eventhandler validation function
          for ($p=0;$p<$slnumplugins;$p++)
          {
            if (($msg=="") && (function_exists($slplugin_event_onPasswordValidate[$p])))
              $msg=call_user_func($slplugin_event_onPasswordValidate[$p],$slpluginid[$p],$newpassword,1);
          }
          if ($msg=="")
          {
            if (function_exists("sl_onPasswordValidate"))
              $msg=sl_onPasswordValidate($newpassword,1);
          }
          if (($msg=="") && (strspn($newpassword, $ValidPasswordChars) != strlen($newpassword)))
            $msg=MSG_PASSNG;
          if (($msg=="") && (strlen($newpassword)<5))
            $msg=MSG_PASS5;                  
      }       
      if ((substr($allowed,1,1)=="Y") && (isset($_REQUEST['newpassword'])) && ($newpassword!="") && ($newpassword!=$verifynewpassword))
      {
        if ($msg=="")
          $msg=MSG_PASSVER;      
      }     
      // See if existing password required to change password
      if ((substr($allowed,1,1)=="Y") && (isset($_REQUEST['newpassword'])) && ($newpassword!="") && ($existingpassword!=$slpassword) && ($ProfilePassRequired==2))
      {
        if ($msg=="")
          $msg=MSG_EXPASSREQ;      
      }     
      // Validate email
      if ((substr($allowed,3,1)=="Y") && (isset($_REQUEST['newemail'])))
      {
        if (($msg=="") && (!sl_validate_email($newemail)))
          $msg=MSG_EMAILNG;
        // Check if email address already used (by a different user if required                        
        if (($msg=="") && ($EmailUnique>0))
        {
          $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($newemail)." AND ".$UsernameField."!=".sl_quote_smart($slusername));
          if ($mysql_result===false)
            $msg=MSG_DBPROB;  
          $num = mysqli_num_rows($mysql_result);
          if ($num>0)
            $msg=MSG_EMAILEXISTS;
        }
        // Call plugin and eventhandler validation function
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (($msg=="") && (function_exists($slplugin_event_onEmailValidate[$p])))
            $msg=call_user_func($slplugin_event_onEmailValidate[$p],$slpluginid[$p],$newemail,1);
        }
        if ($msg=="")
        {
          if (function_exists("sl_onEmailValidate"))
            $msg=sl_onEmailValidate($newemail,1);
        } 	      
      }
      if ((isset($_REQUEST['newemail'])) && (isset($_REQUEST['verifynewemail'])) && ($newemail!=$verifynewemail))
      {
        if ($msg=="")
          $msg=MSG_EMAILVER;            
      }
      // Validate name
      if ((substr($allowed,2,1)=="Y") && (isset($_REQUEST['newname'])))
      {
        // Call plugin and eventhandler validation function
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (($msg=="") && (function_exists($slplugin_event_onNameValidate[$p])))
            $msg=call_user_func($slplugin_event_onNameValidate[$p],$slpluginid[$p],$newname,1);
        }
        if ($msg=="")
        {
          if (function_exists("sl_onNameValidate"))
            $msg=sl_onNameValidate($newname,1);
        }
        if (($msg=="") && ($newname==""))
          $msg=MSG_ENTERNAME;
      }
      // If file(s) uploaded then check for errors
      for ($k=1;$k<51;$k++)
      {
        $cusvar="newcustom".$k;
        if (($msg=="") && ($_FILES[$cusvar]['name']!="") && ($_FILES[$cusvar]['error']>0))
          $msg=MSG_UPLOADERROR.$_FILES[$cusvar]['error'];
      }
      // Validate custom fields where required 
      $uploadprefix=(string)time()."_";
      // If profile folder exists in $FileLocation then use that
      if (is_dir($FileLocation."profile"))
        $uploadprefix="profile/".$uploadprefix;            
      for ($k=1;$k<51;$k++)
      {
        $cusvar="newcustom".$k;
        $cusvar2="Custom".$k."Validate";
        $cusvar3="CustomTitle".$k;
        $cusvar4="sl_onCustom".$k."Validate";
        $cusvar5="slplugin_event_onCustom".$k."Validate";
        // First check file type if uploading (even if field has no validation)
        if (($msg=="") && ($_FILES[$cusvar]['name']))
        {
          $ext=sl_fileextension($_FILES[$cusvar]['name']);
          $ext=trim(strtolower($ext));
          if (!is_integer(array_search($ext,$sl_alloweduploads)))
            $msg=MSG_UPLOADTYPE;
        }
        // Validate for plugins  
        for ($p=0;$p<$slnumplugins;$p++)   
        {
          if ((substr($allowed,$k+3,1)=="Y") && ($msg=="") && (function_exists(${$cusvar5}[$p])))
          {
            if ($_FILES[$cusvar]['name'])
              $msg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$_FILES[$cusvar]['name'],$$cusvar3,1);
            else  
              $msg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$$cusvar,$$cusvar3,1);
          }
        }    
        // Validate using eventhandlers          
        if ((substr($allowed,$k+3,1)=="Y") && (($$cusvar2==1) || ($$cusvar2==3)))
        {
          if ($msg=="")
          {
            if ($_FILES[$cusvar]['name'])
              $msg=call_user_func($cusvar4,$_FILES[$cusvar]['name'],$$cusvar3,1);
            else
              $msg=call_user_func($cusvar4,$$cusvar,$$cusvar3,1);
          }
        }
        // Add upload prefix ready for final checks on value
        if ((substr($allowed,$k+3,1)=="Y") && ($_FILES[$cusvar]['name']!=""))
          $$cusvar=$uploadprefix.$_FILES[$cusvar]['name'];
      }
      // See if email field is being used as the username as well (if username is not entered but is allowed)
      $emailusedasusername=false;
      if ((!isset($_REQUEST['newusername'])) && (substr($allowed,0,1)=="Y") && (isset($_REQUEST['newemail'])))
      {
        $emailusedasusername=true;
        $newusername=$newemail;
      } 
      // Call onCheckModifyProfile event handlers     
      if ($msg=="")
      {
        // Here we should give any custom code or plugins the final decision about the updated data
        $paramdata['allowed']=$allowed;
        if (count($modifygroup)>0)
          $paramdata['modifygroups']=implode("|",$modifygroup);
        else
          $paramdata['modifygroups']="";   
        $paramdata['oldusername']=$slusername;
        if ($newusername!="")
          $paramdata['username']=$newusername;
        else
          $paramdata['username']=$slusername;
        $paramdata['userid']=$sluserid;
        $paramdata['password']=$newpassword;
        $paramdata['enabled']="Yes";
        $paramdata['name']=$newname;
        $paramdata['email']=$newemail;
        $paramdata['usergroups']=$slusergroups;
        $paramdata['custom1']=$newcustom1;
        $paramdata['custom2']=$newcustom2;
        $paramdata['custom3']=$newcustom3;
        $paramdata['custom4']=$newcustom4;
        $paramdata['custom5']=$newcustom5;
        $paramdata['custom6']=$newcustom6;
        $paramdata['custom7']=$newcustom7;
        $paramdata['custom8']=$newcustom8;
        $paramdata['custom9']=$newcustom9;
        $paramdata['custom10']=$newcustom10;
        $paramdata['custom11']=$newcustom11;
        $paramdata['custom12']=$newcustom12;
        $paramdata['custom13']=$newcustom13;
        $paramdata['custom14']=$newcustom14;
        $paramdata['custom15']=$newcustom15;
        $paramdata['custom16']=$newcustom16;
        $paramdata['custom17']=$newcustom17;
        $paramdata['custom18']=$newcustom18;
        $paramdata['custom19']=$newcustom19;
        $paramdata['custom20']=$newcustom20;
        $paramdata['custom21']=$newcustom21;
        $paramdata['custom22']=$newcustom22;
        $paramdata['custom23']=$newcustom23;
        $paramdata['custom24']=$newcustom24;
        $paramdata['custom25']=$newcustom25;
        $paramdata['custom26']=$newcustom26;
        $paramdata['custom27']=$newcustom27;
        $paramdata['custom28']=$newcustom28;
        $paramdata['custom29']=$newcustom29;
        $paramdata['custom30']=$newcustom30;
        $paramdata['custom31']=$newcustom31;
        $paramdata['custom32']=$newcustom32;
        $paramdata['custom33']=$newcustom33;
        $paramdata['custom34']=$newcustom34;
        $paramdata['custom35']=$newcustom35;
        $paramdata['custom36']=$newcustom36;
        $paramdata['custom37']=$newcustom37;
        $paramdata['custom38']=$newcustom38;
        $paramdata['custom39']=$newcustom39;
        $paramdata['custom40']=$newcustom40;
        $paramdata['custom41']=$newcustom41;
        $paramdata['custom42']=$newcustom42;
        $paramdata['custom43']=$newcustom43;
        $paramdata['custom44']=$newcustom44;
        $paramdata['custom45']=$newcustom45;
        $paramdata['custom46']=$newcustom46;
        $paramdata['custom47']=$newcustom47;
        $paramdata['custom48']=$newcustom48;
        $paramdata['custom49']=$newcustom49;
        $paramdata['custom50']=$newcustom50;
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onCheckModifyProfile[$p]))
            $msg=call_user_func($slplugin_event_onCheckModifyProfile[$p],$slpluginid[$p],$paramdata);
          if ($msg!="")
            break;
        }
      }
      // Call user event handler
      if ($msg=="")
      {            
        if (function_exists("sl_onCheckModifyProfile"))
          $msg=sl_onCheckModifyProfile($paramdata);
      }
      
      // Call onCheckModify event handlers     
      if ($msg=="")
      {
        // Here we should give any custom code or plugins the final decision about the updated data
        $paramdata['oldusername']=$slusername;
        if ($newusername!="")
          $paramdata['username']=$newusername;
        else
          $paramdata['username']=$slusername;
        $paramdata['userid']=$sluserid;
        $paramdata['password']=$newpassword;
        $paramdata['enabled']="Yes";
        $paramdata['name']=$newname;
        $paramdata['email']=$newemail;
        $paramdata['usergroups']=$slusergroups;
        $paramdata['custom1']=$newcustom1;
        $paramdata['custom2']=$newcustom2;
        $paramdata['custom3']=$newcustom3;
        $paramdata['custom4']=$newcustom4;
        $paramdata['custom5']=$newcustom5;
        $paramdata['custom6']=$newcustom6;
        $paramdata['custom7']=$newcustom7;
        $paramdata['custom8']=$newcustom8;
        $paramdata['custom9']=$newcustom9;
        $paramdata['custom10']=$newcustom10;
        $paramdata['custom11']=$newcustom11;
        $paramdata['custom12']=$newcustom12;
        $paramdata['custom13']=$newcustom13;
        $paramdata['custom14']=$newcustom14;
        $paramdata['custom15']=$newcustom15;
        $paramdata['custom16']=$newcustom16;
        $paramdata['custom17']=$newcustom17;
        $paramdata['custom18']=$newcustom18;
        $paramdata['custom19']=$newcustom19;
        $paramdata['custom20']=$newcustom20;
        $paramdata['custom21']=$newcustom21;
        $paramdata['custom22']=$newcustom22;
        $paramdata['custom23']=$newcustom23;
        $paramdata['custom24']=$newcustom24;
        $paramdata['custom25']=$newcustom25;
        $paramdata['custom26']=$newcustom26;
        $paramdata['custom27']=$newcustom27;
        $paramdata['custom28']=$newcustom28;
        $paramdata['custom29']=$newcustom29;
        $paramdata['custom30']=$newcustom30;
        $paramdata['custom31']=$newcustom31;
        $paramdata['custom32']=$newcustom32;
        $paramdata['custom33']=$newcustom33;
        $paramdata['custom34']=$newcustom34;
        $paramdata['custom35']=$newcustom35;
        $paramdata['custom36']=$newcustom36;
        $paramdata['custom37']=$newcustom37;
        $paramdata['custom38']=$newcustom38;
        $paramdata['custom39']=$newcustom39;
        $paramdata['custom40']=$newcustom40;
        $paramdata['custom41']=$newcustom41;
        $paramdata['custom42']=$newcustom42;
        $paramdata['custom43']=$newcustom43;
        $paramdata['custom44']=$newcustom44;
        $paramdata['custom45']=$newcustom45;
        $paramdata['custom46']=$newcustom46;
        $paramdata['custom47']=$newcustom47;
        $paramdata['custom48']=$newcustom48;
        $paramdata['custom49']=$newcustom49;
        $paramdata['custom50']=$newcustom50;
        $paramdata['from']=0;                      
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if ($msg=="")
          {
            if (function_exists($slplugin_event_onCheckModifyUser[$p]))
            {
              $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
              if ($res['ok']==false)
                $msg=$res['message'];
            } 
          }  
        }
        if ($msg=="")
        {
          // Call eventhandler
          if (function_exists("sl_onCheckModifyUser"))
          {
            $res=sl_onCheckModifyUser($paramdata);
            if ($res['ok']==false)
              $msg=$res['message'];
          }  
        }        
      }
      
      $requestedemail="";
      if ($msg=="") 
      {
        // See if user has to confirm email address change
        // If so we should store new email for link and use old one
        if (($EmailConfirmRequired==1) && (substr($allowed,3,1)=="Y") && (isset($_REQUEST['newemail'])) && (strtolower($newemail)!==strtolower($slemail)))
        {
          $requestedemail=$newemail;
          $newemail=$slemail;
          if ($emailusedasusername)
            $newusername=$slusername;
        }
      } 
           
      // Setup query required
      if ($msg=="")
      {
        $Query="";
        // If username is entered and allowed
        if ((substr($allowed,0,1)=="Y") && $newusername!="")
        {
          if ($Query!="") $Query.=", ";
           	$Query.=$UsernameField."=".sl_quote_smart($newusername);
        }
        if ((isset($_REQUEST['newpassword'])) && ($newpassword!="") && ($newpassword==$verifynewpassword) && (substr($allowed,1,1)=="Y"))
        {
          if ($Query!="") $Query.=", ";
          if ($MD5passwords)
          	$Query.=$PasswordField."=".sl_quote_smart(md5($newpassword.$SiteKey));
        	else
          	$Query.=$PasswordField."=".sl_quote_smart($newpassword);    	
        }
        if ((isset($_REQUEST['newname'])) && (substr($allowed,2,1)=="Y"))
        {
          if ($Query!="") $Query.=", ";
        	$Query.=$NameField."=".sl_quote_smart($newname);
        }
        if ((isset($_REQUEST['newemail'])) && (substr($allowed,3,1)=="Y"))
        {
          if ($Query!="") $Query.=", ";
        	$Query.=$EmailField."=".sl_quote_smart($newemail);
        }
        for ($k=1;$k<51;$k++)
        {
          $cusvar="newcustom".$k;
          $cusvar2="Custom".$k."Field";
          $cusvar3="newcustom".$k."clear";
          if (substr($allowed,$k+3,1)=="Y")
          {
            if ($_FILES[$cusvar]['name']!="")
            {
              if ($Query!="") $Query.=", ";
         	    $Query.=$$cusvar2."=".sl_quote_smart($$cusvar);
            }
            else
            {
              // If upload field but no file uploaded this time don't overwrite unless newcustomXclear field set
              if (!isset($_FILES[$cusvar]['error']))
              {
                if ($Query!="") $Query.=", ";
          	    $Query.=$$cusvar2."=".sl_quote_smart($$cusvar);
          	  }
          	  else
          	  {
          	    if ($$cusvar3!="")
          	    {
                  if ($Query!="") $Query.=", ";
            	    $Query.=$$cusvar2."=".sl_quote_smart("");
            	  }  
          	  }  
          	}  
          }
        }
        // If table update required then do it
        if ($Query!="")
        {
          $Query="UPDATE ".$DbTableName." SET ".$Query." WHERE ".$UsernameField."=".sl_quote_smart($slusername);
          if ($DemoMode)
            $mysql_result=true;
          else  
            $mysql_result=mysqli_query($mysql_link,$Query);
          if ($mysql_result==false)  
          {
            if (isset($_REQUEST['newusername']))
              $msg=MSG_USEREXISTS;
            else
              $msg=MSG_PROFPROBLEM;          
          }
        }
      }
      // Update variables and handle uploads
      if ($msg=="")
      {
        if ((isset($_REQUEST['newusername'])) && ($newusername!="") && (substr($allowed,0,1)=="Y"))
        {
          $oldusername=$slusername;
         	$slusername=$_SESSION['ses_slusername']=$newusername;
         	if ($oldusername!=$slusername)
            sl_usernamechanged($oldusername,$slusername);
        }
        // If username is not entered (but is allowed) then use email as username
        if ((!isset($_REQUEST['newusername'])) && (substr($allowed,0,1)=="Y") && (isset($_REQUEST['newemail'])))
        {
          $oldusername=$slusername;
         	$slusername=$_SESSION['ses_slusername']=$newemail;
         	if ($oldusername!=$slusername)
            sl_usernamechanged($oldusername,$slusername);
        }                	
        if ((isset($_REQUEST['newpassword'])) && ($newpassword!="") && (substr($allowed,1,1)=="Y"))
        {
        	$slpassword=$_SESSION['ses_slpassword']=$newpassword;
        	$slpasswordclue=sl_passwordclue($slpassword);
   	  	  $slpasswordhash=md5(md5($slpassword.$SiteKey).$SiteKey);
        }
        if ((isset($_REQUEST['newname'])) && (substr($allowed,2,1)=="Y"))
        	$slname=$newname=$_SESSION['ses_slname']=$newname;
        if ((isset($_REQUEST['newemail'])) && (substr($allowed,3,1)=="Y"))
        	$slemail=$newemail=$_SESSION['ses_slemail']=$newemail;
        for ($k=1;$k<51;$k++)
        {
          $cusvar="newcustom".$k;
          $cusvar2="ses_slcustom".$k;
          $cusvar3="slcustom".$k;	
          $cusvar4="newcustom".$k."clear";
          if (substr($allowed,$k+3,1)=="Y")
          {
            if ($_FILES[$cusvar]['name']!="")
            {
              // Handle upload
              // Delete any existing file pointed to
              if (function_exists("blab_getuploadedimage"))
              {
                $tmp=blab_getuploadedimage($$cusvar3);
                if (($tmp!="") && (file_exists($FileLocation.$tmp)))
                  @unlink($FileLocation.$tmp);
              }
              else
              {
                if (($$cusvar3!="") && (file_exists($FileLocation.$$cusvar3)))
                  @unlink($FileLocation.$$cusvar3);
              }    
              // Move uploaded file
              $uploadedok=@move_uploaded_file($_FILES[$cusvar]['tmp_name'], $FileLocation.$$cusvar);
              if (!$uploadedok)
              {
                $msg=MSG_UPLOADERROR.$_FILES[$cusvar]['error'];
              }  
              else
              {
                // Call plugin event
                for ($p=0;$p<$slnumplugins;$p++)
                {
                  if (function_exists($slplugin_event_onUpload[$p]))
                    call_user_func($slplugin_event_onUpload[$p],$slpluginid[$p],$k,$FileLocation.$$cusvar);
                }              
                if (function_exists("sl_onUpload"))
                  sl_onUpload($k,$FileLocation.$$cusvar);
              }  
          	  $$cusvar3=$$cusvar;
          	  $_SESSION[$cusvar2]=$$cusvar;              	  
          	}  
            else
            {
              if (!isset($_FILES[$cusvar]['error']))
              {
            	  $$cusvar3=$$cusvar;
            	  $_SESSION[$cusvar2]=$$cusvar;
            	}
            	else
            	{
          	    if ($$cusvar4!="")
          	    {
          	      // Clear custom field and delete file pointed to if it exists
                  if (function_exists("blab_getuploadedimage"))
                   {
                     $tmp=blab_getuploadedimage($$cusvar3);
                     if (($tmp!="") && (file_exists($FileLocation.$tmp)))
                       @unlink($FileLocation.$tmp);
                   }
                   else
                   {
                     if (($$cusvar3!="") && (file_exists($FileLocation.$$cusvar3)))
                       @unlink($FileLocation.$$cusvar3);
                   }    
            	    $$cusvar3="";
            	    $_SESSION[$cusvar2]="";
            	  }  
            	}  
          	}  
          }	
        } 
      }  
      if ($msg=="")
      {  
        // If any modifygroup[] inputs are in the form then process them here
        for ($k=0;$k<count($modifygroup);$k++)
        {
          $auth = rawurldecode($modifygroup[$k]);
          $auth=base64_decode($auth);
          $linkvars=explode(",",$auth);
          $function = trim($linkvars[0]);
          if ($function=="1")   // add group
          {
            $setgroup = trim($linkvars[1]);
            $setgroupexpiry = trim($linkvars[2]);   
            $hash = md5($SiteKey . $function . session_id() . $setgroup . $setgroupexpiry);
            $verifyhash = trim($linkvars[3]);
            $verifyhash = trim($verifyhash); // Clean up problem with strtok
            if ($verifyhash==$hash)
              sl_addgroup($setgroup,$setgroupexpiry,"","");
          }          
          if ($function=="2")   // remove group
          {
            $setgroup = trim($linkvars[1]);
            $hash = md5($SiteKey . $function . session_id() . $setgroup);
            $verifyhash = trim($linkvars[2]);
            $verifyhash = trim($verifyhash); // Clean up problem with strtok
            if ($verifyhash==$hash)
              sl_removegroup($setgroup,"","");
          }          
          if ($function=="3")   // replace group
          {
            $setgroup = trim($linkvars[1]);
            $setnewgroup = trim($linkvars[2]);
            $setgroupexpiry = trim($linkvars[3]);   
            
            $hash = md5($SiteKey . $function . session_id() . $setgroup . $setnewgroup . $setgroupexpiry);
            $verifyhash = trim($linkvars[4]);
            $verifyhash = trim($verifyhash); // Clean up problem with strtok
            if ($verifyhash==$hash)
              sl_replacegroup($setgroup,$setnewgroup,$setgroupexpiry,"","");
          }          
          if ($function=="4")   // extend group
          {
            $setgroup = trim($linkvars[1]);
            $setgroupexpiry = trim($linkvars[2]);
            $setexpirytype = trim($linkvars[3]);                 
            $hash = md5($SiteKey . $function . session_id() . $setgroup . $setgroupexpiry . $setexpirytype);
            $verifyhash = trim($linkvars[4]);
            $verifyhash = trim($verifyhash); // Clean up problem with strtok
            if ($verifyhash==$hash)
              sl_extendgroup($setgroup,$setgroupexpiry,$setexpirytype,"","");
          }          
        }
      }        
      if ($msg=="")
      {
        if (substr($LogDetails,7,1)=="Y")
          sl_AddToLog("User Modify",$slusername,"");
        if ($requestedemail!="")
          $msg=MSG_PROFUPDATEDVEREMAIL;
        else  
          $msg=MSG_PROFUPDATED;
        if ($clientemail!="")
        {
      	  if (sl_ReadEmailTemplate($clientemail,$subject,$mailBody,$htmlformat))
      	  {
      	      // Handle !!!verifyemail!!! !!!existingemail!!! and !!!requestedemail!!! tags
      	      sl_ConfirmEmailTags($newemail,$requestedemail,$emailusedasusername,$subject,$mailBody,$htmlformat);
      	      sl_SendEmail($slemail,$mailBody,$subject,$htmlformat,$slusername,$slpassword,$slname,$slemail,$slusergroups,$slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10,
              $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20,$slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30,
              $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40,$slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50);     	            	      
      	  }      	    
      	}
        if ($adminemail!="")
        {
      	  if (sl_ReadEmailTemplate($adminemail,$subject,$mailBody,$htmlformat))
      	  {
      	      // Handle !!!verifyemail!!! and !!!requestedemail!!! tags
      	      sl_ConfirmEmailTags($newemail,$requestedemail,$emailusedasusername,$subject,$mailBody,$htmlformat);
      	      sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$slusername,$slpassword,$slname,$slemail,$slusergroups,$slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10,
              $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20,$slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30,
              $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40,$slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50);     	            	            	      
      	  }      	    
        }
        // See if verify email link template has to be sent out
        if (($EmailConfirmRequired==1) && ($requestedemail!="") && ($EmailConfirmTemplate!=""))
        {
      	  if (sl_ReadEmailTemplate($EmailConfirmTemplate,$subject,$mailBody,$htmlformat))
      	  {
      	    if ($mailBody!="")
      	    {
      	      // Handle !!!verifyemail!!! and !!!requestedemail!!! tags
      	      sl_ConfirmEmailTags($newemail,$requestedemail,$emailusedasusername,$subject,$mailBody,$htmlformat);
      	      sl_SendEmail($requestedemail,$mailBody,$subject,$htmlformat,$slusername,$slpassword,$slname,$slemail,$slusergroups,$slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10,
              $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20,$slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30,
              $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40,$slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50);     	            	      
            }  
      	  }      	    
        }
        // Event point
        if ($oldusername!="")
          $paramdata['oldusername']=$oldusername;
        else  
          $paramdata['oldusername']=$slusername;
        $paramdata['userid']=$sluserid;
        $paramdata['username']=$slusername;
        $paramdata['password']=$slpassword;
        $paramdata['enabled']="Yes";
        $paramdata['name']=$slname;
        $paramdata['email']=$slemail;
        $paramdata['usergroups']=$slusergroups;
        $paramdata['custom1']=$slcustom1;
        $paramdata['custom2']=$slcustom2;
        $paramdata['custom3']=$slcustom3;
        $paramdata['custom4']=$slcustom4;
        $paramdata['custom5']=$slcustom5;
        $paramdata['custom6']=$slcustom6;
        $paramdata['custom7']=$slcustom7;
        $paramdata['custom8']=$slcustom8;
        $paramdata['custom9']=$slcustom9;
        $paramdata['custom10']=$slcustom10;
        $paramdata['custom11']=$slcustom11;
        $paramdata['custom12']=$slcustom12;
        $paramdata['custom13']=$slcustom13;
        $paramdata['custom14']=$slcustom14;
        $paramdata['custom15']=$slcustom15;
        $paramdata['custom16']=$slcustom16;
        $paramdata['custom17']=$slcustom17;
        $paramdata['custom18']=$slcustom18;
        $paramdata['custom19']=$slcustom19;
        $paramdata['custom20']=$slcustom20;
        $paramdata['custom21']=$slcustom21;
        $paramdata['custom22']=$slcustom22;
        $paramdata['custom23']=$slcustom23;
        $paramdata['custom24']=$slcustom24;
        $paramdata['custom25']=$slcustom25;
        $paramdata['custom26']=$slcustom26;
        $paramdata['custom27']=$slcustom27;
        $paramdata['custom28']=$slcustom28;
        $paramdata['custom29']=$slcustom29;
        $paramdata['custom30']=$slcustom30;
        $paramdata['custom31']=$slcustom31;
        $paramdata['custom32']=$slcustom32;
        $paramdata['custom33']=$slcustom33;
        $paramdata['custom34']=$slcustom34;
        $paramdata['custom35']=$slcustom35;
        $paramdata['custom36']=$slcustom36;
        $paramdata['custom37']=$slcustom37;
        $paramdata['custom38']=$slcustom38;
        $paramdata['custom39']=$slcustom39;
        $paramdata['custom40']=$slcustom40;
        $paramdata['custom41']=$slcustom41;
        $paramdata['custom42']=$slcustom42;
        $paramdata['custom43']=$slcustom43;
        $paramdata['custom44']=$slcustom44;
        $paramdata['custom45']=$slcustom45;
        $paramdata['custom46']=$slcustom46;
        $paramdata['custom47']=$slcustom47;
        $paramdata['custom48']=$slcustom48;
        $paramdata['custom49']=$slcustom49;
        $paramdata['custom50']=$slcustom50;
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onModifyUser[$p]))
            call_user_func($slplugin_event_onModifyUser[$p],$slpluginid[$p],$paramdata);
        }
        // Call user event handler            
        if (function_exists("sl_onModifyUser"))
          sl_onModifyUser($paramdata);
        // If $modsuccesspage is set redirect.
        if ($modsuccesspage!="")
        {
          $modsuccesspage=str_replace("!!!username!!!",urlencode($slusername),$modsuccesspage);
          $modsuccesspage=str_replace("!!!ordercustom!!!",sl_ordercustom($slusername,trim(strtok($_SERVER['REMOTE_ADDR'],","))),$modsuccesspage);      	   
          $modsuccesspage=str_replace("!!!password!!!",urlencode($slpassword),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!passwordclue!!!",urlencode(sl_passwordclue($slpassword)),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!passwordhash!!!",md5(md5($slpassword.$SiteKey).$SiteKey),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!name!!!",urlencode($slname),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!email!!!",urlencode($slemail),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom1!!!",urlencode($slcustom1),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom2!!!",urlencode($slcustom2),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom3!!!",urlencode($slcustom3),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom4!!!",urlencode($slcustom4),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom5!!!",urlencode($slcustom5),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom6!!!",urlencode($slcustom6),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom7!!!",urlencode($slcustom7),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom8!!!",urlencode($slcustom8),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom9!!!",urlencode($slcustom9),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom10!!!",urlencode($slcustom10),$modsuccesspage);	   	    
          $modsuccesspage=str_replace("!!!custom11!!!",urlencode($slcustom11),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom12!!!",urlencode($slcustom12),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom13!!!",urlencode($slcustom13),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom14!!!",urlencode($slcustom14),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom15!!!",urlencode($slcustom15),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom16!!!",urlencode($slcustom16),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom17!!!",urlencode($slcustom17),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom18!!!",urlencode($slcustom18),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom19!!!",urlencode($slcustom19),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom20!!!",urlencode($slcustom20),$modsuccesspage);	   	    
          $modsuccesspage=str_replace("!!!custom21!!!",urlencode($slcustom21),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom22!!!",urlencode($slcustom22),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom23!!!",urlencode($slcustom23),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom24!!!",urlencode($slcustom24),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom25!!!",urlencode($slcustom25),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom26!!!",urlencode($slcustom26),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom27!!!",urlencode($slcustom27),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom28!!!",urlencode($slcustom28),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom29!!!",urlencode($slcustom29),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom30!!!",urlencode($slcustom30),$modsuccesspage);	   	    
          $modsuccesspage=str_replace("!!!custom31!!!",urlencode($slcustom31),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom32!!!",urlencode($slcustom32),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom33!!!",urlencode($slcustom33),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom34!!!",urlencode($slcustom34),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom35!!!",urlencode($slcustom35),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom36!!!",urlencode($slcustom36),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom37!!!",urlencode($slcustom37),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom38!!!",urlencode($slcustom38),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom39!!!",urlencode($slcustom39),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom40!!!",urlencode($slcustom40),$modsuccesspage);	   	    
          $modsuccesspage=str_replace("!!!custom41!!!",urlencode($slcustom41),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom42!!!",urlencode($slcustom42),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom43!!!",urlencode($slcustom43),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom44!!!",urlencode($slcustom44),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom45!!!",urlencode($slcustom45),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom46!!!",urlencode($slcustom46),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom47!!!",urlencode($slcustom47),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom48!!!",urlencode($slcustom48),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom49!!!",urlencode($slcustom49),$modsuccesspage);	   
          $modsuccesspage=str_replace("!!!custom50!!!",urlencode($slcustom50),$modsuccesspage);           
          header("Location: ".$modsuccesspage);
          exit;
        }  
  //  mysqli_close($mysql_link);  
      }
    }
    // Clean input data before displaying for prefill
    $clientemail=sl_cleandata($clientemail);
    $adminemail=sl_cleandata($adminemail);
    $allowed=sl_cleandata($allowed);
    $modsuccesspage=sl_cleandata($modsuccesspage);
    $hash=sl_cleandata($hash);
    $newusername=sl_cleandata($slusername);
    $newpassword=sl_cleandata($newpassword);
    $verifynewpassword=sl_cleandata($verifynewpassword);
    $newname=sl_cleandata($slname);
    $newemail=sl_cleandata($slemail);
    $verifynewemail=sl_cleandata($verifynewemail);
    for ($k=1;$k<51;$k++)
    {
      $cusvar="newcustom".$k;
      $cusvar2="slcustom".$k;
      $$cusvar=sl_cleandata($$cusvar2);    
    }
  }
  // on page access Event point
  $paramdata['username']=$slusername;
  $paramdata['userid']=$sluserid;  
  $paramdata['password']=$slpassword;
  $paramdata['enabled']=$slenabled;
  $paramdata['name']=$slname;
  $paramdata['email']=$slemail;
  $paramdata['usergroups']=$slusergroups;
  $paramdata['custom1']=$slcustom1;
  $paramdata['custom2']=$slcustom2;
  $paramdata['custom3']=$slcustom3;
  $paramdata['custom4']=$slcustom4;
  $paramdata['custom5']=$slcustom5;
  $paramdata['custom6']=$slcustom6;
  $paramdata['custom7']=$slcustom7;
  $paramdata['custom8']=$slcustom8;
  $paramdata['custom9']=$slcustom9;
  $paramdata['custom10']=$slcustom10;
  $paramdata['custom11']=$slcustom11;
  $paramdata['custom12']=$slcustom12;
  $paramdata['custom13']=$slcustom13;
  $paramdata['custom14']=$slcustom14;
  $paramdata['custom15']=$slcustom15;
  $paramdata['custom16']=$slcustom16;
  $paramdata['custom17']=$slcustom17;
  $paramdata['custom18']=$slcustom18;
  $paramdata['custom19']=$slcustom19;
  $paramdata['custom20']=$slcustom20;
  $paramdata['custom21']=$slcustom21;
  $paramdata['custom22']=$slcustom22;
  $paramdata['custom23']=$slcustom23;
  $paramdata['custom24']=$slcustom24;
  $paramdata['custom25']=$slcustom25;
  $paramdata['custom26']=$slcustom26;
  $paramdata['custom27']=$slcustom27;
  $paramdata['custom28']=$slcustom28;
  $paramdata['custom29']=$slcustom29;
  $paramdata['custom30']=$slcustom30;
  $paramdata['custom31']=$slcustom31;
  $paramdata['custom32']=$slcustom32;
  $paramdata['custom33']=$slcustom33;
  $paramdata['custom34']=$slcustom34;
  $paramdata['custom35']=$slcustom35;
  $paramdata['custom36']=$slcustom36;
  $paramdata['custom37']=$slcustom37;
  $paramdata['custom38']=$slcustom38;
  $paramdata['custom39']=$slcustom39;
  $paramdata['custom40']=$slcustom40;
  $paramdata['custom41']=$slcustom41;
  $paramdata['custom42']=$slcustom42;
  $paramdata['custom43']=$slcustom43;
  $paramdata['custom44']=$slcustom44;
  $paramdata['custom45']=$slcustom45;
  $paramdata['custom46']=$slcustom46;
  $paramdata['custom47']=$slcustom47;
  $paramdata['custom48']=$slcustom48;
  $paramdata['custom49']=$slcustom49;
  $paramdata['custom50']=$slcustom50;
  $paramdata['page']=$thispage;
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onPageAccess[$p]))
      call_user_func($slplugin_event_onPageAccess[$p],$slpluginid[$p],$paramdata);
  }
  // Call user event handler
  if (function_exists("sl_onPageAccess"))
    sl_onPageAccess($paramdata);
  // Update last page visited
  sl_storerequestpage();
  
} // ($slsearchengine==false)

function DisplayLoginPage($LoginPage,$LoginType,$msg)
{
  global $_SESSION,$startpage,$LoginKey;
  global $slcookieusername,$slcookiepassword,$slcookielogin,$CookieLogin;
  global $TuringLogin,$SitelokLocationURL,$SitelokLocation;
  global $slnumplugins,$slplugin_event_onDefaultLoginTemplate;
  if ($SitelokLocationURL!="")
  {
    $slpwURLparts=getUrlParts($SitelokLocationURL);
    $slpwURL="/".$slpwURLparts[resource];
  }  
  else  
    $slpwURL="http://".$_SERVER['HTTP_HOST']."/slpw/"; 
  // For security if auto login enabled then don't prefill login fields
  if ($CookieLogin==2)
  {
    $slcookieusername="";
    $slcookiepassword="";
  }
  // See if login msg is in the session (from a plugin like Facebook Login)
  if ($_SESSION['ses_loginmsg']!="")
  {
    $msg=$_SESSION['ses_loginmsg'];
    $_SESSION['ses_loginmsg']="";
  }
  // Display login page
	// First create unique session based login key
  $CharAllowed="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  srand((double) microtime() * 1000000);
  $LoginKey="";
  for ($k=0;$k<32;$k++)
  {
    $r=rand(0,61);
    $LoginKey=$LoginKey.$CharAllowed[$r];
  }
  $_SESSION['ses_slloginkey']=$LoginKey;
  // If we are using default template then see if any plugin needs to provide one
  if ($LoginPage=="")
  {
    $plugintemplate="";
    $paramdata['message']=$msg;
    $paramdata['loginkey']=$LoginKey;
    $paramdata['logintype']=$LoginType;
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if ($plugintemplate=="")
      {
        if (function_exists($slplugin_event_onDefaultLoginTemplate[$p]))
          $plugintemplate=call_user_func($slplugin_event_onDefaultLoginTemplate[$p],$slpluginid[$p],$paramdata);
      }  
    }
    // Call user event handler
    if ($plugintemplate=="")
    {
      if (function_exists("sl_onDefaultLoginTemplate"))
        $plugintemplate=sl_onoDefaultLoginTemplate($paramdata);      
    }  
    if ($plugintemplate!="")
      $LoginPage=$plugintemplate;
  }
	if ($LoginPage!="")
	{
	  if (file_exists($LoginPage))
	  {
	    $slpublicaccess=true;
		  include $LoginPage;
		}
		else
		{
		  if (file_exists($SitelokLocation.$LoginPage))
		  {
  	    $slpublicaccess=true;
	   	  include $SitelokLocation.$LoginPage; 
		  }
		  else
		    $LoginPage="";
		}  
	}	  
  if ($LoginPage=="")
  {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<style type="text/css">
/* Thanks to IE6 for requiring so much unnecessary CSS! */
* {
margin: 0;
padding: 0;
}
div.loginbox {
  background-color: white;
  width: 333px;
  height: 352px;
  padding: 58px 76px 0 76px;
  margin-left: auto;
  margin-right: auto;
  color: #ebebeb;
  background-color: #ffffff;
  font: 12px Arial, Helvetica, sans-serif;
  background: url(<?php echo $slpwURL; ?>loginbackground.png) no-repeat left top;
}

h1.loginbox {
	padding: 0 0 0 0;
	margin: -10px 0 20px 0;
	color: #ebebeb;
	font: bold 44px Arial, Helvetica, sans-serif;
	text-align: center;
}

label.loginbox {
  display: inline-block;
  position: relative;
  width: 96px;
	text-align:right;
	margin: 0 0 0 0;
	padding: 10px 10px 0 0;
<?php if ($TuringLogin==0) { ?>
	padding: 20px 10px 0 0;
<?php } ?>
  vertical-align: middle;	
}

input.loginbox {
  display: inline-block;
  position: relative;
	width: 180px;
	height: 20px;
	padding: 10px 4px 6px 3px;
  margin: 10px 0 0 0;
<?php if ($TuringLogin==0) { ?>
  margin: 20px 0 0 0;
<?php } ?>
	border: 1px solid #0d2c52;
	background-color:#1e4f8a;
	font-size: 16px;
	color: #ebebeb;
  vertical-align: middle;
}

input.loginboxcaptcha {
  display: inline-block;
  position: relative;
	width: 90px;
	height: 20px;
	padding: 10px 4px 6px 3px;
  margin: 10px 0 0 0;
<?php if ($TuringLogin==0) { ?>
  margin: 20px 0 0 0;
<?php } ?>
	border: 1px solid #0d2c52;
	background-color:#1e4f8a;
	font-size: 16px;
	color: #ebebeb;
  vertical-align: middle;
}

img.loginboxcaptcha {
  display: inline-block;
	width: 86px;
	height: 36px;
	padding: 0 0 0 0;
  margin: 10px 0 0 0;
	border: 1px solid #0d2c52;
	background-color:#1e4f8a;
  vertical-align: middle;
}

div.extraoptions {
  margin: 10px 0 0 109px;
<?php if ($TuringLogin==0) { ?>
  margin: 20px 0 0 109px;
<?php } ?>
  padding: 0 0 0 0;
}

.loginremember {
  display: inline-block;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

label.loginboxcb {
  display: inline-block;
  position: relative;
  width: 96px;
	text-align: left;
  vertical-align: middle;	
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

input.loginboxcb {
  display: inline-block;
  position: relative;
	margin: 0 0 0 0;
	padding: 0 0 0 0;
  vertical-align: middle;
}

.loginforgot {
  display: inline-block;
  margin: 0 0 0 10px;
  padding: 0 0 0 0;
  vertical-align: middle;
}

a.loginbox {
  display: inline-block;
  position: relative;
  color: #ebebeb;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

div.loginbutton {
  position: relative;
	margin: 20px 0 0 109px;
<?php if ($TuringLogin==0) { ?>
	margin: 30px 0 0 109px;
<?php } ?>
  padding: 0 0 0 0;
}

#submit {
  position: relative;
	width:103px;
	height:42px;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}

p.message {
	color: #ff0000;
	font: bold 12pt Arial, Helvetica, sans-serif;
	text-align: center;
	padding: 0 0 0 0;
	margin: 0 0 0 0;
}
</style>

<!--[if lt IE 7]>
<style type="text/css">
div.loginbox {
background-color: white;
width: 333px;
height: 352px;
padding: 58px 76px 0 76px;
margin-left: auto;
margin-right: auto;
color: #ebebeb;
background-color: #ffffff;
font: 12px Arial, Helvetica, sans-serif;
background: none;
filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale, src='<?php echo $slpwURL; ?>loginbackground.png'); /* IE 6 only */
}
</style>
<![endif]-->

<title>Login</title>
</head>
<body>
<br>
<br>
<br>
<br>
<?php if ($msg!="") { ?>
<p class="message"><?php echo $msg; ?></p>
<?php } ?>
<form id="siteloklogin" name="siteloklogin" action="<?php echo $startpage; ?>" method="post" <?php if ($LoginType=="SECURE") echo " autocomplete=\"off\""; ?>  onSubmit="return validatelogin()" >
<?php siteloklogin(); ?>
<div class="loginbox">
<h1 class="loginbox">Login</h1>
<label class="loginbox" for="username">Username</label>
<input class="loginbox" type="text" name="username" id="username" value="<?php echo $slcookieusername; ?>" maxlength="50">
	
<label class="loginbox" for="password">Password</label>
<input class="loginbox" type="password" name="password" id="password" value="<?php echo $slcookiepassword; ?>" maxlength="50">

<?php if ($TuringLogin==1) { ?>
<label class="loginbox" for="turing">CAPTCHA</label>
<input class="loginboxcaptcha" type="text" name="turing" id="turing" value="" maxlength="5">
<img class="loginboxcaptcha" src="<?php echo $slpwURL; ?>turingimage.php" alt="CAPTCHA" >
<?php } ?>

<div class="extraoptions">
<?php if ($CookieLogin==1) { ?>
<input class="loginboxcb" type="checkbox" name="remember" id="remember" value="1" <?php if ($slcookielogin=="1") echo "checked"; ?>>
<label class="loginboxcb" for="remember">Remember Me</label>
<?php } ?>

<?php if ($CookieLogin==2) { ?>
<input class="loginboxcb" type="checkbox" name="remember" id="remember" value="2">
<label class="loginboxcb" for="remember">Auto Login</label>
<?php } ?>

<a class="loginbox" href="javascript: void forgotpw()" title="Forgot your password? Enter username or email &amp; click link">Forgot Password</a>
</div>
<div class="loginbutton">
<input type="image" id="submit" name="submit" src="<?php echo $slpwURL; ?>loginbutton.jpg" >
</div>
</div>
</form>
<script type="text/javascript">
  var obj=document.getElementById("username")
  obj.focus()
</script>
</body>
</html>
<?php  
}
return($LoginKey);
}

function siteloklogin()
{
  global $LoginType,$LoginKey;
  global $TuringLogin;
	print "<script type=\"text/javascript\">\n";
	print "<!-- JavaScript\n";
	print "function validatelogin(form)\n";
	print "{\n";
	print "  if (document.siteloklogin.username.value==\"\")\n";
	print "  {\n";
	print "    alert(\"".MSG_ENTERUSER."\")\n";
	print "    document.siteloklogin.username.focus()\n";
	print "    return(false)\n";
	print "  }\n";
	print "  if (document.siteloklogin.password.value==\"\")\n";
	print "  {\n";
	print "    alert(\"".MSG_ENTERPASS."\")\n";
	print "    document.siteloklogin.password.focus()\n";
	print "    return(false)\n";
	print "  }\n";
  if ($TuringLogin==1)
  {
  	print "  if ((document.siteloklogin.turing!==undefined) && (document.siteloklogin.turing.value==\"\"))\n";
  	print "  {\n";
  	print "    alert(\"".MSG_ENTERTURING."\")\n";
  	print "    document.siteloklogin.turing.focus()\n";
  	print "    return(false)\n";
  	print "  }\n"; 
  }	
  print "  var LoginType=\"$LoginType\";\n";
  print "  if (LoginType==\"NORMAL\")\n";
  print "    return(true);\n";
	print "  document.siteloklogin.sitelokhash.value=MD5(document.siteloklogin.password.value+document.siteloklogin.loginkey.value)\n";
	print "  document.siteloklogin.password.value=\"********\"\n";
  print "  return(true)\n";
	print "}\n";
	print "function forgotpw(form)\n";
	print "{\n";
	
	print "  if (document.siteloklogin.username.value==\"\")\n";
	print "  {\n";
  if ($TuringLogin==1)
  	print "    alert(\"".MSG_FORGOT1."\")\n";
  else
  	print "    alert(\"".MSG_FORGOT2."\")\n";  	
	print "    document.siteloklogin.username.focus()\n";
	print "    return(false)\n";
	print "  }\n";
  if ($TuringLogin==1)
  {
  	print "  if (document.siteloklogin.turing.value==\"\")\n";
  	print "  {\n";
  	print "    alert(\"".MSG_ENTERTURING."\")\n";
  	print "    document.siteloklogin.turing.focus()\n";
  	print "    return(false)\n";
  	print "  }\n";     
  }	
	print "  document.siteloklogin.forgotpassword.value=\"forgotten-it\"\n";
  print "  document.siteloklogin.submit()\n";
  print "  return(true)\n";
	print "}\n";
  if ($LoginType=="SECURE")
  {
	  print "\n";
	  print "// MD5 Javascript functions provided by Henri Torgemane.\n";
	  print "// Copyright (c) 1996 Henri Torgemane. All Rights Reserved.\n";
	  print "\n";
	  print "function array(n) {\n";
	  print "  for(i=0;i<n;i++) this[i]=0;\n";
	  print "  this.length=n;\n";
	  print "}\n";
	  print "\n";
	  print "function integer(n) { return n%(0xffffffff+1); }\n";
	  print "\n";
	  print "function shr(a,b) {\n";
	  print "  a=integer(a);\n";
	  print "  b=integer(b);\n";
	  print "  if (a-0x80000000>=0) {\n";
	  print "    a=a%0x80000000;\n";
	  print "    a>>=b;\n";
	  print "    a+=0x40000000>>(b-1);\n";
	  print "  } else\n";
	  print "    a>>=b;\n";
	  print "  return a;\n";
	  print "}\n";
	  print "\n";
	  print "function shl1(a) {\n";
	  print "  a=a%0x80000000;\n";
	  print "  if (a&0x40000000==0x40000000)\n";
	  print "  {\n";
	  print "    a-=0x40000000;\n";
	  print "    a*=2;\n";
	  print "    a+=0x80000000;\n";
	  print "  } else\n";
	  print "    a*=2;\n";
	  print "  return a;\n";
	  print "}\n";
	  print "\n";
	  print "function shl(a,b) {\n";
	  print "  a=integer(a);\n";
	  print "  b=integer(b);\n";
	  print "  for (var i=0;i<b;i++) a=shl1(a);\n";
	  print "  return a;\n";
	  print "}\n";
	  print "\n";
	  print "function and(a,b) {\n";
	  print "  a=integer(a);\n";
	  print "  b=integer(b);\n";
	  print "  var t1=(a-0x80000000);\n";
	  print "  var t2=(b-0x80000000);\n";
	  print "  if (t1>=0)\n";
	  print "    if (t2>=0)\n";
	  print "      return ((t1&t2)+0x80000000);\n";
	  print "    else\n";
	  print "      return (t1&b);\n";
	  print "  else\n";
	  print "    if (t2>=0)\n";
	  print "      return (a&t2);\n";
	  print "    else\n";
	  print "      return (a&b);\n";
	  print "}\n";
	  print "\n";
	  print "function or(a,b) {\n";
	  print "  a=integer(a);\n";
	  print "  b=integer(b);\n";
	  print "  var t1=(a-0x80000000);\n";
	  print "  var t2=(b-0x80000000);\n";
	  print "  if (t1>=0)\n";
	  print "    if (t2>=0)\n";
	  print "      return ((t1|t2)+0x80000000);\n";
	  print "    else\n";
	  print "      return ((t1|b)+0x80000000);\n";
	  print "  else\n";
	  print "    if (t2>=0)\n";
	  print "      return ((a|t2)+0x80000000);\n";
	  print "    else\n";
	  print "      return (a|b);\n";
	  print "}\n";
	  print "\n";
	  print "function xor(a,b) {\n";
	  print "  a=integer(a);\n";
	  print "  b=integer(b);\n";
	  print "  var t1=(a-0x80000000);\n";
	  print "  var t2=(b-0x80000000);\n";
	  print "  if (t1>=0)\n";
	  print "    if (t2>=0)\n";
	  print "      return (t1^t2);\n";
	  print "    else\n";
	  print "      return ((t1^b)+0x80000000);\n";
	  print "  else\n";
	  print "    if (t2>=0)\n";
	  print "      return ((a^t2)+0x80000000);\n";
	  print "    else\n";
	  print "      return (a^b);\n";
	  print "}\n";
	  print "\n";
	  print "function not(a) {\n";
	  print "  a=integer(a);\n";
	  print "  return (0xffffffff-a);\n";
	  print "}\n";
	  print "\n";
	  print "    var state = new array(4);\n";
	  print "    var count = new array(2);\n";
	  print "       count[0] = 0;\n";
	  print "       count[1] = 0;\n";
	  print "    var buffer = new array(64);\n";
	  print "    var transformBuffer = new array(16);\n";
	  print "    var digestBits = new array(16);\n";
	  print "\n";
	  print "    var S11 = 7;\n";
	  print "    var S12 = 12;\n";
	  print "    var S13 = 17;\n";
	  print "    var S14 = 22;\n";
	  print "    var S21 = 5;\n";
	  print "    var S22 = 9;\n";
	  print "    var S23 = 14;\n";
	  print "    var S24 = 20;\n";
	  print "    var S31 = 4;\n";
	  print "    var S32 = 11;\n";
	  print "    var S33 = 16;\n";
	  print "    var S34 = 23;\n";
	  print "    var S41 = 6;\n";
	  print "    var S42 = 10;\n";
	  print "    var S43 = 15;\n";
	  print "    var S44 = 21;\n";
	  print "\n";
	  print "    function F(x,y,z) {\n";
	  print "       return or(and(x,y),and(not(x),z));\n";
	  print "    }\n";
	  print "\n";
	  print "    function G(x,y,z) {\n";
	  print "       return or(and(x,z),and(y,not(z)));\n";
	  print "    }\n";
	  print "\n";
	  print "    function H(x,y,z) {\n";
	  print "       return xor(xor(x,y),z);\n";
	  print "    }\n";
	  print "\n";
	  print "    function I(x,y,z) {\n";
	  print "       return xor(y ,or(x , not(z)));\n";
	  print "    }\n";
	  print "\n";
	  print "    function rotateLeft(a,n) {\n";
	  print "       return or(shl(a, n),(shr(a,(32 - n))));\n";
	  print "    }\n";
	  print "\n";
	  print "    function FF(a,b,c,d,x,s,ac) {\n";
	  print "        a = a+F(b, c, d) + x + ac;\n";
	  print "       a = rotateLeft(a, s);\n";
	  print "       a = a+b;\n";
	  print "       return a;\n";
	  print "    }\n";
	  print "\n";
	  print "    function GG(a,b,c,d,x,s,ac) {\n";
	  print "       a = a+G(b, c, d) +x + ac;\n";
	  print "       a = rotateLeft(a, s);\n";
	  print "       a = a+b;\n";
	  print "       return a;\n";
	  print "    }\n";
	  print "\n";
	  print "    function HH(a,b,c,d,x,s,ac) {\n";
	  print "       a = a+H(b, c, d) + x + ac;\n";
	  print "       a = rotateLeft(a, s);\n";
	  print "       a = a+b;\n";
	  print "       return a;\n";
	  print "    }\n";
	  print "\n";
	  print "    function II(a,b,c,d,x,s,ac) {\n";
	  print "       a = a+I(b, c, d) + x + ac;\n";
	  print "       a = rotateLeft(a, s);\n";
	  print "       a = a+b;\n";
	  print "       return a;\n";
	  print "    }\n";
	  print "\n";
	  print "    function transform(buf,offset) {\n";
	  print "       var a=0, b=0, c=0, d=0;\n";
	  print "       var x = transformBuffer;\n";
	  print "\n";
	  print "       a = state[0];\n";
	  print "       b = state[1];\n";
	  print "       c = state[2];\n";
	  print "       d = state[3];\n";
	  print "\n";
	  print "       for (i = 0; i < 16; i++) {\n";
	  print "           x[i] = and(buf[i*4+offset],0xff);\n";
	  print "           for (j = 1; j < 4; j++) {\n";
	  print "               x[i]+=shl(and(buf[i*4+j+offset] ,0xff), j * 8);\n";
	  print "           }\n";
	  print "       }\n";
	  print "\n";
	  print "       /* Round 1 */\n";
	  print "       a = FF ( a, b, c, d, x[ 0], S11, 0xd76aa478); /* 1 */\n";
	  print "       d = FF ( d, a, b, c, x[ 1], S12, 0xe8c7b756); /* 2 */\n";
	  print "       c = FF ( c, d, a, b, x[ 2], S13, 0x242070db); /* 3 */\n";
	  print "       b = FF ( b, c, d, a, x[ 3], S14, 0xc1bdceee); /* 4 */\n";
	  print "       a = FF ( a, b, c, d, x[ 4], S11, 0xf57c0faf); /* 5 */\n";
	  print "       d = FF ( d, a, b, c, x[ 5], S12, 0x4787c62a); /* 6 */\n";
	  print "       c = FF ( c, d, a, b, x[ 6], S13, 0xa8304613); /* 7 */\n";
	  print "       b = FF ( b, c, d, a, x[ 7], S14, 0xfd469501); /* 8 */\n";
	  print "       a = FF ( a, b, c, d, x[ 8], S11, 0x698098d8); /* 9 */\n";
	  print "       d = FF ( d, a, b, c, x[ 9], S12, 0x8b44f7af); /* 10 */\n";
	  print "       c = FF ( c, d, a, b, x[10], S13, 0xffff5bb1); /* 11 */\n";
	  print "       b = FF ( b, c, d, a, x[11], S14, 0x895cd7be); /* 12 */\n";
	  print "       a = FF ( a, b, c, d, x[12], S11, 0x6b901122); /* 13 */\n";
	  print "       d = FF ( d, a, b, c, x[13], S12, 0xfd987193); /* 14 */\n";
	  print "       c = FF ( c, d, a, b, x[14], S13, 0xa679438e); /* 15 */\n";
	  print "       b = FF ( b, c, d, a, x[15], S14, 0x49b40821); /* 16 */\n";
	  print "\n";
	  print "       /* Round 2 */\n";
	  print "       a = GG ( a, b, c, d, x[ 1], S21, 0xf61e2562); /* 17 */\n";
	  print "       d = GG ( d, a, b, c, x[ 6], S22, 0xc040b340); /* 18 */\n";
	  print "       c = GG ( c, d, a, b, x[11], S23, 0x265e5a51); /* 19 */\n";
	  print "       b = GG ( b, c, d, a, x[ 0], S24, 0xe9b6c7aa); /* 20 */\n";
	  print "       a = GG ( a, b, c, d, x[ 5], S21, 0xd62f105d); /* 21 */\n";
	  print "       d = GG ( d, a, b, c, x[10], S22,  0x2441453); /* 22 */\n";
	  print "       c = GG ( c, d, a, b, x[15], S23, 0xd8a1e681); /* 23 */\n";
	  print "       b = GG ( b, c, d, a, x[ 4], S24, 0xe7d3fbc8); /* 24 */\n";
	  print "       a = GG ( a, b, c, d, x[ 9], S21, 0x21e1cde6); /* 25 */\n";
	  print "       d = GG ( d, a, b, c, x[14], S22, 0xc33707d6); /* 26 */\n";
	  print "       c = GG ( c, d, a, b, x[ 3], S23, 0xf4d50d87); /* 27 */\n";
	  print "       b = GG ( b, c, d, a, x[ 8], S24, 0x455a14ed); /* 28 */\n";
	  print "       a = GG ( a, b, c, d, x[13], S21, 0xa9e3e905); /* 29 */\n";
	  print "       d = GG ( d, a, b, c, x[ 2], S22, 0xfcefa3f8); /* 30 */\n";
	  print "       c = GG ( c, d, a, b, x[ 7], S23, 0x676f02d9); /* 31 */\n";
	  print "       b = GG ( b, c, d, a, x[12], S24, 0x8d2a4c8a); /* 32 */\n";
	  print "\n";
	  print "       /* Round 3 */\n";
	  print "       a = HH ( a, b, c, d, x[ 5], S31, 0xfffa3942); /* 33 */\n";
	  print "       d = HH ( d, a, b, c, x[ 8], S32, 0x8771f681); /* 34 */\n";
	  print "       c = HH ( c, d, a, b, x[11], S33, 0x6d9d6122); /* 35 */\n";
	  print "       b = HH ( b, c, d, a, x[14], S34, 0xfde5380c); /* 36 */\n";
	  print "       a = HH ( a, b, c, d, x[ 1], S31, 0xa4beea44); /* 37 */\n";
	  print "       d = HH ( d, a, b, c, x[ 4], S32, 0x4bdecfa9); /* 38 */\n";
	  print "       c = HH ( c, d, a, b, x[ 7], S33, 0xf6bb4b60); /* 39 */\n";
	  print "       b = HH ( b, c, d, a, x[10], S34, 0xbebfbc70); /* 40 */\n";
	  print "       a = HH ( a, b, c, d, x[13], S31, 0x289b7ec6); /* 41 */\n";
	  print "       d = HH ( d, a, b, c, x[ 0], S32, 0xeaa127fa); /* 42 */\n";
	  print "       c = HH ( c, d, a, b, x[ 3], S33, 0xd4ef3085); /* 43 */\n";
	  print "       b = HH ( b, c, d, a, x[ 6], S34,  0x4881d05); /* 44 */\n";
	  print "       a = HH ( a, b, c, d, x[ 9], S31, 0xd9d4d039); /* 45 */\n";
	  print "       d = HH ( d, a, b, c, x[12], S32, 0xe6db99e5); /* 46 */\n";
	  print "       c = HH ( c, d, a, b, x[15], S33, 0x1fa27cf8); /* 47 */\n";
	  print "       b = HH ( b, c, d, a, x[ 2], S34, 0xc4ac5665); /* 48 */\n";
	  print "\n";
	  print "       /* Round 4 */\n";
	  print "       a = II ( a, b, c, d, x[ 0], S41, 0xf4292244); /* 49 */\n";
	  print "       d = II ( d, a, b, c, x[ 7], S42, 0x432aff97); /* 50 */\n";
	  print "       c = II ( c, d, a, b, x[14], S43, 0xab9423a7); /* 51 */\n";
	  print "       b = II ( b, c, d, a, x[ 5], S44, 0xfc93a039); /* 52 */\n";
	  print "       a = II ( a, b, c, d, x[12], S41, 0x655b59c3); /* 53 */\n";
	  print "       d = II ( d, a, b, c, x[ 3], S42, 0x8f0ccc92); /* 54 */\n";
	  print "       c = II ( c, d, a, b, x[10], S43, 0xffeff47d); /* 55 */\n";
	  print "       b = II ( b, c, d, a, x[ 1], S44, 0x85845dd1); /* 56 */\n";
	  print "       a = II ( a, b, c, d, x[ 8], S41, 0x6fa87e4f); /* 57 */\n";
	  print "       d = II ( d, a, b, c, x[15], S42, 0xfe2ce6e0); /* 58 */\n";
	  print "       c = II ( c, d, a, b, x[ 6], S43, 0xa3014314); /* 59 */\n";
	  print "       b = II ( b, c, d, a, x[13], S44, 0x4e0811a1); /* 60 */\n";
	  print "       a = II ( a, b, c, d, x[ 4], S41, 0xf7537e82); /* 61 */\n";
	  print "       d = II ( d, a, b, c, x[11], S42, 0xbd3af235); /* 62 */\n";
	  print "       c = II ( c, d, a, b, x[ 2], S43, 0x2ad7d2bb); /* 63 */\n";
	  print "       b = II ( b, c, d, a, x[ 9], S44, 0xeb86d391); /* 64 */\n";
	  print "\n";
	  print "       state[0] +=a;\n";
	  print "       state[1] +=b;\n";
	  print "       state[2] +=c;\n";
	  print "       state[3] +=d;\n";
	  print "\n";
	  print "    }\n";
	  print "\n";
	  print "    function init() {\n";
	  print "       count[0]=count[1] = 0;\n";
	  print "       state[0] = 0x67452301;\n";
	  print "       state[1] = 0xefcdab89;\n";
	  print "       state[2] = 0x98badcfe;\n";
	  print "       state[3] = 0x10325476;\n";
	  print "       for (i = 0; i < digestBits.length; i++)\n";
	  print "           digestBits[i] = 0;\n";
	  print "    }\n";
	  print "\n";
	  print "    function update(b) {\n";
	  print "       var index,i;\n";
	  print "\n";
	  print "       index = and(shr(count[0],3) , 0x3f);\n";
	  print "       if (count[0]<0xffffffff-7)\n";
	  print "         count[0] += 8;\n";
	  print "        else {\n";
	  print "         count[1]++;\n";
	  print "         count[0]-=0xffffffff+1;\n";
	  print "          count[0]+=8;\n";
	  print "        }\n";
	  print "       buffer[index] = and(b,0xff);\n";
	  print "       if (index  >= 63) {\n";
	  print "           transform(buffer, 0);\n";
	  print "       }\n";
	  print "    }\n";
	  print "\n";
	  print "    function finish() {\n";
	  print "       var bits = new array(8);\n";
	  print "       var     padding;\n";
	  print "       var     i=0, index=0, padLen=0;\n";
	  print "\n";
	  print "       for (i = 0; i < 4; i++) {\n";
	  print "           bits[i] = and(shr(count[0],(i * 8)), 0xff);\n";
	  print "       }\n";
	  print "        for (i = 0; i < 4; i++) {\n";
	  print "           bits[i+4]=and(shr(count[1],(i * 8)), 0xff);\n";
	  print "       }\n";
	  print "       index = and(shr(count[0], 3) ,0x3f);\n";
	  print "       padLen = (index < 56) ? (56 - index) : (120 - index);\n";
	  print "       padding = new array(64);\n";
	  print "       padding[0] = 0x80;\n";
	  print "        for (i=0;i<padLen;i++)\n";
	  print "         update(padding[i]);\n";
	  print "        for (i=0;i<8;i++)\n";
	  print "         update(bits[i]);\n";
	  print "\n";
	  print "       for (i = 0; i < 4; i++) {\n";
	  print "           for (j = 0; j < 4; j++) {\n";
	  print "               digestBits[i*4+j] = and(shr(state[i], (j * 8)) , 0xff);\n";
	  print "           }\n";
	  print "       }\n";
	  print "    }\n";
	  print "\n";
	  print "/* End of the MD5 algorithm */\n";
	  print "\n";
	  print "function hexa(n) {\n";
	  print " var hexa_h = \"0123456789abcdef\";\n";
	  print " var hexa_c=\"\";\n";
	  print " var hexa_m=n;\n";
	  print " for (hexa_i=0;hexa_i<8;hexa_i++) {\n";
	  print "   hexa_c=hexa_h.charAt(Math.abs(hexa_m)%16)+hexa_c;\n";
	  print "   hexa_m=Math.floor(hexa_m/16);\n";
	  print " }\n";
	  print " return hexa_c;\n";
	  print "}\n";
	  print "\n";
	  print "\n";
	  print "var ascii=\"01234567890123456789012345678901\" +\n";
	  print "          \" !\\\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ\"+\n";
	  print "          \"[\\\\]^_`abcdefghijklmnopqrstuvwxyz{|}~\";\n";
	  print "\n";
	  print "function MD5(entree)\n";
	  print "{\n";
	  print " var l,s,k,ka,kb,kc,kd;\n";
	  print "\n";
	  print " init();\n";
	  print " for (k=0;k<entree.length;k++) {\n";
	  print "   l=entree.charAt(k);\n";
	  print "   update(ascii.lastIndexOf(l));\n";
	  print " }\n";
	  print " finish();\n";
	  print " ka=kb=kc=kd=0;\n";
	  print " for (i=0;i<4;i++) ka+=shl(digestBits[15-i], (i*8));\n";
	  print " for (i=4;i<8;i++) kb+=shl(digestBits[15-i], ((i-4)*8));\n";
	  print " for (i=8;i<12;i++) kc+=shl(digestBits[15-i], ((i-8)*8));\n";
	  print " for (i=12;i<16;i++) kd+=shl(digestBits[15-i], ((i-12)*8));\n";
	  print " s=hexa(kd)+hexa(kc)+hexa(kb)+hexa(ka);\n";
	  print " return s;\n";
	  print "}\n";
  }
	print "\n";
	print "\n";
	print "// - JavaScript - -->\n";
	print "</script>\n";
  print "<input type=\"hidden\" name=\"loginformused\" value=\"1\">\n";
  print "<input type=\"hidden\" name=\"forgotpassword\" value=\"\">\n";
  if ($LoginType=="SECURE")
  {
		print "<input type=\"hidden\" name=\"loginkey\" value=\"$LoginKey\">\n";
		print "<input type=\"hidden\" name=\"sitelokhash\" value=\"\">\n";
  }
}
function siteloklogout($page="")
{
  global $thispage;
  $link=$thispage."?sitelokaction=logout";
  if ($page!="")
    $link=$thispage."?sitelokaction=logout&page=".$page;  
  print($link);
}

function siteloklinklogin($fname,$dialog,$expiry=0,$param1="",$param2="")
{
  global $thispage,$SiteKey,$NoFilename,$slDownloadURL,$ExtraPathFilename,$slusername;
  global $SitelokLocationURL,$startpage,$slpublicaccess,$groupswithaccess;
  // remove of location part
  $filename=strtok($fname,":");
  // If user considered not public (logged in and member of any listed groups) handle as siteloklink()
  if (!$slpublicaccess)
  {
    print sl_siteloklink($fname,1,$expiry,$param1,$param2);
    return;
  }  
  // public user then call slfilelogin.php
  // If $dialog parameter is numeric then handle by returning user to current page after login
  if ((is_numeric($dialog)) || ($dialog==""))
  {
    $returnpage=$startpage."#".$filename;
    $auth=md5("filelogin".$SiteKey.$returnpage.trim($groupswithaccess));
    $link=$returnpage.",".$groupswithaccess.",".$auth;
    $link=base64_encode($link);
    $link=rawurlencode($link);
    $lurl=$SitelokLocationURL."slfilelogin.php";
    $link=$lurl."?slfilelogin=".$link;  
    print $link; 
  }
  else
  {
    // If not use a download landing page passed in $dialog
    $returnpage=$startpage."#".$filename;
    $timenow=time();
    $auth=md5("filelogin".$SiteKey.$fname.$expirytime.$dialog.$param1.$param2.$timenow.$returnpage.$groupswithaccess);
    $link=$fname.",".$expirytime.",".$param1.",".$param2.",".$dialog.",".$timenow.",".$returnpage.",".$groupswithaccess.",".$auth;
    $link=base64_encode($link);
    $link=rawurlencode($link);
    $lurl=$SitelokLocationURL."slfilelogin.php";
    $link=$lurl."?slfilelogin=".$link;  
    print $link; 
  }
}

function siteloklink($fname,$dialog,$expiry=0,$param1="",$param2="")
{
  print sl_siteloklink($fname,$dialog,$expiry,$param1,$param2);
}

function sl_siteloklink($fname,$dialog,$expiry=0,$param1="",$param2="")
{
  global $thispage,$SiteKey,$NoFilename,$slDownloadURL,$ExtraPathFilename,$slusername;
  $timenow=time();
  if ($expiry != 0)
  {
    if (strlen($expiry) == 12)
      $expirytime = mktime(substr($expiry, 8, 2), substr($expiry, 10, 2), 0, substr($expiry, 4, 2), substr($expiry, 6, 2), substr($expiry, 0, 4), -1);
    else
      $expirytime = $timenow + ($expiry * 60);
  }
  else
    $expirytime = 0;
  $auth=md5($SiteKey.$fname.$expirytime.$slusername.$param1.$param2.$timenow);
  $link=$fname.",".$expirytime.",".$slusername.",".$param1.",".$param2.",".$dialog.",".$timenow.",".$auth;
  $link=base64_encode($link);
  $link=rawurlencode($link);
  if ($slDownloadURL!="")
  {
    $lurlparts=getUrlParts($slDownloadURL);
    $lurl="/".$lurlparts[resource];
  }  
  // Get filename only
  $fnameonly=strtok($fname,":");
  $fnameonly=basename($fnameonly);
  // Remove any query from fname
  $pos=strpos($fnameonly,"?");
  if (is_integer($pos))
    $fnameonly=substr($fnameonly,0,$pos);
  if($ExtraPathFilename==1)
    $link=$lurl."/".$fnameonly."?sldownload=".$link;
  else
    $link=$lurl."?sldownload=".$link;  
  if ($NoFilename!=1)  
    $link .= "/".$fnameonly;
  return $link; 
}
function sitelokgetfile($download)
{
  global $FileLocation,$FileLocations,$SiteKey,$slusername,$LogDetails;
  global $ServerTimeAdjust;
  global $slnumplugins,$slpluginid,$slplugin_event_onDownload,$slplugin_event_onDownloadTransfer;
  global $sldownloadbuffer,$LogEmbedded;
  global $BackupLocation,$MessagePage;
  // Remove any /filename from end
  $pos=strrpos($download,"/");
  if (is_integer($pos))
  	$download=substr($download,0,$pos);
  $download=rawurldecode($download);	
  $download=base64_decode($download);
  $fields=explode(",",$download);
  // Check for older 7 field links
  if (count($fields)==7)
  {
    $fname=$fields[0];
    $expirytime=$fields[1];
    $username=$fields[2];
    $param1=$fields[3];
    $param2=$fields[4];
    $dialog=$fields[5];
    $hash=$fields[6];
    $verifyhash=md5($SiteKey.$fname.$expirytime.$username.$param1.$param2);
  }
  else
  {
    $fname=$fields[0];
    $expirytime=$fields[1];
    $username=$fields[2];
    $param1=$fields[3];
    $param2=$fields[4];
    $dialog=$fields[5];
    $timenow=$fields[6];
    $hash=$fields[7];
    $verifyhash=md5($SiteKey.$fname.$expirytime.$username.$param1.$param2.$timenow);
  }
  if ($verifyhash!=$hash)
  {
    sl_ShowMessage($MessagePage,MSG_ACCESSFILE);
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$slusername,"Not allowed access to ".$fname);
    exit;
  }
  if ($username!=$slusername)
  {
    sl_ShowMessage($MessagePage,MSG_ACCESSFILE);
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$slusername,"Not allowed access to ".$fname);
    exit;
  }
  // Check link hasn't expired
  if ($expirytime!=0)
  {
    $curtime=time();
    if ($curtime>$expirytime)
    {
      sl_ShowMessage($MessagePage,MSG_DOWNEXP);
      if (substr($LogDetails,4,1)=="Y")
  		  sl_AddToLog("Download Problem",$slusername,"Download link expired for ".$fname);
      exit;
    }
  }
  $logdownload=true;
  if (($dialog=="0") && (!$LogEmbedded))
    $logdownload=false;   
	$fnametolog=$fname;    
	// Make full path or url to file
  $fname=strtok($fname,":");
  $loc=strtok(":");	
  if ($loc=="")
    $link=$FileLocation.$fname;
  else
  {
    if ($loc=="slbackups")
      $link=$BackupLocation.$fname; 
    else
      $link=$FileLocations[$loc].$fname;
  }  
  // Replace any ; with | to handle S3 locations
  $link=str_replace(";","|",$link);  
  // If download path is for S3 then handle it now
  if (substr(trim(strtolower($link)),0,3)=="s3|")
  {
    // Event point
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onDownload[$p]))
        call_user_func($slplugin_event_onDownload[$p],$slpluginid[$p],$slusername,$link,$loc,$param1,$param2);
    }
    // Call user event handler 
    if (function_exists("sl_onDownload"))
      sl_onDownload($slusername,$link,$loc,$param1,$param2);  
    $url=sl_get_s3_url($link,time()+$ServerTimeAdjust,"GET",$dialog);
    if ((substr($LogDetails,3,1)=="Y") && ($logdownload))
      sl_AddToLog("Download",$slusername,$fnametolog);      
    // Close session to allow parallel downloads
    session_write_close();
    header("Location: ".$url);
    exit;
  }   
  $ext=sl_fileextension($link);
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
    // Close session to allow parallel downloads
    session_write_close();
    exit;
  }
  
  
  // If download link is xml page then just include it.
  if ($ext==".xml")
  {
    $fh=@fopen($link,"rb");
    header("Content-type: application/rss+xml; charset=utf-8");
    header("Connection: close");    
    // Close session to allow parallel downloads
    session_write_close();
    sl_xfpassthru($fh);
    exit;
  }
 
  // Get mime type
  $mimetype=sl_getmimetype($link);
  // Event point
  // Allow event handler or plugin to handle the actual download (not S3 or .html or .php though)
  // The download transfer handler should log the download, session_write_close(); call ondownload event and exit if handled.
  // Call plugin event
  $paramdata['username']=$slusername;
  $paramdata['link']=$link;
  $paramdata['loc']=$loc;
  $paramdata['param1']=$param1;
  $paramdata['param2']=$param2;
  $paramdata['dialog']=$dialog;
  $paramdata['expirytime']=$expirytime;
  $paramdata['timenow']=$timenow;
  $paramdata['mime']=$mimetype;
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onDownloadTransfer[$p]))
      call_user_func($slplugin_event_onDownloadTransfer[$p],$slpluginid[$p],$paramdata);
  }
  // Call user event handler 
  if (function_exists("sl_onDownloadTransfer"))
    sl_onDownloadTransfer($paramdata);  
  // If we get here then event handlers didn't perform the transfer
  // Check file exists
  if (!($fh = @fopen($link, "rb")))
  {
    if (substr($LogDetails,4,1)=="Y")
		  sl_AddToLog("Download Problem",$slusername,"Could not open ".$fname);
    sl_ShowMessage($MessagePage,MSG_FILEOPEN);
    exit;
  }
  fclose($fh);
  // See if link is local path or URL
  $i=strrpos($link,"/");
  $fname=substr($link,$i+1,strlen($link)-$i);
  if (($dialog!="0") || ($mimetype==""))
    header("Content-disposition: attachment; filename=\"".basename($link)."\"\n");
  if ($mimetype!="")
    header("Content-type: ".$mimetype."\n");      
  else 
    header("Content-type: application/octet-stream\n");          
  header("Content-transfer-encoding: binary\n");  
  $pos=strpos(strtolower($link),"http://");
  if (!is_integer($pos))
  {
    // If link is a local path then get local path and handle resume & download managers
    $fsize=@filesize($link);
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
          for ($p=0;$p<$slnumplugins;$p++)
          {
            if (function_exists($slplugin_event_onDownload[$p]))
              call_user_func($slplugin_event_onDownload[$p],$slpluginid[$p],$slusername,$link,$loc,$param1,$param2);
          }
          // Call user event handler      
          if (function_exists("sl_onDownload"))
          {
            sl_onDownload($slusername,$link,$loc,$param1,$param2);
          }
          if ((substr($LogDetails,3,1)=="Y") && ($logdownload))
	          sl_AddToLog("Download",$slusername,$fnametolog);                
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
      $size=@filesize($link);
      // Event point
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onDownload[$p]))
          call_user_func($slplugin_event_onDownload[$p],$slpluginid[$p],$slusername,$link,$loc,$param1,$param2);
      }
      // Call user event handler
      if (function_exists("sl_onDownload"))
        sl_onDownload($slusername,$link,$loc,$param1,$param2);
      if (!($fh=@fopen($link,"rb")))
      {
        if (substr($LogDetails,4,1)=="Y")
  		    sl_AddToLog("Download Problem",$slusername,"Could not open ".$fname);
        sl_ShowMessage($MessagePage,MSG_FILEOPEN);
        exit;
      }
      if ((substr($LogDetails,3,1)=="Y")  && ($logdownload))
	      sl_AddToLog("Download",$slusername,$fnametolog);    
    	header("Accept-Ranges: bytes");
      if ((strtolower(ini_get('zlib.output_compression'))!="on") && (ini_get('zlib.output_compression')!="1")) 
        header("Content-Length: ".$size."\n");      
      // Close session to allow parallel downloads
      session_write_close();
      sl_xfpassthru($fh);
    }
  }
  else
  {
    // link is a URL rather than local path so do simple download
		$link=str_replace(" ","%20",$link);
		$size=sl_filesize_remote($link);
		// Event point
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (function_exists($slplugin_event_onDownload[$p]))
        call_user_func($slplugin_event_onDownload[$p],$slpluginid[$p],$slusername,$link,$loc,$param1,$param2);
    }
    // Call user event handler		
    if (function_exists("sl_onDownload"))
      sl_onDownload($slusername,$link,$loc,$param1,$param2);
    if (!($fh=@fopen($link,"rb")))
    {
      if (substr($LogDetails,4,1)=="Y")
	  	  sl_AddToLog("Download Problem",$slusername,"Could not open ".$fname);
      sl_ShowMessage($MessagePage,MSG_FILEOPEN);
      exit;
    }
    if ((substr($LogDetails,3,1)=="Y") && ($logdownload))
      sl_AddToLog("Download",$slusername,$fnametolog);      
    if ((strtolower(ini_get('zlib.output_compression'))!="on") && (ini_get('zlib.output_compression')!="1"))
    {
      if ((int)$size>0)
        header("Content-Length: ".$size."\n");
    }
    sl_xfpassthru($fh);
  }
}

function sitelokmodify($clientemail="",$adminemail="",$modsuccesspage="",$allowed="NYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY")
{
  global $SiteKey, $ValidPasswordChars;
	// To allow for backward compatibility $allowed could be parameter 6 instead of 7.
	if ($modsuccesspage!="")
	{
  	if (strspn($modsuccesspage, "YN") == strlen($modsuccesspage))
  	{
  	  $allowed=$modsuccesspage;
  	  $modsuccesspage="";
  	}
	}  
	if ($allowed=="")
	  $allowed="YNYYNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN";
	if (strlen($allowed)<54)
	{
	  for ($k=strlen($allowed);$k<54;$k++)
	  {
	    if (($k==0) || ($k==2) || ($k==3))
	      $allowed.="Y";
	    else
	      $allowed.="N";  
	  }
	}
	print "<script type=\"text/javascript\">\n";
	print "<!-- JavaScript\n";
	print "function validateprofile()\n";
	print "{\n";
	print "  if (document.sitelokmodify.newpassword)\n";
	print "  {\n";
	
	print "   if ((document.sitelokmodify.newpassword.value.length<5) && (document.sitelokmodify.newpassword.value!=\"\"))\n";
	print "   {\n";
	print "     alert(\"".MSG_PASS5."\")\n";
	print "     document.sitelokmodify.newpassword.focus()\n";
	print "     return(false)\n";
	print "   }\n";
	print "   prob=0\n";
	print "   str=document.sitelokmodify.newpassword.value;\n";
	print "   for (k=0;k<str.length;k++)\n";
	print "   {\n";
	print "     if (\"".$ValidPasswordChars."\".indexOf(str.charAt(k))==-1)\n";
	print "     {\n";
	print "       prob=1\n";
	print "     }\n";
	print "   }\n";
	print "   if (prob==1)\n";
	print "   {\n";
	print "      alert(\"".MSG_PASSNG."\");\n";
	print "      document.sitelokmodify.newpassword.focus();\n";
	print "      return(false)\n";
	print "   }\n";

	print "   if (document.sitelokmodify.newpassword)\n";
	print "   {\n";
	
	print "   if (document.sitelokmodify.newpassword.value!=document.sitelokmodify.verifynewpassword.value)\n";
	print "    {\n";
	print "      alert(\"".MSG_PASSVER."\")\n";
	print "      document.sitelokmodify.verifynewpassword.focus()\n";
	print "      return(false)\n";
	print "    }\n";

  print "   }\n";	
  print "  }\n";
	
	print "   if (document.sitelokmodify.newname)\n";
	print "   {\n";
	
	print "   if (document.sitelokmodify.newname.value==\"\")\n";
	print "   {\n";
	print "     alert(\"".MSG_ENTERNAME."\")\n";
	print "     document.sitelokmodify.newname.focus()\n";
	print "     return(false)\n";
	print "   }\n";
	
  print "   }\n";	
	
	print "   if (document.sitelokmodify.newemail)\n";
	print "   {\n";
	
	print "   if (ValidEmail(document.sitelokmodify.newemail.value)==false)\n";
	print "   {\n";
	print "     alert(\"".MSG_ENTEREMAIL."\")\n";
	print "     document.sitelokmodify.newemail.focus()\n";
	print "     return(false)\n";
	print "   }\n";
	
  print "   }\n";	
	
	
	print "  return(true)\n";
	print "}\n";
	print "function ValidEmail (emailStr)\n";
	print "{\n";
	print "var emailPat=/^(.+)@(.+)$/\n";
	print "var specialChars=\"\\\\(\\\\)<>@,;:\\\\\\\\\\\\\\\"\\\\.\\\\[\\\\]\"\n";
	print "var validChars=\"\\[^\\\\s\" + specialChars + \"\\]\"\n";
	print "var quotedUser=\"(\\\"[^\\\"]*\\\")\"\n";
	print "var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/\n";
	print "var atom=validChars + '+'\n";
	print "var word=\"(\" + atom + \"|\" + quotedUser + \")\"\n";
	print "var userPat=new RegExp(\"^\" + word + \"(\\\\.\" + word + \")*$\")\n";
	print "var domainPat=new RegExp(\"^\" + atom + \"(\\\\.\" + atom +\")*$\")\n";
	print "var matchArray=emailStr.match(emailPat)\n";
	print "if (matchArray==null)\n";
	print " return false\n";
	print "var user=matchArray[1]\n";
	print "var domain=matchArray[2]\n";
	print "if (user.match(userPat)==null)\n";
	print "    return false\n";
	print "var IPArray=domain.match(ipDomainPat)\n";
	print "if (IPArray!=null) {\n";
	print "  for (var i=1;i<=4;i++)\n";
	print "  {\n";
	print "    if (IPArray[i]>255)\n";
	print "      return false\n";
	print "  }\n";
	print "  return true\n";
	print "}\n";
	print "var domainArray=domain.match(domainPat)\n";
	print "if (domainArray==null)\n";
	print "    return false\n";
	print "var atomPat=new RegExp(atom,\"g\")\n";
	print "var domArr=domain.match(atomPat)\n";
	print "var len=domArr.length\n";
	print "if (domArr[domArr.length-1].length<2 ||\n";
	print "    domArr[domArr.length-1].length>4)\n";
	print "   return false\n";
	print "if (len<2)\n";
	print "   return false\n";
	print "return true;\n";
	print "}\n";
	print "// - JavaScript - -->\n";
	print "</script>\n";
  print "<input type=\"hidden\" name=\"sitelokaction\" value=\"modifyprofile\">\n";
  print "<input type=\"hidden\" name=\"clientemail\" value=\"$clientemail\">\n";
  print "<input type=\"hidden\" name=\"adminemail\" value=\"$adminemail\">\n";
  print "<input type=\"hidden\" name=\"allowed\" value=\"$allowed\">\n";
  print "<input type=\"hidden\" name=\"modsuccesspage\" value=\"$modsuccesspage\">\n";
  $hash=md5($clientemail.$adminemail.$allowed.$SiteKey);  
  print "<input type=\"hidden\" name=\"hash\" value=\"$hash\">\n";
}
?>