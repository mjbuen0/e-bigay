<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>
        Animated login signup
    </title>
</head>

<body>
    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <form id="RegForm" method="POST" enctype="multipart/form-data">
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="regname" name="regname" placeholder="Name">
                            </div>
                            <div class="input-group">
                                <i class='bx bx-cake'></i>
                                <input type="date" id="regbirthdate" name="regbirthdate" placeholder="Date of Birth">
                            </div>
                            <div class="input-group">
                                <i class='bx bx-street-view'></i>
                                <input type="text" id="regaddress" name="regaddress" placeholder="Address">
                            </div>
                            <div class="input-group">
                                <i class='bx bx-phone'></i>
                                <input type="number" id="regnumber" name="regnumber" placeholder="Contact No."
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    type="number" maxlength="11" maxlenght="11">
                            </div>
                            <div class="input-group">
                                <i class='bx bx-mail-send'></i>
                                <input type="email" id="regemail" name="regemail" placeholder="Email">
                            </div>
                            <div class="input-group">
                                <i class='bx bx-sitemap'></i>
                                <!-- <input type="email" id="regemail" name="regemail" placeholder="Email"> -->
                                <select name="account-role" id="account-role">
                                    <option value="" disabled selected>Please Select Role...</option>
                                    <option value="Donor">Donor</option>
                                    <option value="Recipient">Recipient</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="regpassword" name="regpassword" placeholder="Password">
                            </div>
                            <button type="button" id="savebtn">Sign-Up</button>
                        </form>
                        <p>
                            <span>
                                Already have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign in here
                            </b>
                        </p>
                    </div>
                </div>
                <div class="form-wrapper">
                    <div class="social-list align-items-center sign-up">
                        <div class="align-items-center facebook-bg">
                            <i class='bx bxl-facebook'></i>
                        </div>
                        <div class="align-items-center google-bg">
                            <i class='bx bxl-google'></i>
                        </div>
                        <div class="align-items-center twitter-bg">
                            <i class='bx bxl-twitter'></i>
                        </div>
                        <div class="align-items-center insta-bg">
                            <i class='bx bxl-instagram-alt'></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <form action="assets/php/loginprocess.php" method="POST">
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="user" name="user" placeholder="User">
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="password" name="password" placeholder="Password">
                            </div>
                            <input type="submit" class="login-btn" id="login" name="login" value="Log In">
                        </form>
                    </div>
                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Admin Login
                    </h2>
                </div>
                <div class="img sign-in">
                    <img src="assets/img/undraw_different_love_a3rg.svg" alt="welcome">
                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">
                    <img src="assets/img/undraw_creative_team_r90h.svg" alt="welcome">
                </div>
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit obcaecati, accusantium
                        molestias, laborum, aspernatur deserunt officia voluptatum tempora dicta quo ab ullam. Assumenda
                        enim harum minima possimus dignissimos deserunt rem.
                    </p>
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"> </script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/validate.js"></script>
    <script>
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#recipients tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
</body>

</html>