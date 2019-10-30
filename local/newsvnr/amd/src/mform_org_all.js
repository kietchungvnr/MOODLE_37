require.config({
    paths: {
        "kendo.all.min": "/theme/moove/js/kendo.all.min",
        "dttable": "/theme/moove/js/datatable.min",
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
        // orgcomp_position: function(){
        //     $('.list-group-item').click(function(){

        //   var getID = this.id;

        //    var settings2 = {
        //       type: 'GET',
        //       data: {
        //         org_competency: 1,
        //         frameid: getID
        //       },
        //       processData: true,
        //       contentType: "application/json"
        //   };

        //   $.ajax(script, settings2)
        //   .then(function(response) {
        //       if (response.error) {
        //           Notification.addNotification({
        //               message: response.error,
        //               type: "error"
        //           });
        //       } else {
        //               // Reload the page, don't show changed data warnings.
        //               if (typeof window.M.core_formchangechecker !== "undefined") {
        //                   window.M.core_formchangechecker.reset_form_dirty_state();
        //               }
        //               // window.location.reload();
        //               var data = JSON.parse(response);                     

        //               var tv = $("#tree-competency").kendoTreeView({
        //                   dataSource: data,
         
        //               }).data('kendoTreeView');


        //               $('#value-item').on('keyup', function () {
        //                        var treeView = $("#tree-competency").getKendoTreeView();
        //                         treeView.dataSource.data(data);
                                    
        //                         // ignore if no search term
        //                         if ($.trim($(this).val()) == '') {
        //                             return;
        //                         }

        //                         var term = this.value.toUpperCase();
        //                         var tlen = term.length;

        //                         $('#tree-competency span.k-in').each(function (index) {
        //                             var text = $(this).text();
                                  
        //                             var html = '';
        //                             var q = 0;
        //                             while ((p = text.toUpperCase().indexOf(term, q)) >= 0) {
        //                                 html += text.substring(q, p) + '<span class="highlight">' + text.substr(p, tlen) + '</span>';
        //                                 q = p + tlen;
        //                             }

        //                             if (q > 0) {
        //                                 html += text.substring(q);

        //                                 var dataItem = treeView.dataItem($(this));
        //                                 dataItem.set("text", html);

        //                                 $(this).parentsUntil('.k-treeview').filter('.k-item').each(

        //                                 function (index, element) {
        //                                     $('#tree-competency ').data('kendoTreeView').expand($(this));
        //                                     $(this).data('value-item', term);
        //                                 });
        //                             }
        //                         });

        //                         $('#tree-competency .k-item').each(function () {
        //                             if ($(this).data('value-item') != term) {
        //                                 $('#tree-competency ').data('kendoTreeView').collapse($(this));
        //                             }
        //                         });
        //               });



        //               $('#tree-competency').click(function () {
        //                       var selected = tv.select(),
        //                           item = tv.dataItem(selected);
                                  
        //                       if (item) {
        //                           document.getElementById("value-item").value = item.id;                               

        //                       } else {
        //                           $('#log').text('Nothing selected');
        //                       }
        //               }); 

                   
        //           }
                  
        //           return ;
        //       }).fail(Notification.exception);

        //   }); 

        //   // ADD COMPETENTCY POSITION

        //   $('#save-add').click(function(){
                
        //       var comp_id = $('#value-item').val();
        //       var orgstructure_position = $('#orgstructure_position').val();
        //       if(!comp_id)
        //       {
        //         alert("Dữ liệu trống!");
        //       }
        //       else{
        //         var getURL = location.origin + '/local/newsvnr/ajax.php';
        //         $.ajax({
        //           url: getURL,
        //           method: 'POST',
        //           data: {
        //             action: "add",
        //             comp_id: comp_id,
        //             orgstructure_position: orgstructure_position
        //           },
        //           success: function(result)
        //           { 
        //               var data = JSON.parse(result);
        //               if(data == "0")
        //               {
        //                  alert("Vị trí này đã tồn tại");
                       
        //               }
        //               else{
        //                  $('.orgcomp-position .table tbody').append(data.html);
        //                   $('.orgcomp-position .group-modal').append(data.modal);
        //                 alert("Thêm thành công!");
        //               }


        //           }
        //         });

        //       }

        //   });

        //   // FILTER COMPETENTCY 


        //   $('#orgstructure').change(function(){

        //       var org_struct = $(this).val();

        //       if(org_struct != '')
        //       {
        //           var getURL = location.origin + '/local/newsvnr/ajax.php';

        //           $.ajax({
        //             url: getURL,
        //             async:false,
        //             method: 'GET',
        //             data:{
        //               action: "get_orgstruct_position",
        //               org_struct: org_struct
        //             },
        //             success: function(result){

        //               $('#orgstructure_position').html(result);

        //             }
        //           });

        //       }
        //         $('#add_competency').prop('disabled', true);  

        //        $('#orgstructure_position').change(function(){

        //           var org_struct_position = $(this).val();

        //             if(org_struct_position != null)
        //             {
        //                $('#add_competency').prop('disabled', false);  

        //                $.ajax({
        //                 url: getURL,
        //                 async:false,
        //                 method: 'GET',
        //                 data:{
        //                   action: "load_comp_postion",
        //                   org_struct_position: org_struct_position
        //                 },

        //                 success: function(result){
        //                     var data = JSON.parse(result);

        //                     $('.orgcomp-position .table tbody').html(data.table);

        //                     $('.orgcomp-position .group-modal').html(data.modal);
        //                     var table;

        //                     if ( $.fn.dataTable.isDataTable( '#orgcomp-position' ) ) {
        //                         table = $('#orgcomp-position').DataTable();
        //                     }
        //                     else {
        //                         table = $('#orgcomp-position').DataTable( {
        //                              "lengthMenu": [ [2, 25, 50, -1], [2, 25, 50, "All"] ]
        //                         } );
        //                     }
        //                 }
        //               });
        //             }                 

        //         });
              
             

        //   });

        //   $('.list-group li').click(function() {
        //     $(this).addClass('active').siblings().removeClass('active');
        //   });
        // }
        // orgmanager: function(){
        //     $('[data-region="orgmanager-page"] button').click(function(event) {
        //       var param = event.target.id;
        //       var settings = {
        //           // async: false,
        //           type: 'GET',
        //           data: {
        //               section: param
        //           },
        //           processData: true,
        //           contentType: "application/json"
        //       };
        //       var script = Config.wwwroot + '/local/newsvnr/ajax/orgdata.php';
        //       $.ajax(script, settings)
        //       .then(function(response) {

        //           if (response.error) {
        //               Notification.addNotification({
        //                   message: response.error,
        //                   type: "error"
        //               });
        //           } else {

        //               var data = JSON.parse(response);
        //                   // var data = [];
        //                   // data.push(feed);

        //                   $('#showtable_data').html(data.header);
        //                   $('#org_datatable').DataTable();

        //               }
        //               return;
        //           }).fail(Notification.exception);

        //     });
        // }
        // orgstructure: function(){
        //     var clickparent = true;
        //     //chọn parentid cho phòng ban orgstructuer - trang orgstructure
        //   $('#id_parentid').on('click',function() {
        //      if(clickparent == true){
        //         var settings = {
        //             type: 'GET',
        //             processData: true,
        //             data:{
        //               org_struct: 1
        //             },
        //             contentType: "application/json"
        //         };
        //         var script = Config.wwwroot + '/local/newsvnr/ajax.php';
        //         var tvajaxx = $.ajax(script, settings)
        //         .then(function(response) {
        //             if (response.error) {
        //                 Notification.addNotification({
        //                     message: response.error,
        //                     type: "error"
        //                 });
        //             } else {
        //                 // Reload the page, don't show changed data warnings.
        //                 if (typeof window.M.core_formchangechecker !== "undefined") {
        //                     window.M.core_formchangechecker.reset_form_dirty_state();
        //                 }
        //                 // window.location.reload();
        //                 var data = JSON.parse(response);
        //                 var tv = $("#treeview-orgstructure").kendoTreeView({
        //                     dataSource: data,
                            
        //                 }).data('kendoTreeView');
                        
        //                 $('#treeview-orgstructure').on('click','.k-item',function(){
        //                     var selected = tv.select(),item;
                           
        //                     if(selected.length >0)
        //                       item = tv.dataItem(selected);
        //                     if (item) {
        //                         document.getElementById('id_parentid').value = item.id;
                               
        //                     } else {
        //                         $('#log').text('Nothing selected');
        //                     }
        //                      $('#treeview-orgstructure').mouseleave(function(){ 
        //                         $(this).hide(500);
        //                      });
        //                 });
                       
        //             }

        //             clickparent = false;
        //             return;
        //         }).fail(Notification.exception);
        //     } else {
        //          $('#id_parentid').on('click',function() {
        //              $('#treeview-orgstructure').show(500);
        //          });
        //     }
        //   });
        // }
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