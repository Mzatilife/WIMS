<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
$payment = new PaymentContr();
if (isset($_POST['verify'])) {
    $code = $_POST['code'];

    $result = $payment->confirmCode($code);
    if ($result) {
        $row = $payment->viewCodeData($code);
        if ($row['reservation_status'] == 0) {
            $result2 = $payment->changeReservationStatus($code, 1);
            $_SESSION['prop_verification_id'] = $row['warehouse_id'];
            if ($row && $result2) {
                header("location: book.owner.php");
            }
        } else {
            $msg = "Code used!";
        }
    } else {
        $msg = "Incorrect code!";
    }
}
?>
<!Doctype HTML>
<html>

<head>
    <title>Reservations</title>
    <!-- modal link ------------------------------->
    <link rel="stylesheet" href="../assets/css/modal-style.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <style>
        :root {
            --main-color: #d3ad7f;
            --black: #13131a;
            --bg: #010103;
            --border: .1rem solid black;
        }

        .colu {
            width: 48%;
        }

        .inputBox2 {
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 5px;
            background: #fff;
            border: var(--border);
        }

        .inputBox2 span {
            color: black;
            font-size: 1.3rem;
            padding: 10px;
        }

        .inputBox2 input {
            width: 100%;
            padding: 10px;
            font-size: 1.3rem;
            color: black;
            border: none;
            text-transform: none;
            background: none;
        }

        .inputBox2 input:hover {
            border: none;
            padding: 10px;
        }

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
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    </br>
    <div class="col-div-12">
        <?php
        if (!empty($msg)) {
            echo "<p class='error_noti'>" . $msg . "</p>";
        } else {
        }
        ?>
        <div class="box-8">
            <div class="content-box">
                <p>Reservations
                </p>
                <br />
                <table>
                    <tr>
                        <th>#</th>
                        <th>Warehouse Name</th>
                        <th>Customer Name</th>
                        <th style="width: 15%">Action</th>
                    </tr>

                    <?php
                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $payment->viewReservation($user_id, 0, $page1, 5);

                    $i = $page1 + 1;
                    foreach ($row as $rw) {
                        echo "<tr>
    <td>" . $i . "</td>
    <td>" . $rw['name'] . " Warehouse</td>
    <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>";
                    ?>
                        <td>
                            <a href="#verify" class="btn-stall">verify</a>
                        </td>
                        </tr>
                    <?php $i++;
                    } ?>

                </table>
            </div>
        </div>
        <?php
        $cout = $payment->countReservation($user_id, 0);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="reservations.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
            <?php } ?>
            <span>&#8594;</span>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>
    <!-- footer link file -->
    <?php include "footer.owner.php" ?>
    </div>

    <!--pop up for customer login-------------------------------------------------------------->
    <div id="verify" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h1 style="margin-bottom: 40px;"><span class="fa"> Reserve</span></h1>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="inputBox2">
                            <span class="fas fa-code"></span>
                            <input type="text" name="code" placeholder="enter rental code" required="required">
                        </div>
                        <button name="verify" type="submit" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-paper-plane"> verify</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


</html>