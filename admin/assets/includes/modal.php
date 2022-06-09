<?php
    $sqlacc = "SELECT * FROM registered_accounts";
    $res = mysqli_query($con, $sqlacc );
    while($row=mysqli_fetch_array($res)){
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
                            <form action="../assets/php/generatedate.php" method="POST">
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
                                <input class="form-control gendate" type="date" name="gendate" id="gendate">
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
<!-- Generate Report Modal -->
<div class="modal fade" id="genreport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate a report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../assets/php/generatereport.php" method="POST">
                <div class="form-group">
                    <label>Month</label>
                    <!-- <input type="text" name="month" id="month" class="form-control" value="" maxlength="50" required> -->
                    <select name="month" id="month" class="form-control" required>
                        <option value="" selected disabled>Please Select a Month:</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label>Year</label>
                    <input type="text" name="year" id="year" class="form-control" value="" maxlength="30" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-success" type="submit" id="generateReport" name="generateReport" value="Generate">
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Details Modals -->
<!-- Modal -->
<?php
$sql = "SELECT donation_table.id AS id, registered_accounts.id AS acc_id, registered_accounts.email AS email, donation_table.date_donated AS date, donation_table.proof_donation AS proof, donation_table.type_of_donation AS type, donation_table.description AS description, donation_table.status AS status FROM donation_table INNER JOIN registered_accounts ON registered_accounts.id = donation_table.acc_id ORDER BY id DESC";
$res = mysqli_query($con, $sql);

while($row=mysqli_fetch_array($res)){
    $id = $row['id'];
    ?>
    <div class="modal fade" id="detailsModal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['type']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo nl2br($row['description']); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>

<!-- Messages -->
<?php
$sql = "SELECT * FROM messages";
$res = mysqli_query($con, $sql);

while($row=mysqli_fetch_array($res)){
    $id = $row['msg_id'];
    ?>
    <div class="modal fade" id="meesageModal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Name: <?php echo $row['sender_name']; ?></h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Email: <?php echo $row['sender_email']; ?></h6>
                    <h6>Subject: <?php echo $row['msg_subject']; ?></h6>
                    <?php echo nl2br($row['msg_body']); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

?>

<!-- Generate Bill Report Messager to Donors Modal -->
<div class="modal fade" id="generateMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Genereate Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="assets/php/sendmailtodonor.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="" maxlength="50" required>
                </div>
                <div class="form-group ">
                    <label>Message</label>
                    <textarea class="form-control" name="message" id="message" rows="5" style="resize:none;" required></textarea>
                </div>
                <div class="form-group ">
                    <label>Total Cost</label>
                    <input type="number" name="cost" id="cost" class="form-control" value="" maxlength="30" required>
                </div>
                <div class="form-group ">
                    <label>Image</label>
                    <input type="file" name="attachment" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" id="send" name="send" value="Send">
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Distributed Donations Modal -->
<div class="modal fade" id="showditributed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Distributed Donations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col align-self-start mb-3 mt-3">
                    <input class="form-control" id="distributed-donations-search" type="text"
                        placeholder="Search.." style="width:400px">
                </div>
                <table class="display nowrap" id="distributed-donations-table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Account ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Donated</th>
                            <th scope="col">Proof of Donation</th>
                            <th scope="col">Type of Donation</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="distributed-donations-table-body">
                        <?php
                            $email = $_SESSION['email'];
                            $sql = "SELECT donation_table.id AS id, registered_accounts.id AS acc_id, registered_accounts.email AS email, donation_table.date_donated AS date, donation_table.proof_donation AS proof, donation_table.type_of_donation AS type, donation_table.status AS status FROM donation_table INNER JOIN registered_accounts ON registered_accounts.id = donation_table.acc_id ORDER BY id DESC";
                            $res = mysqli_query($con, $sql );
                            while($row=mysqli_fetch_array($res)){
                                $id = $row['id'];
                                $accid = $row['acc_id'];
                                if ($row['status'] == "Distributed" && $row['type'] != "Cash") {
                                    echo "<tr>";
                                        echo "<td>";echo $row['id']; echo "</td>";
                                        echo "<td>";echo $row['acc_id']; echo "</td>";
                                        echo "<td>";echo $row['email']; echo "</td>";
                                        echo "<td>";echo $row['date']; echo "</td>";
                                        echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#imgModal".$row['id']."'>See Image...</a></td>";
                                        if ($row['type'] == "Cash") {
                                            echo "<td>";echo $row["type"]; echo "</td>";
                                        } else {
                                            echo "<td>";echo $row["type"]; echo "<br><a href='#' data-bs-toggle='modal' data-bs-target='#detailsModal".$row['id']."'>See Details</a></td>";
                                        }
                                        echo "<td>";echo $row['status']; echo "</td>";
                                    echo "</tr>";
                                }
                                // modal
                                echo "
                                    <div class='modal fade' id='imgModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>Image</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='../assets/img/uploads/".$row['proof']."' style='width:100%;'>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>