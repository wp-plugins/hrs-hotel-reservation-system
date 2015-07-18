<?php

function gahb_show_custom_hotel_list( $hotel_search_place, $hotel_search_arrival_date, $hotel_search_departure_date, $hotel_search_rooms_count, $hotel_search_adult_count, $hotel_search_children_count )

{

	$args	=	array(

					'post_type'		=>	'gahb_hotel',

					'post_status'	=>	'publish',

					'fields'		=>	'ids',

					'meta_query'	=>	array(

											'relation' => 'OR',

											

											array(

												'key'		=>	'_gahb_hotel_city',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

											array(

												'key'		=>	'_gahb_hotel_state',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

											array(

												'key'		=>	'_gahb_hotel_country',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

										),

				);

	

	$filtered_hotel_ids = false;

	

	$post_ids = get_posts( $args );

	//print_r($post_ids);

	if ( $post_ids && count( $post_ids ) ) {

		$hotel_ids=array();

		$hotel_ids=$post_ids;

		

		$filtered_hotel_ids	=	gahb_show_custom_rooms_list(

									$hotel_ids,

									

									$hotel_search_place,

									

									$hotel_search_arrival_date,

									$hotel_search_departure_date,

									$hotel_search_rooms_count,

									$hotel_search_adult_count,

									$hotel_search_children_count

								);

	}

	

	

	return $filtered_hotel_ids;

}

function gahb_show_custom_rooms_list($hotel_ids,$hotel_search_place,$hotel_search_arrival_date,$hotel_search_departure_date,$hotel_search_rooms_count,$hotel_search_adult_count,$hotel_search_children_count)

{

	

	// WP_Query arguments

	$meta_query=array('relation' => 'OR');

	

	

	foreach($hotel_ids as $temp_hotel_id)

	{

		$meta_query[]=array(

						'key'       => '_gahb_hotel_room_hotel',

						'value'     => $temp_hotel_id,

						);

	}

	$args = array (

				'post_type'              => 'gahb_room',

				'post_status'            => 'publish',

				'fields'				 => 'ids',

				'meta_query'             => $meta_query,

			);

	$post_ids = get_posts( $args );

		

	if ( $post_ids ) {

		$room_type_ids=array();

		$room_type_ids=$post_ids;

	}

	

	$filtered_hotel_ids=array();

	

	$arrival_date= date('Y-m-d',strtotime($hotel_search_arrival_date));

	$departure_date=date('Y-m-d',strtotime($hotel_search_departure_date));

	$date_range=createDateRangeArray($arrival_date,$departure_date);

	

	foreach($room_type_ids as $room_id)

	{

		$temp_hotel_id=array();

		$temp_hotel_id=get_post_meta($room_id,'_gahb_hotel_room_hotel');

		foreach($temp_hotel_id as $hotel_id)

		{

			$gahb_hotel_city=get_post_meta($hotel_id,'_gahb_hotel_city',true);

			$gahb_hotel_state=get_post_meta($hotel_id,'_gahb_hotel_state',true);

			$gahb_hotel_country=get_post_meta($hotel_id,'_gahb_hotel_country',true);

			if($hotel_search_place==$gahb_hotel_city || $hotel_search_place==$gahb_hotel_state ||$hotel_search_place==$gahb_hotel_country)

			{

				$search_error=false;

				foreach($date_range as $search_dates)

				{

					$search_date=strtotime($search_dates);

					$room_total_count=get_post_meta($room_id,'_gahb_hotel_room_total_count',true);

					$room_max_adult_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_adult_occupancy',true);

					$room_max_children_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_children_occupancy',true);

					$room_max_adult_occupancy=($hotel_search_rooms_count*$room_max_adult_occupancy);

					$room_max_children_occupancy=($hotel_search_rooms_count*$room_max_children_occupancy);

					//$hotel_id=get_post_meta($room_id,'_gahb_hotel_room_hotel',true);

					$total_booked_rooms=get_post_meta($hotel_id,$search_date."_".$room_id,true);

					if(empty($total_booked_rooms))

					{

						$room_total_count=($room_total_count);

					}

					else

					{

						$room_total_count=($room_total_count-$total_booked_rooms);

					}

					if($room_total_count>=$hotel_search_rooms_count && $room_max_adult_occupancy>=$hotel_search_adult_count && $room_max_children_occupancy>=$hotel_search_children_count)

					{

					}

					else

					{

						$search_error=true;

					}

				}

				if(!$search_error)

				{

					$filtered_hotel_ids[]=$hotel_id;

				}

			}

		}

	}

	return $filtered_hotel_ids;

}

function createDateRangeArray($strDateFrom,$strDateTo) {

  // takes two dates formatted as YYYY-MM-DD and creates an

  // inclusive array of the dates between the from and to dates.

  $aryRange=array();

  $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));

  $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

  if ($iDateTo>=$iDateFrom) {

    array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry

    while ($iDateFrom<$iDateTo) {

      $iDateFrom+=86400; // add 24 hours

      array_push($aryRange,date('Y-m-d',$iDateFrom));

    }

  }

  return $aryRange;

}

//This function Used for rooms list page

function gahb_show_custom_room_list($hotel_id,$hotel_search_arrival_date,$hotel_search_departure_date,$hotel_search_rooms_count,$hotel_search_adult_count,$hotel_search_children_count)

{

	// WP_Query arguments

	$meta_query=array('relation' => 'OR');

	$meta_query[]=array(

				'key'       => '_gahb_hotel_room_hotel',

				'value'     => $hotel_id,

				);

	

	$args = array (

				'post_type'              => 'gahb_room',

				'post_status'            => 'publish',

				'fields'				 => 'ids',

				'meta_query'             => $meta_query,

			);

			

	$post_ids = get_posts( $args );

	if ( $post_ids ) {

		$room_type_ids=array();

		$room_type_ids=$post_ids;

	}

	

	$filtered_rooms_ids=array();

	

	$arrival_date= date('Y-m-d',strtotime($hotel_search_arrival_date));

	$departure_date=date('Y-m-d',strtotime($hotel_search_departure_date));

	

	$date_range=createDateRangeArray($arrival_date,$departure_date);

	

	

	

	

	foreach($room_type_ids as $room_id)

	{

		$search_error=false;

		foreach($date_range as $search_dates)

		{

			$search_date=strtotime($search_dates);

			$room_total_count=get_post_meta($room_id,'_gahb_hotel_room_total_count',true);

			$room_max_adult_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_adult_occupancy',true);

			$room_max_children_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_children_occupancy',true);

			

			$room_max_adult_occupancy=($hotel_search_rooms_count*$room_max_adult_occupancy);

			$room_max_children_occupancy=($hotel_search_rooms_count*$room_max_children_occupancy);

			

			//$hotel_id=get_post_meta($room_id,'_gahb_hotel_room_hotel',true);

			$total_booked_rooms=get_post_meta($hotel_id,$search_date."_".$room_id,true);

			if(empty($total_booked_rooms))

			{

				$room_total_count=($room_total_count);

			}

			else

			{

				$room_total_count=($room_total_count-$total_booked_rooms);

			}

			if($room_total_count>=$hotel_search_rooms_count && $room_max_adult_occupancy>=$hotel_search_adult_count && $room_max_children_occupancy>=$hotel_search_children_count)

			{

			}

			else

			{

				$search_error=true;

			}

		}

		if(!$search_error)

		{

			$filtered_rooms_ids[]=$room_id;	

		}

		

		

	}

	

	return $filtered_rooms_ids;

}





/* New function used to multiple rooms for multiple hotels*/



function gahb_show_custom_multiple_hotel_list( $hotel_search_place, $hotel_search_arrival_date, $hotel_search_departure_date, $hotel_search_rooms_count, $hotel_search_adult_count, $hotel_search_children_count )

{
//echo $hotel_search_place ." -- ". $hotel_search_arrival_date ." -- ". $hotel_search_departure_date ." -- ". $hotel_search_rooms_count ." -- ". $hotel_search_adult_count ." -- ". $hotel_search_children_count;
	$args	=	array(

					'post_type'		=>	'gahb_hotel',

					'post_status'	=>	'publish',

					'fields'		=>	'ids',

					'meta_query'	=>	array(

											'relation' => 'OR',

											

											array(

												'key'		=>	'_gahb_hotel_city',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

											array(

												'key'		=>	'_gahb_hotel_state',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

											array(

												'key'		=>	'_gahb_hotel_country',

												'value'		=>	$hotel_search_place,

												'compare'	=>	'=',

											),

										),

				);

	

	$filtered_hotel_ids = false;

	

	$post_ids = get_posts( $args );

	//print_r($post_ids);

	if ( $post_ids && count( $post_ids ) ) {

		$hotel_ids=array();

		$hotel_ids=$post_ids;

		

		$filtered_rooms_ids	=	gahb_show_custom_multiple_rooms_list(

									$hotel_ids,

									$hotel_search_place,

									$hotel_search_arrival_date,

									$hotel_search_departure_date,

									$hotel_search_rooms_count,

									$hotel_search_adult_count,

									$hotel_search_children_count

								);

	}

	

	

	return $filtered_rooms_ids;

}

function gahb_show_custom_multiple_rooms_list($hotel_ids,$hotel_search_place,$hotel_search_arrival_date,$hotel_search_departure_date,$hotel_search_rooms_count,$hotel_search_adult_count,$hotel_search_children_count)

{

	

	// WP_Query arguments

	$meta_query=array('relation' => 'OR');

	foreach($hotel_ids as $temp_hotel_id)

	{

		$meta_query[]=array(

						'key'       => '_gahb_hotel_room_hotel',

						'value'     => $temp_hotel_id,

						);

	}

	$args = array (

				'post_type'              => 'gahb_room',

				'post_status'            => 'publish',

				'fields'				 => 'ids',

				'meta_query'             => $meta_query,

			);

	$post_ids = get_posts( $args );

			$filtered_room_ids=array();

	if ( $post_ids ) {

		$room_type_ids=array();

		$room_type_ids=$post_ids;

	

		$arrival_date= date('Y-m-d',strtotime($hotel_search_arrival_date));

		$departure_date=date('Y-m-d',strtotime($hotel_search_departure_date));

		$date_range=createDateRangeArray($arrival_date,$departure_date);

		

		foreach($room_type_ids as $room_id)

		{		

			$temp_hotel_id=array();

			$temp_hotel_id=get_post_meta($room_id,'_gahb_hotel_room_hotel');

			

			if(!empty($temp_hotel_id))

			{

				foreach($temp_hotel_id as $hotel_id)

				{

					$gahb_hotel_city=get_post_meta($hotel_id,'_gahb_hotel_city',true);

					$gahb_hotel_state=get_post_meta($hotel_id,'_gahb_hotel_state',true);

					$gahb_hotel_country=get_post_meta($hotel_id,'_gahb_hotel_country',true);

					//echo $hotel_search_place ." - ".$gahb_hotel_city ." - ".$gahb_hotel_state ." - ".$gahb_hotel_country;

					if($hotel_search_place==$gahb_hotel_city || $hotel_search_place==$gahb_hotel_state ||$hotel_search_place==$gahb_hotel_country)

					{

						$search_error=false;

						if(!empty($date_range))

						{

							foreach($date_range as $search_dates)

							{

								

								$search_date=strtotime($search_dates);

								$room_total_count=get_post_meta($room_id,'_gahb_hotel_room_total_count',true);

								$room_max_adult_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_adult_occupancy',true);

								$room_max_children_occupancy=get_post_meta($room_id,'_gahb_hotel_room_max_children_occupancy',true);

								$room_max_adult_occupancy=($hotel_search_rooms_count*$room_max_adult_occupancy);

								$room_max_children_occupancy=($hotel_search_rooms_count*$room_max_children_occupancy);

								//$hotel_id=get_post_meta($room_id,'_gahb_hotel_room_hotel',true);

								$total_booked_rooms=get_post_meta($hotel_id,$search_date."_".$room_id,true);

								if(empty($total_booked_rooms))

								{

									

									$room_total_count=($room_total_count);

								}

								else

								{

									

									$room_total_count=($room_total_count-$total_booked_rooms);

								}

								if($room_total_count>=$hotel_search_rooms_count && $room_max_adult_occupancy>=$hotel_search_adult_count && $room_max_children_occupancy>=$hotel_search_children_count)

								{

									

								}

								else

								{

									

									$search_error=true;

								}

								

							}

							if(!$search_error)

							{

								

								$filtered_room_ids[]=array("hotel_id"=>$hotel_id,"room_id"=>$room_id);

							}

						}

					}

				}

			}

		}	

	}

	return $filtered_room_ids;

}