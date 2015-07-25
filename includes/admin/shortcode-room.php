<?php
add_shortcode( 'gahb_rooms_list', 'add_list_room_shortcode_func' );
function add_list_room_shortcode_func() {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array (
		'post_type'              => 'gahb_room',
		'post_status'            => 'publish',
		'pagination'             => true,
		'posts_per_page'         => '10',
		'paged'					 => $paged,
	);
	
	$output = '';
	ob_start();
	?>
		<div class="gahb_core_container gahb_core_hotel_search_box">
				<?php
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) {
						?>
                        
                         <div class="rooms_search_data_box">
                        <ul>
						
						<?php
							while ( $query->have_posts() ) { $query->the_post(); ?>
								<?php
									$room_id = get_the_ID();
									$room_title = get_the_title();
									$room_permalink = get_permalink();
									$room_description = get_post_meta( $room_id, '_gahb_hotel_room_description', true );
									$room_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
									if( $room_thumbnail_src ){
										$room_thumbnail_src = $room_thumbnail_src[0];
									} else {
										$room_thumbnail_src = gahb_get_no_image_src();
									}
								?>
                               
                                
                                <div class="atithi-md-3">
								<li>
									<div class="list_rooms_page">
										<a href="<?php echo $room_permalink; ?>">
											<img src="<?php echo $room_thumbnail_src; ?>" />
										</a>
										<br />
                                        <div class="title_rooms_list_one">
                                        <h6>	<?php
											$details_link = get_permalink( $room_id );
											if( isset( $_REQUEST['hotel_id'] ) ){
												if( gahb_is_hotel( $_REQUEST['hotel_id'] ) ){
													$details_link = add_query_arg( array( 'hotel_id' => $_REQUEST['hotel_id'] ), get_permalink($room_id) );
												}
											}
										?>
                                        <a href="<?php echo $details_link; ?>">	<?php  echo get_the_title(); ?></a>
                                        
                                        </h6></div>
									
									
									<?php /*?>	<?php if( !empty( $room_description ) ){ ?>
												Description: <?php echo $room_description; ?><br />
										<?php } ?>
										<a href="<?php echo $details_link; ?>">View Details</a><?php */?>
									</div>
								</li>
                                </div>
                                
                                
								<?php }
						?></ul> <div style="clear:both;"></div></div>
						
						<?php
						$big = 999999999; // need an unlikely integer
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $query->max_num_pages
						) );
					}
					wp_reset_postdata();
				?>
			</div>
		</div>
	<?php
	$output .= ob_get_clean();
	
	return $output;
}