<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sitelok (Password Version) V4.0                                                                    	 //
// Copyright 2003-2013 Vibralogix                                                                        //
// You are licensed to use this on one domain only. Please contact us for extra licenses                 //
// www.vibralogix.com							                              								                         //
///////////////////////////////////////////////////////////////////////////////////////////////////////////
@error_reporting (E_ERROR);
require_once("sitelokapi.php");
// Don't change message text here. Change the settings in slconfig.php if necessary
if (!defined('MSG_FORMTAMP'))
  define("MSG_FORMTAMP","It appears this form has been tampered with");
if (!defined('MSG_CANTJOIN'))
  define("MSG_CANTJOIN","You cannot join this usergroup");
if (!defined('MSG_ENTEREMAIL'))
  define("MSG_ENTEREMAIL","Please enter your valid email address");
if (!defined('MSG_EMAILVER'))
  define("MSG_EMAILVER","Your email addresses do not match");
if (!defined('MSG_ENTERNAME'))
  define("MSG_ENTERNAME","Please enter your name");
if (!defined('MSG_PASS5')) 
  define("MSG_PASS5","Password must be at least 5 characters long");
if (!defined('MSG_PASSNG')) 
  define("MSG_PASSNG","Password contains invalid characters");
if (!defined('MSG_PASSVER'))
  define("MSG_PASSVER","Verify password does not match");
if (!defined('MSG_ENTERPASS'))
  define("MSG_ENTERPASS","Please enter your password");
if (!defined('MSG_USERNG'))
  define("MSG_USERNG","Username contains invalid characters");
if (!defined('MSG_ENTERUSER'))
  define("MSG_ENTERUSER","Please enter your username");
if (!defined('MSG_TURING1'))
  define("MSG_TURING1","Turing code did not match");
if (!defined('MSG_USEREXISTS'))
  define("MSG_USEREXISTS","Sorry this username already exists");
if (!defined('MSG_EMAILEXISTS'))
  define("MSG_EMAILEXISTS","Sorry this email address is already registered");
if (!defined('MSG_DBPROB'))
  define("MSG_DBPROB","There was a database problem");
if (!defined('MSG_UPLOADERROR'))
  define("MSG_UPLOADERROR","File upload failed");
if (!defined('MSG_UPLOADTYPE'))
  define("MSG_UPLOADTYPE","Files of this type cannot be uploaded");

if (!empty($_REQUEST))
{
  reset($_REQUEST);
  while(list($namepair, $valuepair) = each($_REQUEST))
  {
    $namepair=strtolower($namepair);
  	if ($namepair=="sldeleteexisting") $sldeleteexisting=0;
  }
}

$allowed="";
$enabled="";
$hash="";
$verifypassword="";
$verifyemail="";
$page="";
$group="";
$expiry="";
$clientemail="";
$adminemail="";
$usergroup="";
$username="";
$password="";
$name="";
$email="";
$custom1="";
$custom2="";
$custom3="";
$custom4="";
$custom5="";
$custom6="";
$custom7="";
$custom8="";
$custom9="";
$custom10="";
$custom11="";
$custom12="";
$custom13="";
$custom14="";
$custom15="";
$custom16="";
$custom17="";
$custom18="";
$custom19="";
$custom20="";
$custom21="";
$custom22="";
$custom23="";
$custom24="";
$custom25="";
$custom26="";
$custom27="";
$custom28="";
$custom29="";
$custom30="";
$custom31="";
$custom32="";
$custom33="";
$custom34="";
$custom35="";
$custom36="";
$custom37="";
$custom38="";
$custom39="";
$custom40="";
$custom41="";
$custom42="";
$custom43="";
$custom44="";
$custom45="";
$custom46="";
$custom47="";
$custom48="";
$custom49="";
$custom50="";

$regaction=$_REQUEST['regaction'];
if ($regaction=="registernew")
{
  // Mod for WP which doesn't allow name as a form field
  if ($_REQUEST['fullname']!="")
  $_REQUEST['name']=$_REQUEST['fullname'];
  $registermsg="";
  $allowed=sl_uncleandata($_REQUEST['allowed']);
  $enabled=sl_uncleandata($_REQUEST['enabled']);
  $hash=sl_uncleandata($_REQUEST['hash']);
  $usrname=sl_uncleandata($_REQUEST['username']);
  $password=sl_uncleandata($_REQUEST['password']);
  $verifypassword=sl_uncleandata($_REQUEST['verifypassword']);
  $email=sl_uncleandata($_REQUEST['email']);
  $verifyemail=sl_uncleandata($_REQUEST['verifyemail']);
  $page=sl_uncleandata($_REQUEST['page']);
  $group=sl_uncleandata($_REQUEST['group']);
  $expiry=sl_uncleandata($_REQUEST['expiry']);
  $clientemail=sl_uncleandata($_REQUEST['clientemail']);
  $adminemail=sl_uncleandata($_REQUEST['adminemail']);
  $usergroup=sl_uncleandata($_REQUEST['usergroup']);
  // Handle array fields 
  for ($k=1;$k<51;$k++)
  {
    $cusvar="custom".$k;
    $cusdelimvar="slcustom".$k."delimiter";
    if (!isset($$cusdelimvar))
      $$cusdelimvar=",";
    if (is_array($_REQUEST[$cusvar]))
    {    
      $_REQUEST[$cusvar]=implode($$cusdelimvar,$_REQUEST[$cusvar]);  
    }  
  }
  // Check that input is allowed
  if ((isset($_REQUEST['username'])) && (substr($allowed,0,1)=="Y"))
  	$username=sl_uncleandata($_REQUEST['username']);
  if ((isset($_REQUEST['password'])) && (substr($allowed,1,1)=="Y"))
  	$password=sl_uncleandata($_REQUEST['password']);
  if ((isset($_REQUEST['name'])) && (substr($allowed,2,1)=="Y"))
  	$name=sl_uncleandata(stripslashes($_REQUEST['name']));
  if ((isset($_REQUEST['email'])) && (substr($allowed,3,1)=="Y"))
  	$email=sl_uncleandata($_REQUEST['email']);
  if ((isset($_REQUEST['custom1'])) && (substr($allowed,4,1)=="Y"))
  	$custom1=sl_uncleandata(stripslashes($_REQUEST['custom1']));
  if ((isset($_REQUEST['custom2'])) && (substr($allowed,5,1)=="Y"))
  	$custom2=sl_uncleandata(stripslashes($_REQUEST['custom2']));
  if ((isset($_REQUEST['custom3'])) && (substr($allowed,6,1)=="Y"))
  	$custom3=sl_uncleandata(stripslashes($_REQUEST['custom3']));
  if ((isset($_REQUEST['custom4'])) && (substr($allowed,7,1)=="Y"))
  	$custom4=sl_uncleandata(stripslashes($_REQUEST['custom4']));
  if ((isset($_REQUEST['custom5'])) && (substr($allowed,8,1)=="Y"))
  	$custom5=sl_uncleandata(stripslashes($_REQUEST['custom5']));
  if ((isset($_REQUEST['custom6'])) && (substr($allowed,9,1)=="Y"))
  	$custom6=sl_uncleandata(stripslashes($_REQUEST['custom6']));
  if ((isset($_REQUEST['custom7'])) && (substr($allowed,10,1)=="Y"))
  	$custom7=sl_uncleandata(stripslashes($_REQUEST['custom7']));
  if ((isset($_REQUEST['custom8'])) && (substr($allowed,11,1)=="Y"))
  	$custom8=sl_uncleandata(stripslashes($_REQUEST['custom8']));
  if ((isset($_REQUEST['custom9'])) && (substr($allowed,12,1)=="Y"))
  	$custom9=sl_uncleandata(stripslashes($_REQUEST['custom9']));
  if ((isset($_REQUEST['custom10'])) && (substr($allowed,13,1)=="Y"))
  	$custom10=sl_uncleandata(stripslashes($_REQUEST['custom10']));
  if ((isset($_REQUEST['custom11'])) && (substr($allowed,14,1)=="Y"))
  	$custom11=sl_uncleandata(stripslashes($_REQUEST['custom11']));
  if ((isset($_REQUEST['custom12'])) && (substr($allowed,15,1)=="Y"))
  	$custom12=sl_uncleandata(stripslashes($_REQUEST['custom12']));
  if ((isset($_REQUEST['custom13'])) && (substr($allowed,16,1)=="Y"))
  	$custom13=sl_uncleandata(stripslashes($_REQUEST['custom13']));
  if ((isset($_REQUEST['custom14'])) && (substr($allowed,17,1)=="Y"))
  	$custom14=sl_uncleandata(stripslashes($_REQUEST['custom14']));
  if ((isset($_REQUEST['custom15'])) && (substr($allowed,18,1)=="Y"))
  	$custom15=sl_uncleandata(stripslashes($_REQUEST['custom15']));
  if ((isset($_REQUEST['custom16'])) && (substr($allowed,19,1)=="Y"))
  	$custom16=sl_uncleandata(stripslashes($_REQUEST['custom16']));
  if ((isset($_REQUEST['custom17'])) && (substr($allowed,20,1)=="Y"))
  	$custom17=sl_uncleandata(stripslashes($_REQUEST['custom17']));
  if ((isset($_REQUEST['custom18'])) && (substr($allowed,21,1)=="Y"))
  	$custom18=sl_uncleandata(stripslashes($_REQUEST['custom18']));
  if ((isset($_REQUEST['custom19'])) && (substr($allowed,22,1)=="Y"))
  	$custom19=sl_uncleandata(stripslashes($_REQUEST['custom19']));
  if ((isset($_REQUEST['custom20'])) && (substr($allowed,23,1)=="Y"))
  	$custom20=sl_uncleandata(stripslashes($_REQUEST['custom20']));
  if ((isset($_REQUEST['custom21'])) && (substr($allowed,24,1)=="Y"))
  	$custom21=sl_uncleandata(stripslashes($_REQUEST['custom21']));
  if ((isset($_REQUEST['custom22'])) && (substr($allowed,25,1)=="Y"))
  	$custom22=sl_uncleandata(stripslashes($_REQUEST['custom22']));
  if ((isset($_REQUEST['custom23'])) && (substr($allowed,26,1)=="Y"))
  	$custom23=sl_uncleandata(stripslashes($_REQUEST['custom23']));
  if ((isset($_REQUEST['custom24'])) && (substr($allowed,27,1)=="Y"))
  	$custom24=sl_uncleandata(stripslashes($_REQUEST['custom24']));
  if ((isset($_REQUEST['custom25'])) && (substr($allowed,28,1)=="Y"))
  	$custom25=sl_uncleandata(stripslashes($_REQUEST['custom25']));
  if ((isset($_REQUEST['custom26'])) && (substr($allowed,29,1)=="Y"))
  	$custom26=sl_uncleandata(stripslashes($_REQUEST['custom26']));
  if ((isset($_REQUEST['custom27'])) && (substr($allowed,30,1)=="Y"))
  	$custom27=sl_uncleandata(stripslashes($_REQUEST['custom27']));
  if ((isset($_REQUEST['custom28'])) && (substr($allowed,31,1)=="Y"))
  	$custom28=sl_uncleandata(stripslashes($_REQUEST['custom28']));
  if ((isset($_REQUEST['custom29'])) && (substr($allowed,32,1)=="Y"))
  	$custom29=sl_uncleandata(stripslashes($_REQUEST['custom29']));
  if ((isset($_REQUEST['custom30'])) && (substr($allowed,33,1)=="Y"))
  	$custom30=sl_uncleandata(stripslashes($_REQUEST['custom30']));
  if ((isset($_REQUEST['custom31'])) && (substr($allowed,34,1)=="Y"))
  	$custom31=sl_uncleandata(stripslashes($_REQUEST['custom31']));
  if ((isset($_REQUEST['custom32'])) && (substr($allowed,35,1)=="Y"))
  	$custom32=sl_uncleandata(stripslashes($_REQUEST['custom32']));
  if ((isset($_REQUEST['custom33'])) && (substr($allowed,36,1)=="Y"))
  	$custom33=sl_uncleandata(stripslashes($_REQUEST['custom33']));
  if ((isset($_REQUEST['custom34'])) && (substr($allowed,37,1)=="Y"))
  	$custom34=sl_uncleandata(stripslashes($_REQUEST['custom34']));
  if ((isset($_REQUEST['custom35'])) && (substr($allowed,38,1)=="Y"))
  	$custom35=sl_uncleandata(stripslashes($_REQUEST['custom35']));
  if ((isset($_REQUEST['custom36'])) && (substr($allowed,39,1)=="Y"))
  	$custom36=sl_uncleandata(stripslashes($_REQUEST['custom36']));
  if ((isset($_REQUEST['custom37'])) && (substr($allowed,40,1)=="Y"))
  	$custom37=sl_uncleandata(stripslashes($_REQUEST['custom37']));
  if ((isset($_REQUEST['custom38'])) && (substr($allowed,41,1)=="Y"))
  	$custom38=sl_uncleandata(stripslashes($_REQUEST['custom38']));
  if ((isset($_REQUEST['custom39'])) && (substr($allowed,42,1)=="Y"))
  	$custom39=sl_uncleandata(stripslashes($_REQUEST['custom39']));
  if ((isset($_REQUEST['custom40'])) && (substr($allowed,43,1)=="Y"))
  	$custom40=sl_uncleandata(stripslashes($_REQUEST['custom40']));
  if ((isset($_REQUEST['custom41'])) && (substr($allowed,44,1)=="Y"))
  	$custom41=sl_uncleandata(stripslashes($_REQUEST['custom41']));
  if ((isset($_REQUEST['custom42'])) && (substr($allowed,45,1)=="Y"))
  	$custom42=sl_uncleandata(stripslashes($_REQUEST['custom42']));
  if ((isset($_REQUEST['custom43'])) && (substr($allowed,46,1)=="Y"))
  	$custom43=sl_uncleandata(stripslashes($_REQUEST['custom43']));
  if ((isset($_REQUEST['custom44'])) && (substr($allowed,47,1)=="Y"))
  	$custom44=sl_uncleandata(stripslashes($_REQUEST['custom44']));
  if ((isset($_REQUEST['custom45'])) && (substr($allowed,48,1)=="Y"))
  	$custom45=sl_uncleandata(stripslashes($_REQUEST['custom45']));
  if ((isset($_REQUEST['custom46'])) && (substr($allowed,49,1)=="Y"))
  	$custom46=sl_uncleandata(stripslashes($_REQUEST['custom46']));
  if ((isset($_REQUEST['custom47'])) && (substr($allowed,50,1)=="Y"))
  	$custom47=sl_uncleandata(stripslashes($_REQUEST['custom47']));
  if ((isset($_REQUEST['custom48'])) && (substr($allowed,51,1)=="Y"))
  	$custom48=sl_uncleandata(stripslashes($_REQUEST['custom48']));
  if ((isset($_REQUEST['custom49'])) && (substr($allowed,52,1)=="Y"))
  	$custom49=sl_uncleandata(stripslashes($_REQUEST['custom49']));
  if ((isset($_REQUEST['custom50'])) && (substr($allowed,53,1)=="Y"))
  	$custom50=sl_uncleandata(stripslashes($_REQUEST['custom50']));
  // If username blank then use email as username
	$emailasuser=false;
  if ((!isset($_REQUEST['username'])) || (substr($allowed,0,1)=="N"))
  {
  	$username=$email;
  	$emailasuser=true;
  }
  if (md5($group.$expiry.$clientemail.$adminemail.$allowed.$enabled.$SiteKey)!=$hash)
  	$registermsg=MSG_FORMTAMP;

   // User already exists. If the user is just in the TEMP usergroup then we can delete them
  $tmpres=slapi_getuser($username,$cr,$ps,$en,$nm,$em,$gs,$cu1,$cu2,$cu3,$cu4,$cu5,$cu6,$cu7,$cu8,$cu9,$cu10,
  $cu11,$cu12,$cu13,$cu14,$cu15,$cu16,$cu17,$cu18,$cu19,$cu20,$cu21,$cu22,$cu23,$cu24,$cu25,$cu26,$cu27,$cu28,$cu29,$cu30,
  $cu31,$cu32,$cu33,$cu34,$cu35,$cu36,$cu37,$cu38,$cu39,$cu40,$cu41,$cu42,$cu43,$cu44,$cu45,$cu46,$cu47,$cu48,$cu49,$cu50);
  $gsa=explode("^",$gs);
  $oktodelete=false;
  if (count($gsa)==1)
  {
    $gsn=strtok($gsa[0],":");
    if ($gsn=="TEMP")
      $oktodelete=true;
  }
  // If required ($sldeleteexisting==1) we can delete user if all their groups are expired
  if (($sldeleteexisting==1) && (!$oktodelete))
  {
    $oktodelete=true;
  	for ($k=0;$k<count($gsa);$k++)
  	{
     	$usrgrp=strtok($gsa[$k],":");
      $grpexp=trim(strtok(":"));
      if ($usrgrp=="TEMP")
        continue;        
      if ($grpexp!="")
      {
      	if ($DateFormat=="DDMMYY")
          if (time()<gmmktime(23,59,59,intval(substr($grpexp,2,2)),intval(substr($grpexp,0,2)),intval(substr($grpexp,4,2))+2000))
            $oktodelete=false;
      	if ($DateFormat=="MMDDYY")
          if (time()<gmmktime(23,59,59,intval(substr($grpexp,0,2)),intval(substr($grpexp,2,2)),intval(substr($grpexp,4,2))+2000))
            $oktodelete=false;
      }
      else
      {
        $oktodelete=false;
      }
  	}
	}
  if ($oktodelete)      
    slapi_deleteuser($username,"","",0);
  // Check Turing code if required
  if (($registermsg=="") && ($TuringRegister==1))
  {
    if ($SessionName!="")
      session_name($SessionName);    
    session_start();
    $turingmatch=false;
    $turingtested=false;
    // First see if plugin will verify code 
    // Call event handlers
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
    if (($turingtested) && (!$turingmatch))
    	$registermsg=MSG_TURING1;
    if (!$turingtested)
    {
      if ((strtolower($_SESSION['ses_slturingcode'])==strtolower(trim($_REQUEST['turing']))) && ($_SESSION['ses_slturingcode']!=""))
      {
        $turingmatch=true;
        $_SESSION['ses_slturingcode']="";
      }
      else if ((strtolower($_SESSION['ses_slpreviousturingcode'])==strtolower(trim($_REQUEST['turing']))) && ($_SESSION['ses_slpreviousturingcode']!=""))
      {
        $turingmatch=true;
        $_SESSION['ses_slpreviousturingcode']="";
      }
      if (!$turingmatch)
      	$registermsg=MSG_TURING1;
    }	
  } 
  // Validate username
  if (($registermsg=="") && ($username==""))
  {
    if ($emailasuser)
  	  $registermsg=MSG_ENTEREMAIL;
    else
  	  $registermsg=MSG_ENTERUSER;
  }	
  // Call plugin and eventhandler validation function
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (($registermsg=="") && (function_exists($slplugin_event_onUsernameValidate[$p])))
      $registermsg=call_user_func($slplugin_event_onUsernameValidate[$p],$slpluginid[$p],$username,0);
  }
  if ($registermsg=="")
  {
    if (function_exists("sl_onUsernameValidate"))
      $registermsg=sl_onUsernameValidate($username,0);
  }
  // check username is set and doesn't contain invalid characters
  if (($registermsg=="") && (strspn($username, $ValidUsernameChars) != strlen($username)))
  	$registermsg=MSG_USERNG;
  
  // Validate password only if allowed
  if (($registermsg=="") && ($password=="") && (substr($allowed,1,1)=="Y"))
  	$registermsg=MSG_ENTERPASS;
  // If password blank then generate password
  if (($registermsg=="") && (substr($allowed,1,1)=="N"))
  {
    $password=sl_CreatePassword($RandomPasswordMask);
	  $verifypassword=$password;
  }
  if (substr($allowed,1,1)=="Y")
  { 
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($registermsg=="") && (function_exists($slplugin_event_onPasswordValidate[$p])))
        $registermsg=call_user_func($slplugin_event_onPasswordValidate[$p],$slpluginid[$p],$password,0);
    }
    if ($registermsg=="")
    {
      if (function_exists("sl_onPasswordValidate"))
        $registermsg=sl_onPasswordValidate($password,0);
    }
    if (($registermsg=="") && (strspn($password, $ValidPasswordChars) != strlen($password)))
    	$registermsg=MSG_PASSNG;  
    if (($registermsg=="") && (strlen($password)<5))
    	$registermsg=MSG_PASS5;     
    if (($registermsg=="") && (isset($_REQUEST['verifypassword'])))
    {  	
      if ($password!=$verifypassword)
      	$registermsg=MSG_PASSVER;
    }
  }
  // Validate name only if allowed
  if (substr($allowed,2,1)=="Y")
  {
    if (($registermsg=="") && ($name==""))
    	$registermsg=MSG_ENTERNAME;
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($registermsg=="") && (function_exists($slplugin_event_onNameValidate[$p])))
        $registermsg=call_user_func($slplugin_event_onNameValidate[$p],$slpluginid[$p],$name,0);
    }
    if ($registermsg=="")
    {
      if (function_exists("sl_onNameValidate"))
        $registermsg=sl_onNameValidate($name,0);
    }
	}
  // Validate email address if allowed
  if (substr($allowed,3,1)=="Y")
  {
  	if (($registermsg=="") && (sl_validate_email($email)==false))
    	$registermsg=MSG_ENTEREMAIL;
    // Check if email address already used if required
    if (($registermsg=="") && ($EmailUnique>0))
    {
      if (false!==slapi_getuserbyemail($email))
        $registermsg=MSG_EMAILEXISTS;
    }
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($registermsg=="") && (function_exists($slplugin_event_onEmailValidate[$p])))
        $registermsg=call_user_func($slplugin_event_onEmailValidate[$p],$slpluginid[$p],$email,0);
    }
    if ($registermsg=="")
    {
      if (function_exists("sl_onEmailValidate"))
        $registermsg=sl_onEmailValidate($email,0);
    } 	
    if (($registermsg=="") && (isset($_REQUEST['verifyemail'])))
    {
      if ($verifyemail!=$email)
        $registermsg=MSG_EMAILVER;
    }
  }	
  	
  // If file(s) uploaded then check for errors
  for ($k=1;$k<51;$k++)
  {
    $cusvar="custom".$k;
    if (($registermsg=="") && ($_FILES[$cusvar]['name']!="") && ($_FILES[$cusvar]['error']>0))
      $registermsg=MSG_UPLOADERROR.$_FILES[$cusvar]['error'];
  }
  // Validate custom fields where required 
  $uploadprefix=(string)time()."_";
  // If profile folder exists in $FileLocation then use that
  if (is_dir($FileLocation."profile"))
    $uploadprefix="profile/".$uploadprefix;              
  for ($k=1;$k<51;$k++)
  {
    // Only validate if field allowed
    if (substr($allowed,$k+3,1)!="Y")
      continue;
    $cusvar="custom".$k;
    $cusvar2="Custom".$k."Validate";
    $cusvar3="CustomTitle".$k;
    $cusvar4="sl_onCustom".$k."Validate";
    $cusvar5="slplugin_event_onCustom".$k."Validate";
    // First check file type if uploading (even if field has no validation)
    if ($_FILES[$cusvar]['name'])
    {
      $ext=sl_fileextension($_FILES[$cusvar]['name']);
      $ext=trim(strtolower($ext));
      if (($registermsg=="") && (!is_integer(array_search($ext,$sl_alloweduploads))))
        $registermsg=MSG_UPLOADTYPE;
    }  
    // Validate for plugins  
    for ($p=0;$p<$slnumplugins;$p++)   
    {
      if (($registermsg=="") && (function_exists(${$cusvar5}[$p])))
      {
        if ($_FILES[$cusvar]['name'])
          $registermsg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$_FILES[$cusvar]['name'],$$cusvar3,0);
        else  
          $registermsg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$$cusvar,$$cusvar3,0);
      }
    }    
    // Validate using eventhandlers          
    if ((substr($allowed,$k+3,1)=="Y") && (($$cusvar2==1) || ($$cusvar2==3)))
    {
      if ($registermsg=="")
      {
        if ($_FILES[$cusvar]['name'])
          $registermsg=call_user_func($cusvar4,$_FILES[$cusvar]['name'],$$cusvar3,0);
        else
          $registermsg=call_user_func($cusvar4,$$cusvar,$$cusvar3,0);
      }
    }
    // Add upload prefix ready for final checks on value
    if ((substr($allowed,$k+3,1)=="Y") && ($_FILES[$cusvar]['name']!=""))
      $$cusvar=$uploadprefix.$_FILES[$cusvar]['name'];
  }

  // Convert groups to an array if necessary  
  $groupsarray=explode(",",$group);
  for($k=0;$k<count($groupsarray);$k++)
    $groupsarray[$k]=trim($groupsarray[$k]);
  $expiriesarray=explode(",",$expiry);
  for($k=0;$k<count($expiriesarray);$k++)
    $expiriesarray[$k]=trim($expiriesarray[$k]);
  // If usergroup is set then check it is allowed group  
  if (isset($_REQUEST['usergroup']))
  {
    if (!is_array($usergroup))
      $usergrouparray=explode(",",$usergroup);
    else
      $usergrouparray=$usergroup;            
    for($k=0;$k<count($usergrouparray);$k++)
      $usergrouparray[$k]=trim($usergrouparray[$k]);      
    for ($j=0;$j<count($usergrouparray);$j++)
    {
      $match=false;
      for ($k=0;$k<count($groupsarray);$k++)
      {
        if ($usergrouparray[$j]==$groupsarray[$k])
        {
          $match=true;
          break;
        }  
      }
      if (($registermsg=="") && ($match==false))
      {
        $registermsg=MSG_CANTJOIN;
      }  
    }  
  }
  else
  {
    $usergrouparray=$groupsarray;
  }
  // Setup group names and expiry dates as required
  $grouptouse="";
  for ($k=0;$k<count($usergrouparray);$k++)
  {
    if (count($expiriesarray)==1)
      $expirytouse=$expiriesarray[0];
    else
    {
      for ($j=0;$j<count($groupsarray);$j++)
      {
        if ($usergrouparray[$k]==$groupsarray[$j])
        {
          $expirytouse=$expiriesarray[$j];
          break;
        }  
      }
    }  
    if ($grouptouse!="")
      $grouptouse.="^";
    $grouptouse.=$usergrouparray[$k];
		if ($expirytouse>0)
		{
      if (strlen($expirytouse)==6)
        $expirystr=":".$expirytouse;
      else
      {   		
  			if ($DateFormat=="DDMMYY")
  	      $expirystr=":".gmdate("dmy",time()+$expirytouse*86400);
  			if ($DateFormat=="MMDDYY")
  	      $expirystr=":".gmdate("mdy",time()+$expirytouse*86400);
	    }
		}
    else
      $expirystr="";
    $grouptouse.=$expirystr;      
  }
   
  if ($registermsg=="")
  {
    // Call event handlers and plugins to get final approval
    $paramdata['allowed']=$allowed;
    $paramdata['username']=$username;
    $paramdata['userid']="";    
    $paramdata['password']=$password;
    $paramdata['enabled']=$enabled;
    $paramdata['name']=$name;
    $paramdata['email']=$email;
    $paramdata['usergroups']=$grouptouse;
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
      if (function_exists($slplugin_event_onCheckRegister[$p]))
      {
        $registermsg=call_user_func($slplugin_event_onCheckRegister[$p],$slpluginid[$p],$paramdata);
        if ($registermsg!="")
          break;
      }  
    }
    if ($registermsg=="")
    {
      // Call user event handler
      if (function_exists("sl_onCheckRegister"))
        $registermsg=sl_onCheckRegister($paramdata);      
    }  
  }
  if ($registermsg=="")
  {
    // Now call onCheckAddUser for plugins and eventhandlers (very similar to onCheckRegister)
    // This is called in the api function anyway but we cal it first to get any returned message
    // Call plugin event
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if ($registermsg=="")
      {
        if (function_exists($slplugin_event_onCheckAddUser[$p]))
        {
          $res=call_user_func($slplugin_event_onCheckAddUser[$p],$slpluginid[$p],$paramdata);
          if ($res['ok']==false)
            $registermsg=$res['message'];
        } 
      }  
    }
  }
  if ($registermsg=="")
  {
    // Call eventhandler
    if (function_exists("sl_onCheckAddUser"))
    {
      $res=sl_onCheckAddUser($paramdata);
      if ($res['ok']==false)
        $registermsg=$res['message'];
    }  
  }     	
  // if all ok so far try to create user
  if ($registermsg=="")
  {
	  $res=slapi_adduser($username,$password,$enabled,$name,$email,$grouptouse,$clientemail,$adminemail,0,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
    $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
    $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
	  if ($res==0)
	  {      
  	  if (!$emailasuser)
	    	$registermsg=MSG_USEREXISTS;
	    else
	  	 $registermsg=MSG_EMAILEXISTS;
	  }
	  if ($res==-1)
	  	$registermsg=MSG_DBPROB;
	  if ($res==1)
	  {
      // Upload files
      for ($k=1;$k<51;$k++)
      {
        $cusvar="custom".$k;
        if (substr($allowed,$k+3,1)=="Y")
        {
          if ($_FILES[$cusvar]['name']!="")
          {
            // Move uploaded file
            $uploadedok=@move_uploaded_file($_FILES[$cusvar]['tmp_name'], $FileLocation.$$cusvar);
            if (!$uploadedok)
            {
              $registermsg=MSG_UPLOADERROR.$_FILES[$cusvar]['error'];
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
        	}  
        }	
      }           
	    // Log registration
      if (substr($LogDetails,9,1)=="Y")
  	    sl_AddToLog("Register",$username,"");
	    // If $page has any variables in it then replace them
      $page=str_replace("!!!username!!!",urlencode($username),$page);
      $page=str_replace("!!!ordercustom!!!",sl_ordercustom($username,trim(strtok($_SERVER['REMOTE_ADDR'],","))),$page);      	   
      $page=str_replace("!!!password!!!",urlencode($password),$page);	   
      $page=str_replace("!!!passwordclue!!!",urlencode(sl_passwordclue($password)),$page);	   
      $page=str_replace("!!!passwordhash!!!",sl_passwordhash(1,$password),$page);	   
      $page=str_replace("!!!name!!!",urlencode($name),$page);	   
      $page=str_replace("!!!email!!!",urlencode($email),$page);	   
      $page=str_replace("!!!custom1!!!",urlencode($custom1),$page);	   
      $page=str_replace("!!!custom2!!!",urlencode($custom2),$page);	   
      $page=str_replace("!!!custom3!!!",urlencode($custom3),$page);	   
      $page=str_replace("!!!custom4!!!",urlencode($custom4),$page);	   
      $page=str_replace("!!!custom5!!!",urlencode($custom5),$page);	   
      $page=str_replace("!!!custom6!!!",urlencode($custom6),$page);	   
      $page=str_replace("!!!custom7!!!",urlencode($custom7),$page);	   
      $page=str_replace("!!!custom8!!!",urlencode($custom8),$page);	   
      $page=str_replace("!!!custom9!!!",urlencode($custom9),$page);	   
      $page=str_replace("!!!custom10!!!",urlencode($custom10),$page);	   	    
      $page=str_replace("!!!custom11!!!",urlencode($custom11),$page);	   
      $page=str_replace("!!!custom12!!!",urlencode($custom12),$page);	   
      $page=str_replace("!!!custom13!!!",urlencode($custom13),$page);	   
      $page=str_replace("!!!custom14!!!",urlencode($custom14),$page);	   
      $page=str_replace("!!!custom15!!!",urlencode($custom15),$page);	   
      $page=str_replace("!!!custom16!!!",urlencode($custom16),$page);	   
      $page=str_replace("!!!custom17!!!",urlencode($custom17),$page);	   
      $page=str_replace("!!!custom18!!!",urlencode($custom18),$page);	   
      $page=str_replace("!!!custom19!!!",urlencode($custom19),$page);	   
      $page=str_replace("!!!custom20!!!",urlencode($custom20),$page);	   	    
      $page=str_replace("!!!custom21!!!",urlencode($custom21),$page);	   
      $page=str_replace("!!!custom22!!!",urlencode($custom22),$page);	   
      $page=str_replace("!!!custom23!!!",urlencode($custom23),$page);	   
      $page=str_replace("!!!custom24!!!",urlencode($custom24),$page);	   
      $page=str_replace("!!!custom25!!!",urlencode($custom25),$page);	   
      $page=str_replace("!!!custom26!!!",urlencode($custom26),$page);	   
      $page=str_replace("!!!custom27!!!",urlencode($custom27),$page);	   
      $page=str_replace("!!!custom28!!!",urlencode($custom28),$page);	   
      $page=str_replace("!!!custom29!!!",urlencode($custom29),$page);	   
      $page=str_replace("!!!custom30!!!",urlencode($custom30),$page);	   	    
      $page=str_replace("!!!custom31!!!",urlencode($custom31),$page);	   
      $page=str_replace("!!!custom32!!!",urlencode($custom32),$page);	   
      $page=str_replace("!!!custom33!!!",urlencode($custom33),$page);	   
      $page=str_replace("!!!custom34!!!",urlencode($custom34),$page);	   
      $page=str_replace("!!!custom35!!!",urlencode($custom35),$page);	   
      $page=str_replace("!!!custom36!!!",urlencode($custom36),$page);	   
      $page=str_replace("!!!custom37!!!",urlencode($custom37),$page);	   
      $page=str_replace("!!!custom38!!!",urlencode($custom38),$page);	   
      $page=str_replace("!!!custom39!!!",urlencode($custom39),$page);	   
      $page=str_replace("!!!custom40!!!",urlencode($custom40),$page);	   	    
      $page=str_replace("!!!custom41!!!",urlencode($custom41),$page);	   
      $page=str_replace("!!!custom42!!!",urlencode($custom42),$page);	   
      $page=str_replace("!!!custom43!!!",urlencode($custom43),$page);	   
      $page=str_replace("!!!custom44!!!",urlencode($custom44),$page);	   
      $page=str_replace("!!!custom45!!!",urlencode($custom45),$page);	   
      $page=str_replace("!!!custom46!!!",urlencode($custom46),$page);	   
      $page=str_replace("!!!custom47!!!",urlencode($custom47),$page);	   
      $page=str_replace("!!!custom48!!!",urlencode($custom48),$page);	   
      $page=str_replace("!!!custom49!!!",urlencode($custom49),$page);	   
      $page=str_replace("!!!custom50!!!",urlencode($custom50),$page);
      
      // Get usergroup redirect page
      // We can't use sl_getstartpage here as the user is not yet logged in
      $grpredpage="";
      $grparray=explode(",",$grouptouse);
      for ($g=0;$g<count($grparray);$g++)
      {
        $grp=strtok($grparray[$g],":");
        $lgaction=$_SESSION['ses_slgrouploginaction_'.$grp];
        if (($lgaction=="URL") || (substr($lgaction,0,6)=="custom"))
        {
          if ($lgaction=="URL")
          {
            $grpredpage=$_SESSION['ses_slgrouploginvalue_'.$grp];
            break;
          }  
          if (substr($lgaction,0,6)=="custom")
          {
            $pvar="custom".$lgaction;
            $grpredpage=$$pvar;
            break;
          }
        }
      }
      if (false===strpos($grpredpage,"?"))
        $page=str_replace("!!!groupstartpagelogin!!!",$grpredpage."?username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);          
      else  
        $page=str_replace("!!!groupstartpagelogin!!!",$grpredpage."&username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);
      if ((!isset($_SESSION['ses_sllastpage'])) || ($_SESSION['ses_sllastpage']==""))
      {
        // Send user to usergroups redirect page
        $page=str_replace("!!!autopage!!!",$grpredpage,$page);          
        if (false===strpos($grpredpage,"?"))
          $page=str_replace("!!!autopagelogin!!!",$grpredpage."?username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);          
        else  
          $page=str_replace("!!!autopagelogin!!!",$grpredpage."&username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);
      } 
      else
      {
        // Try to send user back to last requested secure page
        $page=str_replace("!!!autopage!!!",$_SESSION['ses_sllastpage'],$page);          
        if (false===strpos($_SESSION['ses_sllastpage'],"?"))
          $page=str_replace("!!!autopagelogin!!!",$_SESSION['ses_sllastpage']."?username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);          
        else  
          $page=str_replace("!!!autopagelogin!!!",$_SESSION['ses_sllastpage']."&username=".urlencode($username)."&password=".sl_passwordhash(1,$password),$page);
      }  
      header("Location: ".$page);      
	   	    
/*
	    print "  <html>\n";
	    print "  <head>\n";
	    print "  </head>\n";
	    print "  <body>\n";
	    print "  <script language=\"javascript\" type=\"text/javascript\">\n";
	    print "  <!-- JavaScript\n";
	    print "    window.location.replace(\"$page\")\n";
	    print "  // - JavaScript - -->\n";
	    print "  </script>\n";
	    print "  </body>\n";
	    print "  </html>\n";
*/
	  	exit;
	  }
  }
}

// Clean input data before displaying for prefill
$allowed=sl_cleandata($allowed);
$enabled=sl_cleandata($enabled);
$hash=sl_cleandata($hash);
$username=sl_cleandata($username);
$password=sl_cleandata($password);
$verifypassword=sl_cleandata($verifypassword);
$email=sl_cleandata($email);
$verifyemail=sl_cleandata($verifyemail);
$page=sl_cleandata($page);
$group=sl_cleandata($group);
$expiry=sl_cleandata($expiry);
$clientemail=sl_cleandata($clientemail);
$adminemail=sl_cleandata($adminemail);
$usergroup=sl_cleandata($usergroup);
$username=sl_cleandata($username);
$password=sl_cleandata($password);
$name=sl_cleandata($name);
for ($k=1;$k<51;$k++)
{
  $cusvar="custom".$k;
  $$cusvar=sl_cleandata($$cusvar);    
}      

// Now call onRegisterPageAccess for plugins and eventhandlers
// Call plugin event
$paramdata=array();
for ($p=0;$p<$slnumplugins;$p++)
{
  if (function_exists($slplugin_event_onRegisterPageAccess[$p]))
    call_user_func($slplugin_event_onRegisterPageAccess[$p],$slpluginid[$p],$paramdata);
}
// Call user event handler
if (function_exists("sl_onRegisterPageAccess"))
  sl_onRegisterPageAccess($paramdata);       


function registeruser($group,$expiry,$page,$clientemail,$adminemail,$enabled="Yes",$allowed="YNYYNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN")
{
	global $SiteKey;
	// To allow for backward compatibility $allowed could be parameter 6 instead of 7.
	if ((strlen($enabled)==14) || (strlen($enabled)==54))
	{
	  $allowed=$enabled;
	  $enabled="Yes";
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
	$allowed=strtoupper($allowed);  
	$enabled=preg_replace("/.*yes.*/i","Yes",$enabled);
	$enabled=preg_replace("/.*no.*/i","No",$enabled);
	print "<input type=\"hidden\" name=\"regaction\" value=\"registernew\">\n";
	print "<input type=\"hidden\" name=\"page\" value=\"$page\">\n";
	print "<input type=\"hidden\" name=\"group\" value=\"$group\">\n";
	print "<input type=\"hidden\" name=\"expiry\" value=\"$expiry\">\n";
	print "<input type=\"hidden\" name=\"clientemail\" value=\"$clientemail\">\n";
	print "<input type=\"hidden\" name=\"adminemail\" value=\"$adminemail\">\n";
	print "<input type=\"hidden\" name=\"allowed\" value=\"$allowed\">\n";
	print "<input type=\"hidden\" name=\"enabled\" value=\"$enabled\">\n";	
  $hash=md5($group.$expiry.$clientemail.$adminemail.$allowed.$enabled.$SiteKey);
	print "<input type=\"hidden\" name=\"hash\" value=\"$hash\">\n";
}
?>