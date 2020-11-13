define(['jquery', 'core/config', 'validatefm', 'local_newsvnr/initkendoexam', 'alertjs', 'core/str', 'kendo.all.min'], ($, Config, Validatefm, kendo, alertify, Str, kendoControl) => {
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

    function getSelectRow(gridname) {
        var myGrid = $(gridname).getKendoGrid();
        var selectedRows = myGrid.select();
        var arrObject = [];
        for (var i = 0; i < selectedRows.length; i++) {
            arrObject.push(myGrid.dataItem(selectedRows[i]));
        }
        return arrObject;
    }

    // Convert datetime to unix
   	function convertDateToUnix(datetime) {
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

    // Chuẩn bị Init form tạo môn thi
    var prepareSubjectExamForm = function(form, action) {
        function clearForm() {
            $('#sxname').val("");
            $('#sxcode').val("");
            $('#sxshortname').val("");
            $('#sxdescription').val("");
            $('#sxvisible').data('kendoSwitch').value(true);
        }
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
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_add">'+M.util.get_string('addnew', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>',
                items: [{
                    field: "sxname",
                    label: M.util.get_string('name', 'local_newsvnr'),
                    validation: {
                        required: true,
                    }
                }, {
                    field: "sxcode",
                    label: M.util.get_string('code', 'local_newsvnr'),
                    validation: {
                        required: true
                    }
                }, {
                    field: "sxshortname",
                    label: M.util.get_string('shortname', 'local_newsvnr'),
                    validation: {
                        required: true
                    }
                }, {
                    field: "sxdescription",
                    label: M.util.get_string('description', 'local_newsvnr'),
                    editor: function(container, options) {
                        $("<textarea class='k-textarea' id='" + options.field + "' name='" + options.field + "' data-bind='value: " + options.field + "'></textarea>").appendTo(container);
                    }
                }, {
                    field: "sxvisible",
                    label: M.util.get_string('examvisible', 'local_newsvnr'),
                    editor: "Switch",
                }],
                submit: function(e) {
                    kendoControl.ui.progress($("#modal-subjectexam"), true);
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
                                    clearForm();
                                alertify.success(resp.success, 'success', 3);
                                kendoControl.ui.progress($("#modal-subjectexam"), false);
                            }
                        });
                    } else {
                        //Form validation failed
                        e.preventDefault(); //So prevent form submission
                        kendoControl.ui.progress($("#modal-subjectexam"), false);
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
                        ruleRequired: M.util.get_string('fieldrequired', 'local_newsvnr')

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
                    buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_add">'+M.util.get_string('addnew', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>'
                });
            } else if(action == 'subjectexam_edit') {
                form.getKendoForm().setOptions({
                    buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="subjectexam_edit">'+M.util.get_string('edit', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>'
                });
            }
        }
    }

    // Chuẩn bị Init form tạo kì thi
    var prepareExamForm = function(form, action) {
        function clearForm() {
            $('#examname').val("");
            $('#examcode').val("");
            $('#subjectexam').data('kendoMultiSelect').value([]);
            $('#examdatestart').data('kendoDateTimePicker').value(new Date());
            $('#examdateend').data('kendoDateTimePicker').value(new Date());
            $('#examvisible').data('kendoSwitch').value(true);
        }
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
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_add">'+M.util.get_string('addnew', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>',
                items: [
                {
                    field: "examtype",
                    label: M.util.get_string('examtype', 'local_newsvnr'),
                    validation: {
                        required: true,
                    },
                    editor: "DropDownList",
                    editorOptions: {
                    	optionLabel: M.util.get_string('selectexamtype', 'local_newsvnr'),
                        dataSource: [
                            { text: M.util.get_string('required', 'local_newsvnr'), value: 0 },
                            { text: M.util.get_string('free', 'local_newsvnr'), value: 1 }
                        ],
                        dataTextField: "text",
                        dataValueField: "value"
                    }
                   
                }, {
                    field: "examname",
                    label: M.util.get_string('name', 'local_newsvnr'),
                    validation: {
                        required: true
                    }
                }, {
                    field: "examcode",
                    label: M.util.get_string('code', 'local_newsvnr'),
                    validation: {
                        required: true
                    }
                }, {
                	field: "subjectexam",
                	label: M.util.get_string('subjectexam', 'local_newsvnr'),
                	validation: {
                		required: true
                	},
                	editor: "MultiSelect",
                	editorOptions: {
                		placeholder: M.util.get_string('selectsubjectexam', 'local_newsvnr'),
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
                    label: M.util.get_string('examdatestart', 'local_newsvnr'),
                    editor: "DateTimePicker",
                    validation: {
                        required: true
                    },
                    editorOptions: {
                    	format: "dd/MM/yyyy hh:mm tt"
                    }
                }, {
                    field: "examdateend",
                    label: M.util.get_string('examdateend', 'local_newsvnr'),
                    editor: "DateTimePicker",
                    validation: {
                        required: true,

                    },
                    editorOptions: {
                    	format: "dd/MM/yyyy hh:mm tt"
                    }
                },
                {
                    field: "examdescription",
                    label: M.util.get_string('description', 'local_newsvnr'),
                    editor: function(container, options) {
                        $("<textarea class='k-textarea' name='" + options.field + "' data-bind='value: " + options.field + "'></textarea>").appendTo(container);
                    }
                }, {
                    field: "examvisible",
                    label: M.util.get_string('required', 'local_newsvnr'),
                    editor: "Switch"
                }],

                submit: function(e) {
                    kendoControl.ui.progress($("#modal-exam"), true);
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
                                if(grid != undefined) {
                                    grid.dataSource.read();
                                    if(settings.data.action == 'exam_add') {
                                       clearForm();
                                    }
                                }

                                alertify.success(resp.success, 'success', 3);
                                kendoControl.ui.progress($("#modal-exam"), false);
                            }
                        });
                    } else {
                        //Form validation failed
                        e.preventDefault(); //So prevent form submission
                        kendoControl.ui.progress($("#modal-exam"), false);
                    }
                }


            });
			function validateExamForm() {
	            var validator = form.kendoValidator({
	                rules: {
                        ruleRequired: function(input) {
                            // console.log(input);
                            // if (input.is("[name=examdescription]")) {
                            //     return true
                            // } else {
                            //     return $.trim(input.val()) !== "";
                            // }
                            return true;
                        },
                        // date: function(intput) {
                        //     if(input.is("[name=examdatestart]") <= new Date()) {
                        //         return false;
                        //     }
                        //     if(input.is("[name=examdatestart]") < input.is("[name=examdateend]")) {
                        //         return false;
                        //     }
                        //     return true;
                        // }
                        // ruleDuplicated: function(input) {
                           
                        // },
                    },
                    messages: {
                        // ruleDuplicated: "Your UserName must be Tom",
                        ruleRequired: M.util.get_string('fieldrequired', 'local_newsvnr'),
                        // date: "Ngày bắt đầu phải lớn hơn kết thúc"

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
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_add">'+M.util.get_string('addnew', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>'
	        	});
	        	clearForm();
        	} else if(action == 'exam_edit') {
        		form.getKendoForm().setOptions({
	        		buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit" data-action="exam_edit">'+M.util.get_string('edit', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>'
	        	});
	        	clearForm();
        	}
        }
    }

    // Chuẩn bị Init form ghi danh học viên vào kì thi    
    var prepareEnrollExamUsersForm = function(form, dataItem) {
        if(form.getKendoForm() == undefined) {
            var settingsUsers = {
                url: script,
                type: 'GET',
                dataType: "json",
                contentType: 'application/json; charset=utf-8',
                data: {
                    action: 'list_users',
                    examid: dataItem.id
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
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit">'+M.util.get_string('enrol', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>',
                items: [
                    {
                        field: "examusers",
                        label: M.util.get_string('examuserfullname', 'local_newsvnr'),
                        // validation: {
                        //  required: true
                        // },
                        editor: "MultiSelect",
                        editorOptions: {
                            placeholder: M.util.get_string('selectusers', 'local_newsvnr'),
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
                        label: M.util.get_string('cohort', 'local_newsvnr'),
                        // validation: {
                        //  required: true
                        // },
                        editor: "MultiSelect",
                        editorOptions: {
                            placeholder: M.util.get_string('selectcohort', 'local_newsvnr'),
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
                        label: M.util.get_string('role', 'local_newsvnr'),
                        editor: "DropDownList",
                        validation: {
                            required: true
                        },
                        editorOptions: {
                            dataSource: [
                                { text: M.util.get_string('studentrole', 'local_newsvnr'), value: 5 },
                                { text: M.util.get_string('teacherrole', 'local_newsvnr'), value: 4 }
                            ],
                            dataTextField: "text",
                            dataValueField: "value"
                        }
                    }
                ],
                submit: function(e) {
                    kendoControl.ui.progress($("#modal-enrollexamusers"), true);
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
                                var gridEnrollView = $("#exam-users-grid").data('kendoGrid');
                                grid.dataSource.read();
                                // if(gridEnrollView != undefined) {
                                //     gridEnrollView.dataSource.read();
                                // }
                                $("#examusers").data("kendoMultiSelect").value("");
                                $("#examcohort").data("kendoMultiSelect").value("");
                                $("#examusers").data("kendoMultiSelect").dataSource.read();
                                alertify.success(resp.success, 'success', 3);
                                kendoControl.ui.progress($("#modal-enrollexamusers"), false);
                            }
                    })
                }
            })
        }
    }
   
    // Chuẩn bị Init Form edit học viên đã ghi danh vào kì thi
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
                buttonsTemplate: '<button class="k-button k-primary k-form-submit" type="submit">'+M.util.get_string('edit', 'local_newsvnr')+'</button><button class="k-button k-form-clear">'+M.util.get_string('clear', 'local_newsvnr')+'</button>',
                items: [
                {
                    field: "examuserfullname",
                    label: M.util.get_string('examuserfullname', 'local_newsvnr'),
                    validation: {
                        required: true
                    },
                    attributes: {
                        enable: false
                    }
                }, {
                    field: "examusersrole",
                    label: M.util.get_string('role', 'local_newsvnr'),
                    validation: {
                        required: true,
                    },
                    editor: "DropDownList",
                    editorOptions: {
                        dataSource: [
                            { text: M.util.get_string('studentrole', 'local_newsvnr'), value: 5 },
                            { text: M.util.get_string('teacherrole', 'local_newsvnr'), value: 4 }
                        ],
                        dataTextField: "text",
                        dataValueField: "value"
                    }
                }],

                submit: function(e) {
                    kendoControl.ui.progress($("#modal-enrollexamusers-edit"), true);
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
                            var gridEnrollView = $("#exam-users-grid").data('kendoGrid');
                            grid.dataSource.read();
                            // if(gridEnrollView != undefined) {
                            //     gridEnrollView.dataSource.read();
                            // }
                            alertify.success(resp.success, 'success', 3);
                            kendoControl.ui.progress($("#modal-enrollexamusers-edit"), false);
                        }
                    });
                },

            });
        }
    }

    // Tạo modal form môn thi
    var initExamSubjectForm = function() {
        
        var validationSuccess = $("#validation-success");
        var form = $("#form-subjectexam"),
            dialog = $('#modal-subjectexam'),
            undo = $("#btn-subjectexam");

        undo.click(function() {
            dialog.data("kendoWindow").open();
            $('#sxname').val("");
            $('#sxcode').val("");
            $('#sxshortname').val("");
            $('#sxdescription').val("");
            $('#sxvisible').data('kendoSwitch').value(true);

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
            title: M.util.get_string('createsubjectexam', 'local_newsvnr'),
            modal: true,
            close: onClose,
            visible: false,
            open: onOpen,
        });
        dialog.data("kendoWindow").close();
    }

    // Tạo moda form kỳ thi
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
            title: M.util.get_string('createexam', 'local_newsvnr'),
            modal: true,
            close: onClose,
            open: onOpen
        });
        dialog.data("kendoWindow").close();
    }
    
    // Tạo modal form ghi danh học viên vào kỳ thi
    var initEnrollExamUsers = function(form, dialog, dataItem) {
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
                title: M.util.get_string('name', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "fullname",
                title: M.util.get_string('examuserfullname', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "rolename",
                title: M.util.get_string('role', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "usercreate",
                title: M.util.get_string('usercreate', 'local_newsvnr'),
                width: "200px"
            }
        ];
        kendoConfig.columns = examUsersColumns;
        kendoConfig.apiSettings = settingsExamUserGrid;

        // Chỉnh sửa ghi danh  học viên đã được ghi danh
        kendoConfig.editEvent = function(enrollExamUsersDataItem) {
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
                    var gridEnrollView = $("#exam-users-grid").data('kendoGrid');
                    grid.dataSource.read();
                    // if(gridEnrollView != undefined) {
                    //     gridEnrollView.dataSource.read();
                    // }
                    // alertify.success(resp.success, 'success', 3);
                }
            });
        }

        var gridData = kendo.initGrid(kendoConfig);
        $(gridEnrollExamUsers).kendoGrid(gridData);
    }

    // Tạo modal form chỉnh sửa học viên đã ghi danh vào kỳ thi
    var initEditEnrollExamUsers = function(form, dialog) {
        function onOpen(e) {
            prepareEditEnrollExamUsersForm(form);
            e.sender.center();
        }
        dialog.kendoWindow({
            width: "768px",
            title: M.util.get_string('editenrollexamuser', 'local_newsvnr'),
            modal: true,
            open: onOpen,
        });
            
        dialog.data("kendoWindow").close();
    }

    // Tạo màn hình môn thi
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
            title: M.util.get_string('name', 'local_newsvnr'),
            width: "200px"
        }, {
            field: "code",
            title: M.util.get_string('code', 'local_newsvnr'),
            width: "150px"
        }, {
            field: "shortname",
            title: M.util.get_string('shortname', 'local_newsvnr'),
            width: "150px"
        }, {
            field: "description",
            title: M.util.get_string('description', 'local_newsvnr'),
            width: "200px"
        }];
        kendoConfig.columns = subjectExamColumns;
        kendoConfig.apiSettings = settings;
        kendoConfig.toolbar = [{
                                template: '<a class="btn btn-secondary" id="btn-subjectexam-delete" href="javascript:;">'+M.util.get_string('deleteall', 'local_newsvnr')+'</a>'},"search"
                              ];
        kendoConfig.editEvent = function(dataItem) {
        	actionExamSubjectForm = 'subjectexam_edit';
        	var form = $('#form-subjectexam');
            if (dataItem.visible == 1) {
                dataItem.visible = true;
            } else {
                dataItem.visible = false;
            }
            
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
        $("#btn-subjectexam-delete").click(function() {
            var selectedRows = getSelectRow(gridSubjectExam);
            if(selectedRows.length > 0 ) {
                var settingsSelectedRows = {
                    type: "POST",
                    processData: true,
                    // dataType: "json",
                    // contentType: 'application/json; charset=utf-8',
                    data: {
                        action: 'subjectexam_delete_all',
                        rowselected: JSON.stringify(selectedRows)
                    }
                }
                $.ajax(script, settingsSelectedRows).then(function(resp) {
                    if(resp.success) {
                        $(gridSubjectExam).data("kendoGrid").dataSource.read();
                        alertify.success(resp.success, 'success', 3);
                    }
                })
            } else {
                alertify.error(M.util.get_string('error_norowselectd', 'local_newsvnr'), 'error', 3);
            }
        })
    }

    // Tạo màn hình kỳ thi
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
                title: M.util.get_string('name', 'local_newsvnr'),
                width: "200px"
            }, 
            {
                field: "code",
                title: M.util.get_string('code', 'local_newsvnr'),
                width: "200px"
            }, {
                field: "type",
                title: M.util.get_string('type', 'local_newsvnr'),
                width: "200px"
            }, {
                field: "description",
                title: M.util.get_string('description', 'local_newsvnr'),
                width: "200px"
            }, {
                field: "datestart",
                title: M.util.get_string('examdatestart', 'local_newsvnr'),
                width: "200px"
            }, {
                field: "dateend",
                title: M.util.get_string('examdateend', 'local_newsvnr'),
                width: "200px"
            }, {
                field: "usercreate",
                title: M.util.get_string('usercreate', 'local_newsvnr'),
                width: "200px"
            }
        ];
        kendoConfig.columns = examColumns;
        kendoConfig.apiSettings = settings;
        kendoConfig.toolbar = [{
                                template: '<a class="btn btn-secondary" id="btn-exam-delete" href="javascript:;">'+M.util.get_string('deleteall', 'local_newsvnr')+'</a>'},"search"
                              ];
        kendoConfig.editEvent = function(dataItem) {
        	var form = $('#form-exam');
        	actionExamForm = 'exam_edit';
            if(dataItem.type == M.util.get_string('required', 'local_newsvnr')) {
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
       		var form = $("#form-enrollexamusers"),
       	    dialog = $("#modal-enrollexamusers");
       		initEnrollExamUsers(form, dialog, dataItem);
            function onOpen(e) {
                prepareEnrollExamUsersForm(form, dataItem);
                e.sender.center();
            }

            dialog.kendoWindow({
                width: "1000px",
                title: M.util.get_string('enrollexamuser', 'local_newsvnr'),
                modal: true,
                visible: true,
                open: onOpen
            });
           
            // window.addEventListener('resize', function(event){
            //     var newWidth = window.innerWidth;
            //     var newHeight = window.innerHeight;
            //     dialog.data('kendoWindow').setOptions({
            //         width: newWidth,
            //         position: {
            //             top: "10%",
            //             left: "10%"
            //         }
            //     });
            // });
       		dialog.data('kendoWindow').open();
       	}
        kendoConfig.deleteEvent = function(dataItem) {
            alertify.confirm(M.util.get_string("confirm_datadelete", "local_newsvnr"), M.util.get_string("warning_examdelete", "local_newsvnr"),
                function(){
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
                },function(){ 

                }
            );
        	
        }
        var gridData = kendo.initGrid(kendoConfig);
        $(gridExam).kendoGrid(gridData);
        $("#btn-exam-delete").click(function() {
            var selectedRows = getSelectRow(gridExam);
            if(selectedRows.length > 0 ) {
                alertify.confirm(M.util.get_string("confirm_datadelete", "local_newsvnr"), M.util.get_string("warning_examdelete", "local_newsvnr"),
                    function(){
                        var settingsSelectedRows = {
                            type: "POST",
                            processData: true,
                            // dataType: "json",
                            // contentType: 'application/json; charset=utf-8',
                            data: {
                                action: 'exam_delete_all',
                                rowselected: JSON.stringify(selectedRows)
                            }
                        }
                        $.ajax(script, settingsSelectedRows).then(function(resp) {
                            if(resp.success) {
                                $(gridExam).data("kendoGrid").dataSource.read();
                                alertify.success(resp.success, 'success', 3);
                            }
                        })
                    },function(){ 

                    }
                );
            } else {
                alertify.error(M.util.get_string('error_norowselectd', 'local_newsvnr'), 'error', 3);
            }
        })
    }
    
    // JS cho màn hình quản lý kỳ thi view //

    // Grid cho danh sách môn thi màn hình quản lý kỳ thi 
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
                title: M.util.get_string('name', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "numbersubjectexam",
                title: M.util.get_string('numbersubjectexam', 'local_newsvnr'),
                width: "200px"
            },
        ];
        kendoConfig.columns = listSubjectExamColumns;
        kendoConfig.apiSettings = settingsListSbujectExam;
        var gridData = kendo.initGrid(kendoConfig);
        $("#exam-list-grid").kendoGrid(gridData);

    }
    
    // Grid cho danh sách học viên trong kỳ thi màn hình quản lý kỳ thi 
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
                title: M.util.get_string('numbersubjectexam', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "email",
                title: M.util.get_string('email', 'local_newsvnr'),
                width: "200px"
            },
            {
                field: "enrolltime",
                title: M.util.get_string('enrolltime', 'local_newsvnr'),
                width: "200px"
            }
        ];
        kendoConfig.columns = listSubjectExamColumns;
        kendoConfig.toolbar = [{
                                template: '<a class="btn btn-secondary" id="btn-enrollexamusers" href="javascript:;">'+M.util.get_string('enrol', 'local_newsvnr')+'</a>'},"search"
                              ];
        kendoConfig.apiSettings = settingsListSbujectExam;
        var gridData = kendo.initGrid(kendoConfig);
        $("#exam-users-grid").kendoGrid(gridData);   
        

    }

    // Tạo màn hình quản lý kỳ thi 
    var initViewExam = function() {
        
        $('#btn-exam').click(function(e) {
            e.preventDefault();
            initExamForm();
            $('#modal-exam').data("kendoWindow").open();
        })

        $('#exam-type').kendoDropDownList({
            dataSource: [
                { text: M.util.get_string('listexamrequired', 'local_newsvnr'), value: 0 },
                { text: M.util.get_string('listexamfree', 'local_newsvnr'), value: 1 }
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
            $(this).addClass('active').siblings().removeClass('active');
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
        var examId = $('#exam-category li.active').attr('data-exam');
        prepareListUsersGrid(examId);

        $('#btn-enrollexamusers').click(function() {
            var form = $("#form-enrollexamusers"),
            dialog = $("#modal-enrollexamusers");
            dataItem = {};
            dataItem.id = $('#exam-category li.active').attr('data-exam');
            initEnrollExamUsers(form, dialog, dataItem);
            function onOpen(e) {
                prepareEnrollExamUsersForm(form, dataItem);
                e.sender.center();
            }
            dialog.kendoWindow({
                width: "1000px",
                height: "768px",
                title: M.util.get_string('enrollexamuser', 'local_newsvnr'),
                modal: true,
                visible: true,
                open: onOpen
            });
            dialog.data('kendoWindow').open();
        })
        
    }

    return {
        initExamSubject: initExamSubject,
        initExam: initExam,
        initViewExam: initViewExam
    }
});