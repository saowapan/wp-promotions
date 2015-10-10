<?php 

//AJAX for upload image
add_action('wp_ajax_upload_image', 'wpp_upload_image');
add_action('wp_ajax_nopriv_upload_image', 'wpp_upload_image');

function wpp_upload_image() {
	if(count($_FILES) === 1) {

		$filetype = $_FILES['image']['type'];
		$allowed = '/image\/(?:jpeg|png)/';
		if(preg_match($allowed, $filetype)) {

			if (!function_exists('wp_generate_attachment_metadata')){
			    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
			}

		    foreach ($_FILES as $file => $array) 	{
		        if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
		            return "upload error : " . $_FILES[$file]['error'];
		        }
		        $attach_id = media_handle_upload( $file, 0 );
		    }   

			//check for errors
			if(is_wp_error($attach_id)) {
				echo 'false';
			} else {
				echo $attach_id;
			}

		} else {
			_e('Please only use jpeg or png images!', 'wpp');
		}
	} else {
		_e('Please select only ONE image!', 'wpp');
	}
	wp_die(); //immediately end our ajax response
}

add_action('wp_ajax_remove_image', 'wpp_remove_image');
add_action('wp_ajax_nopriv_remove_image', 'wpp_remove_image');

function wpp_remove_image() {
	$user_id = get_current_user_id();
	$attach_id = $_POST['attach_id'];
	if(empty($user_id) || empty($attach_id)) {
		echo '0';
	} else {
		$attachment_data = get_post($attach_id, ARRAY_A);
		$author_id = $attachment_data['post_author'];
		if($author_id == $user_id) {
			//this attachment belongs to the user delete now
			$success = wp_delete_attachment($attach_id, true);
			if($success) {
				echo '1';
			} else {
				echo '0';
			}
		} else {
			echo '0';
		}
	}
	wp_die(); //immediately end our ajax response
}

function wpp_cat_dropdown( $taxonomy, $orderby = 'date', $order = 'DESC', $limit = '-1', $name, $show_option_all = null, $show_option_none = null,    $show_option_select = null ) {

	global $post;

	$post_id = $post->ID;

	$args = array(
	'orderby' => $orderby,
	'order' => $order,
	'number' => $limit,
	'hide_empty' => 0,
	);

	$terms = get_terms( $taxonomy, $args );
	$name = ( $name ) ? $name : $taxonomy;

	if ( $terms ) {
		printf( '<select name="%s" class="postform">', $name );
		
		if ( $show_option_select ) {
			printf( '<option>%s</option>', $show_option_select );
		}

		if ( $show_option_all ) {
			printf( '<option value="0">%s</option>', $show_option_all );
		}

		if ( $show_option_none ) {
			printf( '<option value="-1">%s</option>', $show_option_none );
		}

		foreach ( $terms as $term ) {
			printf( '<option value="%s">%s</option>', $term->slug, $term->name );
		}

		print( '</select>' );
	}
}


//schedule cron event
/*
* PARAMS
* $data array();
* start, end and post id
*/
function wpp_schedule_promotion_events($data) {
	$args = array( $data['id'] );
	//clear events if set we're updating
	wp_clear_scheduled_hook('promotion_start', $args);
	wp_clear_scheduled_hook('promotion_end', $args);
	//set new event times
	wp_schedule_single_event( $data['start'], 'promotion_start', $args );
	wp_schedule_single_event( $data['end'], 'promotion_end', $args );
}

add_action('promotion_start', 'wpp_cron_promotion_publish', 1, 1);
add_action('promotion_end', 'wpp_cron_promotion_trash',1,1);

//promotion publish
/*
* PARAMS
* $args = array(); 
* $args['id']
*/
function wpp_cron_promotion_publish($args) {

	//$post_data = get_post($args[0]);
	
	$post_information = array(
		'ID' => $args,
		'post_status' => 'publish'
	);
	$post_id = wp_update_post($post_information);
}

//promotion trash
/*
* PARAMS
* $args = array(); 
* $args['id']
*/
function wpp_cron_promotion_trash($args) {

	//$post_data = get_post($args[0]);
	$post_information = array(
		'ID' => $args,
		'post_status' => 'trash'
	);
	$post_id = wp_update_post($post_information);
}