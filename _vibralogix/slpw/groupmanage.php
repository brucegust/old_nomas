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
  $act=$_POST['act'];
  $actid=$_POST['actid'];
  $actname=$_POST['actname'];
  $slcsrf=$_POST['slcsrf'];  
  if (($act=="delete") && ($actname!="") && (!$DemoMode))
  {
    if ($slcsrf!=$_SESSION['ses_slcsrf'])
    {
      print "Form tampering detected";
      exit;
    }  
    $_SESSION['ses_ConfigReload']="reload";
    if (($actname!="ADMIN") && ($actname!="ALL"))
    {
      $mysql_result=mysqli_query($mysql_link,"DELETE FROM ".$DbGroupTableName." WHERE id=".sl_quote_smart($actid));
      if (!$mysql_result)
      {
        $problemmsg="Could not delete group";
      }
      else
      { 
        // Event point
        // Call event handler and plugins
        $paramdata['oldname']="";
        $paramdata['name']=$actname;
        $paramdata['groupid']=$actid;
        $paramdata['description']="";
        $paramdata['loginaction']="";
        $paramdata['loginvalue']="";
        if (function_exists("sl_onDeleteGroup"))
          sl_onDeleteGroup($paramdata);
        for ($p=0;$p<$slnumplugins;$p++)
        {
          if (function_exists($slplugin_event_onDeleteGroup[$p]))
            call_user_func($slplugin_event_onDeleteGroup[$p],$slpluginid[$p],$paramdata);
        }
      }
    }
    else
      $problemmsg=$actname." cannot be deleted";
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
function Delete_Group(n,id)
{
  if (n=="ADMIN")
  {
    alert("You can't delete the ADMIN usergroup")
    return
  }
  if (n=="ALL")
  {
    alert("You can't delete the ALL usergroup")
    return
  }
  if (confirm("Delete this usergroup?"))
  { 
    document.usergroups.act.value="delete"
    document.usergroups.actname.value=n
    document.usergroups.actid.value=id
    document.usergroups.target=""
    document.usergroups.submit()
  }
}

</script>
</head>
<body>
<?php include "headeradminother.php"; ?>
<h1>Manage usergroups</h1>
<form name="usergroups" action="groupmanage.php" method="post">
<?php if ($problemmsg!="") { ?>
<p class="formerror"><?php echo $problemmsg; ?></p>
<?php } ?>
<input type="hidden" name="act" value="">
<input type="hidden" name="actname" value="">
<input type="hidden" name="actid" value="">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">
<fieldset class="enabledplugins">
<legend>Usergroups</legend>
<div class="blankspace"></div>
<table>
<?php
  $query="SELECT * FROM ".$DbGroupTableName." ORDER BY name ASC";
  $mysql_result=mysqli_query($mysql_link,$query);
  if ($mysql_result!=false)
	{
    while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
    {
      $name=$row['name'];
      $description=$row['description'];
      $loginaction=$row['loginaction'];
      $loginvalue=$row['loginvalue'];
      $groupid=$row['id'];
      ?>
<tr>      
<td class="editgroup">
<a href="groupmanage2.php?act=editgroup&actid=<?php echo $groupid; ?>&actname=<?php echo $name; ?>"><img src="edit.png" alt="Edit usergroup" title="Edit usergroup"></a>
</td>

<td class="deletegroup">
<img src="delete.png" onclick='Delete_Group("<?php echo $name; ?>","<?php echo $groupid; ?>");' alt="Delete usergroup" title="Delete usergroup">
</td>

<td class="groupname">
<p><?php echo $name; ?></p>
</td>

<td class="groupdesc">
<p><?php echo $description; ?></p>
</td>

</tr>
<?php
    }
  }  
?>
<tr>
<td colspan="4">&nbsp;</td>
</tr>

<tr>
<td class="addgroup">
<a href="groupmanage2.php?act=addgroup"><img src="add.png" alt="Add usergroup" title="Add usergroup"></a>
</td>
<td class="addgrouptext" colspan="3">
<a href="groupmanage2.php?act=addgroup">Add new group</a>
</td>
</tr>

</table>

</fieldset>

<div>
<button type="button" id="goback-go" name="goback" value="Go Back" onclick="location.href='index.php'">Go Back</button>
</div>

</form>

<?php include "footeradminother.php"; ?>
</body>
</html>