define(["jquery", "core/config", 'kendo.all.min', "core/str", "core/notification", "local_newsvnr/initkendocontrolservices", "theme_moove/generate_qrcode"], function($, Config, kendo, Str, Notification, kendoService, qrCode) {
    
    var showQrCode = function() {
        $('[data-qrcode=qrcode]').bind('click', function(e) {
            var getQrContent = $(this).attr('data-qrcontent');
            qrCode.init('[data-qrcode=qrcode]', getQrContent);
        })
    }

    var init = function() {
        var strings = [{
            key: 'listexamrequired',
            component: 'local_newsvnr'
        }, {
            key: 'listexamfree',
            component: 'local_newsvnr'
        }, {
            key: 'subjectexam',
            component: 'local_newsvnr'
        }, {
            key: 'exam',
            component: 'local_newsvnr'
        }];
        var script = Config.wwwroot + '/local/newsvnr/exam/ajax/examonline.php';
        var examurl = Config.wwwroot + "/examonline.php";
        var scriptsubject = Config.wwwroot + '/local/newsvnr/exam/ajax/exam_grade_report.php';
        if (window.location.href == examurl) {
            $.getJSON(script, function(data) {
                $('#table-exam').hide().html(data.result).fadeIn('fast');
                //Tạo mã QR cho mỗi bài thi
                showQrCode();
            })
            $.getJSON(script + "?action=exam_category", function(data) {
                $('#examonline-category').hide().html(data.category_exam).fadeIn('fast');
            })
        }
        Str.get_strings(strings).then(function(s) {
            //Kendo chọn ngày tháng
            $("#examdate").kendoDatePicker();
            //Tìm kiếm bài thi theo kỳ thi,môn thi,ngày thi
            $('#exam_search_button').click(function() {
                // $('.loading-page').addClass('active');
                var datepicker = $("#examdate").val();
                var date = parseInt((new Date(datepicker).getTime() / 1000).toFixed(0))
                var examid = $('#examname').val();
                var examsubjectexamid = $('#subjectname').val();
                var examtype = $('#exam-type').val();
                $('li').removeClass('active');
                $.getJSON(script + '?examid=' + examid + '&examsubjectexamid=' + examsubjectexamid + '&date=' + date + '&examtype=' + examtype, function(data) {
                    $('#table-exam').hide().html(data.result).fadeIn('fast');
                    $('.loading-page').removeClass('active');
                })
            })
            //Lọc loại kỳ thi
            $('#exam-type').kendoDropDownList({
                dataSource: [{
                    text: s[0],
                    value: 0
                }, {
                    text: s[1],
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
                    $('#add-quiz').addClass('d-none');
                    $.ajax(script, settingsExamCategory).then(function(response) {
                        var obj = $.parseJSON(response);
                        $('#examonline-category').hide().html(obj.category_exam).fadeIn('fast');
                        $('#table-exam').hide().html(obj.result).fadeIn('fast');
                        examDropdown();
                        subjectDropdown();
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
                $('#add-quiz').addClass('d-none');
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
                    showQrCode();
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
                var cancreate = $(this).attr('data-cancreate');
                var examsubjectexamid = $(this).attr('data-examsujbectexam');
                var href = Config.wwwroot + '/course/modedit.php?add=quiz&type=&course=1&section=0&return=0&sr=0&examsubjectexamid=' + examsubjectexamid;
                if(cancreate == 'true') {
                    $('#add-quiz').attr('href', href);
                    $('#add-quiz').removeClass('d-none');
                } else {
                    $('#add-quiz').addClass('d-none');
                }
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
                    //Tạo mã QR cho mỗi bài thi
                    showQrCode();
                    $('.loading-page').removeClass('active');
                });
            })
            // Lọc môn thi
            function examDropdown() {
                var examtype = $('#exam-type').val();
                if (examtype == 1) {
                    var action = 'exam_filter_free';
                } else {
                    var action = 'exam_filter_required';
                }
                var kendoConfig = {};
                var apiSettings = {
                    url: scriptsubject,
                    data: {
                        action: action
                    }
                }
                kendoConfig.optionLabel = s[3] + "...";
                kendoConfig.apiSettings = apiSettings;
                kendoConfig.value = "examid";
                var initDropDownList = kendoService.initDropDownList(kendoConfig);
                $("#examname").kendoDropDownList(initDropDownList);
            }

            function subjectDropdown() {
                var examtype = $('#exam-type').val();
                if (examtype == 1) {
                    var action = 'subject_filter_free';
                } else {
                    var action = 'subject_filter_required';
                }
                var kendoConfig = {};
                var apiSettings = {
                    url: scriptsubject,
                    data: {
                        action: action
                    }
                }
                kendoConfig.cascadeFrom = "examname";
                kendoConfig.optionLabel = s[2] + "...";
                kendoConfig.apiSettings = apiSettings;
                kendoConfig.value = "examsubjectexamid";
                var initDropDownList = kendoService.initDropDownList(kendoConfig);
                $("#subjectname").kendoDropDownList(initDropDownList);
            }
            examDropdown();
            subjectDropdown();
        });
    }
    return {
        init: init
    }
})
