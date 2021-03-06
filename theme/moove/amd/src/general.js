require.config({
    paths: {
        // Change this to your server if you do not wish to use our CDN.
        iframetracker: "/theme/moove/js/jquery.iframetracker"
    }
});
define(["jquery", "core/config", "theme_moove/handle_cookie", 'iframetracker'], function($, Config, Cookie, iframetracker) {
    "use strict";
    // $(window).on('load', function() {
    //     var getSpa = Cookie.getCookie('spa');
    //     if(getSpa) {
    //         document.cookie = 'spa=; max-Age=-1;path=/';
    //     }
    // });
    
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
    $('ul.nav-tabs.course li').click(function(e) {
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
                    $('body').focus();
                    Cookie.setCookie('spa', 'true');
                    console.log('spa');
                },
                outCallback: function(element, event) {
                    this._overId = null; // Reset hover iframe wrapper i
                    document.cookie = 'spa=; max-Age=-1;path=/';
                    console.log('unspa');
                },
                _overId: null
            });
            $('#course-iframe').removeClass('d-none')
            const iframes = iFrameResize({ log: false }, '#course-iframe');
            $('#region-main .loading-page').removeClass('active');
        });
    });
});