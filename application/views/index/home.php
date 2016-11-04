<?php
	require_once("application/views/snippets/layout/header.php");
?>
	<div class="content">
		<?php
			while( $row = $article_query->fetch() ){
				
				$article_id = $row['id_article'];
				$user_id = $this->session->user();
				if( isset($user_id) ){
					if($vote->check_if_up($this->session->user(), $row['id_article'])){
						$selected_up_button = "button_voted_up";
						$selected_up = "voted_up";
					}else{
						$selected_up_button = "";
						$selected_up = "";
					}
					
					
					if($vote->check_if_down($this->session->user(), $row['id_article'])){
						$selected_down_button = "button_voted_down";
						$selected_down = "voted_down";
					}else{
						$selected_down_button = "";
						$selected_down = "";
					}
				}
			
		?>
		<div class="title_article" id ="<?php echo $article_id ; ?>" >
			<h1><a href="<?php echo PATH; ?>id/<?php echo $row['id_article']; ?>/"><?php echo  stripslashes($row['title_article']); ?></a></h1>
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
				<?php
				/*
				<div class="<?php echo $article_button; ?>
					<?php echo $selected_up_button; ?> up"><img src="<?php echo PATH; ?>images/1upView.png" />
				</div>
				<div class="<?php echo $article_button; ?> <?php echo $selected_down_button; ?> down">
					<img src="<?php echo PATH; ?>images/1downView.png" />
				</div>
				*/
				?>
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
			
			</div>
			
			<?php
			/*
			<div class="article_side_wrapp">
				<h1><a href="<?php echo PATH; ?>id/<?php echo $row['id_article']; ?>/"><?php echo  stripslashes($row['title_article']); ?></a></h1>
				
				<div class="article_side_info">
					<div class="article_side_comments">
						<img src ="<?php echo PATH; ?>images/comments_icons.png" /> <fb:comments-count href=http://geekmers.com/id/<?php echo $row['id_article']; ?>/></fb:comments-count>
					</div>
					<div class="article_side_votes">
						<img src ="<?php echo PATH; ?>images/votes_icons.png" /> <span class="vote <?php echo $selected_up; ?> <?php echo $selected_down; ?>"><?php echo number_format($vote->select_total_by_id($row['id_article'])); ?></span>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="article_side">
					<div class="<?php echo $article_button; ?> up">
						<a <?php echo $selected_up_button; ?> style="border-top-left-radius: 10px;" /><img src="<?php echo PATH ;?>images/1up.png" alt="1 Up" /></a>
					</div>
					<div class="<?php echo $article_button; ?> down">
						<a <?php echo $selected_down_button; ?> style="border-top-right-radius: 10px;" /><img src="<?php echo PATH ;?>images/1down.png" alt="1 Down" /></a>
					</div>
					
					<div class="clear"></div>
					<div class="article_bottom">
						
						<div class="clear"></div>
					</div>
				</div>
			</div>
			
			*/
			?>
			<div class="clear"></div>
		</div>
		<?php
		}// end of while loop (this loops all articles)
		?>
		
		<!--
		<div id="more_fun">
			I want more fun!
		</div>
		-->
		
		<?php 
			if($pagination->has_previous_page()){
		
		?>
		<a href="<?php echo PATH ."page/" . $pagination->previous_page(); ?>/" class="more_fun_button" style="float:left;" >Previous fun!</a>
		<?php
		}
		?>
		
		<?php 
			if($pagination->has_next_page()){
		
		?>
		<!-- <a href="<?php echo PATH ."page/" . $pagination->next_page(); ?>/"  id="more_fun" >I want more fun!</a> -->
		<a href="<?php echo PATH ."page/" . $pagination->next_page(); ?>/" id="more_fun_button" class="more_fun_button" data-page="1"  style="float:right;"  >More fun!</a>
		<?php
		}
		?>
		
		
	</div><!-- content ENDs -->

<?php
	require_once("application/views/snippets/layout/footer.php");
?>

