<?php
session_start();
ob_start();
$time = time();
require_once("../connect.php");
require_once("../functions.php");
/* 
if you use GMAIL you need activate IMAP protocol. 
Settings/ Forwarding and POP/IMAP (tab) more 
(https://support.google.com/mail/troubleshooter/1668960?hl=en&ref_topic=3397500)
 */
include 'lib/mailapi.php';

// To install you need to change the parameters of connection to the server
// email details
//$email_hostname = '{imap.gmail.com:993/imap/ssl}INBOX'; // protocol and mail folder

$email_hostname = '{laybycafe.co.za:993/imap/ssl/novalidate-cert}INBOX'; // protocol and mail folder
$email_username = 'standardbank@laybycafe.co.za';
$email_password = 'Willmsela99.';



/*  you can get list of mail folders
$srv = '{sh02-pta.za-dns.com:993/imap/ssl}';
$conn = imap_open($srv, $email_username, $email_password);
$boxes = imap_list($conn, $srv, '*');
print_r($boxes);*/

$inbox = imap_open($email_hostname, $email_username, $email_password) or die('Cannot connect: ' . imap_last_error());

//$emails = imap_search($inbox, 'ALL', SE_UID); // all mails
//$emails = imap_search($inbox, 'UNSEEN SUBJECT "Notify: Payment"', SE_UID); //select mails only with "Notify: Payment" in subject //messages which have not been read yet
$date = strtotime(date('Y-m-d H:i:s') . ' -3 day');
$date = date('j F Y', $date);
$emails = imap_search($inbox, 'UNSEEN', SE_UID);



if ($emails)
  foreach($emails as $e) {
    $msgno = imap_msgno($inbox, $e);
    $header = imap_headerinfo($inbox, $msgno);


    $mid = md5($header->subject.$header->date.$header->MailDate);
   

    $pos = true;
    if ($pos !== false) {
        $body = getBody($e, $inbox);
        
        preg_match_all("/R(\d+[.]?\d+)/", $body, $output_array);
        $amount = $output_array[1][0];
       
        preg_match_all("/\bLB(.+?)\b./", $body, $output_array);
        $reference = strtoupper("LB".$output_array[1][0]);
				
		//imap_setflag_full($inbox, $msgno, "\\Seen \\Flagged", ST_UID);
				  
		 $buyer_details = mysql_query("SELECT * FROM buyer WHERE reference_number='$reference' LIMIT 1");
				$numrows = mysql_num_rows($buyer_details);
 		 		 if ($numrows > 0) {
    				
					$balance = payment_balance($reference) + $amount;
					//This is a valid payment - register it into the DB
					mysql_query("INSERT INTO payment VALUES ('', '$reference', 'Payment Received', 'First National Bank', '', '$amount', '$balance','$time')");
					
					//Check if this Reference number and Amount match any pending transaction
					//imap_clearflag_full($inbox, $msgno, "\\Seen");  
					//imap_mail_move($inbox, $e, 'INBOX.Archive', CP_UID);
		}
         //imap_mail_move($inbox, $e, 'INBOX.Archive', CP_UID);
    }
  }

imap_close($inbox, CL_EXPUNGE);
?>
