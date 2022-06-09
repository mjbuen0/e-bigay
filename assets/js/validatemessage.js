$(document).ready(function () {

    // form autocomplete off		
    $(":input").attr('autocomplete', 'off');

    // remove box shadow from all text input
    $(":input").css('box-shadow', 'none');

    // save button click function
    $("#send").click(function () {

        // initiate validation function
        var response = validateForm();

        // if form validation fails
        if (response == 0) {
            return;
        }

        // get all the data
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        

        $.ajax({
            url: './assets/php/getintouch.php',
            type: 'POST',
            data: {
                'name': name,
                'email': email,
                'subject': subject,
                'message': message,
                'save': 1,
            },
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
                    // console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: response,
                        timer: 3000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = "index.php";
                    });
            },
            error: function (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Opps...',
                    text: 'Something went wrong',
                    timer: 1500,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            }
        });
    });


    // ------------- form validation -----------------
    function validateForm() {
        // removing span text before message
        $('#error').remove();

        // validating input if empty
        

        if($('#name').val() == ""){
            $("#name").after("<span id='error' class='text-danger'>Please enter your name</span>");
			return 0;
        }
        if($('#email').val() == ""){
            $("#email").after("<span id='error' class='text-danger'>Please enter your email</span>");
			return 0;
        }
        if($('#subject').val() == ""){
            $("#subject").after("<span id='error' class='text-danger'>Pleas enter an email subject</span>");
			return 0;
        }
        if($('#message').val() == ""){
            $("#message").after("<span id='error' class='text-danger'>Please Write a message</span>");
			return 0;
        }

        return 1;
    }

    // -----------[ Clear span after clicking on inputs] -----------
    $("#account-role").change(function () {
        $("#error").remove();
    });
    $("#regfname").keyup(function () {
		$("#error").remove();
	});
	$("#reglname").keyup(function () {
		$("#error").remove();
	});
    $("#regoccupation").keyup(function () {
		$("#error").remove();
	});
});