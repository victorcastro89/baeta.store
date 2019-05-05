<?php
/**
 * Shoptimizer Class
 *
 * @author   CommerceGurus
 * @since    1.0.0
 * @package  shoptimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'shoptimizer' ) ) :

	/**
	 * The main Shoptimizer class
	 */
	class shoptimizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ),       10 );
			add_action( 'wp_enqueue_scripts',         array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
			add_filter( 'body_class',                 array( $this, 'body_classes' ) );
			add_filter( 'wp_page_menu_args',          array( $this, 'page_menu_args' ) );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			load_theme_textdomain( 'shoptimizer', trailingslashit( WP_LANG_DIR ) . 'themes/' );
			load_theme_textdomain( 'shoptimizer', get_stylesheet_directory() . '/languages' );
			load_theme_textdomain( 'shoptimizer', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Enable support for site logo
			 */
			add_theme_support( 'custom-logo', apply_filters( 'shoptimizer_custom_logo_args', array(
				'height'      => 110,
				'width'       => 470,
				'flex-height' => true,
				'flex-width'  => true,
			) ) );

			// This theme uses wp_nav_menu() in two locations.
			register_nav_menus( apply_filters( 'shoptimizer_register_nav_menus', array(
				'primary'   => __( 'Primary Menu', 'shoptimizer' ),
				'secondary' => __( 'Secondary Menu', 'shoptimizer' ),
			) ) );

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', apply_filters( 'shoptimizer_html5_args', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			) ) );

			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support( 'site-logo', apply_filters( 'shoptimizer_site_logo_args', array(
				'size' => 'full'
			) ) );

			// Declare WooCommerce support.
			add_theme_support( 'woocommerce', apply_filters( 'shoptimizer_woocommerce_args', array(
				//'single_image_width'    => 800,
				//'thumbnail_image_width' => 400,
				'product_grid'          => array(
					'default_columns' => 3,
					'default_rows'    => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
					'min_rows'        => 1
				)
			) ) );

			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
				return array(
				'width' => 150,
				'height' => 150,
				'crop' => 0,
				);
			} );

			//update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );

			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Declare Gutenberg wide images support.
			add_theme_support( 'align-wide' );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
			$sidebar_args['sidebar'] = array(
				'name'          => __( 'Sidebar', 'shoptimizer' ),
				'id'            => 'sidebar-1',
				'description'   => 'The WooCommerce archives sidebar.'
			);

			$sidebar_args['sidebar-posts'] = array(
				'name'        => __( 'Sidebar Posts', 'shoptimizer' ),
				'id'          => 'sidebar-posts',
				'description' => __( 'The posts sidebar.', 'shoptimizer' ),
			);

			$sidebar_args['sidebar-pages'] = array(
				'name'        => __( 'Sidebar Pages', 'shoptimizer' ),
				'id'          => 'sidebar-pages',
				'description' => __( 'The pages sidebar.', 'shoptimizer' ),
			);

			$sidebar_args['header'] = array(
				'name'        => __( 'Below Header', 'shoptimizer' ),
				'id'          => 'header-1',
				'description' => __( 'Widgets added to this region will appear beneath the header and above the main content.', 'shoptimizer' ),
			);

			$sidebar_args['top-bar-left'] = array(
				'name'        => __( 'Top Bar Left', 'shoptimizer' ),
				'id'          => 'top-bar-left',
				'description' => __( 'A widget added to this region will appear at the very top of the site to the left.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-left  %2$s">',
    			'after_widget' => '</div>', 
			);

			$sidebar_args['top-bar'] = array(
				'name'        => __( 'Top Bar Center', 'shoptimizer' ),
				'id'          => 'top-bar',
				'description' => __( 'A widget added to this region will appear at the very top of the site in the center.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-center  %2$s">',
    			'after_widget' => '</div>', 
			);

			$sidebar_args['top-bar-right'] = array(
				'name'        => __( 'Top Bar Right', 'shoptimizer' ),
				'id'          => 'top-bar-right',
				'description' => __( 'A widget added to this region will appear at the very top of the site to the right.', 'shoptimizer' ),
				'before_widget' => '<div class="top-bar-right  %2$s">',
    			'after_widget' => '</div>', 
			);

			$sidebar_args['single-product-field'] = array(
				'name'        => __( 'Single Product Custom Area', 'shoptimizer' ),
				'id'          => 'single-product-field',
				'description' => __( 'A widget added to this region will appear below the "Add to cart" button on a product page.', 'shoptimizer' ),
			);

			$sidebar_args['floating-button-content'] = array(
				'name'        => __( 'Floating Button Modal Content', 'shoptimizer' ),
				'id'          => 'floating-button-content',
				'description' => __( 'A widget added to this region will appear within a modal window on a single product page. It is intended for a form shortcode, e.g. Contact Form 7 - but you can add any content you wish.', 'shoptimizer' ),
			);

			$sidebar_args['cart-field'] = array(
				'name'        => __( 'Cart Custom Area', 'shoptimizer' ),
				'id'          => 'cart-field',
				'description' => __( 'A widget added to this region will appear below the "Proceed to checkout" button on the Cart page.', 'shoptimizer' ),
			);

			$sidebar_args['checkout-field'] = array(
				'name'        => __( 'Checkout Custom Area', 'shoptimizer' ),
				'id'          => 'checkout-field',
				'description' => __( 'A widget added to this region will appear below the "Place order" button on the Checkout page.', 'shoptimizer' ),
			);

			$sidebar_args['below-content'] = array(
				'name'        => __( 'Below Content', 'shoptimizer' ),
				'id'          => 'below-content',
				'description' => __( 'A widget added to this region will appear below the main content area.', 'shoptimizer' ),
			);

			$sidebar_args['footer'] = array(
				'name'        => __( 'Footer', 'shoptimizer' ),
				'id'          => 'footer',
				'description' => __( 'A widget added to this region will appear within the footer area.', 'shoptimizer' ),
			);

			$sidebar_args['copyright'] = array(
				'name'        => __( 'Copyright', 'shoptimizer' ),
				'id'          => 'copyright',
				'description' => __( 'A widget added to this region will appear within the copyright area.', 'shoptimizer' ),
			);

			$sidebar_args = apply_filters( 'shoptimizer_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>',
				);

				$filter_hook = sprintf( 'shoptimizer_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $shoptimizer_version;

			/**
			 * Styles
			 */
			wp_enqueue_style( 'shoptimizer-style', get_template_directory_uri() . '/style.css', '', $shoptimizer_version );
			wp_enqueue_style( 'shoptimizer-rivolicons', get_template_directory_uri() . '/assets/css/base/rivolicons.css', '', $shoptimizer_version );

			/**
			 * Scripts
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( 'shoptimizer-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20130115', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since  1.0.0
		 */
		public function child_scripts() {
			if ( is_child_theme() ) {
				$child_theme = wp_get_theme( get_stylesheet() );
				wp_enqueue_style( 'shoptimizer-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
			}
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 * @return array
		 */
		public function page_menu_args( $args ) {
			$args['show_home'] = true;
			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// If the main sidebar doesn't contain widgets, adjust the layout to be full-width.
			if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'shoptimizer-full-width-content';
			}

			return $classes;
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function navigation_markup_template() {
			$template  = '<nav id="post-navigation" class="navigation %1$s" aria-label="' . esc_html__( 'Post Navigation', 'shoptimizer' ) . '">';
			$template .= '<span class="screen-reader-text">%2$s</span>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'shoptimizer_navigation_markup_template', $template );
		}

	}
endif;

return new shoptimizer();
