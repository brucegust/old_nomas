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
  if ($_GET['user']!="")
    $user=urldecode($_GET['user']);   
  if (($act=="recentactivity") && ($browsertimeoffset==""))
  {
    // We need to use javascript to get browser time zone so create form and submit it
    ?>
<html>
<head>
</head>
<body>
<form name="recentform" action="logmanage.php" method="post">
<input type="hidden" name="slcsrf" value="<?php echo $slcsrftoken; ?>">
<input type="hidden" name="act" value="recentactivity">
<input type="hidden" name="logmanageact" value="view">
<input type="hidden" name="usernm" value="<?php echo $user; ?>">
<input type="hidden" name="timeoffset" value="<?php echo $LogViewOffset; ?>">
<input type="hidden" name="order" value="DESC">
<input type="hidden" name="fromdate" value="">
<input type="hidden" name="todate" value="">
<input type="hidden" name="maxentries" value="25">
<?php 
for ($k=1;$k<=50;$k++)
{
?>
<input type="hidden" name="logentry<?php echo $k; ?>" value="on">
<?php  
}
?>
<input type="hidden" name="browsertimeoffset" value="">
<input type="hidden" name="selectedonly" value="">
<input type="hidden" name="logsortfield" value="id">
</form>
<script type="text/javascript">
var d = new Date()
document.recentform.browsertimeoffset.value=d.getTimezoneOffset()
document.recentform.submit()
</script>
document
</body>
</html>
    <?php
    exit;
  }
  if ($logmanageact=="")
  {
    for ($k=1;$k<=50;$k++)
    {
      $var="logentry".$k;
      if (substr($LogViewDetails,$k-1,1)!="N")
      	$$var="on";
    }
  }
  if (($logmanageact=="view") || ($logmanageact=="export") || ($logmanageact=="clear"))
  {
    $mysql_link=sl_DBconnect();
    if ($mysql_link==false)
    {
      print("Can't connect to MySQL server");
      exit;
    }
    // Store time offset preference if changed
    if (($timeoffset!=$LogViewOffset) && (!$DemoMode))
    {
      $query="UPDATE ".$DbConfigTableName." SET logviewoffset=".$timeoffset." WHERE confignum=1";
      $mysql_result=mysqli_query($mysql_link,$query);
      $LogViewOffset=$timeoffset;
      $_SESSION['ses_ConfigReload']="reload";     
    }
    // Store output order if changed
    if (($order!=$LogViewOrder) && (!$DemoMode))
    {
      $query="UPDATE ".$DbConfigTableName." SET logvieworder='".$order."' WHERE confignum=1";
      $mysql_result=mysqli_query($mysql_link,$query);
      $LogViewOrder=$order;
      $_SESSION['ses_ConfigReload']="reload";      
    }
    // Store output details if changed
    $lvdtemp="";
    for ($k=1;$k<=50;$k++)
    {
      $var="logentry".$k;
      if ($$var=="on")
        $lvdtemp.="Y";
      else
        $lvdtemp.="N";      
    }    
    if (($lvdtemp!=$LogViewDetails) && (!$DemoMode))
    {
      $query="UPDATE ".$DbConfigTableName." SET logviewdetails='".$lvdtemp."' WHERE confignum=1";
      $mysql_result=mysqli_query($mysql_link,$query);
      $LogViewDetails=$lvdtemp;
      $_SESSION['ses_ConfigReload']="reload";      
    }
    
  	if ($logmanageact=="view")
  	{
	    print "<html>\n";
	    print "<head>\n";
      print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
      print "<link href=\"styleslogview.css\" rel=\"stylesheet\" type=\"text/css\">\n";
	    print "<title>Sitelok Log</title>\n";
      print "</head><body class=\"logview\"><div class=\"logview\">\n";
	  }
  	if ($logmanageact=="export")
    {
      header("Content-type: application/octet-stream");
      header("Content-disposition: attachment; filename=siteloklog.csv");
      header("Content-transfer-encoding: binary");
    }
    $query="";
  	if ($logentry1!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'login' AND ".$DbLogTableName.".type<>'logout'";
  	}
  	if ($logentry2!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'login problem'";
  	}
  	if ($logentry3!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'password requested'";
  	}
  	if ($logentry4!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'download'";
  	}
  	if ($logentry5!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'download problem'";
  	}
  	if ($logentry6!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'email'";
  	}
  	if ($logentry7!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'membership expired'";
  	}
  	if ($logentry8!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'user modify'";
  	}
  	if ($logentry9!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'api'";
  	}
  	if ($logentry10!="on")
  	{
  	  if ($query!="")
  	    $query.=" AND ";
  		$query.=$DbLogTableName.".type<>'register'";
  	}
  	for ($k=11;$k<=50;$k++)
  	{
  	  if ($slplugin_logentrytype[$k]!="")
  	  {
    	  $var="logentry".$k;
      	if ($$var!="on")
      	{
      	  if ($query!="")
      	    $query.=" AND ";
      		$query.=$DbLogTableName.".type<>'".$slplugin_logentrytype[$k]."'";
      	}
  	  }
  	} 	
    $fromtimestring="";
    $totimestring="";
    if (($DateFormat=="DDMMYY") && ($fromdate!=""))
    {
      $day=substr($fromdate,0,2);
      $month=substr($fromdate,2,2);
      $year=substr($fromdate,4,2)+2000;
      $fromtimestring=$year."-".$month."-".$day." 00:00:00";
    }
    if (($DateFormat=="MMDDYY") && ($fromdate!=""))
    {
      $month=substr($fromdate,0,2);
      $day=substr($fromdate,2,2);
      $year=substr($fromdate,4,2)+2000;
      $fromtimestring=$year."-".$month."-".$day." 00:00:00";
    }
    if (($DateFormat=="DDMMYY") && ($todate!=""))
    {
      $day=substr($todate,0,2);
      $month=substr($todate,2,2);
      $year=substr($todate,4,2)+2000;
      $totimestring=$year."-".$month."-".$day." 23:59:59";
    }
    if (($DateFormat=="MMDDYY") && ($todate!=""))
    {
      $month=substr($todate,0,2);
      $day=substr($todate,2,2);
      $year=substr($todate,4,2)+2000;
      $totimestring=$year."-".$month."-".$day." 23:59:59";
    }
    if (($totimestring!="") && ($fromtimestring!=""))
    {
      if ($totimestring<$fromtimestring)
      {
      	$temp=$fromtimestring;
      	$fromtimestring=$totimestring;
      	$totimestring=$temp;
      }
    }
    // Adjust for time offset
    if ($timeoffset=="9999")
    {
      if (is_numeric($browsertimeoffset))
        $timeoffset=($browsertimeoffset*-1);
      else
        $timeoffset=0;
      if ($fromtimestring!="")    
        $fromtimestring=dateoffsetmysqlstring($fromtimestring,($timeoffset*-1));
      if ($totimestring!="")    
        $totimestring=dateoffsetmysqlstring($totimestring,($timeoffset*-1));      
    }
    else
    {
      if ($fromtimestring!="")    
        $fromtimestring=dateoffsetmysqlstring($fromtimestring,($timeoffset*-1));
      if ($totimestring!="")    
        $totimestring=dateoffsetmysqlstring($totimestring,($timeoffset*-1));
    }
    if ($fromtimestring!="")
    {
      if ($query!="")
        $query.=" AND ";
      $query.=$DbLogTableName.".time>='".$fromtimestring."'";
    }
    if ($totimestring!="")
    {
      if ($query!="")
        $query.=" AND ";
      $query.=$DbLogTableName.".time<='".$totimestring."'";
    }
    if ($usernm!="")
    {
      if ($query!="")
        $query.=" AND ";
      $query.=$DbLogTableName.".username=".sl_quote_smart($usernm);
    }
    if ($selectedonly=="on")
    {
      if ($logmanageact=="clear")
      {
        if ($query!="")
          $query=$query." AND ";   
        $query="DELETE ".$DbLogTableName." FROM ".$DbLogTableName.", ".$DbTableName." WHERE ".$query.$DbLogTableName.".username=".$DbTableName.".username AND ".$DbTableName.".Selected='Yes'";
      }
      else
      {
        if ($query!="")
          $query=$query." AND ";   
        $query="SELECT ".$DbLogTableName.".* FROM ".$DbLogTableName.",".$DbTableName." WHERE ".$query.$DbLogTableName.".username=".$DbTableName.".username AND ".$DbTableName.".Selected='Yes'";    
      }
    }  
    else
    {
      if ($query!="")
        $query="WHERE ".$query;    
      if ($logmanageact=="clear")
        $query="DELETE FROM ".$DbLogTableName." ".$query;
      else  
        $query="SELECT * FROM ".$DbLogTableName." ".$query;
    }
    if (!(($selectedonly=="on") && ($logmanageact=="clear")))
    {
      if ($logsortfield=="")
        $logsortfield="id";
      if ($logsortfield!="id")
        $logsortfield.=", id";  
      if ($order=="ASC")
        $query.=" ORDER BY ".$logsortfield." ASC";  
      if ($order=="DESC")
        $query.=" ORDER BY ".$logsortfield." DESC";          
      if ($maxentries>0)
        $query.=" LIMIT ".$maxentries;
    }
  	if ($logmanageact=="view")
  	{
	    print "<table class=\"logview\">\n";
	    print "<tr>\n";
	    print "<th><NOBR>Date</NOBR></th>\n";
	    print "<th><NOBR>Time</NOBR></th>\n";
	    if ($act!="recentactivity")
  	    print "<th><NOBR>Username</NOBR></th>\n";
	    print "<th><NOBR>Type</NOBR></th>\n";
	    print "<th><NOBR>Details</NOBR></th>\n";
	    print "<th><NOBR>IP Address</NOBR></th>\n";
	    if ($act!="recentactivity")
  	    print "<th><NOBR>Session</NOBR></th>\n";
	    print "</tr>\n";
	  }
	  if (!(($logmanageact=="clear")&& ($DemoMode==true)))
      $mysql_result=mysqli_query($mysql_link,$query);
    if ($logmanageact=="view")
    {
      if ($DateFormat=="MMDDYY")
        $dtfmt="m/d/y";
      else
        $dtfmt="d/m/y";
  	  if ($mysql_result!=false)
   	  {
        while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
        {
          $tm=$row['time'];
          $tm=dateoffsetmysqltimestamp($tm,$timeoffset);
          $us=$row['username'];
          $tp=$row['type'];
          $ip=$row['ip'];
          $msg=trim($row['details']);
          $ses=$row['session'];
	        if ($us=="")
	          $us="&nbsp;";
	        if ($msg=="")
	          $msg="&nbsp;";
          print "<tr>\n";
          print "<td><NOBR>".gmdate($dtfmt,$tm)."</NOBR></td>";
          print "<td><NOBR>".gmdate("H:i:s",$tm)."</NOBR></td>";
     	    if ($act!="recentactivity")
            print "<td><NOBR>$us</NOBR></td>";
          print "<td><NOBR>$tp</NOBR></td><td><NOBR>$msg</NOBR></td>";
          print "<td><NOBR>$ip</NOBR></td>";
          if ($act!="recentactivity")
            print "<td><NOBR>$ses</NOBR></td>";
          print "</tr>\n";
  		  }
  		}
    }
    if ($logmanageact=="export")
    {
  	  if ($mysql_result!=false)
   	  {
        while ($row=mysqli_fetch_array($mysql_result,MYSQLI_ASSOC))
        {
          $tm=$row['time'];
          if ($timeoffset!=0)
            $tm=dateoffsetmysqlstring($tm,$timeoffset);
          $us=$row['username'];
          $tp=$row['type'];
          $ip=$row['ip'];
          $msg=trim($row['details']);
          $ses=$row['session'];
          print $tm.",".$us.",".$tp.",".$msg.",".$ip.",".$ses."\n";
  		  }
  		}
    }
    if ($logmanageact=="clear")
    {
      $entriesdeleted=$mysql_result;
      $numdeleted=mysqli_affected_rows($mysql_link);
    }
  	if ($logmanageact=="view")
  	{
	    print "</table>\n";
	    print "</div></body>\n";
	    print "</html>\n";
	  }
  	if (($logmanageact=="view") || ($logmanageact=="export"))
      exit;	  
  }
  
function dateoffsetmysqlstring($time,$offset)
{
  $year=substr($time,0,4);
  $month=substr($time,5,2);
  $day=substr($time,8,2);
  $hour=substr($time,11,2);
  $minute=substr($time,14,2);
  $second=substr($time,17,2);
  $timestamp=gmmktime($hour,$minute,$second,$month,$day,$year);
  $timestamp=$timestamp+($offset*60);
  $newtime=gmdate("Y-m-d H:i:s",$timestamp);
  return($newtime);
}

function dateoffsetmysqltimestamp($time,$offset)
{
  $year=substr($time,0,4);
  $month=substr($time,5,2);
  $day=substr($time,8,2);
  $hour=substr($time,11,2);
  $minute=substr($time,14,2);
  $second=substr($time,17,2);
  $timestamp=gmmktime($hour,$minute,$second,$month,$day,$year);
  $timestamp=$timestamp+($offset*60);
  return($timestamp);
}
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
  print "<meta http-equiv=\"content-type\" content=\"text/html; charset=$MetaCharSet\">\n";
?>
<script language=javascript type="text/javascript" src="gui.js"></script>

<script type="text/javascript" src="fancybox/lib/jquery-1.9.0.min.js"></script>
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>
<script  type="text/javascript">
$("#logform").bind("submit", function() { 
     $.ajax({ 
          type         : "POST", 
          cache      :  false, 
          url           :  "http://localhost/", 
          data        :  $(this).serializeArray(), 
          success  :  function(data) { 
                   $.fancybox(data); 
          } 
    }); 
return false; 
});

</script>



<link href="stylesgui.css" rel="stylesheet" type="text/css"> 
<link href="stylescommon.css" rel="stylesheet" type="text/css">
<title>Manage Log</title>
<script  type="text/javascript">
<!--
function Cancel_Log(form)
{
  window.location = 'index.php'
}
function View_Log(form)
{
  var dateformat="<?php echo $DateFormat; ?>"
  if (form.fromdate.value!="")
  {
    if (!datevalid(form.fromdate.value,dateformat))
    {
      alert("From date is not valid")
      form.fromdate.focus()
      return
    }
  }
  if (form.todate.value!="")
  {
    if (!datevalid(form.todate.value,dateformat))
    {
      alert("To date is not valid")
      form.todate.focus()
      return
    }
  }
  if ((!form.logentry1.checked) && (!form.logentry2.checked) && (!form.logentry3.checked) && (!form.logentry4.checked) && (!form.logentry5.checked) && (!form.logentry6.checked) && (!form.logentry7.checked) && (!form.logentry8.checked) && (!form.logentry9.checked) && (!form.logentry10.checked))
  {
    alert("You must select at least one entry type")
    form.logentry1.focus()
    return;
  }
  var d = new Date()
  form.browsertimeoffset.value=d.getTimezoneOffset()
  form.target="_blank"
  form.action="logmanage.php"
  form.logmanageact.value="view"
  form.submit()
}
function Export_Log(form)
{
  var dateformat="<?php echo $DateFormat; ?>"
  if (form.fromdate.value!="")
  {
    if (!datevalid(form.fromdate.value,dateformat))
    {
      alert("From date is not valid")
      form.fromdate.focus()
      return
    }
  }
  if (form.todate.value!="")
  {
    if (!datevalid(form.todate.value,dateformat))
    {
      alert("To date is not valid")
      form.todate.focus()
      return
    }
  }
  if ((!form.logentry1.checked) && (!form.logentry2.checked) && (!form.logentry3.checked) && (!form.logentry4.checked) && (!form.logentry5.checked) && (!form.logentry6.checked) && (!form.logentry7.checked) && (!form.logentry8.checked) && (!form.logentry9.checked) && (!form.logentry10.checked))
  {
    alert("You must select at least one entry type")
    form.logentry1.focus()
    return
  }
  var d = new Date()
  form.browsertimeoffset.value=d.getTimezoneOffset()  
  form.target=""
  form.action="logmanage.php"
  form.logmanageact.value="export"
  form.submit()
}
function Clear_Log(form)
{
  if (confirm("Permanently delete all matching log entries?"))
  {
	  form.target=""
	  form.action="logmanage.php"
	  form.logmanageact.value="clear"
	  form.submit()
	}
}
function SelectAll()
{
  var cb=document.getElementById("selectall")
  for (k=1;k<=50;k++)
  {
    cbn=document.getElementById("logentry"+k)
    if (!cbn)
      continue
    if (cb.checked)
      cbn.checked=true
    else      
      cbn.checked=false
  }    
  return(false)
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

// -->
</script>
</head>
<body>
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
</div><?php include"headeradminother.php"; ?>
<h1>Manage Log</h1>
<?php
$timeoffset=$LogViewOffset;
$order=$LogViewOrder;
?>
<form id="logform" name="form1" action="logmanage.php" method="POST" onSubmit="validate(this.form);">
<input name="act" type="hidden" value="">
<input name="logmanageact" type="hidden" value="">
<input name="browsertimeoffset" type="hidden" value="">
<input name="slcsrf" type="hidden" value="<?php echo $slcsrftoken; ?>">

<fieldset>
<legend>Date Range</legend>
<div class="blankspace">
</div>

<div class="verticalfield">
<label class="verticalfield" for="fromdate">From date</label>
<input class="inputtext short" name="fromdate" id="fromdate" type="text" maxlength="6" value="<?php echo $fromdate; ?>" onBlur="guiCloseIfOutside();">
<img src="cal.png" width="16" height="16" align="absmiddle" onClick="openCalendar('fromdate','<?php echo $DateFormat; ?>');" alt="Calendar" title="Calendar" style="cursor: pointer;" >
<span class="cbfieldnote"><?php echo $DateFormat; ?> or leave blank</span>
</div>
<div class="verticalfield">
<label class="verticalfield" for="todate">To date</label>
<input class="inputtext short" name="todate" id="todate" type="text" maxlength="6" value="<?php echo $todate; ?>" onBlur="guiCloseIfOutside();">
<img src="cal.png" width="16" height="16" align="absmiddle" onClick="openCalendar('todate','<?php echo $DateFormat; ?>');" alt="Calendar" title="Calendar" style="cursor: pointer;" >
<span class="cbfieldnote"><?php echo $DateFormat; ?> or leave blank</span>
</div>

</fieldset>

<fieldset>
<legend>Users</legend>
<div class="blankspace">
</div>

<div class="verticalfield">
<label class="verticalfield" for="usernm">Username</label>
<input class="inputtext" type="text" name="usernm" id="usernm" maxlength="50" >
<span class="cbfieldnote">Leave blank for all users</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="selectedonly">Selected users only</label>
<input type="checkbox" name="selectedonly" id="selectedonly" class="inputcheckbox" value="on" <?php if ($selectedonly=="on") print "checked=\"checked\""; ?>>
</div>

</fieldset>

<fieldset>
<legend>Entries to include</legend>
<div class="blankspace">
</div>

<div class="verticalfield">
<label class="verticalfield" for="selectall">&nbsp;</label>
<input type="checkbox" name="selectall" id="selectall" class="inputcheckbox" value="on" onClick="SelectAll();">
<span class="cbfieldnote">select or deselect all</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry1">Login / logout</label>
<input type="checkbox" name="logentry1" id="logentry1" class="inputcheckbox" value="on" <?php if ($logentry1=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry2">Login problems</label>
<input type="checkbox" name="logentry2" id="logentry2" class="inputcheckbox" value="on" <?php if ($logentry2=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry3">Password requested</label>
<input type="checkbox" name="logentry3" id="logentry3" class="inputcheckbox" value="on" <?php if ($logentry3=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry4">Download</label>
<input type="checkbox" name="logentry4" id="logentry4" class="inputcheckbox" value="on" <?php if ($logentry4=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry5">Download problems</label>
<input type="checkbox" name="logentry5" id="logentry5" class="inputcheckbox" value="on" <?php if ($logentry5=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry6">Email sent</label>
<input type="checkbox" name="logentry6" id="logentry6" class="inputcheckbox" value="on" <?php if ($logentry6=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry10">User Registered</label>
<input type="checkbox" name="logentry10" id="logentry10" class="inputcheckbox" value="on" <?php if ($logentry10=="on") print "checked=\"checked\""; ?>>
<span class="cbfieldnote">log entries prior to V3.0 listed as API type</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry7">Membership expired</label>
<input type="checkbox" name="logentry7" id="logentry7" class="inputcheckbox" value="on" <?php if ($logentry7=="on") print "checked=\"checked\""; ?>>
<span class="cbfieldnote">where user attempted to access</span>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry8">User modified details</label>
<input type="checkbox" name="logentry8" id="logentry8" class="inputcheckbox" value="on" <?php if ($logentry8=="on") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="logentry9">API function call</label>
<input type="checkbox" name="logentry9" id="logentry9" class="inputcheckbox" value="on" <?php if ($logentry9=="on") print "checked=\"checked\""; ?>>
<span class="cbfieldnote">includes user registered entries prior to V3.0</span>
</div>

<?php
for ($k=11;$k<=50;$k++)
{
  $var="logentry".$k;
  if ($slplugin_logentryname[$k]!="")
  {
?>

<div class="verticalfield">
<label class="verticalfield" for="<?php echo $var; ?>"><?php echo $slplugin_logentryname[$k]; ?></label>
<input type="checkbox" name="<?php echo $var; ?>" id="<?php echo $var; ?>" class="inputcheckbox" value="on" <?php if ($$var=="on") print "checked=\"checked\""; ?>>
</div>

<?php
  }
  else
  {
?>
<input type="hidden" name="<?php echo $var; ?>" id="<?php echo $var; ?>" value="on">
<?php
  }  
}
?>
</fieldset>

<fieldset>
<legend>Output</legend>
<div class="blankspace">
</div>

<div class="verticalfield">
<label class="verticalfield" for="logsortfield">Sort by</label>
<select name="logsortfield" id="logsortfield" size="1">
<option value="id">Date</option>
<option value="username">Username</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="maxentries">Limit output</label>
<select name="maxentries" id="maxentries" size="1">
<option value="0">All entries</option>
<option value="1">1 entries</option>
<option value="3">3 entries</option>
<option value="10">10 entries</option>
<option value="50">50 entries</option>
<option value="100">100 entries</option>
<option value="250">250 entries</option>
<option value="500">500 entries</option>
<option value="1000">1000 entries</option>
<option value="3000">3000 entries</option>
<option value="10000">10000 entries</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="timeoffset">Timezone</label>
<select name="timeoffset" id="timeoffset" size="1">
<option value="0" <?php if ($timeoffset==0) print "selected=\"selected\""; ?>>UTC/GMT</option>
<option value="9999" <?php if ($timeoffset==9999) print "selected=\"selected\""; ?>>Your local time</option>
<option value="-720" <?php if ($timeoffset==-720) print "selected=\"selected\""; ?>>-12 hours</option>
<option value="-660" <?php if ($timeoffset==-660) print "selected=\"selected\""; ?>>-11 hours</option>
<option value="-600" <?php if ($timeoffset==-600) print "selected=\"selected\""; ?>>-10 hours</option>
<option value="-570" <?php if ($timeoffset==-570) print "selected=\"selected\""; ?>>-9.5 hours</option>
<option value="-540" <?php if ($timeoffset==-540) print "selected=\"selected\""; ?>>-9 hours</option>
<option value="-510" <?php if ($timeoffset==-510) print "selected=\"selected\""; ?>>-8.5 hours</option>
<option value="-480" <?php if ($timeoffset==-480) print "selected=\"selected\""; ?>>-8 hours</option>
<option value="-420" <?php if ($timeoffset==-420) print "selected=\"selected\""; ?>>-7 hours</option>
<option value="-360" <?php if ($timeoffset==360)  print "selected=\"selected\""; ?>>-6 hours</option>
<option value="-300" <?php if ($timeoffset==-300) print "selected=\"selected\""; ?>>-5 hours</option>
<option value="-240" <?php if ($timeoffset==-240) print "selected=\"selected\""; ?>>-4 hours</option>
<option value="-210" <?php if ($timeoffset==-210) print "selected=\"selected\""; ?>>-3.5 hours</option>
<option value="-180" <?php if ($timeoffset==-180) print "selected=\"selected\""; ?>>-3 hours</option>
<option value="-120" <?php if ($timeoffset==-120) print "selected=\"selected\""; ?>>-2 hours</option>
<option value="-60" <?php if ($timeoffset==-60) print "selected=\"selected\""; ?>>-1 hour</option>
<option value="60" <?php if ($timeoffset==60) print "selected=\"selected\""; ?>>+1 hours</option>
<option value="120" <?php if ($timeoffset==120) print "selected=\"selected\""; ?>>+2 hours</option>
<option value="180" <?php if ($timeoffset==180) print "selected=\"selected\""; ?>>+3 hours</option>
<option value="210" <?php if ($timeoffset==210) print "selected=\"selected\""; ?>>+3.5 hours</option>
<option value="240" <?php if ($timeoffset==240) print "selected=\"selected\""; ?>>+4 hours</option>
<option value="270" <?php if ($timeoffset==270) print "selected=\"selected\""; ?>>+4.5 hours</option>
<option value="300" <?php if ($timeoffset==300) print "selected=\"selected\""; ?>>5 hours</option>
<option value="330" <?php if ($timeoffset==330) print "selected=\"selected\""; ?>>+5.5 hours</option>
<option value="360" <?php if ($timeoffset==360) print "selected=\"selected\""; ?>>+6 hours</option>
<option value="390" <?php if ($timeoffset==390) print "selected=\"selected\""; ?>>+6.5 hours</option>
<option value="420" <?php if ($timeoffset==420) print "selected=\"selected\""; ?>>+7 hours</option>
<option value="480" <?php if ($timeoffset==480) print "selected=\"selected\""; ?>>+8 hours</option>
<option value="540" <?php if ($timeoffset==540) print "selected=\"selected\""; ?>>+9 hours</option>
<option value="570" <?php if ($timeoffset==570) print "selected=\"selected\""; ?>>+9.5 hours</option>
<option value="600" <?php if ($timeoffset==600) print "selected=\"selected\""; ?>>+10 hours</option>
<option value="630" <?php if ($timeoffset==630) print "selected=\"selected\""; ?>>+10.5 hours</option>
<option value="660" <?php if ($timeoffset==660) print "selected=\"selected\""; ?>>+11 hours</option>
<option value="690" <?php if ($timeoffset==690) print "selected=\"selected\""; ?>>+11.5 hours</option>
<option value="720" <?php if ($timeoffset==720) print "selected=\"selected\""; ?>>+12 hours</option>
</select>
</div>

<div class="verticalfield">
<label class="verticalfield" for="selectedonly">Most recent first</label>
<input class="logmanage" type="radio" name="order" value="DESC" <?php if ($order=="DESC") print "checked=\"checked\""; ?>>
</div>

<div class="verticalfield">
<label class="verticalfield" for="selectedonly">Oldest first</label>
<input class="logmanage" type="radio" name="order" value="ASC" <?php if ($order=="ASC") print "checked=\"checked\""; ?>>
</div>

</fieldset>

<div>
<button type="button" id="view-go" name="viewbutton" value="View" onclick="View_Log(this.form);">View</button>
<button type="button" id="export-go" name="exportbutton" value="Export" onclick="Export_Log(this.form);">Export</button>
<button type="button" id="delete-go" name="deletebutton" value="Delete" onclick="Clear_Log(this.form);">Delete</button>
<button type="button" id="cancel-go" value="Cancel" onclick="location.href='index.php'">Cancel</button>
</div>

</form>
<?php
if ($entriesdeleted)
  print $numdeleted." entries deleted<br>";
?>
<script  type="text/javascript">
  var obj=document.getElementById("fromdate")
  obj.focus()
</script>
<?php include "footeradminother.php"; ?>
</body>
</html>