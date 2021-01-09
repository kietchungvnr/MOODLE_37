define(['jquery', 'core/config','core/str','local_newsvnr/initkendogrid','alertjs'], ($, Config, Str, kendo, alertify) => {
	var gridStudentManagement = '#studentinfo_management';
	var gridListCourse = '#listcourse_student';
	var scriptStudentManagement = Config.wwwroot + '/blocks/vnr_db_courseinfo_management/ajax/studentinfo_management.php';
	var scriptListCourse = Config.wwwroot + '/blocks/vnr_db_courseinfo_management/ajax/listcourse.php';
    var strings = [
    	{
            key: 'number',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'studentcode',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'student',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'codecourse',
            component: 'local_newsvnr'
        },
        {
            key: 'coursename',
            component: 'local_newsvnr'
        },     
        {
            key: 'finishdate',
            component: 'block_vnr_db_courseinfo_management'
    	},
        {
            key: 'processfinish',
            component: 'block_vnr_db_courseinfo_management'
        },     
        {
            key: 'grade',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'rank',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'coursefinish',
            component: 'local_newsvnr'
    	},
    	{
            key: 'courselist',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'lastaccess',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'status',
            component: 'local_newsvnr',
    	}
    ];
    var initGridCourse = function(userId) {
		var kendoConfig = {};
    	Str.get_strings(strings).then(function(s) {
			var settings = {			
				url: scriptListCourse,
				type : 'GET',
	        	dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data: {
	            	userid: userId,
	            	role: 5
	            }
			};
			var columns = [
				{
					// hidden: true,
	                field: "usercode",
	                title: s[1],
	                width: "70px"
				},
				{
					// hidden: true,
	                field: "studentname",
	                title: s[2],
	                width: "90px"
				},
				{
	                field: "courseid",
	                title: s[3],
	                width: "80px"
				},
				{
	                field: "coursename",
	                title: s[4],
	                width: "150px"
				},
				{
	                field: "timecompleted",
	                title: s[5],
	                width: "80px"
				},
	            {
	            	field: 'process', 
	            	template:"<div class='d-flex participants-collum'><div class='progress course'><div class='progress-bar' role='progressbar' aria-valuenow='#: process #' aria-valuemin='0' aria-valuemax='100' style='width:#: process #'></div></div><div>#: process #</div></div></div>",
	                title: s[6],
	                width: "100px"	
	            },
	            {
	            	template: function(e) {
	            		return e.status;
	            	},	
	                field: "status",
	                title: s[12],
	                width: "80px"
	            },
	            {
	                field: "gradefinal",
	                title: s[7],
	                width: "50px"
	            },
	            {
	                field: "rank",
	                title: s[8],
	                width: "50px"
	            }
			];
			if($(gridListCourse).data("kendoGrid")) {
				$(gridListCourse).data("kendoGrid").destroy();
			}
			var toolbar = ["excel","search"]
			var excel = { 
				fileName: "studentinfo.xlsx",
				allPages: true
			}
			kendoConfig.selectable = false;
			kendoConfig.toolbar = toolbar;
			kendoConfig.excel = excel;
			kendoConfig.columns = columns;
			kendoConfig.apiSettings = settings;
			var gridData = kendo.initGrid(kendoConfig);
			$(gridListCourse).kendoGrid(gridData);
		})
    }
	var init = function() {
		$('.nav-link[data-key="studentinfo"]').click(function(){
			if($(gridStudentManagement).data("kendoGrid")) {
				$(gridStudentManagement).data("kendoGrid").destroy();
			}
			var kendoConfig = {};
			Str.get_strings(strings).then(function(s) {
				var settings = {			
					url: scriptStudentManagement,
					type : 'GET',
		        	dataType: "json",
		            contentType: 'application/json; charset=utf-8',
		            data: {
		            	role: 5
		            }
				};
				var columns = [
					{
		                field: "number",
		                title: s[0],
		                width: "50px"
					},
					{
		                field: "usercode",
		                title: s[1],
		                width: "80px"
					},
					{
						template:function(e){
							 return  e.useravatar + "<a href='"+ e.href +"' target='_blank'>"+ e.name +"</a>"
						},
		                field: "name",
		                title: s[2],
		                width: "150px"
					},
					{
					    field: "lastaccess",
		                title: s[11],
		                width: "250px"
					},
					{
		                field: "enrolledcourse",
		                title: s[9],
		                width: "100px"
					}
				];
				var toolbar = ["excel","search"];
				var excel = { 
					fileName: "studentinfo.xlsx",
					allPages: true
				}
				kendoConfig.selectable = false;
				kendoConfig.toolbar = toolbar;
				kendoConfig.excel = excel;
				kendoConfig.columns = columns;
				kendoConfig.apiSettings = settings;
				kendoConfig.viewCourseInfoPopupEvent = function(dataItem) {
					$('#windowstudent').kendoWindow({
				        width: "1200px",
				        title: s[10],
				        visible: false,
				        open: onOpen,
				        actions: [
				            "Minimize",
				            "Maximize",
				            "Close"
				        ],
					})
					function onOpen(e) {
						initGridCourse(dataItem.userid);
						setPositionWindow('#windowstudent',100);
					}
	                $('#windowstudent').data("kendoWindow").center().open();
				}
				var gridData = kendo.initGrid(kendoConfig);
				$(gridStudentManagement).kendoGrid(gridData);
			})
		})
	}
	return {
		init : init
	}
});