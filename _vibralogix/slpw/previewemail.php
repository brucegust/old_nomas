<?php
  reset($_GET);
  reset($_POST);
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$startpage="index.php";
  require_once("sitelokpw.php");
  $body=$_SESSION['ses_slemailbody'];
  $subject=$_SESSION['ses_slemailsubject'];
  $htmlformat=$_SESSION['ses_slemailhtmlformat'];
  $sortf=$_SESSION['ses_slemailsortf'];
  $sortd=$_SESSION['ses_slemailsortd'];
  $user=$_SESSION['ses_slemailuser'];
  $email=$_SESSION['ses_slemailemail'];
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  if ($act=="emailuser")
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
  if ($act=="emailselected")
  {
    if (($sortf!="") && ($sortd!=""))
      $sortquery=" ORDER BY ".mysqli_real_escape_string($mysql_link,$sortf)." ".mysqli_real_escape_string($mysql_link,$sortd);
    else
      $sortquery="";
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'".$sortquery." LIMIT 1");
  }
  if ($act=="emaildirect")
  {
    $emailaddresses=explode(",",$email);
    $emailaddresses[0]=trim($emailaddresses[0]);
    $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($emailaddresses[0]));
  }  
  if ($mysql_result!=false)
  {
      $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
      if ($row!=false)
      { 
        $UserId=$row[$IdField];   
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
        sl_PrepareEmail($body,$subject,$htmlformat,$UserId,$Username,$Password,$Name,$Email,$Usergroups,$Cus1,$Cus2,$Cus3,$Cus4,$Cus5,$Cus6,$Cus7,$Cus8,$Cus9,$Cus10,
        $Cus11,$Cus12,$Cus13,$Cus14,$Cus15,$Cus16,$Cus17,$Cus18,$Cus19,$Cus20,$Cus21,$Cus22,$Cus23,$Cus24,$Cus25,$Cus26,$Cus27,$Cus28,$Cus29,$Cus30,
        $Cus31,$Cus32,$Cus33,$Cus34,$Cus35,$Cus36,$Cus37,$Cus38,$Cus39,$Cus40,$Cus41,$Cus42,$Cus43,$Cus44,$Cus45,$Cus46,$Cus47,$Cus48,$Cus49,$Cus50);
      }
      else       
        sl_PrepareEmail($body,$subject,$htmlformat,"-1","","","",$emailaddresses[0],"","","","","","","","","","","");      
      if ($htmlformat!="Y")
        $body=str_replace("\n","<br>\n",$body);
      print $body;
  }
  else
  {
    print "<html>\n";
    print "<head>\n";
    print "<title>Preview error</title>\n";
    print "</head>\n";
    print "<body>\n";
    print "An error occurred accessing the database<br>\n";
    print "</body>\n";
    print "</html>\n";    
  }

?>
