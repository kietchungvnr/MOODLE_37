define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    $("#page .click-expand").click(function() {
        var id = $(this).attr('id');
        $(".click-expand#" + id + " i").toggleClass('active');
        $('.content-expand.' + id).slideToggle();
    })
});