<?php
/*
Plugin Name: WordPress Promotions
Plugin URI: http://saowapan.com/wordpress-promotions
Description: Instantly turn your website into a promotions website!
Author: Matt Gould, My Kongpia
Version: 1.0
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


//shortcodes
define('submit', '[submit_promotion]');
define('view', '[view_promotion]');
define('edit', '[edit_promotion]');
define('profile', '[promotion_profile]');

//versions and names
define('VERSION', '0.1');

//post type name
define('promo', 'promotion');

//redirect
$home = 'home';
define('redirect', $home);

//add new role (promoter)
function add_roles() {
	add_role(	'promoter', 
				'Promoter', 
				 array( 
				 	'read' => true, 
				 	) );
}

//add role and caps (no caps yet) on plugin activation
function wp_promo_plugin_activation() {
	add_roles();
}
register_activation_hook( __FILE__, 'wp_promo_plugin_activation' );
?>