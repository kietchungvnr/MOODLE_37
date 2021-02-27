define(["jquery", "core/config", "core/str", "core/notification", "theme_moove/handle_cookie"], function($, Config, Str, Notification, Cookie) {
    "use strict";
    $('#btn-menu').click(function() {
        var ck = Cookie.getCookie('menu');
        $('.content-menu-expand').slideUp('fast');
        $('.click-menu-expand i').removeClass('active');
        $('.check-menu').toggleClass('slide-nav-toggle');
        $('.all-header .navbar-brand').toggleClass('d-none');
        $('#page-wrapper').toggleClass('slide-nav-toggle');
        if($('.check-menu').hasClass('slide-nav-toggle')) {
            $('#btn-menu i').removeClass('fa-align-right').addClass('fa-align-left');
            Cookie.setCookie('menu', 'openmenu');
        } else {
            $('#btn-menu i').removeClass('fa-align-left').addClass('fa-align-right');
            document.Cookie = 'menu=; max-Age=-1;path=/';
        }
    })
    $('.fixed-sidebar-left').hover(function() {
        $('.check-menu').addClass('sidebar-hover');
        if($('.all-header .navbar-brand').hasClass('d-none')) {
            $('.all-header .navbar-brand').removeClass('d-none');
        }
    },function(){
        $('.check-menu').removeClass('sidebar-hover');
        if(!$('.check-menu').hasClass('slide-nav-toggle')) {
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
    $(".nav.multi-tab").on('click','li a',function() {
        var tab = $(this).parent().parent('ul').attr('tab');
        var data = $(this).attr('data-key');
        $(".nav.multi-tab[tab="+tab+"] li a").removeClass('active');
        $(this).addClass('active');
        $('.tab-content[tab='+tab+'] .tab-pane').hide();
        $('.tab-content[tab='+tab+'] .tab-pane[data="' + data + '"]').show();
    });
    $(".search_form_fp i").click(function(){
        var keyword = $('#course_search_form_fp').val();
        var linksearch = Config.wwwroot + '/course/search.php?search=' + keyword ;
        window.location.replace(linksearch);
    })
    $('#course_search_form_fp').keypress(function(e) {
        if (event.which == 13) {
            $(".search_form_fp i").click();
        }
    })
});