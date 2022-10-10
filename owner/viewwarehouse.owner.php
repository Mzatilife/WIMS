<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$warehouse = new ManageWarehouseContr();

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
  <?php include "header.owner.php" ?>
  <div class="clearfix"></div>
  </div>
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
      </div>
      <div style="width: 48%;" class="det">
        <h4 class="main">Property Details</h4>
        <p>
          <b>Location:</b> <?php echo $row['location'] . ", " . $row['area']; ?> <br>
          <b>Capacity:</b> <?php echo number_format($row['capacity']); ?>m<sup>2</sup> <br>
          <b>Price:</b> K<?php echo number_format($row['price']) . "/m<sup>2</sup>" ?>
        </p>
        <?php
        if ($row['status'] == 2) {
          $res = $warehouse->viewReason($row['warehouse_id']);
        ?>
          <h2 style="margin-top:0;">Reason:</h2>
          <p style="border: 2px solid red; border-radius:5%; color:red; padding:10px; margin-top:0;"><?php echo $res['reason'] ?></p>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>

  <!-- footer link file -->
  <?php include "footer.owner.php" ?>
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