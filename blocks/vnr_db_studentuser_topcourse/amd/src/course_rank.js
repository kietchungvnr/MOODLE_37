define(
    [
        'jquery',
        'core/config',
        'core/notification',
        'core/str',
        'core/templates'
    ],
    function ($ ,Config, notification, Str, templates) {
         return {
            courserank: function() { 
                //Load data 
                var loaddata = (courseid) => {
                    var table = $('#gradelist');
                    var settings = {
                        type: 'GET',
                        processData: true,
                        data:{
                            action: "get_list_topgrade",
                            courseid: courseid
                        },
                        contentType: "application/json"
                    };
                    var script = Config.wwwroot + '/local/newsvnr/ajax.php';
                    $.ajax(script, settings)
                    .then(function(response) {
                        var data = JSON.parse(response);
                        if(data.listtopgrade.length != 0) {
                            templates.render('block_vnr_db_studentuser_topcourse/studentuser_topcourse_data', data).done(function(html, js) {
                                table.replaceWith(html);
                                templates.runTemplateJS(js);
                            }).fail(notification.exception);
                        } 
                        else {
                            table.html('<div class="d-flex w-100 justify-content-center alert alert-info alert-block fade in ">Khoá học chưa có điểm thi</div>');
                        }
                    }).fail(notification.exception);
                }
                var courseid = $('#list_topgrade').val();
                loaddata(courseid);
                // Lấy danh sách khoá học theo thư mục khoá học
                $('#list_topgrade').change(function() {
                    
                    var courseid = $(this).val();
                    loaddata(courseid);
                    
                });     
            }

        }
        
});
