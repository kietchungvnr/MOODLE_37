define(["jquery", "core/config", "core/str", "core/notification", "kendo.all.min"], function($, Config, Str, Notification, kendo) {
    "use strict";

    function botSpinerResponseHTML() {
        var html = '<div class="bot-chat" id="response-animation"><div class="user-response-wrapper"><div class="tpl-text-response-wrapper" data-type="bot"><div class="tpl-text-response"><span class="spinme-left"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></span></div></div></div></div>';
        return html;
    }

    function enterMessageHtmlToChatBox(text) {
        $('.main-conversation-chatbot').append(text);
    }

    function botResponseFromGrid(e) {
        var viewDetail = '<a href="javascript:;" onclick="showDetailPopup()" id="viewdetailpopup">Xem chi tiết</a>';
        $(SELECTOR.BOTRESPONSEWAIT).replaceWith(enterMessageHtmlToChatBox(botResponseHTML(viewDetail)));
    }

    function getDataSource(dataScript) {
    	
	        let dataSource = new kendo.data.DataSource({
	            transport: {
	                read: {
	                    url: dataScript,
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
	                }
	            },
	            pageSize: 10,
	            serverPaging: true,
	            serverFiltering: true,
	            serverSorting: true
	        });
	        console.log(1, dataSource);
	        return dataSource;
    }
    return {
    	createGrid: async function(domElement, script, columns, strings, querySearch, cb) {
    		debugger;
    		var dtS = await getDataSource(script);
			var grid = $(domElement).kendoGrid({
				autoBind: false,
				dataSource: dtS,
	            toolbar: ["search"],
	            search: {
	                fields: [querySearch]
	            },
	            sortable: true,
	            reorderable: true,
	            groupable: false,
	            height: 538,
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
			console.log(2)
			// grid.data("kendoGrid");
			// grid.bind('dataBound', botResponseFromGrid);
   //  		grid.dataSource.fetch();
    		console.log(grid)
    		return cb(grid);

    	},
    	destroyGrid: function(domElement) {
    		var grid = $(domElement).data("kendoGrid");
			grid.destroy();
    	}
    };
});