define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification, alertify) {
    "use strict";
    $('#btn-menu').click(function() {
        $('.content-menu-expand').slideUp('fast');
        $('.click-menu-expand i').removeClass('active');
        $('body').toggleClass('slide-nav-toggle');
        $('.all-header .navbar-brand').toggleClass('d-none');
    })
    $('.fixed-sidebar-left').hover(function() {
        $('body').addClass('sidebar-hover');
        if($('.all-header .navbar-brand').hasClass('d-none')) {
            $('.all-header .navbar-brand').removeClass('d-none');
        }
    },function(){
        $('body').removeClass('sidebar-hover');
        if(!$('body').hasClass('slide-nav-toggle')) {
            $('.all-header .navbar-brand').addClass('d-none');
            $('.content-menu-expand').slideUp('fast');
            $('.click-menu-expand i').removeClass('active');
        }
    })
    $(".click-menu-expand").click(function() {
        var id = $(this).attr('id');
        $(".click-menu-expand#" + id + " i").toggleClass('active');
        $('.content-menu-expand.' + id).slideToggle('fast');
    })
    var path = window.location.href;
    $('.fixed-sidebar-left li.menu-link a').each(function() {
        if (this.href === path) {
            $(this).parent('li').addClass('active');
        }
    });
});