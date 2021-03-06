define(["jquery", "core/config", "core/str", "core/notification", "alertjs", 'local_newsvnr/initkendogrid','local_newsvnr/initkendocontrolservices'], function($, Config, Str, Notification, alertify, kendo, kendoService) {
    "use strict";
    var initLibrary = function() {
        var strings = [{
            key: 'alert',
            component: 'local_newsvnr'
        }, {
            key: 'confirmdeletefolder',
            component: 'local_newsvnr'
        }, {
            key: 'confirmfoldername',
            component: 'local_newsvnr'
        }];
        /// Thêm thư mục mới
        var scriptfolder = "/local/newsvnr/ajax/library_online/library_folder_ajax.php";
        var scriptmodule = "/local/newsvnr/ajax/library_online/library_module_ajax.php";
        var scriptshare = "/local/newsvnr/ajax/library_online/library_share_module.php?action=";
        Str.get_strings(strings).then(function(s) {
            $('#add-new-folder').click(function() {
                var foldername = $('.add-folder-popup #foldername').val();
                var parentid = $('.add-folder-popup .folderparent').attr('parentid');
                var folderdes = $('.add-folder-popup #folderdes').val();
                var folderid = $(this).attr('forderid');
                var action = $(this).attr('action');
                var multiselect = $("#positionpermission").data("kendoMultiSelect")
                if(multiselect != undefined) {
                    var listposition = multiselect.value();
                    var data = JSON.stringify(listposition);
                } else {
                    var data = '';
                }
                var settings = {
                    type: "GET",
                    processData: true,
                    data: {
                        foldername: foldername,
                        folderid: folderid,
                        parentid: parentid,
                        folderdes: folderdes,
                        action: action,
                        listposition:data
                    },
                    contenttype: "application/json",
                }
                if (foldername == '') {
                    // var text = "* Bắt buộc nhập tên thư mục";
                    $('.form_input_validate:not(:focus):invalid').css('background-image','url("theme/moove/pix/notvalid.png")');
                    return;
                }
                $(this).addClass('not-allow');
                $.ajax(scriptfolder, settings).then(function(response) {
                    var obj = $.parseJSON(response);
                    alertify.notify(obj.alert, 'success', 3);
                    location.reload();
                });
            });
            // mở popup setting thư mục
            $('.tree-folder .folder').bind("contextmenu", function(e) {
                $('.popup-setting').hide();
                if ($(this).hasClass('show')) {
                    var visible = 1;
                } else {
                    var visible = 0;
                }
                var allmodule = $(this).attr('allmodule');
                var action = 'popupsetting';
                var folderid = $(this).attr('id');
                var foldername = $(this).text();
                var settings = {
                    type: "POST",
                    processData: true,
                    data: {
                        visible: visible,
                        action: action,
                        allmodule: allmodule,
                        folderid: folderid,
                        foldername: foldername
                    },
                    contenttype: "application/json",
                }
                $('.tree-folder .folder').removeClass('active');
                $(this).toggleClass('active');
                var x = e.clientX;
                e.preventDefault();
                var id = $(this).attr('id');
                var name = $(this).text();
                var setting = $('.popup-setting');
                var y = $(this).position();
                setting.css('top', y.top + 5);
                if($('#page-wrapper').hasClass('slide-nav-toggle')) {
                    setting.css('left', x - 256);
                } else {
                    setting.css('left', x - 75);
                }
                $.ajax(scriptfolder, settings).then(function(response) {
                    var obj = $.parseJSON(response);
                    $.when($('.popup-setting ul').replaceWith(obj.setting)).then(setting.show());
                });
            });
            $('body').click(function() {
                $('.popup-setting').hide();
            })
            // Làm mới dữ liệu input khi tắt popup
            $("#add-popup-modal-folder").on('show.bs.modal', function() {
                $('#add-popup-modal-folder input#foldername').val('');
                $('.tree-view-folder').slideUp();
                $('#add-popup-modal-folder textarea#folderdes').val('');
            });
            //Láy parameter folder id khi click vào cây thư mục
            $('#folder_library a.folder-child').click(function() {
                $('.alert-warning').text('');
                $('.alert-warning').removeClass('alert');
                $('.loading-page').addClass('active');
                $('.sort-module i').remove();
                $('#folder_library li.folder').removeClass('active');
                $('#folder_library li.folder').addClass('not-allow');
                $(this).parent('li').addClass('active');
                var folderid = $(this).attr('id');
                $('.add-module-popup input[name="selectmodule"]').attr('folderid', folderid);
                $('.searchlibrary').attr('folderid', folderid);
                if($(this).parent('li').hasClass('title')) {
                    $('div[data-target="#add-popup-modal-module"]').hide();
                } else {
                    $('div[data-target="#add-popup-modal-module"]').show();
                }
                var settings = {
                    type: "GET",
                    processData: true,
                    data: {
                        folderid: folderid
                    },
                    contenttype: "application/json",
                }
                $.ajax(scriptmodule, settings).then(function(response) {
                    var obj = $.parseJSON(response);
                    $('#table-library').hide().html(obj.result).fadeIn('fast');
                    $('#header-library').replaceWith(obj.header);
                    $('#pagination').replaceWith(obj.pagination);
                    $('.loading-page').removeClass('active');
                    if (obj.result == '') {
                        $('.alert-warning').replaceWith(obj.alert);
                    }
                    $('#folder_library li.folder').removeClass('not-allow');
                });
            })
            // Tạo module mới trên thư viện ( truyền vào value và folderid)
            $('#add-new-module').click(function() {
                var value = $('.add-module-popup input[name="selectmodule"]:checked').val();
                var folderid = $('.add-module-popup input[name="selectmodule"]:checked').attr('folderid');
                window.location.href = 'course/modedit.php?add=' + value + '&type=&course=1&section=1&return=0&sr=&folderid=' + folderid;
            })
            // load trang index thư viện
            var libraryurl = Config.wwwroot + "/library.php";
            if (window.location.href == libraryurl) {
                $.getJSON(scriptmodule, function(data) {
                    $('#table-library').hide().html(data.result).fadeIn('fast');
                    $('#header-library').replaceWith(data.header);
                    $('#pagination').replaceWith(data.pagination);
                })
            }
            // Search tài liệu thư viện
            $("button.library").click(function() {
                $('.loading-page').addClass('active');
                $('.sort-module i').remove();
                var folderid = $(this).prev('.searchlibrary').attr('folderid');
                var value = $(this).prev('.searchlibrary').val().trim();
                var searchtype = $(this).prev('.searchlibrary').attr('searchtype');
                var settings = {
                    type: "GET",
                    processData: true,
                    data: {
                        folderid: folderid,
                        search: value,
                        searchtype: searchtype
                    },
                    contenttype: "application/json",
                }
                $.ajax(scriptmodule, settings).then(function(response) {
                    var obj = $.parseJSON(response);
                    $('.loading-page').removeClass('active');
                    $('#table-library tr').remove();
                    $('#table-library').append(obj.result);
                    $('#header-library').replaceWith(obj.header);
                    $('#pagination').replaceWith(obj.pagination);
                    $('.alert-warning').replaceWith(obj.alert);
                })
            })
            // Trờ về dữ liệu cũ khi xóa hết giá trị search
            $('.searchlibrary').keyup(function(e) {
                var value = $('.searchlibrary').val().trim();
                if (e.keyCode == 8) {
                    if (value == '') {
                        $(this).next("button.library").click();
                    }
                }
            });
            // Kiểm tra cây có danh mục con hay không
            $('.icon-plus').click(function() {
                var id = $(this).attr('id');
                var iconplus = Config.wwwroot + '/theme/moove/pix/plus.png';
                var iconminus = Config.wwwroot + '/theme/moove/pix/minus.png';
                if($(this).attr('src') == iconplus) {
                    $(this).attr('src',iconminus);
                } else {
                    $(this).attr('src',iconplus);
                }
                $('.content-expand.' + id).slideToggle();
            })
            ///////////////
            function getSelectRow(gridname) {
                var myGrid = $(gridname).getKendoGrid();
                var selectedRows = myGrid.select();
                var arrObject = [];
                for (var i = 0; i < selectedRows.length; i++) {
                    arrObject.push(myGrid.dataItem(selectedRows[i]));
                }
                return arrObject;
            }
            // Xóa các mục module đã chọn (chức năng duyệt module)
            $('#delete-module-select').click(function() {
                var arrObject = getSelectRow('#library-approval-module');
                var href = '/local/newsvnr/ajax/library_online/library_approval_module_ajax.php?action=deleteselect';
                var data = JSON.stringify(arrObject);
                var settings = {
                    type: "POST",
                    processData: true,
                    data: {
                        dataselect: data
                    }
                }
                $.ajax(href, settings).then(function() {
                    $('#library-approval-module').data("kendoGrid").dataSource.read();
                })
            })
            // Xóa các mục module đã chọn (chức năng duyệt module)
            $('#approval-module-select').click(function() {
                var arrObject = getSelectRow('#library-approval-module');
                var href = '/local/newsvnr/ajax/library_online/library_approval_module_ajax.php?action=approvalselect';
                var data = JSON.stringify(arrObject);
                var settings = {
                    type: "POST",
                    processData: true,
                    data: {
                        dataselect: data
                    }
                }
                $.ajax(href, settings).then(function() {
                    $('#library-approval-module').data("kendoGrid").dataSource.read();
                })
            })
            // Mở popup share module thư viện vào khóa học
            $('#table-library').on('click', 'a#share-module-library', function(e) {
                $('#share-popup-modal-module').modal('show');
                var moduleid = $(this).attr('moduleid');
                $('#share-module-library').attr('moduleid', moduleid);
            })
            // kendo lọc khóa học 
            var kendoConfig = {};
                kendoConfig.apiSettings = { url: scriptshare+'filter_course'};
                kendoConfig.value = 'courseid';
            var kendoCourseList = kendoService.initDropDownList(kendoConfig);
            $("#course-share-input").kendoDropDownList(kendoCourseList);
            // kendo lọc section của khóa học
            var kendoConfig = {};
                kendoConfig.apiSettings = { url: scriptshare+'filter_course_section'};
                kendoConfig.value = 'sectionid';
                kendoConfig.cascadeFrom = 'course-share-input';
            var kendoCourseSection = kendoService.initDropDownList(kendoConfig);
            $("#course-section-input").kendoDropDownList(kendoCourseSection);
            
            $("#share-module-library").click(function() {
                var moduleid = $('#share-module-library').attr('moduleid');
                var courseid = $('#course-share-input').val();
                var sectionid = $('#course-section-input').val();
                var settings = {
                    type: "GET",
                    processData: true,
                    dataType: "json",
                    data: {
                        moduleid: moduleid,
                        courseid: courseid,
                        sectionid: sectionid
                    }
                }
                $.ajax(scriptshare + 'share_module', settings).then(function(response) {
                    alertify.notify(response.success, 'success', 3);
                })
            })
            // Mở kendo window
            $('.approvalmodule').click(function(){
                var dialog = $('#viewApprovalModule').data("kendoWindow");
                dialog.title('Duyệt tài nguyên');
                dialog.center().open();
            })
            $('#viewApprovalModule').kendoWindow({
                width: "1200px",
                title: '',
                visible: false,
                open: onOpen,
                actions: [
                    "Minimize", 
                    "Maximize",
                    "Close"
                ],
            })
            function onOpen(e) {
                setPositionWindow('#viewApprovalModule',100);
            }
            $('#modal-iframe-library').on('hidden.bs.modal', function () {
                document.cookie = 'cookie=; max-Age=-1;path=/';
            }) 
            // Sắp xếp
            $('.sort-module').click(function() {
                $('.loading-page').addClass('active');
                $('.sort-module i').remove();
                var action  = $(this).attr('action');
                var folderid = $('#pagination').attr('folderid');
                var modulefilter = $('#pagination').attr('modulefilter');
                var search = $('#pagination').attr('search');
                if(action == "viewsort_desc") {//   
                    $(this).html(M.util.get_string('viewed', 'local_newsvnr')+'<i class="ml-1 fa fa-arrow-down" aria-hidden="true"></i>');
                    $(this).attr('action','viewsort_asc')
                }
                if(action == "viewsort_asc") {
                    $(this).html(M.util.get_string('viewed', 'local_newsvnr')+'<i class="ml-1 fa fa-arrow-up" aria-hidden="true"></i>');
                    $(this).attr('action','viewsort_desc')
                }
                if(action == "timesort_desc") {
                    $(this).html('Time created<i class="ml-1 fa fa-arrow-down" aria-hidden="true"></i>');
                    $(this).attr('action','timesort_asc')
                }
                if(action == "timesort_asc") {
                    $(this).html('Time created<i class="ml-1 fa fa-arrow-up" aria-hidden="true"></i>');
                    $(this).attr('action','timesort_desc')
                }
                var settings = {
                    type: "GET",
                    processData: true,
                    dataType: "json",
                    data: {
                        folderid:folderid,
                        modulefilter:modulefilter,
                        search:search,
                        action: action,
                    }
                }
                $.ajax(scriptmodule,settings).then(function(response) {
                    $('#table-library').hide().html(response.result).fadeIn('fast');
                    $('.loading-page').removeClass('active');
                    $('#pagination').replaceWith(response.pagination);
                })
            })           
        })
    }
    var deleteUser = function() {
        $('#delete_module_request').click(function(){
            var actionscript = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_approval_module_ajax.php';
            var arrObject = getSelectRow('#library-request-approval');
            var data = JSON.stringify(arrObject);
            var settings = {
                type: "POST",
                processData: true,
                data: {
                    dataselect: data,
                    action: 'deleteselectrequest'
                }
            }
            alertify.confirm('Cảnh báo', 'Bạn có chắc muốn xóa các tài liệu đã chọn?', function(){ 
                $.ajax(actionscript,settings).then(function(response) {
                    var obj = $.parseJSON(response);
                    alertify.notify(obj.message, 'success', 3);
                    var grid = $('#library-request-approval').data("kendoGrid");
                    grid.dataSource.read();
                    $('.request-module-fuction').addClass('disabled');
                })
            }, function(){});
        })
    }
    var requestApproval = function() {
        $('#request_approval').click(function(){
            var actionscript = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_approval_module_ajax.php';
            var arrObject = getSelectRow('#library-request-approval');
            var data = JSON.stringify(arrObject);
            var settings = {
                type: "POST",
                processData: true,
                data: {
                    dataselect: data,
                    action: 'requestapprovalselect'
                }
            }
            $.ajax(actionscript,settings).then(function(response) {
                var obj = $.parseJSON(response);
                alertify.notify(obj.message, 'success', 3);
                var grid = $('#library-request-approval').data("kendoGrid");
                grid.dataSource.read();
                $('.request-module-fuction').addClass('disabled');
            })
        })
    }
    var kendoRequestApproval = function() {
        var kendoConfig = {};
        var script = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_request_approval.php';
        var gridName = '#library-request-approval';
        var settings = {            
            url: script,
            type : 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
        };
        var colums = [
            {
                template:function(e) {
                    return e.name;
                },
                field: "name",
                title: "Tên",
                width: "130px"
            },
            {
                field: "folder",
                title: "Thư mục",
                width: "100px"
            },
            {
                field: "moduletype",
                title: "Loại",
                width: "80px"
            },
            {
                field: "size",
                title: "Kích thước",
                width: "80px"
            },
            {
                template: function(e) {
                    return e.download;
                },
                field: "download",
                title: "Tải xuống",
                width: "100px"
            },
            {
                field: "timecreated",
                title: "Ngày yêu cầu",
                width: "100px"
            },
            {
                field: "author",
                title: "Người yêu cầu",
                width: "120px"
            },
            {
                template: function(e) {
                    return e.status;
                },
                field: "status",
                title: 'Trạng thái',
                width: "100px"
            },
            {   
                template: function(e) {
                    return e.action;
                },
                field: "action",
                title: "Chức năng",
                width: "150px"
            }
        ];
        var onChange = function() {
            var selected = $.map(this.select(), function(item) {
                return $(item).text();
            });
            if(selected.length > 0) {
                $('.request-module-fuction').removeClass('disabled');
            } else {
                $('.request-module-fuction').addClass('disabled');
            }
        }   
        kendoConfig.onChange = onChange;
        kendoConfig.columns = colums;
        kendoConfig.apiSettings = settings;
        var gridData = kendo.initGrid(kendoConfig);
        $(gridName).kendoGrid(gridData);
    }
    var init = function() {
        initLibrary();
        kendoRequestApproval();
        deleteUser();
        requestApproval();
    }

    return {
        init:init
    }
});