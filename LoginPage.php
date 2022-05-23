<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>
        EBigay | Login
    </title>
    <link href="assets/img/logo2.png" rel="icon">
    <style>
        .text-danger {
            color:red;
        }
        .sign-up-div {
            height: 500px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up sign-up-div">
                        <form id="RegForm" method="POST" enctype="multipart/form-data">
                            <div class="input-group">
                                <i class='bx bx-sitemap'></i>
                                <!-- <input type="email" id="regemail" name="regemail" placeholder="Email"> -->
                                <select name="account-role" id="account-role" onchange="selectRole()">
                                    <option value="" disabled selected>Please Select Role...</option>
                                    <option value="Donor">Donor</option>
                                    <option value="Recipient">Recipient</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="regfname" name="regfname" placeholder="First Name" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="reglname" name="reglname" placeholder="Last Name" required>
                            </div>
                            <div class="input-group" id="occupationfield" hidden>
                                <i class='bx bxs-briefcase' ></i>
                                <input type="text" id="regoccupation" name="regoccupation" placeholder="Occupaton"
                                    required>
                            </div>
                            <div class="input-group" id="incomefield" hidden>
                                <i class='bx bx-money' ></i>
                                <input type="text" id="regincome" name="regincome" placeholder="Income" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bx-cake'></i>
                                <input type="date" id="regbirthdate" name="regbirthdate" placeholder="Date of Birth"
                                    required>
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
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="regpassword" name="regpassword" placeholder="Password">
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="regconpassword" name="regconpassword"
                                    placeholder="Confirm Password">
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
            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <form action="assets/php/loginprocess.php" method="POST">
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                            </div>
                            <input type="submit" class="login-btn" id="login" name="login" value="Log In">
                        </form>
                        <p>
                            <b>
                                Forgot password?
                            </b>
                        </p>
                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
                            </b>
                        </p>
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
                        Login
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
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
    <script src="assets/js/signup.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"> </script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/validate.js"></script>
</body>

</html>