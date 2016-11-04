<?php
	require_once("application/views/snippets/layout/header.php");
?>
	<div class="content">
		<?php
			while($row = mysql_fetch_assoc($article_query)){
			
		?>
		<div class="article_wrapp">
			<div class="article">
				<img src ="<?php echo PATH; ?>images/wall/<?php echo $row['img_wall_article']; ?>"  alt="<?php echo $row['title_article']; ?>"  title="<?php echo $row['title_article']; ?>" />
			</div>
			<div class="article_side_wrapp">
				<h1><a href="<?php echo PATH; ?>id/<?php echo $row['id_article']; ?>/"><?php echo $row['title_article']; ?></a></h1>
				<div class="article_side">
					
					<div class="article_button">
						<a href="#" style="border-top-left-radius: 10px;" />s</a>
					</div>
					<div class="article_button">
						<a href="#" style="border-top-right-radius: 10px;" />s</a>
					</div>
					
					<div class="clear"></div>
					<div class="article_bottom">
						ds
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		}
		?>
		
		
		<div id="more_fun">
			I want more fun!
		</div>
		
	</div><!-- content ENDs -->

<?php
	require_once("application/views/snippets/layout/footer.php");
?>

