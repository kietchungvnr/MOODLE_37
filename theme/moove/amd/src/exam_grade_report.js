define(['jquery', 'kendo.all.min', 'core/config', 'core/notification', 'core/str'], function($, kendo, Config, Notification, Str) {
	    var script = Config.wwwroot + '/local/newsvnr/exam/ajax/exam_grade_report.php?action=';
	    var script2 = Config.wwwroot + '/local/newsvnr/exam/ajax/exam_grade_quiz_report.php?examtype=';
	    // kendo lọc kì thi bắt buộc 
	    $("#exam-required-input").kendoDropDownList({
	        dataTextField: "name",
	        dataValueField: "examid",
	        autoBind: false,
	        filter: "contains",
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'exam_filter_required',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'POST',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });
	    // kendo lọc khóa học bắt buộc 
	    $("#subject-required-input").kendoDropDownList({
	    	cascadeFrom:"exam-required-input",
	        dataTextField: "name",
	        dataValueField: "id",
	        autoBind: false,
	        filter: "contains",
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'subject_filter_required',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'POST',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });
	    // kendo lọc kì thi tự do 
	    $("#exam-free-input").kendoDropDownList({
	        dataTextField: "name",
	        dataValueField: "examid",
	        autoBind: false,
	        filter: "contains",
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'exam_filter_free',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'POST',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });
	    // kendo lọc khóa học tự do
	    $("#subject-free-input").kendoDropDownList({
	    	cascadeFrom:"exam-free-input",
	        dataTextField: "name",
	        dataValueField: "id",
	        autoBind: false,
	        filter: "contains",
	        dataSource: {
	            transport: {
	                read: {
	                    url: script+'subject_filter_free',
	                    contentType: 'application/json; charset=utf-8',
	                    type: 'POST',
	                    dataType: 'json',
	                    serverFiltering: true
	               }
	            }
	        }
	    });

        var examurl = Config.wwwroot + "/grade/report/overview/index.php";
        var currenturl = window.location.href;
	    if (currenturl.indexOf(examurl) >= 0) {
	        // load ajax danh sach quiz trong ki thì bắt buộc
	        $.getJSON(script2+'required', function(data) {
	            $('#exam-required-table').hide().html(data.result).fadeIn('fast');
	        })
    	    // load ajax danh sach quiz trong ki thì tự do
	        $.getJSON(script2+'free', function(data) {
	            $('#exam-free-table').hide().html(data.result).fadeIn('fast');
	        })
	   
	    }
	    // Tìm kiếm quiz bằng kì thi và môn học bắt buộc
        $('#filter_exam_required').click(function() {
	        var examid = $('#exam-required-input').val();
	        var subjectid = $('#subject-required-input').val();
	        $.getJSON(script2+'required&examid='+examid+'&subjectid='+subjectid, function(data) {
	        	$('#exam-required-table').hide().html(data.result).fadeIn('fast');
	        });
    	})
	    // Tìm kiếm quiz bằng kì thi và môn học bắt buộc
        $('#filter_exam_free').click(function() {
	        var examid = $('#exam-free-input').val();
	        var subjectid = $('#subject-free-input').val();
	        $.getJSON(script2+'free&examid='+examid+'&subjectid='+subjectid, function(data) {
	        	$('#exam-free-table').hide().html(data.result).fadeIn('fast');
	        });
    	})
});