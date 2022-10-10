<?php

class Payment extends Dbh
{
    // FUNCTION TO UPLOAD THE PAYMENT DETAILS
    protected function uploadsPayment($reference, $amount)
    {
        $sql = "INSERT INTO payments (`reference`, `amount`, `status`, `payment_date`) VALUES (?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$reference, $amount, 0]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO RENT A PROPERTY
    protected function reservesProperty($pay_id, $prop_id, $user_id, $fname, $lname, $code)
    {
        $sql = "INSERT INTO reservations (`payment_id`, `warehouse_id`, `customer_id`, `first_name`, `last_name`, `rental_code`, `reservation_date`, `reservation_status`) VALUES (?, ?, ?, ?, ?, ?, NOW(), 0)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$pay_id, $prop_id, $user_id, $fname, $lname, $code]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function viewsReservation($id, $st, $pg, $pg1)
    {
        $sql = "SELECT * FROM `reservations` INNER JOIN `warehouses` ON reservations.warehouse_id = warehouses.warehouse_id WHERE warehouses.user_id = ? AND reservations.reservation_status = ? ORDER BY reservations.reservation_id DESC LIMIT $pg, $pg1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $st]);
        return $stmt->fetchAll();
    }

    protected function countsReservation($id, $st)
    {
        $sql = "SELECT * FROM `reservations` INNER JOIN `warehouses` ON reservations.warehouse_id = warehouses.warehouse_id WHERE warehouses.user_id = ? AND reservations.reservation_status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $st]);
        return $stmt->rowCount();
    }

    // FUNCTION TO RENT A PROPERTY
    protected function rentsProperty($pay_id, $prop_id, $pname, $oname, $capacity,  $owner, $commission)
    {
        $sql = "INSERT INTO rented_properties (`payment_id`, `warehouse_id`, `property_name`, `owner_name`, `ren_capacity`, `owner_fee`, `commission`, `rental_date`, `ren_status`, `del_status`) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 0, 0)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$pay_id, $prop_id, $pname, $oname, $capacity,  $owner, $commission]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO CHECK PAYMENT
    protected function checksPayment($refno)
    {
        $sql = "SELECT * FROM payments WHERE `reference` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$refno]);
        $result = $stmt->rowCount();
        if ($result == 1) {
            return $stmt->fetch();
        }
    }

    //FUNCTION TO DELETE BOOKINGS
    protected function deletesReservation($id)
    {
        $sql = "SELECT * FROM `rented_properties` WHERE rented_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch();

        $sql1 = "SELECT * FROM `warehouses` WHERE warehouse_id = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $ware_id = $res['warehouse_id'];
        $stmt1->execute([$ware_id]);
        $ware = $stmt1->fetch();

        $new_capacity = $res['ren_capacity'] + $ware['available'];

        $sql2 = "UPDATE `warehouses` SET `available` = ?, `full` = 0 WHERE warehouse_id = ?";
        $stmt2 = $this->connect()->prepare($sql2);
        $ware2 = $stmt2->execute([$new_capacity, $ware_id]);

        $sql3 = "UPDATE `rented_properties` SET `del_status` = 1 WHERE rented_id = ?";
        $stmt3 = $this->connect()->prepare($sql3);
        $res2 = $stmt3->execute([$id]);

        if ($ware2 && $res2) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO CONFIRM CODE
    protected function confirmsCode($code)
    {
        $sql = "SELECT * FROM `reservations` WHERE `rental_code` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        $result = $stmt->rowCount();
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO VIEW CODE DATA
    protected function viewsCodeData($code)
    {
        $sql = "SELECT * FROM `reservations` WHERE `rental_code` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        return  $stmt->fetch();
    }

    // FUNCTION TO CHANGE RESERVATION STATUS
    protected function changesReservationStatus($code, $st)
    {
        $sql = "UPDATE `reservations` SET `reservation_status` = ? WHERE `rental_code` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $code]);
    }

    // FUNCTION TO CHANGE PAYMENT STATUS
    protected function changesPaymentStatus($id, $st)
    {
        $sql = "UPDATE `payments` SET `status` = ? WHERE `payment_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $id]);
    }

    // FUNCTION TO SHOW CODE
    protected function viewsRentalCode($id)
    {
        $sql = "SELECT * FROM `reservations` INNER JOIN `warehouses` ON reservations.warehouse_id = warehouses.warehouse_id INNER JOIN `users` ON warehouses.user_id = users.user_id WHERE reservations.customer_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsRented($id)
    {
        $sql = "SELECT * FROM `rented_properties` WHERE warehouse_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsPayment($st, $st2, $pg, $pg1)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id INNER JOIN `users` ON warehouses.user_id = users.user_id WHERE rented_properties.ren_status = ? OR rented_properties.ren_status = ? ORDER BY rented_properties.rented_id DESC LIMIT $pg, $pg1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO COUNT RENTED PROPERTY
    protected function countViewsPayment($st, $st2)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id INNER JOIN `users` ON warehouses.user_id = users.user_id WHERE rented_properties.ren_status = ? OR rented_properties.ren_status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->rowCount();
    }

    // FUNCTION TO CHANGE PAYMENT STATUS
    protected function changesRenstatus($id)
    {
        $sql = "UPDATE `rented_properties` SET `ren_status` = ? WHERE `rented_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([1, $id]);
    }

    // FUNCTION TO SHOW PAYMENTS
    protected function viewsRealPayment($st, $st2, $pg, $pg1)
    {
        $sql = "SELECT * FROM `payments` WHERE `status` = ? OR `status` = ?  ORDER BY payment_id DESC LIMIT $pg, $pg1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO COUNT PAYMENTS
    protected function countViewsRealPayment($st, $st2)
    {
        $sql = "SELECT * FROM `payments` WHERE `status` = ? OR `status` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$st, $st2]);
        return $stmt->rowCount();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsLandlordFinances($id, $pg, $pg1)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id  WHERE warehouses.user_id = ? order by rented_properties.rented_id DESC limit $pg, $pg1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO SHOW RENTED PROPERTY
    protected function viewsNotDeletedFinances($id, $pg, $pg1)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id  WHERE warehouses.user_id = ? AND rented_properties.del_status != 1 order by rented_properties.rented_id DESC limit $pg, $pg1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    // FUNCTION TO COUNT RENTED PROPERTY
    protected function countsNotDeletedFinances($id)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id WHERE warehouses.user_id = ? AND rented_properties.del_status != 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // FUNCTION TO COUNT RENTED PROPERTY
    protected function countsLandlordFinances($id)
    {
        $sql = "SELECT * FROM `rented_properties`INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id WHERE warehouses.user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    //FUNCTION SUMS COMMISSION AND PROERTY OWNER FEE
    protected function sumsPrices($type)
    {
        $sql = "SELECT SUM($type) AS $type FROM `rented_properties`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetch();
    }

    protected function sumsLandlordPrices($type, $id)
    {
        $sql = "SELECT SUM($type) AS $type FROM `rented_properties` INNER JOIN `warehouses` ON rented_properties.warehouse_id = warehouses.warehouse_id WHERE warehouses.user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
