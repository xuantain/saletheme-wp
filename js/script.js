jQuery(document).ready(function() {

		/* Loader */

		jQuery("#loader-status").fadeOut().remove();
		jQuery("#loader").delay(300).fadeOut("slow").remove();


		/* Search form
		-------------------------------------------------------------- */

		jQuery('#searchform .field').click(function() {
				console.log('click');
				jQuery('#searchform').addClass('opened-input');
				jQuery(document).click(function(e) {
						var target = e.target;
						if (!jQuery(target).is('.search_form') && !jQuery(target).parents().is('.search_form')) {
								jQuery('#searchform').removeClass('opened-input');
						}
				});
		});

		/* prettyPhoto
		-------------------------------------------------------------- */

		jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox']").prettyPhoto({
				animation_speed: 'normal',
				/* fast/slow/normal */
				slideshow: 5000,
				/* false OR interval time in ms */
				autoplay_slideshow: false,
				/* true/false */
				opacity: 0.80,
				/* Value between 0 and 1 */
				show_title: true,
				/* true/false */
				allow_resize: true,
				/* Resize the photos bigger than viewport. true/false */
				default_width: 500,
				default_height: 344,
				counter_separator_label: '/',
				/* The separator for the gallery counter 1 "of" 2 */
				theme: 'pp_default',
				/* light_rounded / dark_rounded / light_square / dark_square / facebook */
				horizontal_padding: 20,
				/* The padding on each side of the picture */
				hideflash: false,
				/* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
				wmode: 'opaque',
				/* Set the flash wmode attribute */
				autoplay: true,
				/* Automatically start videos: True/False */
				modal: false,
				/* If set to true, only the close button will close the window */
				deeplinking: true,
				/* Allow prettyPhoto to update the url to enable deeplinking. */
				overlay_gallery: true,
				/* If set to true, a gallery will overlay the fullscreen image on mouse over */
				keyboard_shortcuts: true,
				/* Set to false if you open forms inside prettyPhoto */
				changepicturecallback: function() {},
				/* Called everytime an item is shown/changed */
				social_tools: false,
				gallery_markup: ''
		});

		/* Mobile navigation
		-------------------------------------------------------------- */

		var navList = jQuery('div.menu > ul').clone();
		var etOpener = '<span class="open-child">(open)</span>';
		navList.removeClass('menu').addClass('et-mobile-menu');


		navList.find('li:has(ul)', this).each(function() {
				jQuery(this).prepend(etOpener);
		});

		navList.find('.open-child').toggle(function() {
				jQuery(this).parent().addClass('over').find('>ul').slideDown(200);
		}, function() {
				jQuery(this).parent().removeClass('over').find('>ul').slideUp(200);
		});

		jQuery('.header-bg').after(navList[0]);
		jQuery('div.menu').after('<span class="et-menu-title"><i class="icon-reorder"></i></span>');

		jQuery('.et-menu-title').toggle(function() {
				jQuery('.et-mobile-menu').slideDown(200);
		}, function() {
				jQuery('.et-mobile-menu').slideUp(200);
		});

		/* Fixed menu */

		jQuery(window).scroll(function() {
				var fixedHeader = jQuery('.fixed-header-area');
				var scrollTop = jQuery(this).scrollTop();
				var headerHeight = jQuery('.static-header-area').height();
				var stickybar = jQuery('.stickybar');

				if (scrollTop > headerHeight) {
						if (!fixedHeader.hasClass('fixed-already')) {
								fixedHeader.stop().addClass('fixed-already');
						}
						if (stickybar && !stickybar.hasClass('fixed')) {
							stickybar.stop().addClass('fixed');
						}
						if (stickybar && stickybar.hasClass('fixed')) {
							var stickybarLimitBottom = stickybar.offset().top + stickybar.height();
							var footerTop = jQuery('.footer_container').offset().top;
							if (stickybarLimitBottom > footerTop) {
								stickybar.stop().removeClass('fixed');
							}
						}
				} else {
						if (fixedHeader.hasClass('fixed-already')) {
								fixedHeader.stop().removeClass('fixed-already');
						}
						if (stickybar && stickybar.hasClass('fixed')) {
							stickybar.stop().removeClass('fixed');
						}
				}

		});

		/* Hover intent
		-------------------------------------------------------------- */
		jQuery('.shopping-cart-wrapper').hoverIntent(
				function() {
						jQuery(".cart-popup").stop().slideDown(100);
				},
				function() {
						jQuery(".cart-popup").stop().slideUp(100);
				}
		);

		/* Alerts
		-------------------------------------------------------------- */

		jQuery('.woocommerce_message,.woocommerce_error').append('<span class="close-parent">close</span>');

		/* Tabs
		-------------------------------------------------------------- */
		var tabs = jQuery('.tabs');
		jQuery('.tabs > p > a').unwrap('p');

		var leftTabs = jQuery('.left-tabs');
		var newTitles;

		leftTabs.each(function() {
				var currTab = jQuery(this);
				//currTab.find('> a.tab-title').each(function(){
				newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
				//});

				var newHtml = newTitles;

				var tabNewTitles = jQuery('<div class="left-titles"></div>').prependTo(currTab);
				tabNewTitles.html(newTitles);
		});


		tabs.each(function() {
				var currTab = jQuery(this);
				currTab.find('.tab-title, .tab-title-left').click(function(e) {

						e.preventDefault();

						var tabId = jQuery(this).attr('id');

						if (jQuery(this).hasClass('opened')) {
								jQuery(this).removeClass('opened');
								jQuery('#content_' + tabId).hide();
						} else {
								currTab.find('.tab-title, .tab-title-left').each(function() {
										var tabId = jQuery(this).attr('id');
										jQuery(this).removeClass('opened');
										jQuery('#content_' + tabId).hide();
								});
								jQuery('#content_' + tabId).show();
								jQuery(this).addClass('opened');
						}
				});
		});





		/* Checkout accordion
		-------------------------------------------------------------- */
		var chtAccord = jQuery('.checkout-accordion');
		var tabRegister = jQuery('.register-tab-content');
		var regCheckbox = jQuery('#createaccount');
		var btnNext = jQuery('.checkout-cont');

		if (chtAccord.children().first().hasClass('tab-title')) {
				chtAccord.children().first().addClass('opened').next().show();
		} else {
				chtAccord.children().first().children().first().addClass('opened').next().show();
		}

		btnNext.click(function() {
				if (jQuery(this).hasClass('checkout-cont1')) {
						var nextTab = jQuery(this).parent().parent().parent().hide().prev().removeClass('opened').next().next().children().first();
						if (tabRegister.hasClass('skipTab')) {
								tabRegister.next().addClass('opened').next().show();
						} else {
								jQuery('#tab-register').addClass('opened').next().show();
						}

				} else {
						jQuery(this).parent().hide().prev().removeClass('opened')
								.next().next().addClass('opened').next().show();
				}
		});

		jQuery('input[name="method"]').change(function() {
				if (jQuery(this).val() == 1) {
						tabRegister.addClass('skipTab').hide();
						regCheckbox.attr('checked', false);
				} else {
						tabRegister.removeClass('skipTab').show();
						regCheckbox.attr('checked', true);
				}
		});


		/* Accordion
		-------------------------------------------------------------- */
		var $container = jQuery('.acc-container'),
				$trigger = jQuery('.acc-trigger');

		$container.hide();
		$trigger.first().addClass('active').next().show();

		var fullWidth = $container.outerWidth(true);
		$trigger.css('width', fullWidth);
		$container.css('width', fullWidth);

		$trigger.on('click', function(e) {
				if (jQuery(this).next().is(':hidden')) {
						$trigger.removeClass('active').next().slideUp(300);
						jQuery(this).toggleClass('active').next().slideDown(300);
				}
				e.preventDefault();
		});

		// Resize
		jQuery(window).on('resize', function() {
				fullWidth = $container.outerWidth(true);
				$trigger.css('width', $trigger.parent().width());
				$container.css('width', $container.parent().width());
		});


		/* Checkout
		-------------------------------------------------------------- */
		jQuery("a#checkout-next").click(function() {
				jQuery("#shopping-cart-form").fadeIn();
				var checkoutWidth = jQuery("#shopping-cart").width() + 30;
				jQuery("#checkout-bar-in").animate({
						width: '+=50%'
				});
				jQuery("#checkout-slider").animate({
						marginLeft: '-=' + checkoutWidth
				}, 800, function() {
						jQuery('body,html').animate({
								scrollTop: 0
						}, 800);
				});
				return false;
		});

		jQuery("a#checkout-back,a.checkout-back").click(function() {
				jQuery("#shopping-cart-form").fadeOut();
				var checkoutWidth = jQuery("#shopping-cart").width() + 30;
				jQuery("#checkout-bar-in").animate({
						width: '-=50%'
				});
				jQuery("#checkout-slider").animate({
						marginLeft: '+=' + checkoutWidth
				}, 800, function() {
						jQuery('body,html').animate({
								scrollTop: 0
						}, 800);
				});
				return false;
		});



		/* "Top" button
		-------------------------------------------------------------- */

		var scroll_timer;
		var displayed = false;
		var $message = jQuery('#back-to-top');
		var $window = jQuery(window);

		$window.scroll(function() {
				window.clearTimeout(scroll_timer);
				scroll_timer = window.setTimeout(function() {
						if ($window.scrollTop() <= 0) {
								displayed = false;
								$message.fadeOut(500);
						} else if (displayed === false) {
								displayed = true;
								$message.stop(true, true).fadeIn(500).click(function() {
										$message.fadeOut(500);
								});
						}
				}, 400);
		});

		jQuery('#top-link').click(function(e) {
				jQuery('html, body').animate({
						scrollTop: 0
				}, 1000);
				return false;
		});

		/* Accordion Navigation
		-------------------------------------------------------------- */
		jQuery(function() {
				if (!nav_accordion) {
						jQuery('.categories-group .wpsc_category_title .btn-show ').hide();
				} else {
						jQuery('.block.cats').addClass('acc_enabled');
						jQuery('.categories-group').each(function() {
								jQuery(this).has('.wpsc_top_level_categories').addClass('has-subnav');
								jQuery(this).has('.current-cat').addClass('current-parent opened');
						});


						var nav_section = jQuery('.categories-group .wpsc_top_level_categories');
						var nav_toggle_element = jQuery('.categories-group .wpsc_category_title .btn-show ');
						var nav_speed = 150;


						nav_toggle_element.click(function() {
								if (jQuery(this).parent().parent().hasClass('opened')) {
										hideActiveSection();
								} else {
										showNext(jQuery(this));
								}
						});

						if (jQuery('.categories-group.opened').length > 0) {
								//jQuery('.categories-group.has-subnav').addClass('opened');
						} else {
								// If doesnt exitst opened point
								jQuery('.categories-group.has-subnav:first').addClass('opened').find('ul').show();
						}

						function showNext(element) {
								hideActiveSection();
								element.parent().parent().addClass('opened');
								element.parent().next().show(nav_speed);
						}

						function hideActiveSection() {
								jQuery('.categories-group.opened').removeClass('opened').find('.wpsc_top_level_categories').hide(nav_speed);
						}
				}
		});
		/* ethemeContactForm
		-------------------------------------------------------------- */
		var ethemeContactForm = jQuery('#ethemeContactForm');

		var spinner = jQuery('.contactSpinner');

		jQuery('.required-field').focus(function() {
				jQuery(this).removeClass('validation-failed');
		});

		ethemeContactForm.find('button.button').click(function(e) {
				jQuery('#contactsMsgs').html('');
				e.preventDefault();
				spinner.show();

				var errmsg;
				errmsg = '';

				ethemeContactForm.find('.required-field').each(function() {
						if (jQuery(this).val() === '') {
								errmsg = isRequired;
								jQuery(this).addClass('validation-failed');
						}
				});

				if (errmsg) {
						jQuery('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
						spinner.hide();
				} else {

						url = ethemeContactForm.attr('action');

						data = ethemeContactForm.serialize();
						data += '&contactSubmit=true';

						jQuery.ajax({
								url: url,
								method: 'GET',
								data: data,
								error: function() {
										jQuery('#contactsMsgs').html('<p class="error">' + someerrmsg + '</p>');
										spinner.hide();
								},
								success: function() {
										jQuery('#contactsMsgs').html('<p class="success">' + succmsg + '</p>');
										spinner.hide();
										ethemeContactForm.find("input[type=text], textarea").val("");
								}
						});

				}
		});
		/* ethemeCommentForm
		-------------------------------------------------------------- */
		var ethemeCommentForm = jQuery('#commentform');


		ethemeCommentForm.find('#submit').click(function(e) {
				jQuery('#commentsMsgs').html('');
				var errmsg;
				errmsg = '';

				ethemeCommentForm.find('.required-field').each(function() {
						if (jQuery(this).val() === '') {
								errmsg = isRequired;
								jQuery(this).addClass('validation-failed');
						}
				});

				if (errmsg) {
						e.preventDefault();
						jQuery('#commentsMsgs').html('<p class="error">' + errmsg + '</p>');
				}
		});
		/* "Close parent" button
		-------------------------------------------------------------- */
		var closeParentBtn = jQuery('.close-parent');


		closeParentBtn.click(function(e) {
				closeParent(this);
		});


		/* sf-with-ul */

		jQuery('.menu > ul li').each(function() {
				jQuery(this).has('ul').find('>a').addClass('sf-with-ul');
		});


		/* Icons Preview
		----------------------------------------------------------------*/

		var modalDiv = jQuery('#iconModal');

		jQuery('.the-icons li').click(function() {
				var name = jQuery(this).find('i').attr('class');

				modalDiv.find('i').each(function() {
						jQuery(this).attr('class', name);
				});

				modalDiv.find('#myModalLabel').text(name);

				modalDiv.modal();
		});

		jQuery('[rel="tooltip"]').tooltip();

		/* Woo
		-------------------------------------------------------------- */

		// Variations images changes

		jQuery('form.variations_form').on('found_variation', function(event, variation) {
						var variation_image = variation.image_src;
						var variation_link = variation.image_link;
						var variation_title = variation.image_title;


						if (variation_image !== '' && variation_link !== '') {

								if (jQuery('.product_image').hasClass('zoom-enabled')) {
										jQuery('a#zoom1').swinxyzoom('load', variation_image, variation_link);
										jQuery('a#zoom1').attr('href', variation_link);
										jQuery('.lightbox-btn').attr('href', variation_link);

										//$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
								} else {

										jQuery('a#zoom1').attr('href', variation_link);
										jQuery('a#zoom1 img').attr('src', variation_image);
										jQuery('.lightbox-btn').attr('href', variation_link);

										//$('.product-thumbnails-slider li:eq(0) img').attr('src', variation_image);
								}
						}

				})
				// Reset product image
				.on('reset_image', function(event) {

						var $product = jQuery(this).closest('.product');
						var $product_img = $product.find('div.product_image');

						var o_src = $product_img.attr('data-img');
						var o_href = $product_img.attr('data-original');


						if (o_src !== '' && o_href !== '') {

								if (jQuery('.product_image').hasClass('zoom-enabled')) {
										jQuery('a#zoom1').swinxyzoom('load', o_src, o_href);
										jQuery('a#zoom1').attr('href', o_href);
										jQuery('.lightbox-btn').attr('href', o_href);

								} else {

										jQuery('a#zoom1').attr('href', o_src);
										jQuery('a#zoom1 img').attr('src', o_src);
										jQuery('.lightbox-btn').attr('href', o_href);
								}
						}


				});


		// Ajax add to cart
		jQuery('.etheme-simple-product').live('click', function() {
				// AJAX add to cart request
				var $thisbutton = jQuery(this);

				if ($thisbutton.is('.etheme-simple-product, .product_type_downloadable, .product_type_virtual')) {

						showPopup();

						jQuery('#top-cart').addClass('updating');

						popupOverlay = jQuery('.etheme-popup-overlay');

						popupWindow = jQuery('.etheme-popup');

						formAction = jQuery('#simple-product-form').attr('action');

						var data = {
								quantity: jQuery('input[name=quantity]').val(),
								'add-to-cart': jQuery('input[name=add-to-cart]').val()
						};

						// Trigger event
						jQuery('body').trigger('adding_to_cart');

						// Ajax action
						jQuery.ajax({
								url: formAction,
								data: data,
								method: 'POST',
								timeout: 10000,
								dataType: 'text',
								success: function(data) {
										jQuery('.widget_shopping_cart').html(jQuery(data).find('.widget_shopping_cart').html());
										productImageSrc = jQuery('.main-image img').attr('src');
										productImage = '<img width="72" src="' + productImageSrc + '" />';
										productName = jQuery('.product-description-mainblock > h1').text();
										cartHref = jQuery('#top-cart > a').attr('href');
										popupHtml = productImage + '<em>' + productName + '</em> <br> ' + successfullyAdded2;
										popupWindow.find('.etheme-popup-content').css('backgroundImage', 'none').html(popupHtml);
										jQuery('.cont-shop').one('click', function() {
												hidePopup(popupOverlay, popupWindow);
										});
								},
								error: function(data) {
										popupWindow.find('.etheme-popup-content').css('backgroundImage', 'none').text('Something wrong');
								}
						});

						return false;

				} else {
						return true;
				}

		});


		// Ajax add to cart (on list page)
		jQuery('.etheme_add_to_cart_button').live('click', function() {

				// AJAX add to cart request
				var $thisbutton = jQuery(this);

				if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual')) {

						if (!$thisbutton.attr('data-product_id')) return true;

						$thisbutton.removeClass('added');
						$thisbutton.parent().parent().parent().parent().addClass('loading');
						$thisbutton.after('<div id="floatingCirclesG"></div>');

						var data = {
								action: 'woocommerce_add_to_cart',
								product_id: $thisbutton.attr('data-product_id'),
								quantity: $thisbutton.attr('data-quantity'),
						};

						// Trigger event
						jQuery('body').trigger('adding_to_cart', [$thisbutton, data]);

						// Ajax action
						jQuery.post(woocommerce_params.ajax_url, data, function(response) {

								if (!response)
										return;

								var this_page = window.location.toString();

								this_page = this_page.replace('add-to-cart', 'added-to-cart');

								if (response.error && response.product_url) {
										window.location = response.product_url;
										return;
								}

								// Redirect to cart option
								if (woocommerce_params.cart_redirect_after_add == 'yes') {

										window.location = woocommerce_params.cart_url;
										return;

								} else {

										$thisbutton.parent().find('#floatingCirclesG').remove();

										//fragments = response.fragments;
										cart_hash = response.cart_hash;


										jQuery('.widget_shopping_cart, .shop_table.cart, .updating, .cart_totals').fadeTo('400', '0.6').block({
												message: null,
												overlayCSS: {
														background: 'transparent url(' + woocommerce_params.ajax_loader_url + ') no-repeat center',
														opacity: 0.6
												}
										});
										// Changes button classes
										$thisbutton.addClass('added').parent().after('<p class="added-text bg-success">' + successfullyAdded + '</p>');

										setTimeout(function() {
												$thisbutton.parent().parent().removeClass('loading');
												// $thisbutton.removeClass('added');
												// jQuery('.added-text').fadeOut(300);
										}, 3000);


										// Unblock
										jQuery('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();

										if (jQuery('.widget_shopping_cart').size() > 0) {

												this_pageIe = AddUrlParameter(this_page, 'ei', (new Date()).getTime(), false);

												jQuery.get(this_pageIe, function(data) {
														var newCartHtml = jQuery(data).find('.widget_shopping_cart').html();
														jQuery('.widget_shopping_cart').html(newCartHtml);
												});


										}
								}
						});

						return false;

				} else {
						return true;
				}

		});

		/* Ajax Filter */

		function ajaxProductLoad(url, blockId) {
				jQuery.ajax({
						url: url,
						method: 'GET',
						timeout: 10000,
						dataType: 'text',
						success: function(data) {
								productLoaded(data, blockId);

						},
						error: function(data) {
								alert('Error loading ajax content!');
								window.location.reload();
						}
				});
		}

		function productLoaded(data, blockId) {

				//hide spinner
				jQuery('.grid_pagination_block').html(jQuery(data).find('.grid_pagination_block').html());
				for (var i = 0; i < blockId.length; i++) {
						jQuery(blockId[i]).html(jQuery(data).find(blockId[i]).html());
				}
				jQuery(blockId).html(jQuery(data).find(blockId).html());
				//jQuery('.sidebar_grid').html(jQuery(data).find('.sidebar_grid').html());
				jQuery('#default_products_page_container').html(jQuery(data).find('#default_products_page_container').html());
				jQuery('*').css({
						'cursor': 'auto'
				});
				jQuery('.product-grid').removeClass('loading').find('#floatingCirclesG').remove();

				productHover();
				check_view_mod();
				listSwitcher();

		}

		if (ajaxFilterEnabled == 1) {
				jQuery('.widget_layered_nav a, .grid_pagination_block .grid_pagination a').live('click', function(event) {
						var url = jQuery(this).attr('href');
						if (url === '') {
								url = jQuery(this).attr('value');
						}

						var blockId = [];

						jQuery('.widget_layered_nav').each(function() {
								blockId.push('#' + jQuery(this).attr('id'));
						});


						jQuery('*').css({
								'cursor': 'progress'
						});
						jQuery('#default_products_page_container .product-grid').addClass('loading').prepend('<div id="floatingCirclesG"></div>');

						ajaxProductLoad(url, blockId);
						event.stopPropagation();
						return false;
				});
		}

		/* Testimonials Gallery */

		jQuery('.testimonials-slider').cbpQTRotator();

		/* ----------------------------------------------------------------------------- */

		jQuery('.more-views-arrow').on("mousedown", function() {
				event.preventDefault();
		});


		jQuery('.cloud-zoom').click(function(e) {
				e.preventDefault();
		});

		/* Isotope */

		$portfolio = jQuery('.masonry');





		jQuery('.portfolio-filters a').click(function() {
				var selector = jQuery(this).attr('data-filter');
				jQuery('.portfolio-filters a').removeClass('selected');
				if (!jQuery(this).hasClass('selected')) {
						jQuery(this).addClass('selected');
				}
				$portfolio.isotope({
						filter: selector
				});
				return false;
		});


		setTimeout(function() {
				jQuery(window).resize();
		}, 500);

		setTimeout(function() {
				jQuery('.portfolio').addClass('with-transition');
				jQuery('.portfolio-item').addClass('with-transition');
		}, 1000);


		/* Load in view */

		var progressBars = jQuery('.progress-bar');

		progressBars.bind('inview', function(event, visible) {
				if (visible === true) {

						i = 0;
						progressBars.each(function() {
								i++;

								var el = jQuery(this);
								var width = jQuery(this).data('width');
								setTimeout(function() {
										el.find('div').animate({
												'width': width + '%'
										}, 300);
										el.find('span').css({
												'opacity': 1
										});
								}, i * 150, "easeOutCirc");

						});
				}
		});

		productHover();


}); // End Ready
/* Product Hover
-------------------------------------------------------------- */

function showPopup() {
		html = '<div class="etheme-popup-overlay"></div><div class="etheme-popup"><div class="etheme-popup-content"></div></div>';
		jQuery('body').prepend(html);
		popupOverlay = jQuery('.etheme-popup-overlay');
		popupWindow = jQuery('.etheme-popup');
		popupOverlay.one('click', function() {
				hidePopup(popupOverlay, popupWindow);
		});
}

function hidePopup(popupOverlay, popupWindow) {
		popupOverlay.fadeOut(400);
		popupWindow.fadeOut(400).html('');
}

function closeParent(el) {
		jQuery(el).parent().slideUp(100);
}

function productHover() {
		jQuery('.img-hided').hover(function() {
				if (window.innerWidth > 979) {
						jQuery(this).animate({
								'opacity': 1
						}, 200);
				}
		}, function() {
				if (window.innerWidth > 979) {
						jQuery(this).animate({
								'opacity': 0
						}, 200);
				}
		});
		imageTooltip(jQuery('.imageTooltip'));
}

function check_view_mod() {
		var activeClass = 'switcher-active';
		if (jQuery.cookie('products_page') == 'grid') {
				jQuery('#products-grid').removeClass('products-list').addClass('products-grid');
				jQuery('.switchToGrid').addClass(activeClass);
		} else if (jQuery.cookie('products_page') == 'list') {
				jQuery('#products-grid').removeClass('products-grid').addClass('products-list');
				jQuery('.switchToList').addClass(activeClass);
		} else {
				if (view_mode_default == 'list_grid' || view_mode_default == 'list') {
						jQuery('.switchToList').addClass(activeClass);
				} else {
						jQuery('.switchToGrid').addClass(activeClass);
				}
		}
}

function listSwitcher() {
		/* Listswitcher
		-------------------------------------------------------------- */
		var activeClass = 'switcher-active';
		var gridClass = 'products-grid';
		var listClass = 'products-list';
		jQuery('.switchToList').click(function() {
				if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid') {
						switchToList();
				}
		});
		jQuery('.switchToGrid').click(function() {
				if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list') {
						switchToGrid();
				}
		});

		function switchToList() {
				jQuery('.switchToList').addClass(activeClass);
				jQuery('.switchToGrid').removeClass(activeClass);
				jQuery('#products-grid').fadeOut(300, function() {
						jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
						jQuery.cookie('products_page', 'list');
				});
		}

		function switchToGrid() {
				jQuery('.switchToGrid').addClass(activeClass);
				jQuery('.switchToList').removeClass(activeClass);
				jQuery('#products-grid').fadeOut(300, function() {
						jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
						jQuery.cookie('products_page', 'grid');
				});
		}
}

function hideLightbox() {
		setTimeout(function() {
				jQuery('.pp_woocommerce').remove();
				jQuery('.pp_overlay').remove();
		}, 1);
}

function AddUrlParameter(sourceUrl, parameterName, parameterValue, replaceDuplicates) {
		if ((sourceUrl === null) || (sourceUrl.length === 0)) sourceUrl = document.location.href;
		var urlParts = sourceUrl.split("?");
		var newQueryString = "";
		if (urlParts.length > 1) {
				var parameters = urlParts[1].split("&");
				for (var i = 0;
						(i < parameters.length); i++) {
						var parameterParts = parameters[i].split("=");
						if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
								if (newQueryString === "")
										newQueryString = "?";
								else
										newQueryString += "&";
								newQueryString += parameterParts[0] + "=" + parameterParts[1];
						}
				}
		}
		if (newQueryString === "")
				newQueryString = "?";
		else
				newQueryString += "&";
		newQueryString += parameterName + "=" + parameterValue;

		return urlParts[0] + newQueryString;
}
