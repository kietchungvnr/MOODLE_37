define(['jquery', 'core/config','core/str','local_newsvnr/initkendogrid','alertjs'], ($, Config, Str, kendo, alertify) => {
	let gridName = '#library-approval-module';
	let kendoConfig = {};
	let script = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_approval_module.php';
    var strings = [
    	{
            key: 'type',
            component: 'local_newsvnr'
        },
        {
            key: 'size',
            component: 'local_newsvnr'
        },
        {
            key: 'timecreated',
            component: 'local_newsvnr'
        },
        {
            key: 'author',
            component: 'local_newsvnr'
        },
        {
            key: 'foldername',
            component: 'local_newsvnr'
        },     
        {
            key: 'name',
            component: 'local_newsvnr'
    	},
        {
            key: 'deletemodulesuccess',
            component: 'local_newsvnr'
        },     
        {
            key: 'approvalmodulesuccess',
            component: 'local_newsvnr'
    	} 
    ];
	
	var init = function() {
		Str.get_strings(strings).then(function(s) {
			var settings = {			
				url: script,
				type : 'GET',
	        	dataType: "json",
	            contentType: 'application/json; charset=utf-8',
			};
			var subjectLibraryColums = [
				{
					template:function(e) {
						return e.name;
					},
	                field: "name",
	                title: s[5],
	                width: "200px"
				},
				{
	                field: "type",
	                title: s[0],
	                width: "100px"
				},
				{
	                field: "size",
	                title: s[1],
	                width: "100px"
				},
				{
	                field: "timecreated",
	                title: s[2],
	                width: "120px"
				},
				{
	                field: "author",
	                title: s[3],
	                width: "200px"
				},
				{
	                field: "folder",
	                title: s[4],
	                width: "200px"
				}
			];
			kendoConfig.columns = subjectLibraryColums;
			kendoConfig.apiSettings = settings;
			kendoConfig.approvalModuleEvent = function(dataItem) {
				var grid = $(gridName).data("kendoGrid");
				alertify.notify(s[7],'success',3);
				grid.dataSource.read();
			}
			kendoConfig.deleteModuleEvent = function(dataItem) {
				var grid = $(gridName).data("kendoGrid");
				alertify.notify(s[6],'success',3);
				grid.dataSource.read();
			}
			var gridData = kendo.initGrid(kendoConfig);
			$(gridName).kendoGrid(gridData);
		})
	}
	return {
		init : init
	}
});