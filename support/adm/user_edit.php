<?php

function edit($conn) {
	
	$month=$_POST['month'];
	$day=$_POST['day'];
	$year=$_POST['year'];
	
	$exp_date=$year.'-'.$month.'-'.$day;
	$the_id=$_POST['id'];
	
	$sql=$conn->prepare("UPDATE ceu_users set winclose=:exp_date WHERE orderno=:id");
	$sql->bindParam(':exp_date', $exp_date, PDO::PARAM_STR);
	$sql->bindParam(':id', $the_id, PDO::PARAM_INT);
	if($sql->execute())
	{
		return "good";
	}
	else
	{
		return "whoops";
	}
}

require_once('header.php'); 

require_once("carter.inc");

$display=edit($conn);


$month=$_POST['month'];
$day=$_POST['day'];
$year=$_POST['year'];

?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>User Edit Display Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Congratulations! You have just successfully updated your user's access period to <b><?php echo $month;?>/<?php echo $day;?>/<?php echo $year;?></b>!
		<br><br>
		Click <a href="user_list.php">here</a> to return to the user list.
		<br><br>
		<?php include ("help.php"); ?>
		</td>
	</tr>
</table>

<?php
require_once("footer.php");
?>