<?php
    require('config.php');

    session_start();
  
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target = "../../assets/img/uploads";
        $tmp_name = $_FILES["donatepicure"]["tmp_name"];


        
        $id ="";
        $name = $_POST['donorname'];
        $sql = "SELECT id FROM registered_accounts WHERE name = '$name'";
        // $sql = "SELECT id FROM donation_table";s
        $res = mysqli_query($con, $sql ); 
        while($row=mysqli_fetch_array($res)){
            $id = $row['id'];
        }
        $donateT = $_POST['donatetype'];
        $image = $_FILES['donatepicure']['name'];
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


    // $statusMsg = '';

    // $targetDir = "../../uploads/";
    // $fileName = basename($_FILES["file"]["name"],'.jpg');
    // $targetFilePath = $targetDir . $fileName;
    // $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES["file"]["name"])) {
    //     // Allow certain file formats
    //     $allowTypes = array('jpg','png','jpeg');
    

    //     if(in_array($fileType, $allowTypes)) {
    //         if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
    //             // $name = $_POST['donorname'];
    //             $name ="";
    //             $id ="";
    //             $selsql = "SELECT id, name FROM registered_accounts WHERE `name` = '$name' AND `role` = 'Donor' LIMIT 1";
    //             $res = mysqli_query($con, $selsql );
    //             while($row=mysqli_fetch_array($res)){
    //                 $id = $row['id'];
    //                 $name = $row['name'];
    //             }
    //             $donatetpye = $_POST['donatetype'];
    //             $date = $_POST['donategendate'];
    //             $date = date("F j, Y", strtotime($date));

    //             $sql = "INSERT INTO danation_table (acc_id, name, type_of_donation, image, date_donated) VALUES ($id, '$name', '$donatetpye', `$fileName`, '$date')";
    //             $result = $con->query($sql);
    //             if($result) {
    //                 header("Location:../../donor_profile.php");
    //             } 
    //             else {
    //                 echo "$fileName";
    //                 echo $con->error;
    //             }
    //         }
    //     }
    // }

?>