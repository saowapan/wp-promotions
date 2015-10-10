<li>

	<div class="promotion-content-wrapper">

		<div class="promotion-thumbnail">
			<a href="<?php echo get_permalink(); ?>">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'medium'); ?> 
			</a>
		</div>

		<div class="promotion-description">

			<h3 class="promotion-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			
			<div class="promotion-excerpt"><?php the_excerpt(); ?></div>

			<div class="promotion-meta">

				<p class="cat-map-icon"><i class="fa fa-map-marker"></i></p>

				<div class="promotion-meta-information promotion-start-date"><?php _e('Start: ', 'wpp'); echo get_post_meta(get_the_ID(), 'wpp_promo_start', true); ?></div>
				
				<div class="promotion-meta-information promotion-end-date"><?php _e('End: ', 'wpp'); echo get_post_meta(get_the_ID(), 'wpp_promo_end', true); ?></div>
				
				<div class="promotion-meta-information promotion-status">

					<?php echo get_post_status(); ?>

				</div>

				<div class="promotion-meta-information promotion-edit-delete">
				
					<?php $edit_post = add_query_arg('post', get_the_ID(), get_permalink(wpp_get_id_by_shortcode(wpp_edit))); ?>
					<a class="promotion-edit" href="<?php echo $edit_post; ?>"><?php _e('Edit', 'wpp'); ?></a>
					<?php if( !(get_post_status() == 'trash') ) : ?>
						<a class="promotion-delete" onclick="return confirm('<?php _e('Are you sure you wish to delete post:', 'wpp'); echo get_the_title() ?>?')"href="<?php echo get_delete_post_link( get_the_ID() ); ?>"><?php _e('Delete', 'wpp'); ?></a>
					<?php endif; ?>
				
				</div>

			</div>

		</div>

	</div>

</li>