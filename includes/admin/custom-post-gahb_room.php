<?php


add_action( 'init', 'register_gabh_room_post_type', 0 );





function register_gabh_room_post_type() {





	$labels = array(


		'name'                => _x( 'Rooms', 'Rooms', 'hrwp' ),


		'singular_name'       => _x( 'Room', 'Room', 'hrwp' ),


		'menu_name'           => __( 'Rooms', 'hrwp' ),


		'name_admin_bar'      => __( 'Rooms', 'hrwp' ),


		'parent_item_colon'   => __( 'Parent Room:', 'hrwp' ),


		'all_items'           => __( 'Rooms', 'hrwp' ),


		'add_new_item'        => __( 'Add New Room', 'hrwp' ),


		'add_new'             => __( 'Add New', 'hrwp' ),


		'new_item'            => __( 'New Room', 'hrwp' ),


		'edit_item'           => __( 'Edit Room', 'hrwp' ),


		'update_item'         => __( 'Update Room', 'hrwp' ),


		'view_item'           => __( 'View Room', 'hrwp' ),


		'search_items'        => __( 'Search Rooms', 'hrwp' ),


		'not_found'           => __( 'Not found', 'hrwp' ),


		'not_found_in_trash'  => __( 'Not found in Trash', 'hrwp' ),


	);


	$rewrite = array(


		'slug'                => 'rooms',


		'with_front'          => true,


		'pages'               => true,


		'feeds'               => true,


	);


	$args = array(


		'label'               => __( 'Room', 'hrwp' ),


		'description'         => __( 'Atithi hotel booking system rooms', 'hrwp' ),


		'labels'              => $labels,


		'supports'            => array( 'title', 'thumbnail', 'comments' ),


		/*'taxonomies'          => array( 'hotel_category', 'hotel_tag' ),*/


		'hierarchical'        => false,


		'public'              => true,


		'show_ui'             => true,


		'show_in_menu'        => 'edit.php?post_type=gahb_booking',


		/*'menu_position'       => 1,*/


		/*'menu_icon'           => GAHB__PLUGIN_URL_PATH. 'assets/images/hotel-post-icon-2.png',*/


		'show_in_admin_bar'   => true,


		'show_in_nav_menus'   => true,


		'can_export'          => true,


		'has_archive'         => true,


		'exclude_from_search' => false,


		'publicly_queryable'  => true,


		'rewrite'             => $rewrite,


		'capability_type'     => 'page',


	);


	register_post_type( 'gahb_room', $args );


}