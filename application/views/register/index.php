<?php
	require_once("application/views/snippets/layout/header.php");
?>
<div class="content">
	
		<div class="title_article">
			<h1>Register on Geekmers</h1>
		</div>

		

		<div class="article_wrapp_view">
			<div class="article_view no-center submit">
			
				<?php
				if(isset($msg)){
				?>

					<div class="error_message">
						<?php echo $msg; ?>
					</div>
				<?php
				}
				?>
				
				<form  method="post" action ="<?php echo PATH; ?>register/" enctype="multipart/form-data" >
				
					<div class="input-group">
						<label for="fname">First Name: </label>
						<input type="text" name="fname" id="fname" value="<?php echo $_POST['fname']; ?>" />
					</div>
					
					<div class="input-group">
						<label for="lname">Last Name: </label>
						<input type="text" name="lname" id="lname" value="<?php echo $_POST['lname']; ?>" />
					</div>
					
					<div class="input-group">
						<label for="nick">Nick Name: </label>
						<input type="text" name="nick" id="nick" value="<?php echo $_POST['nick']; ?>"/> <div class="message_register" id="nick_msg"></div>
					</div>
					
					<div class="input-group">
						<label for="email">Email: </label>
						<input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" />
					</div>
					
					<div class="input-group">
						<label for="confirm_email">Confirm Email: </label>
						<input type="email" name="confirm_email" id="confirm_email" value="<?php echo $_POST['confirm_email']; ?>" />
					</div>
					
					<div class="input-group">
						<label for="password">Password: </label>
						<input type="password" name="password" id="password" />
					</div>
					
					<div class="input-group-inline">
						<div class="label"><label for="male">Gender: </label></div>
					
						<label for="male">Male: </label>
						<input type="radio" name="gender" id="male" value="male" class="radio" />
						
						<label for="female">Female: </label>
						<input type="radio" name="gender" id="female" value="female" class="radio" />
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
									echo "<option value='{$i}'>{$i}</option>";
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
									echo "<option value='{$i}'>{$i}</option>";
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
									echo "<option value='{$i}'>{$i}</option>";
								}
							?>
						</select>
					</div>
					
					<div class="recaptcha_wrapped">
						<script type="text/javascript">
						 var RecaptchaOptions = {
						    theme : 'clean'
						 };
						 </script>
						<?php
				          require_once('levelUp_Framework/includes/recaptcha/recaptchalib.php');
				          $publickey = "6Ldh4_sSAAAAAGv4A0Te26EMd6UX2lMMgZmm8nAs"; // you got this from the signup page
				          echo recaptcha_get_html($publickey);
				        ?>
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

