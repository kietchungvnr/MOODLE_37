define(["jquery", "core/config", "core/str", "core/notification","alertjs","theme_moove/handle_cookie"], function($, Config, Str, Notification, alertify, Cookie) {
    "use strict";
    var init = function() {
        // question category
        if($('div.add-question-bank').length != 0) {
            var form = $('#page-question-category .card .card-body form');
            var clone = form.clone();
            form.remove();
            $('#page-question-category #add-category-question .modal-body').append(clone);
            $('.add-question-bank').click(function() {
                $('.createnewquestion .singlebutton button').trigger('click');
            })
        }
        $('#accordion .li-inside .edit-category').click(function() {
            var link = $(this).attr('data-link');
            setCookie('cookie', 'focusmod');
            var iframe = '<iframe id="iframe-edit-category" src="'+link+'" width="100%" height="620px" style="border:0"></iframe>';
            $('#page-question-category #edit-category-question .modal-body').html(iframe);
                $('#iframe-edit-category').on('load',function() {
                    $('#edit-category-question .submit').bind('click',function() {
                        var contents = $('#iframe-edit-category').contents();
                        $(contents).find("#id_submitbutton").click();
                        alertify.notify('Sửa danh mục thành công', 'success',2);
                        $('#edit-category-question').modal('hide');
                        Cookie.setCookie('cookie', '-1', 0);
                        location.reload();
                    })
                })
        })
        $('.tag-item').click(function() {
            var id = $(this).attr('value');
            var url = window.location.href;
            if($(this).hasClass('active')) {
                url = url.replace('&qtagids[]='+id,'');
            } else {
                url += '&qtagids[]=' + id;
            }
            window.location.href = url;
        })
        $('.checkbox input').change(function() {
            $('.modulespecificbuttonscontainer').show();
        })
        $('#qbheadercheckbox').change(function() {
            $('.modulespecificbuttonscontainer').show();
        })
    }
    return {
        init: init
    }
});