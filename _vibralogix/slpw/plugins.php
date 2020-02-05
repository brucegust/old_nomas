<?php
	$groupswithaccess="ADMIN";
	$startpage="index.php";
	$dbupdate=true;
  require_once("sitelokpw.php");
  if ((!empty($_GET)) || (!empty($_POST)))
  {   
    if ($_REQUEST['slcsrf']!=$slcsrftoken)
    {
      print "Form tampering detected";
      exit;
    }
  }
  // Connect to mysql
  $mysql_link=sl_DBconnect();
  if ($mysql_link==false)
  {
    print("Can't connect to MySQL server");
    exit;
  }
  if (isset($_POST['save']))
  {
    foreach ($_POST as $key => $value)
    {
      if (substr($key,0,8)=="pluginid")
      {
        $plid=$value;
        if ($_POST['enabled'.$plid]=="Yes")
          $query="UPDATE ".$DbPluginsTableName." SET enabled='Yes' WHERE id=".sl_quote_smart($plid);
        else
          $query="UPDATE ".$DbPluginsTableName." SET enabled='No' WHERE id=".sl_quote_smart($plid);
        $mysql_result=mysqli_query($mysql_link,$query);
        if ($mysql_result==false)
        {
          print "Could not write plugin settings";
          exit;             
        }
      }
    }
    $_SESSION['ses_ConfigReload']="reload";  
    header("Location: index.php");
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
<link href="stylesplugins.css" rel="stylesheet" type="text/css"> 
<title>Plugins</title>
<script  type="text/javascript">
function Delete_Plugin(n,p)
{
  if (confirm("Delete "+n+" plugin and all associated settings?"))
  { 
    window.location = p
  }
}
</script>
</head>
<body>
<?php include "headeradminother.php"; ?>
<h1>Plugins</h1>
<form action="plugins.php" method="post">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<fieldset class="enabledplugins">
<legend>Enabled plugins</legend>
<br>
<?php

for ($p=0;$p<$slnumplugins;$p++)
{
  $query="SELECT * FROM ".$DbPluginsTableName." WHERE id=".$slpluginid[$p];
  $mysql_result=mysqli_query($mysql_link,$query);
  $row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC);
?>
<div class="pluginenabled">
<input type="hidden" name="pluginid<?php echo $slpluginid[$p]; ?>" value="<?php echo $slpluginid[$p]; ?>">
<input type="checkbox" name="enabled<?php echo $slpluginid[$p]; ?>" value="Yes" checked="checked" >
</div>
<div class="pluginconfigure">
<a href="<?php echo $slpluginfolder[$p]."/".$slplugin_adminpluginpage[$p]."?act=pluginconfig&slcsrf=".$slcsrftoken."&pluginid=".$slpluginid[$p]."&pluginindex=".$p; ?>"><img src="configure.png" alt="Configure plugin" title="Configure plugin"></a>
</div>
<div class="pluginicon">
<img src="<?php echo $slpluginfolder[$p]."/".$slplugin_icon[$p]; ?>">
</div>
<div class="pluginname">
<?php echo $slplugin_name[$p]." V".$row['version']; ?>
</div>
<div style="clear: both;"></div>

<?php } ?>
<?php if ($slnumplugins==0) { ?>
<p class="generaltext">There are no enabled plugins</p>
<?php } ?>
</fieldset>
<fieldset class="disabledplugins">
<legend>Disabled plugins</legend>
<br>
<?php
  if (sl_tableexists($mysql_link,$DbPluginsTableName))
  {
    $slpluginindex=$slnumplugins;
    $query="SELECT * FROM ".$DbPluginsTableName;
    $mysql_result=mysqli_query($mysql_link,$query);
    if ($mysql_result!=false)
    {
      while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
      {
        if ($row['enabled']!="Yes")
        {
          @include_once($SitelokLocation.$row['folder']."/config.php");  
?>
<div class="pluginenabled">
<input type="hidden" name="pluginid<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
<input type="checkbox" name="enabled<?php echo $row['id']; ?>" value="Yes">
</div>
<div class="pluginconfigure">
<img onclick="Delete_Plugin('<?php echo $slplugin_name[$slpluginindex]; ?>','<?php echo $row['folder']."/uninstall.php"; ?>')" src="delete.png" alt="Delete plugin" title="Delete plugin">
</div>
<div class="pluginicon">
<img src="<?php echo $row['folder']."/".$slplugin_icon[$slpluginindex]; ?>">
</div>
<div class="pluginname">
<?php echo $slplugin_name[$slpluginindex]." V".$row['version']; ?>
</div>
<div style="clear: both;"></div>
<?php
           $slpluginindex++;
        }
      }
  	}
    else
    {
      print "Error accessing plugin data";
      exit;
    }
  }
?>
<?php if ($slpluginindex==$slnumplugins) { ?>
<p class="generaltext">There are no disabled plugins</p>
<?php } ?>
</fieldset>
<div class="buttons">
<button type="submit" id="save-go" name="save" value="Save">Save</button>
<button type="button" id="cancel-go" name="cancel" value="Cancel" onclick="location.href='index.php'">Cancel</button>
</div>

<br>
&nbsp;&nbsp;To view and download available plugins <a href="http://www.vibralogix.com/sitelokpw/plugins.php" target="_blank">click here</a><br>
<br>
</form>
<?php include "footeradminother.php"; ?>
</body>
</html>