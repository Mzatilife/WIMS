<?php
session_start();
session_unset();
session_destroy();
include_once '../includes/classautoloader.inc.php';

if (isset($_POST['register'])) {

    $fname = strip_tags($_POST['fname']);
    $lname = strip_tags($_POST['lname']);
    $phone = strip_tags($_POST['phone']);
    $phone2 = (!empty($_POST['phone2']) ? $_POST['phone2'] : null);
    $email = strip_tags($_POST['email']);
    $location = strip_tags($_POST['location']);
    $pass1 = strip_tags($_POST['pass1']);
    $pass2 = strip_tags($_POST['pass2']);

    $register = new ManageUserContr;

    //email validation-------------------------------------------------------------------------------------------------->
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $msg = " Invalid email address!";
    }
    //if confirmation pwd == main pwd ---------------------------------------------------------------------------------->
    elseif ($pass1 != $pass2) {
        $msg = " The two passwords did not match!";
    } else {
        $msg = $register->userRegistration($fname, $lname, $email, $phone, $phone2, $location, $pass1, 'owner');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Warehouse</title>
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

        <h1 class="heading"><span>Register with</span> us </h1>
        <?php
        if (!empty($msg)) {
            echo "<p class='error_noti'>" . $msg . "</p>";
        } else {
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row1">
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="fname" placeholder="first name" required="required" pattern="[a-zA-Z ]+">
                </div>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="lname" placeholder="last name" required="required" pattern="[a-zA-Z ]+">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" name="phone" placeholder="phone number" pattern="[0-9]{10,10}" title="phone number must be 10 digits" required="required">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" name="phone2" placeholder="phone number" pattern="[0-9]{10,10}" title="phone number must be 10 digits">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="email" required="required">
                </div>
                <div class="inputBox">
                    <span class="fas fa-tag"></span>
                    <input type="text" name="location" placeholder="Location..i.e Lilongwe, Gulliver" required="required">
                </div>
                <div class="inputBox">
                    <span class="fas fa-lock"></span>
                    <input type="password" name="pass1" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password2" onkeyup="checkPass();">
                </div>
                <div class="inputBox">
                    <span class="fas fa-unlock"></span>
                    <input type="password" name="pass2" placeholder="confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm2" onkeyup="checkPass();">
                </div>
                <input type="submit" name="register" value="Register" class="btn" style="width: 50%; margin: auto; margin-top: 1rem; border-radius: 5px;">
        </form>

        </div>

    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>