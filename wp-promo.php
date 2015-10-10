<?php
/*
Plugin Name: WordPress Promotions
Plugin URI: http://saowapan.com/wordpress-promotions
Description: Instantly turn your website into a promotions website!
Author: Matt Gould, My Kongpia
Version: 1.1
Author URI: http://saowapan.com/about
*/

//promotion shortcode
require 'shortcodes/promotion-profile.php';
//submit shortcode
require 'shortcodes/submit-promotion.php';
//edit shortcode
require 'shortcodes/edit-promotion.php';
//view shortcode
require 'shortcodes/view-promotion.php';
//shortcode related functions
require 'functions/shortcode-functions.php';
//functions
require 'functions/functions.php';
//enqueue scripts/styles
require 'functions/enqueue.php';
//custom post types
require 'functions/post-types.php';
//general functions
require 'functions/util.php';
//template loader similar to get_template_part();
require 'functions/template-loader.php';
if(is_admin()) {
	require 'admin/index.php';
}
function wpp_admin_page() {
	require 'admin/templates/index.php';
}

//shortcodes
define('wpp_submit', '[submit_promotion]');
define('wpp_view', '[view_promotion]');
define('wpp_edit', '[edit_promotion]');
define('wpp_profile', '[promotion_profile]');

//versions and names
define('WPP_VERSION', '0.1');

//post type name
define('promo', get_option('wpp_post_type'));

//add new role (promoter)
function wpp_add_roles() {
	add_role(	'promoter', 
				'Promoter', 
				 array( 
				 	'read' => true, 
				 	) );
}

//add role and caps (no caps yet) on plugin activation
function wp_promo_plugin_activation() {
	wpp_add_roles();
}
register_activation_hook( __FILE__, 'wp_promo_plugin_activation' );

//add admin menu page
add_action( 'admin_menu', 'wpp_admin_menu' );

function wpp_admin_menu() {

	add_menu_page( 'WP Promotions', 'WP Promotions', 'activate_plugins', 'wp-promotions', 'wpp_admin_page', 'dashicons-dashboard', 75);

}

?>