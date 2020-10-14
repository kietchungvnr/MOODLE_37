define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    $(".nav.tab-click li a").click(function() {
        var id = $(this).attr('id');
        $(".nav.tab-click li").removeClass('active');
        $(this).parent('li').addClass('active');
        $('.tab-pane').hide();
        $('.tab-pane#tab' + id).fadeIn('fast');
    });
    $(".click-expand").click(function() {
        var id = $(this).attr('id');
        $(".click-expand#" + id + " i").toggleClass('active');
        $('.content-expand.' + id).slideToggle();
    })
});