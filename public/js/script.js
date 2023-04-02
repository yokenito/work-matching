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