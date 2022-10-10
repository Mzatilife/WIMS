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

if (isset($_POST['changeaddress'])) {
    $name = strip_tags($_POST['name']);
    $district = strip_tags($_POST['district']);
    $box = strip_tags($_POST['box']);
    $email = strip_tags($_POST['email']);
    $phone = strip_tags($_POST['phone']);
    $mpamba = strip_tags($_POST['mpamba']);

    // passing information
    $msg = $profile->changeAddress($name, $district, $box, $email, $phone, $mpamba);
}

if (isset($_POST['changeabout'])) {
    $about = strip_tags($_POST['about']);

    // passing information
    $msg = $profile->changeAbout($about);
}

if (isset($_POST['changeurls'])) {
    $whatsapp = strip_tags($_POST['whatsapp']);
    $facebook = strip_tags($_POST['facebook']);
    $instagram = strip_tags($_POST['instagram']);
    $twitter = strip_tags($_POST['twitter']);

    // passing information
    $msg = $profile->changeUrls($whatsapp, $facebook, $instagram, $twitter);
}

if (isset($_POST['custerms'])) {
    $customer = strip_tags($_POST['customer']);
    // passing information
    $msg = $profile->changeCustomerTerms($customer);
}

if (isset($_POST['landterms'])) {
    $landlord = strip_tags($_POST['landlord']);
    // passing information
    $msg = $profile->changeLandlordTerms($landlord);
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
    <?php include "header.admin.php" ?>
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
                <p>Address <a href="#popup2"><span style="background-color: black;">Update</span></a></p>
                <hr>
                <address>
                    <?php
                    $address = $profile->viewAddress();

                    foreach ($address as $add) {
                    ?>
                        <address><?php echo $add['company_name'] . "<br> P. O. Box " . $add['postal_box'] . "<br>" . $add['district'] ?></address>

                </address><br>
                <i><b>Email</b>: <?php echo $add['email']; ?>, <b>Mpamba:</b> <?php echo $add['mpamba']; ?>, <b>Phone:</b> <?php echo $add['phone']; ?></i>
            <?php } ?>
            <hr>
            <p>Terms and About Page <a href="#popup3"><span style="background-color: black; margin-left:10px;">Update Ts & Cs</span></a> <a href="#popup4"><span style="background-color: black;">Update About</span></a></p>
            <hr>
            <p>Social Media URLs <a href="#popup5"><span style="background-color: black;">Update</span></a></p>
            <hr>
            <br />
            </div>
        </div>
    </div>
    </br>
    <div class="clearfix"></div>

    <!-- footer link file -->
    <?php include "footer.admin.php" ?>
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

    <!--pop up for changing the Address-------------------------------------------------------------->
    <div id="popup2" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h3 style="margin-bottom: 20px;"><span class="fa"> Change Address</span></h3>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <?php
                        $address = $profile->viewAddress();

                        foreach ($address as $add) { ?>
                            <div class="inputBox2">
                                <span class="fas fa-users"></span>
                                <input type="text" name="name" class="form-control" value="<?php echo $add['company_name'] ?>" id="firstName" required>
                            </div>
                            <div class="inputBox2">
                                <span class="fas fa-mountain"></span>
                                <input type="text" name="district" class="form-control" value="<?php echo $add['district'] ?>" id="lastName" required>
                            </div>
                            <div class="inputBox2">
                                <span class="fas fa-credit-card"></span>
                                <input type="number" name="box" class="form-control" value="<?php echo $add['postal_box'] ?>" min="1" id="lastName" required>
                            </div>
                            <div class="inputBox2">
                                <span class="fas fa-credit-card"></span>
                                <input type="email" name="email" class="form-control" value="<?php echo $add['email'] ?>" id="lastName" required>
                            </div>
                            <div class="inputBox2">
                                <span class="fas fa-phone"></span>
                                <input type="number" name="phone" class="form-control" value="0<?php echo $add['phone'] ?>" maxlength="10" id="lastName" required>
                            </div>
                            <div class="inputBox2">
                                <span class="fas fa-phone"></span>
                                <input type="number" name="mpamba" class="form-control" value="0<?php echo $add['mpamba'] ?>" maxlength="10" id="lastName" required>
                            </div>
                            <button name="changeaddress" class="btn-stall" type="submit" style="margin-top: 20px;"><span class="fa fa-cog"> Update</span></button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--pop up for changing the Ts and Cs-------------------------------------------------------------->
    <div id="popup3" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h3 style="margin-bottom: 20px;"><span class="fa"> Change Ts and Cs</span></h3>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <?php
                        $terms = $profile->viewTerms();

                        foreach ($terms as $term) { ?>
                            <label for="firstName" class="form-label">Landlord Terms and Conditions</label>
                            <textarea name="landlord" class="form-control" id="landlord" cols="40" rows="6" required><?php echo $term['landlord'] ?></textarea><br>
                            <button type="submit" name="landterms" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-cogs"> Update</span></button>
                        <?php } ?>
                    </form><br>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <?php
                        $terms = $profile->viewTerms();

                        foreach ($terms as $term) { ?>
                            <label for="customer" class="form-label">Customer Terms and Conditions</label>
                            <textarea name="customer" class="form-control" id="customer" cols="40" rows="6" required><?php echo $term['customer'] ?></textarea><br>
                            <button name="custerms" type="submit" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-cogs"> Update</span></button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--pop up for changing the About Page-------------------------------------------------------------->
    <div id="popup4" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h3 style="margin-bottom: 20px;"><span class="fa"> Change About info</span></h3>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <?php
                        $about = $profile->viewAbout();

                        foreach ($about as $ab) { ?>
                            <textarea name="about" id="about" class="form-control" cols="40" rows="12" required><?php echo $ab['about'] ?></textarea><br>
                            <button type="submit" name="changeabout" class="btn-stall" style="margin-top: 20px;"><span class="fa fa-cogs"> Update</span></button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--pop up for changing urls-------------------------------------------------------------->
    <div id="popup5" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="content">
                <div class="upform">
                    <h3 style="margin-bottom: 20px;"><span class="fa"> Change Urls</span></h3>
                    <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <?php
                        $urls = $profile->viewUrls();

                        foreach ($urls as $url) { ?>
                            <label for="lastName" class="form-label">whatsApp</label>
                            <div class="inputBox2">
                                <span class="fab fa-whatsapp"></span>
                                <input type="text" name="whatsapp" id="firstName" value="<?php echo $url['whatsapp']; ?>" required>
                            </div>
                            <label for="lastName" class="form-label">Facebook</label>
                            <div class="inputBox2">
                                <span class="fab fa-facebook"></span>
                                <input type="text" name="facebook" id="lastName" value="<?php echo $url['facebook'] ?>" required>
                            </div>
                            <label for="lastName" class="form-label">Twitter</label>
                            <div class="inputBox2">
                                <span class="fab fa-twitter"></span>
                                <input type="text" name="twitter" id="lastName" value="<?php echo $url['twitter'] ?>" required>
                            </div>
                            <label for="lastName" class="form-label">Instagram</label>
                            <div class="inputBox2">
                                <span class="fab fa-instagram"></span>
                                <input type="text" name="instagram" id="lastName" value="<?php echo $url['instagram'] ?>" required>
                            </div>
                            <button name="changeurls" class="btn-stall" type="submit" style="margin-top: 20px;"><span class="fa fa-cog"> Update</span></button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


</html>