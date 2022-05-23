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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #total-amount {
            display: grid;
            place-content: center;
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
                    <li><a class='nav-link scrollto' href='messages.php'>Messages</a></li>
                    <li><a class='nav-link scrollto' href='assets/php/logout.php'>Log Out</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <section>
        <div class="d-flex justify-content-center">
            <div class="" style="width: 350px;" id="reader"></div>
        </div>
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            Total Cash amount
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <?php
                                $getTotalAmountQuery = "SELECT amount FROM cash_table";
                                $getTotalAmountResult = mysqli_query($con, $getTotalAmountQuery );
                                $totalamount = 0;
                                while($rowCal=mysqli_fetch_array($getTotalAmountResult)){
                                    $totalamount += $rowCal['amount'];
                                }
                                $total = "₱ ".number_format($totalamount, 2);
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
                                                    <input class="form-control mb-3" id="search-donation" type="text"
                                                        placeholder="Search.." style="width:400px">
                                                </div>
                                                <div class="col d-flex justify-content-end">
                                                    <button type="submit" id="deleteData"
                                                        class="btn btn-primary ">Reset</button>
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
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingZero">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
                            List of Recipients
                        </button>
                    </h2>
                    <div id="collapseZero" class="accordion-collapse collapse " aria-labelledby="headingZero"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <div class="col align-self-start mb-3">
                                <input class="form-control" id="search-account-recipient" type="text"
                                    placeholder="Search.." style="width:400px">
                            </div>
                            <table class="display" id="recipients-account-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Account ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col" style='text-align:center;'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="recipients-account-table-body">
                                    <?php
                                        
                                        // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
                                        // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Pending'";
                                        $sql = "SELECT * FROM registered_accounts WHERE role = 'Recipient'";
                                        $res = mysqli_query($con, $sql );
                                        $count = 0;
                                        while($row=mysqli_fetch_array($res)){
                                            $id = $row['id'];
                                            // $transacid = $row['transac_id'];
                                            echo "<tr>";
                                                echo "<td>";echo $row['id']; echo "</td>";
                                                echo "<td>";echo $row['name']; echo "</td>";
                                                echo "<td>";echo $row["email"]; echo "</td>";
                                                echo "<td>";echo "0".$row["phone"];  echo "</td>";
                                                echo "<td style='text-align:center;'><button data-bs-toggle='modal' data-bs-target='#modal$id' class='btn form-group btn-warning'>Generate Date of Donation</button></td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Recipient's Unclaimed Donation
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <div class="row" style="width:100%">
                                <div class="col align-self-start">
                                    <input class="form-control" id="search-unclaimed-donation" type="text"
                                        placeholder="Search.." style="width:400px">
                                </div>
                            </div>
                            <table class="display" id="recipients-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Account ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col" style='text-align:center;'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="recipients-table-body">
                                    <?php
                                        // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
                                        // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Pending'";
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
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Claimed Donations
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <input class="form-control" id="search-claimed-donation" type="text" placeholder="Search..">
                            <table class="display" id="donors-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Account ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Date Claimed</th>
                                    </tr>
                                </thead>
                                <tbody id="claimed-donation">
                                    <?php
                                        // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
                                        // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Claimed'";
                                        $sql = "SELECT transactiontable.transac_id, registered_accounts.id AS id, registered_accounts.name AS name, registered_accounts.email AS email, registered_accounts.address AS address, registered_accounts.phone AS phone, transactiontable.date_claimed AS date FROM registered_accounts INNER JOIN transactiontable ON registered_accounts.id = transactiontable.acc_id WHERE transactiontable.status = 'Claimed'";
                                        $res = mysqli_query($con, $sql );
                                        while($row=mysqli_fetch_array($res)){
                                            echo "<tr>";
                                                echo "<td>";echo $row['transac_id']; echo "</td>";
                                                echo "<td>";echo $row['id']; echo "</td>";
                                                echo "<td>";echo $row['name']; echo "</td>";
                                                echo "<td>";echo $row["email"]; echo "</td>";
                                                echo "<td>";echo "0".$row["phone"];  echo "</td>";
                                                echo "<td>";echo $row['date']; echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            List of Donations
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <div class="row" style="width:100%">
                                <div class="col align-self-start ">
                                    <input class="form-control mb-3" id="search-donation" type="text"
                                        placeholder="Search.." style="width:400px">
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <!-- <button type="button" style="background-color:#50d8af; border:none; color:white;"
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#donationModal">
                                        List a Donation
                                    </button> -->
                                </div>
                            </div>
                            <table class="display" id="donations">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Account ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date Donated</th>
                                        <th scope="col">Proof of Donation</th>
                                        <th scope="col">Type of Donation</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="list-donation">
                                    <?php
                                        // $sql = "SELECT id, id = (SELECT T.acc_id FROM transaction T WHERE T.acc_id = R.id AND status = 'Pending'), name, email, address, phone FROM registered_accounts R";
                                        // $sql = "SELECT * FROM transactiontable WHERE `status` = 'Claimed'";
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT donation_table.id AS id, registered_accounts.id AS acc_id, registered_accounts.email AS email, donation_table.date_donated AS date, donation_table.proof_donation AS proof, donation_table.type_of_donation AS type, donation_table.status AS status FROM donation_table INNER JOIN registered_accounts ON registered_accounts.id = donation_table.acc_id ORDER BY id DESC";
                                        // $sql = "SELECT id FROM donation_table";s
                                        $res = mysqli_query($con, $sql );
                                        while($row=mysqli_fetch_array($res)){
                                            $id = $row['id'];
                                            $accid = $row['acc_id'];
                                            echo "<tr>";
                                                echo "<td>";echo $row['id']; echo "</td>";
                                                echo "<td>";echo $row['acc_id']; echo "</td>";
                                                echo "<td>";echo $row['email']; echo "</td>";
                                                echo "<td>";echo $row['date']; echo "</td>";
                                                echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#imgModal".$row['id']."'>See Image...</a></td>";
                                                echo "<td>";echo $row["type"]; echo "</td>";
                                                if($row['type'] == "Goods" && $row['status'] != "Received") {
                                                    echo "<td><button onclick='receive($id, $accid)' class='btn btn-success form-group'>Receive</button></td>";
                                                } elseif ($row['type'] == "Goods" && $row['status'] == "Received"){
                                                    echo "<td>";echo $row['status']; echo "</td>";
                                                }else {
                                                    echo "<td></td>";
                                                }
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
                                                            <img src='assets/img/uploads/".$row['proof']."' style='width:100%;'>
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Inventory of Items
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body scroll-table">
                            <div class="row" style="width:100%">
                                <div class="col align-self-start ">
                                    <input class="form-control mb-3" id="search-proofs" type="text"
                                        placeholder="Search.." style="width:400px">
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="button" style="background-color:#50d8af; border:none; color:white;"
                                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listInventModal">
                                        List an Item
                                    </button>
                                </div>
                            </div>
                            <table class="display" id="inventory">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Item ID</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody id="inventory-body">
                                    <?php
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT * FROM inventory";
                                        
                                        $res = mysqli_query($con, $sql );
                                        while($row=mysqli_fetch_array($res)){
                                            echo "<tr>";
                                                echo "<td>";echo $row['item_id']; echo "</td>";
                                                echo "<td>";echo $row['category']; echo "</td>";
                                                echo "<td>";echo $row['quantity']; echo "</td>";
                                                echo "<td>";echo $row['price']; echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        // $sql = "SELECT transactiontable.acc_id AS id, 
        // registered_accounts.name AS name, 
        // registered_accounts.email AS email, 
        // registered_accounts.address AS address, 
        // registered_accounts.phone AS phone, 
        // transactiontable.status AS status, 
        // transactiontable.transac_id FROM registered_accounts 
        // INNER JOIN transactiontable ON registered_accounts.id = transactiontable.acc_id 
        // WHERE transactiontable.status = 'Pending' AND registered_accounts.role = 'Recipient'";
        $sqlacc = "SELECT * FROM registered_accounts";
        $res = mysqli_query($con, $sqlacc );
        while($row=mysqli_fetch_array($res)){
            // $id = $row['id'];
            // $transacid = $row['transac_id'];
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            ?>
                <!-- Generate date of donation Modal -->
                <div class="modal fade" id="modal<?php echo $id?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Generate date of Donations</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="assets/php/generatedate.php" method="POST">
                                    <label for="accountid">Account ID</label>
                                    <input class="form-control mb-2" type="text" name="accountid" id="accountid"
                                        value="<?php echo $id?>" readonly="true">
                                    <label for="name">Name</label>
                                    <input class="form-control mb-2" type="text" name="name" id="name" value="<?php echo $name?>"
                                        readonly="true">
                                    <label for="email">Email</label>
                                    <input class="form-control mb-2" type="text" name="email" id="email" value="<?php echo $email?>"
                                        readonly="true">
                                    <label for="phone">Phone</label>
                                    <input class="form-control mb-2" type="text" name="phone" id="phone"
                                        value="<?php echo "0".$phone?>" readonly="true">
                                    <label for="gendate">Date</label>
                                    <input class="form-control" type="date" name="gendate" id="gendate">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input class="btn btn-success" type="submit" id="generate" name="generate" value="Done">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
    <!-- Inventory -->
    <div class="modal fade" id="listInventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert an Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" id="category" class="form-control" value="" maxlength="50">
                    </div>
                    <div class="form-group ">
                        <label>Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" value="" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" id="price" class="form-control" value="" maxlength="12">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
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
    <!-- Template Main JS File -->
    <script src="assets/js/inbox_notif.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/admin.js"></script>
    <!-- <script src="assets/js/fetch_total_amount.js"></script> -->
    <script src="assets/js/html5-qrcode.min.js"></script>
    <script>
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });

        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            document.getElementById("search-account-recipient").setAttribute('value', `${decodedText}`);
            document.getElementById("search-unclaimed-donation").setAttribute('value', `${decodedText}`);
            console.log(`Scan result: ${decodedText}`, decodedResult);

            // ...
            html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }

        html5QrcodeScanner.render(onScanSuccess);

        $("#search-account-recipient").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#recipients-account-table-body tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#search-unclaimed-donation").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#recipients-table-body tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $("#search-claimed-donation").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#claimed-donation tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#search-donation").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#list-donation tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#search-proofs").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#inventory-body tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $(document).on('click', '#deleteData', function (e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to reset this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Reset Now!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "assets/php/deletecashtable.php",
                        success: function (data) {
                            location.reload();
                        }
                    });
                }
            })
        });

        $(document).ready(function () {
            $('#recipients-account-table').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
            $('#recipients-table').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
            $('#donations').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
            $('#donors-table').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });
            $('#inventory').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">'
            });

            $('#cash-amount').DataTable({
                "paging": true,
                "searching": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "lengthMenu": [
                    [5, 10, 15, 20, 50, -1],
                    [5, 10, 15, 20, 50, "All"]
                ],
                columnDefs: [{
                    targets: 1,
                    className: 'dt-body-right'
                }],
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>