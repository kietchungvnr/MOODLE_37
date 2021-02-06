define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var strings = [{
        key: 'general',
        component: 'theme_moove'
    }];
   
    var path = window.location.href;

    $(document).ready(function() {
        if (path.indexOf('/mod/quiz/attempt.php') > 0) {
            $('nav.focusmod').addClass('testhoi');
        }
        
    });
  
    // Click vào chế độ focus mode
    $('.open-focusmod').bind('click', function() {
        if($('body').hasClass('focusmod')) {
            setCookie('cookie', 'focusmod');
        }
        var fm = getCookie('cookie');
        var course = $(this).attr('course');
        if($('#mod-iframe').length <= 0) {
            $('#mod-view-coursepage').html('<div class="alert alert-success mb-0"><strong>'+ M.util.get_string('selectcoursedata', 'theme_moove') +'</strong></div>');
        }

        $('#setting-context').addClass('d-none');
        $('#sidepreopen-control').addClass('d-none');
        if (fm == "focusmod") {
            /// Hiện các element khi thoát chế độ focusmode
            $('body').removeClass('focusmod');
            $('#region-main .loading-page').removeClass('active');
            $('#setting-context').removeClass('d-none');
            $('#sidepreopen-control').removeClass('d-none');
            $('.navbar.focusmod').removeClass('d-flex');
            $('#course-main-content').removeClass('d-none');
            $('#mod-view-coursepage').addClass('d-none');
            $('#page-content').removeAttr("style");
            $('#region-main-box').removeAttr("style");
            $('#page.container-fluid').removeAttr("style");
            $('#page-wrapper').removeAttr("style");
            $('#sidepreopen-control').removeClass('d-none');
            $('#sidepre-blocks').removeClass('d-none');
            $('ul.course').removeClass('d-none');
            $('#region-main').removeAttr("style");
            $('.fixed-sidebar-left').removeClass('d-none');
            $('footer,.all-header,#page-header').slideDown();
            document.cookie = 'cookie=; max-Age=-1;path=/';
        } else {
            /// Ẩn các element khi bật chế độ focusmode
            $('body').addClass('focusmod');
            $('footer,.all-header,#page-header').slideUp();
            $('.fixed-sidebar-left').addClass('d-none');
            $('#page-wrapper').css('margin-left', '0');
            $('.navbar.focusmod').addClass('d-flex');
            $('ul.course').addClass('d-none');
            $('#course-main-content').addClass('d-none');
            $('#mod-view-coursepage').removeClass('d-none');
            $('#page-content').attr('style', 'margin-left:0;margin-right:0');
            $('#region-main-box').attr('style', 'padding:0!important;margin-top:62px');
            $('#page.container-fluid').attr('style', 'padding: 0!important');
            $('#setting-context').addClass('d-none');
            $('#sidepreopen-control').addClass('d-none');
            $('#sidepre-blocks').addClass('d-none');

            setCookie('cookie', 'focusmod');
        }
    })

    // Resize windown nếu nhỏ hơn 1050 thì bỏ chức năng focus
    $(window).resize(function() {
        var fm = getCookie('cookie')
        var width = $(window).width();
        if (width <= 1050) {
            if (fm == "focusmod") {
                $('.fixed-top.focusmod .open-focusmod ').trigger('click');
                $('#setting-context').removeClass('d-none');
                $('#sidepreopen-control').removeClass('d-none');
            }
        }
    })

    // Xử dropdown khi click
    $(".dropdown-content .card-header.level1").click(function() {
        var id = $(this).attr("id");
        $(".card-header#" + id + " .rotate-icon").toggleClass('active');
        $(".dropdown-content-2." + id).slideToggle('fast', 'swing');
    })

    // Kiểm xem có nội dung khóa học
    $(".nav-item.mid").click(function() {
        if ($('.dropdown-content').is(':empty')) {
            alert('Không có nội dung');
        } else {
            $('.dropdown-content').slideToggle('fast', 'linear');
        }
    });

    // Lùi bài học
    $('.nav-link.prev').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div.level2');
        if(!temp.is(':first-child')) {
            temp.prev().children('a').trigger('click');
        }
        else {
            var section = $('.card-header.level2 a.active').closest('div.dropdown-content-2').prev();
            if(section.length > 0) {
                $(".card-header .rotate-icon").removeClass('active');
                $(".dropdown-content-2").slideUp('fast', 'swing');
                section.prev().prev().trigger('click');
                section.prev().children('div:last-child').children('a').trigger('click');
            }
        }
    })
    // Tới bài học tiếp theo
    $('.nav-link.next').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div.level2');
        if(!temp.is(':last-child')) {
            temp.next().children('a').trigger('click');
        }
        else {
            var section = $('.card-header.level2 a.active').closest('div.dropdown-content-2').next();
            if(section.length > 0) {
                $(".card-header .rotate-icon").removeClass('active');
                $(".dropdown-content-2").slideUp('fast', 'swing');
                section.trigger('click');
                section.next().children('div:first-child').children('a').trigger('click');
            }
        }
    })

    // Trong khóa học click vào module sẽ auto chuyển sang chế độ focusmode
    $('.course-content li.activity a.aalink').bind('click', function(e) {
        e.preventDefault();
        var moduleId = $(this).parents('li').attr('id').split('-')[1];
        $('#focus-mod').click();
        var element = "div.dropdown-content-2 a[module-id=" +moduleId+ "]";
        $('#mod-view-coursepage').html('');
        setTimeout(function() {
            $(element).trigger('click');
        }, 500);
    })
    // Click vào chọn bài học
    $('div.card-header.level2 a').click(function(e) {
        var _this = $(this);
        var url = _this.attr('data-focusmode-url');
        var modType = _this.attr('data-mod-type');

        if($('body').hasClass('focusmod')) {
            setCookie('cookie', 'focusmod');
        }
        $('#region-main .loading-page').addClass('active');
        $('div.card-header.level2 a').removeClass('active');
        _this.addClass('active').siblings().removeClass('active');
        $('.mid .nav-link.focusmod').html(_this.text() + '<i class="fa fa-angle-down rotate-icon ml-2"></i>');

        $('.nav-link.next, .nav-link.prev').removeClass('disable');
        // Kiểm tra ngoại lệ tiến lùi trong màn hình khóa học
        if ($('.card-header.level2 a').hasClass('active')) {
            if ($('.card-header.level2 a.active').parents().parents('div.dropdown-content-2').prev().is(':first-child') && $('.card-header.level2 a.active').parents('div.level2').is(':first-child')) {
                $('.nav-link.prev').addClass('disable');
            }
            if ($('.card-header.level2 a.active').parents().parents('div.dropdown-content-2').is(':last-child') && $('.card-header.level2 a.active').parents('div.level2').is(':last-child'))  {
                $('.nav-link.next').addClass('disable');
            }
        }

        if(modType == 'forum' || modType == 'quiz') {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" width="100%" height="768" frameBorder="0"></iframe>';
        } else {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" onload="$(this).height($(this.contentWindow.document.body).find(\'#page-wrapper\').first().height());" width="100%" height="100%" frameBorder="0"></iframe>';
        }

        $('#mod-view-coursepage').html(iframe);

        // reload để resize height iframe
        $('#mod-iframe').on('load', function() {
            setTimeout(function() {
                try {
                    if(modType == 'resource' || modType == 'forum' || modType == 'hvp' || modType == 'quiz') {
                        var vh = $('body').height() - 77;
                        $('#mod-iframe').height(vh);
                    }
                    if(modType == 'quiz') {
                        var iframe = document.getElementById("mod-iframe");
                        var iframeModBody = iframe.contentWindow.document.querySelectorAll("body")[0]['id'];
                        if(iframeModBody.includes('page-mod-quiz-attempt') == true || iframeModBody.includes('page-mod-quiz-summary') == true || iframeModBody.includes('page-mod-quiz-review') == true) {
                            $('#header-quiz').removeAttr('style');
                            if($('#back-focusmod').length == 0) {
                                $('#header-main').attr('style', 'display: none!important');
                                var quizHeader = $('nav.focusmod').eq(0);
                                var quizName = $('div.dropdown-content-2 a.active').text();
                                var moduleId = $('div.dropdown-content-2 a.active').attr('module-id');
                                quizHeader.after('<nav class="fixed-top navbar moodle-has-zindex focusmod d-flex" id="header-quiz"><div class="loading-page"></div><span class="d-flex m-auto font-weight-bold" style="font-size:22px">'+quizName+'</span><span id="back-focusmod" class="cl-cursor" style="position: relative; right: 28px; background-color: #3c80bc; color: #fff; padding: 5px; border-radius: 15px;"><i class="fa fa-share" style="margin: 0 5px;position: relative;top: 1px;" aria-hidden="true"></i><span style="margin-right:5px">Quay lại</span></span></nav>');
                                $('#header-main .loading-page').removeClass('active');
                                $('#back-focusmod').bind('click', function(e) {
                                    $('div.dropdown-content-2 a[module-id="'+moduleId+'"]').trigger('click');
                                    $('#header-main').removeAttr('style');
                                    $('#header-quiz').attr('style', 'display: none!important');
                                });
                            }
                        } else {
                            $('#header-main').removeAttr('style');
                            if($('#header-quiz').length > 0) {
                                $('#header-quiz').attr('style', 'display: none!important');
                            }
                        }
                    }
                    $('#region-main .loading-page').removeClass('active');
                } catch (e) {
                    if (e.message.indexOf('Blocked a frame with origin') > -1 || e.message.indexOf('from accessing a cross-origin frame.') > -1) {
                        console.log('Same origin Iframe error found!!!');
                    }
                }
            }, 1000);

        });
        
    });

    // Repalce section không có tên
    Str.get_strings(strings).then(function(s) {
	    if ($('div.card-header.level1:first-child() a').text() == '') {
	        $('div.card-header.level1:first-child() a').append(s[0]);
	    }
	})

    if (!$('.card-header.level2 a').hasClass('active')) {
        $('.nav-link.prev, .nav-link.next').addClass('disable');
    }
    
    // function cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
});