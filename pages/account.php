<?php
session_start();
session_unset();
session_destroy();
include_once '../includes/classautoloader.inc.php';

if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    // passing login information
    $login = new ManageUserContr;
    $msg = $login->userLogin($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
    <!-- contact section starts  -->

    <?php include "../includes/header.inc.php" ?>
    <section class="contact" style="margin-top: 70px">

        <h1 class="heading"> <span>Login here or </span>register</h1>
        <?php
        if (!empty($msg)) {
            echo "<p class='error_noti'>" . $msg . "</p>";
        } else {
        }
        ?>
        <div class="row">

            <img src="../assets/images/login.jpg" alt="" style="width: 50%">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h3>Login</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="email" name="email" placeholder="example@company.com" required="required">
                </div>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password" placeholder="password" required="required">
                </div>
                <input type="submit" value="Login" name="login" class="btn"><br><br>
                <a href="forgot_password.php" style="text-decoration: none; color:white; font-size:15px;">Forgot password?</a>
            </form>


        </div>

    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>