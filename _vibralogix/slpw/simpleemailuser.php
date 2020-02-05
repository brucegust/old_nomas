<?php
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$startpage="index.php";
  include"sitelokpw.php";
  if ($EmailLocation!="")
    $emailpath=$EmailLocation;
  else
    $emailpath=$SitelokLocation."email/";          	  
  if (get_magic_quotes_gpc())
  {
    $body=stripslashes($body);
    $subject=stripslashes($subject);    
  }  
  if (isset($tablestart)==false)
    $tablestart=0;
  if (isset($act)==false)
    $act="void";
  if (isset($user)==false)
    $user="void";
  $fildata1=stripslashes($fildata1);
  $fildata2=stripslashes($fildata2);
  $fildata3=stripslashes($fildata3);
  $fildata4=stripslashes($fildata4);
  $sqlquery=stripslashes($sqlquery);
  $sqlinput=stripslashes($sqlinput);
  if (isset($sqlquery)==false)
    $sqlquery="SELECT * FROM ".$DbTableName;
	// If user selected a record then linked to this page then update selected field
  $checked=0;
  $k=0;
	$pvar1="sl".$k;
  while (isset($$pvar1))
  {
    if ($$pvar1=="1")
    {
    	$checked=1;
    	break;
    }
    if ($$pvar1=="0")
    {
    	$checked=1;
    	break;
    }
	  $k++;
		$pvar1="sl".$k;
  }
  if ($checked==1)
  {
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      print("Can't connect to MySQL server");
      exit;
    }
    $k=0;
		$pvar1="sl".$k;
		$pvar2="us".$k;
    while (isset($$pvar1))
	  {
	    if ($$pvar1=="1")
	    {
		    $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='Yes' WHERE ".$UsernameField."=".sl_quote_smart($$pvar2));
	    }
	    if ($$pvar1=="0")
	    {
		    $mysql_result=mysql_query($mysql_link,"UPDATE ".$DbTableName." SET ".$SelectedField."='No' WHERE ".$UsernameField."=".sl_quote_smart($$pvar2));
		  }
		  $k++;
			$pvar1="sl".$k;
			$pvar2="us".$k;		  
	  }
//     mysqli_close($mysql_link);
  }
  if (($emailact=="save")  &&  (!$DemoMode))
  {
    if (!is_writable($emailpath.$savefilename))
      @chmod($emailpath.$savefilename,0777);
    $myfile=@fopen($emailpath.$savefilename,"w");
    if ($myfile===false)
    {
			$errormsg="Template ".$savefilename." could not be saved";
    }  
    else
    { 
      if ($htmlformat!="Y")
        fwrite($myfile,$subject."\n".$body);
      else
      { 
        //See if <title> </title> tags exist
        $body=preg_replace("/<title>.*<\/title>/i", "<title>".$subject."</title>",$body,-1,$count);
        if ($count<1)
          $body=preg_replace("/<head>/i","<head><title>".$subject."</title>", $body);           
        fwrite($myfile,$body);
      }  
      fclose($myfile);
      $template=$savefilename;
    }    
  }
  if ($emailact=="load")
  {
    if (sl_ReadEmailTemplate($template,$subject,$mailBody,$htmlformat)==false)
		{
			$errormsg="Template ".$template." could not be opened";
	  }
	  $savefilename=$template;
  }
  else
  {
    $mailBody=$body;
  }	
?>
<html>
<head>
<link href="stylesemailuser.css" rel="stylesheet" type="text/css">
<title>Email Sitelok users</title>
</head>
<body>
<script  type="text/javascript">
<!--
function Load(form)
{
	filename=form.template.value
	if (filename=="")
	{
		alert("Please select a template file")
		return
	}
	form.action="simpleemailuser.php"
	form.emailact.value="load"
  form.esact.value="void"
  form.target=""
	form.submit()
}
function Save_Email(form)
{
	if (form.subject.value=="")
	{
		alert("Please enter an email subject")
        form.subject.focus()
		return
	}
	if (form.body.value=="")
	{
		alert("Please enter the email body")
    form.body.focus()
		return
	}
	if (form.savefilename.value=="")
	{
		alert("Please enter a filename")
    form.savefilename.focus()
		return
	}
	if (!ValidChars(form.savefilename.value,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_()"))
	{
		alert("Filename contains invalid characters")
    form.savefilename.focus()
		return	  
	}
	var ext=fileextension(form.savefilename.value)
	if ((ext=="") && (form.htmlformat.checked))
	  form.savefilename.value=form.savefilename.value+".htm"
	if ((ext==".") && (form.htmlformat.checked))
	  form.savefilename.value=form.savefilename.value+"htm"
	if ((ext=="") && (!form.htmlformat.checked))
	  form.savefilename.value=form.savefilename.value+".txt"
	if ((ext==".") && (!form.htmlformat.checked))
	  form.savefilename.value=form.savefilename.value+"txt"
	// Get extension again in case it was modified above  
	var ext=fileextension(form.savefilename.value)
	if (((ext==".htm") || (ext==".html")) && (!form.htmlformat.checked))
	{
		alert("You should only use the "+ext+" extension for html format emails")
    form.savefilename.focus()
		return
	}
	if (((ext!=".htm") && (ext!=".html")) && (form.htmlformat.checked))
	{
		alert("You should use the .htm extension for html format emails")
    form.savefilename.focus()
		return
	}	
	if (!confirm("This will overwrite any file with the same name"))
	{
	  return
	}
  form.emailact.value="save"
  form.action="simpleemailuser.php"
  form.target=""
  form.submit()
}
function Preview_Email(form)
{
	if (form.subject.value=="")
	{
		alert("Please enter an email subject")
        form.subject.focus()
		return
	}
	if (form.body.value=="")
	{
		alert("Please enter the email body")
        form.body.focus()
		return
	}
  window.open("previewemail.php","Sitelok_PreviewEmail","width=800,height=600,scrollbars,resizable")
  form.action="previewemail.php"
  form.target="Sitelok_PreviewEmail"
  form.submit()
}
function Send_Email(form)
{
	if (form.subject.value=="")
	{
		alert("Please enter an email subject")
    form.subject.focus()
		return
	}
	if (form.body.value=="")
	{
		alert("Please enter the email body")
    form.body.focus()
		return
	}
	<?php
	if ($act=="emaildirect")
	{
	?>
	email=form.email.value
	if (email=="")
	{
		alert("Please enter the email address to send to")
    form.email.focus()
		return
	}
	var emailaddresses=email.split(",")
	var failed=""
	for (k=0;k<emailaddresses.length;k++)
	{
	  emailaddresses[k]=Trim(emailaddresses[k])
	  if (!validateemail(emailaddresses[k]))
	  {
	    failed=emailaddresses[k]
	    break
	  }  
	}
	if (failed!="")
	{
		alert(failed+" is not a valid email address")
    form.email.focus()
		return	  
	}
	<?php } ?>	
	
	if ("<?php echo $act; ?>"=="emailselected")
	{
	  if (confirm("Send email to all selected users?"))
	  {
			window.open("emailselected.php?esact=init","Sitelok_Email","width=500,height=280,resizable=no,scrollbars=no")
	    form.action="emailselected.php"
	    form.target="Sitelok_Email"
	    form.esact.value="start"
	    form.submit()
	  }
	}
	else
	{
	    form.esact.value="void"
	    form.action="index.php"
	    form.target=""
	    form.submit()
  }
}
function Cancel_Email(form)
{
  form.action="index.php"
  form.target=""
  form.act.value="void"
  form.user.value="void"
  form.esact.value="void"
  form.submit()
}
function ValidChars(str,valid)
{
  var v=true;
  for (i=0;i<str.length;i++)
  {
    if (valid.indexOf(str.charAt(i))==-1)
    {
      v=false
      break
    }
  }
  return(v)
}
function fileextension(fname)
{
	if (fname=="")
	  return("")
	var pos=fname.lastIndexOf(".")
	if (pos>-1)
	{
	  var ext=fname.substring(pos)
	  return(ext.toLowerCase())
	}
	return("")
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
function Trim(str)
{
  return str.replace(/^\s*|\s*$/g,"");
}

// -->
</script>

<?php
if ($act=="emaildirect")
  include "headersendemail.php"; 
else
  include "headeremailuser.php"; 
?>
<?php
if ($errormsg!="")
	print "<p class=\"emailusererror\">$errormsg</p>\n";  
?>

<form name="emailform" action="" method="POST">
<input name="act" type="hidden" value="<?php echo $act; ?>">
<input name="user" type="hidden" value="<?php echo $user; ?>">
<input name="tablestart" type="hidden" value="<?php echo $tablestart; ?>">
<input name="sqlquery" type="hidden" value="<?php echo $sqlquery; ?>">
<input name="sqlinput" type="hidden" value="<?php echo $sqlinput; ?>">
<input name="filfield1" type="hidden" value="<?php echo $filfield1; ?>">
<input name="filcond1" type="hidden" value="<?php echo $filcond1; ?>">
<input name="fildata1" type="hidden" value="<?php echo $fildata1; ?>">
<input name="filfield2" type="hidden" value="<?php echo $filfield2; ?>">
<input name="filcond2" type="hidden" value="<?php echo $filcond2; ?>">
<input name="fildata2" type="hidden" value="<?php echo $fildata2; ?>">
<input name="filfield3" type="hidden" value="<?php echo $filfield3; ?>">
<input name="filcond3" type="hidden" value="<?php echo $filcond3; ?>">
<input name="fildata3" type="hidden" value="<?php echo $fildata3; ?>">
<input name="filfield4" type="hidden" value="<?php echo $filfield4; ?>">
<input name="filcond4" type="hidden" value="<?php echo $filcond4; ?>">
<input name="fildata4" type="hidden" value="<?php echo $fildata4; ?>">
<input name="filbool1" type="hidden" value="<?php echo $filbool1; ?>">
<input name="filbool2" type="hidden" value="<?php echo $filbool2; ?>">
<input name="filbool3" type="hidden" value="<?php echo $filbool3; ?>">
<input name="sortf" type="hidden" value="<?php echo $sortf; ?>">
<input name="sortd" type="hidden" value="<?php echo $sortd; ?>">
<input name="filteron" type="hidden" value="<?php echo $filteron; ?>">
<input name="emailact" type="hidden" value="<?php echo $emailact; ?>">
<input name="esact" type="hidden" value="">
<input name="recordsperpage" type="hidden" value="<?php echo $recordsperpage; ?>">
<div class="emailuser">
<table class="emailuser">
    <tr>
        <th class="emailuser">Load template</th>
        <td class="emailuser">
                <select class="emailuser" name="template" size="1">
                <option value="">Select email template</option>
                <?php
                $templates=scandir($emailpath,0);
                natcasesort($templates); 
                if ($templates!==false)
                {
                  foreach ($templates as $entryname)
                  {
                    if (($entryname!=".") && ($entryname!="..") && ($entryname!=""))
					          {
                      print "<option value=\"$entryname\"";
						          if ($template==$entryname)
						            print "  selected=\"selected\" ";
						          print ">$entryname</option>";
					          }	
                  }
                }
                ?>
                </select>&nbsp;<input class="emailuser" type="button" name="load" value="Load"  OnClick="Load(this.form);"></td>
    </tr>
    <tr>
      <th class="emailuser">Save template</th>
      <td class="emailuser"><input class="emailuser" name="savefilename" type="text" value="<?php if ($savefilename=="") echo $template; else echo $savefilename; ?>">
        <input class="emailuser" name="Save" type="button" id="Save" onClick="Save_Email(this.form);" value="Save">
        </td>
    </tr>
  	<?php
  	if ($act=="emaildirect")
  	{
  	?>
      <tr>
        <th class="emailuser">To</th>
        <td class="emailuser"><input class="emailuser" type="text" name="email" id="email" value="<?php echo $email; ?>" size="55"></td>
      </tr>
  	<?php
  	}
  	?>    
    <tr>
        <th class="emailuser">Subject</th>
        <td class="emailuser">
            <input class="emailuser" type="text" name="subject" value="<?php echo $subject; ?>" maxlength="150" size="55">
            </td>
    </tr>
    <tr>
        <th class="emailuser">HTML format</th>
        <td class="emailuser">
                            <input class="emailuser" type="checkbox" name="htmlformat" value="Y" <?php if ($htmlformat=="Y") print "checked"; ?>>
                            tick box to send in html format</td>
    </tr>
    <tr>
        <td class="emailuser" colspan="2">
            <textarea class="emailuser" name="body" wrap="virtual"><?php echo $mailBody; ?></textarea>
            </td>
    </tr>
    <tr>
        <td class="emailuser"><input class="emailuser" type="button" name="cancel" value="Cancel" onClick="Cancel_Email(this.form);">
        </td>
        <td class="emailuser" align="right">
          <input class="emailuser" type="button" name="preview" value="Preview" onClick="Preview_Email(this.form);">
          <input class="emailuser" type="button" name="send" value="Send Email" onClick="Send_Email(this.form);">
        </td>
    </tr>
</table>
</form>
</div>
<script type="text/javascript">
<!-- JavaScript
document.emailform.subject.focus()
// - JavaScript - -->
</script>
<?php
if ($act=="emaildirect")
  include "footersendemail.php"; 
else
  include "footeremailuser.php"; 
?>
</body>

</html>