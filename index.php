<?php
include_once 'includes/autoloader.inc.php';
//Start session
session_start();

if (isset($_GET['id'])) {
    $_SESSION['wareid'] = $_GET['id'];
    header("location: pages/warehouse_details.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
    <?php include "includes/header.inc2.php" ?>
    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">
            <h3>Store your products with us</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat labore, sint cupiditate distinctio tempora reiciendis.</p>
        </div>

    </section>

    <!-- home section ends -->

    <!-- menu section starts  -->

    <section class="menu" id="menu">

        <h1 class="heading"> Recent <span>warehouses</span> </h1>
        <div class="box-container">
            <?php
            //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
            $warehouse = new ManageWarehouseContr();
            $row = $warehouse->viewWarehouseOwner(1, 0, 0, 6);

            //displaying the data ---------------------------------------------------------------------------------------->
            foreach ($row as $rw) {
                echo "
        <div class='box'>
        <h3>" . $rw['name'] . " Warehouse</h3>
        <img src='uploads/" . $rw['image1'] . "' alt=''>
        <h3>" . $rw['location'] . ", " . $rw['area'] . " | " .  number_format($rw['available']) . "m<sup>2</sup></h3>
        <div class='price'>K" . number_format($rw['price']) . " /m<sup>2</sup</div><br>
        <a href='index.php?id=" . $rw['warehouse_id'] . "' class='btn'>view</a>
        </div>
        </div>
        ";
            }
            ?>
        </div>
    </section>


    <?php include "includes/footer.inc2.php" ?>
    <!-- custom js file link  -->
    <script src="assets/js/script.js"></script>

</body>

</html>