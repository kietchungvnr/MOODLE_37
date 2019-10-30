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
        orgmain: function() {
            var st = $("#search-term").val();
            var data;
            var tv;
            var clicktable;
            var data_clicktable;
            var settings = {
              type: 'GET',
              data: {
                org_struct: 1
            },
            processData: true,
            contentType: "application/json"
            };
            var script = Config.wwwroot + '/local/newsvnr/ajax.php';
            $('[data-region="buttons-iframe"] #userdetail_orgstructure').click(function(){
              $('[data-region="userdetail-iframe"]').removeClass("d-none");      
            });

            $.ajax(script, settings)
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
                  $('#search-term').on('keyup', function() {
                      var treeView = $("#treeview-sprites").getKendoTreeView();
                      treeView.dataSource.data(data);

                      // ignore if no search term
                      if ($.trim($(this).val()) == '') {
                          return;
                      }

                      var term = this.value.toUpperCase();
                      var tlen = term.length;

                      $('#treeview-sprites span.k-in').each(function(index) {
                          var text = $(this).text();

                          var html = '';
                          var q = 0;
                          while ((p = text.toUpperCase().indexOf(term, q)) >= 0) {
                              html += text.substring(q, p) + '<span class="highlight">' + text.substr(p, tlen) + '</span>';
                              q = p + tlen;
                          }

                          if (q > 0) {
                              html += text.substring(q);

                              var dataItem = treeView.dataItem($(this));
                              dataItem.set("text", html);

                              $(this).parentsUntil('.k-treeview').filter('.k-item').each(

                                  function(index, element) {
                                      $('#treeview-sprites').data('kendoTreeView').expand($(this));
                                      $(this).data('search-term', term);
                                  });
                          }
                      });

                      $('#treeview-sprites .k-item').each(function() {
                          if ($(this).data('search-term') != term) {
                              $('#treeview-sprites').data('kendoTreeView').collapse($(this));
                          }
                      });
                  });
                  // window.location.reload();
                  data = JSON.parse(response);
                  tv = $("#treeview-sprites").kendoTreeView({
                      dataSource: data
                  }).data('kendoTreeView');
                  //search bằng button
                  // $('#treeview-sprites').click(function () {
                  //         var selected = tv.select(),
                  //             item = tv.dataItem(selected);

                  //         if (item) {
                  //             document.getElementById("search-term").value = item.id;
                  //         } else {
                  //             $('#log').text('Nothing selected');
                  //         }
                  // }); 
              }

              return;
            }).fail(Notification.exception);
               //click vào cây phòng ban
                $('#treeview-sprites').on('click',function() {
                  $('[data-region="buttons-iframe"] #list_users').removeClass("btn-primary");
                  $('[data-region="buttons-iframe"] #list_users').removeAttr('disabled');
                  $('[data-region="buttons-iframe"] #orgstructuredetail').removeAttr('disabled');
                  var click_user_orgstructure = true;

                  var selected = tv.select(),
                  item = tv.dataItem(selected);
                  if (item) {
                      var itemid = item.id;
                      var itemtext = item.text;
                      document.getElementById("search-term").value = strip_tags(itemtext);
                  }
                  var settings = {
                      // async: false,
                      type: 'GET',
                      data: {
                          section: 'orgmain_list',
                          orgstructureid: itemid
                      },
                      processData: true,
                      contentType: "application/json"
                  };


                  var script = Config.wwwroot + '/local/newsvnr/ajax/orgdata.php';

                  $.ajax(script, settings)
                  .then(function(response) {

                      if (response.error) {
                          Notification.addNotification({
                              message: response.error,
                              type: "error"
                          });
                      } else {
                          var strings = [{
                              key: 'nodatatable',
                              component: 'local_newsvnr'
                          }, ];
                          Str.get_strings(strings).then(function(s) {
                              var data = JSON.parse(response);
                              $('#showtable_data').html(data.header);
                              var table = $('#orgmain_datatable').DataTable({
                                  "dom": 'frtip',
                                  "language": {
                                      "emptyTable": s[0]
                                  }
                              });
                              var clicktable = $('#orgmain_datatable tbody').on('dblclick', 'tr', function () {            
                                  var data_clicktable = table.row( this ).data();

                                  var settings5 = {
                                    // async: false,
                                    type: 'GET',
                                    data: {
                                      section: 'orgmain_list',
                                      modalsection: 'modalinfo',
                                      orgstructureid:itemid,
                                      usercode:data_clicktable[0]

                                  },
                                  processData: true,
                                  contentType: "application/json"
                              };
                              var script5 = Config.wwwroot + '/local/newsvnr/ajax/orgdata.php';

                              $.ajax(script5,settings5)
                              .then(function(response){
                                  var data = JSON.parse(response);
                                  $('#showmodal_data').html(data.modal);
                                  $('#userdetail').modal('show');
                                  $('#userdetailtable').DataTable({
                                      "dom": 'frtip',
                                      "language": {
                                          "emptyTable": s[0]
                                      }
                                  });

                              }).fail(Notification.exception);
                          }); 
                          });

                      }
                      return;
                  }).fail(Notification.exception);
                });
            $('[data-region="buttons-iframe"] #list_users').click(function(){
                  document.getElementById('treeview-sprites').click();
                  $('#showtable_data').removeClass("d-none");
                  $('#show_orgform').addClass("d-none");

            });

            $('[data-region="buttons-iframe"] #orgstructuredetail').click(function(){
                $('#show_orgform').removeClass("d-none");
                $('#showtable_data').addClass("d-none");
                var selected = tv.select(),
                item = tv.dataItem(selected);
                if (item) {
                    var itemid = item.id;
                }
                var settings = {
                    // async: false,
                    type: 'GET',
                    data: {
                        section: 'orgstructuredetail',
                        id: itemid
                    },
                    processData: true,
                    contentType: "application/json"
                };

                var script = Config.wwwroot + '/local/newsvnr/ajax/orgdata.php';


                $.ajax(script, settings)
                .then(function(response) {

                    var data = JSON.parse(response);
                    // $('#fitem_id_orgname').value = data.header.id;
                    // $('#fitem_nam_orgname').value = data.header.id;
                    // console.log(data.header);
                    // document.write(data.header);
                    // $('#showtable_data').html(data.header);
                });
            })
        }
    };
});