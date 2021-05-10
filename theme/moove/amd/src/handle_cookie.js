define(["jquery", "core/config"], function($, Config) {
    "use strict";
    var setCookie = function(cname, cvalue, secure = false, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        if(secure == true)
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/; SameSite=None; Secure";
        else
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    var setCookieSecure = function(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/; SameSite=None; Secure";
    }
    var getCookie = function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    return {
        setCookie: setCookie,
        setCookieSecure: setCookieSecure,
        getCookie: getCookie
    }
})