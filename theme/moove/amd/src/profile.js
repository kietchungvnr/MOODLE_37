define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification, alertify) {
    "use strict";
    var init = function() {
        var scriptprofile = Config.wwwroot + '/local/newsvnr/ajax/profile/profile.php';
        var url = new URL(window.location.href);
        var userid = url.searchParams.get("id");
        $.getJSON(scriptprofile+'?userid='+userid,function(data) {
            $('#load-forumpost').hide().html(data.result).fadeIn('fast');
            $('#pagination').replaceWith(data.pagination);
        })
        var new_width = $('.profile-width').width();
        $('.user-card.profile').width(new_width + 10); 
        $(window).resize(function() {
            var new_width = $('.profile-width').width();
            $('.user-card.profile').width(new_width + 10); 
        });
    }
    return {
        init: init
    }
});