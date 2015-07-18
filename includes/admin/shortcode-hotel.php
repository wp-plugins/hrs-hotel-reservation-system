<?php



session_start();



add_shortcode( 'gahb_hotels_list', 'add_list_hotel_shortcode_func' );



function add_list_hotel_shortcode_func() {

	$rooms_list_page_id = get_option( 'gahb_rooms_list_page_id', 'none' );



	$hotel_found = true;



	if(isset($_SESSION["hotels_search_data"]) && !is_null($_SESSION["hotels_search_data"]))



	{



		$search_criteria = $_SESSION["hotels_search_data"];



		



		$hotel_list	=	gahb_show_custom_hotel_list(



							$search_criteria["hotel_search_place"],



							$search_criteria["hotel_search_arrival_date"],



							$search_criteria["hotel_search_departure_date"],



							$search_criteria["hotel_search_rooms_count"],



							$search_criteria["hotel_search_adult_count"],



							$search_criteria["hotel_search_children_count"]



						);



	}



	



	



	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;



				



	$args	=	array(



					'post_type'			=>	'gahb_hotel',



					'post_status'		=>	'publish',



					'pagination'		=>	true,



					'posts_per_page'	=>	'10',



					'paged'				=>	$paged,



				);



	



	if( isset($hotel_list) ) {



		if( $hotel_list ){



			$args['post__in'] = $hotel_list;



		} else {



			$hotel_found = false;



		}



	}



	



	$output = '';



	ob_start();



	?>



		<div class="gahb_core_container gahb_core_hotel_search_box">



			<h3>Search Hotels</h3>



			<div class="hotel_search_data_box">



				<div class="hotel_search_data_errors">



					<ul class="hotel_search_data_errors_ul">



					</ul>



				</div>



				<?php if( isset($hotel_list) ) { ?>



					<div class="search_filter_data atithi_search_top atithi-md-12 atithi-sm-12 hidden-xs visible-stb">

<div class="row">

					<h4>Search Criteria</h4>



							<div class="atithi-md-3 atithi-sm-3 has_right_border"><p class="atithi-search-city-name">Place: <?php echo get_the_title($search_criteria['hotel_search_place']); ?></p></div>



						<div class="atithi-md-2 atithi-sm-2"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-IN:</p> <span class="glyphicon glyphicon-calendar hidden-stb"></span> <?php echo date('F j, Y', strtotime($search_criteria['hotel_search_arrival_date'])); ?></span><span class="arrow_greater"></span></div>



						<div class="atithi-md-2 atithi-sm-2 has_right_border"><span class="atithi-check-dates"><p class="atithi_search_captions">CHECK-OUT:</p> <span class="glyphicon glyphicon-calendar hidden-stb"></span> <?php echo  date('F j, Y', strtotime($search_criteria['hotel_search_departure_date'])); ?></span></div>



						<div class="atithi-md-1 atithi-sm-1"><p class="atithi_search_captions">Rooms:</p> <?php echo $search_criteria['hotel_search_rooms_count']; ?></div>



						<div class="atithi-md-1 atithi-sm-1"><p class="atithi_search_captions">Adults:</p> <?php echo $search_criteria['hotel_search_adult_count']; ?></div>



						<div class="atithi-md-1 atithi-sm-1"><p class="atithi_search_captions">Children:</p> <?php echo $search_criteria['hotel_search_children_count']; ?></div>



						<div class="atithi-md-2 atithi-sm-2"><a href="?gahb_action=clear_hotel_search" class="button">Clear Search Filter</a></div>

</div>

					</div>



					<hr />



				<?php } ?>



				<?php



				if( $hotel_found ){



					$query = new WP_Query( $args );



					if ( $query->have_posts() ) {



						?>



						<ul>



							<?php while ( $query->have_posts() ) { $query->the_post(); ?>



							<?php



								$hotel_id = get_the_ID();



								$hotel_title = get_the_title();



								$hotel_permalink = get_permalink();



								



								$hotel_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );



								if( $hotel_thumbnail_src ){



									$hotel_thumbnail_src = $hotel_thumbnail_src[0];



								} else {



									$hotel_thumbnail_src = gahb_get_no_image_src();



								}



							?>



							<li>



								<div>



									<a href="<?php echo $hotel_permalink; ?>">



										<img src="<?php echo $hotel_thumbnail_src; ?>" />



									</a>



									<br />



									<a href="<?php echo add_query_arg(array("hotel_id"=> $hotel_id),get_permalink($rooms_list_page_id)); ?>">View Rooms</a>



								</div>



							</li>



							<?php } ?>



						</ul>



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



				} else {



					?>



					<div class="no_hotel_found">



						Sorry!!! No hotels found in your search criteria



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



