define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var init = function() {
		var script = "/local/newsvnr/ajax/admin/config_admin.php";
		$('.config-admin').click(function() {
			var key = $(this).attr('key');
			var action = $(this).attr('action');
			var setting = {
				type : "GET",
				processData : true,
				contenttype : "application/json",
				data : {
					key : key,
					action: action
				}
			}
			$.ajax(script,setting).then(function(res) {
				if(action == 'hide') {
					$('.config-admin[key="'+key+'"]').children('i').replaceWith('<i class="ml-1 fa fa-eye-slash" aria-hidden="true"></i>');
					$('.config-admin[key="'+key+'"]').attr('action','show');
				} else {
					$('.config-admin[key="'+key+'"]').children('i').replaceWith('<i class="ml-1 fa fa-eye" aria-hidden="true"></i>');
					$('.config-admin[key="'+key+'"]').attr('action','hide');
				}
			})
		})
    }
    return {
    	init: init
    }

})