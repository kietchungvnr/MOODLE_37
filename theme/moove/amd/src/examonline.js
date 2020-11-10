define(["jquery", "core/config", 'kendo.all.min', "core/str", "core/notification"], function($, Config, kendo, Str, Notification) {
    var script = Config.wwwroot + '/local/newsvnr/exam/ajax/examonline.php';
    //load môn thi mỗi khi click vào danh mục kì thi
    $('#exam-tree li.exam').click(function() {
        $('.loading-page').addClass('active');
        $('#exam-tree li.exam').removeClass('active');
        $('#exam-tree li.exam').addClass('not-allow');
        $(this).addClass('active');
        var examid = $(this).attr('id');
        var settings = {
            type: "GET",
            processData: true,
            data: {
                examid: examid
            },
            contenttype: "application/json",
        }
        $.ajax(script, settings).then(function(response) {
            var obj = $.parseJSON(response);
            $('#table-exam').hide().html(obj.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
            $('#exam-tree li.exam').removeClass('not-allow');
        });
    })
    //load bài thi mỗi khi click vào danh mục môn thi
    $('#exam-tree li.subject-exam').click(function() {
        $('.loading-page').addClass('active');
        var subjectid = $(this).attr('id');
        var settings = {
            type: "GET",
            processData: true,
            data: {
                subjectid: subjectid
            },
            contenttype: "application/json",
        }
        $.ajax(script, settings).then(function(response) {
            var obj = $.parseJSON(response);
            $('#table-exam').hide().html(obj.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
        });
    })
    //Mở truyền tham số vào button tạo đề thi khi click vào môn thi
    $('#exam-tree li.list-subcategory').click(function() {
        $('#exam-tree li.list-subcategory').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('id');
        var href = Config.wwwroot + '/course/modedit.php?add=quiz&type=&course=1&section=0&return=0&sr=0&subjectid=' + id;
        $('#add-quiz').attr('href', href);
        $('#add-quiz').removeClass('d-none');
    })
    var examurl = Config.wwwroot + "/examonline.php";
    if (window.location.href == examurl) {
        $.getJSON(script, function(data) {
            $('#table-exam').hide().html(data.result).fadeIn('fast');
        })
    }
    //Kendo chọn ngày tháng
    $("#examdate").kendoDatePicker();
    $('#exam_search_button').click(function() {
        $('.loading-page').addClass('active');
        var datepicker = $("#examdate").val();
        var date = parseInt((new Date(datepicker).getTime() / 1000).toFixed(0))
        var examname = $('.exam_search_input#examname').val().trim().split(' ').join('+');
        var subjectname = $('.exam_search_input#subjectname').val().trim().split(' ').join('+');
        $('li').removeClass('active');
        $.getJSON(script+'?examname='+examname+'&subjectname='+subjectname+'&date='+date+'&action=search', function(data) {
            $('#table-exam').hide().html(data.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
        })
    })
})
