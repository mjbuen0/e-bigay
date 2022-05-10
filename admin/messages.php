<?php
	session_start();
    include('assets/php/config.php');
	if(!$_SESSION['logedinAdmin']) {
		echo "<script>alert('Please login first');</script>";
		header('Location: adminlogin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-Bigay | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css%22%3E   <link rel=" stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/inbox.css">
    <style>
        @media only screen and (max-width: 720px) {
            #donors-table {
                font-size: 12px;
            }

            .scroll-table {
                overflow: scroll;
                height: 300px;
            }

        }
    </style>
</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">
            <div id="logo">
                <h1><a href="index.html"><span>E-Bigay</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class='nav-link scrollto' href='index.php'>Tables</a></li>
                    <li><a class='nav-link scrollto' href='assets/php/logout.php'>Log Out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>
    <section>
        <div class="container">
            <h2>Messages</h2>
            <div class="d-flex align-items-start">
                <div class="scroll">
                    <div class="nav flex-column nav-pills me-3 col-3 cut-text" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php 
                            $sql = "SELECT * FROM messages ORDER BY msg_id DESC";
                            $res = mysqli_query($con, $sql );
                            while($row=mysqli_fetch_array($res)){
                            ?>
                                <button class="nav-link text-align-left cut-text" id="v-pills-<?php echo $row['msg_id'] ?>-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-<?php echo $row['msg_id'] ?>" type="button" role="tab" aria-controls="v-pills-<?php echo $row['msg_id'] ?>"
                                    aria-selected="true">
                                    <?php echo $row['sender_name'] ?><br>
                                    <span><?php echo $row['msg_subject'] ?></span><br>
                                    <span><?php echo $row['msg_body'] ?></span>
                                </button>
                            <?php    
                            }
                        ?>
                        
                    </div>
                </div>
                <div class="vl"></div>
                <div class="tab-content col-9 "  id="v-pills-tabContent">
                    <div class="tab-pane fade show active " style="text-align:center;" id="v-pills-no" role="tabpanel"
                        aria-labelledby="v-pills-no-tab"><h3>No Message Selected</h3></div>
                    <?php
                        $sql = "SELECT * FROM messages ORDER BY msg_id DESC";
                        $res = mysqli_query($con, $sql );
                        while($row2=mysqli_fetch_array($res)){
                            ?>
                            <div class="tab-pane fade show" id="v-pills-<?php echo $row2['msg_id'] ?>" role="tabpanel"
                                aria-labelledby="v-pills-<?php echo $row2['msg_id'] ?>-tab">
                                <h3><?php echo $row2['msg_subject']?><h3>
                                <h5><?php echo $row2['sender_name']?><br><?php echo $row2['sender_email']?></h5>
                                <div class="message-body">
                                    <?php echo $row2['msg_body']?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"> </script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/html5-qrcode.min.js"></script>
    <script>
    </script>
</body>

</html>