<?php

add_shortcode( 'gahb_hotel_search', 'add_search_shortcode_func' );

function add_search_shortcode_func() {

	

	$loc = new GAHB_Locations();

	$countries_list = $loc->get_countries();

	$state_list = $loc->get_states();

	$cities_list = $loc->get_cities();

	

	if( isset( $_REQUEST['hotel_search_form_submit'] ) ){

		$hotel_search_place = trim( $_REQUEST['hotel_search_place'] );

		$hotel_search_arrival_date = trim( $_REQUEST['hotel_search_arrival_date'] );

		$hotel_search_departure_date = trim( $_REQUEST['hotel_search_departure_date'] );

		$hotel_search_rooms_count = trim( $_REQUEST['hotel_search_rooms_count'] );

		$hotel_search_adult_count = trim( $_REQUEST['hotel_search_adult_count'] );

		$hotel_search_children_count = trim( $_REQUEST['hotel_search_children_count'] );

		$return=array('success'=>false,'errors'=>array());

		$error = false;

		$errors = array();

		$return_search=gahb_process_search_hotel_shortcode();

		if(!$return_search["success"])

		{

			$error = true;

			$errors = $return_search["errors"];

		}

	}

	

	$output = '';

	ob_start();

	?>

    <div class="gahb_core_container gahb_core_hotel_search_box">

      <h3 class="gahb_search_hotels">Search Hotels</h3>

      <div class="hotel_search_form_box">

        <div class="hotel_search_form_errors">

          <ul class="hotel_search_form_errors_ul">

            <?php if( $error ){

                    foreach( $errors as $err ) {

                        ?>

            <li><?php echo $err; ?></li>

            <?php

                    }

                    } ?>

          </ul>

        </div>

        <form name="hotel_search_form" id="hotel_search_form" class="hotel_search_form" action="<?php //echo get_post_type_archive_link( 'gahb_hotel' ); ?>" method="get">

          <div class="dv_both_row">

            <div class="dv_col">

              <label for="hotel_search_place" class="fc label">

                <?php _e( 'Choose Place', 'hrwp' ); ?>

                :</label>

              <select name="hotel_search_place" id="hotel_search_place" placeholder="— Find Place —">

                <option value="">— Find Place —</option>

              </select>

            </div>

            <div class="dv_col">

              <label for="hotel_search_arrival_date" class="fc label">

                <?php _e( 'Arrival Date', 'hrwp' ); ?>

                :</label>

              <input type="text" name="hotel_search_arrival_date" class="fc input_text" id="hotel_search_arrival_date" autocomplete="off" value="<?php if(isset($hotel_search_arrival_date)){ echo $hotel_search_arrival_date;} ?>" />

            </div>

            <div class="dv_col">

              <label for="hotel_search_departure_date" class="fc label">

                <?php _e( 'Departure Date', 'hrwp' ); ?>

                :</label>

              <input type="text" name="hotel_search_departure_date" class="fc input_text" id="hotel_search_departure_date" autocomplete="off" value="<?php if(isset($hotel_search_departure_date)){ echo $hotel_search_departure_date;} ?>" />

            </div>

            <div class="clearboth"></div>

          </div>

          <div class="clearboth"></div>

          <div class="dv_both_row">

            <div class="dv_col atithi-md-3 atithi-sm-3">

              <label for="hotel_search_rooms_count" class="fc label">

                <?php _e( 'Rooms', 'hrwp' ); ?>

                :</label>

              <input type="number" name="hotel_search_rooms_count" min="1" class="fc input_text" id="hotel_search_rooms_count" autocomplete="off" value="<?php if(isset($hotel_search_rooms_count)){ echo $hotel_search_rooms_count;}else{ echo "1";} ?>" />

            </div>

            <div class="dv_col atithi-md-3 atithi-sm-3">

              <label for="hotel_search_adult_count" class="fc label">

                <?php _e( 'Adults', 'hrwp' ); ?>

                :</label>

              <input type="number" name="hotel_search_adult_count" min="1" class="fc input_text" id="hotel_search_adult_count" autocomplete="off" value="<?php if(isset($hotel_search_adult_count)){ echo $hotel_search_adult_count;}else{ echo "1";} ?>" />

            </div>

            <div class="dv_col atithi-md-3 atithi-sm-3">

              <label for="hotel_search_children_count" class="fc label">

                <?php _e( 'Children', 'hrwp' ); ?>

                :</label>

              <input type="number" name="hotel_search_children_count" min="0" class="fc input_text" id="hotel_search_children_count" autocomplete="off" value="<?php if(isset($hotel_search_children_count)){ echo $hotel_search_children_count;}else{ echo "0";} ?>" />

            </div>

            <div class="atithi_submit_button atithi-md-3 atithi-sm-3">

            <P></P>

            <input type="submit" name="hotel_search_form_submit" id="hotel_search_submit" class="hotel_search_submit" value="View Hotels" />

            </div>

            <div class="dv_col" style="display:none;">

              <label for="hotel_search_children_count" class="fc label">

                <?php _e( 'Search Type', 'hrwp' ); ?>

                :</label>

              <input type="radio" name="hotel_search_type" class="fc input_text" id="hotel_search_type" value="Hotel" />

              <span>Hotel</span>

              <input type="radio" name="hotel_search_type" class="fc input_text" id="hotel_search_type" value="Room Type" checked="checked" />

              <span>Room Type</span> </div>

            

            <div class="clearboth"></div>

          </div>

        </form>

      </div>
    </div>

    <?php

	$output .= ob_get_clean();

	return $output;

}



