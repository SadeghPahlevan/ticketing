$(document).ready(function () {

    $(".get_stream_id").click(function (e) {
        e.preventDefault();
        window.id = $(this).attr('id');
        window.id = window.id.split('stream-');
        window.id = window.id[1];
        $("#sh-"+window.id).toggle();

    });


    $(".add-text").click(function (e) {
        e.preventDefault();

        window.text = $(this).parent().children('textarea').val();

        if (window.text == '') {
            alert('پیامی نذاشتید');
        } else {
            window.id = $(this).attr('id');
            window.id = window.id.split('add-');
            window.id = window.id[1];
            $.ajax({
                url: $("#stream-url").val(),
                type: 'POST',
                //cache: false,
                data: {stream_id: window.id, response: window.text},
                dataType: "json",
                success: function (result) {
                    if (result.code == 200) {
                        $(".add-"+window.id).val('');
                        $("#text-container-"+window.id).append('<p style="direction:rtl">now:'+window.text+'</p>');
                        alert(result.message);
                    } else {
                        alert(result.message);
                    }
                },
                error: function () {

                },
                complete: function () {

                }
            });
        }

    });


    $(".finish-stream").click(function (e) {
        e.preventDefault();
        alert("از تغییر وضعیت مطمپن هستید؟");
            window.id = $(this).attr('id');
            window.id = window.id.split('finish-stream-');
            window.id = window.id[1];

        $.ajax({
            url: $("#stream-status-url").val(),
            type: 'POST',
            //cache: false,
            data: {stream_id: window.id},
            dataType: "json",
            success: function (result) {
                if (result.code == 200) {
                    alert(result.message);
                } else {
                    alert(result.message);
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });

    });



});