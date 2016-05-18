<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 1.6.4
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
		do_action( 'woocommerce_before_single_product' );
		$product_layout = etheme_get_option('single_product_layout');
?>

<div itemscope="" itemtype="http://schema.org/Product">
		<div id="product-page" class="product_layout_<?php echo $product_layout; ?> row product">

				<div class="span1">
					<ul class="stickybar">
						<li id="liSpec" class=""><a data-ref=".product_description_mainblock"><i class="icondetail-parameter"></i>Thông số</a></li>
						<li id="liImg" class=""><a data-ref="boxpicture"><i class="icondetail-pictures"></i>Hình ảnh</a></li>
						<li id="liAcc" class=""><a data-ref="boxaccess"><i class="icondetail-accessories"></i>Phụ kiện</a></li>
						<li id="liCpr" class=""><a data-ref="boxcompare"><i class="icondetail-compare"></i>So sánh</a></li>
						<li id="liCmt" class="actbox"><a data-ref="wrap_end"><i class="icondetail-comment"></i>Bình luận<label>12</label></a></li>
					</ul>
				</div>

				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

				<div class="span7 product_description_mainblock productcol summary">
					<?php do_action( 'woocommerce_single_product_summary' ); ?>
				</div><!-- .summary -->

				<!-- <div class="span3 product_description_banner">
					<?php if (etheme_get_option('right_banners') && etheme_get_option('right_banners') != '' ) : ?>
							<?php etheme_option('right_banners',true); ?>
					<?php else: ?>
							<?php dynamic_sidebar( 'product-single-widget-area' ); ?>
							<?php wp_reset_query(); ?>
					<?php endif; ?>
					<div class="clear"></div>
				</div> -->

				<div class="clear"></div>

		</div><!-- #product-<?php the_ID(); ?> -->

		<div class="row">
			<div class="span1"></div>
			<div class="span11">
				<!-- Show Related products -->
				<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
