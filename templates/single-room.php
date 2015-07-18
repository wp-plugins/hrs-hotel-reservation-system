<?php get_header(); ?>

<?php gah_put_container_start_tag(); ?>



<?php while ( have_posts() ) : the_post(); ?>

	<?php

		$room_id = get_the_ID();

		$title = get_the_title();

		$permalink = get_permalink();

		$thumbnail_src = gahb_wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );

		

		$gallery_images_ids = get_post_meta( $room_id, '_hotel_room_image_gallery', true );

		$is_gallery = false;

		if( !empty( $gallery_images_ids ) ){

			$gallery_images_ids = array_filter( explode( ",", $gallery_images_ids ) );

			

			foreach( $gallery_images_ids as $gallery_images_id ){

				$gallery_images[$gallery_images_id]	=	array(

																'thumbnail'	=>	gahb_wp_get_attachment_image_src( $gallery_images_id, 'thumbnail' ),

																'full'		=>	gahb_wp_get_attachment_image_src( $gallery_images_id, 'full' ),

															);

			}

			$is_gallery = true;

		}

		$room_facilities = get_post_meta( $room_id, '_gahb_hotel_room_facilities', true );

		$rules_restriction = get_post_meta( $room_id, '_gahb_hotel_room_rules_restriction', true );

		$description = get_post_meta( $room_id, '_gahb_hotel_room_description', true );

		$max_adult_occupancy = get_post_meta( $room_id, '_gahb_hotel_room_max_adult_occupancy', true );

		$max_children_occupancy = get_post_meta( $room_id, '_gahb_hotel_room_max_children_occupancy', true );

		

		$hotel = get_post_meta( $room_id, '_gahb_hotel_room_hotel' );

		$room_hotel_id = false;

		if( !empty( $hotel ) ){

			$hotel = array_filter( $hotel );

		}

		if( isset( $_REQUEST['hotel_id'] ) ){

			if( gahb_is_hotel( $_REQUEST['hotel_id'] ) && in_array( $_REQUEST['hotel_id'], $hotel ) ){

				$room_hotel_id = $_REQUEST['hotel_id'];

			}

		}

		$charge_per_night = get_post_meta( $room_id, '_gahb_hotel_room_charge_per_night', true );

	?>

	<div class="gahb_core_container gahb_core_room_dtails">

		<b>Room: </b><?php echo $title ?><br /><br />

		

		<img src="<?php echo $thumbnail_src; ?>" />

		

		<?php if( $is_gallery ) { ?>

		<?php foreach( $gallery_images as $gi ) { ?>

		<img src="<?php echo $gi['thumbnail']; ?>" />

		<?php } ?>

		<?php } ?><br /><br />

		

		<?php if( $room_hotel_id ) { ?>

		<b>Hotel:</b> <a href="<?php echo get_permalink( $room_hotel_id ); ?>"><?php echo get_the_title( $room_hotel_id ); ?></a><br /><br />

		<?php } ?>

		

		<b>Max Adult Occupancy:</b> <?php echo $max_adult_occupancy; ?><br /><br />

		

		<b>Max Children Occupancy:</b> <?php echo $max_children_occupancy; ?><br /><br />

		

		<?php if( !empty( $description ) ) { ?>

		<b>Description:</b> <?php echo $description; ?>

		<?php } ?><br /><br />

		

		<?php if( !empty( $room_facilities ) ) { ?>

		<b>Room facilities:</b> <?php echo $room_facilities; ?>

		<?php } ?><br /><br />

		

		<?php if( !empty( $rules_restriction ) ) { ?>

		<b>Rules & restriction:</b> <?php echo $rules_restriction; ?>

		<?php } ?><br /><br />

		

		<?php if( $room_hotel_id ) { ?>

		<b>Location:</b> <?php echo gahb_get_hotel_address( $room_hotel_id ); ?>

		<?php } ?><br /><br />

		

		<?php if( $room_hotel_id ) { ?>

		<a href="<?php echo add_query_arg( array( 'hotel_id' => $room_hotel_id, 'room_id' => $room_id ), get_permalink( get_option( 'gahb_booking_checkout_page_id', 'none' ) ) ); ?>">Book Now</a>

		<?php } ?>

		

	</div>

	<?php //comments_template( '', true ); ?>

	

<?php endwhile; // end of the loop. ?>



<?php gah_put_container_end_tag(); ?>

<?php get_footer(); ?>