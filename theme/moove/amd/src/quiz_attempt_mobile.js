define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification, alertify) {
    "use strict";
    var init = function() {
        // chuyển trang bài kiểm tra
        $(document).ready(function() {
            $('.quiz-next-page').click(function() {
                $('.submitbtns .mod_quiz-next-nav').trigger('click')
            })
            $('.quiz-prev-page').click(function() {
                $('.submitbtns .mod_quiz-prev-nav').trigger('click')
            })
            var thispage = $('.qnbutton.thispage');
            var idnumber = thispage[0].outerHTML.search('quiznavbutton');
            var id = thispage[0].outerHTML.slice(idnumber, idnumber + 15);
            var finalid = id.replace('"',' ');
            var widthtime = $('#quiz-timer').width();
            $('.list-question-scroll').animate({
                scrollLeft: $("#" + finalid).offset().left - (widthtime + 10)
            }, 'fast');

            // lan chuột đến câu hỏi 
            $('.qnbutton.thispage').each(function() {
                var question = $(this).attr('href');
                $(this).attr('question',question);
                $(this).removeAttr('href');
            })
            $('.qnbutton.thispage').click(function() {
                var id = $(this).attr('question')
                if(id != '#') {
                    $('body').animate({scrollTop: $(id).offset().top - 40}, 'fast');
                } else {
                    $("html, body").animate({ scrollTop: "0" },'fast'); 
                }
            })
            //
            setTimeout(function() {
                var text = $('#quiz-time-left').text()
                if(text == "") {
                    $('#quiz-time-left').css({'padding':0});
                }
            },1000)
            var currentpage = $("input[name='thispage']").attr('value');
            var nextpage = $("input[name='nextpage']").attr('value');
            if(currentpage == 0) {
                $('.quiz-menu-item.prev-quiz').addClass('disable');
            } 
            if(nextpage == -1) {
                $('.quiz-menu-item.next-quiz').addClass('disable');
            }
        })
    }
    return {
        init: init
    }
});