<?php

if(isset($_GET['clip'])&&$_GET['clip']=="flaccid")
{
	$video_name="All the Flaccid Tongue Videos";
}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="1")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="2")
	{
		$video_name="Flaccid Tongue Video #2";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="3")
	{
		$video_name="Flaccid Tongue Video #1";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="4")
	{
		$video_name="Flaccid Tongue Video #4";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="5")
	{
		$video_name="Flaccid Tongue Video #5";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="6")
	{
		$video_name="Flaccid Tongue Video #6";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="7")
	{
		$video_name="Flaccid Tongue Video #7";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="8")
	{
		$video_name="Flaccid Tongue Video #8";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="9")
	{
		$video_name="Flaccid Tongue Video #9";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="10")
	{
		$video_name="Flaccid Tongue Video #10";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="retracted")
	{
		$video_name="All the Retracted Tongue Videos";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="11")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="12")
	{
		$video_name="Retracted Tongue Video #2";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="13")
	{
		$video_name="Retracted Tongue Video #1";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="14")
	{
		$video_name="Retracted Tongue Video #4";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="15")
	{
		$video_name="Retracted Tongue Video #5";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="16")
	{
		$video_name="Retracted Tongue Video #6";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="17")
	{
		$video_name="Retracted Tongue Video #7";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="18")
	{
		$video_name="Retracted Tongue Video #8";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="19")
	{
		$video_name="Retracted Tongue Video #9";
	}
	elseif(isset($_GET['clip'])&&$_GET['clip']=="20")
	{
		$video_name="Retracted Tongue Video #10";
	}
else
{
	header("location:no_video_chosen.php");
	exit();
}

require_once('header.php'); 

?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Practice Video Assign Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		To assign the <b><a href="http://nomasinternational.org/display_video.php?video=<?php echo $_GET['clip'];?>" target="_blank"><?php echo $video_name;?></a></b> to a user for a period of two days, insert their information into the fields below and click on, "submit."
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
			<table style="width:700px;" border="0"><form action="video_insert_execute.php" method="POST">
			<tr>
					<td style="width:200px;">
					first name
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="first_name">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					last name
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="last_name">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					email address
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="email">
					</td>
				</tr>
			</table>
		</div>
		</td>
	</tr>
	<tr>
		<td style="text-align:center;" colspan="2">&nbsp;<br>
		<input type="hidden" name="clip" value="<?php echo $_GET['clip'];?>">
		<input type="Submit" value="Submit">
		</td>
	</tr>		
</table>

<?php
require_once("footer.php");
?>