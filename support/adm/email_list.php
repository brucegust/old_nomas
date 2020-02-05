<?php

function insert($conn) {
	
	$sql=$conn->prepare("SELECT * FROM video_clips ORDER BY expiration_date DESC, last_name DESC");
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
		<b>Practice Video Assign List</b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;<BR>
		</td>
	</tr>
	<tr>
		<td class="MainText">
		<P>
		Here are all the videos you've assigned coupled with the people you've assigned them to. Click on the "edit" or "delete" button to maintain them however
		you need to.
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
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">clip</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">expiration date</td>
				<td style="text-align:center; background-color:#000; color:#fff; font-weight:bold;">edit / delete</td>
			</tr>
			<?php	
				foreach($list_this as $term)
				{
					if($term['clip']=="flaccid")
					{
						$video_name="All the Flaccid Tongue Videos";
					}
						elseif($term['clip']=="1")
						{
							$video_name="Flaccid Tongue Video #1";
						}
						elseif($term['clip']=="2")
						{
							$video_name="Flaccid Tongue Video #2";
						}
						elseif($term['clip']=="3")
						{
							$video_name="Flaccid Tongue Video #1";
						}
						elseif($term['clip']=="4")
						{
							$video_name="Flaccid Tongue Video #4";
						}
						elseif($term['clip']=="5")
						{
							$video_name="Flaccid Tongue Video #5";
						}
						elseif($term['clip']=="6")
						{
							$video_name="Flaccid Tongue Video #6";
						}
						elseif($term['clip']=="7")
						{
							$video_name="Flaccid Tongue Video #7";
						}
						elseif($term['clip']=="8")
						{
							$video_name="Flaccid Tongue Video #8";
						}
						elseif($term['clip']=="9")
						{
							$video_name="Flaccid Tongue Video #9";
						}
						elseif($term['clip']=="10")
						{
							$video_name="Flaccid Tongue Video #10";
						}
						elseif($term['clip']=="retracted")
						{
							$video_name="All the Retracted Tongue Videos";
						}
						elseif($term['clip']=="11")
						{
							$video_name="Retracted Tongue Video #1";
						}
						elseif($term['clip']=="12")
						{
							$video_name="Retracted Tongue Video #2";
						}
						elseif($term['clip']=="13")
						{
							$video_name="Retracted Tongue Video #1";
						}
						elseif($term['clip']=="14")
						{
							$video_name="Retracted Tongue Video #4";
						}
						elseif($term['clip']=="15")
						{
							$video_name="Retracted Tongue Video #5";
						}
						elseif($term['clip']=="16")
						{
							$video_name="Retracted Tongue Video #6";
						}
						elseif($term['clip']=="17")
						{
							$video_name="Retracted Tongue Video #7";
						}
						elseif($term['clip']=="18")
						{
							$video_name="Retracted Tongue Video #8";
						}
						elseif($term['clip']=="19")
						{
							$video_name="Retracted Tongue Video #9";
						}
						elseif($term['clip']=="20")
						{
							$video_name="Retracted Tongue Video #10";
						}
					else
					{
						$video_name="";
					}
				?>
					<tr>
						<td><?php echo $term['first_name'].' '.$term['last_name'] ;?></td>
						<td><?php echo $video_name;?></td>
						<td><?php echo date("m/d/Y", strtotime($term['expiration_date']));?></td>
						<td style="border:1px solid #cccccc; text-align:center; background-color:#cccccc;">
						<A HREF="email_display.php?ID=<?php echo $term['id']; ?>&Edit=Yes">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<A HREF="email_display.php?ID=<?php echo $term['id']; ?>&Delete=Yes">Delete</a>
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