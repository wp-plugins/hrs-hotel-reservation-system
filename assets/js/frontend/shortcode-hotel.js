jQuery(document).ready(function($){

	/* shortcode_hotel_main_js_obj can be used to retrieve dynamic server side values */

	$("#hotel_search_form").submit(function(e){

		

		hotel_search_place = $.trim( $("#hotel_search_place").val() );

		hotel_search_arrival_date = $.trim( $("#hotel_search_arrival_date").val() );

		hotel_search_departure_date = $.trim( $("#hotel_search_departure_date").val() );

		hotel_search_rooms_count = parseInt( $.trim( $("#hotel_search_rooms_count").val() ) );

		hotel_search_adult_count = parseInt( $.trim( $("#hotel_search_adult_count").val() ) );

		hotel_search_children_count = parseInt( $.trim( $("#hotel_search_children_count").val() ) );

		

		error_flag = false;

		err = '';

		if( hotel_search_place == '' ){

			err += '<li class="hotel_search_form_errors_li">Please choose place for hotel.</li>';

			

			error_flag = true;

		}

		

		if( hotel_search_arrival_date == '' ){

			err += '<li class="hotel_search_form_errors_li">Please choose arrival time</li>';

			

			error_flag = true;

		}

		

		if( hotel_search_departure_date == '' ){

			

			err += '<li class="hotel_search_form_errors_li">Please choose departure time.</li>';

			

			error_flag = true;

		}

		

		if( hotel_search_rooms_count < 1 ){

			

			err += '<li class="hotel_search_form_errors_li">Please choose appropriate no. of rooms to stay.</li>';

			

			error_flag = true;

		}

		

		if( hotel_search_adult_count < 1 ){

			

			err += '<li class="hotel_search_form_errors_li">Please choose appropriate no. of adults per room.</li>';

			

			error_flag = true;

		}

		

		if( hotel_search_children_count < 0 ){

			

			err += '<li class="hotel_search_form_errors_li">Please choose appropriate no. of children per room.</li>';

			

			error_flag = true;

		}

		

		if( error_flag){

			$(".hotel_search_form_errors_ul li").remove();

			$(".hotel_search_form_errors_ul").append(err);

			$(".hotel_search_form_errors_ul").hide().slideDown();

			

			return false;

		}

		

		return true;

	});

});