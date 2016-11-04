<!DOCTYPE HTML>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->header->get_title(); ?></title>
	
    <meta content="<?php echo $this->header->get_meta_description(); ?>" name="Description" />
    <meta content="<?php echo $this->header->get_tags(); ?>" name="Keywords" />
    <?php echo $this->header->get_index_robots();?>
	
	<!-- META WEB TOOLS -->
	<meta name="msvalidate.01" content="9856B242387AE79B5CE5DFB5368B4A2A" /><!-- bing -->

	
	<link rel="shortcut icon" href="<?php echo PATH; ?>images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo PATH; ?>images/favicon.ico" type="image/x-icon">
	<link href="<?php echo PATH; ?>style/style.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo PATH; ?>js/jquery.js"></script>
	<script src="<?php echo PATH; ?>js/script.js"></script>
	

	
	<script type="text/javascript">
		$(document).ready(function() {
			load();
		});
	</script>
	
	
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113934698671823";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	</script>
	
	
	<!--GOOGLE ANALYTICS-->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-41446009-1', 'geekmers.com');
		ga('send', 'pageview');
	</script>
	<!--GOOGLE ANALYTICS-->
	
</head>

<body>
<div id="fb-root"></div>
<div class ="header_wrapper">
	<div class ="header">
		<div id="logo">
			<a href="<?php echo PATH; ?>" >
				<img alt="logo" src="<?php echo PATH; ?>images/logo.png" id="logo_image">
			</a>
		</div>
		<div class="header_right">
			<?php
			//Check if is login to show Navigation menu
			if($this->session->is_loged_in()){
			?>
			<!-- -->
			<div class="header_submit">
				 <a href="<?php echo PATH; ?>submit/"><img class="submit_header_button" src="<?php echo PATH; ?>images/upload.png" alt="Upload" /></a>
				 
			</div>
			
			<div class="header_name">
				 <a href="<?php echo PATH; ?>geekmer/<?php echo $this->session->user(); ?>/"><?php echo $this->session->user_nick(); ?></a>
				 
			</div>
			
			<div class="header_menu">
				<ul>
					<li><img src="<?php echo PATH; ?>images/menu.png" />
						<ul>
							<li>
								<a href="<?php echo PATH; ?>settings/" >Settings</a>
							</li>
							<li>
								<form method="post" >
									<button name="submitted_login" type="submit">Log Out</button>
								</form>
							</li>
							
						</ul>
					</li>
				</ul>
			</div>
			 
			 
			<?php
			}
			else{
			?>
				<!-- Else id not Log in -->
				<form name ="header_form" id="header_form" method="post" action ="<?php echo $this->currentPage; ?>">
					<label for="header_email">Email: </label>
					<input type="email" id="header_email" name="header_email" placeholder="email@example.com" class="input_login"/>
					
					<label for="header_password">Password: </label>
					<input type="password" id="header_password" name="header_password" placeholder="Password"  class="input_login"/>
					
					<input type="submit" id="submitted" name="header_submit" class="button_header" value="GO"/>
					
					
					<a href="<?php echo PATH;?>register/" class="signup">Sign Up</a>
				
				</form>
				
				
				
			<?php
			}
			?>
		</div>
	</div>
</div>

<div class="container">