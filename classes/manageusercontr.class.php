<?php

/**
 * This class manages user, registration and login
 */
class ManageUserContr extends ManageUser
{

    // function __construct(argument)
    // {
    // 	# code...
    // }

    // This function manages the registration data ---------------------------------------------------->
    public function userRegistration($fname, $lname, $email, $mobile, $mobile2, $location, $pwd, $type)
    {
        return $this->registerUser($fname, $lname, $email, $mobile, $mobile2, $location, $pwd, $type);
    }

    //This function manages the login data ------------------------------------------------------------>
    public function userLogin($email, $password)
    {
        return $this->loginUser($email, $password);
    }

    //This function manages the customer login data ------------------------------------------------------------>
    public function customerLogin($email, $password)
    {
        return $this->loginCustomer($email, $password);
    }

    //This function views the users in the system ------------------------------------------------------------>
    public function viewsUsers($type1, $type2, $start, $end)
    {
        return $this->viewUsers($type1, $type2, $start, $end);
    }

    //This function counts the users in the system ------------------------------------------------------------>
    public function countUsers($type1, $type2)
    {
        return $this->countsUsers($type1, $type2);
    }

    //This function edits the user status in the system ------------------------------------------------------------>
    public function editStatus($user_id, $status)
    {
        return $this->editsStatus($user_id, $status);
    }

    //This function deletes the user in the system ------------------------------------------------------------>
    public function deleteUser($user_id)
    {
        return $this->deletesUser($user_id);
    }

    //This function views the user in the system ------------------------------------------------------------------>
    public function viewUser($user_id)
    {
        return $this->viewsUser($user_id);
    }

    //This function checks the user in the system ----------------------------------------------------------------->
    public function checkUser($name, $email)
    {
        return $this->checksUser($name, $email);
    }

    //Tis function resets the password --------------------------------------------------------------------------->
    public function resetPassword($fname, $email, $password)
    {
        return $this->resetsPassword($fname, $email, $password);
    }
}
