$(document).ready(function () {
    // updating the view with notifications using ajax
    function load_unseen_notification(view = '') {
        $.ajax({
            url: "../assets/php/inbox_notif.php",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function (data) {
                $('.notification').html(data.unseen_notification);
            }
        });
    }
    load_unseen_notification();
    // load new notifications
    $(".message-link").on('click', function () {
        load_unseen_notification('yes');
    });
    setInterval(function () {
        load_unseen_notification();
    }, 5000);
});