<?php

if(isset($_POST['clip'])&&$_POST['clip']=="flaccid")
{
	$video_name="All the Flaccid Tongue Videos";
}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="1")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="2")
	{
		$video_name="Flaccid Tongue Video #2";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="3")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="4")
	{
		$video_name="Flaccid Tongue Video #4";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="5")
	{
		$video_name="Flaccid Tongue Video #5";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="6")
	{
		$video_name="Flaccid Tongue Video #6";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="7")
	{
		$video_name="Flaccid Tongue Video #7";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="8")
	{
		$video_name="Flaccid Tongue Video #8";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="9")
	{
		$video_name="Flaccid Tongue Video #9";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="10")
	{
		$video_name="Flaccid Tongue Video #10";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="retracted")
	{
		$video_name="All the Retracted Tongue Videos";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="11")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="12")
	{
		$video_name="Retracted Tongue Video #2";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="13")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="14")
	{
		$video_name="Retracted Tongue Video #4";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="15")
	{
		$video_name="Retracted Tongue Video #5";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="16")
	{
		$video_name="Retracted Tongue Video #6";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="17")
	{
		$video_name="Retracted Tongue Video #7";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="18")
	{
		$video_name="Retracted Tongue Video #8";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="19")
	{
		$video_name="Retracted Tongue Video #9";
	}
	elseif(isset($_POST['clip'])&&$_POST['clip']=="20")
	{
		$video_name="Retracted Tongue Video #10";
	}
else
{
	header("location:no_video_chosen.php");
	exit();
}

function insert($conn) {
	
	$today=date("Y-m-d");
	$two_days=date('Y-m-d', strtotime($today. ' + 3 days'));
	$first_name=trim($_POST['first_name']);
	$last_name=trim($_POST['last_name']);
	$email=trim($_POST['email']);
	$clip=$_POST['clip'];
	
	$sql=$conn->prepare("INSERT INTO video_clips (first_name, last_name, clip, email, expiration_date) VALUES(:first_name, :last_name, :clip, :email, :expiration_date)");
	$sql->bindParam(':first_name', $first_name, PDO::PARAM_STR);
	$sql->bindParam(':last_name', $last_name, PDO::PARAM_STR);
	$sql->bindParam(':email', $email, PDO::PARAM_STR);
	$sql->bindParam(':expiration_date', $two_days, PDO::PARAM_STR);
	$sql->bindParam(':clip', $clip, PDO::PARAM_STR);
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

$do_this=insert($conn);

$today=date("Y-m-d");
$two_days=date('Y-m-d', strtotime($today. ' + 1 days'));

?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Practice Video Assign Execution Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here's the email and the video combo you just created! You can send them to: <b><?php echo $video_name;?></b> to access the video after successfully logging in using their email address and the password, "Secret." They'll have access to the clip for two days after today (<b><?php echo date("m/d/Y", strtotime($two_days));?></b>). 
		<div style="width:90%; margin:auto; height:auto; padding:10px; border:1px solid #ccc; box-shadow:10px 10px 5px #ccc; text-align:center;">The URL you'll send them to is: <a href="http://nomasinternational.org/video_login.php?video=<?php echo $_POST['clip'];?>" target="_blank"><b>http://nomasinternational.org/video_login.php?video=<?php echo $_POST['clip'];?></b></a></div>
		<br>
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
			<table style="width:700px;" border="0">
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
			</table>
		</div>
		</td>
	</tr>
</table>

<?php
require_once("footer.php");
?>