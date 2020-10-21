define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    /// Thêm thư mục mới
    var scriptfolder = "/local/newsvnr/ajax/library_folder_ajax.php";
    var scriptmodule = "/local/newsvnr/ajax/library_module_ajax.php";
    $('#add-new-folder').click(function() {
        var foldername = $('.add-folder-popup #foldername').val();
        var parentid = $('.add-folder-popup #folderparent').attr('parentid');
        var folderdes = $('.add-folder-popup #folderdes').val();
        var folderid = $(this).attr('forderid');
        var action = $(this).attr('action');
        if (foldername == '') {
            alert('Tên thư mục không được để trống');
            return;
        }
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
        $.ajax(scriptfolder, settings).then(function(response) {
            $('#add-popup-modal-folder').modal('hide');
            var obj = $.parseJSON(response);
            alertSuccess(obj.alert);
            location.reload();
        });
    });
    // mở popup setting thư mục
    $('.tree-folder .folder').bind("contextmenu", function(e) {
        $('.tree-folder .folder').removeClass('active');
        $(this).toggleClass('active');
        var x = e.clientX;
        e.preventDefault();
        var id = $(this).attr('id');
        var name = $(this).text();
        var setting = $('.popup-setting');
        var y = $(this).position();
        $('.popup-setting li').attr('folderid', id);
        $('.popup-setting li').attr('foldername', name);
        setting.css('top', y.top + 5);
        setting.css('left', x - 35);
        setting.show();
    });
    $('body').click(function() {
        $('.popup-setting').hide();
    })
    // Xóa , sửa , thêm thư mục con  
    $('.popup-setting li').click(function() {
        var folderid = $(this).attr('folderid');
        var action = $(this).attr('action');
        var name = $(this).attr('foldername');
        //confirm xóa thư mục
        if (action == "delete") {
            var check = confirm("Bạn có chắc muốn xóa , sẽ bị mất hết dữ liệu!");
            if (check == false) {
                return;
            }
        }
        //xử lý thêm thư mục con
        if (action == 'addchildfolder') {
            $('#add-popup-modal-folder').on('shown.bs.modal', function(e) {
                $('input#folderparent').val(name);
                $('input#folderparent').attr('parentid', folderid);
            })
            return;
        }
        var settings = {
            type: "GET",
            processData: true,
            data: {
                folderid: folderid,
                action: action
            },
            contenttype: "application/json",
        }
        $.ajax(scriptfolder, settings).then(function(response) {
            var obj = $.parseJSON(response);
            if (action == 'delete') {
                $('li.folder#' + folderid).remove()
                alertSuccess(obj.alert);
            } else {
                $('#edit-popup-modal-folder').replaceWith(obj.result);
                $('#edit-popup-modal-folder').modal('show');
            }
        });
    });
    // Làm mới dữ liệu input khi tắt popup
    $("#add-popup-modal-folder").on('show.bs.modal', function() {
        $('#add-popup-modal-folder input#foldername').val('');
        $('#add-popup-modal-folder input#folderparent').replaceWith('<input autocomplete="off" class="form-control" id="folderparent">');
        $('#add-popup-modal-folder textarea#folderdes').val('');
    });
    //Láy parameter folder id khi click vào cây thư mục
    $('#folder_library li.folder').click(function() {
    	$('.alert-warning').text('');
    	$('.alert-warning').removeClass('alert');
        $('.loading-page').addClass('active');
        $('#folder_library li.folder').removeClass('active');
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
            $('.loading-page').removeClass('active');
            if(obj.result == '') {
            	$('.alert-warning').replaceWith(obj.alert);
            }
        });
    })
    // Tạo module mới trên thư viện ( truyền vào value và folderid)
    $('#add-new-module').click(function() {
        var value = $('.add-module-popup input[name="selectmodule"]:checked').val();
        var folderid = $('.add-module-popup input[name="selectmodule"]:checked').attr('folderid');
        window.location.href = 'course/modedit.php?add=' + value + '&type=&course=1&section=1&return=0&sr=&folderid=' + folderid;
    })
    // load ajax module library
    // $('#table-library').load('/local/newsvnr/ajax/library_module_ajax.php', function(response) {
    //     var obj = $.parseJSON(response);
    //     $('#table-library').hide().html(obj.result).fadeIn('fast');
    // })
    $.getJSON('/local/newsvnr/ajax/library_module_ajax.php',function(data) {
    	$('#table-library').hide().html(data.result).fadeIn('fast');

    })
    // Search tài liệu thư viện
    $("i.library").click(function() {
        var folderid = $('#searchlibrary').attr('folderid');
        var value = $('#searchlibrary').val().trim();
        var settings = {
            type: "GET",
            processData: true,
            data: {
                folderid: folderid,
                search: value
            },
            contenttype: "application/json",
        }
        $.ajax(scriptmodule, settings).then(function(response) {
            var obj = $.parseJSON(response);
            $('#table-library tr').remove();
            $('#table-library').append(obj.result);
        })
    })
    $('#searchlibrary').keypress(function(e) {
    	if(event.which == 13) {
    		$("i.library").click();
    	}
    })

	$('#searchlibrary').keyup(function(e) {
		var value = $('#searchlibrary').val().trim();
	    if(e.keyCode == 8) {
	    	if(value == '') {
	        	$("i.library").click();
	        }
	    }
	});
});