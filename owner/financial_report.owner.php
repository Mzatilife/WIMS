<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!Doctype HTML>
<html>

<head>
    <title>Financial Report</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
    <!-- header link file -->
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    </br>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Your Fee</p>
            <?php
            $payment = new PaymentContr();
            //counts the property -------------------->
            $fee = $payment->sumLandlordPrices('owner_fee', $user_id);
            ?>
            <p class="number"><?php echo number_format($fee['owner_fee']); ?> MWK</p>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Commission</p>
            <?php
            $com = $payment->sumLandlordPrices('commission', $user_id);
            ?>
            <p class="number"><?php echo number_format($com['commission']); ?> MWK</p>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Total Amount</p>
            <?php
            $total = $com['commission'] + $fee['owner_fee'];
            ?>
            <p class="number"><?php echo number_format($total); ?> MWK</p>
            <i class="fa fa-dollar-sign box-icon"></i>
        </div>
    </div>


    <div class="clearfix"></div>
    <br />

    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Financial Report
                    <a href="print_finance.owner.php"><span style="background-color: black;"><b class="fa fa-print"></b> Print</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Warehouse</th>
                        <th>Customer</th>
                        <th>Owner Fee</th>
                        <th>Commission</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    //creating an object to access user data from the "manageusercontr.php" class -------------------->
                    $user = new ManageUserContr();

                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }

                    $row = $payment->viewLandlordFinances($user_id, $page1, 5);
                    $index = $page1 + 1;
                    foreach ($row as $rw) {
                        $owner = number_format($rw['owner_fee']);
                        $commission = number_format($rw['commission']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td style="text-transform: capitalize;"><?php echo $rw['name']; ?> Warehouse</td>
                            <td><?php echo $rw['owner_name']; ?></td>
                            <td><?php echo $owner; ?> MWK</td>
                            <td><?php echo $commission; ?> MWK</td>
                            <td><?php echo $rw['rental_date']; ?></td>

                        </tr>
                    <?php
                        $index++;
                    } ?>
                </table>
            </div>
        </div>
        <?php
        $cout = $payment->countLandlordFinances($user_id);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="financial_report.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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