function nice(work_id, elm){
    if(elm.classList.contains('active')){
        var url = `/sample-app-work-matching/public/works/deletenice/${work_id}`;
    } else{
        var url = `/sample-app-work-matching/public/works/nice/${work_id}`;
    }
    console.log(url);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "POST",
    })
        .done(function(data){
            console.log(data);
            // active が設定されていれば除去し、なければ追加
            elm.classList.toggle("active");
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            console.log('失敗');
        });
}

function nl2br(str) {
    str = str.replace(/\r\n/g, "<br />");
    str = str.replace(/(\n|\r)/g, "<br />");
    return str;
}

function sendmessage(proposal_id){
    var url = `/sample-app-work-matching/public/chats/sendmessage/${proposal_id}`;
    var send_message = $('#bms_send_message').val();

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

// チャットをデフォルト位置を下部に
let target = document.getElementById('scroll');
target.scrollIntoView(false);

// チャットスクロールで件数増加のボタン表示
// const chat_scroll = document.getElementById('bms_messages');
// const clientHeight = chat_scroll.clientHeight;
// const scrollHeight = chat_scroll.scrollHeight;
// chat_scroll.onscroll = function(){
//     if(this.scrollTop == 0){
//         document.getElementById('reroad-btn').style.display= 'inline';
//     }
// };


// チャットの件数追加
let add_count = 0;
function reroad(proposal_id){

    add_count++;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/sample-app-work-matching/public/chats/addchats/${proposal_id}`,
        type: "POST",
        data:{
            "add_count" : add_count
        }
    })
        .done(function(data){
            console.log(data);
            for(i=0; i < data['chats'].original.length; i++){
                if(data['chats'].original[i].user_id != data['user_id']){
                    $('#addindex').prepend(
                        `
                        <div class="bms_message bms_left">
                            <div class="bms_message_box">
                                <div class="bms_message_content">
                                    <div class="bms_message_text">`
                        + nl2br(data['chats'].original[i].message)
                        +`</div>
                                </div>
                            </div>
                        </div>
                        <div class="bms_clear"></div>
                        `
                    );
                } else{
                    $('#addindex').prepend(
                        `
                        <div class="bms_message bms_right">
                            <div class="bms_message_box">
                                <div class="bms_message_content">
                                    <div class="bms_message_text">`
                        + nl2br(data['chats'].original[i].message)
                        +`</div>
                                </div>
                            </div>
                        </div>
                        <div class="bms_clear"></div>
                        `
                    );
                }
                
            }
            if(data['chats'].original.length == 10){
                let move_top = $('.bms_message_text:eq(8)').offset().top;
                $('#bms_messages').scrollTop(move_top);
            }
                // let eq_num = data['chats'].original-2; 
                // let move_top = $('.bms_message_text:eq(eq_num)').offset().top;
                // console.log(move_top);
                // $('#bms_messages').scrollTop(move_top);
            
            if(data['chats'].original.length < 10){
                $('#reroad-btn').css('display','none');
            }
            
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            // 送信失敗を入れる

            console.log('失敗');
        });
}