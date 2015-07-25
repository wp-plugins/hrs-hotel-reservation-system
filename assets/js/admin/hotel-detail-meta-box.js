jQuery(document).ready(function($){
	$("#hotel_city").select2({
		placeholder: "— Select City —",
		allowClear: true
	});
	
	$("#hotel_state").select2({
		placeholder: "— Select State —",
		allowClear: true
	});
	
	$("#hotel_country").select2({
		placeholder: "— Select Country —",
		allowClear: true
	});
});
