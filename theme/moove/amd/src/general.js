require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "/theme/moove/js/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Cookie, iframetracker) {
    "use strict";
    $(window).on('load', function() {
        var getSpa = Cookie.getCookie('spa');
        if(getSpa) {
            document.cookie = 'spa=; max-Age=-1;path=/';
        }
    });
    window.onload = function() { 
     document.cookie = 'spa=; max-Age=-1;path=/';
    } 
    window.onbeforeunload = function() {
        var baseUrl = Cookie.getCookie('baseUrl');
        if(baseUrl) {
            document.cookie = 'baseUrl=; max-Age=-1;path=/';
        }
        return;
    }

    var getBodyId = $('body').attr('id');
    if(getBodyId.includes('page-course-view')) {
        $('body').addClass('loading');
        $(document).ready(function(){
            $('body').removeClass('loading');
        }) 
    }

    var getBaseUrl = Cookie.getCookie('baseUrl');
    if(!getBaseUrl) {
        var listUrl = ['/course/view.php', '/user/index.php', '/badges/view.php', '/admin/tool/lp/coursecompetencies.php', '/grade/report/index.php', '/contentbank/index.php'];
        var getCurrentPathName = window.location.pathname;
        if(listUrl.includes(getCurrentPathName)) {
            Cookie.setCookie('baseUrl', window.location.href);    
        }
    }
    var first = true;
    console.log(first);
    $('ul.nav-tabs.course li').click(function(e) {
        console.log(false)
        first = false;
        $(this).addClass('active').siblings().removeClass('active');
    	Cookie.setCookie('spa', 'true');
        var _this = this;
        var getUrl = $(_this).attr('data-page-url');
        if(getUrl.includes('course/view.php')) {
            $('#focus-mod.open-focusmod, #setting-context, #page-header .singlebutton').removeClass('d-none');
        } else {
            $('#focus-mod.open-focusmod, #setting-context, #page-header .singlebutton').addClass('d-none');
        }
        var getBaseUrl = Cookie.getCookie('baseUrl');
        if(getBaseUrl.includes(getUrl)) {
            $('#course-iframe').addClass('d-none');
            $('#region-main .card-body').removeClass('d-none');
            // window.history.pushState({path:getUrl},'',getUrl);
            return;
        }
        // window.history.pushState({path:getUrl},'',getUrl);
        // var initIframe = '<iframe id="course-iframe" class="card" src="'+getUrl+'" onload="$(this).height($(this.contentWindow.document.body).find(\'#page-wrapper\').first().height());" width="100%" height="100%" frameBorder="0"></iframe>';
        var initIframe = '<iframe id="course-iframe" class="card" src="'+getUrl+'" frameBorder="0"></iframe>';
        $('#general-iframe-view-coursepage').html(initIframe);
        $('#region-main .card-body').addClass('d-none');
        $('#region-main .loading-page').addClass('active');
        //reload để resize height iframe
        $('#course-iframe').on('load', function() {
            $('#course-iframe').iframeTracker({
                blurCallback: function(event) {
                    Cookie.setCookie('spa', 'true');
                    console.log('spa');
                },
                outCallback: function(element, event) {
                    console.log(event, element)
                    this._overId = null; // Reset hover iframe wrapper i

                    document.cookie = 'spa=; max-Age=-1;path=/';

                    $(document).ready( function() { 
                        console.log('unspa');
                    }) 
                    
                },
                _overId: null
            });
            // $('#course-iframe').iframeTracker(function(event) {
            //     console.log(event)
            // });
            $('#course-iframe').removeClass('d-none')
            const iframes = iFrameResize({ log: false }, '#course-iframe');
            $('#region-main .loading-page').removeClass('active');
        });
        
    });

    
    // Xem file trực tiếp trên popup
    var modalStore = {};
    const showmodal = (cmid, instance) => {
        require(["jquery", "core/modal_factory", "core/modal_events", "core/config", "core/templates", "core/notification"], function($, ModalFactory, ModalEvents,Config, Templates, Notification) {
            "use strict";
            const SHOW_RESOURCE = 1;
            const COMPLETION_RESOURCE = 2;
            const timeNow = Math.floor(Date.now() / 1000);

            var script = Config.wwwroot + '/course/format/multitopic/ajax.php';
            var settings = {
                type: 'GET',
                data: {
                    "cmid": cmid,
                    "instance": instance,
                    "action" : SHOW_RESOURCE,
                    "spenttime" : '',
                },
                processData: true,
                contentType: "application/json"
            };
            
            var loadingIconHtml;
            var win = $(window);
            var Selector = {
                toggleCompletion: ".togglecompletion",
                modal: ".modal",
                modalDialog: ".modal-dialog",
                modalBody: ".modal-body",
                modalTitle: ".modal-title",
                sectionMain: ".section.main",
                pageContent: "#page-content",
                regionMain: "#region-main",
                completionState: "#completionstate_",
                cmModalClose: ".embed_cm_modal .close",
                cmModal: ".embed_cm_modal",
                moodleMediaPlayer: ".mediaplugin_videojs",
                urlModalLoadWarning: "#embed-url-error-msg-",
                closeBtn: "button.close",
                ACTIVITY: "li.activity",
                URLACTIVITYPOPUPLINK: ".activity.modtype_url.urlpopup a",
                newWindowButton: ".button_expand",
                modalHeader: ".modal-header",
                embedModuleButtons: ".embed-module-buttons"
            };

            var LaunchModalDataActions = {
                launchResourceModal: "launch-tiles-resource-modal",
                launchModuleModal: "launch-tiles-module-modal",
                launchUrlModal: "launch-tiles-url-modal"
            };
            var body = $('body');
            var resizeModal = function(modalRoot) {
                modalRoot.find(Selector.modal).animate({"max-width": modalMinWidth()}, "fast");

                var MODAL_MARGIN = 70;

                // If the modal contains a Moodle mediaplayer div, remove the max width css rule which Moodle applies.
                // Otherwise video will be 400px max wide.
                // var mediaPlayer = $(Selector.moodleMediaPlayer);
                // mediaPlayer.find("div").each(function(index, child) {
                //     $(child).css("max-width", "");
                // });
                // if (mediaPlayer.length > 0) {
                //     stopAllVideosOnDismiss(modalRoot);
                // }

                // If the activity contains an iframe (e.g. is a page with a YouTube video in it), ensure modal is big enough.
                // Do this for every iframe in the course module.
                modalRoot.find("iframe").each(function (index, iframe) {

                    // Get the modal.
                    var modal;
                    // Boost calls the modal "modal dialog" so try this first.
                    modal = modalRoot.find(Selector.modalDialog);

                    // If no luck, try what Clean and Adaptable do instead.
                    if (modal.length === 0) {
                        modal = modalRoot.find(Selector.modal);
                    }

                    // Now check and adjust the width of the modal.
                    var iframeWidth = Math.min($(iframe).width(), win.width());
                    if (iframeWidth > modal.width() - MODAL_MARGIN) {
                        modal.animate(
                            {"max-width": Math.max(iframeWidth + MODAL_MARGIN, modalMinWidth())},
                            "fast"
                        );
                        modalRoot.find(Selector.modal).animate(
                            {"max-width": Math.max(iframeWidth + MODAL_MARGIN, modalMinWidth())},
                            "fast"
                        );
                    }

                    // Then the height of the modal body.
                    var iframeHeight = Math.min($(iframe).height(), win.height());
                    var modalBody = modalRoot.find(Selector.modalBody);
                    if (iframeHeight > modalBody.height() - MODAL_MARGIN) {
                        modalBody.animate({"min-height": Math.min(iframeHeight + MODAL_MARGIN, win.height())}, "fast");
                    }

                    // Align the iframe in the centre of the modal.
                    // modalBody.css("text-align", "center");

                    // stopAllVideosOnDismiss(modalRoot);
                });
            };
            var modalMinWidth = function () {
                return Math.min(win.width(), 1000);
            };
            // Init resource lên modal
            var launchResourceModal = function(cmid) {
                $.ajax(script, settings)
                .then(function(resp) {
                    body.addClass("loading");
                    ModalFactory.create({
                        type: ModalFactory.types.DEFAULT,
                        title: resp.resourcename,
                        body: loadingIconHtml
                    })
                    .done(function(modal) {
                        modalStore[cmid] = modal;
                        modal.setLarge();
                        var pluginfileurl = resp.url;
                        var hasCompleteion = resp.hascompletion;
                        var modalRoot = $(modal.root);
                        var completionTimeSpent = resp.completiontimespent;
                        modalRoot.attr("data-cmid", cmid);
                        var modalWidth = Math.round(win.width() * 0.9) + 30;
                        var modalHeight = Math.round(win.height() * 0.9);
                        var templateData = {
                            pluginfileurl: pluginfileurl,
                            id: cmid,
                            cmid: cmid,
                            width: modalWidth,
                            height: modalHeight - 30,
                            showDownload: 1,
                            showNewWindow: 1,
                        };
                        var CSS = {
                            modalBody : {
                                "display" : "flex",
                                "align-items" : "center",
                                "justify-content" : "center"
                            },
                            modalTitle : {
                                "-webkit-line-clamp": "1",
                                "-webkit-box-orient": "vertical",
                                "display":"-webkit-box",
                                "overflow": "hidden",
                                "text-overflow": "ellipsis",
                                "font-weight": "600",
                                "transition": "all 0.30s linear 0s",
                                "line-height": "22px",
                                "max-height": "44px",
                            }
                        };
                        Templates.render("format_multitopic/viewoffice", templateData).done(function (html) {
                            // Params tính thời gian hoàn thành module
                            var settings = {
                                    type: 'GET',
                                    data: {
                                        "cmid": cmid,
                                        "instance": instance,
                                        "action" : COMPLETION_RESOURCE,
                                        "spenttime" : 0
                                    },
                                    processData: true,
                                    contentType: "application/json"
                                }
                            var countShownModal = 0;
                            // Load đường dẫn file và view trên modal(popup);
                            // Reload 2s cho đến khi load thành công lên modal
                            var timerId = setInterval(function() { 
                                var iframe = document.getElementById("iFrame");
                                try {
                                    console.log(iframe.contentDocument.URL);
                                    if(iframe.contentDocument.URL === "about:blank") {
                                        iframe.src = iframe.src;
                                    }
                                } catch (e) {
                                    if(e instanceof TypeError === true) {
                                        body.removeClass("loading");
                                        modal.show();
                                        clearInterval(timerId);
                                        modal.setBody(html);
                                        modalRoot.find(Selector.modalBody).css(CSS.modalBody);
                                        modalRoot.find(Selector.modalBody).addClass('p-0');
                                        modalRoot.find(Selector.modalTitle).css(CSS.modalTitle);
                                        modalRoot.find(Selector.modalBody).animate({"min-height": modalHeight}, "fast");
                                        modalRoot.find(Selector.modal).animate({"max-width": modalWidth}, "fast");
                                        modalRoot.find(Selector.modalDialog).animate({"max-width": modalWidth}, "fast");
                                        modalRoot.find(Selector.modalBody).animate({"max-width": modalWidth}, "fast");
                                        if(hasCompleteion == true) {
                                            if(completionTimeSpent !== 'completed') {
                                                var duration;
                                                var display = document.querySelector('#time');
                                                var valueDisplay = display.innerText;
                                                var sc = valueDisplay.split(':'); 
                                                modal.getRoot().on(ModalEvents.hidden, function() {
                                                    display = document.querySelector('#time');
                                                    valueDisplay = display.innerText;
                                                    sc = valueDisplay.split(':');
                                                    duration = ((+sc[0]) * 60 + (+sc[1])); 
                                                    settings.data.spenttime = completionTimeSpent - duration;
                                                    stopTimer();
                                                    $.ajax(script, settings)
                                                    .then(function(resp) {
                                                    }).fail(Notification.exception);
                                                });
                                                modal.getRoot().on(ModalEvents.shown, function() {
                                                    if(countShownModal == 0) {
                                                        duration = completionTimeSpent;
                                                        countShownModal++;
                                                    } else {
                                                        display = document.querySelector('#time');
                                                        valueDisplay = display.innerText;
                                                        sc = valueDisplay.split(':');
                                                        duration = ((+sc[0]) * 60 + (+sc[1]));
                                                    }
                                                    settings.data.spenttime = duration;
                                                    startTimer(duration, display, settings, true);

                                                });
                                            }
                                        }
                                        
                                    } 
                                }
                            }, 3000);
                        
                        }).fail(Notification.exception);
                        Templates.render("format_multitopic/embed_module_modal_header_btns", templateData).done(function (html) {
                            modalRoot.find(Selector.modalHeader).append(html);
                            modalRoot.find(Selector.closeBtn).detach().appendTo(modalRoot.find(Selector.embedModuleButtons));
                        }).fail(Notification.exception);
                        return true;
                    });
                });
            }
            var countDown;
            // Bắt đầu tính thời gian hoàn thành module
            var startTimer = function(duration, display, settings, start) {
                try {
                    if(!start)
                        return;
                    var timer = duration, minutes, seconds;
                    var settings = settings;
                    countDown = setInterval(function () {
                        minutes = parseInt(timer / 60, 10)
                        seconds = parseInt(timer % 60, 10);
                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;
                        display.textContent = minutes + ":" + seconds;
                        
                        if (--timer < 0) {
                            clearInterval(countDown);
                            $.ajax(script, settings)
                            .then(function(resp) {
                                var cmid = settings.data.cmid;
                                var completedicon = $('#module-' + cmid + ' .actions img').attr('src');
                                var replaceicon = completedicon.replace('auto-n', 'auto-y')
                                $('#module-' + cmid + ' .actions img').attr('src', replaceicon);
                            }).fail(Notification.exception);
                            return true;
                        }    
                    }, 1000);
                } catch (e) {
                    if(e instanceof TypeError === true) {
                        return false;
                    }
                } 
            }
            // Pause thời gian hoàn thành module

            var stopTimer = function() {
                clearInterval(countDown);
            }
            var init = function(cmid) {
                $(document).ready(function() {
                    var modalSelectors = '[data-cmid="' + cmid + '"]';

                    var pageContent = $(Selector.pageContent);
                    if (pageContent.length === 0) {
                        pageContent = $(Selector.regionMain);
                    }
                    var existingModal = modalStore[cmid];
                    if (typeof existingModal === "object") {
                        existingModal.show();
                    } else {
                        launchResourceModal(cmid)
                    }
                });
            }
            init(cmid);
        });
    }
    ////phân trang table thư viện điện tử///
    const nextPage = (url,place) => {
        require(['jquery', 'core/config'], ($, config) => {
            $('.loading-page').addClass('active');
            var settings = {
                type:"GET",
                processData:true,   
                contenttype:"application/json",
            };
            $.ajax(url,settings)
            .then(function(response) {
                var obj = $.parseJSON(response);
                $(place).hide().html(obj.result).fadeIn('fast');
                $('#pagination').replaceWith(obj.pagination);
                $('.loading-page').removeClass('active');
            })
        });
    };
    const loadComment = (id) => {
        require(['jquery', 'core/config'], ($, Config) => {
            $('.loading-page').addClass('active');
            page++;
            var url = Config.wwwroot + "/local/newsvnr/ajax/pagination_comment.php";
            var settings = {
                type:"GET",
                processData:true,
                data:{
                    discussionid:id,
                    page: page
                }
            };
            $.ajax(url,settings).then(function(response) {
                $('.new-detail-see-more').remove();
                $('#list_comment').append(response);
                $('.loading-page').removeClass('active');
            });
        });
    }

    // Xóa file trong tài liệu hệ thống
    const deleteFile = (fileName, filePath, id) => {
        require(['jquery', 'core/config'], ($, Config) => {
            var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
            var settings = {
                type : "GET",
                processData : true,
                data : {
                    action : 'deletefile',
                    filename : fileName,
                    filepath : filePath
                }

            };
            $.ajax(script, settings)
            .then(function(resp) {
                var ele = '#delete-file-' + id;
                var cfrm = confirm("Bạn chắc chắn muốn xóa file này?");
                if(cfrm == true) {
                    Grid.refreshGrid();
                }
            });
        });
    }

    // Duyệt file trong tài liệu hệ thống
    const acceptFile = (id) => {
        require(['jquery', 'core/config', 'local_newsvnr/requestfiles'], ($, Config, Grid) => {
            var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
            var settings = {
                type : "GET",
                processData : true,
                data : {
                    action : 'acceptfile',
                    id : id
                }

            };
            $.ajax(script, settings)
            .then(function(resp) {
                var ele = '#accept-file-' + id;
                var cfrm = confirm("Bạn đồng ý duyệt file này?");
                if(cfrm == true) {
                    Grid.refreshGrid();
                }
            });
        });
    }

    // Kiểm tra quyền trong tài liệu hệ thống
    const checkRoles = () => {
        require(['jquery', 'core/config'], ($, Config) => {
            var userid = $('[role="listitem"]').attr('data-value');
            var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
            var settings = {
                type : "GET",
                processData : true,
                data : {
                    action : 'checkoles',
                    userid : userid
                }

            };
            $('#page-local-newsvnr-generallibrary #iframepermissions').css('height', '645px');
            $.ajax(script, settings)
            .then(function(resp) {
                var contextid = resp;
                var roleurl = Config.wwwroot + '/admin/roles/portalpermissions.php?contextid=' + contextid + '&userid=' + userid + '&courseid=1';
                var iframe = '<iframe id="iframe" src="'+roleurl+'" width="100%" height="645" frameBorder="0"></iframe>';
                $('#iframepermissions').html(iframe);

            });
        });
    }
    // Duyệt file trong trang tài nguyên hệ thống
    const acceptFileSelect = () => {
        require(['jquery', 'core/config', 'alertjs'], ($, Config, alertify) => {
            var script = Config.wwwroot + '/local/newsvnr/ajax/requestfiles_generallibrary.php';
            var arrObject = getSelectRow('#requestfile_grid');
            var data = JSON.stringify(arrObject);
            console.log(data);
            var settings = {
                type : "POST",
                processData : true,
                data : {
                    action : 'acceptFileSelect',
                    dataSelect : data
                }
            };
            if(arrObject.length == 0) {
                alertify.error('{{#str}} approvalerror,local_newsvnr {{/str}}');
            } 
            else {
                alertify.confirm('{{#str}} alert, local_newsvnr {{/str}}', '{{#str}} approvalfileselect, local_newsvnr {{/str}} ?',
                    function(){  
                        $.ajax(script, settings).then(function(resp) {
                            $('#requestfile_grid').data("kendoGrid").dataSource.read();
                            alertify.success('{{#str}} approvalmodulesuccess,local_newsvnr {{/str}}');
                        })
                    },
                    function() { return }
                );
            }
        });
    }
    const activeSubjectExam = function(id, visible) {
        require(['jquery', 'core/config', 'alertjs'], ($, Config, alertify) => {
            var script = Config.wwwroot + '/local/newsvnr/exam/ajax/exam.php';
            var settings = {
                type: 'GET',
                contentType: "application/json",
                data: {
                    action: 'subjectexam_active',
                    exam: {
                        id: id,
                        visible: visible,
                    }
                },
            }
            $.ajax(script, settings).then(function(resp) {
                $('#subjectexam-grid').data('kendoGrid').dataSource.read();
                // alertify.success(resp.success, 'success', 3);
            });
        })
    }
    const activeExam = function(id, visible) {
        require(['jquery', 'core/config', 'alertjs'], ($, Config, alertify) => {
            var script = Config.wwwroot + '/local/newsvnr/exam/ajax/exam.php';
            var settings = {
                type: 'GET',
                contentType: "application/json",
                data: {
                    action: 'exam_active',
                    exam: {
                        id: id,
                        visible: visible,
                    }
                },
            }
            $.ajax(script, settings).then(function(resp) {
                $('#exam-grid').data('kendoGrid').dataSource.read();
                // alertify.success(resp.success, 'success', 3);
            });
        })
    }
    ////phân trang khóa học///
    const getCourse = (url) => {
        require(['jquery', 'core/config'], ($, config) => {
            $('.loading-page').addClass('active');
            var id = $('.pagination').attr('category');
            var teacher = $('#teacher').val();
            var category = $('#category').val();
            var course = $('#keyword').val();
            var filter = $('#course-filter').val();
            var settings = {
                type:"GET",
                processData:true,
                data:{
                    id:id,
                    teacher : teacher,
                    category : id,
                    course : course,
                    filter : filter,
                },
                contenttype:"application/json",
            };
            $.ajax(url,settings)
            .then(function(response) {
                $('#load-course').hide().html(response).fadeIn('fast');
                $('.loading-page').removeClass('active');
            })
        });
    };
});