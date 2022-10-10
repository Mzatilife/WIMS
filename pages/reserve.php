<?php
//Start session
session_start();
include_once '../includes/classautoloader.inc.php';
$property = new ManageWarehouseContr();
$user = new ManageUserContr();
$payment = new PaymentContr();

if (isset($_POST['confirm'])) {
    $reference = $_POST['ref'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $row = $payment->checkPayment($reference);
    $prop = $property->viewWarehouseDetails($_SESSION['wareid']);
    $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $rental_code = substr(str_shuffle($Generator), 0, 6);

    if (!empty($row)) {
        if ($row['status'] == 1) {
            $msg2 = "The payment has already been used!";
        } else {
            $rec_amount = intval(preg_replace('/[^\d.]/', '', $row['amount']));
            if (intval($rec_amount) >= 1000) {
                $result = $payment->reserveProperty($row['payment_id'], $prop['warehouse_id'], 0, $fname, $lname, $rental_code);
                $result2 = $payment->changePaymentStatus($row['payment_id'], 1);
                if ($result2 && $result) {
                    $_SESSION['msg'] = $rental_code;
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Warehouse</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <script src="../assets/js/jquery-1.10.2.min.js"></script>


</head>

<body>
    <!-- contact section starts  -->

    <?php
    include "../includes/header.inc.php";

    $prop = $property->viewWarehouseDetails($_SESSION['wareid']);
    $use = $user->viewUser($prop['user_id']);
    ?>
    <section class="contact" style="margin-top: 70px">

        <h1 class="heading"><span>Reserve</span> Warehouse </h1>
        <?php if (!empty($_SESSION['msg'])) { ?>
            <p class="error_noti" style="width: 100%; color:gray;">
                You have SUCCESSFULY made a reservation. <b>SCREENSHOT</b> or <b>WRITE THE RENTAL CODE DOWN</b>, please do not lose it.
                <br><br>Rental Code: <b style="font-size: 20px;"><?php echo $_SESSION['msg']; ?></b><br><br>
                <b>NAME:</b> <?php echo $prop['name']; ?> Warehouse. <br><b>OWNER:</b> <?php echo $use['first_name'] . " " . $use['last_name']; ?>.
            </p>
        <?php } elseif (!empty($msg2)) {
            echo "<p class='error_noti'>" . $msg2 . "</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <p class="error_noti" style="width: 100%; color:blue;">
                You are about to make a warehouse reservation. Make the payment to the following mpamba number:<br>
                <b style="font-size: 25px;">******* 0887654344 (1,000 MWK reservation fee) *******</b><br>
                Enter the reference number (to cofirm payment), your first and last name.
            </p>
            <div class="inputBox2">
                <span class="fas fa-code"></span>
                <input type="text" name="ref" placeholder="enter reference" required="required">
            </div><br>
            <div class="inputBox2">
                <span class="fas fa-user"></span>
                <input type="text" name="fname" placeholder="enter first name" required="required">
            </div>
            <div class="inputBox2">
                <span class="fas fa-user"></span>
                <input type="text" name="lname" placeholder="enter last name" required="required">
            </div>
            <input type="submit" name="confirm" value="reserve" class="btn" style="width: 40%; margin: auto; margin-top: 1rem; border-radius: 5px;">
        </form>


    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

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