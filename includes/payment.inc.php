<?php
include_once 'classautoloader.inc.php';

$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'wimspayments22@gmail.com'; //your email here
$password = 'mughogho75'; // your password here

//try to connect 
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

// grab emails 
$emails = imap_search($inbox, 'ALL');

//if emails are returned, cycle through each... 
if ($emails) {

    rsort($emails);

    foreach ($emails as $email_number) {

        // get information specific to this email
        $headers = imap_fetch_overview($inbox, $email_number, 0);

        $message = imap_fetchbody($inbox, $email_number, '1');
        $submessage = substr($message, 0, 700);
        $finalMessage = trim(quoted_printable_decode($submessage));

        $realmessage = strip_tags($finalMessage);
        $real = substr($realmessage, 0, 17);

        if ($real == 'Incoming - MPAMBA') {

        //grab amount and reference number from email 
        preg_match_all('#Amt:([ 0-9,.]*)#is', $finalMessage, $matches);
        preg_match_all('#Amount:([ 0-9,.]*)#is', $finalMessage, $match); // change "#Amount" to "AMT" if you want to capture agent payments
        preg_match_all('#Ref:(.*)Bal#is', $finalMessage, $matchRef);

        foreach ($matchRef[1] as $output) {
            $reference1 = strip_tags($output); //remove white spaces
            $reference = trim($reference1);
        }

        if (!empty($matches)) {
            foreach ($matches[1] as $output2) {
                $amount = ($output2);
            }
        } 
        if (!empty($match)) {
            foreach ($match[1] as $output2) {
                $amount = ($output2);
            }
        }

        $payment = new PaymentContr();
        $row = $payment->checkPayment($reference);

        if (empty($row)) {
            $payment->uploadPayment($reference, $amount);
        }
        }
    }
}

imap_close($inbox);
