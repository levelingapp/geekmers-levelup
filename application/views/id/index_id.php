<?php require_once("application/views/snippets/layout/header.php"); ?>

	
	
	
	<div class="content">

		<div class="title_article" id ="<?php echo $article_id ; ?>" >
			<h1><?php echo  stripslashes($row['title_article']); ?></h1>
		</div>
		<div class="article_wrapp" id="<?php echo $row['id_article']; ?>">

			<div class="article">
			<?php
			if($row['nsfw_article']  == "NO" || $nsfw_user == "NO" ){
				//show content
				if($row['is_video_article']  == "NO"){
			?>
				<img src ="<?php echo PATH; ?>images/wall/<?php echo $row['img_wall_article']; ?>"  alt="<?php echo stripslashes($row['title_article']); ?>"  title="<?php echo stripslashes($row['title_article']); ?>" />
			<?php
				}else{
			?>
				<iframe width="620" height="350" src="<?php echo  str_replace("watch?v=","embed/", $row['url_video_article']); ?>" frameborder="0" allowfullscreen></iframe>
			<?php
				}
			?>
				
				
			
				
			<?php
			}else{
				//show image for NSFW
			?>
				<img src ="<?php echo PATH; ?>images/wall/nsfw_wall.jpg" />
			<?php
			}	
			?>
			
			
				<div class="article_info_bottom">
					
					<div class="bottom_votes">
						
						<div data-article_id="<?php echo $article_id; ?>" class="<?php echo $article_button; ?> <?php echo $selected_up_button; ?> up"><img src="<?php echo PATH; ?>images/1upView.png" /></div>
						<div data-article_id="<?php echo $article_id; ?>" class="<?php echo $article_button; ?> <?php echo $selected_down_button; ?> down"><img src="<?php echo PATH; ?>images/1downView.png" /></div>

					</div>
					
					<div class="bottom_info">
						<?php
						if($row['url_source_article'] != ""){
						?>
							<a href="<?php echo $row['url_source_article']; ?>" target="_blank" rel="nofollow" >#SOURCE</a>
						<?php
						}
						?>
						Posted by <a href="<?php echo PATH; ?>geekmer/<?php echo $row['user_id']; ?>/"><?php echo $row['user_nick']; ?></a> on <?php echo date("m/d/Y", strtotime($row['posted_on_article'])); ?>
						
						<div class="clear"></div>
						<div class="bottom_votes_comments">
							<img src="<?php echo PATH; ?>images/votes_icons.png" /> <span class="view_votes" id="view_votes_<?php echo $article_id; ?>" ><?php echo number_format($vote->select_total_by_id($article_id)); ?></span>
							<img src="<?php echo PATH; ?>images/comments_icons.png" /> <fb:comments-count href=http://geekmers.com/id/<?php echo $article_id; ?>/>0</fb:comments-count>
						</div>
					</div>

					<div class="clear"></div>
				</div>

				<div class="clear"></div>
				<div class="article_description">
					<?php
						$desc =  explode("\n\r", $row['description_article']);
						$description = "";
						for($i = 0; $i < count($desc); $i++ ){
							//if is empty don't add the paragraphs
							if ( $desc[$i] == "" ){
								continue;
							}
							$description .= "<p>" . $desc[$i] . "</p>";
						}
						echo $description; 
					?>
				</div>
				
				
				<div class="comments">
					Comments
					<div class="clear"></div>
				</div>
				<!-- Comments -->
				<div class="fb-comments" data-href="http://geekmers.com/id/<?php echo $article_id; ?>/" data-width="620" data-num-posts="30"></div>
				
			</div>

			<div class="clear"></div>
		</div>

	</div>
	
	

<?php 
	$current = "view";
	require_once("application/views/snippets/layout/footer.php"); 
?>