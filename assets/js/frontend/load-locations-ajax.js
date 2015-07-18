jQuery(document).ready(function($){
	/*load_locations_ajax_js_obj*/
	$("#hotel_search_place").select2({
		ajax: {
			url: load_locations_ajax_js_obj.admin_ajax_url,
			dataType: 'json',
			delay: 250,
			data: function (params) {
			  return {
				gahb_q: params.term, // search term
				page: params.page,
				action: 'load_places'
			  };
			},
			processResults: function (data, page) {
			  // parse the results into the format expected by Select2.
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data
			  return {
				results: data.items
			  };
			},
			cache: true
		},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 2,
		noResults: 'No place found',
		allowClear: true,
		placeholder: '— Find Place —',
		//templateResult: formatRepo, // omitted for brevity, see the source of this page
		//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
	});
});