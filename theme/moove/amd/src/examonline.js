define(["jquery", "core/config", 'kendo.all.min', "core/str", "core/notification"], function($, Config, kendo, Str, Notification) {
    var script = Config.wwwroot + '/local/newsvnr/exam/ajax/examonline.php';
    var examurl = Config.wwwroot + "/examonline.php";
    if (window.location.href == examurl) {
        $.getJSON(script, function(data) {
            $('#table-exam').hide().html(data.result).fadeIn('fast');
        })
        $.getJSON(script + "?action=exam_category", function(data) {
            $('#examonline-category').hide().html(data.category_exam).fadeIn('fast');
        })
    }
    //Kendo chọn ngày tháng
    $("#examdate").kendoDatePicker();
    //Tìm kiếm bài thi theo kỳ thi,môn thi,ngày thi
    $('#exam_search_button').click(function() {
        // $('.loading-page').addClass('active');
        var datepicker = $("#examdate").val();
        var date = parseInt((new Date(datepicker).getTime() / 1000).toFixed(0))
        var examname = $('.exam_search_input#examname').val().trim().split(' ').join('+');
        var subjectname = $('.exam_search_input#subjectname').val().trim().split(' ').join('+');
        var examtype = $('#exam-type').val();
        $('li').removeClass('active');
        $.getJSON(script + '?examname=' + examname + '&subjectname=' + subjectname + '&date=' + date + '&action=search&examtype=' + examtype, function(data) {
            $('#table-exam').hide().html(data.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
        })
    })
    //Lọc loại kỳ thi
    $('#exam-type').kendoDropDownList({
        dataSource: [{
            text: "Danh sách kì thi bắt buộc",
            value: 0
        }, {
            text: "Danh sách kì thi tự do",
            value: 1
        }],
        dataTextField: "text",
        dataValueField: "value",
        change: function(e) {
            var examType = this.value();
            var settingsExamCategory = {
                type: "POST",
                processData: true,
                data: {
                    action: 'exam_category',
                    examtype: examType
                }
            }
            $.ajax(script, settingsExamCategory).then(function(response) {
                var obj = $.parseJSON(response);
                $('#examonline-category').hide().html(obj.category_exam).fadeIn('fast');
                $('#table-exam').hide().html(obj.result).fadeIn('fast');
            });
        }
    })
    //load môn thi mỗi khi click vào danh mục kì thi
    $('#examonline-category').on('click', 'li.exam', function(e) {
        var examid = $(this).attr('id');
        var examtype = $('#exam-type').val();
        $('.loading-page').addClass('active');
        $('#menu-tree-exam li.exam').removeClass('active');
        $('#menu-tree-exam li.subject-exam').removeClass('active');
        $('#menu-tree-exam li.exam').addClass('not-allow');
        $(this).addClass('active');
        $('.content-expand.' + examid).slideToggle();
        $(this).children('i.rotate-icon').toggleClass('active');
        var settings = {
            type: "POST",
            processData: true,
            data: {
                examid: examid,
                examtype: examtype
            },
            contenttype: "application/json",
        }
        $.ajax(script, settings).then(function(response) {
            var obj = $.parseJSON(response);
            $('#table-exam').hide().html(obj.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
            $('#menu-tree-exam li.exam').removeClass('not-allow');
        });
    });
    //Load bài thi mỗi khi click vào danh mục môn thi
    $('#examonline-category').on('click', 'li.subject-exam', function(e) {
        $('.loading-page').addClass('active');
        $('#menu-tree-exam li.exam').removeClass('active');
        $('#menu-tree-exam li.subject-exam').removeClass('active');
        $(this).addClass('active');
        // Hiện và truyền tham số vào button tạo đề thi khi click vào môn thi
        var examsubjectexamid = $(this).attr('data-examsujbectexam');
        var href = Config.wwwroot + '/course/modedit.php?add=quiz&type=&course=1&section=0&return=0&sr=0&examsubjectexamid=' + examsubjectexamid;
        $('#add-quiz').attr('href', href);
        $('#add-quiz').removeClass('d-none');
        //////////////////////////////////////
        var examtype = $('#exam-type').val();
        var settings = {
            type: "POST",
            processData: true,
            data: {
                examsubjectexamid: examsubjectexamid,
                examtype: examtype
            },
            contenttype: "application/json",
        }
        $.ajax(script, settings).then(function(response) {
            var obj = $.parseJSON(response);
            $('#table-exam').hide().html(obj.result).fadeIn('fast');
            $('.loading-page').removeClass('active');
        });
    })
})