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
    $Query.="orderno VARCHAR( 255 ) NOT NULL ,";
    $Query.="parentorderno VARCHAR( 255 ) ,";
    $Query.="datetime DATETIME,";
    $Query.="processor VARCHAR( 255 ) ,";
    $Query.="name VARCHAR( 255 ) ,";
    $Query.="company VARCHAR( 255 ) ,";
    $Query.="street1 VARCHAR( 255 ) ,";
    $Query.="street2 VARCHAR( 255 ) ,";
    $Query.="city VARCHAR( 255 ) ,";
    $Query.="state VARCHAR( 255 ) ,";
    $Query.="zip VARCHAR( 255 ) ,";
    $Query.="country VARCHAR( 255 ) ,";
    $Query.="email VARCHAR( 255 ) ,";
    $Query.="telephone VARCHAR( 255 ) ,";
    $Query.="fax VARCHAR( 255 ) ,";
    $Query.="shipname VARCHAR( 255 ) ,";
    $Query.="shipcompany VARCHAR( 255 ) ,";
    $Query.="shipstreet1 VARCHAR( 255 ) ,";
    $Query.="shipstreet2 VARCHAR( 255 ) ,";
    $Query.="shipcity VARCHAR( 255 ) ,";
    $Query.="shipstate VARCHAR( 255 ) ,";
    $Query.="shipzip VARCHAR( 255 ) ,";
    $Query.="shipcountry VARCHAR( 255 ) ,";
    $Query.="shiptelephone VARCHAR( 255 ) ,";
    $Query.="message TEXT,";
    $Query.="invoice VARCHAR( 255) ,";
    $Query.="ip VARCHAR( 50 ) ,";
    $Query.="referrerfirst VARCHAR( 255 ) ,";
    $Query.="entryfirst VARCHAR( 255 ) ,";
    $Query.="referrernow VARCHAR( 255 ) ,";
    $Query.="entrynow VARCHAR( 255 ) ,";
    $Query.="total DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="tax DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="shipping DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="fee DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="currency VARCHAR( 4 ) ,";
    $Query.="method VARCHAR( 255 ) ,";
    $Query.="custom1 VARCHAR( 255 ) ,";
    $Query.="custom2 VARCHAR( 255 ) ,";
    $Query.="custom3 VARCHAR( 255 ) ,";
    $Query.="custom4 VARCHAR( 255 ) ,";
    $Query.="discount DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="voucher VARCHAR( 255 ) ,";
    $Query.="voucherval DECIMAL( 10,2 ) DEFAULT 0.00,";
    $Query.="numitems INT DEFAULT 0,";
    $Query.="itemnumber TEXT,";
    $Query.="itemname TEXT,";
    $Query.="quantity TEXT,";
    $Query.="price TEXT,";
    $Query.="auction VARCHAR( 1 ) DEFAULT 'N',";
    $Query.="auction_buyer_id VARCHAR( 255 ) ,";
    $Query.="auction_closing_date VARCHAR( 255 ) ,";
    $Query.="ipn VARCHAR( 1 ) DEFAULT 'N',";
    $Query.="`return` VARCHAR( 1 ) DEFAULT 'N',";
    $Query.="orderstatus VARCHAR( 255 ) ,";
    $Query.="llnumitems INT DEFAULT 0,";
    $Query.="llitemnumber TEXT,";
    $Query.="llitemname TEXT,";
    $Query.="sitelokusername VARCHAR( 255 ) ,";
    $Query.="sitelokpassword VARCHAR( 255 ) ,";
    $Query.="serialnumber TEXT,";
    $Query.="userfunction TEXT,";
    $Query.="softwarepassportname TEXT,";
    $Query.="softwarepassportkey TEXT,";
    $Query.="clicklocker TEXT,";
    $Query.="PRIMARY KEY (orderno))";

    $mysql_result=mysql_query($Query,$mysql_link);
    $err=mysql_error($mysql_link);
    if (strlen($err)>2)
    {
	    mysql_close($mysql_link);
      print("$err");
      exit;
    }
    print("The Linklok orders database is now setup");
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
orders table</span></font></p>
<p><font face="Arial"><span style="font-size:10pt;">Before using this utility
you must have an exisiting MySQL database and user account setup</span></font></p>
            <form name="form1" ONSUBMIT="return ValidateInput(this);" method="get" action="createordertable.php">
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
                <p><input type="text" name="DbTableName" value="orders" size="35"></p>
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
