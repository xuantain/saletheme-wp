<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce; $woocommerce_checkout = $woocommerce->checkout();
$isAccordion = etheme_get_option('checkout_accordion');
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );

wc_print_notices();
?>

<?php //do_action('woocommerce_before_checkout_form', $checkout ); ?>

<div class="<?php if($isAccordion): ?>tabs accordion checkout-accordion<?php else: ?>checkout-default<?php endif; ?>">
		<form name="checkout" method="post" class="checkout checkout-form" action="<?php echo esc_url( $get_checkout_url ); ?>">
			<?php
				// filter hook for include new pages inside the payment method
				// $get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() );

				if (sizeof($woocommerce_checkout->checkout_fields)>0) : ?>

						<!-- ----------------------------------------------- -->
						<!-- ------------------ ORDER ---------------------- -->
						<!-- ----------------------------------------------- -->
						<div>
								<?php do_action('woocommerce_checkout_order_review'); ?>
						</div>

						<div class="row">

							<!-- ----------------------------------------------- -->
							<!-- ----------------- BILLING --------------------- -->
							<!-- ----------------------------------------------- -->
							<div class="col-xs-12 col-sm-4">
									<?php do_action('woocommerce_checkout_billing'); ?>
							</div>

							<!-- ----------------------------------------------- -->
							<!-- ----------------- SHIPPING -------------------- -->
							<!-- ----------------------------------------------- -->
							<div class="col-xs-12 col-sm-4">
									<?php do_action('woocommerce_checkout_shipping'); ?>
							</div>

							<div class="col-xs-12 col-sm-4">
								<div class="woocommerce-pay">
									<h3 class="bg-primary form-header text-center"><?php _e( 'Payment', ETHEME_DOMAIN ); ?></h3>
									<div class="payment_methods methods">
										<?php
											if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
												// Chosen Method
												if ( sizeof( $available_gateways ) )
													current( $available_gateways )->set_current();

												foreach ( $available_gateways as $gateway ) {
													?>
													<div class="radio payment_method_<?php echo $gateway->id; ?>">
													  <label>
															<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?>
																data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
													    <?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
													  </label>
														<?php
															if ( $gateway->has_fields() || $gateway->get_description() ) {
																echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
																$gateway->payment_fields();
																echo '</div>';
															}
														?>
													</div>
													<?php
												}
											} else {
												echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', ETHEME_DOMAIN ) . '</p>';
											}
										?>
									</div>
								</div>
							<!-- </div> -->

							<!-- <?php //if ( ! $is_ajax ) : ?><div id="order_review"><?php //endif; ?> -->
							<!-- <div class="col-xs-12 col-sm-4"> -->

								<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

								<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order."
									. "You may be charged more than the amount stated above if you fail to do so.', ETHEME_DOMAIN ); ?><br/>
									<input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', ETHEME_DOMAIN ); ?>" />
								</noscript>

								<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

								<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) {
									$terms_is_checked = apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) );
									?>
									<div class="form-row woocommerce-terms">
									  <label for="terms" class="checkbox">
									    <input type="checkbox" class="input-checkbox" id="terms" name="terms" <?php checked( $terms_is_checked, 1 ); ?>>
									    <?php _e( 'I have read and accept the', ETHEME_DOMAIN ); ?>
											<a href="<?php echo esc_url( get_permalink(wc_get_page_id('terms')) ); ?>" target="_blank"><?php _e( 'terms &amp; conditions', ETHEME_DOMAIN ); ?></a>
									  </label>
									</div>
								<?php } ?>

								<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

								<?php
									$order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', ETHEME_DOMAIN ) );
									echo apply_filters( 'woocommerce_order_button_html',
										'<input type="submit" class="btn btn-primary btn-block btn-submit-order" name="woocommerce_checkout_place_order" id="place_order" value="'
											. esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' );
								?>

								<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

								<?php do_action( 'woocommerce_review_order_after_payment' ); ?>

							</div>
							<!-- <?php //if ( ! $is_ajax ) : ?></div><?php //endif; ?> -->

						</div>

				<?php endif; ?>
		</form>
</div>

<?php do_action('woocommerce_after_checkout_form'); ?>
