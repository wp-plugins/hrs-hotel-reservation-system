<?php
session_start();
add_shortcode( 'gahb_hotels_list', 'add_list_hotel_shortcode_func' );
function add_list_hotel_shortcode_func() {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
	$args	=	array(
					'post_type'			=>	'gahb_hotel',
					'post_status'		=>	'publish',
					'pagination'		=>	true,
					'posts_per_page'	=>	'10',
					'paged'				=>	$paged,
				);
	
	$output = '';
	ob_start();
	?>
		<div class="gahb_core_container gahb_core_hotel_search_box">
			<h3>Search Hotels</h3>
			<div class="hotel_search_data_box">
				<?php
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						?>
                        <div class="rooms_search_data_box">
                        
                        
						<ul>
							<?php while ( $query->have_posts() ) { $query->the_post(); ?>
							<?php
								$hotel_id = get_the_ID();
								$hotel_title = get_the_title();
								$hotel_permalink = get_permalink();
								$hotel_description = get_post_meta($hotel_id, '_gahb_hotel_description', true );
								$hotel_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
								if( $hotel_thumbnail_src ){
									$hotel_thumbnail_src = $hotel_thumbnail_src[0];
								} else {
									$hotel_thumbnail_src = gahb_get_no_image_src();
								}
							?>
                            
                                  <div class="atithi-md-3">
                            
                            
							<li>
								<div class="list_rooms_page">
									<a href="<?php echo $hotel_permalink; ?>">
										<img src="<?php echo $hotel_thumbnail_src; ?>" />
									</a>
									<br />
                                    <div class="title_rooms_list_one">
                                    
									  <h6><a href="<?php echo get_permalink($hotel_id); ?>"><?php echo $hotel_title; ?></a>
                                    </h6></div>
								<?php /*?>	<?php if( !empty( $hotel_description ) ) { ?>
									Description: <?php echo $hotel_description; ?><br />
									<?php } ?>
									<a href="<?php echo get_permalink($hotel_id); ?>">View Details</a><?php */?>
								</div>
							</li>
                            </div>
							<?php } ?>
						</ul><div style="clear:both;"></div></div>
						<?php
					} else {
						?>
						<div class="no_hotel_found">
							Sorry!!! No hotels found in your search criteria
						</div>
						<?php
					}
					
					/* pagination code, st */
					$big = 999999999;
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $query->max_num_pages
					) );
					/* pagination code, end */
					
					wp_reset_postdata();
				?>
			</div>
		</div>
	<?php
	$output .= ob_get_clean();
	
	return $output;
}