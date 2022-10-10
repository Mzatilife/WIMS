<?php
class MessagesContr extends Messages
{
    public function sendMessage($sender, $receiver, $message)
    {
        return $this->sendsMessage($sender, $receiver, $message);
    }

    public function viewMessages($sender, $receiver, $pg, $pg1)
    {
        return $this->viewsMessages($sender, $receiver, $pg, $pg1);
    }

    public function viewDistinctSender($rec, $pg, $pg1)
    {
        return $this->viewsDistinctSender($rec, $pg, $pg1);
    }

    public function viewDistinctWare($id, $pg, $pg1)
    {
        return $this->viewsDistinctWare($id, $pg, $pg1);
    }

    public function countDistinctWare($id)
    {
        return $this->countsDistinctWare($id);
    }

    public function countMessages($sender, $receiver)
    {
        return $this->countsMessages($sender, $receiver);
    }

    public function deleteConversation($sender, $receiver)
    {
        return $this->deletesConversation($sender, $receiver);
    }

    public function deleteMessage($msg_id)
    {
        return $this->deletesMessage($msg_id);
    }

    public function countMessagesUp($receiver, $st)
    {
        return $this->countsMessagesUp($receiver, $st);
    }

    public function countMessagesSen($sender, $receiver, $st)
    {
        return $this->countsMessagesSen($sender, $receiver, $st);
    }

    public function updateMessagesStatus($sender, $st)
    {
        return $this->updatesMessagesStatus($sender, $st);
    }

    public function countDistinctSender($rec)
    {
        return $this->countsDistinctSender($rec);
    }
}
