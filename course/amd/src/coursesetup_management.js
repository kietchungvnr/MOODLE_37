define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'dttable', 'core/str'], function($, kendo, Config, Notification, dttable, Str) {

    return {

        coursesetup_management: function() {
            // $body.addClass("loading");
            var strings = [
                {
                    key: 'coursesetup_name',
                    component: 'local_newsvnr'
                },
                {
                    key: 'coursesetup_shortname',
                    component: 'local_newsvnr'
                },
                {
                    key: 'coursesetup_categories',
                    component: 'local_newsvnr'
                },
                {
                    key: 'description',
                    component: 'local_newsvnr'
                },
                {
                    key: 'action',
                    component: 'local_newsvnr'
                }

               
               
               
            ];
            Str.get_strings(strings).then(function(s) {

                var gird, createGrid = function() {
                    
                    var columns =  [
                            {
                                field: "fullname",
                                title: s[0],
                                width: "200px"
                            },
                            {
                                field: "shortname",
                                title: s[1],
                                width: "200px"
                            },
                            {
                                field: "category",
                                title: s[2],
                                width: "200px"
                            },
                            {
                                template: function(e) {
                                    return e.description;
                                },
                                field: "description",
                                title: s[3],
                                width: "300px"
                            },
                            {
                                template: function(e) {
                                    return e.listbtn;
                                },
                                field: "listbtn",
                                title: s[4],
                                width: "200px"
                            }

                        ];
                    var script = Config.wwwroot + '/local/newsvnr/restfulapi/webservice.php?action=coursesetup_management';
                    var settings = {
                        // async: false,
                        type: 'GET',
                        processData: true,
                        contentType: "application/json"
                    };
                    grid = $('#showlistcoursesetup_data').kendoGrid({
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
                                        functionapi: {
                                            type: "string"
                                        },
                                        url: {
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

                createGrid();
               
            });
            
        }
    };
});