define(["jquery"], function($) {
    "use strict";
    var checkSpecialChars = function(strSpecialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/, strCheck) {
    	return strSpecialChars.test(strCheck);
    }
    return {
    	checkSpecialChars : checkSpecialChars
    }
});