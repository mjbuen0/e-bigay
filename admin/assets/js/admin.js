function complete(apt_id, transid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to complete this transaction?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Complete'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../assets/php/setstatus.php?apt_id=" + apt_id + "&transacid=" + transid + "&event=approve";
        }
    })
}

function receive(id, accid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to receive this transaction?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Receive!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../assets/php/setstatus.php?apt_id=" + accid + "&id=" + id + "&event=receive";
        }
    })
}

function distribute(id, accid) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to deploy this donation?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Distribute!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../assets/php/setstatus.php?apt_id=" + accid + "&id=" + id + "&event=distribute";
        }
    })
}

function replied(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You already replied in this message?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../assets/php/setstatus.php?msgid=" + id + "&event=replied";
        }
    })
}

$(document).ready(function () {
    $('#submit').click(function () {

        // calling validate function
        var response = validateForm();

        // alert("test");
        // if form validation fails			
        if (response == 0) {
            return;
        } else {

        }

        var cat = $('#category').val();
        var qty = $('#quantity').val();
        var pri = $('#price').val();
        $.ajax({
            url: "../assets/php/insert_inventory.php",
            type: "POST",
            data: {
                cat: cat,
                qty: qty,
                pri: pri
            },
            cache: false,
            beforeSend: function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Pleas Wait...',
                    text: 'Submitting your form',
                    timer: 1500,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Your item has been listed',
                    timer: 1500,
                    showConfirmButton: false,
                    allowOutsideClick: false
                }).then(() => {
                    location.reload(true);
                });

            },
            error: function (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps..',
                    text: 'Something went Wrong.',
                    timer: 1500,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            }
        });
    });

    function validateForm() {
        // removing span text before message
        $("#error").remove();

        if ($("#category").val() == "") {
            $("#category").after("<span id='error' class='text-danger'>Enter your Name</span><br id='br-category'>");
            return 0;
        }

        if ($("#quantity").val() == "") {
            $("#quantity").after("<span id='error' class='text-danger'>Enter your Email</span><br id='br-quantity'>");
            return 0;
        }

        if ($("#price").val() == "") {
            $("#price").after("<span id='error' class='text-danger'>Enter your Email</span>");
            return 0;
        }

        return 1;
    }

    $("#category").keyup(function () {
        $("#error").remove();
        $("#br-category").remove();

    });


    $("#quantity").keyup(function () {
        $("#error").remove();
        $("#br-quantity").remove();

    });

    $("#price").keyup(function () {
        $("#error").remove();
    });
});