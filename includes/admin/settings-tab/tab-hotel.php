<?php
	$pages = gahb_get_pages_list();
	
	if( isset( $_REQUEST['tab_hotel_form_submit'] ) ) {
		if( isset( $_REQUEST['hotels_list_page_id'] ) ){
			$hotels_list_page_id = $_REQUEST['hotels_list_page_id'];
			if( array_key_exists( $hotels_list_page_id, $pages ) ){
				update_option( 'gahb_hotels_list_page_id', $hotels_list_page_id );
			}
		}
	}
	$hotels_list_page_id = get_option( 'gahb_hotels_list_page_id', '0' );
	
?>
<div class="tab_hotel_container">
	<h1>Hotel Options</h1>
	<?php
	$pp = get_post( 'none' );
	var_dump($pp);
	?>
	<div class="content">
		<form name="tab_general_form" id="tab_general_form" action="" method="POST" class="tab_general_form">
			<label for="hotels_list_page_id" class="fc label">
				Set Hotel Listing Page:
			</label>
			<select class="fc select" name="hotels_list_page_id" id="hotels_list_page_id">
				<?php foreach( $pages as $page_id => $arr ) { ?>
				<option value="<?php echo $page_id; ?>"<?php selected( $page_id, $hotels_list_page_id); ?>><?php echo $arr['title'] . ' [ ' . $arr['slug'] . ' ] [ ' . $page_id . ' ]'; ?></option>
				<?php } ?>
			</select>
			<span><i>Title [ slug ] [ id ]</i></span>
			<br />
			<br />
			
			<input type="submit" name="tab_hotel_form_submit" id="tab_hotel_form_submit" class="tab_hotel_form_submit button" value="Save" />
		</form>
	</div>
</div>