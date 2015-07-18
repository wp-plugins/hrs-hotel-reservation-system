<?php

session_start();

add_shortcode( 'gahb_rooms_list', 'add_list_room_shortcode_func' );

function add_list_room_shortcode_func() {
	$booking_dashboard_page_id = get_option( 'gahb_booking_dashboard_page_id', 'none' );

	$room_found = true;

	if(isset($_SESSION["hotels_search_data"]) && !is_null($_SESSION["hotels_search_data"]) && isset($_REQUEST["hotel_id"]) && $_REQUEST["hotel_id"]!='')

	{

		$search_criteria = $_SESSION["hotels_search_data"];

		$hotel_id=$_REQUEST["hotel_id"];if( !empty($search_criteria["hotel_search_place"]) && !empty( $search_criteria["hotel_search_arrival_date"] ) && !empty( $search_criteria["hotel_search_departure_date"]) ){

		$rooms_list	=	gahb_show_custom_room_list(

							$hotel_id,

							$search_criteria["hotel_search_arrival_date"],

							$search_criteria["hotel_search_departure_date"],

							$search_criteria["hotel_search_rooms_count"],

							$search_criteria["hotel_search_adult_count"],

							$search_criteria["hotel_search_children_count"]

						);}

	}

	

	

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array (

		'post_type'              => 'gahb_room',

		'post_status'            => 'publish',

		'pagination'             => true,

		'posts_per_page'         => '1',

		'paged'					 => $paged,

	);

	if( isset($rooms_list) ) {

		if( $rooms_list ){

			$args['post__in'] = $rooms_list;

		} else {

			$room_found = false;

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

            <?php if( isset($rooms_list) ) { ?>

					<div class="search_filter_data">

					<h4>Search Criteria</h4>

						Place: <?php echo $search_criteria['hotel_search_place']; ?><br />

						Arrival Date: <?php echo $search_criteria['hotel_search_arrival_date']; ?><br />

						Departure Date: <?php echo $search_criteria['hotel_search_departure_date']; ?><br />

						Rooms: <?php echo $search_criteria['hotel_search_rooms_count']; ?><br />

						Adults: <?php echo $search_criteria['hotel_search_adult_count']; ?><br />

						Children: <?php echo $search_criteria['hotel_search_children_count']; ?><br />

						<a href="?gahb_action=clear_hotel_search">Clear Search Filter</a>

					</div>

					<hr />

				<?php } ?>

				<?php

				if( $room_found ){

					// The Query

					$query = new WP_Query( $args );

					// The Loop

					if ( $query->have_posts() ) {

						?><ul><?php

							while ( $query->have_posts() ) { $query->the_post(); ?>

								<?php

									$room_id = get_the_ID();

									$room_title = get_the_title();

									$room_permalink = get_permalink();

									

									$room_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );

									if( $room_thumbnail_src ){

										$room_thumbnail_src = $room_thumbnail_src[0];

									} else {

										$room_thumbnail_src = gahb_get_no_image_src();

									}

								?>

								<li>

									<div>

										<a href="<?php echo $room_permalink; ?>">

											<img src="<?php echo $room_thumbnail_src; ?>" />

										</a>

										<br />

										<?php

											$details_link = get_permalink( $room_id );

											if( isset( $_REQUEST['hotel_id'] ) ){

												if( gahb_is_hotel( $_REQUEST['hotel_id'] ) ){

													$details_link = add_query_arg( array( 'hotel_id' => $_REQUEST['hotel_id'] ), get_permalink($room_id) );

												}

											}

										?>

										<?php  ?>

										<a href="<?php echo $details_link; ?>">View Details</a>

									</div>

								</li>

								<?php }

						?></ul><?php

						$big = 999999999; // need an unlikely integer



						echo paginate_links( array(

							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),

							'format' => '?paged=%#%',

							'current' => max( 1, get_query_var('paged') ),

							'total' => $query->max_num_pages

						) );

					}

					wp_reset_postdata();

				}

				else

				{

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

