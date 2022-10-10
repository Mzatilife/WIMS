<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class -------------------->
$user = new ManageUserContr();
$conver = new MessagesContr();
if (isset($_GET['sender_id'])) {
  $_SESSION['sender_id'] = $_GET['sender_id'];
  $conver->updateMessagesStatus($_GET['sender_id'], 1);
  header("location: view_messages.owner.php");
}

if (isset($_GET['delete_id'])) {
  $sender = $_GET['delete_id'];
  $result = $conver->deleteConversation($sender, $user_id);

  if ($result) {
    $msg = "Conversation deleted";
  } else {
    $msg = "Couldn't deleted the conversation";
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
  <?php include "header.owner.php" ?>
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
        <p>Conversations
          <a href="messages.owner.php?sender_id=1"><span>Message Admin</span></a>
        </p>
        <br />
        <table>
          <tr>
            <th>#</th>
            <th>Sender</th>
            <th>unread</th>
            <th style="width: 5%">Action</th>
          </tr>
          <?php

          //displaying the data ---------------------------------------------------------------------------------------->
          @$page = $_GET["page"];

          if ($page == "" || $page == "1") {

            $page1 = 0;
          } else {

            $page1 = ($page * 5) - 5;
          }
          $row = $conver->viewDistinctSender($user_id, $page1, 5);
          $index =  $page1 + 1;
          foreach ($row as $rw) {
            $us = $user->viewUser($rw['sender']);
          ?>
            <tr>
              <td><?php echo $index; ?></td>
              <td><?php echo $us['first_name'] . " " . $us['last_name']; ?></td>
              <?php
              $sen = $conver->countMessagesSen($rw['sender'], $user_id, 0);
              ?>
              <td style="color: green;"><?php echo $sen; ?> new</td>
              <td>
                <a href="messages.owner.php?sender_id=<?php echo $rw['sender']; ?>" style="text-decoration: none;"><span class="fa fa-eye"></span></a>
              <a href="messages.owner.php?delete_id=<?php echo $rw['sender']; ?>" style="text-decoration: none;"><span class="fa fa-trash-alt"></span></a>
            </td>
            </tr>
          <?php
            $index++;
          }
          ?>

        </table>
      </div>
    </div>
    <?php
    $cout = $conver->countDistinctSender($user_id);

    $a = $cout / 5;

    $a = ceil($a);
    ?>
    <div class="page-btn">
      <?php for ($b = 1; $b <= $a; $b++) {  ?>
        <a href="messages.owner.php?page=<?php echo $b; ?>"><span><?php echo $b . " "; ?></span></a>
      <?php } ?>
      <span>&#8594;</span>
    </div>
  </div>
  </br>
  <div class="clearfix"></div>

  <!-- footer link file -->
  <?php include "footer.owner.php" ?>
  </div>


</body>


</html>