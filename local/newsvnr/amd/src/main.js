define(['jquery', 'local_newsvnr/ajaxcalls','theme_moove/kendo.all.min'
    ],
    function($, Ajaxcalls, kendo
    ) {

    return {
        Init: function(itemid) {
            //console.log(itemid);
            console.log(this);
            $('#testcontent').
                    append('<textarea rows="4" cols="10" id="textarea1"></textarea>').
                    trigger("create");

            $('#testcontent').
                    append('<button id="testbutton1" class="btn btn-default" title="read">Read</button>').
                    trigger("create");
            $('#testbutton1').click(function () {
                var ajaxx = require("local_newsvnr/ajaxcalls");
                var ajax1 = new ajaxx();
              
                ajax1.loadsettings(itemid);
                
            });    
            
            $('#testcontent').append('<button id="testbutton2" class="btn btn-default" title="read">Write</button>').
                    trigger("create");
            $('#testbutton2').click(function () {
                var ajaxx = require("local_newsvnr/ajaxcalls");
                var ajax2 = new ajaxx();
                var content = $('#textarea1').val();
                ajax2.updatesettings(itemid, content); 
            });   
       

        }
    };
});
