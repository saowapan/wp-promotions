<div class="promotions promotions-container">

	<div class="promotion-body">

		<div class="login-error">
			<?php
				//todo add backend options for custom login pages
				$link = '<a href="'.get_site_url().'/wp-login.php">';
				$linkend = '</a>';

				printf(__('Please sign up and %slogin%s to access this page!', 'wpp'), $link, $linkend); 
			?>
		</div>
		
	</div>

</div>