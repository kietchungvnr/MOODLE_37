define(['jquery', 'core/config','core/str','local_newsvnr/initkendogrid','alertjs','highcharts'], function($, Config, Str, kendo, alertify, Highcharts) {
	var gridName = '#library-approval-module';
	var gridNameDB = '#library-approval-module-db';
	var kendoConfig = {};
	var kendoConfigDB = {};
	var script = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_approval_module.php';
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
			var subjectLibraryColumsDB = [
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
	                field: "timecreated",
	                title: s[2],
	                width: "120px"
				},
				{
	                field: "author",
	                title: s[3],
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

			kendoConfigDB.columns = subjectLibraryColumsDB;
			kendoConfigDB.apiSettings = settings;
			kendoConfigDB.selectable = false;
			kendoConfigDB.approvalModuleEvent = function(dataItem) {
				var grid = $(gridNameDB).data("kendoGrid");
				alertify.notify(s[7],'success',3);
				grid.dataSource.read();
			}
			kendoConfigDB.deleteModuleEvent = function(dataItem) {
				var grid = $(gridNameDB).data("kendoGrid");
				alertify.notify(s[6],'success',3);
				grid.dataSource.read();
			}

			var gridDataDB = kendo.initGrid(kendoConfigDB);
			$(gridNameDB).kendoGrid(gridDataDB);
		})
	}
	var chart = function() {
		var script = Config.wwwroot + '/local/newsvnr/ajax/library_online/library_chart.php';
	    var settings = {
	        type: 'GET',
	        dataType: 'json',
	        processData: true,
	        contentType: "application/json"
	    };
    	$.ajax(script, settings).then(function(response) {
    		$('#last-access').html(response.lastaccess);
	        Highcharts.chart('access-chart', {
	            chart: {
	                type: 'line',
	                height: 350
	            },
	            title: {
	                text: ''
	            },
	            subtitle: {
	                text: ''
	            }, 
	            xAxis: {
	                categories: response.categories,
	            },
	            yAxis: {
	                title: {
	                    text: ''
	                }
	            },
	            credits: {
	                enabled: false
	            },
	            plotOptions: {
	                line: {
	                    dataLabels: {
	                        enabled: true
	                    },
	                    enableMouseTracking: true
	                }
	            },
	            series: [{
	                name: 'Lượt truy cập thư viện',
	                data: response.series,
	                color: '#ef4914'
	            }]
	        });
		})
	}
	return {
		init : init,
		chart:chart
	}
});