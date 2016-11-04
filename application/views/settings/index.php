<?php
	require_once("application/views/snippets/layout/header.php");
?>
<div class="content">
	
		<div class="title_article">
			<h1>Settings</h1>
		</div>

		<div class="article_wrapp_view">
		
			<?php
				if(isset($errorMsg)){
			?>

			<div class="error_message">
				<?php echo $errorMsg; ?>
			</div>
			
			<?php
			}
			?>
		
			<h2 class="settings_nick"><?php echo $row['user_nick']; ?></h2>
			<div class="article_view no-center submit">
				
				<form  method="post" action ="<?php echo PATH; ?>settings/" enctype="multipart/form-data" >
				
					<div class="input-group">
						<label for="fname">First Name: </label>
						<input type="text" name="fname" id="fname" value="<?php echo $row['user_fname']; ?>" />
					</div>
					
					<div class="input-group">
						<label for="lname">Last Name: </label>
						<input type="text" name="lname" id="lname" value="<?php echo $row['user_lname']; ?>" />
					</div>

					
					<div class="input-group">
						<label for="email">Email: </label>
						<input type="email" name="email" id="email" value="<?php echo $row['user_email']; ?>"/>
					</div>
					
					<div class="input-group-inline">
						<div class="label"><label for="male">Gender: </label></div>
					
						<label for="male">Male: </label>
						<input type="radio" name="gender" id="male" value="male" class="radio" <?php echo $maleSelected; ?> />
						
						<label for="female">Female: </label>
						<input type="radio" name="gender" id="female" value="female" class="radio" <?php echo $femaleSelected; ?> />
					</div>
					
					<div class="input-group">
						<label for="title">Date of Birth: </label>
						<select name="month">
							<option value="">Month</option>
							<?php
								for($i = 1; $i <= 12; $i++){
									if($i < 10){
										$i = "0". $i;
									}
									
									if($i == $monthUser){
										$selected = 'selected="selected"';
									}
									echo "<option {$selected} value='{$i}'>{$i}</option>";
									$selected = "";
								}
							?>
						</select>
						
						<select name="day">
							<option value="">Day</option>
							<?php
								for($i = 1; $i <= 31; $i++){
									if($i < 10){
										$i = "0". $i;
									}
									
									if($i == $dayUser){
										$selected = 'selected="selected"';
									}
									echo "<option {$selected} value='{$i}'>{$i}</option>";
									$selected = "";
								}
							?>
						</select>
						
						<select name="year">
							<option value="">Year</option>
							<?php
								$end = date("Y") - 106;
								$start = date("Y") - 12;
								for($i = $start; $i >= $end; $i--){
									if($i < 10){
										$i = "0". $i;
									}
									
									if($i == $yearUser){
										$selected = 'selected="selected"';
									}
									echo "<option {$selected} value='{$i}'>{$i}</option>";
									$selected = "";
								}
							?>
						</select>
					</div>
					
					
					
					
					<div class="input-group-inline">
						<div class="label"><label for="yes">NSFW: </label></div>
					
						<label for="yes">YES: </label>
						<input type="radio" name="nsfw" id="yes" value="YES" class="radio" <?php echo $nsfwYes; ?> />
						
						<label for="no">NO: </label>
						<input type="radio" name="nsfw" id="no" value="NO" class="radio" <?php echo $nsfwNo; ?> />
					</div>
					
					
					
					<a class="btn_change_pass">Change Password</a><br />
					<div class="clear"></div>
					
					<div class="settings_password">
						
						<div class="input-group">
							<label for="old_password">Current Password: </label>
							<input type="password" name="old_password" id="old_password" value="" />
						</div>
						
						<div class="input-group">
							<label for="new_password">New Password: </label>
							<input type="password" name="new_password" id="new_password" value="" />
						</div>
						
						<div class="input-group">
							<label for="confirm_password">Confirm Password: </label>
							<input type="password" name="confirm_password" id="confirm_password" value="" />
						</div>
						
					</div>
					
					
					<input type="submit" name="submitted" id="submitted" class="button" value="Submit"/>

				</form>
				
			</div>
			
			

			<div class="clear"></div>

		</div>
		
	</div><!-- content ENDS -->

<?php
	require_once("application/views/snippets/layout/footer.php");
?>

