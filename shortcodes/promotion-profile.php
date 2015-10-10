<?php //profile overview for promotion page

function wpp_promotion_profile() { 
	if(wpp_is_promoter()) {
		wpp_get_template_part('promotion-profile');
	} else {
		wpp_get_template_part('signup');
	}
} 
add_shortcode('promotion_profile', 'wpp_promotion_profile');
?>