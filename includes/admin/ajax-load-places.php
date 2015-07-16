<?php
add_action( 'wp_ajax_load_places', 'gahb_load_places_func' );
add_action( 'wp_ajax_nopriv_load_places', 'gahb_load_places_func' );
function gahb_load_places_func() {
	$results = array( 'items' => array() );
	if( isset( $_GET['gahb_q'] ) ){
		$q = $_GET['gahb_q'];
		$loc = new GAHB_Locations();
		$results['items'] = $loc->query_places( $q );
	}
	echo json_encode( $results );
	exit;
}

add_action( 'wp_ajax_nopriv_login_user_frontend', 'login_user_frontend_func' );
function login_user_frontend_func()
{
	if(isset($_POST['user_email_login']))
	{
		$user_email_login = trim($_POST['user_email_login']);
		$user_password_login = trim($_POST['user_password_login']);
	  
		if(empty($user_email_login))
		{
		  	wp_send_json_success(array("rcode" => "2", "message" => "Please enter username."));
		}
		if(empty($user_password_login))
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter password."));
		}
		$user_obj = get_user_by('login', $user_email_login );	
		if(!$user_obj) 
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Invalid username / password."));
		}
		else
		{
			if ( !( $user_obj && wp_check_password( $user_password_login, $user_obj->data->user_pass, $user_obj->ID) ) ) 
			{
				wp_send_json_success(array("rcode" => "2", "message" => "Invalid username / password."));
			}
			else
			{
				wp_set_current_user( $user_obj->ID, $user_obj->user_login );
				wp_set_auth_cookie( $user_obj->ID );
				do_action( 'wp_login', $user_obj->user_login );
				wp_send_json_success(array(rcode=>"1"));
			}
		}
	}	
}

add_action( 'wp_ajax_nopriv_register_user_frontend', 'register_user_frontend_func' );
function register_user_frontend_func()
{
	if(isset($_POST['user_first_name']))
	{
		$error = array();
		$first_name = trim($_POST['user_first_name']);
		$last_name = trim($_POST['user_last_name']);
		$email = trim($_POST['user_email']);
		$user_address = trim($_POST['user_address']);
	  
		if(empty($first_name))
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter first name."));
		}
		if(empty($last_name))
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter last name."));
		}
		if(empty($user_address))
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter address."));
		}
		if(empty($email)) 
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter Email."));
		}
		/* valid email, duplicate email, duplicate password validation START */  
		if(!is_email($email) )
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Please enter valid Email ID."));
		}
		if(email_exists($email) && empty($error) && ( count($error) == 0 ) )
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Email ID already registered."));
		}
		if(username_exists($emai) )
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Email ID already registered."));
		}
		/* valid email, duplicate email, validation END */
  
		/* validation done, now insert user*/
		$password = wp_generate_password();
		$userlogindata = array(
							  'user_login'	=>	$email,
							  'user_email'	=>	$email,
							  'user_pass'	=>	$password,
							  'first_name'	=>	$first_name,
							  'last_name'	=>	$last_name,
						  );
		$user_id = wp_insert_user($userlogindata);
		if(!is_wp_error($user_id))
		{
			update_user_meta( $user_id, "hbs_customer_address", $user_address); 
			/* send mail to admin also, START */
			$admin_email = get_option( 'admin_email');
			if( !empty($admin_email) )
			{
				$subject = "You are registered successfully on ".site_url();
				$body_message ="Congratulation! Yor are registered on ".site_url().":<br /><br />Username: $email<br /><br />Password: $password";
				$from_name="Admin";
				$ret = hbs_mail($email, $subject, $body_message, $from_email=$admin_email, $from_name);
			}
			/* send mail to admin also, END */
			/* login instantely after registration (even mail not sent) START */
			$user_obj = get_user_by('id', $user_id);
			wp_set_current_user( $user_obj->ID, $user_obj->user_login );
			wp_set_auth_cookie( $user_obj->ID );
			do_action( 'wp_login', $user_obj->user_login );
			/* login instantely after registration (even mail not sent END */
			wp_send_json_success(array(rcode=>"1"));
		}
		else
		{
			wp_send_json_success(array("rcode" => "2", "message" => "Something went wrong! Please try again."));
		}
	}
}