<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

if( !class_exists( 'GAHB_Hotels' ) ){
	class GAHB_Hotels{
		public function __construct(){
			
		}
		
		public function get_hotels(){
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
							'post_type'			=>	'gahb_hotel',
							//'post_mime_type'	=>	'',
							//'post_parent'		=>	'',
							'post_status'		=>	'publish',
							//'suppress_filters'	=>	true
						);
			$posts = get_posts( $args );
			$hotel = false;
			if( $posts && count( $posts ) ){
				
				$loc = new GAHB_Locations();
				
				foreach( $posts as $post ){
					$hotel_name				=	get_post_meta( $post->ID, '_gahb_hotel_name', true );
					$hotel_description		=	get_post_meta( $post->ID, '_gahb_hotel_description', true );
					$hotel_address_line1	=	get_post_meta( $post->ID, '_gahb_hotel_address_line_1', true );
					$hotel_address_line2	=	get_post_meta( $post->ID, '_gahb_hotel_address_line_2', true );
					$hotel_city				=	get_post_meta( $post->ID, '_gahb_hotel_city', true );
					$hotel_state			=	get_post_meta( $post->ID, '_gahb_hotel_state', true );
					$hotel_country			=	get_post_meta( $post->ID, '_gahb_hotel_country', true );
					
					if( !empty($hotel_city) && is_numeric( $hotel_city ) ){
						$hotel_city = $loc->get_city( $hotel_city );
					} else {
						$hotel_city = false;
					}
					
					if( !empty($hotel_state) && is_numeric( $hotel_state ) ){
						$hotel_state = $loc->get_state( $hotel_state );
					} else {
						$hotel_state = false;
					}
					
					if( !empty($hotel_country) && is_numeric( $hotel_country ) ){
						$hotel_country = $loc->get_country( $hotel_country );
					} else {
						$hotel_country = false;
					}
					
					$hotel[$post->ID]	=	array(
												'hotel_name'			=>	$hotel_name,
												'hotel_description'		=>	$hotel_description,
												'hotel_address_line1'	=>	$hotel_address_line1,
												'hotel_address_line2'	=>	$hotel_address_line2,
												'hotel_city'			=>	$hotel_city,
												'hotel_state'			=>	$hotel_state,
												'hotel_country'			=>	$hotel_country,
											);
				}
			}
			return $hotel;
		}
		
	}
}
