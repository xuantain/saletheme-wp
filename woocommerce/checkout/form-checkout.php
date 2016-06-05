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

<?php do_action('woocommerce_before_checkout_form', $checkout ); ?>

<div class="<?php if($isAccordion): ?>tabs accordion checkout-accordion<?php else: ?>checkout-default<?php endif; ?>">
		<?php if(!is_user_logged_in()): ?>
				<!-- ----------------------------------------------- -->
				<!-- ------------------- LOGIN --------------------- -->
				<!-- ----------------------------------------------- -->
				<?php if($isAccordion): ?><a class="tab-title checkout-accordion-title" id="tab_1"><span><?php _e('Checkout Method', ETHEME_DOMAIN) ?></span></a><?php endif; ?>
				<div class="tab-content tab-login" id="content_tab_1">
						<div class="col2-set">
								<div class="col-1 checkout-login">
										<h3><?php _e('New Customers', ETHEME_DOMAIN) ?></h3>
										<div class="checkout-methods">
												<?php if ($checkout->enable_guest_checkout): ?>
													<div class="method-radio">
															<input type="radio" id="method1" name="method" value="1" />
															<label for="method1"><?php _e('Checkout as Guest', ETHEME_DOMAIN); ?></label>
															<div class="clear"></div>
													</div>
												<?php endif ?>
												<?php if (get_option('woocommerce_enable_signup_and_login_from_checkout') != 'no'): ?>
													<div class="method-radio">
															<input type="radio" id="method2" name="method" value="2" <?php if (!$checkout->enable_guest_checkout): ?> checked <?php endif; ?> />
															<label for="method2"><?php _e('Create an Account', ETHEME_DOMAIN); ?></label>
															<div class="clear"></div>
													</div>
												<?php endif; ?>
												<div class="clear"></div>
										</div>
										<?php if($isAccordion): ?><a class="button checkout-cont checkout-cont1"><span><?php _e('Continue', ETHEME_DOMAIN) ?></span></a><?php endif; ?>
								</div>
								<div class="col-2 checkout-customers">
										<h3><?php _e('Returning Customers', ETHEME_DOMAIN) ?></h3>
										<?php
												// If checkout registration is disabled and not logged in, the user cannot checkout
												if (get_option('woocommerce_enable_signup_and_login_from_checkout')=="no" && get_option('woocommerce_enable_guest_checkout')=="no" && !is_user_logged_in()) :
													echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', ETHEME_DOMAIN));
													return;
												endif;
										?>

								</div>
								<div class="clear"></div>
						</div>
				</div>
		<?php endif; ?>

		<form name="checkout" method="post" class="checkout checkout-form" action="<?php echo esc_url( $get_checkout_url ); ?>">

			<?php if(!is_user_logged_in()): ?>
				<?php if (get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes") : ?>
						<!-- ----------------------------------------------- -->
						<!-- -------------- -- REGISTER -- ----------------- -->
						<!-- ----------------------------------------------- -->
						<?php if($isAccordion): ?><a class="tab-title checkout-accordion-title" id="tab-register"><span><?php _e('Create an Account', ETHEME_DOMAIN) ?></span></a><?php endif; ?>
						<div class="tab-content register-tab-content" id="content_tab-register">

								<?php if (get_option('woocommerce_enable_guest_checkout')=='yes') : ?>

									<p class="form-row">
										<input class="input-checkbox" id="createaccount" <?php checked($woocommerce_checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" />
										<label for="createaccount" class="checkbox"><?php _e('Create an account?', ETHEME_DOMAIN); ?></label>
									</p>

								<?php endif; ?>

								<?php do_action( 'woocommerce_before_checkout_registration_form', $woocommerce_checkout ); ?>

								<div class="create-account-form">

									<!--<p><?php _e('Create an account by entering the information below. If you are a returning customer please login with your username at the top of the page.', ETHEME_DOMAIN); ?></p>-->

									<?php foreach ($woocommerce_checkout->checkout_fields['account'] as $key => $field) : ?>

										<?php woocommerce_form_field( $key, $field, $woocommerce_checkout->get_value( $key ) ); ?>

									<?php endforeach; ?>

								</div>

								<?php do_action( 'woocommerce_after_checkout_registration_form', $woocommerce_checkout ); ?>

								<?php if($isAccordion): ?><a class="button checkout-cont checkout-cont2"><span><?php _e('Continue', ETHEME_DOMAIN) ?></span></a><?php endif; ?>

						</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php
				// filter hook for include new pages inside the payment method
				// $get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() ); ?>

				<?php if (sizeof($woocommerce_checkout->checkout_fields)>0) : ?>

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
							<div class="span4">
									<?php do_action('woocommerce_checkout_billing'); ?>
							</div>

							<!-- ----------------------------------------------- -->
							<!-- ----------------- SHIPPING -------------------- -->
							<!-- ----------------------------------------------- -->
							<div class="span4">
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

							<!-- <?php //if ( ! $is_ajax ) : ?><div id="order_review"><?php //endif; ?> -->
							<div class="span4 btn-group">

								<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

								<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', ETHEME_DOMAIN ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', ETHEME_DOMAIN ); ?>" /></noscript>

								<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

								<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) {
									$terms_is_checked = apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) );
									?>
									<p class="form-row terms">
										<label for="terms" class="checkbox"><?php _e( 'I have read and accept the', ETHEME_DOMAIN ); ?> <a href="<?php echo esc_url( get_permalink(wc_get_page_id('terms')) ); ?>" target="_blank"><?php _e( 'terms &amp; conditions', ETHEME_DOMAIN ); ?></a></label>
										<input type="checkbox" class="input-checkbox" name="terms" <?php checked( $terms_is_checked, true ); ?> id="terms" />
									</p>
								<?php } ?>

								<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

								<?php
									$order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', ETHEME_DOMAIN ) );
									echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button btn-submit-order" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' );
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
