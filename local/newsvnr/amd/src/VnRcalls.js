define(['jquery', 'core/config','core/notification', 'local_newsvnr/VnRloader'], function ($, Config, Notification, kendo) {
	
	function initManage() {
		var settings = {
			type: 'GET',
			processData: true,
			contentType: "application/json"
		};


		var script = Config.wwwroot + '/local/newsvnr/ajax.php';
		$.ajax(script, settings)
		.then(function(response) {
			var feed = JSON.parse(response);
			var data = [];
			data.push(feed);

			if (response.error) {
				Notification.addNotification({
					message: response.error,
					type: "error"
				});
			} else {
                    // Reload the page, don't show changed data warnings.
                    if (typeof window.M.core_formchangechecker !== "undefined") {
                    	window.M.core_formchangechecker.reset_form_dirty_state();
                    }
                    // window.location.reload();
                }
                $("#treeview").kendoTreeView({
                	dataSource: data
                });
                return;
            })
		.fail(Notification.exception);
	}
	
	return {
		init: function () {
			initManage();
		}
	};
});

