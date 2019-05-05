var woodmartThemeModule;
var wooFile = false;

(function ($) {
	"use strict";

	woodmartThemeModule = (function () {

		var woodmartTheme = {
			popupEffect: 'mfp-move-horizontal',
			bootstrapTooltips: '.woodmart-tooltip, .product-actions-btns > a, .wrapp-buttons .woodmart-buttons > div:not(.woodmart-add-btn) a, .wrapp-buttons .woodmart-buttons .woodmart-add-btn, body:not(.catalog-mode-on):not(.login-see-prices) .woodmart-hover-base:not(.product-in-carousel) .woodmart-buttons > div:not(.woodmart-add-btn) a, body:not(.catalog-mode-on):not(.login-see-prices) .woodmart-hover-base.hover-width-small:not(.product-in-carousel) .woodmart-add-btn, body:not(.catalog-mode-on):not(.login-see-prices) .woodmart-hover-base.add-small-button:not(.product-in-carousel) .woodmart-add-btn, .woodmart-hover-base .product-compare-button a',
		};

		return {

			init: function () {
				// Disable nanoscroller option
				woodmartTheme.disableNanoScrollerWebkit = woodmart_settings.disable_nanoscroller == 'webkit' && (jscd.browser == 'Chrome' || jscd.browser == 'Opera' || jscd.browser == 'Safari');

				this.headerBanner();

				this.headerBuilder()

				this.visibleElements();

				this.bannersHover();

				this.portfolioEffects();

				this.parallax();

				this.googleMap();

				this.scrollTop();

				this.sidebarMenu();

				this.widgetsHidable();

				this.stickyColumn();

				this.mfpPopup();

				this.blogMasonry();

				this.blogLoadMore();

				this.portfolioLoadMore();

				this.equalizeColumns();

				this.menuSetUp();

				this.menuOffsets();

				this.onePageMenu();

				this.mobileNavigation();

				this.simpleDropdown();

				this.promoPopup();

				this.contentPopup();

				this.cookiesPopup();

				this.btnsToolTips();

				this.stickyFooter();

				this.countDownTimer();

				this.nanoScroller();

				this.gradientShift();

				this.videoPoster();

				this.mobileSearchIcon();

				this.fullScreenMenu();

				this.searchFullScreen();

				this.wooInit();

				this.lazyLoading();

				this.ajaxSearch();

				this.photoswipeImages();

				this.stickySocialButtons();

				this.animationsOffset();

				this.hiddenSidebar();

				this.imageHotspot();

				this.woodSliderLazyLoad();

				this.owlCarouselInit();

				this.portfolioPhotoSwipe();

				this.woocommerceNotices();

				this.menuDropdownsAJAX();

				this.instagramAjaxQuery();

				this.footerWidgetsAccordion();

				$(window).resize();

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * WooCommerce init
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			wooInit: function () {
				if (!woodmart_settings.woo_installed) return;

				this.loginDropdown();

				this.loginSidebar();

				this.productLoaderPosition();

				this.initZoom();

				this.woocommerceWrappTable();

				this.woocommerceComments();

				this.onRemoveFromCart();

				this.woocommerceQuantity();

				this.updateWishListNumberInit();

				this.cartWidget();

				this.ajaxFilters();

				this.shopPageInit();

				this.filtersArea();

				this.categoriesMenu();

				this.headerCategoriesMenu();

				this.loginTabs();

				this.productVideo();

				this.product360Button();

				this.wishList();

				this.compare();

				this.woodmartCompare();

				this.productsLoadMore();

				this.productsTabs();

				this.swatchesVariations();

				this.swatchesOnGrid();

				this.quickViewInit();

				this.quickShop();

				this.addToCart();

				this.productAccordion();

				this.productImagesGallery();

				this.productImages();

				this.stickyDetails();

				this.stickyAddToCart();

				this.stickySidebarBtn();

			},

			footerWidgetsAccordion: function () {
				if ($(window).width() > 576) {
					return;
				}

				$('.footer-widget-collapse .widget-title').on('click', function () {
					var $title = $(this);
					var $widget = $title.parent();
					var $content = $widget.find('> *:not(.widget-title)');

					if ($widget.hasClass('footer-widget-opened')) {
						$widget.removeClass('footer-widget-opened');
						$content.stop().slideUp(200);
					} else {
						$widget.addClass('footer-widget-opened');
						$content.stop().slideDown(200);
					}
				});

			},

			instagramAjaxQuery: function () {
				$('.instagram-widget').each(function () {
					var $instagram = $(this);
					if (!$instagram.hasClass('instagram-with-error')) {
						return;
					}

					var username = $instagram.data('username');
					var atts = $instagram.data('atts');
					var request_param = username.indexOf('#') > -1 ? 'explore/tags/' + username.substr(1) : username;

					var url = 'https://www.instagram.com/' + request_param + '/';

					$instagram.addClass('loading');

					$.ajax({
						url: url,
						success: function (response) {
							$.ajax({
								url: woodmart_settings.ajaxurl,
								data: {
									action: 'woodmart_instagram_ajax_query',
									body: response,
									atts: atts,
								},
								dataType: 'json',
								method: 'POST',
								success: function (response) {
									$instagram.parent().html(response);
									woodmartThemeModule.owlCarouselInit();
								},
								error: function (data) {
									console.log('instagram ajax error');
								},
							});
						},
						error: function (data) {
							console.log('instagram ajax error');
						},
					});

				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Menu dropdowns AJAX
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			menuDropdownsAJAX: function () {
				var $menus = jQuery('.menu').has('.dropdown-load-ajax');

				jQuery('body').on('mousemove', checkMenuProximity);

				function checkMenuProximity(event) {

					$menus.each(function () {
						var $menu = jQuery(this);

						if ($menu.hasClass('dropdowns-loading') || $menu.hasClass('dropdowns-loaded')) return;

						if (!isNear($menu, 50, event)) return;

						loadDropdowns($menu);

					});
				}

				function loadDropdowns($menu) {
					$menu.addClass('dropdowns-loading');

					var $items = $menu.find('.dropdown-load-ajax'),
						ids = [];

					$items.each(function () {
						ids.push(jQuery(this).find('.dropdown-html-placeholder').data('id'));
					});

					jQuery.ajax({
						url: woodmart_settings.ajaxurl,
						data: {
							action: 'woodmart_load_html_dropdowns',
							ids: ids,
						},
						dataType: 'json',
						method: 'POST',
						success: function (response) {

							if (response.status == 'success') {
								Object.keys(response.data).forEach(function (id) {
									var html = response.data[id];
									$menu.find('[data-id="' + id + '"]').replaceWith(html);
								});

								// Initialize OWL Carousels
								woodmartThemeModule.owlCarouselInit();

							} else {
								console.log('loading html dropdowns returns wrong data - ', response.message);
							}
						},
						error: function (data) {
							console.log('loading html dropdowns ajax error');
						},
						complete: function () {
							$menu.removeClass('dropdowns-loading').addClass('dropdowns-loaded');
						},
					});
				}

				function isNear($element, distance, event) {

					var left = $element.offset().left - distance,
						top = $element.offset().top - distance,
						right = left + $element.width() + (2 * distance),
						bottom = top + $element.height() + (2 * distance),
						x = event.pageX,
						y = event.pageY;

					return (x > left && x < right && y > top && y < bottom);

				};
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * WooCommerce pretty notices
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			woocommerceNotices: function () {
				var notices = '.woocommerce-error, .woocommerce-info, .woocommerce-message, div.wpcf7-response-output, #yith-wcwl-popup-message, .mc4wp-alert, .dokan-store-contact .alert-success, .yith_ywraq_add_item_product_message';

				$('body').on('click', notices, function () {
					var $msg = $(this);
					hideMessage($msg);
				});

				var showAllMessages = function () {
					$notices.addClass('shown-notice');
				};

				var hideAllMessages = function () {
					hideMessage($notices);
				};

				var hideMessage = function ($msg) {
					$msg.removeClass('shown-notice').addClass('hidden-notice');
				};
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Portfolio photo swipe
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			portfolioPhotoSwipe: function () {
				$(document).on('click', '.portfolio-enlarge', function (e) {
					e.preventDefault();
					var $parent = $(this).parents('.owl-item');
					if ($parent.length == 0) {
						$parent = $(this).parents('.portfolio-entry');
					}
					var index = $parent.index();
					var items = getPortfolioImages();
					woodmartThemeModule.callPhotoSwipe(index, items);
				});

				var getPortfolioImages = function () {
					var items = [];
					$('.portfolio-entry').find('figure a img').each(function () {
						items.push({
							src: $(this).attr('src'),
							w: $(this).attr('width'),
							h: $(this).attr('height')
						});
					});
					return items;
				};
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Owl carousel init function
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			owlCarouselInit: function () {
				$(document).on('FrontendEditorCarouselInit', function (event, $element) {
					owlInit($element);
				});

				$('div[data-owl-carousel]:not(.scroll-init)').each(function () {
					owlInit($(this));
				});

				if (typeof ($.fn.waypoint) != 'undefined') {
					$('div[data-owl-carousel].scroll-init').waypoint(function () {
						owlInit($(this));
					}, {
							offset: '100%'
						});
				}

				function owlInit($this) {
					var $owl = $this.find('.owl-carousel');

					if ($(window).width() <= 1024 && $this.hasClass('disable-owl-mobile') || $owl.hasClass('owl-loaded')) {
						return;
					}

					var options = {
						rtl: $('body').hasClass('rtl'),
						items: $this.data('desktop') ? $this.data('desktop') : 1,
						responsive: {
							1025: {
								items: $this.data('desktop') ? $this.data('desktop') : 1
							},
							769: {
								items: $this.data('tablet_landscape') ? $this.data('tablet_landscape') : 1
							},
							577: {
								items: $this.data('tablet') ? $this.data('tablet') : 1
							},
							0: {
								items: $this.data('mobile') ? $this.data('mobile') : 1
							}
						},
						autoplay: $this.data('autoplay') == 'yes' ? true : false,
						autoplayHoverPause: $this.data('autoplay' == 'yes') ? true : false,
						autoplayTimeout: $this.data('speed') ? $this.data('speed') : 5000,
						dots: $this.data('hide_pagination_control') == 'yes' ? false : true,
						nav: $this.data('hide_prev_next_buttons') == 'yes' ? false : true,
						autoHeight: $this.data('autoheight') == 'yes' ? true : false,
						slideBy: $this.data('scroll_per_page') == 'yes' ? 'page' : 1,
						navText: false,
						center: $this.data('center_mode') == 'yes' ? true : false,
						loop: $this.data('wrap') == 'yes' ? true : false,
						dragEndSpeed: $this.data('dragendspeed') ? $this.data('dragendspeed') : 200,
						onRefreshed: function () {
							$(window).resize();
						}
					};

					if ($this.data('sliding_speed')) {
						options.smartSpeed = $this.data('sliding_speed');
						options.dragEndSpeed = $this.data('sliding_speed');
					}

					if ($this.data('animation')) {
						options.animateOut = $this.data('animation');
						options.mouseDrag = false;
					}

					if ($this.data('content_animation')) {
						function determinePseudoActive() {
							var id = $owl.find('.owl-item.active').find('.woodmart-slide').attr('id');
							$owl.find('.owl-item.pseudo-active').removeClass('pseudo-active');
							var $els = $owl.find('[id="' + id + '"]');
							$els.each(function () {
								if (!$(this).parent().hasClass('active')) {
									$(this).parent().addClass('pseudo-active');
								}
							});
						}
						determinePseudoActive();
						options.onTranslated = function () {
							determinePseudoActive();
						};
					}

					$(window).on('vc_js', function () {
						$owl.trigger('refresh.owl.carousel');
					});

					$owl.owlCarousel(options);

					if ($this.data('autoheight') == 'yes') {
						$owl.imagesLoaded(function () {
							$owl.trigger('refresh.owl.carousel');
						});
					}
				}
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Woodmart slider lazyload
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			woodSliderLazyLoad: function () {
				$('.woodmart-slider').on('changed.owl.carousel', function (event) {
					var $this = $(this);
					var active = $this.find('.owl-item').eq(event.item.index);
					var id = active.find('.woodmart-slide').attr('id');
					var $els = $this.find('[id="' + id + '"]');

					active.find('.woodmart-slide').addClass('woodmart-loaded');
					$els.each(function () {
						$(this).addClass('woodmart-loaded');
					});
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Image hotspot
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			imageHotspot: function () {
				//Hotspot action
				$('.woodmart-image-hotspot').each(function () {
					var _this = $(this);
					var btn = _this.find('.hotspot-btn');
					// var content = _this.find('.hotspot-content');
					var parentWrapper = _this.parents('.woodmart-image-hotspot-wrapper');

					if (!parentWrapper.hasClass('hotspot-action-click') && $(window).width() > 1024) return;

					btn.on('click', function () {
						if (_this.hasClass('hotspot-opened')) {
							_this.removeClass('hotspot-opened');
						} else {
							_this.addClass('hotspot-opened');
							_this.siblings().removeClass('hotspot-opened');
						}
						$(document).trigger('wood-images-loaded');
						return false;
					});

					$(document).on('click', function (e) {
						var target = e.target;
						if (_this.hasClass('hotspot-opened') && !$(target).is('.woodmart-image-hotspot') && !$(target).parents().is('.woodmart-image-hotspot')) {
							_this.removeClass('hotspot-opened');
							return false;
						}
					});
				});

				//Image loaded
				$('.woodmart-image-hotspot-wrapper').each(function () {
					var _this = $(this);
					_this.imagesLoaded(function () {
						_this.addClass('loaded');
					});
				});

				//Content position
				$('.woodmart-image-hotspot .hotspot-content').each(function () {
					var content = $(this);
					var offsetLeft = content.offset().left;
					var offsetRight = $(window).width() - (offsetLeft + content.outerWidth());

					if ($(window).width() > 768) {
						if (offsetLeft <= 0) content.addClass('hotspot-overflow-right');
						if (offsetRight <= 0) content.addClass('hotspot-overflow-left');
					}

					if ($(window).width() <= 768) {
						if (offsetLeft <= 0) content.css('marginLeft', Math.abs(offsetLeft - 15) + 'px');
						if (offsetRight <= 0) content.css('marginLeft', offsetRight - 15 + 'px');
					}
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Hidden sidebar button
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			hiddenSidebar: function () {
				$('body').on('click', '.woodmart-show-sidebar-btn, .woodmart-sticky-sidebar-opener', function (e) {
					e.preventDefault();
					if ($('.sidebar-container').hasClass('show-hidden-sidebar')) {
						woodmartThemeModule.hideShopSidebar();
					} else {
						showSidebar();
					}
				});

				$('body').on("click touchstart", ".woodmart-close-side, .close-side-widget", function () {
					woodmartThemeModule.hideShopSidebar();
				});

				var showSidebar = function () {
					$('.sidebar-container').addClass('show-hidden-sidebar');
					$('.woodmart-close-side').addClass('woodmart-close-side-opened');
					$('.woodmart-show-sidebar-btn').addClass('btn-clicked');

					if ($(window).width() >= 1024 && (!woodmartTheme.disableNanoScrollerWebkit && woodmart_settings.disable_nanoscroller != 'disable')) {
						$(".sidebar-inner.woodmart-sidebar-scroll").nanoScroller({
							paneClass: 'woodmart-scroll-pane',
							sliderClass: 'woodmart-scroll-slider',
							contentClass: 'woodmart-sidebar-content',
							preventPageScrolling: false
						});
					}
				};
			},

			hideShopSidebar: function () {
				$('.woodmart-show-sidebar-btn').removeClass('btn-clicked');
				$('.sidebar-container').removeClass('show-hidden-sidebar');
				$('.woodmart-close-side').removeClass('woodmart-close-side-opened');
				if (!woodmartTheme.disableNanoScrollerWebkit && woodmart_settings.disable_nanoscroller != 'disable') {
					$('.sidebar-inner.woodmart-scroll').nanoScroller({ destroy: true });
				}
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Css animations offset
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			animationsOffset: function () {
				if (typeof ($.fn.waypoint) == 'undefined') return;

				$('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
					$(this).addClass('wpb_start_animation animated')
				}, {
						offset: '100%'
					});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Social buttons class on load
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			stickySocialButtons: function () {
				$('.woodmart-sticky-social').addClass('buttons-loaded');
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Photoswipe gallery
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			photoswipeImages: function () {
				$('.photoswipe-images').each(function () {
					var $this = $(this);
					$this.on('click', 'a', function (e) {
						e.preventDefault();
						var index = $(e.currentTarget).data('index') - 1;
						var items = getGalleryItems($this, []);
						woodmartThemeModule.callPhotoSwipe(index, items);
					});
				});

				var getGalleryItems = function ($gallery, items) {
					var src, width, height, title;

					$gallery.find('a').each(function () {
						src = $(this).attr('href');
						width = $(this).data('width');
						height = $(this).data('height');
						title = $(this).attr('title');
						if (!isItemInArray(items, src)) {
							items.push({
								src: src,
								w: width,
								h: height,
								title: title
							});
						}
					});

					return items;
				};

				var isItemInArray = function (items, src) {
					var i;
					for (i = 0; i < items.length; i++) {
						if (items[i].src == src) {
							return true;
						}
					}

					return false;
				};
			},

			callPhotoSwipe: function (index, items) {
				var pswpElement = document.querySelectorAll('.pswp')[0];

				if ($('body').hasClass('rtl')) {
					index = items.length - index - 1;
					items = items.reverse();
				}

				// define options (if needed)
				var options = {
					// optionName: 'option value'
					// for example:
					index: index, // start at first slide
					shareButtons: [
						{ id: 'facebook', label: woodmart_settings.share_fb, url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}' },
						{ id: 'twitter', label: woodmart_settings.tweet, url: 'https://twitter.com/intent/tweet?text={{text}}&url={{url}}' },
						{
							id: 'pinterest', label: woodmart_settings.pin_it, url: 'http://www.pinterest.com/pin/create/button/' +
								'?url={{url}}&media={{image_url}}&description={{text}}'
						},
						{ id: 'download', label: woodmart_settings.download_image, url: '{{raw_image_url}}', download: true }
					],
					// getThumbBoundsFn: function(index) {

					//     // get window scroll Y
					//     var pageYScroll = window.pageYOffset || document.documentElement.scrollTop; 
					//     // optionally get horizontal scroll

					//     // get position of element relative to viewport
					//     var rect = $target.offset(); 

					//     // w = width
					//     return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};


					// }
				};

				// Initializes and opens PhotoSwipe
				var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
				gallery.init();
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Header banner
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			headerBanner: function () {
				var banner_version = woodmart_settings.header_banner_version,
					banner_btn = woodmart_settings.header_banner_close_btn,
					banner_enabled = woodmart_settings.header_banner_enabled;
				if (Cookies.get('woodmart_tb_banner_' + banner_version) == 'closed' || banner_btn == false || banner_enabled == false) return;
				var banner = $('.header-banner');

				if (!$('body').hasClass('page-template-maintenance')) {
					$('body').addClass('header-banner-display');
				}

				banner.on('click', '.close-header-banner', function (e) {
					e.preventDefault();
					closeBanner();
				})

				var closeBanner = function () {
					$('body').removeClass('header-banner-display').addClass('header-banner-hide');
					Cookies.set('woodmart_tb_banner_' + banner_version, 'closed', { expires: 60, path: '/' });
				};

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Full screen menu
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			fullScreenMenu: function () {
				$('.full-screen-burger-icon').on('click', function () {
					$('body').toggleClass('full-screen-menu-open');
				});

				$(document).keyup(function (e) {
					if (e.keyCode === 27) $('.full-screen-close-icon').click();
				});

				$('.full-screen-close-icon').on('click', function () {
					$('body').removeClass('full-screen-menu-open');
					setTimeout(function () {
						$('.full-screen-nav .menu-item-has-children').removeClass('sub-menu-open');
						$('.full-screen-nav .menu-item-has-children .icon-sub-fs').removeClass('up-icon');
					}, 200)
				});

				$('.full-screen-nav .menu > .menu-item.menu-item-has-children, .full-screen-nav .menu-item-design-default.menu-item-has-children .menu-item-has-children').append('<span class="icon-sub-fs"></span>');

				$('.full-screen-nav').on('click', '.icon-sub-fs', function (e) {
					var $icon = $(this),
						$parentItem = $icon.parent();

					e.preventDefault();
					if ($parentItem.hasClass('sub-menu-open')) {
						$parentItem.removeClass('sub-menu-open');
						$icon.removeClass('up-icon');
					} else {
						$parentItem.siblings('.sub-menu-open').find('.icon-sub-fs').removeClass('up-icon');
						$parentItem.siblings('.sub-menu-open').removeClass('sub-menu-open');
						$parentItem.addClass('sub-menu-open');
						$icon.addClass('up-icon');
					}
				});
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Mobile search icon 
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			mobileSearchIcon: function () {
				$('.mobile-search-icon.search-button').on('click', function (e) {
					e.preventDefault();
					if (!$('.mobile-nav').hasClass('act-mobile-menu')) {
						$('.mobile-nav').addClass('act-mobile-menu');
						$('.woodmart-close-side').addClass('woodmart-close-side-opened');
						$('.mobile-nav .searchform').find('input[type="text"]').focus();
					}
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Video Poster
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			videoPoster: function () {
				$('.woodmart-video-poster-wrapper').on('click', function () {
					var videoWrapper = $(this),
						video = videoWrapper.parent().find('iframe'),
						videoScr = video.attr('src'),
						videoNewSrc = videoScr + '&autoplay=1';

					if (videoScr.indexOf('vimeo.com') + 1) {
						videoNewSrc = videoScr + '?autoplay=1';
					}
					video.attr('src', videoNewSrc);
					videoWrapper.addClass('hidden-poster');
				})
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Header builder scripts for sticky header 
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			headerBuilder: function () {
				var $header = $('.whb-header'),
					$stickyElements = $('.whb-sticky-row'),
					$firstSticky = '',
					headerHeight = $header.find('.whb-main-header').outerHeight(),
					$window = $(window),
					isSticked = false,
					adminBarHeight = $('#wpadminbar').outerHeight(),
					stickAfter = 300,
					cloneHTML = '',
					isHideOnScroll = $header.hasClass('whb-hide-on-scroll');

				$stickyElements.each(function () {
					if ($(this).outerHeight() > 10) {
						$firstSticky = $(this);
						return false;
					}
				});


				// Real header sticky option
				if ($header.hasClass('whb-sticky-real')) {

					// if no sticky rows
					if ($firstSticky.length == 0 || $firstSticky.outerHeight() < 10) return;

					$header.addClass('whb-sticky-prepared').css({
						paddingTop: headerHeight
					})

					stickAfter = $firstSticky.offset().top - adminBarHeight
				}


				// Sticky header clone 

				if ($header.hasClass('whb-sticky-clone')) {
					var data = []
					data['cloneClass'] = $header.find('.whb-general-header').attr('class')

					if (isHideOnScroll) {
						data['wrapperClasses'] = 'whb-hide-on-scroll';
					}

					cloneHTML = woodmart_settings.whb_header_clone

					cloneHTML = cloneHTML.replace(/<%([^%>]+)?%>/g, function (replacement) {
						var selector = replacement.slice(2, -2)

						return $header.find(selector).length
							? $('<div>')
								.append($header.find(selector).first().clone())
								.html()
							: (data[selector] !== undefined) ? data[selector] : ''
					})

					$header.after(cloneHTML)
					$header = $header.parent().find('.whb-clone')

					$header.find('.whb-row').removeClass('whb-flex-equal-sides').addClass('whb-flex-flex-middle');
				}

				if ($('.whb-header').hasClass('whb-scroll-slide')) {
					stickAfter = headerHeight + adminBarHeight
				}

				var previousScroll;

				$window.on('scroll', function () {
					var after = stickAfter;
					var currentScroll = $(window).scrollTop();
					var windowHeight = $(window).height();
					var documentHeight = $(document).height();
					if ($('.header-banner').length > 0 && $('body').hasClass('header-banner-display')) {
						after += $('.header-banner').outerHeight();
					}

					if (!$('.close-header-banner').length && $header.hasClass('whb-scroll-stick')) {
						after = stickAfter
					}

					if (currentScroll > after) {
						stickHeader();
					} else {
						unstickHeader();
					}

					var startAfter = 100;

					if ($header.hasClass('whb-scroll-stick')) {
						startAfter = 500;
					}

					if (isHideOnScroll) {
						if (previousScroll - currentScroll > 0 && currentScroll > after ) {
							$header.addClass('whb-scroll-up');
							$header.removeClass('whb-scroll-down');
						} else if (currentScroll - previousScroll > 0 && currentScroll + windowHeight != documentHeight && currentScroll > (after + startAfter)) {
							$header.addClass('whb-scroll-down');
							$header.removeClass('whb-scroll-up');
						} else if (currentScroll <= after) {
							$header.removeClass('whb-scroll-down');
							$header.removeClass('whb-scroll-up');
						} else if (currentScroll + windowHeight >= documentHeight - 5) {
							$header.addClass('whb-scroll-up');
							$header.removeClass('whb-scroll-down');
						}
					}

					previousScroll = currentScroll;
				});

				function stickHeader() {
					if (isSticked) return
					isSticked = true
					$header.addClass('whb-sticked')
				}

				function unstickHeader() {
					if (!isSticked) return

					isSticked = false
					$header.removeClass('whb-sticked')
				}
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Counter shortcode method
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			counterShortcode: function (counter) {
				if (counter.attr('data-state') == 'done' || counter.text() != counter.data('final')) {
					return;
				}
				counter.prop('Counter', 0).animate({
					Counter: counter.text()
				}, {
						duration: 3000,
						easing: 'swing',
						step: function (now) {
							if (now >= counter.data('final')) {
								counter.attr('data-state', 'done');
							}
							counter.text(Math.ceil(now));
						}
					});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Activate methods in viewport
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			visibleElements: function () {

				$('.woodmart-counter .counter-value').each(function () {
					$(this).waypoint(function () {
						woodmartThemeModule.counterShortcode($(this));
					}, { offset: '100%' });
				});

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Banner hover effect with jquery panr
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			bannersHover: function () {
				if (typeof ($.fn.panr) == 'undefined') return;
				$('.promo-banner.banner-hover-parallax').panr({
					sensitivity: 20,
					scale: false,
					scaleOnHover: true,
					scaleTo: 1.15,
					scaleDuration: .34,
					panY: true,
					panX: true,
					panDuration: 0.5,
					resetPanOnMouseLeave: true
				});
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Portfolio hover effects
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			portfolioEffects: function () {
				if (typeof ($.fn.panr) == 'undefined') return;
				$('.woodmart-portfolio-holder .portfolio-parallax').panr({
					sensitivity: 15,
					scale: false,
					scaleOnHover: true,
					scaleTo: 1.12,
					scaleDuration: 0.45,
					panY: true,
					panX: true,
					panDuration: 1.5,
					resetPanOnMouseLeave: true
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Promo popup
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			promoPopup: function () {
				var promo_version = woodmart_settings.promo_version;

				if ($('body').hasClass('page-template-maintenance') || woodmart_settings.enable_popup != 'yes' || (woodmart_settings.promo_popup_hide_mobile == 'yes' && $(window).width() < 768)) return;

				var popup = $('.woodmart-promo-popup'),
					shown = false,
					pages = Cookies.get('woodmart_shown_pages');

				var showPopup = function () {
					$.magnificPopup.open({
						items: {
							src: '.woodmart-promo-popup'
						},
						type: 'inline',
						removalDelay: 500, //delay removal by X to allow out-animation
						tClose: woodmart_settings.close,
						tLoading: woodmart_settings.loading,
						callbacks: {
							beforeOpen: function () {
								this.st.mainClass = woodmartTheme.popupEffect + ' promo-popup-wrapper';
							},
							open: function () {
								// Will fire when this exact popup is opened
								// this - is Magnific Popup object
							},
							close: function () {
								Cookies.set('woodmart_popup_' + promo_version, 'shown', { expires: 7, path: '/' });
							}
							// e.t.c.
						}
					});
					$(document).trigger('wood-images-loaded');
				};

				$('.woodmart-open-newsletter').on('click', function (e) {
					e.preventDefault();
					showPopup();
				})

				if (!pages) pages = 0;

				if (pages < woodmart_settings.popup_pages) {
					pages++;
					Cookies.set('woodmart_shown_pages', pages, { expires: 7, path: '/' });
					return false;
				}

				if (Cookies.get('woodmart_popup_' + promo_version) != 'shown') {
					if (woodmart_settings.popup_event == 'scroll') {
						$(window).scroll(function () {
							if (shown) return false;
							if ($(document).scrollTop() >= woodmart_settings.popup_scroll) {
								showPopup();
								shown = true;
							}
						});
					} else {
						setTimeout(function () {
							showPopup();
						}, woodmart_settings.popup_delay);
					}
				}


			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Content in popup element
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			contentPopup: function () {
				var popup = $('.woodmart-open-popup');

				popup.magnificPopup({
					type: 'inline',
					removalDelay: 500, //delay removal by X to allow out-animation
					tClose: woodmart_settings.close,
					tLoading: woodmart_settings.loading,
					callbacks: {
						beforeOpen: function () {
							this.st.mainClass = woodmartTheme.popupEffect + ' content-popup-wrapper';
						},

						open: function () {
							$(document).trigger('wood-images-loaded');
						}
					}
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Cookies law
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			cookiesPopup: function () {
				var cookies_version = woodmart_settings.cookies_version;
				if (Cookies.get('woodmart_cookies_' + cookies_version) == 'accepted') return;
				var popup = $('.woodmart-cookies-popup');

				setTimeout(function () {
					popup.addClass('popup-display');
					popup.on('click', '.cookies-accept-btn', function (e) {
						e.preventDefault();
						acceptCookies();
					})
				}, 2500);

				var acceptCookies = function () {
					popup.removeClass('popup-display').addClass('popup-hide');
					Cookies.set('woodmart_cookies_' + cookies_version, 'accepted', { expires: 60, path: '/' });
				};
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Google map
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			googleMap: function () {
				var gmap = $(".google-map-container-with-content");

				$(window).resize(function () {
					gmap.css({
						'height': gmap.find('.woodmart-google-map.with-content').outerHeight()
					})
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Menu preparation
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			menuSetUp: function () {
				var hasChildClass = 'menu-item-has-children',
					mainMenu = $('.woodmart-navigation').find('ul.menu'),
					lis = mainMenu.find(' > li'),
					openedClass = 'item-menu-opened';

				$('.mobile-nav').find('ul.site-mobile-menu').find(' > li').has('.sub-menu-dropdown').addClass(hasChildClass);

				mainMenu.on('click', ' > .item-event-click > a', function (e) {
					e.preventDefault();
					if (!$(this).parent().hasClass(openedClass)) {
						$('.' + openedClass).removeClass(openedClass);
					}
					$(this).parent().toggleClass(openedClass);
				});

				$(document).on('click', function (e) {
					var target = e.target;
					if ($('.' + openedClass).length > 0 && !$(target).is('.item-event-hover') && !$(target).parents().is('.item-event-hover') && !$(target).parents().is('.' + openedClass + '')) {
						mainMenu.find('.' + openedClass + '').removeClass(openedClass);
						return false;
					}
				});

				var menuForIPad = function () {
					if ($(window).width() <= 1024) {
						mainMenu.find(' > .menu-item-has-children.item-event-hover').each(function () {
							$(this).data('original-event', 'hover').removeClass('item-event-hover').addClass('item-event-click');
						});
					} else {
						mainMenu.find(' > .item-event-click').each(function () {
							if ($(this).data('original-event') == 'hover') {
								$(this).removeClass('item-event-click').addClass('item-event-hover');
							}
						});
					}
				};

				$(window).on('resize', menuForIPad);
			},
			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Keep navigation dropdowns in the screen
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			menuOffsets: function () {

				var mainMenu = $('.main-nav, .whb-secondary-menu').find('ul.menu'),
					lis = mainMenu.find(' > li.menu-item-design-sized, li.menu-item-design-full-width');


				mainMenu.on('hover', ' > li.menu-item-design-sized, li.menu-item-design-full-width', function (e) {
					setOffset($(this));
				});

				var setOffset = function (li) {

					var dropdown = li.find(' > .sub-menu-dropdown'),
						styleID = 'arrow-offset',
						siteWrapper = $('.website-wrapper');

					dropdown.attr('style', '');

					var dropdownWidth = dropdown.outerWidth(),
						dropdownOffset = dropdown.offset(),
						screenWidth = $(window).width(),
						bodyRight = siteWrapper.outerWidth() + siteWrapper.offset().left,
						viewportWidth = $('body').hasClass('wrapper-boxed') || $('body').hasClass('wrapper-boxed-2') ? bodyRight : screenWidth,
						extraSpace = (li.hasClass('menu-item-design-full-width')) ? 0 : 10;

					if (!dropdownWidth || !dropdownOffset) return;

					var dropdownOffsetRight = screenWidth - dropdownOffset.left - dropdownWidth;

					if ($('body').hasClass('rtl') && dropdownOffsetRight + dropdownWidth >= viewportWidth && (li.hasClass('menu-item-design-sized') || li.hasClass('menu-item-design-full-width'))) {
						// If right point is not in the viewport
						var toLeft = dropdownOffsetRight + dropdownWidth - viewportWidth;

						dropdown.css({
							right: - toLeft - extraSpace
						});

					} else if (dropdownOffset.left + dropdownWidth >= viewportWidth && (li.hasClass('menu-item-design-sized') || li.hasClass('menu-item-design-full-width'))) {
						// If right point is not in the viewport
						var toRight = dropdownOffset.left + dropdownWidth - viewportWidth;

						dropdown.css({
							left: - toRight - extraSpace
						});
					}

				};

				lis.each(function () {
					setOffset($(this));
					$(this).addClass('with-offsets');
				});
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * One page menu
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			onePageMenu: function () {

				var scrollToRow = function (hash) {
					var row = $('#' + hash);

					if (row.length < 1) return;

					var position = row.offset().top;

					$('html, body').animate({
						scrollTop: position - woodmart_settings.one_page_menu_offset
					}, 800);

					setTimeout(function () {
						activeMenuItem(hash);
					}, 800);
				};

				var activeMenuItem = function (hash) {
					var itemHash;
					$('.onepage-link').each(function () {
						itemHash = $(this).find('> a').attr('href').split('#')[1];

						if (itemHash == hash) {
							$('.onepage-link').removeClass('current-menu-item');
							$(this).addClass('current-menu-item');
						}

					});
				};

				$('body').on('click', '.onepage-link > a', function (e) {
					var $this = $(this),
						hash = $this.attr('href').split('#')[1];

					if ($('#' + hash).length < 1) return;

					e.preventDefault();

					scrollToRow(hash);

					// close mobile menu
					$('.woodmart-close-side').trigger('click');
				});

				if ($('.onepage-link').length > 0) {
					$('.entry-content > .vc_section, .entry-content > .vc_row').waypoint(function () {
						var hash = $(this).attr('id');
						activeMenuItem(hash);
					}, { offset: 150 });

					// $('.onepage-link').removeClass('current-menu-item');

					// URL contains hash
					var locationHash = window.location.hash.split('#')[1];

					if (window.location.hash.length > 1) {
						setTimeout(function () {
							scrollToRow(locationHash);
						}, 500);
					}

				}
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * mobile responsive navigation
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */

			mobileNavigation: function () {

				var body = $("body"),
					mobileNav = $(".mobile-nav"),
					wrapperSite = $(".website-wrapper"),
					dropDownCat = $(".mobile-nav .site-mobile-menu .menu-item-has-children"),
					elementIcon = '<span class="icon-sub-menu"></span>',
					butOpener = $(".icon-sub-menu");

				var closeSide = $('.woodmart-close-side');

				dropDownCat.append(elementIcon);

				mobileNav.on("click", ".icon-sub-menu", function (e) {
					e.preventDefault();

					if ($(this).parent().hasClass("opener-page")) {
						$(this).parent().removeClass("opener-page").find("> ul").slideUp(200);
						$(this).parent().removeClass("opener-page").find(".sub-menu-dropdown .container > ul, .sub-menu-dropdown > ul").slideUp(200);
						$(this).parent().find('> .icon-sub-menu').removeClass("up-icon");
					} else {
						$(this).parent().addClass("opener-page").find("> ul").slideDown(200);
						$(this).parent().addClass("opener-page").find(".sub-menu-dropdown .container > ul, .sub-menu-dropdown > ul").slideDown(200);
						$(this).parent().find('> .icon-sub-menu').addClass("up-icon");
					}
				});

				mobileNav.on('click', '.mobile-nav-tabs li', function () {
					if ($(this).hasClass('active')) return;
					var menuName = $(this).data('menu');
					$(this).parent().find('.active').removeClass('active');
					$(this).addClass('active');
					$('.mobile-menu-tab').removeClass('active');
					$('.mobile-' + menuName + '-menu').addClass('active');
				});

				body.on("click", ".mobile-nav-icon", function () {

					if (mobileNav.hasClass("act-mobile-menu")) {
						closeMenu();
					} else {
						openMenu();
					}

				});

				body.on("click touchstart", ".woodmart-close-side", function () {
					closeMenu();
				});

				body.on('click', '.mobile-nav .login-side-opener', function () {
					closeMenu();
				});

				function openMenu() {
					mobileNav.addClass("act-mobile-menu");
					closeSide.addClass('woodmart-close-side-opened');
				}

				function closeMenu() {
					mobileNav.removeClass("act-mobile-menu");
					closeSide.removeClass('woodmart-close-side-opened');
					$('.mobile-nav .searchform input[type=text]').blur();
				}
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Simple dropdown for category select on search form
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			simpleDropdown: function () {

				$('.input-dropdown-inner').each(function () {
					var dd = $(this);
					var btn = dd.find('> a');
					var input = dd.find('> input');
					var list = dd.find('> .list-wrapper');

					inputPadding();

					$(document).on('click', function (e) {
						var target = e.target;
						if (dd.hasClass('dd-shown') && !$(target).is('.input-dropdown-inner') && !$(target).parents().is('.input-dropdown-inner')) {
							hideList();
							return false;
						}
					});

					btn.on('click', function (e) {
						e.preventDefault();

						if (dd.hasClass('dd-shown')) {
							hideList();
						} else {
							showList();
						}
						return false;
					});

					list.on('click', 'a', function (e) {
						e.preventDefault();
						var value = $(this).data('val');
						var label = $(this).text();
						list.find('.current-item').removeClass('current-item');
						$(this).parent().addClass('current-item');
						if (value != 0) {
							list.find('ul:not(.children) > li:first-child').show();
						} else if (value == 0) {
							list.find('ul:not(.children) > li:first-child').hide();
						}
						btn.text(label);
						input.val(value).trigger('cat_selected');
						hideList();
						inputPadding();
					});


					function showList() {
						dd.addClass('dd-shown');
						list.slideDown(100);
						if (typeof ($.fn.devbridgeAutocomplete) != 'undefined') {
							dd.parent().siblings('[type="text"]').devbridgeAutocomplete('hide');
						}
						setTimeout(function () {
							woodmartThemeModule.nanoScroller();
						}, 300);
					}

					function hideList() {
						dd.removeClass('dd-shown');
						list.slideUp(100);
					}

					function inputPadding() {
						if ($(window).width() <= 768) return;
						var paddingValue = dd.innerWidth() + dd.parent().siblings('.searchsubmit').innerWidth() + 17,
							padding = 'padding-right';
						if ($('body').hasClass('rtl')) padding = 'padding-left';

						dd.parent().parent().find('.s').css(padding, paddingValue);
					}
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Function to make columns the same height
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			equalizeColumns: function () {

				$.fn.woodmart_equlize = function (options) {

					var settings = $.extend({
						child: "",
					}, options);

					var that = this;

					if (settings.child != '') {
						that = this.find(settings.child);
					}

					var resize = function () {

						var maxHeight = 0;
						var height;
						that.each(function () {
							$(this).attr('style', '');
							if ($(window).width() > 767 && $(this).outerHeight() > maxHeight)
								maxHeight = $(this).outerHeight();
						});

						that.each(function () {
							$(this).css({
								minHeight: maxHeight
							});
						});

					}

					$(window).on('resize', function () {
						resize();
					});
					setTimeout(function () {
						resize();
					}, 200);
					setTimeout(function () {
						resize();
					}, 500);
					setTimeout(function () {
						resize();
					}, 800);
				}

				$('.equal-columns').each(function () {
					$(this).woodmart_equlize({
						child: '> [class*=col-]'
					});
				});
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Enable masonry grid for blog
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			blogMasonry: function () {
				if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') return;
				var $container = $('.masonry-container');

				// initialize Masonry after all images have loaded
				$container.imagesLoaded(function () {
					$container.isotope({
						gutter: 0,
						isOriginLeft: !$('body').hasClass('rtl'),
						itemSelector: '.blog-design-masonry, .blog-design-mask, .masonry-item'
					});
				});


				//Portfolio filters
				$('.masonry-filter').on('click', 'a', function (e) {
					e.preventDefault();
					$('.masonry-filter').find('.filter-active').removeClass('filter-active');
					$(this).addClass('filter-active');
					var filterValue = $(this).attr('data-filter');
					$(this).parents('.portfolio-filter').next('.masonry-container.woodmart-portfolio-holder').isotope({
						filter: filterValue
					});
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Helper function that make btn click when you scroll page to it
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			clickOnScrollButton: function (btnClass, destroy, offset) {
				if (typeof $.waypoints != 'function') return;

				var $btn = $(btnClass);
				if (destroy) {
					$btn.waypoint('destroy');
				}

				if (!offset) {
					offset = 0;
				}

				$btn.waypoint(function () {
					$btn.trigger('click');
				}, {
						offset: function () {
							return $(window).outerHeight() + parseInt(offset);
						}
					});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Load more button for blog shortcode
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			blogLoadMore: function () {
				var btnClass = '.woodmart-blog-load-more.load-on-scroll',
					process = false;

				woodmartThemeModule.clickOnScrollButton(btnClass, false, false);

				$('.woodmart-blog-load-more').on('click', function (e) {
					e.preventDefault();

					if (process || $(this).hasClass('no-more-posts')) return;

					process = true;

					var $this = $(this),
						holder = $this.parent().siblings('.woodmart-blog-holder'),
						source = holder.data('source'),
						action = 'woodmart_get_blog_' + source,
						ajaxurl = woodmart_settings.ajaxurl,
						dataType = 'json',
						method = 'POST',
						atts = holder.data('atts'),
						paged = holder.data('paged');

					$this.addClass('loading');

					var data = {
						atts: atts,
						paged: paged,
						action: action,
					};

					if (source == 'main_loop') {
						ajaxurl = $(this).attr('href');
						method = 'GET';
						data = {};
					}

					$.ajax({
						url: ajaxurl,
						data: data,
						dataType: dataType,
						method: method,
						success: function (data) {

							var items = $(data.items);

							if (items) {
								if (holder.hasClass('masonry-container')) {
									// initialize Masonry after all images have loaded  
									holder.append(items).isotope('appended', items);
									holder.imagesLoaded().progress(function () {
										holder.isotope('layout');
										woodmartThemeModule.clickOnScrollButton(btnClass, true, false);
									});
								} else {
									holder.append(items);
									woodmartThemeModule.clickOnScrollButton(btnClass, true, false);
								}

								holder.data('paged', paged + 1);

								if (source == 'main_loop') {
									$this.attr('href', data.nextPage);
									if (data.status == 'no-more-posts') {
										$this.hide().remove();
									}
								}
							}

							if (data.status == 'no-more-posts') {
								$this.addClass('no-more-posts');
								$this.hide();
							}

						},
						error: function (data) {
							console.log('ajax error');
						},
						complete: function () {
							$this.removeClass('loading');
							process = false;
						},
					});

				});

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Load more button for portfolio shortcode
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			portfolioLoadMore: function () {

				if (typeof $.waypoints != 'function') return;

				var waypoint = $('.woodmart-portfolio-load-more.load-on-scroll').waypoint(function () {
					$('.woodmart-portfolio-load-more.load-on-scroll').trigger('click');
				}, { offset: '100%' }),
					process = false;

				$('.woodmart-portfolio-load-more').on('click', function (e) {
					e.preventDefault();

					if (process || $(this).hasClass('no-more-posts')) return;

					process = true;

					var $this = $(this),
						holder = $this.parent().parent().find('.woodmart-portfolio-holder'),
						source = holder.data('source'),
						action = 'woodmart_get_portfolio_' + source,
						ajaxurl = woodmart_settings.ajaxurl,
						dataType = 'json',
						method = 'POST',
						timeout,
						atts = holder.data('atts'),
						paged = holder.data('paged');

					$this.addClass('loading');

					var data = {
						atts: atts,
						paged: paged,
						action: action,
					};

					if (source == 'main_loop') {
						ajaxurl = $(this).attr('href');
						method = 'GET';
						data = {};
					}

					$.ajax({
						url: ajaxurl,
						data: data,
						dataType: dataType,
						method: method,
						success: function (data) {

							var items = $(data.items);

							if (items) {
								if (holder.hasClass('masonry-container')) {
									// initialize Masonry after all images have loaded
									holder.append(items).isotope('appended', items);
									holder.imagesLoaded().progress(function () {
										holder.isotope('layout');

										clearTimeout(timeout);

										timeout = setTimeout(function () {
											$('.woodmart-portfolio-load-more.load-on-scroll').waypoint('destroy');
											waypoint = $('.woodmart-portfolio-load-more.load-on-scroll').waypoint(function () {
												$('.woodmart-portfolio-load-more.load-on-scroll').trigger('click');
											}, { offset: '100%' });
										}, 1000);
									});
								} else {
									holder.append(items);
								}

								holder.data('paged', paged + 1);

								$this.attr('href', data.nextPage);
							}

							woodmartThemeModule.mfpPopup();
							woodmartThemeModule.portfolioEffects();

							if (data.status == 'no-more-posts') {
								$this.addClass('no-more-posts');
								$this.hide();
							}

						},
						error: function (data) {
							console.log('ajax error');
						},
						complete: function () {
							$this.removeClass('loading');
							process = false;
						},
					});

				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * MEGA MENU
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			sidebarMenu: function () {
				var heightMegaMenu = $(".widget_nav_mega_menu #menu-categories").height();
				var heightMegaNavigation = $(".categories-menu-dropdown").height();
				var subMenuHeight = $(".widget_nav_mega_menu ul > li.menu-item-design-sized > .sub-menu-dropdown, .widget_nav_mega_menu ul > li.menu-item-design-full-width > .sub-menu-dropdown");
				var megaNavigationHeight = $(".categories-menu-dropdown ul > li.menu-item-design-sized > .sub-menu-dropdown, .categories-menu-dropdown ul > li.menu-item-design-full-width > .sub-menu-dropdown");
				subMenuHeight.css(
					"min-height", heightMegaMenu + "px"
				);

				megaNavigationHeight.css(
					"min-height", heightMegaNavigation + "px"
				);
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Hide widget on title click
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			widgetsHidable: function () {

				$(document).on('click', '.widget-hidable .widget-title', function () {
					var content = $(this).siblings('ul, div, form, label, select');
					$(this).parent().toggleClass('widget-hidden');
					content.stop().slideToggle(200);
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Sticky column for portfolio items
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			stickyColumn: function () {
				var details = $('.woodmart-sticky-column');

				details.each(function () {
					var $column = $(this),
						offset = 0;

					if ($('body').hasClass('enable-sticky-header') || $('.whb-sticky-row').length > 0 || $('.whb-sticky-header').length > 0) {
						offset = 150;
					}

					$column.find(' > .vc_column-inner > .wpb_wrapper').stick_in_parent({
						offset_top: offset
					});
				})

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Use magnific popup for images
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			mfpPopup: function () {

				$('.gallery').magnificPopup({
					delegate: ' > a',
					type: 'image',
					removalDelay: 500, //delay removal by X to allow out-animation
					tClose: woodmart_settings.close,
					tLoading: woodmart_settings.loading,
					callbacks: {
						beforeOpen: function () {
							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = woodmartTheme.popupEffect;
						}
					},
					image: {
						verticalFit: true
					},
					gallery: {
						enabled: true,
						navigateByImgClick: true
					},
				});

				$('[data-rel="mfp"]').magnificPopup({
					type: 'image',
					removalDelay: 500, //delay removal by X to allow out-animation
					tClose: woodmart_settings.close,
					tLoading: woodmart_settings.loading,
					callbacks: {
						beforeOpen: function () {
							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = woodmartTheme.popupEffect;
						}
					},
					image: {
						verticalFit: true
					},
					gallery: {
						enabled: false,
						navigateByImgClick: false
					},
				});

				$(document).on('click', '.mfp-img', function () {
					var mfp = jQuery.magnificPopup.instance; // get instance
					mfp.st.image.verticalFit = !mfp.st.image.verticalFit; // toggle verticalFit on and off
					mfp.currItem.img.removeAttr('style'); // remove style attribute, to remove max-width if it was applied
					mfp.updateSize(); // force update of size
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Parallax effect
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			parallax: function () {
				if ($(window).width() <= 1024) return;

				$('.parallax-yes').each(function () {
					var $bgobj = $(this);
					$(window).scroll(function () {
						var yPos = -($(window).scrollTop() / $bgobj.data('speed'));
						var coords = 'center ' + yPos + 'px';
						$bgobj.css({
							backgroundPosition: coords
						});
					});
				});

				$('.woodmart-parallax').each(function () {
					var $this = $(this);
					if ($this.hasClass('wpb_column')) {
						$this.find('> .vc_column-inner').parallax("50%", 0.3);
					} else {
						$this.parallax("50%", 0.3);
					}
				});

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Scroll top button
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			scrollTop: function () {
				//Check to see if the window is top if not then display button
				$(window).scroll(function () {
					if ($(this).scrollTop() > 100) {
						$('.scrollToTop').addClass('button-show');
					} else {
						$('.scrollToTop').removeClass('button-show');
					}
				});

				//Click event to scroll to top
				$('.scrollToTop').on('click', function () {
					$('html, body').animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * ToolTips titles
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			btnsToolTips: function () {

				if ($(window).width() <= 1024) return;

				var $tooltips = $('.woodmart-css-tooltip, .product-grid-item:not(.woodmart-hover-base):not(.woodmart-hover-icons) .woodmart-buttons > div a, .woodmart-hover-base.product-in-carousel .woodmart-buttons > div a'),
					$bootstrapTooltips = $(woodmartTheme.bootstrapTooltips);

				// .product-grid-item .add_to_cart_button


				$tooltips.each(function () {
					$(this).find('.woodmart-tooltip-label').remove();
					$(this).addClass('woodmart-tltp').prepend('<span class="woodmart-tooltip-label">' + $(this).text() + '</span>');
					$(this).find('.woodmart-tooltip-label').trigger('mouseover');
				})

					.off('mouseover.tooltips')

					.on('mouseover.tooltips', function () {
						var $label = $(this).find('.woodmart-tooltip-label'),
							width = $label.outerWidth();

						if ($('body').hasClass('rtl')) {
							$label.css({
								marginRight: - parseInt(width / 2)
							})
						} else {
							$label.css({
								marginLeft: - parseInt(width / 2)
							})
						}
					});

				// Bootstrap tooltips

				$bootstrapTooltips.tooltip({
					animation: false,
					container: 'body',
					trigger: 'hover',
					title: function () {
						if ($(this).find('.added_to_cart').length > 0) return $(this).find('.add_to_cart_button').text();
						return $(this).text();
					}
				});

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Sticky footer: margin bottom for main wrapper
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			stickyFooter: function () {

				if (!$('body').hasClass('sticky-footer-on') || $(window).width() <= 1024) return;

				var $footer = $('.footer-container'),
					$page = $('.main-page-wrapper'),
					$window = $(window);

				if ($('.woodmart-prefooter').length > 0) {
					$page = $('.woodmart-prefooter');
				}

				var footerOffset = function () {
					$page.css({
						marginBottom: $footer.outerHeight()
					})
				};

				$window.on('resize', footerOffset);

				$footer.imagesLoaded(function () {
					footerOffset();
				});

				//Safari fix
				var footerSafariFix = function () {
					if (!$('html').hasClass('browser-Safari')) return;
					var windowScroll = $window.scrollTop();
					var footerOffsetTop = $(document).outerHeight() - $footer.outerHeight();

					if (footerOffsetTop < windowScroll + $footer.outerHeight() + $window.outerHeight()) {
						$footer.addClass('visible-footer');
					} else {
						$footer.removeClass('visible-footer');
					}
				};

				footerSafariFix();
				$window.on('scroll', footerSafariFix);

			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Back in history
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			backHistory: function () {
				history.go(-1);

				setTimeout(function () {
					$('.filters-area').removeClass('filters-opened').stop().hide();
					$('.open-filters').removeClass('btn-opened');
					if ($(window).width() <= 1024) {
						$('.woodmart-product-categories').removeClass('categories-opened').stop().hide();
						$('.woodmart-show-categories').removeClass('button-open');
					}

					woodmartThemeModule.btnsToolTips();
					woodmartThemeModule.categoriesAccordion();
					woodmartThemeModule.woocommercePriceSlider();
				}, 20);


			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Ajax Search for products
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			ajaxSearch: function () {
				if (typeof ($.fn.devbridgeAutocomplete) == 'undefined') return;

				var escapeRegExChars = function (value) {
					return value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
				};

				$('form.woodmart-ajax-search').each(function () {
					var $this = $(this),
						number = parseInt($this.data('count')),
						thumbnail = parseInt($this.data('thumbnail')),
						productCat = $this.find('[name="product_cat"]'),
						$results = $this.parent().find('.woodmart-search-results'),
						postType = $this.data('post_type'),
						url = woodmart_settings.ajaxurl + '?action=woodmart_ajax_search',
						price = parseInt($this.data('price'));

					if (number > 0) url += '&number=' + number;
					url += '&post_type=' + postType;

					$results.on('click', '.view-all-results', function () {
						$this.submit();
					});

					if (productCat.length && productCat.val() !== '') {
						url += '&product_cat=' + productCat.val();
					}

					$this.find('[type="text"]').devbridgeAutocomplete({
						serviceUrl: url,
						appendTo: $results,

						onSelect: function (suggestion) {
							if (suggestion.permalink.length > 0)
								window.location.href = suggestion.permalink;
						},
						onSearchStart: function (query) {
							$this.addClass('search-loading');
						},
						beforeRender: function (container) {

							if (container[0].childElementCount > 2)
								$(container).append('<div class="view-all-results"><span>' + woodmart_settings.all_results + '</span></div>');

						},
						onSearchComplete: function (query, suggestions) {
							$this.removeClass('search-loading');

							if ($(window).width() >= 1024 && (!woodmartTheme.disableNanoScrollerWebkit && woodmart_settings.disable_nanoscroller != 'disable')) {
								$(".woodmart-scroll").nanoScroller({
									paneClass: 'woodmart-scroll-pane',
									sliderClass: 'woodmart-scroll-slider',
									contentClass: 'woodmart-scroll-content',
									preventPageScrolling: false
								});
							}

							$(document).trigger('wood-images-loaded');

						},
						formatResult: function (suggestion, currentValue) {
							if (currentValue == '&') currentValue = "&#038;";
							var pattern = '(' + escapeRegExChars(currentValue) + ')',
								returnValue = '';

							if (thumbnail && suggestion.thumbnail) {
								returnValue += ' <div class="suggestion-thumb">' + suggestion.thumbnail + '</div>';
							}

							returnValue += '<h4 class="suggestion-title result-title">' + suggestion.value
								.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
								// .replace(/&/g, '&amp;')
								.replace(/</g, '&lt;')
								.replace(/>/g, '&gt;')
								.replace(/"/g, '&quot;')
								.replace(/&lt;(\/?strong)&gt;/g, '<$1>') + '</h4>';

							if (suggestion.no_found) returnValue = '<div class="suggestion-title no-found-msg">' + suggestion.value + '</div>';

							if (price && suggestion.price) {
								returnValue += ' <div class="suggestion-price price">' + suggestion.price + '</div>';
							}

							return returnValue;
						}
					});

					if (productCat.length) {

						var searchForm = $this.find('[type="text"]').devbridgeAutocomplete(),
							serviceUrl = woodmart_settings.ajaxurl + '?action=woodmart_ajax_search';

						if (number > 0) serviceUrl += '&number=' + number;
						serviceUrl += '&post_type=' + postType;

						productCat.on('cat_selected', function () {
							if (productCat.val() != '') {
								searchForm.setOptions({
									serviceUrl: serviceUrl + '&product_cat=' + productCat.val()
								});
							} else {
								searchForm.setOptions({
									serviceUrl: serviceUrl
								});
							}

							searchForm.hide();
							searchForm.onValueChange();
						});
					}

					$('body').on('click', function () {
						$this.find('[type="text"]').devbridgeAutocomplete('hide');
					});

					$('.woodmart-search-results').on('click', function (e) {
						e.stopPropagation();
					});

				});

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Search full screen
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			searchFullScreen: function () {

				var body = $('body'),
					searchWrapper = $('.woodmart-search-full-screen'),
					offset = 0;


				body.on('click', '.search-button:not(.mobile-search-icon) > a', function (e) {

					e.preventDefault();

					if ($(this).parent().find('.woodmart-search-dropdown').length > 0) return; // if dropdown search on header builder

					if (body.hasClass('global-search-dropdown') || $(window).width() < 1024) return;

					if (isOpened()) {
						closeWidget();
					} else {
						setTimeout(function () {
							openWidget();
						}, 10);
					}
				})


				body.on("click", ".woodmart-close-search, .main-page-wrapper, .header-banner", function (event) {

					if (!$(event.target).is('.woodmart-close-search') && $(event.target).closest(".woodmart-search-full-screen").length) return;

					if (isOpened()) {
						closeWidget();
					}
				});


				var closeByEsc = function (e) {
					if (e.keyCode === 27) {
						closeWidget();
						body.unbind('keyup', closeByEsc);
					}
				};


				var closeWidget = function () {
					$('body').removeClass('woodmart-search-opened');
					searchWrapper.removeClass('search-overlap');
				};

				var openWidget = function () {
					var bar = $('#wpadminbar').outerHeight();

					var offset = 0;

					if ($('.whb-sticked').length > 0) {
						if ($('.whb-clone').length > 0)
							offset = $('.whb-sticked').outerHeight() + bar;
						else
							offset = $('.whb-main-header').outerHeight() + bar;
					} else {
						offset = $('.whb-main-header').outerHeight() + bar;
						if ($('body').hasClass('header-banner-display')) {
							offset += $('.header-banner').outerHeight();
						}
					}

					searchWrapper.css('top', offset);

					// Close by esc
					body.on('keyup', closeByEsc);

					$('body').addClass('woodmart-search-opened');
					searchWrapper.addClass('search-overlap');
					setTimeout(function () {
						searchWrapper.find('input[type="text"]').focus();
						$(window).one('scroll', function () {
							if (isOpened()) {
								closeWidget();
							}
						});
					}, 300);
				};

				var isOpened = function () {
					return $('body').hasClass('woodmart-search-opened');
				};
			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Sale final date countdown
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			countDownTimer: function () {

				$('.woodmart-timer').each(function () {
					var time = moment.tz($(this).data('end-date'), $(this).data('timezone'));
					$(this).countdown(time.toDate(), function (event) {
						$(this).html(event.strftime(''
							+ '<span class="countdown-days">%-D <span>' + woodmart_settings.countdown_days + '</span></span> '
							+ '<span class="countdown-hours">%H <span>' + woodmart_settings.countdown_hours + '</span></span> '
							+ '<span class="countdown-min">%M <span>' + woodmart_settings.countdown_mins + '</span></span> '
							+ '<span class="countdown-sec">%S <span>' + woodmart_settings.countdown_sec + '</span></span>'));
					});
				});

			},


			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * Init nanoscroller
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			nanoScroller: function () {

				if ($(window).width() < 1024 || (woodmart_settings.disable_nanoscroller == 'webkit' && (jscd.browser == 'Chrome' || jscd.browser == 'Opera' || jscd.browser == 'Safari')) || woodmart_settings.disable_nanoscroller == 'disable') return;

				$(".woodmart-scroll").nanoScroller({
					paneClass: 'woodmart-scroll-pane',
					sliderClass: 'woodmart-scroll-slider',
					contentClass: 'woodmart-scroll-content',
					preventPageScrolling: false
				});

				$('body').on('wc_fragments_refreshed wc_fragments_loaded added_to_cart', function () {
					$(".widget_shopping_cart .woodmart-scroll").nanoScroller({
						paneClass: 'woodmart-scroll-pane',
						sliderClass: 'woodmart-scroll-slider',
						contentClass: 'woodmart-scroll-content',
						preventPageScrolling: false
					});
					$(".widget_shopping_cart .woodmart-scroll-content").scroll(function () {
						$(document).trigger('wood-images-loaded');
					})
				});
			},

			/**
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 * WoodMart gradient
			 *-------------------------------------------------------------------------------------------------------------------------------------------
			 */
			gradientShift: function () {
				$('.woodmart_gradient').each(function () {
					var selector = $(this);
					var parent = selector.prev();
					parent.css('position', 'relative');
					parent.prepend(selector);
				});
			},

			/**
			*-------------------------------------------------------------------------------------------------------------------------------------------
			* Lazy loading
			*-------------------------------------------------------------------------------------------------------------------------------------------
			*/
			lazyLoading: function () {
				if (!window.addEventListener || !window.requestAnimationFrame || !document.getElementsByClassName) return;

				// start
				var pItem = document.getElementsByClassName('woodmart-lazy-load'), pCount, timer;

				$(document).on('wood-images-loaded added_to_cart', function () {
					inView();
				})

				$('.woodmart-scroll-content, .woodmart-sidebar-content').scroll(function () {
					$(document).trigger('wood-images-loaded');
				})
				// $(document).on( 'scroll', '.woodmart-scroll-content', function() {
				//     $(document).trigger('wood-images-loaded');
				// })

				// WooCommerce tabs fix
				$('.wc-tabs > li').on('click', function () {
					$(document).trigger('wood-images-loaded');
				});

				// scroll and resize events
				window.addEventListener('scroll', scroller, false);
				window.addEventListener('resize', scroller, false);

				// DOM mutation observer
				if (MutationObserver) {

					var observer = new MutationObserver(function () {
						// console.log('mutated', pItem.length, pCount)
						if (pItem.length !== pCount) inView();
					});

					observer.observe(document.body, { subtree: true, childList: true, attributes: true, characterData: true });

				}

				// initial check
				inView();

				// throttled scroll/resize
				function scroller() {

					timer = timer || setTimeout(function () {
						timer = null;
						inView();
					}, 100);

				}


				// image in view?
				function inView() {

					if (pItem.length) requestAnimationFrame(function () {

						var wT = window.pageYOffset, wB = wT + window.innerHeight, cRect, pT, pB, p = 0;

						while (p < pItem.length) {

							cRect = pItem[p].getBoundingClientRect();
							pT = wT + cRect.top;
							pB = pT + cRect.height;

							if (wT < pB && wB > pT && !pItem[p].loaded) {
								loadFullImage(pItem[p], p);
							}
							else p++;

						}

						pCount = pItem.length;

					});

				}


				// replace with full image
				function loadFullImage(item, i) {

					item.onload = addedImg;

					item.src = item.dataset.woodSrc;
					if (typeof (item.dataset.srcset) != 'undefined') {
						item.srcset = item.dataset.srcset;
					}

					item.loaded = true

					// replace image
					function addedImg() {

						requestAnimationFrame(function () {
							item.classList.add('woodmart-loaded')

							var $masonry = jQuery(item).parents('.view-masonry .gallery-images, .grid-masonry, .masonry-container');
							if ($masonry.length > 0) {
								$masonry.isotope('layout');
							}
							var $categories = jQuery(item).parents('.categories-masonry');
							if ($categories.length > 0) {
								$categories.packery();
							}

							// var $owl = jQuery(item).parents('.owl-carousel');
							// if ($owl.length > 0) {
							//     $owl.trigger('refresh.owl.carousel');
							// }

						});

					}

				}

			},
		}
	}());

})(jQuery);


jQuery(document).ready(function () {
	if (!wooFile) {
		woodmartThemeModule.init();
	}
});

var wooFile = true;
//Functions WOO

(function ($) {
	"use strict";

	var woodmartTheme = {
		popupEffect: 'mfp-move-horizontal',
		supports_html5_storage: false,
		shopLoadMoreBtn: '.woodmart-products-load-more.load-on-scroll',
		ajaxLinks: '.woodmart-product-categories a, .widget_product_categories a, .widget_layered_nav_filters a, .woocommerce-widget-layered-nav a, .filters-area:not(.custom-content) a, body.post-type-archive-product:not(.woocommerce-account) .woocommerce-pagination a, body.tax-product_cat:not(.woocommerce-account) .woocommerce-pagination a, .woodmart-shop-tools a, .woodmart-woocommerce-layered-nav a, .woodmart-price-filter a, .woodmart-clear-filters-wrapp a, .woodmart-woocommerce-sort-by a',
		mainCarouselArg: {
			rtl: $('body').hasClass('rtl'),
			items: woodmart_settings.product_gallery.thumbs_slider.position == 'centered' ? 2 : 1,
			autoplay: woodmart_settings.product_slider_autoplay,
			autoplayTimeout: 3000,
			loop: woodmart_settings.product_slider_autoplay,
			center: woodmart_settings.product_gallery.thumbs_slider.position == 'centered',
			startPosition: woodmart_settings.product_gallery.thumbs_slider.position == 'centered' ? woodmart_settings.centered_gallery_start : 0,
			dots: false,
			nav: true,
			autoHeight: woodmart_settings.product_slider_auto_height == 'yes',
			navText: false,
			onRefreshed: function () {
				$(window).resize();
			}
		}
	};

	/* Storage Handling */
	try {
		woodmartTheme.supports_html5_storage = ('sessionStorage' in window && window.sessionStorage !== null);

		window.sessionStorage.setItem('woodmart', 'test');
		window.sessionStorage.removeItem('woodmart');
	} catch (err) {
		woodmartTheme.supports_html5_storage = false;
	}

	/**
	*-------------------------------------------------------------------------------------------------------------------------------------------
	* Product filters
	*-------------------------------------------------------------------------------------------------------------------------------------------
	*/

	woodmartThemeModule.productFilters = function () {
		//Select checkboxes value
		var removeValue = function ($mainInput, currentVal) {
			if ($mainInput.length == 0) return;
			var mainInputVal = $mainInput.val();
			if (mainInputVal.indexOf(',') > 0) {
				$mainInput.val(mainInputVal.replace(',' + currentVal, '').replace(currentVal + ',', ''));
			} else {
				$mainInput.val(mainInputVal.replace(currentVal, ''));
			}
		}

		$('.woodmart-pf-checkboxes li > .pf-value').on('click', function (e) {
			e.preventDefault();
			var $this = $(this);
			var $li = $this.parent();
			var $widget = $this.parents('.woodmart-pf-checkboxes');
			var $mainInput = $widget.find('.result-input');
			var $results = $widget.find('.woodmart-pf-results');

			var multiSelect = $widget.hasClass('multi_select');
			var mainInputVal = $mainInput.val();
			var currentText = $this.data('title');
			var currentVal = $this.data('val');

			if (multiSelect) {
				if (!$li.hasClass('pf-active')) {
					if (mainInputVal == '') {
						$mainInput.val(currentVal);
					} else {
						$mainInput.val(mainInputVal + ',' + currentVal);
					}
					$results.prepend('<li class="selected-value" data-title="' + currentVal + '">' + currentText + '</li>');
					$li.addClass('pf-active');
				} else {
					removeValue($mainInput, currentVal);
					$results.find('li[data-title="' + currentVal + '"]').remove();
					$li.removeClass('pf-active');
				}
			} else {
				if (!$li.hasClass('pf-active')) {
					$mainInput.val(currentVal);
					$results.find('.selected-value').remove();
					$results.prepend('<li class="selected-value" data-title="' + currentVal + '">' + currentText + '</li>');
					$li.parents('.woodmart-scroll-content').find('.pf-active').removeClass('pf-active');
					$li.addClass('pf-active');
				} else {
					$mainInput.val('');
					$results.find('.selected-value').remove();
					$li.removeClass('pf-active');
				}
			}
		});

		//Label clear
		$('.woodmart-pf-checkboxes').on('click', '.selected-value', function () {
			var $this = $(this);
			var $widget = $this.parents('.woodmart-pf-checkboxes');
			var $mainInput = $widget.find('.result-input');
			var currentVal = $this.data('title');

			//Price filter clear
			if (currentVal == 'price-filter') {
				var min = $this.data('min');
				var max = $this.data('max');
				var $slider = $widget.find('.price_slider_widget');
				$slider.slider('values', 0, min);
				$slider.slider('values', 1, max);
				$widget.find('.min_price').val('');
				$widget.find('.max_price').val('');
				$(document.body).trigger('filter_price_slider_slide', [min, max, min, max, $slider]);
				return;
			}

			removeValue($mainInput, currentVal);
			$widget.find('.pf-value[data-val="' + currentVal + '"]').parent().removeClass('pf-active');
			$this.remove();
		});

		//Checkboxes value dropdown
		$('.woodmart-pf-checkboxes').each(function () {
			var $this = $(this);
			var $btn = $this.find('.woodmart-pf-title');
			var $list = $btn.siblings('.woodmart-pf-dropdown');
			var multiSelect = $this.hasClass('multi_select');

			$btn.on('click', function (e) {
				var target = e.target;
				if ($(target).is($btn.find('.selected-value'))) return;

				if (!$this.hasClass('opened')) {
					$this.addClass('opened');
					$list.slideDown(100);
					setTimeout(function () {
						woodmartThemeModule.nanoScroller();
					}, 300);
				} else {
					close();
				}
			});

			$(document).on('click', function (e) {
				var target = e.target;
				if ($this.hasClass('opened') && (multiSelect && !$(target).is($this) && !$(target).parents().is($this)) || (!multiSelect && !$(target).is($btn) && !$(target).parents().is($btn))) {
					close();
				}
			});

			var close = function () {
				$this.removeClass('opened');
				$list.slideUp(100);
			}
		});

		var removeEmptyValues = function ($selector) {
			$selector.find('.woodmart-pf-checkboxes').each(function () {
				if (!$(this).find('input[type="hidden"]').val()) {
					$(this).find('input[type="hidden"]').remove();
				}
			});
		}

		var changeFormAction = function ($form) {
			var activeCat = $form.find('.woodmart-pf-categories .pf-active .pf-value');
			if (activeCat.length > 0) {
				$form.attr('action', activeCat.attr('href'));
			}
		}

		//Price slider init
		$(document.body).on('filter_price_slider_create filter_price_slider_slide', function (event, min, max, minPrice, maxPrice, $slider) {
			var minHtml = accounting.formatMoney(min, {
				symbol: woocommerce_price_slider_params.currency_format_symbol,
				decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
				thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
				precision: woocommerce_price_slider_params.currency_format_num_decimals,
				format: woocommerce_price_slider_params.currency_format
			});

			var maxHtml = accounting.formatMoney(max, {
				symbol: woocommerce_price_slider_params.currency_format_symbol,
				decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
				thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
				precision: woocommerce_price_slider_params.currency_format_num_decimals,
				format: woocommerce_price_slider_params.currency_format
			});

			$slider.siblings('.filter_price_slider_amount').find('span.from').html(minHtml);
			$slider.siblings('.filter_price_slider_amount').find('span.to').html(maxHtml);

			var $results = $slider.parents('.woodmart-pf-checkboxes').find('.woodmart-pf-results');
			var value = $results.find('.selected-value');
			if (min == minPrice && max == maxPrice) {
				value.remove();
			} else {
				if (value.length == 0) {
					$results.prepend('<li class="selected-value" data-title="price-filter" data-min="' + minPrice + '" data-max="' + maxPrice + '">' + minHtml + ' - ' + maxHtml + '</li>');
				} else {
					value.html(minHtml + ' - ' + maxHtml);
				}
			}

			$(document.body).trigger('price_slider_updated', [min, max]);
		});

		$('.woodmart-pf-price-range .price_slider_widget').each(function () {
			var $this = $(this);
			var $minInput = $this.siblings('.filter_price_slider_amount').find('.min_price');
			var $maxInput = $this.siblings('.filter_price_slider_amount').find('.max_price');
			var minPrice = parseInt($minInput.data('min'));
			var maxPrice = parseInt($maxInput.data('max'));
			var currentMinPrice = parseInt($minInput.val());
			var currentMaxPrice = parseInt($maxInput.val());

			$('.price_slider_widget, .price_label').show();

			$this.slider({
				range: true,
				animate: true,
				min: minPrice,
				max: maxPrice,
				values: [currentMinPrice, currentMaxPrice],
				create: function () {
					if (currentMinPrice == minPrice && currentMaxPrice == maxPrice) {
						$minInput.val('');
						$maxInput.val('');
					}
					$(document.body).trigger('filter_price_slider_create', [currentMinPrice, currentMaxPrice, minPrice, maxPrice, $this]);
				},
				slide: function (event, ui) {
					if (ui.values[0] == minPrice && ui.values[1] == maxPrice) {
						$minInput.val('');
						$maxInput.val('');
					} else {
						$minInput.val(ui.values[0]);
						$maxInput.val(ui.values[1]);
					}
					$(document.body).trigger('filter_price_slider_slide', [ui.values[0], ui.values[1], minPrice, maxPrice, $this]);
				},
				change: function (event, ui) {
					$(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
				}
			});
		});

		//Submit filter form
		$('.woodmart-product-filters').one('click', '.woodmart-pf-btn button', function (e) {
			var $form = $(this).parents('.woodmart-product-filters');
			removeEmptyValues($form);
			changeFormAction($form);

			if (typeof ($.fn.pjax) == 'undefined') return;
			$.pjax({
				container: '.main-page-wrapper',
				timeout: woodmart_settings.pjax_timeout,
				url: $form.attr('action'),
				data: $form.serialize(),
				scrollTo: false
			});
			$(this).prop('disabled', true);
		});

		//Create labels after ajax
		$('.woodmart-pf-checkboxes .pf-active > .pf-value').each(function () {
			var resultsWrapper = $(this).parents('.woodmart-pf-checkboxes').find('.woodmart-pf-results');
			resultsWrapper.prepend('<li class="selected-value" data-title="' + $(this).data('val') + '">' + $(this).data('title') + '</li>');
		});

	};

	/**
	*-------------------------------------------------------------------------------------------------------------------------------------------
	* Sticky sidebar button
	*-------------------------------------------------------------------------------------------------------------------------------------------
	*/

	woodmartThemeModule.stickySidebarBtn = function () {
		var $trigger = $('.woodmart-show-sidebar-btn');
		var $stickyBtn = $('.shop-sidebar-opener:not(.toolbar)');

		if ($stickyBtn.length <= 0 || $trigger.length <= 0 || $(window).width() >= 1024) return;

		var stickySidebarBtnToggle = function () {
			var btnOffset = $trigger.offset().top + $trigger.outerHeight();
			var windowScroll = $(window).scrollTop();

			if (btnOffset < windowScroll) {
				$stickyBtn.addClass('woodmart-sidebar-btn-shown');
			} else {
				$stickyBtn.removeClass('woodmart-sidebar-btn-shown');
			}
		};

		stickySidebarBtnToggle();

		$(window).scroll(stickySidebarBtnToggle);
		$(window).resize(stickySidebarBtnToggle);
	};

	/**
	*-------------------------------------------------------------------------------------------------------------------------------------------
	* Product thumbnail images & photo swipe gallery
	*-------------------------------------------------------------------------------------------------------------------------------------------
	*/

	woodmartThemeModule.productImages = function () {
		// Init photoswipe

		var currentImage,
			$productGallery = $('.woocommerce-product-gallery'),
			$mainImages = $('.woocommerce-product-gallery__wrapper'),
			$thumbs = $productGallery.find('.thumbnails'),
			currentClass = 'current-image',
			PhotoSwipeTrigger = '.woodmart-show-product-gallery';

		$thumbs.addClass('thumbnails-ready');

		if ($productGallery.hasClass('image-action-popup')) {
			PhotoSwipeTrigger += ', .woocommerce-product-gallery__image a';
		}

		$productGallery.on('click', '.woocommerce-product-gallery__image a', function (e) {
			e.preventDefault();
		});

		$productGallery.on('click', PhotoSwipeTrigger, function (e) {
			e.preventDefault();

			currentImage = $(this).attr('href');

			// build items array
			var items = getProductItems();

			woodmartThemeModule.callPhotoSwipe(getCurrentGalleryIndex(e), items);

		});

		$thumbs.on('click', '.image-link', function (e) {
			e.preventDefault();

			// if( $thumbs.hasClass('thumbnails-large') ) {
			//     var index = $(e.currentTarget).index() + 1;
			//     var items = getProductItems();
			//     callPhotoSwipe(index, items);
			//     return;
			// }

			// var href = $(this).attr('href'),
			//     src  = $(this).attr('data-single-image'),
			//     width = $(this).attr('data-width'),
			//     height = $(this).attr('data-height'),
			//     title = $(this).attr('title');

			// $thumbs.find('.' + currentClass).removeClass(currentClass);
			// $(this).addClass(currentClass);

			// if( $mainImages.find('img').attr('src') == src ) return;

			// $mainImages.addClass('loading-image').attr('href', href).find('img').attr('src', src).attr('srcset', src).one('load', function() {
			//     $mainImages.removeClass('loading-image').data('width', width).data('height', height).attr('title', title);
			// });

		});

		var getCurrentGalleryIndex = function (e) {
			if ($mainImages.hasClass('owl-carousel'))
				return $mainImages.find('.owl-item.active').index();
			else return $(e.currentTarget).parent().parent().index();
		};

		var getProductItems = function () {
			var items = [];

			$mainImages.find('figure a img').each(function () {
				var src = $(this).attr('data-large_image'),
					width = $(this).attr('data-large_image_width'),
					height = $(this).attr('data-large_image_height'),
					caption = $(this).data('caption');

				items.push({
					src: src,
					w: width,
					h: height,
					title: (woodmart_settings.product_images_captions == 'yes') ? caption : false
				});

			});

			return items;
		};

		/* Fix zoom for first item firstly */

		if ($productGallery.hasClass('image-action-zoom')) {
			var zoom_target = $('.woocommerce-product-gallery__image');
			var image_to_zoom = zoom_target.find('img');

			// But only zoom if the img is larger than its container.
			if (image_to_zoom.attr('width') > $('.woocommerce-product-gallery').width()) {
				zoom_target.trigger('zoom.destroy');
				zoom_target.zoom({
					touch: false
				});
			}
		}
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Sticky add to cart
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.stickyAddToCart = function () {
		var $trigger = $('.summary-inner .cart');
		var $stickyBtn = $('.woodmart-sticky-btn');

		if ($stickyBtn.length <= 0 || $trigger.length <= 0 || ($(window).width() <= 768 && $stickyBtn.hasClass('mobile-off'))) return;

		var summaryOffset = $trigger.offset().top + $trigger.outerHeight();
		var $scrollToTop = $('.scrollToTop');

		var stickyAddToCartToggle = function () {
			var windowScroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			var documentHeight = $(document).height();

			if (summaryOffset < windowScroll && windowScroll + windowHeight != documentHeight) {
				$stickyBtn.addClass('woodmart-sticky-btn-shown');
				$scrollToTop.addClass('woodmart-sticky-btn-shown');

			} else if (windowScroll + windowHeight == documentHeight || summaryOffset > windowScroll) {
				$stickyBtn.removeClass('woodmart-sticky-btn-shown');
				$scrollToTop.removeClass('woodmart-sticky-btn-shown');
			}
		};

		stickyAddToCartToggle();

		$(window).scroll(stickyAddToCartToggle);

		$('.woodmart-sticky-add-to-cart').on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $('.summary-inner').offset().top
			}, 800);
		});

		$('.woodmart-sticky-btn-wishlist').on('click', function (e) {
			if (!$(this).hasClass('exists')) e.preventDefault();
			$('.summary-inner > .yith-wcwl-add-to-wishlist .add_to_wishlist').trigger('click');
		});

		$('body').on('added_to_wishlist', function () {
			$('.woodmart-sticky-btn-wishlist').addClass('exists');
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Login dropdown
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.loginDropdown = function () {
		if ($(window).width() <= 1024) return;

		$('.menu-item-register:not(.login-side-opener)').on('mouseover', function () {
			$(this).addClass('opened');
		}).on('mouseout', function (event) {
			if (!$(event.target).is('input')) {
				$(this).removeClass('opened');
			}
		}).on('mouseleave', function () {
			var $this = $(this);
			setTimeout(function () {
				$this.removeClass('opened');
			}, 300);
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Login sidebar
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.loginSidebar = function () {
		var body = $('body');
		var loginFormSide = $('.login-form-side');
		var closeSide = $('.woodmart-close-side');

		$('.login-side-opener').on('click', function (e) {
			e.preventDefault();
			if (isOpened()) {
				closeWidget();
			} else {
				setTimeout(function () {
					openWidget();
				}, 10);
			}
		});

		body.on('click touchstart', '.woodmart-close-side', function () {
			if (isOpened()) closeWidget();
		});

		body.on('click', '.close-side-widget', function (e) {
			e.preventDefault();
			if (isOpened()) closeWidget();
		});

		$(document).keyup(function (e) {
			if (e.keyCode === 27 && isOpened()) closeWidget();
		});

		var closeWidget = function () {
			loginFormSide.removeClass('woodmart-login-side-opened');
			closeSide.removeClass('woodmart-close-side-opened');
		};

		var openWidget = function () {
			loginFormSide.addClass('woodmart-login-side-opened');
			closeSide.addClass('woodmart-close-side-opened');
		};

		var isOpened = function () {
			return loginFormSide.hasClass('woodmart-login-side-opened');
		};
	};

	/**
	*-------------------------------------------------------------------------------------------------------------------------------------------
	* Shop loader position
	*-------------------------------------------------------------------------------------------------------------------------------------------
	*/

	woodmartThemeModule.shopLoader = function () {
		var loaderClass = '.woodmart-shop-loader',
			contentClass = '.products[data-source="main_loop"]',
			sidebarClass = '.area-sidebar-shop',
			sidebarLeftClass = 'sidebar-left',
			hiddenClass = 'hidden-loader',
			hiddenTopClass = 'hidden-from-top',
			hiddenBottomClass = 'hidden-from-bottom';

		var loaderVerticalPosition = function () {
			var $products = $(contentClass),
				$loader = $products.parent().find(loaderClass);

			if ($products.length < 1) return;

			var offset = $(window).height() / 2,
				scrollTop = $(window).scrollTop(),
				holderTop = $products.offset().top - offset,
				holderHeight = $products.height(),
				holderBottom = holderTop + holderHeight - 130;

			if (scrollTop < holderTop) {
				$loader.addClass(hiddenClass + ' ' + hiddenTopClass);
			} else if (scrollTop > holderBottom) {
				$loader.addClass(hiddenClass + ' ' + hiddenBottomClass);
			} else {
				$loader.removeClass(hiddenClass + ' ' + hiddenTopClass + ' ' + hiddenBottomClass);
			}
		};

		var loaderHorizontalPosition = function () {
			var $products = $(contentClass),
				$sidebar = $(sidebarClass),
				$loader = $products.parent().find(loaderClass),
				sidebarWidth = $sidebar.outerWidth();

			if ($products.length < 1) return;

			if (sidebarWidth > 0 && $sidebar.hasClass(sidebarLeftClass)) {
				if ($('body').hasClass('rtl')) {
					$loader.css({
						'marginLeft': - sidebarWidth / 2 - 15
					})
				} else {
					$loader.css({
						'marginLeft': sidebarWidth / 2 - 15
					})
				}
			} else if (sidebarWidth > 0) {
				if ($('body').hasClass('rtl')) {
					$loader.css({
						'marginLeft': sidebarWidth / 2 - 15
					})
				} else {
					$loader.css({
						'marginLeft': - sidebarWidth / 2 - 15
					})
				}
			}

		};

		$(window).off('scroll.loaderVerticalPosition');
		$(window).off('loaderHorizontalPosition');

		$(window).on('scroll.loaderVerticalPosition', loaderVerticalPosition);
		$(window).on('resize.loaderHorizontalPosition', loaderHorizontalPosition);

		loaderVerticalPosition();
		loaderHorizontalPosition();
	};

	/**
	*-------------------------------------------------------------------------------------------------------------------------------------------
	* "Sort by" widget reinit
	*-------------------------------------------------------------------------------------------------------------------------------------------
	*/
	woodmartThemeModule.sortByWidget = function () {
		if (typeof ($.fn.pjax) == 'undefined') return;

		$('.woocommerce-ordering').on('change', 'select.orderby', function () {
			var $form = $(this).closest('form');

			$form.find('[name="_pjax"]').remove();

			$.pjax({
				container: '.main-page-wrapper',
				timeout: woodmart_settings.pjax_timeout,
				url: '?' + $form.serialize(),
				scrollTo: false
			});
		});

		$('.woocommerce-ordering').submit(function (e) {
			e.preventDefault(e);
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Add filters dropdowns compatibility
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.filterDropdowns = function () {
		// Init
		$('.woodmart-widget-layered-nav-dropdown-form').each(function(){
			var $form = $(this);
			var $select = $form.find('select');
			var slug = $select.data('slug');

			$select.change(function () {
				var val = $(this).val();
				$('input[name=filter_' + slug + ']').val(val);
			});

			if ($().selectWoo) {
				$select.selectWoo({
					placeholder: $select.data('placeholder'),
					minimumResultsForSearch: 5,
					width: '100%',
					allowClear: $select.attr('multiple') ? false : true,
					language: {
						noResults: function () {
							return $select.data('noResults');
						}
					}
				}).on('select2:unselecting', function () {
					$(this).data('unselecting', true);
				}).on('select2:opening', function (e) {
					if ($(this).data('unselecting')) {
						$(this).removeData('unselecting');
						e.preventDefault();
					}
				});
			}
		});

		function ajaxAction($element) {
			var $form = $element.parent('.woodmart-widget-layered-nav-dropdown-form');
			if (typeof ($.fn.pjax) == 'undefined') {
				return;
			}

			$.pjax({
				container: '.main-page-wrapper',
				timeout: woodmart_settings.pjax_timeout,
				url: $form.attr('action'),
				data: $form.serialize(),
				scrollTo: false
			});
		}

		$('.woodmart-widget-layered-nav-dropdown__submit').on('click', function (e) {
			if (!$(this).siblings('select').attr('multiple') || !$('body').hasClass('woodmart-ajax-shop-on')) {
				return;
			}

			ajaxAction($(this));

			$(this).prop('disabled', true);
		});

		$('.woodmart-widget-layered-nav-dropdown-form select').on('change', function (e) {
			if (!$('body').hasClass('woodmart-ajax-shop-on')){
				$(this).parent().submit();
				return;
			}

			if ($(this).attr('multiple') ) {
				return;
			}

			ajaxAction($(this));
		});
		
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Sticky details block for special product type
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.stickyDetails = function () {
		if (
			!$('body').hasClass('woodmart-product-sticky-on')
			|| $(window).width() <= 1024
		) return;

		var details = $('.entry-summary');


		details.each(function () {
			var $column = $(this),
				offset = 40,
				$inner = $column.find('.summary-inner'),
				$images = $column.parent().find('.product-images-inner');

			if ($('body').hasClass('enable-sticky-header') || $('.whb-sticky-row').length > 0 || $('.whb-sticky-header').length > 0) {
				offset = 150;
			}

			$images.imagesLoaded(function () {
				var diff = $inner.outerHeight() - $images.outerHeight();

				if (diff < -100) {
					$inner.stick_in_parent({
						offset_top: offset
					});
				} else if (diff > 100) {
					$images.stick_in_parent({
						offset_top: offset
					});
				}

				$(window).resize(function () {

					if ($(window).width() <= 1024) {
						$inner.trigger('sticky_kit:detach');
						$images.trigger('sticky_kit:detach');
					} else if ($inner.outerHeight() < $images.outerHeight()) {
						$inner.stick_in_parent({
							offset_top: offset
						});
					} else {
						$images.stick_in_parent({
							offset_top: offset
						});
					}

				});
			});

		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product accordion
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productAccordion = function () {
		var $accordion = $('.wc-tabs-wrapper');

		var time = 300;

		var hash = window.location.hash;
		var url = window.location.href;

		if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews') {
			$accordion.find('.tab-title-reviews').addClass('active');
		} else if (url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {
			$accordion.find('.tab-title-reviews').addClass('active');
		} else {
			$accordion.find('.woodmart-accordion-title').first().addClass('active');
		}

		$accordion.on('click', '.woodmart-accordion-title', function (e) {
			e.preventDefault();

			var $this = $(this),
				$panel = $this.siblings('.woocommerce-Tabs-panel');

			var curentIndex = $this.parent().index();
			var oldIndex = $this.parent().siblings().find('.active').parent('.woodmart-tab-wrapper').index();

			if ($this.hasClass('active')) {
				oldIndex = curentIndex;
				$this.removeClass('active');
				$panel.stop().slideUp(time);
			} else {
				$accordion.find('.woodmart-accordion-title').removeClass('active');
				$accordion.find('.woocommerce-Tabs-panel').slideUp();
				$this.addClass('active');
				$panel.stop().slideDown(time);
			}

			if (oldIndex == -1) oldIndex = curentIndex;

			$(window).resize();

			setTimeout(function () {
				$(window).resize();
				if ($(window).width() < 1024 && curentIndex > oldIndex) {
					$('html, body').animate({
						scrollTop: $this.offset().top - $this.outerHeight() - $('.sticky-header').outerHeight() - 50
					}, 500);
				}
			}, time);

		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product thumbnail images & photo swipe gallery
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productImagesGallery = function () {
		var $mainImages = $('.woocommerce-product-gallery__image:eq(0) img'),
			$thumbs = $('.images .thumbnails'), // magnific photo-swipe
			$mainOwl = $('.woocommerce-product-gallery__wrapper'),
			thumbs_position = woodmart_settings.product_gallery.thumbs_slider.position;

		// if (woodmart_settings.product_gallery.thumbs_slider.position == 'centered' && $mainOwl.find('.product-image-wrap').length > 1) {
		//     var moveblock = $mainOwl.find('.product-image-wrap:eq(0)');
		//     moveblock.remove();
		//     $mainOwl.find('.product-image-wrap:eq(0)').after(moveblock);
		// }

		if (woodmart_settings.product_gallery.images_slider) {
			if (woodmart_settings.product_slider_auto_height == 'yes') {
				$('.product-images').imagesLoaded(function () {
					initMainGallery();
				});
			} else {
				initMainGallery();
			}
		} else if (jQuery(window).width() <= 1024 && (thumbs_position == 'bottom_combined' || thumbs_position == 'bottom_column' || thumbs_position == 'bottom_grid')) {
			initMainGallery();
		}

		if (woodmart_settings.product_gallery.thumbs_slider.enabled && woodmart_settings.product_gallery.images_slider) {
			initThumbnailsMarkup();
			if (woodmart_settings.product_gallery.thumbs_slider.position == 'left' && jQuery(window).width() > 1024 && typeof ($.fn.slick) != 'undefined') {
				initThumbnailsVertical();
			} else {
				initThumbnailsHorizontal();
			}
		}

		function initMainGallery() {
			$('.woocommerce-product-gallery__wrapper').trigger('destroy.owl.carousel');
			$('.woocommerce-product-gallery__wrapper').addClass('owl-carousel').owlCarousel(woodmartTheme.mainCarouselArg);
			$(document).trigger('wood-images-loaded');
		};

		function initThumbnailsMarkup() {
			var markup = '';

			$('.woocommerce-product-gallery__image').each(function () {
				var image = $(this).data('thumb'),
					alt = $(this).find('a > img').attr('alt'),
					title = $(this).find('a > img').attr('title');

				markup += '<div class="product-image-thumbnail"><img alt="' + alt + '" title="' + title + '" src="' + image + '" /></div>';
			});

			if ($thumbs.hasClass('slick-slider')) {
				$thumbs.slick('unslick');
			} else if ($thumbs.hasClass('owl-carousel')) {
				$thumbs.trigger('destroy.owl.carousel');
			}

			$thumbs.empty();
			$thumbs.append(markup);
		};

		function initThumbnailsVertical() {
			$thumbs.slick({
				slidesToShow: woodmart_settings.product_gallery.thumbs_slider.items.vertical_items,
				slidesToScroll: woodmart_settings.product_gallery.thumbs_slider.items.vertical_items,
				vertical: true,
				verticalSwiping: true,
				infinite: false,
			});

			$thumbs.on('click', '.product-image-thumbnail', function (e) {
				var i = $(this).index();
				$mainOwl.trigger('to.owl.carousel', i);
			});

			$mainOwl.on('changed.owl.carousel', function (e) {
				var i = e.item.index;
				$thumbs.slick('slickGoTo', i);
				$thumbs.find('.active-thumb').removeClass('active-thumb');
				$thumbs.find('.product-image-thumbnail').eq(i).addClass('active-thumb');
			});

			$thumbs.find('.product-image-thumbnail').eq(0).addClass('active-thumb');
		};

		function initThumbnailsHorizontal() {
			$thumbs.addClass('owl-carousel').owlCarousel({
				rtl: $('body').hasClass('rtl'),
				items: woodmart_settings.product_gallery.thumbs_slider.items.desktop,
				responsive: {
					1025: {
						items: woodmart_settings.product_gallery.thumbs_slider.items.desktop
					},
					769: {
						items: woodmart_settings.product_gallery.thumbs_slider.items.tablet_landscape
					},
					577: {
						items: woodmart_settings.product_gallery.thumbs_slider.items.tablet
					},
					0: {
						items: woodmart_settings.product_gallery.thumbs_slider.items.mobile
					}
				},
				dots: false,
				nav: true,
				// mouseDrag: false,
				navText: false,
			});

			var $thumbsOwl = $thumbs.owlCarousel();

			$thumbs.on('click', '.owl-item', function (e) {
				var i = $(this).index();
				$thumbsOwl.trigger('to.owl.carousel', i);
				$mainOwl.trigger('to.owl.carousel', i);
			});

			$mainOwl.on('changed.owl.carousel', function (e) {
				var i = e.item.index;
				$thumbsOwl.trigger('to.owl.carousel', i);
				$thumbs.find('.active-thumb').removeClass('active-thumb');
				$thumbs.find('.product-image-thumbnail').eq(i).addClass('active-thumb');
			});

			$thumbs.find('.product-image-thumbnail').eq(0).addClass('active-thumb');
		};

		// Update first thumbnail on variation change
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * WooCommerce adding to cart
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.addToCart = function () {
		var that = this,
			timeoutNumber = 0;

		that.addToCartAllTypes();

		$('body').on('added_to_cart', function (event, fragments, cart_hash) {

			if (woodmart_settings.add_to_cart_action == 'popup') {

				var html = [
					'<div class="added-to-cart">',
					'<h4>' + woodmart_settings.added_to_cart + '</h4>',
					'<a href="#" class="btn btn-style-link btn-color-default close-popup">' + woodmart_settings.continue_shopping + '</a>',
					'<a href="' + woodmart_settings.cart_url + '" class="btn btn-color-primary view-cart">' + woodmart_settings.view_cart + '</a>',
					'</div>',
				].join("");

				$.magnificPopup.open({
					removalDelay: 500, //delay removal by X to allow out-animation
					tClose: woodmart_settings.close,
					tLoading: woodmart_settings.loading,
					callbacks: {
						beforeOpen: function () {
							this.st.mainClass = woodmartTheme.popupEffect + '  cart-popup-wrapper';
						},
					},
					items: {
						src: '<div class="mfp-with-anim white-popup popup-added_to_cart">' + html + '</div>',
						type: 'inline'
					}
				});

				$('.white-popup').on('click', '.close-popup', function (e) {
					e.preventDefault();
					$.magnificPopup.close();
				});

			} else if (woodmart_settings.add_to_cart_action == 'widget') {

				clearTimeout(timeoutNumber);

				if ($('.act-scroll .woodmart-shopping-cart, .whb-sticked .woodmart-shopping-cart').length > 0) {
					$('.act-scroll .woodmart-shopping-cart, .whb-sticked .woodmart-shopping-cart').addClass('display-widget');
				} else {
					$('.whb-header .woodmart-shopping-cart').addClass('display-widget');
				}

				if ($('.cart-widget-opener').length > 0) {
					$('.cart-widget-opener').trigger('click');
				}

				timeoutNumber = setTimeout(function () {
					$('.display-widget').removeClass('display-widget');
				}, 3500);
			}

			that.btnsToolTips();

		});
	},

		woodmartThemeModule.addToCartAllTypes = function () {
			if (woodmart_settings.ajax_add_to_cart == false) return;
			// AJAX add to cart for all types of products

			$('body').on('submit', 'form.cart', function (e) {
				var $productWrapper = $(this).parents('.single-product-page');
				if ($productWrapper.hasClass('product-type-external') || $productWrapper.hasClass('product-type-zakeke')) return;

				e.preventDefault();

				var $form = $(this),
					$thisbutton = $form.find('.single_add_to_cart_button'),
					data = $form.serialize();

				data += '&action=woodmart_ajax_add_to_cart';

				if ($thisbutton.val()) {
					data += '&add-to-cart=' + $thisbutton.val();
				}

				$thisbutton.removeClass('added not-added');
				$thisbutton.addClass('loading');

				// Trigger event
				$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

				$.ajax({
					url: woodmart_settings.ajaxurl,
					data: data,
					method: 'POST',
					success: function (response) {
						if (!response) {
							return;
						}

						var this_page = window.location.toString();

						this_page = this_page.replace('add-to-cart', 'added-to-cart');

						if (response.error && response.product_url) {
							window.location = response.product_url;
							return;
						}

						// Redirect to cart option
						if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {

							window.location = wc_add_to_cart_params.cart_url;
							return;

						} else {

							$thisbutton.removeClass('loading');

							var fragments = response.fragments;
							var cart_hash = response.cart_hash;


							// Block fragments class
							if (fragments) {
								$.each(fragments, function (key) {
									$(key).addClass('updating');
								});
							}

							// Replace fragments
							if (fragments) {
								$.each(fragments, function (key, value) {
									$(key).replaceWith(value);
								});
							}

							// Show notices
							if (response.notices.indexOf('error') > 0) {
								$('body').append(response.notices);
								$thisbutton.addClass('not-added');
							} else {
								if (woodmart_settings.add_to_cart_action == 'widget')
									$.magnificPopup.close();

								// Changes button classes
								$thisbutton.addClass('added');
								// Trigger event so themes can refresh other areas
								$(document.body).trigger('added_to_cart', [fragments, cart_hash, $thisbutton]);
							}

						}
					},
					error: function () {
						console.log('ajax adding to cart error');
					},
					complete: function () { },
				});

			});
		};

	woodmartThemeModule.updateWishListNumberInit = function () {
		if (woodmart_settings.wishlist == 'no' || $('.wishlist-count').length <= 0) return;

		var that = this;

		if (woodmartTheme.supports_html5_storage) {

			try {
				var wishlistNumber = sessionStorage.getItem('woodmart_wishlist_number'),
					cookie_hash = Cookies.get('woodmart_wishlist_hash');


				if (wishlistNumber === null || wishlistNumber === undefined || wishlistNumber === '') {
					wishlistNumber = 0;
				}

				if (cookie_hash === null || cookie_hash === undefined || cookie_hash === '') {
					cookie_hash = 0;
				}

				if (wishlistNumber == cookie_hash) {
					this.setWishListNumber(wishlistNumber);
				} else {
					throw 'No wishlist number';
				}

			} catch (err) {
				this.updateWishListNumber();
			}

		} else {
			this.updateWishListNumber();
		}

		$('body').on('added_to_cart added_to_wishlist removed_from_wishlist', function () {
			that.updateWishListNumber();
			that.btnsToolTips();
			that.woocommerceWrappTable();
		});
	};

	woodmartThemeModule.updateCartWidgetFromLocalStorage = function () {
		var that = this;

		if (woodmartTheme.supports_html5_storage) {

			try {
				var wc_fragments = $.parseJSON(sessionStorage.getItem(wc_cart_fragments_params.fragment_name));

				if (wc_fragments && wc_fragments['div.widget_shopping_cart_content']) {

					$.each(wc_fragments, function (key, value) {
						$(key).replaceWith(value);
					});

					$(document.body).trigger('wc_fragments_loaded');
				} else {
					throw 'No fragment';
				}

			} catch (err) {
				console.log('cant update cart widget');
			}
		}
	};

	woodmartThemeModule.updateWishListNumber = function () {
		var that = this;
		$.ajax({
			url: woodmart_settings.ajaxurl,
			data: {
				action: 'woodmart_wishlist_number',
			},
			method: 'get',
			success: function (data) {
				that.setWishListNumber(data);
				if (woodmartTheme.supports_html5_storage) {
					sessionStorage.setItem('woodmart_wishlist_number', data);
				}
			}
		});
	};

	woodmartThemeModule.setWishListNumber = function (num) {
		num = ($.isNumeric(num)) ? num : 0;
		$('.woodmart-wishlist-info-widget .wishlist-count').text(num);
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Quick Shop
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.quickShop = function () {
		var btnSelector = '.quick-shop-on.product-type-variable .add_to_cart_button';

		$(document).on('click', btnSelector, function (e) {
			e.preventDefault();

			var $this = $(this),
				$product = $this.parents('.product').first(),
				$content = $product.find('.quick-shop-form'),
				id = $product.data('id'),
				loadingClass = 'btn-loading';

			if ($this.hasClass(loadingClass)) return;


			// Simply show quick shop form if it is already loaded with AJAX previously
			if ($product.hasClass('quick-shop-loaded')) {
				$product.addClass('quick-shop-shown');
				return;
			}

			$this.addClass(loadingClass);
			$product.addClass('loading-quick-shop');

			$.ajax({
				url: woodmart_settings.ajaxurl,
				data: {
					action: 'woodmart_quick_shop',
					id: id,
				},
				method: 'get',
				success: function (data) {

					// insert variations form
					$content.append(data);

					initVariationForm($product);
					$('body').trigger('woodmart-quick-view-displayed');
					woodmartThemeModule.swatchesVariations();
					woodmartThemeModule.btnsToolTips();

				},
				complete: function () {
					setTimeout(function () {
						$this.removeClass(loadingClass);
						$product.removeClass('loading-quick-shop');
						$product.addClass('quick-shop-shown quick-shop-loaded');
					}, 100);
				},
				error: function () {
				},
			});

		})

			.on('click', '.quick-shop-close', function () {
				var $this = $(this),
					$product = $this.parents('.product');

				$product.removeClass('quick-shop-shown');
			});

		$(document.body).on('added_to_cart', function () {
			$('.product').removeClass('quick-shop-shown');
		});

		function initVariationForm($product) {
			$product.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').change();
			$product.find('.variations_form').trigger('wc_variation_form');
		}
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Quick View
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.quickViewInit = function () {
		// Open popup with product info when click on Quick View button
		$(document).on('click', '.open-quick-view', function (e) {

			e.preventDefault();

			var productId = $(this).data('id'),
				loopName = $(this).data('loop-name'),
				closeText = woodmart_settings.close,
				loadingText = woodmart_settings.loading,
				loop = $(this).data('loop'),
				prev = '',
				next = '',
				loopBtns = $('.quick-view').find('[data-loop-name="' + loopName + '"]'),
				btn = $(this);

			btn.addClass('loading');

			if (typeof loopBtns[loop - 1] != 'undefined') {
				prev = loopBtns.eq(loop - 1).addClass('quick-view-prev');
				prev = $('<div>').append(prev.clone()).html();
			}

			if (typeof loopBtns[loop + 1] != 'undefined') {
				next = loopBtns.eq(loop + 1).addClass('quick-view-next');
				next = $('<div>').append(next.clone()).html();
			}

			woodmartThemeModule.quickViewLoad(productId, btn, prev, next);

		});
	};

	woodmartThemeModule.quickViewLoad = function (id, btn, prev, next) {
		var data = {
			id: id,
			action: "woodmart_quick_view",
		};

		var initPopup = function (data) {
			$.magnificPopup.open({
				items: {
					src: '<div class="mfp-with-anim popup-quick-view">' + data + '</div>', // can be a HTML string, jQuery object, or CSS selector
					type: 'inline'
				},
				tClose: woodmart_settings.close,
				tLoading: woodmart_settings.loading,
				removalDelay: 500, //delay removal by X to allow out-animation
				callbacks: {
					beforeOpen: function () {
						this.st.mainClass = woodmartTheme.popupEffect + ' quick-view-wrapper';
					},
					open: function () {
						$('.variations_form').each(function () {
							$(this).wc_variation_form().find('.variations select:eq(0)').change();
						});
						$('.variations_form').trigger('wc_variation_form');
						$('body').trigger('woodmart-quick-view-displayed');
						woodmartThemeModule.swatchesVariations();

						woodmartThemeModule.btnsToolTips();
						setTimeout(function () {
							woodmartThemeModule.nanoScroller();
						}, 300);
					}
				},
			});
		}

		$.ajax({
			url: woodmart_settings.ajaxurl,
			data: data,
			method: 'get',
			success: function (data) {
				if (woodmart_settings.quickview_in_popup_fix) {
					$.magnificPopup.close();
					setTimeout(function () {
						initPopup(data);
					}, 500);
				} else {
					initPopup(data);
				}
			},
			complete: function () {
				btn.removeClass('loading');
			},
			error: function () {
			},
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Swatches variations
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.swatchesVariations = function () {
		var $variation_forms = $('.variations_form');
		var ScrollToTopCounter = 0;

		// Firefox mobile fix
		$('.variations_form .label').on('click', function (e) {
			if ($(this).siblings('.value').hasClass('with-swatches')) {
				e.preventDefault();
			}
		});

		$variation_forms.each(function () {
			var $variation_form = $(this);

			if ($variation_form.data('swatches')) return;
			$variation_form.data('swatches', true);

			// If AJX
			if (!$variation_form.data('product_variations')) {
				$variation_form.find('.swatches-select').find('> div').addClass('swatch-enabled');
			}

			if ($('.swatches-select > div').hasClass('active-swatch')) {
				$variation_form.addClass('variation-swatch-selected');
			}

			$variation_form.on('click', '.swatches-select > div', function () {
				var value = $(this).data('value');
				var id = $(this).parent().data('id');

				$variation_form.trigger('check_variations', ['attribute_' + id, true]);
				resetSwatches($variation_form);

				//$variation_form.find('select#' + id).val('').trigger('change');
				//$variation_form.trigger('check_variations');

				if ($(this).hasClass('active-swatch')) {
					// Removed since 2.9 version as not necessary
					// $variation_form.find( '.variations select' ).val( '' ).change();
					// $variation_form.trigger( 'reset_data' );
					// $(this).removeClass('active-swatch')
					return;
				}

				if ($(this).hasClass('swatch-disabled')) return;
				$variation_form.find('select#' + id).val(value).trigger('change');
				$(this).parent().find('.active-swatch').removeClass('active-swatch');
				$(this).addClass('active-swatch');
				resetSwatches($variation_form);
			})


				// On clicking the reset variation button
				.on('click', '.reset_variations', function (event) {
					$variation_form.find('.active-swatch').removeClass('active-swatch');
					if (!isQuickView()) {
						replaceMainGallery('default', $variation_form);
					}
				})

				.on('reset_data', function () {

					if (!$variation_form.find('.variations .value').hasClass('with-swatches') && !isQuickView()) {
						replaceMainGallery('default', $variation_form);
					}

					var all_attributes_chosen = true;
					var some_attributes_chosen = false;

					$variation_form.find('.variations select').each(function () {
						var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
						var value = $(this).val() || '';

						if (value.length === 0) {
							all_attributes_chosen = false;
						} else {
							some_attributes_chosen = true;
						}

					});

					if (all_attributes_chosen) {
						$(this).parent().find('.active-swatch').removeClass('active-swatch');
					}

					$variation_form.removeClass('variation-swatch-selected');

					var $mainOwl = (isQuickView()) ? $('.product-quick-view .woocommerce-product-gallery__wrapper') : $('.woocommerce-product-gallery__wrapper');

					resetSwatches($variation_form);

					if (!isQuickShop($variation_form)) {
						ScrollToTopCounter++;
						scrollToTop();
					}

					if (!$mainOwl.hasClass('owl-carousel')) return;

					if (woodmart_settings.product_slider_auto_height == 'yes') {
						if (!isQuickView() && isVariationGallery('default')) {
							$mainOwl.trigger('destroy.owl.carousel');
						}
						$('.product-images').imagesLoaded(function () {
							$mainOwl = $mainOwl.owlCarousel(woodmartTheme.mainCarouselArg);
							$mainOwl.trigger('refresh.owl.carousel');
						});
					} else {
						$mainOwl = $mainOwl.owlCarousel(woodmartTheme.mainCarouselArg);
						$mainOwl.trigger('refresh.owl.carousel');
					}

					var slide_go_to = woodmart_settings.product_gallery.thumbs_slider.position == 'centered' ? woodmart_settings.centered_gallery_start : 0;
					if (isQuickView()) slide_go_to = 0;
					$mainOwl.trigger('to.owl.carousel', slide_go_to);

				})


				// Update first tumbnail
				.on('reset_image', function () {
					var $thumb = $('.thumbnails .product-image-thumbnail img').first();
					if (!isQuickView() && !isQuickShop($variation_form)) {
						$thumb.wc_reset_variation_attr('src');
					}
				})
				.on('show_variation', function (e, variation, purchasable) {

					if (!variation.image.src) {
						return;
					}

					// See if the gallery has an image with the same original src as the image we want to switch to.
					var galleryHasImage = $('.thumbnails .product-image-thumbnail img[data-o_src="' + variation.image.thumb_src + '"]').length > 0;
					var $firstThumb = $('.thumbnails .product-image-thumbnail img').first();

					// If the gallery has the image, reset the images. We'll scroll to the correct one.
					if (galleryHasImage) {
						$firstThumb.wc_reset_variation_attr('src');
					}

					if (!isQuickView() && !isQuickShop($variation_form) && !replaceMainGallery(variation.variation_id, $variation_form)) {
						if ($firstThumb.attr('src') != variation.image.thumb_src) {
							$firstThumb.wc_set_variation_attr('src', variation.image.src);
						}
						woodmartThemeModule.initZoom();
					}

					$variation_form.addClass('variation-swatch-selected');

					if (!isQuickShop($variation_form)) {
						scrollToTop();
					}

					var $mainOwl = (isQuickView()) ? $('.product-quick-view .woocommerce-product-gallery__wrapper') : $('.woocommerce-product-gallery__wrapper');

					if (!$mainOwl.hasClass('owl-carousel')) return;

					if (woodmart_settings.product_slider_auto_height == 'yes') {
						if (!isQuickView() && isVariationGallery(variation.variation_id)) {
							$mainOwl.trigger('destroy.owl.carousel');
						}
						$('.product-images').imagesLoaded(function () {
							$mainOwl = $mainOwl.owlCarousel(woodmartTheme.mainCarouselArg);
							$mainOwl.trigger('refresh.owl.carousel');
						});
					} else {
						$mainOwl = $mainOwl.owlCarousel(woodmartTheme.mainCarouselArg);
						$mainOwl.trigger('refresh.owl.carousel');
					}

					var $thumbs = $('.images .thumbnails');

					$mainOwl.trigger('to.owl.carousel', 0);

					if ($thumbs.hasClass('owl-carousel')) {
						$thumbs.owlCarousel().trigger('to.owl.carousel', 0);
						$thumbs.find('.active-thumb').removeClass('active-thumb');
						$thumbs.find('.product-image-thumbnail').eq(0).addClass('active-thumb');
					} else if ($thumbs.hasClass('slick-slider')) {
						$thumbs.slick('slickGoTo', 0);
						if (!$thumbs.find('.product-image-thumbnail').eq(0).hasClass('active-thumb')) {
							$thumbs.find('.active-thumb').removeClass('active-thumb');
							$thumbs.find('.product-image-thumbnail').eq(0).addClass('active-thumb');
						}
					}

				});
		})

		var resetSwatches = function ($variation_form) {

			// If using AJAX
			if (!$variation_form.data('product_variations')) return;

			$variation_form.find('.variations select').each(function () {

				var select = $(this);
				var swatch = select.parent().find('.swatches-select');
				var options = select.html();
				// var options = select.data('attribute_html');
				options = $(options);

				swatch.find('> div').removeClass('swatch-enabled').addClass('swatch-disabled');

				options.each(function (el) {
					var value = $(this).val();

					if ($(this).hasClass('enabled')) {
						// if( ! el.disabled ) {
						swatch.find('div[data-value="' + value + '"]').removeClass('swatch-disabled').addClass('swatch-enabled');
					} else {
						swatch.find('div[data-value="' + value + '"]').addClass('swatch-disabled').removeClass('swatch-enabled');
					}

				});

			});
		};

		var isQuickView = function () {
			return $('.single-product-content').hasClass('product-quick-view');
		};

		var isQuickShop = function ($form) {
			return $form.parent().hasClass('quick-shop-form');
		};

		var isVariationGallery = function (key) {
			return typeof woodmart_variation_gallery_data !== 'undefined' && woodmart_variation_gallery_data && woodmart_variation_gallery_data[key];
		};

		var scrollToTop = function () {
			if (ScrollToTopCounter == 1){
				return;
			}

			if ((woodmart_settings.swatches_scroll_top_desktop == 1 && $(window).width() >= 1024) || (woodmart_settings.swatches_scroll_top_mobile == 1 && $(window).width() <= 1024)) {
				$('.woodmart-swatch').tooltip('hide');
				$('html, body').animate({
					scrollTop: $('.product-image-summary').offset().top - 150
				}, 800);
			}
		}

		var replaceMainGallery = function (key, $variationForm) {
			if (!isVariationGallery(key) || isQuickShop($variationForm) && isQuickView()) {
				return false;
			}

			var imagesData = woodmart_variation_gallery_data[key];
			var $mainGallery = $('.woocommerce-product-gallery__wrapper');
			$mainGallery.empty();

			for (var index = 0; index < imagesData.length; index++) {
				$mainGallery.append(
					'<div class="product-image-wrap">\
						<figure data-thumb="' + imagesData[index].data_thumb + '" class="woocommerce-product-gallery__image">\
							<a href="' + imagesData[index].href + '">\
								' + imagesData[index].image + '\
							</a>\
						</figure>\
					</div>'
				);
			}

			woodmartThemeModule.productImagesGallery();
			$('.woocommerce-product-gallery__image').trigger('zoom.destroy');
			if (!isQuickView()) {
				woodmartThemeModule.initZoom();
			}

			return true;
		}
	};

	woodmartThemeModule.swatchesOnGrid = function () {
		$('body').on('click', '.swatch-on-grid', function () {

			var src, srcset, image_sizes;

			var imageSrc = $(this).data('image-src'),
				imageSrcset = $(this).data('image-srcset'),
				imageSizes = $(this).data('image-sizes');

			if (typeof imageSrc == 'undefined') return;

			var product = $(this).parents('.product-grid-item'),
				image = product.find('.product-image-link > img'),
				srcOrig = image.data('original-src'),
				srcsetOrig = image.data('original-srcset'),
				sizesOrig = image.data('original-sizes');

			if (typeof srcOrig == 'undefined') {
				image.data('original-src', image.attr('src'));
			}

			if (typeof srcsetOrig == 'undefined') {
				image.data('original-srcset', image.attr('srcset'));
			}

			if (typeof sizesOrig == 'undefined') {
				image.data('original-sizes', image.attr('sizes'));
			}


			if ($(this).hasClass('current-swatch')) {
				src = srcOrig;
				srcset = srcsetOrig;
				image_sizes = sizesOrig;
				$(this).removeClass('current-swatch');
				product.removeClass('product-swatched');
			} else {
				$(this).parent().find('.current-swatch').removeClass('current-swatch');
				$(this).addClass('current-swatch');
				product.addClass('product-swatched');
				src = imageSrc;
				srcset = imageSrcset;
				image_sizes = imageSizes;
			}

			if (image.attr('src') == src) return;

			product.addClass('loading-image');

			image.attr('src', src).attr('srcset', srcset).attr('image_sizes', image_sizes).one('load', function () {
				product.removeClass('loading-image');
			});

		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Products tabs element AJAX loading
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productsTabs = function () {
		var process = false;

		$('.woodmart-products-tabs').each(function () {
			var $this = $(this),
				$inner = $this.find('.woodmart-tab-content'),
				cache = [];

			if ($inner.find('.owl-carousel').length < 1) {
				cache[0] = {
					html: $inner.html()
				};
			}

			$this.find('.products-tabs-title li').on('click', function (e) {
				e.preventDefault();

				var $this = $(this),
					atts = $this.data('atts'),
					index = $this.index();

				if (process || $this.hasClass('active-tab-title')) return; process = true;

				loadTab(atts, index, $inner, $this, cache, function (data) {
					if (data.html) {
						$inner.html(data.html);

						$(document).trigger('wood-images-loaded');

						woodmartThemeModule.productHover();
						woodmartThemeModule.btnsToolTips();
						woodmartThemeModule.shopMasonry();
						woodmartThemeModule.productsLoadMore();
						woodmartThemeModule.countDownTimer();
						woodmartThemeModule.productLoaderPosition();
					}
				});

			});

			var $nav = $this.find('.tabs-navigation-wrapper'),
				$subList = $nav.find('ul'),
				time = 300;

			$nav.on('click', '.open-title-menu', function () {
				var $btn = $(this);

				if ($subList.hasClass('list-shown')) {
					$btn.removeClass('toggle-active');
					$subList.stop().slideUp(time).removeClass('list-shown');
				} else {
					$btn.addClass('toggle-active');
					$subList.addClass('list-shown');
					setTimeout(function () {
						$('body').one('click', function (e) {
							var target = e.target;
							if (!$(target).is('.tabs-navigation-wrapper') && !$(target).parents().is('.tabs-navigation-wrapper')) {
								$btn.removeClass('toggle-active');
								$subList.removeClass('list-shown');
								return false;
							}
						});
					}, 10);
				}

			})
				.on('click', 'li', function () {
					var $btn = $nav.find('.open-title-menu'),
						text = $(this).text();

					if ($subList.hasClass('list-shown')) {
						$btn.removeClass('toggle-active').text(text);
						$subList.removeClass('list-shown');
					}
				});

		});

		var loadTab = function (atts, index, holder, btn, cache, callback) {

			btn.parent().find('.active-tab-title').removeClass('active-tab-title');
			btn.addClass('active-tab-title')

			if (cache[index]) {
				holder.addClass('loading');
				setTimeout(function () {
					callback(cache[index]);
					holder.removeClass('loading');
					process = false;
				}, 300);
				return;
			}

			holder.addClass('loading').parent().addClass('element-loading');

			btn.addClass('loading');

			$.ajax({
				url: woodmart_settings.ajaxurl,
				data: {
					atts: atts,
					action: 'woodmart_get_products_tab_shortcode',
				},
				dataType: 'json',
				method: 'POST',
				success: function (data) {
					cache[index] = data;
					callback(data);
				},
				error: function (data) {
					console.log('ajax error');
				},
				complete: function () {
					holder.removeClass('loading').parent().removeClass('element-loading');
					btn.removeClass('loading');
					process = false;
					woodmartThemeModule.compare();
				},
			});
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Load more button for products shortcode
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productsLoadMore = function () {
		var process = false,
			intervalID;

		$('.woodmart-products-element').each(function () {
			var $this = $(this),
				cache = [],
				inner = $this.find('.woodmart-products-holder');

			if (!inner.hasClass('pagination-arrows')) return;

			cache[1] = {
				items: inner.html(),
				status: 'have-posts'
			};

			$this.on('recalc', function () {
				calc();
			});

			$(window).resize(function () {
				calc();
			});

			var calc = function () {
				var height = inner.outerHeight();
				$this.stop().css({ minHeight: height });
			};


			// sticky buttons

			var body = $('body'),
				btnWrap = $this.find('.products-footer'),
				btnLeft = btnWrap.find('.woodmart-products-load-prev'),
				btnRight = btnWrap.find('.woodmart-products-load-next'),
				loadWrapp = $this.find('.woodmart-products-loader'),
				scrollTop,
				holderTop,
				btnLeftOffset,
				btnRightOffset,
				holderBottom,
				holderHeight,
				holderWidth,
				btnsHeight,
				offsetArrow = 50,
				offset,
				windowWidth;

			if (body.hasClass('rtl')) {
				btnLeft = btnRight;
				btnRight = btnWrap.find('.woodmart-products-load-prev');
			}

			$(window).scroll(function () {
				buttonsPos();
			});

			function buttonsPos() {

				offset = $(window).height() / 2;

				windowWidth = $(window).outerWidth(true);

				holderWidth = $this.outerWidth(true);

				scrollTop = $(window).scrollTop();

				holderTop = $this.offset().top - offset;

				btnLeftOffset = $this.offset().left - offsetArrow;

				btnRightOffset = holderWidth + $this.offset().left + offsetArrow - btnRight.outerWidth();

				btnsHeight = btnLeft.outerHeight();

				holderHeight = $this.height() - btnsHeight;

				holderBottom = holderTop + holderHeight;

				if ($(window).width() <= 1024) {
					btnLeftOffset = btnLeftOffset + 35;
					btnRightOffset = btnRightOffset - 35;
				}

				btnLeft.css({
					'left': btnLeftOffset + 'px'
				});

				btnRight.css({
					'left': btnRightOffset + 'px'
				});

				if (scrollTop < holderTop || scrollTop > holderBottom) {
					btnWrap.removeClass('show-arrow');
					loadWrapp.addClass('hidden-loader');
				} else {
					btnWrap.addClass('show-arrow');
					loadWrapp.removeClass('hidden-loader');
				}

			};

			$this.find('.woodmart-products-load-prev, .woodmart-products-load-next').off('click').on('click', function (e) {

				e.preventDefault();

				if (process || $(this).hasClass('disabled')) return; process = true;

				clearInterval(intervalID);

				var $this = $(this),
					holder = $this.parent().parent().prev(),
					next = $this.parent().find('.woodmart-products-load-next'),
					prev = $this.parent().find('.woodmart-products-load-prev'),
					atts = holder.data('atts'),
					action = 'woodmart_get_products_shortcode',
					ajaxurl = woodmart_settings.ajaxurl,
					dataType = 'json',
					method = 'POST',
					paged = holder.attr('data-paged');

				paged++;

				if ($this.hasClass('woodmart-products-load-prev')) {
					if (paged < 2) return;
					paged = paged - 2;
				}

				loadProducts('arrows', atts, ajaxurl, action, dataType, method, paged, holder, $this, cache, function (data) {
					var isBorderedGrid = holder.hasClass('products-bordered-grid');

					if (!isBorderedGrid) {
						holder.addClass('woodmart-animated-products');
					}

					if (data.items) {
						holder.html(data.items).attr('data-paged', paged);
						holder.imagesLoaded().progress(function () {
							holder.parent().trigger('recalc');
						});

						$(document).trigger('wood-images-loaded');

						woodmartThemeModule.productHover();
						woodmartThemeModule.btnsToolTips();
					}

					if ($(window).width() < 768) {
						$('html, body').stop().animate({
							scrollTop: holder.offset().top - 150
						}, 400);
					}

					if (!isBorderedGrid) {
						var iter = 0;
						intervalID = setInterval(function () {
							holder.find('.product-grid-item').eq(iter).addClass('woodmart-animated');
							iter++;
						}, 100);
					}

					if (paged > 1) {
						prev.removeClass('disabled');
					} else {
						prev.addClass('disabled');
					}

					if (data.status == 'no-more-posts') {
						next.addClass('disabled');
					} else {
						next.removeClass('disabled');
					}
				});

			});
		});


		woodmartThemeModule.clickOnScrollButton(woodmartTheme.shopLoadMoreBtn, false, woodmart_settings.infinit_scroll_offset);

		$(document).off('click', '.woodmart-products-load-more').on('click', '.woodmart-products-load-more', function (e) {
			e.preventDefault();

			if (process) return; process = true;

			var $this = $(this),
				holder = $this.parent().siblings('.woodmart-products-holder'),
				source = holder.data('source'),
				action = 'woodmart_get_products_' + source,
				ajaxurl = woodmart_settings.ajaxurl,
				dataType = 'json',
				method = 'POST',
				atts = holder.data('atts'),
				paged = holder.data('paged');

			paged++;

			if (source == 'main_loop') {
				ajaxurl = $(this).attr('href');
				method = 'GET';
			}

			loadProducts('load-more', atts, ajaxurl, action, dataType, method, paged, holder, $this, [], function (data) {
				if (data.items) {
					if (holder.hasClass('grid-masonry')) {
						isotopeAppend(holder, data.items);
					} else {
						holder.append(data.items);
					}

					holder.imagesLoaded().progress(function () {
						woodmartThemeModule.clickOnScrollButton(woodmartTheme.shopLoadMoreBtn, true, woodmart_settings.infinit_scroll_offset);
					});

					$(document).trigger('wood-images-loaded');

					holder.data('paged', paged);

					woodmartThemeModule.productHover();
					woodmartThemeModule.btnsToolTips();
				}

				if (source == 'main_loop') {
					$this.attr('href', data.nextPage);
					if (data.status == 'no-more-posts') {
						$this.hide().remove();
					}
				}

				if (data.status == 'no-more-posts') {
					$this.hide();
				}
			});

		});

		var loadProducts = function (btnType, atts, ajaxurl, action, dataType, method, paged, holder, btn, cache, callback) {
			var data = {
				atts: atts,
				paged: paged,
				action: action,
				woo_ajax: 1,
			};

			if (cache[paged]) {
				holder.addClass('loading');
				setTimeout(function () {
					callback(cache[paged]);
					holder.removeClass('loading');
					process = false;
				}, 300);
				return;
			}

			if (btnType == 'arrows') holder.addClass('loading').parent().addClass('element-loading');

			btn.addClass('loading');

			if (action == 'woodmart_get_products_main_loop') {
				var loop = holder.find('.product').last().data('loop');
				data = {
					loop: loop,
					woo_ajax: 1
				};
			}

			$.ajax({
				url: ajaxurl,
				data: data,
				dataType: dataType,
				method: method,
				success: function (data) {
					cache[paged] = data;
					callback(data);
				},
				error: function (data) {
					console.log('ajax error');
				},
				complete: function () {
					if (btnType == 'arrows') holder.removeClass('loading').parent().removeClass('element-loading');
					btn.removeClass('loading');
					process = false;
					woodmartThemeModule.compare();
					woodmartThemeModule.productHover();
					woodmartThemeModule.countDownTimer();
				},
			});
		};

		var isotopeAppend = function (el, items) {
			// initialize Masonry after all images have loaded
			var items = $(items);
			el.append(items).isotope('appended', items);
			el.imagesLoaded().progress(function () {
				el.isotope('layout');
			});
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Compare button
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.compare = function () {
		var body = $("body"),
			button = $("a.compare");

		body.on("click", "a.compare", function () {
			$(this).addClass("loading");
		});

		body.on("yith_woocompare_open_popup", function () {
			button.removeClass("loading");
			body.addClass("compare-opened");
		});

		body.on('click', '#cboxClose, #cboxOverlay', function () {
			body.removeClass("compare-opened");
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * WoodMart compare functions
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.woodmartCompare = function () {
		var cookiesName = 'woodmart_compare_list';

		if (woodmart_settings.is_multisite) {
			cookiesName += '_' + woodmart_settings.current_blog_id;
		}

		var $body = $("body"),
			$widget = $('.woodmart-compare-info-widget'),
			compareCookie = Cookies.get(cookiesName);

		if ($widget.length > 0) {
			try {
				var ids = JSON.parse(compareCookie);
				$widget.find('.compare-count').text(ids.length);
			} catch (e) {
				console.log('cant parse cookies json');
			}
		}
		// Add to compare action

		$body.on('click', '.woodmart-compare-btn a', function (e) {
			var $this = $(this),
				id = $this.data('id'),
				addedText = $this.data('added-text');

			if ($this.hasClass('added')) return true;

			e.preventDefault();

			$this.addClass('loading');

			jQuery.ajax({
				url: woodmart_settings.ajaxurl,
				data: {
					action: 'woodmart_add_to_compare',
					id: id,
				},
				dataType: 'json',
				method: 'GET',
				success: function (response) {
					if (response.table) {
						updateCompare(response);
					} else {
						console.log('something wrong loading compare data ', response);
					}
				},
				error: function (data) {
					console.log('We cant add to compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
				complete: function () {
					$this.removeClass('loading').addClass('added');

					if ($this.find('span').length > 0) {
						$this.find('span').text(addedText);
					} else {
						$this.text(addedText);
					}
				},
			});

		});

		// Remove from compare action

		$body.on('click', '.woodmart-compare-remove', function (e) {
			var $table = $('.woodmart-compare-table');

			e.preventDefault();
			var $this = $(this),
				id = $this.data('id');

			$table.addClass('loading');
			$this.addClass('loading');

			jQuery.ajax({
				url: woodmart_settings.ajaxurl,
				data: {
					action: 'woodmart_remove_from_compare',
					id: id,
				},
				dataType: 'json',
				method: 'GET',
				success: function (response) {
					if (response.table) {
						updateCompare(response);
					} else {
						console.log('something wrong loading compare data ', response);
					}
				},
				error: function (data) {
					console.log('We cant remove product compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
				complete: function () {
					$table.removeClass('loading');
					$this.addClass('loading');
				},
			});

		});

		// Elements update after ajax

		function updateCompare(data) {
			if ($widget.length > 0) {
				$widget.find('.compare-count').text(data.count);
			}

			if ($('.woodmart-compare-table').length > 0) {
				$('.woodmart-compare-table').replaceWith(data.table);
			}

		}

	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Add class in wishlist
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.wishList = function () {
		var body = $("body");

		body.on("click", ".add_to_wishlist", function () {

			$(this).parent().addClass("feid-in");

		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product 360 button
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.product360Button = function () {
		$('.product-360-button a').magnificPopup({
			type: 'inline',
			mainClass: 'mfp-fade',
			// removalDelay: 500, //delay removal by X to allow out-animation
			// callbacks: {
			//     beforeOpen: function() {
			//         this.st.mainClass = woodmartTheme.popupEffect;
			//     }
			// },
			preloader: false,
			tClose: woodmart_settings.close,
			tLoading: woodmart_settings.loading,
			fixedContentPos: false,
			callbacks: {
				open: function () {
					$(window).resize()
				},
			},
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product video button
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productVideo = function () {
		$('.product-video-button a').magnificPopup({
			tClose: woodmart_settings.close,
			tLoading: woodmart_settings.loading,
			type: 'iframe',
			iframe: {
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id: 'v=',
						src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
					}
				}
			},
			preloader: false,
			fixedContentPos: false
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Login tabs for my account page
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.loginTabs = function () {
		var tabs = $('.woodmart-register-tabs'),
			btn = tabs.find('.woodmart-switch-to-register'),
			title = $('.col-register-text h2'),
			login = tabs.find('.col-login'),
			loginText = tabs.find('.login-info'),
			register = tabs.find('.col-register'),
			classOpened = 'active-register',
			loginLabel = btn.data('login'),
			registerLabel = btn.data('register');

		btn.on('click', function (e) {
			e.preventDefault();

			if (isShown()) {
				hideRegister();
			} else {
				showRegister();
			}

			var scrollTo = $('.main-page-wrapper').offset().top - 100;

			if ($(window).width() < 768) {
				$('html, body').stop().animate({
					scrollTop: tabs.offset().top - 90
				}, 400);
			}
		});

		var showRegister = function () {
			tabs.addClass(classOpened);
			btn.text(loginLabel);
			if (loginText.length > 0) {
				title.text(registerLabel);
			}
		};

		var hideRegister = function () {
			tabs.removeClass(classOpened);
			btn.text(registerLabel);
			if (loginText.length > 0) {
				title.text(loginLabel);
			}
		};

		var isShown = function () {
			return tabs.hasClass(classOpened);
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Header Categories menu for mobile
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.headerCategoriesMenu = function () {
		if ($(window).width() > 1024) return;

		var categories = $('.header-categories-nav'),
			catsUl = categories.find('.categories-menu-dropdown'),
			subCategories = categories.find('.menu-item-has-children'),
			button = categories.find('.menu-opener'),
			time = 200,
			iconDropdown = '<span class="drop-category"></span>';

		subCategories.find('> a').before(iconDropdown);

		catsUl.on('click', '.drop-category', function () {
			var sublist = $(this).parent().find('> .sub-menu-dropdown, >.sub-sub-menu');
			if (sublist.hasClass('child-open')) {
				$(this).removeClass("act-icon");
				sublist.slideUp(time).removeClass('child-open');
			} else {
				$(this).addClass("act-icon");
				sublist.slideDown(time).addClass('child-open');
			}
		});

		categories.on('click', '.menu-opener', function (e) {
			e.preventDefault();

			if (isOpened()) {
				closeCats();
			} else {
				//setTimeout(function() {
				openCats();
				//}, 50);
			}
		});

		catsUl.on('click', 'a', function (e) {
			closeCats();
			catsUl.stop().attr('style', '');
		});

		var isOpened = function () {
			return catsUl.hasClass('categories-opened');
		};

		var openCats = function () {
			catsUl.addClass('categories-opened').stop().slideDown(time);
			button.addClass('button-open');

		};

		var closeCats = function () {
			catsUl.removeClass('categories-opened').stop().slideUp(time);
			button.removeClass('button-open');
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Categories menu for mobile
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.categoriesMenu = function () {
		if ($(window).width() > 1024) return;

		var categories = $('.woodmart-product-categories'),
			subCategories = categories.find('li > ul'),
			button = $('.woodmart-show-categories'),
			time = 200;

		//this.categoriesMenuBtns();

		$('body').on('click', '.icon-drop-category', function () {
			if ($(this).closest('.has-sub').find('> ul').hasClass('child-open')) {
				$(this).removeClass("woodmart-act-icon").closest('.has-sub').find('> ul').slideUp(time).removeClass('child-open');
			} else {
				$(this).addClass("woodmart-act-icon").closest('.has-sub').find('> ul').slideDown(time).addClass('child-open');
			}
		});

		$('body').on('click', '.woodmart-show-categories', function (e) {
			e.preventDefault();

			if (isOpened()) {
				closeCats();
			} else {
				//setTimeout(function() {
				openCats();
				//}, 50);
			}
		});

		$('body').on('click', '.woodmart-product-categories a', function (e) {
			closeCats();
			categories.stop().attr('style', '');
		});

		var isOpened = function () {
			return $('.woodmart-product-categories').hasClass('categories-opened');
		};

		var openCats = function () {
			$('.woodmart-product-categories').addClass('categories-opened').stop().slideDown(time);
			$('.woodmart-show-categories').addClass('button-open');

		};

		var closeCats = function () {
			$('.woodmart-product-categories').removeClass('categories-opened').stop().slideUp(time);
			$('.woodmart-show-categories').removeClass('button-open');
		};
	};

	woodmartThemeModule.categoriesMenuBtns = function () {
		if ($(window).width() > 1024) return;

		var categories = $('.woodmart-product-categories'),
			subCategories = categories.find('li > ul'),
			iconDropdown = '<span class="icon-drop-category"></span>';

		categories.addClass('responsive-cateogires');
		subCategories.parent().addClass('has-sub').find('> .category-nav-link').prepend(iconDropdown);
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Filters area
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.filtersArea = function () {
		var filters = $('.filters-area'),
			btn = $('.open-filters'),
			time = 200;

		$('body').on('click', '.open-filters', function (e) {
			e.preventDefault();

			if (isOpened()) {
				closeFilters();
			} else {
				woodmartThemeModule.openFilters(time);
				setTimeout(function () {
					woodmartThemeModule.shopLoader();
				}, time);
			}

		});

		if (woodmart_settings.shop_filters_close == 'no') {
			$('body').on('click', woodmartTheme.ajaxLinks, function () {
				if (isOpened()) {
					closeFilters();
				}
			});
		}

		var isOpened = function () {
			filters = $('.filters-area')
			return filters.hasClass('filters-opened');
		};

		var closeFilters = function () {
			filters = $('.filters-area')
			filters.removeClass('filters-opened');
			filters.stop().slideUp(time);
			$('.open-filters').removeClass('btn-opened');
		};
	};

	woodmartThemeModule.openFilters = function (time) {
		var filters = $('.filters-area')
		filters.stop().slideDown(time);
		$('.open-filters').addClass('btn-opened');
		setTimeout(function () {
			filters.addClass('filters-opened');
			$('body').removeClass('body-filters-opened');
			woodmartThemeModule.nanoScroller();
			$(document).trigger('wood-images-loaded');
		}, time);
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Init shop page JS functions
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.shopPageInit = function () {
		woodmartThemeModule.shopMasonry();
		woodmartThemeModule.ajaxSearch();
		woodmartThemeModule.productHover();
		woodmartThemeModule.btnsToolTips();
		woodmartThemeModule.compare();
		woodmartThemeModule.filterDropdowns();
		woodmartThemeModule.sortByWidget();
		woodmartThemeModule.categoriesMenuBtns();
		woodmartThemeModule.categoriesAccordion();
		woodmartThemeModule.woocommercePriceSlider();
		woodmartThemeModule.updateCartWidgetFromLocalStorage(); // refresh cart in sidebar
		woodmartThemeModule.countDownTimer();
		woodmartThemeModule.nanoScroller();
		woodmartThemeModule.shopLoader();
		woodmartThemeModule.stickySidebarBtn();
		woodmartThemeModule.productFilters();

		woodmartThemeModule.clickOnScrollButton(woodmartTheme.shopLoadMoreBtn, false, woodmart_settings.infinit_scroll_offset);

		// Bootstrap tooltips reset

		$('body > .tooltip').remove();

		$(document.body).on('updated_wc_div', function () {
			$(document).trigger('wood-images-loaded');
		});

		$(document).trigger('resize.vcRowBehaviour');
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Ajax filters
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.ajaxFilters = function () {
		if (!$('body').hasClass('woodmart-ajax-shop-on') || typeof ($.fn.pjax) == 'undefined') return;

		var that = this,
			filtersState = false,
			products = $('.products');

		$('body').on('click', '.post-type-archive-product .products-footer .woocommerce-pagination a', function (e) {
			scrollToTop(true);
		});

		$(document).pjax(woodmartTheme.ajaxLinks, '.main-page-wrapper', {
			timeout: woodmart_settings.pjax_timeout,
			scrollTo: false
		});

		if (woodmart_settings.price_filter_action == 'click') {
			$(document).on('click', '.widget_price_filter form .button', function () {
				var form = $('.widget_price_filter form');
				$.pjax({
					container: '.main-page-wrapper',
					timeout: woodmart_settings.pjax_timeout,
					url: form.attr('action'),
					data: form.serialize(),
					scrollTo: false
				});

				return false;
			});
		} else if (woodmart_settings.price_filter_action == 'submit') {
			$(document).on('submit', '.widget_price_filter form', function (event) {
				var container = $('.main-page-wrapper');
				$.pjax.submit(event, container);
			});
		}

		$(document).on('pjax:error', function (xhr, textStatus, error, options) {
			console.log('pjax error ' + error);
		});

		$(document).on('pjax:start', function (xhr, options) {
			$('.site-content').removeClass('ajax-loaded');
			$('.site-content').addClass('ajax-loading');
			woodmartThemeModule.hideShopSidebar();
		});

		$(document).on('pjax:complete', function (xhr, textStatus, options) {

			that.shopPageInit();
			scrollToTop(false);

			$(document).trigger('wood-images-loaded');

			$('.woodmart-sidebar-content').scroll(function () {
				$(document).trigger('wood-images-loaded');
			})

			$('.site-content').removeClass('ajax-loading');
		});

		$(document).on('pjax:beforeReplace', function (contents, options) {
			if ($('.filters-area').hasClass('filters-opened') && woodmart_settings.shop_filters_close == 'yes') {
				filtersState = true;
				$('body').addClass('body-filters-opened');
			}
		});

		$(document).on('pjax:end', function (xhr, textStatus, options) {
			if (filtersState) {
				$('.filters-area').css('display', 'block');
				woodmartThemeModule.openFilters(200);
				filtersState = false;
			}
			$('.site-content').removeClass('ajax-loading');
			$('.site-content').addClass('ajax-loaded');
		});

		var scrollToTop = function (type) {
			if (woodmart_settings.ajax_scroll == 'no' && type == false) return false;

			var $scrollTo = $(woodmart_settings.ajax_scroll_class),
				scrollTo = $scrollTo.offset().top - woodmart_settings.ajax_scroll_offset;

			$('html, body').stop().animate({
				scrollTop: scrollTo
			}, 400);
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Side shopping cart widget
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.cartWidget = function () {
		var widget = $('.cart-widget-opener'),
			btn = widget.find('a'),
			body = $('body');

		var cartWidgetSide = $('.cart-widget-side');
		var closeSide = $('.woodmart-close-side');

		widget.on('click', function (e) {
			if (!isCart() && !isCheckout()) e.preventDefault();

			if (isOpened()) {
				closeWidget();
			} else {
				setTimeout(function () {
					openWidget();
				}, 10);
			}

		});

		body.on("click touchstart", ".woodmart-close-side", function () {
			if (isOpened()) {
				closeWidget();
			}
		});

		body.on("click", ".close-side-widget", function (e) {
			e.preventDefault();
			if (isOpened()) {
				closeWidget();
			}
		});

		$(document).keyup(function (e) {
			if (e.keyCode === 27 && isOpened()) closeWidget();
		});

		var closeWidget = function () {
			cartWidgetSide.removeClass('woodmart-cart-opened');
			closeSide.removeClass('woodmart-close-side-opened');
		};

		var openWidget = function () {
			if (isCart() || isCheckout()) return false;
			cartWidgetSide.addClass('woodmart-cart-opened');
			closeSide.addClass('woodmart-close-side-opened');
		};

		var isOpened = function () {
			return cartWidgetSide.hasClass('woodmart-cart-opened');
		};

		var isCart = function () {
			return $('body').hasClass('woocommerce-cart');
		};

		var isCheckout = function () {
			return $('body').hasClass('woocommerce-checkout');
		};
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Quantityt +/-
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.woocommerceQuantity = function () {
		if (!String.prototype.getDecimals) {
			String.prototype.getDecimals = function () {
				var num = this,
					match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
				if (!match) {
					return 0;
				}
				return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
			}
		}

		$(document).on('click', '.plus, .minus', function () {
			// Get values
			var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			// Format values
			if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
			if (max === '' || max === 'NaN') max = '';
			if (min === '' || min === 'NaN') min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = '1';

			// Change the value
			if ($(this).is('.plus')) {
				if (max && (currentVal >= max)) {
					$qty.val(max);
				} else {
					$qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
				}
			} else {
				if (min && (currentVal <= min)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
				}
			}

			// Trigger change event
			$qty.trigger('change');
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * On remove from cart widget
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.onRemoveFromCart = function () {
		$(document).on('click', '.widget_shopping_cart .remove', function (e) {
			e.preventDefault();
			$(this).parent().addClass('removing-process');
		});
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Fix comments
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.woocommerceComments = function () {
		var hash = window.location.hash;
		var url = window.location.href;

		if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews' || url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0) {

			setTimeout(function () {
				window.scrollTo(0, 0);
			}, 1);

			setTimeout(function () {
				if ($(hash).length > 0) {
					$('html, body').stop().animate({
						scrollTop: $(hash).offset().top - 100
					}, 400);
				}
			}, 10);

		}
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Mobile responsive navigation
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.woocommerceWrappTable = function () {
		var wooTable = $(".shop_table:not(.shop_table_responsive):not(.woocommerce-checkout-review-order-table)").wrap("<div class='responsive-table'></div>");
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product loder position
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.productLoaderPosition = function () {
		var recalc = function () {
			$('.woodmart-products-loader').each(function () {
				var $loader = $(this),
					$loaderWrap = $loader.parent();

				if ($loader.length == 0) return;

				$loader.css('left', $loaderWrap.offset().left + $loaderWrap.outerWidth() / 2);
			});
		};

		$(window).on('resize', recalc);

		recalc();
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Init Zoom
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.initZoom = function () {
		if (woodmart_settings.zoom_enable != 'yes') return false;

		var $zoomTarget = $('.woocommerce-product-gallery__image'),
			zoomEnabled = false;

		$($zoomTarget).each(function () {
			var image = $(this).find('img');

			if (image.data('large_image_width') > $('.product-image-wrap').width()) {
				zoomEnabled = true;
				return false;
			}
		});


		// But only zoom if the img is larger than its container.
		if (zoomEnabled) {
			var zoomOptions = {
				touch: false
			};

			if ('ontouchstart' in window) {
				zoomOptions.on = 'click';
			}

			$zoomTarget.trigger('zoom.destroy');
			$zoomTarget.zoom(zoomOptions);
		}
	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Product Hover
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	woodmartThemeModule.productHover = function () {

		$('.woodmart-hover-base').each(function () {

			var $product = $(this);

			$product.imagesLoaded(function () {

				// Read more details button

				var btnHTML = '<a href="#" class="more-details-btn"><span>' + 'more' + '</a></span>',
					content = $product.find('.hover-content'),
					inner = content.find('.hover-content-inner'),
					contentHeight = content.outerHeight(),
					innerHeight = inner.outerHeight(),
					delta = innerHeight - contentHeight;

				if (content.hasClass('more-description')) return;

				if (delta > 30) {
					content.addClass('more-description');
					content.append(btnHTML);
				} else if (delta > 0) {
					content.css('height', contentHeight + delta);
				}

				// Bottom block height

				recalc($product);
			});

		});

		$('body').on('click', '.more-details-btn', function (e) {
			e.preventDefault();
			$(this).parent().addClass('show-full-description');
			recalc($(this).parents('.woodmart-hover-base'));
		});

		if ($(window).width() <= 1024) {
			$('.woodmart-hover-base').on('click', function (e) {
				var hoverClass = 'state-hover';
				if (!$(this).hasClass(hoverClass) && woodmart_settings.base_hover_mobile_click == 'no') {
					e.preventDefault();
					$('.' + hoverClass).removeClass(hoverClass);
					$(this).addClass(hoverClass);
				}
			});
			$(document).on('click touchstart', function (e) {
				if ($(e.target).closest('.state-hover').length == 0) {
					$('.state-hover').removeClass('state-hover');
				}
			});
		}

		var recalc = function ($el) {

			if ($el.hasClass('product-in-carousel')) {
				return;
			}

			var heightHideInfo = $el.find('.fade-in-block').outerHeight();

			$el.find('.content-product-imagin').css({
				marginBottom: -heightHideInfo
			});

			$el.addClass('hover-ready');
		};

		$('.product-grid-item').each(function () {
			var $el = $(this),
				widthHiddenInfo = $el.outerWidth();

			if ($(window).width() <= 1024 && $el.hasClass('woodmart-hover-icons') || !woodmart_settings.hover_width_small) return;

			if (widthHiddenInfo < 255 || $(window).width() <= 1024) {
				$el.removeClass('hover-width-big').addClass('hover-width-small');
			} else {
				$el.removeClass('hover-width-small').addClass('hover-width-big');
			}
		})

	};
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Enable masonry grid for shop isotope type
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	woodmartThemeModule.shopMasonry = function () {

		if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') return;
		var $container = $('.elements-grid.grid-masonry');
		// initialize Masonry after all images have loaded
		$container.imagesLoaded(function () {
			$container.isotope({
				isOriginLeft: !$('body').hasClass('rtl'),
				itemSelector: '.category-grid-item, .product-grid-item',
			});
		});

		// Categories masonry
		$(window).resize(function () {
			var $catsContainer = $('.categories-masonry');
			var colWidth = ($catsContainer.hasClass('categories-style-masonry')) ? '.category-grid-item' : '.col-lg-3.category-grid-item';
			$catsContainer.imagesLoaded(function () {
				$catsContainer.packery({
					resizable: false,
					isOriginLeft: !$('body').hasClass('rtl'),
					// layoutMode: 'packery',
					packery: {
						gutter: 0,
						columnWidth: colWidth
					},
					itemSelector: '.category-grid-item',
					// masonry: {
					// gutter: 0
					// }
				});
			});
		});

	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Categories toggle accordion
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	woodmartThemeModule.categoriesAccordion = function () {

		if (woodmart_settings.categories_toggle == 'no') return;

		var $widget = $('.widget_product_categories'),
			$list = $widget.find('.product-categories'),
			time = 300;

		$list.find('.cat-parent').each(function () {
			if ($(this).find(' > .woodmart-cats-toggle').length > 0) return;
			if ($(this).find(' > .children').length == 0) return;
			$(this).append('<div class="woodmart-cats-toggle"></div>');
		});

		$list.on('click', '.woodmart-cats-toggle', function () {
			var $btn = $(this),
				$subList = $btn.prev();

			if ($subList.hasClass('list-shown')) {
				$btn.removeClass('toggle-active');
				$subList.stop().slideUp(time).removeClass('list-shown');
			} else {
				$subList.parent().parent().find('> li > .list-shown').slideUp().removeClass('list-shown');
				$subList.parent().parent().find('> li > .toggle-active').removeClass('toggle-active');
				$btn.addClass('toggle-active');
				$subList.stop().slideDown(time).addClass('list-shown');
			}
		});

		if ($list.find('li.current-cat.cat-parent, li.current-cat-parent').length > 0) {
			$list.find('li.current-cat.cat-parent, li.current-cat-parent').find('> .woodmart-cats-toggle').click();
		}

	};

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * WooCommerce price filter slider with ajax
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */

	woodmartThemeModule.woocommercePriceSlider = function () {

		// woocommerce_price_slider_params is required to continue, ensure the object exists
		if (typeof woocommerce_price_slider_params === 'undefined' || $('.price_slider_amount #min_price').length < 1 || !$.fn.slider) {
			return false;
		}

		var $slider = $('.price_slider');

		if ($slider.slider('instance') !== undefined) return;

		// Get markup ready for slider
		$('input#min_price, input#max_price').hide();
		$('.price_slider, .price_label').show();

		// Price slider uses $ ui
		var min_price = $('.price_slider_amount #min_price').data('min'),
			max_price = $('.price_slider_amount #max_price').data('max'),
			current_min_price = parseInt(min_price, 10),
			current_max_price = parseInt(max_price, 10);

		if ($('.products').attr('data-min_price') && $('.products').attr('data-min_price').length > 0) {
			current_min_price = parseInt($('.products').attr('data-min_price'), 10);
		}
		if ($('.products').attr('data-max_price') && $('.products').attr('data-max_price').length > 0) {
			current_max_price = parseInt($('.products').attr('data-max_price'), 10);
		}

		$slider.slider({
			range: true,
			animate: true,
			min: min_price,
			max: max_price,
			values: [current_min_price, current_max_price],
			create: function () {

				$('.price_slider_amount #min_price').val(current_min_price);
				$('.price_slider_amount #max_price').val(current_max_price);

				$(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
			},
			slide: function (event, ui) {

				$('input#min_price').val(ui.values[0]);
				$('input#max_price').val(ui.values[1]);

				$(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
			},
			change: function (event, ui) {

				$(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
			}
		});

		setTimeout(function () {
			$(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
			if ($slider.find('.ui-slider-range').length > 1) $slider.find('.ui-slider-range').first().remove();
		}, 10);
	};

})(jQuery);

jQuery(document).ready(function () {
	woodmartThemeModule.init();
}); 
