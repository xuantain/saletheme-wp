<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related(20);
$product_per_row = etheme_get_option('prodcuts_per_row');

if ( sizeof($related) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'						=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 			=> 1,
	'posts_per_page' 			=> 20,
	'orderby' 						=> $orderby,
	'post__in' 						=> $related
) );

$products = new WP_Query( $args );

$rand = rand(1000,99999);

$woocommerce_loop['columns'] 	= $columns;
$related_count = 0;

if ( $products->have_posts() ) : ?>
		<div class="home-product-grid slider">
				<h4 class="slider-title"><?php _e('Related Products', ETHEME_DOMAIN); ?></h4>
				<div>
					<?php while ( $products->have_posts() ) : $products->the_post();	$related_count++; ?>
							<div class="slide product-slide">
								<?php woocommerce_get_template_part( 'content', 'product' ); ?>
							</div>
					<?php endwhile; // end of the loop. ?>
				</div>
				<?php if($related_count > 1): ?>

					<?php
						$arrowClass = '';
						if($related_count < 4) {
							$arrowClass = 'hidden-desktop';
						}
					?>

						<div class="prev related-arrow <?php echo $arrowClass; ?> arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
						<div class="next related-arrow <?php echo $arrowClass; ?> arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
				<?php endif; ?>

		</div><!-- product-slider -->
		<?php if($related_count > 1): ?>
				<script type="text/javascript">
						jQuery(document).ready(function(){
								jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
								jQuery('.slider-<?php echo $rand ?>').iosSlider({
										desktopClickDrag: true,
										snapToChildren: true,
										infiniteSlider: false,
										navNextSelector: '.arrow<?php echo $rand ?>.next',
										navPrevSelector: '.arrow<?php echo $rand ?>.prev',
										lastSlideOffset: 3,
										onFirstSlideComplete: function(){
												jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
										},
										onLastSlideComplete: function(){
												jQuery('.arrow<?php echo $rand ?>.next').addClass('disabled');
										},
										onSlideChange: function(){
												jQuery('.arrow<?php echo $rand ?>.prev').removeClass('disabled');
												jQuery('.arrow<?php echo $rand ?>.next').removeClass('disabled');
										}
								});
						});
				</script>
				<script type="text/javascript">
					function add_to_cart_redirect_ajax (_url) {
						jQuery.ajax({
							method: 'post',
							url: _url,
							success: function (res) {
								if (res) {
									window.location.replace('http://localhost/thegioiphukienso.vn/thanh-toan');
								}
							},
							error: function (err) {
								alert('Error: Cannot put to your card!');
							}
						})
					}
				</script>
		<?php endif; ?>

<?php endif;

wp_reset_query();
