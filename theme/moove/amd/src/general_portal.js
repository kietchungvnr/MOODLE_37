require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "/theme/moove/js/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Cookie, iframetracker) {
    "use strict";

    function iniFrame() {
        var gfg = window.frameElement;
        // Checking if webpage is embedded
        if (gfg) {
            // The page is in an iFrame
            Cookie.setCookieSecure('spa', 'true');
        } 
        else {
            // The page is not in an iFrame
            Cookie.setCookieSecure('spa', 'false');
        }
    }
    iniFrame();
    
    // Xử lý xóa cookie khi right click vào thẻ <a>
    $(document).ready(function() {
        $('body').removeClass('loading');
        $('body a').bind('contextmenu', function(event) {
            Cookie.setCookieSecure('spa', '-1', 0);
            Cookie.setCookieSecure('cookie', '-1', 0);
            Cookie.setCookieSecure('ebmlms', '-1', 0);
        });
        $("body a[target='_blank']").on('click', function(event) {
            event.preventDefault();
            Cookie.setCookieSecure('spa', '-1', 0);
            Cookie.setCookieSecure('cookie', '-1', 0);
            Cookie.setCookieSecure('ebmlms', '-1', 0);
            window.open($(this).attr('href'), '_blank').focus();
        });
        $('body a').on('click', function(e) {
            if (e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1)) {
                Cookie.setCookieSecure('spa', '-1', 0);
                Cookie.setCookieSecure('cookie', '-1', 0);
                Cookie.setCookieSecure('ebmlms', '-1', 0);
            }
        })
    });


    // Xét lại baseurl khi relaod trang
    window.onbeforeunload = function() {
        var baseUrl = Cookie.getCookie('baseUrl');
        if(baseUrl) {
            Cookie.setCookieSecure('baseUrl', '-1', 0);
        }
        
        // Xóa focusmode khi không phải ở trong mod page
        var listUrl = ['/course/view.php', '/user/index.php', '/badges/view.php', '/admin/tool/lp/coursecompetencies.php', '/grade/report/index.php', '/contentbank/index.php'];
        var getCurrentPathName = window.location.pathname;
        if(listUrl.includes(getCurrentPathName)) {
            Cookie.setCookieSecure('cookie', '-1', 0);
        }
        return;
    }

    // Chỉ có những url trong mảng mới xét cookie baseurl
    // Lúc sử dụng SPA không load lại phần đầu tiên khi load page
    var getBaseUrl = Cookie.getCookie('baseUrl');
    if(!getBaseUrl) {
        var listUrl = ['/course/view.php', '/user/index.php', '/badges/view.php', '/admin/tool/lp/coursecompetencies.php', '/grade/report/index.php', '/contentbank/index.php'];
        var getCurrentPathName = window.location.pathname;
        if(listUrl.includes(getCurrentPathName)) {
            Cookie.setCookieSecure('baseUrl', window.location.href);    
        }
    }

    // Xử lý khi click vào tab trong khóa học
    $('ul.nav-tabs.course li').click(function(e) {
        var iframes;
        $(this).addClass('active').siblings().removeClass('active');
        Cookie.setCookieSecure('spa', 'true');
        Cookie.setCookieSecure('ebmlms', 'true');
        Cookie.setCookieSecure('baseUrl', window.location.href); 
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
            Cookie.setCookieSecure('spa', '-1', 0);
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
            $('#course-iframe').removeClass('d-none');
            if(iframes == undefined) {
                iframes =  iFrameResize({ log: false }, '#course-iframe');
            }
            $('#region-main .loading-page').removeClass('active');
        });
    });
});