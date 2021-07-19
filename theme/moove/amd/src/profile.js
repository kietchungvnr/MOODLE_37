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
            var w = window.innerWidth;
            var new_width = $('.profile-width').width();
            if(w <= 767) {
                $('.user-card.profile').removeClass('position-fixed');
            }
            $('.user-card.profile').width(new_width + 10); 
        });
        var w = window.innerWidth;
        if(w <= 767) {
            $('.user-card.profile').removeClass('position-fixed');
        }
        $('#btn-menu').click(function() {
            var w = window.innerWidth;
            var user_width = $('.user-card.profile').width();
            if(w > 1000) {
                if($('.check-menu').hasClass('slide-nav-toggle')) {
                    $('.user-card.profile').width(user_width + 44);
                } else {
                    $('.user-card.profile').width(user_width - 44); 
                }
            }
        })
        $(window).scroll(function(){
            var card = $('#profile-fix');
            if($(window).scrollTop() > 287) {
                card.css({
                    position: 'absolute',
                    top: 287
                })
            } else {
                card.css({
                    position: 'fixed',
                    top: 72
                });
            }
        })
    }
    return {
        init: init
    }
});