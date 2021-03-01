require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "//cdn.rawgit.com/vincepare/iframeTracker-jquery/master/dist/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "core/str", "core/notification", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Str, Notification, Cookie, iframetracker) {
    "use strict";
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
            document.cookie = 'spa=; max-Age=-1;path=/';
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
            document.cookie = 'cookie=; max-Age=-1;path=/';
        } else {
            /// Ẩn các element khi bật chế độ focusmode
            $('body').attr('style','overflow:hidden !important');
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

    // Resize windown nếu nhỏ hơn 1050 thì bỏ chức năng focus
    $(window).resize(function() {
        var fm = Cookie.getCookie('cookie')
        var width = $(window).width();
        if (width <= 576 && fm == "focusmod") {
            $('.nav.multi-tab').slideUp();
        }
        if (width > 576 && fm == "focusmod") {
            $('.page-header').slideUp()
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
    var getBaseUrl = Cookie.getCookie('baseUrl');
    if(getBaseUrl.includes('course/view.php?id=')) {
        $('.course-content li.activity a.aalink').bind('click', function(e) {
            e.preventDefault();
            console.log("clicked")
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
        var height = $(window).height()
        if($('body').hasClass('focusmod')) {
            Cookie.setCookie('cookie', 'focusmod');
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

        if(modType == 'resource') {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" height="768" frameBorder="0"></iframe>';
        } else if(modType == 'quiz') {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" height="'+height+'" frameBorder="0"></iframe>';
        } else {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" frameBorder="0"></iframe>';
        }
        
        $('#mod-view-coursepage').html(iframe);

        // reload để resize height iframe
        $('#mod-iframe').on('load', function() {
            $('.dropdown-content').attr('style', 'display: none');
            setTimeout(function() {
                try {
                    // $('#mod-iframe').iframeTracker({
                    //     blurCallback: function(event) {
                    //         console.log(1)
                    //         Cookie.setCookie('cookie', 'focusmod');
                    //     },
                    //     outCallback: function(element, event) {
                    //         console.log(2)
                    //         this._overId = null; // Reset hover iframe wrapper i
                    //         document.cookie = 'cookie=; max-Age=-1;path=/';
                    //     },
                    //     _overId: null
                    // });
                    if(modType == 'resource' || modType == 'quiz') {
                        var vh = $('body').height();
                        $('#mod-iframe').height(vh);
                    } else {
                        const iframes = iFrameResize({ log: false }, '#mod-iframe');
                    }
                    if(modType == 'quiz') {
                        var iframe = document.getElementById("mod-iframe");
                        $("#mod-iframe").removeAttr('style')
                        var width = $(window).width();
                        var iframeModBody = iframe.contentWindow.document.querySelectorAll("body")[0]['id'];
                        if((iframeModBody.includes('page-mod-quiz-attempt') == true || iframeModBody.includes('page-mod-quiz-summary') == true || iframeModBody.includes('page-mod-quiz-review') == true))  {
                            $('#header-quiz').removeAttr('style');
                            if($('#back-focusmod').length == 0) {
                                var quizHeader = $('nav.focusmod').eq(0);
                                var quizName = $('div.dropdown-content-2 a.active').text();
                                var moduleId = $('div.dropdown-content-2 a.active').attr('module-id');
                                if(width > 576) {
                                    quizHeader.after('<nav class="fixed-top navbar moodle-has-zindex focusmod d-flex" id="header-quiz"><div class="loading-page"></div><span class="d-flex m-auto font-weight-bold" style="font-size:22px">'+quizName+'</span><span class="back-focusmod-desktop" id="back-focusmod" class="cl-cursor"><i class="fa fa-share" style="margin: 0 5px;position: relative;top: 1px;" aria-hidden="true"></i><span style="margin-right:5px">Quay lại</span></span></nav>');
                                } else {
                                    var html = '<div class="d-flex menu-left">'
                                        html += '<div class="course-info-focus">'
                                        html += '<div class="icon-back-focusmod" id="back-focusmod"><i class="fa fa-chevron-left mr-1" aria-hidden="true"></i></div>'
                                        html += '<div class="page-header-headings"><a>'+quizName+'</a></div>'
                                        html += '</div>'
                                        html += '</div>'
                                    quizHeader.after('<nav class="fixed-top navbar moodle-has-zindex focusmod d-flex" id="header-quiz"><div class="loading-page"></div>'+html+'</nav>');
                                }
                                $('#header-main .loading-page').removeClass('active');
                                $('#back-focusmod').bind('click', function(e) {
                                    $('body').removeAttr('style');
                                    $('div.dropdown-content-2 a[module-id="'+moduleId+'"]').trigger('click');
                                    $('#header-main').removeAttr('style');
                                    $('#header-quiz').attr('style', 'display: none!important');
                                });
                            }
                        }    
                        else {
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
    // Nút thoát focusmod mobile 
    $('.back-focusmod').click(function() {
        $('#focus-mod').click();
    })

});
