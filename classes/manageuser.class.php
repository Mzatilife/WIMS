<?php

/**
 * Manage user model
 */
class ManageUser extends Dbh
{

  // function __construct(argument)
  // {
  // 	# code...
  // }

  // FUNCTION TO MANAGE THE USER REGISTRATION *********************************************************************>
  protected function registerUser($fname, $lname, $email, $mobile, $mobile2, $location, $pwd, $type)
  {

    $sql = "SELECT * FROM `users` WHERE `email` = ? AND `user_type`= ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email, $type]);

    //checking if the email and username are unavailable ----------------------------------------------------->
    if ($stmt->rowCount() > 0) {
      return $errorMsg[] = "Error, try using a different username or email!";
    } else {

      //adding the user data into the database ----------------------------------------------------------------->

      $sql1 = "INSERT INTO users (`first_name`, `last_name`, `email`, `mobile`, `mobile2`,`address`, `password`, `user_type`, `regdate`, `user_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1)";
      $stmt1 = $this->connect()->prepare($sql1);
      $passwd = password_hash($pwd, PASSWORD_DEFAULT);

      $result = $stmt1->execute([$fname, $lname, $email, $mobile, $mobile2, $location, $passwd, $type]);

      //Checking if the data was uploaded ----------------------------------------------------------------------->

      if ($result) {
        $sql2 = "SELECT * FROM `users` WHERE `user_type` = ? AND `email` = ?";
        $stmt2 = $this->connect()->prepare($sql2);
        $stmt2->execute([$type, $email]);
        $row = $stmt2->fetch();

        if ($stmt2->rowCount() > 0) {
          session_start();
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['first_name'];
          $user_type = $row['user_type'];
          return header("location: ../$user_type/index.$user_type.php");
        }
      } else {
        return $errorMsg[] = "Error, registration was not done!";
      }
    }
  }

  // FUNCTION TO MANAGE THE USER LOGIN ****************************************************************************>
  protected function loginUser($email, $password)
  {
    $sql = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if ($stmt->rowCount() > 0) {
      //checking if the account is active ----------------------------------------------------------------------->
      if ($row['user_status'] == 1) {
        //checking if the username is correct ----------------------------------------------------------------->
        if ($email == $row['email']) {
          //verifying the password --------------------------------------------------------------------------> 
          if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['first_name'];
            $user_type = $row['user_type'];
            return header("location: ../$user_type/index.$user_type.php");
          } else {
            return $errorMsg[] = "incorrect password";
          }
        } else {
          return $errorMsg[] = "incorrect email";
        }
      } else {
        return $errorMsg[] = "Your account is deactivated";
      }
    } else {
      return $errorMsg[] = "incorrect email or password";
    }
  }

  // FUNCTION TO MANAGE THE CUSTOMER LOGIN ****************************************************************************>
  protected function loginCustomer($email, $password)
  {
    $sql = "SELECT * FROM `users` WHERE `email` = ? AND `user_type`='customer'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if ($stmt->rowCount() > 0) {
      //checking if the account is active ----------------------------------------------------------------------->
      if ($row['user_status'] == 1) {
        //checking if the username is correct ----------------------------------------------------------------->
        if ($email == $row['email']) {
          //verifying the password --------------------------------------------------------------------------> 
          if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['first_name'];
            return header("location: ../customer/index.customer.php");
          } else {
            return $errorMsg[] = "incorrect password";
          }
        } else {
          return $errorMsg[] = "incorrect email";
        }
      } else {
        return $errorMsg[] = "Your account is deactivated";
      }
    } else {
      return $errorMsg[] = "incorrect email or password";
    }
  }

  // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
  protected function viewUsers($type1, $type2, $start, $end)
  {
    $sql = "SELECT * FROM users WHERE user_type = ? OR user_type = ? ORDER BY user_id DESC limit $start, $end ";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$type1, $type2]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO EDIT USER STATUS ****************************************************************************>
  protected function editsStatus($user_id, $status)
  {
    $sql = "UPDATE users SET `user_status` = ? WHERE `user_id` = ? ";
    $stmt = $this->connect()->prepare($sql);
    return $stmt->execute([$status, $user_id]);
  }

  // FUNCTION TO DELETE ***************************************************************************************>
  protected function deletesUser($user_id)
  {
    $sql = "DELETE FROM users WHERE `user_id` = ? ";
    $stmt = $this->connect()->prepare($sql);
    return $stmt->execute([$user_id]);
  }

  // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
  protected function viewsUser($id)
  {
    $sql = "SELECT * FROM users WHERE `user_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO CHECK USER DETAILS ****************************************************************************>
  protected function checksUser($name, $email)
  {
    $sql = "SELECT * FROM `users` WHERE `first_name`=? and `email`=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name, $email]);
    $result = $stmt->rowCount();

    if ($result > 0) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO RESET PASSWORD *********************************************************************************>
  protected function resetsPassword($fname, $email, $password)
  {
    $pwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE `users` SET `password` = ? WHERE `first_name` = ? AND `email` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$pwd, $fname, $email]);

    if ($result > 0) {
      return true;
    } else {
      return false;
    }
  }

  //***************************************  STATISTICS  **********************************************************>
  //.......................... counts number of users ...........................................
  protected function countsUsers($type, $type2)
  {
    $sql = "SELECT * FROM users WHERE user_type = ? OR user_type = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$type, $type2]);
    return $stmt->rowCount();
  }
}
