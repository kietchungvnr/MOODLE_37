define(['jquery', 'core/config', 'alertjs', 'core/str', 'core/modal_factory', 'core/modal_events', 'core/notification', 'core/fragment', 'core/ajax', 'core/yui', 'kendo.all.min'], 
    function($, Config, alertify, Str, ModalFactory, ModalEvents, Notification, Fragment, Ajax, Y, kendoControl) {
    "use strict";
    var gridMatrix = $('#matrix_grid');
    var script = Config.wwwroot + '/blocks/vnr_db_matrix_competency/ajax/matrix.php';
    var kendoConfig = {};
    // Convert string to func js
    function looseJsonParse(obj) {
        return Function('"use strict";return (' + obj + ')')();
    }
    // Rowspan trong table
    function modifyTableRowspan(column) {

        var prevText = "";
        var counter = 0;
        column.each(function (index) {
            var textValue = $(this).text();
            if (index === 0) {
                prevText = textValue; 
            }
            if (textValue !== prevText || index === column.length - 1) {
                var first = index - counter;
                if (index === column.length - 1) {
                    counter = counter + 1;
                }
                column.eq(first).attr('rowspan', counter);
                if (index === column.length - 1) {
                    for (var j = index; j > first; j--) {
                        column.eq(j).remove();
                    }
                }
                else {

                    for (var i = index - 1; i > first; i--) {
                        column.eq(i).remove();
                    }
                }
                prevText = textValue;
                counter = 0;
            }
            counter++;
        });
    }
    // init kendo ma trận năng lực
    var init = function() {
        var settings = {
            url: script,
            type: 'GET',
            dataType: 'json',
            contentType: "application/json",
            data : {
                action : 'get_matrix'
            }
        }
        $.ajax(script, settings).then(function(resp) {
            resp.data_columns.forEach(function(columns) {
                if(columns.template) {
                    columns.template = looseJsonParse(columns.template);
                }
            });
            var dataSource = new kendoControl.data.DataSource({
                transport: {
                    read: settings
                },
                schema: {
                    model: {
                        id : "id",
                        fields: {
                            id : { type: "competency" },
                            name: { type: "string" },
                        }
                    },
                    data: 'data_grid',
                },
            });
            gridMatrix.kendoGrid({
                autoBind: false,
                dataSource: dataSource,
                columns: resp.data_columns,
                noRecords: {
                    template: '<span class="grid-empty">Chưa cấu hình năng lực ma trận!</span>'
                }
            });
            // Cấu hình css cho grid
            var current_position = "[data-field='" + resp.current_orgposition + "']";
            var gridHead = gridMatrix.getKendoGrid().thead;
            var rows = gridHead.find("[role='columnheader']");
            rows.css({"background-color":"#2d5b7c", "color":"#fff", "font-size":"15px", "font-weight":"bold"});
            var rows_current_position = gridHead.find(current_position);
            rows_current_position.css({"background-color":"#3c8dbc", "color":"#fff"});
            $('[data-toggle="tooltip"]').tooltip();
            dataSource.read().then(resp => {
                var columnCompetencyFramework = $('[data-block="vnr_db_matrix_competency"] [role="grid"] td:first-child');
                modifyTableRowspan(columnCompetencyFramework);
            });
        });
    }
    return {
        init: init
    }
});