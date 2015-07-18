<?php

session_start();

add_shortcode( 'gahb_booking_checkout', 'add_booking_checkout_shortcode_func' );

function add_booking_checkout_shortcode_func() {

	$booking_dashboard_page_id = get_option( 'gahb_booking_dashboard_page_id', 'none' );

	$is_booking = false;

	$request_submit=false;$request_type="";

	if( isset( $_REQUEST['booking_confirm_booking_gahb_on_arrival'] ) )

	{

		$request_submit=true;	

		$request_type="arrival";

	}

	if(isset( $_REQUEST['booking_confirm_booking_gahb_paypal'] ))

	{

		$request_submit=true;

		$request_type="paypal";

	}

	

	if($request_submit)

	{

		$booking_user_id=$_POST['booking_user_id'];

		$booking_hotel_id=$_POST['booking_hotel_id'];

		$booking_room_id=$_POST['booking_room_id'];

		$booking_arr_date=$_POST['booking_arr_date'];

		$booking_dep_date=$_POST['booking_dep_date'];

		$booking_rooms_count=$_POST['booking_rooms_count'];

		$booking_adult_coun=$_POST['booking_adult_coun'];

		$booking_children_count=$_POST['booking_children_count'];

		$charge_per_night=get_post_meta( $booking_room_id, '_gahb_hotel_room_charge_per_night', true );

		$hotel_name=get_the_title( $booking_hotel_id );

		$room_name=get_the_title( $booking_room_id );

		$userdata=get_userdata( $booking_hotel_id );

		$username=$userdata->data->display_name;

		$post_data = array(

				  'post_title'    => $username. " ".$hotel_name. " ".$room_name,

				  'post_content'  => $username. " ".$hotel_name. " ".$room_name,

				  'post_status'   => 'publish',

				  'post_author'   => $booking_hotel_id,

				  'post_type'	  => 'gahb_booking'

				);

				// Insert the post into the database

		$booking_id=wp_insert_post( $post_data );

		if($booking_id)

		{

			$room_charge=($charge_per_night*$booking_rooms_count);

			if($request_type=="paypal")

			{

				include 'dtpaypal.php';			

			}

			update_post_meta($booking_id, 'booking_hotel_id', $booking_hotel_id);

			update_post_meta($booking_id, 'booking_room_id', $booking_room_id);

			update_post_meta($booking_id, 'booking_arr_date', $booking_arr_date);

			update_post_meta($booking_id, 'booking_dep_date', $_POST['booking_dep_date']);

			update_post_meta($booking_id, 'booking_rooms_count', $_POST['booking_rooms_count']);

			update_post_meta($booking_id, 'booking_adult_coun', $_POST['booking_adult_coun']);

			update_post_meta($booking_id, 'booking_children_count', $_POST['booking_children_count']);

			update_post_meta($booking_id, 'booking_status', 0);

			global $wpdb;

			$table_prefix=$wpdb->prefix;

			$wpdb->query( "INSERT INTO ".$table_prefix."gahb_bookings ( `booking_id`,`hotel_id`,`room_type_id`,`arrival_date`,`departure_date`,`payment`,`payment_method`,`user_id` ) VALUES ( '$booking_id','$booking_hotel_id','$booking_room_id','$booking_arr_date','$booking_dep_date','$charge_per_night','','$booking_user_id')");

		}

	}

	if(isset($_SESSION["hotels_search_data"]) && !is_null($_SESSION["hotels_search_data"]) && isset($_REQUEST["hotel_id"]) && $_REQUEST["hotel_id"]!='')

	{

		$is_booking = true;

		$_SESSION["hotels_search_data"]['hotel_search_hotel_id'] = $_REQUEST["hotel_id"];

		$_SESSION["hotels_search_data"]['hotel_search_room_id'] = $_REQUEST["room_id"];		

		$search_criteria = $_SESSION["hotels_search_data"];

		$hotel_id=$_REQUEST["hotel_id"];

		$room_id=$_REQUEST["room_id"];

		$rooms_list	=	gahb_show_custom_room_list(

							$hotel_id,

							$search_criteria["hotel_search_arrival_date"],

							$search_criteria["hotel_search_departure_date"],

							$search_criteria["hotel_search_rooms_count"],

							$search_criteria["hotel_search_adult_count"],

							$search_criteria["hotel_search_children_count"]

						);

	}

	

	$output = '';

	

	ob_start();

	

	?>

		<div class="gahb_core_container gahb_core_hotel_search_box">

			<?php if( $is_booking ) { ?>

			<div class="booking_checkout_box">

            <h3>Booking Details</h3>

            

            <ul>

            

            <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Hotel:</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         

                <a href="<?php echo get_permalink( $search_criteria["hotel_search_hotel_id"] ); ?>"><?php echo get_the_title( $search_criteria["hotel_search_hotel_id"] ); ?></a>  

            </div>

            

                   </li>

            

<li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Room:</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         

           <a href="<?php echo get_permalink( $search_criteria["hotel_search_room_id"] ); ?>"><?php echo get_the_title( $search_criteria["hotel_search_room_id"] ); ?></a> 

            </div>

            

                   </li>

                   

                   <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Arrival Date:</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         

              <?php echo date('F j, Y', strtotime($search_criteria["hotel_search_arrival_date"])); ?>

            </div>

            

                   </li>

                   

                   

                   <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Departure Date::</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         

              <?php echo date('F j, Y', strtotime($search_criteria["hotel_search_departure_date"])); ?>

            </div>

            

                   </li>

                   

                   

                   <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Room(s):</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         <?php echo $search_criteria["hotel_search_rooms_count"]; ?>

            </div>

            

                   </li>

                   

                   

                   <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Adults:</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         

                <?php echo $search_criteria["hotel_search_adult_count"]; ?> 

            </div>

            

                   </li>

                   

                   

                   <li>

            

            <div class="checkout-section-left-side-container">

            

            <span class="left-side-check-span">Children:</span>

            </div>

            

            

              

            <div class="checkout-section-right-side-container">

         <?php echo $search_criteria["hotel_search_children_count"]; ?>

            </div>

            

                   </li>

            

            

            </ul>

            

       <?php /*?>     

				

				<b>Hotel:</b> <a href="<?php echo get_permalink( $search_criteria["hotel_search_hotel_id"] ); ?>"><?php echo get_the_title( $search_criteria["hotel_search_hotel_id"] ); ?></a><br /><br />

				<b>Room:</b> <a href="<?php echo get_permalink( $search_criteria["hotel_search_room_id"] ); ?>"><?php echo get_the_title( $search_criteria["hotel_search_room_id"] ); ?></a><br /><br />

				<b>Arrival Date:</b> <?php echo $search_criteria["hotel_search_arrival_date"]; ?><br /><br />

				<b>Departure Date:</b> <?php echo $search_criteria["hotel_search_departure_date"]; ?><br /><br />

				<b>No. of total Rooms:</b> <?php echo $search_criteria["hotel_search_rooms_count"]; ?><br /><br />

				<b>No. of total Adults:</b> <?php echo $search_criteria["hotel_search_adult_count"]; ?><br /><br />

				<b>No. of total children:</b> <?php echo $search_criteria["hotel_search_children_count"]; ?><br /><br /><?php */?>

				

				<?php if( is_user_logged_in() ) { ?>

				<form action="" method="post" name="booking_post" id="booking_post">

                	<input type="hidden" name="booking_user_id" value="<?php echo get_current_user_id(); ?>" />

                    <input type="hidden" name="booking_hotel_id" value="<?php echo $hotel_id; ?>" />

                    <input type="hidden" name="booking_room_id" value="<?php echo $room_id; ?>" />

                    <input type="hidden" name="booking_arr_date" value="<?php echo $search_criteria["hotel_search_arrival_date"]; ?>" />

                    <input type="hidden" name="booking_dep_date" value="<?php echo $search_criteria["hotel_search_departure_date"]; ?>" />

                    <input type="hidden" name="booking_rooms_count" value="<?php echo $search_criteria["hotel_search_rooms_count"]; ?>" />

                    <input type="hidden" name="booking_adult_coun" value="<?php echo $search_criteria["hotel_search_adult_count"]; ?>" />

                    <input type="hidden" name="booking_children_count" value="<?php echo $search_criteria["hotel_search_children_count"]; ?>" />

					<?php if(isset($approvalUrl) && $approvalUrl!="" && $request_type=="paypal"){ ?>

                    <a href="<?php echo $approvalUrl; ?>">Click to pay and confirm</a>

                    <?php }else if($request_type=="arrival"){?>

						<a href="<?php echo get_permalink($booking_dashboard_page_id); ?>">Click to check confirmation</a> <?php

						}

					else{?>

                    <input type="submit" name="booking_confirm_booking_gahb_on_arrival" id="booking_confirm_booking_gahb_on_arrival" value="Confirm Booking on Arrival" />

                    <input type="submit" name="booking_confirm_booking_gahb_paypal" id="booking_confirm_booking_gahb_paypal" value="Confirm Booking by Paypal" />

					<?php } ?>

				</form>

				<?php } else { ?>

					<h4>To confirm booking, you have to login</h4>

                    <div class="registration_login_option">

                    	<div class="option_header_col" id="show_login_form" style="cursor:pointer; float:left;">

                        	Already registered member

                        </div>

                        <div class="option_header_col" id="show_registration_form" style="cursor:pointer; float:left; margin-left:50px;">

                        	New member

                        </div>

                    </div>

                    <div style="clear:both;"></div>

                    <div style="color:#F00;" id="error_div">

                    	<?php 

							if(isset($error) && count($error) > 0)

							{

								echo implode(".<br>", $error);

							}

						?>

                    </div>

                    <div class="new_registration_form_div" id="new_registration_form_div" style="display:none;">

						<form name="registration_form" id="registration_form" method="post" action="">

                            <label for="user_email" class="fc label"><?php _e( 'Email', 'hrwp' ); ?>:</label>

                            <br />

                            <input type="email" name="user_email" class="fc input_text" id="user_email" value="<?php if(isset($email)){ echo $email; } ?>" required="required" />

                            <br />

                            <br />

                            <label for="user_first_name" class="fc label"><?php _e( 'First Name', 'hrwp' ); ?>:</label>

                            <br />

                            <input type="text" name="user_first_name" class="fc input_text" id="user_first_name" value="<?php if(isset($first_name)){ echo $first_name; } ?>" required="required" />

                            <br />

                            <br />

                            <label for="user_last_name" class="fc label"><?php _e( 'Last Name', 'hrwp' ); ?>:</label>

                            <br />

                            <input type="text" name="user_last_name" class="fc input_text" id="user_last_name" value="<?php if(isset($last_name)){ echo $last_name; } ?>" required="required" />

                            <br />

                            <br />

                            <label for="user_address" class="fc label"><?php _e( 'Address', 'hrwp' ); ?>:</label>

                            <br />

                            <textarea name="user_address" class="fc input_textarea" id="user_address" value="<?php if(isset($user_address)){ echo $user_address; } ?>" required="required"></textarea>

                            <br />

                            <br />

                            <input type="button" name="registration_submit" id="registration_submit" value="Register Now" />

					</form>

                    </div>

                    <div class="login_form_div" id="login_form_div">

                    	<form name="login_form" id="login_form" method="post" action="">

                            <label for="user_email_login" class="fc label"><?php _e( 'Email', 'hrwp' ); ?>:</label>

                            <br />

                            <input type="email" name="user_email_login" class="fc input_text" id="user_email_login" required="required" />

                            <br />

                            <br />                            

                            <label for="user_password_login" class="fc label"><?php _e( 'Password', 'hrwp' ); ?>:</label>

                            <br />

                            <input type="password" name="user_password_login" class="fc input_text" id="user_password_login" required="required" />

                            <br />

                            <br />

                            <input type="button" name="login_submit" id="login_submit" value="Login" />

                            

					</form>

                    </div>

                    <div id="ajax_loader" style="display:none;">

                       	<img src="<?php echo GAHB__PLUGIN_URL_PATH_NS; ?>/assets/images/ajax-loader.gif" />

                    </div>

				<?php } ?>

			</div>

			<?php } else { ?>

				You have not booking any room yet. <a href="<?php echo get_permalink( get_option('gahb_hotel_search_page_id', '0') ) ; ?>">Please choose a room to book.</a>

			<?php } ?>

		</div>

	<?php

	$output .= ob_get_clean();

	

	return $output;

}

