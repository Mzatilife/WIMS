<?php
class PaymentContr extends Payment
{
    // This function passes data to upload payment
    public function uploadPayment($reference, $amount)
    {
        return $this->uploadsPayment($reference, $amount);
    }

    // This function passes data to upload payment
    public function rentProperty($pay_id, $prop_id, $pname, $oname, $capacity, $owner, $commission)
    {
        return $this->rentsProperty($pay_id, $prop_id,  $pname, $oname, $capacity, $owner, $commission);
    }

    // This function passes data to upload payment
    public function reserveProperty($pay_id, $prop_id, $user_id, $fname, $lname, $code)
    {
        return $this->reservesProperty($pay_id, $prop_id, $user_id, $fname, $lname, $code);
    }

    // This function passes data to view the code and other details 
    public function viewReservation($id, $st, $pg, $pg1)
    {
        return $this->viewsReservation($id, $st, $pg, $pg1);
    }

    // This function passes data to view the code and other details 
    public function countReservation($id, $st)
    {
        return $this->countsReservation($id, $st);
    }

    // This function passes data to upload payment
    public function checkPayment($refno)
    {
        return $this->checksPayment($refno);
    }

    // This function passes data to confirm code
    public function confirmCode($code)
    {
        return $this->confirmsCode($code);
    }

    // This function passes data to cview code data
    public function viewCodeData($code)
    {
        return $this->viewsCodeData($code);
    }

    // This function passes data to change payment status
    public function changeReservationStatus($code, $st)
    {
        return $this->changesReservationStatus($code, $st);
    }

    // This function passes data to change payment status
    public function changePaymentStatus($id, $st)
    {
        return $this->changesPaymentStatus($id, $st);
    }

    // This function passes data to view the code and other details 
    public function viewRentalCode($id)
    {
        return $this->viewsRentalCode($id);
    }

    // This function passes data to rental details based on id
    public function viewRented($id)
    {
        return $this->viewsRented($id);
    }

    // This function passes data to view payment
    public function viewPayment($st, $st2, $pg, $pg1)
    {
        return $this->viewsPayment($st, $st2, $pg, $pg1);
    }

    // This function passes data to count payment
    public function countViewPayment($st, $st2)
    {
        return $this->countViewsPayment($st, $st2);
    }

    // This function passes an id to change rented status in the rented properties table
    public function changeRenstatus($id)
    {
        return $this->changesRenstatus($id);
    }

    // This function passes data to view real payment
    public function viewRealPayment($st, $st2, $pg, $pg2)
    {
        return $this->viewsRealPayment($st, $st2, $pg, $pg2);
    }

    // This function passes data to count real payment
    public function countViewRealPayment($st, $st2)
    {
        return $this->countViewsRealPayment($st, $st2);
    }

    // This function passes data to view finances for the landlord
    public function viewLandlordFinances($id, $pg, $pg1)
    {
        return $this->viewsLandlordFinances($id, $pg, $pg1);
    }

     public function viewNotDeletedFinances($id, $pg, $pg1)
    {
        return $this->viewsNotDeletedFinances($id, $pg, $pg1);
    }

    // This function passes data to count finances for the landlord
    public function countLandlordFinances($id)
    {
        return $this->countsLandlordFinances($id);
    }

     public function countNotDeletedFinances($id)
    {
        return $this->countsNotDeletedFinances($id);
    }

    // This function passes data to delete reservations
    public function deleteReservation($id)
    {
        return $this->deletesReservation($id);
    }

    // This function passes data to sum prices
    public function sumPrices($type)
    {
        return $this->sumsPrices($type);
    }

    // This function passes data to sum prices for the landlord 
    public function sumLandlordPrices($type, $id)
    {
        return $this->sumsLandlordPrices($type, $id);
    }
}
