<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header('Content-Type: text/html; charset=utf-8');

if(session_id() == '') { session_start(); }

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NOMAS International | Admin Page</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>

$(document).ready(function(){

	$('#repeat').hide();

	  $("button").click(function(){
		$("#repeat").toggle();
	  });
  
});

</script>

<script>
function MM_jumpMenu(targ,selObj,restore){ //v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore) selObj.selectedIndex=0;
	}
</script>

</head>

<body bgcolor="#ffffff">

<table width=100% height=100% valign="center" cellspacing="0" cellpadding="0" border="0">
<tr>
<tr>
<td class="center" valign="top">&nbsp;<BR>
	<table width="800" cellspacing="0" cellpadding="0" class="center">
	<tr>
	<td align="center">
	<IMG SRC="images/admin_header.jpg">
	</td>
	</tr>
	<tr>
	<td>&nbsp;<BR>