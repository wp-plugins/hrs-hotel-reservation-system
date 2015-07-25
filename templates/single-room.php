<?php get_header(); ?>

<?php gah_put_container_start_tag(); ?>



<?php while ( have_posts() ) : the_post(); ?>

	<?php

		$room_id = get_the_ID();

		$title = get_the_title();

		$permalink = get_permalink();

		$thumbnail_src = gahb_wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
		$full_src = gahb_wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

		

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
		
		$room_charge_per_night = get_post_meta($room_id, "_gahb_hotel_room_charge_per_night", true);

		

		$hotel = get_post_meta( $room_id, '_gahb_hotel_room_hotel' );

		$room_hotel_id = false;

		if( !empty( $hotel ) ){

			$hotel = array_filter( $hotel );

		}

		$charge_per_night = get_post_meta( $room_id, '_gahb_hotel_room_charge_per_night', true );

	?>

	<div class="gahb_core_container gahb_core_room_dtails">


<div class="upper-images-container">

<div class="left-side-upper-images-container">
<h1><?php echo $title ?></h1>
<p>		<?php $len = count($hotel) ; for( $i=0;$i<$len;$i++ ) { ?>
			<a href="<?php echo get_permalink( $hotel[$i] ); ?>"><?php echo get_the_title( $hotel[$i] ); ?></a>
			<?php if( $i < ($len-1) ){ echo ', '; } ?>
		<?php } ?></p>	
</div>

<div class="center-side-upper-images-container">
<h4>Max. Occupancy</h4>
	
<span class="adult-no"> <?php echo $max_adult_occupancy; ?></span>

<span class="child-no"><?php echo $max_children_occupancy; ?></span>

</div>

<?php if( $room_charge_per_night ){ ?>
<div class="right-side-upper-images-container">
<div class="inner-side-upper-images-contain">

	<p class="atithi_price_room"><?php echo get_price_string( $room_charge_per_night ); ?></p>
	<p class="atithi_price_room_day"> per room / night</p>
   
                                               
</div>    
</div>
<?php } ?>

<div style="clear:both;"></div>
</div>



	<div class="gallery_section_hotels">	

	<?php /*?><div class="main_image_gallery_section_hotels">	<img src="<?php echo $full_src; ?>" /></div><?php */?>

	<div class="thumb_image_gallery_section_hotels">	

	<?php if( $is_gallery ) { ?>



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

	<div class="bottom-details-ameneties">
        
        <div class="room-fac-dtails-amn"><?php if( !empty( $room_facilities ) ) { ?>

		<b>Room facilities:</b> <?php echo $room_facilities; ?>

		<?php } ?></div>
        
        
         <div class="rules-details-amn">
				<?php if( !empty( $rules_restriction ) ) { ?>

		<b>Rules & restriction:</b> <?php echo $rules_restriction; ?>

		<?php } ?></div>
        
      <div style="clear:both;"></div>
        </div>
<div class="bottom-details-description">
		<?php if( !empty( $description ) ) { ?>

		<b>Description:</b> <?php echo $description; ?>

		<?php } ?><br /><br />
</div>

		

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