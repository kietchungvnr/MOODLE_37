// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Bulk actions for lists of participants.
 *
 * @module     core_user/local/participants/bulkactions
 * @package    core_user
 * @copyright  2020 Andrew Nicols <andrew@nicols.co.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import * as Repository from 'core_user/repository';
import * as Str from 'core/str';
import ModalEvents from 'core/modal_events';
import ModalFactory from 'core/modal_factory';
import Templates from 'core/templates';
import {add as notifyUser} from 'core/toast';
import Ajax from 'core/ajax';
import Fragment from 'core/fragment';
import Config from 'core/config';
import Notification from 'core/notification';
import alertify from 'alertjs';
import kendo from 'kendo.all.min';


/**
 * Show the add note popup
 *
 * @param {Number} courseid
 * @param {Number[]} users
 * @param {String[]} noteStateNames
 * @param {HTMLElement} stateHelpIcon
 * @return {Promise}
 */
export const showAddNote = (courseid, users, noteStateNames, stateHelpIcon) => {
    if (!users.length) {
        // No users were selected.
        return Promise.resolve();
    }

    const states = [];
    for (let key in noteStateNames) {
        switch (key) {
            case 'draft':
                states.push({value: 'personal', label: noteStateNames[key]});
                break;
            case 'public':
                states.push({value: 'course', label: noteStateNames[key], selected: 1});
                break;
            case 'site':
                states.push({value: key, label: noteStateNames[key]});
                break;
        }
    }

    const context = {
        stateNames: states,
        stateHelpIcon: stateHelpIcon.innerHTML,
    };

    let titlePromise = null;
    if (users.length === 1) {
        titlePromise = Str.get_string('addbulknotesingle', 'core_notes');
    } else {
        titlePromise = Str.get_string('addbulknote', 'core_notes', users.length);
    }

    return ModalFactory.create({
        type: ModalFactory.types.SAVE_CANCEL,
        body: Templates.render('core_user/add_bulk_note', context),
        title: titlePromise,
        buttons: {
            save: titlePromise,
        },
        removeOnClose: true,
    })
    .then(modal => {
        modal.getRoot().on(ModalEvents.save, () => submitAddNote(courseid, users, modal));

        modal.show();

        return modal;
    });
};

/**
 * Add a note to this list of users.
 *
 * @param {Number} courseid
 * @param {Number[]} users
 * @param {Modal} modal
 * @return {Promise}
 */
const submitAddNote = (courseid, users, modal) => {
    const text = modal.getRoot().find('form textarea').val();
    const publishstate = modal.getRoot().find('form select').val();

    const notes = users.map(userid => {
        return {
            userid,
            text,
            courseid,
            publishstate,
        };
    });

    return Repository.createNotesForUsers(notes)
    .then(noteIds => {
        if (noteIds.length === 1) {
            return Str.get_string('addbulknotedonesingle', 'core_notes');
        } else {
            return Str.get_string('addbulknotedone', 'core_notes', noteIds.length);
        }
    })
    .then(msg => notifyUser(msg))
    .catch(Notification.exception);
};

/**
 * Show the send message popup.
 *
 * @param {Number[]} users
 * @return {Promise}
 */
export const showSendMessage = users => {
    if (!users.length) {
        // Nothing to do.
        return Promise.resolve();
    }

    let titlePromise;
    if (users.length === 1) {
        titlePromise = Str.get_string('sendbulkmessagesingle', 'core_message');
    } else {
        titlePromise = Str.get_string('sendbulkmessage', 'core_message', users.length);
    }

    return ModalFactory.create({
        type: ModalFactory.types.SAVE_CANCEL,
        body: Templates.render('core_user/send_bulk_message', {}),
        title: titlePromise,
        buttons: {
            save: titlePromise,
        },
        removeOnClose: true,
    })
    .then(modal => {
        modal.getRoot().on(ModalEvents.save, () => {
            submitSendMessage(modal, users);
        });

        modal.show();

        return modal;
    });
};

/**
 * set delay time to load
 * 
 * @param  {[type]} ms [description]
 */
const wait = ms => {
    return new Promise(resolve => {
        setTimeout(resolve, ms);
    });
};
/**
 * Spinner template
 * 
 * @return {[Html]} spinner html
 */
const spinner = () => {
    return '<p class="text-center">'
        + '<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>'
        + '</p>';
}

/**
 * getBody modal
 *
 * @param {Object} formdata
 */
const getBody = formdata => {
    if (typeof formdata === "undefined") {
        formdata = {};
    }
    // Get the content of the modal.
    var params = {jsonformdata: JSON.stringify(formdata)};
    return Fragment.loadFragment('local_newsvnr', 'send_email_form', 1, params).catch(Notification.exception);
}

/**
 * Submit the form via ajax.
 *
 * @param {Object} modal
 */
const submitFormAjax = modal => {
    // We don't want to do a real form submission.
    const form = modal.getRoot().find('form');
    $('button[type="button"]').attr('disabled','disabled');

    // Convert all the form elements values to a serialised string.
    var formData = form.serialize();
    var ids = $('#list-userid').val();
    var courseId = $('#enrolusersbutton-1 input[name=id]').val();
    formData = formData + '&users=' + encodeURI(ids) + '&courseid=' + encodeURI(courseId);
    // Now we can continue...
    modal.setBody(spinner);
    Ajax.call([{
        methodname: 'local_newsvnr_submit_send_email_form',
        args: {contextid: 1, jsonformdata: JSON.stringify(formData)},
    }])[0].then(async function(data) {
        if (data) {
            // We could trigger an event instead.
            // Yuk.
            Y.use('moodle-core-formchangechecker', function() {
                M.core_formchangechecker.reset_form_dirty_state();
            });
            modal.setBody(getBody(formData));
            await wait(2000).then(resp => {
                initKendo();
            });
            alertify.success(M.util.get_string('sendingsuccess', 'local_newsvnr'), 'success', 3);
            $('button[type="button"]').removeAttr('disabled');
        } else {
            modal.setBody(getBody(formData));
            await wait(2000).then(resp => {
                initKendo();
            });
        }
    }).catch(error => {
        Notification.addNotification({
            message: error.message,
            type: 'error',
        });
    });;
}

/**
 * Init kendo template
 *
 * @param {Object} modal
 */
const initKendo = modal => {
    var script = Config.wwwroot + '/local/newsvnr/ajax/email/emailmanagement.php';
    var settingsEmailType = {
        type: 'GET',
        dataType: "json",
        contentType: 'application/json; charset=utf-8',
        data: {
            action: 'get_emailtype',
        }
    }
    $.ajax(script, settingsEmailType)
    .then(function(resp) {
        $('#email-type').kendoDropDownList({
            dataSource: resp,
            dataTextField: "text",
            dataValueField: "value",
            change: function(e) {
                var value = this.value();
                var settingsTemplate = {
                    type: 'GET',
                    dataType: "json",
                    contentType: 'application/json; charset=utf-8',
                    data: {
                        action: 'get_emailcontent',
                        templateid : value
                    }
                }
                $.ajax(script, settingsTemplate)
                .then(function(template) {
                    $('#id_subject').val(template.subject);
                    $('#id_content_editoreditable').html(template.content);
                    $('#id_content_editoreditable').focus();
                });
            }
        });
    });
}

/**
 * Send a email to these users
 * 
 * @param  {[String]} ids [description]
 * @return {[Object]} modal    [description]
 */
export const showSendEmail = ids => {
    return ModalFactory.create({
            type: ModalFactory.types.SAVE_CANCEL,
            title: M.util.get_string('sendemail', 'local_newsvnr'),
            body: getBody()
        })
    .then( async function(modal, title) {
        // Keep a reference to the modal.

        modal.setSaveButtonText(M.util.get_string('sendemail', 'local_newsvnr'));
        // Forms are big, we want a big modal.
        modal.setLarge();

        // We want to reset the form every time it is opened.
        modal.getRoot().on(ModalEvents.hidden, function() {
            modal.getRoot().remove();
        }.bind(this));

        // We want to hide the submit buttons every time it is opened.
        modal.getRoot().on(ModalEvents.shown, function() {
            var idsHtml = '<input class="d-none" id="list-userid" value="' + ids + '">';
            modal.getRoot().append(idsHtml);
            modal.getRoot().append('<style>[data-fieldtype=submit] { display: none ! important; }</style>');
        }.bind(this));

         modal.getRoot().on(ModalEvents.save, e => {
            // Trigger a form submission, so that any mform elements can do final tricks before the form submission
            // is processed.
            // The actual submit even tis captured in the next handler.
            e.preventDefault();
            modal.getRoot().find('form').submit();
        });
        modal.getRoot().on('submit', 'form', e => {
            e.preventDefault();
            submitFormAjax(modal);
        });

        modal.show();

        // wait init kendo template
        await wait(2000).then(resp => {
            initKendo(modal);
        });

        return modal;
    });
}


/**
 * Send a message to these users.
 *
 * @param {Modal} modal
 * @param {Number[]} users
 * @return {Promise}
 */
const submitSendMessage = (modal, users) => {
    const text = modal.getRoot().find('form textarea').val();

    const messages = users.map(touserid => {
        return {
            touserid,
            text,
        };
    });

    return Repository.sendMessagesToUsers(messages)
    .then(messageIds => {
        if (messageIds.length == 1) {
            return Str.get_string('sendbulkmessagesentsingle', 'core_message');
        } else {
            return Str.get_string('sendbulkmessagesent', 'core_message', messageIds.length);
        }
    })
    .then(msg => notifyUser(msg))
    .catch(Notification.exception);
};
