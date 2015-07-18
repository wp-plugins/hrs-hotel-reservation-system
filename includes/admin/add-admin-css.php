<?php
add_action('admin_enqueue_scripts', 'register_admin_css_func' );
function register_admin_css_func(){
	wp_register_style( 'gahb_admin_main_css', GAHB__PLUGIN_ADMIN_CSS_URL_PATH . 'admin-main.css' );
	wp_enqueue_style( 'gahb_admin_main_css' );
}

add_action('admin_enqueue_scripts', 'register_select2_css_func' );
function register_select2_css_func(){
	wp_register_style( 'gahb_admin_select2_css', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'select2/css/select2.css' );
	wp_enqueue_style( 'gahb_admin_select2_css' );
}

add_action('admin_enqueue_scripts', 'register_jquery_ui_css_func' );
function register_jquery_ui_css_func(){
	wp_register_style( 'gahb_jquery_ui_css', GAHB__PLUGIN_ADMIN_CSS_URL_PATH . 'jquery-ui.css' );
	wp_enqueue_style( 'gahb_jquery_ui_css' );
}

add_action('admin_enqueue_scripts', 'register_jquery_ui_theme_css_func' );
function register_jquery_ui_theme_css_func(){
	wp_register_style( 'gahb_jquery_ui_theme_css', GAHB__PLUGIN_ADMIN_CSS_URL_PATH . 'jquery-ui.theme.css' );
	wp_enqueue_style( 'gahb_jquery_ui_theme_css' );
}
