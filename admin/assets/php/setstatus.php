<?php
    include('config.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save']) && $_POST['save'] == 1) {
        date_default_timezone_set('Asia/Singapore');
        $transid = $_POST['transacid'];
        $string = strval($acctid);
        $tdate = date("F j, Y");

        $sql = "UPDATE transactiontable SET `status` = 'Claimed', `date_claimed` = '$tdate' WHERE transac_id = '$transid'";
        $result = $con->query($sql);

        header('Location: ../../index.php');
    }

?>