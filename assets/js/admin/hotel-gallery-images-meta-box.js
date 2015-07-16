jQuery(document).ready(function($){
	/* hotel_gallery_images_meta_box_js_props can be used to retrieve dynamic server side values */
	
	
	/* add photos to gallery, st */
	$("#hotel_gallery_images_meta_box #add_gallery_images").click(function(){
		
		// open media gallery
		var gallery_window = wp.media({
			title: 'Select Photo(s) for Hotel Gallery',
			library: {type: 'image'},
			multiple: true,
			button: {text: 'Select'}
		});
		
		gallery_window.on('select', function(){
			var user_selection = gallery_window.state().get('selection').toJSON();
			var hotel_image_gallery_ids = $("#hotel_image_gallery").val();
			
			hotel_image_gallery_ids   =  ( hotel_image_gallery_ids ) ? ( hotel_image_gallery_ids + "," ) : ('');
			
			$.each(user_selection,function(index,ele){
				id = false;
				url = false;
				
				if(ele.sizes.thumbnail){
					id = ele.id;
					url = ele.sizes.thumbnail.url;
				} else if(ele.sizes.medium){
					id = ele.id;
					url = ele.sizes.medium.url;
				} else{
					id = ele.id;
					url = ele.sizes.full.url;
				}
				
				li = '';
				li	+=	'<li data-attachment_id="'+id+'" class="photos_li">';
				li	+=		'<img src="'+url+'" />';
				li	+=		'<ul class="actions_ul">';
				li	+=			'<li class="delete_gallery_photo">';
				li	+=				'<a class="delete_photo_icon" href="javascript:;" title="Delete Image">Delete</a>';
				li	+=			'</li>';
				li	+=		'</ul>';
				li	+=	'</li>';
				
				$("#hotel_gallery_images_meta_box ul.photos_ul").append(li);
				
				
				hotel_image_gallery_ids += id+',';
				
			});
			
			$("#hotel_image_gallery").val(hotel_image_gallery_ids);
			
		});
		
		gallery_window.open();
		
	});
	/* add photos to gallery, end */
	
	
	/* delete gallery image, st */
	$('#hotel_gallery_images_meta_box').on( 'click', 'a.delete_photo_icon', function() {
		$(this).closest('li.photos_li').remove();
		
		var hotel_image_gallery_ids = '';
		
		$.each( $('#hotel_gallery_images_meta_box ul li.photos_li'), function() {
			var hotel_image_gallery_id = $(this).attr( 'data-attachment_id' );
			hotel_image_gallery_ids = hotel_image_gallery_ids + hotel_image_gallery_id + ',';
		});
		
		$("#hotel_image_gallery").val(hotel_image_gallery_ids);
		return false;
	});
	/* delete gallery image, end */
});


jQuery(document).ready(function($){
	$("#hotel_gallery_images_meta_box .photos_ul").sortable({
		items: '.photos_li',
		cursor: 'move',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		forceHelperSize: false,
		helper: 'clone',
		opacity: 0.65,
		start:function(event,ui){
		},
		stop:function(event,ui){
		},
		update: function(event, ui) {
			
			var hotel_image_gallery_ids = '';

			$.each( $('#hotel_gallery_images_meta_box ul li.photos_li'), function() {
				var hotel_image_gallery_id = $(this).attr( 'data-attachment_id' );
				hotel_image_gallery_ids = hotel_image_gallery_ids + hotel_image_gallery_id + ',';
			});
			
			$("#hotel_image_gallery").val(hotel_image_gallery_ids);
		}
	})
});
