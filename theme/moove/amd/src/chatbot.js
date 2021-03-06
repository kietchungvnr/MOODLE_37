define([
        "jquery", 
        "core/config", 
        "core/str", 
        "core/notification", 
], function($, Config, Str, Notification) {
    "use strict";
    var lastUserMessage, getUserMessage, lastBotMessage, userAnwserTodo = '';
    var SELECTOR = {
            SECLECTHELPBOX: '.help-content-chatbot li',
            SELECTTAGHELP: '.tag-chatbot',
            SUGGESTIONTAGSBOX: '.bot-caption',
            BOTRESPONSEWAIT: '#response-animation',
            KEYUPINPUTMESSAGE: 'input[name=send-message]',
            CHATBOTICON: '#chatbot-icon',
            CHATBOTCHAT: '#chatbot-chat',
            BUTTONCLOSEBOXCHAT: '.tpl-close',
            BUTTONIMAGESENDMSG: '.send-icon path',
            BUTTONSENDMSG: '#send-message',
            MAINCONVERSATION: '.main-conversation-chatbot',
            BOTCHAT: '.bot-chat',
            USERCHAT: '.user-chat',
            TYPEINGMESSAGE: '.typing-chatbot',
            MINIPOPUPCHATBOT: '.mini-popup-chatbot'
    };

    var mainScript = Config.wwwroot;
    var settings, script;

    $(document).ready(function() {
        $(SELECTOR.CHATBOTICON).click(function(){
            if($(SELECTOR.MAINCONVERSATION + ' .bot-chat').length == 0) {
                $(SELECTOR.TYPEINGMESSAGE).attr('style', 'pointer-events: none');
                chatbotResponse('hi').then(async res => {
                    $(SELECTOR.TYPEINGMESSAGE).removeAttr("style");
                    $(SELECTOR.BOTRESPONSEWAIT).replaceWith(enterMessageHtmlToChatBox(res));
                    suggestListTagHTML();
                });
            }
            $(this).animate({bottom: '-55px'});
            $(this).slideToggle();
            $(SELECTOR.MINIPOPUPCHATBOT).fadeOut('fast');
            $(SELECTOR.CHATBOTCHAT).slideToggle();
        });
        $(SELECTOR.BUTTONCLOSEBOXCHAT).click(function(){
            $(SELECTOR.CHATBOTICON).animate({bottom: '55px'});
            $(SELECTOR.CHATBOTCHAT).slideToggle();
            $(SELECTOR.CHATBOTICON).slideToggle();
        });
        $(SELECTOR.KEYUPINPUTMESSAGE).keyup(function() {
            $(SELECTOR.BUTTONIMAGESENDMSG).attr('fill', '#006cff');
            if($(SELECTOR.KEYUPINPUTMESSAGE).val() == '') {
                $(SELECTOR.BUTTONIMAGESENDMSG).attr('fill', '#d7d7d7');
            }
        });
        $(SELECTOR.MINIPOPUPCHATBOT).on('click', function() {
            $(SELECTOR.MINIPOPUPCHATBOT).fadeOut('slow');
        })

        setTimeout(function() {
            if($(SELECTOR.CHATBOTCHAT + ':visible').length == 0) {
                $(SELECTOR.MINIPOPUPCHATBOT).fadeIn('slow');
            }
        }, 10000);
        
    });

    function autoScrollBottom() {
        $('.conversation-chatbot').animate({scrollTop: document.body.scrollHeight},"fast");
    } 

    const wait = async ms => {
        await new Promise(res => setTimeout(res, ms));
    };

    function delay(t, v) {
        return new Promise(function(resolve) { 
            setTimeout(resolve.bind(null, v), t)
        });
    }

    $.urlParam = function(name){
        var urlUserID = $('.text-username').attr('href');
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(urlUserID);
        if (results==null) {
           return null;
        }
        return decodeURI(results[1]) || 0;
    }

    function getUserId() {
        return $.urlParam('id');
    }

    // Hiện thị các tag gợi ý vào chatbot
    async function suggestListTagHTML() {
        var defaultAnswer = botResponseHTML('Bạn có cần tôi hỗ trợ hay không 🤗?');
        await botSendMessage(defaultAnswer);
        enterMessageHtmlToChatBox(botResponseYesNoHTML);
        $('#chatbot-yesno span').click(async function() {
            userAnwserTodo = $(this).text();
            autoScrollBottom();
            $("#chatbot-yesno").remove();
            if(userAnwserTodo == 'Không') {
                var message = botResponseHTML('Nếu bạn cần hỗ trợ, vui lòng nhập "trợ giúp" để được hỗ trợ!');
                await botSendMessage(message);
            } else if(userAnwserTodo == 'Có') {
                enterMessageHtmlToChatBox(userSendMessageHTML(userAnwserTodo));
                var topicMessage = botResponseHTML('Chọn 1 trong các lựa chọn bên dưới được hỗ trợ 💡');
                await botSendMessage(topicMessage);
                enterMessageHtmlToChatBox(botResponseTopicHTML);
                $('#chatbot-topic span').click(function() {
                    userAnwserTodo = $(this).text();
                    autoScrollBottom();
                    userSendMessage(userAnwserTodo);
                    $("#chatbot-topic").remove();
                });
            }
        });
    }

    // Add yes/no tag vào chatbot và xử lý
    async function continueAskChatBotHTML() {
        var defaultAnswer = botResponseHTML('Bạn có muốn được hỗ trợ thêm?');
        await botSendMessage(defaultAnswer);
        enterMessageHtmlToChatBox(botResponseYesNoHTML);
        $('#chatbot-yesno span').click(async function() {
            userAnwserTodo = $(this).text();
            autoScrollBottom();
            $("#chatbot-yesno").remove();
            if(userAnwserTodo == 'Không') {
                var message = botResponseHTML('Nếu bạn cần hỗ trợ, vui lòng nhập "trợ giúp" để được hỗ trợ!');
                await botSendMessage(message);
            } else if(userAnwserTodo == 'Có') {
                enterMessageHtmlToChatBox(userSendMessageHTML(userAnwserTodo));
                var topicMessage = botResponseHTML('Hãy chọn 1 trong những lựa chọn bên dưới để tiếp tục 👇!');
                await botSendMessage(topicMessage);
                enterMessageHtmlToChatBox(botResponseTopicHTML);
                $('#chatbot-topic span').click(function() {
                    userAnwserTodo = $(this).text();
                    autoScrollBottom();
                    userSendMessage(userAnwserTodo);
                    $("#chatbot-topic").remove();
                });
            }
        });

    }

    // Hiện thị các gợi ý khi chọn tag help
    function helpSendMessageHTML(text) {
        var html = '<div class="help-chat"';
        html += '<div class="tpl-text-response-wrapper" data-type="help">';
        html += '<div class="tpl-text-response">';
        html += '<div class="help-content-chatbot">';
        html += '<ul class="list-group">';
        html += '<li class="list-group-item">Xem danh sách khóa học</li>';
        html += '<li class="list-group-item">Xem danh sách khóa giảng</li>';
        html += '<li class="list-group-item">Xem danh sách sách điểm của các khóa học</li>';
        html += '<li class="list-group-item">Xem sự kiện sắp hết hạn</li>';
        html += '<li class="list-group-item">Xem khóa học sắp hết hạn</li>';
        html += '</div>';
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html;
    }

    // add chat của user vào chatbot
    function userSendMessageHTML(text) {
        var html = '<div class="user-chat">';
        html += '<div class="user-response-wrapper">';
        html += '<div class="tpl-text-response-wrapper" data-type="user">';
        html += '<div class="tpl-text-response">';
        html += text;
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html;
    }

    // add chat của bot vào chatbot
    function botResponseHTML(text) {
        var html = '<div class="bot-chat">';
        html += '<div class="user-response-wrapper">';
        html += '<div class="tpl-text-response-wrapper" data-type="bot">';
        html += '<div class="tpl-text-response">';
        html += text;
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html;
    }

    // add chat của bot khi đã qua xử lý của API
    function botResponseFromHelpHTML(text) {
        var html = '<div class="respone-tag-help-chat">';
        html += '<div class="user-response-wrapper">';
        html += '<div class="tpl-text-response-wrapper" data-type="help">';
        html += '<div class="tpl-text-response">';
        html += text;
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html;
    }

    // Aniamtion prechat trên chatbot 
    function botSpinerResponseHTML() {

        var html = '<div class="bot-chat" id="response-animation">';
        html += '<div class="user-response-wrapper">';
        html += '<div class="tpl-text-response-wrapper" data-type="bot">';
        html += '<div class="tpl-text-response">';
        html += '<span class="spinme-left">';
        html += '<div class="spinner">';
        html += '<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3">';
        html += '</div>';
        html += '</span>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html;
    }

    // add tag list vào khung chat
    function botResponseTagHTML(listTag, elementId) {
        var html = '<div class="respone-tag-help-chat mt-0" id="'+elementId+'">';
        html += '<div class="user-response-wrapper">';
        html += '<div class="tpl-text-response-wrapper" data-type="help">';
        html += '<div class="tpl-text-response">';
        html += '<div class="bot-caption m-0">';

        // Render danh sách tag
        $.map( listTag, function(value, index) {
            html += '<span class="tag-chatbot mr-2 mt-1">';
            html += value;
            html += '</span>';
        });

        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        return html; 
    }

    // tag list yes / no
    function botResponseYesNoHTML() {
       
        var elementId = 'chatbot-yesno';
        var listTag = ['Có', 'Không'];
        return botResponseTagHTML(listTag, elementId);

    }
    // tag list todo help 
    function botResponseTopicHTML() {
        var elementId = 'chatbot-topic';
        var listTag = ['Khóa học', 'Bài kiểm tra', 'Bài tập về nhà', 'Kết quả học tập', 'Kết quả học tập', 'Kết quả học tập', 'Kết quả học tập'];
        return botResponseTagHTML(listTag, elementId);
    }

    // tag list khi nhập trợ giúp
    function botResponseHelpTopicHTML() {
        var elementId = 'chatbot-help-topic';
        var listTag = ['Xem danh sách khóa học', 'Xem danh sách khóa giảng', 'Xem danh sách sách điểm của các khóa học', 'Xem sự kiện sắp hết hạn', 'Xem khóa học sắp hết hạn'];
        return botResponseTagHTML(listTag, elementId);
    }

    // event appand new message vào chatbox
    function enterMessageHtmlToChatBox(text) {
        $('.main-conversation-chatbot').append(text);
    }


    // Hiện thị bảng hướng dẫn 
    function showHelpOptions(text) {
        var helpBoxHTML = helpSendMessageHTML(text);
        // enterMessageHtmlToChatBox(helpSendMessageHTML(helpSendMessageHTML));
        return  helpBoxHTML;
    }


    // Bảng hướng dẫn
    function selectHelpOptions(element) {
        $(element).click(function() {
            autoScrollBottom();
            lastUserMessage = $(this).text();
            enterMessageHtmlToChatBox(userSendMessageHTML($(this).text()));
            chatbotResponse(lastUserMessage).then(res => {
                if(res !== undefined) {
                    $(SELECTOR.BOTRESPONSEWAIT).replaceWith(enterMessageHtmlToChatBox(res));
                }
                autoScrollBottom();
            });
            
        });
    }

    // Xử lý khi chọn help tag
    function selectTagHelp(element) {
        $(element).click(function() {
            $(SELECTOR.SUGGESTIONTAGSBOX).fadeOut();
            lastUserMessage = $(this).text();
            enterMessageHtmlToChatBox(userSendMessageHTML(lastUserMessage));
            chatbotResponse(lastUserMessage).then(res => {
                enterMessageHtmlToChatBox(res);
                selectHelpOptions(SELECTOR.SECLECTHELPBOX);
                autoScrollBottom();
            });
            
        });
    }

    // Xóa tất cả các tag trên chatbox khi render dòng chat mới
    function removeTagElement(listTag) {
        $.map(listTag, function(value, index) {
            if($(value).length > 0)
                $(value).remove();
        })
    }


    // Call api xử lý
    var callAjax = (script, settings) => {
        var botMessage = '';
        enterMessageHtmlToChatBox(botSpinerResponseHTML());
        return $.ajax(script, settings)
        .then((resp) => {
            var msg = resp.data[0].html;
            var preBotResponse = resp.data[0].message;
            enterMessageHtmlToChatBox(botResponseHTML(preBotResponse));
            if(msg != undefined) {
                if(msg == '') {
                    botMessage = botResponseHTML(msg);
                } else {
                    botMessage = botResponseFromHelpHTML(msg);
                }
            }
            autoScrollBottom();
            return Promise.resolve(botMessage);
        });
    }

    // Xử lý các input của user và bot
    var chatbotResponse = async function(text) {
        var userId = parseInt(getUserId());
        var botMessage = '';
        var text = text.toLowerCase();
        var listTag = ['#chatbot-yesno', '#chatbot-topic'];
        removeTagElement(listTag);
        switch(true) {
            case text.includes('tạm biệt') || text.includes('bye') || text.includes('thoát') || text.includes('exit'):
                var helpMessage = botResponseHTML('Tạm biệt, nếu cần hỗ trợ hãy gọi tôi nhé 😘!');
                await botSendMessage(helpMessage);
                break;
            case text.includes('hi') || text.includes('xin chào') || text.includes('hello'):
                settings = {
                        type:"POST",
                        data:{
                            userid : userId,
                        },
                        contenttype:"application/json",
                    };
                script = mainScript + '/local/newsvnr/api/chatbot/hello';
                return callAjax(script, settings);
            case text.includes('khóa học'):
                settings = {
                        type:"POST",
                        data:{
                            userid : userId,
                            roleid : 5
                        },
                        contenttype:"application/json",
                    };
                script = mainScript + '/local/newsvnr/api/chatbot/mycourses';
                return await callAjax(script, settings).then((resp) => {
                    console.log(resp)
                    enterMessageHtmlToChatBox(resp)
                    continueAskChatBotHTML();
                });
            case text.includes('khóa giảng'):
                settings = {
                        type:"POST",
                        data:{
                            userid : userId,
                            roleid : 3
                        },
                        contenttype:"application/json",
                    };
                script = mainScript + '/local/newsvnr/api/chatbot/mycourses';
                return await callAjax(script, settings).then((resp) => {
                    console.log(resp)
                    enterMessageHtmlToChatBox(resp)
                    continueAskChatBotHTML();
                });
            case text.includes('help') || text.includes('trợ giúp'):
                var helpMessage = botResponseHTML('Chọn chủ đề hoặc viết câu hỏi của bạn bên dưới 👇!');
                await botSendMessage(helpMessage);
                enterMessageHtmlToChatBox(botResponseHelpTopicHTML);
                $('#chatbot-help-topic span').click(async function() {
                    userAnwserTodo = $(this).text();
                    autoScrollBottom();
                    userSendMessage(userAnwserTodo);
                    $("#chatbot-help-topic").remove();
                });
                break;
            default:
                var defaultAnswer = botResponseHTML('Bạn có cần tôi hỗ trợ hay không 🤗?');
                await botSendMessage(defaultAnswer);
                enterMessageHtmlToChatBox(botResponseYesNoHTML);
                autoScrollBottom();
                $('#chatbot-yesno span').click(async function() {
                    userAnwserTodo = $(this).text();
                    autoScrollBottom();
                    $("#chatbot-yesno").remove();
                    if(userAnwserTodo == 'Không') {
                        var message = botResponseHTML('Nếu bạn cần hỗ trợ, vui lòng nhập "trợ giúp" để được hỗ trợ!');
                        await botSendMessage(message);
                    } else if(userAnwserTodo == 'Có') {
                        enterMessageHtmlToChatBox(userSendMessageHTML(userAnwserTodo));
                        var topicMessage = botResponseHTML('Chọn 1 trong các lựa chọn bên dưới được hỗ trợ 💡');
                        await botSendMessage(topicMessage);
                        enterMessageHtmlToChatBox(botResponseTopicHTML);
                        $('#chatbot-topic span').click(function() {
                            userAnwserTodo = $(this).text();
                            autoScrollBottom();
                            userSendMessage(userAnwserTodo);
                            $("#chatbot-topic").remove();
                        });
                    }
                });
            break;
        }
        
        return Promise.resolve(botMessage); 
    }

    // Tạo animation khi bot tự động chat...
    async function botSendMessage(message = '') {
        enterMessageHtmlToChatBox(botSpinerResponseHTML());
        await delay(500).then(resp => {
            $(SELECTOR.BOTRESPONSEWAIT).replaceWith(message);
            autoScrollBottom();
        })
    }

    // Xử lý message user nhập vào chatbox
    function userSendMessage(message = '') {
        if(message != "") {
            lastUserMessage = message;
        } else {
            lastUserMessage = $(SELECTOR.BUTTONSENDMSG).val();
            document.getElementById('send-message').value = '';
            document.getElementById('send-message').placeholder = 'Type your message here';    
        }
        enterMessageHtmlToChatBox(userSendMessageHTML(lastUserMessage));
        chatbotResponse(lastUserMessage).then(res => {
            $(SELECTOR.BOTRESPONSEWAIT).replaceWith(enterMessageHtmlToChatBox(res));
            autoScrollBottom();
        });
    }
    
    function keyPress(e) {
        var x = e || window.event;
        var key = (x.keyCode || x.which);
        if($(SELECTOR.BUTTONSENDMSG).val() != "") {
           if (key == 13 || key == 3) {
                autoScrollBottom();
                userSendMessage();
            }
        }
    }

    document.onkeypress = keyPress;
});

