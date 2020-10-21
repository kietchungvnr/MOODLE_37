define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'dttable', 'core/str'], function($, kendo, Config, Notification, dttable, Str) {

    return {

        viewreport: function(courseid) {
            var strings = [
                {
                    key: 'fullname',
                    component: 'block_vnr_db_viewreport'
                },
                {
                    key: 'joincoursedate',
                    component: 'block_vnr_db_viewreport'
                },
                {
                    key: 'methodenrol',
                    component: 'block_vnr_db_viewreport'
                },
               
            ];
            $body = $('body');
            Str.get_strings(strings).then(function(s) {
                $body.addClass('loading');
                var gird, createGrid = function() {
                    
                    var columns =  [{
                                field: "fullnamet",
                                title: s[0],
                                width: "200px"
                            },
                            {
                                field: "timecreated",
                                title: s[1],
                                width: "500px"
                            },
                            {
                                field: "enrol",
                                title: s[2],
                                width: "100px"
                            },
                            
                        ];
                    var script = Config.wwwroot + '/local/newsvnr/restfulapi/webservice.php?action=joincourse_grid&courseid=' + courseid;
                    var settings = {
                        // async: false,
                        type: 'GET',
                        processData: true,
                        contentType: "application/json"
                    };
                    grid = $('.showchart_grid').kendoGrid({
                        dataSource: {
                            transport: {
                                read: {
                                    url: script,
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
                                model: {
                                    id: "functionapi",
                                    fields: {
                                        fullnamet: {
                                            type: "string"
                                        }                                    }
                                }
                            },
                            pageSize: 10,
                            serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true
                        },
                        toolbar: ["search"],
                        search: {
                            fields: ["fullnamet"]
                        },
                        sortable: true,
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
                        columns: columns,
                        dataBound: function(e) {
                            $body.removeClass('loading');
                      }
                    }).data('kendoGrid');
                    
                };
                createGrid();
            });
            
        }
    };
});