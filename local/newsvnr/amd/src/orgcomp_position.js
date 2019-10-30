require.config({
    paths: {
        "kendo.all.min": "/local/newsvnr/js/kendo.all.min",
        "dttable": "/local/newsvnr//js/datatable.min",
    }
});
define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'dttable', 'core/modal_factory', 'core/modal_events', 'core/str'], function($, kendo, Config, Notification, dttable, ModalFactory, ModalEvents, Str) {


    return {
        orgcomp_position: function(){
            $('.list-group-item').click(function(){
              alert('xxx');
          var getID = this.id;
          var script = Config.wwwroot + '/local/newsvnr/ajax.php';
           var settings2 = {
              type: 'GET',
              data: {
                org_competency: 1,
                frameid: getID
              },
              processData: true,
              contentType: "application/json"
          };

          $.ajax(script, settings2)
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

                      console.log(data);


                      var tv = $("#tree-competency").kendoTreeView({
                          dataSource: data,
         
                      }).data('kendoTreeView');


                      $('#value-item').on('keyup', function () {
                               var treeView = $("#tree-competency").getKendoTreeView();
                                treeView.dataSource.data(data);
                                    
                                // ignore if no search term
                                if ($.trim($(this).val()) == '') {
                                    return;
                                }

                                var term = this.value.toUpperCase();
                                var tlen = term.length;

                                $('#tree-competency span.k-in').each(function (index) {
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

                                        function (index, element) {
                                            $('#tree-competency ').data('kendoTreeView').expand($(this));
                                            $(this).data('value-item', term);
                                        });
                                    }
                                });

                                $('#tree-competency .k-item').each(function () {
                                    if ($(this).data('value-item') != term) {
                                        $('#tree-competency ').data('kendoTreeView').collapse($(this));
                                    }
                                });
                      });



                      $('#tree-competency').click(function () {
                              var selected = tv.select(),
                                  item = tv.dataItem(selected);
                                  
                              if (item) {
                                  document.getElementById("value-item").value = item.id;                               

                              } else {
                                  $('#log').text('Nothing selected');
                              }
                      }); 

                   
                  }
                  
                  return ;
              }).fail(Notification.exception);

          }); 

          // ADD COMPETENTCY POSITION

          $('#save-add').click(function(){
                
              var comp_id = $('#value-item').val();
              var orgstructure_position = $('#orgstructure_position').val();
              if(!comp_id)
              {
                alert("Dữ liệu trống!");
              }
              else{
                var getURL = location.origin + '/local/newsvnr/ajax.php';
                $.ajax({
                  url: getURL,
                  method: 'POST',
                  data: {
                    action: "add",
                    comp_id: comp_id,
                    orgstructure_position: orgstructure_position
                  },
                  success: function(result)
                  { 
                      var data = JSON.parse(result);
                      if(data == "0")
                      {
                         alert("Vị trí này đã tồn tại");
                       
                      }
                      else{
                         $('.orgcomp-position .table tbody').append(data.html);
                          $('.orgcomp-position .group-modal').append(data.modal);
                        alert("Thêm thành công!");
                      }


                  }
                });

              }

          });

          // FILTER COMPETENTCY 


          // $('#orgstructure').change(function(){

          //     var org_struct = $(this).val();

          //     if(org_struct != '')
          //     {
          //         var getURL = location.origin + '/local/newsvnr/ajax.php';

          //         $.ajax({
          //           url: getURL,
          //           async:false,
          //           method: 'GET',
          //           data:{
          //             action: "get_orgstruct_position",
          //             org_struct: org_struct
          //           },
          //           success: function(result){

          //             $('#orgstructure_position').html(result);

          //           }
          //         });

          //     }
          //       $('#add_competency').prop('disabled', true);       

          // });


          //    $('#orgstructure_position').change(function(){

          //       var org_struct_position = $(this).val();

          //         if(org_struct_position != null)
          //         {
          //            $('#add_competency').prop('disabled', false);  

          //            $.ajax({
          //             url: getURL,
          //             async:false,
          //             method: 'GET',
          //             data:{
          //               action: "load_comp_postion",
          //               org_struct_position: org_struct_position
          //             },

          //             success: function(result){
          //                 var data = JSON.parse(result);

          //                 $('.orgcomp-position .table tbody').html(data.table);

          //                 $('.orgcomp-position .group-modal').html(data.modal);
          //                 var table;

          //                 if ( $.fn.dataTable.isDataTable( '#orgcomp-position' ) ) {
          //                     table = $('#orgcomp-position').DataTable();
          //                 }
          //                 else {
          //                     table = $('#orgcomp-position').DataTable( {
          //                          "lengthMenu": [ [2, 25, 50, -1], [2, 25, 50, "All"] ]
          //                     } );
          //                 }
          //             }
          //           });
          //         }                 

          //     });



          $('.list-group li').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
          });
        }
      
        
    };
});