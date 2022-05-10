<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/

session_start();
unset($_SESSION['logedinAdmin']);
header("Location: ../../index.php");
?>