<?php

    require('config.php');  

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/PHPMailerMaster/PHPMailer-master/src/Exception.php';
    require '../vendor/PHPMailerMaster/PHPMailer-master/src/PHPMailer.php';
    require '../vendor/PHPMailerMaster/PHPMailer-master/src/SMTP.php';
    session_start();

    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']) && $_POST['save'] == 1) {
        // if($_SESSION['email'] == "") {
        //     $name = $_POST['name'];
        //     $email = $_POST['email'];
        // } else {
        //     $name = $_SESSION['name'];
        //     $email = $_SESSION['email'];
        // }
        // $subject = $_POST['subject'];
        // $message = $_POST['message'];
        
        // $sql = "INSERT INTO messages (sender_name, sender_email, msg_subject, msg_body) VALUES ('$name', '$email', '$subject', '$message') ";
        // $result = mysqli_query($con, $sql);
        // if($result){
        //     header("Location: ../../index.php");
        // }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = "e-bigay.com"; // SMTP server
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                            // 1 = errors and messages
                                            // 2 = messages only
        $mail->SMTPAuth   = "true";                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "e-bigay.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465; 
        $mail->Username   = "support@e-bigay.com";
        $mail->Password   = "Ebigay.1";

        $mail->IsHTML(true);
        $mail->setFrom($email, $name);
        $mail->AddAddress('support@e-bigay.com');
        $mail->Subject = $subject;
        $content =  '<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Test mail</title>
            <style>
                .wrapper {
                padding: 20px;
                color: #444;
                font-size: 1.3em;
                }
                a {
                background: #592f80;
                text-decoration: none;
                padding: 8px 15px;
                border-radius: 5px;
                color: #fff;
                }
            </style>
        </head>
        <body>
            <div class="wrapper">
                '.$message.'
            </div>
        </body>
        </html>';

        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
            echo "Error while sending Email.";
        var_dump($mail);
        } else {

        }
        echo "Your inquiry has been sent.";
    }
?>