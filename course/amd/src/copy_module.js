// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This module provides the course copy module from the course to another course
 *
 * @module     course
 * @package    core
 * @copyright  VnR
 * @author     LeThanhVu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since      3.9
 */

define(['jquery', 'core/str', 'core/modal_factory', 'core/modal_events',
        'core/ajax', 'core/fragment', 'core/notification', 'core/config', 'core/templates'],
        function($, Str, ModalFactory, ModalEvents, ajax, Fragment, Notification, Config, Templates) {

    var spinner = '<p class="text-center">'
        + '<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>'
        + '</p>';
  
    function customPlaceholder(draggedItem) {
        return draggedItem
                .clone()
                .addClass("custom-placeholder")
                .removeClass("k-ghost");
    }

    function progress_bar_process(percentage, timer, data) {
        $('#process .progress-bar').css('width', percentage + '%');
        if (percentage > 100) {
            clearInterval(timer);
            $('#process').css('display', 'none');
            $('#process .progress-bar').css('width', '0%');
            {{! $('#save').attr('disabled', false); }}
            $('#hanlde_message').html("<div class='alert alert-success mt-3'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + data.success + "</div>");
            setTimeout(function() {
                $('#hanlde_message').html('');
            }, 5000);
        }
    }
    var initTemplateJs = function(templateData) {
        $(document).ready(function () {
            var script = Config.wwwroot + '/course/ajax/copy_module.php';

            // Xử lý progess step
            var base_color = "rgb(230,230,230)";
            var active_color = "rgb(45, 91, 124)";

            var child = 1;
            var length = $("#coppy-modules section").length;
            $("#coppy-modules #prev").addClass("disabled");
            $("#coppy-modules #submit").addClass("disabled");

            $("#coppy-modules section").not("section:nth-of-type(1)").hide();
            $("#coppy-modules section").not("section:nth-of-type(1)").css("transform", "translateX(100px)");

            var svgWidth = length * 200 + 24;
            $("#coppy-modules #svg_wrap").html('<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' + svgWidth + ' 24" xml:space="preserve"></svg>');

            function makeSVG(tag, attrs) {
                var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
                for (var k in attrs) el.setAttribute(k, attrs[k]);
                return el;
            }
            for (i = 0; i < length; i++) {
                var positionX = 12 + i * 200;
                var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
                document.getElementById("svg_form_time").appendChild(rect);
                // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
                var circle = makeSVG("circle", {
                    cx: positionX,
                    cy: 12,
                    r: 12,
                    width: positionX,
                    height: 6,
                });
                document.getElementById("svg_form_time").appendChild(circle);
            }

            var circle = makeSVG("circle", {
                cx: positionX + 200,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6,
            });
            document.getElementById("svg_form_time").appendChild(circle);

            $("#coppy-modules #svg_form_time rect").css("fill", base_color);
            $("#coppy-modules #svg_form_time circle").css("fill", base_color);
            $("#coppy-modules circle:nth-of-type(1)").css("fill", active_color);

            $("#coppy-modules .button").click(function () {
                $("#coppy-modules #svg_form_time rect").css("fill", active_color);
                $("#coppy-modules #svg_form_time circle").css("fill", active_color);
                var id = $(this).attr("id");
                if (id == "next") {
                    $("#coppy-modules #prev").removeClass("disabled");
                    if (child >= length) {
                        $(this).addClass("disabled");
                        $("#coppy-modules #submit").removeClass("disabled");
                    }
                    if (child <= length) {
                        child++;
                    }
                } else if (id == "prev") {
                    $("#coppy-modules #next").removeClass("disabled");
                    $("#coppy-modules #submit").addClass("disabled");
                    if (child <= 2) {
                        $(this).addClass("disabled");
                    }
                    if (child > 1) {
                        child--;
                    }
                }
                var circle_child = child + 1;
                $("#coppy-modules #svg_form_time rect:nth-of-type(n + " + child + ")").css("fill", base_color);
                $("#coppy-modules #svg_form_time circle:nth-of-type(n + " + circle_child + ")").css("fill", base_color);
                var currentSection = $("#coppy-modules section:nth-of-type(" + child + ")");
                currentSection.fadeIn();
                currentSection.css("transform", "translateX(0)");
                currentSection.prevAll("section").css("transform", "translateX(-100px)");
                currentSection.nextAll("section").css("transform", "translateX(100px)");
                $("#coppy-modules section").not(currentSection).hide();
            });


            var customerTemplate = '<div class="mt-1">' + '#= data.module_icon #' + '#: data.name #' + '</div>';
            // Lấy danh sách module của khóa học hiện tại
            $("#copy-module-optional").kendoListBox({
                selectable: "multiple",
                dataTextField: "name",
                dataValueField: "value",
                template: customerTemplate,
                dataSource: {
                    transport: {
                        read: {
                            type: "GET",
                            processData: true,
                            dataType: "json",
                            contenttype: "application/json",
                            url: script,
                            data: {
                                action : "list_module",
                                courseid : templateData.courseid
                            }
                        }
                    }
                },
                draggable: { placeholder: customPlaceholder },
                dropSources: ["copy-module-selected"],
                connectWith: "copy-module-selected",
                toolbar: {
                    position: "right",
                    tools: ["transferTo", "transferFrom", "transferAllFrom", "transferAllTo"]
                },
                messages: {
                    tools: {
                        moveUp: "Promote",
                        moveDown: "Demote",
                        remove: "Remove Employee",
                        transferTo: "Transfer To",
                        transferFrom: "Transfer From",
                        transferAllTo: "Transfer All To",
                        transferAllFrom: "Transfer All From"
                    }
                }
            });
            // Lấy danh sách module của khóa học hiện tại
            $("#copy-module-selected").kendoListBox({
                selectable: "multiple",
                dataTextField: "name",
                dataValueField: "value",
                template: customerTemplate,
                draggable: { placeholder: customPlaceholder },
                dropSources: ["copy-module-optional"],
                connectWith: "copy-module-optional"
            });

            // Lấy danh sách khóa học theo user login
            Str.get_string('selectcourse', 'theme_moove').then(function(placeholder) {
                $('#list_course').kendoMultiSelect({
                    placeholder: placeholder + "...",
                    dataTextField: "name",
                    dataValueField: "value",
                    dataSource: {
                        transport: {
                            read: {
                                type: "GET",
                                processData: true,
                                dataType: "json",
                                contenttype: "application/json",
                                url: script,
                                data: {
                                    action : "list_course",
                                    userid : templateData.userid
                                }
                            },
                            parameterMap: function(options, operation) {
                                if (operation == "read") {
                                    if (options["filter"]) {
                                        if (options["filter"]["filters"][0])
                                            options["q"] = options["filter"]["filters"][0].value;
                                    }
                                    return options;
                                }
                            }
                        },
                        schema: {
                            model: {
                                fields: {
                                    coursid: {
                                        type: "number"
                                    },
                                    coursename: {
                                        type: "string"
                                    },
                                }
                            }
                        },
                        pageSize: 30,
                        serverPaging: true,
                        serverFiltering: true
                    },
                });
            });
            // Xử lý khi nhấn copy submit
            $('#submit').click(function(e) {
                e.preventDefault();
                var error = [];
                var listModuleKendo = $('#copy-module-selected').data("kendoListBox");
                var listCourseKendo = $('#list_course').data("kendoMultiSelect");
                var listModule = listModuleKendo.dataItems();
                listModule = $.map(listModule, function(module, index) {
                    return module.value;
                });
                var strListModule = listModule.join(",");
                var strListCourse = listCourseKendo.value().toString();
                var strings = [
                    {
                        key: 'courserequired',
                        component: 'theme_moove'
                    },
                    {
                        key: 'modulerequired',
                        component: 'theme_moove'
                    },
                    {
                        key: 'copyingdata',
                        component: 'theme_moove'
                    }
                ];
                Str.get_strings(strings).then(function(s) {
                    $('#hanlde_message').html('');
                    if(strListCourse == '') {
                        error.push('course');
                        $('#hanlde_message').append("<div class='alert alert-warning mt-3'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + s[0] + "</div>");

                    }
                    if(strListModule == '') {
                        error.push('module');
                        $('#hanlde_message').append("<div class='alert alert-warning mt-3'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + s[1] + "</div>");
                    }
                    if(error.length > 0) {
                        setTimeout(function() {
                            $('#hanlde_message').html('');
                        }, 5000)
                        return 0;
                    } else {
                        $('#hanlde_message').html("<div class='alert alert-success mt-3'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + s[2] + "</div>");
                    }
                    $.ajax({
                        type: "GET",
                        processData: true,
                        dataType: "json",
                        contenttype: "application/json",
                        url: script,
                        data: {
                            action : "copy_module",
                            listmodule : strListModule,
                            listcourse : strListCourse,
                        },
                        beforeSend:function() {
                            $('#process').css('display', 'block');
                        },
                        success:function(data) {
                            var percentage = 0;
                            listCourseKendo.value([]);
                            var timer = setInterval(function(){
                                percentage = percentage + 20;
                                progress_bar_process(percentage, timer, data);
                            }, 1000);
                        }
                    });
                });
            })
        }); 
    }
    /**
     * Creates the modal for the module copy form
     *
     * @private
     */
    function createModal(templateData) {
        // Get the Title String.
        Str.get_string('copymodule', 'theme_moove').then(function(title) {
            // Create the Modal.
            ModalFactory.create({
                type: ModalFactory.types.DEFAULT,
                title: title,
                body: spinner,
                large: true
            })
            .done(function(modal) {
                var root = modal.getRoot();
                root.on(ModalEvents.hidden, function() {
                    root.remove();
                }.bind(this));
                Templates.render('core_course/copy_module', templateData).done(function(html, js) {
                    modal.setBody(html);
                    Templates.runTemplateJS(js);  
                });
                modal.show();
            });
            return;
        }).catch(function() {
            Notification.exception(new Error('Failed to load string: loading'));
        });
    }

    var init = function(courseId, userId) {
        var templateData = {
            courseid : courseId,
            userid : userId
        }
        $('#action-menu-2-menu .dropdown-item a').click(function() {
            var getAction = $("i", this).attr('title');
            if(getAction == 'data-action-copy-module=popup') {
                createModal(templateData);
            }
        });
        $('#page-course-admin li a').click(function() {
            var _this = this;
            Str.get_string('copymodule', 'theme_moove').then(function(action) {
                var getAction = $(_this).text();
                if(getAction === action)
                    createModal(templateData);

            });
        });
    }

    /**
     * Initialise the class.
     *
     * @param {Object} context
     * @public
     */
    return {
        init : init,
        initTemplateJs : initTemplateJs
    }


});
