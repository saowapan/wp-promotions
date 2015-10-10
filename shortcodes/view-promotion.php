<?php /* View Posts */ 
function wpp_view_promotion() {
	if(wpp_is_promoter()) {
		wpp_get_template_part('view-promotion');
	} else {
		wpp_get_template_part('signup');
	}
} 

add_shortcode('view_promotion', 'wpp_view_promotion');
?>