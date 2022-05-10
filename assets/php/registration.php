<?php
    require_once 'phpmail.php';
    require('config.php');    
    // check if email is already taken
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email_check']) && $_POST['email_check'] == 1) {
        // validate email
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $sqlcheck = "SELECT email FROM registered_accounts WHERE email = '$email' ";
        $checkResult = $con->query($sqlcheck);

        // check if email already taken
        if($checkResult->num_rows > 0) {
            echo "Sorry! email has already registered.";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']) && $_POST['save'] == 1) {// save records into the database
        $name = $_POST['registername'];
        $occu = $_POST['registeroccupation'];
        $aincome = $_POST['registerincome'];
        $bdate = $_POST['registerbirthdate'];
        $bdate = date("Y-m-d", strtotime($bdate));
        $address = $_POST['registeraddress'];
        $contact = $_POST['registernumber'];
        $email = $_POST['registeremail'];
        $usrrole = $_POST['userrole'];
        $password = $_POST['registerpassword'];
        $save = $_POST['save'];
        $password   =  md5($password);
        $token = bin2hex(random_bytes(50));

        // insert into table
        $sql = "INSERT INTO registered_accounts (name, datebirth, address, phone, email, role, occupation, annual_income, token, password) VALUES ('$name', '$bdate', '$address', '$contact', '$email', '$usrrole', '$occu', '$aincome', '$token', '$password') ";
        $result = $con->query($sql);
        if($result) {
            echo "testing";
            // TO DO: send verification email to user
            sendVerificationEmail($email, $token);

            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;  
        } else {
            echo $con->error;
        }
        
    }  
?>