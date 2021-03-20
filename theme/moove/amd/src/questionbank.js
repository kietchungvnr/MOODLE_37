define(["jquery", "core/config", "core/str", "core/notification"], function($, Config, Str, Notification, alertify) {
    "use strict";
    var init = function() {
        // question category
        if($('div.add-question-bank').length != 0) {
            var form = $('#page-question-category .card .card-body form');
            var clone = form.clone();
            form.remove();
            $('#page-question-category .modal-body').append(clone);
            $('.add-question-bank').click(function() {
                $('.createnewquestion .singlebutton button').trigger('click');
            })
        }
    }
    return {
        init: init
    }
});