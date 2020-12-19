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
    $('.open-focusmod').bind('click', function() {
        var fm = getCookie('cookie');
        var action = $(this).attr('action');

        if (fm == "focusmod") {
            $('body').removeClass('focusmod');
            document.cookie = 'cookie=; max-Age=-1;path=/';
            $('.all-header,footer,#page-header').slideDown();
            $('#focus-mod i').removeClass('fa-compress');
            $('.navbar.focusmod').css('display', 'none');
            $('ul.course').css('display', 'flex');
            $('div#page-content').css('margin-top', '0px');
        } else {
            $('body').addClass('focusmod');
            if (!$('#sidepre-blocks').hasClass('closed')) {
                $('#sidepreopen-control').click();
            }
            $('footer,.all-header,#page-header').slideUp();
            $('#focus-mod i').addClass('fa-compress');
            $('.navbar.focusmod').css('display', 'flex');
            $('ul.course').css('display', 'none');
            $('#page-content').css('margin-top', '62px');
            setCookie('cookie', 'focusmod');
        }
    })
    $(window).resize(function() {
        var fm = getCookie('cookie')
        var width = $(window).width();
        if (width <= 950) {
            if (fm == "focusmod") {
                document.cookie = 'cookie=; max-Age=-1;path=/';
                location.reload();
            }
        }
    })
    $(".dropdown-content .card-header").click(function() {
        var id = $(this).attr("id");
        $(".card-header#" + id + " .rotate-icon").toggleClass('active');
        $(".dropdown-content-2." + id).slideToggle('fast', 'swing');
    })
    $(".nav-item.mid").click(function() {
        if ($('.dropdown-content').is(':empty')) {
            alert('Không có nội dung');
        } else {
            $('.dropdown-content').slideToggle('fast', 'linear');
        }
    });
    $('.card-header.level2 a').each(function() {
        if (this.href === path) {
            $(this).addClass('active');
            $(this).parents('div.dropdown-content-2').addClass('active');
            $('.mid .nav-link.focusmod').html($(this).text() + '<i class="fa fa-angle-down rotate-icon ml-2"></i>');
        }
    });
    $('.nav-link.prev').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div').prev();
        var href = temp.children('a').attr('href');
        $(this).attr('href', href);
    })
    $('.nav-link.next').click(function() {
        var temp = $('.card-header.level2 a.active').parents('div').next();
        var href = temp.children('a').attr('href');
        $(this).attr('href', href);
    })
    Str.get_strings(strings).then(function(s) {
	    if ($('div.card-header.level1:first-child() a').text() == '') {
	        $('div.card-header.level1:first-child() a').append(s[0]);
	    }
	})
    $('div.card-header.level1').each(function() {
        var idheader = $(this).attr('id');
        if ($('.dropdown-content-2.' + idheader).is(':empty')) {
            $(this).hide();
        }
    })
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