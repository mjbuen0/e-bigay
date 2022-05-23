<?php
    include('config.php');
    date_default_timezone_set('Asia/Manila');
    $getAmountDonationQuery = "SELECT amount FROM cash_table";
    $getAmountDonationResult = mysqli_query($con, $getAmountDonationQuery);
    $today = date("F j, Y, g:i A");
    $totalamount = 0;
    while($row = mysqli_fetch_array($getAmountDonationResult)) {
        $totalamount += $row['amount'];
    }
    $total = "₱ ".number_format($totalamount, 2);
    $data = array(
        'amount' => $total,
        'dateandtime' => $today
    );
    echo json_encode($data)
?>