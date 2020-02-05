<?php
  // The following line gets the url variables
  if (!empty($_GET)) while(list($name, $value) = each($_GET)) $$name = $value;
  if (isset($DbName))
  {
    $mysql_link=mysql_connect($DbHost,$DbUser,$DbPassword);
    if ($mysql_link==0)
    {
      print("Can't connect to $DbHost");
      exit;
    }
//    $Query="CREATE DATABASE ".$DbName;
//    $mysql_result=mysql_query($Query,$mysql_link);
//    $err=mysql_error($mysql_link);
//    print("$err<BR>");
    $db=mysql_select_db($DbName,$mysql_link);
    if ($db!=True)
    {
	    $err=mysql_error($mysql_link);
  	  print("$err<BR>");
      print("Can't connect to database $DbName");
      exit;
    }
    $Query= "CREATE TABLE ".$DbTableName." (";
    $Query.="id VARCHAR( 255 ) NOT NULL, ";
    $Query.="description VARCHAR( 255 ), ";
    $Query.="price VARCHAR( 255 ), ";
    $Query.="location TEXT, ";
    $Query.="expiry VARCHAR( 30 ), ";
    $Query.="extra TEXT, ";
    $Query.="PRIMARY KEY (id))";
    $mysql_result=mysql_query($Query,$mysql_link);
    $err=mysql_error($mysql_link);
    if (strlen($err)>2)
    {
	    mysql_close($mysql_link);
      print("$err");
      exit;
    }
    print("The Linklok products database is now setup");
    exit;
  }
?>
<html>
<head>
<title>Linklok products MySQL table setup</title>
<meta name="GENERATOR" content="Namo WebEditor v5.0">
<meta name="description" content="Blank document with no style.">
<script language="JavaScript">
<!-- JavaScript
// - JavaScript - -->
  function ValidateInput(f){
    var host = f.DbHost.value
    var dname = f.DbName.value
    var tname = f.DbTableName.value
    var user = f.DbUser.value
    var pass = f.DbPassword.value
    if (host == "")
    {
      alert('Please enter the MySQL host')
      f.DbHost.focus()
      return (false)
    }
    if (dname == "")
    {
      alert('Please enter an existing database name')
      f.DbName.focus()
      return (false)
    }
    if (tname == "")
    {
      alert('Please enter a table name')
      f.DbTableName.focus()
      return (false)
    }
    if (user == "")
    {
      alert('Please enter an existing MySQL username')
      f.DbUser.focus()
      return (false)
    }
    if (pass == "")
    {
      alert('Please enter the password for the MySQL user')
      f.DbPassword.focus()
      return (false)
    }
    return (true)
  }
</script>

</head>
<body bgcolor="#FFFFCC">

<p><font face="Arial"><span style="font-size:16pt;">Utility to create Linklok
product table</span></font></p>
<p><font face="Arial"><span style="font-size:10pt;">Before using this utility
you must have an exisiting MySQL database and user account setup</span></font></p>
            <form name="form1" ONSUBMIT="return ValidateInput(this);" method="get" action="createproductstable.php">
<table border="0" cellpadding="0" cellspacing="0" width="565">
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">MySQL host</span></font></p>
        </td>
        <td width="292">
                <p><input type="text" name="DbHost" value="localhost" size="35"></p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
                <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">Existing MySQL database
            name</span></font></p>
        </td>
        <td width="292">
                <p><input type="text" name="DbName" value="linklok" size="35"></p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
                <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">MySQL table
            name</span></font></p>
        </td>
        <td width="292">
                <p><input type="text" name="DbTableName" value="products" size="35"></p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
                <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">MySQL username
            (existing)</span></font></p>
        </td>
        <td width="292">
                <p><input type="text" name="DbUser" size="35"></p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
                <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">MySQL password
            for user (existing)</span></font></p>
        </td>
        <td width="292">
                <p><input type="password" name="DbPassword" size="35"></p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
            <p>&nbsp;</p>
        </td>
    </tr>
    <tr>
        <td width="273">
            <p><font face="Arial"><span style="font-size:10pt;">&nbsp;</span></font></p>
        </td>
        <td width="292">
                <p align="right"><input type="submit" name="Button" value="Create"></p>
        </td>
    </tr>
</table>
</form>
<p><font face="Arial"><span style="font-size:16pt;">&nbsp;</span></font></p>
</body>
</html>

