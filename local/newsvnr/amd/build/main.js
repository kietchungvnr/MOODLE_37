define(['jquery', 'local_newsvnr/ajaxcalls','theme_moove/kendo.all.min'
    ],
    function($, Ajaxcalls, kendo
        ) {

        return {
            Init: function() {
            console.log(itemid);
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
           
            // $("#treeview").kendoTreeView({
            //     dataSource: [{
            //         Name: "Furniture",
            //         Id:0,
            //         expanded: true,
            //         items: [{
            //             Name: "Tables & Chairs",
            //             Id: 1
            //         }, {
            //             Name: "Sofas",
            //             Id: 99
            //         }, {
            //             Name: "Occasional Furniture",
            //             Id: 3
            //         }]
            //     }, {
            //         Name: "Decor",
            //         items: [{
            //             Name: "Bed Linen",
            //             Id: 4
            //         }, {
            //             Name: "Curtains & Blinds",
            //             Id: 5
            //         }, {
            //             Name: "Carpets",
            //             Id: 6
            //         }]
            //     }, {
            //         Name: "Storage",
            //         Id: 7
            //     }],
            //     dataTextField: "Name",
            //     dataValueField: "Id"
            // }).data('kendoTreeView');
            // $('#treeview').click(function () {
            //     var selected = tv.select(),
            //     item = tv.dataItem(selected);

            //     if (item) {
            //         document.getElementById("log").value = item.Id;
            //     } else {
            //         $('#log').text('Nothing selected');
            //     }
            // });

        }
    };
});
