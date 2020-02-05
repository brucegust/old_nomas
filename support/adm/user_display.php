<?php

function display($conn, $ID) {
	
	$the_id=$ID;
	
	$sql=$conn->prepare("SELECT * FROM ceu_users WHERE orderno=:id");
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
	$name=$data['name'];
	$itemnumber=$data['itemnumber'];
	$startdate=date("m/d/Y", strtotime($data['winopen']));
	$expiration_date=date("m/d/Y", strtotime($data['winclose']));
	$id=$data['orderno'];
}

?>

<style>

	table.display {
		width:700px; 
		border-collapse: collapse; 
		border:1px solid #ccc;
	}
	
	table.display td {
		border:1px solid #ccc;
		padding:5px; 
	}

</style>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>User Display Page</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		To edit the <b><?php echo $expiration_date;?></b> access expiration date for the user displayed, change the date below then click on "submit."
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
			<table class="display"><form action="user_edit.php" method="POST">
			<tr>
					<td style="width:200px;">
					name
					</td>
					<td style="width:500px;"><?php echo $name;?></td>
				</tr>
				<tr>
					<td style="width:200px;">
					item number
					</td>
					<td style="width:500px;"><?php echo $itemnumber;?></td>
				</tr>
				<tr>
					<td style="width:200px;">
					start date
					</td>
					<td style="width:500px;"><?php echo $startdate;?></td>
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
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="Submit" value="Submit">
		</td>
	</tr>		
</table>

<?php
require_once("footer.php");
?>