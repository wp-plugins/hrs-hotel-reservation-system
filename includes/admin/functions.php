<?php

function hbs_mail($to, $subject="", $body="", $from_email="", $from_name="")
{
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );
	$headers[] = 'From: '.$from_name.' <'.$from_email.'>';
	wp_mail( $to, $subject, $body, $headers );
	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
}
function set_html_content_type() 
{
	return 'text/html';
}

function gahb_get_pages_list(){
	$pages = array();
	
	$args	=	array(
					'post_type'			=>	'page',
					'post_status'		=>	'publish',
					'pagination'		=>	false,
					'posts_per_page'	=>	'-1',
					'orderby'			=>	'title',
					'order'				=>	'ASC',
				);
	
	$posts	=	get_posts( $args );
	
	if( $posts && count( $posts ) ){
		foreach( $posts as $post ){
			$pages[$post->ID]	=	array(
										'title'	=>	$post->post_title,
										'slug'	=>	$post->post_name,
									);
		}
	}
	
	return $pages;
}
function gahb_is_page_published( $page_id ){
	
	$post = get_post( $page_id );
	if( !is_null( $post ) ){
		if( 'publish' == $post->post_status ){
			return true;
		}
	}
	return false;
}
function gahb_process_search_hotel_shortcode()
{
		$return=array('success'=>false,'errors'=>array());
		$error = false;
		$errors = array();
		
		$hotel_search_place = trim( $_REQUEST['hotel_search_place'] );
		$hotel_search_arrival_date = trim( $_REQUEST['hotel_search_arrival_date'] );
		$hotel_search_departure_date = trim( $_REQUEST['hotel_search_departure_date'] );
		$hotel_search_rooms_count = trim( $_REQUEST['hotel_search_rooms_count'] );
		$hotel_search_adult_count = trim( $_REQUEST['hotel_search_adult_count'] );
		$hotel_search_children_count = trim( $_REQUEST['hotel_search_children_count'] );
		$hotel_search_type = trim( $_REQUEST['hotel_search_type'] );
		if(empty($hotel_search_place))
		{
			$error = true;
			$errors['hotel_search_place'] = "Please choose place";
		}
		if(empty($hotel_search_arrival_date))
		{
			$error = true;
			$errors['hotel_search_arrival_date'] = "Please choose arrival date";
		}
		if(empty($hotel_search_departure_date))
		{
			$error = true;
			$errors['hotel_search_departure_date'] = "Please choose departure date";
		}
		if(empty($hotel_search_rooms_count))
		{
			$error = true;
			$errors['hotel_search_rooms_count'] = "Please choose rooms";
		}
		if(empty($hotel_search_adult_count))
		{
			$error = true;
			$errors['hotel_search_adult_count'] = "Please choose adults";
		}
		if($hotel_search_children_count=='')
		{
			$error = true;
			$errors['hotel_search_children_count'] = "Please choose children";
		}
		if( !$error )
		{
			$result = gahb_show_custom_multiple_hotel_list( $hotel_search_place, $hotel_search_arrival_date, $hotel_search_departure_date, $hotel_search_rooms_count, $hotel_search_adult_count, $hotel_search_children_count);
			if(empty($result))
			{
				$error = true;
				$errors['hotel_search_rooms_count'] = "No relevant record found.";
			}
		}
		
		if( !$error ){
			//echo strtotime($hotel_search_arrival_date). " Cur". time();
			$date_for_validate=date('Y-m-d',time());
			$date_for_validate=strtotime($date_for_validate);
						
			
			$hotel_search_arrival_date=date('Y-m-d',strtotime($hotel_search_arrival_date));
			$hotel_search_departure_date=date('Y-m-d',strtotime($hotel_search_departure_date));
			
			
			if(strtotime($hotel_search_arrival_date)<$date_for_validate)
			{
				$error = true;
				$errors['hotel_search_arrival_date'] = "Please choose valid arrival date";
			}
			if(strtotime($hotel_search_departure_date)<$date_for_validate || strtotime($hotel_search_departure_date)<strtotime($hotel_search_arrival_date))
			{
				$error = true;
				$errors['hotel_search_departure_date'] = "Please choose valid departure date";
			}
			if($hotel_search_rooms_count<1)
			{
				$error = true;
				$errors['hotel_search_rooms_count'] = "Please choose rooms";
			}
			if($hotel_search_adult_count<1)
			{
				$error = true;
				$errors['hotel_search_adult_count'] = "Please choose adults";
			}
			if($hotel_search_children_count<0)
			{
				$error = true;
				$errors['hotel_search_children_count'] = "Please choose children";
			}
		}
		
		if( $error ){
			$return["errors"]=$errors;
		}
		else
		{
			$return["success"]=true;
			$return["data"]=array(
							'hotel_search_place'=>$hotel_search_place,
							'hotel_search_arrival_date'=>$hotel_search_arrival_date,
							'hotel_search_departure_date'=>$hotel_search_departure_date,
							'hotel_search_rooms_count'=>$hotel_search_rooms_count,
							'hotel_search_adult_count'=>$hotel_search_adult_count,
							'hotel_search_children_count'=>$hotel_search_children_count
							);	
		}
		
		return $return;
}
function gahb_get_no_image_src(){
	$src = GAHB__PLUGIN_DIR_PATH . 'assets/images/no-image-available.jpg';
	return $src;
}
function gahb_wp_get_attachment_image_src( $thumbnail_id, $size = 'thumbnail' ){
	$thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, $size );
	
	if( $thumbnail_src ){
		return $thumbnail_src[0];
	}
	
	return gahb_get_no_image_src();
}
function gahb_is_hotel( $post_id ){
	$args	=	array(
						'post_type'			=>	'gahb_hotel',
						'post_status'		=>	'publish',
						'posts_per_page'	=>	'-1',
						'post__in'			=>	array( $post_id ),
						'fields'			=>	'ids',
					);
	$posts = get_posts( $args );
	if( !empty( $posts ) ){
		return true;
	}
	
	return false;
}
function gahb_is_room( $post_id ){
	$args	=	array(
						'post_type'			=>	'gahb_room',
						'post_status'		=>	'publish',
						'posts_per_page'	=>	'-1',
						'post__in'			=>	array( $post_id ),
						'fields'			=>	'ids',
					);
	$posts = get_posts( $args );
	if( !empty( $posts ) ){
		return true;
	}
	
	return false;
}
function gahb_get_hotel_address( $post_id ){
	$location = false;
	
	if( gahb_is_hotel( $post_id ) ){
		$address_line_1 = get_post_meta( $post_id, '_gahb_hotel_address_line_1', true );
		$address_line_2 = get_post_meta( $post_id, '_gahb_hotel_address_line_2', true );
		$city = get_post_meta( $post_id, '_gahb_hotel_city', true );
		$state = get_post_meta( $post_id, '_gahb_hotel_state', true );
		$country = get_post_meta( $post_id, '_gahb_hotel_country', true );
		$postal_code = get_post_meta( $post_id, '_gahb_hotel_postal_code', true );
		
		$loc = new GAHB_Locations();
		$city = $loc->get_city( $city );
		$state = $loc->get_state( $state );
		$country = $loc->get_country( $country );
		
		$location = '';
		if( !empty( $address_line_1 ) ){
			$location .= $address_line_1;
		}
		
		if( !empty( $address_line_2 ) ){
			$location .= ', ' . $address_line_2;
		}
		
		if( $city ){
			$location .= ', ' . $city['name'];
		}
		
		if( !empty( $postal_code ) ){
			$location .= ' - ' . $postal_code;
		}
		
		if( $state ){
			$location .= ', ' . $state['name'];
		}
		
		if( $country ){
			$location .= ', ' . $country['name'];
		}
		
		return $location;
	}
	
	return $location;
}
function gahb_get_current_url(){
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}
function gahb_approve_link_in_bookings($actions, $post)
{
    if ($post->post_type=='gahb_booking')
    {
		$booking_status = get_post_meta( $post->ID, "booking_status", true);
		if($booking_status == "0")
		{
        	$actions['approve_booking'] = '<a href="post.php?post='.$post->ID.'&action=approve_booking" title="" rel="permalink">Approve Booking</a>';
		}
		else if($booking_status == "1")
		{
			$actions['approve_booking'] = '<a href="javascript:void(0);" title="" rel="permalink">Approved</a>';
		}
    }
    return $actions;
}
add_filter('post_row_actions', 'gahb_approve_link_in_bookings', 10, 2);
function approve_booking_post_type_func () 
{
	if(!(isset( $_GET['post']) || (isset( $_REQUEST['action']) && 'archive' == $_REQUEST['action'] )))
	{
    	wp_die( 'No post supplied!');
    }
    $id = (int) ( isset( $_GET['post']) ? $_GET['post'] : $_REQUEST['post']);
    if($id)
	{
		$redirect_post_type = 'post_type=gahb_booking&';
		update_post_meta( $id, "booking_status", "1");
		global $wpdb;
		$prefix = $wpdb->prefix;;
		$table_name = $prefix."gahb_bookings";
		$wpdb->query("update $table_name set status=1 where booking_id = $id");
		
		
		$booking_rooms_count=get_post_meta($id,'booking_rooms_count',true);
		$hotel_id=get_post_meta($id,'booking_hotel_id',true);
		$room_id=get_post_meta($id,'booking_room_id',true);
		$arrival_date=get_post_meta($id,'booking_arr_date',true);
		$departure_date=get_post_meta($id,'booking_dep_date',true);
		
		$arrival_date= date('Y-m-d',strtotime($arrival_date));
		
		$departure_date=date('Y-m-d',strtotime($departure_date));
		
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
		
		wp_redirect( admin_url( 'edit.php?' . $redirect_post_type . 'approved=1&ids='.$id ));
		exit;
	} 
	else
	{
		wp_die( __( 'Sorry, i cant find the post-id', $this->textdomain ) );
	}
}
add_action( 'admin_action_approve_booking', 'approve_booking_post_type_func');