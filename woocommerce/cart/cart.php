<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
$woocommerce_checkout = $woocommerce->checkout();
$isAccordion = etheme_get_option('checkout_accordion');
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );

wc_print_notices();

woocommerce_checkout_coupon_form();

do_action( 'woocommerce_before_cart' );
?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<table class="cart table checkout_cart" cellspacing="0" style="margin-bottom: 20px;">
		<tr>
			<th class="product-thumbnail cart_del_column">&nbsp;</th>
			<th class="product-name"><?php _e('Product', ETHEME_DOMAIN); ?></th>
			<th class="product-price cart_del_column"><?php _e('Price', ETHEME_DOMAIN); ?></th>
			<th class="product-quantity"><?php _e('Qty', ETHEME_DOMAIN); ?></th>
			<th class="product-subtotal"><?php _e('Total', ETHEME_DOMAIN); ?></th>
			<th class="product-remove cart_del_column">&nbsp;</th>
		</tr>

		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

						<!-- The thumbnail -->
						<td class="product-thumbnail cart_del_column">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
								printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>

						<!-- Product Name -->
						<td class="product-name">
							<?php
								if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

									// Meta data
									echo $woocommerce->cart->get_item_data( $values );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
										echo '<p class="backorder_notification">' . __('Available on backorder', ETHEME_DOMAIN) . '</p>';
							?>
						</td>

						<!-- Product price -->
						<td class="product-price cart_del_column">
							<?php
								$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity" id="cart-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = '1';
								} else {
									$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
									$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
									$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

									$product_quantity = sprintf( '<div class="qty-block quantity"><input name="cart[%s][qty]" data-min="%s" data-max="%s" value="%s" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $values['quantity'] ) );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
						<!-- Remove from cart link -->
						<td class="product-remove cart_del_column">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="delete-btn" title="%s"></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', ETHEME_DOMAIN) ), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( get_option( 'woocommerce_enable_coupons' ) == 'yes' ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e('Coupon', ETHEME_DOMAIN); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="button apply-coupon" name="apply_coupon" value="<?php _e('Apply Coupon', ETHEME_DOMAIN); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				<input type="submit" class="button update-button" name="update_cart" value="<?php _e('Update Cart', ETHEME_DOMAIN); ?>" />

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php wp_nonce_field('woocommerce-cart') ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<form action="<?php echo esc_url( $get_checkout_url ); ?>" method="post">
	<div class="row">
	<?php if ( sizeof($woocommerce->cart->get_cart()) > 0 ) : ?>
			<div class="span4">
					<!-- ----------------------------------------------- -->
					<!-- ----------------- BILLING --------------------- -->
					<!-- ----------------------------------------------- -->
					<?php do_action('woocommerce_checkout_billing'); ?>
			</div>
			<div class="span4">
					<!-- ----------------------------------------------- -->
					<!-- ----------------- SHIPPING -------------------- -->
					<!-- ----------------------------------------------- -->
					<?php do_action('woocommerce_checkout_shipping'); ?>
			</div>
			<div class="span4">
				<div class="woocommerce-pay">
					<h3><?php _e( 'Payment', ETHEME_DOMAIN ); ?></h3>
					<ul class="payment_methods methods">
						<?php
							if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
								// Chosen Method
								if ( sizeof( $available_gateways ) )
									current( $available_gateways )->set_current();

								foreach ( $available_gateways as $gateway ) {
									?>
									<li class="payment_method_<?php echo $gateway->id; ?>">
										<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
										<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
										<?php
											if ( $gateway->has_fields() || $gateway->get_description() ) {
												echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
												$gateway->payment_fields();
												echo '</div>';
											}
										?>
									</li>
									<?php
								}
							} else {
								echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', ETHEME_DOMAIN ) . '</p>';
							}
						?>
					</ul>
				</div>
			</div>
			<div class="span4 btn-group">
				<?php if($isAccordion): ?>
					<a class="button btn-checkout" href="../thanh-toan"><span><?php _e('Payment', ETHEME_DOMAIN) ?></span></a>
				<?php endif; ?>
			</div>
	<?php endif; ?>

	<!-- <div class="cart-collaterals"> -->
			<!-- <?php //woocommerce_cart_totals(); ?> -->
			<!-- <?php //woocommerce_shipping_calculator(); ?> -->
			<!-- <div class="clear"></div> -->
	<!-- </div> -->
	<!-- <?php //do_action('woocommerce_cart_collaterals'); ?> -->

	</div>
</form>
