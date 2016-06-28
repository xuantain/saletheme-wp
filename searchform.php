<?php
/**
 * The template for displaying search forms
 *
 */
?>

<?php if(class_exists('Woocommerce')) : ?>
	<form action="<?php echo home_url( '/' ); ?>" id="searchform" method="get" class="navbar-form navbar-right" role="search">
		<input type="text" class="field" name="s" id="s"
			value="<?php if(get_search_query() == '') { _e('Search for products', ETHEME_DOMAIN); } else { the_search_query(); } ?>"
			onblur="if(this.value=='')this.value='<?php _e('Search for products', ETHEME_DOMAIN); ?>'"
			onfocus="if(this.value=='<?php _e('Search for products', ETHEME_DOMAIN); ?>')this.value=''"
		/>
		<input type="hidden" name="post_type" value="product" />
		<input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="glyphicon glyphicon-search"/>
	</form>
<?php else: ?>
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get" class="navbar-form navbar-right" role="search">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search entire store here...', ETHEME_DOMAIN ); ?>" />
		<input type="hidden" name="post_type" value="post" />
		<input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="glyphicon glyphicon-search"/>
	</form>
<?php endif ?>
