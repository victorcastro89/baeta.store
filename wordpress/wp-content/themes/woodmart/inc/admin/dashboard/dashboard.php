<?php if ( ! defined('WOODMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Theme dashbaord
 * ------------------------------------------------------------------------------------------------
 */
if( ! class_exists( 'WOODMART_Dashboard' ) ) {
	class WOODMART_Dashboard {

		public $page_name = 'woodmart_dashboard';

		public $tabs;

		public $current_tab = 'home';
		
		private $_notices = null;

		public function __construct() {
			$this->tabs = array(
				'home' => esc_html__( 'Base import', 'woodmart' ), 
				'additional' => esc_html__( 'Additional pages', 'woodmart' ), 
				'builder' => esc_html__( 'Header builder', 'woodmart' ), 
				'license' => esc_html__( 'Theme license', 'woodmart' ), 
				'css' => esc_html__( 'CSS Generator', 'woodmart' ), 
			);
			
			add_action( 'admin_menu', array( $this, 'menu_page' ) );
			
			add_action( 'admin_notices', array( $this, 'add_notices' ), 40 );
			
			$this->_notices = WOODMART_Registry()->notices;
			
		}
		public function menu_page() {

			if ( ! current_user_can( 'administrator' ) ) {
				return;
			}
			
			if ( ! woodmart_get_opt( 'dummy_import' ) ) {
				unset( $this->tabs['home'] );
				unset( $this->tabs['additional'] );
			}

			$addMenuPage = 'add_me' . 'nu_page';
			$addMenuPage( 
				esc_html__( 'WoodMart', 'woodmart' ), 
				esc_html__( 'WoodMart', 'woodmart' ), 
				'manage_options', 
				$this->page_name, 
				array( $this, 'dashboard' ),
				WOODMART_ASSETS . '/images/theme-admin-icon.svg', 
				62 
			);
			
			if ( woodmart_get_opt( 'dummy_import' ) ) {
				add_submenu_page(
					$this->page_name,
					'Base import',
					'Base import',
					'edit_posts',
					'admin.php?page=' . $this->page_name . '&tab=home',
					'' 
				); 
				add_submenu_page(
					$this->page_name,
					'Additional pages',
					'Additional pages',
					'edit_posts',
					'admin.php?page=' . $this->page_name . '&tab=additional',
					'' 
				); 
			}
			
			add_submenu_page(
				$this->page_name,
				'Header builder',
				'Header builder',
				'edit_posts',
				'admin.php?page=' . $this->page_name . '&tab=builder',
				'' 
			); 

			if ( class_exists( 'Redux' ) ) {
				add_submenu_page(
					$this->page_name,
					'Theme settings',
					'Theme settings',
					'edit_posts',
					'admin.php?page=_options&tab=1',
					'' 
				); 
			}

			add_submenu_page(
				$this->page_name,
				'Theme license',
				'Theme license',
				'edit_posts',
				'admin.php?page=' . $this->page_name . '&tab=license',
				'' 
			); 

			add_submenu_page(
				$this->page_name,
				'CSS Generator',
				'CSS Generator',
				'edit_posts',
				'admin.php?page=' . $this->page_name . '&tab=css',
				'' 
			); 

			remove_submenu_page($this->page_name, $this->page_name);
		}

		public function get_tabs() {
			return $this->tabs;
		}

		public function get_current_tab() {
			return $this->current_tab;
		}

		public function set_current_tab( $tab ) {
			$this->current_tab = $tab;
		}

		public function dashboard() {
			$tab = 'home';
			if( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) {
				$tab = trim( sanitize_text_field( $_GET['tab'] ) );

				if( ! isset( $this->tabs[ $tab ] ) ) $tab = 'home';

				$this->set_current_tab( $tab );
			} 
			
			$this->show_page( 'tabs/' . $tab );
		}

		public function tab_url( $tab ) {
			if( ! isset( $this->tabs[ $tab ] ) ) $tab = 'home';
			return admin_url( 'admin.php?page=' . $this->page_name . '&tab=' . $tab );
		}

		public function show_page( $name = 'home') {

			$this->show_part( 'header' );
			$this->show_part( $name );
			$this->show_part( 'footer' );

		}

		public function show_part( $name, $data = array() ) {
			include_once get_parent_theme_file_path( WOODMART_FRAMEWORK . '/admin/dashboard/views/' . $name . '.php');
		}

		public function get_version() {
			$theme = wp_get_theme();
			$v = $theme->get('Version');
			$v_data = explode('.', $v);
			return $v_data[0].'.'.$v_data[1];
		}
		
		public function add_notices() {
			if ( ! woodmart_is_license_activated() ) {
				$this->_notices->add_msg( 'Please, activate your purchase code for the WoodMart theme and enable auto updates <a href="' . $this->tab_url( 'license' ) . '">here</a>. <br /> <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">Where can I get my purchase code?</a>', 'warning', true );
			}

			$file = get_option( 'woodmart-generated-css-file' );
			$theme_version = woodmart_get_theme_info( 'Version' );
			
			if ( isset( $file['file'] ) ) {
				$data = get_file_data( $file['file'], array( 'Version' => 'Version' ) );

				if ( version_compare( $data['Version'], $theme_version, '<' ) ) {
					$this->_notices->add_msg( 'Your custom generated CSS file is outdated. The current version of the theme is ' . $theme_version . ' so you need to go here and click on "<a href="' . $this->tab_url( 'css' ) . '">Update</a>" button to actualize it.', 'warning', true );
				}
			}

			if ( is_user_logged_in() && ! defined( 'WOODMART_CORE_PLUGIN_VERSION' ) || ( defined( 'WOODMART_CORE_PLUGIN_VERSION' ) && version_compare( WOODMART_CORE_PLUGIN_VERSION, WOODMART_CORE_VERSION, '<' ) ) ) {
				$this->_notices->add_msg( 'You just installed the latest version of the WoodMart theme. To finish the installation and enable all theme\'s function  or if you see any problems with your WPBakery elements displayed as shortcodes you need to install the latest version of the WoodMart Core Plugin too. Go to <a href=' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '>Appearance -> Install plugins</a> and click on "Install" or "Update" button.', 'warning', true );
			}
			
		}
		
	}

	$woodmart_dashboard = new WOODMART_Dashboard();
}
