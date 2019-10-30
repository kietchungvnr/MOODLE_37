require.config({
    paths: {
        "kendo.all.min": "/local/newsvnr/js/kendo.all.min",
        "dttable": "/local/newsvnr//js/datatable.min",
    }
});
define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'dttable', 'core/modal_factory', 'core/modal_events', 'core/str'], function($, kendo, Config, Notification, dttable, ModalFactory, ModalEvents, Str) {

    //loại  bỏ thẻ html 
    function strip_tags(str, allowed_tags) {
        var key = '',
        allowed = false;
        var matches = [];
        var allowed_array = [];
        var allowed_tag = '';
        var i = 0;
        var k = '';
        var html = '';

        var replacer = function(search, replace, str) {
            return str.split(search).join(replace);
        };
        // Build allowes tags associative array
        if (allowed_tags) {
            allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
        }

        str += '';

        // Match tags
        matches = str.match(/(<\/?[\S][^>]*>)/gi);

        // Go through all HTML tags
        for (key in matches) {
            if (isNaN(key)) {
                // IE7 Hack
                continue;
            }

            // Save HTML tag
            html = matches[key].toString();

            // Is tag not in allowed list ? Remove from str !
            allowed = false;

            // Go through all allowed tags
            for (k in allowed_array) {
                // Init
                allowed_tag = allowed_array[k];
                i = -1;

                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + '>');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('<' + allowed_tag + ' ');
                }
                if (i != 0) {
                    i = html.toLowerCase().indexOf('</' + allowed_tag);
                }

                // Determine
                if (i == 0) {
                    allowed = true;
                    break;
                }
            }

            if (!allowed) {
                str = replacer(html, "", str);
                // Custom replace. No regexing
            }
        }
        return str;
    }




    return {  
        orgstructure: function(){
          var clickparent = true;
            //chọn parentid cho phòng ban orgstructuer - trang orgstructure
          $('#id_parentid').on('click',function() {
             if(clickparent == true){
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
                        var tv = $("#treeview-orgstructure").kendoTreeView({
                            dataSource: data,
                            
                        }).data('kendoTreeView');
                        
                        $('#treeview-orgstructure').on('click','.k-item',function(){
                            var selected = tv.select(),item;
                           
                            if(selected.length >0)
                              item = tv.dataItem(selected);
                            if (item) {
                                document.getElementById('id_parentid').value = item.id;
                               
                            } else {
                                $('#log').text('Nothing selected');
                            }
                             $('#treeview-orgstructure').mouseleave(function(){ 
                                $(this).hide(500);
                             });
                        });
                       
                    }

                    clickparent = false;
                    return;
                }).fail(Notification.exception);
            } else {
                 $('#id_parentid').on('click',function() {
                     $('#treeview-orgstructure').show(500);
                 });
            }
          });
        }
        
    };
});