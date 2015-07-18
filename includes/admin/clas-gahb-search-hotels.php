<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}
if( !class_exists( 'GAHB_Search_Hotels' ) ){
	class GAHB_Search_Hotels{
		public function __construct(){
		}
		
		public function search_hotels_via_places( $places = array() ){
			$args	=	array(
							'posts_per_page'		=>	-1,
							'post_type'				=>	'gahb_hotel',
							'post_status'			=>	'publish',
							'meta_query'			=>	array(
															
														),
						);
		}
	}
}