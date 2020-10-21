define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'dttable', 'core/str'], function($, kendo, Config, Notification, dttable, Str) {

    return {

        gradereport: function(status, courseid) {
            // $body.addClass("loading");
            var strings = [{
                    key: 'fullname',
                    component: 'block_vnr_db_admin_rp'
                },
                {
                    key: 'status',
                    component: 'block_vnr_db_admin_rp'
                },
                {
                    key: 'score',
                    component: 'block_vnr_db_admin_rp'
                },
            ];
            Str.get_strings(strings).then(function(s) {

                var gird, createGrid = function() {
                   
                    var columns =  [{
                                field: "fullname",
                                title: s[0],
                                width: "300px"
                            },
                            {
                                field: "status",
                                title: s[1],
                                width: "150px"
                            },
                            {
                                field: "finalgrade",
                                title: s[2],
                                width: "150px"
                            },
                            
                        ];
                    var script = Config.wwwroot + '/local/newsvnr/restfulapi/webservice.php?action=gradereport_detail';
                    
                    grid = $('#gradereport_detail').kendoGrid({
                        dataSource: {
                            transport: {
                                read: {
                                    url: script,
                                    dataType: "json",
                                    data: {
                                        status: status,
                                        courseid : courseid
                                    },
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
                                    id: "userid",
                                    fields: {
                                        fullname: {
                                            type: "string"
                                        },
                                    }
                                }
                            },
                            pageSize: 10,
                            serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true
                        },
                        toolbar: ["search"],
                        search: {
                            fields: ["fullname"]
                        },
                        height: 425,
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
                        columns: columns
                    }).data('kendoGrid');
                };
                //grid.destroy();

                $("#gradereport_detail").empty();
                createGrid();
                
            });
            
        }
    };
});