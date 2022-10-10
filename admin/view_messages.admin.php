<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
//creating an object to access user data from the "manageusercontr.php" class -------------------->
$user = new ManageUserContr();
$conver = new MessagesContr();
if (isset($_SESSION['sender_id'])) {
    $sender_id = $_SESSION['sender_id'];
    $user = $user->viewUser($sender_id);
} else {
    header("location: messages.admin.php");
}

if (isset($_POST['send'])) {
    $message = $_POST['message'];

    $result = $conver->sendMessage($user_id, $sender_id, $message);

    if ($result) {
        $msg = "Message sent";
    } else {
        $msg = "Error, cannot send message.";
    }
}
if (isset($_GET['delete_id'])) {
    $msg_id = $_GET['delete_id'];
    $result = $conver->deleteMessage($msg_id);
  
    if ($result) {
      $msg = "message deleted";
    } else {
      $msg = "Couldn't deleted the message";
    }
  }
?>
<!Doctype HTML>
<html>

<head>
    <title>Messages</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
    <!-- font awesome file link  -->
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <style>
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
    <?php include "header.admin.php" ?>
    <div class="clearfix"></div>
    </div>
    <?php
    if (!empty($msg)) {
        echo "<p class='error_noti'>" . $msg . "</p>";
    } else {
    }
    ?>
    </br>
    <div class="col-div-12">
        <div class="box-8">
            <div class="content-box">
                <p>Conversation with <?php echo $user['first_name'] . " " . $user['last_name']; ?> </p>
                <br />
                <table>
                    <tr>
                        <th>From</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <?php

                    //displaying the data ---------------------------------------------------------------------------------------->
                    @$page = $_GET["page"];

                    if ($page == "" || $page == "1") {

                        $page1 = 0;
                    } else {

                        $page1 = ($page * 5) - 5;
                    }
                    $row = $conver->viewMessages($user_id, $sender_id, $page1, 5);
                    foreach ($row as $rw) {
                    ?>
                        <tr>
                            <?php if ($rw['sender'] == $user_id) { ?>
                                <td>You</td>
                            <?php  } else { ?>
                                <td><?php echo $user['first_name']; ?></td>
                            <?php } ?>
                            <td><?php echo $rw['message']; ?></td>
                            <td><?php echo date("d M Y", strtotime($rw['sent_date'])); ?></td>
                            <td>
                <a href="view_messages.admin.php?delete_id=<?php echo $rw['message_id']; ?>" style="text-decoration: none;"><span class="fa fa-trash-alt"></span></a>
            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
        <?php
        $cout = $conver->countMessages($user_id, $sender_id);

        $a = $cout / 5;

        $a = ceil($a);
        ?>
        <div class="page-btn">
            <?php for ($b = 1; $b <= $a; $b++) {  ?>
                <a href="view_messages.admin.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
            <?php } ?>
            <span>&#8594;</span>
        </div>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="box-8">
            <div class="colu" style="padding:10px;">
                <label for="customer" class="form-label">Reply</label>
                <textarea name="message" id="" cols="118" rows="2" required></textarea>
                <button type="submit" name="send" class="btn-stall"><span class="fa fa-paper-plane"></span> send</button>
            </div>
        </div>
    </form>

    </br>
    <div class="clearfix"></div>

    <!-- footer link file -->
    <?php include "footer.admin.php" ?>
    </div>


</body>


</html>