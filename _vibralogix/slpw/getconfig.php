<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sitelok (Password Version)                                                                         	 //
// Copyright 2003-2013 Vibralogix                                                                        //
// You are licensed to use this on one domain only. Please contact us for extra licenses                 //
// www.vibralogix.com													    	                                                     //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
@error_reporting (E_ERROR);
// Start or reopen a session
// If downloading file then the session_cache_limiter is required because of a bug in IE when using SSL
if ((isset($_REQUEST['sldownload'])) || ((isset($_REQUEST['act'])) && ($_REQUEST['act']=="exportselected")) || ((isset($_REQUEST['logmanageact'])) && ($_REQUEST['logmanageact']=="export")))
	session_cache_limiter('public');

//if ((isset($_REQUEST['act'])) && ($_REQUEST['act']=="exportselected"))
//	session_cache_limiter('public');

require_once("slconfig.php");
if (!isset($sl_cookiesecure))
  $sl_cookiesecure=false;
if ($sl_cookiesecure)
  @ini_set("session.cookie_secure", "1");    
if (!isset($sl_cookiehttponly))
  $sl_cookiehttponly=false;
if (false===ini_get("session.cookie_httponly"))
  $sl_cookiehttponly=false;
if ($sl_cookiehttponly)
  @ini_set("session.cookie_httponly", "1");    
if (!isset($sl_nocaptchawithhash))
  $sl_nocaptchawithhash=true;
if (!isset($sl_sessiondomain))
 $sl_sessiondomain="";
if ($sl_sessiondomain!="")
  @ini_set("session.cookie_domain", $sl_sessiondomain);
if (!isset($SessionName))
  $SessionName="";
if ($SessionName!="")
  session_name($SessionName);
if (!isset($sl_dbblocksize))
  $sl_dbblocksize=1000;
if (!isset($sl_cookiehttponly))
  $sl_cookiehttponly=false;
if (!isset($sldownloadbuffer))
  $sldownloadbuffer=500000;
      
session_start();
// If table names not overridden in slconfig.php use defaults

if(get_magic_quotes_runtime())
  set_magic_quotes_runtime(0);
if (!isset($DbTableName))
  $DbTableName="sitelok";
if (!isset($DbConfigTableName))
  $DbConfigTableName="slconfig";
if (!isset($DbLogTableName))
  $DbLogTableName="log";
if (!isset($DbGroupTableName))
  $DbGroupTableName="usergroups";
if (!isset($DbOrdersTableName))
  $DbOrdersTableName="sl_ordercontrol";
if (!isset($DbPluginsTableName))
  $DbPluginsTableName="sl_plugins";
  
if (!isset($_SESSION['ses_ConfigReload']))
  $_SESSION['ses_ConfigReload']="";
if (!isset($dbupdate))
  $dbupdate=false;
if (!isset($DBupdate))
  $DBupdate=false;

// If no csrf token stored in session then create one
if (!isset($_SESSION['ses_slcsrf']))
  $_SESSION['ses_slcsrf']=md5(uniqid(rand(), true));
$slcsrftoken=$_SESSION['ses_slcsrf'];
  
// See if config data already available in which case don't access mysql at this point
if (($_SESSION['ses_SitelokLocation']=="") || ($_SESSION['ses_ConfigReload']=="reload") || ($dbupdate==true) || ($DBupdate==true))
{
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
  	print "There was a database problem";
   	exit;
  }  
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbConfigTableName." LIMIT 1");
  if ($mysql_result!=false)
  {
  	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
    if ($row!=false)
    {
      $_SESSION['ses_SitelokVersion']=$row["version"];      
      $_SESSION['ses_SiteName']=$row["sitename"];
      $_SESSION['ses_SiteEmail']=$row["siteemail"];
      $_SESSION['ses_SiteEmail2']=$row["siteemail2"];
      $_SESSION['ses_DateFormat']=$row["dateformat"];
      $_SESSION['ses_LogoutPage']=$row["logoutpage"];
      $_SESSION['ses_SitelokLocation']=$row["siteloklocation"];
      $_SESSION['ses_SitelokLocationURL']=$row["siteloklocationurl"];
      $_SESSION['ses_EmailLocation']=$row["emaillocation"];
      $_SESSION['ses_EmailURL']=$row["emailurl"];
      $_SESSION['ses_FileLocation']=$row["filelocation"];
      $_SESSION['ses_TuringLogin']=$row["turinglogin"];
      $_SESSION['ses_TuringRegister']=$row["turingregister"];
      $_SESSION['ses_RandomPasswordMask']=$row["randompasswordmask"];
      $_SESSION['ses_SiteKey']=$row["sitekey"];
      $_SESSION['ses_MD5passwords']=$row["md5passwords"];
      $_SESSION['ses_ConcurrentLogin']=$row["concurrentlogin"];
      $_SESSION['ses_LogViewOffset']=$row["logviewoffset"];
      $_SESSION['ses_LogViewOrder']=$row["logvieworder"];
      $_SESSION['ses_LogViewDetails']=$row["logviewdetails"];
      $_SESSION['ses_LoginType']=$row["logintype"];
      $_SESSION['ses_CookieLogin']=$row["cookielogin"];
      $_SESSION['ses_MaxSessionTime']=$row["maxsessiontime"];
      $_SESSION['ses_MaxInactivityTime']=$row["maxinactivitytime"];
      $_SESSION['ses_LoginPage']=$row["logintemplate"];
      $_SESSION['ses_ErrorPage']=$row["errortemplate"];
      $_SESSION['ses_MessagePage']=$row["messagetemplate"];
      $_SESSION['ses_ExpiredPage']=$row["expiredpage"];      
      $_SESSION['ses_WrongGroupPage']=$row["wronggrouppage"];      
      $_SESSION['ses_ForgottenEmail']=$row["forgottenemail"];
      $_SESSION['ses_NewUserEmail']=$row["newuseremail"];
      $_SESSION['ses_SitelokLog']=$row["siteloklog"];
      $_SESSION['ses_LogDetails']=$row["logdetails"];
      $_SESSION['ses_ShowRows']=$row["showrows"];
      $_SESSION['ses_ActionItems']=$row["actionitems"];
     
      $_SESSION['ses_CustomTitle1']=$row["customtitle1"];
      $_SESSION['ses_CustomTitle2']=$row["customtitle2"];
      $_SESSION['ses_CustomTitle3']=$row["customtitle3"];
      $_SESSION['ses_CustomTitle4']=$row["customtitle4"];
      $_SESSION['ses_CustomTitle5']=$row["customtitle5"];
      $_SESSION['ses_CustomTitle6']=$row["customtitle6"];
      $_SESSION['ses_CustomTitle7']=$row["customtitle7"];
      $_SESSION['ses_CustomTitle8']=$row["customtitle8"];
      $_SESSION['ses_CustomTitle9']=$row["customtitle9"];
      $_SESSION['ses_CustomTitle10']=$row["customtitle10"];
      $_SESSION['ses_CustomTitle11']=$row["customtitle11"];
      $_SESSION['ses_CustomTitle12']=$row["customtitle12"];
      $_SESSION['ses_CustomTitle13']=$row["customtitle13"];
      $_SESSION['ses_CustomTitle14']=$row["customtitle14"];
      $_SESSION['ses_CustomTitle15']=$row["customtitle15"];
      $_SESSION['ses_CustomTitle16']=$row["customtitle16"];
      $_SESSION['ses_CustomTitle17']=$row["customtitle17"];
      $_SESSION['ses_CustomTitle18']=$row["customtitle18"];
      $_SESSION['ses_CustomTitle19']=$row["customtitle19"];
      $_SESSION['ses_CustomTitle20']=$row["customtitle20"];
      $_SESSION['ses_CustomTitle21']=$row["customtitle21"];
      $_SESSION['ses_CustomTitle22']=$row["customtitle22"];
      $_SESSION['ses_CustomTitle23']=$row["customtitle23"];
      $_SESSION['ses_CustomTitle24']=$row["customtitle24"];
      $_SESSION['ses_CustomTitle25']=$row["customtitle25"];
      $_SESSION['ses_CustomTitle26']=$row["customtitle26"];
      $_SESSION['ses_CustomTitle27']=$row["customtitle27"];
      $_SESSION['ses_CustomTitle28']=$row["customtitle28"];
      $_SESSION['ses_CustomTitle29']=$row["customtitle29"];
      $_SESSION['ses_CustomTitle30']=$row["customtitle30"];
      $_SESSION['ses_CustomTitle31']=$row["customtitle31"];
      $_SESSION['ses_CustomTitle32']=$row["customtitle32"];
      $_SESSION['ses_CustomTitle33']=$row["customtitle33"];
      $_SESSION['ses_CustomTitle34']=$row["customtitle34"];
      $_SESSION['ses_CustomTitle35']=$row["customtitle35"];
      $_SESSION['ses_CustomTitle36']=$row["customtitle36"];
      $_SESSION['ses_CustomTitle37']=$row["customtitle37"];
      $_SESSION['ses_CustomTitle38']=$row["customtitle38"];
      $_SESSION['ses_CustomTitle39']=$row["customtitle39"];
      $_SESSION['ses_CustomTitle40']=$row["customtitle40"];
      $_SESSION['ses_CustomTitle41']=$row["customtitle41"];
      $_SESSION['ses_CustomTitle42']=$row["customtitle42"];
      $_SESSION['ses_CustomTitle43']=$row["customtitle43"];
      $_SESSION['ses_CustomTitle44']=$row["customtitle44"];
      $_SESSION['ses_CustomTitle45']=$row["customtitle45"];
      $_SESSION['ses_CustomTitle46']=$row["customtitle46"];
      $_SESSION['ses_CustomTitle47']=$row["customtitle47"];
      $_SESSION['ses_CustomTitle48']=$row["customtitle48"];
      $_SESSION['ses_CustomTitle49']=$row["customtitle49"];
      $_SESSION['ses_CustomTitle50']=$row["customtitle50"];

      $_SESSION['ses_Custom1Validate']=$row["custom1validate"];
      $_SESSION['ses_Custom2Validate']=$row["custom2validate"];
      $_SESSION['ses_Custom3Validate']=$row["custom3validate"];
      $_SESSION['ses_Custom4Validate']=$row["custom4validate"];
      $_SESSION['ses_Custom5Validate']=$row["custom5validate"];
      $_SESSION['ses_Custom6Validate']=$row["custom6validate"];
      $_SESSION['ses_Custom7Validate']=$row["custom7validate"];
      $_SESSION['ses_Custom8Validate']=$row["custom8validate"];
      $_SESSION['ses_Custom9Validate']=$row["custom9validate"];
      $_SESSION['ses_Custom10Validate']=$row["custom10validate"];
      $_SESSION['ses_Custom11Validate']=$row["custom11validate"];
      $_SESSION['ses_Custom12Validate']=$row["custom12validate"];
      $_SESSION['ses_Custom13Validate']=$row["custom13validate"];
      $_SESSION['ses_Custom14Validate']=$row["custom14validate"];
      $_SESSION['ses_Custom15Validate']=$row["custom15validate"];
      $_SESSION['ses_Custom16Validate']=$row["custom16validate"];
      $_SESSION['ses_Custom17Validate']=$row["custom17validate"];
      $_SESSION['ses_Custom18Validate']=$row["custom18validate"];
      $_SESSION['ses_Custom19Validate']=$row["custom19validate"];
      $_SESSION['ses_Custom20Validate']=$row["custom20validate"];
      $_SESSION['ses_Custom21Validate']=$row["custom21validate"];
      $_SESSION['ses_Custom22Validate']=$row["custom22validate"];
      $_SESSION['ses_Custom23Validate']=$row["custom23validate"];
      $_SESSION['ses_Custom24Validate']=$row["custom24validate"];
      $_SESSION['ses_Custom25Validate']=$row["custom25validate"];
      $_SESSION['ses_Custom26Validate']=$row["custom26validate"];
      $_SESSION['ses_Custom27Validate']=$row["custom27validate"];
      $_SESSION['ses_Custom28Validate']=$row["custom28validate"];
      $_SESSION['ses_Custom29Validate']=$row["custom29validate"];
      $_SESSION['ses_Custom30Validate']=$row["custom30validate"];
      $_SESSION['ses_Custom31Validate']=$row["custom31validate"];
      $_SESSION['ses_Custom32Validate']=$row["custom32validate"];
      $_SESSION['ses_Custom33Validate']=$row["custom33validate"];
      $_SESSION['ses_Custom34Validate']=$row["custom34validate"];
      $_SESSION['ses_Custom35Validate']=$row["custom35validate"];
      $_SESSION['ses_Custom36Validate']=$row["custom36validate"];
      $_SESSION['ses_Custom37Validate']=$row["custom37validate"];
      $_SESSION['ses_Custom38Validate']=$row["custom38validate"];
      $_SESSION['ses_Custom39Validate']=$row["custom39validate"];
      $_SESSION['ses_Custom40Validate']=$row["custom40validate"];
      $_SESSION['ses_Custom41Validate']=$row["custom41validate"];
      $_SESSION['ses_Custom42Validate']=$row["custom42validate"];
      $_SESSION['ses_Custom43Validate']=$row["custom43validate"];
      $_SESSION['ses_Custom44Validate']=$row["custom44validate"];
      $_SESSION['ses_Custom45Validate']=$row["custom45validate"];
      $_SESSION['ses_Custom46Validate']=$row["custom46validate"];
      $_SESSION['ses_Custom47Validate']=$row["custom47validate"];
      $_SESSION['ses_Custom48Validate']=$row["custom48validate"];
      $_SESSION['ses_Custom49Validate']=$row["custom49validate"];
      $_SESSION['ses_Custom50Validate']=$row["custom50validate"];         
      $_SESSION['ses_EmailType']=$row["emailtype"];         
      $_SESSION['ses_EmailUsername']=$row["emailusername"];
      $_SESSION['ses_EmailPassword']=$row["emailpassword"];
      $_SESSION['ses_EmailServer']=$row["emailserver"];
      $_SESSION['ses_EmailPort']=$row["emailport"];
      $_SESSION['ses_EmailAuth']=$row["emailauth"];
      $_SESSION['ses_EmailServerSecurity']=$row["emailserversecurity"];
      $_SESSION['ses_EmailDelay']=$row["emaildelay"];
      $_SESSION['ses_ModifyUserEmail']=$row["modifyuseremail"];
      $_SESSION['ses_NoAccessPage']=$row["noaccesspage"];      
      $_SESSION['ses_DBupdate']=$row["dbupdate"];      
      $_SESSION['ses_AllowSearchEngine']=$row["allowsearchengine"];      
      $_SESSION['ses_SearchEngineGroup']=$row["searchenginegroup"];      
      $_SESSION['ses_ProfilePassRequired']=$row["profilepassrequired"];      
      $_SESSION['ses_EmailConfirmRequired']=$row["emailconfirmrequired"];      
      $_SESSION['ses_EmailConfirmTemplate']=$row["emailconfirmtemplate"];      
      $_SESSION['ses_EmailUnique']=$row["emailunique"];      
      $_SESSION['ses_LoginWithEmail']=$row["loginwithemail"];      
      $_SESSION['ses_ColumnOrder']=$row["columnorder"];      
      $_SESSION['ses_BackupLocation']=$row["backuplocation"];      
    }
  }
  else
  {
    print "Error accessing configuration data";
    exit;
  }
  $query="SELECT * FROM ".$DbGroupTableName." ORDER BY name ASC";
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
  {
    $_SESSION['ses_slgroupnames']="";
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
        if ($_SESSION['ses_slgroupnames']!="")
          $_SESSION['ses_slgroupnames'].=",";
        $_SESSION['ses_slgroupnames'].=$row['name']; 
        $_SESSION['ses_slgroupdesc_'.$row['name']]=$row['description']; 
        $_SESSION['ses_slgrouploginaction_'.$row['name']]=$row['loginaction'];
        $_SESSION['ses_slgrouploginvalue_'.$row['name']]=$row['loginvalue'];
    }
	}
  else
  {
    print "Error accessing usergroup data";
    exit;
  }
  // Now see if there are any plugins installed. sl_plugins table won't exist otherwise
  $_SESSION['ses_slnumplugins']=0;
  if (sl_tableexists($mysql_link,$DbPluginsTableName))
  {
    $query="SELECT * FROM ".$DbPluginsTableName;
    $mysql_result=mysqli_query($mysql_link,$query);
    if ($mysql_result!=false)
    {
      while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
      {
        if ($row['enabled']=="Yes")
        {
          $_SESSION['ses_slpluginid_'.$_SESSION['ses_slnumplugins']]=$row['id']; 
          $_SESSION['ses_slpluginfolder_'.$_SESSION['ses_slnumplugins']]=$row['folder']; 
          $_SESSION['ses_slnumplugins']++;
        }
      }
  	}
    else
    {
      print "Error accessing plugin data";
      exit;
    }
  }
}
$SitelokVersion=$_SESSION['ses_SitelokVersion'];
$DateFormat=$_SESSION['ses_DateFormat'];
$SiteName=$_SESSION['ses_SiteName'];
$SiteEmail=$_SESSION['ses_SiteEmail'];
$SiteEmail2=$_SESSION['ses_SiteEmail2'];
$LogoutPage=$_SESSION['ses_LogoutPage'];
$SitelokLocation=$_SESSION['ses_SitelokLocation'];
$SitelokLocationURL=$_SESSION['ses_SitelokLocationURL'];
$EmailLocation=$_SESSION['ses_EmailLocation'];
$EmailURL=$_SESSION['ses_EmailURL'];
$temp=explode("|",$_SESSION['ses_FileLocation']);
for ($k=0;$k<count($temp);$k++)
{
  $label=strtok($temp[$k],"=");
  $value=strtok("=");
  if ($label=="default")
    $FileLocation=$value;
  else
    $FileLocations[$label]=$value;  
}
if (!isset($EmailHeaderNoSlashR))
  $EmailHeaderNoSlashR=1;
if (!isset($LogEmbedded))
  $LogEmbedded=false;  
if ((!isset($ExtraMailParam)) && (strtolower(@ini_get("safe_mode")) != 'on') && (@ini_get("safe_mode") != '1'))
  $ExtraMailParam="-f ".$SiteEmail;
@ini_set(sendmail_from,$SiteEmail);
$TuringLogin=$_SESSION['ses_TuringLogin'];
$TuringRegister=$_SESSION['ses_TuringRegister'];
$RandomPasswordMask=$_SESSION['ses_RandomPasswordMask'];
$SiteKey=$_SESSION['ses_SiteKey'];
if ($_SESSION['ses_MD5passwords']==1)
  $MD5passwords=true;
else
  $MD5passwords=false;
if ($_SESSION['ses_ConcurrentLogin']==1)
  $ConcurrentLogin=true;
else
  $ConcurrentLogin=false;
$LogViewOffset=$_SESSION['ses_LogViewOffset'];    
$LogViewOrder=$_SESSION['ses_LogViewOrder'];    
$LogViewDetails=$_SESSION['ses_LogViewDetails'];    
$LoginType=$_SESSION['ses_LoginType'];    
$CookieLogin=$_SESSION['ses_CookieLogin'];
$MaxSessionTime=$_SESSION['ses_MaxSessionTime'];
if ($MaxSessionTime>0)
  ini_set('session.gc_maxlifetime',$MaxSessionTime);
$MaxInactivityTime=$_SESSION['ses_MaxInactivityTime'];
$LoginPage=$_SESSION['ses_LoginPage'];
$ErrorPage=$_SESSION['ses_ErrorPage'];
$MessagePage=$_SESSION['ses_MessagePage'];
$ExpiredPage=$_SESSION['ses_ExpiredPage'];
$WrongGroupPage=$_SESSION['ses_WrongGroupPage'];
$ForgottenEmail=$_SESSION['ses_ForgottenEmail'];
$NewUserEmail=$_SESSION['ses_NewUserEmail'];    
$SitelokLog=$_SESSION['ses_SitelokLog'];    
$LogDetails=$_SESSION['ses_LogDetails'];    
$ShowRows=$_SESSION['ses_ShowRows'];
$ActionItems=$_SESSION['ses_ActionItems'];
$CustomTitle1=$_SESSION['ses_CustomTitle1'];  
$CustomTitle2=$_SESSION['ses_CustomTitle2'];  
$CustomTitle3=$_SESSION['ses_CustomTitle3'];  
$CustomTitle4=$_SESSION['ses_CustomTitle4'];  
$CustomTitle5=$_SESSION['ses_CustomTitle5'];  
$CustomTitle6=$_SESSION['ses_CustomTitle6'];  
$CustomTitle7=$_SESSION['ses_CustomTitle7'];  
$CustomTitle8=$_SESSION['ses_CustomTitle8'];  
$CustomTitle9=$_SESSION['ses_CustomTitle9'];  
$CustomTitle10=$_SESSION['ses_CustomTitle10'];  
$CustomTitle11=$_SESSION['ses_CustomTitle11'];  
$CustomTitle12=$_SESSION['ses_CustomTitle12'];  
$CustomTitle13=$_SESSION['ses_CustomTitle13'];  
$CustomTitle14=$_SESSION['ses_CustomTitle14'];  
$CustomTitle15=$_SESSION['ses_CustomTitle15'];  
$CustomTitle16=$_SESSION['ses_CustomTitle16'];  
$CustomTitle17=$_SESSION['ses_CustomTitle17'];  
$CustomTitle18=$_SESSION['ses_CustomTitle18'];  
$CustomTitle19=$_SESSION['ses_CustomTitle19'];  
$CustomTitle20=$_SESSION['ses_CustomTitle20'];  
$CustomTitle21=$_SESSION['ses_CustomTitle21'];
$CustomTitle22=$_SESSION['ses_CustomTitle22'];
$CustomTitle23=$_SESSION['ses_CustomTitle23'];
$CustomTitle24=$_SESSION['ses_CustomTitle24'];
$CustomTitle25=$_SESSION['ses_CustomTitle25'];
$CustomTitle26=$_SESSION['ses_CustomTitle26'];
$CustomTitle27=$_SESSION['ses_CustomTitle27'];
$CustomTitle28=$_SESSION['ses_CustomTitle28'];
$CustomTitle29=$_SESSION['ses_CustomTitle29'];
$CustomTitle30=$_SESSION['ses_CustomTitle30'];
$CustomTitle31=$_SESSION['ses_CustomTitle31'];
$CustomTitle32=$_SESSION['ses_CustomTitle32'];
$CustomTitle33=$_SESSION['ses_CustomTitle33'];
$CustomTitle34=$_SESSION['ses_CustomTitle34'];
$CustomTitle35=$_SESSION['ses_CustomTitle35'];
$CustomTitle36=$_SESSION['ses_CustomTitle36'];
$CustomTitle37=$_SESSION['ses_CustomTitle37'];
$CustomTitle38=$_SESSION['ses_CustomTitle38'];
$CustomTitle39=$_SESSION['ses_CustomTitle39'];
$CustomTitle40=$_SESSION['ses_CustomTitle40'];
$CustomTitle41=$_SESSION['ses_CustomTitle41'];
$CustomTitle42=$_SESSION['ses_CustomTitle42'];
$CustomTitle43=$_SESSION['ses_CustomTitle43'];
$CustomTitle44=$_SESSION['ses_CustomTitle44'];
$CustomTitle45=$_SESSION['ses_CustomTitle45'];
$CustomTitle46=$_SESSION['ses_CustomTitle46'];
$CustomTitle47=$_SESSION['ses_CustomTitle47'];
$CustomTitle48=$_SESSION['ses_CustomTitle48'];
$CustomTitle49=$_SESSION['ses_CustomTitle49'];
$CustomTitle50=$_SESSION['ses_CustomTitle50'];

$Custom1Validate=$_SESSION['ses_Custom1Validate'];  
$Custom2Validate=$_SESSION['ses_Custom2Validate'];  
$Custom3Validate=$_SESSION['ses_Custom3Validate'];  
$Custom4Validate=$_SESSION['ses_Custom4Validate'];  
$Custom5Validate=$_SESSION['ses_Custom5Validate'];  
$Custom6Validate=$_SESSION['ses_Custom6Validate'];  
$Custom7Validate=$_SESSION['ses_Custom7Validate'];  
$Custom8Validate=$_SESSION['ses_Custom8Validate'];  
$Custom9Validate=$_SESSION['ses_Custom9Validate'];  
$Custom10Validate=$_SESSION['ses_Custom10Validate'];  
$Custom11Validate=$_SESSION['ses_Custom11Validate'];  
$Custom12Validate=$_SESSION['ses_Custom12Validate'];  
$Custom13Validate=$_SESSION['ses_Custom13Validate'];  
$Custom14Validate=$_SESSION['ses_Custom14Validate'];  
$Custom15Validate=$_SESSION['ses_Custom15Validate'];  
$Custom16Validate=$_SESSION['ses_Custom16Validate'];  
$Custom17Validate=$_SESSION['ses_Custom17Validate'];  
$Custom18Validate=$_SESSION['ses_Custom18Validate'];  
$Custom19Validate=$_SESSION['ses_Custom19Validate'];  
$Custom20Validate=$_SESSION['ses_Custom20Validate'];  
$Custom21Validate=$_SESSION['ses_Custom21Validate'];  
$Custom22Validate=$_SESSION['ses_Custom22Validate'];  
$Custom23Validate=$_SESSION['ses_Custom23Validate'];  
$Custom24Validate=$_SESSION['ses_Custom24Validate'];  
$Custom25Validate=$_SESSION['ses_Custom25Validate'];  
$Custom26Validate=$_SESSION['ses_Custom26Validate'];  
$Custom27Validate=$_SESSION['ses_Custom27Validate'];  
$Custom28Validate=$_SESSION['ses_Custom28Validate'];  
$Custom29Validate=$_SESSION['ses_Custom29Validate'];  
$Custom30Validate=$_SESSION['ses_Custom30Validate'];  
$Custom31Validate=$_SESSION['ses_Custom31Validate'];  
$Custom32Validate=$_SESSION['ses_Custom32Validate'];  
$Custom33Validate=$_SESSION['ses_Custom33Validate'];  
$Custom34Validate=$_SESSION['ses_Custom34Validate'];  
$Custom35Validate=$_SESSION['ses_Custom35Validate'];  
$Custom36Validate=$_SESSION['ses_Custom36Validate'];  
$Custom37Validate=$_SESSION['ses_Custom37Validate'];  
$Custom38Validate=$_SESSION['ses_Custom38Validate'];  
$Custom39Validate=$_SESSION['ses_Custom39Validate'];  
$Custom40Validate=$_SESSION['ses_Custom40Validate'];  
$Custom41Validate=$_SESSION['ses_Custom41Validate'];  
$Custom42Validate=$_SESSION['ses_Custom42Validate'];  
$Custom43Validate=$_SESSION['ses_Custom43Validate'];  
$Custom44Validate=$_SESSION['ses_Custom44Validate'];  
$Custom45Validate=$_SESSION['ses_Custom45Validate'];  
$Custom46Validate=$_SESSION['ses_Custom46Validate'];  
$Custom47Validate=$_SESSION['ses_Custom47Validate'];  
$Custom48Validate=$_SESSION['ses_Custom48Validate'];  
$Custom49Validate=$_SESSION['ses_Custom49Validate'];  
$Custom50Validate=$_SESSION['ses_Custom50Validate'];  
$EmailType=$_SESSION['ses_EmailType'];  
$EmailUsername=$_SESSION['ses_EmailUsername'];  
$EmailPassword=$_SESSION['ses_EmailPassword'];  
$EmailServer=$_SESSION['ses_EmailServer'];
$EmailPort=$_SESSION['ses_EmailPort'];
$EmailDelay=$_SESSION['ses_EmailDelay'];
$EmailAuth=$_SESSION['ses_EmailAuth'];
$EmailServerSecurity=$_SESSION['ses_EmailServerSecurity'];
$ModifyUserEmail=$_SESSION['ses_ModifyUserEmail'];    
// Process if PHPmailer is being used
if ($EmailType==1)
  $UsePHPmailer=1;
$NoAccessPage=$_SESSION['ses_NoAccessPage'];
if ($_SESSION['ses_DBupdate']==1)
  $DBupdate=true;
else
  $DBupdate=false;  
if ($_SESSION['ses_AllowSearchEngine']==1)
  $AllowSearchEngine=true;
else
  $AllowSearch=false;
$slstarttime=$_SESSION['ses_slstarttime'];
$slaccesstime=$_SESSION['ses_slaccesstime'];
$SearchEngineGroup=$_SESSION['ses_SearchEngineGroup'];
$ProfilePassRequired=$_SESSION['ses_ProfilePassRequired'];
$EmailConfirmRequired=$_SESSION['ses_EmailConfirmRequired'];
$EmailConfirmTemplate=$_SESSION['ses_EmailConfirmTemplate'];
$EmailUnique=$_SESSION['ses_EmailUnique'];
$LoginWithEmail=$_SESSION['ses_LoginWithEmail'];
$ColumnOrder=$_SESSION['ses_ColumnOrder'];
$BackupLocation=$_SESSION['ses_BackupLocation'];
// Define group names and descriptions
$groupnamesarray=explode(",",$_SESSION['ses_slgroupnames']);
for ($k=0;$k<count($groupnamesarray);$k++)
{
  $GroupNames[$groupnamesarray[$k]]=$_SESSION['ses_slgroupdesc_'.$groupnamesarray[$k]];
}

// Get plugins details
$slnumplugins=$_SESSION['ses_slnumplugins'];
if ($slnumplugins>0)
{
  for($k=0;$k<$slnumplugins;$k++)
  {
    $slpluginid[$k]=$_SESSION['ses_slpluginid_'.$k];
    $slpluginfolder[$k]=$_SESSION['ses_slpluginfolder_'.$k];
    $slpluginindex=$k;
    $slplugintableid=$slpluginid[$k];
    include_once($SitelokLocation.$slpluginfolder[$k]."/config.php");
    // Call onload function if required
    if (function_exists($slplugin_onloadplugin[$slpluginindex]))
      call_user_func($slplugin_onloadplugin[$slpluginindex],$slplugintableid,$slpluginindex);
  } 
}
if (!isset($ValidUsernameChars))
  $ValidUsernameChars="@-_.0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
if (!isset($ValidPasswordChars))
  $ValidPasswordChars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
if (!isset($ValidCaptchaChars))
  $ValidCaptchaChars="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
if (!isset($ServerTimeAdjust))
  $ServerTimeAdjust=300;
if (!isset($sl_alloweduploads))
  $sl_alloweduploads=array(".jpg",".gif",".png");
$IPaddr=trim(strtok($_SERVER['REMOTE_ADDR'],","));
$DateFormat=strtoupper($DateFormat);
$LogDetails=strtoupper($LogDetails);
$LoginType=strtoupper($LoginType);
if (!isset($ConcurrentLogin))
  $ConcurrentLogin=true;
if (!isset($MetaCharSet))
  $MetaCharSet="utf-8";
// Backward compatible  
if ($MetaCharSet[0]=="<")
{
  $pos=strpos($MetaCharSet, "charset");
  $MetaCharSet=substr($MetaCharSet,$pos+8);
  $pos=strpos($MetaCharSet, "\"");
  $MetaCharSet=substr($MetaCharSet,0,$pos);
}
if (!isset($MysqlCharSet))
  $MysqlCharSet="utf8";

// If main sitelok table field names set in slconfig.php then use those settings
if (!isset($SelectedField))
{
  $SelectedField="Selected";
  $CreatedField="Created";
  $UsernameField="Username";
  $PasswordField="Passphrase";
  $EnabledField="Enabled";
  $NameField="Name";
  $EmailField="Email";
  $UsergroupsField="Usergroups";
  $IdField="id";
  $SessionField="Session";
  $Custom1Field="Custom1";
  $Custom2Field="Custom2";
  $Custom3Field="Custom3";
  $Custom4Field="Custom4";
  $Custom5Field="Custom5";
  $Custom6Field="Custom6";
  $Custom7Field="Custom7";
  $Custom8Field="Custom8";
  $Custom9Field="Custom9";
  $Custom10Field="Custom10";
  $Custom11Field="Custom11";
  $Custom12Field="Custom12";
  $Custom13Field="Custom13";
  $Custom14Field="Custom14";
  $Custom15Field="Custom15";
  $Custom16Field="Custom16";
  $Custom17Field="Custom17";
  $Custom18Field="Custom18";
  $Custom19Field="Custom19";
  $Custom20Field="Custom20";
  $Custom21Field="Custom21";
  $Custom22Field="Custom22";
  $Custom23Field="Custom23";
  $Custom24Field="Custom24";
  $Custom25Field="Custom25";
  $Custom26Field="Custom26";
  $Custom27Field="Custom27";
  $Custom28Field="Custom28";
  $Custom29Field="Custom29";
  $Custom30Field="Custom30";
  $Custom31Field="Custom31";
  $Custom32Field="Custom32";
  $Custom33Field="Custom33";
  $Custom34Field="Custom34";
  $Custom35Field="Custom35";
  $Custom36Field="Custom36";
  $Custom37Field="Custom37";
  $Custom38Field="Custom38";
  $Custom39Field="Custom39";
  $Custom40Field="Custom40";
  $Custom41Field="Custom41";
  $Custom42Field="Custom42";
  $Custom43Field="Custom43";
  $Custom44Field="Custom44";
  $Custom45Field="Custom45";
  $Custom46Field="Custom46";
  $Custom47Field="Custom47";
  $Custom48Field="Custom48";
  $Custom49Field="Custom49";
  $Custom50Field="Custom50";
}
if (!isset($_SESSION['ses_UserAutoLoggedIn']))
  $_SESSION['ses_UserAutoLoggedIn']="0";
if ($_SESSION['ses_UserAutoLoggedIn']==1) 
  $sluserautologgedin=true;
else
  $sluserautologgedin=false;
$_SESSION['ses_ConfigReload']="";
require_once("eventhandler.php");
if (!function_exists('get_headers')) {
function get_headers($url, $format=0) {
    $headers = array();
    $url = parse_url($url);
    $host = isset($url['host']) ? $url['host'] : '';
    $port = isset($url['port']) ? $url['port'] : 80;
    $path = (isset($url['path']) ? $url['path'] : '/') . (isset($url['query']) ? '?' . $url['query'] : '');
    $fp = fsockopen($host, $port, $errno, $errstr, 3);
    if ($fp)
    {
        $hdr = "GET $path HTTP/1.1\r\n";
        $hdr .= "Host: $host \r\n";
        $hdr .= "Connection: Close\r\n\r\n";
        fwrite($fp, $hdr);
        while (!feof($fp) && $line = trim(fgets($fp, 1024)))
        {
            if ($line == "\r\n") break;
            list($key, $val) = explode(': ', $line, 2);
            if ($format)
                if ($val) $headers[$key] = $val;
                else $headers[] = $key;
            else $headers[] = $line;
        }
        fclose($fp);
        return $headers;
    }
    return false;
}
}
function sl_DBconnect()
{
  global $DbHost,$DbUser,$DbPassword,$DbName,$sl_mysql_link,$MysqlCharSet;
  static $mysql_link=false;
  // Next line can be removed for servers with slow mysql connect times
  $mysql_link=false;
  if ($mysql_link==false)
  {
    $mysql_link=mysqli_connect($DbHost,$DbUser,$DbPassword);
    if ($mysql_link===false)
      return(false);
    mysqli_set_charset($mysql_link,$MysqlCharSet);
    $db=mysqli_select_db($mysql_link,$DbName);
    if ($db==false)
      return(false);
  } 
  $sl_mysql_link=$mysql_link;
  return($mysql_link);
}

function sl_ShowMessage($Page,$slmessage)
{
  if (0==sl_CustomMessage($Page,$slmessage))
  {
    print "<html>\n";
    print "<head>\n";
    print "<title>Sitelok</title>\n";
    print "</head>\n";
    print "<body>\n";
    print "$slmessage<br><br>\n";
    if (function_exists("siteloklogout"))
    {
      print "<a href=\"";
      siteloklogout();
      print "\">Logout</a><br>";
    }
    print "</body>\n";
    print "</html>\n";
  }
}
function sl_CustomMessage($Page,$slmessage)
{
  if ($Page=="")
    return(0);
  include $Page;
  return(1);
}
function sl_ReadEmailTemplate($template,&$subject,&$mailBody,&$htmlformat)
{
	global $SitelokLocation,$EmailLocation;
  if ($EmailLocation!="")
    $emailpath=$EmailLocation;
  else
    $emailpath=$SitelokLocation."email/";          	
  $fh=@fopen($emailpath.$template,"r");
  if (!($fh))
  {
    return(false);
  }
  else
  {
    $mailBody = fread($fh,100000);
    fclose($fh);
    $i=strrpos($template,".");
    $ext=substr($template,$i,strlen($template)-$i);
    $ext=strtolower($ext);
    // Get subject for email
    if ($ext==".txt")
    {
      $pos=strpos($mailBody,"\n");
      $subject=substr($mailBody,0,$pos);
      $mailBody=substr($mailBody,$pos+1,strlen($mailBody)-$pos-1);
      $htmlformat="";
    }
    else
    {
      $subject=$SiteName;
      $pos=strpos($mailBody,"<TITLE>");
      if (!is_integer($pos))
        $pos=strpos($mailBody,"<title>");
      $pos2=strpos($mailBody,"</TITLE>");
      if (!is_integer($pos2))
        $pos2=strpos($mailBody,"</title>");
      if ((is_integer($pos)) &&  (is_integer($pos2)))
      {
        $subject=substr($mailBody,$pos+7,$pos2-$pos-7);
      }
      $htmlformat="Y";
		  // Standardise the eachgroup comments
		  $mailBody=preg_replace("/<!--.{0,4}eachgroupstart.{0,4}-->/i","<!--eachgroupstart-->",$mailBody);
		  $mailBody=preg_replace("/<!--.{0,4}eachgroupend.{0,4}-->/i","<!--eachgroupend-->",$mailBody);
		  // Firefox converts ! to %21, ( to %28, and ) to %29 so convert these back.
		  $mailBody=str_replace("%21","!",$mailBody);
		  $mailBody=str_replace("%28","(",$mailBody);
		  $mailBody=str_replace("%29",")",$mailBody);
    }
  }
  return(true);
}
function sl_getitemvars($buf,$n)
{
  $start = 0;
  $itemids = "";
  do
  {
    $pos = strpos($buf, "!!!" . $n . "(", $start);
    $found = 0;
    if (is_integer($pos))
    {
      $found = 1;
      $pos2 = strpos($buf, ")!!!", $pos);
      if (is_integer($pos2))
      {
        if ($itemids != "")
          $itemids .= "|";
        $itemids .= substr($buf, $pos + strlen($n) + 4, $pos2 - ($pos + strlen($n) + 4));
      }
      $start = $pos2;
    }
  }
  while ($found == 1);
  return($itemids);
}
function sl_quote_smart($value)
{    
  global $sl_mysql_link;
  if (get_magic_quotes_gpc())
    $value = stripslashes($value);
  if (function_exists('mysqli_real_escape_string'))
    $value = "'" . mysqli_real_escape_string($sl_mysql_link,$value) . "'";
  else  
    $value="'".addslashes($value)."'";      
  return $value;
}
function sl_tableexists($mysql_link, $tablename)
{
  // See if table exists
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$tablename);
  if ($mysql_result==false)
    return(false);
  return(true);  
}
function sl_xgetallheaders()
{
 $headers = array();
  while (list($key, $value) = each ($_SERVER))
  {
    if (strncmp($key, "HTTP_", 5) == 0)
    {
      $key = strtr(ucwords(strtolower(strtr(substr($key, 5), "_", " "))), " ", "-");
      $headers[$key] = $value;
    }
  }
  return $headers;
}
function sl_xfpassthru($file)
{
 global $sldownloadbuffer;
 if ($sldownloadbuffer>0)
 {
   @set_time_limit(86400); 
   while(!feof($file))
   {
      print(fread($file, $sldownloadbuffer));
      ob_flush();
      flush();
      if ($sldownloadbuffer>10000)
        sleep(1);
   }
   fclose($file);
 }
 else
   @fpassthru($file);
}
function sl_GetSecureLink($filename, $expiry, $username)
{
  global $NoFilename, $SiteKey, $SitelokLocationURL, $ExtraPathFilename;
  if ($SitelokLocationURL!="")
    $LinklokURL=$SitelokLocationURL."linkloksl.php";
  else  
    $LinklokURL="http://".$_SERVER['HTTP_HOST']."/slpw/linkloksl.php";  
  if ($link != "NA")
  {
    $dfile = basename($filename);
    $verifyhash = md5($SiteKey . $filename . $expiry . $username);
    $auth = $filename . "," . $expiry . "," . $username . "," . $verifyhash;
    $auth = base64_encode($auth);
    $auth = rawurlencode($auth);
     // Get filename only
    $fnameonly=strtok($filename,":");
    $fnameonly=basename($fnameonly);
    // Remove any query from fname
    $pos=strpos($fnameonly,"?");
    if (is_integer($pos))
      $fnameonly=substr($fnameonly,0,$pos);
    if($ExtraPathFilename==1)
      $plink=$LinklokURL."/".$fnameonly."?auth=".$auth;
    else
      $plink=$LinklokURL."?auth=".$auth;  
    if ($NoFilename!=1)  
      $plink .= "/".$fnameonly;
  }
  else
    $plink = "";
  return ($plink);
}
function sl_filesize_remote($url, $timeout=2)
{
  if (function_exists('curl_init'))
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects
    $data = curl_exec($ch);
    curl_close($ch);
    if ($data === false) {
      return(false);
    }   
    $contentLength = 'unknown';
    $status = 'unknown';
    if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
      $status = (int)$matches[1];
    }
    if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
      $contentLength = (int)$matches[1];
    }
    if ($contentLength=="unknown")
      return(false);
    return($contentLength);
  }
  else
  {
  	$url = parse_url($url);
  	if ($fp = @fsockopen($url['host'], ($url['port'] ? $url['port'] : 80), $errno, $errstr, $timeout))
  	{
  	  fwrite($fp, 'HEAD '.$url['path'].$url['query']." HTTP/1.0\r\nHost: ".$url['host']."\r\n\r\n");
  	  @stream_set_timeout($fp, $timeout);
  	  while (!feof($fp))
  	  {
  	    $size = fgets($fp, 4096);
  	    if (stristr($size, 'Content-Length') !== false)
  	    {
  	      $size = trim(substr($size, 16));
  	      break;
  	    }
  	  }
  	  fclose ($fp);
  	}
  	return is_numeric($size) ? intval($size) : false;
	}
}
function sl_FriendlyFileSize($sz)
{
  if ($sz==0)
    return("Unknown size");	
  if ($sz <= 1023)
    return($sz . " Bytes");
  if (($sz >= 1024) && ($sz <= 1048575))
  {
    $sz = intval($sz / 1024);
    return($sz . " KB");
  }
  if ($sz >= 1048576)
  {
    $sz = $sz / 1048576;
    $sz = intval($sz * 100) / 100;
    return($sz . " MB");
  }
}
function sl_fileextension($fname)
{
  if ($fname == "")
    return("");
  // Remove any query from fname
  $pos=strpos($fname,"?");
  if (is_integer($pos))
    $fname=substr($fname,0,$pos);    
  $pos = strrpos($fname, ".");
  if (is_integer($pos))
    return(strtolower(substr($fname, $pos)));
  return("");
}
function sl_PrepareEmail(&$mailBody,&$subject,$HTMLEmail,$userid,$user,$pass,$name,$email,$groups,$custom1="",$custom2="",$custom3="",$custom4="",$custom5="",$custom6="",$custom7="",$custom8="",$custom9="",$custom10="",
$custom11="",$custom12="",$custom13="",$custom14="",$custom15="",$custom16="",$custom17="",$custom18="",$custom19="",$custom20="",
$custom21="",$custom22="",$custom23="",$custom24="",$custom25="",$custom26="",$custom27="",$custom28="",$custom29="",$custom30="",
$custom31="",$custom32="",$custom33="",$custom34="",$custom35="",$custom36="",$custom37="",$custom38="",$custom39="",$custom40="",
$custom41="",$custom42="",$custom43="",$custom44="",$custom45="",$custom46="",$custom47="",$custom48="",$custom49="",$custom50="")
{
	global $SiteName,$SiteEmail,$GroupNames,$DateFormat,$LogDetails,$FileLocation,$FileLocations,$SiteKey,$SitelokLocationURL,$RandomPasswordMask;
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField,$PasswordField;
	global $SiteEmail2,$slnumplugins,$slplugin_event_onPrepareEmail2;
  if ($SitelokLocationURL!="")
    $slpwURL=$SitelokLocationURL;
  else  
    $slpwURL="http://".$_SERVER['HTTP_HOST']."/slpw/";

	$umg=explode("^",$groups);
	for ($k=0;$k<count($umg);$k++)
	{
   	$usrgrp=strtok($umg[$k],":");
    $grpexp=trim(strtok(":"));
    $slgroupname[]=$usrgrp;
    if ($GroupNames[$usrgrp]!="")
      $slgroupdesc[]=$GroupNames[$usrgrp];
    else
      $slgroupdesc[]=$usrgrp." members area";  
    if ($grpexp!="")
    {
      if ($DateFormat=="DDMMYY")
      {
        $day=substr($grpexp,0,2);
        $month=substr($grpexp,2,2);
        $year=substr($grpexp,4,2);
	      $slgroupexpiry[]=$day."/".$month."/".$year;
      }
      if ($DateFormat=="MMDDYY")
      {
        $month=substr($grpexp,0,2);
        $day=substr($grpexp,2,2);
        $year=substr($grpexp,4,2);
	      $slgroupexpiry[]=$month."/".$day."/".$year;
      }
    }
    else
    {
				$slgroupexpiry[]="Unlimited";
    }
	}
  // First standardise the eachgroup comments
  $mailBody=preg_replace("/<!--.{0,4}eachgroupstart.{0,4}-->/is","<!--eachgroupstart-->",$mailBody);
  $mailBody=preg_replace("/<!--.{0,4}eachgroupend.{0,4}-->/is","<!--eachgroupend-->",$mailBody);
  // Firefox converts ! to %21, ( to %28, ) to %29, & to &amp; so convert these back.
  $mailBody=str_replace("%21","!",$mailBody);
  $mailBody=str_replace("%28","(",$mailBody);
  $mailBody=str_replace("%29",")",$mailBody);
  $mailBody=str_replace("&amp;","&",$mailBody);
  $subject=str_replace("%21","!",$subject);
  $subject=str_replace("%28","(",$subject);
  $subject=str_replace("%29",")",$subject);
  $subject=str_replace("&amp;","&",$subject);
  // Safari problem
  $mailBody=str_replace(chr(0xC2).chr(0xA0)," ",$mailBody);       
  $subject=str_replace(chr(0xC2).chr(0xA0)," ",$subject);       
  $subject=str_replace("!!!username!!!",$user,$subject);
  $subject=str_replace("!!!password!!!",$pass,$subject);
  $subject=str_replace("!!!passwordclue!!!",sl_passwordclue($pass),$subject);  
  $subject=str_replace("!!!passwordhash!!!",md5(md5($pass.$SiteKey).$SiteKey),$subject);
  $subject=str_replace("!!!name!!!",$name,$subject);
  $namesarray=explode(" ",trim($name));
  $subject=str_replace("!!!firstname!!!",$namesarray[0],$subject);
  $subject=str_replace("!!!lastname!!!",$namesarray[count($namesarray)-1],$subject);  
  $subject=str_replace("!!!email!!!",$email,$subject);
  $subject=str_replace("!!!sitename!!!",$SiteName,$subject);
  $subject=str_replace("!!!siteemail!!!",$SiteEmail,$subject);
  $subject=str_replace("!!!siteemail2!!!",$SiteEmail2,$subject);  
  $subject=str_replace("!!!groups!!!",$groups,$subject);
  $subject=str_replace("!!!custom1!!!",$custom1,$subject);
  $subject=str_replace("!!!custom2!!!",$custom2,$subject);
  $subject=str_replace("!!!custom3!!!",$custom3,$subject);
  $subject=str_replace("!!!custom4!!!",$custom4,$subject);
  $subject=str_replace("!!!custom5!!!",$custom5,$subject);
  $subject=str_replace("!!!custom6!!!",$custom6,$subject);
  $subject=str_replace("!!!custom7!!!",$custom7,$subject);
  $subject=str_replace("!!!custom8!!!",$custom8,$subject);
  $subject=str_replace("!!!custom9!!!",$custom9,$subject);
  $subject=str_replace("!!!custom10!!!",$custom10,$subject);
  $subject=str_replace("!!!custom11!!!",$custom11,$subject);
  $subject=str_replace("!!!custom12!!!",$custom12,$subject);
  $subject=str_replace("!!!custom13!!!",$custom13,$subject);
  $subject=str_replace("!!!custom14!!!",$custom14,$subject);
  $subject=str_replace("!!!custom15!!!",$custom15,$subject);
  $subject=str_replace("!!!custom16!!!",$custom16,$subject);
  $subject=str_replace("!!!custom17!!!",$custom17,$subject);
  $subject=str_replace("!!!custom18!!!",$custom18,$subject);
  $subject=str_replace("!!!custom19!!!",$custom19,$subject);
  $subject=str_replace("!!!custom20!!!",$custom20,$subject);
  $subject=str_replace("!!!custom21!!!",$custom21,$subject);
  $subject=str_replace("!!!custom22!!!",$custom22,$subject);
  $subject=str_replace("!!!custom23!!!",$custom23,$subject);
  $subject=str_replace("!!!custom24!!!",$custom24,$subject);
  $subject=str_replace("!!!custom25!!!",$custom25,$subject);
  $subject=str_replace("!!!custom26!!!",$custom26,$subject);
  $subject=str_replace("!!!custom27!!!",$custom27,$subject);
  $subject=str_replace("!!!custom28!!!",$custom28,$subject);
  $subject=str_replace("!!!custom29!!!",$custom29,$subject);
  $subject=str_replace("!!!custom30!!!",$custom30,$subject);
  $subject=str_replace("!!!custom31!!!",$custom31,$subject);
  $subject=str_replace("!!!custom32!!!",$custom32,$subject);
  $subject=str_replace("!!!custom33!!!",$custom33,$subject);
  $subject=str_replace("!!!custom34!!!",$custom34,$subject);
  $subject=str_replace("!!!custom35!!!",$custom35,$subject);
  $subject=str_replace("!!!custom36!!!",$custom36,$subject);
  $subject=str_replace("!!!custom37!!!",$custom37,$subject);
  $subject=str_replace("!!!custom38!!!",$custom38,$subject);
  $subject=str_replace("!!!custom39!!!",$custom39,$subject);
  $subject=str_replace("!!!custom40!!!",$custom40,$subject);
  $subject=str_replace("!!!custom41!!!",$custom41,$subject);
  $subject=str_replace("!!!custom42!!!",$custom42,$subject);
  $subject=str_replace("!!!custom43!!!",$custom43,$subject);
  $subject=str_replace("!!!custom44!!!",$custom44,$subject);
  $subject=str_replace("!!!custom45!!!",$custom45,$subject);
  $subject=str_replace("!!!custom46!!!",$custom46,$subject);
  $subject=str_replace("!!!custom47!!!",$custom47,$subject);
  $subject=str_replace("!!!custom48!!!",$custom48,$subject);
  $subject=str_replace("!!!custom49!!!",$custom49,$subject);
  $subject=str_replace("!!!custom50!!!",$custom50,$subject);
  $mailBody=str_replace("!!!username!!!",$user,$mailBody);
  $mailBody=str_replace("!!!password!!!",$pass,$mailBody);
  $mailBody=str_replace("!!!passwordclue!!!",sl_passwordclue($pass),$mailBody);
  $mailBody=str_replace("!!!passwordhash!!!",md5(md5($pass.$SiteKey).$SiteKey),$mailBody);
  $mailBody=str_replace("!!!name!!!",$name,$mailBody);
  $mailBody=str_replace("!!!firstname!!!",$namesarray[0],$mailBody);
  $mailBody=str_replace("!!!lastname!!!",$namesarray[count($namesarray)-1],$mailBody);    
  $mailBody=str_replace("!!!email!!!",$email,$mailBody);
  $mailBody=str_replace("!!!ip!!!",trim(strtok($_SERVER['REMOTE_ADDR'],",")) ,$mailBody);
  $mailBody=str_replace("!!!useragent!!!",$_SERVER['HTTP_USER_AGENT'],$mailBody);
  $mailBody=str_replace("!!!sitename!!!",$SiteName,$mailBody);
  $mailBody=str_replace("!!!siteemail!!!",$SiteEmail,$mailBody);
  $mailBody=str_replace("!!!siteemail2!!!",$SiteEmail2,$mailBody);
  $mailBody=str_replace("!!!groups!!!",$groups,$mailBody);
  $mailBody=str_replace("!!!custom1!!!",sl_processcustomfield($custom1,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom2!!!",sl_processcustomfield($custom2,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom3!!!",sl_processcustomfield($custom3,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom4!!!",sl_processcustomfield($custom4,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom5!!!",sl_processcustomfield($custom5,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom6!!!",sl_processcustomfield($custom6,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom7!!!",sl_processcustomfield($custom7,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom8!!!",sl_processcustomfield($custom8,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom9!!!",sl_processcustomfield($custom9,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom10!!!",sl_processcustomfield($custom10,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom11!!!",sl_processcustomfield($custom11,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom12!!!",sl_processcustomfield($custom12,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom13!!!",sl_processcustomfield($custom13,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom14!!!",sl_processcustomfield($custom14,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom15!!!",sl_processcustomfield($custom15,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom16!!!",sl_processcustomfield($custom16,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom17!!!",sl_processcustomfield($custom17,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom18!!!",sl_processcustomfield($custom18,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom19!!!",sl_processcustomfield($custom19,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom20!!!",sl_processcustomfield($custom20,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom21!!!",sl_processcustomfield($custom21,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom22!!!",sl_processcustomfield($custom22,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom23!!!",sl_processcustomfield($custom23,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom24!!!",sl_processcustomfield($custom24,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom25!!!",sl_processcustomfield($custom25,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom26!!!",sl_processcustomfield($custom26,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom27!!!",sl_processcustomfield($custom27,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom28!!!",sl_processcustomfield($custom28,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom29!!!",sl_processcustomfield($custom29,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom30!!!",sl_processcustomfield($custom30,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom31!!!",sl_processcustomfield($custom31,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom32!!!",sl_processcustomfield($custom32,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom33!!!",sl_processcustomfield($custom33,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom34!!!",sl_processcustomfield($custom34,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom35!!!",sl_processcustomfield($custom35,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom36!!!",sl_processcustomfield($custom36,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom37!!!",sl_processcustomfield($custom37,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom38!!!",sl_processcustomfield($custom38,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom39!!!",sl_processcustomfield($custom39,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom40!!!",sl_processcustomfield($custom40,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom41!!!",sl_processcustomfield($custom41,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom42!!!",sl_processcustomfield($custom42,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom43!!!",sl_processcustomfield($custom43,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom44!!!",sl_processcustomfield($custom44,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom45!!!",sl_processcustomfield($custom45,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom46!!!",sl_processcustomfield($custom46,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom47!!!",sl_processcustomfield($custom47,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom48!!!",sl_processcustomfield($custom48,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom49!!!",sl_processcustomfield($custom49,$HTMLEmail),$mailBody);
  $mailBody=str_replace("!!!custom50!!!",sl_processcustomfield($custom50,$HTMLEmail),$mailBody);
  if ($DateFormat=="DDMMYY")
    $mailBody=str_replace("!!!date!!!",date("d/m/y"),$mailBody);
  if ($DateFormat=="MMDDYY")
    $mailBody=str_replace("!!!date!!!",date("m/d/y"),$mailBody);
  $mailBody=str_replace("!!!datedmy!!!",date("d/m/y"),$mailBody);
  $mailBody=str_replace("!!!datemdy!!!",date("m/d/y"),$mailBody);

  // Now we should see if eachgroupstart sections exists
  $start=0;
  do
  {
    $found=0;
	  $pos=strpos($mailBody,"<!--eachgroupstart-->");
	  $pos2=strpos($mailBody,"<!--eachgroupend-->");
	  if ((is_integer($pos)) && (is_integer($pos2)))
	  {
      $found=1;
	    $buf=substr($mailBody,$pos+21,$pos2-$pos-21);
	    // Now remove this section
	    $mailBody1=substr($mailBody,0,$pos);
	    $mailBody2=substr($mailBody,$pos2+19,strlen($mailBody)-$pos2-19);
	    $mailBody=$mailBody1;
	    for ($k=0; $k<count($slgroupname); $k++)
	    {
	      $repeatbuf=$buf;
	      $repeatbuf=str_replace("!!!groupname!!!",$slgroupname[$k],$repeatbuf);
	      $repeatbuf=str_replace("!!!groupdesc!!!",$slgroupdesc[$k],$repeatbuf);
	      $repeatbuf=str_replace("!!!groupexpiry!!!",$slgroupexpiry[$k],$repeatbuf);
	      $repeatbuf=str_replace("!!!groupremove!!!","!!!removegroup(1440,".$slgroupname[$k].",,,)!!!",$repeatbuf);
	      $mailBody.=$repeatbuf;
	    }
	    $mailBody.=$mailBody2;
	  }
  }
  while($found==1);
  // If there are any of the group loop variables left assume they are for the first group
  $mailBody=str_replace("!!!groupname!!!",$slgroupname[0],$mailBody);
  $mailBody=str_replace("!!!groupdesc!!!",$slgroupdesc[0],$mailBody);
  $mailBody=str_replace("!!!groupexpiry!!!",$slgroupexpiry[0],$mailBody);  
  $mailBody=str_replace("!!!groupremove!!!","!!!removegroup(1440,".$slgroupname[0].",,,)!!!",$mailBody);  
  // Now handle any !!!link(filename,expiry)!!! template variables
  $downloadbackground="";
  if (file_exists($SitelokLocation."emaildownloadpage.php"))
    $downloadbackground=$SitelokLocation."emaildownloadpage.php";
  $itemids=sl_getitemvars($mailBody,"link");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into filename and expiry time.
    $filename=strtok($items[$k],",");
    $exp=strtok(",");
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $expiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $expiry = time() + ($exp * 60);
    }
    else
      $expiry=0;
    if ($user!="")      
      $plink=sl_GetSecureLink($filename, $expiry, $user);
    else 
      $plink=sl_GetSecureLink($filename, $expiry, $email);
    if ($downloadbackground!="")
      $plink = str_replace("?auth=", "?authe=", $plink);                    
    $mailBody = str_replace("!!!link(".$items[$k].")!!!",$plink, $mailBody);
  }
  // Now handle any !!!passwordhash(minutes)!!! template variables
  $itemids=sl_getitemvars($mailBody,"passwordhash");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    $mailBody = str_replace("!!!passwordhash(".$items[$k].")!!!",sl_passwordhash($items[$k],$pass), $mailBody);
  }
  // Now handle any !!!size(filename)!!! template variables
  $itemids=sl_getitemvars($mailBody,"size");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    $fname=strtok($items[$k],":");
    $loc=strtok(":");
    if ($loc=="")
      $fullpath=$FileLocation.$fname;
    else
      $fullpath=$FileLocations[$loc].$fname;
    // Convert ; to | for s3 location
    $fullpath=str_replace(";","|",$fullpath);  
    if (substr(trim(strtolower($fullpath)),0,3)=="s3|")
    {
      $s = sl_filesize_s3($fullpath);
      if (is_numeric($s))
        $size = $s;
    }
    else
    {      
      $pos = strpos(strtolower($fullpath), "http://");
      if (is_integer($pos))
      {
        $s=sl_filesize_remote($fullpath);
        if (is_integer($s))
        	$size=$s;
      }
      else
        $size = @filesize($fullpath);
    }
    $mailBody = str_replace("!!!size(".$items[$k].")!!!",sl_FriendlyFileSize($size), $mailBody);
  }
  // Handle !!!approve!!!
  $approveexpiry=0;
  $approvectemplate="approve.htm";
  $approveatemplate="approveadmin.htm";
  $approveredirect="";
  $approvehash=md5($SiteKey."1".$user.$approveexpiry.$approvectemplate.$approveatemplate.$approveredirect);
  $approveauth="1,".$user.",".$approveexpiry.",".$approvectemplate.",".$approveatemplate.",".$approveredirect.",".$approvehash;
  $approveauth = base64_encode($approveauth);
  $approveauth = rawurlencode($approveauth);  
  $mailBody=str_replace("!!!approve!!!",$slpwURL."linkprocess.php?auth=".$approveauth,$mailBody);
  // Handle !!!approve(expiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"approve");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, client template, admin template and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $approvectemplate=$tokenparts[1];
    $approveatemplate=$tokenparts[2];
    $approveredirect=$tokenparts[3];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $approveexpiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $approveexpiry = time() + ($exp * 60);
    }  
    $approvehash=md5($SiteKey."1".$user.$approveexpiry.$approvectemplate.$approveatemplate.$approveredirect);
    $approveauth="1,".$user.",".$approveexpiry.",".$approvectemplate.",".$approveatemplate.",".$approveredirect.",".$approvehash;
    $approveauth = base64_encode($approveauth);
    $approveauth = rawurlencode($approveauth);  
    $mailBody = str_replace("!!!approve(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$approveauth, $mailBody);
  }  
  // Handle !!!disable!!!
  $disableexpiry=0;
  $disablectemplate="disable.htm";
  $disableatemplate="disableadmin.htm";
  $disableredirect="";
  $disablehash=md5($SiteKey."2".$user.$disableexpiry.$disablectemplate.$disableatemplate.$disableredirect);
  $disableauth="2,".$user.",".$disableexpiry.",".$disablectemplate.",".$disableatemplate.",".$disableredirect.",".$disablehash;
  $disableauth = base64_encode($disableauth);
  $disableauth = rawurlencode($disableauth);  
  $mailBody=str_replace("!!!disable!!!",$slpwURL."linkprocess.php?auth=".$disableauth,$mailBody);
  // Handle !!!disable(expiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"disable");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, template and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $disablectemplate=$tokenparts[1];
    $disableatemplate=$tokenparts[2];
    $disableredirect=$tokenparts[3];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $disableexpiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $disableexpiry = time() + ($exp * 60);
    }  
    $disablehash=md5($SiteKey."2".$user.$disableexpiry.$disablectemplate.$disableatemplate.$disableredirect);
    $disableauth="2,".$user.",".$disableexpiry.",".$disablectemplate.",".$disableatemplate.",".$disableredirect.",".$disablehash;
    $disableauth = base64_encode($disableauth);
    $disableauth = rawurlencode($disableauth);  
    $mailBody = str_replace("!!!disable(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$disableauth, $mailBody);
  }
  // Handle !!!newpassword!!!   (this works with !!!activatepassword!!!)
  $newpassword=sl_CreatePassword($RandomPasswordMask);
  $subject=str_replace("!!!newpassword!!!",$newpassword,$subject);
  $mailBody=str_replace("!!!newpassword!!!",$newpassword,$mailBody);
  // Handle !!!activatepassword!!!
  $newpwhash=md5($SiteKey."3".$user.md5($pass.$SiteKey).$newpassword);
  $newpwauth="3,".$user.",".md5($pass.$SiteKey).",".$newpassword.",".$newpwhash;
  $newpwauth = base64_encode($newpwauth);
  $newpwauth = rawurlencode($newpwauth);  
  $mailBody=str_replace("!!!activatepassword!!!",$slpwURL."linkprocess.php?auth=".$newpwauth,$mailBody);
  // Handle !!!delete!!!
  $deleteexpiry=0;
  $deletectemplate="";
  $deleteatemplate="";
  $deleteredirect="";
  $deletehash=md5($SiteKey."4".$user.$deleteexpiry.$deletectemplate.$deleteatemplate.$deleteredirect);
  $deleteauth="4,".$user.",".$deleteexpiry.",".$deletectemplate.",".$deleteatemplate.",".$deleteredirect.",".$deletehash;
  $deleteauth = base64_encode($deleteauth);
  $deleteauth = rawurlencode($deleteauth);  
  $mailBody=str_replace("!!!delete!!!",$slpwURL."linkprocess.php?auth=".$deleteauth,$mailBody);
  // Handle !!!delete(expiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"delete");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, template and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $deletectemplate=$tokenparts[1];
    $deleteatemplate=$tokenparts[2];
    $deleteredirect=$tokenparts[3];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $deleteexpiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $deleteexpiry = time() + ($exp * 60);
    }  
    $deletehash=md5($SiteKey."4".$user.$deleteexpiry.$deletectemplate.$deleteatemplate.$deleteredirect);
    $deleteauth="4,".$user.",".$deleteexpiry.",".$deletectemplate.",".$deleteatemplate.",".$deleteredirect.",".$deletehash;
    $deleteauth = base64_encode($deleteauth);
    $deleteauth = rawurlencode($deleteauth);  
    $mailBody = str_replace("!!!delete(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$deleteauth, $mailBody);
  }
  // Handle !!!addgroup(expiry,group,groupexpiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"addgroup");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, group, grouexpiry, templates and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $group=$tokenparts[1];  
    $groupexpiry=$tokenparts[2];  
    $ctemplate=$tokenparts[3];
    $atemplate=$tokenparts[4];    
    $redirect=$tokenparts[5];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $expiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $expiry = time() + ($exp * 60);
    }  
    $hash=md5($SiteKey."5".$user.$expiry.$group.$groupexpiry.$ctemplate.$atemplate.$redirect);
    $auth="5,".$user.",".$expiry.",".$group.",".$groupexpiry.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
    $auth = base64_encode($auth);
    $auth = rawurlencode($auth);  
    $mailBody = str_replace("!!!addgroup(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$auth, $mailBody);
  }      
  // Handle !!!removegroup(expiry,group,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"removegroup");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, group, templates and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $group=$tokenparts[1];  
    $ctemplate=$tokenparts[3];
    $atemplate=$tokenparts[4];    
    $redirect=$tokenparts[5];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $expiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $expiry = time() + ($exp * 60);
    }  
    $hash=md5($SiteKey."6".$user.$expiry.$group.$ctemplate.$atemplate.$redirect);
    $auth="6,".$user.",".$expiry.",".$group.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
    $auth = base64_encode($auth);
    $auth = rawurlencode($auth);  
    $mailBody = str_replace("!!!removegroup(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$auth, $mailBody);
  }
  // Handle !!!replacegroup(expiry,group,newgroup,groupexpiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"replacegroup");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, group, newgroup, grouexpiry, templates and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $group=$tokenparts[1];  
    $newgroup=$tokenparts[2];  
    $groupexpiry=$tokenparts[3];  
    $ctemplate=$tokenparts[4];
    $atemplate=$tokenparts[5];    
    $redirect=$tokenparts[6];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $expiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $expiry = time() + ($exp * 60);
    }  
    $hash=md5($SiteKey."7".$user.$expiry.$group.$newgroup.$groupexpiry.$ctemplate.$atemplate.$redirect);
    $auth="7,".$user.",".$expiry.",".$group.",".$newgroup.",".$groupexpiry.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
    $auth = base64_encode($auth);
    $auth = rawurlencode($auth);  
    $mailBody = str_replace("!!!replacegroup(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$auth, $mailBody);
  }      
  // Handle !!!extendgroup(expiry,group,groupexpiry,expirytype,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"extendgroup");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, group, grouexpiry, expirytype templates and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $group=$tokenparts[1];  
    $groupexpiry=$tokenparts[2];  
    $expirytype=$tokenparts[3];  
    $ctemplate=$tokenparts[4];
    $atemplate=$tokenparts[5];    
    $redirect=$tokenparts[6];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $expiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $expiry = time() + ($exp * 60);
    }  
    $hash=md5($SiteKey."8".$user.$expiry.$group.$groupexpiry.$expirytype.$ctemplate.$atemplate.$redirect);
    $auth="8,".$user.",".$expiry.",".$group.",".$groupexpiry.",".$expirytype.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
    $auth = base64_encode($auth);
    $auth = rawurlencode($auth);  
    $mailBody = str_replace("!!!extendgroup(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$auth, $mailBody);
  }       
  if ($HTMLEmail == "Y")
    $mailBody="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD W3 HTML//EN\">\n".$mailBody;
  // Call onPrepareEmail event handler
  $paramdata['subject']=$subject;
  $paramdata['body']=$mailBody;
  $paramdata['htmlformat']=$HTMLEmail;
  $paramdata['toemail']=$toemail;
  $paramdata['username']=$user;
  $paramdata['userid']=$userid;    
  $paramdata['password']=$pass;
  $paramdata['name']=$name;
  $paramdata['email']=$email;
  $paramdata['usergroups']=$groups;
  $paramdata['custom1']=$custom1;
  $paramdata['custom2']=$custom2;
  $paramdata['custom3']=$custom3;
  $paramdata['custom4']=$custom4;
  $paramdata['custom5']=$custom5;
  $paramdata['custom6']=$custom6;
  $paramdata['custom7']=$custom7;
  $paramdata['custom8']=$custom8;
  $paramdata['custom9']=$custom9;
  $paramdata['custom10']=$custom10;
  $paramdata['custom11']=$custom11;
  $paramdata['custom12']=$custom12;
  $paramdata['custom13']=$custom13;
  $paramdata['custom14']=$custom14;
  $paramdata['custom15']=$custom15;
  $paramdata['custom16']=$custom16;
  $paramdata['custom17']=$custom17;
  $paramdata['custom18']=$custom18;
  $paramdata['custom19']=$custom19;
  $paramdata['custom20']=$custom20;
  $paramdata['custom21']=$custom21;
  $paramdata['custom22']=$custom22;
  $paramdata['custom23']=$custom23;
  $paramdata['custom24']=$custom24;
  $paramdata['custom25']=$custom25;
  $paramdata['custom26']=$custom26;
  $paramdata['custom27']=$custom27;
  $paramdata['custom28']=$custom28;
  $paramdata['custom29']=$custom29;
  $paramdata['custom30']=$custom30;
  $paramdata['custom31']=$custom31;
  $paramdata['custom32']=$custom32;
  $paramdata['custom33']=$custom33;
  $paramdata['custom34']=$custom34;
  $paramdata['custom35']=$custom35;
  $paramdata['custom36']=$custom36;
  $paramdata['custom37']=$custom37;
  $paramdata['custom38']=$custom38;
  $paramdata['custom39']=$custom39;
  $paramdata['custom40']=$custom40;
  $paramdata['custom41']=$custom41;
  $paramdata['custom42']=$custom42;
  $paramdata['custom43']=$custom43;
  $paramdata['custom44']=$custom44;
  $paramdata['custom45']=$custom45;
  $paramdata['custom46']=$custom46;
  $paramdata['custom47']=$custom47;
  $paramdata['custom48']=$custom48;
  $paramdata['custom49']=$custom49;
  $paramdata['custom50']=$custom50;    
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onPrepareEmail2[$p]))
    {
      $result=call_user_func($slplugin_event_onPrepareEmail2[$p],$slpluginid[$p],$paramdata);
      $paramdata['body']=$result['body'];
      $paramdata['subject']=$result['subject'];
    }  
  }
  // Call user event handler
  if (function_exists("sl_onPrepareEmail"))
    sl_onPrepareEmail($paramdata);      
  $mailBody=$paramdata['body']; 
  $subject=$paramdata['subject'];
}
function sl_ConfirmEmailTags($email,$requestedemail,$emailusedasusername,&$subject,&$mailBody,$htmlformat)
{
  global $SitelokLocationURL,$SiteKey,$slusername;
  $updateusername=0;
  if ($emailusedasusername)
    $updateusername=1;  
  if ($SitelokLocationURL!="")
    $slpwURL=$SitelokLocationURL;
  else  
    $slpwURL="http://".$_SERVER['HTTP_HOST']."/slpw/";
  $subject=str_replace("!!!requestedemail!!!",$requestedemail,$subject);
  $mailBody=str_replace("!!!requestedemail!!!",$requestedemail,$mailBody);
  // Handle !!!verifyemail!!!
  $verifyemailexpiry=0;
  $verifyemailctemplate="";
  $verifyemailatemplate="";
  $verifyemailredirect="";
  $verifyemailhash=md5($SiteKey."9".$slusername.$email.$requestedemail.$updateusername.$verifyemailexpiry.$verifyemailctemplate.$verifyemailatemplate.$verifyemailredirect);
  $verifyemailauth="9,".$slusername.",".$email.",".$requestedemail.",".$updateusername.",".$verifyemailexpiry.",".$verifyemailctemplate.",".$verifyemailatemplate.",".$verifyemailredirect.",".$verifyemailhash;
  $verifyemailauth = base64_encode($verifyemailauth);
  $verifyemailauth = rawurlencode($verifyemailauth);  
  $mailBody=str_replace("!!!verifyemail!!!",$slpwURL."linkprocess.php?auth=".$verifyemailauth,$mailBody);
  // Handle !!!verifyemail(expiry,clienttemplate,admintemplate,page)
  $itemids=sl_getitemvars($mailBody,"verifyemail");
  $items=explode("|",$itemids);
  for ($k=0;$k<count($items);$k++)
  {
    // Split item into expiry, template and page.
    $tokenparts=explode(",",$items[$k]);
    $exp=$tokenparts[0];
    if ($exp=="")
      $exp=0;
    $verifyemailctemplate=$tokenparts[1];
    $verifyemailatemplate=$tokenparts[2];
    $verifyemailredirect=$tokenparts[3];
    if ($exp != 0)
    {
      if (strlen($exp)==12)
        $verifyemailexpiry=gmmktime(substr($exp,8,2),substr($exp,10,2),0,substr($exp,4,2),substr($exp,6,2),substr($exp,0,4),-1);
      else
        $verifyemailexpiry = time() + ($exp * 60);
    }  
    $verifyemailhash=md5($SiteKey."9".$slusername.$email.$requestedemail.$updateusername.$verifyemailexpiry.$verifyemailctemplate.$verifyemailatemplate.$verifyemailredirect);
    $verifyemailauth="9,".$slusername.",".$email.",".$requestedemail.",".$updateusername.",".$verifyemailexpiry.",".$verifyemailctemplate.",".$verifyemailatemplate.",".$verifyemailredirect.",".$verifyemailhash;
    $verifyemailauth = base64_encode($verifyemailauth);
    $verifyemailauth = rawurlencode($verifyemailauth);  
    $mailBody = str_replace("!!!verifyemail(".$items[$k].")!!!",$slpwURL."linkprocess.php?auth=".$verifyemailauth, $mailBody);
  }
}
function sl_processcustomfield($s,$format)
{
  // If custom data contains html tags then leave as is.
  // If not then convert any \n characters to <br> if email format is html
  if ($s=="")
    return($s);
  if ($format!="Y")
    return($s);
  if (strlen(strip_tags($s))>=strlen($s))
  {
    $s=str_replace("\n","<br>",$s);
  }
  return($s);    
}
function sl_SendEmail($toemail,$mailBody,$subject,$HTMLEmail,$user,$pass,$name,$email,$groups,$custom1="",$custom2="",$custom3="",$custom4="",$custom5="",$custom6="",$custom7="",$custom8="",$custom9="",$custom10="",
$custom11="",$custom12="",$custom13="",$custom14="",$custom15="",$custom16="",$custom17="",$custom18="",$custom19="",$custom20="",
$custom21="",$custom22="",$custom23="",$custom24="",$custom25="",$custom26="",$custom27="",$custom28="",$custom29="",$custom30="",
$custom31="",$custom32="",$custom33="",$custom34="",$custom35="",$custom36="",$custom37="",$custom38="",$custom39="",$custom40="",
$custom41="",$custom42="",$custom43="",$custom44="",$custom45="",$custom46="",$custom47="",$custom48="",$custom49="",$custom50="")
{
	global $SiteName,$SiteEmail,$LogDetails,$DbTableName,$UsernameField,$IdField,$slnumplugins,$slpluginid;
	global $slplugin_event_onPrepareEmail2,$slplugin_event_onSendEmailAllowed,$slplugin_event_onSendEmailOut;
  // Get user id
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print "Could not connect to Mysql";
    exit;
  }
  $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user);
  $mysql_result=mysqli_query($mysql_link,$query);
  $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  if ($row)
    $UserId=$row[$IdField];
  else
    $UserId=-1;
  sl_PrepareEmail($mailBody,$subject,$HTMLEmail,$UserId,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
  $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,
  $custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
  $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,
  $custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);	 
  // Call onSendEmailAllowed event handler
  $paramdata['subject']=$subject;
  $paramdata['body']=$mailBody;
  $paramdata['htmlformat']=$HTMLEmail;
  $paramdata['toemail']=$toemail;
  $paramdata['username']=$user;
  $paramdata['userid']=$UserId;    
  $paramdata['password']=$pass;
  $paramdata['name']=$name;
  $paramdata['email']=$email;
  $paramdata['usergroups']=$groups;
  $paramdata['custom1']=$custom1;
  $paramdata['custom2']=$custom2;
  $paramdata['custom3']=$custom3;
  $paramdata['custom4']=$custom4;
  $paramdata['custom5']=$custom5;
  $paramdata['custom6']=$custom6;
  $paramdata['custom7']=$custom7;
  $paramdata['custom8']=$custom8;
  $paramdata['custom9']=$custom9;
  $paramdata['custom10']=$custom10;
  $paramdata['custom11']=$custom11;
  $paramdata['custom12']=$custom12;
  $paramdata['custom13']=$custom13;
  $paramdata['custom14']=$custom14;
  $paramdata['custom15']=$custom15;
  $paramdata['custom16']=$custom16;
  $paramdata['custom17']=$custom17;
  $paramdata['custom18']=$custom18;
  $paramdata['custom19']=$custom19;
  $paramdata['custom20']=$custom20;
  $paramdata['custom21']=$custom21;
  $paramdata['custom22']=$custom22;
  $paramdata['custom23']=$custom23;
  $paramdata['custom24']=$custom24;
  $paramdata['custom25']=$custom25;
  $paramdata['custom26']=$custom26;
  $paramdata['custom27']=$custom27;
  $paramdata['custom28']=$custom28;
  $paramdata['custom29']=$custom29;
  $paramdata['custom30']=$custom30;
  $paramdata['custom31']=$custom31;
  $paramdata['custom32']=$custom32;
  $paramdata['custom33']=$custom33;
  $paramdata['custom34']=$custom34;
  $paramdata['custom35']=$custom35;
  $paramdata['custom36']=$custom36;
  $paramdata['custom37']=$custom37;
  $paramdata['custom38']=$custom38;
  $paramdata['custom39']=$custom39;
  $paramdata['custom40']=$custom40;
  $paramdata['custom41']=$custom41;
  $paramdata['custom42']=$custom42;
  $paramdata['custom43']=$custom43;
  $paramdata['custom44']=$custom44;
  $paramdata['custom45']=$custom45;
  $paramdata['custom46']=$custom46;
  $paramdata['custom47']=$custom47;
  $paramdata['custom48']=$custom48;
  $paramdata['custom49']=$custom49;
  $paramdata['custom50']=$custom50;    
  $sendallowed=true;
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onSendEmailAllowed[$p]))
    {
      if (!call_user_func($slplugin_event_onSendEmailAllowed[$p],$slpluginid[$p],$paramdata))
        $sendallowed=false;
    }    
  }
  // Call user event handler
  if (function_exists("sl_onSendEmailAllowed"))
  {
    if (!sl_onSendEmailAllowed($paramdata))
      $sendallowed=false;      
  }  
  if (!$sendallowed)
    return(2);  // Email was blocked by plugin or event handler 

  // Call onSendEmailOut event handler
  $paramdata['emailsent']=false;
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onSendEmailOut[$p]))
    {
      if (call_user_func($slplugin_event_onSendEmailOut[$p],$slpluginid[$p],$paramdata))
        $paramdata['emailsent']=true;
    }    
  }
  // Call user event handler
  if (function_exists("sl_onSendEmailOut"))
  {
    if (sl_onSendEmailOut($paramdata))
      $paramdata['emailsent']=true;
  }
  // If not sent by event handlers then send now  
  if (!$paramdata['emailsent'])        
    $paramdata['emailsent']=sl_SendEmailOut($paramdata['toemail'],$SiteEmail,$SiteName,$paramdata['subject'],$paramdata['body'],$paramdata['htmlformat']);  
  if ($paramdata['emailsent'])
  {
    if (substr($LogDetails,5,1)=="Y")
    {
      if ($user=="")
	      sl_AddToLog("Email",$paramdata['toemail'],$paramdata['subject']);
	    else   
	      sl_AddToLog("Email",$user,$paramdata['subject']);
    }  
  }
  if ($paramdata['emailsent'])
    return(1);  // Email sent
	return(0); // Email failed
}
function sl_SendEmailOut($toemail,$fromemail,$fromname,$subject,$mailBody,$htmlformat)
{
	global $EmailHeaderNoSlashR, $ExtraMailParam, $UsePHPmailer, $DemoMode, $SiteEmail, $SiteEmail2, $MetaCharSet;
  if ($DemoMode)
  {
    if (function_exists('usleep'))    
	    usleep(100000);
	  return(true);
  }
	// Remove any comma in from name
	$fromname=str_replace(","," ",$fromname);
	// If phpmailer setup then use it otherwise handle with PHP mail() function
	if ($UsePHPmailer==1)
	{
		global $EmailUsername,$EmailPassword,$EmailServer, $EmailPort, $EmailAuth, $EmailServerSecurity;
    if ($EmailPort=="")
      $EmailPort=25;
		require_once("class.phpmailer.php");
		$mail = new PHPMailer(true);
    try
    {
		$mail->IsSMTP();
		$mail->SMTPDebug = false;
		$mail->do_debug = 0;
		$mail->CharSet=$MetaCharSet;
		$mail->Host     = $EmailServer;
		$mail->Port = $EmailPort;
    if ($EmailAuth=="0")				
  		$mail->SMTPAuth = false;
		else
  		$mail->SMTPAuth = true;
  	if ($EmailServerSecurity!="")			
  	  $mail->SMTPSecure = $EmailServerSecurity;
		$mail->Username = $EmailUsername;
		$mail->Password = $EmailPassword;
		$mail->From     = $fromemail;
		$mail->FromName = $fromname;
		$mail->AddAddress($toemail);
    // If admin email then send also to $SiteEmail2 if required
    if (($SiteEmail2!="") && ($toemail==$SiteEmail))
		  $mail->AddAddress($SiteEmail2);    
		if ($htmlformat=="Y")
			$mail->IsHTML(true);
		else
			$mail->IsHTML(false);
		$mail->Subject  =  $subject;
		$mail->Body     =  $mailBody;
		$mail->Send();
		$result=true;
		}	
		catch (phpmailerException $e)
		{
  		$result=false;  		
		}
		catch (Exception $e)
		{
  		$result=false;  		  		
		}	
		if($mail->isError()==true)
		  $result=false;
	}
	else
	{
    // If admin email then send to $SiteEmail2 if required
    if (($SiteEmail2!="") && ($toemail==$SiteEmail))
    	$toemail.=",".$SiteEmail2;
	  $headers = "From: " . $fromname . " <" . $fromemail . ">\r\n";
	  $headers.= "Reply-To: " . $fromname . " <" . $fromemail . ">\r\n";
	  $headers.= "MIME-Version: 1.0\r\n";
	  if ($htmlformat=="Y")
	  {
	    $headers .= "Content-type: text/html; charset=$MetaCharSet\r\n";
	    $headers .= "Content-Transfer-Encoding: base64\r\n";	    
	    $mailBody=chunk_split(base64_encode($mailBody));
	  }
	  else
	    $headers .= "Content-type: text/plain\r\n";
	  if ($EmailHeaderNoSlashR == 1)
	    $headers = str_replace("\r", "", $headers);
	  if ($ExtraMailParam!="")
		  $result=mail($toemail, $subject, $mailBody, $headers, $ExtraMailParam);
	  else
		  $result=mail($toemail, $subject, $mailBody, $headers);
	}
	return ($result);  
}
function sl_CreatePassword($mask)
{
  global $ValidPasswordChars;
  if ($mask=="")
    $mask="cccc##";
  $password="";   
  for ($k=0;$k<strlen($mask);$k++)  
  {
    if (substr($mask,$k,1)=="c")
  	  $password.=substr("abcdefghijklmnopqrstuvwxyz",rand(0,25),1);
    if (substr($mask,$k,1)=="C")
  	  $password.=substr("ABCDEFGHIJKLMNOPQRSTUVWXYZ",rand(0,25),1);
    if (substr($mask,$k,1)=="#")
  	  $password.=substr("0123456789",rand(0,9),1);
    if (substr($mask,$k,1)=="X")
  	  $password.=substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ",rand(0,51),1);
    if (substr($mask,$k,1)=="A")
  	  $password.=substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",rand(0,61),1);
    if (substr($mask,$k,1)=="U")
  	  $password.=substr($ValidPasswordChars,rand(0,strlen($ValidPasswordChars)-1),1);
  }
  return($password);
}
function sl_validate_email($email)
{
  $email=strtolower($email);
  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'; 
  $valid=false;
  if (preg_match($regex, $email))
	  $valid=true;
	return ($valid);
}  
function sl_AddToLog($t,$u,$d)
{
  global $SitelokLog,$IPaddr,$DateFormat,$DbHost,$DbUser,$DbPassword,$DbName,$DbLogTableName;
  // if Logfile required add a line to it containing details of this request
  $timenow=time();
  if ($SitelokLog!="")
  {
    $lne=$t.",".$u.",".$d;
    // Remove quotes and carriage returns from $lne
    $lne=str_replace("'","",$lne);
    $lne=str_replace("\"","",$lne);
    $lne=str_replace("\n","",$lne);
    $lne=str_replace("\r","",$lne);    
    if (is_writeable($SitelokLog))
    {
      $fh=@fopen($SitelokLog,"a");
      if ($fh)
      {
      	if ($DateFormat=="DDMMYY")
	        $logstr=gmdate("d/m/y",$timenow);
	      else
	        $logstr=gmdate("m/d/y",$timenow);
        $logstr.=",".gmdate("H:i:s",$timenow).",".$IPaddr.","; // Date and time
        $logstr.=$lne;
        $logstr.="\n";
        fputs($fh,$logstr);
        fclose($fh);
      }
    }
  }
  // If mysql log required then add entry
  if ($DbLogTableName!="")
  {
    $u=str_replace("'","",$u);
    $u=str_replace("\"","",$u);
    $u=str_replace("\n","",$u);
    $u=str_replace("\r","",$u);    
    $d=str_replace("'","",$d);
    $d=str_replace("\"","",$d);
    $d=str_replace("\n","",$d);
    $d=str_replace("\r","",$d);    
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
      return;
    $Query="INSERT INTO ".$DbLogTableName." (time, username, type, details, ip, session) VALUES('".gmdate("Y-m-d H:i:s",$timenow)."',".sl_quote_smart($u).",".sl_quote_smart($t).",".sl_quote_smart($d).",'".$IPaddr."','".session_id()."')";      
    $mysql_result=mysqli_query($mysql_link,$Query);
  }
}
function sl_userdeleted($user)
{
  // Note deleting selected users in admin does not call this function
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbLogTableName,$DbOrdersTableName;
  // Delete username in log and sl_ordercontrol
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
    return(false);
  $mysql_result=mysqli_query($mysql_link,"DELETE FROM ".$DbOrdersTableName." WHERE username=".sl_quote_smart($user));
  if (!$mysql_result)
    return(false);
  $mysql_result=mysqli_query($mysql_link,"DELETE FROM ".$DbLogTableName." WHERE username=".sl_quote_smart($user));
  if (!$mysql_result)
    return(false);
  return(true);
}
function sl_usernamechanged($old,$new)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbLogTableName,$DbOrdersTableName;
  // Change username in log and sl_ordercontrol
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
    return(false);
  $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbOrdersTableName." SET username=".sl_quote_smart($new)." WHERE username=".sl_quote_smart($old));
  if (!$mysql_result)
    return(false);
  $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbLogTableName." SET username=".sl_quote_smart($new)." WHERE username=".sl_quote_smart($old));	  
  if (!$mysql_result)
    return(false);
  return(true);
}
function sl_processlogout($user)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$SelectedField,$CreatedField,$UsernameField;
	global $PasswordField,$EnabledField,$NameField,$EmailField,$UsergroupsField,$SiteEmail,$IdField;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
  global $slnumplugins,$slpluginid,$slplugin_event_onLogout;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
    return(false);
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
  if ($mysql_result!=false)
  {
  	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
    if ($row!=false)
    {
      $paramdata['oldusername']=$row[$UsernameField];
      $paramdata['username']=$row[$UsernameField];
      $paramdata['userid']=$row[$IdField];      
      $paramdata['password']=$row[$PasswordField];
      $paramdata['enabled']=$row[$EnabledField];
      $paramdata['name']=$row[$NameField];
      $paramdata['email']=$row[$EmailField];
      $paramdata['usergroups']=$row[$UsergroupsField];
      $paramdata['custom1']=$row[$Custom1Field];
      $paramdata['custom2']=$row[$Custom2Field];
      $paramdata['custom3']=$row[$Custom3Field];
      $paramdata['custom4']=$row[$Custom4Field];
      $paramdata['custom5']=$row[$Custom5Field];
      $paramdata['custom6']=$row[$Custom6Field];
      $paramdata['custom7']=$row[$Custom7Field];
      $paramdata['custom8']=$row[$Custom8Field];
      $paramdata['custom9']=$row[$Custom9Field];
      $paramdata['custom10']=$row[$Custom10Field];
      $paramdata['custom11']=$row[$Custom11Field];
      $paramdata['custom12']=$row[$Custom12Field];
      $paramdata['custom13']=$row[$Custom13Field];
      $paramdata['custom14']=$row[$Custom14Field];
      $paramdata['custom15']=$row[$Custom15Field];
      $paramdata['custom16']=$row[$Custom16Field];
      $paramdata['custom17']=$row[$Custom17Field];
      $paramdata['custom18']=$row[$Custom18Field];
      $paramdata['custom19']=$row[$Custom19Field];
      $paramdata['custom20']=$row[$Custom20Field];
      $paramdata['custom21']=$row[$Custom21Field];
      $paramdata['custom22']=$row[$Custom22Field];
      $paramdata['custom23']=$row[$Custom23Field];
      $paramdata['custom24']=$row[$Custom24Field];
      $paramdata['custom25']=$row[$Custom25Field];
      $paramdata['custom26']=$row[$Custom26Field];
      $paramdata['custom27']=$row[$Custom27Field];
      $paramdata['custom28']=$row[$Custom28Field];
      $paramdata['custom29']=$row[$Custom29Field];
      $paramdata['custom30']=$row[$Custom30Field];
      $paramdata['custom31']=$row[$Custom31Field];
      $paramdata['custom32']=$row[$Custom32Field];
      $paramdata['custom33']=$row[$Custom33Field];
      $paramdata['custom34']=$row[$Custom34Field];
      $paramdata['custom35']=$row[$Custom35Field];
      $paramdata['custom36']=$row[$Custom36Field];
      $paramdata['custom37']=$row[$Custom37Field];
      $paramdata['custom38']=$row[$Custom38Field];
      $paramdata['custom39']=$row[$Custom39Field];
      $paramdata['custom40']=$row[$Custom40Field];
      $paramdata['custom41']=$row[$Custom41Field];
      $paramdata['custom42']=$row[$Custom42Field];
      $paramdata['custom43']=$row[$Custom43Field];
      $paramdata['custom44']=$row[$Custom44Field];
      $paramdata['custom45']=$row[$Custom45Field];
      $paramdata['custom46']=$row[$Custom46Field];
      $paramdata['custom47']=$row[$Custom47Field];
      $paramdata['custom48']=$row[$Custom48Field];
      $paramdata['custom49']=$row[$Custom49Field];
      $paramdata['custom50']=$row[$Custom50Field];
	 	  //mysqli_close($mysql_link);
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (function_exists($slplugin_event_onLogout[$p]))
          call_user_func($slplugin_event_onLogout[$p],$slpluginid[$p],$paramdata);
      }
      // Call user event handler
      if (function_exists("sl_onLogout"))
        sl_onLogout($paramdata);
    }
  }
}
function sl_ordercustom($user,$ip)
{
  global $SiteKey;
  $custom="I=".$ip.","."U=".$user;
  $custom=md5($SiteKey.$custom)."^".$custom;
  $custom=base64_encode($custom);
  $custom=rawurlencode($custom);
  return ($custom);
}
function sl_passwordclue($pass)
{
  if ($pass=="")
    return("********");
  if (strlen($pass)==1)
    return("********");    
  if (strlen($pass)<=4)
    return(str_repeat("*", strlen($pass)-1).substr($pass,strlen($pass)-1));
  if (strlen($pass)<=6)
    return(str_repeat("*", strlen($pass)-2).substr($pass,strlen($pass)-2));  
  return(str_repeat("*", strlen($pass)-3).substr($pass,strlen($pass)-3));  
}
function sl_passwordhash($minutes,$pass="",$dohash=true)
{
  global $slpasswordhash,$SiteKey;
  if ($pass!="")
  {
    if ($dohash)
      $pass=md5(md5($pass.$SiteKey).$SiteKey);    
  }
  else
    $pass=$slpasswordhash;
  if ($minutes>0)
    $exptime=time()+($minutes*60);
  else
    $exptime=0;
  $hash=md5($SiteKey.$exptime.$pass);
  $link=$hash.",".$exptime.",".$pass;
  $link=base64_encode($link);
  $link=rawurlencode($link);
  return($link);	    
}
function sl_get_s3_url($location,$expires,$operation="GET",$dialog=0)
{
  // Split into access key id, secret access key, bucket , filename
  $parts=explode("|",$location);
  $accesskeyid=trim($parts[1]);
  $secretaccesskey=trim($parts[2]);
  $bucket=trim($parts[3]);
  $resource=trim($parts[4]);
  $filename=basename($resource);
  $extension=sl_fileextension($resource);  
  if ($dialog==1)
  {
    $headers = array(
        'response-content-disposition' => 'attachment; filename=' . "\"".$filename."\"",
        'response-content-type' => 'application/force-download',
    );
  }
  else
    $headers=array();
  $resource = str_replace(array('%2F', '%2B'), array('/', '+'), rawurlencode($resource));
  $string_to_sign = $operation."\n\n\n$expires\n/$bucket/$resource";
  $final_url = "http://s3.amazonaws.com/$bucket/$resource?";

  $append_char = '?';
  foreach ($headers as $header => $value) {
      $final_url .= $header . '=' . urlencode($value) . '&';
      $string_to_sign .= $append_char . $header . '=' . $value;
      $append_char = '&';
  }
  $signature = urlencode(sl_hex2b64(sl_hmacsha1($secretaccesskey,$string_to_sign)));
  $final_url=$final_url . "AWSAccessKeyId=$accesskeyid&Expires=$expires&Signature=$signature&FixForIE=".$extension;
  return ($final_url); 
}

function sl_filesize_s3($location)
{
  global $ServerTimeAdjust;
  $url=sl_get_s3_url($location,time()+$ServerTimeAdjust,"GET");
  $size=sl_filesize_remote($url);
  if ($size===false)
    return("Unknown");
  return($size);  
}
function sl_hmacsha1($key,$data)
{
  $blocksize=64;
  $hashfunc='sha1';
  if (strlen($key)>$blocksize)
      $key=pack('H*', $hashfunc($key));
  $key=str_pad($key,$blocksize,chr(0x00));
  $ipad=str_repeat(chr(0x36),$blocksize);
  $opad=str_repeat(chr(0x5c),$blocksize);
  $hmac = pack(
              'H*',$hashfunc(
                  ($key^$opad).pack(
                      'H*',$hashfunc(
                          ($key^$ipad).$data
                      )
                  )
              )
          );
  return bin2hex($hmac);
}
function sl_hex2b64($str)
{
  $raw = '';
  for ($i=0; $i < strlen($str); $i+=2) {
          $raw .= chr(hexdec(substr($str, $i, 2)));
  }
  return base64_encode($raw);
}
function getUrlParts($url)
{
	// Get the protocol, site and resource parts of the URL
	// original url = http://example.com/blog/index?name=foo
	// protocol = http://
	// site = example.com/
	// resource = blog/index?name=foo
	$result = array();
	$regex = '#^(.*?//)*([\w\.\d-]*)(:(\d+))*(/*)(.*)$#';
	$matches = array();
	preg_match($regex, $url, $matches);
	// Assign the matched parts of url to the result array
	$result['protocol'] = $matches[1];
	$result['port'] = $matches[4];
	$result['site'] = $matches[2];
	$result['resource'] = $matches[6];
	// clean up the site portion by removing the trailing /
	$result['site'] = preg_replace('#/$#', '', $result['site']); 
	// clean up the protocol portion by removing the trailing ://
	$result['protocol'] = preg_replace('#://$#', '', $result['protocol']);
	return $result;
}
function sl_issearchengine($botip,$botagent)
{
  global $searchenginedetails;
  $searchenginedetails[]="googlebot,googlebot.com";
  $searchenginedetails[]="slurp,yahoo.com";
  $searchenginedetails[]="slurp,yahoo.net";
  $searchenginedetails[]="slurp,inktomi.com";
  $searchenginedetails[]="slurp,inktomisearch.com";
  $searchenginedetails[]="msnbot,msn.com";
  $searchenginedetails[]="ia_archiver,amazonaws.com";
  $searchenginedetails[]="charlotte,searchme.com";
  $searchenginedetails[]="teoma,ask.com";
  $searchenginedetails[]="speedy,entireweb.com";
  $botagent=strtolower($botagent);   
  for ($k=0;$k<count($searchenginedetails);$k++)
  {
    $searchengineparts=explode(",",$searchenginedetails[$k]);
    if (is_integer(strpos($botagent,strtolower($searchengineparts[0]))))
    {
      $bothost=gethostbyaddr($botip);
      if (substr($bothost, -strlen($searchengineparts[1])) == $searchengineparts[1])
      { 
        $verifiedbotip = gethostbyname($bothost);
        if ( $botip = $verifiedbotip )
        {
           return($searchengineparts[0]);
        }
      } 
    }
  }
  return("");
}
function sl_rc4two($data, $salt, $encrypt = true)
{
	$key = array();
	$result = "";
	$state = array();
	$salt = md5(str_rot13($salt));
	$len = strlen($salt);

	if ($encrypt)
	{
		$data = str_rot13($data);
	}
	else
	{
		$data = base64_decode($data);
	}
	$ii = -1;
	while (++$ii < 256)
	{
		$key[$ii] = ord(substr($salt, (($ii % $len) + 1), 1));
		$state[$ii] = $ii;
	}
	$ii = -1;
	$j = 0;
	while (++$ii < 256)
	{
		$j = ($j + $key[$ii] + $state[$ii]) % 255;
		$t = $state[$j];

		$state[$ii] = $state[$j];
		$state[$j] = $t;
	}
	$len = strlen($data);
	$ii = -1;
	$j = 0;
	$k = 0;
	while (++$ii < $len)
	{
		$j = ($j + 1) % 256;
		$k = ($k + $state[$j]) % 255;
		$t = $key[$j];
		$state[$j] = $state[$k];
		$state[$k] = $t;

		$x = $state[(($state[$j] + $state[$k]) % 255)];
		$result .= chr(ord($data[$ii]) ^ $x);
	}
	if ($encrypt)
	{
		$result = base64_encode($result);
	}
	else
	{
		$result = str_rot13($result);
	}
	return $result;
}
function sl_UpdateUserVariables($username,$frommysql)
{
  // Update user related variables from mysql
 	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$CreatedField,$UsernameField,$PasswordField,$EnabledField;
	global $NameField,$EmailField,$UsergroupsField,$IdField;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
  global $slcreated,$slusername,$sluserid,$slpassword,$slpasswordclue,$slpasswordhash,$slenabled,$slusergroups,$slname,$slfirstname,$sllastname,$slemail;
  global $slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10; 
  global $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20; 
  global $slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30; 
  global $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40; 
  global $slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50;
  global $slordercustom,$slgroupname,$slgroupdesc,$slgrouploginaction,$slgrouploginvalue;
  global $slgroupexpiry,$slgroupexpirybyname,$slgroupexpiryts,$slgroupexpirytsbyname;
  global $DateFormat,$IPaddr,$SiteKey;
  if ($frommysql)
  { 
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
      return(false);
    $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
    $mysql_result=mysqli_query($mysql_link,$query);
    if ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $created=$row[$CreatedField];
      $_SESSION['ses_slcreated']=gmmktime(0,0,0,substr($created,2,2),substr($created,4,2),substr($created,0,2));
      $_SESSION['ses_slusername']=$row[$UsernameField];
      $_SESSION['ses_sluserid']=$row[$IdField];
      $_SESSION['ses_slpassword']=$row[$PasswordField];
      $_SESSION['ses_slname']=$row[$NameField];
      $_SESSION['ses_slenabled']=$row[$EnabledField];
      $_SESSION['ses_slemail']=$row[$EmailField];
      $_SESSION['ses_slusergroups']=$row[$UsergroupsField];
      $_SESSION['ses_slcustom1']=$row[$Custom1Field];
      $_SESSION['ses_slcustom2']=$row[$Custom2Field];
      $_SESSION['ses_slcustom3']=$row[$Custom3Field];
      $_SESSION['ses_slcustom4']=$row[$Custom4Field];
      $_SESSION['ses_slcustom5']=$row[$Custom5Field];
      $_SESSION['ses_slcustom6']=$row[$Custom6Field];
      $_SESSION['ses_slcustom7']=$row[$Custom7Field];
      $_SESSION['ses_slcustom8']=$row[$Custom8Field];
      $_SESSION['ses_slcustom9']=$row[$Custom9Field];
      $_SESSION['ses_slcustom10']=$row[$Custom10Field];
      $_SESSION['ses_slcustom11']=$row[$Custom11Field];
      $_SESSION['ses_slcustom12']=$row[$Custom12Field];
      $_SESSION['ses_slcustom13']=$row[$Custom13Field];
      $_SESSION['ses_slcustom14']=$row[$Custom14Field];
      $_SESSION['ses_slcustom15']=$row[$Custom15Field];
      $_SESSION['ses_slcustom16']=$row[$Custom16Field];
      $_SESSION['ses_slcustom17']=$row[$Custom17Field];
      $_SESSION['ses_slcustom18']=$row[$Custom18Field];
      $_SESSION['ses_slcustom19']=$row[$Custom19Field];
      $_SESSION['ses_slcustom20']=$row[$Custom20Field];
      $_SESSION['ses_slcustom21']=$row[$Custom21Field];
      $_SESSION['ses_slcustom22']=$row[$Custom22Field];
      $_SESSION['ses_slcustom23']=$row[$Custom23Field];
      $_SESSION['ses_slcustom24']=$row[$Custom24Field];
      $_SESSION['ses_slcustom25']=$row[$Custom25Field];
      $_SESSION['ses_slcustom26']=$row[$Custom26Field];
      $_SESSION['ses_slcustom27']=$row[$Custom27Field];
      $_SESSION['ses_slcustom28']=$row[$Custom28Field];
      $_SESSION['ses_slcustom29']=$row[$Custom29Field];
      $_SESSION['ses_slcustom30']=$row[$Custom30Field];
      $_SESSION['ses_slcustom31']=$row[$Custom31Field];
      $_SESSION['ses_slcustom32']=$row[$Custom32Field];
      $_SESSION['ses_slcustom33']=$row[$Custom33Field];
      $_SESSION['ses_slcustom34']=$row[$Custom34Field];
      $_SESSION['ses_slcustom35']=$row[$Custom35Field];
      $_SESSION['ses_slcustom36']=$row[$Custom36Field];
      $_SESSION['ses_slcustom37']=$row[$Custom37Field];
      $_SESSION['ses_slcustom38']=$row[$Custom38Field];
      $_SESSION['ses_slcustom39']=$row[$Custom39Field];
      $_SESSION['ses_slcustom40']=$row[$Custom40Field];
      $_SESSION['ses_slcustom41']=$row[$Custom41Field];
      $_SESSION['ses_slcustom42']=$row[$Custom42Field];
      $_SESSION['ses_slcustom43']=$row[$Custom43Field];
      $_SESSION['ses_slcustom44']=$row[$Custom44Field];
      $_SESSION['ses_slcustom45']=$row[$Custom45Field];
      $_SESSION['ses_slcustom46']=$row[$Custom46Field];
      $_SESSION['ses_slcustom47']=$row[$Custom47Field];
      $_SESSION['ses_slcustom48']=$row[$Custom48Field];
      $_SESSION['ses_slcustom49']=$row[$Custom49Field];
      $_SESSION['ses_slcustom50']=$row[$Custom50Field];
    }
  }
  $slcreated=$_SESSION['ses_slcreated'];
  $slusername=$_SESSION['ses_slusername'];
  $sluserid=$_SESSION['ses_sluserid'];
  $slpassword=$_SESSION['ses_slpassword'];
  $slpasswordclue=sl_passwordclue($slpassword);
  $slpasswordhash=md5(md5($slpassword.$SiteKey).$SiteKey);  
  $slenabled=$_SESSION['ses_slenabled'];
  $slusergroups=$_SESSION['ses_slusergroups'];
  $slname=trim($_SESSION['ses_slname']);
  $namesarray=explode(" ",trim($slname));
  $slfirstname=$namesarray[0];
  $sllastname=$namesarray[count($namesarray)-1];  	  
  $slemail=$_SESSION['ses_slemail'];
  $slcustom1=$_SESSION['ses_slcustom1'];
  $slcustom2=$_SESSION['ses_slcustom2'];
  $slcustom3=$_SESSION['ses_slcustom3'];
  $slcustom4=$_SESSION['ses_slcustom4'];
  $slcustom5=$_SESSION['ses_slcustom5'];
  $slcustom6=$_SESSION['ses_slcustom6'];
  $slcustom7=$_SESSION['ses_slcustom7'];
  $slcustom8=$_SESSION['ses_slcustom8'];
  $slcustom9=$_SESSION['ses_slcustom9'];
  $slcustom10=$_SESSION['ses_slcustom10'];
  $slcustom11=$_SESSION['ses_slcustom11'];
  $slcustom12=$_SESSION['ses_slcustom12'];
  $slcustom13=$_SESSION['ses_slcustom13'];
  $slcustom14=$_SESSION['ses_slcustom14'];
  $slcustom15=$_SESSION['ses_slcustom15'];
  $slcustom16=$_SESSION['ses_slcustom16'];
  $slcustom17=$_SESSION['ses_slcustom17'];
  $slcustom18=$_SESSION['ses_slcustom18'];
  $slcustom19=$_SESSION['ses_slcustom19'];
  $slcustom20=$_SESSION['ses_slcustom20'];
  $slcustom21=$_SESSION['ses_slcustom21'];
  $slcustom22=$_SESSION['ses_slcustom22'];
  $slcustom23=$_SESSION['ses_slcustom23'];
  $slcustom24=$_SESSION['ses_slcustom24'];
  $slcustom25=$_SESSION['ses_slcustom25'];
  $slcustom26=$_SESSION['ses_slcustom26'];
  $slcustom27=$_SESSION['ses_slcustom27'];
  $slcustom28=$_SESSION['ses_slcustom28'];
  $slcustom29=$_SESSION['ses_slcustom29'];
  $slcustom30=$_SESSION['ses_slcustom30'];
  $slcustom31=$_SESSION['ses_slcustom31'];
  $slcustom32=$_SESSION['ses_slcustom32'];
  $slcustom33=$_SESSION['ses_slcustom33'];
  $slcustom34=$_SESSION['ses_slcustom34'];
  $slcustom35=$_SESSION['ses_slcustom35'];
  $slcustom36=$_SESSION['ses_slcustom36'];
  $slcustom37=$_SESSION['ses_slcustom37'];
  $slcustom38=$_SESSION['ses_slcustom38'];
  $slcustom39=$_SESSION['ses_slcustom39'];
  $slcustom40=$_SESSION['ses_slcustom40'];
  $slcustom41=$_SESSION['ses_slcustom41'];
  $slcustom42=$_SESSION['ses_slcustom42'];
  $slcustom43=$_SESSION['ses_slcustom43'];
  $slcustom44=$_SESSION['ses_slcustom44'];
  $slcustom45=$_SESSION['ses_slcustom45'];
  $slcustom46=$_SESSION['ses_slcustom46'];
  $slcustom47=$_SESSION['ses_slcustom47'];
  $slcustom48=$_SESSION['ses_slcustom48'];
  $slcustom49=$_SESSION['ses_slcustom49'];
  $slcustom50=$_SESSION['ses_slcustom50'];
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
  return(true);
}
function sitelokdelete($deletectemplate,$deleteatemplate,$deleteredirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $deletehash=md5($SiteKey."1004".$slusername.session_id().$deletectemplate.$deleteatemplate.$deleteredirect);
  $deleteauth="1004,".$slusername.",".session_id().",".$deletectemplate.",".$deleteatemplate.",".$deleteredirect.",".$deletehash;
  $deleteauth = base64_encode($deleteauth);
  $deleteauth = rawurlencode($deleteauth);
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts['resource']."linkprocess.php?auth=".$deleteauth;
}
function sitelokaddgroup($group,$groupexpiry,$ctemplate,$atemplate,$redirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $hash=md5($SiteKey."1005".$slusername.session_id().$group.$groupexpiry.$ctemplate.$atemplate.$redirect);
  $auth="1005,".$slusername.",".session_id().",".$group.",".$groupexpiry.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
  $auth = base64_encode($auth);
  $auth = rawurlencode($auth);  
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts[resource]."linkprocess.php?auth=".$auth;
}
function sitelokremovegroup($group,$ctemplate,$atemplate,$redirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $hash=md5($SiteKey."1006".$slusername.session_id().$group.$ctemplate.$atemplate.$redirect);
  $auth="1006,".$slusername.",".session_id().",".$group.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
  $auth = base64_encode($auth);
  $auth = rawurlencode($auth);  
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts['resource']."linkprocess.php?auth=".$auth;
}
function sitelokreplacegroup($group,$newgroup,$groupexpiry,$ctemplate,$atemplate,$redirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $hash=md5($SiteKey."1007".$slusername.session_id().$group.$newgroup.$groupexpiry.$ctemplate.$atemplate.$redirect);
  $auth="1007,".$slusername.",".session_id().",".$group.",".$newgroup.",".$groupexpiry.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
  $auth = base64_encode($auth);
  $auth = rawurlencode($auth);  
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts['resource']."linkprocess.php?auth=".$auth;
}
function sitelokextendgroup($group,$groupexpiry,$expirytype,$ctemplate,$atemplate,$redirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $hash=md5($SiteKey."1008".$slusername.session_id().$group.$groupexpiry.$expirytype.$ctemplate.$atemplate.$redirect);
  $auth="1008,".$slusername.",".session_id().",".$group.",".$groupexpiry.",".$expirytype.",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
  $auth = base64_encode($auth);
  $auth = rawurlencode($auth);  
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts['resource']."linkprocess.php?auth=".$auth;
}
function siteloksendemail($ctemplate,$atemplate,$redirect)
{
  global $slusername,$SiteKey,$SitelokLocationURL;
  $hash=md5($SiteKey."1010".$slusername.session_id().$ctemplate.$atemplate.$redirect);
  $auth="1010,".$slusername.",".session_id().",".$ctemplate.",".$atemplate.",".$redirect.",".$hash;
  $auth = base64_encode($auth);
  $auth = rawurlencode($auth);  
  $lpurlparts=getUrlParts($SitelokLocationURL);    
  print "/".$lpurlparts[resource]."linkprocess.php?auth=".$auth;
}
function addgroupinput($group,$groupexpiry)
{
  global $SiteKey;
  if (session_id()=="")
    return;
  $hash=md5($SiteKey."1".session_id().$group.$groupexpiry);
  $auth="1".",".$group.",".$groupexpiry.",".$hash;
  $auth=base64_encode($auth);
  $auth=rawurlencode($auth);  
  print $auth;
}
function removegroupinput($group)
{
  global $SiteKey;
  if (session_id()=="")
    return;
  $hash=md5($SiteKey."2".session_id().$group);
  $auth="2".",".$group.",".$hash;
  $auth=base64_encode($auth);
  $auth=rawurlencode($auth);  
  print $auth;
}
function replacegroupinput($group,$newgroup,$groupexpiry)
{
  global $SiteKey;
  if (session_id()=="")
    return;
  $hash=md5($SiteKey."3".session_id().$group.$newgroup.$groupexpiry);
  $auth="3".",".$group.",".$newgroup.",".$groupexpiry.",".$hash;
  $auth=base64_encode($auth);
  $auth=rawurlencode($auth);  
  print $auth;
}
function extendgroupinput($group,$groupexpiry,$expirytype)
{
  global $SiteKey;
  if (session_id()=="")
    return;
  $hash=md5($SiteKey."4".session_id().$group.$groupexpiry.$expirytype);
  $auth="4".",".$group.",".$groupexpiry.",".$expirytype.",".$hash;
  $auth=base64_encode($auth);
  $auth=rawurlencode($auth);  
  print $auth;
}
function sl_ismemberof($g)
{
  global $slgroupname;
  if (!isset($slgroupname))
    return (false);
  $g=trim($g);  
  $i=array_search($g, $slgroupname);
  if (is_integer($i))
    return(true);
  // Also allow ALL group (if not checking for ADMIN) or ADMIN
  if ($g=="ADMIN")
    return(false);
  $i=array_search("ALL", $slgroupname);
  if (is_integer($i))
    return(true);
  $i=array_search("ADMIN", $slgroupname);
  if (is_integer($i))
    return(true);
  return (false);		
}
function sl_memberofexpires($g)
{
  global $slgroupname,$DateFormat,$slgroupexpiry;
  if (!isset($slgroupname))
    return (-1);
  $i=array_search($g, $slgroupname);
  if (is_integer($i))
  {
    $grpexp=$slgroupexpiry[$i];
    if ($grpexp=="Unlimited")
      return(0);
  	if ($DateFormat=="DDMMYY")
    {
			$day=intval(substr($grpexp,0,2));
			$month=intval(substr($grpexp,3,2));
			$year=intval(substr($grpexp,6,2))+2000;
    }
  	if ($DateFormat=="MMDDYY")
    {
			$month=intval(substr($grpexp,0,2));
			$day=intval(substr($grpexp,3,2));
			$year=intval(substr($grpexp,6,2))+2000;
    }
    $exptime=gmmktime(23,59,59,$month,$day,$year);
    return($exptime);
  }
  return (-1);  		
}
function sl_isactivememberof($g)
{
  global $slgroupname,$DateFormat,$slgroupexpiry;
  if (!isset($slgroupname))
    return (false);
  $i=array_search($g, $slgroupname);
  if (is_integer($i))
  {
    $grpexp=$slgroupexpiry[$i];
    if ($grpexp=="Unlimited")
      return(true);
  	if ($DateFormat=="DDMMYY")
    {
			$day=intval(substr($grpexp,0,2));
			$month=intval(substr($grpexp,3,2));
			$year=intval(substr($grpexp,6,2))+2000;
    }
  	if ($DateFormat=="MMDDYY")
    {
			$month=intval(substr($grpexp,0,2));
			$day=intval(substr($grpexp,3,2));
			$year=intval(substr($grpexp,6,2))+2000;
    }
    $exptime=gmmktime(23,59,59,$month,$day,$year);
    if (time()<$exptime)
      return(true);
    // Also allow ALL group (if not checking for ADMIN) or ADMIN
    if ($g=="ADMIN")
      return(false);
    $i=array_search("ADMIN", $slgroupname);
    if (!is_integer($i))
      $i=array_search("ALL", $slgroupname);
    if (is_integer($i))
    {
      $grpexp=$slgroupexpiry[$i];
      if ($grpexp=="Unlimited")
        return(true);
    	if ($DateFormat=="DDMMYY")
      {
  			$day=intval(substr($grpexp,0,2));
  			$month=intval(substr($grpexp,3,2));
  			$year=intval(substr($grpexp,6,2))+2000;
      }
    	if ($DateFormat=="MMDDYY")
      {
  			$month=intval(substr($grpexp,0,2));
  			$day=intval(substr($grpexp,3,2));
  			$year=intval(substr($grpexp,6,2))+2000;
      }
      $exptime=gmmktime(23,59,59,$month,$day,$year);
      if (time()<$exptime)
        return(true); 
    }        
  }
  return (false);  		
}
function sl_redirecttourl($u)
{
  header("Location: ".$u);
  exit;
}
function sl_setcustom($num,$data)
{
  global $DbHost,$DbName,$DbUser,$DbPassword,$DbTableName,$UsernameField,$slusername,$MessagePage;
  global $slusername,$slpassword,$slname,$slemail,$slusergroups,$sluserid;
  global $slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10;
  global $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20;
  global $slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30;
  global $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40;
  global $slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50;
  global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
  global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
  global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
  global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
  global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
	global $slnumplugins,$slpluginid,$slplugin_event_onModifyUser,$slplugin_event_onCheckModifyUser;

  // Give last chance to plugins and event handler to block changes
  $paramdata['oldusername']=$slusername;
  $paramdata['username']=$slusername;
  $paramdata['userid']=$sluserid;
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
  $paramdata['from']=0;                      
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onCheckModifyUser[$p]))
    {
      $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
      if ($res['ok']==false)
        return(false);
    } 
  }
  // Call eventhandler
  if (function_exists(sl_onCheckModifyUser))
  {
    $res=sl_onCheckModifyUser($paramdata);
    if ($res['ok']==false)
      return(false);
  }  
  $pid="slcustom".$num;
  $$pid=$data;
  $_SESSION['ses_slcustom'.$num]=$data;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
    return(false);
  $pid="Custom".$num."Field";
  $query="UPDATE ".$DbTableName." SET ".$$pid."=".sl_quote_smart($data)." WHERE ".$UsernameField."=".sl_quote_smart($slusername);
  $mysql_result=mysqli_query($mysql_link,$query);
  // Event point
  $paramdata['oldusername']=$slusername;
  $paramdata['username']=$slusername;
  $paramdata['userid']=$sluserid;
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
  $paramdata['from']=0;                        
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onModifyUser[$p]))
      call_user_func($slplugin_event_onModifyUser[$p],$slpluginid[$p],$paramdata);
  }
  // Call user event handler 
  if (function_exists("sl_onModifyUser"))
    sl_onModifyUser($paramdata);
  return(true);
}
function sl_getstartpage()
{
  // We use similar code in sitelokregister.php where this function can't be called
  global $slgroupname;
  global $slcustom1,$slcustom2,$slcustom3,$slcustom4,$slcustom5,$slcustom6,$slcustom7,$slcustom8,$slcustom9,$slcustom10;
  global $slcustom11,$slcustom12,$slcustom13,$slcustom14,$slcustom15,$slcustom16,$slcustom17,$slcustom18,$slcustom19,$slcustom20;
  global $slcustom21,$slcustom22,$slcustom23,$slcustom24,$slcustom25,$slcustom26,$slcustom27,$slcustom28,$slcustom29,$slcustom30;
  global $slcustom31,$slcustom32,$slcustom33,$slcustom34,$slcustom35,$slcustom36,$slcustom37,$slcustom38,$slcustom39,$slcustom40;
  global $slcustom41,$slcustom42,$slcustom43,$slcustom44,$slcustom45,$slcustom46,$slcustom47,$slcustom48,$slcustom49,$slcustom50;
  $startpage="";
  for ($g=0;$g<count($slgroupname);$g++)
  {
    $lgaction=$_SESSION['ses_slgrouploginaction_'.$slgroupname[$g]];
    if ((sl_isactivememberof($slgroupname[$g])) && (($lgaction=="URL") || (substr($lgaction,0,6)=="custom")))
    {
      if ($lgaction=="URL")
      {
        $startpage=$_SESSION['ses_slgrouploginvalue_'.$slgroupname[$g]];
        break;
      }  
      if (substr($lgaction,0,6)=="custom")
      {
        $pvar="sl".$lgaction;
        $startpage=$$pvar;
        break;
      }
    }
  }
  return($startpage);
}
function sl_cleandata($d)
{
  global $MetaCharSet;
  $d=htmlentities($d,ENT_QUOTES,strtoupper($MetaCharSet));  
  return($d);
}

function sl_uncleandata($d)
{
  $d=htmlspecialchars_decode($d,ENT_QUOTES);
  return($d);
}

function sl_storerequestpage()
{
  $page=$_SERVER['PHP_SELF'];  
  if ($_SERVER['REQUEST_URI']!="")
    $page=$_SERVER['REQUEST_URI'];
  else
  {
    if ($_SERVER['SCRIPT_NAME']!="")
    {
      $page=$_SERVER['SCRIPT_NAME'];
      if ($_SERVER['QUERY_STRING']!="")
        $page=$page."?".$_SERVER['QUERY_STRING'];
    }
  }
  $_SESSION['ses_sllastpage']=$page;
}

function sl_getmimetype($fn)
{
  $mt['.jpg']="image/jpeg";
  $mt['.gif']="image/gif";
  $mt['.gif']="image/gif";
  $mt['.htm']="text/html";
  $mt['.html']="text/html";
  $mt['.txt']="text/plain";
  $mt['.pdf']="application/pdf";
  $mt['.mpg']="video/mpeg";
  $mt['.mpeg']="video/mpeg";
  $mt['.rm']="audio/x-pn-realaudio";
  $mt['.wmv']="video/x-ms-wmv";
  $mt['.swf']="application/x-shockwave-flash";
  $mt['.mov']="video/quicktime";
  $mt['.asf']="video/x-ms-asf";
  $mt['.asx']="video/x-ms-asf";
  $mt['.rm']="audio/x-realaudio";
  $mt['.ram']="audio/x-pn-realaudio"; 
  $mt['.mp4']="video/quicktime"; 
  $mt['.xml']="application/xml";
  $mt['.cgm']="image/cgm";
  $mt['.flv']="video/x-flv";
  $mt['.m4v']="video/x-m4v";
  $mt['.mp3']="audio/mpeg";
  $mt['.png']="image/png";
  $mt['.rar']="application/x-rar-compressed";
  $mt['.zip']="application/zip";
  $mt['.ogg']="audio/ogg";
  $mt['.ogv']="video/ogg";
  $i=strrpos($fn,".");
  $ext=substr($fn,$i,strlen($fn)-$i);
  $ext=strtolower($ext);
  if (isset($mt[$ext]))
    $mimetype=$mt[$ext];
  else
    $mimetype="";
  return($mimetype);
}


?>