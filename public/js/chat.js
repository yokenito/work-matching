window.onload=function(){window.Echo.channel('chats-channel').listen('ChatCreated',function(data){
    console.log('received a message');
    console.log(data);
    let newmessage = data.chat['message'];
    let user_id = data.chat['user_id'];
    let message = document.querySelector('#scroll');
    var my_id = document.getElementById('my_id').textContent;
    console.log(newmessage);
    console.log(user_id);
    console.log(my_id);
    if(my_id != user_id){
        message.insertAdjacentHTML('beforeend',
        `
        <div class="bms_message bms_left">
            <div class="bms_message_box">
                <div class="bms_message_content">
                    <div class="bms_message_text">`
        + nl2br(newmessage)
        +`</div>
                </div>
            </div>
        </div>
        <div class="bms_clear"></div>
        `
        );
        let target = document.getElementById('scroll');
        target.scrollIntoView(false);
    }
});
}


function nl2br(str) {
    str = str.replace(/\r\n/g, "<br />");
    str = str.replace(/(\n|\r)/g, "<br />");
    return str;
}


function sendmessage(proposal_id){
    var url = `/sample-app-work-matching/public/chatsoket/api/create`;
    var send_message = $('#bms_send_message').val();
    console.log(send_message);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "POST",
        data:{
            "send_message" : send_message
        }
    })
        .done(function(data){
            $('#bms_send_message').val("");
            $('#scroll').append(
                `
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">`
                + nl2br(send_message)
                +`</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div>
                `
            );
            let target = document.getElementById('scroll');
            target.scrollIntoView(false);
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            // 送信失敗を入れる

            console.log('失敗');
        });
        
}

// チャットのデフォルト位置を下部に
let target = document.getElementById('scroll');
target.scrollIntoView(false);