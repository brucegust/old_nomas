<?php
	$groupswithaccess="ADMIN";
	$startpage="index.php";
	$dbupdate=true;
  require_once("sitelokpw.php");
  // Connect to mysql
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  // If entering page
  if (!isset($_POST['save']))
  {
    $act=$_GET['act'];
    $actname=$_GET['actname'];
    $actid=$_GET['actid'];
    // If edit then get current group details
    if ($act=="editgroup")
    {
      $query="SELECT * FROM ".$DbGroupTableName." WHERE id=".sl_quote_smart($actid);
      $mysql_result=mysqli_query($mysql_link,$query);
      if ($mysql_result!=false)
    	{
        $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
        if (!$row)
        {
          print "Could not access usergroup";
          exit;
        }
        $newgroupname=$row['name'];
        $newdescription=$row['description'];
        $newloginaction=$row['loginaction'];
        $newloginvalue=$row['loginvalue'];
      }
      else
      {
        print "Could not access usergroup";
        exit;      
      }  
    }
  }
  if (isset($_POST['save']))
  {
    $problemmsg="";
    $act=$_POST['act'];
    $actname=$_POST['actname'];
    $actid=$_POST['actid'];
    $slcsrf=$_POST['slcsrf'];
    if ($slcsrf!=$_SESSION['ses_slcsrf'])
    {
      print "Form tampering detected";
      exit;
    }      
    $newgroupname=trim($_POST['newgroupname']);
    $newdescription=trim($_POST['newdescription']);
    $newloginaction=$_POST['newloginaction'];
    $newloginvalue=trim($_POST['newloginvalue']);     
    if (get_magic_quotes_gpc())
    {
      $newgroupname=stripslashes($newgroupname);
      $newdescription=stripslashes($newdescription);
      $newloginaction=stripslashes($newloginaction);
      $newloginvalue=stripslashes($newloginvalue);     
    }
    // Validate input
    if (($problemmsg=="") && ($newgroupname==""))
      $problemmsg="Please enter a name for the usergroup";       
    if (($problemmsg=="") && (strspn($newgroupname,"#{}()@.0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") != strlen($newgroupname)))
      $problemmsg="Usergroup name contains invalid characters";
    if (($problemmsg=="") && ($newloginaction=="URL") && ($newloginvalue==""))
      $problemmsg="Please enter a URL to redirect to on login";    
    if (($problemmsg=="") && ($act=="addgroup") && (!$DemoMode))
    {
      $_SESSION['ses_ConfigReload']="reload";
      $mysql_result=mysqli_query($mysql_link,"INSERT INTO ".$DbGroupTableName." (name,description,loginaction,loginvalue) VALUES(".sl_quote_smart($newgroupname).",".sl_quote_smart($newdescription).",".sl_quote_smart($newloginaction).",".sl_quote_smart($newloginvalue).")");
      if (!$mysql_result)
      {
        $problemmsg="This usergroup already exists";
      }
      else
      { 
        // Event point
        // Call event handler and plugins
        $groupid=mysqli_insert_id($mysql_link);
        $paramdata['oldname']="";
        $paramdata['name']=$newgroupname;
        $paramdata['groupid']=$groupid;
        $paramdata['description']=$newdescription;
        $paramdata['loginaction']=$newloginaction;
        $paramdata['loginvalue']=$newloginvalue;
        if (function_exists("sl_onAddGroup"))
          sl_onAddGroup($paramdata);
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onAddGroup[$p]))
            call_user_func($slplugin_event_onAddGroup[$p],$slpluginid[$p],$paramdata);
        }
        header("Location: groupmanage.php");
        exit;
      }
    }
    if (($problemmsg=="") && ($act=="editgroup") && (!$DemoMode))
    {
      $_SESSION['ses_ConfigReload']="reload";
      $mysql_result=mysqli_query($mysql_link,"UPDATE ".$DbGroupTableName." SET name=".sl_quote_smart($newgroupname).", description=".sl_quote_smart($newdescription).", loginaction=".sl_quote_smart($newloginaction).", loginvalue=".sl_quote_smart($newloginvalue)." WHERE id=".sl_quote_smart($actid));
      if (!$mysql_result)
      {
        $problemmsg="This usergroup already exists";
      }
      else
      { 
        // Event point
        // Call event handler and plugins
        $paramdata['oldname']=$actname;
        $paramdata['name']=$newgroupname;
        $paramdata['groupid']=$actid;
        $paramdata['description']=$newdescription;
        $paramdata['loginaction']=$newloginaction;
        $paramdata['loginvalue']=$newloginvalue;
        if (function_exists("sl_onModifyGroup"))
          sl_onModifyGroup($paramdata);
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onModifyGroup[$p]))
            call_user_func($slplugin_event_onModifyGroup[$p],$slpluginid[$p],$paramdata);
        }
        header("Location: groupmanage.php");
        exit;
      }
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
<link href="stylesgroupmanage.css" rel="stylesheet" type="text/css"> 
<title>Manage Usergroups</title>
<script  type="text/javascript">
function loginAction()
{
  var sel= document.getElementById("newloginaction")
  var txt= document.getElementById("newloginvalue")
  if (sel.value=="URL")
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
</script>
</head>
<body>
<?php include "headeradminother.php"; ?>
<?php if ($act=="editgroup") { ?><h1>Edit usergroup</h1><?php } ?>
<?php if ($act=="addgroup") { ?><h1>Add usergroup</h1><?php } ?>
<form name="usergroups" action="groupmanage2.php" method="post">
<?php if ($problemmsg!="") { ?>
<p class="formerror"><?php echo $problemmsg; ?></p>
<?php } ?>
<input type="hidden" name="act" value="<?php echo $act; ?>">
<input type="hidden" name="actname" value="<?php echo $actname; ?>">
<input type="hidden" name="actid" value="<?php echo $actid; ?>">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<fieldset class="enabledplugins">
<legend>Usergroup</legend>

<div class="blankspace"></div>

<div class="verticalfield">
<label class="verticalfield" for="newgroupname">Usergroup name</label>
<input class="inputtext" type="text" name="newgroupname" id="newgroupname" maxlength="255" value="<?php echo $newgroupname ?>">
</div>

<div class="verticalfield">
<label class="verticalfield" for="newdescription">Usergroup description</label>
<input class="inputtext long" type="text" name="newdescription" id="newdescription" maxlength="255" value="<?php echo $newdescription ?>">
</div>

<div class="verticalfield">
<label class="verticalfield" for="newloginaction">Login action</label>
<select name="newloginaction" id="newloginaction" size="1" onchange="loginAction();">
  <option value="" <?php if ($newloginaction=="") echo "selected=\"selected\""; ?>>None</option>
  <option value="URL" <?php if ($newloginaction=="URL") echo "selected=\"selected\""; ?>>Redirect to URL</option>
<?php
  for ($k=1;$k<=50;$k++)
  {
    $namevar="custom".$k;
    $titlevar="CustomTitle".$k;
    if ($$titlevar=="")
      $$titlevar="Custom ".$k;
    ?>  
    <option value="<?php echo $namevar; ?>" <?php if ($newloginaction==$namevar) echo "selected=\"selected\"";?>>Redirect to entry - <?php echo $$titlevar; ?></option>
    <?php
  }
?>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="newloginvalue">URL</label>
<input class="inputtext long" type="text" name="newloginvalue" id="newloginvalue" maxlength="255" value="<?php echo $newloginvalue; ?>">
</div>


</fieldset>

<div>
<div><button type="submit" id="save-go" name="save" value="Save">Save</button><button type="button" id="cancel-go" value="Cancel" onclick="location.href='groupmanage.php'">Cancel</button></div>
</div>

</form>
<script  type="text/javascript">
  loginAction()
  var obj=document.getElementById("newgroupname")
  obj.focus()
</script>
<?php include "footeradminother.php"; ?>
</body>
</html>