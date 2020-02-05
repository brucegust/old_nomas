<?php 
require_once('header.php'); 
?>
			
<table border="0" cellspacing="0" cellpadding="0" width=100%>		
	<tr>		
		<td>		
		<IMG SRC="images/spacer.gif" width="10" height="10">		
		</td>		
		<td>			
			<table border="0" cellspacing="0" cellpadding="0" width=100% class="center">			
				<tr>			
					<td class="TitleText">			
					<b>Nomas International<sup>&copy;</sup> Admin Page</b>			
					</td>			
				</tr>			
				<tr>			
					<td>&nbsp;<BR>			
					</td>			
				</tr>			
				<tr>			
					<td>			
					<P>			
					Welcome to the NOMAS International Admin Page! 
					<br><br>
					You can use this interface to manage your practice videos as well as extend a user's access to course content. 
					<ul>
						<li>To extend a user's access to their course content, click on "List Users" from the "users" pulldown menu below</li>
						<li>Choose from the videos listed in the pulldown menus below to give a student access to it for a specified amount of time.</li>
						<li>Choose any of the "email" options to monitor and maintain your list of students that you have emailed and the videos you've given them access to</li>
					</ul>
					</td>			
				</tr>				
				<tr>			
					<td>				
						<table style="width:600px; margin:auto;" border="0" cellspacing="3" cellpadding="3">				
							<tr>
								<td valign="top">
									<table cellspacing="3" cellpadding="3">
										<tr>
											<td>
												<select name="select" size="1" onchange="MM_jumpMenu('top',this,1)">						
													<option value="#" selected>Videos</option>						
													<option value="video.php?clip=flaccid">Flaccid Tongue</option>
													<option  value="video.php?clip=1">Video #1</option>
													<option  value="video.php?clip=2">Video #2</option>
													<option  value="video.php?clip=3">Video #3</option>
													<option  value="video.php?clip=4">Video #4</option>
													<option  value="video.php?clip=5">Video #5</option>
													<option  value="video.php?clip=6">Video #6</option>
													<option  value="video.php?clip=7">Video #7</option>
													<option  value="video.php?clip=8">Video #8</option>
													<option  value="video.php?clip=9">Video #9</option>
													<option  value="video.php?clip=10">Video #10</option>		
													<option value="">_____________________	</option>
													<option value="video.php?clip=retracted">Retracted Tongue</option>
													<option  value="video.php?clip=11">Video #1</option>
													<option  value="video.php?clip=12">Video #2</option>
													<option  value="video.php?clip=13">Video #3</option>
													<option  value="video.php?clip=14">Video #4</option>
													<option  value="video.php?clip=15">Video #5</option>
													<option  value="video.php?clip=16">Video #6</option>
													<option  value="video.php?clip=17">Video #7</option>
													<option  value="video.php?clip=18">Video #8</option>
													<option  value="video.php?clip=19">Video #9</option>
													<option  value="video.php?clip=20">Video #10</option>
													<option value="">_____________________	</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
								<td valign="top">
									<table cellspacing="3" cellpadding="3">
										<tr>
											<td align="center">
											<select name="select62" size="1" onchange="MM_jumpMenu('top',this,1)">						
											<option value="#" selected>emails &amp; videos</option>												
											<option value="email_list.php">List Emails</option>								
											<option value="email_list.php">Edit / Delete Emails</option>						
											<option value="">_____________________	</option>	
											</select>
											</td>
										</tr>
									</table>
								</td>
								<td align="center" valign="top">
									<table cellspacing="3" cellpadding="3">
										<tr>
											<td align="center">
											<select name="select162" size="1" onchange="MM_jumpMenu('top',this,1)">						
											<option value="#" selected>users</option>												
											<option value="user_list.php">List Users</option>								
											<option value="user_list.php">Edit User's Access</option>						
											<option value="">_____________________	</option>	
											</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
	</td>
	</tr>
</table>	



<?php require_once('footer.php'); ?>		