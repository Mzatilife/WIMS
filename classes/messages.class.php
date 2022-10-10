<?php
class Messages extends Dbh
{
    // FUNCTION TO SEND MESSAGE
    protected function sendsMessage($sender, $receiver, $message)
    {
        $sql = "INSERT INTO messages (`sender`, `receiver`, `message`, `sent_date`, `message_status`) VALUES (?, ?, ?, NOW(), 0)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$sender, $receiver, $message]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO VIEW MESSAGES
    protected function viewsMessages($sender, $receiver, $pg, $pg1)
    {
        $sql = "SELECT * FROM `messages` WHERE (`sender` = ? AND `receiver` = ?) OR (`receiver` = ? AND `sender`=?) order by `sent_date` DESC limit $pg, $pg1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$sender, $receiver, $sender, $receiver]);
        return  $stmt->fetchAll();
    }

    // FUNCTION TO DELETE CONVERSATION
    protected function deletesConversation($sender, $receiver)
    {
        $sql = "DELETE FROM `messages` WHERE (`sender` = ? AND `receiver` = ?) OR (`receiver` = ? AND `sender`=?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$sender, $receiver, $sender, $receiver]);
        return $result;
    }

    // FUNCTION TO DELETE MESSAGE
    protected function deletesMessage($msg_id)
    {
        $sql = "DELETE FROM `messages` WHERE `message_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$msg_id]);
        return $result;
    }

    // FUNCTION TO VIEW DISTINCT SENDERS
    protected function viewsDistinctSender($rec, $pg, $pg1)
    {
        $sql = "SELECT DISTINCT `sender` FROM `messages`  WHERE `receiver` = ? order by `sent_date` DESC limit $pg, $pg1 ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$rec]);
        return  $stmt->fetchAll();
    }

    // FUNCTION TO COUNT MESSAGES
    protected function countsMessages($sender, $receiver)
    {
        $sql = "SELECT * FROM `messages` WHERE (`sender` = ? AND `receiver` = ?) OR (`receiver` = ? AND `sender`=?) ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$sender, $receiver, $sender, $receiver]);
        return  $stmt->rowCount();
    }

    // FUNCTION TO COUNTS DISTINCT SENDER
    protected function countsDistinctSender($rec)
    {
        $sql = "SELECT DISTINCT `sender` FROM `messages` WHERE `receiver` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$rec]);
        return  $stmt->rowCount();
    }

    // FUNCTION TO COUNTS DISTINCT SENDER
    protected function countsDistinctWare($id)
    {
        $sql = "SELECT DISTINCT `warehouse_id` FROM `reservations` WHERE `customer_id` = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->rowCount();
    }

    // FUNCTION TO VIEW DISTINCT SENDER
    protected function viewsDistinctWare($id, $pg, $pg1)
    {
        $sql = "SELECT DISTINCT `warehouse_id` FROM `reservations` WHERE `customer_id` = ? order by `reservation_date` DESC limit $pg, $pg1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return  $stmt->fetchAll();
    }

    // FUNCTION TO COUNT MESSAGES
    protected function countsMessagesUp($receiver, $st)
    {
        $sql = "SELECT * FROM `messages` WHERE `receiver` = ? AND `message_status` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$receiver, $st]);
        return  $stmt->rowCount();
    }

    // FUNCTION TO COUNT MESSAGES
    protected function countsMessagesSen($sender, $receiver, $st)
    {
        $sql = "SELECT * FROM `messages` WHERE `sender` = ? AND `receiver` = ? AND `message_status` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$sender, $receiver, $st]);
        return  $stmt->rowCount();
    }

    // FUNCTION TO COUNT MESSAGES
    protected function updatesMessagesStatus($sender, $st)
    {
        $sql = "UPDATE `messages` SET `message_status` = ? WHERE `sender` = ? ";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$st, $sender]);
    }
}
