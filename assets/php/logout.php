<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/

session_start();
unset($_SESSION["id"]);
unset($_SESSION["email"]);
unset($_SESSION['name']);
unset($_SESSION['verified']);

header("Location: ../../index.php");
?>