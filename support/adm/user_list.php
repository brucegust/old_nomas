<?php

function insert($conn) {
	
	$sql=$conn->prepare("SELECT * FROM ceu_users ORDER BY name");
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

$list_this=insert($conn);


?>

<table border="0" cellspacing="0" cellpadding="0" width=100%>
	<tr>
		<td class="TitleText">
		<b>Users List</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		To extend a user's access period, click on the "edit" link displayed to the right of their name.
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
			<div class="table_cell" style="width:900px;">
			<table style="width:900px;">
			<tr>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">name</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">item number</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">start date</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">expiration date</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">edit / delete</td>
			</tr>
			<?php	
				foreach($list_this as $term)
				{
				?>
					<tr>
						<td><?php echo $term['name'] ;?></td>
						<td><?php echo $term['itemnumber'] ;?></td>
						<td>
							<?php 
							if($term['winopen']<>"0000-00-00")
							{
								echo date("m/d/Y", strtotime($term['winopen'])) ;
							}
							else
							{
								echo "&nbsp;";
							}
							?>
						</td>
						<td>
							<?php 
							if($term['winclose']<>"0000-00-00")
							{
								echo date("m/d/Y", strtotime($term['winclose'])) ;
							}
							else
							{
								echo "&nbsp;";
							}
							?>
						</td>
						<td style="border:1px solid #cccccc; text-align:center; background-color:#cccccc;">
						<A HREF="user_display.php?ID=<?php echo $term['orderno']; ?>&Edit=Yes">Edit</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		</div>
		</td>
	</tr>
</table>

<?php
require_once("footer.php");
?>