<div class="promotions promotions-container">

<?php 
	
	wpp_get_template_part('parts/menu');  ?>

	<ul class="promotions-list">

	<?php $author_id = get_current_user_id();
	$query = new WP_Query( array(
		'post_type' => 'promotion',
	 	'posts_per_page' =>'-1',
	 	'post_status' => array('publish', 'pending'),
	 	'author' => $author_id )
	);

	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

		wpp_get_template_part('parts/single-promotion');

	endwhile; else: ?>

		<div class="promotion-info"><?php _e('No promotions found! Please add some!', 'wpp'); ?></div>

<?php endif; ?>

	</ul>

</div>