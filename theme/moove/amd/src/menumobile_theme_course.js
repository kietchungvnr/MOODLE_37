define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var size_li = $(".course-content .nav-tabs li").length;
    $(window).resize(function() {
        var width = $(window).width();
        if (width <= 768) {
            $('.menu-show').append($('.course-content .nav-tabs li:lt(' + size_li + ')'));
            var active_mb = $('div.menu-show li a.active').attr('title');
            $('.first').html("<i class='fa fa-folder' aria-hidden='true'></i>" + active_mb + "<i class='fa fa-caret-down' aria-hidden='true'></i>");
        } else {
            $(".course-content .nav-tabs").load(location.href + " .course-content .nav-tabs");
        }
    })
    if (window.matchMedia('(max-width: 768px)').matches) {
        $('.menu-show').append($('.course-content .nav-tabs li:lt(' + size_li + ')'))
        var active_mb = $('div.menu-show li a.active').attr('title');
        $('.first').html("<i class='fa fa-folder' aria-hidden='true'></i>" + active_mb + "<i class='fa fa-caret-down' aria-hidden='true'></i>");
    }
    $(".nav-item.load-more").click(function() {
        if ($('.menu-show:visible').length) $('.menu-show').hide();
        else $('.menu-show').show();
    });
    $("<div class='arrow-next'><i class='fa fa-angle-right'style='font-size:23px'></i></div>").insertBefore('#nav-drawer');
    $("<div class='arrow-prev'><i class='fa fa-angle-left'style='font-size:23px'></i></div>").insertBefore('#nav-drawer');
    $('.arrow-next').click(function(event) {
        var pos = $('#nav-drawer').scrollLeft() + 300;
        $('#nav-drawer').animate({
            scrollLeft: pos
        }, 400);
    });
    $('.arrow-prev').click(function(event) {
        var pos = $('#nav-drawer').scrollLeft() - 300;
        $('#nav-drawer').animate({
            scrollLeft: pos
        }, 400);
    });
    $('#nav-drawer').scroll(function() {
        var $elem = $('#nav-drawer');
        var newScrollLeft = $elem.scrollLeft(),
            width = $elem.outerWidth(),
            scrollWidth = $elem.get(0).scrollWidth;
        if (scrollWidth - newScrollLeft == Math.round(width)) {
            $('.arrow-next').css({
                'display': 'none'
            });
        } else {
            $('.arrow-next').css({
                'display': 'block'
            });
        }
        if (newScrollLeft > 0) {
            $('.arrow-prev').css({
                'display': 'block'
            });
        } else {
            $('.arrow-prev').css({
                'display': 'none'
            });
        }
    });
});