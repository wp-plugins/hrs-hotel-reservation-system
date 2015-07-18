<?php


add_action( 'init', 'taxonomy_hotel_categories', 0 );


function taxonomy_hotel_categories() {





	$labels = array(


		'name'                       => _x( 'Hotel Categories', 'Hotel Categories', 'hrwp' ),


		'singular_name'              => _x( 'Hotel Category', 'Hotel Category', 'hrwp' ),


		'menu_name'                  => __( 'Hotel Categories', 'hrwp' ),


		'all_items'                  => __( 'All Hotel Categories', 'hrwp' ),


		'parent_item'                => __( 'Parent Hotel Category', 'hrwp' ),


		'parent_item_colon'          => __( 'Parent Hotel Category:', 'hrwp' ),


		'new_item_name'              => __( 'New Hotel Category', 'hrwp' ),


		'add_new_item'               => __( 'Add New Hotel Category', 'hrwp' ),


		'edit_item'                  => __( 'Edit Hotel Category', 'hrwp' ),


		'update_item'                => __( 'Update Hotel Category', 'hrwp' ),


		'view_item'                  => __( 'View Hotel Category', 'hrwp' ),


		'separate_items_with_commas' => __( 'Separate Hotel Categories with commas', 'hrwp' ),


		'add_or_remove_items'        => __( 'Add or remove hotel category', 'hrwp' ),


		'choose_from_most_used'      => __( 'Choose from the most used hotel categories', 'hrwp' ),


		'popular_items'              => __( 'Popular Hotel Categories', 'hrwp' ),


		'search_items'               => __( 'Search Hotel Categories', 'hrwp' ),


		'not_found'                  => __( 'Not Found Hotel Categories', 'hrwp' ),


	);


	


	$args = array(


		'labels'                     => $labels,


		'hierarchical'               => true,


		'public'                     => true,


		'show_ui'                    => true,


		'show_admin_column'          => true,


		'show_in_nav_menus'          => true,


		'show_tagcloud'              => true,


	);


	register_taxonomy( 'hotel_category', array( 'gahb_hotel' ), $args );


}


