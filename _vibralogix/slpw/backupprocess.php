<?php
$backupnozip=false;
$groupswithaccess="ADMIN";
$noaccesspage="";
require"sitelokpw.php";
if ($_GET['slcsrf']!=$_SESSION['ses_slcsrf'])
{
  print "Form tampering detected get=".$_GET['slcsrf']." sess=".$_SESSION['ses_slcsrf'];
  exit;
}  
$backupact=="";
$backupmigrate="0";
$backupcompress="1";
if (isset($_GET['backupact']))
  $backupact=$_GET['backupact'];
if (isset($_GET['backupcompress']))
  $backupcompress=$_GET['backupcompress'];  
if (isset($_GET['backupmigrate']))
  $backupmigrate=$_GET['backupmigrate'];  
$maxtime=ini_get('max_execution_time');
if (!is_numeric($maxtime))
	 $maxtime=30;
$maxtime=$maxtime-5;	 
$scriptstart=time();
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php print $MetaCharSet; ?>">
<link href="stylesbackup.css" rel="stylesheet" type="text/css">
 <title>Sitelok Backup</title>
</head>
<body class="backupprocess">
<p align="center"><h1 style="text-align: center;">Backup</h1></p>
<?php
$msg="Please wait";
if ($backupact=="finish")
  $msg="Backup completed";  
if ($backupact=="cancel")
  $msg="Backup cancelled";  
?>

<script  type="text/javascript">
</script>
<div id="divprogress"><p class="backupprocess"><?php echo $msg; ?></p>
</div>
<br>
<form name="form1">
<?php if (($backupact=="cancel") || ($backupact=="finish")) { ?>
	<p class="backupprocess"><input type="button" name="Close" value="Close" onClick="wclose()"></p>
<?php } else {?>	
	<p class="backupprocess"><input class="backupprocess" type="button" name="Cancel" value="Cancel" onClick="cancel()"></p>
<?php } ?>
  </form>
<br>
<?php if (($backupact=="") || ($backupact=="callback")) { ?>
  <p class="backupprocesswarning">Warning. Closing this window will cancel the backup.<br>
<?php } ?>

<script  type="text/javascript">
function updateprogress(msg)
{
  document.getElementById("divprogress").innerHTML = "<p align=\"center\"><font face=\"Arial\"><span style=\"font-size:12pt;\">"+msg+"</span></font><p>";
}
function callback()
{
  window.location.href=window.location.pathname+"?slcsrf=<?php print $_SESSION['ses_slcsrf']; ?>&backupact=callback&backupcompress=<?php echo $backupcompress; ?>&backupmigrate=<?php echo $backupmigrate; ?>"
}
function finish()
{
  window.location.href=window.location.pathname+"?slcsrf=<?php print $_SESSION['ses_slcsrf']; ?>&backupact=finish&backupcompress=<?php echo $backupcompress; ?>&backupmigrate=<?php echo $backupmigrate; ?>"
}
function cancel()
{
  if (confirm("Are you sure you want to cancel this backup?"))
  {
    window.location.href=window.location.pathname+"?slcsrf=<?php print $_SESSION['ses_slcsrf']; ?>&backupact=cancel&backupcompress=<?php echo $backupcompress; ?>&backupmigrate=<?php echo $backupmigrate; ?>"
  }
}
function wclose()
{
//  window.close()
parent.jQuery.fancybox.close()
}
</script>
<?php if ($backupact=="finish") { ?>
</body>
</html>
<?php
	exit;
}

print str_repeat(" ",50000)."\n";
flush();


$mysql_link=sl_DBconnect();
if ($mysql_link==false)
{
  print "Can't connect to MySQL server";
  exit;
}  
if ($backupact=="")
{
  // We are starting the process
  $_SESSION['ses_slbackupcurrenttable']=0;
  $_SESSION['ses_slbackupcurrentrow']=-1;
  // Create file
  $fname=$BackupLocation."sitelok_".gmdate("YmdHis")."_".substr(md5($SiteKey.(string)time()),0,10).".tmp";
  $_SESSION['ses_slbackupfname']=$fname;
  // Make array of table names starting with the ones we know exist
  $tables=array();
  $tables[0]=$DbTableName;
  $tables[1]=$DbConfigTableName;
  $tables[2]=$DbLogTableName;
  $tables[3]=$DbGroupTableName;
  $tables[4]=$DbOrdersTableName;
  $tables[5]=$DbPluginsTableName;
  // Now add any others not already included that start with sl_
	$mysql_result = mysqli_query($mysql_link,'SHOW TABLES');
	$c=6;
	while($row = mysqli_fetch_row($mysql_result))
	{
	  if ((substr($row[0],0,3)=="sl_") && (false===array_search($row[0], $tables)))
	  {
		  $tables[$c] = $row[0];
		  $c++;
		}  
	}
  $_SESSION['ses_slbackuptables']=implode("|",$tables);
  // Get total fields and records in each table
  for ($k=0;$k<count($tables);$k++)
  {
  	$mysql_result = mysqli_query($mysql_link,'SELECT COUNT(*) FROM '.$tables[$k]);
  	$row = mysqli_fetch_row($mysql_result);
  	$tablerows[$k]=$row[0];
  	$mysql_result = mysqli_query($mysql_link,'SHOW COLUMNS FROM '.$tables[$k]);
  	$tablefields[$k]=mysqli_num_rows($mysql_result);
  }
  $_SESSION['ses_slbackuptablerows']=implode("|",$tablerows);
  $_SESSION['ses_slbackuptablefields']=implode("|",$tablefields);
  // If creating backup for migrating server then we will need fields names from slconfig table
  if ($backupmigrate=="1")
  {
    $configcolumns=array();
    $configmigratefields=array();
    $mysql_result = mysqli_query($mysql_link,"SHOW COLUMNS FROM ".$DbConfigTableName);
    if (mysqli_num_rows($mysql_result) > 0)
    {
      $field=0;
      $configcolumns=array();
      $configmigratefields=array();
      while ($row = mysqli_fetch_assoc($mysql_result))
      {
        if (($row['Field']=='version') || ($row['Field']=='siteloklocation') || ($row['Field']=='emaillocation') || ($row['Field']=='backuplocation'))
          $configmigratefields[]=$field;
        $configcolumns[$field]=$row['Field'];
        $field++; 
      }
      $configcolumnsstr="(".$configcolumnsstr.")";
    }
  }  
}
if (($backupact=="") || ($backupact=="callback"))
{
  // Get variables from session so we can see where we got to
  $fname=$_SESSION['ses_slbackupfname'];
  $tables=explode("|",$_SESSION['ses_slbackuptables']);
  $tablerows=explode("|",$_SESSION['ses_slbackuptablerows']);
  // Get total of all table rows
  $allrows=array_sum($tablerows);
  $tablefields=explode("|",$_SESSION['ses_slbackuptablefields']);
  $backupcurrenttable=$_SESSION['ses_slbackupcurrenttable'];
  $backupcurrentrow=$_SESSION['ses_slbackupcurrentrow'];
  $fh=@fopen($fname,"ab");
  if ($fh===false)
  {
    updateprogress("Unable to open file for writing");
    sleep(3);
   	print "<script language=\"javascript\" type=\"text/javascript\">";
    print "wclose()\n";
   	print "</script>";
   	print str_repeat(" ",50000)."\n";
  	print "</body>\n";
  	print "</html>\n";
    flush();
    exit;
  }
  for ($t=$backupcurrenttable;$t<count($tables);$t++)
  {  
    // Get total of all rows so far
    $allrowssofar=0;
    for ($tot=0;$tot<$backupcurrenttable;$tot++)
      $allrowssofar+=$tablerows[$tot];
    if ($backupcurrentrow==-1)
    {
      $percent=round(($allrowssofar/$allrows)*100);
      if ($percent==100)
        $percent=99;
      updateprogress($percent."% completed");
      // We need to output table structure
		  if (($backupmigrate==0) || ($tables[$backupcurrenttable]!=$DbConfigTableName))
		  {
        fwrite($fh,"DROP TABLE IF EXISTS ".$tables[$backupcurrenttable].";\n");    
        $row=mysqli_fetch_row(mysqli_query($mysql_link,'SHOW CREATE TABLE '.$tables[$backupcurrenttable]));
        fwrite($fh,"\n\n".$row[1].";\n\n");
        fwrite($fh,"\n");
      }
      // Update where we are so far
      $backupcurrentrow=0;
    }
    // Check for timeout approaching
 	  if (($maxtime!=0) && ((time()-$scriptstart)>=($maxtime-1)))
 	  {
 	    callback();
      exit;
 	  } 
    if ($backupcurrentrow>-1)
    {
      // We need to output rows
      for ($l=$backupcurrentrow;$l<$backupcurrentrow+$sl_dbblocksize;$l=$l+$sl_dbblocksize)
      {
        $percent=round((($allrowssofar+$backupcurrentrow)/$allrows)*100);
        if ($percent==100)
          $percent=99;
        updateprogress($percent."% completed");
        $limit=" LIMIT ".$l.",".$sl_dbblocksize;
        $mysql_result=mysqli_query($mysql_link,"SELECT * FROM ".$tables[$backupcurrenttable].$limit);
  			while($row = mysqli_fetch_row($mysql_result))
  			{
          // See if handling migration in slconfig table 			
 				  if (($tables[$backupcurrenttable]==$DbConfigTableName) && ($backupmigrate==1))
 				  {
 				    $line="";
    				for($j=0; $j<$tablefields[$backupcurrenttable]; $j++) 
    				{
    				  if (array_search($j,$configmigratefields)!==false)
    				    continue;
  //    					$row[$j] = addslashes($row[$j]);
  //    					$row[$j] = str_replace("\n","\\n",$row[$j]);
    					if (isset($row[$j]))
    					{
      				  if ($line!="")
      				    $line.=", ";  
  //    					  $line.='"'.$row[$j].'"');
    					  $line.=$configcolumns[$j]."='".mysqli_real_escape_string($mysql_link,$row[$j])."'";
    					}
    				  else
    				  {
    				    $line.='""';
    				  }
    				} 
    				$line.=" WHERE confignum=1;\n";
    				$line='UPDATE '.$tables[$backupcurrenttable].' SET '.$line;
    				fwrite($fh,$line);
 				  }
 				  else
 				  {
 				    $line="";
    				for($j=0; $j<$tablefields[$backupcurrenttable]; $j++) 
    				{
  //    					$row[$j] = addslashes($row[$j]);
  //    					$row[$j] = str_replace("\n","\\n",$row[$j]);
    					if (isset($row[$j]))
    					{
      				  if ($line!="")
      				    $line.=",";      					
  //    					  $line.='"'.$row[$j].'"';
    					  $line.="'".mysqli_real_escape_string($mysql_link,$row[$j])."'";
    					}
    				  else
    				  {
    				    $line.='""';
    				  }
    				}  				
    				$line.=");\n";
    				$line='INSERT INTO '.$tables[$backupcurrenttable].' VALUES('.$line;
    				fwrite($fh,$line);
  				}
  				$backupcurrentrow++;
  
  				// Check for timeout approaching
       	  if (($maxtime!=0) && ((time()-$scriptstart)>=($maxtime-1)))
       	  {
       	    callback();
    	      exit;
       	  } 	
  			}    		
      } 
   		fwrite($fh,"\n\n\n"); 
    }
    $backupcurrenttable++;
    $backupcurrentrow=-1;
  }
	// Check for timeout approaching
  if (($maxtime!=0) && ((time()-$scriptstart)>=($maxtime-1)))
  {
    callback();
    exit;
  } 
  fwrite($fh,"# End of backup file\n");
  fclose($fh);
  rename($fname,str_replace(".tmp",".sql",$fname));
  if ($backupcompress==1)
  {
    if (function_exists("gzopen"))
    {
      updateprogress("Compressing file");
      gzipbackup(str_replace(".tmp",".sql",$fname));
      @unlink(str_replace(".tmp",".sql",$fname));
    }      
  }    
  unset($_SESSION['ses_slbackupcurrenttable']);
  unset($_SESSION['ses_slbackupcurrentrow']);
  unset($_SESSION['ses_slbackupfname']);
  unset($_SESSION['ses_slbackuptables']);
  unset($_SESSION['ses_slbackuptablerows']);
  unset($_SESSION['ses_slbackuptablefields']);
 	print "<script language=\"javascript\" type=\"text/javascript\">";
//  print "window.opener.location.href=\"backup.php?slcsrf=".$_SESSION['ses_slcsrf']."&backupact=finished&backupcompress=".$backupcompress."&backupmigrate=".$backupmigrate."\"\n";
  print "finish(\"finish\")";
 	print "</script>";
 	print str_repeat(" ",50000)."\n";
	print "</body>\n";
	print "</html>\n";
  flush();
}
if ($backupact=="cancel")
{
  fclose($fh);
  $fname=$_SESSION['ses_slbackupfname'];
  @unlink($fname);
  unset($_SESSION['ses_slbackupcurrenttable']);
  unset($_SESSION['ses_slbackupcurrentrow']);
  unset($_SESSION['ses_slbackupfname']);
  unset($_SESSION['ses_slbackuptables']);
  unset($_SESSION['ses_slbackuptablerows']);
  unset($_SESSION['ses_slbackuptablefields']);
// 	print "<script language=\"javascript\" type=\"text/javascript\">";
//  print "window.opener.location.href=\"backup.php?slcsrf=".$_SESSION['ses_slcsrf']."&backupact=cancel&backupcompress=".$backupcompress."&backupmigrate=".$backupmigrate."\"\n";
//  print "</script">";
  updateprogress("Backup cancelled");
}

function callback()
{
  global $fh,$backupcurrenttable,$backupcurrentrow;
  $_SESSION['ses_slbackupcurrenttable']=$backupcurrenttable;
  $_SESSION['ses_slbackupcurrentrow']=$backupcurrentrow;
  fclose($fh);
 	print "<script language=\"javascript\" type=\"text/javascript\">";
  print "updateprogress('Please wait')";
 	print str_repeat(" ",1024)."\n";
  flush();       	
  print "callback()";
  print "</script>";
  print str_repeat(" ",1024)."\n";
	print "</body>\n";
	print "</html>\n";
}
function updateprogress($msg)
{
 	print "<script language=\"javascript\" type=\"text/javascript\">";
  print "updateprogress(\"".$msg."\")";
 	print "</script>";
 	print str_repeat(" ",1024)."\n";
  flush(); 
}

function gzipbackup($src, $level = 5, $dst = false){
    if($dst == false){
        $dst = $src.".gz";
    }
    if(file_exists($src)){
        $filesize = filesize($src);
        $src_handle = fopen($src, "r");
        if(!file_exists($dst)){
            $dst_handle = gzopen($dst, "w$level");
            while(!feof($src_handle)){
                $chunk = fread($src_handle, 2048);
                gzwrite($dst_handle, $chunk);
            }
            fclose($src_handle);
            gzclose($dst_handle);
            return true;
        } else {
            error_log("$dst already exists");
        }
    } else {
        error_log("$src doesn't exist");
    }
    return false;
}    
?>
