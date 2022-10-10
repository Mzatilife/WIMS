<?php
include_once '../includes/classautoloader.inc.php';

//Start session
session_start();

if (isset($_GET['id'])) {
    $_SESSION['wareid'] = $_GET['id'];
    header("location: warehouse_details.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouses</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>

    <?php include "../includes/header.inc.php" ?>
    <!-- menu section ends -->

    <section style="margin-top:100px;" class="menu" id="menu">
        <h1 class="heading"> our <span>warehouses</span> </h1>

        <div class="box-container">
            <?php
            //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
            $warehouse = new ManageWarehouseContr();
            //displaying the data ---------------------------------------------------------------------------------------->
            @$page = $_GET["page"];

            if ($page == "" || $page == "1") {

                $page1 = 0;
            } else {

                $page1 = ($page * 9) - 9;
            }

            $row = $warehouse->viewWarehouseOwner(1, 0, $page1, 9);

            foreach ($row as $rw) {

                echo "      
        <div class='box'>
        <h3>" . $rw['name'] . " Warehouse</h3>
        <img src='../uploads/" . $rw['image1'] . "' alt=''>
        <h3>" . $rw['location'] . ", " . $rw['area'] . " | " .  number_format($rw['available']) . "m<sup>2</sup></h3>
        <div class='price'>K" . number_format($rw['price']) . " /m<sup>2</sup</div><br>
        <a href='warehouses.php?id=" . $rw['warehouse_id'] . "' class='btn'>view</a>
        </div>
        </div>
        ";
            }
            ?>
        </div>
        <?php
        $cout = $warehouse->countWarehouseOwner(1, 0);

        $a = $cout / 9;

        $a = ceil($a);
        ?>


    </section>
    <div class="page-btn">
        <?php for ($b = 1; $b <= $a; $b++) {  ?>
            <a href="warehouses.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
        <?php } ?>
        <span>&#8594;</span>
    </div>

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>