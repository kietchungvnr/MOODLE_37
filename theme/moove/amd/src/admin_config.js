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
				var current = $('.config-admin[key="'+key+'"]');
				if(action == 'hide') {
					current.children('input').prop('checked',false);
					current.attr('action','show');
				} else {
					current.children('input').prop('checked',true);
					current.attr('action','hide');
				}
				if(current.hasClass('title-tab')) {
					var count = current.parent('h4').next('ul').children('li').length;
					if(action == 'hide') {
						for (var i = 1; i <= count; i++) {
							if(current.parent('h4').next('ul').children('li:nth-child('+i+')').children('div.config-admin').attr('action') == 'hide') {
								current.parent('h4').next('ul').children('li:nth-child('+i+')').children('div.config-admin').trigger('click');
							}
						}
					} else {
						for (var i = 1; i <= count; i++) {
							if(current.parent('h4').next('ul').children('li:nth-child('+i+')').children('div.config-admin').attr('action') == 'show') {
								current.parent('h4').next('ul').children('li:nth-child('+i+')').children('div.config-admin').trigger('click');
							}
						}
					}
				};
			})
		})
    }
    return {
    	init: init
    }
})