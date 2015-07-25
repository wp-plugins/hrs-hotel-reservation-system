<?php
function gah_put_container_start_tag(){
	$template = get_option( 'template' );

	switch( $template ) {
		case 'twentyeleven' :
			echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
			break;
		case 'twentytwelve' :
			echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
			break;
		case 'twentythirteen' :
			echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
			break;
		case 'twentyfourteen' :
			echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
			break;
		case 'twentyfifteen' :
			echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
			break;
		default :
			echo '<div id="container"><div id="content" role="main">';
			break;
	}
}

function gah_put_container_end_tag(){
	$template = get_option( 'template' );

	switch( $template ) {
		case 'twentyeleven' :
			echo '</div></div>';
			break;
		case 'twentytwelve' :
			echo '</div></div>';
			break;
		case 'twentythirteen' :
			echo '</div></div>';
			break;
		case 'twentyfourteen' :
			echo '</div></div></div>';
			get_sidebar( 'content' );
			break;
		case 'twentyfifteen' :
			echo '</div></div>';
			break;
		default :
			echo '</div></div>';
			break;
	}
}

function gahb_single_room_post_type_template( $single_template ) {
     global $post;

     if ( $post->post_type == 'gahb_room' ) {
          $single_template = GAHB__PLUGIN_DIR_PATH . 'templates/single-room.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'gahb_single_room_post_type_template' );

function gahb_single_hotel_post_type_template( $single_template ) {
     global $post;

     if ( $post->post_type == 'gahb_hotel' ) {
          $single_template = GAHB__PLUGIN_DIR_PATH . 'templates/single-hotel.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'gahb_single_hotel_post_type_template' );