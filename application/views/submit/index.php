<?php
	require_once("application/views/snippets/layout/header.php");
?>
<div class="content">
	
		<div class="title_article">
			<h1>Add a Geek/Gamer pic</h1>
		</div>

		<div class="article_wrapp_view">
			<div class="article_view no-center submit">
				<?php 
					if(isset($errorMsg)){
				?>
			<div class="error_message">
					<?php echo $errorMsg; ?>
				</div>
				<?php 
				}
				?>
				
				<form  method="post" action ="<?php echo PATH; ?>submit/" enctype="multipart/form-data" >
				
					<div class="type_of_article">
						<div id="picture"></div>  <div id="video"></div>
						<div class="clear"></div>
						<div class="radio_divs">
							<input type="radio" id="radio_picture" name="type_of_upload" value="picture" checked />
							<input type="radio" id="radio_video" name="type_of_upload" value="video" />
						</div>
					</div>
			
				
					<div class="input-group">
						<label for="title">Title: </label>
						<input type="text" name="title" id="title" />
						<span>Be original</span>
					</div>
					
					<div class="input-group" id="url_file">
						<label for="url">URL of Picture:</label>
						<input type="url" name="url" id="url"  />
						<span><div id="upload_file_link">Upload</div> you picture</span>
					</div>
					
					<div class="input-group" id="upload_file">
						<label for="upload">Upload the Image:</label>
						<input type="file" name="upload" id="upload" /><br />
						<span  id="spanUpload"><div id="url_file_link">Use URL</div> to Upload your picture</span>
					</div>
					
					<div class="input-group" id="urlVideoWrapp">
						<label for="urlVideo">URL of Video:</label>
						<input type="url" name="urlVideo" id="urlVideo" />
						<span>*Please only provide Youtube links</span>
					</div>
					
					<div class="input-group">
						<label for="sourceUrl">URL of the Source:</label>
						<input type="url" name="sourceUrl" id="sourceUrl"/>
						<span>Respect the work of others</span>
					</div>
					
					<div class="description-group">
						<label for="description">Description of image:</label>
						<textarea id="description" name="description"></textarea>
					</div>
					
					<div class="nsfw_wrapp">
						<input type="checkbox" name="NSFW" id="NSFW"/>
						<label for="NSFW">NSFW (Not Safe For Work)</label>
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

