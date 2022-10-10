<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!Doctype HTML>
<html>

<head>
    <title>Payments</title>
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
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Payments <a href="accounts.admin.php"><span style="background-color: black;">Accounts</span></a></p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Reference #</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $payment = new PaymentContr();
                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $payment->viewRealPayment(1, 0,  $page1, 5);
                    $index = 1;
                    foreach ($row as $rw) {
                        $amount = number_format($rw['amount']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $rw['reference']; ?></td>
                            <td><?php echo $amount; ?> MWK</td>
                            <td><?php echo $rw['payment_date']; ?></td>
                            <td><?php echo ($rw['status'] == 0) ? "Not Used" : "Used"; ?></td>
                        </tr>
                    <?php
                        $index++;
                    }
                    ?>


                </table>
            </div>
        </div>
        <?php
        $cout = $payment->countViewRealPayment(1, 0);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="payments.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
            <?php } ?>
            <span>&#8594;</span>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>

    <!-- footer link file -->
    <?php include "footer.admin.php" ?>
    </div>


</body>


</html>