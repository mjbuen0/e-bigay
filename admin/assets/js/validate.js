$(document).ready(function () {

    // form autocomplete off		
    $(":input").attr('autocomplete', 'off');

    // remove box shadow from all text input
    $(":input").css('box-shadow', 'none');

    // save button click function
    $("#savebtn").click(function () {

        // calling validate function
        var response = validateForm();

        // alert("test");
        // if form validation fails			
        if (response == 0) {
            return;
        } else {
            // window.location.href = "index.php";
            swal.fire({
                title: "Success!",
                text: "Thank you for Registering",
            }).then(function () {
                window.location = "loginpage.php";
            });
        }

        // getting all form data
        var name = $("#regname").val();
        var email = $("#regemail").val();
        var password = $("#regpassword").val();
        var birthdate = $("#regbirthdate").val();
        var number = $("#regnumber").val();
        var address = $("#regaddress").val();
        var acctrole = $('#account-role').find(":selected").text();



        // sending ajax request
        $.ajax({

            url: './assets/php/registration.php',
            type: 'post',
            data: {
                'registername': name,
                'registerbirthdate': birthdate,
                'registeraddress': address,
                'registernumber': number,
                'registeremail': email,
                'userrole': acctrole,
                'registerpassword': password,
                'save': 1
            },

            // before ajax request
            beforeSend: function () {
                $("#result").html("<p class='text-success'> Please wait.. </p>");
            },

            // on success response
            success: function (response) {
                $("#result").html(response);

                // reset form fields
                $("#RegForm")[0].reset();
            },

            // error response
            error: function (e) {
                $("#result").html("Some error encountered.");
            }

        });
    });




    // ------------- form validation -----------------

    function validateForm() {

        // removing span text before message
        $("#error").remove();

        if ($("#regname").val() == "") {
            $("#regname").after("<span id='error' class='text-danger'>Enter your Name</span>");
            return 0;
        }

        if ($("#regemail").val() == "") {
            $("#regemail").after("<span id='error' class='text-danger'>Enter your Email</span>");
            return 0;
        }


        // validating input if empty
        if ($("#regpassword").val() == "") {
            $("#regpassword").after("<span id='error' class='text-danger'>Enter your Password</span>");
            return 0;
        }

        if ($("#regbirthdate").val() == "") {
            $("#regbirthdate").after("<span id='error' class='text-danger'>Enter your Birthdate</span>");
            return 0;
        }

        if ($("#regnumber").val() == "") {
            $("#regnumber").after("<span id='error' class='text-danger'>Enter your Phone Number</span>");
            return 0;
        }

        if ($("#regaddress").val() == "") {
            $("#regaddress").after("<span id='error' class='text-danger'>Enter your Address</span>");
            return 0;
        }

        return 1;

    }


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
                $("#registeremail_error").remove();

                // adding span after email textbox with error message
                $("#regemail").after("<span id='email_error' class='text-danger'>" + response + "</span>");
            },

            error: function (e) {
                $("#result").html("Something went wrong");
            }

        });
    });
    // -----------[ Clear span after clicking on inputs] -----------

    $("#username").keyup(function () {
        $("#error").remove();
    });


    $("#registeremail").keyup(function () {
        $("#error").remove();
        $("span#email_error").remove();
    });

    $("#registerpassword").keyup(function () {
        $("#error").remove();
    });

    $("#confirmpassword").keyup(function () {
        $("#error").remove();
    });

});