
 define(['jquery'], function($) {
 
    return {
        refresh: function() {
 
            // Put whatever you like here. $ is available
            // to you as normal.
            $("#refresh").on('click', function() {

                alert("troi oi la troizz");
            });
        }
    };
});