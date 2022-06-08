<?php
    require('config.php');

    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target = "../../admin/assets/img/uploads";
        $tmp_name = $_FILES["file"]["tmp_name"];

        $id ="";
        $name = $_POST['donorname'];
        $sql = "SELECT id FROM registered_accounts WHERE name = '$name' AND role = 'Donor'";
        // $sql = "SELECT id FROM donation_table";s
        $res = mysqli_query($con, $sql ); 
        while($row=mysqli_fetch_array($res)){
            $id = $row['id'];
        }
        $donateT = $_POST['donatetype'];
        $typeofdonation = $_POST['typeofgoods'];
        $description = $_POST['goodsdescription'];
        $money = $_POST['amount'];
        $image = $_FILES['file']['name'];
        $date = $_POST['donategendate'];
        $date = date("F j, Y", strtotime($date));
        
        if ($donateT == "Cash") {
            $insertQueryDonationTable = "INSERT INTO donation_table (acc_id, name, type_of_donation, description, proof_donation,  date_donated, status, notif_status) VALUES ($id, '$name', '$donateT', '$money', '$image', '$date', 'Received', 1)";
            mysqli_query($con, $insertQueryDonationTable);
            move_uploaded_file($tmp_name, "$target/$image");

            $insertQueryCashTable = "INSERT INTO cash_table (acc_id, name, amount, proof_of_receipt) VALUES ($id, '$name', '$money', '$image')";
            mysqli_query($con, $insertQueryCashTable);


            $selectTotalCash = "SELECT total FROM total_cash";
            $selectTotalCashRes = mysqli_query($con, $selectTotalCash);
            $total = mysqli_fetch_array($selectTotalCashRes);
            if (mysqli_num_rows($selectTotalCashRes) > 0) {
                $insertTotal = $money + $total['total'];

                $updateTotalCash = "UPDATE total_cash SET total = '$insertTotal' WHERE 1";
                mysqli_query($con, $updateTotalCash);
            } else {
                $inserTotalCash = "INSERT INTO `total_cash`(`total`) VALUES ('$money')";
                mysqli_query($con, $inserTotalCash);
            }
            

        } else {
            $typeofD = $donateT.": ".$typeofdonation;
            $insertQueryDonationTable = "INSERT INTO donation_table (acc_id, name, type_of_donation, description, proof_donation,  date_donated, status, notif_status) VALUES ($id, '$name', '$typeofD', '$description', '$image', '$date', 'Being droped off', 1)";
            mysqli_query($con, $insertQueryDonationTable);
            move_uploaded_file($tmp_name, "$target/$image");
        }
        if(move_uploaded_file($tmp_name, "$target/$image")) {
            echo "moved";
        } else {
            echo $name;
            echo $con->error;
        }
        // echo $image;
        header("Location: ../../donor_profile.php");
    }

    function getId(){
        $ids = 0;
        if(isset($_SESSION['email'])){
            $link=mysqli_connect("localhost","root", "") or die(mysqli_error($link));
            mysqli_select_db($link, "ebigay") or die(mysqli_error($link));
            $res=mysqli_query($link, "select id from registered_accounts 
            where email = '" .$_SESSION['email']. "'");
            while($row=mysqli_fetch_array($res)){
            $ids = $row["id"];
            }
            
        }
        return $ids;
    }

    function getName(){
        $names = 0;
        if(isset($_SESSION['email'])){
            $link=mysqli_connect("localhost","root", "") or die(mysqli_error($link));
            mysqli_select_db($link, "ebigay") or die(mysqli_error($link));
            $res=mysqli_query($link, "select name from registered_accounts 
            where email = '" .$_SESSION['email']. "'");
            while($row=mysqli_fetch_array($res)){
            $names = $row["name"];
            }
            
        }
        return $names;
    }
?>