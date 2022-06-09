<?php
    include('assets/php/config.php');
	session_start();
	if(!$_SESSION['logedinAdmin']) {
		echo "<script>alert('Please login first');</script>";
		header('Location: adminlogin.php');
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/new_index.css">
    
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="index.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                        <i class="fas fa-solid fa-peso-sign fa-fw me-3"></i><span>Cash Accumulated</span>
                    </a>
                    <a href="pages/inbox.php" class="list-group-item list-group-item-action py-2 ripple message-link" aria-current="true">
                        <i class="fas fa-solid fa-inbox fa-fw me-3"></i><span>Mail</span>
                    </a>
                    <a href="pages/list_of_recipients.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-users fa-fw me-3"></i><span>List of Recipients</span>
                    </a>
                    <a href="pages/unclaimed_donations.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-clipboard fa-fw me-3"></i><span>Recipient's Unclaimed Donation</span></a>
                    <a href="pages/claimed_donations.php" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-solid fa-clipboard-check fa-fw me-3"></i><span>Claimed Donations</span></a>
                    <a href="pages/list_of_donation.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-solid fa-clipboard-list fa-fw me-3"></i><span>List of Donations</span>
                    </a>
                    <a href="pages/inventory_of_itmes.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-solid fa-boxes-stacked fa-fw me-3"></i><span>Inventory of Items</span></a>
                    <a href="assets/php/logout.php" class="list-group-item list-group-item-action py-2 ripple">
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
                    <img src="assets/img/logo2.png" height="50px" alt=""
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
            <?php
                $getTotalAmountQuery = "SELECT total FROM total_cash";
                $getTotalAmountResult = mysqli_query($con, $getTotalAmountQuery );
                $totalamount = mysqli_fetch_array($getTotalAmountResult);
                $total = "₱ ".number_format($totalamount['total'], 2);
            ?>
            <div class="row">
                <div class="col">
                    <h1>Total Amount Accumulated: </h1>
                    <div class="total-amount">
                        <?php echo "<h2>$total</h2>";?>
                    </div>
                </div>
                <div class="col">
                    <div style="width:100%">
                        <div class="col align-self-start ">
                            <div class="row">
                                <div class="col">
                                    <input class="form-control mb-3" id="total-amount-search" type="text"
                                        placeholder="Search.." style="width:400px">
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="button" style="background-color:#50d8af; border:none; color:white;"
                                        class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateMessage">
                                        Generate Message
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="table-container">
                    </div>
                    <table class="display" id="cash-amount" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Proof of Receipt</th>
                            </tr>
                        </thead>
                        <tbody id="list-amount">
                            <?php
                                $getAllCashDonationQuery = "SELECT * FROM cash_table";
                                $getAllCashDonationResult = mysqli_query($con, $getAllCashDonationQuery );
                                $totalamount = 0;
                                while($row=mysqli_fetch_array($getAllCashDonationResult)){
                                    echo "<tr>";
                                        echo "<td>";echo $row['name']; echo "</td>";
                                        echo "<td>";echo "₱ ".number_format($row['amount'], 2); echo "</td>";
                                        echo "<td class='text-center'><a href='#' data-bs-toggle='modal' data-bs-target='#imgReceiptModal".$row['id']."'>See Image...</a></td>";
                                    echo "</tr>";
                                    // Modal of Amounts
                                    echo "
                                        <div class='modal fade' id='imgReceiptModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLabel'>Proof of Receipt</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <img src='assets/img/uploads/".$row['proof_of_receipt']."' style='width:100%;'>
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
        </div>
        <?php include('assets/includes/modal.php') ?>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        $(document).ready(function (){
            $('#cash-amount').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
            $("#total-amount-search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#list-amount tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>