<?php 
    include('config.php');
    $resetQuery = "DELETE FROM cash_table";
    mysqli_query($con, $resetQuery);
    header("Location: ../../index.php");
?>