<?php


if ( ! defined( 'ABSPATH' ) ) {


	exit; /* Exit if accessed directly */


}





if( !class_exists( 'Hotel_Meta_Boxes' ) ){


	class Hotel_Meta_Boxes {


		public function __construct(){


			add_action( 'add_meta_boxes', array( $this, 'add_hotel_meta_boxes') );


			add_action( 'save_post', array( $this, 'save_hotel_meta_boxes') );


		}


		


		public function add_hotel_meta_boxes(){


			/* add method for all meta boxes */


			


			add_meta_box( 'hotel_photos_sectionid', __( 'Hotel Photo Gallery', 'hrwp' ), array( $this, 'hotel_photo_gallery_render_meta_box' ), 'gahb_hotel', 'side' );


			add_meta_box( 'hotel_details_sectionid', __( 'Hotel Details', 'hrwp' ), array( $this, 'hotel_details_render_meta_box' ), 'gahb_hotel' );


		}


		


		public function save_hotel_meta_boxes( $postid ){


			


			/* save method for all meta boxes */


			$this->hotel_details_save_meta_box( $postid );


			$this->hotel_photo_gallery_save_meta_box( $postid );


		}


		


		public function hotel_details_render_meta_box( $post ){


			$post_id = $post->ID;


			$gahb_hotel_name = get_post_meta( $post_id, '_gahb_hotel_name', true );


			$gahb_hotel_description = get_post_meta( $post_id, '_gahb_hotel_description', true );


			$gahb_hotel_address_line_1 = get_post_meta( $post_id, '_gahb_hotel_address_line_1', true );


			$gahb_hotel_address_line_2 = get_post_meta( $post_id, '_gahb_hotel_address_line_2', true );


			$city = get_post_meta( $post_id, '_gahb_hotel_city', true );


			$state = get_post_meta( $post_id, '_gahb_hotel_state', true );


			$country = get_post_meta( $post_id, '_gahb_hotel_country', true );


			$gahb_hotel_postal_code = get_post_meta( $post_id, '_gahb_hotel_postal_code', true );


			


			$loc = new GAHB_Locations();


			$cities = $loc->get_cities();


			$states = $loc->get_states();


			$countries = $loc->get_countries();


			


			?>


			<div class="gahb_core_container">


				<div class="hotel_details" id="hotel_details">


				


					<label for="hotel_name" class="fc label"><?php _e( 'Name', 'hrwp' ); ?>:</label>


					<br />


					<input type="text" name="hotel_name" class="fc input_text" id="hotel_name" value="<?php echo esc_attr( $gahb_hotel_name ); ?>" autocomplete="off" />


					<br />


					<br />


					


					<label for="hotel_description" class="fc label"><?php _e( 'Few line of description', 'hrwp' ); ?>:</label>


					<br />


					<textarea name="hotel_description" class="fc input_textarea" id="hotel_description" /><?php echo esc_attr( $gahb_hotel_description ); ?></textarea>


					<br />


					<br />


					


					<label for="hotel_address_line_1" class="fc label"><?php _e( 'Address Line 1', 'hrwp' ); ?>:</label>


					<br />


					<input type="text" name="hotel_address_line_1" class="fc input_text" id="hotel_address_line_1" value="<?php echo esc_attr( $gahb_hotel_address_line_1 ); ?>" autocomplete="off" />


					<br />


					<br />


					


					<label for="hotel_address_line_2" class="fc label"><?php _e( 'Address Line 2', 'hrwp' ); ?>:</label>


					<br />


					<input type="text" name="hotel_address_line_2" class="fc input_text" id="hotel_address_line_2" value="<?php echo esc_attr( $gahb_hotel_address_line_2 ); ?>" autocomplete="off" />


					<br />


					<br />


					


					<label for="hotel_city" class="fc label"><?php _e( 'City', 'hrwp' ); ?>:</label>


					<br />


					


					<select name="hotel_city" class="fc input_select" id="hotel_city" required="required" placeholder="— Select City —" autocomplete="off">


						<option value=""<?php selected("", $city); ?>>— Select City —</option>


						<?php foreach( $cities as $key => $val) { ?>


						<option value="<?php echo $key; ?>"<?php selected($key, $city); ?>><?php echo $val; ?></option>


						<?php } ?>


					</select>


					<a href="<?php echo admin_url('post-new.php?post_type=gahb_city'); ?>" class="button" title="Go to city list manager">Add New City</a>


					<br />


					<br />


					


					<label for="hotel_state" class="fc label"><?php _e( 'State', 'hrwp' ); ?>:</label>


					<br />


					<select name="hotel_state" class="fc input_select" id="hotel_state" placeholder="— Select State —" autocomplete="off">


						<option value=""<?php selected("", $state); ?>>— Select State —</option>


						<?php foreach( $states as $key => $val) { ?>


						<option value="<?php echo $key; ?>"<?php selected($key, $state); ?>><?php echo $val; ?></option>


						<?php } ?>


					</select>


					<a href="<?php echo admin_url('post-new.php?post_type=gahb_state'); ?>" class="button" title="Go to state list manager">Add New State</a>


					<br />


					<br />


					


					<label for="hotel_country" class="fc label"><?php _e( 'Country', 'hrwp' ); ?>:</label>


					<br />


					<select name="hotel_country" class="fc input_select" id="hotel_country" required="required" placeholder="— Select Country —" autocomplete="off">


						<option value=""<?php selected("", $country); ?>>— Select Country —</option>


						<?php foreach( $countries as $key => $val) { ?>


						<option value="<?php echo $key; ?>"<?php selected($key, $country); ?>><?php echo $val; ?></option>


						<?php } ?>


					</select>


					<a href="<?php echo admin_url('post-new.php?post_type=gahb_country'); ?>" class="button" title="Go to city list manager">Add New Country</a>


					<br />


					<br />


					


					<label for="hotel_postal_code" class="fc label"><?php _e( 'ZIP/Postal Code', 'hrwp' ); ?>:</label>


					<br />
<input type="hidden" name="prevent_delete_meta_movetotrash" id="prevent_delete_meta_movetotrash" value="<?php echo wp_create_nonce('hbs_post_meta_'.$post_id); ?>" />

					<input type="text" name="hotel_postal_code" class="fc input_text" id="hotel_postal_code" value="<?php echo esc_attr( $gahb_hotel_postal_code ); ?>" autocomplete="off" />


					<br />


					<br />


				</div>


			</div>


			<?php


		}


		


		public function hotel_details_save_meta_box( $post_id ){
if (!wp_verify_nonce($_POST['prevent_delete_meta_movetotrash'], 'hbs_post_meta_'.$post_id)) { return $post_id; }

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {


				return;


			}


			


			$hotel_name = isset( $_POST['hotel_name'] ) ? sanitize_text_field( $_POST['hotel_name'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_name', $hotel_name );


			


			$hotel_description = isset( $_POST['hotel_description'] ) ? sanitize_text_field( $_POST['hotel_description'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_description', $hotel_description );


			


			$hotel_address_line_1 = isset( $_POST['hotel_address_line_1'] ) ? sanitize_text_field( $_POST['hotel_address_line_1'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_address_line_1', $hotel_address_line_1 );


			


			$hotel_address_line_2 = isset( $_POST['hotel_address_line_2'] ) ? sanitize_text_field( $_POST['hotel_address_line_2'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_address_line_2', $hotel_address_line_2 );


			


			$hotel_city = isset( $_POST['hotel_city'] ) ? sanitize_text_field( $_POST['hotel_city'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_city', $hotel_city );


			


			$hotel_state = isset( $_POST['hotel_state'] ) ? sanitize_text_field( $_POST['hotel_state'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_state', $hotel_state );


			


			$hotel_country = isset( $_POST['hotel_country'] ) ? sanitize_text_field( $_POST['hotel_country'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_country', $hotel_country );


			


			$hotel_postal_code = isset( $_POST['hotel_postal_code'] ) ? sanitize_text_field( $_POST['hotel_postal_code'] ) : '';


			update_post_meta( $post_id, '_gahb_hotel_postal_code', $hotel_postal_code );


			


		}


		


		public function hotel_photo_gallery_render_meta_box( $post ){


			$hotel_image_gallery = false;


			$hotel_image_gallery_ids = false;


			if ( metadata_exists( 'post', $post->ID, '_hotel_image_gallery' ) ) {


				$hotel_image_gallery = get_post_meta( $post->ID, '_hotel_image_gallery', true );


			}


			


			$hotel_image_gallery = array_filter( explode( ",", $hotel_image_gallery ) );


			


			if( $hotel_image_gallery && is_array( $hotel_image_gallery ) && !empty( $hotel_image_gallery ) ){


				$hotel_image_gallery_ids = true;


			}


			?>


			<div class="gahb_core_container">


				<div class="gallery_meta_box" id="hotel_gallery_images_meta_box">


					<div class="gallery_box">


						<ul class="photos_ul">


							<?php if( $hotel_image_gallery_ids ){ ?>


							<?php foreach( $hotel_image_gallery as $hig ) { ?>


							<li data-attachment_id="<?php echo $hig; ?>" class="photos_li">


								<?php echo wp_get_attachment_image( $hig, 'thumbnail' ); ?>


								<ul class="actions_ul">


									<li class="delete_gallery_photo">


										<a class="delete_photo_icon" href="javascript:;" title="Delete Image">Delete</a>


									</li>


								</ul>


							</li>


							


							<?php } ?>


							<?php } ?>


							


						</ul>


					</div>


					


					<div class="gallery_controls">
<input type="hidden" id="hotel_room_image_gallery" name="_hotel_room_image_gallery" value="<?php echo esc_attr( implode(",", $hotel_room_image_gallery) ); ?>" />

						<input type="hidden" id="hotel_image_gallery" name="_hotel_image_gallery" value="<?php echo esc_attr( implode(",", $hotel_image_gallery) ); ?>" />


						


						<a href="javascript:;" class="btn_link" id="add_gallery_images"><?php _e('Add Photos to gallery', 'hrwp'); ?></a>


					</div>


				</div>


			</div>


			<?php


		}


		


		public function hotel_photo_gallery_save_meta_box( $post_id ){


			


			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {


				return;


			}


			


			$hotel_image_gallery = isset( $_POST['_hotel_image_gallery'] ) ? array_filter( explode( ',', sanitize_text_field( $_POST['_hotel_image_gallery'] ) ) ) : array();

if (!wp_verify_nonce($_POST['prevent_delete_meta_movetotrash'], 'hbs_post_meta_'.$post_id)) { return $post_id; }
			update_post_meta( $post_id, '_hotel_image_gallery', implode( ',', $hotel_image_gallery ) );


		}


		


	}


}





return new Hotel_Meta_Boxes();