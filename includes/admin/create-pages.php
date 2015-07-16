<?php

/* insert page for hotels list, st */

$hotel_search_page_id = get_option( 'gahb_hotel_search_page_id', 'none' );

if( !gahb_is_page_published( $hotel_search_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Hotels Search' ),

						'post_name'			=>	'hotels-search',

						'post_content'		=>	'[gahb_hotel_search]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$hotel_search_page_id = wp_insert_post( $args );

	if( $hotel_search_page_id ){

		update_option( 'gahb_hotel_search_page_id', $hotel_search_page_id );

	}

}

/* insert page for hotels list, end */



/* insert page for hotels list, st */

$hotels_list_page_id = get_option( 'gahb_hotels_list_page_id', 'none' );

if( !gahb_is_page_published( $hotels_list_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Hotels List' ),

						'post_name'			=>	'hotels-list',

						'post_content'		=>	'[gahb_hotels_list]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$hotels_list_page_id = wp_insert_post( $args );

	if( $hotels_list_page_id ){

		update_option( 'gahb_hotels_list_page_id', $hotels_list_page_id );

	}

}

/* insert page for hotels list, end */





/* insert page for rooms list, st */

$rooms_list_page_id = get_option( 'gahb_rooms_list_page_id', 'none' );

if( !gahb_is_page_published( $rooms_list_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Rooms List' ),

						'post_name'			=>	'rooms-list',

						'post_content'		=>	'[gahb_rooms_list]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$rooms_list_page_id = wp_insert_post( $args );

	if( $rooms_list_page_id ){

		update_option( 'gahb_rooms_list_page_id', $rooms_list_page_id );

	}

}

/* insert page for rooms list, end */



/* insert page for user booking dashboard, st */

$booking_dashboard_page_id = get_option( 'gahb_booking_dashboard_page_id', 'none' );

if( !gahb_is_page_published( $booking_dashboard_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Bookings Dashboard' ),

						'post_name'			=>	'booking-dashboard',

						'post_content'		=>	'[gahb_booking_dashboard]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$booking_dashboard_page_id = wp_insert_post( $args );

	if( $booking_dashboard_page_id ){

		update_option( 'gahb_booking_dashboard_page_id', $booking_dashboard_page_id );

	}

}

/* insert page for user booking dashboard, st */



/* insert page for user booking dashboard, st */

$booking_checkout_page_id = get_option( 'gahb_booking_checkout_page_id', 'none' );

if( !gahb_is_page_published( $booking_checkout_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Booking Checkout' ),

						'post_name'			=>	'booking-checkout',

						'post_content'		=>	'[gahb_booking_checkout]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$booking_checkout_page_id = wp_insert_post( $args );

	if( $booking_checkout_page_id ){

		update_option( 'gahb_booking_checkout_page_id', $booking_checkout_page_id );

	}

}

/* insert page for user booking dashboard, st */

/* insert page for rooms list for multiple hotels, st */

$booking_checkout_page_id = get_option( 'gahb_booking_mrooms_list_mhotels_page_id', 'none' );

if( !gahb_is_page_published( $booking_checkout_page_id ) ){

	$args	=	array(

						'post_title'		=>	wp_strip_all_tags( 'Multiple Rooms List' ),

						'post_name'			=>	'multiple-rooms-list',

						'post_content'		=>	'[gahb_multiple_rooms_list]',

						'post_status'		=>	'publish',

						'post_type'			=>	'page',

					);

		

	$booking_checkout_page_id = wp_insert_post( $args );

	if( $booking_checkout_page_id ){

		update_option( 'gahb_booking_mrooms_list_mhotels_page_id', $booking_checkout_page_id );

	}

}

/* insert page for rooms list for multiple hotels, end */