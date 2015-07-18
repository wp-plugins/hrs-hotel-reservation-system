<?php





session_start();





add_shortcode( 'gahb_booking_dashboard', 'add_list_booking_shortcode_func' );





function add_list_booking_shortcode_func() {





	$booking_found=true;





	global $wpdb;





	$table_prefix=$wpdb->prefix;


	


	if( isset($_REQUEST["booking_id"]) && $_REQUEST["booking_id"]!="" && isset($_REQUEST["success"]) && $_REQUEST["success"]=="true")


	{


		$booking_id=$_REQUEST["booking_id"];


		$mybookingdata = $wpdb->get_results( "SELECT * FROM ".$table_prefix."gahb_bookings where booking_id=".$booking_id );


		if(count($mybookingdata)==1 && $mybookingdata[0]->status==0)


		{


			$id=$mybookingdata[0]->booking_id;


			$booking_rooms_count=get_post_meta($id,'booking_rooms_count',true);


			$hotel_id=$mybookingdata[0]->hotel_id;





			$room_id=$mybookingdata[0]->room_type_id;


			


			$arrival_date= date('Y-m-d',strtotime($mybookingdata[0]->arrival_date));


			


			$departure_date=date('Y-m-d',strtotime($mybookingdata[0]->departure_date));


			


			$date_range=createDateRangeArray($arrival_date,$departure_date);


			


			foreach($date_range as $search_dates_temp)


			{


				$search_date= date('Y-m-d',strtotime($search_dates_temp));


				$search_date=strtotime($search_date);


				$total_booked_rooms=get_post_meta($hotel_id,$search_date."_".$room_id,true);


				if(empty($total_booked_rooms))


				{


					$room_total_count=$booking_rooms_count;


				}


				else


				{


					$room_total_count=($total_booked_rooms+$booking_rooms_count);


				}


				update_post_meta($hotel_id,$search_date."_".$room_id,$room_total_count);


			}		


			update_post_meta( $id, "booking_status", "1");


			$table_name = $table_prefix."gahb_bookings";


			$wpdb->query("update $table_name set status=1 where booking_id =$id");


		}


	}


	$mydatarows = $wpdb->get_results( "SELECT * FROM ".$table_prefix."gahb_bookings where user_id=".get_current_user_id() );


	if(count($mydatarows)<1)


	{


		$booking_found=false;


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


				<?php


				if( $booking_found ){


					?><ul class="booking_found_ul_class heading">


					<li class="booking_found_li_class">Booking ID</li><li class="booking_found_li_class">Hotel Name</li>


                    <li class="booking_found_li_class">Room Type</li><li class="booking_found_li_class">Arrival Date</li>


                    <li class="booking_found_li_class">Departure Date</li><li class="booking_found_li_class">Payment</li>


                    <li class="booking_found_li_class">Status</li>


                    </ul>


					<ul class="booking_found_ul_class details">


					<?php


					for($i=0;$i<count($mydatarows);$i++)


					{?>


                   


						<li class="booking_found_li_class"><?php echo $mydatarows[$i]->booking_id; ?></li>


                        <li class="booking_found_li_class"><?php echo get_the_title( $mydatarows[$i]->hotel_id); ?></li>


                        <li class="booking_found_li_class"><?php echo get_the_title( $mydatarows[$i]->room_type_id); ?></li>


                        <li class="booking_found_li_class"><?php echo date('F j, Y', strtotime($mydatarows[$i]->arrival_date)); ?></li>


                        <li class="booking_found_li_class"><?php echo date('F j, Y', strtotime($mydatarows[$i]->departure_date)); ?></li>


                        <li class="booking_found_li_class"><?php echo get_price_string($mydatarows[$i]->payment); ?></li>


						<li class="booking_found_li_class"><?php if($mydatarows[$i]->status=="1"){?>Confirm<?php } else{ ?>Not Confirm<?php } ?></li>


					<?php


					}


					?></ul><?php


				}


				else


				{


					?>


						<div class="no_hotel_found">


							Sorry!!! No Booking found.


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





