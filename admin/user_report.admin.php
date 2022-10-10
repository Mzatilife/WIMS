<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$user = new ManageUserContr();
?>
<!Doctype HTML>
<html>

<head>
    <title>User Report</title>
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
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Customers</p>
            <?php
            //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
            $user = new ManageUserContr();
            $cus = $user->countUsers('customer', 'customer');

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $cus . "</p>";
            ?>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Warehouse Owners</p>
            <?php
            $owner = $user->countUsers('owner', 'owner');

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $owner . "</p>";
            ?>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-4-1">
        <div class="box">
            <p class="head-1">Total</p>
            <?php
            $product = $user->countUsers('owner', 'customer');

            //viewing thr counted data --------------------------------------->
            echo "<p class='number'>" . $product . "</p>";
            ?>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>User Report
                    <a href="print_user.admin.php"><span style="background-color: black;"><b class="fa fa-print"></b> Print</span></a>
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Reg. date</th>
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
                        $row = $user->viewsUsers('owner', 'customer', $page1, 5);
                        $i = $page1 + 1;
                        foreach ($row as $rw) {
                            echo "<tr>
    <td>" . $i . "</td>
    <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>
    <td>" . $rw['address'] . "</td>
    <td>" . $rw['user_type'] . "</td>
    <td>" . $rw['email'] . "</td>
    <td>" . $rw['mobile'] . "</td>
    <td>" . date('d/m/Y', strtotime($rw['regdate'])) . "</td>";
                        ?>

                        <?php $i++;
                        } ?>
                    </tr>
                </table>
            </div>
        </div><a href=''></a>

        <?php
        $cout = $user->countUsers('owner', 'customer');

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="users.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
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