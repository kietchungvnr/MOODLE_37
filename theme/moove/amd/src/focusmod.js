define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var strings = [{
        key: 'general',
        component: 'theme_moove'
    }];
   
    var path = window.location.href;

    $(document).ready(function() {
        if (path.indexOf('course/view/') > 0) {
            $('#sidepreopen-control').click();
        }
    })

    // Khỉ reload trang course view thì kiểm tra xem có chế độ focus đang được bật hay ko
    // Nếu có thì bỏ chế độ focus
    var checkFm = getCookie('cookie');
    if(checkFm == "focusmod") {
        document.cookie = 'cookie=; max-Age=-1;path=/';
        var courseId = $('#focus-mod').attr('course');
        window.location.replace(Config.wwwroot + '/course/view.php?id='+courseId);
    }

    // Click vào chế độ focus mode
    $('.open-focusmod').bind('click', function() {
        var fm = getCookie('cookie');
        var course = $(this).attr('course');
        Str.get_string('selectcoursedata', 'theme_moove').then(function(s) {
            $('[role="main"]').html('<div class="alert alert-success mb-0"><strong>'+s+'</strong></div>');
        })
        $('#region-main').css('margin-top', '20px');
        $('#setting-context').removeClass('d-none');
        $('#sidepreopen-control').removeClass('d-none');
        if (fm == "focusmod") {
            $('body').removeClass('focusmod');
            window.location.replace(Config.wwwroot + '/course/view.php?id='+course);
            document.cookie = 'cookie=; max-Age=-1;path=/';
        } else {
            $('body').addClass('focusmod');
            if (!$('#sidepre-blocks').hasClass('closed')) {
                $('#sidepreopen-control').click();
            }
            $('footer,.all-header,#page-header').slideUp();
            $('.navbar.focusmod').css('display', 'flex');
            $('ul.course').css('display', 'none');
            $('#page-content').css('margin-top', '62px');
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
    $(".dropdown-content .card-header").click(function() {
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

    // Đổi coursedata dựa vào lần chọn bài học
    $('.card-header.level2 a').each(function() {
        var currentPath = $(this).attr('data-focusmode-url');
        if (currentPath === path) {
            $(this).addClass('active');
            $(this).parents('div.dropdown-content-2').addClass('active');
            $('.mid .nav-link.focusmod').html($(this).text() + '<i class="fa fa-angle-down rotate-icon ml-2"></i>');
        }
    });

    // Lùi bài học
    $('.nav-link.prev').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div').prev();
        var href = temp.children('a').attr('href');
        $(this).attr('href', href);
    })

    // Tới bài học tiếp theo
    $('.nav-link.next').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div').next();
        var href = temp.children('a').attr('href');
        $(this).attr('href', href);
    })

    // Click vào chọn bài học
    $('[data-focusmode-url]').click(function(e) {
        var _this = $(this);
        var url = _this.attr('data-focusmode-url');
        var modType = _this.attr('data-mod-type');

        $('[role=main]').addClass('d-none');
        $('#course-content').addClass('d-none');
        $('#region-main .loading-page').addClass('active');
        $('#page-content').attr('style', 'margin-left:0;margin-right:0');
        $('#region-main-box').attr('style', 'padding:0!important;margin-top:40px');
        $('#page.container-fluid').attr('style', 'padding: 0!important');
        $('#setting-context').addClass('d-none');
        $('#sidepreopen-control').addClass('d-none');
        $('#sidepre-blocks').addClass('d-none');

        if(modType == 'forum') {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" width="100%" height="768" frameBorder="0"></iframe>';
        } else {
            var iframe = '<iframe id="mod-iframe" src="'+url+'" onload="$(this).height($(this.contentWindow.document.body).find(\'#page-wrapper\').first().height());" width="100%" height="100%" frameBorder="0"></iframe>';
        }

        $('#mod-view').html(iframe);

        // reload để resize height iframe
        $('#mod-iframe').on('load', function() {
            setTimeout(function() {
                try {
                    if(modType == 'resource' || modType == 'forum') {
                        var vh = $('body').height() - 77;
                        $('#mod-iframe').height(vh);
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

    // Nếu trong section không có content thì bị ẩn đi
    $('div.card-header.level1').each(function() {
        var idheader = $(this).attr('id');
        if ($('.dropdown-content-2.' + idheader).is(':empty')) {
            $(this).hide();
        }
    })

    // Kiểm tra ngoại lệ tiến lùi trong màn hình khóa học
    if ($('.card-header.level2 a').hasClass('active')) {
        if ($('.card-header.level2 a.active').parents('div.level2').is(':first-child')) {
            $('.nav-link.prev').addClass('disable');
        }
        if ($('.card-header.level2 a.active').parents('div.level2').is(':last-child')) {
            $('.nav-link.next').addClass('disable');
        }
    } else {
        $('.nav-link.next,.nav-link.prev').addClass('disable');
    }

    $('.card-header.level2 a').each(function() {
        if ($(this).attr('href').indexOf('/mod/url/') > 0) {
            $(this).attr('target', '_blank');
        }
    })
    
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