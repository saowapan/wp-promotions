<div class="promotions promotions-container edit-promotion">

<?php wpp_get_template_part('parts/menu'); ?>
<?php if(isset($_GET['post'])) {
	$promotion_id = $_GET['post'];
} else {
	$promotion_id = 0;
}

$promotionData = wpp_get_edit_promotion($promotion_id); //This probably shouldn't be here, lets use actions later

if(!empty($promotionData)) { 

	if(isset($_POST['submitted'])) {
		if (isset($_POST['postTitle']) && isset($_POST['postContent']) && !empty($_POST['postTitle']) && !empty($_POST['postContent']) ) { ?>
		<div class="promotion-success">

			<?php _e('Congratulations your promotion has been successfully updated!', 'wpp'); ?>
		
		</div>
	<?php } else { ?>
		<div class="promotion-warning">

			<?php _e('Woops your promotion was missing a title or description!', 'wpp'); ?>
			<br />
			<?php _e('Please make sure your promotion has both a title and description!', 'wpp'); ?>
			
		</div>
	<?php } ?>
<?php } ?>
	<form id="primaryPostForm" method="POST" action="?post=<?php echo $promotionData['id']; ?>">
		<fieldset>

			<label for="postTitle"><?php _e('Promotion Title:', 'wpp') ?></label>
			<input type="text" name="postTitle" id="postTitle" value="<?php echo $promotionData['title']; ?>" class="required" />

		</fieldset>

		<fieldset>

			<label for="postContent"><?php _e('Promotion Description:', 'wpp'); ?></label>
			<textarea name="postContent" id="postContent" rows="8" cols="30" class="required"><?php echo $promotionData['content']; ?></textarea>
		
		</fieldset>

		<fieldset>
			<label for="category"><?php _e('Promotion Category:', 'wpp'); ?></label>
			<?php echo wpp_cat_dropdown( 'promotion_category', 'date', 'DESC', '10', 'category' ); ?>
		</fieldset>

		<fieldset>

				<div id="current-image">
					<img id="mediaCurrent" src="<?php echo $promotionData['image'][0]; ?>" alt="<?php echo $promotionData['title']; ?>" alt="Your Image Preview"/>
					<div><?php _e('Current Image:', 'wpp'); ?></div>
				</div>

				<div id="upload-container">
					<label for="file"><?php _e('Promotion Image:', 'wpp'); ?></label>
					<input type="file" name="file" id="file">
					<input type="hidden" value="<?php echo $promotionData['image_id']; ?>" name="attach_id" id="attach_id" class="required">
					<div id="mediaUpload"><span class="media-title"<?php _e('Upload New Image', 'wpp'); ?></span></div>
				</div>

				<div id="media-percentage"></div>

				<div id="remove-container">
					<img id="media-preview" src="<?php echo $promotionData['image'][0]; ?>" alt="<?php echo $promotionData['title']; ?>" alt="Your Image Preview"/>
					<div id="remove-mediaUpload"><?php _e('Remove', 'wpp'); ?></div>
				</div>

		</fieldset>

		<fieldset>

		    <label for="promoStart"><?php _e('Promotion Start Date:', 'wpp') ?></label>
		 
		    <input type="text" name="promoStart" id="promoStart" value="<?php if(isset($_POST['promoStart'])) echo $_POST['promoStart'];?>" class="required" />
		 
		</fieldset>
		 
		<fieldset>
		 
		    <label for="promoEnd"><?php _e('Promotion End Date:', 'wpp') ?></label>
		 
		    <input type="text" name="promoEnd" id="promoEnd" value="<?php if(isset($_POST['promoEnd'])) echo $_POST['promoEnd'];?>" class="required" />
		 
		</fieldset>

		<fieldset>
			
			<?php wp_nonce_field('promotion_nonce', 'promotion_nonce_field'); ?>

			<input type="hidden" name="submitted" id="submitted" value="true" />
			<button type="submit"><?php _e('Update promotion', 'wpp') ?></button>

		</fieldset>

	</form>

<?php } elseif (empty($_GET['post'])) { ?>

	<div class="promotion-warning"><?php _e('Opps There\'s no promotion id! Please make sure you\'re editting a promotion!', 'wpp'); ?></div>

<?php } else { ?>

	<div class="promotion-warning"><?php _e('Something went wrong!', 'wpp'); ?></div>

<?php } ?>
</div>