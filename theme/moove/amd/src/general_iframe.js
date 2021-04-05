require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "/theme/moove/js/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Cookie, iframetracker) {
    "use strict";

    // Xử lý xóa cookie khi right click vào thẻ <a>
    $(document).ready(function() {
        $('body').removeClass('loading');
        $('#standard-iframe a').bind('contextmenu', function(event) {
            Cookie.setCookie('spa', '-1', 0);
            Cookie.setCookie('cookie', '-1', 0);
        });
        $('#standard-iframe a').on('click', function(e) {
            if (e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1)) {
                Cookie.setCookie('spa', '-1', 0);
                Cookie.setCookie('cookie', '-1', 0);
            }
        })
        $('#general-iframe a').bind('contextmenu', function(event) {
            Cookie.setCookie('spa', '-1', 0);
        });
        $('#general-iframe a').on('click', function(e) {
            if (e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1)) {
                Cookie.setCookie('spa', '-1', 0);
            }
        })
    });


    // Xét lại baseurl khi relaod trang
    window.onbeforeunload = function() {
        var baseUrl = Cookie.getCookie('baseUrl');
        if(baseUrl) {
            Cookie.setCookie('baseUrl', '-1', 0);
        }
        // Cookie.setCookie('spa', '-1', 0);
        return;
    }

    // Chỉ có những url trong mảng mới xét cookie baseurl
    // Lúc sử dụng SPA không load lại phần đầu tiên khi load page
    var getBaseUrl = Cookie.getCookie('baseUrl');
    if(!getBaseUrl) {
        var listUrl = ['/course/view.php', '/user/index.php', '/badges/view.php', '/admin/tool/lp/coursecompetencies.php', '/grade/report/index.php', '/contentbank/index.php'];
        var getCurrentPathName = window.location.pathname;
        if(listUrl.includes(getCurrentPathName)) {
            Cookie.setCookie('baseUrl', window.location.href);    
        }
    }

    // Xử lý khi click vào tab trong khóa học
    $('ul.nav-tabs.course li').click(function(e) {
        $(this).addClass('active').siblings().removeClass('active');
    	Cookie.setCookie('spa', 'true');
        Cookie.setCookie('baseUrl', window.location.href); 
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
            Cookie.setCookie('spa', '-1', 0);
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
                    $('body').focus();
                    Cookie.setCookie('spa', 'true');
                },
                outCallback: function(element, event) {
                    this._overId = null; // Reset hover iframe wrapper i
                    Cookie.setCookie('spa', '-1', 0);
                },
                _overId: null
            });
            $('#course-iframe').removeClass('d-none')
            const iframes = iFrameResize({ log: false }, '#course-iframe');
            $('#region-main .loading-page').removeClass('active');
        });
    });
});