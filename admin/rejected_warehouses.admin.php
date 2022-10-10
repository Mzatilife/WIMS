<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
if (isset($_GET['id'])) {
  $_SESSION['ware_id'] = $_GET['id'];
  header("location: viewwarehouse.admin.php");
}
?>
<!Doctype HTML>
<html>

<head>
  <title>Rejected Warehouses</title>
  <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
  <!-- font awesome file link  -->
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
  <style>
    .btn-stall {
      background-color: black;
      color: white;
      padding: 10px;
      margin-top: 5px;
    }

    .btn-stall:hover {
      background-color: white;
      color: black;
      border: 2px solid black;
      letter-spacing: 2.5px;
    }
  </style>
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
        <p>Rejected Warehouses
          <a href="warehouses.admin.php"><span><b>Uploaded</b></span></a>
          <a href="full_warehouses.admin.php"><span style="margin-right:3px;"><b>Full</b></span></a>
        </p>
        <br />
        <table>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Image</th>
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

          $row = $warehouse->viewWarehouseOwner(2, 0, $page1, 5);

          $i = $page1 + 1;
          foreach ($row as $rw) {
            echo "<tr>
    <td>" . $i . "</td>
    <td>" . $rw['name'] . " warehouse</td>
    <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>
    <td>" . $rw['location'] . "</td>
    <td>" . number_format($rw['capacity']) . "m<sup>2</sup></td>
    <td>K" . number_format($rw['price']) . "/m<sup>2</sup>" . "</td>
    <td><img style='width:75px; margin:0; align-content:center; border-radius:10%;' class='image' src='../uploads/" . $rw['image1'] . "'></td>";
          ?>
            <td>
              <a class="btn-stall" style="text-decoration:none; font-weight: bold; " href="rejected_warehouses.admin.php?id=<?php echo $rw['warehouse_id']; ?>"><span style="">view</span></a>
            </td>
            </tr>
          <?php $i++;
          } ?>

        </table>
      </div>
    </div>
    <?php
    $cout = $warehouse->countWarehouseOwner(2, 0);

    $a = $cout / 5;

    $a = ceil($a);
    ?>
    <div class="page-btn">
      <?php for ($b = 1; $b <= $a; $b++) {  ?>
        <a href="rejected_warehouses.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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