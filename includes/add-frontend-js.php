<?php
add_action('wp_head', 'register_frontend_js_func' );
function register_frontend_js_func(){
	
	wp_register_script( 'gahb_frontend_main_js', GAHB__PLUGIN_FRONTEND_JS_URL_PATH . 'frontend-main.js', array( 'jquery' ), false, false);
	$frontend_main_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
	wp_localize_script( 'gahb_frontend_main_js', 'frontend_main_js_obj', $frontend_main_js_props );
	
	wp_enqueue_script( 'gahb_frontend_main_js' );
}
add_action('wp_head', 'register_shortcode_hotel_js_func' );
function register_shortcode_hotel_js_func(){
	
	wp_register_script( 'shortcode_hotel_main_js', GAHB__PLUGIN_FRONTEND_JS_URL_PATH . 'shortcode-hotel.js', array( 'jquery' ), false, false);
	$shortcode_hotel_main_js_props	=	array(
											'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
										);
	wp_localize_script( 'shortcode_hotel_main_js', 'shortcode_hotel_main_js_obj', $shortcode_hotel_main_js_props );
	
	wp_enqueue_script( 'shortcode_hotel_main_js' );
}
add_action('wp_head', 'register_front_select2_js_func' );
function register_front_select2_js_func(){
	wp_register_script( 'gahb_front_select2_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'select2/js/select2.full.min.js', array( 'jquery' ), false, false);
	
	$gahb_select2_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'gahb_front_select2_js', 'gahb_from_select2_js_obj', $gahb_select2_js_props );
	
	wp_enqueue_script( 'gahb_front_select2_js' );
}
add_action('wp_head', 'register_load_locations_ajax_js_func' );
function register_load_locations_ajax_js_func(){
	
	wp_register_script( 'load_locations_ajax_js', GAHB__PLUGIN_FRONTEND_JS_URL_PATH . 'load-locations-ajax.js', array( 'jquery' ), false, false);
	$load_locations_ajax_js_props	=	array(
											'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
										);
	wp_localize_script( 'load_locations_ajax_js', 'load_locations_ajax_js_obj', $load_locations_ajax_js_props );
	
	wp_enqueue_script( 'load_locations_ajax_js' );
}
add_action('wp_head', 'register_hotel_search_datepickers_js_func' );
function register_hotel_search_datepickers_js_func(){
	
	wp_register_script( 'hotel_search_datepickers_js', GAHB__PLUGIN_FRONTEND_JS_URL_PATH . 'hotel-search-datepickers.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ), false, false);
	
	$curr_date_obj= new DateTime();
	$next_date_obj= new DateTime('tomorrow');
	$curr_date = $curr_date_obj->format('F d, Y');
	$next_date = $next_date_obj->format('F d, Y');
	
	$hotel_search_datepickers_js_props	=	array(
												'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
												'curr_date'	=>	$curr_date,
												'next_date'	=>	$next_date,
											);
	wp_localize_script( 'hotel_search_datepickers_js', 'hotel_search_datepickers_js_obj', $hotel_search_datepickers_js_props );
	
	wp_enqueue_script( 'hotel_search_datepickers_js' );
}
