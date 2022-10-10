<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$payment = new PaymentContr();

if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];

    $result = $payment->deleteReservation($del_id);

    if ($result) {
        $msg = "Booking deleted!";
    } else {
        $msg = "Booking wasn't deleted!";
    }
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Booked Warehouses</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
    <!-- header link file -->
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    <?php
    if (!empty($msg)) {
        echo "<p class='error_noti'>" . $msg . "</p>";
    } else {
    }
    ?>
    </br>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Booked Warehouses</p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Warehouse</th>
                        <th>Property Name</th>
                        <th>Customer</th>
                        <th>Capacity</th>
                        <th>Amount</th>
                        <th>Your Fee</th>
                        <th>Action</th>
                    </tr>
                    <?php

                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $payment->viewNotDeletedFinances($user_id, $page1, 5);
                    $index = $page1 + 1;
                    foreach ($row as $rw) {
                        $price = number_format($rw['price'] * $rw['ren_capacity']);
                        $owner = number_format($rw['owner_fee']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td style="text-transform:capitalize;"><?php echo $rw['name']; ?> Warehouse</td>
                            <td style="text-transform:capitalize;"><?php echo $rw['property_name'] ?></td>
                            <td style="text-transform:capitalize;"><?php echo $rw['owner_name'] ?></td>
                            <td><?php echo $rw['ren_capacity']; ?>m<sup>2</sup></td>
                            <td><?php echo $price; ?> MWK</td>
                            <td><?php echo $owner; ?> MWK</td>
                            <td><a href="booked_warehouses.owner.php?del_id=<?php echo $rw['rented_id'] ?>" style="text-decoration: none;"><span class="fa fa-trash-alt"></span> Del</a></td>
                        </tr>
                    <?php
                        $index++;
                    }
                    ?>



                </table>
            </div>
        </div>
        <?php
        $cout = $payment->countNotDeletedFinances($user_id);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="booked_warehouses.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
            <?php } ?>
            <span>&#8594;</span>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>
    <!-- footer link file -->
    <?php include "footer.owner.php" ?>
    </div>


</body>


</html>