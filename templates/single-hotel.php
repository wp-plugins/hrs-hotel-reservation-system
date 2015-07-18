<?php get_header(); ?>



<?php gah_put_container_start_tag(); ?>







<?php while ( have_posts() ) : the_post(); ?>
<?php
	$hotel_id = get_the_ID();
	$hotel_name = get_post_meta($hotel_id, '_gahb_hotel_name', true );
	$hotel_description = get_post_meta($hotel_id, '_gahb_hotel_description', true );
	$hotel_address_line_1 = get_post_meta($hotel_id, '_gahb_hotel_address_line_1', true );
	$hotel_address_line_2 = get_post_meta($hotel_id, '_gahb_hotel_address_line_2', true );
	$hotel_city = get_post_meta($hotel_id, '_gahb_hotel_city', true );
	$hotel_state = get_post_meta($hotel_id, '_gahb_hotel_state', true );
	$hotel_country = get_post_meta($hotel_id, '_gahb_hotel_country', true );
	$hotel_postal_code = get_post_meta($hotel_id, '_gahb_hotel_postal_code', true );
	
	$address = '';
	$address .= ( !empty( $hotel_address_line_1 ) ) ? ( $hotel_address_line_1.', ' ) : ( '' );
	$address .= ( !empty( $hotel_address_line_2 ) ) ? ( $hotel_address_line_2.', ' ) : ( '' );
	$address .= ( !empty( $hotel_city ) ) ? ( $hotel_city.', ' ) : ( '' );
	$address .= ( !empty( $hotel_state ) ) ? ( $hotel_state.', ' ) : ( '' );
	$address .= ( !empty( $hotel_country ) ) ? ( $hotel_country.', ' ) : ( '' );
	$address .= ( !empty( $hotel_postal_code ) ) ? ( $hotel_postal_code ) : ( '' );
	$featured_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
	
	if( $featured_img_src ){
		$featured_img_src = $featured_img_src[0];
	}
?>

<?php if( !empty( $hotel_name ) ) { ?>
<h2><?php echo $hotel_name; ?></h2>
<?php } ?>
<?php if( $featured_img_src ) { ?>
<img src="<?php echo $featured_img_src; ?>" />
<?php } ?>

<?php if( !empty( $hotel_description ) ) { ?>
	<h3><?php echo $hotel_description; ?></h3>
<?php } ?>
<br />
<br />
<br />
<div>
	<?php if( !empty( $address ) ) { ?>
	<h4><?php echo $address; ?></h4>
	<?php } ?>
</div>
<hr />




	



	<?php comments_template( '', true ); ?>



	



<?php endwhile; // end of the loop. ?>







<?php gah_put_container_end_tag(); ?>



<?php get_footer(); ?>