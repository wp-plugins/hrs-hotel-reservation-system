jQuery(document).ready(function($){
	$("#show_login_form").click(function(e) {
        $("#login_form_div").show();
		$("#new_registration_form_div").hide();
		$("#error_div").text("");
    });
	
	$("#show_registration_form").click(function(e) {
        $("#login_form_div").hide();
		$("#new_registration_form_div").show();
		$("#error_div").text("");
    });
	
	$("#login_submit").click(function(e) {
        jQuery("#ajax_loader").show();
		$.ajax({
			url: frontend_main_js_obj.admin_ajax_url,		
			type: "POST",		
			data:{		
				action:'login_user_frontend',		
				user_email_login: $("#user_email_login").val(),
				user_password_login: $("#user_password_login").val(),
		},		
		}).done(function( r ) {			
			if( r.success )		
			{
				if(r.data.rcode == 1)
				{
					location.href = location.href;
				}
				else
				{
					jQuery("#error_div").html(r.data.message);
				}
				jQuery("#ajax_loader").hide();
			}		
			else 		
			{		
				jQuery("#ajax_loader").hide();
			}		
		}).fail(function( jqXHR, textStatus ) {		
			jQuery("#ajax_loader").hide();
		});	
    });
	
	$("#registration_submit").click(function(e) {
        jQuery("#ajax_loader").show();
		$.ajax({
			url: frontend_main_js_obj.admin_ajax_url,		
			type: "POST",		
			data:{		
				action:'register_user_frontend',		
				user_first_name: $("#user_first_name").val(),
				user_last_name: $("#user_last_name").val(),
				user_email: $("#user_email").val(),
				user_address: $("#user_address").val()
		},		
		}).done(function( r ) {			
			if( r.success )		
			{
				if(r.data.rcode == 1)
				{
					location.href = location.href;
				}
				else
				{
					jQuery("#error_div").html(r.data.message);
				}
				jQuery("#ajax_loader").hide();
			}		
			else 		
			{		
				jQuery("#ajax_loader").hide();
			}		
		}).fail(function( jqXHR, textStatus ) {		
			jQuery("#ajax_loader").hide();
		});	
    });
});