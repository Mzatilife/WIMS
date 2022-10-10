<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!Doctype HTML>
<html>

<head>
  <title>Accounts</title>
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
        <p>Accounts <a href="payments.admin.php"><span style="background-color: black;">Payments</span></a></p>
        <br />
        <table>
          <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Warehouse</th>
            <th>Owner</th>
            <th>Owner's #</th>
            <th>Commission</th>
            <th>Owners Amount</th>
            <th style="width: 5%">Action</th>
          </tr>
          <?php
          //creating an object to access user data from the "manageusercontr.php" class -------------------->
          $user = new ManageUserContr();
          $payment = new PaymentContr();


          //displaying the data ---------------------------------------------------------------------------------------->
          @$page = $_GET["page"];

          if ($page == "" || $page == "1") {

            $page1 = 0;
          } else {

            $page1 = ($page * 5) - 5;
          }
          $row = $payment->viewPayment(0, 0, $page1, 5);
          $index =  $page1 + 1;
          foreach ($row as $rw) {
            $owner = number_format($rw['owner_fee']);
            $commission = number_format($rw['commission']);
          ?>
            <tr>
              <td><?php echo $index; ?></td>
              <td><?php echo $rw['owner_name']; ?></td>
              <td style="text-transform: capitalize;"><?php echo $rw['name']; ?> Warehouse</td>
              <td><?php echo $rw['first_name'] . " " . $rw['last_name']; ?></td>
              <td><?php echo $rw['mobile']; ?></td>
              <td><?php echo $commission; ?> MWK</td>
              <td><?php echo $owner; ?> MWK</td>
              <td><a href="account.admin.php?id=<?php echo $rw['rented_id']; ?>" class="btn-stall" style="text-decoration: none;">close</a></td>
            </tr>
          <?php
            $index++;
          }
          ?>

        </table>
      </div>
    </div>
    <?php
    $cout = $payment->countViewPayment(0, 0);

    $a = $cout / 5;

    $a = ceil($a);
    ?>
    <div class="page-btn">
      <?php for ($b = 1; $b <= $a; $b++) {  ?>
        <a href="accounts.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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