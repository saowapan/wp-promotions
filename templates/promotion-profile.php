<div class="promotions promotions-container">

	<?php wpp_get_template_part('parts/menu'); ?>
	
	<div class="promotion-body">

		<div class="total-promotions">
			<?php $postcount = count_user_posts(get_current_user_id(), promo); ?>
			<div class="promotion-info">
				<?php if ($postcount == 0) {

					_e('Opps! It seems you currently have no active promotions! Please wait patiently while we review your promotions.', 'wpp');
				
				} elseif ($postcount == 1) {
				
					printf( __('You have %d active promotion.', 'wpp'), $postcount);
				
				} else {
				
					printf( __('You have added %d active promotions.', 'wpp'), $postcount);
				
				} ?>
			</div>
		</div>
	</div>
</div>