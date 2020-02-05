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
  $backupmigrate="0";
  $backupcompress="1";
  $fname="";
  $act="";
  if (isset($_GET['act']))
    $act=$_GET['act'];  
  if (isset($_GET['backupcompress']))
    $backupcompress=$_GET['backupcompress'];  
  if (isset($_GET['backupmigrate']))
    $backupmigrate=$_GET['backupmigrate'];
  if (isset($_GET['backupmigrate']))
    $backupmigrate=$_GET['backupmigrate'];
  if (isset($_GET['fname']))
    $fname=$_GET['fname'];
    
  // Check backup folder is writable by creating temporary file
  $fopenerrormsg="";
  $fh=@fopen($BackupLocation."test.tmp","ab");
  if ($fh===false)
    $fopenerrormsg="Cannot write files to the folder ".$BackupLocation;
  else
  {
    @unlink($BackupLocation."test.tmp");
    fclose($fh);
  } 
  // Check if gzip is supported
  $gziperrormsg="";
  if (!function_exists("gzopen"))
  {
    $gziperrormsg="PHP on this server does not support the gzopen() function for compression";
    $backupcompress="0";
  } 
  
  // Delete file if required
  if (($act=="delete") && ($fname!=""))
  {
    if (file_exists($BackupLocation.$fname))
    {
      if (false===@unlink($BackupLocation.$fname))
        $deleteerrormsg="Could not delete ".$fname;
    }  
  } 
 
  function backup_FriendlyFileSize($sz)
  {
  if ($sz==0)
    return("0");	
  if ($sz <= 1023)
    return($sz . " Bytes");
  if (($sz >= 1024) && ($sz <= 1048575))
  {
    $sz = intval($sz / 1024);
    return($sz . " KB");
  }
  if ($sz >= 1048576)
  {
    $sz = $sz / 1048576;
    $sz = intval($sz * 100) / 100;
    return($sz . " MB");
  }
} 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"> 
<html>
<head>
<?php
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>
<script type="text/javascript" src="fancybox/lib/jquery-1.9.0.min.js"></script>
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>
<link href="stylescommon.css" rel="stylesheet" type="text/css"> 
<link href="stylesbackup.css" rel="stylesheet" type="text/css">
<title>Backup</title>
<script  type="text/javascript">
function Backup()
{
  var formobj=document.getElementById('backupform')
  var backupcompress=0
  if (formobj.backupcompress.checked)
    var backupcompress=1  
  var backupmigrate=0
  if (formobj.backupmigrate.checked)
    var backupmigrate=1
//  window.open("backupprocess.php?slcsrf=<?php echo $slcsrftoken; ?>&backupcompress="+backupcompress+"&backupmigrate="+backupmigrate,"backupprocess","width=400,height=180,resizable=no,scrollbars=no")

jQuery.fancybox({
      'scrolling' : 'no',
      'modal' : true,
			'content'	:	"<iframe id=\"backupiframe\" src=\"backupprocess.php?slcsrf=<?php echo $slcsrftoken; ?>&backupcompress="+backupcompress+"&backupmigrate="+backupmigrate+"\" scrolling=\"no\" frameborder=\"0\" width=\"400\" height=\"180\"></iframe>",
			'afterClose': function() { window.location.reload(true); ;}			
	});	     
}
function Cancel_Backup(form)
{
  window.location = 'index.php'
}

function Delete_File(fname)
{
  if (confirm("Are you sure you want to delete this backup file?"))
  {
    window.location = 'backup.php?slcsrf=<?php echo $slcsrftoken; ?>&act=delete&fname='+fname
  }
}

</script>

</head>

<body>
<?php
  include "headeradminother.php"; 
?>
<h1>Backup</h1>
<form name="backupform" id="backupform" action="" method="POST">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">
<fieldset>
<legend>Backup files</legend>

<p class="sectionnotes">
Any backup files stored are displayed below. As backup files can become very large
we strongly recommend that after download you verify that it completed successfully. To do this open the file in a text editor (you can rename it with .txt)
and check that the last line contains<br>
<br>
# End of backup file<br>
<br>
For large files we recommend downloading using an FTP client.<br>
<br>
Backup files are stored in the following folder which can be changed in the configuration page.<br>
<br>
<?php if ($DemoMode) echo "Hidden in demo mode"; else echo $BackupLocation; ?>
</p>
<?php if ($deleteerrormsg!="") { ?><p class="generalerrortext"><?php echo $deleteerrormsg; ?></p><?php } ?>

<?php
$hDirectory=@opendir($BackupLocation);
$fnames=array();
$fsizes=array();
$fmtimes=array();
$fctimes=array();
if ($hDirectory!=false)
{
  while($entryname=readdir($hDirectory))
  {
    if (($entryname!=".") && ($entryname!="..") && ($entryname!=""))
    {
      // Only get details about .gz .sql or .tmp files
      $ext=strtolower(".".pathinfo($entryname, PATHINFO_EXTENSION));
      if (($ext!=".gz") && ($ext!=".sql") && ($ext!=".tmp"))
        continue;
      if ($DemoMode)
      {
         @unlink($BackupLocation.$entryname);  
         continue;
      }   
      if ($ext==".tmp")
      {
        // See if file is .tmp and older than 1 day (3 minutes for demo mode)
        if (time()-filemtime($BackupLocation.$entryname)>86400)
        {
          @unlink($BackupLocation.$entryname); 
          continue;           
        }
        continue;
      }      
      $fnames[]=$entryname;
      $filestat=stat($BackupLocation.$entryname);
      $fsizes[]=$filestat['size'];
      $fmtimes[]=$filestat['mtime'];
      $fctimes[]=$filestat['ctime'];
    }
  }
  closedir($hDirectory);
}
// Get date format for list
if ($DateFormat=="DDMMYY")
  $dformat="d/m/Y";
if ($DateFormat=="MMDDYY")
  $dformat="m/d/Y";
// Sort file list as required
array_multisort($fmtimes, SORT_ASC, SORT_NUMERIC, $fnames, $fsizes, $fmtimes, $fctimes);
for ($k=0;$k<count($fnames);$k++)
{
?>
<div class="verticalfield">
<label class="backup"><?php echo gmdate($dformat,$fmtimes[$k]); ?>&nbsp;<?php echo gmdate("H:i",$fmtimes[$k]); ?></label>
<span class="filename"><a href="#"><img class="delete" src="delete.png" onclick="Delete_File('<?php echo $fnames[$k]; ?>');" alt="Delete backup file" title="Delete backup file"></a>&nbsp;&nbsp;<a href="<?php siteloklink($fnames[$k].":slbackups",1); ?>"><?php echo $fnames[$k]; ?></a>&nbsp;&nbsp;(<?php echo backup_FriendlyFileSize($fsizes[$k]); ?>)</span>
</div>
<?php } ?>
<?php if (count($fnames)==0) { ?>
<div class="verticalfield">
<label class="backup">No files found<?php if ($DemoMode) echo " <br>hidden in demo"; ?></label>
</div>
<?php } ?>
</fieldset>

<fieldset>
<legend>Generate new backup file</legend>

<p class="sectionnotes">
When you click the backup button Sitelok will generate a backup of all Sitelok data
in a standard .sql file and then compress it in .gz format if required.<br>
<br>
The standard backup file can be used by Mysql administrator control panels (like phpmyadmin)
to fully restore the Sitelok database. If you wish use the backup to migrate Sitelok to a new
server then check the 'Generate data for migration only' checkbox. This will still backup all user data
but will not restore server specific paths etc on the new server.
</p>

<?php if ($fopenerrormsg!="") { ?><p class="generalerrortext"><?php echo $fopenerrormsg; ?></p><?php } ?>

<div class="blankspace"></div>

<div class="horizontalfield">
<label class="verticalfield" for="backupcompress">Compress file in .gz format</label>
<input type="checkbox" name="backupcompress" id="backupcompress" class="inputcheckbox" value="1" <?php if ($backupcompress=="1") print "checked=\"checked\""; ?> <?php if ($gziperrormsg!="") echo " disabled=\"disabled\"" ; ?>>
<?php if ($gziperrormsg!="") { ?><p class="textfielderror"><?php echo $gziperrormsg; ?></p><?php } ?>
</div>

<div class="blankspace"></div>

<div class="horizontalfield">
<label class="verticalfield" for="backupmigrate">Generate data for migration only</label>
<input type="checkbox" name="backupmigrate" id="backupmigrate" class="inputcheckbox" value="1" <?php if ($backupmigrate=="1") print "checked=\"checked\""; ?>>
</div>

<div class="blankspace"></div>

<div><button type="button" id="backup-go" value="Backup" onclick="Backup();">Backup</button>

</fieldset>

<button type="button" id="goback-go" value="Go Back" onclick="location.href='index.php'">Go Back</button></div>
</form>
</div>



<?php
  include "footeradminother.php"; 
?>

</body>

</html>