<?php
include_once('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailerMaster/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailerMaster/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailerMaster/PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $cost = $_POST['cost'];
    $message = $_POST['message'];

    $target = "../../assets/img/receipt";
    $tmp_name = $_FILES["attachment"]["tmp_name"];
    $image = $_FILES['attachment']['name'];
    move_uploaded_file($tmp_name, "$target/$image");


    $selectTotalCash = "SELECT total FROM total_cash";
    $selectTotalCashRes = mysqli_query($con, $selectTotalCash);
    $total = mysqli_fetch_array($selectTotalCashRes);
    if (mysqli_num_rows($selectTotalCashRes) > 0) {
        $insertTotal = $total['total'] - $cost;

        $updateTotalCash = "UPDATE total_cash SET total = '$insertTotal' WHERE 1";
        mysqli_query($con, $updateTotalCash);
    }

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
    $mail->Username   = "no-reply@e-bigay.com";
    $mail->Password   = "Dontreply.1";

    $mail->IsHTML(true);
    $mail->setFrom('no-reply@e-bigay.com', 'E-Bigay Organization');
    
    $selectAllEmailDonor = "SELECT email FROM registered_accounts WHERE role = 'Donor'";
    $selectAllEmailDonorRes = mysqli_query($con, $selectAllEmailDonor);
    while ($row=mysqli_fetch_array($selectAllEmailDonorRes)) {
        $mail->AddAddress($row['email']);
    }

    $mail->addAttachment('../../assets/img/receipt/'.$image, $image);
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
            <p>'.$message.'</p>
        </div>
    </body>
    </html>';

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {

    }
    header("Location:../../index.php");
}

?>