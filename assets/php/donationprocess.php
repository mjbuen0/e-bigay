<?php
    require('config.php');

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target = "../../admin/assets/img/uploads";
        $tmp_name = $_FILES["file"]["tmp_name"];


        
        $id ="";
        $name = $_POST['donorname'];
        $sql = "SELECT id FROM registered_accounts WHERE name = '$name'";
        // $sql = "SELECT id FROM donation_table";s
        $res = mysqli_query($con, $sql ); 
        while($row=mysqli_fetch_array($res)){
            $id = $row['id'];
        }
        $donateT = $_POST['donatetype'];
        $image = $_FILES['file']['name'];
        $date = $_POST['donategendate'];
        $date = date("F j, Y", strtotime($date));

        $sql = "INSERT INTO donation_table (acc_id, name, type_of_donation, proof_donation, date_donated) VALUES ($id, '$name', '$donateT', '$image', '$date')";
        mysqli_query($con, $sql);
        move_uploaded_file($tmp_name, "$target/$image");

        if(move_uploaded_file($tmp_name, "$target/$image")) {
            echo "moved";
        } else {
            echo $name;
            echo $con->error;
        }
        // echo $image;
        header("Location: ../../index.php");
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