<?php

add_action('wp_head', 'register_frontend_css_func' );

function register_frontend_css_func(){

	wp_register_style( 'gahb_frontend_main_css', GAHB__PLUGIN_FRONTEND_CSS_URL_PATH . 'frontend-main.css' );

	wp_enqueue_style( 'gahb_frontend_main_css' );

}

add_action('wp_head', 'register_bootstrap_css_func' );

function register_bootstrap_css_func(){

	wp_register_style( 'gahb_bootstrap_main_css', GAHB__PLUGIN_FRONTEND_CSS_URL_PATH . 'bootstrap-min.css' );

	wp_enqueue_style( 'gahb_bootstrap_main_css' );

}

add_action('wp_head', 'register_front_select2_css_func' );

function register_front_select2_css_func(){

	wp_register_style( 'gahb_front_select2_css', GAHB__PLUGIN_ADMIN_JS_URL_PATH . 'select2/css/select2.css' );

	wp_enqueue_style( 'gahb_front_select2_css' );

}



add_action('wp_head', 'register_front_jquery_ui_css_func' );

function register_front_jquery_ui_css_func(){

	wp_register_style( 'gahb_front_jquery_ui_css', GAHB__PLUGIN_URL_PATH . 'assets/css/common/jquery-css/jquery-ui.css' );

	wp_enqueue_style( 'gahb_front_jquery_ui_css' );

}

