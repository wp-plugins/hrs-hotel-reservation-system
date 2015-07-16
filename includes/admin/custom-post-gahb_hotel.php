<?php


add_action( 'init', 'register_gabh_hotel_post_type', 0 );





function register_gabh_hotel_post_type() {





	$labels = array(


		'name'                => _x( 'Hotels', 'Post Type General Name', 'hrwp' ),


		'singular_name'       => _x( 'Hotel', 'Post Type Singular Name', 'hrwp' ),


		'menu_name'           => __( 'Hotels', 'hrwp' ),


		'name_admin_bar'      => __( 'Hotels', 'hrwp' ),


		'parent_item_colon'   => __( 'Parent Hotel:', 'hrwp' ),


		'all_items'           => __( 'Hotels', 'hrwp' ),


		'add_new_item'        => __( 'Add New Hotel', 'hrwp' ),


		'add_new'             => __( 'Add New', 'hrwp' ),


		'new_item'            => __( 'New Hotel', 'hrwp' ),


		'edit_item'           => __( 'Edit Hotel', 'hrwp' ),


		'update_item'         => __( 'Update Hotel', 'hrwp' ),


		'view_item'           => __( 'View Hotel', 'hrwp' ),


		'search_items'        => __( 'Search Hotels', 'hrwp' ),


		'not_found'           => __( 'Not found', 'hrwp' ),


		'not_found_in_trash'  => __( 'Not found in Trash', 'hrwp' ),


	);


	$rewrite = array(


		'slug'                => 'hotels',


		'with_front'          => true,


		'pages'               => true,


		'feeds'               => true,


	);


	$args = array(


		'label'               => __( 'Hotel', 'hrwp' ),


		'description'         => __( 'Atithi hotel booking system hotels', 'hrwp' ),


		'labels'              => $labels,


		'supports'            => array( 'title', 'thumbnail', ),


		'taxonomies'          => array( 'hotel_category', 'hotel_tag' ),


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


	register_post_type( 'gahb_hotel', $args );


}