$(document).ready(function () {

    $(".get_stream_id").click(function (e) {
        e.preventDefault();
        window.id = $(this).parent().attr('data-key');
        $("#sh-" + window.id).toggle();

    });
    $(".add-rate").click(function (e) {
        e.preventDefault();
        window.id = $(this).parent().attr('data-key');
        $("#show-rate" + window.id).toggle();

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
                        $("#text-container-"+window.id).prepend('<p>'+window.text+'</p>');
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
    

});