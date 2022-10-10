<?php
include_once '../includes/classautoloader.inc.php';
//Start session
session_start();

// LOGIN ------------------------------------------------------------------------------------------------------------->
if (isset($_POST['login'])) {
  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);

  // passing login information
  $login = new ManageUserContr;
  $msg = $login->customerLogin($email, $password);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warehouse Details</title>
  <!-- modal link ------------------------------->
  <link rel="stylesheet" href="../assets/css/modal-style.css" type="text/css" />
  <!-- custom css file link  -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- font awesome file link  -->
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
  <!-- about section starts  -->

  <?php include "../includes/header.inc.php" ?>
  <section class="about" style="margin-top: 70px">

    <h1 class="heading"> <span>Warehouse</span> Details </h1>
    <?php
    if (!empty($msg)) {
      echo "<p class='error_noti'>" . $msg . "</p>";
    } else {
    }
    ?>
    <?php
    //object to access warehouse data ----------------------------------------------------------------------------------------->
    $warehouse = new ManageWarehouseContr();
    $row = $warehouse->viewWarehouseDetails($_SESSION['wareid']);
    ?>
    <div class="row">

      <div class="image">
        <!-- viewing the images using the slider -->
        <div class="small-container single-property">
          <div class="col-2">

            <div style="width: 80%">
              <img src="../uploads/<?php echo $row['image1']; ?>" width="100%" height="300px" id="PropertyImg">
            </div>

            <div style="width: 20%">
              <div class="small-img-row">
                <div class="small-img-col">
                  <img src="../uploads/<?php echo $row['image1']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                  <img src="../uploads/<?php echo $row['image2']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                  <img src="../uploads/<?php echo $row['image3']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                  <img src="../uploads/<?php echo $row['image4']; ?>" width="100%" class="small-img">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <h3><?php echo $row['name']; ?> Warehouse</h3>
        <p><b>Location: </b><?php echo $row['location'] . ", " . $row['area']; ?>.</p>
        <p><b>Capacity: </b><?php echo number_format($row['capacity']); ?>m<sup>2</sup> | <b>Available: </b><?php echo number_format($row['available']); ?>m<sup>2</sup>.</p>
        <p><b>Price: </b>K<?php echo number_format($row['price']); ?> / m<sup>2</sup></p>
        <p><b>Register</b> or <b>login</b> when you already have an account to book a warehouse. </p>
        <a href="reserve.php" class="btn" style="margin-right: 20px;">Reserve</a> <a href="customer_terms.php" class="btn" style="margin-right: 20px;">Register</a> <a href="#popup2" class="btn">Login</a>
      </div>

    </div>
  </section>
  <section class="menu" id="menu">
    <h1 class="heading"> Related <span>warehouses</span> </h1>
    <div class="box-container">
      <?php

      $row = $warehouse->searchRelatedWarehouse($row['warehouse_id'], 0, $row['name'], $row['location'], $row['area'], 0, 3);

      //displaying the data ---------------------------------------------------------------------------------------->
      foreach ($row as $rw) {
        echo "
        <div class='box'>
        <h3>" . $rw['name'] . " Warehouse</h3>
        <img src='../uploads/" . $rw['image1'] . "' alt=''>
        <h3>" . $rw['location'] . ", " . $rw['area'] . " | " .  number_format($rw['capacity']) . "m<sup>2</sup></h3>
        <div class='price'>K" . number_format($rw['price']) . " /m<sup>2</sup</div><br>
        <a href='warehouse_details.php?id=" . $rw['warehouse_id'] . "' class='btn'>view</a>
        </div>
        ";
      }
      ?>

    </div>
  </section>

  <!-- about section ends -->

  <?php include "../includes/footer.inc.php" ?>
  <!-- custom js file link  -->
  <script src="../assets/js/script.js"></script>
  <!-- The javascript to control the image view ----------------------------------------->
  <script type="text/javascript">
    var PropertyImg = document.getElementById("PropertyImg");
    var SmallImg = document.getElementsByClassName("small-img");

    SmallImg[0].onclick = function() {
      PropertyImg.src = SmallImg[0].src;

    }
    SmallImg[1].onclick = function() {
      PropertyImg.src = SmallImg[1].src;

    }
    SmallImg[2].onclick = function() {
      PropertyImg.src = SmallImg[2].src;

    }
    SmallImg[3].onclick = function() {
      PropertyImg.src = SmallImg[3].src;

    }
  </script>
  <?php include "../includes/register_login_popup.inc.php"  ?>
</body>

</html>