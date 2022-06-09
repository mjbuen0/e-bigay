<?php
    require('config.php');  
    session_start();

    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_SESSION['email'] == "") {
            $name = $_POST['name'];
            $email = $_POST['email'];
        } else {
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
        }
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $sql = "INSERT INTO messages (sender_name, sender_email, msg_subject, msg_body) VALUES ('$name', '$email', '$subject', '$message') ";
        $result = mysqli_query($con, $sql);
        if($result){
            header("Location: ../../index.php");
        }
    }

?>