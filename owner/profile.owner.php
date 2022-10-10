<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$profile = new ProfileContr;

if (isset($_POST['changepass'])) {
    $old_password = strip_tags($_POST['oldpass']);
    $new_password = strip_tags($_POST['newpass']);
    $conf_password = strip_tags($_POST['conpass']);

    if ($new_password != $conf_password) {
        $msg = "The two passwords did not match!";
    } else {
        // passing information
        $msg = $profile->changePassword($user_id, $old_password, $new_password, $conf_password);
    }
}

?>
<!Doctype HTML>
<html>

<head>
    <title>Profile</title>
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
    </style>
</head>


<body>
    <!-- header link file -->
    <?php include "header.owner.php" ?>
    <div class="clearfix"></div>
    </div>
    </br>
    <?php
    if (!empty($msg)) {
        echo "<p class='error_noti' style='margin-bottom:5px;'>" . $msg . "</p>";
    } else {
    }
    ?>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <hr>
                <p>Password <a href="#popup1"><span style="background-color: black;">Update</span></a></p>
                <hr>
                <br />
            </div>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>

    <!-- footer link file -->
    <?php include "footer.owner.php" ?>
    </div>

    <!--pop up for changing the password-------------------------------------------------------------->
    <div id="popup1" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h3 style="margin-bottom: 20px;"><span class="fa"> Change Password</span></h3>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

                        <label for="customer" class="form-label">Old Password</label>
                        <div class="inputBox2">
                            <span class="fas fa-key"></span>
                            <input type="password" name="oldpass" placeholder="old password" required="required">
                        </div><br>

                        <label for="customer" class="form-label">New Password</label>
                        <div class="inputBox2">
                            <span class="fas fa-key"></span>
                            <input type="password" name="newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="New Password" required="required">
                        </div>

                        <label for="customer" class="form-label">Confirm Password</label>
                        <div class="inputBox2">
                            <span class="fas fa-key"></span>
                            <input type="password" name="conpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Password" required="required">
                        </div>
                        <button name="changepass" type="submit" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-cogs"> Update</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>


</html>