<?php 
$pages = gahb_get_pages_list();	
if( isset( $_REQUEST['tab_general_form_submit'] ) ){
	
		$currency_symbol=trim( $_REQUEST['currency_symbol'] );
		if( isset( $_REQUEST['currency_symbol'] ) && (!empty( $currency_symbol ) ) ){
			$currency_symbol = sanitize_text_field( $_REQUEST['currency_symbol'] );
			update_option( 'gahb_currency', $currency_symbol );
		}
		
		if( isset( $_REQUEST['currency_symbol_position'] ) && in_array( $_REQUEST['currency_symbol_position'], array( 'pos_before', 'pos_after', 'pos_before_space', 'pos_after_space' ) ) ){
			update_option( 'gahb_currency_position', $_REQUEST['currency_symbol_position'] );
		}
		
		if( isset( $_REQUEST['hotel_search_page_id'] ) ){
			$hotel_search_page_id = $_REQUEST['hotel_search_page_id'];
			if( array_key_exists( $hotel_search_page_id, $pages ) ){
				update_option( 'gahb_hotel_search_page_id', $hotel_search_page_id );
			}
		}
		
		$paypal_client_id=trim( $_REQUEST['paypal_client_id'] );
		if( isset( $_REQUEST['paypal_client_id'] ) && (!empty( $paypal_client_id ) ) ){
			$paypal_client_id = sanitize_text_field( $_REQUEST['paypal_client_id'] );
			update_option( 'gahb_paypal_client_id', $paypal_client_id );
		}
		
		$paypal_client_secret=trim( $_REQUEST['paypal_client_secret'] );
		if( isset( $_REQUEST['paypal_client_secret'] ) && (!empty( $paypal_client_secret ) ) ){
			$paypal_client_secret = sanitize_text_field( $_REQUEST['paypal_client_secret'] );
			update_option( 'gahb_paypal_client_secret', $paypal_client_secret );
		}
	}
	
	$currency_symbol = get_option( 'gahb_currency', '$');
	$currency_symbol_position = get_option( 'gahb_currency_position', 'pos_before' );
	$hotel_search_page_id = get_option( 'gahb_hotel_search_page_id', '0' );
	$paypal_client_id = get_option( 'gahb_paypal_client_id', 'N/A' );	
	$paypal_client_secret = get_option( 'gahb_paypal_client_secret', 'N/A' );
?>
<div class="tab_general_container">
	<h1>General Options</h1>
	<div class="content">
		<form name="tab_general_form" id="tab_general_form" action="" method="POST" class="tab_general_form">
		
			<label for="currency_symbol" class="fc label"><?php _e( 'Currency Symbol', 'hrwp' ); ?>:</label>
			<input type="text" name="currency_symbol" id="currency_symbol" class="fc input_text" value="<?php echo $currency_symbol; ?>" />
			
			<br />
			<br />
			
			<label for="currency_symbol_position" class="fc label"><?php _e( 'Currency Symbol Position', 'hrwp' ); ?>:</label>
			<select id="currency_symbol_position" class="fc input_select" name="currency_symbol_position">
				<option value="pos_before"<?php selected( 'pos_before', $currency_symbol_position); ?>>Left (<?php echo $currency_symbol; ?>99.99)</option>
				<option value="pos_after"<?php selected( 'pos_after', $currency_symbol_position); ?>>Right (99.99<?php echo $currency_symbol; ?>)</option>
				<option value="pos_before_space"<?php selected( 'pos_before_space', $currency_symbol_position); ?>>Left with space (<?php echo $currency_symbol; ?> 99.99)</option>
				<option value="pos_after_space"<?php selected( 'pos_after_space', $currency_symbol_position); ?>>Right with space (99.99 <?php echo $currency_symbol; ?>)</option>
			</select>
			<br />
			<br />
			
			<label for="hotel_search_page_id" class="fc label">
				Set Hotel Listing Page:
			</label>
			<select class="fc select" name="hotel_search_page_id" id="hotel_search_page_id">
				<?php foreach( $pages as $page_id => $arr ) { ?>
				<option value="<?php echo $page_id; ?>"<?php selected( $page_id, $hotel_search_page_id); ?>><?php echo $arr['title'] . ' [ ' . $arr['slug'] . ' ] [ ' . $page_id . ' ]'; ?></option>
				<?php } ?>
			</select>
			<span><i>Title [ slug ] [ id ]</i></span>
			<br />
			<br />
			
            <label for="paypal_client_id" class="fc label"><?php _e( 'Paypal app Client ID', 'hrwp' ); ?>:</label>
			<input type="text" name="paypal_client_id" id="paypal_client_id" class="fc input_text" value="<?php echo $paypal_client_id; ?>" />
			<br />
			<br />
            
            <label for="paypal_client_secret" class="fc label"><?php _e( 'Paypal app Client Secret', 'hrwp' ); ?>:</label>
			<input type="text" name="paypal_client_secret" id="paypal_client_secret" class="fc input_text" value="<?php echo $paypal_client_secret; ?>" />
			<br />
			<br />
            
			<input type="submit" name="tab_general_form_submit" id="tab_general_form_submit" class="tab_general_form_submit button" value="Save" />
			
		</form>
	</div>
</div>