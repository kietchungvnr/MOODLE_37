define(['jquery', 'core/config', 'validatefm', 'theme_moove/checkspecialchars', 'local_newsvnr/initkendogrid'], ($, Config, Validatefm, hasSpecialChars, kendo) => {
	let gridName = '#subjectexam-grid';
	let kendoConfig = {};
	let script = Config.wwwroot + '/local/newsvnr/exam/ajax/exam.php';
	var validate_form = function() {
		
		$("#md-form-subjectexam").validate({
			onfocusout: false,
			onkeyup: false,
			onclick: false,
			rules: {
				"subjectexam-name": {
					required: true,
				},
				"subjectexam-code": {
					required: true,
				},
				"subjectexam-shortname": {
					required: true,
				}
			},
			messages: {
				"subjectexam-name": {
					required: "Bắt buộc nhập tên kì thi",
				},
				"subjectexam-code": {
					required: "Bắt buộc nhập mã kì thi",
				},
				"subjectexam-shortname": {
					required: "Bắt buộc nhập tên rút gọn",
				},
			},
			submitHandler: function(form) {
				var id = $('#subjectexam-id').val();
				var name = $('#subjectexam-name').val();
				var code = $('#subjectexam-code').val();
				var shortname = $('#subjectexam-shortname').val();
				var description = $('#subjectexam-description').val();
				if($('#subjectexam-visible').is(':checked') === true)
					var visible = 1;
				else
					var visible = 0;
				var settings = {
					type : 'GET',
                	contentType: "application/json",
					data : {
						subjectexam : {
							id : id,
							name : name,
							code : code,
							shortname : shortname,
							visible : visible,
							description : description
						}
						
					},
				}
				if(id == '') {
					settings.data.action = 'subjectexam';
				} else if(id && $.isNumeric(id)) {
					settings.data.action = 'subjectexam_edit';
				}
				
				$.ajax(script, settings)
				.then(function(resp) {
					var res = JSON.parse(resp);
					if(res.success) {
						$('#show-info').html('<div class="alert alert-success" id="show-info-success"><button type="button" class="close" data-dismiss="alert">&times;</button>' + res.success + '</div>');
						setTimeout(function() {
							$('#show-info-success').remove();
						}, 5000);
						var grid = $(gridName).data("kendoGrid");
						grid.dataSource.read();
					}

				})
		  	}
		});
	}
	var init = function() {
		$('#btn-exam').click(function() {
			$('#modal-exam').modal('show');
		});
		$('#btn-subjectexam').click(function() {
			$('#modal-subjectexam').modal('show');
		});
		
		var settings = {
			url: script,
			type : 'POST',
        	dataType: "json",
            contentType: 'application/json; charset=utf-8',
			data : {
				action : 'subjectexam_grid'
			}
		};
		var subjectExamColums = [
			
						{
			                field: "name",
			                width: "200px"
            			},
            			{
			                field: "code",
			                width: "200px"
            			},
            			{
			                field: "shortname",
			                width: "200px"
            			},
		];
		kendoConfig.columns = subjectExamColums;
		kendoConfig.apiSettings = settings;
		kendoConfig.editEvent = function(dataItem) {
			$('#subjectexam-id').val(dataItem.id);
			$('#subjectexam-name').val(dataItem.name);
			$('#subjectexam-code').val(dataItem.code);
			$('#subjectexam-shortname').val(dataItem.shortname);
			$('#subjectexam-description').val(dataItem.description);
			$('#subjectexam-visible').prop('checked', dataItem.visible);
			$('#modal-subjectexam').modal('show');
		}
		var gridData = kendo.initGrid(kendoConfig);
		$(gridName).kendoGrid(gridData);
		validate_form();
	}
	return {
		init : init
	}

});