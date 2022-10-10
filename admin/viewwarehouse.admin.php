<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$warehouse = new ManageWarehouseContr();

if (isset($_GET['upload'])) {
  $upload = $_GET['upload'];
  $result = $warehouse->approveWarehouse($upload, 1);
  if ($result) {
    $msg = "Property uploaded!";
  } else {
    $msg = "Error! Property can't be uploaded!";
  }
} elseif (isset($_POST['reject'])) {
  $reject_id = $_GET['rejid'];
  $reasons = $_POST['reasons'];

  $result = $warehouse->rejectWarehouse($reject_id, $reasons);
  if ($result) {
    $msg = "Property rejected!";
  } else {
    $msg = "Error! Property can't be rejected!";
  }
}
?>
<!Doctype HTML>
<html>

<head>
  <title>Warehouse Details</title>
  <!-- modal link ------------------------------->
  <link rel="stylesheet" href="../assets/css/modal-style.css" type="text/css" />
  <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
  <!-- font awesome file link  -->
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
  <!-- header link file -->
  <?php include "header.admin.php" ?>
  <div class="clearfix"></div>
  </div>
  <?php
  if (!empty($msg)) {
    echo "<p class='error_noti' style='margin-bottom:5px;'>" . $msg . "</p>";
  } else {
  }
  ?>
  <div class="contact">
    <div class="row" style="width: 98%;">
      <?php
      $row = $warehouse->viewWarehouseDetails($_SESSION['ware_id']);
      ?>
      <div style="width: 48%;" class="det">
        <h4 class="main"><?php echo $row['name']; ?> Warehouse</h4>
        <!-- viewing the images using the slider -->
        <div class="small-container single-property">
          <div class="col-2">

            <div style="width: 80%">
              <img src="../uploads/<?php echo $row['image1']; ?>" width="100%" height="200px" id="PropertyImg">
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
        <p>
          <b>Location:</b> <?php echo $row['location'] . ", " . $row['area']; ?> |
          <b>Capacity:</b> <?php echo number_format($row['capacity']); ?>m<sup>2</sup> |
          <b>Price:</b> K<?php echo number_format($row['price']) . "/m<sup>2</sup>" ?>
        </p>
      </div>
      <div style="width: 48%;" class="det">
        <h4 class="main">Owner Details
          <span style="float: right;">
            <?php if ($row['status'] != 1) { ?>
              <a href="viewwarehouse.admin.php?upload=<?php echo $row['warehouse_id']; ?>" style="color: green; text-decoration: none;">upload</a> |
            <?php } 
            if ($row['status'] != 2) {?>
            <a href="#popup" style="color: red; text-decoration: none;">Reject</a>
            <?php } ?>
          </span>
        </h4>
        <p><b>Name:</b> <?php echo $row['last_name'] . " " . $row['first_name']; ?></p>
        <p><b>Mobile:</b> <?php echo $row['mobile']; ?></p>
        <p><b>Email:</b> <?php echo $row['email']; ?></p>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>

  <!-- footer link file -->
  <?php include "footer.admin.php" ?>
  </div>

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
  <?php include "../includes/rejectpopup.inc.php"  ?>
</body>


</html>