<?php
add_action('admin_enqueue_scripts', 'register_admin_head_js_func' );
function register_admin_head_js_func(){
	wp_register_script( 'gahb_admin_main_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'admin-main.js', array( 'jquery' ), false, false);
	
	$admin_main_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
	wp_localize_script( 'gahb_admin_main_js', 'admin_main_js_obj', $admin_main_js_props );
	
	wp_enqueue_script( 'gahb_admin_main_js' );
}

add_action('admin_enqueue_scripts', 'register_hotel_gallery_images_meta_box_js_func' );
function register_hotel_gallery_images_meta_box_js_func(){
	wp_register_script( 'hotel_gallery_images_meta_box_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'hotel-gallery-images-meta-box.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable'), false, false);
	
	$hotel_gallery_images_meta_box_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'hotel_gallery_images_meta_box_js', 'hotel_gallery_images_meta_box_js_obj', $hotel_gallery_images_meta_box_js_props );
	
	wp_enqueue_script( 'hotel_gallery_images_meta_box_js' );
}

add_action('admin_enqueue_scripts', 'register_hotel_room_gallery_images_meta_box_js_func' );
function register_hotel_room_gallery_images_meta_box_js_func(){
	wp_register_script( 'hotel_room_gallery_images_meta_box_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'hotel-room-gallery-images-meta-box.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable'), false, false);
	
	$hotel_room_gallery_images_meta_box_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'hotel_room_gallery_images_meta_box_js', 'hotel_room_gallery_images_meta_box_js_obj', $hotel_room_gallery_images_meta_box_js_props );
	
	wp_enqueue_script( 'hotel_room_gallery_images_meta_box_js' );
}


add_action('admin_enqueue_scripts', 'register_select2_js_func' );
function register_select2_js_func(){
	wp_register_script( 'gahb_select2_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'select2/js/select2.full.min.js', array( 'jquery' ), false, false);
	
	$gahb_select2_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'gahb_select2_js', 'gahb_select2_js_obj', $gahb_select2_js_props );
	
	wp_enqueue_script( 'gahb_select2_js' );
}

add_action('admin_enqueue_scripts', 'register_hotel_detail_meta_js_func' );
function register_hotel_detail_meta_js_func(){
	wp_register_script( 'register_hotel_detail_meta_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'hotel-detail-meta-box.js', array( 'jquery' ), false, false);
	
	$register_hotel_detail_meta_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'register_hotel_detail_meta_js', 'register_hotel_detail_meta_js_obj', $register_hotel_detail_meta_js_props );
	
	wp_enqueue_script( 'register_hotel_detail_meta_js' );
}

add_action('admin_enqueue_scripts', 'register_hotel_room_detail_meta_js_func' );
function register_hotel_room_detail_meta_js_func(){
	wp_register_script( 'register_hotel_room_detail_meta_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'hotel-room-detail-meta-box.js', array( 'jquery' ), false, false);
	
	$register_hotel_room_detail_meta_js_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'register_hotel_room_detail_meta_js', 'register_hotel_room_detail_meta_js_obj', $register_hotel_room_detail_meta_js_props );
	
	wp_enqueue_script( 'register_hotel_room_detail_meta_js' );
}

add_action('admin_enqueue_scripts', 'register_admin_settings_menu_js_func' );
function register_admin_settings_menu_js_func(){
	wp_register_script( 'register_admin_settings_menu_js', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'admin-settings-menu.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), false, false);
	
	$register_admin_settings_menu_props	=	array(
									'admin_ajax_url'	=>	admin_url( 'admin-ajax.php' ),
								);
								
	wp_localize_script( 'register_admin_settings_menu_js', 'register_admin_settings_menu_js_obj', $register_admin_settings_menu_props );
	
	wp_enqueue_script( 'register_admin_settings_menu_js' );
}

