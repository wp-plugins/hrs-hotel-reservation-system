jQuery(document).ready(function($){

	/* hotel_search_datepickers_js_obj can be used to retrieve dynamic server side values */

	
	if($("#hotel_search_arrival_date").val() == "")
	{
		$("#hotel_search_arrival_date").val( hotel_search_datepickers_js_obj.curr_date );
	}
	if($("#hotel_search_departure_date").val() == "")
	{
		$("#hotel_search_departure_date").val( hotel_search_datepickers_js_obj.next_date );
	}
	
	$("#hotel_search_arrival_date").datepicker({dateFormat: 'MM d, yy'});

	$("#hotel_search_departure_date").datepicker({dateFormat: 'MM d, yy'});

	

});