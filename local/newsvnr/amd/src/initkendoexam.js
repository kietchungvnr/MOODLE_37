define(['jquery', 'core/config', 'core/str', 'kendo.all.min'], function($, Config, Str, kendo) {
    var initGrid = function(gridConfig) {
        var strings = [
            {
                key: 'action',
                component: 'local_newsvnr'
            }, {
                key: 'enrol',
                component: 'local_newsvnr'
            }, {
                key: 'manageenroll',
                component: 'local_newsvnr'
            }, {
                key: 'emptydata',
                component: 'local_newsvnr'
            }, 
        ];
        if (gridConfig.columns === undefined) {
            gridConfig.columns = [];
        }
        if(gridConfig.toolbar === undefined) {
            gridConfig.toolbar = ["search"];
        }
        var eventArr = [];

        gridConfig.columns.unshift({
            selectable: true,
            width: 45
        });
        //edit
        // if (gridConfig.selectRowEvent != undefined) {
        //     var funcSelectRow = function(e) {
        //         var myGrid = $(gridName).getKendoGrid();
        //         var selectedRows = myGrid.select();
        //         var arrObject = [];
        //         for (var i = 0; i < selectedRows.length; i++) {
        //             arrObject.push(myGrid.dataItem(selectedRows[i]));
        //         }
        //         gridConfig.selectRowEvent(arrObject);
        //     }
        // }
        if (gridConfig.editEvent != undefined) {
            var funcEdit = function(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                gridConfig.editEvent(dataItem);
            }
            var objEventEdit = {
                click: funcEdit,
                text: " ",
                name: "edit",
                iconClass: 'fa fa-pencil-square-o text-primary',
            }
            eventArr.push(objEventEdit);
        }
       
        if (gridConfig.deleteEvent != undefined) {
            var funcDelete = function(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                gridConfig.deleteEvent(dataItem);
            }
            var objEventDelete = {
                click: funcDelete,
                text: " ",
                name: "delete",
                iconClass: 'fa fa-trash-o text-primary',
            }
            eventArr.push(objEventDelete);
        }

        if(eventArr.length > 0) {
            gridConfig.columns.push({
                title: 'Chức năng',
                command: eventArr,
                width: 180
            });    
        }
        
        if (gridConfig.enrollExamUsers != undefined) {
            var funcEnroll = function(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                gridConfig.enrollExamUsers(dataItem);
            }
            var objEventEdit = {
                click: funcEnroll,
                text: 'Ghi danh',
                name: "enroll",
                iconClass: 'fa fa-user-plus text-primary',
            }
            gridConfig.columns.push({
                title: 'Quản lý ghi danh',
                command: objEventEdit,
                width: 155
            });
            // Str.get_strings(strings).then(function(s) {
                
            // });
        }
        return {
            dataSource: newDatasourceGrid(gridConfig),
            persistSelection: true,
            groupable: false,
            //sortable: true,
            resizable: true,
            //dataBound: gridConfig.dataBound,
            // height: 450,
            toolbar: gridConfig.toolbar,    
            search: {
                fields: ["name"]
            },
            pageable: {
                refresh: true,
                pageSizes: true,
                pageSizes: [10, 20, 50, 100],
                buttonCount: 5
            },
            columns: gridConfig.columns,
            noRecords: {
                template: '<span class="grid-empty">Không có dữ liệu trong lưới!</span>'
            }
        }
    };
    var newDatasourceGrid = function(gridConfig) {
        return new kendo.data.DataSource({
            transport: {
                read: gridConfig.apiSettings,
                parameterMap: function(options, operation) {
                    if (operation == "read") {
                        if (options["filter"]) {
                            options["q"] = options["filter"]["filters"][0].value;
                        }
                        return options;
                    }
                }
            },
            // error: function (evt) {
            //     if (evt.xhr && evt.xhr.status == '401') {
            //         console.log('Errs');
            //     }
            // },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
            schema: {
                model: {
                    id : "id",
                    fields: {
                        id : { type: "number" },
                        name: { type: "string" },
                    }
                },
                total: function(data) {
                    if (data != null && data.length > 0) return data[0].total;
                },
            }
        });
    };
    return {
        initGrid: initGrid
    }
})