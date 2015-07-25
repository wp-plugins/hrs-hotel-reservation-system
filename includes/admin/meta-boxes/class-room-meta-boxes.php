<?php



if ( ! defined( 'ABSPATH' ) ) {



	exit; /* Exit if accessed directly */



}







if( !class_exists( 'Room_Meta_Boxes' ) ){



	class Room_Meta_Boxes {



		public function __construct(){



			add_action( 'add_meta_boxes', array( $this, 'add_hotel_room_meta_boxes') );



			add_action( 'save_post', array( $this, 'save_hotel_room_meta_boxes') );



		}



		



		public function add_hotel_room_meta_boxes(){



			/* add method for all meta boxes */



			



			add_meta_box( 'hotel_room_photos_sectionid', __( 'Room Photo Gallery', 'hrwp' ), array( $this, 'hotel_room_photo_gallery_render_meta_box' ), 'gahb_room', 'side' );



			add_meta_box( 'hotel_room_details_sectionid', __( 'Room Details', 'hrwp' ), array( $this, 'hotel_room_details_render_meta_box' ), 'gahb_room' );



		}



		



		public function save_hotel_room_meta_boxes( $postid ){



			



			/* save method for all meta boxes */



			$this->hotel_room_details_save_meta_box( $postid );



			$this->hotel_room_photo_gallery_save_meta_box( $postid );



		}



		



		public function hotel_room_details_render_meta_box( $post ){



			$post_id = $post->ID;



			$gahb_hotel_room_name = get_post_meta( $post_id, '_gahb_hotel_room_name', true );



			$gahb_hotel_room_description = get_post_meta( $post_id, '_gahb_hotel_room_description', true );



			$gahb_hotel_room_max_adult_occupancy = get_post_meta( $post_id, '_gahb_hotel_room_max_adult_occupancy', true );



			$gahb_hotel_room_max_children_occupancy = get_post_meta( $post_id, '_gahb_hotel_room_max_children_occupancy', true );



			$gahb_hotel_room_facilities = get_post_meta( $post_id, '_gahb_hotel_room_facilities', true );



			$gahb_hotel_room_total_count = get_post_meta( $post_id, '_gahb_hotel_room_total_count', true );



			$gahb_hotel_room_hotel = get_post_meta( $post_id, '_gahb_hotel_room_hotel' );



			$gahb_hotel_room_rules_restriction = get_post_meta( $post_id, '_gahb_hotel_room_rules_restriction', true );



			$gahb_hotel_room_charge_per_night = get_post_meta( $post_id, '_gahb_hotel_room_charge_per_night', true );



			



			if( !empty( $gahb_hotel_room_charge_per_night ) && ( is_float( $gahb_hotel_room_charge_per_night ) || is_numeric( $gahb_hotel_room_charge_per_night ) ) ){



				$gahb_hotel_room_charge_per_night = $gahb_hotel_room_charge_per_night;



			}



			



			$hotel = new GAHB_Hotels();



			$hotels = $hotel->get_hotels();



			$currency_symbol = get_option( 'gahb_currency', '$');



			$currency_symbol_position = get_option( 'gahb_currency_position', 'pos_before' );



			



			$currency_symbol_before = '';



			$currency_symbol_before_space = '';



			$currency_symbol_after = '';



			$currency_symbol_after_space = '';



			if( 'pos_before' == $currency_symbol_position ) {



				$currency_symbol_before = $currency_symbol;



			} else if( 'pos_before_space' == $currency_symbol_position ) {



				$currency_symbol_before_space = $currency_symbol . ' ';



			} else if( 'pos_after' == $currency_symbol_position ) {



				$currency_symbol_after = $currency_symbol;



			} else if( 'pos_after_space' == $currency_symbol_position ) {



				$currency_symbol_after_space = ' ' . $currency_symbol;



			} else {



				$currency_symbol_before = $currency_symbol;



			}



			?>



			<div class="gahb_core_container">



				<div class="hotel_room_details" id="hotel_room_details">



				



					<label for="hotel_room_name" class="fc label"><?php _e( 'Room Type Name', 'hrwp' ); ?>:</label>



					<br />



					<input type="text" name="hotel_room_name" class="fc input_text" id="hotel_room_name" value="<?php echo esc_attr( $gahb_hotel_room_name ); ?>" autocomplete="off" />



					<br />



					<br />



					



					<label for="hotel_room_charge_per_night" class="fc label"><?php _e( 'Charge per night', 'hrwp' ); ?>:</label>



					<br />



					<?php echo $currency_symbol_before; ?><?php echo $currency_symbol_before_space; ?><input type="number" step="any" required="required" name="hotel_room_charge_per_night" class="fc input_text" id="hotel_room_charge_per_night" value="<?php echo $gahb_hotel_room_charge_per_night; ?>" autocomplete="off" /><?php echo $currency_symbol_after; ?><?php echo $currency_symbol_after_space; ?>



					<br />



					<br />



					



					<label for="hotel_room_description" class="fc label"><?php _e( 'Room Type Description', 'hrwp' ); ?>:</label>



					<br />



					<textarea type="text" name="hotel_room_description" class="fc input_textarea" id="hotel_room_description"><?php echo esc_attr( $gahb_hotel_room_description ); ?></textarea>



					<br />



					<br />



					



					<label for="hotel_room_max_adult_occupancy" class="fc label"><?php _e( 'Max. Adult Occupancy', 'hrwp' ); ?>:</label>



					<br />



					<input type="number" required="required" min="0" name="hotel_room_max_adult_occupancy" class="fc input_text" id="hotel_room_max_adult_occupancy" value="<?php echo esc_attr( $gahb_hotel_room_max_adult_occupancy ); ?>" autocomplete="off" />



					<br />



					<br />



					



					<label for="hotel_room_max_children_occupancy" class="fc label"><?php _e( 'Max. Children Occupancy', 'hrwp' ); ?>:</label>



					<br />



					<input type="number" required="required" min="0" name="hotel_room_max_children_occupancy" class="fc input_text" id="hotel_room_max_children_occupancy" value="<?php echo esc_attr( $gahb_hotel_room_max_children_occupancy ); ?>" autocomplete="off" />



					<br />



					<br />



					



					<label for="hotel_room_total_count" class="fc label"><?php _e( 'Total number of rooms of this type', 'hrwp' ); ?>:</label>



					<br />



					<input type="number" required="required" min="0" name="hotel_room_total_count" class="fc input_text" id="hotel_room_total_count" value="<?php echo esc_attr( $gahb_hotel_room_total_count ); ?>" autocomplete="off" />



					<br />



					<br />



					



					<label for="hotel_room_hotel" class="fc label"><?php _e( 'Associated Hotel', 'hrwp' ); ?>:</label>



					<br />







					<select name="hotel_room_hotel[]" class="fc input_select multiple" id="hotel_room_hotel" required="required" placeholder="— Select Hotel —" autocomplete="off" multiple="multiple">



						<?php foreach( $hotels as $key => $val) { ?>



						<option value="<?php echo $key; ?>"<?php if( in_array($key, $gahb_hotel_room_hotel) ){ echo ' selected="selected"';} ?>><?php echo $val['hotel_name']; ?></option>



						<?php } ?>



					</select>



					<a href="<?php echo admin_url('post-new.php?post_type=gahb_hotel'); ?>" class="button" title="Go to city list manager">Add New Hotel</a>



					<br />



					<br />



					



					<label for="hotel_room_facilities" class="fc label"><?php _e( 'Room Facilities', 'hrwp' ); ?>:</label>



					<br />



					<?php



						/* wp editor settings parameters */



						$settings = array(



										wpautop				=>	true,



										media_buttons		=>	true,



										textarea_name		=>	'hotel_room_facilities',



										textarea_rows		=>	5,	/*get_option('default_post_edit_rows', 10),*/



										tabindex			=>	'',



										editor_css			=>	'<style type="text/css"></style>',



										editor_class		=>	'fc input_textarea',



										editor_height		=>	'600px',



										teeny				=>	false,



										dfw					=>	false,



										tinymce				=>	true,



										quicktags			=>	true,



										drag_drop_upload	=>	true,



									);



					?>



					<?php wp_editor( $gahb_hotel_room_facilities, "hotel_room_facilities", $settings ); ?>



					<?php /*<textarea type="text" name="hotel_room_facilities" class="fc input_textarea" id="hotel_room_facilities"><?php echo esc_attr( $gahb_hotel_room_facilities ); ?></textarea> */ ?>



					<br />



					<br />



					



					<label for="hotel_room_rules_restriction" class="fc label"><?php _e( 'Rules & Restriction', 'hrwp' ); ?>:</label>



					<br />



					<?php



						/* wp editor settings parameters */



						$settings = array(



										wpautop				=>	true,



										media_buttons		=>	true,



										textarea_name		=>	'hotel_room_rules_restriction',



										textarea_rows		=>	5,	/*get_option('default_post_edit_rows', 10),*/



										tabindex			=>	'',



										editor_css			=>	'<style type="text/css"></style>',



										editor_class		=>	'fc input_textarea',



										editor_height		=>	'600px',



										teeny				=>	false,



										dfw					=>	false,



										tinymce				=>	true,



										quicktags			=>	true,



										drag_drop_upload	=>	true,



									);



					?>



					<?php wp_editor( $gahb_hotel_room_rules_restriction, "hotel_room_rules_restriction", $settings ); ?>
<input type="hidden" name="prevent_delete_meta_movetotrash" id="prevent_delete_meta_movetotrash" value="<?php echo wp_create_nonce('hbs_post_meta_'.$post_id); ?>" />


					<?php /*<textarea type="text" name="hotel_room_rules_restriction" class="fc input_textarea" id="hotel_room_rules_restriction"><?php echo esc_attr( $gahb_hotel_room_facilities ); ?></textarea> */ ?>



					<br />



					<br />



					



				</div>



			</div>



			<?php



		}



		



		



		public function hotel_room_details_save_meta_box( $post_id ){
global $post;

if (!wp_verify_nonce($_POST['prevent_delete_meta_movetotrash'], 'hbs_post_meta_'.$post_id)) { return $post_id; }
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {



				return;



			}						if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {				return $post_id;			  }			  			  if(!current_user_can('edit_post')) {    return $post->ID;  }     if($post->post_type == 'revision') {    return;  }



			



			$hotel_room_name = isset( $_POST['hotel_room_name'] ) ? sanitize_text_field( $_POST['hotel_room_name'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_name', $hotel_room_name );



			



			$hotel_room_description = isset( $_POST['hotel_room_description'] ) ? sanitize_text_field( $_POST['hotel_room_description'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_description', $hotel_room_description );



			



			$hotel_room_max_adult_occupancy = isset( $_POST['hotel_room_max_adult_occupancy'] ) ? sanitize_text_field( $_POST['hotel_room_max_adult_occupancy'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_max_adult_occupancy', $hotel_room_max_adult_occupancy );



			



			$hotel_room_max_children_occupancy = isset( $_POST['hotel_room_max_children_occupancy'] ) ? sanitize_text_field( $_POST['hotel_room_max_children_occupancy'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_max_children_occupancy', $hotel_room_max_children_occupancy );



			



			$gahb_hotel_room_total_count = isset( $_POST['hotel_room_total_count'] ) ? sanitize_text_field( $_POST['hotel_room_total_count'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_total_count', $gahb_hotel_room_total_count );



			



			$hotel_room_facilities = trim( $_POST['hotel_room_facilities'] );



			update_post_meta( $post_id, '_gahb_hotel_room_facilities', $hotel_room_facilities );



			



			$hotel_room_rules_restriction = trim( $_POST['hotel_room_rules_restriction'] );



			update_post_meta( $post_id, '_gahb_hotel_room_rules_restriction', $hotel_room_rules_restriction );



			



			if( isset( $_POST['hotel_room_hotel'] ) ){



				delete_post_meta($post_id, '_gahb_hotel_room_hotel');



				$t_hotel_room_hotel = array();



				$hotel_room_hotel = $_POST['hotel_room_hotel'];



				$hotel_obj = new GAHB_Hotels();



				$hotels = $hotel_obj->get_hotels();



				



				foreach( $hotel_room_hotel as $hrh ){



					$hrh = intval( trim($hrh) );



					if( array_key_exists( $hrh, $hotels ) ){



						$t_hotel_room_hotel[] = $hrh;



					}



				}



				$hotel_room_hotel = $t_hotel_room_hotel;



				foreach( $hotel_room_hotel as $hrh ){



					add_post_meta( $post_id, '_gahb_hotel_room_hotel', $hrh );



				}



			}



			



			$hotel_room_charge_per_night = isset( $_POST['hotel_room_charge_per_night'] ) ? sanitize_text_field( $_POST['hotel_room_charge_per_night'] ) : '';



			update_post_meta( $post_id, '_gahb_hotel_room_charge_per_night', $hotel_room_charge_per_night );



			



		}



		



		public function hotel_room_photo_gallery_render_meta_box( $post ){



			$hotel_room_image_gallery = false;



			$hotel_room_image_gallery_ids = false;



			if ( metadata_exists( 'post', $post->ID, '_hotel_room_image_gallery' ) ) {



				$hotel_room_image_gallery = get_post_meta( $post->ID, '_hotel_room_image_gallery', true );



			}



			



			$hotel_room_image_gallery = array_filter( explode( ",", $hotel_room_image_gallery ) );



			



			if( $hotel_room_image_gallery && is_array( $hotel_room_image_gallery ) && !empty( $hotel_room_image_gallery ) ){



				$hotel_room_image_gallery_ids = true;



			}



			?>


<input type="hidden" name="prevent_delete_meta_movetotrash" id="prevent_delete_meta_movetotrash" value="<?php echo wp_create_nonce('hbs_post_meta_'.$post_id); ?>" />
			<div class="gahb_core_container">



				<div class="gallery_meta_box" id="hotel_room_gallery_images_meta_box">



					<div class="gallery_box">



						<ul class="photos_ul">



							<?php if( $hotel_room_image_gallery_ids ){ ?>



							<?php foreach( $hotel_room_image_gallery as $hig ) { ?>



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



						



						<a href="javascript:;" class="btn_link" id="add_gallery_images"><?php _e('Add Photos to gallery', 'hrwp'); ?></a>



					</div>



				</div>



			</div>



			<?php



		}



		



		public function hotel_room_photo_gallery_save_meta_box( $post_id ){



			



			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {



				return;



			}



			



			$hotel_room_image_gallery = isset( $_POST['_hotel_room_image_gallery'] ) ? array_filter( explode( ',', sanitize_text_field( $_POST['_hotel_room_image_gallery'] ) ) ) : array();


if (!wp_verify_nonce($_POST['prevent_delete_meta_movetotrash'], 'hbs_post_meta_'.$post_id)) { return $post_id; }
			update_post_meta( $post_id, '_hotel_room_image_gallery', implode( ',', $hotel_room_image_gallery ) );



		}



		



	}



}







return new Room_Meta_Boxes();