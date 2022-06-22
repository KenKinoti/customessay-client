$(document).ready(function () {
    let locale = $('html').attr('lang');

    $('.unread .collapse').on('shown.bs.collapse', function () {
        var id = $(this).data('message-id');
        $(this).parent('.message').removeClass('unread');

        $.ajax({
            url: window.location.protocol + "//" + window.location.hostname + "/" + locale + "/messages/read",
            method: "post",
            data: {"_token": $('meta[name=csrf-token]').attr('content'), "message_id": id},
            dataType: "JSON",
            success: function (data) {
                if (data.count > 0) {
                    $('#message-counter').text(data.count)
                }
                else {
                    $('#message-counter').text(data.count).hide()
                }
            }
        });
    });

    // Update message id on clicking reply
    $('.reply').on('click', function () {
        $('#reply_message #message_id').val($(this).data('message-id'));
    });

    // Message files
    $('#newMessageFiles').MultiFile({
        list: '#newMessageFileList',
        STRING: {
            remove: '<i class="ti ti-trash"></i>'
        }
    });

    // Message files
    $('#replyMessageFiles').MultiFile({
        list: '#replyMessageFileList',
        STRING: {
            remove: '<i class="ti ti-trash"></i>'
        }
    });
});
