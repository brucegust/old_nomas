<?php

function edit($conn) {
	
	$month=$_POST['month'];
	$day=$_POST['day'];
	$year=$_POST['year'];
	
	$two_days=$year.'-'.$month.'-'.$day;
	$first_name=trim($_POST['first_name']);
	$last_name=trim($_POST['last_name']);
	$email=trim($_POST['email']);
	$clip=$_POST['clip'];
	$the_id=$_POST['id'];
	
	$sql=$conn->prepare("UPDATE video_clips set first_name=:first_name, last_name=:last_name, email=:email, clip=:clip, expiration_date=:full_date WHERE id=:id");
	$sql->bindParam(':first_name', $first_name, PDO::PARAM_STR);
	$sql->bindParam(':last_name', $last_name, PDO::PARAM_STR);
	$sql->bindParam(':email', $email, PDO::PARAM_STR);
	$sql->bindParam(':full_date', $two_days, PDO::PARAM_STR);
	$sql->bindParam(':clip', $clip, PDO::PARAM_STR);
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
	
if($_POST['clip']=="fl_all")
{
	$video_name="All the Flaccid Tongue Videos";
}
	elseif($_POST['clip']=="fl_1")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif($_POST['clip']=="fl_2")
	{
		$video_name="Flaccid Tongue Video #2";
	}
	elseif($_POST['clip']=="fl_3")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif($_POST['clip']=="fl_4")
	{
		$video_name="Flaccid Tongue Video #4";
	}
	elseif($_POST['clip']=="fl_5")
	{
		$video_name="Flaccid Tongue Video #5";
	}
	elseif($_POST['clip']=="fl_6")
	{
		$video_name="Flaccid Tongue Video #6";
	}
	elseif($_POST['clip']=="fl_7")
	{
		$video_name="Flaccid Tongue Video #7";
	}
	elseif($_POST['clip']=="fl_8")
	{
		$video_name="Flaccid Tongue Video #8";
	}
	elseif($_POST['clip']=="fl_9")
	{
		$video_name="Flaccid Tongue Video #9";
	}
	elseif($_POST['clip']=="fl_10")
	{
		$video_name="Flaccid Tongue Video #10";
	}
	elseif($_POST['clip']=="re_all")
	{
		$video_name="All the Retracted Tongue Videos";
	}
	elseif($_POST['clip']=="re_1")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif($_POST['clip']=="re_2")
	{
		$video_name="Retracted Tongue Video #2";
	}
	elseif($_POST['clip']=="re_3")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif($_POST['clip']=="re_4")
	{
		$video_name="Retracted Tongue Video #4";
	}
	elseif($_POST['clip']=="re_5")
	{
		$video_name="Retracted Tongue Video #5";
	}
	elseif($_POST['clip']=="re_6")
	{
		$video_name="Retracted Tongue Video #6";
	}
	elseif($_POST['clip']=="re_7")
	{
		$video_name="Retracted Tongue Video #7";
	}
	elseif($_POST['clip']=="re_8")
	{
		$video_name="Retracted Tongue Video #8";
	}
	elseif($_POST['clip']=="re_9")
	{
		$video_name="Retracted Tongue Video #9";
	}
	elseif($_POST['clip']=="re_10")
	{
		$video_name="Retracted Tongue Video #10";
	}
else
{
	$video_name="";
}

$month=$_POST['month'];
$day=$_POST['day'];
$year=$_POST['year'];

?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Practice Video Edit Display Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here are the edits you just made for <b><?php echo $_POST['first_name'].' '.$_POST['last_name'];?></b> and the <b><?php echo $video_name;?></b> Practice Video.
		<br><br>
		Click <a href="email_list.php">here</a> to return to the email list.
		<br><br>
		<?php include ("help.php"); ?>
		</td>
	</tr>
	<tr>
		<td>
		&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td>
		<HR>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td align="center">
			<div class="table_cell" style="width:710px;">
			<table style="width:700px;" border="0"><form action="email_edit.php" method="POST">
			<tr>
					<td style="width:200px;">
					first name
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="first_name" value="<?php echo $_POST['first_name'];?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					last name
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="last_name" value="<?php echo $_POST['last_name'];?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					email address
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="email" value="<?php echo $_POST['email'];?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					expiration date
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="email" value="<?php echo $month.'/'.$day.'/'.$year;?>"></td>
				</tr>
			</table>
		</div>
		</td>
	</tr>	
</table>

<?php
require_once("footer.php");
?>