define(['jquery', 'core/config', 'core/str','kendo.all.min'], function($, Config, Str, kendo) {

	var grid, createGridKendo = function() {
		var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
		var strings = [
			{
				key: 'acceptfile',
                component: 'local_newsvnr'
			},
			{
				key: 'filename',
				component: 'local_newsvnr'
			},
			{
				key: 'filetype',
				component: 'local_newsvnr'
			},
			{
				key: 'filesize',
				component: 'local_newsvnr'
			},
			{
				key: 'filetimecreated',
				component: 'local_newsvnr'
			},
			{
				key: 'fileauthor',
				component: 'local_newsvnr'
			},
			{
				key: 'download',
				component: 'local_newsvnr'
			},
			{
				key: 'filepath',
				component: 'local_newsvnr'
			}
		];
		Str.get_strings(strings).then(function(s) {
			var columns =  	[
								{	
									template: function(e) {
			                            return e.filename;
			                        },
			                        field: "filename",
			                        title: s[1],
			                        width: "500px"
			                    },
			                    {
			                        field: "filepath",
			                        title: s[7],
			                        width: "200px"
								},
								{
			                        field: "filetype",
			                        title: s[2],
			                        width: "100px"
								},
								{
			                        field: "filesize",
			                        title: s[3],
			                        width: "120px"
			                    },
								{
									template: function(e) {
			                            return e.download;
			                        },
									field: "download",
									title: s[6],
									width: "100px"
								},
								{
			                        field: "timecreated",
			                        title: s[4],
			                        width: "120px"
			                    },
			                    
								{
			                        field: "author",
			                        title: s[5],
			                        width: "200px"
			                    },
			                    {
			                        template: function(e) {
			                            return e.listbtn;
			                        },
			                        field: "listbtn",
			                        title: s[0],
			                        width: "100px"
			                    }
		                	];
	        grid = $('#requestfile_grid').kendoGrid({
	            dataSource: {
	                transport: {
	                    read: {
	                        url: script,
	                        data: {
	                        	action : 'getdata'
	                        },
	                        dataType: "json",
	                        contentType: 'application/json; charset=utf-8',
	                        type: "GET",
	                    },
	                    parameterMap: function(options, operation) {
	                        if (operation == "read") {
	                            if (options["filter"]) {
	                                options["q"] = options["filter"]["filters"][0].value;
	                            }
	                            return options;
	                        }
	                    }

	                },
	                schema: {
	                    total: function(data) {
	                        if(data != null && data.length > 0)
	                            return data[0].total; 
	                    },
	                },
	                pageSize: 10,
	                serverPaging: true,
	                serverFiltering: true,
	                serverSorting: true
	            },
	            toolbar: ["search"],
	            search: {
	                fields: ["filename"]
	            },
	            height: 300,
	            sortable: false,
	            reorderable: true,
	            groupable: false,
	            resizable: true,
	            filterable: true,
	            columnMenu: true,
	            pageable: {
	                refresh: true,
	                pageSizes: true,
	                buttonCount: 5
	            },
	            columns: columns
	        });
	        return grid;
		});
	} 



	var init = function () {
		$('[data-key=requestaccecpt]').click(function() {
			createGridKendo();
		});
	}

	var refreshGrid = function () {
		createGridKendo()
		return "OK";
	}

	var acceptFile = function(id) {
		var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
        var settings = {
            type : "GET",
            processData : true,
            data : {
                action : 'acceptfile',
                id : id
            }

        };
        $.ajax(script, settings)
        .then(function(resp) {

        });
	}
	var deleteFile = function(fileName, filePath) {
		var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
        var settings = {
            type : "GET",
            processData : true,
            data : {
                action : 'deletefile',
                filename : fileName,
                filepath : filePath
            }

        };
        $.ajax(script, settings)
        .then(function(resp) {

        });
	}

	return {
		init : init,
		refreshGrid : refreshGrid, 
		acceptFile : acceptFile,
		deleteFile : deleteFile
	}
});