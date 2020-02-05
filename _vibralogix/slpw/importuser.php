<?php
  @set_time_limit(86400);
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
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html>
<head>
<?php
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>  
<link href="stylescommon.css" rel="stylesheet" type="text/css">
<title>Import users</title>
<script  type="text/javascript">
<!--
function validateform(form)
{
  if (form.slimportedusers.value=="")
  {
  	alert("You must select a file to import")
  	form.slimportedusers.focus()
  	return (false)
  }
  return(true);
}
// -->
</script>
</head>
<body>
<?php include "headeradminother.php"; ?>
<h1>Import Users</h1>
<form name="form1" action="importuser.php" method="POST" enctype="multipart/form-data"  onSubmit="return validateform(this)">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">
<fieldset>
<legend>Import settings</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="slimportedusers">Select file</label>
<input name="MAX_FILE_SIZE" type="hidden" value="2000000">
<input class="inputfile" type="file" name="slimportedusers" size="50">
</div>

<div class="verticalfield">
<label class="verticalfield" for="updatedupl">Duplicates</label>
<input type="checkbox" name="updatedupl" id="updatedupl" value="on" >
<span class="cbfieldnote">check box to update existing users or leave blank to ignore them</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="randpass">Random passwords</label>
<input type="checkbox" name="randpass" id="randpass" value="on" <?php if ($randpass=="on") echo "checked=\"checked\""; ?>>
<span class="cbfieldnote">assign random password (ignore password in file)</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="selectimp">Select</label>
<input type="checkbox" name="selectimp" id="selectimp" value="on" <?php if ($selectimp=="on") echo "checked=\"checked\""; ?>>
<span class="cbfieldnote">select users added or updated</span>
</div>

</fieldset>

<div><button type="submit" id="import-go" name="submit" value="Import">Import</button><button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button></div>

<div class="blankspace"></div>

<?php
@ini_set('auto_detect_line_endings', true);
$usernotunique=false;
if (isset($_FILES['slimportedusers']))
{
  print "<div class=\"importuserresults\">\n";
  $usersadded=0;
  $usersignored=0;
 	$totalrecords=0;
 	$usersupdated=0;
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  $fh=@fopen($_FILES['slimportedusers']['tmp_name'],"r");
  if (!($fh))
  {
    print("Can't open imported file");
    mysqli_close($mysql_link);
    exit;
  }
  // If selecting users added or updated then clear already selected users
  if ($selectimp=="on")
    $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='No' ");
  if (!isset($ImportSeparator))
    $ImportSeparator=",";	    
  while (($fields = fgetcsv($fh, 4096, $ImportSeparator)) !== false)
  {
    if (count($fields)<6)
    	continue;
    // See if created date is included
    for ($i=0;$i<count($fields);$i++)
      $fields[$i]=rtrim($fields[$i]);
    $cri=$fields[0];
    // See if first field is a date
    $criarray=explode("/",$cri);
    if ((count($criarray)==3) && (is_numeric($criarray[0])) && (is_numeric($criarray[1]))  && (is_numeric($criarray[2])))
    {
      if ($DateFormat=="DDMMYY")
      {
        if ($criarray[2]>=2000)
          $criarray[2]=$criarray[2]-2000;
        $cr=sprintf("%02d",$criarray[2]).sprintf("%02d",$criarray[1]).sprintf("%02d",$criarray[0]);
      }  
      else
      {
        if ($criarray[2]>=2000)
          $criarray[2]=$criarray[2]-2000;
        $cr=sprintf("%02d",$criarray[2]).sprintf("%02d",$criarray[0]).sprintf("%02d",$criarray[1]);
      }  
      if ($selectimp=="on")
	      $sl="Yes";
      else
	      $sl="No";
      $user=$fields[1];
      $pass=$fields[2];
      if ($randpass=="on")
        $pass=sl_CreatePassword($RandomPasswordMask);
      if ($MD5passwords)
        $pass=md5($pass.$SiteKey);
      $en=$fields[3];
      if (strtolower($en)=="no")
        $en="No";
      if (strtolower($en)=="yes")
        $en="Yes";        
      $nm=$fields[4];
      $em=$fields[5];
      $ug=$fields[6];
      $cu1="";
      $cu2="";
      $cu3="";
      $cu4="";
      $cu5="";
      $cu6="";
      $cu7="";
      $cu8="";
      $cu9="";
      $cu10="";
      $cu11="";
      $cu12="";
      $cu13="";
      $cu14="";
      $cu15="";
      $cu16="";
      $cu17="";
      $cu18="";
      $cu19="";
      $cu20="";
      $cu21="";
      $cu22="";
      $cu23="";
      $cu24="";
      $cu25="";
      $cu26="";
      $cu27="";
      $cu28="";
      $cu29="";
      $cu30="";
      $cu31="";
      $cu32="";
      $cu33="";
      $cu34="";
      $cu35="";
      $cu36="";
      $cu37="";
      $cu38="";
      $cu39="";
      $cu40="";
      $cu41="";
      $cu42="";
      $cu43="";
      $cu44="";
      $cu45="";
      $cu46="";
      $cu47="";
      $cu48="";
      $cu49="";
      $cu50="";
      if (count($fields)>7)
        $cu1=$fields[7];
      if (count($fields)>8)
        $cu2=$fields[8];
      if (count($fields)>9)
        $cu3=$fields[9];
      if (count($fields)>10)
        $cu4=$fields[10];
      if (count($fields)>11)
        $cu5=$fields[11];
      if (count($fields)>12)
        $cu6=$fields[12];
      if (count($fields)>13)
        $cu7=$fields[13];
      if (count($fields)>14)
        $cu8=$fields[14];
      if (count($fields)>15)
        $cu9=$fields[15];
      if (count($fields)>16)
        $cu10=$fields[16];
      if (count($fields)>17)
        $cu11=$fields[17];
      if (count($fields)>18)
        $cu12=$fields[18];
      if (count($fields)>19)
        $cu13=$fields[19];
      if (count($fields)>20)
        $cu14=$fields[20];
      if (count($fields)>21)
        $cu15=$fields[21];
      if (count($fields)>22)
        $cu16=$fields[22];
      if (count($fields)>23)
        $cu17=$fields[23];
      if (count($fields)>24)
        $cu18=$fields[24];
      if (count($fields)>25)
        $cu19=$fields[25];
      if (count($fields)>26)
        $cu20=$fields[26];
      if (count($fields)>27)
        $cu21=$fields[27];
      if (count($fields)>28)
        $cu22=$fields[28];
      if (count($fields)>29)
        $cu23=$fields[29];
      if (count($fields)>30)
        $cu24=$fields[30];
      if (count($fields)>31)
        $cu25=$fields[31];
      if (count($fields)>32)
        $cu26=$fields[32];
      if (count($fields)>33)
        $cu27=$fields[33];
      if (count($fields)>34)
        $cu28=$fields[34];
      if (count($fields)>35)
        $cu29=$fields[35];
      if (count($fields)>36)
        $cu30=$fields[36];
      if (count($fields)>37)
        $cu31=$fields[37];
      if (count($fields)>38)
        $cu32=$fields[38];
      if (count($fields)>39)
        $cu33=$fields[39];
      if (count($fields)>40)
        $cu34=$fields[40];
      if (count($fields)>41)
        $cu35=$fields[41];
      if (count($fields)>42)
        $cu36=$fields[42];
      if (count($fields)>43)
        $cu37=$fields[43];
      if (count($fields)>44)
        $cu38=$fields[44];
      if (count($fields)>45)
        $cu39=$fields[45];
      if (count($fields)>46)
        $cu40=$fields[46];
      if (count($fields)>47)
        $cu41=$fields[47];
      if (count($fields)>48)
        $cu42=$fields[48];
      if (count($fields)>49)
        $cu43=$fields[49];
      if (count($fields)>50)
        $cu44=$fields[50];
      if (count($fields)>51)
        $cu45=$fields[51];
      if (count($fields)>52)
        $cu46=$fields[52];
      if (count($fields)>53)
        $cu47=$fields[53];
      if (count($fields)>54)
        $cu48=$fields[54];
      if (count($fields)>55)
        $cu49=$fields[55];
      if (count($fields)>56)
        $cu50=$fields[56];	        
    }
    else
    {
      if ($selectimp=="on")
	      $sl="Yes";
      else
	      $sl="No";
      $cr=gmdate("ymd");
      $user=$fields[0];
      $pass=$fields[1];
      if ($randpass=="on")
        $pass=sl_CreatePassword($RandomPasswordMask);
      if ($MD5passwords)
        $pass=md5($pass.$SiteKey);	      
      $en=$fields[2];
      if (strtolower($en)=="no")
        $en="No";
      if (strtolower($en)=="yes")
        $en="Yes";        
      $nm=$fields[3];
      $em=$fields[4];
      $ug=$fields[5];
      $ug=rtrim($ug);
      $cu1="";
      $cu2="";
      $cu3="";
      $cu4="";
      $cu5="";
      $cu6="";
      $cu7="";
      $cu8="";
      $cu9="";
      $cu10="";
      $cu11="";
      $cu12="";
      $cu13="";
      $cu14="";
      $cu15="";
      $cu16="";
      $cu17="";
      $cu18="";
      $cu19="";
      $cu20="";
      $cu21="";
      $cu22="";
      $cu23="";
      $cu24="";
      $cu25="";
      $cu26="";
      $cu27="";
      $cu28="";
      $cu29="";
      $cu30="";
      $cu31="";
      $cu32="";
      $cu33="";
      $cu34="";
      $cu35="";
      $cu36="";
      $cu37="";
      $cu38="";
      $cu39="";
      $cu40="";
      $cu41="";
      $cu42="";
      $cu43="";
      $cu44="";
      $cu45="";
      $cu46="";
      $cu47="";
      $cu48="";
      $cu49="";
      $cu50="";
      if (count($fields)>6)
        $cu1=$fields[6];
      if (count($fields)>7)
        $cu2=$fields[7];
      if (count($fields)>8)
        $cu3=$fields[8];
      if (count($fields)>9)
        $cu4=$fields[9];
      if (count($fields)>10)
        $cu5=$fields[10];
      if (count($fields)>11)
        $cu6=$fields[11];
      if (count($fields)>12)
        $cu7=$fields[12];
      if (count($fields)>13)
        $cu8=$fields[13];
      if (count($fields)>14)
        $cu9=$fields[14];
      if (count($fields)>15)
        $cu10=$fields[15];
      if (count($fields)>16)
        $cu11=$fields[16];
      if (count($fields)>17)
        $cu12=$fields[17];
      if (count($fields)>18)
        $cu13=$fields[18];
      if (count($fields)>19)
        $cu14=$fields[19];
      if (count($fields)>20)
        $cu15=$fields[20];
      if (count($fields)>21)
        $cu16=$fields[21];
      if (count($fields)>22)
        $cu17=$fields[22];
      if (count($fields)>23)
        $cu18=$fields[23];
      if (count($fields)>24)
        $cu19=$fields[24];
      if (count($fields)>25)
        $cu20=$fields[25];
      if (count($fields)>26)
        $cu21=$fields[26];
      if (count($fields)>27)
        $cu22=$fields[27];
      if (count($fields)>28)
        $cu23=$fields[28];
      if (count($fields)>29)
        $cu24=$fields[29];
      if (count($fields)>30)
        $cu25=$fields[30];
      if (count($fields)>31)
        $cu26=$fields[31];
      if (count($fields)>32)
        $cu27=$fields[32];
      if (count($fields)>33)
        $cu28=$fields[33];
      if (count($fields)>34)
        $cu29=$fields[34];
      if (count($fields)>35)
        $cu30=$fields[35];
      if (count($fields)>36)
        $cu31=$fields[36];
      if (count($fields)>37)
        $cu32=$fields[37];
      if (count($fields)>38)
        $cu33=$fields[38];
      if (count($fields)>39)
        $cu34=$fields[39];
      if (count($fields)>40)
        $cu35=$fields[40];
      if (count($fields)>41)
        $cu36=$fields[41];
      if (count($fields)>42)
        $cu37=$fields[42];
      if (count($fields)>43)
        $cu38=$fields[43];
      if (count($fields)>44)
        $cu39=$fields[44];
      if (count($fields)>45)
        $cu40=$fields[45];
      if (count($fields)>46)
        $cu41=$fields[46];
      if (count($fields)>47)
        $cu42=$fields[47];
      if (count($fields)>48)
        $cu43=$fields[48];
      if (count($fields)>49)
        $cu44=$fields[49];
      if (count($fields)>50)
        $cu45=$fields[50];
      if (count($fields)>51)
        $cu46=$fields[51];
      if (count($fields)>52)
        $cu47=$fields[52];
      if (count($fields)>53)
        $cu48=$fields[53];
      if (count($fields)>54)
        $cu49=$fields[54];
      if (count($fields)>55)
        $cu50=$fields[55];
    }
    if (($user!="") && ($pass!="") && ($nm!="") && ($em!="") && (sl_validate_email($em)) && (($en=="Yes") || ($en=="No")))
    {
    	$totalrecords++;
    	// See if user exists already
    	if(mysqli_num_rows(mysqli_query($mysql_link,"SELECT ".$UsernameField." FROM ".$DbTableName." WHERE ".$UsernameField." = ".sl_quote_smart($user))))
    	{
    	  // User exists so modify it if required
      	if ($updatedupl!="on")
      	{
          print "<p class=\"generaltext\">User ".$user." already exists so was ignored</p>\n";
          $usersignored++;
          continue;
        }
        // Check if email address already used (by a different user) if required                        
        if ($EmailUnique==2)
        {
          $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$EmailField."=".sl_quote_smart($em)." AND ".$UsernameField."!=".sl_quote_smart($user));
          if ($mysql_result!==false)
          {   
            $num = mysqli_num_rows($mysql_result);
            if ($num>0)
            {
              print "<p class=\"generaltext\">User ".$user." not modified. Email address already used</p>\n";
              $usersignored++;
              continue;              
            }
          }  
        }
        // Give last chance to plugins and event handler to block modification
        $paramdata['userid']="";  	
        $paramdata['oldusername']=$user;
        $paramdata['username']=$user;
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
        $importmsg="";                     
        // Call plugin event
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if ($importmsg=="")
          {
            if (function_exists($slplugin_event_onCheckModifyUser[$p]))
            {
              $res=call_user_func($slplugin_event_onCheckModifyUser[$p],$slpluginid[$p],$paramdata);
              if ($res['ok']==false)
                $importmsg=$res['message'];
            } 
          }  
        }
        if ($importmsg=="")
        {
          // Call eventhandler
          if (function_exists("sl_onCheckModifyUser"))
          {
            $res=sl_onCheckModifyUser($paramdata);
            if ($res['ok']==false)
              $importmsg=$res['message'];
          }  
        }  
        if ($importmsg!="")
        {
          print "<p class=\"generaltext\">User ".$user." not modified. ".$importmsg."</p>\n";
          $usersignored++;
          continue;
        }
	    	if (count($fields)>16)
	    	{
          $Query="UPDATE ".$DbTableName." SET ".$SelectedField."=".sl_quote_smart($sl).", ".$UsernameField."=".sl_quote_smart($user).", ".$PasswordField.
          "=".sl_quote_smart($pass).", ".$EnabledField."=".sl_quote_smart($en).", ".$NameField."=".sl_quote_smart($nm).", ".$EmailField."=".sl_quote_smart($em).", ".$UsergroupsField.
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
          $Query="UPDATE ".$DbTableName." SET ".$SelectedField."=".sl_quote_smart($sl).", ".$UsernameField."=".sl_quote_smart($user).", ".$PasswordField.
          "=".sl_quote_smart($pass).", ".$EnabledField."=".sl_quote_smart($en).", ".$NameField."=".sl_quote_smart($nm).", ".$EmailField."=".sl_quote_smart($em).", ".$UsergroupsField.
          "=".sl_quote_smart($ug).", ".$Custom1Field."=".sl_quote_smart($cu1).", ".$Custom2Field."=".sl_quote_smart($cu2).", ".$Custom3Field."=".sl_quote_smart($cu3).", ".$Custom4Field.
          "=".sl_quote_smart($cu4).", ".$Custom5Field."=".sl_quote_smart($cu5).", ".$Custom6Field."=".sl_quote_smart($cu6).", ".$Custom7Field."=".sl_quote_smart($cu7).", ".$Custom8Field.
          "=".sl_quote_smart($cu8).", ".$Custom9Field."=".sl_quote_smart($cu9).", ".$Custom10Field."=".sl_quote_smart($cu10)." WHERE ".$UsernameField."=".sl_quote_smart($user);    	    	  
	    	}
	      if ($DemoMode)
	        $mysql_result=true;
	      else  
				  $mysql_result=mysqli_query($mysql_link,$Query);
        if ($mysql_result!=false)
        {
          print "<p class=\"generaltext\"User ".$user." was updated</p>\n";
        	$usersupdated++;
          // Event point
          // Get auto increment id of user modified
          $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." WHERE ".$UsernameField."=".sl_quote_smart($user));
          $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);	
          $paramdata['userid']=$row[$IdField];  
          $paramdata['oldusername']=$user;
          $paramdata['username']=$user;
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
        }
      }
    	else
    	{
    	  // User doesn't exist so add it
      	// Give plugins and event handler last word about whether the user can be added
        if ($EmailUnique==2)
        {
          if (false!==slapi_getuserbyemail($em))
          {
             print "<p class=\"generaltext\">User ".$user." not added. Email address already used</p>\n";
             $usersignored++;
             continue;              
          }
        }
      	$importmsg="";
        $paramdata['userid']="";  // Not yet known  
        $paramdata['oldusername']=$user;
        $paramdata['username']=$user;
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
          if ($importmsg=="")
          {
            if (function_exists($slplugin_event_onCheckAddUser[$p]))
            {
              $res=call_user_func($slplugin_event_onCheckAddUser[$p],$slpluginid[$p],$paramdata);
              if ($res['ok']==false)
              {
                $importmsg=$res['message'];
              } 
            } 
          }  
        }
        if ($importmsg=="")
        {
          // Call eventhandler
          if (function_exists("sl_onCheckAddUser"))
          {
            $res=sl_onCheckAddUser($paramdata);
            if ($res['ok']==false)
              $importmsg=$res['message'];
          }  
        }  
        if ($importmsg!="")
        {
          print "<p class=\"generaltext\">User ".$user." not added. ".$importmsg."</p>\n";
          $usersignored++;
          continue;
        }
        $Query="INSERT INTO ".$DbTableName." (".$SelectedField.",".$CreatedField.",".$UsernameField.",".$PasswordField.",".$EnabledField.
        ",".$NameField.",".$EmailField.",".$UsergroupsField.",".
        $Custom1Field.",".$Custom2Field.",".$Custom3Field.",".$Custom4Field.",".$Custom5Field.",".$Custom6Field.",".$Custom7Field.",".$Custom8Field.",".$Custom9Field.",".$Custom10Field.",".
        $Custom11Field.",".$Custom12Field.",".$Custom13Field.",".$Custom14Field.",".$Custom15Field.",".$Custom16Field.",".$Custom17Field.",".$Custom18Field.",".$Custom19Field.",".$Custom20Field.",".
        $Custom21Field.",".$Custom22Field.",".$Custom23Field.",".$Custom24Field.",".$Custom25Field.",".$Custom26Field.",".$Custom27Field.",".$Custom28Field.",".$Custom29Field.",".$Custom30Field.",".
        $Custom31Field.",".$Custom32Field.",".$Custom33Field.",".$Custom34Field.",".$Custom35Field.",".$Custom36Field.",".$Custom37Field.",".$Custom38Field.",".$Custom39Field.",".$Custom40Field.",".
        $Custom41Field.",".$Custom42Field.",".$Custom43Field.",".$Custom44Field.",".$Custom45Field.",".$Custom46Field.",".$Custom47Field.",".$Custom48Field.",".$Custom49Field.",".$Custom50Field.  	      
        ") VALUES(".sl_quote_smart($sl).",".sl_quote_smart($cr).",".sl_quote_smart($user).",".sl_quote_smart($pass).",".sl_quote_smart($en).",".sl_quote_smart($nm).",".sl_quote_smart($em).",".sl_quote_smart($ug).",".sl_quote_smart($cu1).",".sl_quote_smart($cu2).",".sl_quote_smart($cu3).",".sl_quote_smart($cu4).",".sl_quote_smart($cu5).",".sl_quote_smart($cu6).",".sl_quote_smart($cu7).",".sl_quote_smart($cu8).",".sl_quote_smart($cu9).",".sl_quote_smart($cu10).",".
        sl_quote_smart($cu11).",".sl_quote_smart($cu12).",".sl_quote_smart($cu13).",".sl_quote_smart($cu14).",".sl_quote_smart($cu15).",".sl_quote_smart($cu16).",".sl_quote_smart($cu17).",".sl_quote_smart($cu18).",".sl_quote_smart($cu19).",".sl_quote_smart($cu20).",".
        sl_quote_smart($cu21).",".sl_quote_smart($cu22).",".sl_quote_smart($cu23).",".sl_quote_smart($cu24).",".sl_quote_smart($cu25).",".sl_quote_smart($cu26).",".sl_quote_smart($cu27).",".sl_quote_smart($cu28).",".sl_quote_smart($cu29).",".sl_quote_smart($cu30).",".
        sl_quote_smart($cu31).",".sl_quote_smart($cu32).",".sl_quote_smart($cu33).",".sl_quote_smart($cu34).",".sl_quote_smart($cu35).",".sl_quote_smart($cu36).",".sl_quote_smart($cu37).",".sl_quote_smart($cu38).",".sl_quote_smart($cu39).",".sl_quote_smart($cu40).",".
        sl_quote_smart($cu41).",".sl_quote_smart($cu42).",".sl_quote_smart($cu43).",".sl_quote_smart($cu44).",".sl_quote_smart($cu45).",".sl_quote_smart($cu46).",".sl_quote_smart($cu47).",".sl_quote_smart($cu48).",".sl_quote_smart($cu49).",".sl_quote_smart($cu50).")";	    	  
        if ($DemoMode)
          $mysql_result=true;
        else  
          $mysql_result=mysqli_query($mysql_link,$Query);
        $usersadded++;
        // Event point
        $userid=mysqli_insert_id($mysql_link);
        $paramdata['userid']=$userid;
        $paramdata['oldusername']=$user;
        $paramdata['username']=$user;
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
          if (function_exists($slplugin_event_onAddUser[$p]))
            call_user_func($slplugin_event_onAddUser[$p],$slpluginid[$p],$paramdata);
        }         
        if (function_exists("sl_onAddUser"))
          sl_onAddUser($paramdata);
      }
    }
    else
    {
      print "<p class=\"generaltext\">User ".$user." not added (missing data)</p>\n";
      $usersignored++;
      continue;
    }
  }
  fclose($fh);
//   mysqli_close($mysql_link);
  unlink($_FILES['slimportedusers']['tmp_name']);
  print "<br>\n";
  print "<p class=\"generaltext\">$totalrecords users read from file.</p>\n";
  print "<p class=\"generaltext\">$usersadded users successfuly added</p>\n";
  if ($usersignored>0)
    print "<p class=\"generalerrortext\">$usersignored users were not added</p>\n";
  if ($usersupdated>0)
    print "<p class=\"generaltext\">$usersupdated users have been updated</p>\n";
  print "</div>";  
}
?>
</form>
<script  type="text/javascript">
  var obj=document.getElementById("slimportedusers")
  obj.focus()
</script>
<?php include "footeradminother.php"; ?>
</body>
</html>    

