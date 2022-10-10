<?php

/**
 *THIS CLASS IS A CONTROLLER FOR THE MANAGE WAREHOUSE CLASS
 */
class ManageWarehouseContr extends ManageWarehouse
{

    // function __construct(argument)
    // {
    // 	# code...
    // }

    // This function manages the submission of warehouse data ---------------------------------------------------->
    public function submitWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4)
    {
        return $this->submitsWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4);
    }

    // This function manages the submission of warehouse data ---------------------------------------------------->
    public function editWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4, $ware_id)
    {
        return $this->editsWarehouse($name, $user_id, $capacity, $location, $area, $price, $image1, $image2, $image3, $image4, $ware_id);
    }

    // This function views the warehouse at the owner side --------------------------------------------------------->
    public function viewWarehouse($user_id, $st1, $st2, $st3, $start, $end)
    {
        return $this->viewsWarehouse($user_id, $st1, $st2, $st3, $start, $end);
    }

    // This function counts the warehouse at the owner side --------------------------------------------------------->
    public function countOwnerWarehouse($user_id, $st1, $st2, $st3)
    {
        return $this->countsOwnerWarehouse($user_id, $st1, $st2, $st3);
    }

    // This function views the warehouse at the admin side --------------------------------------------------------->
    public function viewWarehouseOwner($status, $full, $start, $end)
    {
        return $this->viewsWarehouseOwner($status, $full, $start, $end);
    }

    // This function counts the warehouse at the admin side --------------------------------------------------------->
    public function countWarehouseOwner($status, $full)
    {
        return $this->countsWarehouseOwner($status, $full);
    }

    // This function views the warehouse details at the admin side --------------------------------------------------->
    public function viewWarehouseDetails($id)
    {
        return $this->viewsWarehouseDetails($id);
    }

    // This function views the reason --------------------------------------------------->
    public function viewReason($id)
    {
        return $this->viewsReason($id);
    }

    // This function passes data to approve warehouse ---------------------------------------------------------------->
    public function approveWarehouse($id, $st)
    {
        return $this->approvesWarehouse($id, $st);
    }

    // This function passes data to reject warehouse ---------------------------------------------------------------->
    public function rejectWarehouse($id, $reason)
    {
        return $this->rejectsWarehouse($id, $reason);
    }

    // This function passes data to rent warehouse ---------------------------------------------------------------->
    public function rentWarehouse($id, $st)
    {
        return $this->rentsWarehouse($id, $st);
    }

    // This function passes data to count warehouses ---------------------------------------------------------------->
    public function countWarehouse($id)
    {
        return $this->countsWarehouse($id);
    }

    // This function searches for related warehouses --------------------------------------------------------->
    public function searchRelatedWarehouse($ware_id, $full, $name, $location, $area, $start, $end)
    {
        return $this->searchsRelatedWarehouse($ware_id, $full, $name, $location, $area, $start, $end);
    }

    // This function counts the property at the owner side --------------------------------------------------------->
    public function countOwnerProperty($user_id, $st1, $st2, $st3, $st4)
    {
        return $this->countsOwnerProperty($user_id, $st1, $st2, $st3, $st4);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function viewProperty($user_id, $st1, $st2, $st3, $st4, $st5, $pg, $pg1)
    {
        return $this->viewsProperty($user_id, $st1, $st2, $st3, $st4, $st5, $pg, $pg1);
    }

    // This function views the property at the owner side --------------------------------------------------------->
    public function CountViewProperty($user_id, $st1, $st2, $st3, $st4, $st5)
    {
        return $this->countViewsProperty($user_id, $st1, $st2, $st3, $st4, $st5);
    }

    // This function views the property at the admin side --------------------------------------------------------->
    public function viewPropertyAdmin($st1, $st2, $st3, $st4, $st5, $pg, $pg2)
    {
        return $this->viewsPropertyAdmin($st1, $st2, $st3, $st4, $st5, $pg, $pg2);
    }

    // This function countss the property at the admin side --------------------------------------------------------->
    public function countPropertyAdmin($st1, $st2, $st3, $st4, $st5)
    {
        return $this->countsPropertyAdmin($st1, $st2, $st3, $st4, $st5);
    }

    // This function searches the property -------------------------------------------------------------------->
    public function searchProperty($status, $full, $word, $start, $end)
    {
        return  $this->searchesProperty($status, $full, $word, $start, $end);
    }

    // This function searches the property -------------------------------------------------------------------->
    public function countSearchProperty($status, $full, $word)
    {
        return  $this->countsSearchProperty($status, $full, $word);
    }
}
