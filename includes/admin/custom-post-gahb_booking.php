<?php


add_action( 'init', 'register_gabh_booking_post_type', 0 );





function register_gabh_booking_post_type() {





	$labels = array(


		'name'                => _x( 'Bookings', 'Post Type General Name', 'hrwp' ),


		'singular_name'       => _x( 'Booking', 'Post Type Singular Name', 'hrwp' ),


		'menu_name'           => __( 'Atithi', 'hrwp' ),


		'name_admin_bar'      => __( 'Bookings', 'hrwp' ),


		'parent_item_colon'   => __( 'Parent Booking:', 'hrwp' ),


		'all_items'           => __( 'Bookings', 'hrwp' ),


		'add_new_item'        => __( 'Add New Booking', 'hrwp' ),


		'add_new'             => __( 'Add New', 'hrwp' ),


		'new_item'            => __( 'New Booking', 'hrwp' ),


		'edit_item'           => __( 'Edit Booking', 'hrwp' ),


		'update_item'         => __( 'Update Booking', 'hrwp' ),


		'view_item'           => __( 'View Booking', 'hrwp' ),


		'search_items'        => __( 'Search Bookings', 'hrwp' ),


		'not_found'           => __( 'Not found', 'hrwp' ),


		'not_found_in_trash'  => __( 'Not found in Trash', 'hrwp' ),


	);


	$rewrite = array(


		'slug'                => 'bookings',


		'with_front'          => true,


		'pages'               => true,


		'feeds'               => true,


	);


	$args = array(


		'label'               => __( 'Booking', 'hrwp' ),


		'description'         => __( 'Atithi hotel booking system bookings', 'hrwp' ),


		'labels'              => $labels,


		'supports'            => array( 'title', 'thumbnail', ),


		/*'taxonomies'          => array( 'hotel_category', 'hotel_tag' ),*/


		'hierarchical'        => false,


		'public'              => true,


		'show_ui'             => true,


		'show_in_menu'        => true,


		/*'menu_position'       => 1,*/


		'menu_icon'           => GAHB__PLUGIN_URL_PATH. 'assets/images/hotel-post-icon-2.png',


		'show_in_admin_bar'   => true,


		'show_in_nav_menus'   => true,


		'can_export'          => true,


		'has_archive'         => true,


		'exclude_from_search' => false,


		'publicly_queryable'  => true,


		'rewrite'             => $rewrite,


		'capability_type'     => 'page',


	);


	register_post_type( 'gahb_booking', $args );


}