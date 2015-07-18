<?php
/*
Plugin Name: Hotel Reservation WP

Plugin URI: http://hotelreservationwp.com/

Description: A Hotel Reservation and Booking System.

Version: 1.0.0

Author: PluginCreations

Author URI: http://hotelreservationwp.com/

License: GPLv2 or later

Text Domain: hrwp

*/


if ( !function_exists( 'add_action' ) ) {

	exit;

}


if( !class_exists ( 'HrwpMain' ) ){

	class HrwpMain {
		
		protected static $_instance = null;
		

		public static function instance() {

			if ( is_null( self::$_instance ) ) {

				self::$_instance = new self();

			}

			return self::$_instance;

		}
		

		public function __construct() {
			

			register_activation_hook( __FILE__, array( get_class($this), 'add_option_after_plugin_activation' ) );

			register_deactivation_hook( __FILE__, array( get_class($this), 'after_plugin_deactivation' ) );


			add_action( 'admin_init', array( $this, 'after_plugin_activation_func' ) );

			add_action('admin_menu', array( $this, 'hide_add_new_booking_post') );

			add_action('init', array($this,'process_hotel_search_code'));
			

			$this->defines();

			$this->includes();

		}


		


		public function add_option_after_plugin_activation(){


			add_option( 'GAHB_atithi_hbs_activated_plugin_option', 'GAHB_atithi_hbs_activated_plugin_option_value' );


		}


		


		public function after_plugin_deactivation(){


			/* here onwards do the stuff which needs to be done right after this plugin deactivation */


			update_option( 'GAHB_atithi_hbs_plugin_activated', 'no');


		}


		


		public function after_plugin_activation_func(){


			if ( is_admin() && get_option( 'GAHB_atithi_hbs_activated_plugin_option' ) == 'GAHB_atithi_hbs_activated_plugin_option_value' ) {


				delete_option( 'GAHB_atithi_hbs_activated_plugin_option' );


				


				/* here onwards do the stuff which needs to be done right after this plugin activation */


				update_option( 'GAHB_atithi_hbs_plugin_activated', 'yes');


				require_once 'includes/admin/class-create-tables.php';


				require_once 'includes/admin/create-pages.php';


			}


		}


		


		public function defines() {


			


			if ( ! defined( 'GAHB__VERSION' ) ) {


				define( 'GAHB__VERSION', $this->plugin_version );


			}


			


			if ( ! defined( 'GAHB__MINIMUM_WP_VERSION' ) ) {


				define( 'GAHB__MINIMUM_WP_VERSION', '4.0' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_SLUG' ) ) {


				define( 'GAHB__MINIMUM_WP_VERSION', 'atithi-hotel-booking' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_URL_PATH' ) ) {


				define( 'GAHB__PLUGIN_URL_PATH', trailingslashit( plugin_dir_url( __FILE__ ) ) );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_DIR_PATH' ) ) {


				define( 'GAHB__PLUGIN_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_DIR_SCRIPT_NAME' ) ) {


				define( 'GAHB__PLUGIN_DIR_SCRIPT_NAME', trailingslashit( plugin_basename( __FILE__ ) ) );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_DIR_NAME' ) ) {


				$GAHB__PLUGIN_DIR_SCRIPT_NAME = GAHB__PLUGIN_DIR_SCRIPT_NAME;


				$GAHB__PLUGIN_DIR_SCRIPT = explode( "/", $GAHB__PLUGIN_DIR_SCRIPT_NAME );


				define( 'GAHB__PLUGIN_DIR_NAME', trailingslashit( $GAHB__PLUGIN_DIR_SCRIPT[0] ) );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_SCRIPT_NAME' ) ) {


				$GAHB__PLUGIN_DIR_SCRIPT_NAME = GAHB__PLUGIN_DIR_SCRIPT_NAME;


				$GAHB__PLUGIN_DIR_SCRIPT = explode( "/", $GAHB__PLUGIN_DIR_SCRIPT_NAME );


				define( 'GAHB__PLUGIN_SCRIPT_NAME', $GAHB__PLUGIN_DIR_SCRIPT[1] );


			}


			


			if ( ! defined( 'GAHB__PLUGINS_DIR_PATH' ) ) {


				$dir = trailingslashit( plugin_dir_path( __FILE__ ) );


				$plugin_dir_name = trailingslashit( GAHB__PLUGIN_DIR_NAME );


				$plugins_dir_path = substr( $dir, 0, strrpos( $dir, $plugin_dir_name ) );


				


				define( 'GAHB__PLUGINS_DIR_PATH', trailingslashit( $plugins_dir_path ) );


			}


			


			if ( ! defined( 'GAHB__PLUGINS_URL_PATH' ) ) {


				$url = trailingslashit( plugin_dir_url( __FILE__ ) );


				$plugin_dir_name = trailingslashit( GAHB__PLUGIN_DIR_NAME );


				$plugins_url_path = substr( $url, 0, strrpos( $dir, $plugin_dir_name ) );


				


				define( 'GAHB__PLUGINS_URL_PATH', trailingslashit( $plugins_url_path ) );


			}


			


			if ( ! defined( 'GAHB__THEME_DIR_PATH' ) ) {


				define( 'GAHB__THEME_DIR_PATH', trailingslashit( get_template_directory() ) );


			}


			


			if ( ! defined( 'GAHB__THEME_URL_PATH' ) ) {


				define( 'GAHB__THEME_URL_PATH', trailingslashit( get_template_directory_uri() ) );


			}


			


			if ( ! defined( 'GAHB__CHILD_THEME_DIR_PATH' ) ) {


				define( 'GAHB__CHILD_THEME_DIR_PATH', trailingslashit( get_stylesheet_directory() ) );


			}


			


			if ( ! defined( 'GAHB__CHILD_THEME_URL_PATH' ) ) {


				define( 'GAHB__CHILD_THEME_URL_PATH', trailingslashit( get_stylesheet_directory_uri() ) );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_FRONTEND_JS_DIR_PATH' ) ) {


				define( 'GAHB__PLUGIN_FRONTEND_JS_DIR_PATH', GAHB__PLUGIN_DIR_PATH . 'assets/js/frontend/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_FRONTEND_JS_URL_PATH' ) ) {


				define( 'GAHB__PLUGIN_FRONTEND_JS_URL_PATH', GAHB__PLUGIN_URL_PATH . 'assets/js/frontend/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_ADMIN_JS_DIR_PATH' ) ) {


				define( 'GAHB__PLUGIN_ADMIN_JS_DIR_PATH', GAHB__PLUGIN_DIR_PATH . 'assets/js/admin/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_ADMIN_JS_URL_PATH' ) ) {


				define( 'GAHB__PLUGIN_ADMIN_JS_URL_PATH', GAHB__PLUGIN_URL_PATH . 'assets/js/admin/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_FRONTEND_CSS_DIR_PATH' ) ) {


				define( 'GAHB__PLUGIN_FRONTEND_CSS_DIR_PATH', GAHB__PLUGIN_DIR_PATH . 'assets/css/frontend/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_FRONTEND_CSS_URL_PATH' ) ) {


				define( 'GAHB__PLUGIN_FRONTEND_CSS_URL_PATH', GAHB__PLUGIN_URL_PATH . 'assets/css/frontend/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_ADMIN_CSS_DIR_PATH' ) ) {


				define( 'GAHB__PLUGIN_ADMIN_CSS_DIR_PATH', GAHB__PLUGIN_DIR_PATH . 'assets/css/admin/' );


			}


			


			if ( ! defined( 'GAHB__PLUGIN_ADMIN_CSS_URL_PATH' ) ) {


				define( 'GAHB__PLUGIN_ADMIN_CSS_URL_PATH', GAHB__PLUGIN_URL_PATH . 'assets/css/admin/' );


			}


			


			


			/**


			 * define constants those are having path like structure


			 * defined above has slash at the end,


			 * below are all with no slash


			 */


			


			if( !defined( 'GAHB__PLUGIN_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_URL_PATH_NS', untrailingslashit( GAHB__PLUGIN_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_DIR_PATH_NS', untrailingslashit( GAHB__PLUGIN_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_DIR_NAME_NS' ) ){


				define( 'GAHB__PLUGIN_DIR_NAME_NS', untrailingslashit( GAHB__PLUGIN_DIR_NAME ) );


			}


			


			if( !defined( 'GAHB__PLUGINS_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGINS_DIR_PATH_NS', untrailingslashit( GAHB__PLUGINS_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGINS_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGINS_URL_PATH_NS', untrailingslashit( GAHB__PLUGINS_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__THEME_DIR_PATH_NS' ) ){


				define( 'GAHB__THEME_DIR_PATH_NS', untrailingslashit( GAHB__THEME_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__THEME_URL_PATH_NS' ) ){


				define( 'GAHB__THEME_URL_PATH_NS', untrailingslashit( GAHB__THEME_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__CHILD_THEME_DIR_PATH_NS' ) ){


				define( 'GAHB__CHILD_THEME_DIR_PATH_NS', untrailingslashit( GAHB__CHILD_THEME_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__CHILD_THEME_URL_PATH_NS' ) ){


				define( 'GAHB__CHILD_THEME_URL_PATH_NS', untrailingslashit( GAHB__CHILD_THEME_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_FRONTEND_JS_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_FRONTEND_JS_DIR_PATH_NS', untrailingslashit( GAHB__PLUGIN_FRONTEND_JS_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_FRONTEND_JS_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_FRONTEND_JS_URL_PATH_NS', untrailingslashit( GAHB__PLUGIN_FRONTEND_JS_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_ADMIN_JS_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_ADMIN_JS_DIR_PATH_NS', untrailingslashit( GAHB__PLUGIN_ADMIN_JS_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_ADMIN_JS_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_ADMIN_JS_URL_PATH_NS', untrailingslashit( GAHB__PLUGIN_ADMIN_JS_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_FRONTEND_CSS_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_FRONTEND_CSS_DIR_PATH_NS', untrailingslashit( GAHB__PLUGIN_FRONTEND_CSS_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_FRONTEND_CSS_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_FRONTEND_CSS_URL_PATH_NS', untrailingslashit( GAHB__PLUGIN_FRONTEND_CSS_URL_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_ADMIN_CSS_DIR_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_ADMIN_CSS_DIR_PATH_NS', untrailingslashit( GAHB__PLUGIN_ADMIN_CSS_DIR_PATH ) );


			}


			


			if( !defined( 'GAHB__PLUGIN_ADMIN_CSS_URL_PATH_NS' ) ){


				define( 'GAHB__PLUGIN_ADMIN_CSS_URL_PATH_NS', untrailingslashit( GAHB__PLUGIN_ADMIN_CSS_URL_PATH ) );


			}


		}


		


		public function includes() {


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/class-gahb-main-menu.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_booking.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_hotel.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-taxonomy-hotel_category.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-taxonomy-hotel_tag.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_room.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_country.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_state.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/custom-post-gahb_city.php';


						


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/class-gahb-location-manager.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/class-gahb-hotel-manager.php';


						


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/add-admin-js.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/add-frontend-js.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/add-admin-css.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/add-frontend-css.php';


			


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-hotel-meta-boxes.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-room-meta-boxes.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/meta-boxes/class-booking-meta-boxes.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-search.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-hotel.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-room.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-bookings-dashboard.php';


			


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-multiple-hotels-rooms-list.php';


			


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/ajax-load-places.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/functions.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/template-functions.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/hotel_search_functions.php';


			include_once GAHB__PLUGIN_DIR_PATH . 'includes/admin/shortcode-booking-checkout.php';


		}


		


		function hide_add_new_booking_post(){


			global $submenu;


			unset($submenu['edit.php?post_type=gahb_booking'][10]);


			


		}


		


		function process_hotel_search_code() {


			$booking_checkout_page_id_url = url_to_postid( gahb_get_current_url() );


			$booking_checkout_page_id = get_option( 'gahb_booking_checkout_page_id', 'none' );

			if( $booking_checkout_page_id_url ==  $booking_checkout_page_id ){

				if(isset($_SESSION["hotels_search_data"]) && !is_null($_SESSION["hotels_search_data"]) )

				{

					if( isset($_REQUEST["hotel_id"]) && $_REQUEST["room_id"] ){

						if( !gahb_is_hotel( $_REQUEST["hotel_id"] ) || !gahb_is_room( $_REQUEST["room_id"] ) ){

							$hotel_search_page_id = get_option( 'gahb_hotel_search_page_id', 'none' );

							wp_redirect( get_permalink( $hotel_search_page_id ) );

							exit;

						}

					} else {


						$hotel_search_page_id = get_option( 'gahb_hotel_search_page_id', 'none' );


						wp_redirect( get_permalink( $hotel_search_page_id ) );


						exit;


					}


				}


			}


			


			if( isset( $_REQUEST['gahb_action'] ) && 'clear_hotel_search' == $_REQUEST['gahb_action'] ){


				unset( $_SESSION["hotels_search_data"] );


				$hotel_search_page_id = get_option( 'gahb_hotel_search_page_id', 'none' );


				wp_redirect( get_permalink( $hotel_search_page_id ) );


				exit;


			}


			$return = gahb_process_search_hotel_shortcode();


			if($return["success"]) 

			{

				$_SESSION["hotels_search_data"]=$return["data"];

				//$hotels_list_page_id = get_option( 'gahb_hotels_list_page_id', 'none' );

				$hotels_list_page_id = get_option( 'gahb_booking_mrooms_list_mhotels_page_id', 'none' );

				wp_redirect( get_permalink( $hotels_list_page_id ) );

				exit;

			}

		}

	}

}


function HrwpMainInit() {

	return HrwpMain::instance();

}


HrwpMainInit();