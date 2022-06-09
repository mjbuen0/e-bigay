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
                            echo "<li><a class='nav-link scrollto' href='loginpage.php'>Log-In</a></li>";
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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#donateCashModal">Donate Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <input class="form-control w-25 mt-3" id="search-donation" type="text" placeholder="Search..">
            <table class="display" id="list-of-donation">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Date Donated</th>
                        <th scope="col">Proof of Donation</th>
                        <th scope="col">Type of Donation</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="donations">
                    <?php
                        include('assets/php/config.php');
                        $email = $_SESSION['email'];
                        // $sql = "SELECT donation_table.id AS id, donation_table.date_donated AS date, donation_table.amount AS amount, donation_table.proof_donation AS proof, donation_table.type_of_donation AS type FROM donation_table INNER JOIN registered_accounts ON registered_accounts.id = $acctid WHERE donation_table.acc_id = $acctid ORDER BY id DESC";
                        // $sql = "SELECT * FROM donation_table WHERE email = '".$_SESSION['email']."'";
                        $getDonorAcct = "SELECT id FROM registered_accounts WHERE email = '$email'";
                        $getDonorAcctResult = mysqli_query($con, $getDonorAcct);
                        $id = mysqli_num_rows($getDonorAcctResult);
                        // echo $acctid;
                        $sql = "SELECT * FROM donation_table WHERE acc_id = '".$acctid."'";
                        $res = mysqli_query($con, $sql );
                        while($row=mysqli_fetch_array($res)){
                            echo "<tr>";
                                echo "<td>";echo $row['id']; echo "</td>";
                                echo "<td>";echo $row['date_donated']; echo "</td>";
                                echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#imgModal".$row['id']."'>See Image...</a></td>";
                                if ($row['type_of_donation'] == "Cash") {
                                    echo "<td>";echo $row["type_of_donation"]; echo "</td>";
                                } else {
                                    echo "<td>";echo $row["type_of_donation"]; echo "<br><a href='#' data-bs-toggle='modal' data-bs-target='#detailsModal".$row['id']."'>See Details</a></td>";
                                }
                                if($row['status'] == "Being droped off") {
                                    echo "<td>Being droped off</td>";
                                } else {
                                    echo "<td>";echo $row['status']; echo "</td>";
                                }
                            echo "</tr>";
                            // modal
                            echo "
                                <div class='modal fade' id='imgModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>Proof of Donation</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <img src='admin/assets/img/uploads/".$row['proof_donation']."' style='width:100%;'>
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <input class="form-control w-25 mt-3" id="search-proofs" type="text" placeholder="Search..">
            <table class="display" id="proof-of-acceptance">
                <thead>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Date Donated</th>
                    <th scope="col">Proof of Donation</th>
                    <th scope="col">Type of Donation</th>
                </thead>
                <tbody id="proofs">

                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="donateCashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Donate Now!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="assets/php/donationprocess.php" method="POST" enctype="multipart/form-data">
                    <label for="donorname" class="fw-bold">Name of Donor</label>
                    <input type="text" name="donorname" id="donorname" class="form-control" value='<?php echo $name ?>' readonly>
                    <label for="donatetype" class="fw-bold">Type of Donation</label>
                    <select class="form-control" name="donatetype" id="donatetype" onchange="donateType()" required>
                        <option value="" selected disabled>Please Select...</option>
                        <option value="Cash">Cash</option>
                        <option value="Goods">Goods</option>
                    </select>
                    <div class="form-group" id="cash-group" hidden >
                        <label for="amount" class="fw-bold">How much will you donate?</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                        <span class="text-muted">Gcash Number: Antonio Miguel S. - 09206199333</span><br>
                    </div>
                    <div class="form-group" id="goods-group" hidden>
                        <label for="typeofgoods" class="fw-bold">Type of Goods</label>
                        <select class="form-control" name="typeofgoods" id="typeofgoods" onchange="donateType()" required>
                            <option value="" selected disabled>Please Select...</option>
                            <option value="Food">Food</option>
                            <option value="Clothes">Clothes</option>
                            <option value="Toiletries">Toiletries</option>
                            <option value="First aid">First Aid</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group" id="donationdescription-group" hidden>
                        <label for="goodsdescription" class="fw-bold">Description</label>
                        <!-- <input type="text" name="goodsdescription" id="goodsdescription" class="form-control" required> -->
                        <textarea class="form-control" name="goodsdescription" id="goodsdescription" rows="5" style="resize:none;" required></textarea>
                        <span class="text-muted">Note: Break down the goods that you're going to donate for example:<br>Clothes:<br>5x for boys pants<br>5x for girls dress</span><br>
                    </div>
                    <label for="donatepicture" class="fw-bold">Reciept</label>
                    <input type="file" name="file" class="form-control">
                    <label for="donategendate" class="fw-bold">Date Donated</label>
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
    <?php include('assets/includes/modal.php') ?>
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
        $('#list-of-donation').DataTable({
            "paging": true,
            "searching" : false,
            "dom": '<"top"i>rt<"bottom"flp><"clear">'
        });
        $('#proof-of-acceptance').DataTable({
            "paging": true,
            "searching" : false,
            "dom": '<"top"i>rt<"bottom"flp><"clear">'
        });
        $("#search-donation").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#donations tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#search-proofs").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#proofs tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
    </script>
    <script>
        function donateType() {
            var type = document.getElementById('donatetype').value;
            if (type == "Cash") {
                document.getElementById('goods-group').setAttribute('hidden', 'true');
                document.getElementById('typeofgoods').removeAttribute('required');

                document.getElementById('donationdescription-group').setAttribute('hidden', 'true');
                document.getElementById('goodsdescription').removeAttribute('required');

                document.getElementById('cash-group').removeAttribute('hidden');
                document.getElementById('amount').setAttribute('required', 'true');
            } else {
                document.getElementById('cash-group').setAttribute('hidden', 'true');
                document.getElementById('amount').removeAttribute('required');

                document.getElementById('goods-group').removeAttribute('hidden');
                document.getElementById('typeofgoods').setAttribute('required', 'true');

                document.getElementById('donationdescription-group').removeAttribute('hidden');
                document.getElementById('goodsdescription').setAttribute('required', 'true');
            }
        }
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("donategendate")[0].setAttribute('min', today);
    </script>
</body>
</html>