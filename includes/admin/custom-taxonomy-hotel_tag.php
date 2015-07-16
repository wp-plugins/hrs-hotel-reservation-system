<?php


add_action( 'init', 'taxonomy_hotel_tags', 0 );


function taxonomy_hotel_tags() {





	$labels = array(


		'name'                       => _x( 'Hotel Tags', 'Hotel Tags', 'hrwp' ),


		'singular_name'              => _x( 'Hotel Tag', 'Hotel Tag', 'hrwp' ),


		'menu_name'                  => __( 'Hotel Tags', 'hrwp' ),


		'all_items'                  => __( 'All Hotel Tags', 'hrwp' ),


		'parent_item'                => __( 'Parent Hotel Tag', 'hrwp' ),


		'parent_item_colon'          => __( 'Parent Hotel Tag:', 'hrwp' ),


		'new_item_name'              => __( 'New Hotel Tag', 'hrwp' ),


		'add_new_item'               => __( 'Add New Hotel Tag', 'hrwp' ),


		'edit_item'                  => __( 'Edit Hotel Tag', 'hrwp' ),


		'update_item'                => __( 'Update Hotel Tag', 'hrwp' ),


		'view_item'                  => __( 'View Hotel Tag', 'hrwp' ),


		'separate_items_with_commas' => __( 'Separate Hotel Tags with commas', 'hrwp' ),


		'add_or_remove_items'        => __( 'Add or remove hotel catogery', 'hrwp' ),


		'choose_from_most_used'      => __( 'Choose from the most used hotel tags', 'hrwp' ),


		'popular_items'              => __( 'Popular Hotel Tags', 'hrwp' ),


		'search_items'               => __( 'Search Hotel Tags', 'hrwp' ),


		'not_found'                  => __( 'Not Found Hotel Tags', 'hrwp' ),


	);


	


	$args = array(


		'labels'                     => $labels,


		'hierarchical'               => false,


		'public'                     => true,


		'show_ui'                    => true,


		'show_admin_column'          => true,


		'show_in_nav_menus'          => true,


		'show_tagcloud'              => true,


	);


	register_taxonomy( 'hotel_tag', array( 'gahb_hotel' ), $args );


}


