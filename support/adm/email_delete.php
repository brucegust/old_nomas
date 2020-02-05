<?php

function display($conn, $id) {
	
	$sql=$conn->prepare("SELECT * FROM video_clips where id=:id");
	$sql->bindParam(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$result=array();
	while($row=$sql->fetch(PDO::FETCH_ASSOC))
	{
		$result[]=$row;
	}
	return $result;
}

require_once('header.php'); 

require_once("carter.inc");

$id=$_GET['id'];
$new_display=display($conn, $id);
?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Email Delete Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
			<table style="width:100%; margin:auto;" align="center" border="0" cellspacing="1" cellpadding="1"><form action="email_delete_execute.php" method="Post">
			<?php
			foreach($new_display as $term)
			{
			?>
				<tr>
					<td>	
					To delete, <b>"<?php echo stripslashes($term['email']); ?>"</b> and their access to the video you assigned to them, click on the "Delete" button below. Otherwise, click <A HREF="email_list.php">here</a> to return to the list of email addresses and videos.
					<P>
					<?php include ("help.php"); ?>
					</td>
				</tr>
					<td>&nbsp;<BR>
					</td>
				</tr>
				<tr>
				<td style="text-align:center;"><input type="hidden" name="ID" value="<?php echo $id; ?>">
				<input type="Submit" value="Delete"></td></form>
				</tr>
			<?php
			}
			?>
			</table>
		</td>
	</tr>
</table>
 <?php require_once('footer.php'); ?>	