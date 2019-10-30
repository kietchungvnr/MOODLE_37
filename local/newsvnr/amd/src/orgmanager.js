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
        
        orgmanager: function(){
            $('[data-region="orgmanager-page"] button').click(function(event) {
              var param = event.target.id;
              var settings = {
                  // async: false,
                  type: 'GET',
                  data: {
                      section: param
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

                      var data = JSON.parse(response);
                          // var data = [];
                          // data.push(feed);

                          $('#showtable_data').html(data.header);
                          $('#org_datatable').DataTable();

                      }
                      return;
                  }).fail(Notification.exception);

            });
        }           
    };
});