// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contain the logic for the add random question modal.
 *
 * @module     mod_quiz/edit_all_question
 * @package    mod_quiz
 * @copyright  2020 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define([
    'jquery',
    'core/notification',
    'core/templates',
    'core/config',
    'core/str'
],
function(
    $,
    Notification,
    Templates,
    Config,
    Str
) {
	var editquestion = function () {
		$(document).ready(function(){
	        $('input[name="all"]').bind('click', function(){
	            $('input[name="slot[]"]').not(this).prop('checked', this.checked);
	        });
	    });
	    $('#selectmultiplecommand').click(function() {
				$('input[name="slot[]"]').addClass('d-none');
				$('#changeallmark').addClass('d-none');
		});
		$('#selectmultiplecancelcommand').click(function() {
				$('input[name="slot[]"]').removeClass('d-none');
				$('#changeallmark').removeClass('d-none');
		});
		
	    $("#changemark").click(function () {
	        var selected = new Array();
	        $('input[name="slot[]"]:checked').each(function () {
	            selected.push(this.value);
	        });
	        if (selected.length > 0) {
	            var url_string = window.location.href;
				var url = new URL(url_string);
				var cmid = url.searchParams.get("cmid");
	       		var maxmark = $('#maxmark').val();
	        	var script = Config.wwwroot + '/mod/quiz/edit_rest.php';
	        	var settings = {
	        		type: 'POST',
	                data: {
	                    "class" : "resource",
	                    "field" : "updateallmaxmark",
	                    "maxmark" : maxmark,
	                    "listid" : selected.join(","),
	                    "cmid" : cmid,
	                    "quizid" : 0,
	                    "sesskey" : M.cfg.sesskey
	                },
	                processData: true,
		        };
	        	$.ajax(script, settings)
			    .then(function(response) {
			    	if (response.error) {
		             	Notification.addNotification({
			                message: response.error,
			                type: "error"
		            	});
          			} else {
          				selected.forEach(questioid => 
          					$('#slot-' + questioid + ' .instancemaxmark.decimalplaces_2').text(response.instancemaxmark)
          				);
          				$('.mod_quiz_summarks').text(response.newsummarks);
          				Str.get_string('changeallmarksuccess', 'mod_quiz')
                           .then(function(s) {
			                alert(s);
			            }).fail(Notification.exception)
          			}
          			return;
			    }).fail(Notification.exception);
			}
		});
	}
	return {
		editquestion: editquestion,
	}
	
});