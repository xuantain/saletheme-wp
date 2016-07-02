<?php
/**
 * The Header for saletheme.
 *
 */
?>
<?php global $etheme_responsive; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<?php if($etheme_responsive): ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php endif; ?>
	<meta name="google-site-verification" content="d0wCzDOehBR50JI1kRgEPoHfilWoN_pOJq_Wly45Nj8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>
		<?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;

			wp_title( '|', true, 'right' );

			// Add the blog name.
			bloginfo( 'name' );

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', ETHEME_DOMAIN ), max( $paged, $page ) );
		?>
	</title>
	<link rel='stylesheet' type='text/css'
		href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,900,400italic,500italic,300&subset=latin,vietnamese'>
	<link rel="shortcut icon" href="<?php etheme_option('favicon',true) ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script type="text/javascript">
		var etheme_wp_url = '<?php echo home_url(); ?>';
		var succmsg = '<?php _e('All is well, your e&ndash;mail has been sent!', ETHEME_DOMAIN); ?>';
		var menuTitle = '<?php _e('Menu', ETHEME_DOMAIN); ?>';
		var nav_accordion = false;
		var ajaxFilterEnabled = <?php echo (etheme_get_option('ajax_filter')) ? 1 : 0 ; ?>;
		var isRequired = ' <?php _e('Please, fill in the required fields!', ETHEME_DOMAIN); ?>';
		var someerrmsg = '<?php _e('Something went wrong', ETHEME_DOMAIN); ?>';
		var successfullyAdded = '<?php _e('Successfully added to your shopping cart', ETHEME_DOMAIN); ?>';
	</script>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-57632795-1', 'auto');
		ga('send', 'pageview');
	</script>

	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
	$header_type = apply_filters('custom_header_filter', $header_type);
?>
</head>

<body
	<?php $fixed = '';
	if(etheme_get_option('fixed_nav')) {
		$fixed .= ' fixNav-enabled ';
	}
	if($header_type == 'variant6' && is_front_page()) {
		$fixed .= ' header-overlapped ';
	}
	body_class('no-svg '.etheme_get_option('main_layout').' banner-mask-'.etheme_get_option('banner_mask').$fixed); ?>
>

	<div class="wrapper">

		<?php if(etheme_get_option('loader')): ?>
		<div id="loader">
			<div id="loader-status">
				<p class="text-center">
					<em><?php _e('Loading the content...', ETHEME_DOMAIN); ?></em>
					<em><?php _e('Loading depends on your connection speed!', ETHEME_DOMAIN); ?></em>
				</p>
			</div>
		</div>
		<?php endif; ?>

		<!-- Header Navigation Top -->
		<nav class="navbar navbar-default navbar-static-top static-header-area" role="navigation">
			<div class="container">
				<!-- LARGE SCREEN -->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-left">
						<?php if ( is_active_sidebar( 'phone-hotline' ) ) : ?>
							<li><?php dynamic_sidebar( 'phone-hotline' ); ?></li>
						<?php endif; ?>
						<li><a href="<?php echo site_url(); ?>"><i class="home-btn"></i></a></li>
					</ul>
					<?php etheme_header_menu(); ?>
					<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
						<ul id="top-cart" class="nav navbar-nav navbar-right">
							<li><?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?></li>
							<?php if (etheme_get_option('search_form')) : ?>
							<li><?php get_search_form(); ?></li>
							<?php endif; ?>
						</ul>
						<!-- Login/Logout -->
						<?php //if(etheme_get_option('top_links')): ?>
								<?php	//get_template_part( 'et-links' ); ?>
						<?php //endif; ?>
					<?php endif ;?>
				</div>

				<!-- SMALL SCREEN -->
				<div class="row visible-xs nav-bar-xs">
					<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
						<div class="col-xs-6"><?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?></div>
						<?php if (etheme_get_option('search_form')) : ?>
						<div class="col-xs-6"><?php get_search_form(); ?></div>
						<?php endif; ?>
					<?php endif ;?>
				</div>
			</div>
		</nav>
		<!-- End of Header Navigation Top -->

		<!-- Header Fixed Navigation Top -->
		<nav class="navbar navbar-default navbar-static-top fixed-header-area" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<?php etheme_logo(); ?>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-car-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="header-car-collapse">
					<?php etheme_header_cat_navigation(); ?>
				</div>
			</div>
		</nav>
		<!-- End of Header Fixed Navigation Top -->

		<?php
			get_template_part( 'et-styles' );
			// if($etheme_responsive){
			// 	get_template_part('large-resolution');
			// }
		?>
	</div>
