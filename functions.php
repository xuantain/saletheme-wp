<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( 'idstore' );
define('ETHEME_DOMAIN', 'idstore');
define('ETHEME_OPTIONS', 'site_basic_options');
require_once( get_template_directory() . '/code/init.php' );
register_sidebar(array(
		'name' => 'Tư vấn bán hàng',
		'id' => 'phone-hotline',
		'description' => 'Khu vực hiển thị số điện thoại hotline tư vấn bán hàng. Nằm ở góc trên bên trái header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
));
register_sidebar(array(
		'name' => 'Liên kết mạng xã hội',
		'id' => 'phone-facebook',
		'description' => 'Khu vực hiển thị các liên kết mạng xã hội như Facebook, Google+, Twitter',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
));
register_sidebar(array(
		'name' => 'Lọc theo màu sắc',
		'id' => 'loc-theo-mau-sac',
		'description' => 'Khu vực sidebar hiển thị lọc theo màu sắc',
		'before_widget' => '<div style="float: right"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>'
));
register_sidebar(array(
		'name' => 'Sidebar custom - Trái',
		'id' => 'about-sidebar-left',
		'description' => 'Khu vực hiển thị cho sidebar bên trái',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>'
));
register_sidebar(array(
		'name' => 'Sidebar custom - Phải',
		'id' => 'about-sidebar-right',
		'description' => 'Khu vực hiển thị cho sidebar bên phải trang chủ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>'
));
register_sidebar(array(
		'name' => 'Chuyên trang widget',
		'id' => 'chuyen-trang',
		'description' => 'Khu vực sidebar hiển thị các chuyên trang',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>'
));
add_action( 'woocommerce_share', 'patricks_woocommerce_social_share_icons', 10 );
function patricks_woocommerce_social_share_icons() {
		if ( function_exists( 'sharing_display' ) ) {
				remove_filter( 'the_content', 'sharing_display', 19 );
				remove_filter( 'the_excerpt', 'sharing_display', 19 );
				echo sharing_display();
		}
}
// Đăng nhập bằng email và username
add_filter('authenticate', 'dang_nhap_tha_phanh', 20, 3);
function dang_nhap_tha_phanh( $user, $username, $password ) {
		if ( is_email( $username ) ) {
				$user = get_user_by_email( $username );
				if ( $user ) $username = $user->user_login;
		}
		return wp_authenticate_username_password( null, $username, $password );
}
// search titles only (relevanssi plugin)
add_filter('relevanssi_index_content', 'contentoff');
function contentoff() {
		return false;
}

// Hook in: We add new one field is "shipping_phone"
add_filter( 'woocommerce_checkout_fields' , 'add_new_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function add_new_checkout_fields( $fields ) {
		$fields['shipping']['shipping_phone'] = array(
			'label' => __('Phone', 'woocommerce'),
			'placeholder' => _x('Phone', 'placeholder', 'woocommerce'),
			'required' => false,
			'class' => array('form-row-wide'),
			'clear' => true
		);

		return $fields;
}

// Hook in: We remove some fields is not necessary
add_filter( 'woocommerce_checkout_fields' , 'remove_checkout_fields' );
// Our hooked in function - $fields is passed via the filter!
function remove_checkout_fields( $fields ) {

		// Remove some fields in billing
		unset($fields['billing']['billing_country']);
		unset($fields['billing']['billing_company']);
		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_state']);
		unset($fields['billing']['billing_postcode']);

		// Remove some fields in shipping
		unset($fields['shipping']['shipping_country']);
		unset($fields['shipping']['shipping_company']);
		unset($fields['shipping']['shipping_address_2']);
		unset($fields['shipping']['shipping_state']);
		unset($fields['shipping']['shipping_postcode']);

		return $fields;
}
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');
