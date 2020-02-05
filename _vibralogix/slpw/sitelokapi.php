<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// Sitelok (Password Version)  V4.0                                                                   	 //
// Copyright 2003-2013 Vibralogix                                                                        //
// You are licensed to use this on one domain only. Please contact us for extra licenses                 //
// www.vibralogix.com																														                         //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
@error_reporting (E_ERROR);
require_once("getconfig.php");
////////////////////////////////////////////////////////////////////////////////////
// slapi_getuser                                                                  //
// Retrieves data for a specific user                                             //
// Return 1 if found, 0 if not found or -1 if database problem                    //
////////////////////////////////////////////////////////////////////////////////////
  function slapi_getuser($user,&$created,&$pass,&$enabled,&$name,&$email,&$groups,&$custom1,&$custom2,&$custom3,&$custom4,&$custom5,&$custom6,&$custom7,&$custom8,&$custom9,&$custom10,
                         &$custom11,&$custom12,&$custom13,&$custom14,&$custom15,&$custom16,&$custom17,&$custom18,&$custom19,&$custom20,
                         &$custom21,&$custom22,&$custom23,&$custom24,&$custom25,&$custom26,&$custom27,&$custom28,&$custom29,&$custom30,
                         &$custom31,&$custom32,&$custom33,&$custom34,&$custom35,&$custom36,&$custom37,&$custom38,&$custom39,&$custom40,
                         &$custom41,&$custom42,&$custom43,&$custom44,&$custom45,&$custom46,&$custom47,&$custom48,&$custom49,&$custom50)
  {
  	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$CreatedField,$UsernameField,$PasswordField,$EnabledField;
  	global $NameField,$EmailField,$UsergroupsField;
  	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
  	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
  	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
  	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
  	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
  	if ($user=="")
  	  return(0);
  	$pass="";
  	$enabled="";
  	$name="";
  	$email="";
  	$groups="";
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    	return(-1);
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
    if ($mysql_result!=false)
    {
    	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
      if ($row!=false)
      {
  	    $created=$row[$CreatedField];
  	    $user=$row[$UsernameField];
  	    $pass=$row[$PasswordField];
  	    $name=$row[$NameField];
  	    $enabled=$row[$EnabledField];
  	    $email=$row[$EmailField];
  	    $groups=$row[$UsergroupsField];
  	    $custom1=$row[$Custom1Field];
  	    $custom2=$row[$Custom2Field];
  	    $custom3=$row[$Custom3Field];
  	    $custom4=$row[$Custom4Field];
  	    $custom5=$row[$Custom5Field];
  	    $custom6=$row[$Custom6Field];
  	    $custom7=$row[$Custom7Field];
  	    $custom8=$row[$Custom8Field];
  	    $custom9=$row[$Custom9Field];
  	    $custom10=$row[$Custom10Field];
  	    $custom11=$row[$Custom11Field];
  	    $custom12=$row[$Custom12Field];
  	    $custom13=$row[$Custom13Field];
  	    $custom14=$row[$Custom14Field];
  	    $custom15=$row[$Custom15Field];
  	    $custom16=$row[$Custom16Field];
  	    $custom17=$row[$Custom17Field];
  	    $custom18=$row[$Custom18Field];
  	    $custom19=$row[$Custom19Field];
  	    $custom20=$row[$Custom20Field];
  	    $custom21=$row[$Custom21Field];
  	    $custom22=$row[$Custom22Field];
  	    $custom23=$row[$Custom23Field];
  	    $custom24=$row[$Custom24Field];
  	    $custom25=$row[$Custom25Field];
  	    $custom26=$row[$Custom26Field];
  	    $custom27=$row[$Custom27Field];
  	    $custom28=$row[$Custom28Field];
  	    $custom29=$row[$Custom29Field];
  	    $custom30=$row[$Custom30Field];
  	    $custom31=$row[$Custom31Field];
  	    $custom32=$row[$Custom32Field];
  	    $custom33=$row[$Custom33Field];
  	    $custom34=$row[$Custom34Field];
  	    $custom35=$row[$Custom35Field];
  	    $custom36=$row[$Custom36Field];
  	    $custom37=$row[$Custom37Field];
  	    $custom38=$row[$Custom38Field];
  	    $custom39=$row[$Custom39Field];
  	    $custom40=$row[$Custom40Field];
  	    $custom41=$row[$Custom41Field];
  	    $custom42=$row[$Custom42Field];
  	    $custom43=$row[$Custom43Field];
  	    $custom44=$row[$Custom44Field];
  	    $custom45=$row[$Custom45Field];
  	    $custom46=$row[$Custom46Field];
  	    $custom47=$row[$Custom47Field];
  	    $custom48=$row[$Custom48Field];
  	    $custom49=$row[$Custom49Field];
  	    $custom50=$row[$Custom50Field];
  	 	  //mysqli_close($mysql_link);
    		return(1);
      }
      else
      {
  	    //mysqli_close($mysql_link);
  	    return(0);
      }
    }
    else
    {
      //mysqli_close($mysql_link);
    	return(0);
    }
  }


////////////////////////////////////////////////////////////////////////////////////
// slapi_adduser                                                                  //
// Add new user                                                                   //
// Return 1 if successful, 0 if not or -1 if database problem                     //
////////////////////////////////////////////////////////////////////////////////////
function slapi_adduser($user,$pass,$enabled,$name,$email,$groups,$clientemail,$adminemail,$logit,$custom1="",$custom2="",$custom3="",$custom4="",$custom5="",$custom6="",$custom7="",$custom8="",$custom9="",$custom10="",
                       $custom11="",$custom12="",$custom13="",$custom14="",$custom15="",$custom16="",$custom17="",$custom18="",$custom19="",$custom20="",
                       $custom21="",$custom22="",$custom23="",$custom24="",$custom25="",$custom26="",$custom27="",$custom28="",$custom29="",$custom30="",
                       $custom31="",$custom32="",$custom33="",$custom34="",$custom35="",$custom36="",$custom37="",$custom38="",$custom39="",$custom40="",
                       $custom41="",$custom42="",$custom43="",$custom44="",$custom45="",$custom46="",$custom47="",$custom48="",$custom49="",$custom50="")
  {
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$SelectedField,$CreatedField,$UsernameField;
	global $PasswordField,$EnabledField,$NameField,$EmailField,$UsergroupsField,$SiteEmail;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
	global $MD5passwords,$LogDetails;
	global $SiteKey;
	global $ValidPasswordChars,$ValidUsernameChars;
	global $slnumplugins,$slpluginid,$slplugin_event_onAddUser,$slplugin_event_onCheckAddUser,$EmailUnique;	
	if (($user=="") || ($pass=="") || ($enabled=="") || ($name=="") || ($email=="") || ($groups==""))
	  return(0);
  // Remove illegal characters from fields
  $user=sl_swapillegalchars($ValidUsernameChars,"",$user);
  $pass=sl_swapillegalchars($ValidPasswordChars,"",$pass);
	$en=strtolower($enabled);
	if (($en=="yes") || ($en=="y"))
		$enabled="Yes";
	if (($en=="no") || ($en=="n"))
		$enabled="No";
	if (($en!="no") && ($en!="n") && ($en!="yes") && ($en!="y"))
		$enabled="Yes";
	$selected="No";
	$created=gmdate("ymd");
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  // If email must be unique check if already used
  if ($EmailUnique==2)
  {
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($email));
    if ($mysql_result===false)
      return(-1);
    $num = mysqli_num_rows($mysql_result);
    if ($num>0)
      return(0);
  }  	
  // Give plugins and event handler final word on whether user can be added	 	
  // Event point
  $paramdata['username']=$user;
  $paramdata['userid']="";  // Not yet known
  $paramdata['password']=$pass;
  $paramdata['enabled']=$enabled;
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
  $paramdata['from']=0;
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onCheckAddUser[$p]))
    {
      $res=call_user_func($slplugin_event_onCheckAddUser[$p],$slpluginid[$p],$paramdata);
      if ($res['ok']==false)
        return(0);
    }  
  }
  if (function_exists("sl_onCheckAddUser"))
    $res=sl_onCheckAddUser($paramdata);
  if ($res['ok']==false)
     return(0);
  $passwordtouse=$pass;
  if (($MD5passwords) && (!sl_ismd5hash($pass)))
    $passwordtouse=md5($pass.$SiteKey);
  $Query="INSERT INTO ".$DbTableName." (".$SelectedField.",".$CreatedField.",".$UsernameField.",".$PasswordField.
  ",".$EnabledField.",".$NameField.",".$EmailField.",".$UsergroupsField.",".$Custom1Field.",".$Custom2Field.
  ",".$Custom3Field.",".$Custom4Field.",".$Custom5Field.",".$Custom6Field.",".$Custom7Field.",".$Custom8Field.
  ",".$Custom9Field.",".$Custom10Field.",".$Custom11Field.",".$Custom12Field.",".$Custom13Field.",".$Custom14Field.",".$Custom15Field.
  ",".$Custom16Field.",".$Custom17Field.",".$Custom18Field.",".$Custom19Field.",".$Custom20Field.",".$Custom21Field.",".$Custom22Field.
  ",".$Custom23Field.",".$Custom24Field.",".$Custom25Field.",".$Custom26Field.",".$Custom27Field.",".$Custom28Field.",".$Custom29Field.
  ",".$Custom30Field.",".$Custom31Field.",".$Custom32Field.",".$Custom33Field.",".$Custom34Field.",".$Custom35Field.",".$Custom36Field.    
  ",".$Custom37Field.",".$Custom38Field.",".$Custom39Field.",".$Custom40Field.",".$Custom41Field.",".$Custom42Field.",".$Custom43Field.
  ",".$Custom44Field.",".$Custom45Field.",".$Custom46Field.",".$Custom47Field.",".$Custom48Field.",".$Custom49Field.",".$Custom50Field.
  ") VALUES(".sl_quote_smart($selected).",".sl_quote_smart($created).",".sl_quote_smart($user).",".sl_quote_smart($passwordtouse).",".sl_quote_smart($enabled).
  ",".sl_quote_smart($name).",".sl_quote_smart($email).",".sl_quote_smart($groups).",".sl_quote_smart($custom1).",".sl_quote_smart($custom2).",".sl_quote_smart($custom3).",".sl_quote_smart($custom4).",".sl_quote_smart($custom5).
  ",".sl_quote_smart($custom6).",".sl_quote_smart($custom7).",".sl_quote_smart($custom8).",".sl_quote_smart($custom9).",".sl_quote_smart($custom10).
  ",".sl_quote_smart($custom11).",".sl_quote_smart($custom12).",".sl_quote_smart($custom13).",".sl_quote_smart($custom14).",".sl_quote_smart($custom15).
  ",".sl_quote_smart($custom16).",".sl_quote_smart($custom17).",".sl_quote_smart($custom18).",".sl_quote_smart($custom19).",".sl_quote_smart($custom20).
  ",".sl_quote_smart($custom21).",".sl_quote_smart($custom22).",".sl_quote_smart($custom23).",".sl_quote_smart($custom24).",".sl_quote_smart($custom25).
  ",".sl_quote_smart($custom26).",".sl_quote_smart($custom27).",".sl_quote_smart($custom28).",".sl_quote_smart($custom29).",".sl_quote_smart($custom30).
  ",".sl_quote_smart($custom31).",".sl_quote_smart($custom32).",".sl_quote_smart($custom33).",".sl_quote_smart($custom34).",".sl_quote_smart($custom35).
  ",".sl_quote_smart($custom36).",".sl_quote_smart($custom37).",".sl_quote_smart($custom38).",".sl_quote_smart($custom39).",".sl_quote_smart($custom40).
  ",".sl_quote_smart($custom41).",".sl_quote_smart($custom42).",".sl_quote_smart($custom43).",".sl_quote_smart($custom44).",".sl_quote_smart($custom45).
  ",".sl_quote_smart($custom46).",".sl_quote_smart($custom47).",".sl_quote_smart($custom48).",".sl_quote_smart($custom49).",".sl_quote_smart($custom50).")";    
  $mysql_result=mysqli_query($mysql_link,$Query);
  $usernotunique=false;
  if ($mysql_result==false)
    $usernotunique=true;
  //mysqli_close($mysql_link);
  if ($mysql_result==false)
  	return(0);
  $userid=mysqli_insert_id($mysql_link);	
  if ($clientemail!="")
  {
	  if (sl_ReadEmailTemplate($clientemail,$subject,$mailBody,$htmlformat))
	    sl_SendEmail($email,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
	    $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
      $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
	}
  if ($adminemail!="")
  {
	  if (sl_ReadEmailTemplate($adminemail,$subject,$mailBody,$htmlformat))
  		sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
  		$custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
  		$custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
  }
  if (($logit==1) && (substr($LogDetails,8,1)=="Y"))
    sl_AddToLog("API",$user,"User added");
  // Event point
  $paramdata['username']=$user;
  $paramdata['userid']=$userid;
  $paramdata['password']=$pass;
  $paramdata['enabled']=$enabled;
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
  $paramdata['from']=0;
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onAddUser[$p]))
      call_user_func($slplugin_event_onAddUser[$p],$slpluginid[$p],$paramdata);
  }
  if (function_exists("sl_onAddUser"))
    sl_onAddUser($paramdata);
  return(1);
}
////////////////////////////////////////////////////////////////////////////////////
// slapi_modifyuser                                                               //
// Modifies data for a specific user                                              //
// Return 1 if successful, 0 if not or -1 if database problem                     //
////////////////////////////////////////////////////////////////////////////////////
function slapi_modifyuser($user,$pass,$enabled,$name,$email,$groups,$clientemail,$adminemail,$logit,$custom1="",$custom2="",$custom3="",$custom4="",$custom5="",$custom6="",$custom7="",$custom8="",$custom9="",$custom10="",
                          $custom11="",$custom12="",$custom13="",$custom14="",$custom15="",$custom16="",$custom17="",$custom18="",$custom19="",$custom20="",
                          $custom21="",$custom22="",$custom23="",$custom24="",$custom25="",$custom26="",$custom27="",$custom28="",$custom29="",$custom30="",
                          $custom31="",$custom32="",$custom33="",$custom34="",$custom35="",$custom36="",$custom37="",$custom38="",$custom39="",$custom40="",
                          $custom41="",$custom42="",$custom43="",$custom44="",$custom45="",$custom46="",$custom47="",$custom48="",$custom49="",$custom50="")
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$SelectedField,$CreatedField,$UsernameField;
	global $PasswordField,$EnabledField,$NameField,$EmailField,$UsergroupsField,$SiteEmail,$IdField;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
  global $MD5passwords,$LogDetails;
	global $SiteKey;
	global $ValidPasswordChars,$ValidUsernameChars;
	global $slnumplugins,$slpluginid,$slplugin_event_onModifyUser,$slplugin_event_onCheckModifyUser,$EmailUnique;
	// Remove illegal characters from fields
  $user=sl_swapillegalchars($ValidUsernameChars,"",$user);
  $pass=sl_swapillegalchars($ValidPasswordChars,"",$pass);
	if (($user=="") || ($pass=="") || ($enabled=="") || ($name=="") || ($email==""))
    return(0);
	$en=strtolower($enabled);
	if (($en=="yes") || ($en=="y"))
		$enabled="Yes";
	if (($en=="no") || ($en=="n"))
		$enabled="No";
	if (($en!="no") && ($en!="n") && ($en!="yes") && ($en!="y"))
		$enabled="Yes";
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  // If email must be unique check if already used
  if ($EmailUnique==2)
  {
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($email)." AND ".$UsernameField."!=".sl_quote_smart($user));
    if ($mysql_result===false)
      return(-1);
    $num = mysqli_num_rows($mysql_result);
    if ($num>0)
      return(0);
  }  	  	
  // Give plugins and event handler final word on whether user can be added	 	
  // Event point
  $paramdata['userid']="";
  $paramdata['username']=$user;
  $paramdata['oldusername']=$user;
  $paramdata['password']=$pass;
  $paramdata['enabled']=$enabled;
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
  $paramdata['from']=0;                      
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onCheckModifyUser[$p]))
    {
      $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
      if ($res['ok']==false)
        return(0);
    }  
  }
  if (function_exists("sl_onCheckModifyUser"))
    $res=sl_onCheckModifyUser($paramdata);
  if ($res['ok']==false)
     return(0);
  $passwordtouse=$pass;
  if (($MD5passwords) && (!sl_ismd5hash($pass)))
  $passwordtouse=md5($pass.$SiteKey);
  $Query="UPDATE ".$DbTableName." SET ".$UsernameField."=".sl_quote_smart($user).", ".$PasswordField."=".sl_quote_smart($passwordtouse).", ".
  $Custom1Field."=".sl_quote_smart($custom1).", ".$Custom2Field."=".sl_quote_smart($custom2).", ".$Custom3Field."=".sl_quote_smart($custom3).", ".
  $Custom4Field."=".sl_quote_smart($custom4).", ".$Custom5Field."=".sl_quote_smart($custom5).", ".$Custom6Field."=".sl_quote_smart($custom6).", ".
  $Custom7Field."=".sl_quote_smart($custom7).", ".$Custom8Field."=".sl_quote_smart($custom8).", ".$Custom9Field."=".sl_quote_smart($custom9).", ".$Custom10Field."=".sl_quote_smart($custom10).", ".
  $Custom11Field."=".sl_quote_smart($custom11).", ".$Custom12Field."=".sl_quote_smart($custom12).", ".$Custom13Field."=".sl_quote_smart($custom13).", ".
  $Custom14Field."=".sl_quote_smart($custom14).", ".$Custom15Field."=".sl_quote_smart($custom15).", ".$Custom16Field."=".sl_quote_smart($custom16).", ".
  $Custom17Field."=".sl_quote_smart($custom17).", ".$Custom18Field."=".sl_quote_smart($custom18).", ".$Custom19Field."=".sl_quote_smart($custom19).", ".$Custom20Field."=".sl_quote_smart($custom20).", ".
  $Custom21Field."=".sl_quote_smart($custom21).", ".$Custom22Field."=".sl_quote_smart($custom22).", ".$Custom23Field."=".sl_quote_smart($custom23).", ".
  $Custom24Field."=".sl_quote_smart($custom24).", ".$Custom25Field."=".sl_quote_smart($custom25).", ".$Custom26Field."=".sl_quote_smart($custom26).", ".
  $Custom27Field."=".sl_quote_smart($custom27).", ".$Custom28Field."=".sl_quote_smart($custom28).", ".$Custom29Field."=".sl_quote_smart($custom29).", ".$Custom30Field."=".sl_quote_smart($custom30).", ".
  $Custom31Field."=".sl_quote_smart($custom31).", ".$Custom32Field."=".sl_quote_smart($custom32).", ".$Custom33Field."=".sl_quote_smart($custom33).", ".
  $Custom34Field."=".sl_quote_smart($custom34).", ".$Custom35Field."=".sl_quote_smart($custom35).", ".$Custom36Field."=".sl_quote_smart($custom36).", ".
  $Custom37Field."=".sl_quote_smart($custom37).", ".$Custom38Field."=".sl_quote_smart($custom38).", ".$Custom39Field."=".sl_quote_smart($custom39).", ".$Custom40Field."=".sl_quote_smart($custom40).", ".
  $Custom41Field."=".sl_quote_smart($custom41).", ".$Custom42Field."=".sl_quote_smart($custom42).", ".$Custom43Field."=".sl_quote_smart($custom43).", ".
  $Custom44Field."=".sl_quote_smart($custom44).", ".$Custom45Field."=".sl_quote_smart($custom45).", ".$Custom46Field."=".sl_quote_smart($custom46).", ".
  $Custom47Field."=".sl_quote_smart($custom47).", ".$Custom48Field."=".sl_quote_smart($custom48).", ".$Custom49Field."=".sl_quote_smart($custom49).", ".$Custom50Field."=".sl_quote_smart($custom50).", ".
  $EnabledField."=".sl_quote_smart($enabled).", ".$NameField."=".sl_quote_smart($name).", ".$EmailField."=".sl_quote_smart($email).", ".$UsergroupsField."=".sl_quote_smart($groups).
  " WHERE ".$UsernameField."=".sl_quote_smart($user);
  $mysql_result=mysqli_query($mysql_link,$Query);
  //mysqli_close($mysql_link);
  if ($mysql_result==false)
  	return(0);
  if ($clientemail!="")
  {
	  if (sl_ReadEmailTemplate($clientemail,$subject,$mailBody,$htmlformat))
	    sl_SendEmail($email,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
      $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
      $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);	    
	}
  if ($adminemail!="")
  {
	  if (sl_ReadEmailTemplate($adminemail,$subject,$mailBody,$htmlformat))
  		sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
      $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
      $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
  }
  if (($logit==1) && (substr($LogDetails,8,1)=="Y"))
    sl_AddToLog("API",$user,"User details modified");
  // Event point
  // Get auto increment id of user modified
  $mysql_result=mysql_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
  $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);	
  $paramdata['userid']=$row[$IdField];
  $paramdata['username']=$user;
  $paramdata['oldusername']=$user;
  $paramdata['password']=$pass;
  $paramdata['enabled']=$enabled;
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
  return(1);
}
////////////////////////////////////////////////////////////////////////////////////
// slapi_deleteuser                                                               //
// Deletes a specific user                                                        //
// Return 1 if found, 0 if not found or -1 if database problem                    //
////////////////////////////////////////////////////////////////////////////////////
function slapi_deleteuser($user,$clientemail,$adminemail,$logit)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField,$PasswordField,$EnabledField;
	global $NameField,$EmailField,$UsergroupsField,$SiteEmail,$IdField;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
	global $LogDetails,$slplugin_event_onDeleteUser,$slnumplugins;
	if ($user=="")
	  return(0);
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
  if ($mysql_result!=false)
  {
  	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
    if ($row!=false)
    {
	    $userid=$row[$IdField];    
	    $pass=$row[$PasswordField];
	    $name=$row[$NameField];
	    $enabled=$row[$EnabledField];
	    $email=$row[$EmailField];
	    $groups=$row[$UsergroupsField];
      $custom1=$row[$Custom1Field];
      $custom2=$row[$Custom2Field];
      $custom3=$row[$Custom3Field];
      $custom4=$row[$Custom4Field];
      $custom5=$row[$Custom5Field];
      $custom6=$row[$Custom6Field];
      $custom7=$row[$Custom7Field];
      $custom8=$row[$Custom8Field];
      $custom9=$row[$Custom9Field];
      $custom10=$row[$Custom10Field];
	    $custom11=$row[$Custom11Field];
	    $custom12=$row[$Custom12Field];
	    $custom13=$row[$Custom13Field];
	    $custom14=$row[$Custom14Field];
	    $custom15=$row[$Custom15Field];
	    $custom16=$row[$Custom16Field];
	    $custom17=$row[$Custom17Field];
	    $custom18=$row[$Custom18Field];
	    $custom19=$row[$Custom19Field];
	    $custom20=$row[$Custom20Field];
	    $custom21=$row[$Custom21Field];
	    $custom22=$row[$Custom22Field];
	    $custom23=$row[$Custom23Field];
	    $custom24=$row[$Custom24Field];
	    $custom25=$row[$Custom25Field];
	    $custom26=$row[$Custom26Field];
	    $custom27=$row[$Custom27Field];
	    $custom28=$row[$Custom28Field];
	    $custom29=$row[$Custom29Field];
	    $custom30=$row[$Custom30Field];
	    $custom31=$row[$Custom31Field];
	    $custom32=$row[$Custom32Field];
	    $custom33=$row[$Custom33Field];
	    $custom34=$row[$Custom34Field];
	    $custom35=$row[$Custom35Field];
	    $custom36=$row[$Custom36Field];
	    $custom37=$row[$Custom37Field];
	    $custom38=$row[$Custom38Field];
	    $custom39=$row[$Custom39Field];
	    $custom40=$row[$Custom40Field];
	    $custom41=$row[$Custom41Field];
	    $custom42=$row[$Custom42Field];
	    $custom43=$row[$Custom43Field];
	    $custom44=$row[$Custom44Field];
	    $custom45=$row[$Custom45Field];
	    $custom46=$row[$Custom46Field];
	    $custom47=$row[$Custom47Field];
	    $custom48=$row[$Custom48Field];
	    $custom49=$row[$Custom49Field];
	    $custom50=$row[$Custom50Field];
      // Get each field from record row
    }
    else
    {
	    //mysqli_close($mysql_link);
      return(0);
    }
	  $mysql_result=mysqli_query($mysql_link,"DELETE FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
	  $rowsaffected=mysqli_affected_rows($mysql_link);
	  //mysql_close($mysql_link);
	  if (($mysql_result==false) || ($rowsaffected==0))
	    return(0);
	  if ($clientemail!="")
	  {
	    if (sl_ReadEmailTemplate($clientemail,$subject,$mailBody,$htmlformat))
	      sl_SendEmail($email,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
       $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
       $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);	      
	  }
	  if ($adminemail!="")
	  {
	    if (sl_ReadEmailTemplate($adminemail,$subject,$mailBody,$htmlformat))
	    {
	      sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
        $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
        $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);	      
	    }
	  }
    if (($logit==1) && (substr($LogDetails,8,1)=="Y"))
	    sl_AddToLog("API",$user,"User deleted");
	  // Process after deleting user  
	  sl_userdeleted($user);
    $paramdata['username']=$user;
    $paramdata['userid']=$userid;    
    $paramdata['password']=$pass;
    $paramdata['enabled']=$enabled;
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
      if (function_exists($slplugin_event_onDeleteUser[$p]))
        call_user_func($slplugin_event_onDeleteUser[$p],$slpluginid[$p],$paramdata);
    }
    // Call user event handler   
    if (function_exists("sl_onDeleteUser"))
      sl_onDeleteUser($paramdata);
  	return(1);
  }
  else
  {
    //mysqli_close($mysql_link);
  	return(0);
  }
}
////////////////////////////////////////////////////////////////////////////////////
// slapi_addorupdate                                                              //
// Updates groups and expiry dates of existing user or adds user if doesn't exist //
// Return 1 updated, 0 if not or -1 if database problem                           //
////////////////////////////////////////////////////////////////////////////////////
function slapi_addorupdate($user,&$password,$email,$name,$groups,$groupexpiry,$clientemaila,$adminemaila,$clientemailm,$adminemailm,$logit,$custom1="",$custom2="",$custom3="",$custom4="",$custom5="",$custom6="",$custom7="",$custom8="",$custom9="",$custom10="",
                           $custom11="",$custom12="",$custom13="",$custom14="",$custom15="",$custom16="",$custom17="",$custom18="",$custom19="",$custom20="",
                           $custom21="",$custom22="",$custom23="",$custom24="",$custom25="",$custom26="",$custom27="",$custom28="",$custom29="",$custom30="",
                           $custom31="",$custom32="",$custom33="",$custom34="",$custom35="",$custom36="",$custom37="",$custom38="",$custom39="",$custom40="",
                           $custom41="",$custom42="",$custom43="",$custom44="",$custom45="",$custom46="",$custom47="",$custom48="",$custom49="",$custom50="")
{
	global $DateFormat;
	global $Custom11Field;
	global $RandomPasswordMask;
	global $MD5passwords;
	global $SiteKey;
	global $ValidPasswordChars,$ValidUsernameChars;
  // Remove illegal characters from fields
  $user=sl_swapillegalchars($ValidUsernameChars,"",$user);
  $password=sl_swapillegalchars($ValidPasswordChars,"",$password);
	$exists=slapi_getuser($user,$created,$pass,$en,$nm,$em,$ugs,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
	$cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
	$cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50);	  
	if ($exists==0)
	{
	  $addgroups="";
	  for ($k=0;$k<count($groups);$k++)
	  {
	    $groupexpirystr=sl_adjustexpirydate("",$groupexpiry[$k],$DateFormat,false); 
	    if ($groups[$k]!="")
	    {
	      if ($addgroups!="")
		      $addgroups.="^";	    
	      $addgroups.=$groups[$k];
	      if ($groupexpirystr!="")
		      $addgroups.=":".$groupexpirystr;
	    }
	  }
	 if ($password=="")
		{
			$pass=sl_CreatePassword($RandomPasswordMask);
			$password=$pass;  
		}  
		else
		{
			$pass=$password;
			if (($MD5passwords) && (!sl_ismd5hash($pass)))
				$pass=md5($password.$SiteKey);        
		}  
		return(slapi_adduser($user,$pass,"Yes",$name,$email,$addgroups,$clientemaila,$adminemaila,$logit,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
												 $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,
												 $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50)); 
	}
	if ($exists==1)
	{
		$modgroups="";
	  $password=$pass;
		if (($ugs=="ALL") || ($ugs=="ADMIN"))
		  return(1);
    $groupstrs=explode("^",$ugs);
    for ($k=0;$k<count($groupstrs);$k++)
    {
      $groupsarray[$k]=strtok($groupstrs[$k],":");
      $expiriesarray[$k]=trim(strtok(":"));
    }
    // Update expiry dates for groups that already exist for this user
    for ($j=0;$j<count($groupsarray);$j++)
	  {
			for ($k=0;$k<count($groups);$k++)
			{
				$found=false;
				if ($groups[$k]==$groupsarray[$j])
				{
					$found=true;
					if ($modgroups!="")
						$modgroups.="^";	    
					$groupexpirystr=sl_adjustexpirydate($expiriesarray[$j],$groupexpiry[$k],$DateFormat,true);
					$modgroups.=$groups[$k];    
					if ($groupexpirystr!="")
						$modgroups.=":".$groupexpirystr;
					break;	
				}
      }
			if (!$found)
			{
				if ($modgroups!="")
					$modgroups.="^";	    
				$modgroups.=$groupsarray[$j];    
				if ($expiriesarray[$j]!="")
					$modgroups.=":".$expiriesarray[$j];				
			} 
		}
		// Add any new groups for this user
 	  for ($k=0;$k<count($groups);$k++)
	  {
	  	if ($groups[$k]!="")
	  	{
	      $found=0;
	      for ($j=0;$j<count($groupsarray);$j++)
	      {
	        if ($groups[$k]==$groupsarray[$j])
	        {
	          $found=1;
	          break;
	        }
	      }
	      if ($found==0)
	      {
   	      if ($modgroups!="")
			      $modgroups.="^";	    
          $groupexpirystr=sl_adjustexpirydate("",$groupexpiry[$k],$DateFormat,false); 	      
					$modgroups.=$groups[$k];    
					if ($groupexpirystr!="")
						$modgroups.=":".$groupexpirystr;
	      }
	    }
    }
	 	return(slapi_modifyuser($user,$pass,$en,$nm,$em,$modgroups,$clientemailm,$adminemailm,$logit,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
  	$cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
  	$cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50));
	}
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_addgroup                                                                 //
// Adds a group to a user                                                         //
// Return 1 if updated, 0 if not or -1 if database problem                        //
////////////////////////////////////////////////////////////////////////////////////
function slapi_addgroup($username,$group,$groupexpiry,$ctemplate,$atemplate)
{
  global $DateFormat;
  // Get existing user data
  $exists=slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
  if ($exists<>1)              
    return($exists);
  // See if user already a member of group
  $groupstrs=explode("^",$groups);
  $found=false;
  for ($k=0;$k<count($groupstrs);$k++)
  {
    $groupsarray[$k]=strtok($groupstrs[$k],":");
    $expiriesarray[$k]=trim(strtok(":"));
    if ($groupsarray[$k]==$group)
      $found=true;
  }
  if (!$found)
  {
    if ($groups!="")
      $groups.="^";	    
    $groupexpirystr=sl_adjustexpirydate("",$groupexpiry,$DateFormat,false); 	      
		$groups.=$group;    
		if ($groupexpirystr!="")
			$groups.=":".$groupexpirystr;
    $result=slapi_modifyuser($username,$pass,"Yes",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    return($result);                 
  }
  return(0);                  
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_removegroup                                                              //
// Remove a group from a user                                                     //
// Return 1 if updated, 0 if not or -1 if database problem                        //
////////////////////////////////////////////////////////////////////////////////////
function slapi_removegroup($username,$group,$ctemplate,$atemplate)
{
  // Get existing user data
  $exists=slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
  if ($exists<>1)              
    return($exists);  
  // Check user is already a member of group and if so remove it
  $groupstrs=explode("^",$groups);
  $found=false;
  $groups="";
  for ($k=0;$k<count($groupstrs);$k++)
  {
    $groupsarray[$k]=strtok($groupstrs[$k],":");
    $expiriesarray[$k]=trim(strtok(":"));
    if ($groupsarray[$k]==$group)
      $found=true;
    else
    {
      if ($groups!="")
        $groups.="^";
      $groups.=$groupsarray[$k];
			if ($expiriesarray[$k]!="")
  			$groups.=":".$expiriesarray[$k];	       	    
    }  
  }
  if ($found)
  {
    $result=slapi_modifyuser($username,$pass,"Yes",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);
    return($result);                                   
  }
  return(0);                  
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_replacegroup                                                             //
// Replace a group for a user                                                     //
// Return 1 if updated, 0 if not or -1 if database problem                        //
////////////////////////////////////////////////////////////////////////////////////
function slapi_replacegroup($username,$group,$newgroup,$groupexpiry,$ctemplate,$atemplate)
{
  global $DateFormat;
  // Get existing user data
  $exists=slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                      
  if ($exists<>1)              
    return($exists);
  // Check user is already a member of group and if so update it
  $groupstrs=explode("^",$groups);
  $found=false;
  $groups="";
  for ($k=0;$k<count($groupstrs);$k++)
  {
    $groupsarray[$k]=strtok($groupstrs[$k],":");
    $expiriesarray[$k]=trim(strtok(":"));
    if ($groupsarray[$k]==$group)
    {
      $found=true;
      if ($groups!="")
        $groups.="^";
      $groups.=$newgroup;
      if ($groupexpiry!="")
      {
        $groupexpirystr=sl_adjustexpirydate($expiriesarray[$k],$groupexpiry,$DateFormat,true); 
			  if ($groupexpirystr!="")
  			  $groups.=":".$groupexpirystr;
      }
      else
      {
			  if ($expiriesarray[$k]!="")
  			  $groups.=":".$expiriesarray[$k];
  		}	
    }  
    else
    {
      if ($groups!="")
        $groups.="^";
      $groups.=$groupsarray[$k];
			if ($expiriesarray[$k]!="")
  			$groups.=":".$expiriesarray[$k];	       	    
    }  
  }
  if ($found)
  {
    $result=slapi_modifyuser($username,$pass,"Yes",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    return($result);                     
  }                  
  return(0);
}  

////////////////////////////////////////////////////////////////////////////////////
// slapi_extendgroup                                                              //
// Extend expiry for a group for a user                                           //
// Return 1 if updated, 0 if not or -1 if database problem                        //
////////////////////////////////////////////////////////////////////////////////////
function slapi_extendgroup($username,$group,$groupexpiry,$expirytype,$ctemplate,$atemplate)
{
  global $DateFormat;
  // Get existing user data
  $exists=slapi_getuser($username,$created,$pass,$enabled,$name,$email,$groups,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                      
  if ($exists<>1)              
    return($exists);
  // Check user is already a member of group and if so update it
  $groupstrs=explode("^",$groups);
  $found=false;
  $groups="";
  for ($k=0;$k<count($groupstrs);$k++)
  {
    $groupsarray[$k]=strtok($groupstrs[$k],":");
    $expiriesarray[$k]=trim(strtok(":"));
    if (($groupsarray[$k]==$group) && ($expiriesarray[$k]!=""))
    {
      $found=true;
      if ($groups!="")
        $groups.="^";
      $groups.=$group;
      if ($groupexpiry!="")
      {
        $groupexpirystr=$expiriesarray[$k];
        // Check that expirytype allows changing (based on current expiry)
        if ($expirytype!=0) 
        {
          // See if current expiry has expired or not
      	  $daysdifference=0;
      		if ($DateFormat=="DDMMYY")
      			$tso=gmmktime(23, 59, 59, substr($expiriesarray[$k],2,2),substr($expiriesarray[$k],0,2),2000+substr($expiriesarray[$k],4,2));
      		if ($DateFormat=="MMDDYY")
      			$tso=gmmktime(23, 59, 59, substr($expiriesarray[$k],0,2),substr($expiriesarray[$k],2,2),2000+substr($expiriesarray[$k],4,2));
      		$daysdifference=($tso-time())/86400;
      		// If only allowed to extend if still x days left until expiry
	        if ($expirytype>0)
	        {
	          if ($daysdifference>=$expirytype)
              $groupexpirystr=sl_adjustexpirydate($expiriesarray[$k],$groupexpiry,$DateFormat,true);   	        
	        }  
      		// If only allowed to extend if still more than x days since expiry
	        if ($expirytype<0)
	        {
	          if (($daysdifference*-1)>=($expirytype*-1))
              $groupexpirystr=sl_adjustexpirydate($expiriesarray[$k],(string)$groupexpiry,$DateFormat,true);   	        
	        }  
        }
        else
        {
          $groupexpirystr=sl_adjustexpirydate($expiriesarray[$k],(string)$groupexpiry,$DateFormat,true);   	                  
        }  	      
			  if ($groupexpirystr!="")
  			  $groups.=":".$groupexpirystr;
      }
      else
      {
			  if ($expiriesarray[$k]!="")
  			  $groups.=":".$expiriesarray[$k];
  		}	
    }  
    else
    {
      if ($groups!="")
        $groups.="^";
      $groups.=$groupsarray[$k];
			if ($expiriesarray[$k]!="")
  			$groups.=":".$expiriesarray[$k];	       	    
    }  
  }
  if ($found)
  {
    $result=slapi_modifyuser($username,$pass,"Yes",$name,$email,$groups,$ctemplate,$atemplate,1,$custom1,$custom2,$custom3,$custom4,$custom5,$custom6,$custom7,$custom8,$custom9,$custom10,
                     $custom11,$custom12,$custom13,$custom14,$custom15,$custom16,$custom17,$custom18,$custom19,$custom20,$custom21,$custom22,$custom23,$custom24,$custom25,$custom26,$custom27,$custom28,$custom29,$custom30,    
                     $custom31,$custom32,$custom33,$custom34,$custom35,$custom36,$custom37,$custom38,$custom39,$custom40,$custom41,$custom42,$custom43,$custom44,$custom45,$custom46,$custom47,$custom48,$custom49,$custom50);                  
    return($result);                  
  }
  return(0);                  
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_getallusernames                                                          //
// Returns an array containing all usernames in the database                      //
// Returns -1 if database problem                                                 //
////////////////////////////////////////////////////////////////////////////////////
function slapi_getallusernames($orderby="",$where="")
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  $query="SELECT ".$UsernameField." FROM ".$DbTableName;
  if ($where!="")
  {
    $query.=" WHERE ".$where;
  }
  if ($orderby!="")
    $query.=" ORDER BY ".$orderby;
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
  {
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
	    $usersarray[]=$row[$UsernameField];
    }
    return($usersarray);
  }
  return(-1);
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_getallgroupnames                                                         //
// Returns an array containing all usergroups defined in Manage Groups            //
// Returns -1 if database problem                                                 //
////////////////////////////////////////////////////////////////////////////////////
function slapi_getallusergroups()
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbGroupTableName;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbGroupTableName);
  if ($mysql_result!=false)
  {
    $k=0;
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      if ($row['name']=="ALL")
        continue;
	    $groupsarray[$k]['name']=$row['name'];
	    $groupsarray[$k]['description']=$row['description'];
	    $groupsarray[$k]['loginaction']=$row['loginaction'];
	    $groupsarray[$k]['loginvalue']=$row['loginvalue'];
	    $k++;
    }
    return($groupsarray);
  }
  return(-1);
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_loginuser                                                                //
// Login the user                                                                 //
// Returns 1 on success, 0 if username not known , -1 if database problem         //
////////////////////////////////////////////////////////////////////////////////////
function slapi_loginuser($username)
{
 	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$CreatedField,$UsernameField;
  global $SessionName,$ConcurrentLogin,$LogDetails,$sljustloggedin;
  global $slnumplugins,$slpluginid,$slplugin_event_onLogin,$LogDetails,$SessionField;
  // First lookup username and get details
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    return(-1);
  }
  $query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username);
  $mysql_result=mysqli_query($mysql_link,$query);
  if (!$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
  {
   return(0);
  }
  // Check if user currently has session open. If so destroy that session if concurrent logins not allowed.
  $ThisSession=session_id();
  $OpenSession=$row[$SessionField];
  if (($ConcurrentLogin==false) && ($OpenSession!=""))
  {
    session_id($OpenSession);
    @session_destroy();
    if ($SessionName!="")
      session_name($SessionName);
    session_id($ThisSession);
    session_start();
  }
  
  // Regenerate session at login for security
//  session_regenerate_id();
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
  if (!sl_UpdateUserVariables($username,true))
    return(-1);
  if (substr($LogDetails,0,1)=="Y")
    sl_AddToLog("Login",$username,"via API");
  $sljustloggedin=true;
  $_SESSION['ses_sljustloggedin']=true;  	    
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
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onLogin[$p]))
      call_user_func($slplugin_event_onLogin[$p],$slpluginid[$p],$paramdata);
  }
  // Call user event handler
  if (function_exists("sl_onLogin"))
    sl_onLogin($paramdata);         
  return(1);  
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_changeusername                                                           //
// Changes username                                                               //
// Return 1 if successful, 0 if not or -1 if database problem                     //
////////////////////////////////////////////////////////////////////////////////////
function slapi_changeusername($username,$newusername,$clientemail,$adminemail,$logit)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField,$SiteEmail,$IdField;
  global $LogDetails, $SiteKey,$ValidUsernameChars,$SiteEmail;
	global $slnumplugins,$slpluginid,$slplugin_event_onModifyUser,$slplugin_event_onCheckModifyUser;
	// Remove illegal characters from fields
  $newusername=sl_swapillegalchars($ValidUsernameChars,"",$newusername);
	$exists=slapi_getuser($username,$created,$pass,$en,$nm,$em,$ugs,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
	$cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
	$cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50);
	if ($exists<>1)
	  return(0);	    
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(-1);
  // Give plugins and event handler final word on whether user can be added	 	
  // Event point
  $paramdata['userid']="";
  $paramdata['username']=$newusername;
  $paramdata['oldusername']=$username;
  $paramdata['password']=$pass;
  $paramdata['enabled']=$en;
  $paramdata['name']=$nm;
  $paramdata['email']=$em;
  $paramdata['usergroups']=$ugs;
  $paramdata['custom1']=$cu1;
  $paramdata['custom2']=$cu2;
  $paramdata['custom3']=$cu3;
  $paramdata['custom4']=$cu4;
  $paramdata['custom5']=$cu5;
  $paramdata['custom6']=$cu6;
  $paramdata['custom7']=$cu7;
  $paramdata['custom8']=$cu8;
  $paramdata['custom9']=$cu9;
  $paramdata['custom10']=$cu10;
  $paramdata['custom11']=$cu11;
  $paramdata['custom12']=$cu12;
  $paramdata['custom13']=$cu13;
  $paramdata['custom14']=$cu14;
  $paramdata['custom15']=$cu15;
  $paramdata['custom16']=$cu16;
  $paramdata['custom17']=$cu17;
  $paramdata['custom18']=$cu18;
  $paramdata['custom19']=$cu19;
  $paramdata['custom20']=$cu20;
  $paramdata['custom21']=$cu21;
  $paramdata['custom22']=$cu22;
  $paramdata['custom23']=$cu23;
  $paramdata['custom24']=$cu24;
  $paramdata['custom25']=$cu25;
  $paramdata['custom26']=$cu26;
  $paramdata['custom27']=$cu27;
  $paramdata['custom28']=$cu28;
  $paramdata['custom29']=$cu29;
  $paramdata['custom30']=$cu30;
  $paramdata['custom31']=$cu31;
  $paramdata['custom32']=$cu32;
  $paramdata['custom33']=$cu33;
  $paramdata['custom34']=$cu34;
  $paramdata['custom35']=$cu35;
  $paramdata['custom36']=$cu36;
  $paramdata['custom37']=$cu37;
  $paramdata['custom38']=$cu38;
  $paramdata['custom39']=$cu39;
  $paramdata['custom40']=$cu40;
  $paramdata['custom41']=$cu41;
  $paramdata['custom42']=$cu42;
  $paramdata['custom43']=$cu43;
  $paramdata['custom44']=$cu44;
  $paramdata['custom45']=$cu45;
  $paramdata['custom46']=$cu46;
  $paramdata['custom47']=$cu47;
  $paramdata['custom48']=$cu48;
  $paramdata['custom49']=$cu49;
  $paramdata['custom50']=$cu50;
  $paramdata['from']=0;                      
  // Call plugin event
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (function_exists($slplugin_event_onCheckModifyUser[$p]))
    {
      $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
      if ($res['ok']==false)
        return(0);
    }  
  }
  if (function_exists("sl_onCheckModifyUser"))
    $res=sl_onCheckModifyUser($paramdata);
  if ($res['ok']==false)
     return(0);
  $Query="UPDATE ".$DbTableName." SET ".$UsernameField."=".sl_quote_smart($newusername)." WHERE ".$UsernameField."=".sl_quote_smart($username);
  $mysql_result=mysqli_query($mysql_link,$Query);
  //mysqli_close($mysql_link);
  if ($mysql_result===false)
  	return(0);

  sl_usernamechanged($username,$newusername);	
  if ($clientemail!="")
  {
	  if (sl_ReadEmailTemplate($clientemail,$subject,$mailBody,$htmlformat))
	    sl_SendEmail($em,$mailBody,$subject,$htmlformat,$newusername,$pass,$nm,$em,$ugs,$cu1,$cu2,$cu3,$cu4,$cu5,$cu6,$cu7,$cu8,$cu9,$cu10,
      $cu11,$cu12,$cu13,$cu14,$cu15,$cu16,$cu17,$cu18,$cu19,$cu20,$cu21,$cu22,$cu23,$cu24,$cu25,$cu26,$cu27,$cu28,$cu29,$cu30,
      $cu31,$cu32,$cu33,$cu34,$cu35,$cu36,$cu37,$cu38,$cu39,$cu40,$cu41,$cu42,$cu43,$cu44,$cu45,$cu46,$cu47,$cu48,$cu49,$cu50);	    
	}
  if ($adminemail!="")
  {
	  if (sl_ReadEmailTemplate($adminemail,$subject,$mailBody,$htmlformat))
  		sl_SendEmail($SiteEmail,$mailBody,$subject,$htmlformat,$newusername,$pass,$nm,$em,$ugs,$cu1,$cu2,$cu3,$cu4,$cu5,$cu6,$cu7,$cu8,$cu9,$cu10,
      $cu11,$cu12,$cu13,$cu14,$cu15,$cu16,$cu17,$cu18,$cu19,$cu20,$cu21,$cu22,$cu23,$cu24,$cu25,$cu26,$cu27,$cu28,$cu29,$cu30,
      $cu31,$cu32,$cu33,$cu34,$cu35,$cu36,$cu37,$cu38,$cu39,$cu40,$cu41,$cu42,$cu43,$cu44,$cu45,$cu46,$cu47,$cu48,$cu49,$cu50);
  }
  if (($logit==1) && (substr($LogDetails,8,1)=="Y"))
    sl_AddToLog("API",$user,"User details modified");
  // Event point
  // Get auto increment id of user modified
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($newusername));
  $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);	
  $paramdata['userid']=$row[$IdField];
  $paramdata['username']=$newusername;
  $paramdata['oldusername']=$username;
  $paramdata['password']=$pass;
  $paramdata['enabled']=$en;
  $paramdata['name']=$nm;
  $paramdata['email']=$em;
  $paramdata['usergroups']=$ugs;
  $paramdata['custom1']=$cu1;
  $paramdata['custom2']=$cu2;
  $paramdata['custom3']=$cu3;
  $paramdata['custom4']=$cu4;
  $paramdata['custom5']=$cu5;
  $paramdata['custom6']=$cu6;
  $paramdata['custom7']=$cu7;
  $paramdata['custom8']=$cu8;
  $paramdata['custom9']=$cu9;
  $paramdata['custom10']=$cu10;
  $paramdata['custom11']=$cu11;
  $paramdata['custom12']=$cu12;
  $paramdata['custom13']=$cu13;
  $paramdata['custom14']=$cu14;
  $paramdata['custom15']=$cu15;
  $paramdata['custom16']=$cu16;
  $paramdata['custom17']=$cu17;
  $paramdata['custom18']=$cu18;
  $paramdata['custom19']=$cu19;
  $paramdata['custom20']=$cu20;
  $paramdata['custom21']=$cu21;
  $paramdata['custom22']=$cu22;
  $paramdata['custom23']=$cu23;
  $paramdata['custom24']=$cu24;
  $paramdata['custom25']=$cu25;
  $paramdata['custom26']=$cu26;
  $paramdata['custom27']=$cu27;
  $paramdata['custom28']=$cu28;
  $paramdata['custom29']=$cu29;
  $paramdata['custom30']=$cu30;
  $paramdata['custom31']=$cu31;
  $paramdata['custom32']=$cu32;
  $paramdata['custom33']=$cu33;
  $paramdata['custom34']=$cu34;
  $paramdata['custom35']=$cu35;
  $paramdata['custom36']=$cu36;
  $paramdata['custom37']=$cu37;
  $paramdata['custom38']=$cu38;
  $paramdata['custom39']=$cu39;
  $paramdata['custom40']=$cu40;
  $paramdata['custom41']=$cu41;
  $paramdata['custom42']=$cu42;
  $paramdata['custom43']=$cu43;
  $paramdata['custom44']=$cu44;
  $paramdata['custom45']=$cu45;
  $paramdata['custom46']=$cu46;
  $paramdata['custom47']=$cu47;
  $paramdata['custom48']=$cu48;
  $paramdata['custom49']=$cu49;
  $paramdata['custom50']=$cu50;
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
  return(1);
}
////////////////////////////////////////////////////////////////////////////////////
// slapi_getuserbyemail                                                           //
// Returns user data for first user with matching email address field             //
// Returns false if not found or failed or array with data                        //
////////////////////////////////////////////////////////////////////////////////////
function slapi_getuserbyemail($email)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$CreatedField,$UsernameField,$PasswordField,$EnabledField;
	global $NameField,$EmailField,$UsergroupsField,$IdField;
	global $Custom1Field,$Custom2Field,$Custom3Field,$Custom4Field,$Custom5Field,$Custom6Field,$Custom7Field,$Custom8Field,$Custom9Field,$Custom10Field;
	global $Custom11Field,$Custom12Field,$Custom13Field,$Custom14Field,$Custom15Field,$Custom16Field,$Custom17Field,$Custom18Field,$Custom19Field,$Custom20Field;
	global $Custom21Field,$Custom22Field,$Custom23Field,$Custom24Field,$Custom25Field,$Custom26Field,$Custom27Field,$Custom28Field,$Custom29Field,$Custom30Field;
	global $Custom31Field,$Custom32Field,$Custom33Field,$Custom34Field,$Custom35Field,$Custom36Field,$Custom37Field,$Custom38Field,$Custom39Field,$Custom40Field;
	global $Custom41Field,$Custom42Field,$Custom43Field,$Custom44Field,$Custom45Field,$Custom46Field,$Custom47Field,$Custom48Field,$Custom49Field,$Custom50Field;
	if ($email=="")
	  return(false);
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(false);
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($email));
  if ($mysql_result!=false)
  {
  	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
    if ($row!=false)
    {
      $result=array();     
	    $result['userid']=$row[$IdField];
	    $result['created']=$row[$CreatedField];
	    $result['username']=$row[$UsernameField];
	    $result['password']=$row[$PasswordField];
	    $result['name']=$row[$NameField];
	    $result['enabled']=$row[$EnabledField];
	    $result['email']=$row[$EmailField];
	    $result['usergroups']=$row[$UsergroupsField];
	    $result['custom1']=$row[$Custom1Field];
	    $result['custom2']=$row[$Custom2Field];
	    $result['custom3']=$row[$Custom3Field];
	    $result['custom4']=$row[$Custom4Field];
	    $result['custom5']=$row[$Custom5Field];
	    $result['custom6']=$row[$Custom6Field];
	    $result['custom7']=$row[$Custom7Field];
	    $result['custom8']=$row[$Custom8Field];
	    $result['custom9']=$row[$Custom9Field];
	    $result['custom10']=$row[$Custom10Field];
	    $result['custom11']=$row[$Custom11Field];
	    $result['custom12']=$row[$Custom12Field];
	    $result['custom13']=$row[$Custom13Field];
	    $result['custom14']=$row[$Custom14Field];
	    $result['custom15']=$row[$Custom15Field];
	    $result['custom16']=$row[$Custom16Field];
	    $result['custom17']=$row[$Custom17Field];
	    $result['custom18']=$row[$Custom18Field];
	    $result['custom19']=$row[$Custom19Field];
	    $result['custom20']=$row[$Custom20Field];
	    $result['custom21']=$row[$Custom21Field];
	    $result['custom22']=$row[$Custom22Field];
	    $result['custom23']=$row[$Custom23Field];
	    $result['custom24']=$row[$Custom24Field];
	    $result['custom25']=$row[$Custom25Field];
	    $result['custom26']=$row[$Custom26Field];
	    $result['custom27']=$row[$Custom27Field];
	    $result['custom28']=$row[$Custom28Field];
	    $result['custom29']=$row[$Custom29Field];
	    $result['custom30']=$row[$Custom30Field];
	    $result['custom31']=$row[$Custom31Field];
	    $result['custom32']=$row[$Custom32Field];
	    $result['custom33']=$row[$Custom33Field];
	    $result['custom34']=$row[$Custom34Field];
	    $result['custom35']=$row[$Custom35Field];
	    $result['custom36']=$row[$Custom36Field];
	    $result['custom37']=$row[$Custom37Field];
	    $result['custom38']=$row[$Custom38Field];
	    $result['custom39']=$row[$Custom39Field];
	    $result['custom40']=$row[$Custom40Field];
	    $result['custom41']=$row[$Custom41Field];
	    $result['custom42']=$row[$Custom42Field];
	    $result['custom43']=$row[$Custom43Field];
	    $result['custom44']=$row[$Custom44Field];
	    $result['custom45']=$row[$Custom45Field];
	    $result['custom46']=$row[$Custom46Field];
	    $result['custom47']=$row[$Custom47Field];
	    $result['custom48']=$row[$Custom48Field];
	    $result['custom49']=$row[$Custom49Field];
	    $result['custom50']=$row[$Custom50Field];
	 	  //mysqli_close($mysql_link);
  		return($result);
    }
    else
    {
	    //mysqli_close($mysql_link);
	    return(false);
    }
  }
  else
  {
    //mysqli_close($mysql_link);
  	return(false);
  }
}
////////////////////////////////////////////////////////////////////////////////////
// slapi_getuseridfromusername                                                    //
// Gets unique userid for username                                                //
// Returns false if not found or failed or userid                                 //
////////////////////////////////////////////////////////////////////////////////////
function slapi_getuseridfromusername($username)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField,$IdField;
	if ($username=="")
	  return(false);
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(false);
  $mysql_result=mysqli_query($mysql_link,"SELECT ".$IdField." FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($username));
  if ($mysql_result===false)
    return(false);
	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  if ($row==false)
    return(false);
  return($row[$IdField]);
}

////////////////////////////////////////////////////////////////////////////////////
// slapi_getusernamefromemail                                                     //
//                                                                                //
// Returns false if not foud or DB problem. Array of usernames if found           //
////////////////////////////////////////////////////////////////////////////////////
function slapi_getusernamefromemail($email)
{
	global $DbHost,$DbUser,$DbPassword,$DbName,$DbTableName,$UsernameField,$EmailField;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  	return(false);
  $query="SELECT ".$UsernameField." FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($email);
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
  {
    $usersarray=array();
    $found=false;
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $found=true;
	    $usersarray[]=$row[$UsernameField];
    }
    if ($found)
      return($usersarray);
  }
  return(false);
}

//**********************************************************************************
// Functions below this point are designed to work on the currently logged in user
// and should only be called from members pages.
//**********************************************************************************


////////////////////////////////////////////////////////////////////////////////////
// sl_delete                                                                      //
// For use in members pages only                                                  //
// Deletes the user account (current user)                                        //
// Returns -1 if database problem or 1 if ok                                      //
////////////////////////////////////////////////////////////////////////////////////
function sl_delete($ctemplate,$atemplate)
{
  global $slusername;
  if ($slusername!="")
  {
    $result=slapi_deleteuser($slusername,$ctemplate,$atemplate,0);
    if ($result==1)
      return(1);  
  }
  return(-1);
}

////////////////////////////////////////////////////////////////////////////////////
// sl_addgroup                                                                    //
// For use in members pages only                                                  //
// Adds a group to the current user and session (Sitelok variables updated)       //
// Returns -1 if database problem or 1 if ok                                      //
////////////////////////////////////////////////////////////////////////////////////
function sl_addgroup($group,$groupexpiry,$ctemplate,$atemplate)
{
  global $slusername;
  if ($slusername!="")
  {
    $result=slapi_addgroup($slusername,$group,$groupexpiry,$ctemplate,$atemplate);
    sl_UpdateUserVariables($slusername,true);
    if ($result==1)
      return(1);  
  }
  return(-1);
}

////////////////////////////////////////////////////////////////////////////////////
// sl_removegroup                                                                 //
// For use in members pages only                                                  //
// Removes a group from the current user and session (Sitelok variables updated)  //
// Returns -1 if database problem or 1 if ok                                      //
////////////////////////////////////////////////////////////////////////////////////
function sl_removegroup($group,$ctemplate,$atemplate)
{
  global $slusername;
  if ($slusername!="")
  {
    $result=slapi_removegroup($slusername,$group,$ctemplate,$atemplate);
    sl_UpdateUserVariables($slusername,true);
    if ($result==1)
      return(true);  
  }
  return(false);
}

////////////////////////////////////////////////////////////////////////////////////
// sl_replacegroup                                                                //
// For use in members pages only                                                  //
// Replaces a group for the current user and session (Sitelok variables updated)  //
// Returns -1 if database problem or 1 if ok                                      //
////////////////////////////////////////////////////////////////////////////////////
function sl_replacegroup($group,$newgroup,$groupexpiry,$ctemplate,$atemplate)
{
  global $slusername;
  if ($slusername!="")
  {
    $result=slapi_replacegroup($slusername,$group,$newgroup,$groupexpiry,$ctemplate,$atemplate);
    sl_UpdateUserVariables($slusername,true);
    if ($result==1)
      return(1);  
  }
  return(-1);
}

////////////////////////////////////////////////////////////////////////////////////
// sl_extendgroup                                                                 //
// For use in members pages only                                                  //
// Extends a group for the current user and session (Sitelok variables updated)   //
// Returns -1 if database problem or 1 if ok                                      //
////////////////////////////////////////////////////////////////////////////////////
function sl_extendgroup($group,$groupexpiry,$expirytype,$ctemplate,$atemplate)
{
  global $slusername;
  if ($slusername!="")
  {
    $result=slapi_extendgroup($slusername,$group,$groupexpiry,$expirytype,$ctemplate,$atemplate);
    sl_UpdateUserVariables($slusername,true);
    if ($result==1)
      return(1);  
  }
  return(-1);
}

function sl_logout()
{
  global $slusername,$LogDetails,$slcookielogin,$LogDetails,$sl_cookiesecure,$sl_cookiehttponly;
  if (substr($LogDetails,0,1)=="Y")
	  sl_AddToLog("Logout",$slusername,"via API");
  sl_processlogout($slusername);
  @session_destroy();
  if ($sl_cookiehttponly)
    setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure,true);
  else  
    setcookie(session_name(), '', time()-42000, '/',"",$sl_cookiesecure);
  if ($slcookielogin=="2")
  {
    if ($sl_cookiehttponly)
      setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure,true);
    else
      setcookie("SITELOKPW".$SessionName,"",time()-86400,"/","",$sl_cookiesecure);
  }  
}

//**********************************************************************************
// Functions below this point should not be called directly
//**********************************************************************************

function sl_swapillegalchars($allowed,$r,$s)
{
  $ret="";
  for ($k=0;$k<strlen($s);$k++)
  {
    $c=substr($s,$k,1);
    if (!is_integer(strpos($allowed,$c)))
      $ret.=$r;
    else
      $ret.=$c;  
  }
  return($ret);
}

function sl_ismd5hash($s)
{
  $s=strtolower($s);
  if (strlen($s)!=32)
    return(false);
  $good=true;  
  for ($k=0;$k<32;$k++)
  {
    $c=$s[$k];
    if ((($c>='0') && ($c<='9')) || (($c>='a') && ($c<='f')))
      continue;
    $good=false;
    break;  
  }
  return($good);
}
function sl_adjustexpirydate($expiry,$groupexpiry,$DateFormat,$existing)
{
  if ((is_string($groupexpiry)) && ($groupexpiry=="0"))
    return("");
  if ((!is_string($groupexpiry)) && ($groupexpiry==0))
    return("");
  if (!$existing)
  {
  	if (!is_string($groupexpiry))
  	{
  		if ($groupexpiry>0)
  		{
				if ($DateFormat=="DDMMYY")
					return(gmdate("dmy",time()+$groupexpiry*86400));
				if ($DateFormat=="MMDDYY")
					return(gmdate("mdy",time()+$groupexpiry*86400));  	
			}
			else
				return("");	
  	}
  	if (is_string($groupexpiry))
  	{
  		if (($groupexpiry=="0") || ($groupexpiry==""))
  			return("");
 			if ((strlen($groupexpiry)==6) && (substr($groupexpiry, 0, 1)!="+"))
			{
				if (($DateFormat=="DDMMYY") && (checkdate(substr($groupexpiry,2,2),substr($groupexpiry,0,2),2000+substr($groupexpiry,4,2))))
					return($groupexpiry);
				if (($DateFormat=="MMDDYY") && (checkdate(substr($groupexpiry,0,2),substr($groupexpiry,2,2),2000+substr($groupexpiry,4,2))))
					return($groupexpiry);				  	
			}
			if ($DateFormat=="DDMMYY")
				return(gmdate("dmy",time()+$groupexpiry*86400));
			if ($DateFormat=="MMDDYY")
				return(gmdate("mdy",time()+$groupexpiry*86400));
		}
	}			
	if ($existing)
	{
	  if ($expiry=="")
	    return("");
	  // See if expiry date is expired
	  $expired=false;
		if ($DateFormat=="DDMMYY")
			$tso=gmmktime(23, 59, 59, substr($expiry,2,2),substr($expiry,0,2),2000+substr($expiry,4,2));
		if ($DateFormat=="MMDDYY")
			$tso=gmmktime(23, 59, 59, substr($expiry,0,2),substr($expiry,2,2),2000+substr($expiry,4,2));
		if ($tso<=time())
		  $expired=true;		    
  	if (!is_string($groupexpiry))
  	{
  		if ($groupexpiry>0)
  		{
				if ($DateFormat=="DDMMYY")
					return(gmdate("dmy",time()+$groupexpiry*86400));
				if ($DateFormat=="MMDDYY")
					return(gmdate("mdy",time()+$groupexpiry*86400));  	
			}
			else
				return("");	
  	}
  	if (is_string($groupexpiry))
		{
 			if ((strlen($groupexpiry)==6) && (substr($groupexpiry, 0, 1)!="+"))
			{
				if (($DateFormat=="DDMMYY") && (checkdate(substr($groupexpiry,2,2),substr($groupexpiry,0,2),2000+substr($groupexpiry,4,2))))
					return($groupexpiry);
				if (($DateFormat=="MMDDYY") && (checkdate(substr($groupexpiry,0,2),substr($groupexpiry,2,2),2000+substr($groupexpiry,4,2))))
					return($groupexpiry);				  	
			}
		  if (substr($groupexpiry, 0, 1)=="+")
			{
			  if ($expired)
			  {
					if ($DateFormat=="DDMMYY")
						return(gmdate("dmy",time()+$groupexpiry*86400));
					if ($DateFormat=="MMDDYY")
						return(gmdate("mdy",time()+$groupexpiry*86400));			  
			  }
			  if (!$expired)
			  {
					if ($DateFormat=="DDMMYY")
						return(gmdate("dmy",$tso+$groupexpiry*86400));
					if ($DateFormat=="MMDDYY")
						return(gmdate("mdy",$tso+$groupexpiry*86400));			  			  
			  }
			}
		  if (substr($groupexpiry, 0, 1)!="+")
			{
				if ($DateFormat=="DDMMYY")
					return(gmdate("dmy",time()+$groupexpiry*86400));
				if ($DateFormat=="MMDDYY")
					return(gmdate("mdy",time()+$groupexpiry*86400));			  			
			}
		}	
	}
	return("");
}
?>