<?php
function gahb_send_email($booking = array()){
	
	$curr_user = gahb_get_current_user();
	if( $curr_user && !empty( $booking ) ){
		$content = '';
		ob_start();
		?>
		<div style="border: 2px solid #000;padding: 10px;">
			<h1>Your Booking Details</h1>
			<b> Hotel: </b> <a href="<?php echo $booking['hotel_link']; ?>"><?php echo $booking['hotel_name']; ?></a> <br /><br />
			<b> Room: </b> <a href="<?php echo $booking['room_link']; ?>"><?php echo $booking['room_name']; ?></a> <br /><br />
			<b> Arrival Date: </b> <?php echo date( 'F j, Y', strtotime( $booking['arrival_date'] ) ); ?> <br /><br />
			<b> Departure Date: </b> <?php echo date( 'F j, Y', strtotime( $booking['departure_date'] ) ); ?> <br /><br />
			<b> Room(s): </b> <?php echo $booking['room_count']; ?> <br /><br />
			<b> Adults: </b> <?php echo $booking['adult_count']; ?> <br /><br />
			<b> Children: </b> <?php echo $booking['children_count']; ?> <br /><br />
		</div>
		<?php
		$content .= ob_get_clean();
		
		add_filter('wp_mail_from', 'gahb_send_email_from');
		add_filter( 'wp_mail_from_name', 'gahb_send_email_from_name' );
		add_filter( 'wp_mail_content_type', 'gahb_send_email_content_type' );
		
		wp_mail( $curr_user['email'], 'Booking has been placed', $content);
		
		remove_filter('wp_mail_from', 'gahb_send_email_from');
		remove_filter( 'wp_mail_from_name', 'gahb_send_email_from_name' );
		remove_filter( 'wp_mail_content_type', 'gahb_send_email_content_type' );
	}
}


function gahb_send_email_from( $from_email ){
	$admin_email = get_option('admin_email');
	if( is_email( $admin_email ) ){
		$from_email = $admin_email;
	}
	return $from_email;
}


function gahb_send_email_from_name( $from_name ) {
	$site_title = get_bloginfo();
	if( $site_title ){
		$from_name = $site_title;
	}
	return $from_name;
}


function gahb_send_email_content_type( $email_content_type ) {
	return 'text/html';
}

function gahb_get_current_user(){
	$curr_user = get_user_by( 'id', get_current_user_id() );
	if( $curr_user ){
		$curr_user_id = $curr_user->ID;
		$curr_user_email = $curr_user->data->user_email;
		$curr_user_login = $curr_user->data->user_login;
		$curr_user_first_name = get_user_meta( $curr_user_id, 'first_name', true );
		$curr_user_last_name = get_user_meta( $curr_user_id, 'las_name', true );
		$curr_user_name = '';
		if( !empty( $curr_user_first_name ) && !empty( $curr_user_last_name ) ){
			$curr_user_name = $curr_user_first_name . ' ' . $curr_user_last_name;
		} else {
			$curr_user_name = $curr_user_login;
		}
		
		$user_data	=	array(
							'id'			=>	$curr_user_id,
							'email'			=>	$curr_user_email,
							'name'			=>	$curr_user_name,
						);
		return $user_data;
	}
	
	return false;
}