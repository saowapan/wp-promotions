<?php
//submit promotion shortcode
function wpp_submit_promotion() { 
	if(wpp_is_promoter()) {

		//shortcode functions
		if(isset( $_POST['promotion_nonce_field'] ) && wp_verify_nonce( $_POST['promotion_nonce_field'], 'promotion_nonce' )) {
			$success = wpp_submit_save_promotion($_POST['postTitle'], $_POST['postContent'], $_POST['category'], $_POST['attach_id'], $_POST['promoStart'], $_POST['promoEnd'], $_POST['promotion_nonce_field']);
		}

		wpp_get_template_part('submit-promotion');
	} else {
		wpp_get_template_part('signup');
	}

}
add_shortcode('submit_promotion', 'wpp_submit_promotion');
?>