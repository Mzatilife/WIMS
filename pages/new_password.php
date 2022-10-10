<?php
include_once '../includes/classautoloader.inc.php';
session_start();

if (isset($_POST['submit'])) {
    $fname = $_SESSION['fname'];
    $email = $_SESSION['email'];
    $password1 = $_POST['password2'];
    $password2 = $_POST['confirm2'];

    $uppercase = preg_match('@[A-Z]@', $password1);
    $lowercase = preg_match('@[a-z]@', $password1);
    $number    = preg_match('@[0-9]@', $password1);
    $specialChars = preg_match('@[^\w]@', $password1);

    if (empty($password1) && empty($password2)) {
        $msg2 = "All fields are required";
    } elseif ($password1 != $password2) {
        $msg2 = "Passwords do not match";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
        $msg2 = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else {

        $code = new ManageUserContr();
        $result = $code->resetPassword($fname, $email, $password1);

        if ($result) {
            $msg2 = "Your password has been reset";
            header("refresh:4, url= account.php");
        } else {
            $msg2 = "Cannot reset password";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <script type="text/javascript">
        function checkPass() {
            //Store the password field objects into variables ...
            var password = document.getElementById('password2');
            var confirm = document.getElementById('confirm2');
            //Store the Confirmation Message Object ...
            var message = document.getElementById('confirm-message2');
            //Set the colors we will be using ...
            var good_color = "#66cc66";
            var bad_color = "#ff6666";
            if (password.value == confirm.value) {
                confirm.style.backgroundColor = good_color;
                message.style.color = good_color;
                message.innerHTML = 'Passwords matched!';
            } else {
                confirm.style.backgroundColor = bad_color;
                message.style.color = bad_color;
                message.innerHTML = '<i>Did not match!</i>';
            }
        }
    </script>

</head>

<body>
    <!-- contact section starts  -->

    <?php include "../includes/header.inc.php" ?>
    <section class="contact" style="margin-top: 70px">

        <h1 class="heading"> <span>Set New </span>Password</h1>
        <?php
        if (!empty($msg2)) {
            echo "<p class='error_noti'>" . $msg2 . "</p>";
        } else {
        }
        ?>
        <div class="row">

            <img src="../assets/images/warehouse.jpg" alt="" style="width: 50%">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h3>Reset Password</h3>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password2" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password2" onkeyup="checkPass();">
                </div>
                <div class="inputBox">
                    <span class="fas fa-key"></span>
                    <input type="password" name="confirm2" placeholder="confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm2" onkeyup="checkPass();">
                </div>
                <input type="submit" value="reset" name="submit" class="btn"><br><br>
            </form>


        </div>

    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>