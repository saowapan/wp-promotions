<?php /* Edit Posts */

function wpp_edit_promotion() {
	if(wpp_is_promoter()) {
		//make sure GET is set, no post id == no post to edit, also check to see if user is logged in
		if(isset($_GET['post']) && wpp_is_promoter()) {

			//save before we grab data (it could have already been updated!)
			if(isset( $_POST['promotion_nonce_field'] ) && wp_verify_nonce( $_POST['promotion_nonce_field'], 'promotion_nonce' )) {
				$success = wpp_edit_save_promotion($_GET['post'], $_POST['postTitle'], $_POST['postContent'], $_POST['category'], $_POST['attach_id'], $_POST['promoStart'], $_POST['promoEnd'], $_GET['post'], $_POST['promotion_nonce_field']);
			}

		}

		wpp_get_template_part('edit-promotion');
	} else {
		wpp_get_template_part('signup');
	}

}
add_shortcode('edit_promotion', 'wpp_edit_promotion');
?>