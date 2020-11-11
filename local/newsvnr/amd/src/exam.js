define(['jquery', 'core/config', 'validatefm', 'local_newsvnr/initkendoexam', 'alertjs'], ($, Config, Validatefm, kendo, alertify) => {
    // Kì thi bắt buộc = 0
    // Kì thi tư do = 1
    const EXAMTYPEREQUIRED = 0;
    const EXAMTYPEFREEDOM = 1;
    let gridSubjectExam = '#subjectexam-grid';
    let gridExam = '#exam-grid';
    let gridEnrollExamUsers = '#enrollexamusers-grid';
    let script = Config.wwwroot + '/local/newsvnr/exam/ajax/exam.php';
    let scriptExamView = Config.wwwroot + '/local/newsvnr/exam/ajax/exam_view.php';
    var actionExamSubjectForm = '', 
    	actionExamForm = '';
   	function convertDateToUnix(datetime) {
        debugger
   		// var date = new Date(datetime.getYear(), datetime.getMonth(), datetime.getDay(), datetime.getHours(), datetime.getMinutes()).toUTCString();
        var date = new Date(datetime).toUTCString();
   		var result = (new Date(date).getTime() / 1000) + (3600*7);
   		return result;
   	}

    var initDialog = function(config) {
        var elModal = config.modalElement;
        var modal = elWindow.kendoWindow({
            width: config.width,
            height: config.height,
            title: config.titleModal,
            modal: config.isModal,
            close: onClose,
            open: onOpen,
            visible: false
        });
    }

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
                if ($('#subjectexam-visible').is(':checked') === true) var visible = 1;
                else var visible = 0;
                var settings = {
                    type: 'GET',
                    contentType: "application/json",
                    data: {
                        subjectexam: {
                            id: id,
                            name: name,
                            code: code,
                            shortname: shortname,
                            visible: visible,
                            description: description
                        }
                    },
                }
                if (id == '') {
                    settings.data.action = 'subjectexam';
                } else if (id && $.isNumeric(id)) {
                    settings.data.action = 'subjectexam_edit';
                }
                $.ajax(script, settings).then(function(resp) {
                    var res = JSON.parse(resp);
                    if (res.success) {
                        var grid = $(gridSubjectExam).data("kendoGrid");
                        grid.dataSource.read();
                    }
                })
            }
        });
    }

    var prepareExamForm = function(form, action) {
    	if (form.getKendoForm() == undefined) {
    		
        	var settings = {
        		url: script,
        		type: 'GET',
        		dataType: 'json',
        		data: {
        			action: 'list_subjectexam'
        		}
        	}
            var initFrm = form.kendoForm({
                orientation: "vertical",
                formData: {
                    examid: "",
                    examname: "",
                    examcode: "",
                    examtype: 0,
                    examdatestart: new Date(),
                    examdateend: new Date(),
                    examdescription: "",
                    examvisible: true
                },
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_add">Tạo kì thi</button><button class="k-button k-form-clear">Xóa</button>',
                items: [
                {
                    field: "examtype",
                    label: "Loại kì thi:",
                    validation: {
                        required: true,
                    },
                    editor: "DropDownList",
                    editorOptions: {
                    	optionLabel: "Chọn loại kì thi",
                        dataSource: [
                            { text: "Bắt buộc", value: 0 },
                            { text: "Tự do", value: 1 }
                        ],
                        dataTextField: "text",
                        dataValueField: "value"
                    }
                   
                }, {
                    field: "examname",
                    label: "Tên:",
                    validation: {
                        required: true
                    }
                }, {
                    field: "examcode",
                    label: "Mã:",
                    validation: {
                        required: true
                    }
                }, {
                	field: "subjectexam",
                	label: "Môn thi",
                	// validation: {
                	// 	required: true
                	// },
                	editor: "MultiSelect",
                	editorOptions: {
                		placeholder: "Chọn môn thi",
		                itemTemplate: '<span>#= code # - #= name #</span>',
		                dataTextField: "name",
		                dataValueField: "id",
		                height: 520,
		              
		                dataSource: {
		                    transport: {
		                        read: settings,
				                parameterMap: function(options, operation) {
				                	debugger;
				                    if (operation == "read") {
				                        if (options["filter"]) {
				                        	if(options["filter"]["filters"][0])
				                            	options["q"] = options["filter"]["filters"][0].value;
				                        }
				                        return options;
				                    }
				                }
		                    },
		                    schema: {
		                        model: {
		                        	fields: {
				                        id : { type: "number" },
				                        name: { type: "string" },
				                        code: { type: "string" },
				                    }
		                        }
		                    },
		                    pageSize: 30,
		                    serverPaging: true,
		                    serverFiltering: true
		                },
                	}
                }, {
                    field: "examdatestart",
                    label: "Ngày bắt đầu:",
                    editor: "DateTimePicker",
                    validation: {
                        required: true
                    },
                    editorOptions: {
                    	format: "dd/MM/yyyy hh:mm tt"
                    }
                }, {
                    field: "examdateend",
                    label: "Ngày kết thúc:",
                    editor: "DateTimePicker",
                    validation: {
                        required: true
                    },
                    editorOptions: {
                    	format: "dd/MM/yyyy hh:mm tt"
                    }
                },
                {
                    field: "examdescription",
                    label: "Mô tả:",
                    editor: function(container, options) {
                        $("<textarea class='k-textarea' name='" + options.field + "' data-bind='value: " + options.field + "'></textarea>").appendTo(container);
                    }
                }, {
                    field: "examvisible",
                    label: "Kích hoạt:",
                    editor: "Switch"
                }],

                submit: function(e) {
                    if (validateExamForm()) {
                        e.preventDefault();
                        if(e.model.examdatestart) {
                        	e.model.examdatestart = convertDateToUnix(e.model.examdatestart);
                        }
                        if(e.model.examdateend) {
                        	e.model.examdateend = convertDateToUnix(e.model.examdateend);
                        }
                        if(e.model.subjectexam) {
                        	e.model.subjectexam = $('#subjectexam').data("kendoMultiSelect").value().toString();
                        }
                        if(e.model.visible == true) {
                        	e.model.visible = 1;
                        } else {
                        	e.model.visible = 0;
                        }
                        if(e.model.examtype) {
                        	e.model.examtype = $('#examtype').data("kendoDropDownList").value();
                        }
                        console.log(e.model)

                        var action = $('#form-exam .k-form-submit').attr('data-action');
                        var settings = {
                            type: 'GET',
                            dataType: 'json',
                            contentType: "application/json",
                            data: {
                                action: action,
                                exam: e.model
                            },
                        }
                        $.ajax(script, settings).then(function(resp) {
                            if (resp.success) {
                                var grid = $(gridExam).data('kendoGrid');
                                grid.dataSource.read();
                                if(settings.data.action == 'exam_add') {
                                	form.getKendoForm().clear();
                                }
                                alertify.success(resp.success, 'success', 3);
                            }
                        });
                    } else {
                        //Form validation failed
                        e.preventDefault(); //So prevent form submission
                    }
                },

            });
			function validateExamForm() {
	            var validator = form.kendoValidator({
	                rules: {
	                    minlength: async function(input) {
	                        if (input.is("[name=name]")) {
	                            (async () => {
	                                var settings = {
	                                    url: script,
	                                    type: 'GET',
	                                    contentType: 'application/json; charset=utf-8',
	                                    data: {
	                                        action: 'subjectexam_validate',
	                                        exam: {
	                                            name: input.val()
	                                        }
	                                    }
	                                }
	                                const res = await callAjax(settings);
	                                debugger
	                                if (await res.errors == false) {
	                                    return false;
	                                } else {
	                                    return true;
	                                }
	                            })();
	                        } else {
	                            return true;
	                        }
	                    },
	                    checkcity: function(input) {
	                        //only city will be validated
	                        if (input.is("[name=city]")) {
	                            if (input.val() != "ABC") return false;
	                        }
	                        return true;
	                    }
	                },
	                messages: {
	                    minlength: "Min length required is 4",
	                    checkcity: "City name must be ABC"
	                }
	            }).data("kendoValidator");
	            if (validator.validate()) {
	                return true;
	            } else {
	                // alert("Oops! There is invalid data in the form.\n" + validator.errors());
	                return false;
	            }
	        }
        } else {
        	if(action == 'exam_add') {
        		form.getKendoForm().setOptions({
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_add">Thêm mới</button><button class="k-button k-form-clear">Xóa</button>'
	        	});
	        	form.getKendoForm().clear();
        	} else if(action == 'exam_edit') {
        		form.getKendoForm().setOptions({
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_edit">Chỉnh sửa</button><button class="k-button k-form-clear">Xóa</button>'
	        	});
	        	form.getKendoForm().clear();
        	}
        }
    	
    }

    var prepareEnrollExamUsers = function(form, dataItem) {
    	if(form.getKendoForm() == undefined) {
    		var settingsUsers = {
    			url: script,
	            type: 'GET',
	            dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data: {
	                action: 'list_users'
	            }
    		}
    		var settingsCohort = {
    			url: script,
	            type: 'GET',
	            dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data: {
	                action: 'list_cohort'
	            }
    		} 
    		var initFrm = form.kendoForm({
    			formData: {
    				examid: dataItem.id,
    				examusers: "",
    				examcohort: "",
    				examusersrole: 5
    			},
    			operation: 'vertical',
    			buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit">Ghi danh</button><button class="k-button k-form-clear">Xóa</button>',
    			items: [
	    			{
	                	field: "examusers",
	                	label: "Người dùng",
	                	// validation: {
	                	// 	required: true
	                	// },
	                	editor: "MultiSelect",
	                	editorOptions: {
	                		placeholder: "Chọn người dùng",
			                itemTemplate: '<span>#= fullname #</span>',
			                dataTextField: "fullname",
			                dataValueField: "id",
			                dataSource: {
			                    transport: {
			                        read: settingsUsers,
					                parameterMap: function(options, operation) {
					                	debugger;
					                    if (operation == "read") {
					                        if (options["filter"]) {
					                        	if(options["filter"]["filters"][0])
					                            	options["q"] = options["filter"]["filters"][0].value;
					                        }
					                        return options;
					                    }
					                }
			                    },
			                    schema: {
			                        model: {
			                        	fields: {
					                        id : { type: "number" },
					                        fullname: { type: "string" },
					                    }
			                        }
			                    },
			                    pageSize: 30,
			                    serverPaging: true,
			                    serverFiltering: true
			                },
	                	}
	                }, {
	                	field: "examcohort",
	                	label: "Người dùng",
	                	// validation: {
	                	// 	required: true
	                	// },
	                	editor: "MultiSelect",
	                	editorOptions: {
	                		placeholder: "Chọn nhóm người dùng",
			                itemTemplate: '<span>#= fullname #</span>',
			                dataTextField: "fullname",
			                dataValueField: "id",
			                dataSource: {
			                    transport: {
			                        read: settingsCohort,
					                parameterMap: function(options, operation) {
					                	debugger;
					                    if (operation == "read") {
					                        if (options["filter"]) {
					                        	if(options["filter"]["filters"][0])
					                            	options["q"] = options["filter"]["filters"][0].value;
					                        }
					                        return options;
					                    }
					                }
			                    },
			                    schema: {
			                        model: {
			                        	fields: {
					                        id : { type: "number" },
					                        fullname: { type: "string" },
					                    }
			                        }
			                    },
			                    pageSize: 30,
			                    serverPaging: true,
			                    serverFiltering: true
			                },
	                	}
	                }, {
	                	field: "examusersrole",
	                	label: "Vai trò",
	                	editor: "DropDownList",
                        validation: {
                            required: true
                        },
	                	editorOptions: {
	                        dataSource: [
	                            { text: "Học viên", value: 5 },
	                            { text: "Giáo viên", value: 4 }
	                        ],
	                        dataTextField: "text",
	                        dataValueField: "value"
	                    }
	                }
    			],
    			submit: function(e) {
    				e.preventDefault();
    				if(e.model.examusers) {
    					e.model.examusers = $('#examusers').data("kendoMultiSelect").value().toString();
    				}
    				if(e.model.examcohort) {
    					e.model.examcohort = $('#examcohort').data("kendoMultiSelect").value().toString();
    				}
    				if(e.model.examusersrole) {
    					e.model.examusersrole = $('#examusersrole').data("kendoDropDownList").value();
    				}
                    console.log(e.model)
    				var settingsEnrollExamUsers  = {
    					type: 'GET',
			            dataType: "json",
			            contentType: 'application/json; charset=utf-8',
			            data: {
			                action: 'examusers_enroll',
			                exam: e.model
			            }
    				}
    				$.ajax(script, settingsEnrollExamUsers).then(function(resp) {
    					if (resp.success) {
                                var grid = $(gridEnrollExamUsers).data('kendoGrid');
                                grid.dataSource.read();
                                $("#examusers").data("kendoMultiSelect").value("");
                                $("#examcohort").data("kendoMultiSelect").value("");
                                $("#examusers").data("kendoMultiSelect").dataSource.read();
                                alertify.success(resp.success, 'success', 3);
                            }
    				})
    			}
    		})
    	}
    }

    var prepareSubjectExamForm = function(form, action) {

    	if (form.getKendoForm() == undefined) {
    		
            var initFrm = form.kendoForm({
                orientation: "vertical",
                formData: {
                    sxid: "",
                    sxname: "",
                    sxcode: "",
                    sxshortname: "",
                    sxdescription: "",
                    sxvisible: true
                },
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_add">Thêm mới</button><button class="k-button k-form-clear">Xóa</button>',
                items: [{
                    field: "sxname",
                    label: "Tên:",
                    // validation: {
                    //     required: true,
                    // }
                }, {
                    field: "sxcode",
                    label: "Mã:",
                    // validation: {
                    //     required: true
                    // }
                }, {
                    field: "sxshortname",
                    label: "Tên viết tắt:",
                    // validation: {
                    //     required: true
                    // }
                }, {
                    field: "sxdescription",
                    label: "Mô tả:",
                    editor: function(container, options) {
                        $("<textarea class='k-textarea' name='" + options.field + "' data-bind='value: " + options.field + "'></textarea>").appendTo(container);
                    }
                }, {
                    field: "sxvisible",
                    label: "Kích hoạt:",
                    editor: "Switch"
                }],
                submit: function(e) {
                    debugger;
                    if (validateSubjectExamForm()) {
                        e.preventDefault();
                        var getAction = $('#form-subjectexam .k-form-submit').attr('data-action');
                        var settings = {
                            type: 'GET',
                            dataType: 'json',
                            contentType: "application/json",
                            data: {
                                action: getAction,
                                exam: e.model
                            },
                        }
                        $.ajax(script, settings).then(function(resp) {
                            if (resp.success) {
                                var grid = $(gridSubjectExam).data('kendoGrid');
                                grid.dataSource.read();
                                if(settings.data.action == 'subjectexam_add')
                                	form.getKendoForm().clear();
                                alertify.success(resp.success, 'success', 3);
                            }
                        });
                    } else {
                        //Form validation failed
                        e.preventDefault(); //So prevent form submission
                    }
                }
            });
            function validateSubjectExamForm() {
	            var validator = form.kendoValidator({
	                rules: {
                            ruleRequired: function(input){
                                console.log(input);
                                if (input.is("[name=sxdescription]")) {
                                    return true
                                } else {
                                  return $.trim(input.val()) !== "";
                                }
                            },
                            // ruleDuplicated: function(input) {
                               
                            // },
                        },
                    messages: {
                        // ruleDuplicated: "Your UserName must be Tom",
                        ruleRequired: "Trường này bắt buộc"

                    }
	                   
	            }).data("kendoValidator");
	            if (validator.validate()) {
	                return true;
	            } else {
	                // alert("Oops! There is invalid data in the form.\n" + validator.errors());
	                return false;
	            }
	        }
        } else {
        	if(action == 'subjectexam_add') {
        		form.getKendoForm().setOptions({
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_add">Thêm mới</button><button class="k-button k-form-clear">Xóa</button>'
	        	});
        	} else if(action == 'subjectexam_edit') {
        		form.getKendoForm().setOptions({
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_edit">Chỉnh sửa</button><button class="k-button k-form-clear">Xóa</button>'
	        	});
        	}
        }
    }
    async function getRecord(cell_date) {
        return $.ajax({
            url: script,
            type: 'POST',
            dataType: 'json',
            data: {
                action: "check_duplicated",
                field: cell_date
            }
        })
        .then(response => {
            return response;
            console.log(response)
        });
    }
    var prepareEditEnrollExamUsersForm = function(form) {
        if(form.getKendoForm() == undefined) {
            var initFrm = form.kendoForm({
                orientation: "vertical",
                formData: {
                    enrolluserid: "",
                    examid: "",
                    examuserid: "",
                    examuserfullname: "",
                    examusersrole: 5,
                },
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit">Chỉnh sửa</button><button class="k-button k-form-clear">Xóa</button>',
                items: [
                {
                    field: "examuserfullname",
                    label: "Tên người dùng:",
                    validation: {
                        required: true
                    },
                    attributes: {
                        enable: false
                    }
                }, {
                    field: "examusersrole",
                    label: "Vai trò:",
                    validation: {
                        required: true,
                    },
                    editor: "DropDownList",
                    editorOptions: {
                        dataSource: [
                            { text: "Học viên", value: 5 },
                            { text: "Giáo viên", value: 4 }
                        ],
                        dataTextField: "text",
                        dataValueField: "value"
                    }
                }],

                submit: function(e) {
                    e.preventDefault();
            
                    if(e.model.examtype) {
                        e.model.examtype = $('#examusersrole').data("kendoDropDownList").value();
                    }

                    var settings = {
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json",
                        data: {
                            action: 'examusers_enroll_edit',
                            exam: e.model
                        },
                    }
                    $.ajax(script, settings).then(function(resp) {
                        if (resp.success) {
                            var grid = $(gridEnrollExamUsers).data('kendoGrid');
                            grid.dataSource.read();
                            alertify.success(resp.success, 'success', 3);
                        }
                    });
                },

            });
        }
    }

    var initExamSubjectForm = function() {
        var validationSuccess = $("#validation-success");
        var form = $("#form-subjectexam"),
            dialog = $('#modal-subjectexam'),
            undo = $("#btn-subjectexam");

        undo.click(function() {
            dialog.data("kendoWindow").open();
            $('.k-form-clear').click();

        });

        function onClose() {
            actionExamSubjectForm = 'subjectexam_add';
            undo.fadeIn();
        }

        function onOpen(e) {
            prepareSubjectExamForm(form, actionExamSubjectForm);
            e.sender.center();
        }

        dialog.kendoWindow({
            width: "450px",
            title: "Tạo môn thi",
            modal: true,
            close: onClose,
            visible: false,
            open: onOpen,
        });
        dialog.data("kendoWindow").close();
    }

    var initExamForm = function() {
        var form = $("#form-exam"),
            dialog = $('#modal-exam'),
            undo = $("#btn-exam");

        undo.click(function() {
            dialog.data("kendoWindow").open();
        });
        
        function onClose() {
        	actionExamForm = 'exam_add';
            undo.fadeIn();
        }
        
        function onOpen(e) {
            prepareExamForm(form, actionExamForm);
            e.sender.center();
        }

        dialog.kendoWindow({
            width: "450px",
            title: "Tạo kì thi",
            modal: true,
            close: onClose,
            open: onOpen
        });
        dialog.data("kendoWindow").close();
    }
    
    var initEditEnrollExamUsers = function(form, dialog) {
        function onOpen(e) {
            prepareEditEnrollExamUsersForm(form);
            e.sender.center();
        }
        dialog.kendoWindow({
            width: "768px",
            title: "Chỉnh sửa người dùng ghi danh",
            modal: true,
            open: onOpen,
        });
            
        dialog.data("kendoWindow").close();
    }

    var initEnrollExamUsersForm = function(form, dialog, dataItem) {
    	let kendoConfig = {};
    	var settingsExamUserGrid = {
            url: script,
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'examusers_grid',
                examid: dataItem.id
            }
        };
        var examUsersColumns = [
            {
                field: "examname",
                width: "200px"
            },
            {
                field: "fullname",
                width: "200px"
            },
            {
                field: "rolename",
                width: "200px"
            },
            {
                field: "usercreate",
                width: "200px"
            }
        ];
        kendoConfig.columns = examUsersColumns;
        kendoConfig.apiSettings = settingsExamUserGrid;
        // Chỉnh sửa ghi danh  học viên đã được ghi danh
        kendoConfig.editEvent = function(enrollExamUsersDataItem) {
            console.log(enrollExamUsersDataItem)
            var editEnrollDialog = $('#modal-enrollexamusers-edit'),
                editEnrollForm = $('#form-enrollexamusers-edit');
            initEditEnrollExamUsers(editEnrollForm, editEnrollDialog);
            editEnrollForm.getKendoForm().setOptions({
                formData: {
                    enrolluserid: enrollExamUsersDataItem.id,
                    examid: dataItem.id,
                    examuserid: enrollExamUsersDataItem.userid,
                    examuserfullname: enrollExamUsersDataItem.fullname,
                    examusersrole: enrollExamUsersDataItem.roleid,
                },
            });
            editEnrollDialog.data("kendoWindow").open();;
            
        }
        kendoConfig.deleteEvent = function(enrollExamUsersDataItem) {
            var settings = {
                type: 'GET',
                dataType: "json",
                contentType: 'application/json; charset=utf-8',
                data: {
                    action: 'examusers_enroll_delete',
                    id: enrollExamUsersDataItem.id
                }
            }
            $.ajax(script, settings).then(function(resp) {
                if (resp.success) {
                   var grid = $(gridEnrollExamUsers).data('kendoGrid');
                    grid.dataSource.read();
                    alertify.success(resp.success, 'success', 3);
                }
            });
        }

        var gridData = kendo.initGrid(kendoConfig);
        $(gridEnrollExamUsers).kendoGrid(gridData);
        function onOpen(e) {
            prepareEnrollExamUsers(form, dataItem);
            e.sender.center();
        }

        dialog.kendoWindow({
            width: "450px",
            height: "768px",
            title: "Ghi danh người dùng",
            modal: true,
            open: onOpen
        });
        dialog.data("kendoWindow").close();
    }

    var initExamSubject = function() {
    	let kendoConfig = {};
        initExamSubjectForm();
       
        var settings = {
            url: script,
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'subjectexam_grid'
            }
        };
        var subjectExamColumns = [{
            field: "name",
            width: "200px"
        }, {
            field: "code",
            width: "200px"
        }, {
            field: "shortname",
            width: "200px"
        }, {
            field: "description",
            width: "200px"
        }];
        kendoConfig.columns = subjectExamColumns;
        kendoConfig.apiSettings = settings;
        kendoConfig.editEvent = function(dataItem) {
        	actionExamSubjectForm = 'subjectexam_edit';
        	var form = $('#form-subjectexam');
            console.log(dataItem)
            if (dataItem.visible == 1) {
                dataItem.visible = true;
            } else {
                dataItem.visible = false;
            }
            console.log(dataItem)
            
            prepareSubjectExamForm(form, actionExamSubjectForm);
            form.getKendoForm().setOptions({
                formData: {
                	sxid: dataItem.id,
                    sxname: dataItem.name,
                    sxcode: dataItem.code,
                    sxshortname: dataItem.shortname,
                    sxdescription: dataItem.description,
                    sxvisible: dataItem.visible
                },
            });
          
            $('#modal-subjectexam').data("kendoWindow").open();

        }
        kendoConfig.deleteEvent = function(dataItem) {
        	var settings = {
	            type: 'GET',
	            dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data: {
	                action: 'subjectexam_delete',
	                id: dataItem.id
	            }
        	}
        	$.ajax(script, settings).then(function(resp) {
        		if (resp.success) {
                    var grid = $(gridSubjectExam).data('kendoGrid');
                    grid.dataSource.read();
                    alertify.success(resp.success, 'success', 3);
                }
        	});
        }
        var gridData = kendo.initGrid(kendoConfig);
        $(gridSubjectExam).kendoGrid(gridData);
    }

    var initExam = function() {
    	let kendoConfig = {};
        initExamForm();
     
        var settings = {
            url: script,
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'exam_grid'
            }
        };
        var examColumns = [
            {
                field: "name",
                width: "200px"
            }, 
            {
                field: "code",
                width: "200px"
            }, {
                field: "type",
                width: "200px"
            }, {
                field: "description",
                width: "200px"
            }, {
                field: "datestart",
                width: "200px"
            }, {
                field: "dateend",
                width: "200px"
            }, {
                field: "usercreate",
                width: "200px"
            }
        ];
        kendoConfig.columns = examColumns;
        kendoConfig.apiSettings = settings;
        kendoConfig.editEvent = function(dataItem) {
        	var form = $('#form-exam');
        	actionExamForm = 'exam_edit';
            if(dataItem.type == 'Bắt buộc') {
            	dataItem.type = 0;
            } else {
            	dataItem.type = 1;
            }
            if (dataItem.visible == 1) {
                dataItem.visible = true;
            } else {
                dataItem.visible = false;
            }
            prepareExamForm(form, actionExamForm);
            var settings = {
            	type: 'GET',
            	dataType: 'json',
            	contentType: 'application/json; charset=utf-8',
            	data: {
            		action: 'list_subjectexam_by_examid',
            		examid: dataItem.id
            	}
            }
            var formData = {
            	examid: dataItem.id,
                examname: dataItem.name,
                examcode: dataItem.code,
                examtype: dataItem.type,
                examdatestart: new Date(),
                examdateend: new Date(),
                examdescription: dataItem.description,
            }
            form.getKendoForm().setOptions({
                formData: formData,
            });
            $.ajax(script, settings).then(function(resp) {
            	formData.subjectexam = resp;
            	formData.examvisible = dataItem.visible;
            	form.getKendoForm().setOptions({
                	formData: formData,
                })
            });
            
            $('#modal-exam').data("kendoWindow").open();
        }
       	kendoConfig.enrollExamUsers = function(dataItem) {
            console.log(dataItem);
       		var form = $("#form-enrollexamusers"),
       	    dialog = $("#modal-enrollexamusers");
       		initEnrollExamUsersForm(form, dialog, dataItem);
       		dialog.data('kendoWindow').open();
       	}
        kendoConfig.deleteEvent = function(dataItem) {
        	var settings = {
	            type: 'GET',
	            dataType: "json",
	            contentType: 'application/json; charset=utf-8',
	            data: {
	                action: 'exam_delete',
	                id: dataItem.id
	            }
        	}
        	$.ajax(script, settings).then(function(resp) {
        		if (resp.success) {
                    var grid = $(gridExam).data('kendoGrid');
                    grid.dataSource.read();
                    alertify.success(resp.success, 'success', 3);
                }
        	});
        }
        var gridData = kendo.initGrid(kendoConfig);
        $(gridExam).kendoGrid(gridData);
    }

    var prepareListSubjectExamGrid = function(examId) {
        let kendoConfig = {};
        var settingsListSbujectExam = {
            url: scriptExamView,
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'exam_listsubjectexam_grid',
                examid: examId
            }
        }
        var listSubjectExamColumns = [
            {
                field: "name",
                width: "200px"
            },
            {
                field: "numbersubjectexam",
                width: "200px"
            },
        ];
        kendoConfig.columns = listSubjectExamColumns;
        kendoConfig.apiSettings = settingsListSbujectExam;
        var gridData = kendo.initGrid(kendoConfig);
        $("#exam-list-grid").kendoGrid(gridData);

    }
    var prepareListUsersGrid = function(examId) {
        let kendoConfig = {};
        var settingsListSbujectExam = {
            url: scriptExamView,
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'exam_listusersexam_grid',
                examid: examId
            }
        }
        var listSubjectExamColumns = [
            {
                field: "fullname",
                width: "200px"
            },
            {
                field: "email",
                width: "200px"
            },
            {
                field: "enrolltime",
                width: "200px"
            }
        ];
        kendoConfig.columns = listSubjectExamColumns;
        kendoConfig.apiSettings = settingsListSbujectExam;
        var gridData = kendo.initGrid(kendoConfig);
        $("#exam-users-grid").kendoGrid(gridData);

    }

    var initViewExam = function() {
        
        $('#exam-type').kendoDropDownList({
            dataSource: [
                { text: "Danh sách kì thi bắt buộc", value: 0 },
                { text: "Danh sách kì thi tự do", value: 1 }
            ],
            dataTextField: "text",
            dataValueField: "value",
            change: function(e) {
                var examType = this.value();
                var settingsExamCategory = {
                    type: 'GET',
                    dataType: "json",
                    contentType: 'application/json; charset=utf-8',
                    data: {
                        action: 'exam_category',
                        examtype: examType
                    }
                }
                $.ajax(scriptExamView, settingsExamCategory).then(function(resp) {
                    $('#exam-category').html(resp.category);
                });
            }

        })
        var examType = $('#exam-type').data('kendoDropDownList').value();
        var settingsExamCategory = {
            type: 'GET',
            dataType: "json",
            contentType: 'application/json; charset=utf-8',
            data: {
                action: 'exam_category',
                examtype: examType
            }
        }
        
        $.ajax(scriptExamView, settingsExamCategory).then(function(resp) {
            $('#exam-category').html(resp.category);
        })
        $('#exam-category').on('click', 'li', function(e) {
            var examId = $(this).attr('data-exam');
            var settingsExamDescription = {
                type: 'GET',
                dataType: "json",
                contentType: 'application/json; charset=utf-8',
                data: {
                    action: 'exam_description',
                    examid: examId
                }
            }
            $.ajax(scriptExamView, settingsExamDescription).then(function(resp) {
                console.log(resp)
                $('#ed-name').val(resp.examdescription.name);
                $('#ed-code').val(resp.examdescription.code);
                $('#ed-type').val(resp.examdescription.type);
                $('#ed-datestart').val(resp.examdescription.datestart);
                $('#ed-dateend').val(resp.examdescription.dateend);
                $('#ed-description').val(resp.examdescription.description);
                $('#ed-teacher').html(resp.examdescription.teacher);
                $('#ed-numnberstudent').html(resp.examdescription.numberstudent);
            });
            prepareListSubjectExamGrid(examId);
            prepareListUsersGrid(examId);
            
        });
        
    }

    return {
        initExamSubject: initExamSubject,
        initExam: initExam,
        initViewExam: initViewExam
    }
});