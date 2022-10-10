<?php
include_once '../includes/classautoloader.inc.php';
include "../includes/session.inc.php";
$property = new ManageWarehouseContr();
$payment = new PaymentContr();

?>
<!Doctype HTML>
<html>

<head>
    <title>Warehouses</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
    <!-- header link file -->
    <?php include "header.customer.php" ?>
    <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
    <br />

    <div class="clearfix"></div>
    <br />
    <?php
    $row = $payment->viewRentalCode($user_id);
    foreach ($row as $rw) {
        $price = number_format($rw['price']);
    ?>
        <div class="col-div-4-1">
            <div class="box-1" style="height: fit-content;">
                <div class="content-box-1">
                    <p class="head-1"><b><?php echo $rw['name'] ?> Warehouse</b></p>
                    <img src="../uploads/<?php echo $rw['image1']; ?>" alt="property image" width="100%" height="100px">
                    <div class="m-box">
                        <p style="text-align: justify;"><b>Landlord: </b><?php echo $rw['first_name'] . " " . $rw['last_name'] . ", " . $rw['mobile']; ?></p>
                        <p style="text-align: justify;"><b>Don't </b>show anyone this code apart from the warehouse owner. PLEASE KEEP IT PRIVATE.</p>
                        <p><b>Code: </b><?php echo $rw['rental_code']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="clearfix"></div>
    <!-- footer link file -->
    <?php include "footer.customer.php" ?>
    </div>


</body>


</html>