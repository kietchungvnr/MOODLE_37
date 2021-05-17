define(['jquery', 'core/config', 'validatefm', 'local_newsvnr/initkendogrid', 'alertjs', 'core/str', 'kendo.all.min', 'local_newsvnr/initkendocontrolservices'], function($, Config, Validatefm, kendo, alertify, Str, kendoControl, kendoService) {
    "use strict";
    let gridName = '#competency_report';
    let kendoConfig = {};
    let kendoscript = Config.wwwroot + '/local/newsvnr/report/ajax/learning_report.php';
    var kendoDropdown = function() {
        var datascript = "/local/newsvnr/report/ajax/report_data.php?action=";
        //dropdown trạng thái người dùng
        $("#start_timeaccess").kendoDatePicker({
            change: onChange
        });
        function onChange() {
            $('#end_timeaccess').val('');
            var date =  $("#start_timeaccess").val().split('/');
            if(date.length > 1) {
                var datepicker = $("#end_timeaccess").data("kendoDatePicker");
                var year = parseInt(date[2]);
                var month = parseInt(date[0]);
                var day = parseInt(date[1]);
                datepicker.setOptions({
                    min: new Date(year,month-1,day+1)
                });
            }
        }
        $("#end_timeaccess").kendoDatePicker();
        //dropdown trạng thái người dùng
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_course'};
            kendoConfig.value = 'value';
            kendoConfig.optionLabel = "Chọn khóa học";
        var kendoUserStatus = kendoService.initDropDownList(kendoConfig);
        $("#course").kendoDropDownList(kendoUserStatus);
        //dropdown loại phòng ban
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_orgstructure_category'};
            kendoConfig.value = 'categoryid';
            kendoConfig.optionLabel = "Chọn loại phòng ban";
        var kendoOrgCategory = kendoService.initDropDownList(kendoConfig);
        $("#orgstructure_category").kendoDropDownList(kendoOrgCategory);
        //dropdown phòng ban
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_orgstructure'};
            kendoConfig.value = 'orgid';
            kendoConfig.optionLabel = "Chọn phòng ban";
            kendoConfig.cascadeFrom = 'orgstructure_category';
        var kendoOrgstructure = kendoService.initDropDownList(kendoConfig);
        $("#orgstructure").kendoDropDownList(kendoOrgstructure);
        //dropdown chức danh
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_orgstructure_jobtitle'};
            kendoConfig.value = 'jobtitleid';
            kendoConfig.optionLabel = "Chọn chức danh";
        var kendoOrgJobtitle = kendoService.initDropDownList(kendoConfig);
        $("#orgstructure_jobtitle").kendoDropDownList(kendoOrgJobtitle);
        //dropdown chức vụ
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_orgstructure_position'};
            kendoConfig.value = 'positionid';
            kendoConfig.optionLabel = "Chọn chức vụ";
            kendoConfig.cascadeFrom = 'orgstructure_jobtitle';
        var kendoOrgPosition = kendoService.initDropDownList(kendoConfig);
        $("#orgstructure_position").kendoDropDownList(kendoOrgPosition);
        //dropdown chức vụ
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_learning_status'};
            kendoConfig.value = 'value';
            kendoConfig.optionLabel = "Chọn";
        var kendoStatus = kendoService.initDropDownList(kendoConfig);
        $("#status").kendoDropDownList(kendoStatus);
        $("#start_process").kendoNumericTextBox({
            format: "p0",
            factor: 100,
            min: 0,
            max: 1,
            step: 0.01, 
        });
        $("#end_process").kendoNumericTextBox({
            format: "p0",
            factor: 100,
            min: 0,
            max: 1,
            step: 0.01, 
        });
    }
    var initGrid = function(data) {
        var settings = {            
            url: kendoscript,
            type : 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data : data
        };
        var colums = [
            {
                template:function(e) {
                    return e.name;
                },
                field: "name",
                title: "Tên học viên",
                width: "100px"
            },
            {
                template:function(e) {
                    return e.coursename;
                },
                field: "coursename",
                title: "Tên khóa học",
                width: "120px"
            },
            {
                template:"<div class='d-flex participants-collum'><div class='progress course'><div class='progress-bar' role='progressbar' aria-valuenow='#: process #' aria-valuemin='0' aria-valuemax='100' style='width:#: process #'></div></div><div></div></div></div>",
                field: "process",
                title: "Tiến trình học",
                width: "100px"
            },
            {
                template:function(e) {
                    return e.status;
                },
                field: "status",
                title: "Trạng thái",
                width: "100px"
            },
            {
                field: "timestart",
                title: "Ngày tham gia",
                width: "100px"
            },
            {
                field: "timecompleted",
                title: "Ngày hoàn thành",
                width: "70px"
            },
            {
                field: "timeaccess",
                title: "Thời gian học",
                width: "80px"
            },
            {
                field: "grade",
                title: "Điểm số",
                width: "100px"
            }
        ];
        var toolbar = ["excel"]
        var excel = { 
            fileName: "learning_report.xlsx",
            allPages: true
        }
        kendoConfig.toolbar = toolbar;
        kendoConfig.excel = excel;
        kendoConfig.columns = colums;
        kendoConfig.apiSettings = settings;
        var gridData = kendo.initGrid(kendoConfig);
        if($(gridName).data("kendoGrid")) {
            $(gridName).data("kendoGrid").destroy();
        }
        $(gridName).kendoGrid(gridData);
    }
    var gridSearchAccount = function(username,datestart,dateend,courseid,status,startprocess,endprocess) {
        var data = {
            action:'searchaccount',
            username:username,
            datestart:datestart,
            dateend:dateend,
            courseid:courseid,
            status:status,
            startprocess:startprocess,
            endprocess:endprocess
        }
        initGrid(data);
    }
    var gridSearchOrgstructure = function(orgstructureid,positionid) {
        var data = {
            action:'searchorgstructure',
            orgstructureid:orgstructureid,
            positionid:positionid
        }
        initGrid(data);
    }

    var init = function() {
        initGrid();
        $('#searchorgs').click(function() {
            var orgstructureid = $('#orgstructure').val();
            var positionid = $('#orgstructure_position').val();
            gridSearchOrgstructure(orgstructureid,positionid);
        })
        $('#searchaccount').click(function() {
            var username = $('#username').val();
            var datestart = $('#start_timeaccess').val();
            var dateend = $('#end_timeaccess').val();
            var courseid = $('#course').val();;
            var status = $('#status').val();
            var startprocess = $('#start_process').val();
            var endprocess = $('#end_process').val();
            gridSearchAccount(username,datestart,dateend,courseid,status,startprocess,endprocess);
        })
        $('#resettable').click(function() {
            initGrid();
        })
        $('#exporttable').click(function() {
            $('.k-grid-excel').click();
        })
    }
    return {
        init:init,
        kendoDropdown:kendoDropdown
    }
});