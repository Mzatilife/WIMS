<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$payment = new PaymentContr();
?>
<!Doctype HTML>
<html>

<head>
  <title>Warehouses</title>
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
        <p>Accounts</p>
        <br />
        <table>
          <tr>
            <th>#</th>
            <th>Warehouse</th>
            <th>Capacity</th>
            <th>Amount</th>
            <th>Your Fee</th>
          </tr>
          <?php

          //displaying the data ---------------------------------------------------------------------------------------->
          @$page = $_GET["page"];

          if ($page == "" || $page == "1") {

            $page1 = 0;
          } else {

            $page1 = ($page * 5) - 5;
          }
          $row = $payment->viewLandlordFinances($user_id, $page1, 5);
          $index = $page1 + 1;
          foreach ($row as $rw) {
            $price = number_format($rw['price'] * $rw['ren_capacity']);
            $owner = number_format($rw['owner_fee']);
          ?>
            <tr>
              <td><?php echo $index; ?></td>
              <td style="text-transform:capitalize;"><?php echo $rw['name']; ?> Warehouse</td>
              <td><?php echo $rw['ren_capacity'];  ?>m<sup>2</sup></td>
              <td><?php echo $price; ?> MWK</td>
              <td><?php echo $owner; ?> MWK</td>
            </tr>
          <?php
            $index++;
          }
          ?>



        </table>
      </div>
    </div>
    <?php
    $cout = $payment->countLandlordFinances($user_id);

    $a = $cout / 5;

    $a = ceil($a);
    ?>
    <div class="page-btn">
      <?php for ($b = 1; $b <= $a; $b++) {  ?>
        <a href="accounts.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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