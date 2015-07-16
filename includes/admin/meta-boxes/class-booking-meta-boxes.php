<?php





if ( ! defined( 'ABSPATH' ) ) {





	exit; /* Exit if accessed directly */





}











if( !class_exists( 'Booking_Meta_Boxes' ) ){





	class Booking_Meta_Boxes {





		public function __construct(){





			add_action( 'add_meta_boxes', array( $this, 'add_booking_meta_boxes') );





		}





		





		public function add_booking_meta_boxes(){





			/* add method for all meta boxes */





			add_meta_box( 'booking_details_sectionid', __( 'Booking Details', 'hrwp' ), array( $this, 'booking_details_render_meta_box' ), 'gahb_booking' );





		}


		





		public function booking_details_render_meta_box( $post ){





			$post_id = $post->ID;





			$gahb_booking_hotel_id = get_post_meta( $post_id, 'booking_hotel_id', true );


			$gahb_booking_room_id = get_post_meta( $post_id, 'booking_room_id', true );


			$gahb_booking_arr_date = get_post_meta( $post_id, 'booking_arr_date', true );


			$gahb_booking_dep_date = get_post_meta( $post_id, 'booking_dep_date', true );


			$gahb_booking_rooms_count = get_post_meta( $post_id, 'booking_rooms_count', true );


			$gahb_booking_adult_coun = get_post_meta( $post_id, 'booking_adult_coun', true );


			$gahb_booking_children_count = get_post_meta( $post_id, 'booking_children_count', true );


			$gahb_booking_status = get_post_meta( $post_id, 'booking_status', true );


			if($gahb_booking_status==0)


			{


				$gahb_booking_status="Not Confirm";


			}


			else if($gahb_booking_status==1)


			{


				$gahb_booking_status="Confirm";


			}





			?>





			<div class="gahb_core_container">





				<div class="hotel_room_details" id="hotel_room_details">





					<label for="gahb_booking_hotel_id" class="fc label"><?php _e( 'Hotel Name', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_hotel_id" class="fc input_text" id="gahb_booking_hotel_id" value="<?php echo esc_attr( $gahb_booking_hotel_id ); ?>" autocomplete="off" readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_room_id" class="fc label"><?php _e( 'Room Type Name', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_room_id" class="fc input_text" id="gahb_booking_room_id" value="<?php echo esc_attr( $gahb_booking_room_id ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_arr_date" class="fc label"><?php _e( 'Arrival Date', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_arr_date" class="fc input_text" id="gahb_booking_arr_date" value="<?php echo esc_attr( $gahb_booking_arr_date ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_dep_date" class="fc label"><?php _e( 'Departure Date', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_dep_date" class="fc input_text" id="gahb_booking_dep_date" value="<?php echo esc_attr( $gahb_booking_dep_date ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_adults" class="fc label"><?php _e( 'Adults', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_adults" class="fc input_text" id="gahb_booking_adults" value="<?php echo esc_attr( $gahb_booking_adult_coun ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_children_count" class="fc label"><?php _e( 'Childrens', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_children_count" class="fc input_text" id="gahb_booking_children_count" value="<?php echo esc_attr( $gahb_booking_children_count ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />


                    


                    <label for="gahb_booking_booking_status" class="fc label"><?php _e( 'Status', 'hrwp' ); ?>:</label>





					<br />





					<input type="text" name="gahb_booking_booking_status" class="fc input_text" id="gahb_booking_booking_status" value="<?php echo esc_attr( $gahb_booking_status ); ?>" autocomplete="off"  readonly="readonly"/>





					<br />





					<br />





				</div>





			</div>


			<style>


				#publishing-action { display: none; }


			</style>


			<?php





		}


	}


}


return new Booking_Meta_Boxes();