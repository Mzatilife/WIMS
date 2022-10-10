<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$user = new ManageUserContr();
include 'user_operations.admin.php';
?>
<!Doctype HTML>
<html>

<head>
  <title>Warehouse Owners</title>
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
  <div class="col-div-12">
    <div class="box-8">
      <div class="content-box">
        <p>Warehouse Owners
          <a href="#"><span>Owners</span></a>
          <a href="customers.admin.php"><span style="margin-right:3px;">Customers</span></a>
          <a href="users.admin.php"><span style="margin-right:3px;">view all</span></a>
        </p>
        <br />
        <table>
          <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th style="width:150px;">Action</th>
          </tr>
          <!-- shows the details of both the customer and warehouse owner --------------------------------------------------->
          <tr>
            <?php

            //displaying the data ---------------------------------------------------------------------------------------->
            @$page = $_GET["page"];

            if ($page == "" || $page == "1") {

              $page1 = 0;
            } else {

              $page1 = ($page * 5) - 5;
            }
            $row = $user->viewsUsers('owner', 'owner', $page1, 5);
            $i = $page1 + 1;
            foreach ($row as $rw) {
              echo "<tr>
    <td>" . $i . "</td>
    <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>
    <td>" . $rw['email'] . "</td>
    <td>+256" . $rw['mobile'] . "</td>
    <td>
      <a href='mailto:" . $rw['email'] . "' style='color:blue;'><i class='fa fa-envelope'></i></a>&nbsp; | &nbsp;
      <a href='tel:+256" . $rw['mobile'] . "' style='color:green;'><i class='fa fa-phone'></i></a>&nbsp; | &nbsp;";
            ?>
              <?php if ($rw['user_status'] == '1') { ?>
                <a href="owners.admin.php?dis=<?php echo $rw['user_id']; ?>" title="Click To Disable" style="color:orange;"><i class="fa fa-unlock"></i></a>
              <?php } else { ?>
                <a href="owners.admin.php?en=<?php echo $rw['user_id']; ?>" title="Click To Enable" style="color:orange;"><i class="fa fa-lock"></i></a>
              <?php } ?>
              &nbsp; | &nbsp;
              <a href="owners.admin.php?del=<?php echo $rw['user_id']; ?>" title="Click To Delete" onclick="return confirm('are you sure you want to Disable?')" style="color:red;"><i class="fa fa-trash"></i></a>
              </td>

            <?php $i++;
            } ?>
          </tr>
        </table>
      </div>
    </div><a href=''></a>

    <?php
    $cout = $user->countUsers('owner', 'owner');

    $a = $cout / 5;

    $a = ceil($a);
    ?>
    <div class="page-btn">
      <?php for ($b = 1; $b <= $a; $b++) {  ?>
        <a href="owners.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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