<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

if( !class_exists( 'GAHB_Locations' ) ){
	class GAHB_Locations{
		public function __construct(){
			
		}
		
		public function get_cities(){
			$args	=	array(
							'posts_per_page'	=>	-1,
							//'offset'			=>	0,
							//'category'			=>	'',
							//'category_name'		=>	'',
							'orderby'			=>	'title',
							'order'				=>	'ASC',
							//'include'			=>	'',
							//'exclude'			=>	'',
							//'meta_key'			=>	'',
							//'meta_value'		=>	'',
							'post_type'			=>	'gahb_city',
							//'post_mime_type'	=>	'',
							//'post_parent'		=>	'',
							'post_status'		=>	'publish',
							//'suppress_filters'	=>	true
						);
			$posts = get_posts( $args );
			$loc = false;
			if( $posts && count( $posts ) ){
				foreach( $posts as $post ){
					$loc[$post->ID] = $post->post_title;
				}
			}
			return $loc;
		}
		
		public function get_city( $loc_id ){
			$loc = false;
			$post = get_post( $loc_id );
			if( $post ){
				$loc = array('id' => $post->ID, 'name' => $post->post_title );
			}
			
			return $loc;
		}
		
		public function get_states(){
			$args	=	array(
							'posts_per_page'	=>	-1,
							//'offset'			=>	0,
							//'category'			=>	'',
							//'category_name'		=>	'',
							'orderby'			=>	'title',
							'order'				=>	'ASC',
							//'include'			=>	'',
							//'exclude'			=>	'',
							//'meta_key'			=>	'',
							//'meta_value'		=>	'',
							'post_type'			=>	'gahb_state',
							//'post_mime_type'	=>	'',
							//'post_parent'		=>	'',
							'post_status'		=>	'publish',
							//'suppress_filters'	=>	true
						);
			$posts = get_posts( $args );
			$loc = false;
			if( count( $posts ) ){
				foreach( $posts as $post ){
					$loc[$post->ID] = $post->post_title;
				}
			}
			return $loc;
		}
		
		public function get_state( $loc_id ){
			$loc = false;
			$post = get_post( $loc_id );
			if( $post ){
				$loc = array('id' => $post->ID, 'name' => $post->post_title );
			}
			
			return $loc;
		}
		
		public function get_countries( $args = array() ){
			if( empty( $args ) ){
				$args	=	array(
								'posts_per_page'	=>	-1,
								//'offset'			=>	0,
								//'category'			=>	'',
								//'category_name'		=>	'',
								'orderby'			=>	'title',
								'order'				=>	'ASC',
								//'include'			=>	'',
								//'exclude'			=>	'',
								//'meta_key'			=>	'',
								//'meta_value'		=>	'',
								'post_type'			=>	'gahb_country',
								//'post_mime_type'	=>	'',
								//'post_parent'		=>	'',
								'post_status'		=>	'publish',
								//'suppress_filters'	=>	true
							);
			}
			
			$posts = get_posts( $args );
			$loc = false;
			if( count( $posts ) ){
				foreach( $posts as $post ){
					$loc[$post->ID] = $post->post_title;
				}
			}
			return $loc;
		}
		
		public function get_country( $loc_id ){
			$loc = false;
			$post = get_post( $loc_id );
			if( $post ){
				$loc = array('id' => $post->ID, 'name' => $post->post_title );
			}
			
			return $loc;
		}
		
		public function query_places( $q ){
			
			$args	=	array(
								'posts_per_page'	=>	5,
								's'					=>	$q,
								//'offset'			=>	0,
								//'category'			=>	'',
								//'category_name'		=>	'',
								'orderby'			=>	'title',
								'order'				=>	'ASC',
								//'include'			=>	'',
								//'exclude'			=>	'',
								//'meta_key'			=>	'',
								//'meta_value'		=>	'',
								'post_type'			=>	array( 'gahb_country', 'gahb_state', 'gahb_city' ),
								//'post_mime_type'	=>	'',
								//'post_parent'		=>	'',
								'post_status'		=>	'publish',
								//'suppress_filters'	=>	true
							);
			
			$posts = get_posts( $args );
			$loc = array();
			if( count( $posts ) ){
				foreach( $posts as $post ){
					$loc[] = array( 'id' => $post->ID, 'text' => $post->post_title );
				}
			}
			
			return $loc;
		}
		
	}
}