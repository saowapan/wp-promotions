<?php

//enqueue styles and scripts
function wpp_enqueue_scripts() {
	//styles
	wp_register_style('wpp-style', plugins_url( '/assets/css/style.css', dirname(__FILE__)), '', WPP_VERSION);
	wp_enqueue_style('wpp-style');
	wp_register_style('jquery-ui', plugins_url( '/assets/css/jquery-ui.css', dirname(__FILE__)), '', WPP_VERSION);
	wp_enqueue_style( 'jquery-ui' );

	//media upload scripts
    wp_register_script( 'wpp-media-upload', plugins_url( '/assets/js/media.js', dirname(__FILE__) ) , array('jquery', 'jquery-ui-datepicker'), WPP_VERSION, true);
    wp_enqueue_script('wpp-media-upload');
    
    //localize
	wp_localize_script( 'wpp-media-upload', 'mediaupload', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
	// wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
	// 	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	// 	'query_vars' => json_encode( $wp_query->query )
	// ));
}
add_action('wp_enqueue_scripts', 'wpp_enqueue_scripts');