require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "/theme/moove/js/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Cookie, iframetracker) {
    "use strict";

    // Kiểm tra có phải là 1 iframe hay không?
    function iniFrame() {
        var gfg = window.frameElement;
        // Checking if webpage is embedded
        if (gfg) {
            // The page is in an iFrame
            Cookie.setCookie('spa', 'true');
        } 
        else {
            // The page is not in an iFrame
            Cookie.setCookie('spa', 'false');
        }
    }
    iniFrame();

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
        $('#general-iframe a').mousedown(function(event) {
            switch (event.which) {
                case 1:
                    var getTarget = $(this).attr('target');
                    if(getTarget == '_blank') {
                        Cookie.setCookie('spa', '-1', 0);
                    } else {
                        Cookie.setCookie('spa', 'true');
                    }
                    break;
                case 2:
                    //alert('Middle mouse button pressed');
                    Cookie.setCookie('spa', '-1', 0);
                    break;
                case 3:
                    //alert('Right mouse button pressed');
                    Cookie.setCookie('spa', '-1', 0);
                    break;
                default:
                    //alert('You have a strange mouse');
                    Cookie.setCookie('spa', '-1', 0);
            }
            if (e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button == 1)) {
                Cookie.setCookie('spa', '-1', 0);
            }
        });
    });

});