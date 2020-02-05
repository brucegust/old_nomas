<?php 
session_start(); 
 
switch (@$_POST['do'])
{
      case "login":
      $password=$_POST['password'];
	 if ($password != "Secret") { 
      header("Location:login_wrong.php");
      exit ();
      }
     else
      {
      $_SESSION['auth'] = "yes";
      header("Location:admin.php");
      exit();
      }
 
      break;
}
require_once('header.php'); 
 
?>
	
<table border="0" cellspacing="0" cellpadding="0" style="width:990px; margin:auto;">
	<tr>
		<td class="TitleText">
		<b>Admin Page Login</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">Enter your password below, then click on "Submit." 
		</td>
	</tr>
	<tr>
		<td>
		&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td style="text-align:center;">
			<table style="width:900px; margin:auto;" border="0"><form action="index.php" method="post">
				<tr>
					<td style="text-align:center;">
					<input type="password" name="password" size="35">
					</td>
				</tr>
				<tr>
					<td style="text-align:center;">
					<input type="Submit" value="Submit">  <input type="hidden" name="do" value="login">
					</td>
				</tr>
			</table></form>

		</td>
	</tr>
</table>

		
	
 <?php require_once('footer.php'); ?>	