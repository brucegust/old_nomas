<?php
$groupswithaccess="PUBLIC";
$loginpage="pagewithlogin-fancy.php";
$logoutpage="pagewithlogin-fancy.php";
$loginredirect=1;
require_once("../sitelokpw.php");
?>
<html>
<head>
<title>Page with login</title>
	<style type="text/css">
	/* Thanks to IE6 for requiring so much unnecessary CSS! */
	* {
		margin: 0;
		padding: 0;
	}
	/* @group Customer Login Form */
	/* customer login boxes */
	h1.loginboxcust {
		padding: 0 0 0 0;
		margin: -10px 0 20px 0;
		color: #ebebeb;
		font: bold 30px Arial,Helvetica,sans-serif;
		text-align: center;
	}
	label.loginboxcust {
		display: inline-block;
		position: relative;
		width: 96px;
		text-align: right;
		margin: 0 0 0 0;
		padding: 10px 10px 0 0;
		vertical-align: middle;
		text-transform: capitalize;
		font-variant: small-caps;
		font-family: "Lucida Grande",Lucida,Verdana,sans-serif;
		color: #7c7c7c;
	}
	input.loginboxcust {
		-moz-border-radius: 4px;
		border-radius: 4px;
		-webkit-box-shadow: 2px 3px 3px #0f0f0f;
		-moz-box-shadow: 2px 3px 3px #0f0f0f;
		box-shadow: 2px 3px 3px #0f0f0f;
		display: inline-block;
		position: relative;
		font-size: 14px;
		width: 280px;
		height: 20px;
		line-height: 20px;
		padding: 2px;
		margin: 10px 0 0 0;
		border: 1px solid #0d2c52;
		background-color: #c4c4c4;
		font-size: 16px;
		color: #444545;
		vertical-align: middle;
	}
	input.loginboxcust:focus {
		border: 1px solid #e19653;
		background-color: #eff2f1;
	}
	/* end login boxes for customer page */
	

	/* @group LogoutButton	 */
		a.buttonlogout {
			-moz-box-shadow:inset 0px 1px 0px 0px #f29c93;
			-webkit-box-shadow:inset 0px 1px 0px 0px #f29c93;
			box-shadow:inset 0px 1px 0px 0px #f29c93;
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100) );
			background:-moz-linear-gradient( center top, #fe1a00 5%, #ce0100 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
			background-color:#fe1a00;
			-moz-border-radius:6px;
			-webkit-border-radius:6px;
			border-radius:6px;
			border:1px solid #d83526;
			display:inline-block;
			color:#ffffff;
			font-family:arial;
			font-size:14px;
			font-weight:bold;
			padding:6px 24px;
			text-decoration:none;
			text-shadow:1px 1px 0px #b23e35;
		}
		a.buttonlogout:hover {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ce0100), color-stop(1, #fe1a00) );
			background:-moz-linear-gradient( center top, #ce0100 5%, #fe1a00 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ce0100', endColorstr='#fe1a00');
			background-color:#ce0100;
		}
		a.buttonlogout:active {
			position:relative;
			top:1px;
		}
			a.buttonpassword {
			-moz-box-shadow:inset 0px 1px 0px 0px #f29c93;
			-webkit-box-shadow:inset 0px 1px 0px 0px #f29c93;
			box-shadow:inset 0px 1px 0px 0px #f29c93;
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100) );
			background:-moz-linear-gradient( center top, #fe1a00 5%, #ce0100 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
			background-color:#fe1a00;
			-moz-border-radius:6px;
			-webkit-border-radius:6px;
			border-radius:6px;
			border:1px solid #d83526;
			display:inline-block;
			color:#ffffff;
			font-family:arial;
			font-size:11px;
			font-weight:bold;
			height: 15px;
			line-height: 15px;
			padding: 4px 10px;
			text-decoration:none;
			text-shadow:1px 1px 0px #b23e35;
			margin-top: 5px;
		margin-left: 108px;
		}
		a.buttonpassword:hover {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ce0100), color-stop(1, #fe1a00) );
			background:-moz-linear-gradient( center top, #ce0100 5%, #fe1a00 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ce0100', endColorstr='#fe1a00');
			background-color:#ce0100;
		}
		a.buttonpassword:active {
			position:relative;
			top:1px;
		}

	input[type="submit"] {
		-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
		-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
		box-shadow:inset 0px 1px 0px 0px #bbdaf7;
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
		background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
		background-color:#79bbff;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		border-radius:6px;
		border:1px solid #84bbf3;
		display:inline-block;
		color:#ffffff;
		font-family:arial;
		font-size:14px;
		font-weight:bold;
		padding:5px 25px;
		text-decoration:none;
		text-shadow:1px 1px 0px #528ecc;
		margin-top: 10px;
		margin-left: 108px;
	}
	input[type="submit"]:hover {
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
		background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
		background-color:#378de5;
	}
	input[type="submit"]:active {
		position:relative;
		top:1px;
		}
	/* @end */
	</style>

</head>
<body>

This page can be seen by anyone who visits.
	<?php if ($slpublicaccess) { ?>
	<p> You can log in using the form below if you wish.</p>
	<p></p>
	<?php if ($msg!="") print $msg; ?>
	<form id ="svplogin" name="siteloklogin" action="<?php print $startpage; ?>" method="POST" onSubmit="return validatelogin()">
	<fielsdset>
	<?php siteloklogin(); ?>
	<label class="loginboxcust" for="username">Username</label>
		<input class="loginboxcust" type="text" name="username" value="" maxlength="50"><br />
	<label class="loginboxcust" for="password">Password</label>
		<input class="loginboxcust" type="password" name="password" value="" maxlength="50"><br />
	<input type="Submit" name="login" value="Login"><br />
	<a class="buttonpassword" href="javascript: void forgotpw()"
	title="Forgot your password? Enter username or email &amp; click link">
	Forgot your password?</a>
	</fieldset>
	</form>
	<?php } ?>
	<p>This text can be seen by all visitors - publicly visible </p>
	<?php if (!$slpublicaccess) { ?>
	<p>This part can only be seen by logged in members.</p>
	<p>You are logged in as <?php echo $slusername; ?></p>
	<p><a class="buttonlogout" href="<?php siteloklogout()?>">Logout</a></p>
	<?php } ?>
</body>
</html>
