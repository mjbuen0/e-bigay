<?php
    include('../assets/php/config.php');
	session_start();
	if(!$_SESSION['logedinAdmin']) {
		echo "<script>alert('Please login first');</script>";
		header('Location: ../adminlogin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/new_index.css">
    
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="../index.php" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
                        <i class="fas fa-solid fa-peso-sign fa-fw me-3"></i><span>Cash Accumulated</span>
                    </a>
                    <a href="inbox.php" class="list-group-item list-group-item-action py-2 ripple active message-link" aria-current="true">
                        <i class="fas fa-solid fa-inbox fa-fw me-3"></i><span>Mail</span>
                    </a>
                    <a href="list_of_recipients.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-users fa-fw me-3"></i><span>List of Recipients</span>
                    </a>
                    <a href="unclaimed_donations.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-solid fa-clipboard fa-fw me-3"></i><span>Recipient's Unclaimed Donation</span></a>
                    <a href="claimed_donations.php" class="list-group-item list-group-item-action py-2 ripple "><i
                            class="fas fa-solid fa-clipboard-check fa-fw me-3"></i><span>Claimed Donations</span></a>
                    <a href="list_of_donation.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-clipboard-list fa-fw me-3"></i><span>List of Donations</span>
                    </a>
                    <a href="inventory_of_itmes.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-solid fa-boxes-stacked fa-fw me-3"></i><span>Inventory of Items</span></a>
                    <a href="../assets/php/logout.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-solid fa-arrow-right-from-bracket fa-fw me-3 text-danger"></i><span class="text-danger">Log Out</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/logo2.png" height="50px" alt=""
                        loading="lazy" />
                </a>
                <div class="d-none d-md-flex input-group w-auto my-auto" id="nav-header-div">
                    <h1 class="nav-header"><a href="index.html"><span>E-Bigay</span></a></h1>
                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->
    <!--Main layout-->
    <main style="margin-top: 100px">
        <div class="container text-center">
            <h3>To open your mail click here:</h3><br>
            <a href="http://www.e-bigay.com/webmail" target="_blank" class="btn btn-primary btn-m">Open Mail</a>
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="../assets/js/admin.js"></script>
    <!-- <script src="../assets/js/inbox_notif.js"></script> -->
    <script>
        $("#search-message").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("div.card").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>