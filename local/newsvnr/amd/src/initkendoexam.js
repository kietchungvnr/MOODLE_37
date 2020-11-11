define(['jquery', 'core/config', 'core/str', 'kendo.all.min'], function($, Config, Str, kendo) {
    var initGrid = function(gridConfig) {
        if (gridConfig.columns === undefined) {
            gridConfig.columns = [];
        }
        var eventArr = [];
        // var checkedIds = {};
        // gridConfig.selectData = function (e) {
        // var myGrid = $('#library-approval-module').getKendoGrid();
        // var selectedRows = myGrid.select();
        // var arrObject = [];
        // for (var i = 0; i < selectedRows.length; i++) {
        //     arrObject.push(myGrid.dataItem(selectedRows[i]));
        // }
        // console.log(arrObject);
        // };
        // gridConfig.selectId = function (e) {
        //     var myGrid = $('div[kendo-grid][k-options=' + gridConfig.gridName + ']').getKendoGrid();
        //     var selectedRows = myGrid.select();
        //     var arrObject = [];
        //     for (var i = 0; i < selectedRows.length; i++) {
        //         arrObject.push(myGrid.dataItem(selectedRows[i]).Id);
        //     }
        //     return arrObject;
        // };
        gridConfig.columns.unshift({
            selectable: true,
            width: 45
        });
        //edit
        // if (gridConfig.selectRowEvent != undefined) {
        //     var funcSelectRow = function(e) {
        //         e.preventDefault();
        //         var myGrid = $('#library-approval-module').getKendoGrid();
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
                iconClass: 'fa fa-pencil-square-o',
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
                iconClass: 'fa fa-trash-o'
            }
            eventArr.push(objEventDelete);
        }
        gridConfig.columns.push({
            title: 'Action',
            command: eventArr,
            width: 150
        });
        if (gridConfig.enrollExamUsers != undefined) {
            var funcEnroll = function(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                gridConfig.enrollExamUsers(dataItem);
            }
            var objEventEdit = {
                click: funcEnroll,
                text: "Ghi danh",
                name: "enroll",
                iconClass: 'fa fa-user-plus',
            }
            gridConfig.columns.push({
                title: 'Quản lý ghi danh',
                command: objEventEdit,
                width: 150
            });
        }
        return {
            dataSource: newDatasourceGrid(gridConfig),
            persistSelection: true,
            groupable: false,
            //sortable: true,
            resizable: true,
            //dataBound: gridConfig.dataBound,
            //height: 520,
            toolbar: ["search"],
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
                template: 'No Records'
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