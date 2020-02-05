<?php

function deleteEmail($conn, $id) {
	
	$sql=$conn->prepare("DELETE FROM video_clips where id=:id");
	$sql->bindParam(':id', $id, PDO::PARAM_INT);
	$sql->execute();

}

require_once('header.php'); 

require_once("carter.inc");

$id=$_POST['ID'];
$new_display=deleteEmail($conn, $id);
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Email Delete Execute Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
			<table style="width:100%; margin:auto;" align="center" border="0" cellspacing="1" cellpadding="1">
				<tr>
					<td>	
					Congratulations! You have successfully deleted your selection from the database. Click <A HREF="email_list.php">here</a> to return to the roster of email addresses.
					<P>
					<?php include ("help.php"); ?>
					</td>
				</tr>
					<td>&nbsp;<BR>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
 <?php require_once('footer.php'); ?>	