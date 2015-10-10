<?php

//utility functions

//check if is promoter or admin
function wpp_is_promoter() {
	$current_user = wp_get_current_user();

	if(empty($current_user->roles[0])) {
		return false;
	}
	
	$role_name = $current_user->roles[0];
	$promoter_role = get_option('wpp_promoter_role');
	if(empty($promoter_role)) {
		$promoter_role = 'Subcriber';
	}
	//check for promoter role, and allow admin
	if( $role_name === 'administrator' || $role_name == $promoter_role ) {
		return true;
	} else {
		return false;
	}
}

//change date to unix
function wpp_date_to_unix($date) {
	$date_slash = str_replace ("/", "-", $date);
	$date_format = strptime($date_slash, '%m-%d-%Y');
	$timestamp = mktime(0, 0, 0, $date_format['tm_mon']+1, $date_format['tm_mday'], $date_format['tm_year']+1900);
	return $timestamp;
}

//strip file extension
function file_ext_strip($filename){
    return preg_replace('/.[^.]*$/', '', $filename);
}

//get page id of shortcode
function wpp_get_id_by_shortcode($shortcode) {
	global $wpdb;

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%' . $shortcode . '%"';
	$id = $wpdb->get_var($sql);

	return $id;
}

//get pade id of wpp shortcodes for menu
function wpp_get_page_id() {
	$ids = array();
	
	$ids['submit'] = wpp_get_id_by_shortcode(wpp_submit);
	$ids['view'] = wpp_get_id_by_shortcode(wpp_view);
	$ids['overview'] = wpp_get_id_by_shortcode(wpp_profile);

	return $ids;
}

//create links for menu
//maybe relocate this later
function wpp_create_links() {
	$ids = wpp_get_page_id();
	foreach($ids as $name => $id) {
 		echo '<li><a href="' . get_permalink($id) . '">' . get_the_title($id) . '</a></li>';
 	}
}

function wpp_menu() {
	wpp_get_template_part('main-menu');
}