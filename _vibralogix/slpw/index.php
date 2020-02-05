<?php
  reset($_POST);
  reset($_GET);
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$noaccesspage="";
  require("sitelokpw.php");
  @set_time_limit(86400);
  // Remove loggedout,remember,username and password from GET if found
  if (isset($_GET['loggedout']))
    unset($_GET['loggedout']);
  if (isset($_GET['remember']))
    unset($_GET['remember']);
  if (isset($_GET['username']))
    unset($_GET['username']);
  if (isset($_GET['password']))
    unset($_GET['password']);
  if (isset($_GET['fbstatus']))
    unset($_GET['fbstatus']);
  if ((!empty($_GET)) || (!empty($_POST)))
  {   
    if ($slcsrf!=$_SESSION['ses_slcsrf'])
    {
      print "Form tampering detected";
      exit;
    }  
  }  
  if ($sl_noqueryoption)
  {
    if ($act=="query")
      $act="";
    $sqlinput="";
  }  
  // If main admin form submitted then store data in session
//  if (!empty( $_POST ))
  if ((!empty( $_POST )) && ($recordsperpage!=""))
  {
    if (get_magic_quotes_gpc())
    {
      $fildata1=stripslashes($fildata1);
      $fildata2=stripslashes($fildata2);
      $fildata3=stripslashes($fildata3);
      $fildata4=stripslashes($fildata4);
      $sqlquery=stripslashes($sqlquery);
      $sqlinput=stripslashes($sqlinput);
      $quicksearch=stripslashes($quicksearch);
      $memberof=stripslashes($memberof);
      $unexpmemberof=stripslashes($unexpmemberof);
      $expmemberof=stripslashes($expmemberof);
      $expwithin=stripslashes($expwithin);
      if (isset($body))
  	    $body=stripslashes($body);
    }
    if (($sqlquery!="") && ($DemoMode))
      $sqlquery="";
    $_SESSION['ses_admin_tablestart']=$tablestart;
    $_SESSION['ses_admin_sqlquery']=$sqlquery;
    $_SESSION['ses_admin_sqlinput']=$sqlinput;
    $_SESSION['ses_admin_filfield1']=$filfield1;
    $_SESSION['ses_admin_filcond1']=$filcond1;
    $_SESSION['ses_admin_fildata1']=$fildata1;
    $_SESSION['ses_admin_filfield2']=$filfield2;
    $_SESSION['ses_admin_filcond2']=$filcond2;
    $_SESSION['ses_admin_fildata2']=$fildata2;
    $_SESSION['ses_admin_filfield3']=$filfield3;
    $_SESSION['ses_admin_filcond3']=$filcond3;
    $_SESSION['ses_admin_fildata3']=$fildata3;
    $_SESSION['ses_admin_filfield4']=$filfield4;
    $_SESSION['ses_admin_filcond4']=$filcond4;
    $_SESSION['ses_admin_fildata4']=$fildata4;
    $_SESSION['ses_admin_filbool1']=$filbool1;
    $_SESSION['ses_admin_filbool2']=$filbool2;
    $_SESSION['ses_admin_filbool3']=$filbool3;
    $_SESSION['ses_admin_sortf']=$sortf;
    $_SESSION['ses_admin_sortd']=$sortd;
    $_SESSION['ses_admin_filteron']=$filteron;
    $_SESSION['ses_admin_recordsperpage']=$recordsperpage;
    $_SESSION['ses_admin_simfildisplayed']=$simfildisplayed;
    $_SESSION['ses_admin_advfildisplayed']=$advfildisplayed;
    $_SESSION['ses_admin_sqlfildisplayed']=$sqlfildisplayed;
    $_SESSION['ses_admin_quicksearch']=$quicksearch;
    $_SESSION['ses_admin_memberof']=$memberof;
    $_SESSION['ses_admin_unexpmemberof']=$unexpmemberof;
    $_SESSION['ses_admin_expmemberof']=$expmemberof;
    $_SESSION['ses_admin_expwithin']=$expwithin;
    $_SESSION['ses_admin_expwithindays']=$expwithindays;
    $_SESSION['ses_admin_joinwithin']=$joinwithin;
    $_SESSION['ses_admin_onlyselected']=$onlyselected;
  }
  if (($sqlquery!="") && ($DemoMode))
    $sqlquery="";
  $tablestart=$_SESSION['ses_admin_tablestart'];
  $sqlquery=$_SESSION['ses_admin_sqlquery'];
  $sqlinput=$_SESSION['ses_admin_sqlinput'];
  $filfield1=$_SESSION['ses_admin_filfield1'];
  $filcond1=$_SESSION['ses_admin_filcond1'];
  $fildata1=$_SESSION['ses_admin_fildata1'];
  $filfield2=$_SESSION['ses_admin_filfield2'];
  $filcond2=$_SESSION['ses_admin_filcond2'];
  $fildata2=$_SESSION['ses_admin_fildata2'];
  $filfield3=$_SESSION['ses_admin_filfield3'];
  $filcond3=$_SESSION['ses_admin_filcond3'];
  $fildata3=$_SESSION['ses_admin_fildata3'];
  $filfield4=$_SESSION['ses_admin_filfield4'];
  $filcond4=$_SESSION['ses_admin_filcond4'];
  $fildata4=$_SESSION['ses_admin_fildata4'];
  $filbool1=$_SESSION['ses_admin_filbool1'];
  $filbool2=$_SESSION['ses_admin_filbool2'];
  $filbool3=$_SESSION['ses_admin_filbool3'];
  $sortf=$_SESSION['ses_admin_sortf'];
  $sortd=$_SESSION['ses_admin_sortd'];
  $filteron=$_SESSION['ses_admin_filteron'];
  $recordsperpage=$_SESSION['ses_admin_recordsperpage'];
  $simfildisplayed=$_SESSION['ses_admin_simfildisplayed'];
  $advfildisplayed=$_SESSION['ses_admin_advfildisplayed'];
  $sqlfildisplayed=$_SESSION['ses_admin_sqlfildisplayed'];
  $quicksearch=$_SESSION['ses_admin_quicksearch'];
  $memberof=$_SESSION['ses_admin_memberof'];
  $unexpmemberof=$_SESSION['ses_admin_unexpmemberof'];
  $expmemberof=$_SESSION['ses_admin_expmemberof'];
  $expwithin=$_SESSION['ses_admin_expwithin'];
  $expwithindays=$_SESSION['ses_admin_expwithindays'];
  $joinwithin=$_SESSION['ses_admin_joinwithin'];
  $onlyselected=$_SESSION['ses_admin_onlyselected'];
	if ($recordsperpage!="")
	{ 
	  if (substr($recordsperpage,0,3)=="ALL")
	    $ShowRows=substr($recordsperpage,3);
	  else
	    $ShowRows=$recordsperpage;
	}  
	else
	  $recordsperpage=$ShowRows;    
  if (!isset($tablestart))
    $tablestart=0;
  if ($sljustloggedin)
    $act="start";
  if (($sqlquery!="") && ($DemoMode))
    $sqlquery="";    
	$emailsent=0;
	$emailblocked=0;
	$emailfail=0;  
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  // Get list of usergroup names
  $groupname=array();
  $query="SELECT * FROM ".$DbGroupTableName." ORDER BY name ASC";
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
	{
	  $k=0;
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $groupname[$k]=$row['name'];
      $k++;
    }
  } 
  // See if any users selected manually that need to be selected in the DB 
  if ($act!="start")
  {
    $k=0;
		$pvar1="sl".$k;
    while (isset($$pvar1))
	  {
	    $sl=substr($$pvar1,0,1);
	    $id=substr($$pvar1,1);
	    if ($sl=="Y")
	    {
		    $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' WHERE ".$IdField."=".sl_quote_smart($id));
	    }
	    if ($sl=="N")
	    {
		    $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='No' WHERE ".$IdField."=".sl_quote_smart($id));
		  }
		  $k++;
			$pvar1="sl".$k;
	  }
	}  
  if ((!isset($sortf)) || (!isset($sortd)))
  {
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbConfigTableName." LIMIT 1");
    if ($mysql_result!=false)
    {
    	$row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
      if ($row!=false)
      {
        $sortf=$row["sortfield"];
        $sortd=$row["sortdirection"];
      }
    }  
  }
  // If opening another admin page
  if ($act=="openadminpage")
  {
    if (get_magic_quotes_gpc())
      $adminpage=stripslashes($adminpage);
    header("Location: ".$adminpage);
    exit;
  }
  if ($act=="sort")
  {
    // Store sort field and direction in configuration table
    $query="UPDATE ".$DbConfigTableName." SET sortfield='".$sortf."', sortdirection='".$sortd."' WHERE confignum=1";
    $mysql_result=mysqli_query($mysql_link,$query);
  }  
  if (($act=="delete") && ($user!=""))
  {
    if (!$DemoMode)
    {
      // If required call event handler
      $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
      if ($mysql_result!=false)
      {
        $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
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
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onDeleteUser[$p]))
            call_user_func($slplugin_event_onDeleteUser[$p],$slpluginid[$p],$paramdata);
        }
        // Call user event handler       
        if (function_exists("sl_onDeleteUser"))
          sl_onDeleteUser($paramdata);  
      }
      // Delete the session data associated with this user if known.
      if ($row[$SessionField]!="")
      {
        $ThisSession=session_id();
        session_id($row[$SessionField]);
        @session_destroy();
        if ($SessionName!="")
          session_name($SessionName);
        session_id($ThisSession);
        session_start();     
      }
      $mysql_result=mysqli_query($mysql_link,"DELETE FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
      // Process after deleting user
      sl_userdeleted($user);
    }
  }
  if (($act=="passremind") && ($user!=""))
  {
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
    if ($mysql_result!=false)
    {
      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
      $selected=$row[$SelectedField];
      $created=$row[$CreatedField];
      $user=$row[$UsernameField];
      $pass=$row[$PasswordField];
      $enabled=$row[$EnabledField];
      $name=$row[$NameField];
      $email=$row[$EmailField];
      $groups=$row[$UsergroupsField];
      $cus1=$row[$Custom1Field];
      $cus2=$row[$Custom2Field];
      $cus3=$row[$Custom3Field];
      $cus4=$row[$Custom4Field];
      $cus5=$row[$Custom5Field];
      $cus6=$row[$Custom6Field];
      $cus7=$row[$Custom7Field];
      $cus8=$row[$Custom8Field];
      $cus9=$row[$Custom9Field];
      $cus10=$row[$Custom10Field];
      $cus11=$row[$Custom11Field];
      $cus12=$row[$Custom12Field];
      $cus13=$row[$Custom13Field];
      $cus14=$row[$Custom14Field];
      $cus15=$row[$Custom15Field];
      $cus16=$row[$Custom16Field];
      $cus17=$row[$Custom17Field];
      $cus18=$row[$Custom18Field];
      $cus19=$row[$Custom19Field];
      $cus20=$row[$Custom20Field];
      $cus21=$row[$Custom21Field];
      $cus22=$row[$Custom22Field];
      $cus23=$row[$Custom23Field];
      $cus24=$row[$Custom24Field];
      $cus25=$row[$Custom25Field];
      $cus26=$row[$Custom26Field];
      $cus27=$row[$Custom27Field];
      $cus28=$row[$Custom28Field];
      $cus29=$row[$Custom29Field];
      $cus30=$row[$Custom30Field];
      $cus31=$row[$Custom31Field];
      $cus32=$row[$Custom32Field];
      $cus33=$row[$Custom33Field];
      $cus34=$row[$Custom34Field];
      $cus35=$row[$Custom35Field];
      $cus36=$row[$Custom36Field];
      $cus37=$row[$Custom37Field];
      $cus38=$row[$Custom38Field];
      $cus39=$row[$Custom39Field];
      $cus40=$row[$Custom40Field];
      $cus41=$row[$Custom41Field];
      $cus42=$row[$Custom42Field];
      $cus43=$row[$Custom43Field];
      $cus44=$row[$Custom44Field];
      $cus45=$row[$Custom45Field];
      $cus46=$row[$Custom46Field];
      $cus47=$row[$Custom47Field];
      $cus48=$row[$Custom48Field];
      $cus49=$row[$Custom49Field];
      $cus50=$row[$Custom50Field];
      if (sl_ReadEmailTemplate($ForgottenEmail,$subject,$mailBody,$htmlformat))
	     $emres=sl_SendEmail($email,$mailBody,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
      $cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
      $cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50);	    
      if ($emres==1)
       	$emailsent++;
      if ($emres==2)
       	$emailblocked++;
      if ($emres==0)
      	$emailfail++;
    }
  }  
  if (($act=="emailuser") && ($user!=""))
  {
    if (get_magic_quotes_gpc())
    {
      $body=stripslashes($body);
      $subject=stripslashes($subject);    
    }    
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
	  if ($mysql_result!=false)
	  {
      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
      if ($row!=false)
      {
        $selected=$row[$SelectedField];
        $created=$row[$CreatedField];
        $user=$row[$UsernameField];
        $pass=$row[$PasswordField];
        $enabled=$row[$EnabledField];
        $name=$row[$NameField];
        $email=$row[$EmailField];
        $groups=$row[$UsergroupsField];
        $cus1=$row[$Custom1Field];
        $cus2=$row[$Custom2Field];
        $cus3=$row[$Custom3Field];
        $cus4=$row[$Custom4Field];
        $cus5=$row[$Custom5Field];
        $cus6=$row[$Custom6Field];
        $cus7=$row[$Custom7Field];
        $cus8=$row[$Custom8Field];
        $cus9=$row[$Custom9Field];
        $cus10=$row[$Custom10Field];
        $cus11=$row[$Custom11Field];
        $cus12=$row[$Custom12Field];
        $cus13=$row[$Custom13Field];
        $cus14=$row[$Custom14Field];
        $cus15=$row[$Custom15Field];
        $cus16=$row[$Custom16Field];
        $cus17=$row[$Custom17Field];
        $cus18=$row[$Custom18Field];
        $cus19=$row[$Custom19Field];
        $cus20=$row[$Custom20Field];
        $cus21=$row[$Custom21Field];
        $cus22=$row[$Custom22Field];
        $cus23=$row[$Custom23Field];
        $cus24=$row[$Custom24Field];
        $cus25=$row[$Custom25Field];
        $cus26=$row[$Custom26Field];
        $cus27=$row[$Custom27Field];
        $cus28=$row[$Custom28Field];
        $cus29=$row[$Custom29Field];
        $cus30=$row[$Custom30Field];
        $cus31=$row[$Custom31Field];
        $cus32=$row[$Custom32Field];
        $cus33=$row[$Custom33Field];
        $cus34=$row[$Custom34Field];
        $cus35=$row[$Custom35Field];
        $cus36=$row[$Custom36Field];
        $cus37=$row[$Custom37Field];
        $cus38=$row[$Custom38Field];
        $cus39=$row[$Custom39Field];
        $cus40=$row[$Custom40Field];
        $cus41=$row[$Custom41Field];
        $cus42=$row[$Custom42Field];
        $cus43=$row[$Custom43Field];
        $cus44=$row[$Custom44Field];
        $cus45=$row[$Custom45Field];
        $cus46=$row[$Custom46Field];
        $cus47=$row[$Custom47Field];
        $cus48=$row[$Custom48Field];
        $cus49=$row[$Custom49Field];
        $cus50=$row[$Custom50Field];
        $emres=sl_SendEmail($email,$body,$subject,$htmlformat,$user,$pass,$name,$email,$groups,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
        $cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
        $cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50);
        if ($emres==1)
	       	$emailsent++;
        if ($emres==2)
	       	$emailblocked++;
        if ($emres==0)
	      	$emailfail++;
      }
    }
  }
  if (($act=="emaildirect") && ($email!=""))
  {
    if (get_magic_quotes_gpc())
    {
      $body=stripslashes($body);
      $subject=stripslashes($subject);    
    }    
    $emailaddresses=explode(",",$email);
    for ($k=0;$k<count($emailaddresses);$k++)
    {
      $emailaddresses[$k]=trim($emailaddresses[$k]);
      $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($emailaddresses[$k]));
  	  if ($mysql_result!=false)
  	  {
        $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
        if ($row!=false)
        {
          $selected=$row[$SelectedField];
          $created=$row[$CreatedField];
          $user=$row[$UsernameField];
          $pass=$row[$PasswordField];
          $enabled=$row[$EnabledField];
          $name=$row[$NameField];
          //$email=$row[$EmailField];
          $groups=$row[$UsergroupsField];
          $cus1=$row[$Custom1Field];
          $cus2=$row[$Custom2Field];
          $cus3=$row[$Custom3Field];
          $cus4=$row[$Custom4Field];
          $cus5=$row[$Custom5Field];
          $cus6=$row[$Custom6Field];
          $cus7=$row[$Custom7Field];
          $cus8=$row[$Custom8Field];
          $cus9=$row[$Custom9Field];
          $cus10=$row[$Custom10Field];
          $cus11=$row[$Custom11Field];
          $cus12=$row[$Custom12Field];
          $cus13=$row[$Custom13Field];
          $cus14=$row[$Custom14Field];
          $cus15=$row[$Custom15Field];
          $cus16=$row[$Custom16Field];
          $cus17=$row[$Custom17Field];
          $cus18=$row[$Custom18Field];
          $cus19=$row[$Custom19Field];
          $cus20=$row[$Custom20Field];
          $cus21=$row[$Custom21Field];
          $cus22=$row[$Custom22Field];
          $cus23=$row[$Custom23Field];
          $cus24=$row[$Custom24Field];
          $cus25=$row[$Custom25Field];
          $cus26=$row[$Custom26Field];
          $cus27=$row[$Custom27Field];
          $cus28=$row[$Custom28Field];
          $cus29=$row[$Custom29Field];
          $cus30=$row[$Custom30Field];
          $cus31=$row[$Custom31Field];
          $cus32=$row[$Custom32Field];
          $cus33=$row[$Custom33Field];
          $cus34=$row[$Custom34Field];
          $cus35=$row[$Custom35Field];
          $cus36=$row[$Custom36Field];
          $cus37=$row[$Custom37Field];
          $cus38=$row[$Custom38Field];
          $cus39=$row[$Custom39Field];
          $cus40=$row[$Custom40Field];
          $cus41=$row[$Custom41Field];
          $cus42=$row[$Custom42Field];
          $cus43=$row[$Custom43Field];
          $cus44=$row[$Custom44Field];
          $cus45=$row[$Custom45Field];
          $cus46=$row[$Custom46Field];
          $cus47=$row[$Custom47Field];
          $cus48=$row[$Custom48Field];
          $cus49=$row[$Custom49Field];
          $cus50=$row[$Custom50Field];
          $emres=sl_SendEmail($emailaddresses[$k],$body,$subject,$htmlformat,$user,$pass,$name,$emailaddresses[$k],$groups,$cus1,$cus2,$cus3,$cus4,$cus5,$cus6,$cus7,$cus8,$cus9,$cus10,
          $cus11,$cus12,$cus13,$cus14,$cus15,$cus16,$cus17,$cus18,$cus19,$cus20,$cus21,$cus22,$cus23,$cus24,$cus25,$cus26,$cus27,$cus28,$cus29,$cus30,
          $cus31,$cus32,$cus33,$cus34,$cus35,$cus36,$cus37,$cus38,$cus39,$cus40,$cus41,$cus42,$cus43,$cus44,$cus45,$cus46,$cus47,$cus48,$cus49,$cus50);
          if ($emres==1)
           	$emailsent++;
          if ($emres==2)
           	$emailblocked++;
          if ($emres==0)
          	$emailfail++;
        }
        else
        {
          $emres=sl_SendEmail($emailaddresses[$k],$body,$subject,$htmlformat,"","","",$emailaddresses[$k],"","","","","","","","","","","");
          if ($emres==1)
           	$emailsent++;
          if ($emres==2)
           	$emailblocked++;
          if ($emres==0)
          	$emailfail++;
        }
  	  }  
    } 	
  }
  if ($act=="deleteselected")
  {
    if (!$DemoMode)
    {
      // Remove user from log entries, order control and Sitelok
      $delquery="DELETE ".$DbLogTableName.".* ";
      $delquery.="FROM ".$DbTableName.", ".$DbLogTableName." ";
      $delquery.="WHERE ".$DbTableName.".".$UsernameField." = ".$DbLogTableName.".username ";
      $delquery.="AND ".$DbTableName.".".$SelectedField."='Yes'"; 
      $mysql_result=mysqli_query($mysql_link,$delquery);
      
      $delquery="DELETE ".$DbOrdersTableName.".* ";
      $delquery.="FROM ".$DbTableName.", ".$DbOrdersTableName." ";
      $delquery.="WHERE ".$DbTableName.".".$UsernameField." = ".$DbOrdersTableName.".username ";
      $delquery.="AND ".$DbTableName.".".$SelectedField."='Yes'"; 
      $mysql_result=mysqli_query($mysql_link,$delquery);
      
      // If required call sl_onDeleteUser() event for each user being deleted
      $mysql_result=mysqli_query($mysql_link,"SELECT count(*) FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'");
      $row = mysqli_fetch_row($mysql_result);
      if ($row!=false)
        $matchrows = $row[0];
      else
        $matchrows=0;
      for ($l=0;$l<$matchrows;$l=$l+$sl_dbblocksize)
      {
        $limit=" LIMIT ".$l.",".$sl_dbblocksize;
          $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'".$limit);
        while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
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
          // Call plugin event
          for ($p=0;$p<$slnumplugins;$p++)
          {
            if (function_exists($slplugin_event_onDeleteUser[$p]))
              call_user_func($slplugin_event_onDeleteUser[$p],$slpluginid[$p],$paramdata);
          }
          // Call user event handler
          if (function_exists("sl_onDeleteUser"))
              sl_onDeleteUser($paramdata);
        }
      }  
      // Delete selected users   
      $delquery="DELETE FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'";
      $mysql_result=mysqli_query($mysql_link,$delquery);
    }
  }
  if ($act=="exportselected")
  {
    if (!isset($ExportSeparator))
      $ExportSeparator=",";
    header("Content-type: application/octet-stream");
    header("Content-disposition: attachment; filename=sitelokusers.csv");
    header("Content-transfer-encoding: binary");
  	if (($sortf!="") && ($sortf!=""))
  	  $sortquery=" ORDER BY ".mysqli_real_escape_string($mysql_link,$sortf)." ".mysqli_real_escape_string($mysql_link,$sortd);
  	else
  		$sortquery="";
  		
    $mysql_result=mysqli_query($mysql_link,"SELECT count(*) FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'");
    $row = mysqli_fetch_row($mysql_result);
    if ($row!=false)
      $matchrows = $row[0];
    for ($l=0;$l<$matchrows;$l=$l+$sl_dbblocksize)
    {
      $limit=" LIMIT ".$l.",".$sl_dbblocksize;
      $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'".$sortquery.$limit);
      while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
      {
        $Selected=$row[$SelectedField];
        $Created=$row[$CreatedField];
        $Username=$row[$UsernameField];
        $Password=$row[$PasswordField];
        $Enabled=$row[$EnabledField];
        $Name=$row[$NameField];
        $Email=$row[$EmailField];
        $Usergroups=$row[$UsergroupsField];
        $Cus1=$row[$Custom1Field];
        $Cus2=$row[$Custom2Field];
        $Cus3=$row[$Custom3Field];
        $Cus4=$row[$Custom4Field];
        $Cus5=$row[$Custom5Field];
        $Cus6=$row[$Custom6Field];
        $Cus7=$row[$Custom7Field];
        $Cus8=$row[$Custom8Field];
        $Cus9=$row[$Custom9Field];
        $Cus10=$row[$Custom10Field];
        $Cus11=$row[$Custom11Field];
        $Cus12=$row[$Custom12Field];
        $Cus13=$row[$Custom13Field];
        $Cus14=$row[$Custom14Field];
        $Cus15=$row[$Custom15Field];
        $Cus16=$row[$Custom16Field];
        $Cus17=$row[$Custom17Field];
        $Cus18=$row[$Custom18Field];
        $Cus19=$row[$Custom19Field];
        $Cus20=$row[$Custom20Field];
        $Cus21=$row[$Custom21Field];
        $Cus22=$row[$Custom22Field];
        $Cus23=$row[$Custom23Field];
        $Cus24=$row[$Custom24Field];
        $Cus25=$row[$Custom25Field];
        $Cus26=$row[$Custom26Field];
        $Cus27=$row[$Custom27Field];
        $Cus28=$row[$Custom28Field];
        $Cus29=$row[$Custom29Field];
        $Cus30=$row[$Custom30Field];
        $Cus31=$row[$Custom31Field];
        $Cus32=$row[$Custom32Field];
        $Cus33=$row[$Custom33Field];
        $Cus34=$row[$Custom34Field];
        $Cus35=$row[$Custom35Field];
        $Cus36=$row[$Custom36Field];
        $Cus37=$row[$Custom37Field];
        $Cus38=$row[$Custom38Field];
        $Cus39=$row[$Custom39Field];
        $Cus40=$row[$Custom40Field];
        $Cus41=$row[$Custom41Field];
        $Cus42=$row[$Custom42Field];
        $Cus43=$row[$Custom43Field];
        $Cus44=$row[$Custom44Field];
        $Cus45=$row[$Custom45Field];
        $Cus46=$row[$Custom46Field];
        $Cus47=$row[$Custom47Field];
        $Cus48=$row[$Custom48Field];
        $Cus49=$row[$Custom49Field];
        $Cus50=$row[$Custom50Field];
        if (($DateFormat=="DDMMYY") && (strlen($Created)==6))
          $cdate=substr($Created,4,2)."/".substr($Created,2,2)."/".substr($Created,0,2);
        else
          $cdate=substr($Created,2,2)."/".substr($Created,4,2)."/".substr($Created,0,2);
        print "\"$cdate\"$ExportSeparator\"$Username\"$ExportSeparator\"$Password\"$ExportSeparator\"$Enabled\"$ExportSeparator\"$Name\"$ExportSeparator\"$Email\"$ExportSeparator\"$Usergroups\"";
        for ($i=1;$i<=50;$i++)
        {
          $pvar1="CustomTitle".$i;
          $pvar2="Cus".$i;
          if ($$pvar1!="")
            print "$ExportSeparator\"".$$pvar2."\"";
          else
            break;
        }
        print "\r\n";
      }
    }
  exit;
  }
  // Count total number of records
  $mysql_result = mysqli_query($mysql_link,"SELECT count(*) from $DbTableName");
  $row = mysqli_fetch_row($mysql_result);
  if ($row!=false)
    $totalrows = $row[0];
  else  
    $totalrows = 0;
  // If tablestart>totalrows thenadjust
  if ($tablestart>=$totalrows)
    $tablestart=0;    
//  $sqlinput="";
  $rowsaffected=-1;
  $queryerror=false;
  // If no filter or sql query then set query to show all records
  if (($filteron!="1") && ($sqlquery==""))
    $sqlquerytodo="SELECT * FROM ".$DbTableName;
  // If filtering required and groupexpiry not selected we can use SQL
  if (($filteron=="1") && ($filfield1!="groupexpiry") && ($filfield2!="groupexpiry") && ($filfield3!="groupexpiry") && ($filfield4!="groupexpiry"))
  {
  	// If filtering with created date then convert user entered data to YYMMDD
  	if (($filfield1==$CreatedField) && (strlen($fildata1)==6))
  	{
      $enteredfildata1=$fildata1;
      if ($DateFormat=="DDMMYY")
        $fildata1=substr($fildata1,4,2).substr($fildata1,2,2).substr($fildata1,0,2);
      else
        $fildata1=substr($fildata1,2,2).substr($fildata1,4,2).substr($fildata1,0,2);
  	}
  	if (($filfield2==$CreatedField) && (strlen($fildata2)==6))
  	{
      $enteredfildata2=$fildata2;
      if ($DateFormat=="DDMMYY")
        $fildata2=substr($fildata2,4,2).substr($fildata2,2,2).substr($fildata2,0,2);
      else
        $fildata2=substr($fildata2,2,2).substr($fildata2,4,2).substr($fildata2,0,2);
  	}
  	if (($filfield3==$CreatedField) && (strlen($fildata3)==6))
  	{
      $enteredfildata3=$fildata3;
      if ($DateFormat=="DDMMYY")
        $fildata3=substr($fildata3,4,2).substr($fildata3,2,2).substr($fildata3,0,2);
      else
        $fildata3=substr($fildata3,2,2).substr($fildata3,4,2).substr($fildata3,0,2);
  	}
  	if (($filfield4==$CreatedField) && (strlen($fildata4)==6))
  	{
      $enteredfildata4=$fildata4;
      if ($DateFormat=="DDMMYY")
        $fildata4=substr($fildata4,4,2).substr($fildata4,2,2).substr($fildata4,0,2);
      else
        $fildata4=substr($fildata4,2,2).substr($fildata4,4,2).substr($fildata4,0,2);
  	}
    $sqlquerytodo="SELECT * FROM ".$DbTableName." WHERE ";
    if ($filcond1=="equals")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." = ".sl_quote_smart($fildata1);
    if ($filcond1=="notequal")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." != ".sl_quote_smart($fildata1);
    if ($filcond1=="contains")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." LIKE ".sl_quote_smart("%".$fildata1."%");
    if ($filcond1=="notcontain")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." NOT LIKE ".sl_quote_smart("%".$fildata1."%");
    if ($filcond1=="less")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." < ".sl_quote_smart($fildata1);
    if ($filcond1=="greater")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." > ".sl_quote_smart($fildata1);
    if ($filcond1=="starts")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." LIKE ".sl_quote_smart($fildata1."%");
    if ($filcond1=="ends")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." LIKE ".sl_quote_smart("%".$fildata1);
    if ($filcond1=="lessnum")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." < ".mysqli_real_escape_string($mysql_link,$fildata1);
    if ($filcond1=="greaternum")
      $query1=mysqli_real_escape_string($mysql_link,$filfield1)." > ".mysqli_real_escape_string($mysql_link,$fildata1);
    $sqlquerytodo=$sqlquerytodo.$query1;
	  if (($filfield2!="") && ($filfield2!="groupexpiry"))
	  {
	    if ($filcond2=="equals")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." = ".sl_quote_smart($fildata2);
	    if ($filcond2=="notequal")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." != ".sl_quote_smart($fildata2);
	    if ($filcond2=="contains")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." LIKE ".sl_quote_smart("%".$fildata2."%");
	    if ($filcond2=="notcontain")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." NOT LIKE ".sl_quote_smart("%".$fildata2."%");
	    if ($filcond2=="less")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." < ".sl_quote_smart($fildata2);
	    if ($filcond2=="greater")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." > ".sl_quote_smart($fildata2);
	    if ($filcond2=="starts")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." LIKE ".$sl_quote_smart($fildata2."%");
	    if ($filcond2=="ends")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." LIKE ".sl_quote_smart("%".$fildata2);
	    if ($filcond2=="lessnum")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." < ".mysqli_real_escape_string($mysql_link,$fildata2);
	    if ($filcond2=="greaternum")
	      $query2=mysqli_real_escape_string($mysql_link,$filfield2)." > ".mysqli_real_escape_string($mysql_link,$fildata2);
	    $sqlquerytodo=$sqlquerytodo." ".$filbool1." ".$query2;
	    if (($filfield3!="") && ($filfield3!="groupexpiry"))
	    {
	      if ($filcond3=="equals")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." = ".sl_quote_smart($fildata3);
	      if ($filcond3=="notequal")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." != ".sl_quote_smart($fildata3);
	      if ($filcond3=="contains")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." LIKE ".sl_quote_smart("%".$fildata3."%");
	      if ($filcond3=="notcontain")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." NOT LIKE ".sl_quote_smart("%".$fildata3."%");
	      if ($filcond3=="less")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." < ".sl_quote_smart($fildata3);
	      if ($filcond3=="greater")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." > ".sl_quote_smart($fildata3);
	      if ($filcond3=="starts")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." LIKE ".sl_quote_smart($fildata3."%");
	      if ($filcond3=="ends")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." LIKE ".sl_quote_smart("%".$fildata3);
	      if ($filcond3=="lessnum")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." < ".mysqli_real_escape_string($mysql_link,$fildata3);
	      if ($filcond3=="greaternum")
	        $query3=mysqli_real_escape_string($mysql_link,$filfield3)." > ".mysqli_real_escape_string($mysql_link,$fildata3);
		    $sqlquerytodo=$sqlquerytodo." ".$filbool2." ".$query3;
  	    if (($filfield4!="") && ($filfield4!="groupexpiry"))
  	    {
  	      if ($filcond4=="equals")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." = ".sl_quote_smart($fildata4);
  	      if ($filcond4=="notequal")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." != ".sl_quote_smart($fildata4);
  	      if ($filcond4=="contains")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." LIKE ".sl_quote_smart("%".$fildata4."%");
  	      if ($filcond4=="notcontain")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." NOT LIKE ".sl_quote_smart("%".$fildata4."%");
  	      if ($filcond4=="less")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." < ".sl_quote_smart($fildata4);
  	      if ($filcond4=="greater")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." > ".sl_quote_smart($fildata4);
  	      if ($filcond4=="starts")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." LIKE ".sl_quote_smart($fildata4."%");
  	      if ($filcond4=="ends")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." LIKE ".sl_quote_smart("%".$fildata4);
  	      if ($filcond4=="lessnum")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." < ".mysqli_real_escape_string($mysql_link,$fildata4);
  	      if ($filcond4=="greaternum")
  	        $query4=mysqli_real_escape_string($mysql_link,$filfield4)." > ".mysqli_real_escape_string($mysql_link,$fildata4);
  		    $sqlquerytodo=$sqlquerytodo." ".$filbool3." ".$query4;
  	    }	    
	    }
	  }
	  // Put back the date in user entered format if we filtered using created date
  	if (($filfield1==$CreatedField) && (strlen($fildata1)==6))
  	{
      $fildata1=$enteredfildata1;
    }
  	if (($filfield2==$CreatedField) && (strlen($fildata2)==6))
  	{
      $fildata2=$enteredfildata2;
    }
  	if (($filfield3==$CreatedField) && (strlen($fildata3)==6))
  	{
      $fildata3=$enteredfildata3;
    }
  	if (($filfield4==$CreatedField) && (strlen($fildata4)==6))
  	{
      $fildata4=$enteredfildata4;
    }
  }
  if (($filteron=="1") && (($filfield1=="groupexpiry") || ($filfield2=="groupexpiry") || ($filfield3=="groupexpiry") || ($filfield4=="groupexpiry")))
  {
  	// We will filter manually so set query for all records
    $sqlquerytodo="SELECT * FROM ".$DbTableName;
  }
  if ($sqlquery!="")
  	$sqlquerytodo=$sqlquery;
  	
  if ($act=="query")
  {
  	$tablestart=0;
    if ((strlen(trim($sqlquerytodo))>=6) && (strcasecmp(substr(trim($sqlquerytodo),0,6),"SELECT")!=0))
    {
      $mysql_result=mysqli_query($mysql_link,$sqlquerytodo);
      if ($mysql_result!=false)
      {
        $rowsaffected=mysqli_affected_rows($mysql_link);
        $sqlquery="SELECT * FROM ".$DbTableName;
        $sqlquerytodo=$sqlquery;
	      $sqlinput="";
      }
      else
      {
        $queryerror=true;
        $sqlinput=$sqlquery;
        $sqlquery="SELECT * FROM ".$DbTableName;
        $sqlquerytodo=$sqlquery;
      }        
    }
    else
    {
      $sqlinput=$sqlquery;
      $sqlquerytodo=$sqlquery;
    }    
  }
  
  if (($act=="filter") || ($act=="quicksearch") || ($act=="memberof") || ($act=="joinwithin") || ($act=="unexpmemberof") || ($act=="expmemberof") || ($act=="expwithin") || ($act=="onlyselected"))
  	$tablestart=0;
  
  $queryrun=false;
  // ********************************
  if (($filteron=="1") && (($filfield1=="groupexpiry") || ($filfield2=="groupexpiry") || ($filfield3=="groupexpiry") || ($filfield4=="groupexpiry")))
  {
    $queryrun=true;
  	// As groupexpiry field selected we need to filter manually
  	if (($sortf!="") && ($sortf!=""))
  	  $sortquery=" ORDER BY ".mysqli_real_escape_string($mysql_link,$sortf)." ".mysqli_real_escape_string($mysql_link,$sortd);
	  $numrows=0;
	  $numselected=0;
	  $tfildata1=strtolower($fildata1);
	  $tfildata2=strtolower($fildata2);
	  $tfildata3=strtolower($fildata3);
	  $tfildata4=strtolower($fildata4);
   	// If checking Created field then convert date to YYMMDD for each of the 4 filters
   	if (($filfield1==$CreatedField) && (strlen($tfildata1)==6))
  	{
      if ($DateFormat=="DDMMYY")
        $tfildata1=substr($tfildata1,4,2).substr($tfildata1,2,2).substr($tfildata1,0,2);
      else
        $tfildata1=substr($tfildata1,4,2).substr($tfildata1,0,2).substr($tfildata1,2,2);
	  }
   	if (($filfield2==$CreatedField) && (strlen($tfildata2)==6))
  	{
      if ($DateFormat=="DDMMYY")
        $tfildata2=substr($tfildata2,4,2).substr($tfildata2,2,2).substr($tfildata2,0,2);
      else
        $tfildata2=substr($tfildata2,4,2).substr($tfildata2,0,2).substr($tfildata2,2,2);
	  }
   	if (($filfield3==$CreatedField) && (strlen($tfildata3)==6))
  	{
      if ($DateFormat=="DDMMYY")
        $tfildata3=substr($tfildata3,4,2).substr($tfildata3,2,2).substr($tfildata3,0,2);
      else
        $tfildata3=substr($tfildata3,4,2).substr($tfildata3,0,2).substr($tfildata3,2,2);
	  }
   	if (($filfield4==$CreatedField) && (strlen($tfildata4)==6))
  	{
      if ($DateFormat=="DDMMYY")
        $tfildata4=substr($tfildata4,4,2).substr($tfildata4,2,2).substr($tfildata4,0,2);
      else
        $tfildata4=substr($tfildata4,4,2).substr($tfildata4,0,2).substr($tfildata4,2,2);
	  }

   	if (($filfield1=="groupexpiry") && (strlen($tfildata1)==6))
    {
      if ($DateFormat=="DDMMYY")
        $fitime1=substr($tfildata1,4,2).substr($tfildata1,2,2).substr($tfildata1,0,2);
      else
        $fitime1=substr($tfildata1,4,2).substr($tfildata1,0,2).substr($tfildata1,2,2);
    }
    else
      $fitime1=0;

   	if (($filfield2=="groupexpiry") && (strlen($tfildata2)==6))
    {
      if ($DateFormat=="DDMMYY")
        $fitime2=substr($tfildata2,4,2).substr($tfildata2,2,2).substr($tfildata2,0,2);
      else
        $fitime2=substr($tfildata2,4,2).substr($tfildata2,0,2).substr($tfildata2,2,2);
    }
    else
      $fitime2=0;

   	if (($filfield3=="groupexpiry") && (strlen($tfildata3)==6))
    {
      if ($DateFormat=="DDMMYY")
        $fitime3=substr($tfildata3,4,2).substr($tfildata3,2,2).substr($tfildata3,0,2);
      else
        $fitime3=substr($tfildata3,4,2).substr($tfildata3,0,2).substr($tfildata3,2,2);
    }
    else
      $fitime3=0;

   	if (($filfield4=="groupexpiry") && (strlen($tfildata4)==6))
    {
      if ($DateFormat=="DDMMYY")
        $fitime4=substr($tfildata4,4,2).substr($tfildata4,2,2).substr($tfildata4,0,2);
      else
        $fitime4=substr($tfildata4,4,2).substr($tfildata4,0,2).substr($tfildata4,2,2);
    }
    else
      $fitime4=0;


    for ($l=0;$l<$totalrows;$l=$l+$sl_dbblocksize)
    {
      $limit=" LIMIT ".$l.",".$sl_dbblocksize;
      $mysql_result=mysqli_query($mysql_link,$sqlquerytodo.$sortquery.$limit);
  	  if ($mysql_result!=false)
  	  {
  	    for ($k=$l;$k<($l+$sl_dbblocksize);$k++)
  	    {
  	      if ($k>=$totalrows)
  	        break;
  	      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  	      if ($row!=false)
  	      {
            // Now see if matches filter 1
            if ($filfield1!="groupexpiry")
            {
              $datatocheck=strtolower($row[$filfield1]);
              switch ($filcond1)
              {
                case "equals":
                  $comp1=($tfildata1==$datatocheck);
                  break;
                case "notequal":
                  $comp1=($tfildata1!=$datatocheck);
                  break;
                case "contains":
                  $comp1=is_integer(strpos($datatocheck,$tfildata1));
                  break;
                case "notcontain":
                  $comp1=(strpos($datatocheck,$tfildata1)===false);
                  break;
                case "less":
                  $comp1=($datatocheck<$tfildata1);
                  break;
                case "greater":
                  $comp1=($datatocheck>$tfildata1);
                  break;
                case "starts":
                  $comp1=(strpos($datatocheck,$tfildata1)===0);
                  break;
                case "ends":
                  $comp1=(strpos($datatocheck,$tfildata1)===(strlen($datatocheck)-strlen($tfildata1)));
                  break;
              }
            }
            else
            {
              // Compare the expiry dates. If any match then set comp to true
              $allgroups=explode("^",$row[$UsergroupsField]);
              for ($j=0;$j<count($allgroups);$j++)
              {
                $exdate=strtok($allgroups[$j],":");
                $exdate=trim(strtok(":"));
                if (strlen($exdate)!=6)
                {
                  if (($filcond1=="notequal") || ($filcond1=="greater"))
                  	$comp1=true;
                  else
                  	$comp1=false;
                	continue;
                }
                switch ($filcond1)
                {
    	            case "equals":
    	              $comp1=($tfildata1==$exdate);
    	              break;
    	            case "notequal":
    	              $comp1=($tfildata1!=$exdate);
    	              break;
    	            case "contains":
    	              $comp1=is_integer(strpos($exdate,$tfildata1));
    	              break;
    	            case "greater":
    	              $comp1=($datatocheck>$tfildata1);
    	            	if ($fitime1==0)
    	            		$comp1=false;
    	            	else
    	            	{
    	                if ($DateFormat=="DDMMYY")
    					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
    	                else
    					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
    	                $comp1=false;
    	                if (($filcond1=="greater") && ($extime>$fitime1))
    										$comp1=true;
                    }    	              
    	              break;
    	            case "starts":
    	              $comp1=(strpos($exdate,$tfildata1)===0);
    	              break;
    	            case "ends":
    	              $comp1=(strpos($exdate,$tfildata1)===(strlen($exdate)-strlen($tfildata1)));
    	              break;
    	            case "less":
    	            	if ($fitime1==0)
    	            		$comp1=false;
    	            	else
    	            	{
    	                if ($DateFormat=="DDMMYY")
    					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
    	                else
    					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
    	                $comp1=false;
    	                if (($filcond1=="less") && ($extime<$fitime1))
    										$comp1=true;
                    }
                    break;
  	            }
  	            if ($comp1)
  	              break; // We only need one match
              }
            }
            $finalcomp="\$comp1";
            // Now see if matches filter 2
            if ($filfield2!="")
            {
              if ($filfield2!="groupexpiry")
              {
                $datatocheck=strtolower($row[$filfield2]);
                switch ($filcond2)
                {
                  case "equals":
                    $comp2=($tfildata2==$datatocheck);
                    break;
                  case "notequal":
                    $comp2=($tfildata2!=$datatocheck);
                    break;
                  case "contains":
                    $comp2=is_integer(strpos($datatocheck,$tfildata2));
                    break;
                  case "notcontain":
                    $comp2=(strpos($datatocheck,$tfildata2)===false);
                    break;
                  case "less":
                    $comp2=($datatocheck<$tfildata2);
                    break;
                  case "greater":
                    $comp2=($datatocheck>$tfildata2);
                    break;
                  case "starts":
                    $comp2=(strpos($datatocheck,$tfildata2)===0);
                    break;
                  case "ends":
                    $comp2=(strpos($datatocheck,$tfildata2)===(strlen($datatocheck)-strlen($tfildata2)));
                    break;
                }
              }
              else
              {
                // Compare the expiry dates. If any match then set comp to true
                $allgroups=explode("^",$row[$UsergroupsField]);
                for ($j=0;$j<count($allgroups);$j++)
                {
                  $exdate=strtok($allgroups[$j],":");
                  $exdate=trim(strtok(":"));
                  if (strlen($exdate)!=6)
                  {
                    if (($filcond2=="notequal") || ($filcond2=="greater"))
                    	$comp2=true;
                    else
                    	$comp2=false;
                  	continue;
                  }
                  switch ($filcond2)
                  {
      	            case "equals":
      	              $comp2=($tfildata2==$exdate);
      	              break;
      	            case "notequal":
      	              $comp2=($tfildata2!=$exdate);
      	              break;
      	            case "contains":
      	              $comp2=is_integer(strpos($exdate,$tfildata2));
      	              break;
      	            case "greater":
      	              $comp2=($datatocheck>$tfildata2);
      	            	if ($fitime2==0)
      	            		$comp2=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp2=false;
      	                if (($filcond2=="greater") && ($extime>$fitime2))
      										$comp2=true;
                      }    	              
      	              break;
      	            case "starts":
      	              $comp2=(strpos($exdate,$tfildata2)===0);
      	              break;
      	            case "ends":
      	              $comp2=(strpos($exdate,$tfildata2)===(strlen($exdate)-strlen($tfildata2)));
      	              break;
      	            case "less":
      	            	if ($fitime2==0)
      	            		$comp2=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp2=false;
      	                if (($filcond2=="less") && ($extime<$fitime2))
      										$comp2=true;
                      }
                      break;
    	            }
    	            if ($comp2)
    	              break; // We only need one match
                }
              }
  	          if ($filbool1=="AND")
  		          $finalcomp=$finalcomp." & "."\$comp2";
  	          else
  		          $finalcomp=$finalcomp." | "."\$comp2";
            }
            // Now see if matches filter 3
            if ($filfield3!="")
            {
              if ($filfield3!="groupexpiry")
              {
                $datatocheck=strtolower($row[$filfield3]);
                switch ($filcond3)
                {
                  case "equals":
                    $comp3=($tfildata3==$datatocheck);
                    break;
                  case "notequal":
                    $comp3=($tfildata3!=$datatocheck);
                    break;
                  case "contains":
                    $comp3=is_integer(strpos($datatocheck,$tfildata3));
                    break;
                  case "notcontain":
                    $comp3=(strpos($datatocheck,$tfildata3)===false);
                    break;
                  case "less":
                    $comp3=($datatocheck<$tfildata3);
                    break;
                  case "greater":
                    $comp3=($datatocheck>$tfildata3);
                    break;
                  case "starts":
                    $comp3=(strpos($datatocheck,$tfildata3)===0);
                    break;
                  case "ends":
                    $comp3=(strpos($datatocheck,$tfildata3)===(strlen($datatocheck)-strlen($tfildata3)));
                    break;
                }
              }
              else
              {
                // Compare the expiry dates. If any match then set comp to true
                $allgroups=explode("^",$row[$UsergroupsField]);
                for ($j=0;$j<count($allgroups);$j++)
                {
                  $exdate=strtok($allgroups[$j],":");
                  $exdate=trim(strtok(":"));
                  if (strlen($exdate)!=6)
                  {
                    if (($filcond3=="notequal") || ($filcond3=="greater"))
                    	$comp3=true;
                    else
                    	$comp3=false;
                  	continue;
                  }
                  switch ($filcond3)
                  {
      	            case "equals":
      	              $comp3=($tfildata3==$exdate);
      	              break;
      	            case "notequal":
      	              $comp3=($tfildata3!=$exdate);
      	              break;
      	            case "contains":
      	              $comp3=is_integer(strpos($exdate,$tfildata3));
      	              break;
      	            case "greater":
      	              $comp3=($datatocheck>$tfildata3);
      	            	if ($fitime3==0)
      	            		$comp3=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp3=false;
      	                if (($filcond3=="greater") && ($extime>$fitime3))
      										$comp3=true;
                      }    	              
      	              break;
      	            case "starts":
      	              $comp3=(strpos($exdate,$tfildata3)===0);
      	              break;
      	            case "ends":
      	              $comp3=(strpos($exdate,$tfildata3)===(strlen($exdate)-strlen($tfildata3)));
      	              break;
      	            case "less":
      	            	if ($fitime3==0)
      	            		$comp3=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp3=false;
      	                if (($filcond3=="less") && ($extime<$fitime3))
      										$comp3=true;
                      }
                      break;
    	            }
    	            if ($comp3)
    	              break; // We only need one match
                }
              }
  	          if ($filbool2=="AND")
  		          $finalcomp=$finalcomp." & "."\$comp3";
  						else
  		          $finalcomp=$finalcomp." | "."\$comp3";
            }  
            
            // Now see if matches filter 4
            if ($filfield4!="")
            {
              if ($filfield4!="groupexpiry")
              {
                $datatocheck=strtolower($row[$filfield4]);
                switch ($filcond4)
                {
                  case "equals":
                    $comp4=($tfildata4==$datatocheck);
                    break;
                  case "notequal":
                    $comp4=($tfildata4!=$datatocheck);
                    break;
                  case "contains":
                    $comp4=is_integer(strpos($datatocheck,$tfildata4));
                    break;
                  case "notcontain":
                    $comp4=(strpos($datatocheck,$tfildata4)===false);
                    break;
                  case "less":
                    $comp4=($datatocheck<$tfildata4);
                    break;
                  case "greater":
                    $comp4=($datatocheck>$tfildata4);
                    break;
                  case "starts":
                    $comp4=(strpos($datatocheck,$tfildata4)===0);
                    break;
                  case "ends":
                    $comp4=(strpos($datatocheck,$tfildata4)===(strlen($datatocheck)-strlen($tfildata4)));
                    break;
                }
              }
              else
              {
                // Compare the expiry dates. If any match then set comp to true
                $allgroups=explode("^",$row[$UsergroupsField]);
                for ($j=0;$j<count($allgroups);$j++)
                {
                  $exdate=strtok($allgroups[$j],":");
                  $exdate=trim(strtok(":"));
                  if (strlen($exdate)!=6)
                  {
                    if (($filcond4=="notequal") || ($filcond4=="greater"))
                    	$comp4=true;
                    else
                    	$comp4=false;
                  	continue;
                  }
                  switch ($filcond4)
                  {
      	            case "equals":
      	              $comp4=($tfildata4==$exdate);
      	              break;
      	            case "notequal":
      	              $comp4=($tfildata4!=$exdate);
      	              break;
      	            case "contains":
      	              $comp4=is_integer(strpos($exdate,$tfildata4));
      	              break;
      	            case "greater":
      	              $comp4=($datatocheck>$tfildata4);
      	            	if ($fitime4==0)
      	            		$comp4=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp4=false;
      	                if (($filcond4=="greater") && ($extime>$fitime4))
      										$comp4=true;
                      }    	              
      	              break;
      	            case "starts":
      	              $comp4=(strpos($exdate,$tfildata4)===0);
      	              break;
      	            case "ends":
      	              $comp4=(strpos($exdate,$tfildata4)===(strlen($exdate)-strlen($tfildata4)));
      	              break;
      	            case "less":
      	            	if ($fitime4==0)
      	            		$comp4=false;
      	            	else
      	            	{
      	                if ($DateFormat=="DDMMYY")
      					           $extime=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
      	                else
      					           $extime=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
      	                $comp4=false;
      	                if (($filcond4=="less") && ($extime<$fitime4))
      										$comp4=true;
                      }
                      break;
    	            }
    	            if ($comp4)
    	              break; // We only need one match
                }
              }
  	          if ($filbool3=="AND")
  		          $finalcomp=$finalcomp." & "."\$comp4";
  						else
  		          $finalcomp=$finalcomp." | "."\$comp4";
            }
            // Now combine filter results together using OR and AND
            eval("\$comp=(".$finalcomp.");");
            if ($comp)
            {
 	            $select=$row[$SelectedField];
  	          if ($act=="selectall")
  	          {
                $mysql_selresult=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' WHERE ".$UsernameField."=".sl_quote_smart($row[$UsernameField]));
                $select="Yes";
  	          }
  	          if ($act=="deselectall")
  	          {
                $mysql_selresult=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='No' WHERE ".$UsernameField."=".sl_quote_smart($row[$UsernameField]));
                $select="No";
  	          }
              $numrows++;
              if ((($numrows-1)>=$tablestart) && (($numrows-1)<($tablestart+$ShowRows)))
              {
                $rtu=$numrows-$tablestart-1;
                $Selectedarray[$rtu]=$select;
                $Createdarray[$rtu]=$row[$CreatedField];
                $Usernamearray[$rtu]=$row[$UsernameField];
                $Passwordarray[$rtu]=$row[$PasswordField];
                $Enabledarray[$rtu]=$row[$EnabledField];
                $Namearray[$rtu]=$row[$NameField];
                $Emailarray[$rtu]=$row[$EmailField];
                $Usergroupsarray[$rtu]=$row[$UsergroupsField];
                $Cus1array[$rtu]=$row[$Custom1Field];
                $Cus2array[$rtu]=$row[$Custom2Field];
                $Cus3array[$rtu]=$row[$Custom3Field];
                $Cus4array[$rtu]=$row[$Custom4Field];
                $Cus5array[$rtu]=$row[$Custom5Field];
                $Cus6array[$rtu]=$row[$Custom6Field];
                $Cus7array[$rtu]=$row[$Custom7Field];
                $Cus8array[$rtu]=$row[$Custom8Field];
                $Cus9array[$rtu]=$row[$Custom9Field];
                $Cus10array[$rtu]=$row[$Custom10Field];
                $Cus11array[$rtu]=$row[$Custom11Field];
                $Cus12array[$rtu]=$row[$Custom12Field];
                $Cus13array[$rtu]=$row[$Custom13Field];
                $Cus14array[$rtu]=$row[$Custom14Field];
                $Cus15array[$rtu]=$row[$Custom15Field];
                $Cus16array[$rtu]=$row[$Custom16Field];
                $Cus17array[$rtu]=$row[$Custom17Field];
                $Cus18array[$rtu]=$row[$Custom18Field];
                $Cus19array[$rtu]=$row[$Custom19Field];
                $Cus20array[$rtu]=$row[$Custom20Field];
                $Cus21array[$rtu]=$row[$Custom21Field];
                $Cus22array[$rtu]=$row[$Custom22Field];
                $Cus23array[$rtu]=$row[$Custom23Field];
                $Cus24array[$rtu]=$row[$Custom24Field];
                $Cus25array[$rtu]=$row[$Custom25Field];
                $Cus26array[$rtu]=$row[$Custom26Field];
                $Cus27array[$rtu]=$row[$Custom27Field];
                $Cus28array[$rtu]=$row[$Custom28Field];
                $Cus29array[$rtu]=$row[$Custom29Field];
                $Cus30array[$rtu]=$row[$Custom30Field];
                $Cus31array[$rtu]=$row[$Custom31Field];
                $Cus32array[$rtu]=$row[$Custom32Field];
                $Cus33array[$rtu]=$row[$Custom33Field];
                $Cus34array[$rtu]=$row[$Custom34Field];
                $Cus35array[$rtu]=$row[$Custom35Field];
                $Cus36array[$rtu]=$row[$Custom36Field];
                $Cus37array[$rtu]=$row[$Custom37Field];
                $Cus38array[$rtu]=$row[$Custom38Field];
                $Cus39array[$rtu]=$row[$Custom39Field];
                $Cus40array[$rtu]=$row[$Custom40Field];
                $Cus41array[$rtu]=$row[$Custom41Field];
                $Cus42array[$rtu]=$row[$Custom42Field];
                $Cus43array[$rtu]=$row[$Custom43Field];
                $Cus44array[$rtu]=$row[$Custom44Field];
                $Cus45array[$rtu]=$row[$Custom45Field];
                $Cus46array[$rtu]=$row[$Custom46Field];
                $Cus47array[$rtu]=$row[$Custom47Field];
                $Cus48array[$rtu]=$row[$Custom48Field];
                $Cus49array[$rtu]=$row[$Custom49Field];
                $Cus50array[$rtu]=$row[$Custom50Field];              
                $Useridarray[$rtu]=$row[$IdField];              
              }
            }
  	      }
  	    }
  	  } 	  
    }
  }
  if ($quicksearch!="")
  {
    $tmpdata=sl_quote_smart("%".$quicksearch."%");
    $sqlquerytodo= "SELECT * FROM ".$DbTableName." WHERE ".$UsernameField." LIKE ".$tmpdata." OR ";
    $sqlquerytodo.=$PasswordField." LIKE ".$tmpdata." OR ";
    $sqlquerytodo.=$NameField." LIKE ".$tmpdata." OR ";
    $sqlquerytodo.=$EmailField." LIKE ".$tmpdata." OR ";
    $sqlquerytodo.=$UsergroupsField." LIKE ".$tmpdata;
    for ($k=1;$k<=50;$k++)
    {
      $sqlquerytodo.=" OR ";
      $var="Custom".$k."Field";
      $sqlquerytodo.=$$var." LIKE ".$tmpdata;
    }
  }
  
  if ($memberof!="")
  {
    $sqlquerytodo= "SELECT * FROM ".$DbTableName." WHERE ".$UsergroupsField." REGEXP '(^|\\\^)".$memberof."(:|\\\^|$)'";
  }
  if ($joinwithin!="")
  {
    $comparedate=gmdate("ymd",strtotime("-".($joinwithin-1)." days") );
    $sqlquerytodo= "SELECT * FROM ".$DbTableName." WHERE ".$CreatedField." >= ".$comparedate;
  }
  if ($onlyselected!="")
  {
    $sqlquerytodo= "SELECT * FROM ".$DbTableName." WHERE ".$SelectedField."=".sl_quote_smart($onlyselected);
  }
  if (($unexpmemberof!="") || ($expmemberof!="") || ($expwithin!=""))
  { 
    $queryrun=true;
  	if (($sortf!="") && ($sortf!=""))
  	  $sortquery=" ORDER BY ".mysqli_real_escape_string($mysql_link,$sortf)." ".mysqli_real_escape_string($mysql_link,$sortd);
    if ($unexpmemberof!="")
    {
      $comparedate=gmdate("ymd");
      $qry="SELECT * FROM ".$DbTableName." WHERE ".$UsergroupsField." REGEXP '(^|\\\^)".$unexpmemberof."(:|\\\^|$)'";
    }  
    if ($expmemberof!="")
    {
      $comparedate=gmdate("ymd");
      $qry="SELECT * FROM ".$DbTableName." WHERE ".$UsergroupsField." REGEXP '(^|\\\^)".$expmemberof."(:)'";
    }  
    if ($expwithin!="")
    {
      $comparedate=gmdate("ymd");
      $comparedate2=gmdate("ymd",strtotime("+".$expwithindays." days") );
      $qry="SELECT * FROM ".$DbTableName." WHERE ".$UsergroupsField." REGEXP '(^|\\\^)".$expwithin."(:)'";
    }
	  $numrows=0;
	  $numselected=0;
    for ($l=0;$l<$totalrows;$l=$l+$sl_dbblocksize)
    {
      $limit=" LIMIT ".$l.",".$sl_dbblocksize;
      $mysql_result=mysqli_query($mysql_link,$qry.$sortquery.$limit);
  	  if ($mysql_result!=false)
  	  {
  	    for ($k=$l;$k<($l+$sl_dbblocksize);$k++)
  	    {
  	      if ($k>=$totalrows)
  	        break;
  	      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
  	      if ($row!=false)
  	      {
  	        $comp=false;
  	        if ($unexpmemberof!="")
     	      {  
    	        // Check that group selected is not expired
              $allgroups=explode("^",$row[$UsergroupsField]);
              for ($j=0;$j<count($allgroups);$j++)
              {
                $grpname=strtok($allgroups[$j],":");
                if (trim($grpname)!=$unexpmemberof)
                  continue;
                $exdate=trim(strtok(":"));
                if ($exdate=="")
                {
                  $comp=true;
                  break;
                }  
                if (strlen($exdate)==6)
                {
                  if ($DateFormat=="DDMMYY")
   				          $exp=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
                  else
     			          $exp=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
     			        if ($exp>=$comparedate)
     			        {
     			          $comp=true;
     			          break;
     			        }  
                }
              }
            }
  	        if ($expmemberof!="")
     	      {  
    	        // Check that group selected is expired
              $allgroups=explode("^",$row[$UsergroupsField]);
              for ($j=0;$j<count($allgroups);$j++)
              {
                $grpname=strtok($allgroups[$j],":");
                if (trim($grpname)!=$expmemberof)
                  continue;
                $exdate=trim(strtok(":"));
                if ($exdate=="")
                {
                  $comp=false;
                  break;
                }  
                if (strlen($exdate)==6)
                {
                  if ($DateFormat=="DDMMYY")
   				          $exp=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
                  else
     			          $exp=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
     			        if ($exp<$comparedate)
     			        {
     			          $comp=true;
     			          break;
     			        }  
                }
              }              
            }
  	        if ($expwithin!="")
     	      { 
    	        // see if group expires within entered days
              $allgroups=explode("^",$row[$UsergroupsField]);
              for ($j=0;$j<count($allgroups);$j++)
              {
                $grpname=strtok($allgroups[$j],":");
                if (trim($grpname)!=$expwithin)
                  continue;
                $exdate=trim(strtok(":"));
                if ($exdate=="")
                {
                  $comp=false;
                  break;
                }  
                if (strlen($exdate)==6)
                {
                  if ($DateFormat=="DDMMYY")
   				          $exp=substr($exdate,4,2).substr($exdate,2,2).substr($exdate,0,2);
                  else
     			          $exp=substr($exdate,4,2).substr($exdate,0,2).substr($exdate,2,2);
     			        if (($exp<$comparedate2) && ($exp>=$comparedate))
     			        {
     			          $comp=true;
     			          break;
     			        }  
                }
              }
            }
            if ($comp)
            {
 	            $select=$row[$SelectedField];
  	          if ($act=="selectall")
  	          {
                $mysql_selresult=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' WHERE ".$UsernameField."=".sl_quote_smart($row[$UsernameField]));
                $select="Yes";
  	          }
  	          if ($act=="deselectall")
  	          {
                $mysql_selresult=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='No' WHERE ".$UsernameField."=".sl_quote_smart($row[$UsernameField]));
                $select="No";
  	          }
              $numrows++;
              if ((($numrows-1)>=$tablestart) && (($numrows-1)<($tablestart+$ShowRows)))
              {
                $rtu=$numrows-$tablestart-1;
                $Selectedarray[$rtu]=$select;
                $Createdarray[$rtu]=$row[$CreatedField];
                $Usernamearray[$rtu]=$row[$UsernameField];
                $Passwordarray[$rtu]=$row[$PasswordField];
                $Enabledarray[$rtu]=$row[$EnabledField];
                $Namearray[$rtu]=$row[$NameField];
                $Emailarray[$rtu]=$row[$EmailField];
                $Usergroupsarray[$rtu]=$row[$UsergroupsField];
                $Cus1array[$rtu]=$row[$Custom1Field];
                $Cus2array[$rtu]=$row[$Custom2Field];
                $Cus3array[$rtu]=$row[$Custom3Field];
                $Cus4array[$rtu]=$row[$Custom4Field];
                $Cus5array[$rtu]=$row[$Custom5Field];
                $Cus6array[$rtu]=$row[$Custom6Field];
                $Cus7array[$rtu]=$row[$Custom7Field];
                $Cus8array[$rtu]=$row[$Custom8Field];
                $Cus9array[$rtu]=$row[$Custom9Field];
                $Cus10array[$rtu]=$row[$Custom10Field];
                $Cus11array[$rtu]=$row[$Custom11Field];
                $Cus12array[$rtu]=$row[$Custom12Field];
                $Cus13array[$rtu]=$row[$Custom13Field];
                $Cus14array[$rtu]=$row[$Custom14Field];
                $Cus15array[$rtu]=$row[$Custom15Field];
                $Cus16array[$rtu]=$row[$Custom16Field];
                $Cus17array[$rtu]=$row[$Custom17Field];
                $Cus18array[$rtu]=$row[$Custom18Field];
                $Cus19array[$rtu]=$row[$Custom19Field];
                $Cus20array[$rtu]=$row[$Custom20Field];
                $Cus21array[$rtu]=$row[$Custom21Field];
                $Cus22array[$rtu]=$row[$Custom22Field];
                $Cus23array[$rtu]=$row[$Custom23Field];
                $Cus24array[$rtu]=$row[$Custom24Field];
                $Cus25array[$rtu]=$row[$Custom25Field];
                $Cus26array[$rtu]=$row[$Custom26Field];
                $Cus27array[$rtu]=$row[$Custom27Field];
                $Cus28array[$rtu]=$row[$Custom28Field];
                $Cus29array[$rtu]=$row[$Custom29Field];
                $Cus30array[$rtu]=$row[$Custom30Field];
                $Cus31array[$rtu]=$row[$Custom31Field];
                $Cus32array[$rtu]=$row[$Custom32Field];
                $Cus33array[$rtu]=$row[$Custom33Field];
                $Cus34array[$rtu]=$row[$Custom34Field];
                $Cus35array[$rtu]=$row[$Custom35Field];
                $Cus36array[$rtu]=$row[$Custom36Field];
                $Cus37array[$rtu]=$row[$Custom37Field];
                $Cus38array[$rtu]=$row[$Custom38Field];
                $Cus39array[$rtu]=$row[$Custom39Field];
                $Cus40array[$rtu]=$row[$Custom40Field];
                $Cus41array[$rtu]=$row[$Custom41Field];
                $Cus42array[$rtu]=$row[$Custom42Field];
                $Cus43array[$rtu]=$row[$Custom43Field];
                $Cus44array[$rtu]=$row[$Custom44Field];
                $Cus45array[$rtu]=$row[$Custom45Field];
                $Cus46array[$rtu]=$row[$Custom46Field];
                $Cus47array[$rtu]=$row[$Custom47Field];
                $Cus48array[$rtu]=$row[$Custom48Field];
                $Cus49array[$rtu]=$row[$Custom49Field];
                $Cus50array[$rtu]=$row[$Custom50Field];              
                $Useridarray[$rtu]=$row[$IdField];
              }
            }
  	      }
  	    }
  	  }
    }
  }
  if (!$queryrun)
  {
	  if ($mysql_result!=false)
	  {
	  	if ($act=="selectall")
	  	{
        $pos=strpos(strtoupper($sqlquerytodo),"WHERE");
        if (is_integer($pos))
        {
          $selquery="UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' ".substr($sqlquerytodo,$pos,strlen($sqlquerytodo)-$pos);
          $mysql_result=mysqli_query($mysql_link,$selquery);
        }
        else
        {
          $selquery="UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' ";
          $mysql_result=mysqli_query($mysql_link,$selquery);
        }
      }
	  	if ($act=="deselectall")
	  	{
	      $pos=strpos(strtoupper($sqlquerytodo),"WHERE");
	      if (is_integer($pos))
	      {
				  $selquery="UPDATE ".$DbTableName." SET ".$SelectedField."='No' ".substr($sqlquerytodo,$pos,strlen($sqlquerytodo)-$pos);
					$mysql_result=mysqli_query($mysql_link,$selquery);
	      }
	      else
	      {
				  $selquery="UPDATE ".$DbTableName." SET ".$SelectedField."='No' ";
					$mysql_result=mysqli_query($mysql_link,$selquery);
	      }
      }
	  	if (($sortf!="") && ($sortf!=""))
        $sortquery=" ORDER BY ".$sortf." ".$sortd;
      $sqllimit=" LIMIT ".$tablestart.",".$ShowRows;
	    $mysql_result=mysqli_query($mysql_link,str_replace("SELECT","SELECT SQL_CALC_FOUND_ROWS",$sqlquerytodo).$sortquery.$sqllimit);
	    if ($mysql_result!=false)
	    {
  	    $sqlnum=mysqli_query($mysql_link,"SELECT FOUND_ROWS() AS `found_rows`;");
  	    $rows = mysqli_fetch_array($sqlnum,MYSQLI_ASSOC);
  	    $numrows = $rows['found_rows'];
  	  }  
	    else
	    {
	      $numrows=0;
        $queryerror=true;
	    } 
		  if ($tablestart>=$numrows)
    		$tablestart=$numrows-$ShowRows;
	    for ($k=0;$k<$ShowRows;$k++)
	    {
	      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
	      if ($row!=false)
	      {
          $Selectedarray[$k]=$row[$SelectedField];
          $Createdarray[$k]=$row[$CreatedField];
          $Usernamearray[$k]=$row[$UsernameField];
          $Passwordarray[$k]=$row[$PasswordField];
          $Enabledarray[$k]=$row[$EnabledField];
          $Namearray[$k]=$row[$NameField];
          $Emailarray[$k]=$row[$EmailField];
          $Usergroupsarray[$k]=$row[$UsergroupsField];
          $Cus1array[$k]=$row[$Custom1Field];
          $Cus2array[$k]=$row[$Custom2Field];
          $Cus3array[$k]=$row[$Custom3Field];
          $Cus4array[$k]=$row[$Custom4Field];
          $Cus5array[$k]=$row[$Custom5Field];
          $Cus6array[$k]=$row[$Custom6Field];
          $Cus7array[$k]=$row[$Custom7Field];
          $Cus8array[$k]=$row[$Custom8Field];
          $Cus9array[$k]=$row[$Custom9Field];
          $Cus10array[$k]=$row[$Custom10Field];
          $Cus11array[$k]=$row[$Custom11Field];
          $Cus12array[$k]=$row[$Custom12Field];
          $Cus13array[$k]=$row[$Custom13Field];
          $Cus14array[$k]=$row[$Custom14Field];
          $Cus15array[$k]=$row[$Custom15Field];
          $Cus16array[$k]=$row[$Custom16Field];
          $Cus17array[$k]=$row[$Custom17Field];
          $Cus18array[$k]=$row[$Custom18Field];
          $Cus19array[$k]=$row[$Custom19Field];
          $Cus20array[$k]=$row[$Custom20Field];
          $Cus21array[$k]=$row[$Custom21Field];
          $Cus22array[$k]=$row[$Custom22Field];
          $Cus23array[$k]=$row[$Custom23Field];
          $Cus24array[$k]=$row[$Custom24Field];
          $Cus25array[$k]=$row[$Custom25Field];
          $Cus26array[$k]=$row[$Custom26Field];
          $Cus27array[$k]=$row[$Custom27Field];
          $Cus28array[$k]=$row[$Custom28Field];
          $Cus29array[$k]=$row[$Custom29Field];
          $Cus30array[$k]=$row[$Custom30Field];
          $Cus31array[$k]=$row[$Custom31Field];
          $Cus32array[$k]=$row[$Custom32Field];
          $Cus33array[$k]=$row[$Custom33Field];
          $Cus34array[$k]=$row[$Custom34Field];
          $Cus35array[$k]=$row[$Custom35Field];
          $Cus36array[$k]=$row[$Custom36Field];
          $Cus37array[$k]=$row[$Custom37Field];
          $Cus38array[$k]=$row[$Custom38Field];
          $Cus39array[$k]=$row[$Custom39Field];
          $Cus40array[$k]=$row[$Custom40Field];
          $Cus41array[$k]=$row[$Custom41Field];
          $Cus42array[$k]=$row[$Custom42Field];
          $Cus43array[$k]=$row[$Custom43Field];
          $Cus44array[$k]=$row[$Custom44Field];
          $Cus45array[$k]=$row[$Custom45Field];
          $Cus46array[$k]=$row[$Custom46Field];
          $Cus47array[$k]=$row[$Custom47Field];
          $Cus48array[$k]=$row[$Custom48Field];
          $Cus49array[$k]=$row[$Custom49Field];
          $Cus50array[$k]=$row[$Custom50Field];
          $Useridarray[$k]=$row[$IdField];         
	      }
	      else
	      {
	        $Selectedarray[$k]="";
	        $Createdarray[$k]="";
	        $Usernamearray[$k]="";
	        $Passwordarray[$k]="";
	        $Enabledarray[$k]="";
	        $Namearray[$k]="";
	        $Emailarray[$k]="";
	        $Usergroupsarray[$k]="";
          $Cus1array[$k]="";
          $Cus2array[$k]="";
          $Cus3array[$k]="";
          $Cus4array[$k]="";
          $Cus5array[$k]="";
          $Cus6array[$k]="";
          $Cus7array[$k]="";
          $Cus8array[$k]="";
          $Cus9array[$k]="";
          $Cus10array[$k]="";
          $Cus11array[$k]="";
          $Cus12array[$k]="";
          $Cus13array[$k]="";
          $Cus14array[$k]="";
          $Cus15array[$k]="";
          $Cus16array[$k]="";
          $Cus17array[$k]="";
          $Cus18array[$k]="";
          $Cus19array[$k]="";
          $Cus20array[$k]="";
          $Cus21array[$k]="";
          $Cus22array[$k]="";
          $Cus23array[$k]="";
          $Cus24array[$k]="";
          $Cus25array[$k]="";
          $Cus26array[$k]="";
          $Cus27array[$k]="";
          $Cus28array[$k]="";
          $Cus29array[$k]="";
          $Cus30array[$k]="";
          $Cus31array[$k]="";
          $Cus32array[$k]="";
          $Cus33array[$k]="";
          $Cus34array[$k]="";
          $Cus35array[$k]="";
          $Cus36array[$k]="";
          $Cus37array[$k]="";
          $Cus38array[$k]="";
          $Cus39array[$k]="";
          $Cus40array[$k]="";
          $Cus41array[$k]="";
          $Cus42array[$k]="";
          $Cus43array[$k]="";
          $Cus44array[$k]="";
          $Cus45array[$k]="";
          $Cus46array[$k]="";
          $Cus47array[$k]="";
          $Cus48array[$k]="";
          $Cus49array[$k]="";
          $Cus50array[$k]="";          
          $Useridarray[$k]="";         
	      }
	    }
	  }
	  else
	  {
	    for ($k=0;$k<$ShowRows;$k++)
	    {
	      $Selectedarray[$k]="";
	      $Createdarray[$k]="";
	      $Usernamearray[$k]="";
	      $Passwordarray[$k]="";
	      $Enabledarray[$k]="";
	      $Namearray[$k]="";
	      $Emailarray[$k]="";
	      $Usergroupsarray[$k]="";
        $Cus1array[$k]="";
        $Cus2array[$k]="";
        $Cus3array[$k]="";
        $Cus4array[$k]="";
        $Cus5array[$k]="";
        $Cus6array[$k]="";
        $Cus7array[$k]="";
        $Cus8array[$k]="";
        $Cus9array[$k]="";
        $Cus10array[$k]="";
        $Cus11array[$k]="";
        $Cus12array[$k]="";
        $Cus13array[$k]="";
        $Cus14array[$k]="";
        $Cus15array[$k]="";
        $Cus16array[$k]="";
        $Cus17array[$k]="";
        $Cus18array[$k]="";
        $Cus19array[$k]="";
        $Cus20array[$k]="";
        $Cus21array[$k]="";
        $Cus22array[$k]="";
        $Cus23array[$k]="";
        $Cus24array[$k]="";
        $Cus25array[$k]="";
        $Cus26array[$k]="";
        $Cus27array[$k]="";
        $Cus28array[$k]="";
        $Cus29array[$k]="";
        $Cus30array[$k]="";
        $Cus31array[$k]="";
        $Cus32array[$k]="";
        $Cus33array[$k]="";
        $Cus34array[$k]="";
        $Cus35array[$k]="";
        $Cus36array[$k]="";
        $Cus37array[$k]="";
        $Cus38array[$k]="";
        $Cus39array[$k]="";
        $Cus40array[$k]="";
        $Cus41array[$k]="";
        $Cus42array[$k]="";
        $Cus43array[$k]="";
        $Cus44array[$k]="";
        $Cus45array[$k]="";
        $Cus46array[$k]="";
        $Cus47array[$k]="";
        $Cus48array[$k]="";
        $Cus49array[$k]="";
        $Cus50array[$k]=""; 
        $Useridarray[$k]="";         
	    }
	  }
  }
  // See how many records are selected
  $selquery="SELECT count(*) FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'";
  $mysql_result=mysqli_query($mysql_link,$selquery);
  $row = mysqli_fetch_row($mysql_result);
  if ($row!=false)
    $numselected = $row[0];
  else  
    $numselected = 0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>
<link href="stylesadmin.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" src="fancybox/lib/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script  type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox({
			width		: 600,
			height		: '70%',
			autoSize: false,
			type : 'iframe'
		});
		});
</script>
<script type="text/javascript" src="popupmenu.js">
/***********************************************
* Flex Level Popup Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/
</script>
<script type="text/javascript" src="anylinkcssmenu.js">
/***********************************************
* AnyLink CSS Menu script v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/anylinkcss.htm for full source code
***********************************************/  
</script>
<title>Sitelok control panel</title>
<script  type="text/javascript">
var lastclass='';
<?php if ($simfildisplayed==1) { ?>
var simfildisplayed=true;
<?php } else {?>
var simfildisplayed=false;
<?php } ?>
<?php if ($advfildisplayed==1) {?>
var advfildisplayed=true;
<?php } else { ?>
var advfildisplayed=false;
<?php } ?>
<?php if ($sqlfildisplayed==1) {?>
var sqlfildisplayed=true;
<?php } else { ?>
var sqlfildisplayed=false;
<?php } ?>

function Run_SQL_Query()
{
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="query"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=document.form1.sqlinput.value
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.submit()
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
}

function Show_All()
{
	document.form1.action="index.php"
	document.form1.target=""
	document.form1.act.value="showall"
	document.form1.user.value="void"
	document.form1.tablestart.value="0"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
	document.form1.sqlinput.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}

function Filter()
{
	document.form1.action="index.php"
	document.form1.target=""
	document.form1.act.value="filter"
	document.form1.user.value="void"
	document.form1.tablestart.value="0"
	document.form1.sqlquery.value=""
	document.form1.sqlinput.value=""
	document.form1.filteron.value="1"
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}

function Show_Filters(type)
{
  if (type=="advanced")
  {
    advfildisplayed=!advfildisplayed
    if (advfildisplayed)
    {
      simfildisplayed=false;  
      sqlfildisplayed=false;
    } 
  }  
  if (type=="simple")
  {
    simfildisplayed=!simfildisplayed
    if (simfildisplayed)
    {
      advfildisplayed=false;  
      sqlfildisplayed=false;
    } 
  }  
  if (type=="sql")
  {
    sqlfildisplayed=!sqlfildisplayed
    if (sqlfildisplayed)
    {
      simfildisplayed=false;  
      advfildisplayed=false;
    }     
  }  
  var afilrow1=document.getElementById('afilrow1') 
  var afilrow2=document.getElementById('afilrow2') 
  var afilrow3=document.getElementById('afilrow3') 
  var afilrow4=document.getElementById('afilrow4') 
  var sqlrow1=document.getElementById('sqlrow1')   
  var sfilrow1=document.getElementById('sfilrow1')   
  var sfilrow2=document.getElementById('sfilrow2')   
  var sfilrow3=document.getElementById('sfilrow3')   
  var sfilrow4=document.getElementById('sfilrow4')   
  var sfilrow5=document.getElementById('sfilrow5')   
  var sfilrow6=document.getElementById('sfilrow6')   
  var sfilrow7=document.getElementById('sfilrow7')   
  if (simfildisplayed)
  {
    sfilrow1.style.display = '';        
    sfilrow2.style.display = '';        
    sfilrow3.style.display = '';        
    sfilrow4.style.display = '';        
    sfilrow5.style.display = '';        
    sfilrow6.style.display = '';        
    sfilrow7.style.display = '';        
    document.getElementById("sfilimage").src="hide.png";
  }
  else
  {
    sfilrow1.style.display = 'none';        
    sfilrow2.style.display = 'none';        
    sfilrow3.style.display = 'none';        
    sfilrow4.style.display = 'none';        
    sfilrow5.style.display = 'none';        
    sfilrow6.style.display = 'none';        
    sfilrow7.style.display = 'none';        
    document.getElementById("sfilimage").src="expand.png";
  }
  if (advfildisplayed)
  {
    afilrow1.style.display = '';        
    afilrow2.style.display = '';        
    afilrow3.style.display = '';        
    afilrow4.style.display = '';
    document.getElementById("afilimage").src="hide.png";
  }
  else
  {
    afilrow1.style.display = 'none';        
    afilrow2.style.display = 'none';        
    afilrow3.style.display = 'none';        
    afilrow4.style.display = 'none';            
    document.getElementById("afilimage").src="expand.png";
  }
  if (sqlfildisplayed)
  {
    sqlrow1.style.display = '';
    document.getElementById("sqlimage").src="hide.png";
  }
  else
  {
    sqlrow1.style.display = 'none';
    document.getElementById("sqlimage").src="expand.png";
  }
}
function QuickSearch()
{
  if (document.form1.quicksearch.value=="")
  {
    alert("Please enter the data to search for")
    document.form1.quicksearch.focus()
    return
  }
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="quicksearch"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""
  document.form1.joinwithin.value=""    
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function MemberOf()
{
  document.form1.memberof.value=document.form1.selectmemberof.value;
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="memberof"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function UnexpMemberOf()
{
  document.form1.unexpmemberof.value=document.form1.selectunexpmemberof.value;
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="unexpmemberof"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value="" 
  document.form1.expmemberof.value=""    
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function ExpMemberOf()
{
  document.form1.expmemberof.value=document.form1.selectexpmemberof.value;
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="expmemberof"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function ExpWithin()
{
  if (!isValidNumDays(document.form1.expwithindays.value))
  {
    alert("please enter the number of days such as 30")
    document.form1.expwithindays.focus()
    return
  }
  document.form1.expwithin.value=document.form1.selectexpwithin.value;
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="expwithin"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.joinwithin.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function JoinWithin()
{
  if (!isValidNumDays(document.form1.joinwithin.value))
  {
    alert("please enter the number of days such as 30")
    document.form1.joinwithin.focus()
    return
  }
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="joinwithin"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.quicksearch.value=""  
  document.form1.memberof.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.onlyselected.value=""  
  document.form1.submit()
}
function OnlySelected()
{
  document.form1.onlyselected.value=document.form1.selectonlyselected.value;
	document.form1.action="index.php"
  document.form1.target=""
	document.form1.act.value="onlyselected"
	document.form1.user.value="void"
	document.form1.filfield1.value="<?php echo $usernameField; ?>"
	document.form1.filcond1.value="contains"
	document.form1.fildata1.value=""
	document.form1.filfield2.value="<?php echo $usernameField; ?>"
	document.form1.filcond2.value="contains"
	document.form1.fildata2.value=""
	document.form1.filfield3.value="<?php echo $usernameField; ?>"
	document.form1.filcond3.value="contains"
	document.form1.fildata3.value=""
	document.form1.filfield4.value="<?php echo $usernameField; ?>"
	document.form1.filcond4.value="contains"
	document.form1.fildata4.value=""
	document.form1.filbool1.value="AND"
	document.form1.filbool2.value="AND"
	document.form1.filbool3.value="AND"
	document.form1.filteron.value="0"
	document.form1.sqlquery.value=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.memberof.value=""  
  document.form1.quicksearch.value=""  
  document.form1.unexpmemberof.value=""  
  document.form1.expmemberof.value=""  
  document.form1.expwithin.value=""  
  document.form1.expwithindays.value=""  
  document.form1.joinwithin.value=""  
  document.form1.submit()
}
function Edit_User(user)
{
	document.form1.act.value="openadminpage"
  document.form1.adminpage.value="edituser.php?slcsrf=<?php echo $slcsrftoken; ?>&user="+urlencode(user)
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Email_User(user)
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="<?php if ($LegacyBrowser) echo "simple"; ?>emailuser.php?act=emailuser&slcsrf=<?php echo $slcsrftoken; ?>&user="+urlencode(user)
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Log_User(user)
{
  //Not used with Fancybox
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="logmanage.php?act=recentactivity&slcsrf=<?php echo $slcsrftoken; ?>&user="+urlencode(user)
	document.form1.target="_blank"
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Delete_User(user)
{
  if (confirm("Permanently delete user "+user+"?"))
  {
		document.form1.action="index.php"
		document.form1.act.value="delete"
		document.form1.user.value=user
	  document.form1.target=""
	  document.form1.simfildisplayed.value=simfildisplayed?1:0
	  document.form1.advfildisplayed.value=advfildisplayed?1:0
	  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}
function Plugin_User(pluginid,pluginindex,plugin,user)
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value=plugin+"?user="+urlencode(user)+"&act=pluginuser&slcsrf=<?php echo $slcsrftoken; ?>&pluginid="+pluginid+"&pluginindex="+pluginindex
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Add_User()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="adduser.php?slcsrf=<?php echo $slcsrftoken; ?>"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Pass_Remind(user)
{
  if (confirm("Send password reminder email to "+user+"?"))
  {
		document.form1.action="index.php"
		document.form1.act.value="passremind"
		document.form1.user.value=user
	  document.form1.target=""
	  document.form1.simfildisplayed.value=simfildisplayed?1:0
	  document.form1.advfildisplayed.value=advfildisplayed?1:0
	  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}

function Goto_First()
{
  var ts
  ts=<?php echo "$tablestart\n";?>
  if (ts!=0)
  {
		document.form1.action="index.php"
		document.form1.act.value="first"
		document.form1.user.value="void"
    document.form1.tablestart.value=0
  	document.form1.target=""
  	document.form1.simfildisplayed.value=simfildisplayed?1:0
  	document.form1.advfildisplayed.value=advfildisplayed?1:0
  	document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}

function Goto_Prev()
{
  var ts
  var row
  var sr
  ts=<?php print("$tablestart\n");?>
  sr=<?php print("$ShowRows\n");?>
  if (ts>0)
  {
    row=ts-sr
    if (row<0)
    {
      row=0
    }
		document.form1.action="index.php"
		document.form1.act.value="prev"
		document.form1.user.value="void"
    document.form1.tablestart.value=row.toString(10)
  	document.form1.target=""
  	document.form1.simfildisplayed.value=simfildisplayed?1:0
  	document.form1.advfildisplayed.value=advfildisplayed?1:0
  	document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}

function Goto_Next()
{
  var ts
  var mr
  var row
  var sr
  ts=<?php print("$tablestart\n");?>
  mr=<?php print("$numrows\n");?>
  sr=<?php print("$ShowRows\n");?>
  if ((mr-ts)>sr)
  {
    row=ts+sr
		document.form1.action="index.php"
		document.form1.act.value="next"
		document.form1.user.value="void"
    document.form1.tablestart.value=row.toString(10)
	  document.form1.target=""
	  document.form1.simfildisplayed.value=simfildisplayed?1:0
	  document.form1.advfildisplayed.value=advfildisplayed?1:0
	  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}

function Goto_Last()
{
  var ts
  var mr
  var row
  var sr
  ts=<?php print("$tablestart\n");?>
  mr=<?php print("$numrows\n");?>
  sr=<?php print("$ShowRows\n");?>
  if ((mr-ts)>sr)
  {
    row=Math.floor(mr/sr)*sr
		document.form1.action="index.php"
		document.form1.act.value="last"
		document.form1.user.value="void"
    document.form1.tablestart.value=row.toString(10)
  	document.form1.target=""
  	document.form1.simfildisplayed.value=simfildisplayed?1:0
  	document.form1.advfildisplayed.value=advfildisplayed?1:0
  	document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}

function Goto_Page()
{
  var ts
  var sr
  var np
  var row
  ts=<?php print("$tablestart\n");?>
  sr=<?php print("$ShowRows\n");?>
  np=document.form1.showpage.value
  row=sr*(np-1)
  if (ts!=row)
  {
		document.form1.action="index.php"
		document.form1.act.value="goto"
		document.form1.user.value="void"
    document.form1.tablestart.value=row.toString(10)
  	document.form1.target=""
  	document.form1.simfildisplayed.value=simfildisplayed?1:0
  	document.form1.advfildisplayed.value=advfildisplayed?1:0
    document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
 	  document.form1.submit()
  }
}

function Records_Per_Page()
{
	document.form1.action="index.php"
	document.form1.act.value="recordsperpage"
	document.form1.user.value="void"
  document.form1.tablestart.value=0
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}

function Show_Selected_Actions(dis)
{
  var divobj=document.getElementById('selectedactions') 
//  Not IE7 compatible
//  var divobj2=document.getElementById('selectedactionsmenu') 
  if (dis)
  {
    divobj.style.display='';
//    divobj2.style.display='';
  }  
  else
  {
    divobj.style.display='none';
//    divobj2.style.display='none';
  } 
}

function Sort(sortf)
{
	var sortd
	sortd="<?php echo $sortd ?>"
	if (sortf=="")
	  sortd=""
	else
	{
	  if (sortf=="<?php echo $sortf; ?>")
	  {
	    if (sortd=="ASC")
	      sortd="DESC"
	    else
	      sortd="ASC"
	  }
	  else
	  {
	    sortd="ASC"
	  }
	}
  document.form1.action="index.php"
  document.form1.act.value="sort"
  document.form1.user.value="void"
  document.form1.sortf.value=sortf
  document.form1.sortd.value=sortd
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Delete_Selected()
{
	var selected=<?php print $numselected; ?>+justselected
	if (selected==0)
	{
		alert("You must selected at least one user")
		return
	}
  if (confirm("Permanently delete "+selected+" user(s)?"))
  {
	  document.form1.action="index.php"
	  document.form1.act.value="deleteselected"
	  document.form1.user.value="void"
   	document.form1.target=""
   	document.form1.simfildisplayed.value=simfildisplayed?1:0
   	document.form1.advfildisplayed.value=advfildisplayed?1:0
   	document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
  }
}
function Email_Selected()
{
	var selected=<?php print $numselected; ?>+justselected
	if (selected==0)
	{
		alert("You must selected at least one user")
		return
	}
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="<?php if ($LegacyBrowser) echo "simple"; ?>emailuser.php?act=emailselected&slcsrf=<?php echo $slcsrftoken; ?>&user=void"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Export_Selected()
{
	var selected=<?php print $numselected; ?>+justselected
	if (selected==0)
	{
		alert("You must selected at least one user")
		return
	}
  document.form1.action="index.php?dummy=123<?php if ($NoFilename!=1) print"/sitelokusers.csv"; ?>"
  document.form1.act.value="exportselected"
  document.form1.user.value="void"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}

function Plugin_Selected(pluginid,pluginindex,plugin)
{
	var selected=<?php print $numselected; ?>+justselected
	if (selected==0)
	{
		alert("You must selected at least one user")
		return
	}
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value=plugin+"?act=pluginselected&slcsrf=<?php echo $slcsrftoken; ?>&pluginid="+pluginid+"&numsel="+selected+"&pluginindex="+pluginindex
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}

function Import_Users()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="importuser.php?slcsrf=<?php echo $slcsrftoken; ?>"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Manage_Log()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="logmanage.php?act=logmanage&slcsrf=<?php echo $slcsrftoken; ?>&user=void"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Email_Direct()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="<?php if ($LegacyBrowser) echo "simple"; ?>emailuser.php?act=emaildirect&slcsrf=<?php echo $slcsrftoken; ?>&user=void"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Edit_Config()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="editconfig.php"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Plugins_Config()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="plugins.php?slcsrf=<?php echo $slcsrftoken; ?>"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}
function Manage_Groups()
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value="groupmanage.php"
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}

function Plugin_Page(pluginid,pluginindex,pluginpage)
{
  document.form1.act.value="openadminpage"
  document.form1.adminpage.value=pluginpage+"?act=pluginadmin&slcsrf=<?php echo $slcsrftoken; ?>&pluginid="+pluginid+"&pluginindex="+pluginindex
	document.form1.target=""
  document.form1.simfildisplayed.value=simfildisplayed?1:0
  document.form1.advfildisplayed.value=advfildisplayed?1:0
  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
  document.form1.submit()
}

var justselected=0
function Select(sel)
{
	var selected=<?php print $numselected."\n"; ?>
  var slobj=document.getElementById('sl'+sel)
  var id=slobj.value.substr(1)
  var st=slobj.value.substr(0,1)
  var cbobj=document.getElementById('cb'+sel)
  if (cbobj.checked)
	{
	  slobj.value='Y'+id
		justselected++
	}
	else
	{
	  slobj.value='N'+id
		justselected--
	}	
  var object=document.getElementById('seltext') 
	if ((selected+justselected)>0)
	{
	  selected=selected+justselected
		object.innerHTML="("+selected+" selected)"
		Show_Selected_Actions(true)
	}
	else
	{
		object.innerHTML="&nbsp;"
		Show_Selected_Actions(false)
	}	
}
function Select_All()
{
	  document.form1.action="index.php"
	  document.form1.act.value="selectall"
	  document.form1.user.value="void"
	  document.form1.target=""
	  document.form1.simfildisplayed.value=simfildisplayed?1:0
	  document.form1.advfildisplayed.value=advfildisplayed?1:0
	  document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
}
function Deselect_All()
{
	  document.form1.action="index.php"
	  document.form1.act.value="deselectall"
	  document.form1.user.value="void"
  	document.form1.target=""
  	document.form1.simfildisplayed.value=simfildisplayed?1:0
    document.form1.advfildisplayed.value=advfildisplayed?1:0
    document.form1.sqlfildisplayed.value=sqlfildisplayed?1:0
	  document.form1.submit()
}
function submitenter(e,func)
{
  var keycode
  if (window.event) keycode = window.event.keyCode
  else if (e) keycode = e.which
  else return true
  if (keycode == 13)
  {
      func()
      return false
  }
  else
      return true
}
function isValidNumDays(str)
{
    return /^[1-9]\d*$/.test(str);
}
function urlencode(str)
{
    str = (str+'').toString();
    // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
    // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}

function MoreMenu(user)
{
  var str=""+
  <?php if ($ActionItems==0) { ?>
          "<li><a href=\"#\" onclick=\"Edit_User('!!!username!!!'); return false;\"><img src=\"edit.png\" width=\"16\" height=\"16\" border=\"0\">Edit User</a></li>"+
          "<li><a href=\"#\" onclick=\"Email_User('!!!username!!!'); return false;\"><img src=\"email.png\" width=\"16\" height=\"16\" border=\"0\">Email User</a></li>"+
          "<li><a href=\"#\" onclick=\"Delete_User('!!!username!!!'); return false;\"><img src=\"delete.png\" width=\"16\" height=\"16\" border=\"0\">Delete User</a></li>"+
<?php } ?>
          "<li><a class=\"fancybox fancybox.iframe\" href=\"logmanage.php?act=recentactivity&slcsrf=<?php echo $slcsrftoken; ?>&user=!!!urlencodeusername!!!\"><img src=\"log.png\" width=\"16\" height=\"16\" border=\"0\">Recent Activity</a></li>"+
          "<li><a href=\"#\" onclick=\"Pass_Remind('!!!username!!!'); return false;\"><img src=\"passremind.png\" width=\"16\" height=\"16\" border=\"0\">Send password reminder</a></li>"+
<?php
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (($slplugin_adminusericon[$p]!="") && ($slplugin_adminuserpage[$p]!=""))
    {
    ?>
          "<li><a href=\"#\" onclick=\"Plugin_User(<?php echo $slpluginid[$p]; ?>,<?php echo $p; ?>,'<?php echo $slpluginfolder[$p]."/".$slplugin_adminuserpage[$p]; ?>','!!!username!!!'); return false;\"><img src=\"<?php echo $slpluginfolder[$p]."/".$slplugin_adminusericon[$p]; ?>\" width=\"16\" height=\"16\" border=\"0\"><?php echo $slplugin_adminusertooltip[$p]; ?></a></li>"+

    <?php
    }
  }
  ?>
  ""
  obj=document.getElementById('popmenu1')
  str=str.replace(/!!!username!!!/g, user)
  str=str.replace(/!!!urlencodeusername!!!/g, urlencode(user))  
  obj.innerHTML=str
}

//anylinkcssmenu.init("menu_anchors_class") ////Pass in the CSS class of anchor links (that contain a sub menu)
anylinkcssmenu.init("anchorclass")
</script>

</head>
<body>
<?php include "headeradmin.php"; ?>


<ul id="popmenu1" class="jqpopupmenu">
</ul>

<ul id="navbar">

<li><a href="#" rel="usersmenu" class="anchorclass">Users</a>
<div id="usersmenu" class="anylinkcss">
  <ul>
     <li><a href="javascript: Add_User()"><img src="adduser.png">Add User</a></li>
     <li><a href="javascript: Select_All()"><img src="check.png">Select All Users</a></li>
 
<!-- Not IE7 compatible
  <div style="display: none;" id="selectedactionsmenu">
-->

     <li><a href="javascript: Deselect_All()"><img src="ucheck.png">Deselect All Users</a></li>     
     <li><a href="javascript: Email_Selected()"><img src="email.png">Email Selected</a></li>
     <li><a href="javascript: Export_Selected()"><img src="export.png">Export Selected</a></li>
     <li><a href="javascript: Delete_Selected()"><img src="delete.png">Delete Selected</a></li>
     <li><a href="javascript: Import_Users()"><img src="import.png">Import Users</a></li>
<?php
// Insert links to plugin selected users pages
for ($p=0;$p<$slnumplugins;$p++)
{
  if (($slplugin_adminusermenuname[$p]!="") && ($slplugin_adminusermenupage[$p]!=""))
  {
  ?>
  <li><a href="javascript: Plugin_Selected(<?php echo $slpluginid[$p]; ?>,<?php echo $p; ?>,'<?php echo $slpluginfolder[$p]."/".$slplugin_adminusermenupage[$p]; ?>')"><img src="<?php echo $slpluginfolder[$p]."/".$slplugin_icon[$p]; ?>"><?php echo $slplugin_adminusermenuname[$p]; ?></a></li>
  <?php  
  }
}
?>  
<!-- Not IE7 compatible
  </div>
-->
  </ul> 
</div>   
</li>
   
   
<li><a href="javascript: Manage_Groups()">Manage Groups</a></li>
<li><a href="javascript: Manage_Log()">Manage Log</a></li>
<li><a href="javascript: Email_Direct()">Email</a></li>
<li><a href="javascript: Import_Users()">Import Users</a></li>

<?php
// Insert links to plugin pages
for ($p=0;$p<$slnumplugins;$p++)
{
  if (($slplugin_adminmenuname[$p]!="") && ($slplugin_adminmenupage[$p]!=""))
  {
  ?>
  <li><a href="javascript: Plugin_Page(<?php echo $slpluginid[$p]; ?>,<?php echo $p; ?>,'<?php echo $slpluginfolder[$p]."/".$slplugin_adminmenupage[$p]; ?>')"><?php echo $slplugin_adminmenuname[$p]; ?></a></li>
  <?php  
  }
}
?>  

<li><a href="#" rel="pluginmenu" class="anchorclass">Plugins</a>
<div id="pluginmenu" class="anylinkcss">
<ul>   
<?php
if ($slnumplugins>0)
{
  // Insert links to plugin pages
  
  for ($p=0;$p<$slnumplugins;$p++)
  {
    if (($slplugin_adminpluginmenuname[$p]!="") && ($slplugin_adminpluginmenupage[$p]!=""))
    {
    ?>
<li><a href="javascript: Plugin_Page(<?php echo $slpluginid[$p]; ?>,<?php echo $p; ?>,'<?php echo $slpluginfolder[$p]."/".$slplugin_adminpluginmenupage[$p]; ?>')"><img src="<?php echo $slpluginfolder[$p]."/".$slplugin_icon[$p]; ?>"><?php echo $slplugin_adminpluginmenuname[$p]; ?></a></li>
    <?php  
    }
  }
?>
<?php } ?>
<li><a href="javascript: Plugins_Config()">Plugin Preferences</a></li>
<li><a href="http://www.vibralogix.com/sitelokpw/plugins.php" target="_blank">Find Plugins</a></li>
</ul>
</div>

<li><a href="#" rel="toolsmenu" class="anchorclass">Tools</a>
<div id="toolsmenu" class="anylinkcss">
  <ul>
     <li><a href="javascript: Edit_Config()">Configuration</a></li>
     <li><a href="javascript: Plugins_Config()">Plugins</a></li>
     <li><a href="backup.php?slcsrf=<?php echo $slcsrftoken; ?>">Backup</a></li>
  </ul>
</div>              
</li>

<li><a href="<?php siteloklogout();?>">Logout</a></li>
</ul>

<form name="form1" id="adminform" method="POST" action="index.php" target="">
<div class="filter">
<input name="act" type="hidden" value="">
<input name="user" type="hidden" value="">
<input name="adminpage" type="hidden" value="">
<input name="tablestart" type="hidden" value="<?php echo $tablestart; ?>">
<input name="sortf" type="hidden" value="<?php echo $sortf; ?>">
<input name="sortd" type="hidden" value="<?php echo $sortd; ?>">
<input name="filteron" type="hidden" value="<?php echo $filteron; ?>">
<input name="sqlquery" type="hidden" value="<?php echo $sqlquery; ?>">
<input name="simfildisplayed" type="hidden" value="">
<input name="advfildisplayed" type="hidden" value="">
<input name="sqlfildisplayed" type="hidden" value="">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<table class="filter" border="0" cellspacing="0" bgcolor="#F2F0FF">
    <tr>
    <th onclick="Show_Filters('simple');" colspan="5"><span style="float: left;">Quick filters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="float: right;"><img id="sfilimage" src="expand.png"></span></th>
    </tr>
    <tr id="sfilrow1" style="display: none;">
    <td colspan="2">
    Quick search
    </td>
    <td colspan="2">              
    <input class="filter  inputtextfilter" type="text" id="quicksearch" name="quicksearch" value="<?php print($quicksearch);?>" maxlength="255" onKeyPress="return submitenter(event,QuickSearch)">
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="QuickSearch();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow2" style="display: none;">
    <td colspan="2">
    All members of
    </td>
    <td colspan="2">  
    <input type="hidden" name="memberof" value="<?php echo $memberof; ?>">
    <select class="filter" name="selectmemberof" size="1" onKeyPress="return submitenter(event,MemberOf)">
    <?php for ($k=0;$k<count($groupname);$k++) { ?>
    <option value="<?php echo $groupname[$k]; ?>" <?php if ($memberof==$groupname[$k]) print "selected"; ?>><?php echo $groupname[$k]; ?></option>
    <?php } ?>
    </select>
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="MemberOf();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow3" style="display: none;">
    <td colspan="2">
    Unexpired members of
    </td>
    <td colspan="2">  
    <input type="hidden" name="unexpmemberof" value="<?php echo $unexpmemberof; ?>">
    <select class="filter" name="selectunexpmemberof" size="1" onKeyPress="return submitenter(event,UnexpMemberOf)">
    <?php for ($k=0;$k<count($groupname);$k++) { ?>
    <option value="<?php echo $groupname[$k]; ?>" <?php if ($unexpmemberof==$groupname[$k]) print "selected"; ?>><?php echo $groupname[$k]; ?></option>
    <?php } ?>
    </select>
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="UnexpMemberOf();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow4" style="display: none;">
    <td colspan="2">
    Expired members of
    </td>
    <td colspan="2">  
    <input type="hidden" name="expmemberof" value="<?php echo $expmemberof; ?>">
    <select class="filter" name="selectexpmemberof" size="1"  onKeyPress="return submitenter(event,ExpMemberOf)">
    <?php for ($k=0;$k<count($groupname);$k++) { ?>
    <option value="<?php echo $groupname[$k]; ?>" <?php if ($expmemberof==$groupname[$k]) print "selected"; ?>><?php echo $groupname[$k]; ?></option>
    <?php } ?>
    </select>
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="ExpMemberOf();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow5" style="display: none;">
    <td colspan="2">
    Members expiring in
    </td>
    <td colspan="2">  
    <input type="hidden" name="expwithin" value="<?php echo $expwithin; ?>">
    <select class="filter" name="selectexpwithin" size="1" onKeyPress="return submitenter(event,ExpWithin)">
    <?php for ($k=0;$k<count($groupname);$k++) { ?>
    <option value="<?php echo $groupname[$k]; ?>" <?php if ($expwithin==$groupname[$k]) print "selected"; ?>><?php echo $groupname[$k]; ?></option>
    <?php } ?>
    </select>
    within
    <input class="filter  inputtextfilter short" type="text" id="expwithindays" name="expwithindays" value="<?php print($expwithindays);?>" maxlength="3" onKeyPress="return submitenter(event,ExpWithin)">    
    days 
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="ExpWithin();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow6" style="display: none;">
    <td colspan="2">
    New members joined within
    </td>
    <td colspan="2">  
    <input class="filter  inputtextfilter short" type="text" id="joinwithin" name="joinwithin" value="<?php print($joinwithin);?>" maxlength="3" onKeyPress="return submitenter(event,JoinWithin)">    
    days 
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="JoinWithin();">Filter</button>          
    </td>
    </tr>

    <tr id="sfilrow7" style="display: none;">
    <td colspan="2">
    Only users that are 
    </td>
    <td colspan="2">  
    <input type="hidden" name="onlyselected" value="<?php echo $onlyselected; ?>">
    <select class="filter" name="selectonlyselected" size="1" onKeyPress="return submitenter(event,OnlySelected)">
    <option value="Yes" <?php if ($onlyselected=="Yes") print "selected"; ?>>Selected</option>
    <option value="No" <?php if ($onlyselected=="No") print "selected"; ?>>Not Selected</option>
    </select>
    </td>
    <td>
    <button type="button" id="filter-go" name="filter" value="Filter" onclick="OnlySelected();">Filter</button>          
    </td>
    </tr>

    <tr>
        <th onclick="Show_Filters('advanced');" colspan="5"><span style="float: left;">Advanced filter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="float: right;"><img id="afilimage" src="expand.png"></span></th>
    </tr>
    <tr id="afilrow1" style="display: none;">
        <td>&nbsp;</td>
        <td><select class="filter" name="filfield1" size="1" onKeyPress="return submitenter(event,Filter)">
                <option value="<?php print $UsernameField; ?>" <?php if (($filfield1==$UsernameField) || ($filfield1=="")) print "selected"; ?>>Username</option>
                <option value="<?php print $PasswordField; ?>" <?php if ($filfield1==$PasswordField) print "selected"; ?>>Password</option>
                <option value="<?php print $EnabledField; ?>" <?php if ($filfield1==$EnabledField) print "selected"; ?>>Enabled</option>
                <option value="<?php print $NameField; ?>" <?php if ($filfield1==$NameField) print "selected"; ?>>Name</option>
                <option value="<?php print $EmailField; ?>" <?php if ($filfield1==$EmailField) print "selected"; ?>>Email</option>
                <option value="<?php print $UsergroupsField; ?>" <?php if ($filfield1==$UsergroupsField) print "selected"; ?>>Usergroups</option>
                <option value="groupexpiry" <?php if ($filfield1=="groupexpiry") print "selected"; ?>>Usergroups expiry</option>
                <option value="<?php print $CreatedField; ?>" <?php if ($filfield1==$CreatedField) print "selected"; ?>>Created</option>
                <?php if ($CustomTitle1!="") { ?><option value="<?php print $Custom1Field; ?>" <?php if ($filfield1==$Custom1Field) print "selected"; ?>><?php print $CustomTitle1; ?></option><?php } ?>
                <?php if ($CustomTitle2!="") { ?><option value="<?php print $Custom2Field; ?>" <?php if ($filfield1==$Custom2Field) print "selected"; ?>><?php print $CustomTitle2; ?></option><?php } ?>
                <?php if ($CustomTitle3!="") { ?><option value="<?php print $Custom3Field; ?>" <?php if ($filfield1==$Custom3Field) print "selected"; ?>><?php print $CustomTitle3; ?></option><?php } ?>
                <?php if ($CustomTitle4!="") { ?><option value="<?php print $Custom4Field; ?>" <?php if ($filfield1==$Custom4Field) print "selected"; ?>><?php print $CustomTitle4; ?></option><?php } ?>
                <?php if ($CustomTitle5!="") { ?><option value="<?php print $Custom5Field; ?>" <?php if ($filfield1==$Custom5Field) print "selected"; ?>><?php print $CustomTitle5; ?></option><?php } ?>
                <?php if ($CustomTitle6!="") { ?><option value="<?php print $Custom6Field; ?>" <?php if ($filfield1==$Custom6Field) print "selected"; ?>><?php print $CustomTitle6; ?></option><?php } ?>
                <?php if ($CustomTitle7!="") { ?><option value="<?php print $Custom7Field; ?>" <?php if ($filfield1==$Custom7Field) print "selected"; ?>><?php print $CustomTitle7; ?></option><?php } ?>
                <?php if ($CustomTitle8!="") { ?><option value="<?php print $Custom8Field; ?>" <?php if ($filfield1==$Custom8Field) print "selected"; ?>><?php print $CustomTitle8; ?></option><?php } ?>
                <?php if ($CustomTitle9!="") { ?><option value="<?php print $Custom9Field; ?>" <?php if ($filfield1==$Custom9Field) print "selected"; ?>><?php print $CustomTitle9; ?></option><?php } ?>
                <?php if ($CustomTitle10!="") { ?><option value="<?php print $Custom10Field; ?>" <?php if ($filfield1==$Custom10Field) print "selected"; ?>><?php print $CustomTitle10; ?></option><?php } ?>
                <?php if ($CustomTitle11!="") { ?><option value="<?php print $Custom11Field; ?>" <?php if ($filfield1==$Custom11Field) print "selected"; ?>><?php print $CustomTitle11; ?></option><?php } ?>
                <?php if ($CustomTitle12!="") { ?><option value="<?php print $Custom12Field; ?>" <?php if ($filfield1==$Custom12Field) print "selected"; ?>><?php print $CustomTitle12; ?></option><?php } ?>
                <?php if ($CustomTitle13!="") { ?><option value="<?php print $Custom13Field; ?>" <?php if ($filfield1==$Custom13Field) print "selected"; ?>><?php print $CustomTitle13; ?></option><?php } ?>
                <?php if ($CustomTitle14!="") { ?><option value="<?php print $Custom14Field; ?>" <?php if ($filfield1==$Custom14Field) print "selected"; ?>><?php print $CustomTitle14; ?></option><?php } ?>
                <?php if ($CustomTitle15!="") { ?><option value="<?php print $Custom15Field; ?>" <?php if ($filfield1==$Custom15Field) print "selected"; ?>><?php print $CustomTitle15; ?></option><?php } ?>
                <?php if ($CustomTitle16!="") { ?><option value="<?php print $Custom16Field; ?>" <?php if ($filfield1==$Custom16Field) print "selected"; ?>><?php print $CustomTitle16; ?></option><?php } ?>
                <?php if ($CustomTitle17!="") { ?><option value="<?php print $Custom17Field; ?>" <?php if ($filfield1==$Custom17Field) print "selected"; ?>><?php print $CustomTitle17; ?></option><?php } ?>
                <?php if ($CustomTitle18!="") { ?><option value="<?php print $Custom18Field; ?>" <?php if ($filfield1==$Custom18Field) print "selected"; ?>><?php print $CustomTitle18; ?></option><?php } ?>
                <?php if ($CustomTitle19!="") { ?><option value="<?php print $Custom19Field; ?>" <?php if ($filfield1==$Custom19Field) print "selected"; ?>><?php print $CustomTitle19; ?></option><?php } ?>
                <?php if ($CustomTitle20!="") { ?><option value="<?php print $Custom20Field; ?>" <?php if ($filfield1==$Custom20Field) print "selected"; ?>><?php print $CustomTitle20; ?></option><?php } ?>
                <?php if ($CustomTitle21!="") { ?><option value="<?php print $Custom21Field; ?>" <?php if ($filfield1==$Custom21Field) print "selected"; ?>><?php print $CustomTitle21; ?></option><?php } ?>
                <?php if ($CustomTitle22!="") { ?><option value="<?php print $Custom22Field; ?>" <?php if ($filfield1==$Custom22Field) print "selected"; ?>><?php print $CustomTitle22; ?></option><?php } ?>
                <?php if ($CustomTitle23!="") { ?><option value="<?php print $Custom23Field; ?>" <?php if ($filfield1==$Custom23Field) print "selected"; ?>><?php print $CustomTitle23; ?></option><?php } ?>
                <?php if ($CustomTitle24!="") { ?><option value="<?php print $Custom24Field; ?>" <?php if ($filfield1==$Custom24Field) print "selected"; ?>><?php print $CustomTitle24; ?></option><?php } ?>
                <?php if ($CustomTitle25!="") { ?><option value="<?php print $Custom25Field; ?>" <?php if ($filfield1==$Custom25Field) print "selected"; ?>><?php print $CustomTitle25; ?></option><?php } ?>
                <?php if ($CustomTitle26!="") { ?><option value="<?php print $Custom26Field; ?>" <?php if ($filfield1==$Custom26Field) print "selected"; ?>><?php print $CustomTitle26; ?></option><?php } ?>
                <?php if ($CustomTitle27!="") { ?><option value="<?php print $Custom27Field; ?>" <?php if ($filfield1==$Custom27Field) print "selected"; ?>><?php print $CustomTitle27; ?></option><?php } ?>
                <?php if ($CustomTitle28!="") { ?><option value="<?php print $Custom28Field; ?>" <?php if ($filfield1==$Custom28Field) print "selected"; ?>><?php print $CustomTitle28; ?></option><?php } ?>
                <?php if ($CustomTitle29!="") { ?><option value="<?php print $Custom29Field; ?>" <?php if ($filfield1==$Custom29Field) print "selected"; ?>><?php print $CustomTitle29; ?></option><?php } ?>
                <?php if ($CustomTitle30!="") { ?><option value="<?php print $Custom30Field; ?>" <?php if ($filfield1==$Custom30Field) print "selected"; ?>><?php print $CustomTitle30; ?></option><?php } ?>
                <?php if ($CustomTitle31!="") { ?><option value="<?php print $Custom31Field; ?>" <?php if ($filfield1==$Custom31Field) print "selected"; ?>><?php print $CustomTitle31; ?></option><?php } ?>
                <?php if ($CustomTitle32!="") { ?><option value="<?php print $Custom32Field; ?>" <?php if ($filfield1==$Custom32Field) print "selected"; ?>><?php print $CustomTitle32; ?></option><?php } ?>
                <?php if ($CustomTitle33!="") { ?><option value="<?php print $Custom33Field; ?>" <?php if ($filfield1==$Custom33Field) print "selected"; ?>><?php print $CustomTitle33; ?></option><?php } ?>
                <?php if ($CustomTitle34!="") { ?><option value="<?php print $Custom34Field; ?>" <?php if ($filfield1==$Custom34Field) print "selected"; ?>><?php print $CustomTitle34; ?></option><?php } ?>
                <?php if ($CustomTitle35!="") { ?><option value="<?php print $Custom35Field; ?>" <?php if ($filfield1==$Custom35Field) print "selected"; ?>><?php print $CustomTitle35; ?></option><?php } ?>
                <?php if ($CustomTitle36!="") { ?><option value="<?php print $Custom36Field; ?>" <?php if ($filfield1==$Custom36Field) print "selected"; ?>><?php print $CustomTitle36; ?></option><?php } ?>
                <?php if ($CustomTitle37!="") { ?><option value="<?php print $Custom37Field; ?>" <?php if ($filfield1==$Custom37Field) print "selected"; ?>><?php print $CustomTitle37; ?></option><?php } ?>
                <?php if ($CustomTitle38!="") { ?><option value="<?php print $Custom38Field; ?>" <?php if ($filfield1==$Custom38Field) print "selected"; ?>><?php print $CustomTitle38; ?></option><?php } ?>
                <?php if ($CustomTitle39!="") { ?><option value="<?php print $Custom39Field; ?>" <?php if ($filfield1==$Custom39Field) print "selected"; ?>><?php print $CustomTitle39; ?></option><?php } ?>
                <?php if ($CustomTitle40!="") { ?><option value="<?php print $Custom40Field; ?>" <?php if ($filfield1==$Custom40Field) print "selected"; ?>><?php print $CustomTitle40; ?></option><?php } ?>
                <?php if ($CustomTitle41!="") { ?><option value="<?php print $Custom41Field; ?>" <?php if ($filfield1==$Custom41Field) print "selected"; ?>><?php print $CustomTitle41; ?></option><?php } ?>
                <?php if ($CustomTitle42!="") { ?><option value="<?php print $Custom42Field; ?>" <?php if ($filfield1==$Custom42Field) print "selected"; ?>><?php print $CustomTitle42; ?></option><?php } ?>
                <?php if ($CustomTitle43!="") { ?><option value="<?php print $Custom43Field; ?>" <?php if ($filfield1==$Custom43Field) print "selected"; ?>><?php print $CustomTitle43; ?></option><?php } ?>
                <?php if ($CustomTitle44!="") { ?><option value="<?php print $Custom44Field; ?>" <?php if ($filfield1==$Custom44Field) print "selected"; ?>><?php print $CustomTitle44; ?></option><?php } ?>
                <?php if ($CustomTitle45!="") { ?><option value="<?php print $Custom45Field; ?>" <?php if ($filfield1==$Custom45Field) print "selected"; ?>><?php print $CustomTitle45; ?></option><?php } ?>
                <?php if ($CustomTitle46!="") { ?><option value="<?php print $Custom46Field; ?>" <?php if ($filfield1==$Custom46Field) print "selected"; ?>><?php print $CustomTitle46; ?></option><?php } ?>
                <?php if ($CustomTitle47!="") { ?><option value="<?php print $Custom47Field; ?>" <?php if ($filfield1==$Custom47Field) print "selected"; ?>><?php print $CustomTitle47; ?></option><?php } ?>
                <?php if ($CustomTitle48!="") { ?><option value="<?php print $Custom48Field; ?>" <?php if ($filfield1==$Custom48Field) print "selected"; ?>><?php print $CustomTitle48; ?></option><?php } ?>
                <?php if ($CustomTitle49!="") { ?><option value="<?php print $Custom49Field; ?>" <?php if ($filfield1==$Custom49Field) print "selected"; ?>><?php print $CustomTitle49; ?></option><?php } ?>
                <?php if ($CustomTitle50!="") { ?><option value="<?php print $Custom50Field; ?>" <?php if ($filfield1==$Custom50Field) print "selected"; ?>><?php print $CustomTitle50; ?></option><?php } ?>                
                </select>
        </td>
        <td>
            <select class="filter" name="filcond1" size="1" onKeyPress="return submitenter(event,Filter)">
                    <option value="equals" <?php if ($filcond1=="equals") print "selected"; ?>>equals</option>
                    <option value="notequal" <?php if ($filcond1=="notequal") print "selected"; ?>>not equal to</option>
                    <option value="contains" <?php if (($filcond1=="contains") || ($filcond1=="")) print "selected"; ?>>contains</option>
                    <option value="notcontain" <?php if ($filcond1=="notcontain") print "selected"; ?>>does not contain</option>
                    <option value="less" <?php if ($filcond1=="less") print "selected"; ?>>less than</option>
                    <option value="greater" <?php if ($filcond1=="greater") print "selected"; ?>>greater than</option>
                    <option value="starts" <?php if ($filcond1=="starts") print "selected"; ?>>starts with</option>
                    <option value="ends" <?php if ($filcond1=="ends") print "selected"; ?>>ends with</option>
                    <option value="lessnum" <?php if ($filcond1=="lessnum") print "selected"; ?>>less than num</option>
                    <option value="greaternum" <?php if ($filcond1=="greaternum") print "selected"; ?>>greater than num</option>
                    </select>
        </td>
        <td> 
            <input class="filter  inputtextfilter" type="text" name="fildata1" value="<?php print $fildata1; ?>" maxlength="100" size="30" onKeyPress="return submitenter(event,Filter)">
        </td>
        <td>&nbsp</td>
    </tr>
    <tr id="afilrow2" style="display: none;">
        <td>
	             <select class="filter" name="filbool1" size="1"  onKeyPress="return submitenter(event,Filter)">
	              <option value="AND" <?php if ($filbool1=="AND") print "selected"; ?>>AND</option>
	              <option value="OR" <?php if ($filbool1=="OR") print "selected"; ?>>OR</option>
	              </select>
        </td>
        <td>
            <select class="filter" name="filfield2" size="1" onKeyPress="return submitenter(event,Filter)">
        				<option value="" <?php if ($filfield2=="") print "selected"; ?>>Select field</option>
                <option value="<?php print $UsernameField; ?>" <?php if ($filfield2==$UsernameField) print "selected"; ?>>Username</option>
                <option value="<?php print $PasswordField; ?>" <?php if ($filfield2==$PasswordField) print "selected"; ?>>Password</option>
                <option value="<?php print $EnabledField; ?>" <?php if ($filfield2==$EnabledField) print "selected"; ?>>Enabled</option>
                <option value="<?php print $NameField; ?>" <?php if ($filfield2==$NameField) print "selected"; ?>>Name</option>
                <option value="<?php print $EmailField; ?>" <?php if ($filfield2==$EmailField) print "selected"; ?>>Email</option>
                <option value="<?php print $UsergroupsField; ?>" <?php if ($filfield2==$UsergroupsField) print "selected"; ?>>Usergroups</option>
                <option value="groupexpiry" <?php if ($filfield2=="groupexpiry") print "selected"; ?>>Usergroups expiry</option>
                <option value="<?php print $CreatedField; ?>" <?php if ($filfield2==$CreatedField) print "selected"; ?>>Created</option>
                <?php if ($CustomTitle1!="") { ?><option value="<?php print $Custom1Field; ?>" <?php if ($filfield2==$Custom1Field) print "selected"; ?>><?php print $CustomTitle1; ?></option><?php } ?>
                <?php if ($CustomTitle2!="") { ?><option value="<?php print $Custom2Field; ?>" <?php if ($filfield2==$Custom2Field) print "selected"; ?>><?php print $CustomTitle2; ?></option><?php } ?>
                <?php if ($CustomTitle3!="") { ?><option value="<?php print $Custom3Field; ?>" <?php if ($filfield2==$Custom3Field) print "selected"; ?>><?php print $CustomTitle3; ?></option><?php } ?>
                <?php if ($CustomTitle4!="") { ?><option value="<?php print $Custom4Field; ?>" <?php if ($filfield2==$Custom4Field) print "selected"; ?>><?php print $CustomTitle4; ?></option><?php } ?>
                <?php if ($CustomTitle5!="") { ?><option value="<?php print $Custom5Field; ?>" <?php if ($filfield2==$Custom5Field) print "selected"; ?>><?php print $CustomTitle5; ?></option><?php } ?>
                <?php if ($CustomTitle6!="") { ?><option value="<?php print $Custom6Field; ?>" <?php if ($filfield2==$Custom6Field) print "selected"; ?>><?php print $CustomTitle6; ?></option><?php } ?>
                <?php if ($CustomTitle7!="") { ?><option value="<?php print $Custom7Field; ?>" <?php if ($filfield2==$Custom7Field) print "selected"; ?>><?php print $CustomTitle7; ?></option><?php } ?>
                <?php if ($CustomTitle8!="") { ?><option value="<?php print $Custom8Field; ?>" <?php if ($filfield2==$Custom8Field) print "selected"; ?>><?php print $CustomTitle8; ?></option><?php } ?>
                <?php if ($CustomTitle9!="") { ?><option value="<?php print $Custom9Field; ?>" <?php if ($filfield2==$Custom9Field) print "selected"; ?>><?php print $CustomTitle9; ?></option><?php } ?>
                <?php if ($CustomTitle10!="") { ?><option value="<?php print $Custom10Field; ?>" <?php if ($filfield2==$Custom10Field) print "selected"; ?>><?php print $CustomTitle10; ?></option><?php } ?>
                <?php if ($CustomTitle11!="") { ?><option value="<?php print $Custom11Field; ?>" <?php if ($filfield2==$Custom11Field) print "selected"; ?>><?php print $CustomTitle11; ?></option><?php } ?>
                <?php if ($CustomTitle12!="") { ?><option value="<?php print $Custom12Field; ?>" <?php if ($filfield2==$Custom12Field) print "selected"; ?>><?php print $CustomTitle12; ?></option><?php } ?>
                <?php if ($CustomTitle13!="") { ?><option value="<?php print $Custom13Field; ?>" <?php if ($filfield2==$Custom13Field) print "selected"; ?>><?php print $CustomTitle13; ?></option><?php } ?>
                <?php if ($CustomTitle14!="") { ?><option value="<?php print $Custom14Field; ?>" <?php if ($filfield2==$Custom14Field) print "selected"; ?>><?php print $CustomTitle14; ?></option><?php } ?>
                <?php if ($CustomTitle15!="") { ?><option value="<?php print $Custom15Field; ?>" <?php if ($filfield2==$Custom15Field) print "selected"; ?>><?php print $CustomTitle15; ?></option><?php } ?>
                <?php if ($CustomTitle16!="") { ?><option value="<?php print $Custom16Field; ?>" <?php if ($filfield2==$Custom16Field) print "selected"; ?>><?php print $CustomTitle16; ?></option><?php } ?>
                <?php if ($CustomTitle17!="") { ?><option value="<?php print $Custom17Field; ?>" <?php if ($filfield2==$Custom17Field) print "selected"; ?>><?php print $CustomTitle17; ?></option><?php } ?>
                <?php if ($CustomTitle18!="") { ?><option value="<?php print $Custom18Field; ?>" <?php if ($filfield2==$Custom18Field) print "selected"; ?>><?php print $CustomTitle18; ?></option><?php } ?>
                <?php if ($CustomTitle19!="") { ?><option value="<?php print $Custom19Field; ?>" <?php if ($filfield2==$Custom19Field) print "selected"; ?>><?php print $CustomTitle19; ?></option><?php } ?>
                <?php if ($CustomTitle20!="") { ?><option value="<?php print $Custom20Field; ?>" <?php if ($filfield2==$Custom20Field) print "selected"; ?>><?php print $CustomTitle20; ?></option><?php } ?>
                <?php if ($CustomTitle21!="") { ?><option value="<?php print $Custom21Field; ?>" <?php if ($filfield2==$Custom21Field) print "selected"; ?>><?php print $CustomTitle21; ?></option><?php } ?>
                <?php if ($CustomTitle22!="") { ?><option value="<?php print $Custom22Field; ?>" <?php if ($filfield2==$Custom22Field) print "selected"; ?>><?php print $CustomTitle22; ?></option><?php } ?>
                <?php if ($CustomTitle23!="") { ?><option value="<?php print $Custom23Field; ?>" <?php if ($filfield2==$Custom23Field) print "selected"; ?>><?php print $CustomTitle23; ?></option><?php } ?>
                <?php if ($CustomTitle24!="") { ?><option value="<?php print $Custom24Field; ?>" <?php if ($filfield2==$Custom24Field) print "selected"; ?>><?php print $CustomTitle24; ?></option><?php } ?>
                <?php if ($CustomTitle25!="") { ?><option value="<?php print $Custom25Field; ?>" <?php if ($filfield2==$Custom25Field) print "selected"; ?>><?php print $CustomTitle25; ?></option><?php } ?>
                <?php if ($CustomTitle26!="") { ?><option value="<?php print $Custom26Field; ?>" <?php if ($filfield2==$Custom26Field) print "selected"; ?>><?php print $CustomTitle26; ?></option><?php } ?>
                <?php if ($CustomTitle27!="") { ?><option value="<?php print $Custom27Field; ?>" <?php if ($filfield2==$Custom27Field) print "selected"; ?>><?php print $CustomTitle27; ?></option><?php } ?>
                <?php if ($CustomTitle28!="") { ?><option value="<?php print $Custom28Field; ?>" <?php if ($filfield2==$Custom28Field) print "selected"; ?>><?php print $CustomTitle28; ?></option><?php } ?>
                <?php if ($CustomTitle29!="") { ?><option value="<?php print $Custom29Field; ?>" <?php if ($filfield2==$Custom29Field) print "selected"; ?>><?php print $CustomTitle29; ?></option><?php } ?>
                <?php if ($CustomTitle30!="") { ?><option value="<?php print $Custom30Field; ?>" <?php if ($filfield2==$Custom30Field) print "selected"; ?>><?php print $CustomTitle30; ?></option><?php } ?>
                <?php if ($CustomTitle31!="") { ?><option value="<?php print $Custom31Field; ?>" <?php if ($filfield2==$Custom31Field) print "selected"; ?>><?php print $CustomTitle31; ?></option><?php } ?>
                <?php if ($CustomTitle32!="") { ?><option value="<?php print $Custom32Field; ?>" <?php if ($filfield2==$Custom32Field) print "selected"; ?>><?php print $CustomTitle32; ?></option><?php } ?>
                <?php if ($CustomTitle33!="") { ?><option value="<?php print $Custom33Field; ?>" <?php if ($filfield2==$Custom33Field) print "selected"; ?>><?php print $CustomTitle33; ?></option><?php } ?>
                <?php if ($CustomTitle34!="") { ?><option value="<?php print $Custom34Field; ?>" <?php if ($filfield2==$Custom34Field) print "selected"; ?>><?php print $CustomTitle34; ?></option><?php } ?>
                <?php if ($CustomTitle35!="") { ?><option value="<?php print $Custom35Field; ?>" <?php if ($filfield2==$Custom35Field) print "selected"; ?>><?php print $CustomTitle35; ?></option><?php } ?>
                <?php if ($CustomTitle36!="") { ?><option value="<?php print $Custom36Field; ?>" <?php if ($filfield2==$Custom36Field) print "selected"; ?>><?php print $CustomTitle36; ?></option><?php } ?>
                <?php if ($CustomTitle37!="") { ?><option value="<?php print $Custom37Field; ?>" <?php if ($filfield2==$Custom37Field) print "selected"; ?>><?php print $CustomTitle37; ?></option><?php } ?>
                <?php if ($CustomTitle38!="") { ?><option value="<?php print $Custom38Field; ?>" <?php if ($filfield2==$Custom38Field) print "selected"; ?>><?php print $CustomTitle38; ?></option><?php } ?>
                <?php if ($CustomTitle39!="") { ?><option value="<?php print $Custom39Field; ?>" <?php if ($filfield2==$Custom39Field) print "selected"; ?>><?php print $CustomTitle39; ?></option><?php } ?>
                <?php if ($CustomTitle40!="") { ?><option value="<?php print $Custom40Field; ?>" <?php if ($filfield2==$Custom40Field) print "selected"; ?>><?php print $CustomTitle40; ?></option><?php } ?>
                <?php if ($CustomTitle41!="") { ?><option value="<?php print $Custom41Field; ?>" <?php if ($filfield2==$Custom41Field) print "selected"; ?>><?php print $CustomTitle41; ?></option><?php } ?>
                <?php if ($CustomTitle42!="") { ?><option value="<?php print $Custom42Field; ?>" <?php if ($filfield2==$Custom42Field) print "selected"; ?>><?php print $CustomTitle42; ?></option><?php } ?>
                <?php if ($CustomTitle43!="") { ?><option value="<?php print $Custom43Field; ?>" <?php if ($filfield2==$Custom43Field) print "selected"; ?>><?php print $CustomTitle43; ?></option><?php } ?>
                <?php if ($CustomTitle44!="") { ?><option value="<?php print $Custom44Field; ?>" <?php if ($filfield2==$Custom44Field) print "selected"; ?>><?php print $CustomTitle44; ?></option><?php } ?>
                <?php if ($CustomTitle45!="") { ?><option value="<?php print $Custom45Field; ?>" <?php if ($filfield2==$Custom45Field) print "selected"; ?>><?php print $CustomTitle45; ?></option><?php } ?>
                <?php if ($CustomTitle46!="") { ?><option value="<?php print $Custom46Field; ?>" <?php if ($filfield2==$Custom46Field) print "selected"; ?>><?php print $CustomTitle46; ?></option><?php } ?>
                <?php if ($CustomTitle47!="") { ?><option value="<?php print $Custom47Field; ?>" <?php if ($filfield2==$Custom47Field) print "selected"; ?>><?php print $CustomTitle47; ?></option><?php } ?>
                <?php if ($CustomTitle48!="") { ?><option value="<?php print $Custom48Field; ?>" <?php if ($filfield2==$Custom48Field) print "selected"; ?>><?php print $CustomTitle48; ?></option><?php } ?>
                <?php if ($CustomTitle49!="") { ?><option value="<?php print $Custom49Field; ?>" <?php if ($filfield2==$Custom49Field) print "selected"; ?>><?php print $CustomTitle49; ?></option><?php } ?>
                <?php if ($CustomTitle50!="") { ?><option value="<?php print $Custom50Field; ?>" <?php if ($filfield2==$Custom50Field) print "selected"; ?>><?php print $CustomTitle50; ?></option><?php } ?>                                
                </select>
        </td>
        <td>
            <select class="filter" name="filcond2" size="1" onKeyPress="return submitenter(event,Filter)">
                    <option value="equals" <?php if ($filcond2=="equals") print "selected"; ?>>equals</option>
                    <option value="notequal" <?php if ($filcond2=="notequal") print "selected"; ?>>not equal to</option>
                    <option value="contains" <?php if (($filcond2=="contains") || ($filcond2=="")) print "selected"; ?>>contains</option>
                    <option value="notcontain" <?php if ($filcond2=="notcontain") print "selected"; ?>>does not contain</option>
                    <option value="less" <?php if ($filcond2=="less") print "selected"; ?>>less than</option>
                    <option value="greater" <?php if ($filcond2=="greater") print "selected"; ?>>greater than</option>
                    <option value="starts" <?php if ($filcond2=="starts") print "selected"; ?>>starts with</option>
                    <option value="ends" <?php if ($filcond2=="ends") print "selected"; ?>>ends with</option>
                    <option value="lessnum" <?php if ($filcond2=="lessnum") print "selected"; ?>>less than num</option>
                    <option value="greaternum" <?php if ($filcond2=="greaternum") print "selected"; ?>>greater than num</option>
                    </select>
        </td>
        <td>
            <input class="filter inputtextfilter" type="text" name="fildata2" value="<?php print $fildata2; ?>" maxlength="100" size="30" onKeyPress="return submitenter(event,Filter)">
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr id="afilrow3" style="display: none;">
        <td>
                <select class="filter" name="filbool2" size="1" onKeyPress="return submitenter(event,Filter)">
	              <option value="AND" <?php if ($filbool2=="AND") print "selected"; ?>>AND</option>
	              <option value="OR" <?php if ($filbool2=="OR") print "selected"; ?>>OR</option>
                </select>
        </td>
        <td>
                <select class="filter" name="filfield3" size="1" onKeyPress="return submitenter(event,Filter)">
                <option selected value="">Select field</option>
                <option value="<?php print $UsernameField; ?>" <?php if ($filfield3==$UsernameField) print "selected"; ?>>Username</option>
                <option value="<?php print $PasswordField; ?>" <?php if ($filfield3==$PasswordField) print "selected"; ?>>Password</option>
                <option value="<?php print $EnabledField; ?>" <?php if ($filfield3==$EnabledField) print "selected"; ?>>Enabled</option>
                <option value="<?php print $NameField; ?>" <?php if ($filfield3==$NameField) print "selected"; ?>>Name</option>
                <option value="<?php print $EmailField; ?>" <?php if ($filfield3==$EmailField) print "selected"; ?>>Email</option>
                <option value="<?php print $UsergroupsField; ?>" <?php if ($filfield3==$UsergroupsField) print "selected"; ?>>Usergroups</option>
                <option value="groupexpiry" <?php if ($filfield3=="groupexpiry") print "selected"; ?>>Usergroups expiry</option>
                <option value="<?php print $CreatedField; ?>" <?php if ($filfield3==$CreatedField) print "selected"; ?>>Created</option>
                <?php if ($CustomTitle1!="") { ?><option value="<?php print $Custom1Field; ?>" <?php if ($filfield3==$Custom1Field) print "selected"; ?>><?php print $CustomTitle1; ?></option><?php } ?>
                <?php if ($CustomTitle2!="") { ?><option value="<?php print $Custom2Field; ?>" <?php if ($filfield3==$Custom2Field) print "selected"; ?>><?php print $CustomTitle2; ?></option><?php } ?>
                <?php if ($CustomTitle3!="") { ?><option value="<?php print $Custom3Field; ?>" <?php if ($filfield3==$Custom3Field) print "selected"; ?>><?php print $CustomTitle3; ?></option><?php } ?>
                <?php if ($CustomTitle4!="") { ?><option value="<?php print $Custom4Field; ?>" <?php if ($filfield3==$Custom4Field) print "selected"; ?>><?php print $CustomTitle4; ?></option><?php } ?>
                <?php if ($CustomTitle5!="") { ?><option value="<?php print $Custom5Field; ?>" <?php if ($filfield3==$Custom5Field) print "selected"; ?>><?php print $CustomTitle5; ?></option><?php } ?>
                <?php if ($CustomTitle6!="") { ?><option value="<?php print $Custom6Field; ?>" <?php if ($filfield3==$Custom6Field) print "selected"; ?>><?php print $CustomTitle6; ?></option><?php } ?>
                <?php if ($CustomTitle7!="") { ?><option value="<?php print $Custom7Field; ?>" <?php if ($filfield3==$Custom7Field) print "selected"; ?>><?php print $CustomTitle7; ?></option><?php } ?>
                <?php if ($CustomTitle8!="") { ?><option value="<?php print $Custom8Field; ?>" <?php if ($filfield3==$Custom8Field) print "selected"; ?>><?php print $CustomTitle8; ?></option><?php } ?>
                <?php if ($CustomTitle9!="") { ?><option value="<?php print $Custom9Field; ?>" <?php if ($filfield3==$Custom9Field) print "selected"; ?>><?php print $CustomTitle9; ?></option><?php } ?>
                <?php if ($CustomTitle10!="") { ?><option value="<?php print $Custom10Field; ?>" <?php if ($filfield3==$Custom10Field) print "selected"; ?>><?php print $CustomTitle10; ?></option><?php } ?>
                <?php if ($CustomTitle11!="") { ?><option value="<?php print $Custom11Field; ?>" <?php if ($filfield3==$Custom11Field) print "selected"; ?>><?php print $CustomTitle11; ?></option><?php } ?>
                <?php if ($CustomTitle12!="") { ?><option value="<?php print $Custom12Field; ?>" <?php if ($filfield3==$Custom12Field) print "selected"; ?>><?php print $CustomTitle12; ?></option><?php } ?>
                <?php if ($CustomTitle13!="") { ?><option value="<?php print $Custom13Field; ?>" <?php if ($filfield3==$Custom13Field) print "selected"; ?>><?php print $CustomTitle13; ?></option><?php } ?>
                <?php if ($CustomTitle14!="") { ?><option value="<?php print $Custom14Field; ?>" <?php if ($filfield3==$Custom14Field) print "selected"; ?>><?php print $CustomTitle14; ?></option><?php } ?>
                <?php if ($CustomTitle15!="") { ?><option value="<?php print $Custom15Field; ?>" <?php if ($filfield3==$Custom15Field) print "selected"; ?>><?php print $CustomTitle15; ?></option><?php } ?>
                <?php if ($CustomTitle16!="") { ?><option value="<?php print $Custom16Field; ?>" <?php if ($filfield3==$Custom16Field) print "selected"; ?>><?php print $CustomTitle16; ?></option><?php } ?>
                <?php if ($CustomTitle17!="") { ?><option value="<?php print $Custom17Field; ?>" <?php if ($filfield3==$Custom17Field) print "selected"; ?>><?php print $CustomTitle17; ?></option><?php } ?>
                <?php if ($CustomTitle18!="") { ?><option value="<?php print $Custom18Field; ?>" <?php if ($filfield3==$Custom18Field) print "selected"; ?>><?php print $CustomTitle18; ?></option><?php } ?>
                <?php if ($CustomTitle19!="") { ?><option value="<?php print $Custom19Field; ?>" <?php if ($filfield3==$Custom19Field) print "selected"; ?>><?php print $CustomTitle19; ?></option><?php } ?>
                <?php if ($CustomTitle20!="") { ?><option value="<?php print $Custom20Field; ?>" <?php if ($filfield3==$Custom20Field) print "selected"; ?>><?php print $CustomTitle20; ?></option><?php } ?>
                <?php if ($CustomTitle21!="") { ?><option value="<?php print $Custom21Field; ?>" <?php if ($filfield3==$Custom21Field) print "selected"; ?>><?php print $CustomTitle21; ?></option><?php } ?>
                <?php if ($CustomTitle22!="") { ?><option value="<?php print $Custom22Field; ?>" <?php if ($filfield3==$Custom22Field) print "selected"; ?>><?php print $CustomTitle22; ?></option><?php } ?>
                <?php if ($CustomTitle23!="") { ?><option value="<?php print $Custom23Field; ?>" <?php if ($filfield3==$Custom23Field) print "selected"; ?>><?php print $CustomTitle23; ?></option><?php } ?>
                <?php if ($CustomTitle24!="") { ?><option value="<?php print $Custom24Field; ?>" <?php if ($filfield3==$Custom24Field) print "selected"; ?>><?php print $CustomTitle24; ?></option><?php } ?>
                <?php if ($CustomTitle25!="") { ?><option value="<?php print $Custom25Field; ?>" <?php if ($filfield3==$Custom25Field) print "selected"; ?>><?php print $CustomTitle25; ?></option><?php } ?>
                <?php if ($CustomTitle26!="") { ?><option value="<?php print $Custom26Field; ?>" <?php if ($filfield3==$Custom26Field) print "selected"; ?>><?php print $CustomTitle26; ?></option><?php } ?>
                <?php if ($CustomTitle27!="") { ?><option value="<?php print $Custom27Field; ?>" <?php if ($filfield3==$Custom27Field) print "selected"; ?>><?php print $CustomTitle27; ?></option><?php } ?>
                <?php if ($CustomTitle28!="") { ?><option value="<?php print $Custom28Field; ?>" <?php if ($filfield3==$Custom28Field) print "selected"; ?>><?php print $CustomTitle28; ?></option><?php } ?>
                <?php if ($CustomTitle29!="") { ?><option value="<?php print $Custom29Field; ?>" <?php if ($filfield3==$Custom29Field) print "selected"; ?>><?php print $CustomTitle29; ?></option><?php } ?>
                <?php if ($CustomTitle30!="") { ?><option value="<?php print $Custom30Field; ?>" <?php if ($filfield3==$Custom30Field) print "selected"; ?>><?php print $CustomTitle30; ?></option><?php } ?>
                <?php if ($CustomTitle31!="") { ?><option value="<?php print $Custom31Field; ?>" <?php if ($filfield3==$Custom31Field) print "selected"; ?>><?php print $CustomTitle31; ?></option><?php } ?>
                <?php if ($CustomTitle32!="") { ?><option value="<?php print $Custom32Field; ?>" <?php if ($filfield3==$Custom32Field) print "selected"; ?>><?php print $CustomTitle32; ?></option><?php } ?>
                <?php if ($CustomTitle33!="") { ?><option value="<?php print $Custom33Field; ?>" <?php if ($filfield3==$Custom33Field) print "selected"; ?>><?php print $CustomTitle33; ?></option><?php } ?>
                <?php if ($CustomTitle34!="") { ?><option value="<?php print $Custom34Field; ?>" <?php if ($filfield3==$Custom34Field) print "selected"; ?>><?php print $CustomTitle34; ?></option><?php } ?>
                <?php if ($CustomTitle35!="") { ?><option value="<?php print $Custom35Field; ?>" <?php if ($filfield3==$Custom35Field) print "selected"; ?>><?php print $CustomTitle35; ?></option><?php } ?>
                <?php if ($CustomTitle36!="") { ?><option value="<?php print $Custom36Field; ?>" <?php if ($filfield3==$Custom36Field) print "selected"; ?>><?php print $CustomTitle36; ?></option><?php } ?>
                <?php if ($CustomTitle37!="") { ?><option value="<?php print $Custom37Field; ?>" <?php if ($filfield3==$Custom37Field) print "selected"; ?>><?php print $CustomTitle37; ?></option><?php } ?>
                <?php if ($CustomTitle38!="") { ?><option value="<?php print $Custom38Field; ?>" <?php if ($filfield3==$Custom38Field) print "selected"; ?>><?php print $CustomTitle38; ?></option><?php } ?>
                <?php if ($CustomTitle39!="") { ?><option value="<?php print $Custom39Field; ?>" <?php if ($filfield3==$Custom39Field) print "selected"; ?>><?php print $CustomTitle39; ?></option><?php } ?>
                <?php if ($CustomTitle40!="") { ?><option value="<?php print $Custom40Field; ?>" <?php if ($filfield3==$Custom40Field) print "selected"; ?>><?php print $CustomTitle40; ?></option><?php } ?>
                <?php if ($CustomTitle41!="") { ?><option value="<?php print $Custom41Field; ?>" <?php if ($filfield3==$Custom41Field) print "selected"; ?>><?php print $CustomTitle41; ?></option><?php } ?>
                <?php if ($CustomTitle42!="") { ?><option value="<?php print $Custom42Field; ?>" <?php if ($filfield3==$Custom42Field) print "selected"; ?>><?php print $CustomTitle42; ?></option><?php } ?>
                <?php if ($CustomTitle43!="") { ?><option value="<?php print $Custom43Field; ?>" <?php if ($filfield3==$Custom43Field) print "selected"; ?>><?php print $CustomTitle43; ?></option><?php } ?>
                <?php if ($CustomTitle44!="") { ?><option value="<?php print $Custom44Field; ?>" <?php if ($filfield3==$Custom44Field) print "selected"; ?>><?php print $CustomTitle44; ?></option><?php } ?>
                <?php if ($CustomTitle45!="") { ?><option value="<?php print $Custom45Field; ?>" <?php if ($filfield3==$Custom45Field) print "selected"; ?>><?php print $CustomTitle45; ?></option><?php } ?>
                <?php if ($CustomTitle46!="") { ?><option value="<?php print $Custom46Field; ?>" <?php if ($filfield3==$Custom46Field) print "selected"; ?>><?php print $CustomTitle46; ?></option><?php } ?>
                <?php if ($CustomTitle47!="") { ?><option value="<?php print $Custom47Field; ?>" <?php if ($filfield3==$Custom47Field) print "selected"; ?>><?php print $CustomTitle47; ?></option><?php } ?>
                <?php if ($CustomTitle48!="") { ?><option value="<?php print $Custom48Field; ?>" <?php if ($filfield3==$Custom48Field) print "selected"; ?>><?php print $CustomTitle48; ?></option><?php } ?>
                <?php if ($CustomTitle49!="") { ?><option value="<?php print $Custom49Field; ?>" <?php if ($filfield3==$Custom49Field) print "selected"; ?>><?php print $CustomTitle49; ?></option><?php } ?>
                <?php if ($CustomTitle50!="") { ?><option value="<?php print $Custom50Field; ?>" <?php if ($filfield3==$Custom50Field) print "selected"; ?>><?php print $CustomTitle50; ?></option><?php } ?>                
                </select>
        </td>
        <td>
            <select class="filter" name="filcond3" size="1" onKeyPress="return submitenter(event,Filter)">
                    <option value="equals" <?php if ($filcond3=="equals") print "selected"; ?>>equals</option>
                    <option value="notequal" <?php if ($filcond3=="notequal") print "selected"; ?>>not equal to</option>
                    <option value="contains" <?php if (($filcond3=="contains") || ($filcond3=="")) print "selected"; ?>>contains</option>
                    <option value="notcontain" <?php if ($filcond3=="notcontain") print "selected"; ?>>does not contain</option>
                    <option value="less" <?php if ($filcond3=="less") print "selected"; ?>>less than</option>
                    <option value="greater" <?php if ($filcond3=="greater") print "selected"; ?>>greater than</option>
                    <option value="starts" <?php if ($filcond3=="starts") print "selected"; ?>>starts with</option>
                    <option value="ends" <?php if ($filcond3=="ends") print "selected"; ?>>ends with</option>
                    <option value="lessnum" <?php if ($filcond3=="lessnum") print "selected"; ?>>less than num</option>
                    <option value="greaternum" <?php if ($filcond3=="greaternum") print "selected"; ?>>greater than num</option>
                    </select>
        </td>
        <td>
            <input class="filter inputtextfilter" type="text" name="fildata3" value="<?php print $fildata3; ?>" maxlength="100" size="30" onKeyPress="return submitenter(event,Filter)">
        </td>
      </tr>
    <tr id="afilrow4" style="display: none;">
      
        <td>
                <select class="filter" name="filbool3" size="1" onKeyPress="return submitenter(event,Filter)">
	              <option value="AND" <?php if ($filbool3=="AND") print "selected"; ?>>AND</option>
	              <option value="OR" <?php if ($filbool3=="OR") print "selected"; ?>>OR</option>
                </select>
        </td>
        <td>
                <select class="filter" name="filfield4" size="1" onKeyPress="return submitenter(event,Filter)">
                <option selected value="">Select field</option>
                <option value="<?php print $UsernameField; ?>" <?php if ($filfield4==$UsernameField) print "selected"; ?>>Username</option>
                <option value="<?php print $PasswordField; ?>" <?php if ($filfield4==$PasswordField) print "selected"; ?>>Password</option>
                <option value="<?php print $EnabledField; ?>" <?php if ($filfield4==$EnabledField) print "selected"; ?>>Enabled</option>
                <option value="<?php print $NameField; ?>" <?php if ($filfield4==$NameField) print "selected"; ?>>Name</option>
                <option value="<?php print $EmailField; ?>" <?php if ($filfield4==$EmailField) print "selected"; ?>>Email</option>
                <option value="<?php print $UsergroupsField; ?>" <?php if ($filfield4==$UsergroupsField) print "selected"; ?>>Usergroups</option>
                <option value="groupexpiry" <?php if ($filfield4=="groupexpiry") print "selected"; ?>>Usergroups expiry</option>
                <option value="<?php print $CreatedField; ?>" <?php if ($filfield4==$CreatedField) print "selected"; ?>>Created</option>
                <?php if ($CustomTitle1!="") { ?><option value="<?php print $Custom1Field; ?>" <?php if ($filfield4==$Custom1Field) print "selected"; ?>><?php print $CustomTitle1; ?></option><?php } ?>
                <?php if ($CustomTitle2!="") { ?><option value="<?php print $Custom2Field; ?>" <?php if ($filfield4==$Custom2Field) print "selected"; ?>><?php print $CustomTitle2; ?></option><?php } ?>
                <?php if ($CustomTitle3!="") { ?><option value="<?php print $Custom3Field; ?>" <?php if ($filfield4==$Custom3Field) print "selected"; ?>><?php print $CustomTitle3; ?></option><?php } ?>
                <?php if ($CustomTitle4!="") { ?><option value="<?php print $Custom4Field; ?>" <?php if ($filfield4==$Custom4Field) print "selected"; ?>><?php print $CustomTitle4; ?></option><?php } ?>
                <?php if ($CustomTitle5!="") { ?><option value="<?php print $Custom5Field; ?>" <?php if ($filfield4==$Custom5Field) print "selected"; ?>><?php print $CustomTitle5; ?></option><?php } ?>
                <?php if ($CustomTitle6!="") { ?><option value="<?php print $Custom6Field; ?>" <?php if ($filfield4==$Custom6Field) print "selected"; ?>><?php print $CustomTitle6; ?></option><?php } ?>
                <?php if ($CustomTitle7!="") { ?><option value="<?php print $Custom7Field; ?>" <?php if ($filfield4==$Custom7Field) print "selected"; ?>><?php print $CustomTitle7; ?></option><?php } ?>
                <?php if ($CustomTitle8!="") { ?><option value="<?php print $Custom8Field; ?>" <?php if ($filfield4==$Custom8Field) print "selected"; ?>><?php print $CustomTitle8; ?></option><?php } ?>
                <?php if ($CustomTitle9!="") { ?><option value="<?php print $Custom9Field; ?>" <?php if ($filfield4==$Custom9Field) print "selected"; ?>><?php print $CustomTitle9; ?></option><?php } ?>
                <?php if ($CustomTitle10!="") { ?><option value="<?php print $Custom10Field; ?>" <?php if ($filfield4==$Custom10Field) print "selected"; ?>><?php print $CustomTitle10; ?></option><?php } ?>
                <?php if ($CustomTitle11!="") { ?><option value="<?php print $Custom11Field; ?>" <?php if ($filfield4==$Custom11Field) print "selected"; ?>><?php print $CustomTitle11; ?></option><?php } ?>
                <?php if ($CustomTitle12!="") { ?><option value="<?php print $Custom12Field; ?>" <?php if ($filfield4==$Custom12Field) print "selected"; ?>><?php print $CustomTitle12; ?></option><?php } ?>
                <?php if ($CustomTitle13!="") { ?><option value="<?php print $Custom13Field; ?>" <?php if ($filfield4==$Custom13Field) print "selected"; ?>><?php print $CustomTitle13; ?></option><?php } ?>
                <?php if ($CustomTitle14!="") { ?><option value="<?php print $Custom14Field; ?>" <?php if ($filfield4==$Custom14Field) print "selected"; ?>><?php print $CustomTitle14; ?></option><?php } ?>
                <?php if ($CustomTitle15!="") { ?><option value="<?php print $Custom15Field; ?>" <?php if ($filfield4==$Custom15Field) print "selected"; ?>><?php print $CustomTitle15; ?></option><?php } ?>
                <?php if ($CustomTitle16!="") { ?><option value="<?php print $Custom16Field; ?>" <?php if ($filfield4==$Custom16Field) print "selected"; ?>><?php print $CustomTitle16; ?></option><?php } ?>
                <?php if ($CustomTitle17!="") { ?><option value="<?php print $Custom17Field; ?>" <?php if ($filfield4==$Custom17Field) print "selected"; ?>><?php print $CustomTitle17; ?></option><?php } ?>
                <?php if ($CustomTitle18!="") { ?><option value="<?php print $Custom18Field; ?>" <?php if ($filfield4==$Custom18Field) print "selected"; ?>><?php print $CustomTitle18; ?></option><?php } ?>
                <?php if ($CustomTitle19!="") { ?><option value="<?php print $Custom19Field; ?>" <?php if ($filfield4==$Custom19Field) print "selected"; ?>><?php print $CustomTitle19; ?></option><?php } ?>
                <?php if ($CustomTitle20!="") { ?><option value="<?php print $Custom20Field; ?>" <?php if ($filfield4==$Custom20Field) print "selected"; ?>><?php print $CustomTitle20; ?></option><?php } ?>
                <?php if ($CustomTitle21!="") { ?><option value="<?php print $Custom21Field; ?>" <?php if ($filfield4==$Custom21Field) print "selected"; ?>><?php print $CustomTitle21; ?></option><?php } ?>
                <?php if ($CustomTitle22!="") { ?><option value="<?php print $Custom22Field; ?>" <?php if ($filfield4==$Custom22Field) print "selected"; ?>><?php print $CustomTitle22; ?></option><?php } ?>
                <?php if ($CustomTitle23!="") { ?><option value="<?php print $Custom23Field; ?>" <?php if ($filfield4==$Custom23Field) print "selected"; ?>><?php print $CustomTitle23; ?></option><?php } ?>
                <?php if ($CustomTitle24!="") { ?><option value="<?php print $Custom24Field; ?>" <?php if ($filfield4==$Custom24Field) print "selected"; ?>><?php print $CustomTitle24; ?></option><?php } ?>
                <?php if ($CustomTitle25!="") { ?><option value="<?php print $Custom25Field; ?>" <?php if ($filfield4==$Custom25Field) print "selected"; ?>><?php print $CustomTitle25; ?></option><?php } ?>
                <?php if ($CustomTitle26!="") { ?><option value="<?php print $Custom26Field; ?>" <?php if ($filfield4==$Custom26Field) print "selected"; ?>><?php print $CustomTitle26; ?></option><?php } ?>
                <?php if ($CustomTitle27!="") { ?><option value="<?php print $Custom27Field; ?>" <?php if ($filfield4==$Custom27Field) print "selected"; ?>><?php print $CustomTitle27; ?></option><?php } ?>
                <?php if ($CustomTitle28!="") { ?><option value="<?php print $Custom28Field; ?>" <?php if ($filfield4==$Custom28Field) print "selected"; ?>><?php print $CustomTitle28; ?></option><?php } ?>
                <?php if ($CustomTitle29!="") { ?><option value="<?php print $Custom29Field; ?>" <?php if ($filfield4==$Custom29Field) print "selected"; ?>><?php print $CustomTitle29; ?></option><?php } ?>
                <?php if ($CustomTitle30!="") { ?><option value="<?php print $Custom30Field; ?>" <?php if ($filfield4==$Custom30Field) print "selected"; ?>><?php print $CustomTitle30; ?></option><?php } ?>
                <?php if ($CustomTitle31!="") { ?><option value="<?php print $Custom31Field; ?>" <?php if ($filfield4==$Custom31Field) print "selected"; ?>><?php print $CustomTitle31; ?></option><?php } ?>
                <?php if ($CustomTitle32!="") { ?><option value="<?php print $Custom32Field; ?>" <?php if ($filfield4==$Custom32Field) print "selected"; ?>><?php print $CustomTitle32; ?></option><?php } ?>
                <?php if ($CustomTitle33!="") { ?><option value="<?php print $Custom33Field; ?>" <?php if ($filfield4==$Custom33Field) print "selected"; ?>><?php print $CustomTitle33; ?></option><?php } ?>
                <?php if ($CustomTitle34!="") { ?><option value="<?php print $Custom34Field; ?>" <?php if ($filfield4==$Custom34Field) print "selected"; ?>><?php print $CustomTitle34; ?></option><?php } ?>
                <?php if ($CustomTitle35!="") { ?><option value="<?php print $Custom35Field; ?>" <?php if ($filfield4==$Custom35Field) print "selected"; ?>><?php print $CustomTitle35; ?></option><?php } ?>
                <?php if ($CustomTitle36!="") { ?><option value="<?php print $Custom36Field; ?>" <?php if ($filfield4==$Custom36Field) print "selected"; ?>><?php print $CustomTitle36; ?></option><?php } ?>
                <?php if ($CustomTitle37!="") { ?><option value="<?php print $Custom37Field; ?>" <?php if ($filfield4==$Custom37Field) print "selected"; ?>><?php print $CustomTitle37; ?></option><?php } ?>
                <?php if ($CustomTitle38!="") { ?><option value="<?php print $Custom38Field; ?>" <?php if ($filfield4==$Custom38Field) print "selected"; ?>><?php print $CustomTitle38; ?></option><?php } ?>
                <?php if ($CustomTitle39!="") { ?><option value="<?php print $Custom39Field; ?>" <?php if ($filfield4==$Custom39Field) print "selected"; ?>><?php print $CustomTitle39; ?></option><?php } ?>
                <?php if ($CustomTitle40!="") { ?><option value="<?php print $Custom40Field; ?>" <?php if ($filfield4==$Custom40Field) print "selected"; ?>><?php print $CustomTitle40; ?></option><?php } ?>
                <?php if ($CustomTitle41!="") { ?><option value="<?php print $Custom41Field; ?>" <?php if ($filfield4==$Custom41Field) print "selected"; ?>><?php print $CustomTitle41; ?></option><?php } ?>
                <?php if ($CustomTitle42!="") { ?><option value="<?php print $Custom42Field; ?>" <?php if ($filfield4==$Custom42Field) print "selected"; ?>><?php print $CustomTitle42; ?></option><?php } ?>
                <?php if ($CustomTitle43!="") { ?><option value="<?php print $Custom43Field; ?>" <?php if ($filfield4==$Custom43Field) print "selected"; ?>><?php print $CustomTitle43; ?></option><?php } ?>
                <?php if ($CustomTitle44!="") { ?><option value="<?php print $Custom44Field; ?>" <?php if ($filfield4==$Custom44Field) print "selected"; ?>><?php print $CustomTitle44; ?></option><?php } ?>
                <?php if ($CustomTitle45!="") { ?><option value="<?php print $Custom45Field; ?>" <?php if ($filfield4==$Custom45Field) print "selected"; ?>><?php print $CustomTitle45; ?></option><?php } ?>
                <?php if ($CustomTitle46!="") { ?><option value="<?php print $Custom46Field; ?>" <?php if ($filfield4==$Custom46Field) print "selected"; ?>><?php print $CustomTitle46; ?></option><?php } ?>
                <?php if ($CustomTitle47!="") { ?><option value="<?php print $Custom47Field; ?>" <?php if ($filfield4==$Custom47Field) print "selected"; ?>><?php print $CustomTitle47; ?></option><?php } ?>
                <?php if ($CustomTitle48!="") { ?><option value="<?php print $Custom48Field; ?>" <?php if ($filfield4==$Custom48Field) print "selected"; ?>><?php print $CustomTitle48; ?></option><?php } ?>
                <?php if ($CustomTitle49!="") { ?><option value="<?php print $Custom49Field; ?>" <?php if ($filfield4==$Custom49Field) print "selected"; ?>><?php print $CustomTitle49; ?></option><?php } ?>
                <?php if ($CustomTitle50!="") { ?><option value="<?php print $Custom50Field; ?>" <?php if ($filfield4==$Custom50Field) print "selected"; ?>><?php print $CustomTitle50; ?></option><?php } ?>                
                </select>
        </td>
        <td>
            <select class="filter" name="filcond4" size="1" onKeyPress="return submitenter(event,Filter)">
                    <option value="equals" <?php if ($filcond4=="equals") print "selected"; ?>>equals</option>
                    <option value="notequal" <?php if ($filcond4=="notequal") print "selected"; ?>>not equal to</option>
                    <option value="contains" <?php if (($filcond4=="contains") || ($filcond3=="")) print "selected"; ?>>contains</option>
                    <option value="notcontain" <?php if ($filcond4=="notcontain") print "selected"; ?>>does not contain</option>
                    <option value="less" <?php if ($filcond4=="less") print "selected"; ?>>less than</option>
                    <option value="greater" <?php if ($filcond4=="greater") print "selected"; ?>>greater than</option>
                    <option value="starts" <?php if ($filcond4=="starts") print "selected"; ?>>starts with</option>
                    <option value="ends" <?php if ($filcond4=="ends") print "selected"; ?>>ends with</option>
                    <option value="lessnum" <?php if ($filcond4=="lessnum") print "selected"; ?>>less than num</option>
                    <option value="greaternum" <?php if ($filcond4=="greaternum") print "selected"; ?>>greater than num</option>
                    </select>
        </td>
        <td>
            <input class="filter inputtextfilter" type="text" name="fildata4" value="<?php print $fildata4; ?>" maxlength="100" size="30" onKeyPress="return submitenter(event,Filter)">
        </td>
        <td>
        <button type="button" id="filter-go" name="filter" value="Filter" onclick="Filter();">Filter</button>          
        </td>
    </tr>
<?php  if (!$sl_noqueryoption) { ?>
    <tr >
        <th onclick="Show_Filters('sql');" colspan="5"><span style="float: left;">SQL Query&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="float: right;"><img id="sqlimage" src="expand.png"></span></th>
    </tr>

    <tr id="sqlrow1" style="display: none;">
        <td colspan="4">
                
<input class="filter" type="text" id="sqlinput" name="sqlinput" value="<?php print($sqlinput);?>" maxlength="1000" onKeyPress="return submitenter(event,Run_SQL_Query)">
        </td>
        <td>
          <button type="button" id="query-go" name="query" value="Query" onclick="Run_SQL_Query();">Query</button>
        </td>
    </tr>
<?php } ?>    
<?php
  if (($queryerror==true) && ($act=="query"))
  {
	  print "    <tr>\n";
	  print "        <td colspan=\"3\">\n";
	  print("<p class=\"filtererror\"><b>Invalid Query</b></p>");
	  print "        </td>\n";
	  print "    </tr>\n";
	}
?>
</table>
</div>

<div class="numrows">
<?php
  // If delete or other change made then recalculate total number of records
  if (($rowsaffected>-1) || ($act="deleteselected"))
  {
    $mysql_result = mysqli_query($mysql_link,"SELECT count(*) from $DbTableName");
    $row = mysqli_fetch_row($mysql_result);
    if ($row!=false)
      $totalrows = $row[0];
    else  
    $totalrows = 0;
  }
	print "<table class=\"numrows\" border=\"0\" cellspacing=\"0\">\n";
	print "<tr>\n";
	print "<td>\n";
	if ($rowsaffected>-1)
	  print("$rowsaffected users from $totalrows affected by query");
	else
	{
	  if($numrows<$totalrows)
	    print"$numrows users from $totalrows";
	  else
	    print"$numrows users";
	}
	print "</td>\n";
	print "<td>\n";
  if ($numselected>0)
		print "<span id=\"seltext\">($numselected selected)</span>\n";
	else
		print "<span id=\"seltext\"></span>\n";
  
  if($numrows<$totalrows)
    print "<a class='numrows' href='javascript: Show_All();'>clear filter</a>\n";

	print "</td>\n";
   
  if (($emailsent>0) || ($emailfail>0) || ($emailblocked>0))
  {
  	print "<td>\n";
    if ($emailsent>0)
  		print "<span class=\"emailsent\">$emailsent email(s) sent&nbsp;</span>\n";
    if ($emailblocked>0)
  		print "<span class=\"emailfailed\">$emailblocked email(s) blocked by plugin&nbsp;</span>\n";
    if ($emailfail>0)
  		print "<span class=\"emailfailed\">$emailfail email(s) failed</span>\n";
  	print "</td></tr>\n";
	}
  print "</table>\n";
  print "</div>";
	for ($k=0;$k<$ShowRows;$k++)
	{
	  if ($Useridarray[$k]!="")
	  {
			print "<input name=\"sl$k\" id=\"sl$k\" type=\"hidden\" value=\" ".$Useridarray[$k]."\">\n";
	  }
	}
?>

<div class="records">
<table class="records">
<tr >
<?php 
for ($col=0;$col<strlen($ColumnOrder);$col++)
{
  $coltag=substr($ColumnOrder,$col*2,2);
  switch ($coltag)
  {
    case "AC":?>
<th id="actioncolumn" style="width: 18px; overflow: hidden; cursor: pointer;" OnClick="Sort('');" title="Click to clear sort">
&nbsp;
</th>
    <?php break;
    case "SL":?>
<th  OnClick="Sort('<?php print $SelectedField; ?>');" title="Click to sort" style="cursor: pointer;" >
&nbsp;
</th>
    <?php break;
    case "CR":?>
<th <?php if ($sortf==$CreatedField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $CreatedField; ?>');" title="<?php echo getsortmessage($CreatedField); ?>" style="cursor: pointer;" >
<nobr>Created</nobr>
</th>
    <?php break;
    case "US":?>
<th <?php if ($sortf==$UsernameField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $UsernameField; ?>');" title="<?php echo getsortmessage($UsernameField); ?>" style="cursor: pointer;" >
<nobr>Username</nobr>
</th>
    <?php break;
    case "PW":?>
<th <?php if ($sortf==$PasswordField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $PasswordField; ?>');" title="<?php echo getsortmessage($PasswordField); ?>" style="cursor: pointer;" >
<nobr>Password</nobr>
</th>
    <?php break;
    case "EN":?>
<th <?php if ($sortf==$EnabledField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $EnabledField; ?>');" title="<?php echo getsortmessage($EnabledField); ?>" style="cursor: pointer;" >
<nobr>Enabled</nobr>
</th>
    <?php break;
    case "NM":?>
<th <?php if ($sortf==$NameField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $NameField; ?>');" title="<?php echo getsortmessage($NameField); ?>" style="cursor: pointer;" >
<nobr>Name</nobr>
</th>
    <?php break;
    case "EM":?>
<th <?php if ($sortf==$EmailField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $EmailField; ?>');" title="<?php echo getsortmessage($EmailField); ?>" style="cursor: pointer;" >
<nobr>Email</nobr>
</th>
    <?php break;
    case "UG":?>
<th <?php if ($sortf==$UsergroupsField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $UsergroupsField; ?>');" title="<?php echo getsortmessage($UsergroupsField); ?>" style="cursor: pointer;" >
<nobr>Usergroups</nobr>
</th>
    <?php break;
    case "ID":?>
<th <?php if ($sortf==$IdField) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $IdField; ?>');" title="<?php echo getsortmessage($IdField); ?>" style="cursor: pointer;" >
<nobr>User Id</nobr>
</th>
    <?php break;
    case "01":?>
<th <?php if ($sortf==$Custom1Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom1Field; ?>');" title="<?php echo getsortmessage($Custom1Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle1; ?></nobr>
</th>
    <?php break;
    case "02":?>
<th <?php if ($sortf==$Custom2Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom2Field; ?>');" title="<?php echo getsortmessage($Custom2Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle2; ?></nobr>
</th>
    <?php break;
    case "03":?>
<th <?php if ($sortf==$Custom3Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom3Field; ?>');" title="<?php echo getsortmessage($Custom3Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle3; ?></nobr>
</th>
    <?php break;
    case "04":?>
<th <?php if ($sortf==$Custom4Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom4Field; ?>');" title="<?php echo getsortmessage($Custom4Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle4; ?></nobr>
</th>
    <?php break;
    case "05":?>
<th <?php if ($sortf==$Custom5Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom5Field; ?>');" title="<?php echo getsortmessage($Custom5Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle5; ?></nobr>
</th>
    <?php break;
    case "06":?>
<th <?php if ($sortf==$Custom6Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom6Field; ?>');" title="<?php echo getsortmessage($Custom6Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle6; ?></nobr>
</th>
    <?php break;
    case "07":?>
<th <?php if ($sortf==$Custom7Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom7Field; ?>');" title="<?php echo getsortmessage($Custom7Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle7; ?></nobr>
</th>
    <?php break;
    case "08":?>
<th <?php if ($sortf==$Custom8Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom8Field; ?>');" title="<?php echo getsortmessage($Custom8Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle8; ?></nobr>
</th>
    <?php break;
    case "09":?>
<th <?php if ($sortf==$Custom9Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom9Field; ?>');" title="<?php echo getsortmessage($Custom9Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle9; ?></nobr>
</th>
    <?php break;
    case "10":?>
<th <?php if ($sortf==$Custom10Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom10Field; ?>');" title="<?php echo getsortmessage($Custom10Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle10; ?></nobr>
</th>
    <?php break;
    case "11":?>
<th <?php if ($sortf==$Custom11Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom11Field; ?>');" title="<?php echo getsortmessage($Custom11Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle11; ?></nobr>
</th>
    <?php break;
    case "12":?>
<th <?php if ($sortf==$Custom12Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom12Field; ?>');" title="<?php echo getsortmessage($Custom12Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle12; ?></nobr>
</th>
    <?php break;
    case "13":?>
<th <?php if ($sortf==$Custom13Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom13Field; ?>');" title="<?php echo getsortmessage($Custom13Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle13; ?></nobr>
</th>
    <?php break;
    case "14":?>
<th <?php if ($sortf==$Custom14Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom14Field; ?>');" title="<?php echo getsortmessage($Custom14Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle14; ?></nobr>
</th>
    <?php break;
    case "15":?>
<th <?php if ($sortf==$Custom15Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom15Field; ?>');" title="<?php echo getsortmessage($Custom15Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle15; ?></nobr>
</th>
    <?php break;
    case "16":?>
<th <?php if ($sortf==$Custom16Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom16Field; ?>');" title="<?php echo getsortmessage($Custom16Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle16; ?></nobr>
</th>
    <?php break;
    case "17":?>
<th <?php if ($sortf==$Custom17Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom17Field; ?>');" title="<?php echo getsortmessage($Custom17Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle17; ?></nobr>
</th>
    <?php break;
    case "18":?>
<th <?php if ($sortf==$Custom18Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom18Field; ?>');" title="<?php echo getsortmessage($Custom18Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle18; ?></nobr>
</th>
    <?php break;
    case "19":?>
<th <?php if ($sortf==$Custom19Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom19Field; ?>');" title="<?php echo getsortmessage($Custom19Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle19; ?></nobr>
</th>
    <?php break;
    case "20":?>
<th <?php if ($sortf==$Custom20Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom20Field; ?>');" title="<?php echo getsortmessage($Custom20Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle20; ?></nobr>
</th>
    <?php break;
    case "21":?>
<th <?php if ($sortf==$Custom21Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom21Field; ?>');" title="<?php echo getsortmessage($Custom21Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle21; ?></nobr>
</th>
    <?php break;
    case "22":?>
<th <?php if ($sortf==$Custom22Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom22Field; ?>');" title="<?php echo getsortmessage($Custom22Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle22; ?></nobr>
</th>
    <?php break;
    case "23":?>
<th <?php if ($sortf==$Custom23Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom23Field; ?>');" title="<?php echo getsortmessage($Custom23Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle23; ?></nobr>
</th>
    <?php break;
    case "24":?>
<th <?php if ($sortf==$Custom24Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom24Field; ?>');" title="<?php echo getsortmessage($Custom24Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle24; ?></nobr>
</th>
    <?php break;
    case "25":?>
<th <?php if ($sortf==$Custom25Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom25Field; ?>');" title="<?php echo getsortmessage($Custom25Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle25; ?></nobr>
</th>
    <?php break;
    case "26":?>
<th <?php if ($sortf==$Custom26Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom26Field; ?>');" title="<?php echo getsortmessage($Custom26Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle26; ?></nobr>
</th>
    <?php break;
    case "27":?>
<th <?php if ($sortf==$Custom27Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom27Field; ?>');" title="<?php echo getsortmessage($Custom27Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle27; ?></nobr>
</th>
    <?php break;
    case "28":?>
<th <?php if ($sortf==$Custom28Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom28Field; ?>');" title="<?php echo getsortmessage($Custom28Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle28; ?></nobr>
</th>
    <?php break;
    case "29":?>
<th <?php if ($sortf==$Custom29Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom29Field; ?>');" title="<?php echo getsortmessage($Custom29Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle29; ?></nobr>
</th>
    <?php break;
    case "30":?>
<th <?php if ($sortf==$Custom30Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom30Field; ?>');" title="<?php echo getsortmessage($Custom30Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle30; ?></nobr>
</th>
    <?php break;
    case "31":?>
<th <?php if ($sortf==$Custom31Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom31Field; ?>');" title="<?php echo getsortmessage($Custom31Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle31; ?></nobr>
</th>
    <?php break;
    case "32":?>
<th <?php if ($sortf==$Custom32Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom32Field; ?>');" title="<?php echo getsortmessage($Custom32Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle32; ?></nobr>
</th>
    <?php break;
    case "33":?>
<th <?php if ($sortf==$Custom33Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom33Field; ?>');" title="<?php echo getsortmessage($Custom33Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle33; ?></nobr>
</th>
    <?php break;
    case "34":?>
<th <?php if ($sortf==$Custom34Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom34Field; ?>');" title="<?php echo getsortmessage($Custom34Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle34; ?></nobr>
</th>
    <?php break;
    case "35":?>
<th <?php if ($sortf==$Custom35Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom35Field; ?>');" title="<?php echo getsortmessage($Custom35Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle35; ?></nobr>
</th>
    <?php break;
    case "36":?>
<th <?php if ($sortf==$Custom36Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom36Field; ?>');" title="<?php echo getsortmessage($Custom36Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle36; ?></nobr>
</th>
    <?php break;
    case "37":?>
<th <?php if ($sortf==$Custom37Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom37Field; ?>');" title="<?php echo getsortmessage($Custom37Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle37; ?></nobr>
</th>
    <?php break;
    case "38":?>
<th <?php if ($sortf==$Custom38Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom38Field; ?>');" title="<?php echo getsortmessage($Custom38Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle38; ?></nobr>
</th>
    <?php break;
    case "39":?>
<th <?php if ($sortf==$Custom39Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom39Field; ?>');" title="<?php echo getsortmessage($Custom39Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle39; ?></nobr>
</th>
    <?php break;
    case "40":?>
<th <?php if ($sortf==$Custom40Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom40Field; ?>');" title="<?php echo getsortmessage($Custom40Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle40; ?></nobr>
</th>
    <?php break;
    case "41":?>
<th <?php if ($sortf==$Custom41Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom41Field; ?>');" title="<?php echo getsortmessage($Custom41Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle41; ?></nobr>
</th>
    <?php break;
    case "42":?>
<th <?php if ($sortf==$Custom42Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom42Field; ?>');" title="<?php echo getsortmessage($Custom42Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle42; ?></nobr>
</th>
    <?php break;
    case "43":?>
<th <?php if ($sortf==$Custom43Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom43Field; ?>');" title="<?php echo getsortmessage($Custom43Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle43; ?></nobr>
</th>
    <?php break;
    case "44":?>
<th <?php if ($sortf==$Custom44Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom44Field; ?>');" title="<?php echo getsortmessage($Custom44Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle44; ?></nobr>
</th>
    <?php break;
    case "45":?>
<th <?php if ($sortf==$Custom45Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom45Field; ?>');" title="<?php echo getsortmessage($Custom45Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle45; ?></nobr>
</th>
    <?php break;
    case "46":?>
<th <?php if ($sortf==$Custom46Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom46Field; ?>');" title="<?php echo getsortmessage($Custom46Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle46; ?></nobr>
</th>
    <?php break;
    case "47":?>
<th <?php if ($sortf==$Custom47Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom47Field; ?>');" title="<?php echo getsortmessage($Custom47Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle47; ?></nobr>
</th>
    <?php break;
    case "48":?>
<th <?php if ($sortf==$Custom48Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom48Field; ?>');" title="<?php echo getsortmessage($Custom48Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle48; ?></nobr>
</th>
    <?php break;
    case "49":?>
<th <?php if ($sortf==$Custom49Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom49Field; ?>');" title="<?php echo getsortmessage($Custom49Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle49; ?></nobr>
</th>
    <?php break;
    case "50":?>
<th <?php if ($sortf==$Custom50Field) echo "class=\"sortcolumn\""; ?> OnClick="Sort('<?php print $Custom50Field; ?>');" title="<?php echo getsortmessage($Custom50Field); ?>" style="cursor: pointer;" >
<nobr><?php print $CustomTitle50; ?></nobr>
</th>
<?php
break; 
}
}
?>

</tr>
<?php
  for ($k=0;$k<$ShowRows;$k++)
  {
    if ($Usernamearray[$k]!="")
    {
	  if ($k%2==0)
        print"<tr class=\"recordseven\">\n";
	  else
        print"<tr class=\"recordsodd\">\n";	   
 
for ($col=0;$col<strlen($ColumnOrder);$col++)
{
  $coltag=substr($ColumnOrder,$col*2,2);
  switch ($coltag)
  {
    case "AC":
      print("<td>\n");
      print("<nobr>");
      print ("&nbsp;");
      if ($ActionItems>0)
      {
        print("<a class=\"records\" href=\"javascript: Edit_User('".$Usernamearray[$k]."')\" onMouseOver=\"window.status='Edit details for ".$Usernamearray[$k]."'; return true;\"  onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"edit.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Edit user\" title=\"Edit user\"></a>");
        print("&nbsp;&nbsp;<a class=\"records\" href=\"javascript: Email_User('".$Usernamearray[$k]."')\" onMouseOver=\"window.status='Send email to ".$Usernamearray[$k]."'; return true;\"  onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"email.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Email user\" title=\"Email user\"></a>");
        print ("&nbsp;&nbsp;<a class=\"records\" href=\"javascript: Delete_User('".$Usernamearray[$k]."')\" onMouseOver=\"window.status='Permanently delete ".$Usernamearray[$k]."'; return true;\"  onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"delete.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Delete user\" title=\"Delete user\"></a>");
        if ($ActionItems==2)
        {
          if ($DbLogTableName!="")       
            print ("&nbsp;&nbsp;<a class=\"fancybox fancybox.iframe records\" href=\"logmanage.php?act=recentactivity&slcsrf=".$slcsrftoken."&user=".urlencode($Usernamearray[$k])."\" onMouseOver=\"window.status='View recent activity for ".$Usernamearray[$k]."'; return true;\"  onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"log.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Recent activity\" title=\"Recent activity\"></a>");
          print ("&nbsp;&nbsp;<a class=\"records\" href=\"javascript: Pass_Remind('".$Usernamearray[$k]."')\" onMouseOver=\"window.status='Send password reminder email to ".$Usernamearray[$k]."'; return true;\"  onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"passremind.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"Send password reminder\" title=\"Send password reminder\"></a>");
          // Insert links to plugin pages
          for ($p=0;$p<$slnumplugins;$p++)
          {
            if (($slplugin_adminusericon[$p]!="") && ($slplugin_adminuserpage[$p]!=""))
            {
              print ("&nbsp;&nbsp;<a class=\"records\" href=\"javascript: Plugin_User(".$slpluginid[$p].",$p,'".$slpluginfolder[$p]."/".$slplugin_adminuserpage[$p]."','".$Usernamearray[$k]."')\" onMouseOver=\"window.status='".$slplugin_adminusertooltip[$p]."'; return true;\" onMouseOut=\"window.status=''; return true;\"><img class=\"records\" src=\"".$slpluginfolder[$p]."/".$slplugin_adminusericon[$p]."\" width=\"16\" height=\"16\" border=\"0\" alt=\"".$slplugin_adminusertooltip[$p]."\" title=\"".$slplugin_adminusertooltip[$p]."\"></a>");
            }
          }
        }
      }
      if ($ActionItems<2)
      {
        if ($ActionItems==1)
          print ("&nbsp;&nbsp;");
        print "<a data-popupmenu=\"popmenu1\" onclick=\"javascript: return false;\" href=\"#\" onmouseover=\"MoreMenu('".$Usernamearray[$k]."')\"><img class=\"records\" src=\"more.png\" width=\"16\" height=\"16\" border=\"0\"></a>";
      }
      print "&nbsp;</nobr>";
      print("</td>\n");
      break;
      case "SL":  
      print("<td>\n");
      if (strtolower($Selectedarray[$k])=="yes")
				print "<input class=\"inputcheckbox\" type=\"checkbox\" name=\"cb$k\" id=\"cb$k\" checked onClick=\"Select('$k');\">\n";
	    else
				print "<input class=\"inputcheckbox\" type=\"checkbox\" name=\"cb$k\" id=\"cb$k\" onClick=\"Select('$k');\">\n";
      print("</td>\n");
      break;
      case "CR":  
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      if (($DateFormat=="DDMMYY") && (strlen($Createdarray[$k])==6))
      	$cdate=substr($Createdarray[$k],4,2)."/".substr($Createdarray[$k],2,2)."/".substr($Createdarray[$k],0,2);
      else
      	$cdate=substr($Createdarray[$k],2,2)."/".substr($Createdarray[$k],4,2)."/".substr($Createdarray[$k],0,2);
      print("<nobr>".$cdate."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "US";
      print("<td  ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Usernamearray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "PW":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Passwordarray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "EN":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Enabledarray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "NM":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Namearray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "EM":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Emailarray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "UG":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Usergroupsarray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "ID":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
      print("<nobr>".htmlentities($Useridarray[$k],ENT_QUOTES,strtoupper($MetaCharSet))."&nbsp;</nobr>\n");
      print("</td>\n");
      break;
      case "01":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus1array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "02":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus2array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "03":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus3array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "04":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus4array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "05":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus5array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "06":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus6array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "07":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus7array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "08":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus8array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "09":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus9array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "10":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus10array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "11":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus11array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "12":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus12array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "13":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus13array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "14":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus14array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "15":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus15array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "16":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus16array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "17":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus17array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "18":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus18array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "19":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus19array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "20":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus20array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "21":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus21array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "22":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus22array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "23":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus23array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "24":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus24array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "25":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus25array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "26":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus26array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "27":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus27array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "28":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus28array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "29":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus29array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "30":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus30array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "31":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus31array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "32":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus32array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "33":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus33array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "34":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus34array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "35":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus35array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "36":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus36array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "37":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus37array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "38":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus38array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "39":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus39array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "40":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus40array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "41":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus41array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "42":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus42array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "43":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus43array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "44":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus44array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "45":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus45array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "46":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus46array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "47":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus47array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "48":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus48array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "49":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus49array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
	    break;
      case "50":
      print("<td ondblclick=\"Edit_User('".$Usernamearray[$k]."')\">\n");
	    print("<nobr>".lengthlimit(htmlentities($Cus50array[$k],ENT_QUOTES,strtoupper($MetaCharSet)),255)."&nbsp;</nobr>\n");
	    print("</td>\n");
    }
    }       
      print("</tr>\n");
    }
    else
    {
  	  if ($k%2==0)	
        print"<tr class=\"recordsblankeven\">\n";
	  else
        print"<tr class=\"recordsblankodd\">\n";	  
    for ($col=0;$col<strlen($ColumnOrder)/2;$col++)
    {
      print("<td>\n");
      print("&nbsp;\n");
      print("</td>\n");
    }  
      print("</tr>\n");
    }
  }
?>
<!--
<tr>
<td colspan="59">
-->

<!--
</td>
</tr>
-->
</table>
</div>
<div class="controls">
<a class="controls" href="javascript: Goto_First()" onMouseOver="window.status='Goto the first page'; return true;" onMouseOut="window.status=''; return true;"><img class="controls" src="first.png" width="16" height="16" border="0" alt="First record" title="First record" align="absmiddle"></a>&nbsp;
<a class="controls" href="javascript: Goto_Prev()" onMouseOver="window.status='Goto the previous page'; return true;" onMouseOut="window.status=''; return true;"><img class="controls" src="prev.png" width="16" height="16" border="0" alt="Previous <?php print $ShowRows ?> records" title="Previous <?php print $ShowRows ?> records" align="absmiddle"></a>&nbsp;
<a class="controls" href="javascript: Goto_Next()" onMouseOver="window.status='Goto the next page'; return true;" onMouseOut="window.status=''; return true;"><img class="controls" src="next.png" width="16" height="16" border="0" alt="Next <?php print $ShowRows ?> records" title="Next <?php print $ShowRows ?> records" align="absmiddle"></a>&nbsp;
<a class="controls" href="javascript: Goto_Last()" onMouseOver="window.status='Goto the last page'; return true;" onMouseOut="window.status=''; return true;"><img class="controls" src="last.png" width="16" height="16" border="0" alt="Last record" title="Last record" align="absmiddle"></a>&nbsp;&nbsp;&nbsp;
Page
<select class="controls" name="showpage" size="1" onChange="Goto_Page();" >
<?php
$np=intval(ceil($numrows/$ShowRows));
if ($np==0)
	$np=1;
$cp=intval($tablestart/$ShowRows)+1;
for ($k=1;$k<=$np;$k++)
{
	print"<option value=\"$k\"";
	if ($k==$cp)
		print " selected ";
	print">$k</option>\n";
}
?>
</select>
<b>&nbsp;</b>of&nbsp;<?php echo $np; ?>&nbsp;&nbsp;
&nbsp;&nbsp;<select class="controls" name="recordsperpage" size="1" onChange="Records_Per_Page();" >
<option value="1" <?php if ($recordsperpage=="1") print "selected"; ?> >1</option>
<option value="5" <?php if ($recordsperpage=="5") print "selected"; ?> >5</option>
<option value="10" <?php if ($recordsperpage=="10") print "selected"; ?> >10</option>
<option value="15" <?php if ($recordsperpage=="15") print "selected"; ?> >15</option>
<option value="20" <?php if ($recordsperpage=="20") print "selected"; ?> >20</option>
<option value="30" <?php if ($recordsperpage=="30") print "selected"; ?> >30</option>
<option value="40" <?php if ($recordsperpage=="40") print "selected"; ?> >40</option>
<option value="50" <?php if ($recordsperpage=="50") print "selected"; ?> >50</option>
<option value="100" <?php if ($recordsperpage=="100") print "selected"; ?> >100</option>
<option value="200" <?php if ($recordsperpage=="200") print "selected"; ?> >200</option>
<option value="300" <?php if ($recordsperpage=="300") print "selected"; ?> >300</option>
<option value="500" <?php if ($recordsperpage=="500") print "selected"; ?> >500</option>
</select>
Records per page
</div>
<div class="selectall">
&nbsp;&nbsp;<a class="controls" href="javascript: Select_All()" onMouseOver="window.status='Select All'; return true;" onMouseOut="window.status=''; return true;"><img src="checkall.png" width="37" height="16" border="0" align="absmiddle" alt="Select All" title="Select All"></a>
</div>
<div style="display: none;" id="selectedactions">
&nbsp;&nbsp;<a class="selectedactions" href="javascript: Deselect_All()" onMouseOver="window.status='Deselect All'; return true;" onMouseOut="window.status=''; return true;"><img src="ucheckall.png" width="37" height="16" border="0" align="absmiddle" alt="Deselect All"  title="Deselect All"></a>
&nbsp;&nbsp;<a class="selectedactions" href="javascript: Add_User()" onMouseOver="window.status='Add user'; return true;" onMouseOut="window.status=''; return true;"><img src="adduser.png" width="16" height="16" border="0" align="absmiddle" alt="Add user" title="Add user"></a>
&nbsp;&nbsp;<a class="selectedactions" href="javascript: Email_Selected()" onMouseOver="window.status='Email selected users'; return true;" onMouseOut="window.status=''; return true;"><img src="email.png" width="16" height="16" border="0" align="absmiddle" alt="Email selected users" title="Email selected users"></a>
&nbsp;&nbsp;<a class="selectedactions" href="javascript: Delete_Selected()" onMouseOver="window.status='Delete selected users'; return true;" onMouseOut="window.status=''; return true;"><img src="delete.png" width="16" height="16" border="0" align="absmiddle" alt="Delete Selected Users" title="Delete Selected Users"></a>
&nbsp;&nbsp;<a class="selectedactions" href="javascript: Export_Selected()" onMouseOver="window.status='Export selected users'; return true;" onMouseOut="window.status=''; return true;"><img src="export.png" width="16" height="16" border="0" align="absmiddle" alt="Export selected users" title="Export selected users"></a>
<?php
// Insert links to plugin selected users pages
for ($p=0;$p<$slnumplugins;$p++)
{
  if (($slplugin_adminselectedicon[$p]!="") && ($slplugin_adminselectedpage[$p]!=""))
  {
  ?>
    &nbsp;&nbsp;<a class="selectedactions" href="javascript: Plugin_Selected(<?php echo $slpluginid[$p]; ?>,<?php echo $p; ?>,'<?php echo $slpluginfolder[$p]."/".$slplugin_adminselectedpage[$p]; ?>')" onMouseOver="window.status='<?php echo $slplugin_adminselectedtooltip[$p]; ?>'; return true;" onMouseOut="window.status=''; return true;"><img src="<?php echo $slpluginfolder[$p]."/".$slplugin_adminselectedicon[$p]; ?>" width="16" height="16" border="0" align="absmiddle" alt="<?php echo $slplugin_adminselectedtooltip[$p]; ?>" title="<?php echo $slplugin_adminselectedtooltip[$p]; ?>"></a>
  <?php  
  }
}
?>
</div>  
</form>
<br>
<script  type="text/javascript">
Show_Filters("")
<?php if ($numselected>0) { ?>
Show_Selected_Actions(true)
<?php } ?>
</script>
<?php include "footeradmin.php"; ?>
</body>
</html>
<?php
//  mysqli_close($mysql_link);
function lengthlimit($s,$l)
{
 $s=substr($s,0,$l);
 return($s);	
}
function getsortmessage($field)
{
  global $sortf,$sortd;
	if ($sortf!=$field)
	  return("Click to sort");
	if ($sortd=="ASC")
	  return("Sorted ascending (click to reverse)");
  return("Sorted descending (click to reverse)");
}
?>