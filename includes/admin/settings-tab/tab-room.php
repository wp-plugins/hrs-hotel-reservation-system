<?php
	$pages = gahb_get_pages_list();
	
	if( isset( $_REQUEST['tab_room_form_submit'] ) ) {
		if( isset( $_REQUEST['rooms_list_page_id'] ) ){
			$rooms_list_page_id = $_REQUEST['rooms_list_page_id'];
			if( array_key_exists( $rooms_list_page_id, $pages ) ){
				update_option( 'gahb_rooms_list_page_id', $rooms_list_page_id );
			}
		}
	}
	$rooms_list_page_id = get_option( 'gahb_rooms_list_page_id', '0' );
	
?>
<div class="tab_room_container">
	<h1>Room Options</h1>
	<div class="content">
		<form name="tab_general_form" id="tab_general_form" action="" method="POST" class="tab_general_form">
			<label for="rooms_list_page_id" class="fc label">
				Set Rooms Listing Page:
			</label>
			<select class="fc select" name="rooms_list_page_id" id="rooms_list_page_id">
				<?php foreach( $pages as $page_id => $arr ) { ?>
				<option value="<?php echo $page_id; ?>"<?php selected( $page_id, $rooms_list_page_id); ?>><?php echo $arr['title'] . ' [ ' . $arr['slug'] . ' ] [ ' . $page_id . ' ]'; ?></option>
				<?php } ?>
			</select>
			<span><i>Title [ slug ] [ id ]</i></span>
			<br />
			<br />
			
			<input type="submit" name="tab_room_form_submit" id="tab_room_form_submit" class="tab_room_form_submit button" value="Save" />
		</form>
	</div>
</div>