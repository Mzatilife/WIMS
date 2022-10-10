<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$user = new ManageUserContr();
?>
<!Doctype HTML>
<html>

<head>
    <title>User Report</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
    <!-- header link file -->
    <?php include "header.admin.php" ?>
    <div class="clearfix"></div>
    </div>
    </br>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Warehouse Owner Fee</p>
            <?php
            $payment = new PaymentContr();
            //counts the property -------------------->
            $fee = $payment->sumPrices('owner_fee');

            //viewing the counted data --------------------------------------->
            echo "<p class='number'>" . number_format($fee['owner_fee']) . " MWK</p>";
            ?>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Commission</p>
            <?php
            $com = $payment->sumPrices('commission');

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . number_format($com['commission']) . " MWK</p>";
            ?>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Total Amount</p>
            <?php
            $total = $com['commission'] + $fee['owner_fee'];

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $total . " MWK</p>";
            ?>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Financial Report
                    <a href="print_finance.admin.php"><span style="background-color: black;"><b class="fa fa-print"></b> Print</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Customer</th>
                        <th>Capacity</th>
                        <th>Commission</th>
                        <th>Owner</th>
                        <th>Date</th>
                    </tr>
                    <!-- shows the details of both the customer and warehouse owner --------------------------------------------------->
                    <?php
                    //creating an object to access user data from the "manageusercontr.php" class -------------------->
                    $user = new ManageUserContr();
                    $payment = new PaymentContr();


                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $payment->viewPayment(0, 0, $page1, 5);
                    $index =  $page1 + 1;
                    foreach ($row as $rw) {
                        $owner = number_format($rw['owner_fee']);
                        $commission = number_format($rw['commission']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td style="text-transform: capitalize;"><?php echo $rw['name']; ?> Warehouse</td>
                            <td><?php echo $rw['first_name'] . " " . $rw['last_name']; ?></td>
                            <td><?php echo $rw['owner_name']; ?></td>
                            <td><?php echo number_format($rw['ren_capacity']); ?>m<sup>2</sup></td>
                            <td><?php echo $commission; ?> MWK</td>
                            <td><?php echo $owner; ?> MWK</td>
                            <td><?php echo date('d/m/Y', strtotime($rw['rental_date'])); ?></td>
                        </tr>
                    <?php
                        $index++;
                    }
                    ?>

                </table>
            </div>
        </div>

        <?php
        $cout = $payment->countViewPayment(0, 0);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="financial_report.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
            <?php } ?>
            <span>&#8594;</span>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>

    <!-- footer link file -->
    <?php include "footer.admin.php" ?>
    <script>
        $(document).ready(function() {
            $(".user p").click(function() {
                $(".user-div").toggle();
            });
        });
    </script>
    </div>

</body>


</html>