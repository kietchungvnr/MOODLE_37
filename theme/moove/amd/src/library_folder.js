define(["jquery", "core/config", "core/str", "core/notification", "alertjs"], function($, Config, Str, Notification, alertify) {
    "use strict";
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
    Str.get_strings(strings).then(function(s) {
        $('#add-new-folder').click(function() {
            var foldername = $('.add-folder-popup #foldername').val();
            var parentid = $('.add-folder-popup #folderparent').attr('parentid');
            var folderdes = $('.add-folder-popup #folderdes').val();
            var folderid = $(this).attr('forderid');
            var action = $(this).attr('action');
            var settings = {
                type: "GET",
                processData: true,
                data: {
                    foldername: foldername,
                    folderid: folderid,
                    parentid: parentid,
                    folderdes: folderdes,
                    action: action
                },
                contenttype: "application/json",
            }
            if (foldername == '') {
                alertify.alert(s[0],s[2]);
                return;
            }
            $.ajax(scriptfolder, settings).then(function(response) {
                $('#add-popup-modal-folder').modal('hide');
                var obj = $.parseJSON(response);
                alertify.notify(obj.alert, 'success', 3);
                location.reload();
            });
        });
        // mở popup setting thư mục
        $('.tree-folder .folder').bind("contextmenu", function(e) {
            $('.popup-setting').hide();
            if($(this).hasClass('show')) {
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
                    allmodule:allmodule,
                    folderid:folderid,
                    foldername:foldername
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
            setting.css('left', x - 35);
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
        $('#folder_library li.folder').click(function() {
            $('.alert-warning').text('');
            $('.alert-warning').removeClass('alert');
            $('.loading-page').addClass('active');
            $('#folder_library li.folder').removeClass('active');
            $('#folder_library li.folder').addClass('not-allow');
            $(this).addClass('active');
            var folderid = $(this).attr('id');
            $('.add-module-popup input[name="selectmodule"]').attr('folderid', folderid);
            $('#searchlibrary').attr('folderid', folderid);
            $('button[data-target="#add-popup-modal-module"]').show();
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
        $("i.library").click(function() {
            var folderid = $('#searchlibrary').attr('folderid');
            var value = $('#searchlibrary').val().trim();
            var searchtype = $('#searchlibrary').attr('searchtype');
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
                $('#table-library tr').remove();
                $('#table-library').append(obj.result);
                $('#header-library').replaceWith(obj.header);
                $('#pagination').replaceWith(obj.pagination);
                $('.alert-warning').replaceWith(obj.alert);
            })
        })
        // search khi nhấn enter
        $('#searchlibrary').keypress(function(e) {
            if (event.which == 13) {
                $("i.library").click();
            }
        })
        // Trờ về dữ liệu cũ khi xóa hết giá trị search
        $('#searchlibrary').keyup(function(e) {
            var value = $('#searchlibrary').val().trim();
            if (e.keyCode == 8) {
                if (value == '') {
                    $("i.library").click();
                }
            }
        });
        // Kiểm tra cây có danh mục con hay không
        $('li.click-expand').each(function() {
            var id = $(this).attr('id');
            if ($('.content-expand.' + id).is(':empty')) {
                $(this).children('i.rotate-icon').remove();
            }
        })
        // Chọn loại filter tìm kiếm
        $('#filter_search_library').bind('change', function() {
            var searchtype = $(this).val();
            $('#searchlibrary').attr('searchtype', searchtype);
            if (searchtype == "searchcontent") {
                $('.k-animation-container').addClass('d-none')
            } else {
                $('.k-animation-container').removeClass('d-none')
            }
        })
        $(".nav.multi-tab li a").click(function() {
            var data = $(this).attr('data-key');
            $(".nav.multi-tab li a").removeClass('active');
            $(this).addClass('active');
            $('.tab-content .tab-pane').hide();
            $('.tab-content .tab-pane[data="' + data + '"]').fadeIn('fast');
        });
        //
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
    })
});