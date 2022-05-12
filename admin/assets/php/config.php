<?php
    $servername = "localhost";
    $username = "ebigay";
    $password = "ebigaysql";
    $dbname = "ebigay";

    // crearte connection
    try {
        $con = new Mysqli($servername, $username, $password, $dbname);
    } catch (Exception $e) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ebigay";

        // crearte connection
        $con = new Mysqli($servername, $username, $password, $dbname);
    }
?>