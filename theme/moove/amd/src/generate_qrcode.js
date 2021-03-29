define(['jquery', 
	'core/config', 
	'core/str', 
	'core/modal_factory', 
	'core/modal_events', 
	'core/notification', 
	'kendo.all.min'], 
function($, Config, Str, ModalFactory, ModalEvents, Notification, kendo) {
    "use strict";
    var modalObj = {};
    var createModal = function(qrData) {
    	var spinner = '<p class="text-center">'
        + '<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>'
        + '</p>';
       	var strings = [
	                    {
	                        key: 'qrcode',
	                        component: 'theme_moove'
	                    },
	                    {
	                        key: 'qrcode_help',
	                        component: 'theme_moove'
	                    }
	                ];
        // Get the Strings.
        Str.get_strings(strings).then(function(s) {
            // Create the Modal.
            ModalFactory.create({
                type: ModalFactory.types.DEFAULT,
                title: s[0] + '<i class="fa fa-info-circle ml-1" aria-hidden="true" id="k-help-qrcode"></i>',
                body: spinner,
            })
            .done(function(modal) {
            	modalObj = modal;
                var root = modal.getRoot();
                root.on(ModalEvents.hidden, function() {
                    root.remove();
                }.bind(this));
        		modal.setBody(setBodyHtml(qrData));
				initQrCode(qrData, s[1]);
               	modalObj.show();
            });
            return;
        }).catch(function() {
            Notification.exception(new Error('Failed to load string: loading'));
        });
    }

    var setBodyHtml = function(qrData) {
        var html = '<div class="d-block" id="qrConfig">';
        html += '<div id="k-qrcode" class="qr-code"></div>';
        html += '<input type="text" value="'+ qrData +'" class="form-control mb-2" maxlength="250" id="qrValue" data-bind="value: qrValue">';
        html += '<style>@media (min-width: 576px) {.modal-dialog { max-width: 350px !important; }} .modal-body { padding: 0!important;} </style>';
        html += '</div>'
        return html;
    }

    var initQrCode = function(qrData, qrHelp) {
        $(document).ready(function() {
            var qrCode = $("#k-qrcode").kendoQRCode({
                errorCorrection: "H",
                color: "#000000",
                size: 285,
            }).data("kendoQRCode");

            $("#k-help-qrcode").kendoTooltip({
                position: "bottom",
                content: qrHelp,
                width: 344,
                animation: {
                    open: {
                        effects: "zoom",
                        duration: 150
                    }
                }
            });
            if($("#k-qrcode").lenght === 0) {
                Notification.exception(new Error('Not found QR code!'));
                return;
            }
           
            var viewModel = kendo.observable({
                qrValue: qrData,
                setValue: function () {
                    qrCode.value(this.qrValue);
                },
                
            });

            viewModel.bind("change", function (e) {
                if (e.field == "qrValue") {
                    console.log(this)
                    this.setValue();
                }
            });
            kendo.bind($("#qrConfig"), viewModel);
            viewModel.setValue();
            
        })
    }
    var init = function(element, qrData) {
        createModal(qrData);
    }
    return {
    	init : init
    }
});
