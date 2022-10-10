<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!Doctype HTML>
<html>

<head>
    <title>Warehouse Report</title>
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
            <p class="head-1">Uploaded</p>
            <?php
            $property = new ManageWarehouseContr();
            //counts the property -------------------->
            $uploaded = $property->countOwnerProperty($user_id, 1, 1, 1, 1);
            ?>
            <p class="number"><?php echo $uploaded; ?></p>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Rejected</p>
            <?php
            //counts the property -------------------->
            $rejected = $property->countOwnerProperty($user_id, 2, 2, 2, 2);
            ?>
            <p class="number"><?php echo $rejected; ?></p>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Booked</p>
            <?php
            //counts the property -------------------->
            $payment = new PaymentContr();
            $cout = $payment->countLandlordFinances($user_id);
            ?>
            <p class="number"><?php echo $cout; ?></p>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>


    <div class="clearfix"></div>
    <br />

    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Warehouse Report
                    <a href="print_warehouse.owner.php"><span style="background-color: black;"><b class="fa fa-print"></b> Print</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Warehouse</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Available</th>
                        <th>Price</th>
                        <th>Uploaded Date</th>
                    </tr>
                    <?php
                    //creating an object to access property data from the "managepropertycontr.php" class -------------------->
                    $property = new ManageWarehouseContr();
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $property->viewProperty($user_id, 0, 1, 2, 3, 4, $page1, 5);
                    $index = $page1 + 1;
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        echo "
                        <tr>
                        <td>" . $index . "</td>
                        <td>" . $rw['name'] . "</td>
                        <td>" . $rw['location'] . ", " . $rw['area'] . "</td>";
                        if ($rw['status'] == 0) {
                            echo "<td><span style='font-size:13px; color:orange;'>Pending</span></td>";
                        } elseif ($rw['status'] == 1) {
                            echo "<td><span style='font-size:13px; color:blue ;'>Uploaded</span></td>";
                        } elseif ($rw['status'] == 2) {
                            echo "<td><span style='font-size:13px; color:red;'>Rejected</span></td>";
                        } elseif ($rw['status'] == 4) {
                            echo "<td><span style='font-size:13px; color:green;'>Full Booked</span></td>";
                        } else {
                            echo "<td><span style='font-size:13px;'>Invalid</span></td>";
                        }
                        echo "<td>K" . $price . "\m<sup>2</sup></td>
                        <td>" . number_format($rw['capacity']) . "m<sup>2</sup></td>
                        <td>" . number_format($rw['available']) . "m<sup>2</sup></td>
                        <td>" . $rw['date'] . "</td>
                        </tr>";
                        $index++;
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php
        $cout = $property->countViewProperty($user_id, 0, 1, 2, 3, 4);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="warehouse_report.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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