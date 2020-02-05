<?php
require_once("sitelokapi.php");
// Don't change message text here. Change the settings in slconfig.php if necessary
if (!defined('MSG_ACCDEN'))
  define("MSG_ACCDEN","Access Denied");
if (!defined('MSG_LINKAUTH'))
  define("MSG_LINKAUTH","Sorry this link failed. Authentication failed");
if (!defined('MSG_LINKEXP'))
  define("MSG_LINKEXP","Sorry but this link has expired");
if (!defined('MSG_USERAPP'))
  define("MSG_USERAPP","has been approved");
if (!defined('MSG_USERDIS'))
  define("MSG_USERDIS","has been disabled");
if (!defined('MSG_USERDEL'))
  define("MSG_USERDEL","has been permanently deleted");
if (!defined('MSG_NEWPASS'))
  define("MSG_NEWPASS","now has the password");
if (!defined('MSG_ACCOUNTUPDATE'))
  define("MSG_ACCOUNTUPDATE","Your account has been updated"); 
if (!defined('MSG_EMAILCONFIRM'))
  define("MSG_EMAILCONFIRM","Your email address has been set as");
if (!defined('MSG_EMAILCONFIRMFAILED'))
  define("MSG_EMAILCONFIRMFAILED","Your email address could not be set to");
if (!defined('MSG_USERNAMECONFIRM'))
  define("MSG_USERNAMECONFIRM","Your username has been set as");
if (!defined('MSG_USERNAMECONFIRMFAILED'))
  define("MSG_USERNAMECONFIRMFAILED","Your username could not be set to");
if (!defined('MSG_EMAILEXISTS'))
  define("MSG_EMAILEXISTS","Sorry this email address is already registered");
if (!defined('MSG_EMAILSENT'))
  define("MSG_EMAILSENT","An email has been sent to you");
   
$auth=$_REQUEST['auth'];
if (isset($auth))
{
  $auth = rawurldecode($auth);
  $auth=base64_decode($auth);
  $linkvars=explode(",",$auth);
  $function = trim($linkvars[0]);
  if ($function=="1")   // Approve user
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $ctemplate = trim($linkvars[3]);
    $atemplate = trim($linkvars[4]);    
    $redirect = trim($linkvars[5]);
    $hash = md5($SiteKey . $function . $username . $expiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[6]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"User cannot be approved - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired
    if ($expiry != 0)
    {
      $curtime = time();
      if ($curtime > $expiry)
      {
        sl_ShowMessage($MessagePage, MSG_LINKEXP);
        if (substr($LogDetails,1,1)=="Y")
    		  sl_AddToLog("Login Problem",$username,"User cannot be approved - link expired");
        exit;
      }
    }
    // Now enable account
    slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                  $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                  $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    slapi_modifyuser($username,$pass,"Yes",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    if ($_SESSION['ses_slusername']==$username)
      sl_UpdateUserVariables($username,true);                           
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, $username." ".MSG_USERAPP);
  	  exit;      
    } 
  }  
  if ($function=="2")   // Disable user
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $ctemplate = trim($linkvars[3]);
    $atemplate = trim($linkvars[4]);    
    $redirect = trim($linkvars[5]);
    $hash = md5($SiteKey . $function . $username . $expiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[6]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"User cannot be disabled - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired
    if ($expiry != 0)
    {
      $curtime = time();
      if ($curtime > $expiry)
      {
        sl_ShowMessage($MessagePage, MSG_LINKEXP);
        if (substr($LogDetails,1,1)=="Y")
    		  sl_AddToLog("Login Problem",$username,"User cannot be disabled - link expired");
        exit;
      }
    }
    // Now disable account
    slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                  $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                  $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    slapi_modifyuser($username,$pass,"No",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    if ($_SESSION['ses_slusername']==$username)
      sl_UpdateUserVariables($username,true);
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      sl_ShowMessage($MessagePage, "Can't connect to Mysql");
      exit;
    }
    $Query="SELECT ".$SessionField." FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
    $mysql_result=mysqli_query($mysql_link,$Query);
    if ($mysql_result==false)
    {
      mysqli_close($mysql_link);
      sl_ShowMessage($MessagePage, "User doesn't exist");
  	  exit;      
    }
    if ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $usersess=$row[$SessionField];        
      $ThisSession=session_id();
      session_id($usersess);
      @session_destroy();
      if ($SessionName!="")
        session_name($SessionName);
      session_id($ThisSession);
      session_start();     
    }
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, $username." ".MSG_USERDIS);
  	  exit;      
    } 
  }
  if ($function=="3")   // Activate new password
  {
    $username = trim($linkvars[1]);
    $existingpwhash = trim($linkvars[2]);
    $newpw = trim($linkvars[3]);
    $hash = md5($SiteKey . $function . $username . $existingpwhash . $newpw);
    $verifyhash = trim($linkvars[4]);
    if ($verifyhash == $hash)
    {
      // Check that previous password matches.
      $res=slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                    $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                    $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
      if ($res==1)
      {
        if ($existingpwhash==md5($pass.$SiteKey))
        {
          $passtomodify=$newpw;
          $res=slapi_modifyuser($username,$passtomodify,$enabled,$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                           $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                           $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
          if ($_SESSION['ses_slusername']==$username)
            sl_UpdateUserVariables($username,true);                                                        
          sl_ShowMessage($MessagePage, $username." ".MSG_NEWPASS." ".$newpw);
      	  exit;                                        
        }
      }                   
    }
    sl_ShowMessage($MessagePage, MSG_LINKAUTH);
    if (substr($LogDetails,1,1)=="Y")
	    sl_AddToLog("Login Problem",$username,"Password cannot be activated - authentication");
	  exit;
  }
  if (($function=="4") || ($function=="1004"))  // Delete user
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $ctemplate = trim($linkvars[3]);
    $atemplate = trim($linkvars[4]);    
    $redirect = trim($linkvars[5]);
    $hash = md5($SiteKey . $function . $username . $expiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[6]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"User cannot be deleted - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired (email) or session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"User cannot be deleted - session mismatch");
          exit;      
      }
    }
    else
    {
      if ($expiry != 0)
      {
        $curtime = time();
        if ($curtime > $expiry)
        {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"User cannot be deleted - link expired");
          exit;
        }
      }
    }
    // Clear users session if it is active
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      sl_ShowMessage($MessagePage, "Can't connect to Mysql");
      exit;
    }
    $Query="SELECT ".$SessionField." FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
    $mysql_result=mysqli_query($mysql_link,$Query);
    if ($mysql_result==false)
    {
      mysqli_close($mysql_link);
      sl_ShowMessage($MessagePage, "User doesn't exist");
  	  exit;      
    }
    if ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $usersess=$row[$SessionField];        
      $ThisSession=session_id();
      session_id($usersess);
      @session_destroy();
      if ($SessionName!="")
        session_name($SessionName);
      session_id($ThisSession);
      session_start();     
    }    
    // Now delete account
    slapi_deleteuser($username,$ctemplate,$atemplate,1);
    $_SESSION['ses_ConfigReload']="reload";                               
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, $username." ".MSG_USERDEL);
  	  exit;      
    } 
  }
  if (($function=="5") || ($function=="1005"))  // Add group
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $setgroup = trim($linkvars[3]);
    $setgroupexpiry = trim($linkvars[4]);   
    $ctemplate = trim($linkvars[5]);
    $atemplate = trim($linkvars[6]);    
    $redirect = trim($linkvars[7]);
    $hash = md5($SiteKey . $function . $username . $expiry . $setgroup . $setgroupexpiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[8]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Group cannot be added - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired (email) or session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be added - link expired");
          exit;      
      }
    }
    else
    {
      if ($expiry != 0)
      {
        $curtime = time();
        if ($curtime > $expiry)
        {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be added - session mismatch");
          exit;
        }
      }
    }
    slapi_addgroup($username,$setgroup,$setgroupexpiry,$ctemplate,$atemplate);
    if ($_SESSION['ses_slusername']==$username)
    {
      sl_UpdateUserVariables($username,true);
    }
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, MSG_ACCOUNTUPDATE);
  	  exit;      
    } 
  }
  if (($function=="6") || ($function=="1006"))   // Remove group
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $setgroup = trim($linkvars[3]);
    $ctemplate = trim($linkvars[4]);
    $atemplate = trim($linkvars[5]);    
    $redirect = trim($linkvars[6]);
    $hash = md5($SiteKey . $function . $username . $expiry . $setgroup . $setgroupexpiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[7]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Group cannot be removed - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired (email) or session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be removed - link expired");
          exit;      
      }
    }
    else
    {
      if ($expiry != 0)
      {
        $curtime = time();
        if ($curtime > $expiry)
        {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be removed - session mismatch");
          exit;
        }
      }
    }
    slapi_removegroup($username,$setgroup,$ctemplate,$atemplate);
    $_SESSION['ses_ConfigReload']="reload";                               
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, MSG_ACCOUNTUPDATE);
  	  exit;      
    } 
  }
  if (($function=="7") || ($function=="1007"))  // Replace group
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $setgroup = trim($linkvars[3]);
    $setnewgroup = trim($linkvars[4]);
    $setgroupexpiry = trim($linkvars[5]);   
    $ctemplate = trim($linkvars[6]);
    $atemplate = trim($linkvars[7]);    
    $redirect = trim($linkvars[8]);
    $hash = md5($SiteKey . $function . $username . $expiry . $setgroup . $setnewgroup . $setgroupexpiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[9]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Group cannot be replace - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired (email) or session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be replaced - link expired");
          exit;      
      }
    }
    else
    {
      if ($expiry != 0)
      {
        $curtime = time();
        if ($curtime > $expiry)
        {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Group cannot be replaced - session mismatch");
          exit;
        }
      }
    }
    slapi_replacegroup($username,$setgroup,$setnewgroup,$setgroupexpiry,$ctemplate,$atemplate);
    if ($_SESSION['ses_slusername']==$username)
      sl_UpdateUserVariables($username,true);                           
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, MSG_ACCOUNTUPDATE);
  	  exit;      
    } 
  }
  if (($function=="8") || ($function=="1008"))   // Extend Group
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);
    $setgroup = trim($linkvars[3]);
    $setgroupexpiry = trim($linkvars[4]); 
    $setexpirytype = trim($linkvars[5]);   
    $ctemplate = trim($linkvars[6]);
    $atemplate = trim($linkvars[7]);    
    $redirect = trim($linkvars[8]);
    $hash = md5($SiteKey . $function . $username . $expiry . $setgroup . $setgroupexpiry . $setexpirytype . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[9]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Expiry cannot be extended - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired (email) or session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Expiry cannot be extended - link expired");
          exit;      
      }
    }
    else
    {
      if ($expiry != 0)
      {
        $curtime = time();
        if ($curtime > $expiry)
        {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Expiry cannot be extended - session mismatch");
          exit;
        }
      }
    }
    slapi_extendgroup($username,$setgroup,$setgroupexpiry,$setexpirytype,$ctemplate,$atemplate);
    if ($_SESSION['ses_slusername']==$username)
      sl_UpdateUserVariables($username,true);                           
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, MSG_ACCOUNTUPDATE);
  	  exit;      
    } 
  }
  if ($function=="9")   // Verify Email
  {
    $username = trim($linkvars[1]);
    $existingemail = trim($linkvars[2]);
    $requestedemail = trim($linkvars[3]);   
    $updateusername = trim($linkvars[4]);
    $expiry = trim($linkvars[5]);
    $ctemplate = trim($linkvars[6]);
    $atemplate = trim($linkvars[7]);    
    $redirect = trim($linkvars[8]);
    $hash = md5($SiteKey . $function . $username . $existingemail . $requestedemail . $updateusername . $expiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[9]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Email cannot be verified - authentication");
  	  exit;
    }
    // auth is OK but we should now check if link expired
    if ($expiry != 0)
    {
      $curtime = time();
      if ($curtime > $expiry)
      {
        sl_ShowMessage($MessagePage, MSG_LINKEXP);
        if (substr($LogDetails,1,1)=="Y")
    		  sl_AddToLog("Login Problem",$username,"Email cannot be verified - link expired");
        exit;
      }
    }
    slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                  $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                  $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
    // If required make sure email is not already in use
    if (($requestedemail!=$email) && ($EmailUnique>0))
    {
      if (false!==slapi_getuserbyemail($requestedemail))
      {
        sl_ShowMessage($MessagePage, MSG_EMAILEXISTS);
        exit;              
      }
    }
    // Now update email address if existing email is still the same
    if (strtolower($existingemail)==strtolower($email))
    {
      if ($updateusername=="1")
        $res=slapi_changeusername($username,$requestedemail,"","",0);
      else
        $res=1;
      if ($res==1)
      {  
        if ($updateusername=="1")
          $newusername=$requestedemail;
        else
          $newusername=$username;  
        slapi_modifyuser($newusername,$pass,$enabled,$name,$requestedemail,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                         $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                         $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                                         
        sl_UpdateUserVariables($newusername,true);                           
        if ($redirect!="")
          header("Location: ".$redirect); 
        else
        {
          if ($updateusername=="1")
            sl_ShowMessage($MessagePage, MSG_USERNAMECONFIRM." ".$requestedemail);
          else
            sl_ShowMessage($MessagePage, MSG_EMAILCONFIRM." ".$requestedemail);
          exit;              
        }
      }
      else
      {
        // Change username failed
        if ($updateusername=="1")
          sl_ShowMessage($MessagePage, MSG_USERNAMECONFIRMFAILED);      
        else
          sl_ShowMessage($MessagePage, MSG_EMAILCONFIRMFAILED);                
        exit;
      }
    }
    else
    {
      if (strtolower($email)==strtolower($requestedemail))
      {
        if ($redirect!="")
          header("Location: ".$redirect); 
        else
        {
          if ($updateusername=="1")
            sl_ShowMessage($MessagePage, MSG_USERNAMECONFIRM." ".$requestedemail);
          else
            sl_ShowMessage($MessagePage, MSG_EMAILCONFIRM." ".$requestedemail);
          exit;              
        }  
      }  
      else
        if ($updateusername=="1")
          sl_ShowMessage($MessagePage, MSG_USERNAMECONFIRMFAILED);      
        else
          sl_ShowMessage($MessagePage, MSG_EMAILCONFIRMFAILED);                
  	  exit;      
    } 
  } 
  if ($function=="1010")  // Send email to user
  {
    $username = trim($linkvars[1]);
    $expiry = trim($linkvars[2]);    
    $ctemplate = trim($linkvars[3]);
    $atemplate = trim($linkvars[4]);    
    $redirect = trim($linkvars[5]);
    $hash = md5($SiteKey . $function . $username . $expiry . $ctemplate . $atemplate . $redirect);
    $verifyhash = trim($linkvars[6]);
    if ($verifyhash != $hash)
    {
      sl_ShowMessage($MessagePage, MSG_LINKAUTH);
      if (substr($LogDetails,1,1)=="Y")
  	    sl_AddToLog("Login Problem",$username,"Email cannot be sent - authentication");
  	  exit;
    }
    // auth is OK but we should now check if session id doesn't match (web)
    if ($function>"1000")
    {
      if (session_id()!=$expiry)
      {
          sl_ShowMessage($MessagePage, MSG_LINKEXP);
          if (substr($LogDetails,1,1)=="Y")
      		  sl_AddToLog("Login Problem",$username,"Email cannot be sent - session mismatch");
          exit;      
      }
    }
    // Email user (and admin if required)
    slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                  $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                  $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
    if ($ctemplate!="")
    {
  	  if (sl_ReadEmailTemplate($ctemplate,$subject,$mailBody,$htmlformat))
  	    sl_SendEmail($email,$mailBody,$subject,$htmlformat,$username,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
  	    $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
        $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
  	}
    if ($atemplate!="")
    {
  	  if (sl_ReadEmailTemplate($atemplate,$subject,$mailBody,$htmlformat))
    		sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$username,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
    		$custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
    		$custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
    }
    if ($redirect!="")
      header("Location: ".$redirect); 
    else
    {
      sl_ShowMessage($MessagePage, $username." ".MSG_EMAILSENT);
  	  exit;      
    } 
  }                            
}
else
{
  if (defined('MSG_ACCDEN'))
    sl_ShowMessage($MessagePage,MSG_ACCDEN);
  else
    sl_ShowMessage($MessagePage, "Access Denied");
}
?>