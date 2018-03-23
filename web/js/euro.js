$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            method: "GET",
            url: document.location.href + "&type=ajax"
        }).done(function (data) {
            data = JSON.parse(data);
            if (data.status === 'ok') {
                $('#euro').html(data.msg);
                $('#error').html('');
            } else if (data.status === 'error') {
                $('#error').html(data.msg);
            }
            console.log('update');
        });
    }, 10000);
});
