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
    <title>E-Bigay | Recipient Profile</title>
    <!-- Favicons -->
    <link href="assets/img/logo2.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">    
    <!-- Custom CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/recipient.css">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">
            <div id="logo">
                <h1><a href="index.php" style="text-decoration:none"><span>E-Bigay <img src="assets/img/logo2.png" alt="" style="width:50px"></span></a></h1>
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
                    echo "<li><a class='nav-link scrollto active' href='recipient_profile.php'>". $name ."</a></li>";
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown">
                        <span class="label label-pill label-danger count" style="border-radius:10px; color:red;"></span>
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
                            echo "<li><a class='nav-link scrollto' href='assets/php/logout.php'>Log Out</a></li>";
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
            </nav>
        </div>
    </header>	
    <div class="container">
        <div class="row pt-5 mb-5 row-center" >
            <section id="spacer1" class="home-section spacer">
                <h1 data-wow-delay="1s">Recipeint Profile Page</h1>
            </section>
            <div class=" row pt-5 pb-5 mb-2 row-center bg-secondary info-text" style="margin-left: 1px;">
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
                            <!-- Button to generate QR Code for the entered data -->
                            <button type="button" class="btn btn-success" id="generate">Generate QR Code</button>
                        </div>
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
                <th scope="col">Date Claimed</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="recipients">
                <?php
                    include('assets/php/config.php');
                    $email = $_SESSION['email'];
                    $sql = "SELECT transactiontable.transac_id AS id, transactiontable.date_claimed AS date, transactiontable.status AS status FROM transactiontable INNER JOIN registered_accounts ON registered_accounts.id = $acctid WHERE transactiontable.acc_id = $acctid ORDER BY transac_id DESC";
                    $res = mysqli_query($con, $sql );
                    while($row=mysqli_fetch_array($res)){
                        echo "<tr>";
                            echo "<td>";echo $row['id']; echo "</td>";
                            if($row['status'] != "Pending") {
                                echo "<td>";echo date("F j, Y", strtotime($row['date'])); echo "</td>";
                            } else {
                                echo "<td>Not Yet Available</td>";
                            }
                            echo "<td>";echo $row["status"]; echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/recipient_notif.js"></script>
    <!-- In house JavaScript -->
    <script type="text/javascript">
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#recipients tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        // Function to HTML encode the text
        // This creates a new hidden element,
        // inserts the given text into it
        // and outputs it out as HTML
        function htmlEncode(value) {
            return $('<div/>').text(value)
                .html();
        }
        $(function () {
            // Specify an onclick function
            // for the generate button
            $('#generate').click(function () {
                $('#qrCode').removeAttr('hidden');
                $('#generate').attr('hidden', true);
                // Generate the link that would be
                // used to generate the QR Code
                // with the given data
                let finalURL = 'https://chart.googleapis.com/chart?cht=qr&chl=' + htmlEncode('<?php echo $acctid ?>')  + '&chs=160x160&chld=L|0'
                // Replace the src of the image with
                // the QR code image
                $('.qr-code').attr('src', finalURL);
            });
        });
    </script>
</body>
</html>