<?php
include('config.php');
if(isset($_POST['view'])){
    // $con = mysqli_connect("localhost", "root", "", "notif");
    if($_POST["view"] != ''){
        $update_query = "UPDATE transactiontable SET notif_status = 1 WHERE notif_status = 0";
        mysqli_query($con, $update_query);
    }
    $query = "SELECT * FROM transactiontable ORDER BY transac_id DESC LIMIT 5";
    $result = mysqli_query($con, $query);
    $output = '';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $output .= '
            <li>
            <strong><a href="http://localhost/web_dev/Ebigay/recipient_profile.php" style="text-decoration:none;padding:0px;margin:0px;">ETA of Delivery of Donation</a></strong>
            <p>'.$row["date_generated"].'</p>
            <hr>
            </li>
            ';
        }
    }else{
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }
    $status_query = "SELECT * FROM transactiontable WHERE notif_status=0";
    $result_query = mysqli_query($con, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unseen_notification'  => $count
    );
    echo json_encode($data);
}
?>