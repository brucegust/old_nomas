<?php
  reset($_GET);
  reset($_POST);
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$startpage="index.php";
  require_once("sitelokpw.php");
  if ($slcsrf!=$_SESSION['ses_slcsrf'])
  {
    print "Form tampering detected";
    exit;
  }  
  if (isset($_GET['user']))
    $user=urldecode($user);
  $editmsg="";
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }  
  if (($act=="useredited") && ($newuser!=""))
  { 
    if (get_magic_quotes_gpc())
    {
      $nm=stripslashes($nm);
      $cu1=stripslashes($cu1);
      $cu2=stripslashes($cu2);
      $cu3=stripslashes($cu3);
      $cu4=stripslashes($cu4);
      $cu5=stripslashes($cu5);
      $cu6=stripslashes($cu6);
      $cu7=stripslashes($cu7);
      $cu8=stripslashes($cu8);
      $cu9=stripslashes($cu9);
      $cu10=stripslashes($cu10);      
      $cu11=stripslashes($cu11);
      $cu12=stripslashes($cu12);
      $cu13=stripslashes($cu13);
      $cu14=stripslashes($cu14);
      $cu15=stripslashes($cu15);
      $cu16=stripslashes($cu16);
      $cu17=stripslashes($cu17);
      $cu18=stripslashes($cu18);
      $cu19=stripslashes($cu19);
      $cu20=stripslashes($cu20);      
      $cu21=stripslashes($cu21);
      $cu22=stripslashes($cu22);
      $cu23=stripslashes($cu23);
      $cu24=stripslashes($cu24);
      $cu25=stripslashes($cu25);
      $cu26=stripslashes($cu26);
      $cu27=stripslashes($cu27);
      $cu28=stripslashes($cu28);
      $cu29=stripslashes($cu29);
      $cu30=stripslashes($cu30);      
      $cu31=stripslashes($cu31);
      $cu32=stripslashes($cu32);
      $cu33=stripslashes($cu33);
      $cu34=stripslashes($cu34);
      $cu35=stripslashes($cu35);
      $cu36=stripslashes($cu36);
      $cu37=stripslashes($cu37);
      $cu38=stripslashes($cu38);
      $cu39=stripslashes($cu39);
      $cu40=stripslashes($cu40);      
      $cu41=stripslashes($cu41);
      $cu42=stripslashes($cu42);
      $cu43=stripslashes($cu43);
      $cu44=stripslashes($cu44);
      $cu45=stripslashes($cu45);
      $cu46=stripslashes($cu46);
      $cu47=stripslashes($cu47);
      $cu48=stripslashes($cu48);
      $cu49=stripslashes($cu49);
      $cu50=stripslashes($cu50);      
    }
    // Validate username field
    if ($newuser=="")
    	$editmsg="Username must be entered";
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($editmsg=="") && (function_exists($slplugin_event_onUsernameValidate[$p])))
        $editmsg=call_user_func($slplugin_event_onUsernameValidate[$p],$slpluginid[$p],$newuser,2);
    }
    if ($editmsg=="")
    {
      if (function_exists("sl_onUsernameValidate"))
        $editmsg=sl_onUsernameValidate($newuser,2);
    }
    // check username is set and doesn't contain invalid characters
    if (($editmsg=="") && (strspn($newuser, $ValidUsernameChars) != strlen($newuser)))
    	$editmsg="Username contains invalid characters"; 
    // Validate password field
    if ((!$MD5passwords) && ($editmsg=="") && ($pass==""))
    	$editmsg="Password should contain at least 5 characters";
    if ($pass!="")
    { 	     
      // Call plugin and eventhandler validation function
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if (($editmsg=="") && (function_exists($slplugin_event_onPasswordValidate[$p])))
          $editmsg=call_user_func($slplugin_event_onPasswordValidate[$p],$slpluginid[$p],$pass,2);
      }
      if ($editmsg=="")
      {
        if (function_exists("sl_onPasswordValidate"))
          $editmsg=sl_onPasswordValidate($pass,2);
      }
    }
    if (($MD5passwords) && ($pass!=""))
    {
      // check password is at least 5 characters long
      if (($editmsg=="") && (strlen($pass)<5))
      	$editmsg="Password should contain at least 5 characters"; 
      // Validate against master list of valid characters
      if (($editmsg=="") && (strspn($pass, $ValidPasswordChars) != strlen($pass)))
      	$editmsg="Password contains invalid characters";
    }
    if (!$MD5passwords)
    {
      // check password is at least 5 characters long
      if (($editmsg=="") && (strlen($pass)<5))
      	$editmsg="Password should contain at least 5 characters"; 
      // Validate against master list of valid characters
      if (($editmsg=="") && (strspn($pass, $ValidPasswordChars) != strlen($pass)))
      	$editmsg="Password contains invalid characters";
    } 
    // Validate name field
    if (($editmsg=="") && ($nm==""))
    	$editmsg="Please enter the users name";     
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($editmsg=="") && (function_exists($slplugin_event_onNameValidate[$p])))
        $editmsg=call_user_func($slplugin_event_onNameValidate[$p],$slpluginid[$p],$nm,2);
    }
    if ($editmsg=="")
    {
      if (function_exists("sl_onNameValidate"))
      $editmsg=sl_onNameValidate($nm,2);
    }
    // Validate email field
    if (($editmsg=="") && ($em==""))
    	$editmsg="Please enter the users email address";     
    // Check email is in valid format
    if (($editmsg=="") && (!sl_validate_email($em)))
      $editmsg="Please enter a valid email address";    
    // Check if email address already used (by a different user if required                        
    if (($editmsg=="") && ($EmailUnique==2))
    {
      $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($em)." AND ".$UsernameField."!=".sl_quote_smart($user));
      if ($mysql_result===false)
        $editmsg=MSG_DBPROB;  
      $num = mysqli_num_rows($mysql_result);
      if ($num>0)
        $editmsg="The email address is already in use";
    }
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($editmsg=="") && (function_exists($slplugin_event_onEmailValidate[$p])))
        $editmsg=call_user_func($slplugin_event_onEmailValidate[$p],$slpluginid[$p],$em,2);
    }
    if ($editmsg=="")
    {
      if (function_exists("sl_onEmailValidate"))
        $editmsg=sl_onEmailValidate($em,2);
    }
    // Validate custom fields if required
    for ($k=1;$k<51;$k++)
    {
      $cusvar="cu".$k;
      $cusvar2="Custom".$k."Validate";
      $cusvar3="CustomTitle".$k;
      $cusvar4="sl_onCustom".$k."Validate";
      $cusvar5="slplugin_event_onCustom".$k."Validate";
      // Validate for plugins  
      for ($p=0;$p<$slnumplugins;$p++)   
      {
        if (($editmsg=="") && (function_exists(${$cusvar5}[$p])))
        {
          $editmsg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$$cusvar,$$cusvar3,2);
        }
      }
      // Validate using eventhandlers
      if (($editmsg=="") && (($$cusvar2==2) || ($$cusvar2==3)))
      {
        $editmsg=call_user_func($cusvar4,$$cusvar,$$cusvar3,2);
      }
    }
    // Concatenate groups and expiry times in table format
    $ug="";
    for ($k=1;$k<=$groupcount+5;$k++)
    {
      $pvar1="group".$k;
      $pvar2="expirydate".$k;
      if ($$pvar1!="")
      {
        if ($ug!="")
          $ug.="^";
        $ug.=$$pvar1;  
        if ($$pvar2!="")
        {
          // If expiry is number of days then convert to date
          if (strlen($$pvar2)<6)
          {
      			if ($DateFormat=="DDMMYY")
	            $expirystr=gmdate("dmy",time()+$$pvar2*86400);
			      if ($DateFormat=="MMDDYY")
	            $expirystr=gmdate("mdy",time()+$$pvar2*86400);            
          }
          else
            $expirystr=$$pvar2;
          $ug.=":";
          $ug.=$expirystr;
        }         
      }
    }
    if ($editmsg=="")
    {
      // Give last chance to plugins and event handler to block changes
      $paramdata['userid']="";  // Not yet known  	
      $paramdata['oldusername']=$user;
      $paramdata['username']=$newuser;
      $paramdata['password']=$pass;
      $paramdata['enabled']=$en;
      $paramdata['name']=$nm;
      $paramdata['email']=$em;
      $paramdata['usergroups']=$ug;
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
      $paramdata['from']=1;                      
      // Call plugin event
      for ($p=0;$p<$slnumplugins;$p++)
      {
        if ($editmsg=="")
        {
          if (function_exists($slplugin_event_onCheckModifyUser[$p]))
          {
            $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
            if ($res['ok']==false)
              $editmsg=$res['message'];
          } 
        }  
      }
    }
    if ($editmsg=="")
    {
      // Call eventhandler
      if (function_exists("sl_onCheckModifyUser"))
      {
        $res=sl_onCheckModifyUser($paramdata);
        if ($res['ok']==false)
          $editmsg=$res['message'];
      }  
    }  
    if ($editmsg=="")
    {	
      if (($MD5passwords!=true) || ($pass!=""))
      {
        $passtowrite=$pass;
        if ($MD5passwords)
          $passtowrite=md5($pass.$SiteKey);
        $Query="UPDATE ".$DbTableName." SET ".$UsernameField."=".sl_quote_smart($newuser).", ".$PasswordField.
        "=".sl_quote_smart($passtowrite).", ".$EnabledField."=".sl_quote_smart($en).", ".$NameField."=".sl_quote_smart($nm).", ".$EmailField."=".sl_quote_smart($em).", ".$UsergroupsField.
        "=".sl_quote_smart($ug).", ".$Custom1Field."=".sl_quote_smart($cu1).", ".$Custom2Field."=".sl_quote_smart($cu2).", ".$Custom3Field."=".sl_quote_smart($cu3).", ".$Custom4Field.
        "=".sl_quote_smart($cu4).", ".$Custom5Field."=".sl_quote_smart($cu5).", ".$Custom6Field."=".sl_quote_smart($cu6).", ".$Custom7Field."=".sl_quote_smart($cu7).", ".$Custom8Field.
        "=".sl_quote_smart($cu8).", ".$Custom9Field."=".sl_quote_smart($cu9).", ".$Custom10Field."=".sl_quote_smart($cu10).", ".$Custom11Field."=".sl_quote_smart($cu11).", ".$Custom12Field.
        "=".sl_quote_smart($cu12).", ".$Custom13Field."=".sl_quote_smart($cu13).", ".$Custom14Field."=".sl_quote_smart($cu14).", ".$Custom15Field."=".sl_quote_smart($cu15).", ".$Custom16Field.
        "=".sl_quote_smart($cu16).", ".$Custom17Field."=".sl_quote_smart($cu17).", ".$Custom18Field."=".sl_quote_smart($cu18).", ".$Custom19Field."=".sl_quote_smart($cu19).", ".$Custom20Field.
        "=".sl_quote_smart($cu20).", ".$Custom21Field."=".sl_quote_smart($cu21).", ".$Custom22Field."=".sl_quote_smart($cu22).", ".$Custom23Field."=".sl_quote_smart($cu23).", ".$Custom24Field.
        "=".sl_quote_smart($cu24).", ".$Custom25Field."=".sl_quote_smart($cu25).", ".$Custom26Field."=".sl_quote_smart($cu26).", ".$Custom27Field."=".sl_quote_smart($cu27).", ".$Custom28Field.
        "=".sl_quote_smart($cu28).", ".$Custom29Field."=".sl_quote_smart($cu29).", ".$Custom30Field."=".sl_quote_smart($cu30).", ".$Custom31Field."=".sl_quote_smart($cu31).", ".$Custom32Field.
        "=".sl_quote_smart($cu32).", ".$Custom33Field."=".sl_quote_smart($cu33).", ".$Custom34Field."=".sl_quote_smart($cu34).", ".$Custom35Field."=".sl_quote_smart($cu35).", ".$Custom36Field.
        "=".sl_quote_smart($cu36).", ".$Custom37Field."=".sl_quote_smart($cu37).", ".$Custom38Field."=".sl_quote_smart($cu38).", ".$Custom39Field."=".sl_quote_smart($cu39).", ".$Custom40Field.
        "=".sl_quote_smart($cu40).", ".$Custom41Field."=".sl_quote_smart($cu41).", ".$Custom42Field."=".sl_quote_smart($cu42).", ".$Custom43Field."=".sl_quote_smart($cu43).", ".$Custom44Field.
        "=".sl_quote_smart($cu44).", ".$Custom45Field."=".sl_quote_smart($cu45).", ".$Custom46Field."=".sl_quote_smart($cu46).", ".$Custom47Field."=".sl_quote_smart($cu47).", ".$Custom48Field.
        "=".sl_quote_smart($cu48).", ".$Custom49Field."=".sl_quote_smart($cu49).", ".$Custom50Field."=".sl_quote_smart($cu50)." WHERE ".$UsernameField."=".sl_quote_smart($user);
      }
      else
      {
        $Query="UPDATE ".$DbTableName." SET ".$UsernameField."=".sl_quote_smart($newuser).", ".$EnabledField."=".sl_quote_smart($en).", ".$NameField."=".sl_quote_smart($nm).", ".$EmailField."=".sl_quote_smart($em).", ".$UsergroupsField.
        "=".sl_quote_smart($ug).", ".$Custom1Field."=".sl_quote_smart($cu1).", ".$Custom2Field."=".sl_quote_smart($cu2).", ".$Custom3Field."=".sl_quote_smart($cu3).", ".$Custom4Field.
        "=".sl_quote_smart($cu4).", ".$Custom5Field."=".sl_quote_smart($cu5).", ".$Custom6Field."=".sl_quote_smart($cu6).", ".$Custom7Field."=".sl_quote_smart($cu7).", ".$Custom8Field.
        "=".sl_quote_smart($cu8).", ".$Custom9Field."=".sl_quote_smart($cu9).", ".$Custom10Field."=".sl_quote_smart($cu10).", ".$Custom11Field."=".sl_quote_smart($cu11).", ".$Custom12Field.
        "=".sl_quote_smart($cu12).", ".$Custom13Field."=".sl_quote_smart($cu13).", ".$Custom14Field."=".sl_quote_smart($cu14).", ".$Custom15Field."=".sl_quote_smart($cu15).", ".$Custom16Field.
        "=".sl_quote_smart($cu16).", ".$Custom17Field."=".sl_quote_smart($cu17).", ".$Custom18Field."=".sl_quote_smart($cu18).", ".$Custom19Field."=".sl_quote_smart($cu19).", ".$Custom20Field.
        "=".sl_quote_smart($cu20).", ".$Custom21Field."=".sl_quote_smart($cu21).", ".$Custom22Field."=".sl_quote_smart($cu22).", ".$Custom23Field."=".sl_quote_smart($cu23).", ".$Custom24Field.
        "=".sl_quote_smart($cu24).", ".$Custom25Field."=".sl_quote_smart($cu25).", ".$Custom26Field."=".sl_quote_smart($cu26).", ".$Custom27Field."=".sl_quote_smart($cu27).", ".$Custom28Field.
        "=".sl_quote_smart($cu28).", ".$Custom29Field."=".sl_quote_smart($cu29).", ".$Custom30Field."=".sl_quote_smart($cu30).", ".$Custom31Field."=".sl_quote_smart($cu31).", ".$Custom32Field.
        "=".sl_quote_smart($cu32).", ".$Custom33Field."=".sl_quote_smart($cu33).", ".$Custom34Field."=".sl_quote_smart($cu34).", ".$Custom35Field."=".sl_quote_smart($cu35).", ".$Custom36Field.
        "=".sl_quote_smart($cu36).", ".$Custom37Field."=".sl_quote_smart($cu37).", ".$Custom38Field."=".sl_quote_smart($cu38).", ".$Custom39Field."=".sl_quote_smart($cu39).", ".$Custom40Field.
        "=".sl_quote_smart($cu40).", ".$Custom41Field."=".sl_quote_smart($cu41).", ".$Custom42Field."=".sl_quote_smart($cu42).", ".$Custom43Field."=".sl_quote_smart($cu43).", ".$Custom44Field.
        "=".sl_quote_smart($cu44).", ".$Custom45Field."=".sl_quote_smart($cu45).", ".$Custom46Field."=".sl_quote_smart($cu46).", ".$Custom47Field."=".sl_quote_smart($cu47).", ".$Custom48Field.
        "=".sl_quote_smart($cu48).", ".$Custom49Field."=".sl_quote_smart($cu49).", ".$Custom50Field."=".sl_quote_smart($cu50)." WHERE ".$UsernameField."=".sl_quote_smart($user);
      }
      if ($DemoMode)
        $mysql_result=true;
      else  
        $mysql_result=mysqli_query($mysql_link,$Query);
      if ($mysql_result==false)
        $editmsg="Username has already been used!";
      else  
      {
        if (($mysql_result) && ($user!=$newuser))
          sl_usernamechanged($user,$newuser);
        // If user account has been disabled then destroy existing session if we can
        if ($en=="No")
        {
          $Query="SELECT ".$SessionField." FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user);
          $mysql_result=mysqli_query($mysql_link,$Query);
          if ($mysql_result==false)
          {
            print("User doesn't exist");
            mysqli_close($mysql_link);
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
        } 
       	if (($template!="") && ($sendemail=="on"))
      	{
  		    if (sl_ReadEmailTemplate($template,$subject,$mailBody,$htmlformat)==false)
  		    {
  		      print "<p class=\"editusererror\">Template $template could not be opened</p>\n";
  		    }
  		    else
  		    {
            if (($template!=$ModifyUserEmail) && (!$DemoMode))
            {
              $query="UPDATE ".$DbConfigTableName." SET modifyuseremail=".$template." WHERE confignum=1";
              $mysql_result=mysqli_query($mysql_link,$query);
              $ModifyUserEmail=$template;
              $_SESSION['ses_ConfigReload']="reload";     
            }		      
            $passtoemail=$pass;
            if ($pass=="")
              $passtoemail=$existingpass;
  			    if (sl_SendEmail($em,$mailBody,$subject,$htmlformat,$newuser,$passtoemail,$nm,$em,$ug,$cu1,$cu2,$cu3,$cu4,$cu5,$cu6,$cu7,$cu8,$cu9,$cu10,
  			    $cu11,$cu12,$cu13,$cu14,$cu15,$cu16,$cu17,$cu18,$cu19,$cu20,$cu21,$cu22,$cu23,$cu24,$cu25,$cu26,$cu27,$cu28,$cu29,$cu30,
  			    $cu31,$cu32,$cu33,$cu34,$cu35,$cu36,$cu37,$cu38,$cu39,$cu40,$cu41,$cu42,$cu43,$cu44,$cu45,$cu46,$cu47,$cu48,$cu49,$cu50)==1)
  			      $emailsent++;
  			  }
  			}
  			// Event point
        // Get auto increment id of user modified
        $mysql_result=mysql_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
        $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
        $paramdata['userid']=$row[$IdField];  	
        $paramdata['oldusername']=$user;
        $paramdata['username']=$newuser;
        $paramdata['password']=$pass;
        $paramdata['enabled']=$en;
        $paramdata['name']=$nm;
        $paramdata['email']=$em;
        $paramdata['usergroups']=$ug;
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
        $paramdata['from']=1;                      
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onModifyUser[$p]))
            call_user_func($slplugin_event_onModifyUser[$p],$slpluginid[$p],$paramdata);
        }
        // Call user event handler  			
        if (function_exists("sl_onModifyUser"))
          sl_onModifyUser($paramdata);
        header("Location: index.php");
        exit;  
      }
    }
  }
  else
  {
    $Query="SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user);
    $mysql_result=mysqli_query($mysql_link,$Query);
    if ($mysql_result==false)
    {
      print("User doesn't exist");
      mysqli_close($mysql_link);
      exit;
    }
    if ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $newuser=$row[$UsernameField];
      $pass=$row[$PasswordField];
      $en=$row[$EnabledField];
      $nm=$row[$NameField];
      $em=$row[$EmailField];
      $ug=$row[$UsergroupsField];
      $cu1=$row[$Custom1Field];
      $cu2=$row[$Custom2Field];
      $cu3=$row[$Custom3Field];
      $cu4=$row[$Custom4Field];
      $cu5=$row[$Custom5Field];
      $cu6=$row[$Custom6Field];
      $cu7=$row[$Custom7Field];
      $cu8=$row[$Custom8Field];
      $cu9=$row[$Custom9Field];
      $cu10=$row[$Custom10Field];
      $cu11=$row[$Custom11Field];
      $cu12=$row[$Custom12Field];
      $cu13=$row[$Custom13Field];
      $cu14=$row[$Custom14Field];
      $cu15=$row[$Custom15Field];
      $cu16=$row[$Custom16Field];
      $cu17=$row[$Custom17Field];
      $cu18=$row[$Custom18Field];
      $cu19=$row[$Custom19Field];
      $cu20=$row[$Custom20Field];
      $cu21=$row[$Custom21Field];
      $cu22=$row[$Custom22Field];
      $cu23=$row[$Custom23Field];
      $cu24=$row[$Custom24Field];
      $cu25=$row[$Custom25Field];
      $cu26=$row[$Custom26Field];
      $cu27=$row[$Custom27Field];
      $cu28=$row[$Custom28Field];
      $cu29=$row[$Custom29Field];
      $cu30=$row[$Custom30Field];
      $cu31=$row[$Custom31Field];
      $cu32=$row[$Custom32Field];
      $cu33=$row[$Custom33Field];
      $cu34=$row[$Custom34Field];
      $cu35=$row[$Custom35Field];
      $cu36=$row[$Custom36Field];
      $cu37=$row[$Custom37Field];
      $cu38=$row[$Custom38Field];
      $cu39=$row[$Custom39Field];
      $cu40=$row[$Custom40Field];
      $cu41=$row[$Custom41Field];
      $cu42=$row[$Custom42Field];
      $cu43=$row[$Custom43Field];
      $cu44=$row[$Custom44Field];
      $cu45=$row[$Custom45Field];
      $cu46=$row[$Custom46Field];
      $cu47=$row[$Custom47Field];
      $cu48=$row[$Custom48Field];
      $cu49=$row[$Custom49Field];
      $cu50=$row[$Custom50Field];
      // Convert existing groups and expiry dates into data to be displayed
      $grouparray=explode("^",$ug);
     	for ($k=0;$k<count($grouparray);$k++)
    	{
    	  $pvar1="group".($k+1);
    	  $pvar2="expirydate".($k+1);
   	    $$pvar1=strtok($grouparray[$k],":");
        $$pvar2=trim(strtok(":"));
    	}
    	$groupcount=count($grouparray);
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>
<link href="stylescommon.css" rel="stylesheet" type="text/css">
<link href="stylesgui.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="gui.js"></script> 
<title>Edit user</title>
</head>
<body>
<div id="combobox1div" class="combobox" onmouseover="combomouse=true;" onmouseout="combomouse=false;">
<ul class="combobox">
<?php
  $query="SELECT * FROM ".$DbGroupTableName." ORDER BY name ASC";
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
  {
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $name=$row['name'];
      print "<li onClick=\"comboBoxSelected('$name')\">$name</li>\n";
    }
	}
?>    
</ul>
</div>

<div class="calendar" id="calendardiv" onmouseover="calendarmouse=true;" onmouseout="calendarmouse=false;">
<table id="calendar" class="calendar" cellspacing="0">
  <tr>
    <td class="monthselect" onClick="previousYear()"><p class="monthselecttext">&lt;&lt;</p></td>
    <td class="monthselect" onClick="previousMonth()"><p class="monthselecttext">&lt;</p></td>
    <td class="monthselect" colspan="3"><p class="monthselecttext"></p></td>
    <td class="monthselect" onClick="nextMonth()"><p class="monthselecttext">&gt;</p></td>
    <td class="monthselect" onClick="nextYear()"><p class="monthselecttext">&gt;&gt;</p></td>
  </tr>
  <tr>
    <td class="dayofweek"><p class="dayofweektext">Su</p></td>
    <td class="dayofweek"><p class="dayofweektext">Mo</p></td>
    <td class="dayofweek"><p class="dayofweektext">Tu</p></td>
    <td class="dayofweek"><p class="dayofweektext">We</p></td>
    <td class="dayofweek"><p class="dayofweektext">Th</p></td>
    <td class="dayofweek"><p class="dayofweektext">Fr</p></td>
    <td class="dayofweek"><p class="dayofweektext">Sa</p></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
  </tr>
  <tr>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td class="dayofmonth" ></td>
    <td colspan="3" class="close"><p class="closetext" onClick="closeCalendar()">close</p></td>
  </tr>
</table>
</div>

<script  type="text/javascript">
<!--

function Random_Pass(form)
{
  var mask="<?php print $RandomPasswordMask; ?>"
  if (mask=="")
    mask="cccc##"
  var password="";   
  for (k=0;k<mask.length;k++)  
  {
    if (mask.charAt(k)=="c")
  	  password=password+"abcdefghijklmnopqrstuvwxyz".charAt(Math.round(25*Math.random()));
    if (mask.charAt(k)=="C")
  	  password=password+"ABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(Math.round(25*Math.random()));
    if (mask.charAt(k)=="#")
  	  password=password+"0123456789".charAt(Math.round(9*Math.random()));
    if (mask.charAt(k)=="X")
  	  password=password+"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ".charAt(Math.round(51*Math.random()));
    if (mask.charAt(k)=="A")
  	  password=password+"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".charAt(Math.round(61*Math.random()));
    if (mask.charAt(k)=="U")
  	  password=password+"<?php print $ValidPasswordChars; ?>".charAt(Math.round(<?php print strlen($ValidPasswordChars)-1; ?>*Math.random()));
  }
  form.pass.value=password  
}

function Edit_User(form)
{
  var str
  var k
  var prob
  // Validate entries
  str=form.newuser.value
  if (str.length==0)
  {
     alert("Please enter a Username")
     form.newuser.focus()
     return (false)
  }
  prob=0
  for (k=0;k<str.length;k++)
  {
    if ("<?php echo $ValidUsernameChars; ?>".indexOf(str.charAt(k))==-1)
    {
      prob=1
    }
  }
  if (prob==1)
  {
     alert("Username contains invalid characters!");
     form.newuser.focus();
     return (false);
  }
  str=form.pass.value
  <?php if (!$MD5passwords) { ?>
  if (str.length==0)
  {
     alert("Please enter a Password")
     form.pass.focus()
     return (false)
  }
  <?php } ?>
  prob=0
  for (k=0;k<str.length;k++)
  {
    if ("<?php echo $ValidPasswordChars; ?>".indexOf(str.charAt(k))==-1)
    {
      prob=1
    }
  }
  if (prob==1)
  {
     alert("Password contains invalid characters!");
     form.pass.focus();
     return (false);
  }
  if (form.nm.value.length==0)
  {
     alert("Please enter a Name")
     form.nm.focus()
     return (false)
  }
  if (validateemail(form.em.value)==false)
  {
    alert("Please enter a valid email address")
    form.em.focus()
    return (false);
  }
  // Check usergroup names and expiry dates
  for (k=1;k<=<?php echo $groupcount+5; ?>;k++)
  {
    groupfieldname="group"+k.toString()
    expiryfieldname="expirydate"+k.toString()
    groupfield=document.getElementsByName(groupfieldname).item(0)
    expiryfield=document.getElementsByName(expiryfieldname).item(0)
    str=groupfield.value
    for (j=0;j<str.length;j++)
    {
      if ("#{}()@.|0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(str.charAt(j))==-1)
      {
        alert("Usergroup contains invalid characters!")
        groupfield.focus()
        return (false)
      }
    }
    str=expiryfield.value
    for (j=0;j<str.length;j++)
    {
      if ("0123456789".indexOf(str.charAt(j))==-1)
      {
        alert("Expiry date contains invalid characters!")
        expiryfield.focus()
        return (false)
      }
    }
    if (str.length==6)
    {
      var dateformat='<?php echo $DateFormat; ?>'
      if (!datevalid(str,dateformat))
      {
          alert("Expiry date is not valid. Use "+dateformat+" format")
          expiryfield.focus()
          return (false)
      }
    }    
  }
  form.action="edituser.php"
  form.act.value="useredited"
  form.submit()
}

function Cancel_Edit(form)
{
  window.location = 'index.php'
}

function validateemail (emailStr) {
var emailPat=/^(.+)@(.+)$/
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
var validChars="\[^\\s" + specialChars + "\]"
var quotedUser="(\"[^\"]*\")"
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
var atom=validChars + '+'
var word="(" + atom + "|" + quotedUser + ")"
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
var matchArray=emailStr.match(emailPat)
if (matchArray==null)
 return false
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null)
    return false
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
  for (var i=1;i<=4;i++)
  {
    if (IPArray[i]>255)
      return false
  }
  return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null)
    return false
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 ||
    domArr[domArr.length-1].length>4)
   return false
if (len<2)
   return false
return true;
}
function datevalid(dt,fmt)
{
  var monthMax=new Array(31,29,31,30,31,30,31,31,30,31,30,31)
  if (dt.length!=6)
    return(false)
  if (fmt=="DDMMYY")
  {
    var day=dt.substring(0,2)
    var month=dt.substring(2,4)
    var year=dt.substring(4,6)
  }
  else
  {
    var month=dt.substring(0,2)
    var day=dt.substring(2,4)
    var year=dt.substring(4,6)
  }
  if ((isNaN(day)) || (isNaN(month)) || (isNaN(year)))
    return(false)
  var iday=parseInt(day,10)
  var imonth=parseInt(month,10)
  var iyear=parseInt(year,10)
  if ((imonth<1) || (imonth>12))
    return(false)
  if ((iyear<0) || (iyear>37))
    return(false)
  var top=monthMax[imonth-1]
  if ((iday<1) || (iday>top))
    return(false)
  if ((imonth==2) && (iday==29))
  {
    if ((iyear/4)!=(Math.floor(iyear/4)))
      return(false)
  }
  return(true)
}

function deleteGroup(num)
{
  if (confirm("Delete this entry?"))
  {
    field=document.getElementsByName('group'+num.toString()).item(0)  
    field.value=""
    field=document.getElementsByName('expirydate'+num.toString()).item(0)  
    field.value=""
  }
}

function groupUp(n)
{
  if (n==1)
    return
  p=n-1  
  gfieldn=document.getElementsByName('group'+n.toString()).item(0)  
  efieldn=document.getElementsByName('expirydate'+n.toString()).item(0)
  gfieldp=document.getElementsByName('group'+p.toString()).item(0)  
  efieldp=document.getElementsByName('expirydate'+p.toString()).item(0)
  gtemp=gfieldp.value
  etemp=efieldp.value
  gfieldp.value=gfieldn.value
  efieldp.value=efieldn.value
  gfieldn.value=gtemp
  efieldn.value=etemp
}

function groupDown(n)
{
  if (n==5)
    return
  p=n+1  
  gfieldn=document.getElementsByName('group'+n.toString()).item(0)  
  efieldn=document.getElementsByName('expirydate'+n.toString()).item(0)
  gfieldp=document.getElementsByName('group'+p.toString()).item(0)  
  efieldp=document.getElementsByName('expirydate'+p.toString()).item(0)
  gtemp=gfieldp.value
  etemp=efieldp.value
  gfieldp.value=gfieldn.value
  efieldp.value=efieldn.value
  gfieldn.value=gtemp
  efieldn.value=etemp
}

function sendemailclicked()
{
  var cb= document.getElementById("sendemail")
  var template = document.getElementById("template")
  if (cb.checked)
  {
    template.disabled=false
    template.className = template.className.replace(/\bselectdisabled\b/,'')
    template.focus()
  }
  else
  {
    template.disabled=true
    if (template.className.indexOf("selectdisabled",0)==-1)        
      template.className += " selectdisabled";
  }  
}

function limitText(limitField, limitNum)
{
	if (limitField.value.length > limitNum)
		limitField.value = limitField.value.substring(0, limitNum);
}
// -->
</script>
<?php include "headeradminother.php"; ?>
<h1>Edit User</h1>
<form name="form1" action="edituser.php" method="POST">
<input name="act" type="hidden" value="">
<input name="user" type="hidden" value="<?php echo htmlentities($user,ENT_QUOTES,strtoupper($MetaCharSet)) ?>">
<input name="groupcount" type="hidden" value="<?php echo htmlentities($groupcount,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">
<?php if ($editmsg!="") { ?>
<p class="formerror"><?php echo $editmsg; ?></p>
<?php } ?>

<fieldset>
<legend>User Details</legend>

<div class="verticalfield">
<label class="verticalfield" for="newuser">Username</label>
<input class="inputtext" type="text" name="newuser" id="newuser" maxlength="50" value="<?php echo htmlentities($newuser,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
</div>

<div class="verticalfield">
<label class="verticalfield" for="pass">Password</label>
<input class="inputtext" type="text" name="pass" id="pass" maxlength="50" value="<?php if (!$MD5passwords) echo htmlentities($pass,ENT_QUOTES,strtoupper($MetaCharSet)) ?>">
<button type="button" id="random-go" name="randombutton" value="Random" onclick="Random_Pass(this.form);">Random</button>
<?php if ($MD5passwords) { ?>
<p class="textfieldnote"> Leave blank for existing password (MD5 encoded)</p>
<?php } ?>
</div>

<input type="hidden" name="existingpass" value="<?php echo htmlentities($pass,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">

<div class="verticalfield">
<label class="verticalfield" for="en">Enabled</label>
<select name="en" id="en" size="1">
<option value="Yes" <?php if (($en=="Yes") || ($en=="")) echo "selected=selected"; ?>>Yes</option>
<option value="No" <?php if ($en=="No") echo "selected=selected"; ?>>No</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="nm">Name</label>
<input class="inputtext" type="text" name="nm" id="nm" maxlength="50" value="<?php echo htmlentities($nm,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
</div>

<div class="verticalfield">
<label class="verticalfield" for="em">Email</label>
<input class="inputtext" type="text" name="em" id="em" maxlength="50" value="<?php echo htmlentities($em,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
</div>

</fieldset>

<fieldset>
<legend>Usergroups</legend>
<p class="sectionnotes">Enter or select the group(s) the user should belong to. You can also enter an optional expiry
date (<?php echo $DateFormat; ?>). For no expiry leave the date field blank.
If you need more usergroups just save the user then click edit user to add more.
</p>

<?php
for ($k=1;$k<=($groupcount+5);$k++)
{
$groupvar="group".$k;
$datevar="expirydate".$k;
?>
<div class="horizontalfield">
<label class="verticalfield" for="group<?php echo $k; ?>">Group name</label>
<input class="inputtext short" type="text" name="group<?php echo $k; ?>" id="group<?php echo $k; ?>" maxlength="50" value="<?php echo htmlentities($$groupvar,ENT_QUOTES,strtoupper($MetaCharSet)); ?>" onBlur="guiCloseIfOutside();">
<img src="dropdown.png" width="17" height="16" align="absmiddle" onClick="comboBox('group<?php echo $k; ?>','combobox1div');" alt="Click to select" title="Click to select" style="cursor: pointer;" >
</div>
<div class="horizontalfield">
<label class="horizontalfield" for="expirydate<?php echo $k; ?>">Expiry date</label>
<input class="inputtext short" name="expirydate<?php echo $k; ?>" id="expirydate<?php echo $k; ?>" type="text" maxlength="6" value="<?php echo htmlentities($$datevar,ENT_QUOTES,strtoupper($MetaCharSet)); ?>" onBlur="guiCloseIfOutside();">
<img src="cal.png" width="16" height="16" align="absmiddle" onClick="openCalendar('expirydate<?php echo $k; ?>','<?php echo $DateFormat; ?>');" alt="Calendar" title="Calendar" style="cursor: pointer;" >
<img src="uparrow.png" width="16" height="16" align="absmiddle" onClick="groupUp(<?php echo $k; ?>);" alt="Move group up" title="Move group up" style="cursor: pointer;" >
<img src="downarrow.png" width="16" height="16" align="absmiddle" onClick="groupDown(<?php echo $k; ?>);" alt="Move group down" title="Move group down" style="cursor: pointer;" >
<img src="delete.png" width="16" height="16" align="absmiddle" onClick="deleteGroup(<?php echo $k; ?>);" alt="Delete Group" title="Delete Group" style="cursor: pointer;" >
</div>
<?php } ?>
</fieldset>

<fieldset>
<legend>Custom fields</legend>
<div class="blankspace">
</div>

<?php
$mysql_link=sl_DBconnect();
if ($mysql_link==false)
{
  print("Can't connect to MySQL server");
  exit;
}
$mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." LIMIT 1");
$fcharset=mysqli_get_charset($mysql_link);
$finfo=mysqli_fetch_fields($mysql_result);
for ($k=1;$k<=50;$k++)
{
$titlevar="CustomTitle".$k;
$valuevar="cu".$k;
$fieldlength = ($finfo[$k+7]->length)/$fcharset->max_length;
if ($$titlevar!="")
{
  if ($fieldlength>255)
  {
?>

<div class="verticalfield">
<label class="verticalfield" for="<?php echo $valuevar; ?>"><?php echo $$titlevar; ?></label>
<textarea class="textarea" name="<?php echo $valuevar; ?>" id="<?php echo $valuevar; ?>" onKeyDown="limitText(this.form.<?php echo $valuevar; ?>,<?php echo $fieldlength; ?>);" onKeyUp="limitText(this.form.<?php echo $valuevar; ?>,<?php echo $fieldlength; ?>);" ><?php echo htmlentities($$valuevar,ENT_QUOTES,strtoupper($MetaCharSet)); ?></textarea>
</div>

<?php } else { ?>

<div class="verticalfield">
<label class="verticalfield" for="<?php echo $valuevar; ?>"><?php echo $$titlevar; ?></label>
<input class="inputtext long" type="text" name="<?php echo $valuevar; ?>" id="<?php echo $valuevar; ?>" maxlength="255" value="<?php echo htmlentities($$valuevar,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
</div>

<?php
}
}
}
?>
</fieldset>

<fieldset>
<legend>Email user when saved</legend>

<div class="blankspace">
</div>

<div class="horizontalfield">
<label class="verticalfield" for="sendemail">Email user?</label>
<input type="checkbox" name="sendemail" id="sendemail" class="inputcheckbox" value="on" onClick="sendemailclicked();" <?php if ($sendemail=="on") print "checked=\"checked\""; ?>>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="template">Template</label>
<select <?php if ($sendemail=="") echo "class=\"selectdisabled\""; ?> name="template" id="template" size="1" <?php if ($sendemail!="on") print "disabled=\"disabled\""; ?>>
      <?php
			if ($template!="")
				$templatematch=$template;
			else
				$templatematch=$NewUserEmail;
      if ($EmailLocation!="")
        $emailpath=$EmailLocation;
      else
        $emailpath=$SitelokLocation."email/";     									
      $templates=scandir($emailpath,0);
      natcasesort($templates); 
      if ($templates!==false)
      {
        foreach ($templates as $entryname)
        {
          if (($entryname!=".") && ($entryname!="..") && ($entryname!=""))
          {
            $ext=ufileextension($entryname);
            if (($ext==".txt") || ($ext==".htm") || ($ext==".html"))
            {
            	print "<option value=\"$entryname\"";
              if ($templatematch==$entryname) print "selected=selected";
                print ">$entryname</option>\n";
            }  
          }
        }
      }
      function ufileextension($fname)
      {
      	if ($fname=="")
      	  return("");
      	$pos=strrpos($fname,".");
      	if (is_integer($pos))
      		return(strtolower(substr($fname,$pos)));
      	return("");
      }  
      ?>
</select>
</div>
</fieldset>
<div><button type="button" id="save-go" name="addbutton" value="Save" onclick="Edit_User(this.form);">Save</button><button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button></div>
</form>
<script  type="text/javascript">
  var obj=document.getElementById("newuser")
  obj.focus()
</script>
<?php include "footeradminother.php"; ?>
</body>
</html>
<?php
// mysqli_close($mysql_link);
?>