<?php
  reset($_GET);
  reset($_POST);
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (!empty($_POST)) while(list($name, $value) = each($_POST)) $$name = $value;
	$groupswithaccess="ADMIN";
	$startpage="index.php";
  require("sitelokpw.php");
  if ($slcsrf!=$_SESSION['ses_slcsrf'])
  {
    print "Form tampering detected";
    exit;
  }  
  if (isset($_GET['user']))
    $user=urldecode($user);
  if ($EmailURL!="")
    $emailpathrtr=GetRelativeToRoot($EmailURL);
  else
    $emailpathrtr="/slpw/email";
  if ($EmailLocation!="")
    $emailpath=$EmailLocation;
  else
    $emailpath=$SitelokLocation."email/";          
  if (($htmlformat=="") && ($DefaultEmailFormat!=""))
  {
    if ($DefaultEmailFormat=="HTML")
      $htmlformat="Y";
    else  
      $htmlformat="N";
  }  
  if ($htmlformat=="")
    $htmlformat="Y";
  if (get_magic_quotes_gpc())
  {
    $body=stripslashes($body);
    $subject=stripslashes($subject);    
  }
  if (($emailact=="sendselected") || ($emailact=="previewemail"))
  {
    // Store email in session for external page access
    $_SESSION['ses_slemailbody']=$body;
    $_SESSION['ses_slemailsubject']=$subject;
    $_SESSION['ses_slemailhtmlformat']=$htmlformat;
    $_SESSION['ses_slemailsortf']=$sortf;
    $_SESSION['ses_slemailsortf']=$sortd;
    $_SESSION['ses_slemaildedupe']=$dedupe;
    $_SESSION['ses_slemailuser']=$user;
    $_SESSION['ses_slemailemail']=$email;
  }
  if (($emailact=="save") &&  (!$DemoMode))
  {
    if (!is_writable($emailpath.$template))
      @chmod($emailpath.$template,0777);
    $myfile=@fopen($emailpath.$template,"w");
    if ($myfile===false)
    {
			$errormsg="Template ".$template." could not be saved";
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
				// Standardise the eachgroup comments
				$body=preg_replace("/<!--.{0,4}eachgroupstart.{0,4}-->/i","<!--eachgroupstart-->",$body);
				$body=preg_replace("/<!--.{0,4}eachgroupend.{0,4}-->/i","<!--eachgroupend-->",$body);
        // Firefox converts ! to %21, ( to %28, ) to %29, & to &amp; so convert these back.
			  $body=str_replace("%21","!",$body);
			  $body=str_replace("%28","(",$body);
			  $body=str_replace("%29",")",$body);        
        $body=str_replace("&amp;","&",$body);
        $body=str_replace(chr(0xC2).chr(0xA0)," ",$body); 
        // Remove any contentEditiable="true" as this causes issues with IE9 on some systems
        $body=str_replace("contentEditable=\"true\"","",$body);
        // Change "styles/default.css" to be full URL
        $body=str_replace("\"styles/default.css\"","\"".$SitelokLocationURL."styles/default.css\"",$body);        
        fwrite($myfile,$body);
      }  
      fclose($myfile);
    }    
  }
  if ($emailact=="load")
  {
    if (sl_ReadEmailTemplate($template,$subject,$mailBody,$htmlformat)==false)
		{
			$errormsg="Template ".$template." could not be opened";
	  }
	  if ($htmlformat=="")
	    $htmlformat="N";
  }
  else
  {
    $mailBody=$body;
  }
  function GetRelativeToRoot($a)
  {
    $pos=strpos($a,"/",8);
    if (is_integer($pos))
      $a=substr($a,$pos);
    else
      return("/");
    if ($a!="/")    
      $a=RemoveLastSlash($a);
    return($a);    
  } 
  function RemoveLastSlash($a)
  {
    if (substr($a,strlen($a)-1,1)=="/")
      $a=substr($a,0,strlen($a)-1);  
    return($a);     
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>
<?php
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>
<link href="stylesemailuser.css" rel="stylesheet" type="text/css">
<title>Email users</title>
<script  src="scripts/innovaeditor.js"></script>

    <script  type="text/javascript">
        function fileclick(url) {
          url=GetRelativeToRoot(url)
          emailurl="<?php echo $EmailURL; ?>"
          emailurl=GetRelativeToRoot(emailurl)
          url=url.substr(emailurl.length)
          url=RemoveFirstSlash(url)
          document.getElementById("template").value = url;
        }    
    </script>

<!--
    <script src="assetmanager/jquery/jquery-1.7.min.js" type="text/javascript"></script>
    <script src="assetmanager/fancybox/jquery.easing-1.3.pack.js" type="text/javascript"></script>
    <script src="assetmanager/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
    <script src="assetmanager/fancybox/jquery.mousewheel-3.0.4.pack.js" type="text/javascript"></script>
    <link href="assetmanager/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
-->
	  <script type="text/javascript" src="fancybox/lib/jquery-1.9.0.min.js"></script>
	  <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.4"></script>
	  <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
	  <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <script  type="text/javascript">
$(document).ready(function() {
	$(".assetm").fancybox({
		width		: 500,
		height		: 400,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		overlayShow	:	false,
		closeEffect	: 'none',
	   helpers : {
        overlay : {
            css : {
                'background' : 'rgba(58, 42, 45, 0)'
            }
        }
    }		
		
	});
});

    </script>


<script >
function LoadTemplate(form)
{
  <?php if ($htmlformat=="Y") print "form.onsubmit()\n"; ?>
	if (form.template.value=="")
	{
	  alert("Please select a template to load")
	  form.template.focus()
	  return
	}  
	var ext=fileextension(form.template.value)
  if ((ext!=".txt") && (ext!=".html") && (ext!=".htm"))
  {
	  alert("The template should have the extension .txt .htm or .html")
	  form.template.focus()    
    return  
  }  
	form.action="emailuser.php"
	form.emailact.value="load"
  form.esact.value="void"
  form.target=""
	form.submit()
}
function SaveTemplate(form)
{
  <?php if ($htmlformat=="Y") print "form.onsubmit()\n"; ?>
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
	if (form.template.value=="")
	{
		alert("Please enter a filename")
    form.template.focus()
		return
	}
	if (!ValidChars(form.template.value,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_()/"))
	{
		alert("Filename contains invalid characters")
    form.template.focus()
		return	  
	}
	var ext=fileextension(form.template.value)
	if ((ext=="") && (form.htmlformat.value=="Y"))
	  form.template.value=form.template.value+".htm"
	if ((ext==".") && (form.htmlformat.value=="Y"))
	  form.template.value=form.template.value+"htm"
	if ((ext=="") && (form.htmlformat.value!="Y"))
	  form.template.value=form.template.value+".txt"
	if ((ext==".") && (form.htmlformat.value!="Y"))
	  form.template.value=form.template.value+"txt"
	// Get extension again in case it was modified above  
	var ext=fileextension(form.template.value)
	if (((ext==".htm") || (ext==".html")) && (form.htmlformat.value!="Y"))
	{
		alert("You should only use the "+ext+" extension for html format emails")
    form.template.focus()
		return
	}
	if (((ext!=".htm") && (ext!=".html")) && (form.htmlformat.value=="Y"))
	{
		alert("You should use the .htm extension for html format emails")
    form.template.focus()
		return
	}	
	if (!confirm("This will overwrite any file with the same name"))
	{
	  return
	}
  form.emailact.value="save"
  form.action="emailuser.php"
  form.target=""
  form.submit()
}
function Preview_Email(form)
{
  <?php if ($htmlformat=="Y") print "form.onsubmit()\n"; ?>
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
  form.action="emailuser.php"
  form.emailact.value="previewemail"
  form.submit()
}
function Send_Email(form)
{
  <?php if ($htmlformat=="Y") print "form.onsubmit()\n"; ?>
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
	    form.action="emailuser.php"
	    form.esact.value="void"
      form.emailact.value="sendselected"
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
  window.location = 'index.php'
}
function SwitchFormat(form)
{
  <?php if ($htmlformat=="Y") print "form.onsubmit()\n"; ?>
  if (form.htmlformat.value=="Y")
    form.htmlformat.value="N"
  else
    form.htmlformat.value="Y"    
  form.emailact.value="switchformat"
  form.action="emailuser.php"
  form.target=""
  form.submit()
}

function Insert_Tag(form)
{
  tag=form.inserttag.value
  oEdit1.focus()   
  if (tag=="username")
    oUtil.obj.insertHTML("!!!username!!!")
  if (tag=="password")
    oUtil.obj.insertHTML("!!!password!!!")
  if (tag=="passwordclue")
    oUtil.obj.insertHTML("!!!passwordclue!!!")
  if (tag=="passwordhash")
    oUtil.obj.insertHTML("!!!passwordhash!!!")
  if (tag=="name")
    oUtil.obj.insertHTML("!!!name!!!")
  if (tag=="firstname")
    oUtil.obj.insertHTML("!!!firstname!!!")
  if (tag=="lastname")
    oUtil.obj.insertHTML("!!!lastname!!!")
  if (tag=="email")
    oUtil.obj.insertHTML("!!!email!!!")
  if (tag=="sitename")
    oUtil.obj.insertHTML("!!!sitename!!!")
  if (tag=="siteemail")
    oUtil.obj.insertHTML("!!!siteemail!!!")
  if (tag=="siteemail2")
    oUtil.obj.insertHTML("!!!siteemail2!!!")
  if (tag=="date")
    oUtil.obj.insertHTML("!!!date!!!")
  if (tag=="ip")
    oUtil.obj.insertHTML("!!!ip!!!")
<?php for ($k=1;$k<=50;$k++) { ?>
  if (tag=="custom<?php echo $k; ?>")
    oUtil.obj.insertHTML("!!!custom<?php echo $k; ?>!!!")
<?php } ?>
  if (tag=="groups")
    oUtil.obj.insertHTML("!!!groups!!!")
  if (tag=="groupname")
    oUtil.obj.insertHTML("!!!groupname!!!")
  if (tag=="groupdesc")
    oUtil.obj.insertHTML("!!!groupdesc!!!")
  if (tag=="groupexpiry")
    oUtil.obj.insertHTML("!!!groupexpiry!!!")
  if (tag=="groupremove")
    oEdit1.insertLink("!!!groupremove!!!","Remove group","")
  if (tag=="groupstartloop")
    oUtil.obj.insertHTML("<!--eachgroupstart-->")
  if (tag=="groupendloop")
    oUtil.obj.insertHTML("<!--eachgroupend-->")
  if (tag=="link()")
    oEdit1.insertLink("!!!link(filename,expiry)!!!","download","")
  if (tag=="size()")
    oUtil.obj.insertHTML("!!!size(filename)!!!")
  if (tag=="passwordhash()")
    oUtil.obj.insertHTML("!!!passwordhash(minutes)!!!")
  if (tag=="approve")
    oEdit1.insertLink("!!!approve!!!","approve","")
  if (tag=="approve()")
    oEdit1.insertLink("!!!approve(expiry,clienttemplate,admintemplate,redirectpage)!!!","approve","")
  if (tag=="disable")
    oEdit1.insertLink("!!!disable!!!","disable","")
  if (tag=="disable()")
    oEdit1.insertLink("!!!disable(expiry,clienttemplate,admintemplate,redirectpage)!!!","disable","")
  if (tag=="delete")
    oEdit1.insertLink("!!!delete!!!","delete","")
  if (tag=="delete()")
    oEdit1.insertLink("!!!delete(expiry,clienttemplate,admintemplate,redirectpage)!!!","delete","")
  if (tag=="newpassword")
    oUtil.obj.insertHTML("!!!newpassword!!!")
  if (tag=="activatepassword")
    oEdit1.insertLink("!!!activatepassword!!!","activate","")
  if (tag=="verifyemail")
    oEdit1.insertLink("!!!verifyemail!!!","verifyemail","")
  if (tag=="verifyemail()")
    oEdit1.insertLink("!!!verifyemail(expiry,clienttemplate,admintemplate,redirectpage)!!!","verifyemail","")
  if (tag=="addgroup()")
    oEdit1.insertLink("!!!addgroup(expiry,group,groupexpiry,clienttemplate,admintemplate,redirectpage)!!!","add group","")
  if (tag=="removegroup()")
    oEdit1.insertLink("!!!removegroup(expiry,group,clienttemplate,admintemplate,redirectpage)!!!","remove group","")
  if (tag=="replacegroup()")
    oEdit1.insertLink("!!!replacegroup(expiry,group,newgroup,groupexpiry,clienttemplate,admintemplate,redirectpage)!!!","replace group","")
  if (tag=="extendgroup()")
    oEdit1.insertLink("!!!extendgroup(expiry,group,groupexpiry,expirytype,clienttemplate,admintemplate,redirectpage)!!!","extend group","") 
<?php
  // Get any plugin related template variables (such as !!!unsubscribe!!!)
  for ($k=0;$k<count($slplugin_templatevariablename);$k++)
  {
    if ($slplugin_templatevariabletype[$k]=="link")
    {
?>
  if (tag=="<?php echo $slplugin_templatevariablename[$k]; ?>")
    oEdit1.insertLink("<?php echo $slplugin_templatevariablecode[$k]; ?>","<?php echo $slplugin_templatevariablelink[$k]; ?>","") 
<?php } 
    if ($slplugin_templatevariabletype[$k]=="html")
    {
?>
  if (tag=="<?php echo $slplugin_templatevariablename[$k]; ?>")
    oUtil.obj.insertHTML("<?php echo $slplugin_templatevariablecode[$k]; ?>")
<?php } ?>
<?php } ?>
  oEdit1.focus()   
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

function GetRelativeToRoot(url)
{
  var pos=url.indexOf("/",8)
  if (pos!=-1)
    url=url.substring(pos)
  else
    return("/");
  if (url!="/")    
    url=RemoveLastSlash(url);
  return(url);    
}

function RemoveLastSlash(url)
{
  if (url.substring(url.length-1)=="/")
    url=url.substring(0,url.length-1)
  return(url);
}

function RemoveFirstSlash(url)
{
  if (url.substring(0,1)=="/")
    url=url.substring(1)
  return(url);
}

</script>

</head>

<body>
<?php
  include "headeradminother.php"; 
?>
<?php if ($act=="emailuser") { ?>
<h1>Send email to <?php echo htmlentities($user,ENT_QUOTES,strtoupper($MetaCharSet)); ?></h1>
<?php } ?>

<?php if ($act=="emailselected") { ?>
<h1>Send email to selected users</h1>
<?php } ?>

<?php if ($act=="emaildirect") { ?>
<h1>Send Email</h1>
<?php } ?>

<?php
if ($errormsg!="")
	print "<p class=\"emailusererror\">$errormsg</p>\n";  
?>

<form name="emailform" id="emailform" action="" method="POST">
<input name="act" type="hidden" value="<?php echo htmlentities($act,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
<input name="user" type="hidden" value="<?php echo htmlentities($user,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
<input name="emailact" type="hidden" value="<?php echo htmlentities($emailact,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
<input name="esact" type="hidden" value="">
<input name="htmlformat" type="hidden" value="<?php echo htmlentities($htmlformat,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<div class="emailuser">
<table class="emailuser">
    
    <tr>
        <th class="emailuser">Template Filename</th>
        <td class="emailuser">
        <input class="inputtext" name="template" type="text" id="template" value="<?php echo htmlentities($template,ENT_QUOTES,strtoupper($MetaCharSet)); ?>">
        <a class="assetm fancybox.iframe" href="assetmanager/asset.php"><img class="emailuser" src="folder.png" alt="Browse" width="18" height="16" border="0" align="top"></a>
        <button type="button" id="load-go" name="load" value="Load" onclick="LoadTemplate(this.form);">Load</button>
        <button type="button" id="savesm-go" name="Save" value="Save" onclick="SaveTemplate(this.form);">Save</button>
        </td>
    </tr>
    <tr>
      <th class="emailuser">Email Format</th>
      <td class="emailuser">
      <?php if ($htmlformat=="Y") { ?>
      <button type="button" id="switchtext-go" name="switch" value="Switch" onclick="SwitchFormat(this.form);">Switch</button>
      <?php } else { ?>
      <button type="button" id="switchhtml-go" name="switch" value="Switch" onclick="SwitchFormat(this.form);">Switch</button>
      <?php } ?>
      </td>
    </tr>
	<?php
	if ($act=="emaildirect")
	{
	?>
    <tr>
      <th class="emailuser">To</th>
      <td class="emailuser"><input class="inputtext" type="text" name="email" id="email" value="<?php echo htmlentities($email,ENT_QUOTES,strtoupper($MetaCharSet)); ?>" size="55"></td>
    </tr>
	<?php
	}
	?>
	<?php
	if ($act=="emailselected")
	{
	?>
    <tr>
        <th class="emailuser">Dedupe email addresses</th>
        <td class="emailuser">
            <input class="inputcheckbox" type="checkbox" name="dedupe" value="dedupe" checked >
             <span class="cbfieldnote">Check to email only once to each email address</span>
        </td>
    </tr>
	<?php
	}
	?>
    <tr>
        <th class="emailuser">Subject</th>
        <td class="emailuser">
            <input class="inputtext long" type="text" name="subject" id="subject" value="<?php echo htmlentities($subject,ENT_QUOTES,strtoupper($MetaCharSet)); ?>" maxlength="150" size="55">
        </td>
    </tr>
    
    <tr>
        <td colspan="2">
        <?php if ($htmlformat=="Y") { ?>
            <textarea name="body" id="body" wrap="virtual">
            <?php
            function encodeHTML($sHTML)
            {
              $sHTML=str_replace("&","&amp;",$sHTML);
              $sHTML=str_replace("<","&lt;",$sHTML);
              $sHTML=str_replace(">","&gt;",$sHTML);
              return $sHTML;
            }
            $sContent=stripslashes($mailBody); //Remove slashes
            echo encodeHTML($sContent);
            ?>
            <?php //echo $mailBody; ?>
            </textarea>
            <?php } else {?>
            <textarea class="emailuser" name="body" id="body" wrap="virtual"><?php echo $mailBody; ?></textarea>
            <?php } ?>            
              <?php
if ($htmlformat=="Y")
{
?>
  <script>
var oEdit1 = new InnovaEditor("oEdit1");
oEdit1.groups = [
        ["group1", "", ["FontName", "FontSize", "Superscript", "Subscript", "ForeColor", "BackColor", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "TextDialog", "Styles", "RemoveFormat"]],
        ["group2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Paragraph", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
        ["group3", "", ["TableDialog", "Emoticons", "FlashDialog", "CharsDialog", "BRK", "LinkDialog", "ImageDialog", "YoutubeDialog", "Line"]],
        ["group4", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo", "FullScreen"]]
        ];
oEdit1.returnKeyMode = 2;
oEdit1.enableFlickr = false;
oEdit1.enableLightbox = false;
<?php
$pathtoassman=$_SERVER['SCRIPT_NAME'];
$pathtoassman=str_replace("/emailuser.php","/assetmanager/asset.php",$pathtoassman);
?>
oEdit1.fileBrowser = "<?php echo $pathtoassman; ?>";
/*
oEdit1.cmdAssetManager="modalDialogShow('<?php echo $pathtoassman; ?>',640,465);";
oEdit1.useDIV=false;
oEdit1.useBR=true;
oEdit1.mode="HTML";
*/
oEdit1.width="700px";
oEdit1.height="400px";
oEdit1.css = "styles/default.css";
oEdit1.mode = "XHTML";
oEdit1.REPLACE("body");
oEdit1.initialRefresh=true;
</script>
  <?php
}

?>
</td>
    </tr>
    
<tr>
<td colspan="2" class="inserttags">
<select name="inserttag" style="font-family: arial,helvetica; font-size: 8pt; font_align: left;">
<option value="">Select tag to insert...</option>
<option value="username">Username</option>
<option value="password">Password</option>
<option value="passwordclue">Password Clue</option>
<option value="passwordhash">Password Hash</option>
<option value="passwordhash()">Password hash expiring (edit parameter)</option>
<option value="name">Name</option>
<option value="firstname">First Name</option>
<option value="lastname">Last Name</option>
<option value="email">Email</option>
<option value="sitename">Site Name</option>
<option value="siteemail">Site Email</option>
<option value="siteemail2">Site Email2</option>
<option value="date">Date</option>
<option value="ip">IP Address</option>
<?php
for ($k=1;$k<=50;$k++)
{
  $titlevar="CustomTitle".$k;
  if ($$titlevar!="")
  {
    print "<option value=\"custom".$k."\">".htmlentities($$titlevar,ENT_QUOTES,strtoupper($MetaCharSet))."</option>\n"; 
  }
}
?>
<option value="groups">Groups</option>
<option value="groupname">Group Name</option>
<option value="groupdesc">Group Description</option>
<option value="groupexpiry">Group Expiry</option>
<option value="groupremove">Group Remove</option>
<option value="groupstartloop">Start Group Loop</option>
<option value="groupendloop">End Group Loop</option>
<option value="link()">File Link (edit parameters in html source)</option>
<option value="size()">File Size (edit parameter)</option>
<option value="approve">Approve Link</option>
<option value="approve()">Approve Link (edit parameters in html source)</option>
<option value="disable">Disable Link</option>
<option value="disable()">Disable (edit parameters in html source)</option>
<option value="delete">Delete Link</option>
<option value="delete()">Delete Link (edit parameters in html source)</option>
<option value="newpassword">New Password</option>
<option value="activatepassword">Activate Password Link</option>
<option value="verifyemail">Verify Email Link</option>
<option value="verifyemail()">Verify Email (edit parameters in html source)</option>
<option value="addgroup()">Add Group Link (edit parameters in html source)</option>
<option value="removegroup()">Remove Group Link (edit parameters in html source)</option>
<option value="replacegroup()">Replace Group Link (edit parameters in html source)</option>
<option value="extendgroup()">Extend Group Link (edit parameters in html source)</option>
<?php
// Get any plugin related template variables (such as !!!unsubscribe!!!)
for ($k=0;$k<count($slplugin_templatevariablename);$k++)
{
?>
<option value="<?php echo $slplugin_templatevariablename[$k]; ?>"><?php echo $slplugin_templatevariabledescription[$k]; ?></option>
<?php } ?>}
</select>
<button type="button" id="insert-go" name="insert" value="Insert" onclick="Insert_Tag(this.form);">Insert</button>
</td>
</tr>        
    <tr>
        <td class="emailuser"><button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button></td>
        <td class="emailuser" style="text-align: right;">
        <button type="button" id="preview-go" value="Preview" onclick="Preview_Email(this.form);">Preview</button>
        <button type="button" id="send-go" value="Send" onclick="Send_Email(this.form);">Send</button>
        </td>
    </tr>
</table>
</form>
</div>
<script  type="text/javascript">
  var obj=document.getElementById("template")
  obj.focus()
</script>
<?php
if ($emailact=="sendselected")
{
?>
<script  type="text/javascript">
jQuery.fancybox({
      'scrolling' : 'no',
      'modal' : true,
			'content'	:	"<iframe id=\"emailiframe\" src=\"emailselected.php?slcsrf=<?php echo $slcsrftoken; ?>&esact=start"+"\" scrolling=\"no\" frameborder=\"0\" width=\"400\" height=\"180\"></iframe>"			
	})      	  
</script>
<?php
}
if ($emailact=="previewemail")
{
?>
<script  type="text/javascript">
jQuery.fancybox({
      'scrolling' : 'no',
			'content'	:	"<iframe id=\"previewiframe\" src=\"previewemail.php?slcsrf=<?php echo $slcsrftoken; ?>&act=<?php echo $act; ?>"+"\" scrolling=\"yes\" frameborder=\"0\" width=\"800\" height=\"600\"></iframe>"			
	})      	  
</script>
<?php
}
?>
<?php
  include "footeradminother.php"; 
?>
</body>

</html>