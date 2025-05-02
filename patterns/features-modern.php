<?php
return [
    'title'      => __( 'Features - Modern Grid', 'arnabwp' ),
    'slug'        => 'arnabwp/features-modern',
    'categories' => [ 'arnabwp-sections', 'featured' ],
    'keywords'   => [ 'features', 'grid', 'modern' ],
    'content'    => <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
<div class="wp-block-group site-container alignfull has-background-background-color has-background" style="padding-top:80px;padding-bottom:80px">

	<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"38px"}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="font-size:38px">Smarter Features, Built In</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.8","fontSize":"18px"}},"textColor":"tertiary"} -->
	<p class="has-text-align-center has-tertiary-color has-text-color" style="font-size:18px;line-height:1.8">Everything you need to launch and grow. Powerful tools, ready to use — no plugins required.</p>
	<!-- /wp:paragraph -->

	<!-- wp:columns {"style":{"spacing":{"margin":{"top":"60px"}}}} -->
	<div class="wp-block-columns" style="margin-top:60px">

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"50px","bottom":"30px","left":"30px","right":"30px"}},"border":{"radius":"16px"},"shadow":"var(--wp--preset--shadow--natural)"},"backgroundColor":"white","className":"feature-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group feature-card has-white-background-color has-background" style="border-radius:16px;padding:50px 30px;box-shadow:0 8px 20px rgba(0,0,0,0.06)">

				<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"full","className":"is-style-rounded"} -->
				<figure class="wp-block-image aligncenter is-resized is-style-rounded"><img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg" alt="Speed" width="64" height="64"/></figure>
				<!-- /wp:image -->

				<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"20px"}}}} -->
				<h4 class="wp-block-heading has-text-align-center" style="margin-top:20px">Ultra Fast</h4>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">Built with speed in mind using lightweight components and minimal scripts.</p>
				<!-- /wp:paragraph -->

			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"50px","bottom":"30px","left":"30px","right":"30px"}},"border":{"radius":"16px"},"shadow":"var(--wp--preset--shadow--natural)"},"backgroundColor":"white","className":"feature-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group feature-card has-white-background-color has-background" style="border-radius:16px;padding:50px 30px;box-shadow:0 8px 20px rgba(0,0,0,0.06)">

				<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"full","className":"is-style-rounded"} -->
				<figure class="wp-block-image aligncenter is-resized is-style-rounded"><img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg" alt="Security" width="64" height="64"/></figure>
				<!-- /wp:image -->

				<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"20px"}}}} -->
				<h4 class="wp-block-heading has-text-align-center" style="margin-top:20px">Secure by Default</h4>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">Follows best coding practices with hardened templates and clean codebase.</p>
				<!-- /wp:paragraph -->

			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"50px","bottom":"30px","left":"30px","right":"30px"}},"border":{"radius":"16px"},"shadow":"var(--wp--preset--shadow--natural)"},"backgroundColor":"white","className":"feature-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group feature-card has-white-background-color has-background" style="border-radius:16px;padding:50px 30px;box-shadow:0 8px 20px rgba(0,0,0,0.06)">

				<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"full","className":"is-style-rounded"} -->
				<figure class="wp-block-image aligncenter is-resized is-style-rounded"><img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg" alt="Custom" width="64" height="64"/></figure>
				<!-- /wp:image -->

				<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"20px"}}}} -->
				<h4 class="wp-block-heading has-text-align-center" style="margin-top:20px">Total Control</h4>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">Use Global Styles and Pattern variations to craft your brand identity.</p>
				<!-- /wp:paragraph -->

			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
HTML,
];