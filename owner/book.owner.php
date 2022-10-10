<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$property = new ManageWarehouseContr();
$payment = new PaymentContr();

if (isset($_POST['confirm'])) {
    $pname = $_POST['name'];
    $oname = $_POST['owner'];
    $reference = $_POST['ref'];
    $capacity = $_POST['capacity'];
    $row = $payment->checkPayment($reference);
    $prop = $property->viewWarehouseDetails($_SESSION['prop_verification_id']);

    if (!empty($row)) {
        if ($row['status'] == 1) {
            $msg2 = "The payment has already been used!";
        } else {
            $real_amount = $prop['price'] * $capacity;
            $rec_amount = intval(preg_replace('/[^\d.]/', '', $row['amount']));
            if (intval($rec_amount) >= $real_amount) {
                $commission = $real_amount * 0.05;
                $owner_fee = $real_amount - $commission;
                $result = $payment->rentProperty($row['payment_id'], $prop['warehouse_id'], $pname, $oname, $capacity, $owner_fee, $commission);
                $result3 = $payment->changePaymentStatus($row['payment_id'], 1);
                if ($prop['available'] <= 0) {
                    $result2 = $property->approveWarehouse($prop['warehouse_id'], 4);
                } else {
                    $quantity = $prop['capacity'] - $capacity;
                    $result2 = $property->rentWarehouse($_SESSION['prop_verification_id'], $quantity);
                }
                if ($result2 && $result && $result3) {
                    $msg = "Property rented!";
                } else {
                    $msg2 = "Error, couldn't process payment";
                }
            } else {
                $msg2 = "The amount paid is not enough!";
            }
        }
    } else {
        $msg2 = "Payment was not done!";
    }
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Book Warehouse</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <script src="../assets/js/jquery-1.10.2.min.js"></script>
    <style>
        :root {
            --main-color: #d3ad7f;
            --black: #13131a;
            --bg: #010103;
            --border: .1rem solid black;
        }

        .colu {
            width: 48%;
        }

        .inputBox2 {
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 5px;
            background: #fff;
            border: var(--border);
        }

        .inputBox2 span {
            color: black;
            font-size: 1.3rem;
            padding: 10px;
        }

        .inputBox2 input {
            width: 100%;
            padding: 10px;
            font-size: 1.3rem;
            color: black;
            border: none;
            text-transform: none;
            background: none;
        }

        .inputBox2 input:hover {
            border: none;
            padding: 10px;
        }

        .btn-stall {
            background-color: black;
            color: white;
            padding: 10px;
            margin-top: 5px;
        }

        .btn-stall:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
            letter-spacing: 2.5px;
        }
    </style>
</head>


<body>
    <!-- header link file -->
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    <?php
    if (!empty($msg)) {
        echo "<p class='error_noti'>" . $msg . "</p>";
    } elseif (!empty($msg2)) {
        echo "<p class='error_noti'>" . $msg2 . "</p>";
    } else {
    }
    ?>
    <?php
    if (!empty($_SESSION['prop_verification_id'])) {

        //object to access warehouse data ----------------------------------------------------------------------------------------->
        $warehouse = new ManageWarehouseContr();
        $row = $warehouse->viewWarehouseDetails($_SESSION['prop_verification_id']);

    ?>
        <div class="contact">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="colu">
                        <label for="customer" class="form-label">Property Name</label>
                        <div class="inputBox2">
                            <span class="fa fa-box"></span>
                            <input type="text" placeholder="enter property name" name="name" required>
                        </div>
                    </div>
                    <div class="colu">
                        <label for="customer" class="form-label">Owner's Name</label>
                        <div class="inputBox2">
                            <span class="fas fa-user-alt"></span>
                            <input type="text" placeholder="property owner's name" name="owner" required>
                        </div>
                    </div>
                    <div class="colu">
                        <label for="customer" class="form-label">Reference Number</label>
                        <div class="inputBox2">
                            <span class="fas fa-code"></span>
                            <input type="text" placeholder="enter reference number" name="ref" required>
                        </div>
                    </div>
                    <div class="colu">
                        <label for="customer" class="form-label">Capacity in m<sup>2</sup></label>
                        <div class="inputBox2">
                            <span class="fas fa-building"></span>
                            <input type="number" placeholder="Capacity" max="<?php echo $row['available']; ?>" name="capacity" required>
                        </div>
                    </div>
                    <input type="submit" name="confirm" value="Book Warehouse" class="btn-stall" style="width: 40%;">
                </div>
            </form>
        </div>
    <?php } ?>

    <div class="clearfix"></div>
    <!-- footer link file -->
    <?php include "footer.owner.php" ?>
    </div>

    <div id="status">
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $("#status").load("../includes/payment.inc.php");
            refresh();
        }, 500);
    });
</script>

</html>