<?php
session_start();
add_shortcode( 'gahb_multiple_rooms_list', 'add_multiple_rooms_list_shortcode_func' );
function add_multiple_rooms_list_shortcode_func() {
	$rooms_list_page_id = get_option( 'gahb_rooms_list_page_id', 'none' );
	$room_found = true;
	if(isset($_SESSION["hotels_search_data"]) && !is_null($_SESSION["hotels_search_data"]))
	{
		$search_criteria = $_SESSION["hotels_search_data"];
		
		$room_list	=	gahb_show_custom_multiple_hotel_list(
							$search_criteria["hotel_search_place"],
							$search_criteria["hotel_search_arrival_date"],
							$search_criteria["hotel_search_departure_date"],
							$search_criteria["hotel_search_rooms_count"],
							$search_criteria["hotel_search_adult_count"],
							$search_criteria["hotel_search_children_count"]
						);
	}
	//print_r($room_list);
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
	$args	=	array(
					'post_type'			=>	'gahb_room',
					'post_status'		=>	'publish',
					'pagination'		=>	true,
					'posts_per_page'	=>	'10',
					'paged'				=>	$paged,
				);
	$room_list_ids=array();
	if( isset($room_list) ) {
		if( $room_list ){
			
			foreach($room_list as $single_room_id)
			{
				$room_list_ids[]=$single_room_id["room_id"];
			}
			$args['post__in'] = $room_list_ids;
		} else {
			$room_found = false;
		}
	}
	
	$output = '';
	ob_start();
	?>
		<div class="gahb_core_container gahb_core_hotel_search_box">
			<h3>Search Rooms</h3>
			<div class="hotel_search_data_box">
				<div class="hotel_search_data_errors">
					<ul class="hotel_search_data_errors_ul">
					</ul>
				</div>
				<?php if( isset($room_list) ) { ?><h4>Search Criteria</h4>
                
       
                <div class="search_filter_data atithi_search_top atithi-md-12 atithi-sm-12 hidden-xs visible-stb">
                
             
                
<?php /*?><div class="row">
			
            <div class="atithi-md atithi-md-2 atithi-sm-2"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-IN:</p> <?php echo date('F j, Y', strtotime($search_criteria['hotel_search_arrival_date'])); ?></span><span class="arrow_greater"></span></div>
            
            
						<div class="atithi-md atithi-md-2 atithi-sm-2 has_right_border"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-OUT:</p> <?php echo date('F j, Y', strtotime($search_criteria['hotel_search_departure_date'])); ?></span></div>
                        
                        
						<div class="atithi-md atithi-md-1 atithi-sm-1"><p class="atithi_search_captions">Rooms:</p> <?php echo $search_criteria['hotel_search_rooms_count']; ?></div>
                        
                        
						<div class="atithi-md atithi-md-1 atithi-sm-1 adults_cls"><p class="atithi_search_captions">Adults:</p> <?php echo $search_criteria['hotel_search_adult_count']; ?></div>
                        
						<div class="atithi-md atithi-md-2 atithi-sm-2 child-head"><p class="atithi_search_captions">Children:</p> <?php echo $search_criteria['hotel_search_children_count']; ?></div>
                        
						<div class="atithi-md atithi-md-1 atithi-sm-1 last"><a href="?gahb_action=clear_hotel_search" class="atithi_button">Reset</a></div>
                        
</div><?php */?>


<div class="row">
			
               <div class="atithi-md atithi-md-2 atithi-sm-2 title_data_box"><p class="atithi-search-city-name">Place: <?php echo get_the_title($search_criteria['hotel_search_place']); ?></p></div>
            
            
            <div class="atithi-md atithi-md-2 atithi-sm-2 check_in_data_box"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-IN:</p> 
			<p><?php echo date('F j, Y', strtotime($search_criteria['hotel_search_arrival_date'])); ?></p>
            </span><span class="arrow_greater"></span></div>
            
            
						<div class="atithi-md atithi-md-2 atithi-sm-2 has_right_border check_out_data_box"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-OUT:</p><p> <?php echo date('F j, Y', strtotime($search_criteria['hotel_search_departure_date'])); ?></p></span></div>
                        
                        
						<div class="atithi-md atithi-md-2 atithi-sm-2 rooms_data_box"><p class="atithi_search_captions">Rooms:</p> <?php echo $search_criteria['hotel_search_rooms_count']; ?></div>
                        
                        
						<div class="atithi-md atithi-md-2 atithi-sm-2 adults_cls adults_data_box"><p class="atithi_search_captions">Adults:</p> <?php echo $search_criteria['hotel_search_adult_count']; ?></div>
                        
						<div class="atithi-md atithi-md-2 atithi-sm-2 child-head children_data_box"><p class="atithi_search_captions">Children:</p> <?php echo $search_criteria['hotel_search_children_count']; ?></div>
                        
						<div class="atithi-md atithi-md-2 atithi-sm-2 last reset_data_box">
                       <form action="?gahb_action=clear_hotel_search" method="post">
             <input name="reset" type="submit" value="Reset" /></form> </div>
                        
</div>


<div class="gahb_clearboth"></div>
					</div>
					
				<?php } ?>
				<?php
				if( $room_found && count($room_list_ids) ){
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						$while_count=0;
						?>
						<ul>
							<?php while ( $query->have_posts() )
							{	
								$query->the_post();
								$room_id=get_the_ID();
								$available_hotels=array_count_values($room_list_ids);
								$available_hotels=$available_hotels[$room_id];
								for($i=0;$i<$available_hotels;$i++	)
								{
									$hotel_id = $room_list[$while_count]["hotel_id"];
									$while_count++;
									$room_title = get_the_title();
									$room_permalink = get_permalink();
									$room_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
									if( $room_thumbnail_src ){
										$room_thumbnail_src = $room_thumbnail_src[0];
									} else {
										$room_thumbnail_src = gahb_get_no_image_src();
									}
									?>
                                    <li class="atithi_main_conatiner_li">
										<div class="main_conatiner_room ">
                                        <div class="image-name-deatailed-left-side">
                                        	<div class="image_section atithi-md-2 atithi-sm-2">
                                            	<a href="<?php echo $room_permalink; ?>"><img src="<?php echo $room_thumbnail_src; ?>" /></a>
                                            </div>
                                            
                                            <div class="room_title_search atithi-sm-8 atithi-md-8">
                                   				<a href="<?php echo $room_permalink; ?>"><?php echo $room_title; ?></a><p><span>Hotel: </span><a class="black-anchor-small-font" href="<?php echo get_permalink( $hotel_id ); ?>"><?php echo get_the_title( $hotel_id ); ?></a> </p>
                                            </div>
                                      
												
											  
                                           
                                            
                                            <div class="room_description_search atithi-sm-8 atithi-md-8"> 
                                            	<?php echo get_post_meta($room_id, "_gahb_hotel_room_description", true); ?>
											</div>
                                            
                                               <div style="clear:both;"></div>
                                            
                                            </div>
                                            
                                         <div class="rates-deatailed-right-side"><div class="room_description_search atithi-md-2 atithi-sm-2">
                                            	<p class="atithi_price_room"><?php $room_charge_per_night = get_post_meta($room_id, "_gahb_hotel_room_charge_per_night", true); echo get_price_string($room_charge_per_night); ?></p>
                                               <p class="atithi_price_room_day"> per room / night</p>
                         <form action="<?php echo add_query_arg( array( 'hotel_id' => $hotel_id, 'room_id' => $room_id ), get_permalink( get_option( 'gahb_booking_checkout_page_id', 'none' ) ) ); ?>" method="post">
                         
                         <input name="booknow" type="submit" value="Book Now" /></form>

											</div>

                                                
                                                <div style="clear:both;"></div>
                                                </div>   
                                            
                                            
									   </div>
									</li>
							<?php
								} 
							} ?>
						</ul>
						<?php
					} else {
						?>
						<div class="no_hotel_found">
							Sorry!!! No rooms found in your search criteria
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
				} else {
					?>
					<div class="no_hotel_found">
						Sorry!!! No rooms found in your search criteria
					</div>
					<?php
				}
				?>
			</div>
		</div>
	<?php
	$output .= ob_get_clean();
	
	return $output;
}
