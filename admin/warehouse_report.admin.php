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
            <p class="head-1">Uploaded</p>
            <?php
            //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
            $count = new ManageWarehouseContr();
            $result = $count->countWarehouse(1);

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $result . "</p>";
            ?>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Rejected</p>
            <?php
            $rejected = $count->countWarehouse(2);

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $rejected . "</p>";
            ?>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Fully Booked</p>
            <?php
            $booked = $count->countWarehouse(4);

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $booked . "</p>";
            ?>
            <i class="fa fa-warehouse box-icon"></i>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Warehouse Report
                    <a href="print_warehouse.admin.php"><span style="background-color: black;"><b class="fa fa-print"></b> Print</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Available</th>
                        <th>Price</th>
                        <th>Upload Date</th>
                    </tr>
                    <!-- shows the details of both the customer and warehouse owner --------------------------------------------------->

                    <?php
                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $property = new ManageWarehouseContr();
                    $row = $property->viewPropertyAdmin(0, 1, 2, 3, 4, $page1, 5);
                    $index = 1;
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        echo "
                        <tr>
                        <td>" . $index . "</td>";
                        echo "<td>" . $rw['name'] . "</td>
                        <td>" . $rw['location'] . ", " . $rw['area'] . "</td>
                        <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>";
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
                        echo "<td>" . number_format($rw['capacity']) . "m<sup>2</sup></td>
                            <td>" . number_format($rw['available']) . "m<sup>2</sup></td>
                            <td>K" . $price . "\m<sup>2</sup></td>
                        <td>" . date('d/m/Y', strtotime($rw['date'])) . "</td>
                        </tr>";
                        $index++;
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php
        $cout = $property->countPropertyAdmin(0, 1, 2, 3, 4);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="warehouse_report.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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