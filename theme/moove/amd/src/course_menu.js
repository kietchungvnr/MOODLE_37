define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var strings = [{
        key: 'courseoverview',
        component: 'theme_moove'
    }];
    var path = window.location.href;
    $('.nav-tabs.course li a').each(function() {
        if (this.href === path) {
            $(this).parent().addClass('active');
        }
        if (this.href.indexOf('badge') > 0 && path.indexOf('badge') > 0) {
            $(this).parent().addClass('active');
        }
    })
    if (path.indexOf('mod') > 0 || path.indexOf('backup') > 0 || path.indexOf('enrol') > 0) {
        $('#nav-drawer').remove();
    }
    if ($('.nav-tabs.course li:not(:first-child)').hasClass('active')) {
        $('.nav-tabs.course li:first').removeClass('active');
    } else {
        if ($('.nav-tabs.course li:first').hasClass('active')) {} else {
            $('.nav-tabs.course li:first').addClass('active');
        }
    }
    Str.get_strings(strings).then(function(s) {
        $('.nav-tabs.course li:first a').html(s[0]);
    })
    $('.nav-tabs.course li[data-key="sitesettings"]').css({
        'display': 'none'
    });
    $('.nav-tabs.course li[data-key="addblock"]').css({
        'display': 'none'
    });
    $('#page-course-view-topcoll #toggles-all-opened').click(function() {
        $(this).addClass('d-none');
        $('#page-course-view-topcoll .sectionhead.toggle .reportmodule i').addClass('active');
        $('#page-course-view-topcoll #toggles-all-closed').removeClass('d-none');
        $('#page-course-view-topcoll #toggles-all-closed').fadeIn('fast');
    })
    $('#page-course-view-topcoll #toggles-all-closed').click(function() {
        $(this).addClass('d-none');
        $('#page-course-view-topcoll .sectionhead.toggle .reportmodule i').removeClass('active');
        $('#page-course-view-topcoll #toggles-all-opened').removeClass('d-none');
        $('#page-course-view-topcoll #toggles-all-opened').fadeIn('fast');
    })
    $('.format-topcoll .sectionhead span.the_toggle').click(function() {
        $(this).parent('.sectionhead').toggleClass('active');
        if($(this).hasClass('toggle_closed')) {
            $(this).children('.icon-opensection-mb').children('img').attr('src',Config.wwwroot + '/theme/moove/pix/close.png');
        } else {
            $(this).children('.icon-opensection-mb').children('img').attr('src',Config.wwwroot + '/theme/moove/pix/open.png');
        }
        $(this).closest('div.content').prev().prev().toggleClass('left-before');
    })
    $(window).resize(function() {
        var width = $(window).width();
        if(width > 576) {
            $('.nav-tabs.multi-tab li:first-child a').click();
        }
        if(width <= 576 && $('body.format-topcoll').hasClass('editing')) {
            $('#page-header .btn.btn-primary').click();
        }
    })
    
});