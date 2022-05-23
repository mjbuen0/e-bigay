<?php
include('config.php');
if(isset($_POST['view'])){
    // $con = mysqli_connect("localhost", "root", "", "notif");
    if($_POST["view"] != ''){
        $update_query = "UPDATE donation_table SET notif_status = 1 WHERE notif_status = 0";
        mysqli_query($con, $update_query);
    }
    $query = "SELECT * FROM donation_table ORDER BY id DESC LIMIT 5";
    $result = mysqli_query($con, $query);
    $output = '';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $output .= '
            <li>
            <strong><a href="https://e-bigay.com/donor_profile.php" style="text-decoration:none;padding:0px;margin:0px;">Your Donation has Been Received</a></strong>
            <p>See the image on your Profile</p>
            <hr>
            </li>
            ';
        }
    }else{
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }
    $status_query = "SELECT * FROM donation_table WHERE notif_status=0";
    $result_query = mysqli_query($con, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unseen_notification'  => $count
    );
    echo json_encode($data);
}
?>