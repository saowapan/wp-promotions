<?php

//functions for shortcode templates

//[submit_promotion] save post function
/* PARAMS 
* $title = post title
* $content = post content
* $category = post category
* $attach_id = post attachment id
* $promoStart = post start time
* $promoEnd = post end time
* $nonce = post_nonce_field
*/
function wpp_submit_save_promotion( $title, $content, $category, $attach_id, $promoStart, $promoEnd, $nonce) {
	$status = '';
	$data = array();

	$current = get_current_user_id();

 	if (empty($current)){
 		die;
 	}

	//sanitize data
	$title = sanitize_text_field($title);
	$content = sanitize_text_field($content);
	$category = sanitize_text_field($category);
	$attachid = sanitize_text_field($attach_id);
	$promoStart = sanitize_text_field($promoStart);
	$promoEnd = sanitize_text_field($promoEnd);

	//no title or content? Don't save!
 	if(empty($title) || empty($content)) {
 		return;
 	}

 	//TODO add support for multiple cats?
	$category = get_term_by('name', $category, 'promotion_category');
	$category_id = $category->term_id;

    $post_information = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_type' => 'promotion',
        'post_status' => 'pending',
        'post_author' => $current,

        'ping_status' => 'closed',
    );

	$post_id = wp_insert_post($post_information);

	//set object terms
	wp_set_object_terms($post_id, $category_id, 'promotion_category', true);

	// Update Custom Meta
	update_post_meta($post_id, 'wpp_promo_start', $promoStart);
	update_post_meta($post_id, 'wpp_promo_end', $promoEnd);

	if (!is_wp_error($attach_id)){
	    set_post_thumbnail( $post_id, $attach_id );
    }

    $data['id'] = $post_id;
    $data['start'] = wpp_date_to_unix($promoStart);
    $data['end'] = wpp_date_to_unix($promoEnd);

    wpp_schedule_promotion_events($data);

    return $post_id;
}

//[edit_promotion] save post function
/* PARAMS 
* $id = post ID
* $title = post title
* $content = post content
* $category = post category
* $attach_id = post attachment id
* $promoStart = post start time TODO
* $promoEnd = post end time TODO
* $nonce = post_nonce_field
*/
function wpp_edit_save_promotion($id, $title, $content, $category, $attach_id, $promoStart, $promoEnd, $nonce) {
	//sanitize data
	$id = sanitize_text_field($id);
	$title = sanitize_text_field($title);
	$content = sanitize_text_field($content);
	$category = sanitize_text_field($category);
	$attachid = sanitize_text_field($attach_id);
	$promoStart = sanitize_text_field($promoStart);
	$promoEnd = sanitize_text_field($promoEnd);
	//make sure this post belongs to the user
	$user_id = get_current_user_id();
	$query = new WP_Query(array('post_type' => promo, 'p' => $id, 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'trash'), 'author' => $user_id ) );
	if($query->found_posts === 0) {
		wp_die();
	}
	wp_reset_query();

	$data = array();

	$post_information = array(
		'ID' => $id,
		'post_title' => $title,
		'post_content' => $content,
		'post-type' => 'promotion',
		'post_status' => 'pending'
	);

	$post_id = wp_update_post($post_information);

	//set object terms
	wp_set_object_terms($post_id, $category, 'promotion_category', true);
	
	update_post_meta($post_id, 'wpp_promo_start', $promoStart);
	update_post_meta($post_id, 'wpp_promo_end', $promoEnd);
 	update_post_meta($post_id, 'wpp_promo_logged', 'not_logged');
	if ( !is_wp_error($attach_id)){
	    //and if you want to set that image as Post  then use
	    set_post_thumbnail( $post_id, $attach_id );
    }

    $data['id'] = $post_id;
    $data['start'] = wpp_date_to_unix($promoStart);
    $data['end'] = wpp_date_to_unix($promoEnd);

    wpp_schedule_promotion_events($data);
}

//match $_GET['post'] with an author post_id
/*
*PARAMS
*$current_post = post id via $_GET['post']
*/
function wpp_get_edit_promotion($current_post) {
	$promotionData = array();
	$user_id = get_current_user_id();
	//TODO CUSTOM SQL QUERY?
	$query = new WP_Query(array('post_type' => promo, 'p' => $current_post, 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'trash'), 'author' => $user_id ) );
 	
 	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		if($current_post == get_the_ID()) {	

			$promotionData['id'] = get_the_ID();
			$promotionData['title'] = strip_tags(get_the_title());
			$promotionData['content'] = strip_tags(get_the_content());
			$promotionData['image_id'] = get_post_thumbnail_id();
			$promotionData['image'] = wp_get_attachment_image_src($promotionData['image_id'],'thumbnail', true);
			$promotionData['start'] = get_post_meta(get_the_ID(), 'wpp_promo_start', true);
			$promotionData['end'] = get_post_meta(get_the_ID(), 'wpp_promo_end', true);

		}
	endwhile; endif;
	wp_reset_query();

	return $promotionData;
}
?>