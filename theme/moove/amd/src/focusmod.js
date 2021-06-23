require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "//cdn.rawgit.com/vincepare/iframeTracker-jquery/master/dist/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "core/str", "core/notification", "theme_moove/handle_cookie", 'iframetracker','kendo.all.min'], function($, Config, Str, Notification, Cookie, iframetracker,kendo) {
    "use strict";
    var init = function() {
        var strings = [{
            key: 'general',
            component: 'theme_moove'
        }];

        // Click vào chế độ focus mode
        $('.open-focusmod').bind('click', function() {
            if($('body').hasClass('focusmod')) {
                Cookie.setCookie('cookie', 'focusmod');
            }
            var fm = Cookie.getCookie('cookie');
            var spa = Cookie.getCookie('spa');
            var course = $(this).attr('course');
            var width = $(window).width();
            if(spa == "true") {
                Cookie.setCookie('spa', '-1', 0)
            }
            
            if($('#mod-iframe').length <= 0) {
                $('#mod-view-coursepage').html('<div class="alert alert-success mb-0"><strong>'+ M.util.get_string('selectcoursedata', 'theme_moove') +'</strong></div>');
            }
            $('#setting-context').addClass('d-none');
            $('#sidepreopen-control').addClass('d-none');
            if (fm == "focusmod") {
                /// Hiện các element khi thoát chế độ focusmode
                $('body').removeClass('focusmod');
                $('body').removeAttr('style');
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
                if(width <= 576) {
                    $('.nav.multi-tab').slideDown();
                }
                Cookie.setCookie('cookie', '-1', 0)
            } else {
                /// Ẩn các element khi bật chế độ focusmode
                // $('body').attr('style','overflow:hidden !important');
                $('body').addClass('focusmod');
                $('footer,.all-header,#page-header').slideUp();
                $('.fixed-sidebar-left').addClass('d-none');
                $('#page-wrapper').css('margin-left', '0');
                $('.navbar.focusmod').addClass('d-flex');
                $('ul.course').addClass('d-none');
                $('#course-main-content').addClass('d-none');
                $('#mod-view-coursepage').removeClass('d-none');
                $('#page-content').attr('style', 'margin-left:0;margin-right:0');
                if(width <= 576) {
                    $('#region-main-box').attr('style', 'padding:0!important;margin-top:48px');    
                } else {
                    $('#region-main-box').attr('style', 'padding:0!important;margin-top:62px'); 
                }
                $('#page.container-fluid').attr('style', 'padding: 0!important');
                $('#setting-context').addClass('d-none');
                $('#sidepreopen-control').addClass('d-none');
                $('#sidepre-blocks').addClass('d-none');
                $('.nav.multi-tab').slideUp();
                Cookie.setCookie('cookie', 'focusmod');
            }
        })

        // Resize window
        $(window).resize(function() {
            var fm = Cookie.getCookie('cookie');
            var width = $(window).width();
            var height = $(window).height();
            var clone = $('#quiz-timer').clone();
            if (width <= 576 && fm == "focusmod") {
                $('.list-question-scroll').append(clone);
                $('.nav.multi-tab').slideUp();
                $('#region-main-box').attr('style', 'padding:0!important;margin-top:48px');
                $('iframe#mod-iframe').css('height',height);
            }
            else if (width > 576 && fm == "focusmod") {
                $('#quiz-timer').remove();
                $('#page-header').slideUp()
                $('#region-main-box').attr('style', 'padding:0!important;margin-top:62px');
                $('iframe#mod-iframe').css('height',height - 60);
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
        // Chỉ áp dụng khi có role là học viên trong 1 khóa
        if($('.tab-content [data-role=1]').length > 0) {
            $('.course-content li.activity a.aalink').bind('click', function(e) {
                e.preventDefault();
                if($('[data-isportal=true]').length > 0) {
                    Cookie.setCookieSecure('ebmlms', 'true');
                }
                var moduleId = $(this).parents('li').attr('id').split('-')[1];
                var element = "div.dropdown-content-2 a[module-id=" +moduleId+ "]";
                $('#focus-mod').trigger('click');
                $('#mod-view-coursepage').html('');
                setTimeout(function() {
                    $(element).trigger('click');
                    $(element).parents('div.dropdown-content-2').slideDown();
                }, 1000);
            })
        }
        
        // Click vào chọn bài học
        $('div.card-header.level2 a').click(function(e) {
            var _this = $(this);
            var url = _this.attr('data-focusmode-url');
            var modType = _this.attr('data-mod-type');
            var height = $(window).height();
            var width = $(window).width();
            Cookie.setCookie('cookie', 'focusmod');
            if($('body').hasClass('focusmod')) {
                Cookie.setCookie('cookie', 'focusmod');
            }
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
            if(width <= 576) {
                var isMobile = true
                var iframeheight = height;
            } else {
                var isMobile = false
                var iframeheight = height - 60;
            }
            if(modType == 'resource') {
                $('body').removeAttr('style');
                var iframe = '<iframe id="mod-iframe" src="'+url+'" height="768" frameBorder="0"></iframe>';
            } else if(modType == 'quiz') {
                var iframe = '<iframe id="mod-iframe" src="'+url+'" height="'+iframeheight+'" frameBorder="0"></iframe>';
                createSession(isMobile);
            } else if(modType == 'scorm') {
                iframeheight = iframeheight - 8;
                var iframe = '<iframe id="mod-iframe" src="'+url+'" height="'+iframeheight+'" width="100%" frameBorder="0"></iframe>';
            } else {
                $('body').removeAttr('style');
                var iframe = '<iframe id="mod-iframe" src="'+url+'" frameBorder="0"></iframe>';
            }
            
            $('#mod-view-coursepage').html(iframe);

            // reload để resize height iframe
            $('#mod-iframe').on('load', function() {
                $('.dropdown-content').attr('style', 'display: none');
                setTimeout(function() {
                    try {
                        if(modType == 'resource') {
                            var vh = $('body').height();
                            $('#mod-iframe').height(vh);
                        } else if (modType == 'quiz') {
                            var width = $(window).width();
                            if(width > 576) {
                                $('#mod-iframe').removeAttr('height');
                                const iframes = iFrameResize({ log: true }, '#mod-iframe');
                            } 
                        } else if(modType == 'scorm') {
                            // Nothing todo...
                        } else {
                            const iframes = iFrameResize({ log: true }, '#mod-iframe');
                        }
                        // Xử lý khi module là quiz thì thay đổi header
                        if(modType == 'quiz') {
                            var iframe = document.getElementById("mod-iframe");
                            var width = $(window).width();
                            var iframeModBody = iframe.contentWindow.document.querySelectorAll("body")[0]['id'];
                            if((iframeModBody.includes('page-mod-quiz-attempt') == true || iframeModBody.includes('page-mod-quiz-summary') == true || iframeModBody.includes('page-mod-quiz-review') == true))  {
                                $('.header-quiz').removeAttr('style');
                                if($('.back-quiz').length == 0) {
                                    var quizHeader = $('nav.focusmod').eq(0);
                                    var quizName = $('div.dropdown-content-2 a.active').text();
                                    var moduleId = $('div.dropdown-content-2 a.active').attr('module-id');
                                    // if(width > 576) {
                                        quizHeader.after('<nav class="fixed-top navbar moodle-has-zindex focusmod d-flex header-quiz d-none-mb" id="header-quiz"><div class="loading-page"></div><span class="d-flex m-auto font-weight-bold" style="font-size:22px">'+quizName+'</span><span class="back-focusmod-desktop back-quiz"  class="cl-cursor"><i class="fa fa-share" style="margin: 0 5px;position: relative;top: 1px;" aria-hidden="true"></i><span style="margin-right:5px">Quay lại</span></span></nav>');
                                    // } else {
                                        var html = '<div class="d-flex menu-left">'
                                            html += '<div class="course-info-focus">'
                                            html += '<div class="icon-back-focusmod back-quiz" ><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i></div>'
                                            html += '<div class="page-header-headings"><a>'+quizName+'</a></div>'
                                            html += '</div>'
                                            html += '</div>'
                                        quizHeader.after('<nav class="fixed-top navbar moodle-has-zindex focusmod d-flex header-quiz d-flex-mb" id="header-quiz"><div class="loading-page"></div>'+html+'</nav>');
                                    // }
                                    $('#header-main .loading-page').removeClass('active');
                                    $('.back-quiz').bind('click', function(e) {
                                        $('div.dropdown-content-2 a[module-id="'+moduleId+'"]').trigger('click');
                                        $('#header-main').removeAttr('style');
                                        $('.header-quiz').attr('style', 'display: none!important');
                                    });
                                }
                            }    
                            else {
                                $('#header-main').removeAttr('style');
                                if($('.header-quiz').length > 0) {
                                    $('.header-quiz').attr('style', 'display: none!important');
                                }
                            }
                        }
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
        // Nút thoát focusmod mobile 
        $('.back-focusmod').click(function() {
            $('#focus-mod').click();
        })
        // Hàm tạo session 
        function createSession(devicemobile) {
            var settings = {
                    contenttype: "application/json",
                    type:"GET",
                    processData:true,
                    data: {
                        devicemobile:devicemobile
                    }
                }
            var script = Config.wwwroot + '/local/newsvnr/ajax/session.php'  
            $.ajax(script,settings).then(function(){})
        }
    }
    return {
        init:init
    }
    
});
