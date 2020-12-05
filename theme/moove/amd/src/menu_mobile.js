define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var path = window.location.href;
    $('.grade-navigation ul:first').removeClass('mb-3');
    if (path.indexOf('mod/quiz/') > 0) {
        $('.m-t-2.m-b-1.row').css({
            'display': 'none'
        });
    }
    $('.toolbar ul li a').each(function() {
        if (this.href === path) {
            $(this).addClass('active');
        }
    });
    if ($('.pagelayout-course .summary').find('.no-overflow') > 0) {} else {
        $('.pagelayout-course .summary').css('display', 'none');
    }
});