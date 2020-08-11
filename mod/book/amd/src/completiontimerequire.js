define(["jquery", "core/config", "core/templates", "core/notification"], function($, Config, Templates, Notification) {
    "use strict";

    const SHOW_BOOK = 1;
    const COMPLETION_BOOK = 2;
    const timeNow = Math.floor(Date.now() / 1000);

    var script = Config.wwwroot + '/mod/book/ajax.php';
    
    // Init Book
    var Init = function(cmid, instance) {
        var settings = {
            type: 'GET',
            data: {
                "cmid": cmid,
                "instance": instance,
                "action" : SHOW_BOOK,
                "spenttime" : '',
            },
            processData: true,
            contentType: "application/json"
        };
        $.ajax(script, settings)
        .then(function(resp) {
            var completionTimeSpent = resp.completiontimespent;
            //Params tính thời gian hoàn thành module
            var completionSettings = {
                    type: 'GET',
                    data: {
                        "cmid": cmid,
                        "instance": instance,
                        "action" : COMPLETION_BOOK,
                        "spenttime" : 0
                    },
                    processData: true,
                    contentType: "application/json"
                }
        
            if(completionTimeSpent !== 'completed') {
                var duration = resp.completiontimespent;
                var display = document.querySelector('#time');
                startTimer(duration, display, completionSettings, true);
                window.onbeforeunload = function() {
                    var valueDisplay = display.innerText;
                    var sc = valueDisplay.split(':'); 
                    duration = ((+sc[0]) * 60 + (+sc[1])); 
                    completionSettings.data.spenttime = completionTimeSpent - duration;
                    $.ajax(script, completionSettings)
                    .then(function(resp) {
                    }).fail(Notification.exception);
                    return undefined;
                }
            }
            return true;
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
                    var valueDisplay = display.innerText;
                    var sc = valueDisplay.split(':'); 
                    var timeSpent = ((+sc[0]) * 60 + (+sc[1])); 
                    settings.data.spenttime = duration - timeSpent;
                    $.ajax(script, settings)
                    .then(function(resp) {
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
    return {
        init : function(cmid, instance) {
            Init(cmid, instance);
        }
    };
});
    