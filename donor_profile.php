<?php 
	session_start();
    if(empty($_SESSION['id'])) {
        header('location: index.php');
    } else {
        $isActive = isset($_SESSION['email']);
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Bigay | Donor Profile</title>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css%22%3E   <link rel=" stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- Favicons -->
    <link href="assets/img/logo2.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/recipient.css">
</head>
<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">
            <div id="logo">
                <h1><a href="index.php"><span>E-Bigay <img src="assets/img/logo2.png" alt="" style="width:50px"></span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <?php
                    include('assets/php/config.php');
                    $sql = "SELECT * FROM registered_accounts WHERE email = '" .$_SESSION['email']. "'";
                    $res = mysqli_query($con, $sql );
                    if(! $res ) {
                        die('Could not get data: ' . mysql_error());
                    }
                    while($row=mysqli_fetch_array($res)){
                        $name = $row["name"];
                    }
                    echo "<li><a class='nav-link scrollto active' href='donor_profile.php'>". $name ."</a></li>";
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown">
                        <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                        <i class="fas fa-bell" style="font-size:18px;"></i></a>
                        <div class="dropdown-menu" style="padding-left:5px;width:300px;"></div>
                    </li>
                    <li><a class="nav-link scrollto " href="index.php#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                    <?php
                    switch ($isActive) {
                        case 'value' :{
                            echo "<li><a class='nav-link scrollto' href='assets/php/logout.php' style='color: red;'>Log Out</a></li>";
                        break;
                        }
                        default:{
                            echo "<li><a class='nav-link scrollto' href='LoginPage.php'>Log-In</a></li>";
                        break;
                        }
                    }
                ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>
    <div class="container">
        <div class="row pt-5 mb-5 row-center" >
            <div class="col-6 " style="text-align: center;">
                <img id="profile-pic"
                    src="assets/img/placeholder/avatar.png" alt="" srcset=""><br>
                    <?php
                        include('assets/php/config.php');
                        $sql = "SELECT * FROM registered_accounts WHERE email = '" .$_SESSION['email']. "' ORDER BY id DESC LIMIT 1";
                        $retval = mysqli_query($con, $sql );
                        if(! $retval ) {
                            die('Could not get data: ' . mysql_error());
                        }
                        while($row = $retval->fetch_assoc()) {
                            $acctid = $row['id'];
                            // $name = $row['name'];
                            echo "<ul class='personalinfo' style='list-style-type:none; text-align: left;'>";
                            echo "<li id='name'><b>Full Name: </b>".$row['name']."</li>" ;
                            echo "<li><b>Birth Date: </b>". $row['datebirth']."</li>" ;
                            echo "<li><b>Address: </b>". $row['address']."</li>" ;
                            echo "<li><b>Phone No.: </b>". $row['phone']."</li>" ;
                            echo "<li><b>E-Mail: </b>". $row['email']."</li>" ;
                            echo "</ul>";
                        }
                    ?>
            </div>
            <div class="col-6 align-self-center" style=" text-align: center; ">
                <img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0"
                    class="qr-code img-thumbnail img-responsive" hidden="true" id="qrCode" />
                <div class="form-group d-flex justify-content-center">
                    <div class="col-sm-offset-2 col-sm-10 ">
                        <!-- Button to generate QR Code for the entered data -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#donateCashModal">Donate Cash</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <table class="table " >
            <thead class="thead-dark">
                <tr>
                <th scope="col">Transaction ID</th>
                <th scope="col">Date Donated</th>
                <th scope="col">Proof of Donation</th>
                <th scope="col">Type of Donation</th>
                </tr>
            </thead>
            <tbody id="recipients">
                <?php
                    include('assets/php/config.php');
                    // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
                    // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Claimed'";
                    $email = $_SESSION['email'];
                    $sql = "SELECT donation_table.id AS id, donation_table.date_donated AS date, donation_table.proof_donation AS proof, donation_table.type_of_donation AS type FROM donation_table INNER JOIN registered_accounts ON registered_accounts.id = $acctid WHERE donation_table.acc_id = $acctid ORDER BY id DESC";
                    // $sql = "SELECT id FROM donation_table";s
                    $res = mysqli_query($con, $sql );
                    while($row=mysqli_fetch_array($res)){
                        echo "<tr>";
                            echo "<td>";echo $row['id']; echo "</td>";
                            echo "<td>";echo $row['date']; echo "</td>";
                            // echo "<td><button id='showimg".$row['id']."' value='".$row['id']."' data-bs-toggle='modal' data-bs-target='#exampleModal'>".$row['proof']."</button></td>";
                            // echo "<td><a class='image-link".$row['id']."' href='admin/assets/img/uploads/".$row['proof']."'>".$row['proof']."</a></td>";
                            echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#imgModal".$row['id']."'>".$row['proof']."</a></td>";
                            echo "<td>";echo $row["type"]; echo "</td>";
                        echo "</tr>";
                        // modal
                        echo "
                            <div class='modal fade' id='imgModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <img src='admin/assets/img/uploads/".$row['proof']."' style='width:100%;'>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                        <button type='button' class='btn btn-primary'>Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="donateCashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Donate Cash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="assets/php/donationprocess.php" method="POST" enctype="multipart/form-data">
                    <label for="donorname">Name of Donor</label>
                    <input type="text" name="donorname" id="donorname" class="form-control" value='<?php echo $name ?>'>
                    <label for="donatetype"> Type of Donation</label>
                    <input type="text" name="donatetype" id="donatetype" class="form-control" value="Cash">
                    <label for="donatepicture">Reciept</label>
                    <input type="file" name="file" class="form-control">
                    <label for="donategendate">Date Donated</label>
                    <input class="form-control" type="date" name="donategendate" id="donategendate">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="done" class="btn btn-primary" value="Send">
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/donor_notif.js"></script>
    <script type="text/javascript">
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#recipients tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
    </script>
    <!-- <script>
        $(document).ready(function() {
            $( ".image-link23" ).click(function() {
                alert( "Handler for .click() called." );
            });
        });
    </script> -->
</body>
</html>