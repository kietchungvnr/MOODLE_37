define(['jquery', 'core/config', 'validatefm', 'local_newsvnr/initkendogrid', 'alertjs', 'core/str', 'kendo.all.min', 'local_newsvnr/initkendocontrolservices'], function($, Config, Validatefm, kendo, alertify, Str, kendoControl, kendoService) {
    "use strict";
    let gridName = '#competency_report';
    let kendoConfig = {};
    let kendoscript = Config.wwwroot + '/local/newsvnr/report/ajax/competency_report.php';
    var kendoDropdown = function() {
        var datascript = "/local/newsvnr/report/ajax/competency_report_data.php?action=";
        //dropdown trạng thái người dùng
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_competency'};
            kendoConfig.value = 'value';
            kendoConfig.optionLabel = "Chọn năng lực";
        var kendoUserStatus = kendoService.initDropDownList(kendoConfig);
        $("#competency").kendoDropDownList(kendoUserStatus);
        //dropdown trạng thái người dùng
        var kendoConfig = {};
            kendoConfig.apiSettings = { url: datascript + 'get_competencyplan'};
            kendoConfig.value = 'value';
            kendoConfig.optionLabel = "Chọn kế hoạch";
        var kendoUserStatus = kendoService.initDropDownList(kendoConfig);
        $("#competencyplan").kendoDropDownList(kendoUserStatus);
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
                field: "competencyname",
                title: "Năng lực",
                width: "100px"
            },
            {
                template:function(e) {
                    return e.activity;
                },
                field: "activity",
                title: "Hoạt động",
                width: "100px"
            },
            {
                template:function(e) {
                    return e.coursename;
                },
                field: "coursename",
                title: "Khóa học",
                width: "130px"
            },
            {
                field: "planname",
                title: "Kế hoạch học tập",
                width: "100px"
            },
            {
                template:function(e) {
                    return e.status;
                },
                field: "status",
                title: "Trạng thái",
                width: "90px"
            },
            {
                field: "duedate",
                title: "Ngày hoàn thành",
                width: "80px"
            },
            {
                field: "reviewer",
                title: "Người đánh giá",
                width: "100px"
            }
        ];
        var toolbar = ["excel"]
        var excel = { 
            fileName: "competency_report.xlsx",
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
    var gridSearchAccount = function(username,competency,competencyplan,course) {
        var data = {
            action:'searchaccount',
            username:username,
            competency:competency,
            competencyplan:competencyplan,
            course:course
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
            var competency = $('#competency').val();
            var competencyplan = $('#competencyplan').val();
            var course = $('#course').val();;
            gridSearchAccount(username,competency,competencyplan,course);
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