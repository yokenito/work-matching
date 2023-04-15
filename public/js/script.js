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

let target = document.getElementById('scroll');
target.scrollIntoView(false);