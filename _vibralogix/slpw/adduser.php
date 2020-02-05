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
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  // Get custom field lengths
  $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$DbTableName." LIMIT 1");
  $fcharset=mysqli_get_charset($mysql_link);
  $finfo=mysqli_fetch_fields($mysql_result);
  if (($act=="adduser") && ($user!="") && ($pass!=""))
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
    $addmsg="";
    $successmsg="";
    // Validate username field
    if ($user=="")
    	$addmsg="Username must be entered";
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($addmsg=="") && (function_exists($slplugin_event_onUsernameValidate[$p])))
        $addmsg=call_user_func($slplugin_event_onUsernameValidate[$p],$slpluginid[$p],$user,2);
    }
    if ($addmsg=="")
    {
      if (function_exists("sl_onUsernameValidate"))
        $addmsg=sl_onUsernameValidate($user,2);
    }
    // check username is set and doesn't contain invalid characters
    if (($addmsg=="") && (strspn($user, $ValidUsernameChars) != strlen($user)))
    	$addmsg="Username contains invalid characters";  
    // Validate password field
    if (($addmsg=="") && ($pass==""))
    	$addmsg="Password should contain at least 5 characters";     
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($addmsg=="") && (function_exists($slplugin_event_onPasswordValidate[$p])))
        $addmsg=call_user_func($slplugin_event_onPasswordValidate[$p],$slpluginid[$p],$pass,2);
    }
    if ($addmsg=="")
    {
      if (function_exists("sl_onPasswordValidate"))
        $addmsg=sl_onPasswordValidate($pass,2);
    }
    // check password is at least 5 characters long
    if (($addmsg=="") && (strlen($pass)<5))
    	$addmsg="Password should contain at least 5 characters"; 
    // Validate against master list of valid characters
    if (($addmsg=="") && (strspn($pass, $ValidPasswordChars) != strlen($pass)))
    	$addmsg="Password contains invalid characters";      
    // Validate name field
    if (($addmsg=="") && ($nm==""))
    	$addmsg="Please enter the users name";     
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($addmsg=="") && (function_exists($slplugin_event_onNameValidate[$p])))
        $addmsg=call_user_func($slplugin_event_onNameValidate[$p],$slpluginid[$p],$nm,2);
    }
    if ($addmsg=="")
    {
      if (function_exists("sl_onNameValidate"))
      $addmsg=sl_onNameValidate($nm,2);
    }
    // Validate email field
    if (($addmsg=="") && ($em==""))
    	$addmsg="Please enter the users email address";     
    // Check email is in valid format
    if (($addmsg=="") && (!sl_validate_email($em)))
      $addmsg="Please enter a valid email address";
    // Check if email address already used if required
    if (($addmsg=="") && ($EmailUnique==2))
    {
      if (false!==slapi_getuserbyemail($em))
        $addmsg="The email address is already in use";
    }
    // Call plugin and eventhandler validation function
    for ($p=0;$p<$slnumplugins;$p++)
    {
      if (($addmsg=="") && (function_exists($slplugin_event_onEmailValidate[$p])))
        $addmsg=call_user_func($slplugin_event_onEmailValidate[$p],$slpluginid[$p],$em,2);
    }
    if ($addmsg=="")
    {
      if (function_exists("sl_onEmailValidate"))
        $addmsg=sl_onEmailValidate($em,2);
    }
    // Validate custom fields for plugins and eventhandler
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
        if (($addmsg=="") && (function_exists(${$cusvar5}[$p])))
        {
          $addmsg=call_user_func(${$cusvar5}[$p],$slpluginid[$p],$$cusvar,$$cusvar3,2);
        }
      }
      // Validate using eventhandlers
      if (($addmsg=="") && (($$cusvar2==2) || ($$cusvar2==3)))
      {
        $addmsg=call_user_func($cusvar4,$$cusvar,$$cusvar3,2);
      }
    }
    // Concatenate groups and expiry times in table format
    $ug="";
    for ($k=1;$k<=5;$k++)
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
    if ($addmsg=="")
    {
      // Give plugins and event handler the last word about adding this user
      // Event point
      $paramdata['username']=$user;
      $paramdata['userid']="";   // Not set yet        
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
        if ($addmsg=="")
        {
          if (function_exists($slplugin_event_onCheckAddUser[$p]))
          {
            $res=call_user_func($slplugin_event_onCheckAddUser[$p],$slpluginid[$p],$paramdata);
            if ($res['ok']==false)
              $addmsg=$res['message'];
          } 
        }  
      }
    }
    if ($addmsg=="")
    {
      // Call eventhandler
      if (function_exists("sl_onCheckAddUser"))
      {
        $res=sl_onCheckAddUser($paramdata);
        if ($res['ok']==false)
          $addmsg=$res['message'];
      }  
    }  
    if ($addmsg=="")
    { 
    	$emailsent=0;
      $passtowrite=$pass;
      if ($MD5passwords)
      $passtowrite=md5($pass.$SiteKey);
      $Query="INSERT INTO ".$DbTableName." (".$SelectedField.",".$CreatedField.",".$UsernameField.",".$PasswordField.",".$EnabledField.
      ",".$NameField.",".$EmailField.",".$UsergroupsField.",".$Custom1Field.",".$Custom2Field.",".$Custom3Field.",".$Custom4Field.",".$Custom5Field.
      ",".$Custom6Field.",".$Custom7Field.",".$Custom8Field.",".$Custom9Field.",".$Custom10Field.
      ",".$Custom11Field.",".$Custom12Field.",".$Custom13Field.",".$Custom14Field.",".$Custom15Field.
      ",".$Custom16Field.",".$Custom17Field.",".$Custom18Field.",".$Custom19Field.",".$Custom20Field.
      ",".$Custom21Field.",".$Custom22Field.",".$Custom23Field.",".$Custom24Field.",".$Custom25Field.
      ",".$Custom26Field.",".$Custom27Field.",".$Custom28Field.",".$Custom29Field.",".$Custom30Field.
      ",".$Custom31Field.",".$Custom32Field.",".$Custom33Field.",".$Custom34Field.",".$Custom35Field.
      ",".$Custom36Field.",".$Custom37Field.",".$Custom38Field.",".$Custom39Field.",".$Custom40Field.
      ",".$Custom41Field.",".$Custom42Field.",".$Custom43Field.",".$Custom44Field.",".$Custom45Field.
      ",".$Custom46Field.",".$Custom47Field.",".$Custom48Field.",".$Custom49Field.",".$Custom50Field.
      ") VALUES('No','".gmdate("ymd")."',".sl_quote_smart($user).",".sl_quote_smart($passtowrite).",".sl_quote_smart($en).",".sl_quote_smart($nm).",".sl_quote_smart($em).",".sl_quote_smart($ug).",".sl_quote_smart($cu1).",".sl_quote_smart($cu2).",".sl_quote_smart($cu3).",".sl_quote_smart($cu4).",".sl_quote_smart($cu5).",".sl_quote_smart($cu6).",".sl_quote_smart($cu7).",".sl_quote_smart($cu8).",".sl_quote_smart($cu9).",".sl_quote_smart($cu10).",".
      sl_quote_smart($cu11).",".sl_quote_smart($cu12).",".sl_quote_smart($cu13).",".sl_quote_smart($cu14).",".sl_quote_smart($cu15).",".sl_quote_smart($cu16).",".sl_quote_smart($cu17).",".sl_quote_smart($cu18).",".sl_quote_smart($cu19).",".sl_quote_smart($cu20).",".
      sl_quote_smart($cu21).",".sl_quote_smart($cu22).",".sl_quote_smart($cu23).",".sl_quote_smart($cu24).",".sl_quote_smart($cu25).",".sl_quote_smart($cu26).",".sl_quote_smart($cu27).",".sl_quote_smart($cu28).",".sl_quote_smart($cu29).",".sl_quote_smart($cu30).",".
      sl_quote_smart($cu31).",".sl_quote_smart($cu32).",".sl_quote_smart($cu33).",".sl_quote_smart($cu34).",".sl_quote_smart($cu35).",".sl_quote_smart($cu36).",".sl_quote_smart($cu37).",".sl_quote_smart($cu38).",".sl_quote_smart($cu39).",".sl_quote_smart($cu40).",".
      sl_quote_smart($cu41).",".sl_quote_smart($cu42).",".sl_quote_smart($cu43).",".sl_quote_smart($cu44).",".sl_quote_smart($cu45).",".sl_quote_smart($cu46).",".sl_quote_smart($cu47).",".sl_quote_smart($cu48).",".sl_quote_smart($cu49).",".sl_quote_smart($cu50).")";
      if ($DemoMode)
        $mysql_result=true;
      else  
        $mysql_result=mysqli_query($mysql_link,$Query);
      if ($mysql_result==false)
      {
        $addmsg="Username has already been used!";
      }
      else
      {
        $userid=mysqli_insert_id($mysql_link);
      	if (($template!="") && ($sendemail=="on"))
      	{
  		    if (sl_ReadEmailTemplate($template,$subject,$mailBody,$htmlformat)==false)
  		    {
  		      $addmsg="Template ".$template." could not be opened";
  		    }
  		    else
  		    {
            if (($template!=$NewUserEmail) && (!$DemoMode))
            {
              $query="UPDATE ".$DbConfigTableName." SET newuseremail=".$template." WHERE confignum=1";
              $mysql_result=mysqli_query($mysql_link,$query);
              $NewUserEmail=$template;
              $_SESSION['ses_ConfigReload']="reload";     
            }		      		      
  			    if (sl_SendEmail($em,$mailBody,$subject,$htmlformat,$user,$pass,$nm,$em,$ug,$cu1,$cu2,$cu3,$cu4,$cu5,$cu6,$cu7,$cu8,$cu9,$cu10,$cu11,$cu12,$cu13,$cu14,$cu15,$cu16,$cu17,$cu18,$cu19,$cu20,
  			    $cu21,$cu22,$cu23,$cu24,$cu25,$cu26,$cu27,$cu28,$cu29,$cu30,$cu31,$cu32,$cu33,$cu34,$cu35,$cu36,$cu37,$cu38,$cu39,$cu40,$cu41,$cu42,$cu43,$cu44,$cu45,$cu46,$cu47,$cu48,$cu49,$cu50)==1)
  			      $emailsent++;
  			  }
  			}
        // Event point
        $paramdata['username']=$user;
        $paramdata['userid']=$userid;        
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
        // Call eventhandler
        if (function_exists("sl_onAddUser"))
          sl_onAddUser($paramdata);
        // Empty form fields
        $successmsg=$user." has been added";
        $user="";
        $pass="";
        $en="Yes";
        $nm="";
        $em="";
        $group1="";
        $expirydate1="";
        $group2="";
        $expirydate2="";
        $group3="";
        $expirydate3="";
        $group4="";
        $expirydate4="";
        $group5="";
        $expirydate5="";
        for ($k=1;$k<=50;$k++)
        {
          $var="cu".$k;
          $$var="";
        }
        $sendemail="";
        $template="";      
      }
  //    mysqli_close($mysql_link);
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
<title>Add user</title>
<script  type="text/javascript" src="gui.js"></script>
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

function Add_User(form)
{
  var str
  var k
  var prob 
  // Validate entries
  str=form.user.value
  if (str.length==0)
  {
     alert("Please enter a Username")
     form.user.focus()
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
     form.user.focus();
     return (false);
  }
  str=form.pass.value
  if (str.length==0)
  {
     alert("Please enter a Password")
     form.pass.focus()
     return (false)
  }
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
     alert("Please enter a name")
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
  for (k=1;k<=5;k++)
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
  form.action="adduser.php"
  form.act.value="adduser"
  form.submit()
}

function Cancel_Add(form)
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
</head>
<body onMouseUp="guiCloseIfOutside()">
<?php include "headeradminother.php"; ?>
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
<h1>Add User</h1>
<form name="form1" action="adduser.php" method="POST">
<input name="act" type="hidden" value="">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">
<?php if ($addmsg!="") { ?>
<p class="formerror"><?php echo $addmsg; ?></p>
<?php } ?>
<?php if ($emailsent>0) { ?>
<p>Email <?php echo $template; ?> sent to <?php echo $user; ?></p>
<?php } ?>
<?php if ($successmsg!="") { ?>
<p class="generaltext"><?php echo $successmsg; ?></p>
<?php } ?>
<fieldset>
<legend>User Details</legend>
<div class="blankspace"></div>
<div class="verticalfield">
<label class="verticalfield" for="user">Username</label>
<input class="inputtext" type="text" name="user" id="user" maxlength="50" value="<?php echo htmlentities($user,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
</div>

<div class="verticalfield">
<label class="verticalfield" for="pass">Password</label>
<input class="inputtext" type="text" name="pass" id="pass" maxlength="50" value="<?php echo htmlentities($pass,ENT_QUOTES,strtoupper($MetaCharSet)) ?>">
<button type="button" id="random-go" name="randombutton" value="Random" onclick="Random_Pass(this.form);">Random</button>
<?php if ($MD5passwords) { ?>
<p class="textfieldnote">Password will be MD5 encoded</p>
<?php } ?>
</div>

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
If you need more than 5 usergroups to be assigned just add the user with the first 5 and then click edit user to add more.
</p>

<?php for ($k=1;$k<=5;$k++) 
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

for ($k=1;$k<=50;$k++)
{
$titlevar="CustomTitle".$k;
$valuevar="cu".$k;
if ($$titlevar!="")
{
  $fieldlength = ($finfo[$k+7]->length)/$fcharset->max_length;
  if ($fieldlength>255)
  {
?>

<div class="verticalfield">
<label class="verticalfield" for="<?php echo $valuevar; ?>"><?php echo $$titlevar; ?></label>
<textarea class="textarea" name="<?php echo $valuevar; ?>" id="<?php echo $valuevar; ?>" onKeyDown="limitText(this.form.<?php echo $valuevar; ?>,<?php echo $fieldlength[$k+7]; ?>);" onKeyUp="limitText(this.form.<?php echo $valuevar; ?>,<?php echo $fieldlength[$k+7]; ?>);" ><?php echo htmlentities($$valuevar,ENT_QUOTES,strtoupper($MetaCharSet)); ?></textarea>
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
<div><button type="button" id="save-go" name="addbutton" value="Save" onclick="Add_User(this.form);">Save</button><button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button></div>
</form>

<script  type="text/javascript">
  var obj=document.getElementById("user")
  obj.focus()
</script>
<?php include "footeradminother.php"; ?>
</body>
</html>