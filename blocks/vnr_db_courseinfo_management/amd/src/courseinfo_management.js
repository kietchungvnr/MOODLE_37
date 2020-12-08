define(['jquery', 'core/config','core/str','local_newsvnr/initkendogrid','alertjs'], ($, Config, Str, kendo, alertify) => {
	let gridName = '#courseinfo_management';
	let kendoConfig = {};
	let script = Config.wwwroot + '/blocks/vnr_db_courseinfo_management/ajax/courseinfo_management.php';
    var strings = [
    	{
            key: 'codecourse',
            component: 'local_newsvnr'
        },
        {
            key: 'coursename',
            component: 'local_newsvnr'
        },
        {
            key: 'timeopencourse',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'timeendcourse',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'totalstudent',
            component: 'block_vnr_db_courseinfo_management'
        },     
        {
            key: 'studentunfinished',
            component: 'block_vnr_db_courseinfo_management'
    	},
        {
            key: 'courseaveragepoints',
            component: 'block_vnr_db_courseinfo_management'
        },     
    	{
            key: 'highestpoint',
            component: 'block_vnr_db_courseinfo_management'
    	},
		{
            key: 'lowestpoint',
            component: 'block_vnr_db_courseinfo_management'
    	} 
    ];
	$("#coursedatestart").kendoDatePicker({
		change: onChange
	});
    function onChange() {
    	$('#coursedateend').val('');
    	date = 	$("#coursedatestart").val().split('/');
		if(date.length > 1) {
			var datepicker = $("#coursedateend").data("kendoDatePicker");
			var year = parseInt(date[2]);
			var month = parseInt(date[0]);
			var day = parseInt(date[1]);
			datepicker.setOptions({
		    	min: new Date(year,month-1,day+1)
			});
		}
 	}
	$("#coursedateend").kendoDatePicker();
	var initGrid = function(datestart,dateend) {
		if($(gridName).data("kendoGrid")) {
			$(gridName).data("kendoGrid").destroy();
		}
		Str.get_strings(strings).then(function(s) {
			var settings = {			
				url: script,
				type : 'GET',
	        	dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data : {
	            	datestart: datestart,
	            	dateend: dateend
	            }
			};
			var colums = [
				{
	                field: "courseid",
	                title: s[0],
	                width: "125px"
				},
				{
					template: "<a href='#:href #' target='_blank'>#:coursename #</a>",
	                field: "coursename",
	                title: s[1],
	                width: "200px"
				},
				{
	                field: "startdate",
	                title: s[2],
	                width: "120px"
				},
				{
	                field: "enddate",
	                title: s[3],
	                width: "120px"
				},
				{
					// template: "<div onclick='viewTotalStudent()'><a href='javascript:;'>#:totalstudent #</a></div>",
	                field: "totalstudent",
	                title: s[4],
	                width: "100px"
				},
				{
	                field: "studentunfinish",
	                title: s[5],
	                width: "100px"
				},
				{
	                field: "courseaveragepoint",
	                title: s[6],
	                width: "100px"
				},
				{
	                field: "highestpoint",
	                title: s[7],
	                width: "120px"
				},
				{
	                field: "lowestpoint",
	                title: s[8],
	                width: "100px"
				}
			];
			var toolbar = ["excel","search"]
			var excel = { 
				fileName: "courseinfo.xlsx",
				allPages: true
			}
			kendoConfig.selectable = false;
			kendoConfig.toolbar = toolbar;
			kendoConfig.excel = excel;
			kendoConfig.columns = colums;
			kendoConfig.apiSettings = settings;
			var gridData = kendo.initGrid(kendoConfig);
			$(gridName).kendoGrid(gridData);
		})
	}
	var init = function() {
		initGrid();
		$('#course_search_dashboard').click(function() {
            var datestartpicker = $("#coursedatestart").val();
            var datestart = parseInt((new Date(datestartpicker).getTime() / 1000).toFixed(0));
            var dateendpicker = $("#coursedateend").val();
            var dateend = parseInt((new Date(dateendpicker).getTime() / 1000).toFixed(0))
			initGrid(datestart,dateend);
		})
	}
	return {
		init : init
	}
});