$(document).ready(function () {

    for (i = 0; i < 1000; i++) {
        $("#approve" + i).click(function () {
            var ref = $(this).val();
            var transid = String(ref);

            $.ajax({
                url: '../admin/assets/php/setstatus.php',
                type: 'post',
                data: {
                    'transacid': transid,
                    'save': 1
                },
                success: function () {
                    swal.fire({
                        icon: "success",
                        title: "Completed!",
                    }).then(function () {
                        window.location.href = window.location.href;
                    })

                }
            });
        });
    }
});