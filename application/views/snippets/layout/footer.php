	<div class="sidebar">
	
		<?php
		if($current == "view"){
		?>
		<div class="browse_more_wrapped">
			
			<?php
			if($next_row['id_article'] != ""){
			?>
				<a href="<?php echo PATH ."id/". $next_row['id_article']; ?>/"  id="go_prev" >&#8668; Prev</a>
			<?php
			}else{
			?>
			<span id="go_prev">Prev &#8668;</span>
			<?php
			}
			?>
			
			<?php
			if($previous_row['id_article'] != ""){
			?>
				<a href="<?php echo PATH ."id/" . $previous_row['id_article']; ?>/" id="go_next" >Next &#8669; </a>
			<?php
			}else{
			?>
			<span id="go_next" >Next &#8669;</span>
			<?php
			}
			?>
			<div class="clear"></div>
		</div>
		<?php
		}
		?>
	
		<div class="ad">
			<?php
				require("application/views/snippets/ads/250x250.php");
			?>
		</div>
		
		<div class="follow_us">
			<h3>Geekmers is Social</h3>
			<div class="fb-like-box" data-href="https://www.facebook.com/Geekmers" data-width="286" data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
			
			<div class="clear"></div>
			
			<a href="https://twitter.com/geekmers1" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @geekmers1</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

			<div class="clear"></div>
		</div>
		
		<div class="stickySidebar">
			<div class="ad ad_scroll">
				<?php
					require("application/views/snippets/ads/250x250.php");
				?>
			</div>
			<div class="footer">
					

				<strong>Geekmers &copy; <?php echo date("Y");?> </strong><br />
			
				<a href="<?php echo PATH; ?>about/">About</a> · <a href="<?php echo PATH; ?>advertise/">Advertise</a> · <a href="<?php echo PATH; ?>faq/">FAQ</a> · <a href="<?php echo PATH; ?>terms/">Terms</a> · <a href="<?php echo PATH; ?>privacy/">Privacy</a> · <a href="<?php echo PATH; ?>contact/">Contact</a>
			</div>
		</div>

	</div>

</div>


</body>
</html> 