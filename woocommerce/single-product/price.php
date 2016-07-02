<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="main-info product_meta" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<div itemprop="price" class="price-block">
				<?php echo $product->get_price_html(); ?>
		</div>
		<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
		<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
		<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

		<div class="product-stock">

			<?php etheme_print_stars(true); ?>

			<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && $product->get_sku() ) : ?>
				<span class="product-code"><?php _e('SKU:', ETHEME_DOMAIN); ?>
					<span class="sku"><?php echo $product->get_sku(); ?></span>
				</span>
			<?php endif; ?>

				<?php
					// Availability
					$availability = $product->get_availability();

					if ($availability['availability']) :
						echo apply_filters( 'woocommerce_stock_html', '<span class="stock '.$availability['class'].'">'.__('Availability:', ETHEME_DOMAIN).' <span>'.$availability['availability'].'</span></span>', $availability['availability'] );
						endif;
				?>
		</div>
		<div class="clear"></div>
</div>
<hr />
