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
	$address .= ( !empty( $hotel_city ) ) ? ( get_the_title($hotel_city).', ' ) : ( '' );
	$address .= ( !empty( $hotel_state ) ) ? ( get_the_title($hotel_state).', ' ) : ( '' );
	$address .= ( !empty( $hotel_country ) ) ? ( get_the_title($hotel_country).', ' ) : ( '' );
	$address .= ( !empty( $hotel_postal_code ) ) ? ( $hotel_postal_code ) : ( '' );
	$featured_img_src = gahb_wp_get_attachment_image_src( get_post_thumbnail_id( $hotel_id ), 'full' );
	

	
	$thumbnail_src = gahb_wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );


		

		$gallery_images_ids = get_post_meta( $hotel_id, '_hotel_image_gallery', true );

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
	
	
	
	
	
	
	
	
	
	
	
?>

<div class="title_section_hotels">
 <?php if( !empty( $hotel_name ) ) { ?>
 <h2><?php echo $hotel_name; ?></h2>
 <?php } ?>
</div>
<?php /*?><?php if( $featured_img_src ) { ?>
<img src="<?php echo $featured_img_src; ?>" />
<?php } ?><?php */?>
<div class="gallery_section_hotels">
 
 <div class="thumb_image_gallery_section_hotels">
  <?php


 if( $is_gallery ) { 
 
 ?>
  <script type="text/javascript">
function changeImage(current) {
	var imagesNumber = <?php echo count($gallery_images)?>;
	
	for (i=1; i<=imagesNumber; i++) {	
		if (i == current) {
			document.getElementById("normal" + current).style.display = "block";
		} else {
			document.getElementById("normal" + i).style.display = "none";
		}
	}
}
</script>

<div class="main_image_gallery_section_hotels"> 
	<?php 
		$i=1;
		foreach( $gallery_images as $gi ) 
		{ 
		?>
  <div  id="normal<?php echo $i;?>" <?php if($i!=1) echo 'style="display:none;"';?>> <img  src="<?php echo $gi['full']; ?>" alt=""/> </div>
  <?php 
  $i++;
		} 
		?>
        </div>
  <ul>
   <?php 
		$i=1;
		foreach( $gallery_images as $gi ) 
		{ 
		?>
   <li> <a href="javascript: changeImage(<?php echo $i++;?>);"> <img src="<?php echo $gi['thumbnail']; ?>" alt="" /> </a> </li>
   <?php 
		} 
		?>
  </ul>
  
 </div>
 <?php } ?>
</div>
</div>
<div class="desc_section_hotels_details">
 <?php if( !empty( $hotel_description ) ) { ?>
 <h3><?php echo $hotel_description; ?></h3>
 <?php } ?>
</div>
<div class="add_section_hotels_details">
 <?php if( !empty( $address ) ) { ?>
 <h4><?php echo $address; ?></h4>
 <?php } ?>
</div>
</div>
<hr />
<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
<?php gah_put_container_end_tag(); ?>
<?php get_footer(); ?>
