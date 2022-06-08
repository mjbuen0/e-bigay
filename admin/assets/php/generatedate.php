<?php
    include('config.php');
    // $sql = "SELECT * FROM registered_accounts WHERE role = 'Recipient'";
    // $retval = mysqli_query($con, $sql );
    // if(! $retval ) {
    //     die('Could not get data: ' . mysql_error());
    // }
    
    // while($row = $retval->fetch_assoc()) {
    // //   echo "Dear "; echo $row['name']; echo",<br>";
    //     $accountid = $row['id'];
    //     $nameAcct = $row['name'];
    //     $transacid = $_POST['transid'];
    //     $date = $_POST['gendate'];
    //     $date = date("F j, Y", strtotime($date));
        
    //     if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $sql = "INSERT INTO transactiontable (acc_id, name,  date_generated, date_claimed, status) VALUES ($accountid, '$nameAcct', '$date', 'Not Yet Available', 'Pending') WHERE transac_id = $transacid";
    //         $result = $con->query($sql);
    //         if($result) {
    //             header("Location:../../index.php");
    //         } 
    //         else {
    //             echo $con->error;
    //         }
    //     }
    // }

    if(isset($_POST['generate'])) {
        $accountid = $_POST['accountid'];
        $nameAcct = $_POST['name'];
        $date = $_POST['gendate'];
        // $date = date("Y-m-d", strtotime($date));
        $sql = "INSERT INTO transactiontable (acc_id, name,  date_generated, date_claimed, status) VALUES ($accountid, '$nameAcct', '$date', 'Not Yet Available', 'Pending') ";
        $result = $con->query($sql);
        if($result) {
            header("Location:../../pages/list_of_recipients.php");
        } 
        else {
            echo $con->error;
        }
    }
?>