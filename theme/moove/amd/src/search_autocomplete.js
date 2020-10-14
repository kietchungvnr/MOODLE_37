define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'core/str'], function($, kendo, Config, Notification, Str) {
	    var script = Config.wwwroot + '/local/newsvnr/restfulapi/webservice.php?action=';
	    $("#category").kendoAutoComplete({
	        dataTextField: "name",
	        filter: "contains",
	        minLength: 2,
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'search_category',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'GET',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });

	    $("#keyword").kendoAutoComplete({
	        dataTextField: "fullname",
	        filter: "contains",
	        minLength: 3,
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'search_course',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'GET',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });

	    $("#teacher").kendoAutoComplete({
	        dataTextField: "fullnamet",
	        filter: "contains",
	        minLength: 2,
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'search_teacher',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'GET',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });
});