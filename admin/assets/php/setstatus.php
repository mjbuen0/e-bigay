<?php
    include('config.php');
    if (isset($_GET['apt_id']) && $_GET['event'] == 'approve') {
        date_default_timezone_set('Asia/Singapore');
        $transid = $_GET['transacid'];
        $string = strval($acctid);
        $tdate = date("F j, Y");

        $sql = "UPDATE transactiontable SET `status` = 'Claimed', `date_claimed` = '$tdate' WHERE transac_id = '$transid'";
        $result = $con->query($sql);

        header('Location: ../../index.php');
    }

    if (isset($_GET['apt_id']) && $_GET['event'] == 'receive') {
        date_default_timezone_set('Asia/Singapore');
        $id = $_GET['id'];
        $string = strval($acctid);
        $tdate = date("F j, Y");

        $sql = "UPDATE donation_table SET `status` = 'Received', `notif_status` = 0 WHERE id = '$id'";
        $result = $con->query($sql);

        header('Location: ../../index.php');
    }

?>