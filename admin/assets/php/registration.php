<?php
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
        $bdate = $_POST['registerbirthdate'];
        $bdate = date("Y-m-d", strtotime($bdate));
        $address = $_POST['registeraddress'];
        $contact = $_POST['registernumber'];
        $email = $_POST['registeremail'];
        $usrrole = $_POST['userrole'];
        $password = $_POST['registerpassword'];
        $save = $_POST['save'];
        $password   =        md5($password);

        // insert into table
        $sql = "INSERT INTO registered_accounts (name, datebirth, address, phone, email, role, password) VALUES ('$name', '$bdate', '$address', '$contact', '$email', '$usrrole','$password') ";
        $result = $con->query($sql);
        if($result) {
            
            // echo "<div class='alert alert-success alert-dismissible'> 
            //     <button class='close' type='button' data-dismiss='alert'>&times;</button>
            //     Registration has completed successfully.
            // </div>";
        } else {
            echo $con->error;
        //    echo "<div class='alert alert-danger alert-dismissible'>
        //     <button type='button' class='close' data-dismiss='alert'> &times; </button>
        //     Whoops! some error encountered. Please try again.";
        }

    }   

?>