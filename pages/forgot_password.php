<?php
include_once '../includes/classautoloader.inc.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$me = '';
$resetcode = '';

if (isset($_POST['continue'])) {
    $email = $_POST['email'];
    $name = $_POST['fname'];
    if (empty($email)) {
        echo " ";
    } else {
        $_SESSION['fname'] = $name;
        $_SESSION['email'] = $email;

        $code = new ManageUserContr();
        $ans = $code->checkUser($name, $email);

        if ($ans) {

            $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $resetcode = substr(str_shuffle($Generator), 0, 4);
            //echo $resetcode;

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                     
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'wimspayments22@gmail.com';
                $mail->Password   = 'mughogho75';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                //Recipients
                $mail->setFrom('wimspayments22@gmail.com');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "WIMS :  Recovery Code";
                $mail->Body    = "
                <div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
                <p> Recovery Code: <b>$resetcode</b><br> Enter it in the field to reset your password </p>
                </div>
                ";

                $mail->send();
                $msg = 'We have sent a reset code to your email';

                $_SESSION['resetcode'] = $resetcode;
                header("refresh:2, url=code.php");
            } catch (Exception $e) {
                $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $msg = "Email and username not found";
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
    <title>Forgot Password</title>
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
                <h3>First name and email</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="fname" placeholder="First name i.e. John" required="required">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="Email i.e. example@company.com" required="required">
                </div>
                <input type="submit" value="continue" name="continue" class="btn"><br><br>
                <a href="account.php" style="text-decoration: none; color:white; font-size:15px;">Go back?</a>
            </form>


        </div>

    </section>

    <!-- contact section ends -->

    <?php include "../includes/footer.inc.php" ?>
    <!-- custom js file link  -->
    <script src="../assets/js/script.js"></script>

</body>

</html>