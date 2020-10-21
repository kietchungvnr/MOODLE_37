
define(['jquery', 'kendo.all.min', 'core/config', 'core/notification','core/str'], function($, kendo, Config, Notification, Str) {
    return {  
        orgtreeview: function(){

            var clickparent_course = true;
            var clickparent_category = true;
            //chọn parentid cho phòng ban orgstructuer - trang orgstructure
            $('#id_courseoforgstructure').on('click',function() {
                if(clickparent_course == true){
                var settings = {
                    type: 'GET',
                    processData: true,
                    data:{
                        org_struct: 1
                },
                contentType: "application/json"
                };
                var script = Config.wwwroot + '/local/newsvnr/ajax.php';
                var tvajaxx = $.ajax(script, settings)
                .then(function(response) {
                if (response.error) {
                    Notification.addNotification({
                        message: response.error,
                        type: "error"
                    });
                } else {
                        // Reload the page, don't show changed data warnings.
                        if (typeof window.M.core_formchangechecker !== "undefined") {
                            window.M.core_formchangechecker.reset_form_dirty_state();
                        }
                        // window.location.reload();
                        var data = JSON.parse(response);
                        var tv = $("#treeview-orgstructure-course").kendoTreeView({
                            // multiselect phòng ban
                            // checkboxes: {
                            //     checkChildren: false
                            // },
                            // check: onCheck,
                            dataSource: data,
                            
                        }).data('kendoTreeView');
                        // multiselect phòng ban
                        // function checkedNodeIds(nodes, checkedNodes) {
                        //     for (var i = 0; i < nodes.length; i++) {
                        //         if (nodes[i].checked) {
                        //             checkedNodes.push(nodes[i].text);
                        //         }

                        //         if (nodes[i].hasChildren) {
                        //             checkedNodeIds(nodes[i].children.view(), checkedNodes);
                        //         }
                        //     }
                        // }
                        // function onCheck() {
                        //     var checkedNodes = [],
                        //         treeView = $("#treeview-orgstructure-course").data("kendoTreeView"),
                        //         message;

                        //     checkedNodeIds(treeView.dataSource.view(), checkedNodes);

                        //     if (checkedNodes.length > 0) {
                        //         message =  checkedNodes.join(",");
                        //     } else {
                        //         message = "No nodes checked.";
                        //     }
                        //     document.getElementById('id_courseoforgstructure').value = message;
                        // }
                        

                        $('#treeview-orgstructure-course').on('click','.k-item',function(){
                            var selected = tv.select(),item;

                            if(selected.length >0)
                              item = tv.dataItem(selected);
                            if (item) {
                                document.getElementById('id_courseoforgstructure').value = item.text;
                                $('#id_courseoforgstructure').focus();
                            } else {
                                $('#log').text('Nothing selected');
                            }
                            $('#treeview-orgstructure-course').mouseleave(function(){ 
                                $(this).hide(500);
                            });
                        });

                    }

                    clickparent_course = false;
                    return;
                }).fail(Notification.exception);
          } 
          else {
             $('#id_courseoforgstructure').on('click',function() {
                 $('#treeview-orgstructure-course').show(500);
             });
         }
     });

            $('#id_category_cs').on('click',function() {
             if(clickparent_category == true){
                var settings = {
                    type: 'GET',
                    processData: true,
                    data:{
                      coursesetup: 1
                  },
                  contentType: "application/json"
              };
              var script = Config.wwwroot + '/local/newsvnr/ajax.php';
              var tvajaxx = $.ajax(script, settings)
              .then(function(response) {
                if (response.error) {
                    Notification.addNotification({
                        message: response.error,
                        type: "error"
                    });
                } else {
                        // Reload the page, don't show changed data warnings.
                        if (typeof window.M.core_formchangechecker !== "undefined") {
                            window.M.core_formchangechecker.reset_form_dirty_state();
                        }
                        // window.location.reload();
                        var data = JSON.parse(response);
                        var tv = $("#treeview-category-course").kendoTreeView({
                            dataSource: data,
                            
                        }).data('kendoTreeView');
                        
                        $('#treeview-category-course').on('click','.k-item',function(){
                            var selected = tv.select(),item;

                            if(selected.length >0)
                              item = tv.dataItem(selected);
                          if (item) {
                            document.getElementById('id_category_cs').value = item.text;

                        } else {
                            $('#log').text('Nothing selected');
                        }
                        $('#treeview-category-course').mouseleave(function(){ 
                            $(this).hide(500);
                        });
                    });

                    }

                    clickparent_category = false;
                    return;
                }).fail(Notification.exception);
          } 
          else {
             $('#id_category_cs').on('click',function() {
                 $('#treeview-category-course').show(500);
             });
         }
     });
        }
        
    };
});