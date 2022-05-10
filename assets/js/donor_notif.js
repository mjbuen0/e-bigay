$(document).ready(function () {
    // updating the view with notifications using ajax
    function load_unseen_notification(view = '') {
        $.ajax({
            url: "assets/php/fetch_notif_donor.php",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function (data) {
                // console.log($data);
                $('.dropdown-menu').html(data.notification);
                if (data.unseen_notification > 0) {
                    $('.count').html(data.unseen_notification);
                }
            }
        });
    }
    load_unseen_notification();

    // load new notifications
    $(document).on('click', '.dropdown', function () {
      $('.count').html('');
      load_unseen_notification('yes');
    });
    setInterval(function () {
        load_unseen_notification();
    }, 5000);
  });