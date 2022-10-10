<?php

/**
 *THIS CLASS MANAGES SUBMITTING, VERIFYING AND MANAGING THE WAREHOUSE INFORMATION
 */
class ManageWarehouse extends Dbh
{

  // function __construct(argument)
  // {
  // 	# code...
  // }

  // FUNCTION TO MANAGE WAREHOUSE SUBMISSION *********************************************************************>
  protected function submitsWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO warehouses (`user_id`, `name`, `capacity`, `available`, `location`, `area`, `price`, `image1`, `image2`, `image3`, `image4`, `status`, `full`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, NOW())";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$user_id, $name, $capacity, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO MANAGE WAREHOUSE EDITING *********************************************************************>
  protected function editsWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4, $ware_id)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "UPDATE warehouses SET `user_id` = ?, `name` = ?, `capacity` = ?, `available` = ?, `location` = ?, `area` = ?, `price` = ?, `image1` = ?, `image2` = ?, `image3` = ?, `image4` = ?, `status` = ?, `full` = ? WHERE `warehouse_id` = ?";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$user_id, $name, $capacity, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4, 0, 0, $ware_id]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO VIEW WAREHOUSE DETAILS ****************************************************************************>
  protected function viewsWarehouse($user_id, $st1, $st2, $st3, $start, $end)
  {
    $sql = "SELECT * FROM warehouses WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ?) order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT WAREHOUSE DETAILS ****************************************************************************>
  protected function countsOwnerWarehouse($user_id, $st1, $st2, $st3)
  {
    $sql = "SELECT * FROM warehouses WHERE user_id = ? AND (status = ? OR status = ? OR status = ?) order by warehouse_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3]);
    return $stmt->rowCount();
  }


  // FUNCTION TO VIEW WAREHOUSE AND OWNER DETAILS ******************************************************************>
  protected function viewsWarehouseOwner($status, $full, $start, $end)
  {
    $sql = "SELECT * FROM warehouses INNER JOIN users ON warehouses.user_id = users.user_id WHERE warehouses.status = ? AND warehouses.full = ? order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $full]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT WAREHOUSES AND OWNER DETAILS ******************************************************************>
  protected function countsWarehouseOwner($status, $full)
  {
    $sql = "SELECT * FROM warehouses INNER JOIN users ON warehouses.user_id = users.user_id WHERE warehouses.status = ? AND warehouses.full = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $full]);
    return $stmt->rowCount();
  }


  // FUNCTION TO VIEW PROPERTY DETAILS ****************************************************************************>
  protected function viewsPropertyAdmin($st1, $st2, $st3, $st4, $st5, $start, $end)
  {
    $sql = "SELECT * FROM `warehouses`  INNER JOIN `users` ON warehouses.user_id = users.user_id WHERE warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st1, $st2, $st3, $st4, $st5]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW PROPERTY DETAILS ****************************************************************************>
  protected function countsPropertyAdmin($st1, $st2, $st3, $st4, $st5)
  {
    $sql = "SELECT * FROM `warehouses`  INNER JOIN `users` ON warehouses.user_id = users.user_id WHERE warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? OR warehouses.status = ? order by warehouse_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st1, $st2, $st3, $st4, $st5]);
    return $stmt->rowCount();
  }

  // FUNCTION TO VIEW WAREHOUSE DETAILS AND OWNER DETAILS **********************************************************>
  protected function viewsWarehouseDetails($id)
  {
    $sql = "SELECT * FROM warehouses INNER JOIN users ON warehouses.user_id = users.user_id WHERE warehouses.warehouse_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO APPROVE WAREHOUSE FOR UPLOAD  *********************************************************************>
  protected function approvesWarehouse($id, $st)
  {
    $sql = "UPDATE warehouses SET status = ? WHERE warehouse_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$st, $id]);

    if ($result) {
      // return header("location: uploads.admin.php");
      // return '<script type = "text/javascript" > alert("Operation done"); window.location=\'uploads.admin.php\';</script> ';
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO REJECT WAREHOUSE *****************************************************************************>
  protected function rejectsWarehouse($id, $reasons)
  {
    $sql = "INSERT INTO reasons (`warehouse_id`, `reason`) VALUES (?,?)";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id, $reasons]);

    if ($result) {
      return $this->approvesWarehouse($id, 2);
    }
  }

  protected function viewsReason($id)
  {
    $sql = "SELECT * FROM `reasons` WHERE `warehouse_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO RENT WAREHOUSE  *********************************************************************>
  protected function rentsWarehouse($id, $st)
  {
    $sql = "UPDATE `warehouses` SET `available` = ? WHERE `warehouse_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$st, $id]);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO VIEW PROPERTY DETAILS ****************************************************************************>
  protected function viewsProperty($user_id, $st1, $st2, $st3, $st4, $st5,  $start, $end)
  {
    $sql = "SELECT * FROM `warehouses` WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ? OR `status` = ?) order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3, $st4, $st5]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO SEARCH FOR RELATED WAREHOUSES ******************************************************************>
  protected function searchsRelatedWarehouse($ware_id, $full, $name, $location, $area, $start, $end)
  {
    $sql = "SELECT * FROM warehouses INNER JOIN users ON warehouses.user_id = users.user_id WHERE warehouses.warehouse_id != ? AND warehouses.full = ? AND (warehouses.name LIKE '%$name%' OR warehouses.location LIKE '%$location%' OR warehouses.area LIKE '%$area%') order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$ware_id, $full]);
    return $stmt->fetchAll();
  }

  //VIEW SEARCH RESULTS ********************************************************************************************>
  protected function searchesProperty($status, $full, $word, $start, $end)
  {
    $sql = "SELECT * FROM `warehouses` WHERE `status` = ? AND `full` = ? AND (`location` LIKE '%$word%' OR `area` LIKE '%$word%' OR `name` LIKE '%$word%') order by warehouse_id DESC limit $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $full]);
    return $stmt->fetchAll();
  }

  //COUNT SEARCH RESULTS ********************************************************************************************>
  protected function countsSearchProperty($status, $full, $word)
  {
    $sql = "SELECT * FROM `warehouses` WHERE `status` = ? AND `full` = ? AND (`location` LIKE '%$word%' OR `area` LIKE '%$word%' OR `name` LIKE '%$word%') order by warehouse_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status, $full]);
    return $stmt->rowCount();
  }

  //***************************************  STATISTICS  **********************************************************>
  //.......................... counts number of warehouses ...........................................
  protected function countsWarehouse($id)
  {
    $sql = "SELECT * FROM warehouses WHERE `status` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }

  protected function countsOwnerProperty($user_id, $st1, $st2, $st3, $st4)
  {
    $sql = "SELECT * FROM `warehouses` WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3, $st4]);
    return $stmt->rowCount();
  }

  protected function countViewsProperty($user_id, $st1, $st2, $st3, $st4, $st5)
  {
    $sql = "SELECT * FROM `warehouses` WHERE `user_id` = ? AND (`status` = ? OR `status` = ? OR `status` = ? OR `status` = ? OR `status` = ?) order by warehouse_id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $st1, $st2, $st3, $st4, $st5]);
    return $stmt->rowCount();
  }
}
