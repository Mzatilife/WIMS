<?php
include_once '../includes/classautoloader.inc.php';
session_start();

$me = '';
$reset = $_SESSION['resetcode'];
if (isset($_POST['submit'])) {
    $code = $_POST['code'];

    if ($code != $reset) {
        $msg = "Invalid code";
    } else {
        header("location: new_password.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter code</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">

</head>

<body>
    <!-- contact section starts  -->

    <?php include "../includes/header.inc.php" ?>
    <section class="contact" style="margin-top: 70px">

        <h1 class="heading"> <span>Forgot </span>Password</h1>
        <?php
        if (!empty($msg)) {
            echo "<p class='error_noti'>" . $msg . "</p>";
        } else {
        }
        ?>
        <div class="row">

            <img src="../assets/images/warehouse.jpg" alt="" style="width: 50%">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h3>Enter Code</h3>
                <div class="inputBox">
                    <span class="fas fa-code"></span>
                    <input type="text" name="code" placeholder="reset code" required="required">
                </div>
                <input type="submit" value="continue" name="submit" class="btn">
            </form>


        </div>

    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>