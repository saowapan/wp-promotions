<div class="promotions promotions-container">

<?php wpp_get_template_part('parts/menu'); ?>

<?php 
	if(isset($_POST['submitted'])) {
		if (isset($_POST['postTitle']) && isset($_POST['postContent']) && !empty($_POST['postTitle']) && !empty($_POST['postContent']) ) { ?>
		<div class="promotion-success">

			<?php _e('Congratulations your promotion has been successfully added!', 'wpp'); ?>
			<br />
			<?php _e('Please add another promotion!', 'wpp'); ?>
		
		</div>
	<?php } else { ?>
		<div class="promotion-warning">

			<?php _e('Woops your promotion was missing a title or description!', 'wpp'); ?>
			<br />
			<?php _e('Please make sure your promotion has both a title and description!', 'wpp'); ?>
			
		</div>
	<?php } ?>
<?php } ?>
	
	<form enctype="multipart/form-data" id="primaryPostForm" method="POST">

		<fieldset>

			<label for="postTitle"><?php _e('Promotion Title:', 'wpp') ?></label>

			<input type="text" name="postTitle" id="postTitle" placeholder="<?php _e('Title', 'wpp'); ?>" class="required" />

		</fieldset>

		<fieldset>

			<label for="postContent"><?php _e('Promotion Description:', 'wpp') ?></label>

			<textarea name="postContent" id="postContent" placeholder="<?php _e('Your content...', 'wpp'); ?>"rows="8" cols="30"></textarea>

		</fieldset>

		<fieldset>
			<label for="category"><?php _e('Promotion Category:', 'wpp'); ?></label>
			<?php echo wpp_cat_dropdown( 'promotion_category', 'date', 'DESC', '10', 'category' ); ?>
		</fieldset>

		<fieldset>

			<div class="media-uploader">
				<label for="file"><?php _e('Promotion Image:', 'wpp'); ?></label>

				<div id="image-loading"><span id="loading-text"><?php _e('Loading...', 'wpp'); ?></span><span id="media-percentage"></span></div>

				<div id="upload-container">
					<input type="file" name="file" id="file">
					<input type="hidden" name="attach_id" id="attach_id" class="required">
					<div id="mediaUpload"><button class="media-title"><?php _e('Upload Image', 'wpp'); ?></button></div>
				</div>

				<div id="remove-container">
					<img id="media-preview" src="#" alt="Your Image Preview"/>
					<div id="remove-mediaUpload"><button><?php _e('Remove', 'wpp'); ?></button></div>
				</div>
			</div>

		</fieldset>

		<fieldset>

		    <label for="promoStart"><?php _e('Promotion Start Date:', 'wpp') ?></label>
		 
		    <input type="text" name="promoStart" id="promoStart" placeholder="<?php _e('Start Date', 'wpp'); ?>" class="required" />
		 
		</fieldset>
		 
		<fieldset>
		 
		    <label for="promoEnd"><?php _e('Promotion End Date:', 'wpp') ?></label>
		 
		    <input type="text" name="promoEnd" id="promoEnd" placeholder="<?php _e('End Date', 'wpp'); ?>"/>
		 
		</fieldset>

		<fieldset>
			
			<?php wp_nonce_field('promotion_nonce', 'promotion_nonce_field'); ?>

			<input type="hidden" name="submitted" id="submitted" value="true" />
			<button type="submit"><?php _e('Submit', 'wpp') ?></button>

		</fieldset>

	</form>
</div>