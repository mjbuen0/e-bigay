<?php

    include('config.php');
    $cat=$_POST['cat'];
    $qty=$_POST['qty'];
    $pri=$_POST['pri'];
    $sql = "INSERT INTO `inventory`( `category`, `quantity`, `price`) VALUES ('$cat','$qty','$pri')";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }

?>