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
    var createModal = function(qrdata) {
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
        // Get the Title String.
        Str.get_strings(strings).then(function(s) {
            // Create the Modal.
            ModalFactory.create({
                type: ModalFactory.types.DEFAULT,
                title: s[0] + '<i class="fa fa-info-circle ml-1" aria-hidden="true" id="k-help-qrcode"></i>',
                body: spinner,
            })
            .done(function(modal) {
            	modalObj = modal;
            	var html = '<div class="d-block">';
            	html += '<div id="k-qrcode" class="qr-code"></div>';
            	html += '<input type="text" value="'+ qrdata +'" class="form-control mb-2" id="text-qrcode" maxlength="250">';
            	html += '<style>@media (min-width: 576px) {.modal-dialog { max-width: 350px !important; }} .modal-body { padding: 0!important;}</style>';
            	html += '</div>'
				// Get Qr code via api
        		modal.setBody(html);
				$(document).ready(function() {
					$("#k-qrcode").kendoQRCode({
		                value: qrdata,
		                errorCorrection: "H",
		                color: "#000000",
		                size: 285,
		            });
		            $("#k-help-qrcode").kendoTooltip({
		            	position: "bottom",
		            	content: s[1],
		            	width: 344,
                        animation: {
                        	open: {
                        		effects: "zoom",
                        		duration: 150
                        	}
                        }
		            });
				})
        		$('#txt-qrcode').focus();
               	modal.show();
            });
            return;
        }).catch(function() {
            Notification.exception(new Error('Failed to load string: loading'));
        });
    }
    var init = function(element, qrdata) {
    	var hasQR = false;
    	$(element).click(function(e) {
    		if(hasQR == false) {
    			hasQR = true
    			createModal(qrdata);	
    		} else {
    			modalObj.show();
    		}
    	})
    }
    return {
    	init : init
    }
});
