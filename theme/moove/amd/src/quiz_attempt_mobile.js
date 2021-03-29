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
            var clone = $('#quiz-timer').clone();
            var initwidth = $(window).width();
            if(initwidth > 576) {
                $('#quiz-timer').remove();
            }
            $(window).resize(function() {
                var fm = getCookie('cookie');
                var width = $(window).width();
                if (width <= 576 && fm == "focusmod") {
                    $('#quiz-timer').remove();
                    $('.list-question-scroll').before(clone);
                } 
                else if (width > 576 && fm == "focusmod") {
                    $('#quiz-timer').remove();
                    $('#user-picture').after(clone);
                    $('#quiz-timer').next('div').children('div#quiz-timer').remove();
                }
            })
            $('.multichoice .answer input[type="radio"]').change(function() {
                var name = $(this).attr('name');
                var id = name.replace('q','');
                    id = id.replace(':','-');
                    id = id.replace('_answer','');
                    id = '#question-'+id;
                $(id+' div.r0').removeClass('active');
                $(id+' div.r1').removeClass('active');
                $(this).parent('div').addClass('active');
                $('.clear-choice[name="'+name+'"]').remove();    
                var clearchoice = $('<div class="clear-choice" name="'+name+'"><i class="fa fa-times" aria-hidden="true"></i></div>').insertAfter($(this).next());
                setTimeout(function() {
                    clearchoice.show()
                },300);
                $('.clear-choice').click(function() {
                    var name = $(this).attr('name');
                    name += '-1';
                    $('.qtype_multichoice_clearchoice a[for="'+name+'"]').trigger('click')
                    $(this).parent().removeClass('active');
                    $(this).remove();
                })
            })
            $('.multichoice .answer input[type="radio"]').each(function() {
                if($(this).is(":checked")   ) {
                    $(this).parent('div').addClass('active');
                    var name = $(this).attr('name');
                    var clearchoice = $('<div class="clear-choice" name="'+name+'"><i class="fa fa-times" aria-hidden="true"></i></div>').insertAfter($(this).next());
                    setTimeout(function() {
                        clearchoice.show()
                    },300)
                }
            })
        })
    }
    return {
        init: init
    }
});