$(document).ready(function () {

    // form autocomplete off		
    $(":input").attr('autocomplete', 'off');

    // remove box shadow from all text input
    $(":input").css('box-shadow', 'none');

    // save button click function
    $("#savebtn").click(function () {

        // initiate validation function
        var response = validateForm();

        // if form validation fails
        if (response == 0) {
            return;
        }

        // get all the data
        var role = $('#account-role').val();
        var fname = $('#regfname').val();
        var lname = $('#reglname').val();
        var occupation = $('#regoccupation').val();
        var income = $('#regincome').val();
        var birthdate = $('#regbirthdate').val();
        var address = $('#regaddress').val();
        var number = $('#regnumber').val();
        var email = $('#regemail').val();
        var password = $('#regpassword').val();

        $.ajax({
            url: './assets/php/registration.php',
            type: 'POST',
            data: {
                'userrole': role,
                'firstname': fname,
                'lastname': lname,
                'occupation': occupation,
                'income': income,
                'birthdate': birthdate,
                'address': address,
                'number': number,
                'email': email,
                'password': password,
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
                if (response == "taken") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps...',
                        text: 'Your email is already registered',
                        timer: 3000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                } else {
                    // console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: response,
                        timer: 3000,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = "loginpage.php";
                    });
                }
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

    // ------------------- [ Email blur function ] -----------------

	$("#regemail").blur(function () {

		var email = $('#regemail').val();

		// if email is empty then return
		if (email == "") {
			return;
		}

		// send ajax request if email is not empty
		$.ajax({
			url: './assets/php/registration.php',
			type: 'post',
			data: {
				'email': email,
				'email_check': 1,
			},
			success: function (response) {
				// clear span before error message
				$("#email_error").remove();
				// adding span after email textbox with error message
				$("#regemail").after("<span id='email_error' class='text-danger'>" + response + "</span>");
			},

			error: function (e) {
				$("#result").html("Something went wrong");
			}

		});
	});

    // ------------- form validation -----------------
    function validateForm() {
        // removing span text before message
        $('#error').remove();

        // validating input if empty
        if ($('#account-role option:selected').prop('disabled')) {
            $("#account-role").after("<span id='error' class='text-danger'>Select a Role</span>");
            return 0;
        }

        if($('#regfname').val() == ""){
            $("#regfname").after("<span id='error' class='text-danger'>Please enter your first name</span>");
			return 0;
        }

        if($('#reglname').val() == ""){
            $("#reglname").after("<span id='error' class='text-danger'>Please enter your last name</span>");
			return 0;
        }

        if($('#account-role').val() == "Recipient") {
            if($('#regoccupation').val() == ""){
                $("#regoccupation").after("<span id='error' class='text-danger'>Please enter your occupation name</span>");
                return 0;
            }
            if($('#regincome').val() == ""){
                $("#regincome").after("<span id='error' class='text-danger'>Please enter your income name</span>");
                return 0;
            }
        }

        if($('#regbirthdate').val() == ""){
            $("#regbirthdate").after("<span id='error' class='text-danger'>Please enter birthdate</span>");
			return 0;
        }

        if($('#regaddress').val() == ""){
            $("#regaddress").after("<span id='error' class='text-danger'>Please enter your address</span>");
			return 0;
        }

        if($('#regnumber').val() == ""){
            $("#regnumber").after("<span id='error' class='text-danger'>Please enter your phone number</span>");
			return 0;
        }

        if($('#regemail').val() == ""){
            $("#regemail").after("<span id='error' class='text-danger'>Please enter your email</span>");
			return 0;
        }

        if($('#regpassword').val() == ""){
            $("#regpassword").after("<span id='error' class='text-danger'>Please enter your password</span>");
			return 0;
        } else if ($('#regpassword').val() != $('#regconpassword').val()) {
            $("#regconpassword").after("<span id='error' class='text-danger'>Your password does not match</span>");
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
    $("#regincome").keyup(function () {
		$("#error").remove();
	});
	$("#regbirthdate").keyup(function () {
		$("#error").remove();
	});
	$("#regaddress").keyup(function () {
		$("#error").remove();
	});
	$("#regnumber").keyup(function () {
		$("#error").remove();
	});
	$("#regemail").keyup(function () {
		$("#error").remove();
	});
	$("#regpassword").keyup(function () {
		$("#error").remove();
	});
	$("#regconpassword").keyup(function () {
		$("#error").remove();
	});


});