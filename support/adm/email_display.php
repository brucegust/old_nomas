<?php

if ($_GET['Edit'] != "Yes")
{
$ID=$_GET['ID'];
header("Location: email_delete.php?id=$ID");
}

function display($conn, $ID) {
	
	$the_id=$ID;
	
	$sql=$conn->prepare("SELECT * FROM video_clips WHERE id=:id");
	$sql->bindParam(':id', $the_id, PDO::PARAM_INT);
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

$ID=$_GET['ID'];

$display=display($conn, $ID);

foreach($display as $data)
{
	$first_name=$data['first_name'];
	$last_name=$data['last_name'];
	$email=$data['email'];
	$expiration_date=date("m/d/Y", strtotime($data['expiration_date']));
	$id=$data['id'];
	if($data['clip']=="fl_all")
	{
		$video_name="All the Flaccid Tongue Videos";
	}
		elseif($data['clip']=="fl_1")
		{
			$video_name="Flaccid Tongue Video #1";
		}
		elseif($data['clip']=="fl_2")
		{
			$video_name="Flaccid Tongue Video #2";
		}
		elseif($data['clip']=="fl_3")
		{
			$video_name="Flaccid Tongue Video #1";
		}
		elseif($data['clip']=="fl_4")
		{
			$video_name="Flaccid Tongue Video #4";
		}
		elseif($data['clip']=="fl_5")
		{
			$video_name="Flaccid Tongue Video #5";
		}
		elseif($data['clip']=="fl_6")
		{
			$video_name="Flaccid Tongue Video #6";
		}
		elseif($data['clip']=="fl_7")
		{
			$video_name="Flaccid Tongue Video #7";
		}
		elseif($data['clip']=="fl_8")
		{
			$video_name="Flaccid Tongue Video #8";
		}
		elseif($data['clip']=="fl_9")
		{
			$video_name="Flaccid Tongue Video #9";
		}
		elseif($data['clip']=="fl_10")
		{
			$video_name="Flaccid Tongue Video #10";
		}
		elseif($data['clip']=="re_all")
		{
			$video_name="All the Retracted Tongue Videos";
		}
		elseif($data['clip']=="re_1")
		{
			$video_name="Retracted Tongue Video #1";
		}
		elseif($data['clip']=="re_2")
		{
			$video_name="Retracted Tongue Video #2";
		}
		elseif($data['clip']=="re_3")
		{
			$video_name="Retracted Tongue Video #1";
		}
		elseif($data['clip']=="re_4")
		{
			$video_name="Retracted Tongue Video #4";
		}
		elseif($data['clip']=="re_5")
		{
			$video_name="Retracted Tongue Video #5";
		}
		elseif($data['clip']=="re_6")
		{
			$video_name="Retracted Tongue Video #6";
		}
		elseif($data['clip']=="re_7")
		{
			$video_name="Retracted Tongue Video #7";
		}
		elseif($data['clip']=="re_8")
		{
			$video_name="Retracted Tongue Video #8";
		}
		elseif($data['clip']=="re_9")
		{
			$video_name="Retracted Tongue Video #9";
		}
		elseif($data['clip']=="re_10")
		{
			$video_name="Retracted Tongue Video #10";
		}
	else
	{
		$video_name="";
	}
	
}

?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Practice Video Display Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		To edit the <b><?php echo $video_name;?></b> for the user displayed, change the content below then click on "submit."
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
					<input type="text" style="width:500px;" name="first_name" value="<?php echo $first_name;?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					last name
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="last_name" value="<?php echo $last_name;?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					email address
					</td>
					<td style="width:500px;">
					<input type="text" style="width:500px;" name="email" value="<?php echo $email;?>">
					</td>
				</tr>
				<tr>
					<td style="width:200px;">
					expiration date
					</td>
					<td style="width:500px;">
						<table>
							<tr>
								<td>
									<select name="month">
									<option selected value="<?php echo date("m", strtotime($expiration_date));?>"><?php echo date("F", strtotime($expiration_date));?></option>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="02">December</option>
									</select>
								</td>
								<td>
								<select name="day">
								<option selected value="<?php echo date("d", strtotime($expiration_date));?>"><?php echo date("d", strtotime($expiration_date));?></option>
								<option value="01">1</option>
								<option value="02">2</option>
								<option value="03">3</option>
								<option value="04">4</option>
								<option value="05">5</option>
								<option value="06">6</option>
								<option value="07">7</option>
								<option value="08">8</option>
								<option value="09">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
								</select>
							</td>
							<td>
								<select name="year">
								<?php 
								$this_year=date("Y");
								$next_year = date('Y', strtotime('+1 years'));
								$year_before=date("Y", strtotime('-1 year'));
								?>
								<option selected value="<?php echo date("Y", strtotime($expiration_date));?>"><?php echo date("Y", strtotime($expiration_date));?></option>
								<option value="<?php echo $year_before; ?>"><?php echo $year_before;?></option>
								<option value="<?php echo $this_year; ?>"><?php echo $this_year;?></option>
								<option value="<?php echo $next_year; ?>"><?php echo $next_year;?></option>
								</select>
							<td>
						</tr>
					</table>
				</td>
			</table>
		</div>
		</td>
	</tr>
	<tr>
		<td style="text-align:center;" colspan="2">&nbsp;<br>
		<input type="hidden" name="clip" value="<?php echo $data['clip'];?>">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="Submit" value="Submit">
		</td>
	</tr>		
</table>

<?php
require_once("footer.php");
?>