<?php
  reset($_GET);
  reset($_POST);
  if (!empty($_POST))
  {
    while (list($name, $value) = each($_POST))
    {
      if (get_magic_quotes_gpc())
        $value=stripslashes($value);  
      $$name=trim($value);
    }
  }
	$groupswithaccess="ADMIN";
	$startpage="index.php";	
  require_once("sitelokpw.php");
  // Get current values
  if ($editconfigact=="")
  {
    $newsitename=$SiteName;
    $newsiteemail=$SiteEmail;
    $newsiteemail2=$SiteEmail2;
    $newdateformat=$DateFormat;
    $newlogoutpage=$LogoutPage;
    $newsiteloklocation=$SitelokLocation;
    $newsiteloklocationurl=$SitelokLocationURL;
    $newemaillocation=$EmailLocation;
    $newemailurl=$EmailURL;
    $newbackuplocation=$BackupLocation;
    if ($DemoMode)
      $newbackuplocation="Hidden in demo mode";
    $newfilelocation=$FileLocation;
    // Convert ; character splitting S3 location to | used in Linklok and Sitelok  
    $newfilelocation=str_replace(";","|",$FileLocation);
    if ($DemoMode)
      $newfilelocation="Hidden in demo mode";
    for ($k=0;$k<count($FileLocations);$k++)
    {
      $elements=each($FileLocations);
      $var1="newfilelocationsname".$k;
      $var2="newfilelocations".$k;
      $$var1=$elements[0];
      $$var2=$elements[1];
      // Convert ; character splitting S3 location to | used in Linklok and Sitelok
      $$var2=str_replace(";","|",$$var2);
      if ($DemoMode)
        $$var2="Hidden in demo mode";      
    }
    $newsiteloklog=$SitelokLog;
    if (substr($LogDetails,0,1)=="Y")
      $newlogentry1="on";
    if (substr($LogDetails,1,1)=="Y")
      $newlogentry2="on";
    if (substr($LogDetails,2,1)=="Y")
      $newlogentry3="on";
    if (substr($LogDetails,3,1)=="Y")
      $newlogentry4="on";
    if (substr($LogDetails,4,1)=="Y")
      $newlogentry5="on";
    if (substr($LogDetails,5,1)=="Y")
      $newlogentry6="on";
    if (substr($LogDetails,6,1)=="Y")
      $newlogentry7="on";
    if (substr($LogDetails,7,1)=="Y")
      $newlogentry8="on";
    if (substr($LogDetails,8,1)=="Y")
      $newlogentry9="on";
    $newsitekey=$SiteKey;
    if ($DemoMode)
      $newsitekey="Hidden in demo mode";    
    $newlogintype=$LoginType;
    $newturinglogin=$TuringLogin;
    $newturingregister=$TuringRegister;
    $newmaxsessiontime=$MaxSessionTime;
    $newmaxinactivitytime=$MaxInactivityTime;
    $newcookielogin=$CookieLogin;
    $newlogintemplate=$LoginPage;
    $newnoaccesspage=$NoAccessPage;            
    $newexpiredpage=$ExpiredPage;
    $newwronggrouppage=$WrongGroupPage;
    $newmessagetemplate=$MessagePage;
    $newforgottenemail=$ForgottenEmail;
    $newshowrows=$ShowRows;
    // Split column order into variables
    for ($c=0;$c<strlen($ColumnOrder);$c++)
    {
      $coltag=substr($ColumnOrder,$c*2,2);
      if ($coltag=="AC") $newactioncolumn=$c+1;
      if ($coltag=="SL") $newselectedcolumn=$c+1;
      if ($coltag=="CR") $newcreatedcolumn=$c+1;
      if ($coltag=="US") $newusernamecolumn=$c+1;
      if ($coltag=="PW") $newpasswordcolumn=$c+1;
      if ($coltag=="EN") $newenabledcolumn=$c+1;
      if ($coltag=="NM") $newnamecolumn=$c+1;
      if ($coltag=="EM") $newemailcolumn=$c+1;
      if ($coltag=="UG") $newusergroupscolumn=$c+1;
      if ($coltag=="ID") $newuseridcolumn=$c+1;
      for($k=1;$k<=50;$k++)
      {
        if ($k<10) $val="0".$k; else $val=$k;
        $var="newcustom".$k."column";
        if ($coltag==$val) $$var=$c+1;
      }
    }
    $newactionitems=$ActionItems;
    $newrandompasswordmask=$RandomPasswordMask;
    if ($MD5passwords)
      $newmd5passwords="1";
    else
      $newmd5passwords="0";
    $newprofilepassrequired=$ProfilePassRequired; 
    $newemailconfirmrequired=$EmailConfirmRequired;
    $newemailconfirmtemplate=$EmailConfirmTemplate;
    $newemailunique=$EmailUnique;
    $newloginwithemail=$LoginWithEmail;
    if ($ConcurrentLogin)
      $newconcurrentlogin="1";
    else
      $newconcurrentlogin="0";  
    $newcustomtitle1=$CustomTitle1;  
    $newcustomtitle2=$CustomTitle2;  
    $newcustomtitle3=$CustomTitle3;  
    $newcustomtitle4=$CustomTitle4;  
    $newcustomtitle5=$CustomTitle5;  
    $newcustomtitle6=$CustomTitle6;  
    $newcustomtitle7=$CustomTitle7;  
    $newcustomtitle8=$CustomTitle8;  
    $newcustomtitle9=$CustomTitle9;  
    $newcustomtitle10=$CustomTitle10;  
    $newcustomtitle11=$CustomTitle11;  
    $newcustomtitle12=$CustomTitle12;  
    $newcustomtitle13=$CustomTitle13;  
    $newcustomtitle14=$CustomTitle14;  
    $newcustomtitle15=$CustomTitle15;  
    $newcustomtitle16=$CustomTitle16;  
    $newcustomtitle17=$CustomTitle17;  
    $newcustomtitle18=$CustomTitle18;  
    $newcustomtitle19=$CustomTitle19;  
    $newcustomtitle20=$CustomTitle20;  
    $newcustomtitle21=$CustomTitle21;  
    $newcustomtitle22=$CustomTitle22;  
    $newcustomtitle23=$CustomTitle23;  
    $newcustomtitle24=$CustomTitle24;  
    $newcustomtitle25=$CustomTitle25;  
    $newcustomtitle26=$CustomTitle26;  
    $newcustomtitle27=$CustomTitle27;  
    $newcustomtitle28=$CustomTitle28;  
    $newcustomtitle29=$CustomTitle29;  
    $newcustomtitle30=$CustomTitle30;  
    $newcustomtitle31=$CustomTitle31;  
    $newcustomtitle32=$CustomTitle32;  
    $newcustomtitle33=$CustomTitle33;  
    $newcustomtitle34=$CustomTitle34;  
    $newcustomtitle35=$CustomTitle35;  
    $newcustomtitle36=$CustomTitle36;  
    $newcustomtitle37=$CustomTitle37;  
    $newcustomtitle38=$CustomTitle38;  
    $newcustomtitle39=$CustomTitle39;  
    $newcustomtitle40=$CustomTitle40;  
    $newcustomtitle41=$CustomTitle41;  
    $newcustomtitle42=$CustomTitle42;  
    $newcustomtitle43=$CustomTitle43;  
    $newcustomtitle44=$CustomTitle44;  
    $newcustomtitle45=$CustomTitle45;  
    $newcustomtitle46=$CustomTitle46;  
    $newcustomtitle47=$CustomTitle47;  
    $newcustomtitle48=$CustomTitle48;  
    $newcustomtitle49=$CustomTitle49;  
    $newcustomtitle50=$CustomTitle50;             
    $newcustom1validate=$Custom1Validate;
    $newcustom2validate=$Custom2Validate;
    $newcustom3validate=$Custom3Validate;
    $newcustom4validate=$Custom4Validate;
    $newcustom5validate=$Custom5Validate;
    $newcustom6validate=$Custom6Validate;
    $newcustom7validate=$Custom7Validate;
    $newcustom8validate=$Custom8Validate;
    $newcustom9validate=$Custom9Validate;
    $newcustom10validate=$Custom10Validate;
    $newcustom11validate=$Custom11Validate;
    $newcustom12validate=$Custom12Validate;
    $newcustom13validate=$Custom13Validate;
    $newcustom14validate=$Custom14Validate;
    $newcustom15validate=$Custom15Validate;
    $newcustom16validate=$Custom16Validate;
    $newcustom17validate=$Custom17Validate;
    $newcustom18validate=$Custom18Validate;
    $newcustom19validate=$Custom19Validate;
    $newcustom20validate=$Custom20Validate;
    $newcustom21validate=$Custom21Validate;
    $newcustom22validate=$Custom22Validate;
    $newcustom23validate=$Custom23Validate;
    $newcustom24validate=$Custom24Validate;
    $newcustom25validate=$Custom25Validate;
    $newcustom26validate=$Custom26Validate;
    $newcustom27validate=$Custom27Validate;
    $newcustom28validate=$Custom28Validate;
    $newcustom29validate=$Custom29Validate;
    $newcustom30validate=$Custom30Validate;
    $newcustom31validate=$Custom31Validate;
    $newcustom32validate=$Custom32Validate;
    $newcustom33validate=$Custom33Validate;
    $newcustom34validate=$Custom34Validate;
    $newcustom35validate=$Custom35Validate;
    $newcustom36validate=$Custom36Validate;
    $newcustom37validate=$Custom37Validate;
    $newcustom38validate=$Custom38Validate;
    $newcustom39validate=$Custom39Validate;
    $newcustom40validate=$Custom40Validate;
    $newcustom41validate=$Custom41Validate;
    $newcustom42validate=$Custom42Validate;
    $newcustom43validate=$Custom43Validate;
    $newcustom44validate=$Custom44Validate;
    $newcustom45validate=$Custom45Validate;
    $newcustom46validate=$Custom46Validate;
    $newcustom47validate=$Custom47Validate;
    $newcustom48validate=$Custom48Validate;
    $newcustom49validate=$Custom49Validate;
    $newcustom50validate=$Custom50Validate;
    $newemailtype=$EmailType;             
    $newemailusername=$EmailUsername;             
    $newemailpassword=$EmailPassword;             
    $newemailserver=$EmailServer; 
    $newemailport=$EmailPort; 
    $newemailauth=$EmailAuth;
    $newemailserversecurity=$EmailServerSecurity;
    $newemaildelay=$EmailDelay;
    $newdbupdate=$DBupdate;
    $newallowsearchengine=$AllowSearchEngine;
    $newsearchenginegroup=$SearchEngineGroup;
  }
  $problem=false;
  $newsitenameproblem="";
  $newsiteemailproblem="";
  $newsitekeyproblem="";
  $newlogoutpageproblem="";
  $newsiteloklocationproblem="";
  $newsiteloklocationurlproblem="";
  $newemaillocationproblem="";
  $newemailurlproblem="";
  $newbackuplocationproblem="";
  $newfilelocationproblem="";
  $newfilelocationsproblem="";
  $newsiteloklogproblem="";
  $newmaxsessiontimeproblem="";
  $newmaxinactivitytimeproblem="";
  $newlogintemplateproblem="";
  $newnoaccesspageproblem="";
  $newexpiredpageproblem="";
  $newwronggrouppageproblem="";
  $newmessagetemplateproblem="";
  $newrandompasswordmaskproblem="";
  $newmd5passwordsproblem="";
  $newemailusernameproblem="";
  $newemailpasswordproblem="";
  $newemailserverproblem="";
  $newemailportproblem="";
  $newsearchenginegroupproblem="";
  if ($editconfigact=="save")
  {
    if ($slcsrf!=$_SESSION['ses_slcsrf'])
    {
      print "Form tampering detected";
      exit;
    }     
    $newsearchenginegroup=str_replace(" ","",$newsearchenginegroup);
    // Check newsitename is not blank
    if ($newsitename=="")
    {
      $problem=true;
      $newsitenameproblem="Enter a site name (e.g. My Members Area)";
    }  
    // Check newsiteemail is valid email address
    if (!sl_validate_email($newsiteemail))
    {
      $problem=true;
      $newsiteemailproblem="Enter a valid admin email address. The secondary email is optional";
    }
    // Check newsiteemail is valid email address
    if ($newsiteemail2!="")
    {
      if (!sl_validate_email($newsiteemail2))
      {
        $problem=true;
        $newsiteemailproblem="Enter a valid admin email address. The secondary email is optional";
      }
    }
    // Check newlogoutpage is not blank
    if ($newlogoutpage=="")
    {
      $problem=true;
      $newlogoutpageproblem="Enter a logout page URL (e.g. http://www.yoursite.com/logout.html)";
    }  
    // Check newsitekey is not blank
    if ($newsitekey=="")
    {
      $problem=true;
      $newsitekeyproblem="Enter a random site key (e.g. fgf73bc6w";
    }  
    // Check newsiteloklocation is not blank and ends in /
    $newsiteloklocation=str_replace("\\","/",$newsiteloklocation);
    if ($newsiteloklocation!="")
    {
      if (substr($newsiteloklocation,strlen($newsiteloklocation)-1,1)!="/")
        $newsiteloklocation.="/";
    }        
    if ($newsiteloklocation=="")
    {
      $problem=true;
      $newsiteloklocationproblem="Enter the full file path to the slpw folder (e.g. /home/public_html/slpw/)";
    }
    else
    {
      if (!is_file($newsiteloklocation."sitelokpw.php"))
      {
        $problem=true;
        $newsiteloklocationproblem="Please verify the path to the slpw folder (e.g. /home/public_html/slpw/)";
      }      
    }
    // Check newsiteloklocationurl is not blank, starts with http and ends in /
    $newsiteloklocationurl=str_replace("\\","/",$newsiteloklocationurl);
    if ($newsiteloklocationurl!="")
    {
      if (substr($newsiteloklocationurl,strlen($newsiteloklocationurl)-1,1)!="/")
        $newsiteloklocationurl.="/";
    }  
    if ((strlen($newsiteloklocationurl)<8) || (substr($newsiteloklocationurl,0,4)!="http"))
    {
      $problem=true;
      $newsiteloklocationurlproblem="Enter the full url to the slpw folder (e.g. http://www.yoursite.com/slpw/)";
    }
    // Check newemaillocation is not blank and ends in /
    $newemaillocation=str_replace("\\","/",$newemaillocation);
    if ($newemaillocation!="")
    {
      if (substr($newemaillocation,strlen($newemaillocation)-1,1)!="/")
        $newemaillocation.="/";
    }    
    if ($newemaillocation=="")
    {
      $problem=true;
      $newemaillocationproblem="Enter the full file path to the email folder (e.g. /home/public_html/slpw/email/)";
    }
    else
    {
      if (!is_dir($newemaillocation))
      {
        $problem=true;
        $newemaillocationproblem="Please verify the path to the email folder (e.g. /home/public_html/slpw/email/)";      
      }
    }    
    // Check newemailurl is not blank, starts with http and ends in /
    $newemailurl=str_replace("\\","/",$newemailurl);
    if ($newemailurl!="")
    {
      if (substr($newemailurl,strlen($newemailurl)-1,1)!="/")
        $newemailurl.="/";
    }    
    if ((strlen($newemailurl)<8) || (substr($newemailurl,0,4)!="http"))
    {
      $problem=true;
      $newemailurlproblem="Enter the full url to the email folder (e.g. http://www.yoursite.com/slpw/email/)";
    }
    // Check newbackuplocation is not blank and ends in /
    $newbackuplocation=str_replace("\\","/",$newbackuplocation);
    if ($newbackuplocation!="")
    {
      if (substr($newbackuplocation,strlen($newbackuplocation)-1,1)!="/")
        $newbackuplocation.="/";
    }    
    if ($newbackuplocation=="")
    {
      $problem=true;
      $newbackuplocationproblem="Enter the full file path to the backup folder (e.g. /home/public_html/slbackups_4567ewge37534ty23/)";
    }
    else
    {
      if (!is_dir($newbackuplocation))
      {
        $problem=true;
        $newbackuplocationproblem="Please verify the path to the backup folder (e.g. /home/public_html/slbackups_4567ewge37534ty23/)";      
      }
    }        
    // Check newfilelocation is not blank and ends in /
    $newfilelocation=str_replace("\\","/",$newfilelocation);
    if ($newfilelocation!="")
    {
      // If not S3 location then make sure last character is /
      if (strtolower(substr($newfilelocation,0,3))!="s3|")
      {
        if (substr($newfilelocation,strlen($newfilelocation)-1,1)!="/")
          $newfilelocation.="/";
      }  
    }
    if ($newfilelocation=="")
    {
      $problem=true;
      $newfilelocationproblem="Enter the full file path to the download file folder (e.g. /home/public_html/rt7f67dfg/)";
    }
    else
    {
      // If not remote location or S3 then check folder exists
      if ((strtolower(substr($newfilelocation,0,3))!="s3|") && (strtolower(substr($newfilelocation,0,7))!="http://"))
      {      
        if (!is_dir($newfilelocation))
        {
          $problem=true;
          $newfilelocationproblem="Please verify the path to the download file folder (e.g. /home/public_html/rt7f67dfg/)";      
        }
      }
    }     
    // Check additional file locations.
    $match=false;
    $missing=false;
    $notfound=false;
    for($k=0;$k<(count($FileLocations)+5);$k++)
    {
      $var1="newfilelocationsname".$k;
      $var2="newfilelocations".$k;
      $$var2=str_replace("\\","/",$$var2);
      if ($$var2!="")
      {
        // If not S3 location then make sure last character is /
        if (strtolower(substr($$var2,0,3))!="s3|")
        {     
          if (substr($$var2,strlen($$var2)-1,1)!="/")
            $$var2.="/";
        }  
      }           
      // Check if name is unique
      for ($j=0;$j<(count($FileLocations)+5);$j++)
      {
        if ($j==$k)
          continue;
        $var3="newfilelocationsname".$j;
        if (($$var1=="") || ($$var3==""))
          continue;
        if ($$var1==$$var3)
          $match=true;  
      }
      // Check that each name has corresponding file location
      if (($$var1!="") && ($$var2==""))
        $missing=true;
      // Check that each file location has corresponding name
      if (($$var2!="") && ($$var1==""))
        $missing=true;
      // If not remote location or S3 then check folder exists
      if ((strtolower(substr($$var2,0,3))!="s3|") && (strtolower(substr($$var2,0,7))!="http://"))
      if ($$var2!="")
      {
        if (!is_dir($$var2))
        {
          $notfound=true;
        }
      }  
    }
    if ($notfound)
    {
      $problem=true;
      $newfilelocationsproblem="Check that the download paths specified below exist";
    }
    if ($$var1=='default')
      $match=true;
    if ($match)
    {
      $problem=true;
      $newfilelocationsproblem="The name assigned to each file location must be unique";
    }
    if ($missing)
    {
      $problem=true;
      $newfilelocationsproblem="Each specified location must have a name and file path";
    }
    // Check newsiteloklog (if not blank) for file access
    if ($newsiteloklog!="")
    { 
      $newsiteloklog=str_replace("\\","/",$newsiteloklog);
      if ((is_writeable($newsiteloklog) == false) || (is_readable($newsiteloklog) == false))
      {
        $problem=true;
        $newsiteloklogproblem="Check that the logfile exists and has read and write permission";
      }        
    }
    // Check newmaxsessiontime is numeric.
    if ($newmaxsessiontime=="")
      $newmaxsessiontime="0";
    if (strspn($newmaxsessiontime, "1234567890") != strlen($newmaxsessiontime))
    {
      $problem=true;
      $newmaxsessiontimeproblem="Enter the maximum session time in minutes (0 for no maximum)";
    }        
    // Check newmaxinactivitytime is numeric.
    if ($newmaxinactivitytime=="")
      $newmaxinactivitytime="0";
    if (strspn($newmaxinactivitytime, "1234567890") != strlen($newmaxinactivitytime))
    {
      $problem=true;
      $newmaxinactivitytimeproblem="Enter the maximum inactivity time in minutes (0 for no maximum)";
    } 
    // Check newlogintemplate exists if set
    if ($newlogintemplate!="")
    { 
      $newlogintemplate=str_replace("\\","/",$newlogintemplate);
      if (is_file($newlogintemplate) == false)
      {
        $problem=true;
        $newlogintemplateproblem="Check that the login template file exists (leave blank for default)";
      }        
    }
/*    
    
    // Check newnoaccesspage
    if ($newnoaccesspage!="")
    { 
      $newnoaccesspage=str_replace("\\","/",$newnoaccesspage);
    }
    // Check newexpiredpage exists if set
    if ($newexpiredpage!="")
    { 
      $newexpiredpage=str_replace("\\","/",$newexpiredpage);
    }
    // Check newwronggrouppage exists if set
    if ($newwronggrouppage!="")
    { 
      $newwronggrouppage=str_replace("\\","/",$newwronggrouppage);
      if (is_file($newwronggrouppage) == false)
      {
        $problem=true;
        $newwronggrouppageproblem="Check that the wrong group template file exists (leave blank for default)";
      }        
    }
*/        
    // Check newmessagetemplate exists if set
    if ($newmessagetemplate!="")
    { 
      $newmessagetemplate=str_replace("\\","/",$newmessagetemplate);
      if (is_file($newmessagetemplate) == false)
      {
        $problem=true;
        $newmessagetemplateproblem="Check that the message template file exists (leave blank for default)";
      }        
    }   
    // Check newrandompasswordmask is valid
    if ($newrandompasswordmask=="")
      $newrandompasswordmask="cccc##";
    if (strspn($newrandompasswordmask, "cCX#AU") != strlen($newrandompasswordmask))
    {
      $problem=true;
      $newrandompasswordmaskproblem="Enter a valid random password mask (leave blank for default)";
    }
    // If MD5 passwords setting has changed check password is correct
    if ((($newmd5passwords=="1") && ($MD5passwords==false)) || (($newmd5passwords=="0") && ($MD5passwords==true)))
    {
      if (($md5passwordsconfirm!=$slpassword) && (md5($md5passwordsconfirm.$SiteKey)!=$slpassword))
      {
        $problem=true;
        $newmd5passwordsproblem="Enter the current admin user password to change this setting"; 
        $newmd5passwords=$MD5passwords;       
      }
    }
    // Check that email settings are provided for PHPmailer otherwise clear them
    if ($newemailtype==1)
    {
      if ($newemailusername=="")
      {
        $problem=true;
        $newemailusernameproblem="Enter the email account username";
      }
      if ($newemailpassword=="")
      {
        $problem=true;
        $newemailpasswordproblem="Enter the email account password";
      }
      if ($newemailserver=="")
      {
        $problem=true;
        $newemailserverproblem="Enter the email account SMTP server address";       
      }
      if ($newemailport=="")
      {
        $problem=true;
        $newemailportproblem="Enter the email account SMTP port (25 is usual)";       
      }
    }
    else
    {
      $newemailusername="";
      $newemailpassword="";
      $newemailserver="";
      $newemailport="";
      $newemailauth="0";
      $newemailserversecurity="";
    }
    if ($newallowsearchengine==1)
    {
      if (($newsearchenginegroup=="") || (strspn($newsearchenginegroup, ",#{}()@.|0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") != strlen($newsearchenginegroup)))
      {
        $problem=true;
        $newsearchenginegroupproblem="Enter the usergroup (separated by commas if more than 1) for the search engine (for example ALL)";                       
      }    
    }
    // Convert column order variables
    $newcolumnorder="";
    for ($c=1;$c<=60;$c++)
    {
      if ($c<10) $val="0".$c; else $val=$c;
      if ($newactioncolumn==$val) $newcolumnorder.="AC";
      if ($newselectedcolumn==$val) $newcolumnorder.="SL";
      if ($newcreatedcolumn==$val) $newcolumnorder.="CR";
      if ($newusernamecolumn==$val) $newcolumnorder.="US";
      if ($newpasswordcolumn==$val) $newcolumnorder.="PW";
      if ($newenabledcolumn==$val) $newcolumnorder.="EN";
      if ($newnamecolumn==$val) $newcolumnorder.="NM";
      if ($newemailcolumn==$val) $newcolumnorder.="EM";
      if ($newusergroupscolumn==$val) $newcolumnorder.="UG";
      if ($newuseridcolumn==$val) $newcolumnorder.="ID";
      for($k=1;$k<=50;$k++)
      {
        $var="newcustom".$k."column";
        if ($k<10) $val2="0".$k; else $val2=$k;
        if ($$var==$val) $newcolumnorder.=$val2;
      }
    }  
    if ((!$problem) && (!$DemoMode))
    {
      $mysql_link=sl_DBconnect();
      if ($mysql_link==false)
      {
        print("Can't connect to MySQL server");
        exit;
      }
      // Save settings to table and set current settings
      $Query = "UPDATE " . $DbConfigTableName . " SET ";
      $Query.="sitename=".sl_quote_smart($newsitename).",";
      $Query.="siteemail=".sl_quote_smart($newsiteemail).",";
      $Query.="siteemail2=".sl_quote_smart($newsiteemail2).",";
      $Query.="dateformat=".sl_quote_smart($newdateformat).",";
      $Query.="logoutpage=".sl_quote_smart($newlogoutpage).",";
      $Query.="siteloklocation=".sl_quote_smart($newsiteloklocation).",";
      $Query.="siteloklocationurl=".sl_quote_smart($newsiteloklocationurl).",";
      $Query.="emaillocation=".sl_quote_smart($newemaillocation).",";
      $Query.="emailurl=".sl_quote_smart($newemailurl).",";
      $newfilelocation=str_replace("|",";",$newfilelocation);
      $temp="default=".$newfilelocation;
      for($k=0;$k<(count($FileLocations)+5);$k++)
      {
        $var1="newfilelocationsname".$k;
        $var2="newfilelocations".$k;
        // Convert | character splitting S3 location to ; as |is used internally already
        $$var2=str_replace("|",";",$$var2);
        if (($$var1!="") && ($$var2!=""))
        {
          $temp.="|".$$var1."=".$$var2;  
        }
      }
      $Query.="filelocation=".sl_quote_smart($temp).",";
      $Query.="siteloklog=".sl_quote_smart($newsiteloklog).",";
            $newlogdetails="";
      if ($newlogentry1=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry2=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry3=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry4=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry5=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry6=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry7=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry8=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      if ($newlogentry9=="on")
        $newlogdetails.="Y";
      else
        $newlogdetails.="N";
      $newlogdetails.="YYYYYYY";          
      $Query.="logdetails=".sl_quote_smart($newlogdetails).",";
      $Query.="sitekey=".sl_quote_smart($newsitekey).",";
      $Query.="logintype=".sl_quote_smart($newlogintype).",";
      $Query.="turinglogin=".$newturinglogin.",";
      $Query.="turingregister=".$newturingregister.",";
      $Query.="maxsessiontime=".$newmaxsessiontime.",";
      $Query.="maxinactivitytime=".$newmaxinactivitytime.",";
      $Query.="cookielogin=".$newcookielogin.",";
      $Query.="logintemplate=".sl_quote_smart($newlogintemplate).",";
      $Query.="expiredpage=".sl_quote_smart($newexpiredpage).",";
      $Query.="wronggrouppage=".sl_quote_smart($newwronggrouppage).",";
      $Query.="messagetemplate=".sl_quote_smart($newmessagetemplate).",";
      $Query.="forgottenemail=".sl_quote_smart($newforgottenemail).",";
      $Query.="showrows=".$newshowrows.",";
      $Query.="actionitems=".$newactionitems.",";
      $Query.="randompasswordmask=".sl_quote_smart($newrandompasswordmask).",";
      $Query.="md5passwords=".$newmd5passwords.",";
      $Query.="concurrentlogin=".$newconcurrentlogin.",";
      $Query.="customtitle1=".sl_quote_smart($newcustomtitle1).",";
      $Query.="customtitle2=".sl_quote_smart($newcustomtitle2).",";
      $Query.="customtitle3=".sl_quote_smart($newcustomtitle3).",";
      $Query.="customtitle4=".sl_quote_smart($newcustomtitle4).",";
      $Query.="customtitle5=".sl_quote_smart($newcustomtitle5).",";
      $Query.="customtitle6=".sl_quote_smart($newcustomtitle6).",";
      $Query.="customtitle7=".sl_quote_smart($newcustomtitle7).",";
      $Query.="customtitle8=".sl_quote_smart($newcustomtitle8).",";
      $Query.="customtitle9=".sl_quote_smart($newcustomtitle9).",";
      $Query.="customtitle10=".sl_quote_smart($newcustomtitle10).",";
      $Query.="customtitle11=".sl_quote_smart($newcustomtitle11).",";
      $Query.="customtitle12=".sl_quote_smart($newcustomtitle12).",";
      $Query.="customtitle13=".sl_quote_smart($newcustomtitle13).",";
      $Query.="customtitle14=".sl_quote_smart($newcustomtitle14).",";
      $Query.="customtitle15=".sl_quote_smart($newcustomtitle15).",";
      $Query.="customtitle16=".sl_quote_smart($newcustomtitle16).",";
      $Query.="customtitle17=".sl_quote_smart($newcustomtitle17).",";
      $Query.="customtitle18=".sl_quote_smart($newcustomtitle18).",";
      $Query.="customtitle19=".sl_quote_smart($newcustomtitle19).",";
      $Query.="customtitle20=".sl_quote_smart($newcustomtitle20).",";
      $Query.="customtitle21=".sl_quote_smart($newcustomtitle21).",";
      $Query.="customtitle22=".sl_quote_smart($newcustomtitle22).",";
      $Query.="customtitle23=".sl_quote_smart($newcustomtitle23).",";
      $Query.="customtitle24=".sl_quote_smart($newcustomtitle24).",";
      $Query.="customtitle25=".sl_quote_smart($newcustomtitle25).",";
      $Query.="customtitle26=".sl_quote_smart($newcustomtitle26).",";
      $Query.="customtitle27=".sl_quote_smart($newcustomtitle27).",";
      $Query.="customtitle28=".sl_quote_smart($newcustomtitle28).",";
      $Query.="customtitle29=".sl_quote_smart($newcustomtitle29).",";
      $Query.="customtitle30=".sl_quote_smart($newcustomtitle30).",";
      $Query.="customtitle31=".sl_quote_smart($newcustomtitle31).",";
      $Query.="customtitle32=".sl_quote_smart($newcustomtitle32).",";
      $Query.="customtitle33=".sl_quote_smart($newcustomtitle33).",";
      $Query.="customtitle34=".sl_quote_smart($newcustomtitle34).",";
      $Query.="customtitle35=".sl_quote_smart($newcustomtitle35).",";
      $Query.="customtitle36=".sl_quote_smart($newcustomtitle36).",";
      $Query.="customtitle37=".sl_quote_smart($newcustomtitle37).",";
      $Query.="customtitle38=".sl_quote_smart($newcustomtitle38).",";
      $Query.="customtitle39=".sl_quote_smart($newcustomtitle39).",";
      $Query.="customtitle40=".sl_quote_smart($newcustomtitle40).",";
      $Query.="customtitle41=".sl_quote_smart($newcustomtitle41).",";
      $Query.="customtitle42=".sl_quote_smart($newcustomtitle42).",";
      $Query.="customtitle43=".sl_quote_smart($newcustomtitle43).",";
      $Query.="customtitle44=".sl_quote_smart($newcustomtitle44).",";
      $Query.="customtitle45=".sl_quote_smart($newcustomtitle45).",";
      $Query.="customtitle46=".sl_quote_smart($newcustomtitle46).",";
      $Query.="customtitle47=".sl_quote_smart($newcustomtitle47).",";
      $Query.="customtitle48=".sl_quote_smart($newcustomtitle48).",";
      $Query.="customtitle49=".sl_quote_smart($newcustomtitle49).",";
      $Query.="customtitle50=".sl_quote_smart($newcustomtitle50).",";
      $Query.="custom1validate=".sl_quote_smart($newcustom1validate).",";
      $Query.="custom2validate=".sl_quote_smart($newcustom2validate).",";
      $Query.="custom3validate=".sl_quote_smart($newcustom3validate).",";
      $Query.="custom4validate=".sl_quote_smart($newcustom4validate).",";
      $Query.="custom5validate=".sl_quote_smart($newcustom5validate).",";
      $Query.="custom6validate=".sl_quote_smart($newcustom6validate).",";
      $Query.="custom7validate=".sl_quote_smart($newcustom7validate).",";
      $Query.="custom8validate=".sl_quote_smart($newcustom8validate).",";
      $Query.="custom9validate=".sl_quote_smart($newcustom9validate).",";
      $Query.="custom10validate=".sl_quote_smart($newcustom10validate).",";
      $Query.="custom11validate=".sl_quote_smart($newcustom11validate).",";
      $Query.="custom12validate=".sl_quote_smart($newcustom12validate).",";
      $Query.="custom13validate=".sl_quote_smart($newcustom13validate).",";
      $Query.="custom14validate=".sl_quote_smart($newcustom14validate).",";
      $Query.="custom15validate=".sl_quote_smart($newcustom15validate).",";
      $Query.="custom16validate=".sl_quote_smart($newcustom16validate).",";
      $Query.="custom17validate=".sl_quote_smart($newcustom17validate).",";
      $Query.="custom18validate=".sl_quote_smart($newcustom18validate).",";
      $Query.="custom19validate=".sl_quote_smart($newcustom19validate).",";
      $Query.="custom20validate=".sl_quote_smart($newcustom20validate).",";
      $Query.="custom21validate=".sl_quote_smart($newcustom21validate).",";
      $Query.="custom22validate=".sl_quote_smart($newcustom22validate).",";
      $Query.="custom23validate=".sl_quote_smart($newcustom23validate).",";
      $Query.="custom24validate=".sl_quote_smart($newcustom24validate).",";
      $Query.="custom25validate=".sl_quote_smart($newcustom25validate).",";
      $Query.="custom26validate=".sl_quote_smart($newcustom26validate).",";
      $Query.="custom27validate=".sl_quote_smart($newcustom27validate).",";
      $Query.="custom28validate=".sl_quote_smart($newcustom28validate).",";
      $Query.="custom29validate=".sl_quote_smart($newcustom29validate).",";
      $Query.="custom30validate=".sl_quote_smart($newcustom30validate).",";
      $Query.="custom31validate=".sl_quote_smart($newcustom31validate).",";
      $Query.="custom32validate=".sl_quote_smart($newcustom32validate).",";
      $Query.="custom33validate=".sl_quote_smart($newcustom33validate).",";
      $Query.="custom34validate=".sl_quote_smart($newcustom34validate).",";
      $Query.="custom35validate=".sl_quote_smart($newcustom35validate).",";
      $Query.="custom36validate=".sl_quote_smart($newcustom36validate).",";
      $Query.="custom37validate=".sl_quote_smart($newcustom37validate).",";
      $Query.="custom38validate=".sl_quote_smart($newcustom38validate).",";
      $Query.="custom39validate=".sl_quote_smart($newcustom39validate).",";
      $Query.="custom40validate=".sl_quote_smart($newcustom40validate).",";
      $Query.="custom41validate=".sl_quote_smart($newcustom41validate).",";
      $Query.="custom42validate=".sl_quote_smart($newcustom42validate).",";
      $Query.="custom43validate=".sl_quote_smart($newcustom43validate).",";
      $Query.="custom44validate=".sl_quote_smart($newcustom44validate).",";
      $Query.="custom45validate=".sl_quote_smart($newcustom45validate).",";
      $Query.="custom46validate=".sl_quote_smart($newcustom46validate).",";
      $Query.="custom47validate=".sl_quote_smart($newcustom47validate).",";
      $Query.="custom48validate=".sl_quote_smart($newcustom48validate).",";
      $Query.="custom49validate=".sl_quote_smart($newcustom49validate).",";
      $Query.="custom50validate=".sl_quote_smart($newcustom50validate).",";
      $Query.="emailtype=".$newemailtype.",";
      $Query.="emailusername=".sl_quote_smart($newemailusername).",";
      $Query.="emailpassword=".sl_quote_smart($newemailpassword).",";
      $Query.="emailserver=".sl_quote_smart($newemailserver).",";
      $Query.="emailport=".sl_quote_smart($newemailport).",";
      $Query.="emailauth=".$newemailauth.",";
      $Query.="emailserversecurity=".sl_quote_smart($newemailserversecurity).",";
      $Query.="emaildelay=".$newemaildelay.",";      
      $Query.="noaccesspage=".sl_quote_smart($newnoaccesspage).",";
      $Query.="dbupdate=".$newdbupdate.",";
      $Query.="allowsearchengine=".$newallowsearchengine.",";
      $Query.="searchenginegroup=".sl_quote_smart($newsearchenginegroup).",";
      $Query.="profilepassrequired=".sl_quote_smart($newprofilepassrequired).",";
      $Query.="emailconfirmrequired=".sl_quote_smart($newemailconfirmrequired).",";
      $Query.="emailconfirmtemplate=".sl_quote_smart($newemailconfirmtemplate).",";
      $Query.="emailunique=".sl_quote_smart($newemailunique).",";
      $Query.="loginwithemail=".sl_quote_smart($newloginwithemail).",";
      $Query.="columnorder=".sl_quote_smart($newcolumnorder).",";      
      $Query.="backuplocation=".sl_quote_smart($newbackuplocation);      
      $Query.=" WHERE confignum=1";
      $mysql_result = mysqli_query($mysql_link,$Query);
      if ($mysql_result==false)
      {
        print mysqli_error($mysql_link);
        print "<br>\n".$Query;
        print "Error writing data to mysql table";
        exit;
      }
      $_SESSION['ses_ConfigReload']="reload";
      // Now see if we need to md5 hash all passwords
      if (($newmd5passwords==1) && ($md5passwordsconfirm==$slpassword) && ($MD5passwords==false))
      {
        $sqlquery="SELECT * FROM ".$DbTableName;
        $mysql_result=mysqli_query($mysql_link,$sqlquery);
        $found=0;
        do
      	{
        	$row=mysqli_fetch_array($mysql_result,MYSQL_ASSOC);
        	if ($row!=false)
        	{
        	  $fus=$row[$UsernameField];
        	  $fpw=$row[$PasswordField];
        	  if (strlen($fpw)!=32)
        	  {      	  
          	  $md5fpw=md5($fpw.$SiteKey);
          	  $query="UPDATE ".$DbTableName." SET ".$PasswordField."=".sl_quote_smart($md5fpw)." WHERE ".$UsernameField."=".sl_quote_smart($fus);
         	  mysqli_query($mysql_link,$query);
        	  }
        	}
        }
        while (($row!=false));
      } 
      header("Location: index.php");
      exit;     
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
<title>Sitelok Configuration</title>
<script  type="text/javascript">
<!--
function Save_Config(form)
{
  // Try and validate entries as far as we can in Javascript
  if (form.newsitename.value=="")
  {
     alert("Please enter a name for the membership area")
     form.newsitename.focus()
     return (false)
  }
  if (validateemail(form.newsiteemail.value)==false)
  {
    alert("Please enter a valid admin email address")
    form.newsiteemail.focus()
    return (false);
  }
  if (form.newsiteemail2.value!="")
  {  
    if (validateemail(form.newsiteemail2.value)==false)
    {
      alert("Please enter a valid secondary admin email address or leave blank")
      form.newsiteemail2.focus()
      return (false);
    }
  }  
  if (form.newlogoutpage.value=="")
  {
     alert("Please enter a logout page")
     form.newlogoutpage.focus()
     return (false)
  }
  if (form.newsitekey.value=="")
  {
     alert("Please enter random Site Key value")
     form.newsitekey.focus()
     return (false)
  }
  if (form.newsiteloklocation.value=="")
  {
     alert("Please enter the full file path to the Sitelok folder")
     form.newsiteloklocation.focus()
     return (false)
  }
  if (form.newsiteloklocationurl.value=="")
  {
     alert("Please enter the full URL to the Sitelok folder")
     form.newsiteloklocationurl.focus()
     return (false)
  }
  if (form.newemaillocation.value=="")
  {
     alert("Please enter the full file path to the email folder")
     form.newemaillocation.focus()
     return (false)
  }
  if (form.newemailurl.value=="")
  {
     alert("Please enter the full URL to the email folder")
     form.newemailurl.focus()
     return (false)
  }
  if (form.newfilelocation.value=="")
  {
     alert("Please enter the full file path to the download files folder")
     form.newfilelocation.focus()
     return (false)
  }
  if (form.newmaxsessiontime.value=="")
  {
     alert("Please enter the maximum session time (0 for unlimited)")
     form.newmaxsessiontime.focus()
     return (false)
  }
  if (form.newmaxinactivitytime.value=="")
  {
     alert("Please enter the maximum inactivity time (0 for unlimited)")
     form.newmaxinactivitytime.focus()
     return (false)
  }
  <?php
  if ($MD5passwords==true)
    echo "var md5setting=true\n";
  else
    echo "var md5setting=false\n";   
  ?>
  if ((md5setting==false) && (form.newmd5passwords.value=="1") && (form.md5passwordsconfirm.value!=""))
  {
     if (!confirm("Are you sure you want to MD5 hash all passwords irreversibly?"))
     {
       return (false)
     }
  }  
  if ((md5setting==true) && (form.newmd5passwords.value=="0") && (form.md5passwordsconfirm.value!=""))
  {
     if (!confirm("Are you sure you want to change the MD5 passwords setting?"))
     {
       return (false)
     }
  }  
  if (form.newemailtype.value=="1")
  {
     if (form.newemailusername.value=="")
     {
       alert("Please enter the email account username")
       form.newemailusername.focus()
       return (false)
     }
     if (form.newemailpassword.value=="")
     {
       alert("Please enter the email account password")
       form.newemailpassword.focus()
       return (false)
     }
     if (form.newemailserver.value=="")
     {
       alert("Please enter the email account SMTP server address")
       form.newemailserver.focus()
       return (false)
     }
     if (form.newemailport.value=="")
     {
       alert("Please enter the email account SMTP server port (25 is usual)")
       form.newemailport.focus()
       return (false)
     }
  }
  if (form.newallowsearchengine.value=="1")
  {
     if (form.newsearchenginegroup.value=="")
     {
       alert("Please enter search engine group (e.g. ALL)")
       form.newsearchenginegroup.focus()
       return (false)
     }
  }    
  form.action="editconfig.php"
  form.editconfigact.value="save"
  form.submit()
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

function searchEngineAccess()
{
  var sel= document.getElementById("newallowsearchengine")
  var txt= document.getElementById("newsearchenginegroup")
  if (sel.value=="1")
  {
    txt.disabled=false
    txt.className = txt.className.replace(/\binputdisabled\b/,'')
    txt.focus()   
  }  
  else
  {
    txt.disabled=true
    if (txt.className.indexOf("inputdisabled",0)==-1)        
      txt.className += " inputdisabled"
  }  
}

function md5Passwords()
{
  var sel= document.getElementById("newmd5passwords")
  var txt= document.getElementById("md5passwordsconfirm")
  txt.disabled=false
  txt.className = txt.className.replace(/\binputdisabled\b/,'')
  txt.focus()   
}

function emailSettings()
{
  var sel= document.getElementById("newemailtype")
  var txt1= document.getElementById("newemailusername")
  var txt2= document.getElementById("newemailpassword")
  var txt3= document.getElementById("newemailserver")
  var txt4= document.getElementById("newemailport")
  var txt5= document.getElementById("newemailauth")
  var txt6= document.getElementById("newemailserversecurity")
  if (sel.value=="1")
  {
    txt1.disabled=false
    txt2.disabled=false
    txt3.disabled=false
    txt4.disabled=false
    txt5.disabled=false
    txt6.disabled=false
    txt1.className = txt1.className.replace(/\binputdisabled\b/,'')
    txt2.className = txt2.className.replace(/\binputdisabled\b/,'')
    txt3.className = txt3.className.replace(/\binputdisabled\b/,'')
    txt4.className = txt4.className.replace(/\binputdisabled\b/,'')
    txt5.className = txt5.className.replace(/\bselectdisabled\b/,'')
    txt6.className = txt6.className.replace(/\bselectdisabled\b/,'')
    txt1.focus()   
  }  
  else
  {
    txt1.disabled=true
    txt2.disabled=true
    txt3.disabled=true
    txt4.disabled=true
    txt5.disabled=true
    txt6.disabled=true
    if (txt1.className.indexOf("inputdisabled",0)==-1)        
      txt1.className += " inputdisabled"
    if (txt2.className.indexOf("inputdisabled",0)==-1)        
      txt2.className += " inputdisabled"
    if (txt3.className.indexOf("inputdisabled",0)==-1)        
      txt3.className += " inputdisabled"
    if (txt4.className.indexOf("inputdisabled",0)==-1)        
      txt4.className += " inputdisabled"
    if (txt5.className.indexOf("selectdisabled",0)==-1)        
      txt5.className += " selectdisabled"
    if (txt6.className.indexOf("selectdisabled",0)==-1)        
      txt6.className += " selectdisabled"
  }  
}

function emailverifyclicked()
{
  var sel=document.getElementById("newemailconfirmrequired")
  var template = document.getElementById("newemailconfirmtemplate")
  if (sel.value=="1")
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

// -->
</script>
</head>
<body>
<?php include "headeradminother.php"; ?>
<h1>Sitelok Configuration V<?php echo $SitelokVersion; ?></h1>
<div class="editconfig">
<?php if ($problem) { ?>
<p class="formerror">There were errors found. Please correct the error(s) highlighted below</p>
<?php } ?>
<form name="form1" action="editconfig.php" method="POST" onSubmit="validate(this.form);">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<input name="editconfigact" type="hidden" value="">

<fieldset>
<legend>General Settings</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newsitename">Site name</label>
<input class="inputtext<?php if ($newsitenameproblem!="") echo " errorfield"; ?>" type="text" name="newsitename" id="newsitename" maxlength="255" value="<?php echo $newsitename; ?>">
<?php if ($newsitenameproblem!="") { ?><p class="textfielderror"><?php echo $newsitenameproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsiteemail">Admin email</label>
<input class="inputtext<?php if ($newsiteemailproblem!="") echo " errorfield"; ?>" type="text" name="newsiteemail" id="newsiteemail" maxlength="255" value="<?php echo $newsiteemail; ?>">
<?php if ($newsiteemailproblem!="") { ?><p class="textfielderror"><?php echo $newsiteemailproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsiteemail2">Admin email (secondary)</label>
<input class="inputtext<?php if ($newsiteemail2problem!="") echo " errorfield"; ?>" type="text" name="newsiteemail2" id="newsiteemail2" maxlength="255" value="<?php echo $newsiteemail2; ?>">
<span class="cbfieldnote">optional</span>
<?php if ($newsiteemail2problem!="") { ?><p class="textfielderror"><?php echo $newsiteemail2problem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newdateformat">Date format</label>
<select name="newdateformat" id="newdateformat" size="1">
<option value="DDMMYY" <?php if ($DateFormat=="DDMMYY") print "selected=\"selected\"";?>>DDMMYY</option>
<option value="MMDDYY" <?php if ($DateFormat=="MMDDYY") print "selected=\"selected\"";?>>MMDDYY</option>
</select>
<span class="cbfieldnote">don't change after setup</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsitekey">Site Key</label>
<input class="inputtext<?php if ($newsitekeyproblem!="") echo " errorfield"; ?>" type="text" name="newsitekey" id="newsitekey" maxlength="255" value="<?php echo $newsitekey; ?>">
<span class="cbfieldnote">don't change after setup</span>
<?php if ($newsitekeyproblem!="") { ?><p class="textfielderror"><?php echo $newsitekeyproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newmaxsessiontime">Maximum session time</label>
<input class="inputtext short<?php if ($newmaxsessiontimeproblem!="") echo " errorfield"; ?>" type="text" name="newmaxsessiontime" id="newmaxsessiontime" maxlength="255" value="<?php echo $newmaxsessiontime; ?>">
<span class="cbfieldnote">seconds (0 for unlimited)</span>
<?php if ($newmaxsessiontimeproblem!="") { ?><p class="textfielderror"><?php echo $newmaxsessiontimeproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newmaxinactivitytime">Maximum inactivity time</label>
<input class="inputtext short<?php if ($newmaxinactivitytimeproblem!="") echo " errorfield"; ?>" type="text" name="newmaxinactivitytime" id="newmaxinactivitytime" maxlength="255" value="<?php echo $newmaxinactivitytime; ?>">
<span class="cbfieldnote">seconds (0 for unlimited)</span>
<?php if ($newmaxinactivitytimeproblem!="") { ?><p class="textfielderror"><?php echo $newmaxinactivitytimeproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newturinglogin">Login CAPTCHA</label>
<select name="newturinglogin" id="newturinglogin" size="1">
<option value="0" <?php if ($newturinglogin=="0") print "selected=\"selected\""; ?>>Disabled</option>
<option value="1" <?php if ($newturinglogin=="1") print "selected=\"selected\""; ?>>Enabled</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newturingregister">Register CAPTCHA</label>
<select name="newturingregister" id="newturingregister" size="1">
<option value="0" <?php if ($newturingregister=="0") print "selected=\"selected\"";?>>Disabled</option>
<option value="1" <?php if ($newturingregister=="1") print "selected=\"selected\"";?>>Enabled</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newcookielogin">Remember me (cookie login)</label>
<select name="newcookielogin" id="newcookielogin" size="1">
<option value="0" <?php if ($newcookielogin=="0") print "selected=\"selected\"";?>>Disabled</option>
<option value="1" <?php if ($newcookielogin=="1") print "selected=\"selected\"";?>>Remember Me</option>
<option value="2" <?php if ($newcookielogin=="2") print "selected=\"selected\"";?>>Auto Login</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newforgottenemail">Forgotten password email</label>
<select name="newforgottenemail" id="newforgottenemail" size="1">
<option value="" <?php if ($newforgottenemail=="") print "selected";?>>Default built in</option>
<?php
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
        if ($newforgottenemail==$entryname) print "selected=\"selected\"";
          print">$entryname</option>\n";
      }  
    }
  }
}
?>    
</select>
<span class="cbfieldnote">select template to use</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newrandompasswordmask">Random password mask</label>
<input class="inputtext short<?php if ($newrandompasswordmaskproblem!="") echo " errorfield"; ?>" type="text" name="newrandompasswordmask" id="newrandompasswordmask" maxlength="255" value="<?php echo $newrandompasswordmask; ?>">
<span class="cbfieldnote">e.g. cccc##</span>
<?php if ($newrandompasswordmaskproblem!="") { ?><p class="textfielderror"><?php echo $newrandompasswordmaskproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newconcurrentlogin">Allow concurrent logins</label>
<select name="newconcurrentlogin" id="newconcurrentlogin" size="1">
<option value="0" <?php if ($newconcurrentlogin=="0") print "selected=\"selected\"";?>>No</option>
<option value="1" <?php if ($newconcurrentlogin=="1") print "selected=\"selected\"";?>>Yes</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newdbupdate">Force database read</label>
<select name="newdbupdate" id="newdbupdate" size="1">
<option value="0" <?php if ($newdbupdate=="0") print "selected=\"selected\"";?>>Disabled</option>
<option value="1" <?php if ($newdbupdate=="1") print "selected=\"selected\"";?>>Enabled</option>
</select>
<span class="cbfieldnote">forces DB update on each page access</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newallowsearchengine">Allow search engine access</label>
<select name="newallowsearchengine" id="newallowsearchengine" size="1" onchange="searchEngineAccess();">
<option value="0" <?php if ($newallowsearchengine=="0") print "selected=\"selected\"";?>>No</option>
<option value="1" <?php if ($newallowsearchengine=="1") print "selected=\"selected\"";?>>Yes</option>
</select>
<span class="cbfieldnote">setting yes allows some search engine to access protected pages</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsearchenginegroup">Search engine usergroup</label>
<input class="inputtext short<?php if ($newsearchenginegroupproblem!="") echo " errorfield"; ?>" type="text" name="newsearchenginegroup" id="newsearchenginegroup" maxlength="255" value="<?php echo $newsearchenginegroup; ?>">
<span class="cbfieldnote">this is the usergroup the search engine will access as</span>
<?php if ($newsearchenginegroupproblem!="") { ?><p class="textfielderror"><?php echo $newsearchenginegroupproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogintype">Login type</label>
<select name="newlogintype" id="newlogintype" size="1">
<option value="NORMAL" <?php if ($newlogintype=="NORMAL") print "selected=\"selected\"";?>>NORMAL</option>
<option value="SECURE" <?php if ($newlogintype=="SECURE") print "selected=\"selected\"";?>>SECURE</option>
</select>
<span class="cbfieldnote">we strongly recommend using the NORMAL setting for all new sites</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newmd5passwords">Store passwords as MD5</label>
<select name="newmd5passwords" id="newmd5passwords" size="1" onchange="md5Passwords();">
<option value="0" <?php if ($newmd5passwords=="0") print "selected";?>>No</option>
<option value="1" <?php if ($newmd5passwords=="1") print "selected";?>>Yes (see warning)</option>
</select>
<span class="cbfieldnote">WARNING. This will irreversibly hash all users passwords.</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="md5passwordsconfirm">&nbsp;</label>
<input class="inputtext short<?php if ($newmd5passwordsproblem!="") echo " errorfield"; ?> inputdisabled" disabled="disabled" type="password" name="md5passwordsconfirm" id="md5passwordsconfirm" maxlength="50">
<span class="cbfieldnote">enter admin password to change the MD5 passwords setting</span>
<?php if ($newmd5passwordsproblem!="") { ?><p class="textfielderror"><?php echo $newmd5passwordsproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newprofilepassrequired">Profile update password required</label>
<select name="newprofilepassrequired" id="newprofilepassrequired" size="1">
<option value="0" <?php if ($newprofilepassrequired=="0") print "selected";?>>Not required</option>
<option value="1" <?php if ($newprofilepassrequired=="1") print "selected";?>>Required for any changes</option>
<option value="2" <?php if ($newprofilepassrequired=="2") print "selected";?>>Required to change password</option>
</select>
<span class="cbfieldnote">Forces user to enter existing password to update their profile</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailconfirmrequired">Email change verification</label>
<select name="newemailconfirmrequired" id="newemailconfirmrequired" size="1" onchange="emailverifyclicked();">
<option value="0" <?php if ($newemailconfirmrequired=="0") print "selected=\"selected\"";?>>No</option>
<option value="1" <?php if ($newemailconfirmrequired=="1") print "selected=\"selected\"";?>>Yes</option>
</select>
<span class="cbfieldnote">setting yes requires users to confirm email address changes via emailed link</span>
</div>

<div class="verticalfield"><label class="verticalfield" for="newemailconfirmtemplate"></label>
<select <?php if ($newemailconfirmrequired=="") echo "class=\"selectdisabled\""; ?> name="newemailconfirmtemplate" id="newemailconfirmtemplate" size="1" <?php if ($newemailconfirmrequired!="1") print "disabled=\"disabled\""; ?>>
<option value="">No email (use link in update profile email)</option>
      <?php
				$templatematch=$newemailconfirmtemplate;
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
      ?>
</select>
<span class="cbfieldnote">email to send</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailunique">Email field must be unique</label>
<select name="newemailunique" id="newemailunique" size="1">
<option value="0" <?php if ($newemailunique=="0") print "selected";?>>Not required</option>
<option value="1" <?php if ($newemailunique=="1") print "selected";?>>Required only for user entry</option>
<option value="2" <?php if ($newemailunique=="2") print "selected";?>>Must always be unique</option>
</select>
<span class="cbfieldnote">When enabled email address field must be unique</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newloginwithemail">Login with username or email</label>
<select name="newloginwithemail" id="newloginwithemail" size="1">
<option value="0" <?php if ($newloginwithemaile=="0") print "selected";?>>No</option>
<option value="1" <?php if ($newloginwithemail=="1") print "selected";?>>Yes</option>
</select>
<span class="cbfieldnote">If set to yes user can use either username or email address for login. If no then username only.</span>
</div>

</fieldset>

<fieldset>
<legend>Pages and Templates</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newlogoutpage">Logout page URL</label>
<input class="inputtext long<?php if ($newlogoutpageproblem!="") echo " errorfield"; ?>" type="text" name="newlogoutpage" id="newlogoutpage" maxlength="255" value="<?php echo $newlogoutpage; ?>">
<?php if ($newlogoutpageproblem!="") { ?><p class="textfielderror"><?php echo $newlogoutpageproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newmessagetemplate">Message and error template</label>
<input class="inputtext<?php if ($newmessagetemplateproblem!="") echo " errorfield"; ?>" type="text" name="newmessagetemplate" id="newmessagetemplate" maxlength="255" value="<?php echo $newmessagetemplate; ?>">
<span class="cbfieldnote">enter template name (stored in /slpw) or leave blank for default</span>
<?php if ($newmessagetemplateproblem!="") { ?><p class="textfielderror"><?php echo $newmessagetemplateproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogintemplate">Login template</label>
<input class="inputtext<?php if ($newlogintemplateproblem!="") echo " errorfield"; ?>" type="text" name="newlogintemplate" id="newlogintemplate" maxlength="255" value="<?php echo $newlogintemplate; ?>">
<span class="cbfieldnote">enter template name (stored in /slpw) or leave blank for default</span>
<?php if ($newlogintemplateproblem!="") { ?><p class="textfielderror"><?php echo $newlogintemplateproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newexpiredpage">Expired membership page URL</label>
<input class="inputtext long<?php if ($newexpiredpageproblem!="") echo " errorfield"; ?>" type="text" name="newexpiredpage" id="newexpiredpage" maxlength="255" value="<?php echo $newexpiredpage; ?>">
<?php if ($newexpiredpageproblem!="") { ?><p class="textfielderror"><?php echo $newexpiredpageproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newwronggrouppage">Wrong group page URL</label>
<input class="inputtext long<?php if ($newwronggrouppageproblem!="") echo " errorfield"; ?>" type="text" name="newwronggrouppage" id="newwronggrouppage" maxlength="255" value="<?php echo $newwronggrouppage; ?>">
<?php if ($newwronggrouppageproblem!="") { ?><p class="textfielderror"><?php echo $newwronggrouppageproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newnoaccesspage">No Access Page URL</label>
<input class="inputtext long<?php if ($newnoaccesspageproblem!="") echo " errorfield"; ?>" type="text" name="newnoaccesspage" id="newnoaccesspage" maxlength="255" value="<?php echo $newnoaccesspage; ?>">
<?php if ($newnoaccesspageproblem!="") { ?><p class="textfielderror"><?php echo $newnoaccesspageproblem; ?></p><?php } ?>
</div>

</fieldset>

<fieldset>
<legend>Log Settings</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry1">Login/Logout</label>
<input type="checkbox" name="newlogentry1" id="newlogentry1" class="inputcheckbox" value="on" <?php if ($newlogentry1=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry2">Login problems</label>
<input type="checkbox" name="newlogentry2" id="newlogentry2" class="inputcheckbox" value="on" <?php if ($newlogentry2=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry3">Password requested</label>
<input type="checkbox" name="newlogentry3" id="newlogentry3" class="inputcheckbox" value="on" <?php if ($newlogentry3=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry4">Download</label>
<input type="checkbox" name="newlogentry4" id="newlogentry4" class="inputcheckbox" value="on" <?php if ($newlogentry4=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry5">Download problems</label>
<input type="checkbox" name="newlogentry5" id="newlogentry5" class="inputcheckbox" value="on" <?php if ($newlogentry5=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry6">Email sent</label>
<input type="checkbox" name="newlogentry6" id="newlogentry6" class="inputcheckbox" value="on" <?php if ($newlogentry6=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry7">Membership expired</label>
<input type="checkbox" name="newlogentry7" id="newlogentry7" class="inputcheckbox" value="on" <?php if ($newlogentry7=="on") print "checked=\"checked\""; ?>>
<span class="cbfieldnote">where user attempted to access</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry8">User modified details</label>
<input type="checkbox" name="newlogentry8" id="newlogentry8" class="inputcheckbox" value="on" <?php if ($newlogentry8=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newlogentry9">API function call</label>
<input type="checkbox" name="newlogentry9" id="newlogentry9" class="inputcheckbox" value="on" <?php if ($newlogentry9=="on") print "checked=\"checked\""; ?>>
<span class="cbfieldnote">includes user registration</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsiteloklog">Server path to text format log file</label>
<input class="inputtext long<?php if ($newsiteloklogproblem!="") echo " errorfield"; ?>" type="text" name="newsiteloklog" id="newsiteloklog" maxlength="255" value="<?php echo $newsiteloklog; ?>">
<?php if ($newsiteloklogproblem!="") { ?><p class="textfielderror"><?php echo $newsiteloklogproblem; ?></p><?php } ?>
<p class="textfieldnote">leave blank if not required</p>
</div>

</fieldset>

<fieldset>
<legend>Control Panel Settings</legend>

<div class="blankspace"></div>



<label class="verticalfield" for="newfilelocation">Main table column order</label>

<div class="blankspace"></div>

<div class="horizontalfield"><label class="verticalfield" for="newactioncolumn">Actions</label>
<select style="width: 4.5em;" name="newactioncolumn" id="newactioncolumn" size="1">
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newactioncolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newselectedcolumn">Selected</label>
<select style="width: 4.5em;" name="newselectedcolumn" id="newselectedcolumn" size="1">
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newselectedcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newcreatedcolumn">Created</label>
<select style="width: 4.5em;" name="newcreatedcolumn" id="newcreatedcolumn" size="1">
<option value="00" <?php if ($newcreatedcolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newcreatedcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newusernamecolumn">Username</label>
<select style="width: 4.5em;" name="newusernamecolumn" id="newusernamecolumn" size="1">
<option value="00" <?php if ($newusernamecolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newusernamecolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="verticalfield" for="newpasswordcolumn">Password</label>
<select style="width: 4.5em;" name="newpasswordcolumn" id="newpasswordcolumn" size="1">
<option value="00" <?php if ($newpasswordcolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newpasswordcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newenabledcolumn">Enabled</label>
<select style="width: 4.5em;" name="newenabledcolumn" id="newenabledcolumn" size="1">
<option value="00" <?php if ($newenabledcolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newenabledcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newnamecolumn">Name</label>
<select style="width: 4.5em;" style="width: 4.5em;" name="newnamecolumn" id="newnamecolumn" size="1">
<option value="00" <?php if ($newnamecolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newnamecolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="horizontalfield" for="newemailcolumn">Email</label>
<select style="width: 4.5em;" name="newemailcolumn" id="newemailcolumn" size="1">
<option value="00" <?php if ($newemailcolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newemailcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="horizontalfield"><label class="verticalfield" for="newusergroupscolumn">Usergroups</label>
<select style="width: 4.5em;" name="newusergroupscolumn" id="newusergroupscolumn" size="1">
<option value="00" <?php if ($newusergroupscolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newusergroupscolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<?php for ($c=1; $c<=50;$c++)
{
  $var="newcustom".$c."column";
?>
<div class="horizontalfield"><label class="<?php if ((($c-1) % 4)==3) echo "verticalfield"; else echo "horizontalfield"; ?>" for="<?php echo $var; ?>">Custom <?php echo $c; ?></label>
<select style="width: 4.5em;" name="<?php echo $var; ?>" id="<?php echo $var; ?>" size="1">
<option value="00" <?php if ($$var=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($$var==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>
<?php } ?>

<div class="horizontalfield"><label class="horizontalfield" for="newuseridcolumn">User Id</label>
<select style="width: 4.5em;" name="newuseridcolumn" id="newuseridcolumn" size="1">
<option value="00" <?php if ($newuseridcolumn=="00") print "selected=\"selected\"";?>>Hide</option>
<?php for ($k=1;$k<=60;$k++)
{
  if ($k<10) $val="0".$k; else $val=$k;
?>
<option value="<?php echo $val; ?>" <?php if ($newuseridcolumn==$val) print "selected=\"selected\"";?>><?php echo $k; ?></option>
<?php } ?>
</select>
</div>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newshowrows">Default rows to display</label>
<select name="newshowrows" id="newshowrows" size="1">
<option value="1" <?php if ($newshowrows=="1") print "selected=\"selected\"";?>>1</option>
<option value="5" <?php if ($newshowrows=="5") print "selected=\"selected\"";?>>5</option>
<option value="10" <?php if ($newshowrows=="10") print "selected=\"selected\"";?>>10</option>
<option value="15" <?php if ($newshowrows=="15") print "selected=\"selected\"";?>>15</option>
<option value="20" <?php if ($newshowrows=="20") print "selected=\"selected\"";?>>20</option>
<option value="30" <?php if ($newshowrows=="30") print "selected=\"selected\"";?>>30</option>
<option value="50" <?php if ($newshowrows=="50") print "selected=\"selected\"";?>>50</option>
<option value="100" <?php if ($newshowrows=="100") print "selected=\"selected\"";?>>100</option>
<option value="200" <?php if ($newshowrows=="200") print "selected=\"selected\"";?>>200</option>
<option value="500" <?php if ($newshowrows=="500") print "selected=\"selected\"";?>>500</option>
</select>
<span class="cbfieldnote">this is the default number of rows on the main admin page</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newactionitems">User action field size</label>
<select name="newactionitems" id="newactionitems" size="1">
<option value="0" <?php if ($newactionitems=="0") print "selected=\"selected\"";?>>Small (popup menu only)</option>
<option value="1" <?php if ($newactionitems=="1") print "selected=\"selected\"";?>>Normal (show common actions plus menu for others)</option>
<option value="2" <?php if ($newactionitems=="2") print "selected=\"selected\"";?>>Large (show all action icons)</option>
</select>
<span class="textfieldnote">This adjusts how the action icons next to each user are displayed</span>
</div>





</fieldset>

<fieldset>
<legend>Custom User Fields</legend>

<div class="blankspace"></div>

<?php for ($k=1; $k<=50; $k++)
{
  $var="newcustomtitle".$k;
  $var2="newcustom".$k."validate";
?>  
<div class="verticalfield">
<label class="verticalfield" for="newcustomtitle<?php echo $k; ?>">Custom <?php echo $k; ?></label>

<input class="inputtext" type="text" name="newcustomtitle<?php echo $k; ?>" id="newcustomtitle<?php echo $k; ?>" maxlength="255" value="<?php echo $$var; ?>">
<span class="cbfieldnote">title&nbsp;&nbsp;&nbsp;&nbsp;</span>
<select name="newcustom<?php echo $k; ?>validate" id="newcustom<?php echo $k; ?>validate" size="1">
<option value="0" <?php if ($$var2=="0") print "selected=\"selected\"";?>>No validation</option>
<option value="1" <?php if ($$var2=="1") print "selected=\"selected\"";?>>User entry validation only</option>
<option value="2" <?php if ($$var2=="2") print "selected=\"selected\"";?>>Admin entry validation only</option>
<option value="3" <?php if ($$var2=="3") print "selected=\"selected\"";?>>User and admin entry validation</option>
</select>
<span class="cbfieldnote">validation&nbsp;&nbsp;</span>
</div>
<?php } ?>

</fieldset>

<fieldset>
<legend>Download Locations</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newfilelocation">Full file path to download folder</label>
<input class="inputtext long<?php if ($newfilelocationproblem!="") echo " errorfield"; ?>" type="text" name="newfilelocation" id="newfilelocation" maxlength="255" value="<?php echo $newfilelocation; ?>">
<?php if ($newfilelocationproblem!="") { ?><p class="textfielderror"><?php echo $newfilelocationproblem; ?></p><?php } ?>
</div>

<?php
for ($k=0;$k<(count($FileLocations)+5);$k++)
{
  $var1="newfilelocationsname".$k;
  $var2="newfilelocations".$k;      
?>
<div class="verticalfield">
<?php if (($newfilelocationsproblem!="") && ($k==0)) { ?><p class="textfielderror"><?php echo $newfilelocationsproblem; ?></p><?php } ?>
<label class="verticalfield" for="newfilelocationsname<?php echo $k; ?>"><?php if ($k==0) echo "Additional download locations"; else echo "&nbsp;"; ?></label>
<input class="inputtext short" type="text" name="newfilelocationsname<?php echo $k; ?>" id="newfilelocationsname<?php echo $k; ?>" maxlength="255" value="<?php echo $$var1; ?>">
<span class="cbfieldnote">name&nbsp;&nbsp;</span>
<input class="inputtext medium" type="text" name="newfilelocations<?php echo $k; ?>" id="newfilelocations<?php echo $k; ?>" maxlength="255" value="<?php echo $$var2; ?>">
<span class="cbfieldnote">path</span>
</div>

<?php } ?>

</fieldset>

<fieldset>
<legend>Email Settings</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newemailtype">Send email using</label>
<select name="newemailtype" id="newemailtype" size="1" onchange="emailSettings()">
    <option value="0" <?php if ($newemailtype=="0") print "selected=\"selected\"";?>>PHP Mail() function</option>
    <option value="1" <?php if ($newemailtype=="1") print "selected=\"selected\"";?>>PHPmailer</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailusername">Email account username</label>
<input class="inputtext<?php if ($newemailusernameproblem!="") echo " errorfield"; ?>" type="text" name="newemailusername" id="newemailusername" maxlength="255" value="<?php echo $newemailusername; ?>">
<span class="cbfieldnote">required when sending email using PHPmailer</span>
<?php if ($newemailusernameproblem!="") { ?><p class="textfielderror"><?php echo $newemailusernameproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailpassword">Email account password</label>
<input class="inputtext<?php if ($newemailpasswordproblem!="") echo " errorfield"; ?>" type="text" name="newemailpassword" id="newemailpassword" maxlength="255" value="<?php echo $newemailpassword; ?>">
<span class="cbfieldnote">required when sending email using PHPmailer</span>
<?php if ($newemailpasswordproblem!="") { ?><p class="textfielderror"><?php echo $newemailpasswordproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailserver">Email account smtp server</label>
<input class="inputtext<?php if ($newemailserverproblem!="") echo " errorfield"; ?>" type="text" name="newemailserver" id="newemailserver" maxlength="255" value="<?php echo $newemailserver; ?>">
<span class="cbfieldnote">required when sending email using PHPmailer</span>
<?php if ($newemailserverproblem!="") { ?><p class="textfielderror"><?php echo $newemailserverproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailport">Email account smtp port</label>
<input class="inputtext short<?php if ($newemailportproblem!="") echo " errorfield"; ?>" type="text" name="newemailport" id="newemailport" maxlength="255" value="<?php echo $newemailport; ?>">
<span class="cbfieldnote">required when sending email using PHPmailer</span>
<?php if ($newemailportproblem!="") { ?><p class="textfielderror"><?php echo $newemailportproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailauth">Email authentication</label>
<select <?php if ($newemailtype=="0") echo "class=\"selectdisabled\""; ?> name="newemailauth" id="newemailauth" size="1">
<option value="0" <?php if ($newemailauth=="0") print "selected=\"selected\"";?>>Disabled</option>
<option value="1" <?php if ($newemailauth=="1") print "selected=\"selected\"";?>>Enabled</option>
</select>
<span class="cbfieldnote">required when sending email using PHPmailer</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailserversecurity">Email security</label>
<select name="newemailserversecurity" id="newemailserversecurity" size="1">
<option value="" <?php if ($newemailserversecurity=="") print "selected=\"selected\"";?>>No SSL</option>
<option value="ssl" <?php if ($newemailserversecurity=="ssl") print "selected=\"selected\"";?>>SSL</option>
<option value="tls" <?php if ($newemailserversecurity=="tls") print "selected=\"selected\"";?>>TLS</option>
</select>
<span class="cbfieldnote">required when sending email using PHPmailer</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemaildelay">Delay between bulk emails</label>
<select name="newemaildelay" id="newemaildelay" size="1">
<option value="0" <?php if ($newemaildelay=="0") print "selected=\"selected\"";?>>No Delay</option>
<option value="100" <?php if ($newemaildelay=="100") print "selected=\"selected\"";?>>100ms</option>
<option value="250" <?php if ($newemaildelay=="250") print "selected=\"selected\"";?>>250ms</option>
<option value="500" <?php if ($newemaildelay=="500") print "selected=\"selected\"";?>>500ms</option>
<option value="1000" <?php if ($newemaildelay=="1000") print "selected=\"selected\"";?>>1 Sec</option>
<option value="2000" <?php if ($newemaildelay=="2000") print "selected=\"selected\"";?>>2 Sec</option>
<option value="3000" <?php if ($newemaildelay=="3000") print "selected=\"selected\"";?>>3 Sec</option>
<option value="5000" <?php if ($newemaildelay=="5000") print "selected=\"selected\"";?>>5 Sec</option>
<option value="8000" <?php if ($newemaildelay=="8000") print "selected=\"selected\"";?>>8 Sec</option>
<option value="10000" <?php if ($newemaildelay=="10000") print "selected=\"selected\"";?>>10 Sec</option>
</select>
<span class="cbfieldnote">some servers limit how quickly email can be sent</span>
</div>

</fieldset>

<fieldset>
<legend>Installation Paths</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newsiteloklocation">Full file path to Sitelok folder</label>
<input class="inputtext long<?php if ($newsiteloklocationproblem!="") echo " errorfield"; ?>" type="text" name="newsiteloklocation" id="newsiteloklocation" maxlength="255" value="<?php echo $newsiteloklocation; ?>">
<?php if ($newsiteloklocationproblem!="") { ?><p class="textfielderror"><?php echo $newsiteloklocationproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newsiteloklocationurl">URL to Sitelok folder</label>
<input class="inputtext long<?php if ($newsiteloklocationurlproblem!="") echo " errorfield"; ?>" type="text" name="newsiteloklocationurl" id="newsiteloklocationurl" maxlength="255" value="<?php echo $newsiteloklocationurl; ?>">
<?php if ($newsiteloklocationurlproblem!="") { ?><p class="textfielderror"><?php echo $newsiteloklocationurlproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemaillocation">Full file path to email folder</label>
<input class="inputtext long<?php if ($newemaillocationproblem!="") echo " errorfield"; ?>" type="text" name="newemaillocation" id="newemaillocation" maxlength="255" value="<?php echo $newemaillocation; ?>">
<?php if ($newemaillocationproblem!="") { ?><p class="textfielderror"><?php echo $newemaillocationproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newemailurl">URL to email template folder</label>
<input class="inputtext long<?php if ($newemailurlproblem!="") echo " errorfield"; ?>" type="text" name="newemailurl" id="newemailurl" maxlength="255" value="<?php echo $newemailurl; ?>">
<?php if ($newemailurlproblem!="") { ?><p class="textfielderror"><?php echo $newemailurlproblem; ?></p><?php } ?>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newbackuplocation">Full file path to backup folder</label>
<input class="inputtext long<?php if ($newbackuplocationproblem!="") echo " errorfield"; ?>" type="text" name="newbackuplocation" id="newbackuplocation" maxlength="255" value="<?php echo $newbackuplocation; ?>">
<?php if ($newbackuplocationproblem!="") { ?><p class="textfielderror"><?php echo $newbackuplocationproblem; ?></p><?php } ?>
</div>

</fieldset>

<div><button type="button" id="save-go" name="addbutton" value="Save" onclick="Save_Config(this.form);">Save</button><button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button></div>

</form>

<script  type="text/javascript">
  searchEngineAccess()
  emailverifyclicked()
  emailSettings()
  var obj=document.getElementById("newsitename")
  obj.focus()
</script>

<?php include "footeradminother.php"; ?>
<?php
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
</body>
</html>