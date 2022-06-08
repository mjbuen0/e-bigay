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
    <script src="../assets/js/inbox_notif.js"></script>
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
                    <a href="inbox.php" class="list-group-item list-group-item-action py-2 ripple message-link" aria-current="true">
                        <i class="fas fa-solid fa-inbox fa-fw me-3"></i><span>Messages&nbsp;&nbsp;</span><span class="notification"></span>
                    </a>
                    <a href="list_of_recipients.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-users fa-fw me-3"></i><span>List of Recipients</span>
                    </a>
                    <a href="unclaimed_donations.php" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-solid fa-clipboard fa-fw me-3"></i><span>Recipient's Unclaimed Donation</span></a>
                    <a href="claimed_donations.php" class="list-group-item list-group-item-action py-2 ripple"><i
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
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="d-flex justify-content-center">
                <div class="" style="width: 350px;" id="reader"></div>
            </div>
            <div class="col align-self-start mb-3 mt-3">
                <input class="form-control" id="search-unclaimed-donation" type="text"
                    placeholder="Search.." style="width:400px">
            </div>
            <table class="display nowrap" id="unclaimed-donation-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Account ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col" style='text-align:center;'>Action</th>
                    </tr>
                </thead>
                <tbody id="unclaimed-donation-table-body">
                    <?php
                        $sql = "SELECT transactiontable.acc_id AS id, 
                        registered_accounts.name AS name, 
                        registered_accounts.email AS email, 
                        registered_accounts.address AS address, 
                        registered_accounts.phone AS phone, 
                        transactiontable.status AS status, 
                        transactiontable.transac_id FROM registered_accounts 
                        INNER JOIN transactiontable ON registered_accounts.id = transactiontable.acc_id 
                        WHERE transactiontable.status = 'Pending' AND registered_accounts.role = 'Recipient'";
                        $res = mysqli_query($con, $sql );
                        $count = 0;
                        while($row=mysqli_fetch_array($res)){
                            $id = $row['id'];
                            $transacid = $row['transac_id'];
                            echo "<tr>";
                                echo "<td>";echo $row['id']; echo "</td>";
                                echo "<td>";echo $row['name']; echo "</td>";
                                echo "<td>";echo $row["email"]; echo "</td>";
                                echo "<td>";echo "0".$row["phone"];  echo "</td>";
                                echo "<td style='text-align:center;'><button onclick='complete($id, $transacid)' class='btn form-group btn-success'>Complete</button></td>";
                            echo "</tr>";
                            $count++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- modals -->
        <?php include_once('../assets/includes/modal.php') ?>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/html5-qrcode.min.js"></script>

    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            document.getElementById("search-unclaimed-donation").setAttribute('value', `${decodedText}`);
            console.log(`Scan result: ${decodedText}`, decodedResult);

            // ...
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        $("#search-unclaimed-donation").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#unclaimed-donation-table-body tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        html5QrcodeScanner.render(onScanSuccess);
        $(document).ready(function (){
            $('#unclaimed-donation-table').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>