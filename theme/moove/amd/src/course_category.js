define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification) {
    "use strict";
    var init = function() {
        $('.ajax-load').click(function() {
            $('.loading-page').addClass('active');
            $('li').removeClass('active');
            $('.courses_search_input').val('');
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
            var filter = $("#course-filter :selected").val();
            $('li').removeClass('active');
            $('.dropdown-menu-tree').slideUp();
            $('#load-course').load('/course/load_course.php?keyword=' + keyword + '&teacher=' + teacher + '&category=' + category + '&filter=' + filter, function() {
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
        $("#course-filter").bind('change', function() {
            $('.loading-page').addClass('active');
            $('.courses_search_input').val('');
            var filter = $(this).val();
            var script = "/course/load_course.php";
            var settings = {
                type: "GET",
                processData: true,
                data: {
                    filter: filter
                },
                contenttype: "application/json"
            }
            $.ajax(script, settings).then(function(response) {
                $('li').removeClass('active');
                $('.dropdown-menu-tree').slideUp();
                $('#load-course').hide().html(response).fadeIn('fast');
                $('.loading-page').removeClass('active');
            })
        });
        var map = {};
        $('#course-filter option').each(function() {
            if (map[this.value]) {
                $(this).remove();
            }
            map[this.value] = true;
        })
        $('li.list-category').each(function() {
            if ($(this).parent('.dropdown-menu-tree').length) {
                $(this).css('background', 'transparent')
            }
        })
    }
    return {
        init:init
    }
});