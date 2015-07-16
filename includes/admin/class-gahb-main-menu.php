<?php


if ( ! defined( 'ABSPATH' ) ) {


	exit; /* Exit if accessed directly */


}





if ( ! class_exists( 'HRWP_Main_Menu' ) ) {





	class HRWP_Main_Menu {


		


		public function __construct() {


			add_action( 'admin_menu', array( $this, 'gahb_main_menu_func_reg' ) );


		}


		


		public function gahb_main_menu_func_reg() {


			//add_menu_page( 'Atithi', 'Atithi', 'manage_options', GAHB__PLUGIN_SLUG, array( $this, 'gahb_main_menu_func' ) );


			add_submenu_page( 'edit.php?post_type=gahb_booking', 'Settings', 'Settings', 'manage_options', 'atithi-hotel-booking-system', array( $this, 'gahb_main_menu_func' ) );


		}


		


		public function gahb_main_menu_func() {


			$tab_links	=	array(


								'general'					=>	admin_url('edit.php?post_type=gahb_booking&page=atithi-hotel-booking-system&gahb_settings_tab=general'),


								'hotel'						=>	admin_url('edit.php?post_type=gahb_booking&page=atithi-hotel-booking-system&gahb_settings_tab=hotel'),


								'room'						=>	admin_url('edit.php?post_type=gahb_booking&page=atithi-hotel-booking-system&gahb_settings_tab=room'),


								'booking_dashboard'			=>	admin_url('edit.php?post_type=gahb_booking&page=atithi-hotel-booking-system&gahb_settings_tab=booking_dashboard'),


							);


			$tab_active =	array(


								'general'					=>	'',


								'hotel'						=>	'',


								'room'						=>	'',


								'booking_dashboard'			=>	'',


							);


			if( isset( $_REQUEST['gahb_settings_tab'] ) ){


				if( array_key_exists( $_REQUEST['gahb_settings_tab'], $tab_links ) ) {


					$tab_links[$_REQUEST['gahb_settings_tab']] = 'javascript:;';


					$tab_active[$_REQUEST['gahb_settings_tab']] = 'tab_active';


				} else {


					$tab_links['general'] = 'javascript:;';


					$tab_active['general'] = 'tab_active';


				}


			} else {


				$tab_links['general'] = 'javascript:;';


				$tab_active['general'] = 'tab_active';


			};


			?>


			<div class="gahb_core_container">


				<h2 class="gahb_core_container_nav_tab_wrapper">


					<a class="gahb_core_container_nav_tab <?php echo $tab_active['general']; ?>" href="<?php echo $tab_links['general']; ?>">General</a>


					


					<a class="gahb_core_container_nav_tab <?php echo $tab_active['hotel']; ?>" href="<?php echo $tab_links['hotel']; ?>">Hotel</a>


					


					<a class="gahb_core_container_nav_tab <?php echo $tab_active['room']; ?>" href="<?php echo $tab_links['room']; ?>">Room</a>


					


					<a class="gahb_core_container_nav_tab <?php echo $tab_active['booking_dashboard']; ?>" href="<?php echo $tab_links['booking_dashboard']; ?>">Booking Dashboard</a>


				</h2>


				


				<div class="settings_content">


					<?php


						$filename = array_keys( $tab_active, 'tab_active');


						$filename = $filename[0];


						require_once 'settings-tab/tab-'.$filename.'.php';


					?>


				</div>


			</div>


			<?php


		}


		


	}


}





return new HRWP_Main_Menu();