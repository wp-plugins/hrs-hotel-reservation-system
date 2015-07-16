<?php
	$pages = gahb_get_pages_list();
	
	if( isset( $_REQUEST['tab_booking_dashboard_form_submit'] ) ) {
		if( isset( $_REQUEST['booking_dashboard_page_id'] ) ){
			$booking_dashboard_page_id = $_REQUEST['booking_dashboard_page_id'];
			if( array_key_exists( $booking_dashboard_page_id, $pages ) ){
				update_option( 'gahb_booking_dashboard_page_id', $booking_dashboard_page_id );
			}
		}
	}
	$booking_dashboard_page_id = get_option( 'gahb_booking_dashboard_page_id', '0' );
	
?>
<div class="tab_booking_dashboard">
	<h1>Booking Dashboard Options</h1>
	<div class="content">
		<form name="tab_booking_dashboard_form" id="tab_booking_dashboard_form" action="" method="POST" class="tab_booking_dashboard_form">
			<label for="booking_dashboard_page_id" class="fc label">
				Set Booking Dashboard Page:
			</label>
			<select class="fc select" name="booking_dashboard_page_id" id="booking_dashboard_page_id">
				<?php foreach( $pages as $page_id => $arr ) { ?>
				<option value="<?php echo $page_id; ?>"<?php selected( $page_id, $booking_dashboard_page_id); ?>><?php echo $arr['title'] . ' [ ' . $arr['slug'] . ' ] [ ' . $page_id . ' ]'; ?></option>
				<?php } ?>
			</select>
			<span><i>Title [ slug ] [ id ]</i></span>
			<br />
			<br />
			
			<input type="submit" name="tab_booking_dashboard_form_submit" id="tab_booking_dashboard_form_submit" class="tab_booking_dashboard_form_submit button" value="Save" />
		</form>
	</div>
</div>