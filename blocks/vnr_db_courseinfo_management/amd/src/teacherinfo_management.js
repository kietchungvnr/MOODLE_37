define(['jquery', 'core/config','core/str','local_newsvnr/initkendogrid','alertjs'], ($, Config, Str, kendo, alertify) => {
	var gridTeacherManagement = '#teacherinfo_management';
	var gridListCourse = '#listcourse_teacher';
	var scriptTeacherManagement = Config.wwwroot + '/blocks/vnr_db_courseinfo_management/ajax/studentinfo_management.php';
	var scriptListCourse = Config.wwwroot + '/blocks/vnr_db_courseinfo_management/ajax/listcourse.php';
    var strings = [
    	{
            key: 'number',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'teachercode',
            component: 'block_vnr_db_courseinfo_management'
        },
        {
            key: 'teachername',
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
            key: 'coursejoin',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'courselist',
            component: 'block_vnr_db_courseinfo_management'
    	},
    	{
            key: 'lastaccess',
            component: 'block_vnr_db_courseinfo_management'
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
	            	role: 3
	            }
			};
			var columns = [
				{
					// hidden: true,
	                field: "usercode",
	                title: s[1],
	                width: "80px"
				},
				{
					// hidden: true,
	                field: "studentname",
	                title: s[2],
	                width: "120px"
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
	                width: "100px"
				},
	            {
	                field: "process",
	                title: s[6],
	                width: "150px"
	            },
	            {
	                field: "gradefinal",
	                title: s[7],
	                width: "80px"
	            },
	            {
	                field: "rank",
	                title: s[8],
	                width: "80px"
	            },

			];
			if($(gridListCourse).data("kendoGrid")) {
				$(gridListCourse).data("kendoGrid").destroy();
			}
			var toolbar = ["excel","search"]
			var excel = { 
				fileName: "teacherinfo.xlsx",
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
		$('.nav-link[data-key="teacherinfo"]').click(function(){
			if($(gridTeacherManagement).data("kendoGrid")) {
				$(gridTeacherManagement).data("kendoGrid").destroy();
			}
			var kendoConfig = {};
			Str.get_strings(strings).then(function(s) {
				var settings = {			
					url: scriptTeacherManagement,
					type : 'GET',
		        	dataType: "json",
		            contentType: 'application/json; charset=utf-8',
		            data: {
		            	role: 3
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
		                width: "200px"
					},
					{
		                field: "lastaccess",
		                title: s[11],
		                width: "250px"
					},
					{
		                field: "coursejoin",
		                title: s[9],
		                width: "100px"
					}
				];
				var toolbar = ["excel","search"]
				var excel = { 
					fileName: "teacherinfo.xlsx",
					allPages: true
				}
				kendoConfig.selectable = false;
				kendoConfig.toolbar = toolbar;
				kendoConfig.excel = excel;
				kendoConfig.columns = columns;
				kendoConfig.apiSettings = settings;
				kendoConfig.viewCourseInfoPopupEvent = function(dataItem) {
					$('#windowteacher').kendoWindow({
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
						setPositionWindow('#windowteacher',100);
					}
	                $('#windowteacher').data("kendoWindow").center().open();
				}
				var gridData = kendo.initGrid(kendoConfig);
				$(gridTeacherManagement).kendoGrid(gridData);
			})
		})
	}
	return {
		init : init
	}
});