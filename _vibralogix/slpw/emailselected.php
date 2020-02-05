<?php
  reset($_GET);
  reset($_POST);
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$startpage="index.php";
	$maxsessiontime=0; // Stop session timing out during mailing
  require_once("sitelokpw.php");
  $body=$_SESSION['ses_slemailbody'];
  $subject=$_SESSION['ses_slemailsubject'];
  $htmlformat=$_SESSION['ses_slemailhtmlformat'];
  $sortf=$_SESSION['ses_slemailsortf'];
  $sortd=$_SESSION['ses_slemailsortd'];
  $dedupe=$_SESSION['ses_slemaildedupe'];
  if ((!isset($_SESSION['ses_slemailcount'])) || ($esact=="start"))
    $emailcount=0;
  else
    $emailcount=$_SESSION['ses_slemailcount'];
  if ((!isset($_SESSION['ses_slemailsent']))  || ($esact=="start"))
    $emailsent=0;
  else
    $emailsent=$_SESSION['ses_slemailsent'];
  if ((!isset($_SESSION['ses_slemailfail']))  || ($esact=="start"))
    $emailfail=0;
  else
    $emailfail=$_SESSION['ses_slemailfail'];
  if ((!isset($_SESSION['ses_slemailblocked']))  || ($esact=="start"))
    $emailblocked=0;
  else
    $emailblocked=$_SESSION['ses_slemailblocked'];
	print "<html>\n";
	print "<head>\n";
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
	print "<link href=\"stylesemailuser.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	print " <title>Sending email...</title>\n";
	print "</head>\n";
	print "<body class=\"emailselected\">\n";
	?>
  <p align="center"><h1 style="text-align: center;">Sending Emails</h1></p>
  <?php
	$msg="Please wait";
	if ($esact=="pause")
    $msg="Emailing paused";
	if ($esact=="init")
    $msg="Initialising";
	if ($esact=="finish")
	{
    $msg="Finished. $emailsent emails sent ";
    if ($emailblocked>0)
      $msg.="$emailblocked emails blocked by plugin ";
    if ($emailfail>0)
      $msg.="and $emailfail emails failed ";
  }  
	print "<div id=\"divprogress\"><p class=\"emailselected\">$msg</p>\n";
	print "</div>\n";
	print "<br>\n";
	print "<form name=\"form1\">\n";
	if ($esact=="pause")
		print "<p class=\"emailselected\"><input type=\"button\" name=\"Continue\" value=\"Continue\" onClick=\"callback()\">\n";
	else
	{
		if ($esact=="finish")
			print "<p class=\"emailselected\"><input type=\"button\" name=\"Close\" value=\"Close\" onClick=\"cancel()\">\n";
		else
			print "<p class=\"emailselected\"><input type=\"button\" name=\"Pause\" value=\"Pause\" onClick=\"pause()\">\n";
	}
	if ($esact!="finish")
	{
		print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
		print "<input class=\"emailselected\" type=\"button\" name=\"Cancel\" value=\"Cancel\" onClick=\"cancel()\"></p>\n";
  }
	print "  </form>\n";
	print "<br>\n";
	if ($esact!="finish")
	{
	  print "<p class=\"emailselectedwarning\">Warning. Closing this window will cancel the mailing.<br>";
	  if ($esact!="pause")
	    print "If the mailing seems to hang click <a class=\"emailselected\" href=\"javascript:callback()\">here</a> to continue.</p>\n";
  }
	print "</div>\n";
	print "<script language=\"javascript\" type=\"text/javascript\">\n";
	print "function updateprogress(msg)\n";
	print "{\n";
	print "  document.getElementById(\"divprogress\").innerHTML = \"<p align=\\\"center\\\"><font face=\\\"Arial\\\"><span style=\\\"font-size:12pt;\\\">\"+msg+\"</span></font><p>\";\n";
	print "}\n";
	print "function callback()\n";
	print "{\n";
	print "  window.location.href=window.location.pathname\n";
	print "}\n";
	print "function finish()\n";
	print "{\n";
  print "  window.location.href=window.location.pathname+\"?esact=finish\"\n";
	print "}\n";
	print "function pause()\n";
	print "{\n";
  print "  window.location.href=window.location.pathname+\"?esact=pause\"\n";
	print "}\n";
	print "function cancel()\n";
	print "{\n";
  if ($esact=="finish")
  {
    print "parent.jQuery.fancybox.close()\n";
//		print "  window.close()\n";
  }		
  else
  {
	  print "  if (confirm(\"Are you sure you want to cancel this mailing?\"))\n";
	  print "  {\n";
//	  print "    window.close()\n";
    print "parent.jQuery.fancybox.close()\n";
	  print "  }\n";
	}
	print "}\n";
	print "</script>\n";
	if (($esact=="pause") || ($esact=="init") || ($esact=="finish"))
	{
		print "</body>\n";
		print "</html>\n";
		exit;
	}
	$maxtime=ini_get('max_execution_time');
	if (!is_numeric($maxtime))
		 $maxtime=30;
  $maxtime=$maxtime-5;	 
  $scriptstart=time();
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }  
	print str_repeat(" ",50000)."\n";
	flush();
  if (($sortf!="") && ($sortd!=""))
    $sortquery=" ORDER BY ".mysqli_real_escape_string($mysql_link,$sortf)." ".mysqli_real_escape_string($mysql_link,$sortd);
  else
    $sortquery="";


  $finished=false;  
  do
  {
    $limit=" LIMIT ".$emailcount.",".$sl_dbblocksize; 
    if ($dedupe=="dedupe") 
      $mysql_result=mysqli_query($mysql_link,"SELECT SQL_CALC_FOUND_ROWS * FROM ".$DbTableName." WHERE ".$SelectedField."='Yes' GROUP BY(".$EmailField.")".$sortquery.$limit);  
    else
      $mysql_result=mysqli_query($mysql_link,"SELECT SQL_CALC_FOUND_ROWS * FROM ".$DbTableName." WHERE ".$SelectedField."='Yes'".$sortquery.$limit);  
    if ($mysql_result!=false)
    {
    	// See how many selected records
    	$sqlnum=mysqli_query($mysql_link,"SELECT FOUND_ROWS() AS `found_rows`;");
      $rows = mysqli_fetch_array($sqlnum,MYSQLI_ASSOC);
      $numtoemail = $rows['found_rows'];
      while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
      {
     	  if ($EmailDelay!=0)
     	  {
     	    if ($EmailDelay>=1000)
     	      sleep(intval($EmailDelay/1000));
     	    else
     	      usleep($EmailDelay*1000);  
     	  }
     	  // See if near max script time
     	  if (($maxtime!=0) && ((time()-$scriptstart)>=($maxtime-1-(intval($EmailDelay/1000)))))
     	  {
  	     	print "<script language=\"javascript\" type=\"text/javascript\">";
  	      print "callback()";
  	      print "</script>";
  	      print str_repeat(" ",50000)."\n";
  				print "</body>\n";
  				print "</html>\n";
  				flush();
  	      exit;
     	  }
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
        $emres=sl_SendEmail($Email,$body,$subject,$htmlformat,$Username,$Password,$Name,$Email,$Usergroups,$Cus1,$Cus2,$Cus3,$Cus4,$Cus5,$Cus6,$Cus7,$Cus8,$Cus9,$Cus10,
        $Cus11,$Cus12,$Cus13,$Cus14,$Cus15,$Cus16,$Cus17,$Cus18,$Cus19,$Cus20,$Cus21,$Cus22,$Cus23,$Cus24,$Cus25,$Cus26,$Cus27,$Cus28,$Cus29,$Cus30,
        $Cus31,$Cus32,$Cus33,$Cus34,$Cus35,$Cus36,$Cus37,$Cus38,$Cus39,$Cus40,$Cus41,$Cus42,$Cus43,$Cus44,$Cus45,$Cus46,$Cus47,$Cus48,$Cus49,$Cus50);
        $num=$emailcount+1;
        if ($emres==1)
         	$emailsent++;
        if ($emres==2)
         	$emailblocked++;
        if ($emres==0)
        	$emailfail++;
        $emailcount++;
  			$_SESSION['ses_slemailcount']=$emailcount;
  			$_SESSION['ses_slemailsent']=$emailsent;
  			$_SESSION['ses_slemailfail']=$emailfail;
  			$_SESSION['ses_slemailblocked']=$emailblocked;
       	print "<script language=\"javascript\" type=\"text/javascript\">";
        print "updateprogress(\"emailed $Email ($num of $numtoemail)\")";
       	print "</script>";
       	print str_repeat(" ",50000)."\n";
        flush();
  //      for ($j=0;$j<1000000;$j++) { }
      }
    }
    else
      $finished=true;    
  }
  while((!$finished) && ($emailcount<$numtoemail));
  sleep(1);
	$_SESSION['ses_slemailcount']=-1;
 	print "<script language=\"javascript\" type=\"text/javascript\">";
  print "finish()";
 	print "</script>";
 	print str_repeat(" ",50000)."\n";
	print "</body>\n";
	print "</html>\n";
  flush();
  $progress="Finished. $emailsent emails sent ";
  if ($emailblocked>0)
    $progress.="$emailblocked emails blocked by plugin ";
  if ($emailfail>0)
    $progress.="and $emailfal emails failed ";
  print "updateprogress(\"$progress\")";
	print "</script>";
	print str_repeat(" ",50000)."\n";
  flush();
?>