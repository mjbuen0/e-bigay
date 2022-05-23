<?php
    include("config.php");
    $getTable = "SELECT name, amount FROM donation_table WHERE type_of_donation = 'cash'";
    $getTableResult = mysqli_query($con, $getTable);
    $output ='';
    $totalamount = 0;
    while($row = mysqli_fetch_array($getTableResult)) {
        $output .= '
            <tr>
                <td>'.$row['name'].'</td>
                <td>'.$row['amount'].'</td>
            </tr';

        $totalamount += $row['amount'];
        
    }

    $total = "₱ ".number_format($totalamount, 2);
    $data = array(
        'table' => $output,
        'amount' => $total
    );
    echo json_encode($data);
?>