<?php

session_start();
unset($_SESSION['logedinAdmin']);
header("Location: ../../index.php");
?>