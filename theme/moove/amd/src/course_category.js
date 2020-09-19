define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    $('.ajax-load').click(function() {
        $('.loading-page').addClass('active');
        $('li').removeClass('active');
        $(this).parents('li').addClass('active');
        var script = "/course/load_course.php";
        var category = $(this).attr('id');
        var settings = {
            type: "GET",
            processData: true,
            data: {
                id: category
            },
            contenttype: "application/json",
        }
        $.ajax(script, settings).then(function(response) {
            $('#load-course').hide().html(response).fadeIn('fast');
            $('.loading-page').removeClass('active')
        });
    });
    $('#courses_search_button').click(function() {
        $('.loading-page').addClass('active');
        var keyword = $('.courses_search_input[name="keyword"]').val().trim().split(' ').join('+');
        var teacher = $('.courses_search_input[name="teacher"]').val().trim().split(' ').join('+');
        var category = $('.courses_search_input[name="category"]').val().trim().split(' ').join('+');
        $('#load-course').load('/course/load_course.php?keyword=' + keyword + '&teacher=' + teacher + '&category=' + category, function() {
            $('.loading-page').removeClass('active');
        });
    })
    $('#load-course').load('/course/load_course.php');
    $('.list-category').click(function() {
        var idlist = $(this).attr('data');
        $('.list-category[data=' + idlist + '] i').toggleClass('active');
        $('.dropdown-menu-tree.' + idlist).slideToggle();
    })
    $('.list-subcategory').click(function() {
        var idlist = $(this).attr('id');
        $('.list-category#' + idlist).toggleClass('active');
        $('.dropdown-menu-tree.' + idlist).slideToggle();
    })
    $('.checkall').click(function() {
        $('input.usercheckbox').prop('checked', this.checked);
    })
});