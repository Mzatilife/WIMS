<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
if (isset($_GET['view'])) {
    $_SESSION['ware_id'] = $_GET['view'];
    header("location: viewwarehouse.owner.php");
}
if (isset($_GET['edit'])) {
    $_SESSION['edit_id'] = $_GET['edit'];
    header("location: edit.owner.php");
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Uploaded Warehouses</title>
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
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Uploaded Warehouses
                    <a href="rejected_warehouses.owner.php"><span>Rejected</span></a>
                    <a href="pending_warehouses.owner.php"><span style="margin-right:3px;">Pending</span></a>
                    <a href="warehouses.owner.php"><span style="margin-right:3px;">view all</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th style="width: 5%">Image</th>
                        <th style="width: 5%">Action</th>
                    </tr>

                    <?php
                    //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
                    $warehouse = new ManageWarehouseContr();

                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $warehouse->viewWarehouse($user_id, 1, 1, 1, $page1, 5);

                    $i = $page1 + 1;
                    foreach ($row as $rw) {
                        echo "<tr>
    <td>" . $i . "</td>
    <td>" . $rw['name'] . " Warehouse</td>
    <td>" . $rw['location'] . ", " . $rw['area'] . "</td>
    <td>" . number_format($rw['capacity']) . "m<sup>2</sup></td>
    <td>K" . number_format($rw['price']) . "/m<sup>2</sup>" . "</td>
    <td><img style='width:75px; height:50px; margin:0; align-content:center; border-radius:10%;' class='image' src='../uploads/" . $rw['image1'] . "'></td>";
                    ?>
                        <td>
                            <?php if ($rw['status'] != 4) { ?>
                                <a href="uploaded_warehouses.owner.php?edit=<?php echo $rw['warehouse_id']; ?>"><span class="fa fa-edit"></span></a>
                            <?php } ?>
                            <a href="uploaded_warehouses.owner.php?view=<?php echo $rw['warehouse_id']; ?>"><span class="fa fa-eye"></span></a>
                        </td>
                        </tr>
                    <?php $i++;
                    } ?>

                </table>
            </div>
        </div>
        <?php
        $cout = $warehouse->countOwnerWarehouse($user_id, 1, 1, 1);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="uploaded_warehouses.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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