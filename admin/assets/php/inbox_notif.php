<?php
include('config.php');
if(isset($_POST['view'])){
    // $con = mysqli_connect("localhost", "root", "", "notif");
    if($_POST["view"] != ''){
        $update_query = "UPDATE messages SET notif_status = 1 WHERE notif_status = 0";
        mysqli_query($con, $update_query);
    }
    
    $status_query = "SELECT * FROM messages WHERE notif_status = 0";
    $result_query = mysqli_query($con, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unseen_notification'  => $count
    );
    echo json_encode($data);
    
}
?>