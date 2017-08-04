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
$email_username = 'absa@laybycafe.co.za';
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
$emails = imap_search($inbox, 'UNSEEN SINCE "'.$date.'"', SE_UID);



if ($emails)
  foreach($emails as $e) {
    $msgno = imap_msgno($inbox, $e);
    $header = imap_headerinfo($inbox, $msgno);


    $mid = md5($header->subject.$header->date.$header->MailDate);
   

    $pos = true;

   if ($pos !== false) {
        $body = getBody($e, $inbox);
        
      $transaction_key = $_GET['transaction_id'];
		$transaction = mysql_query("SELECT * FROM transaction WHERE transaction_key='$transaction_key' ORDER BY id DESC LIMIT 1");
		$numrows = mysql_num_rows($transaction);
 		  if ($numrows > 0) {
    		while ($row = mysql_fetch_assoc($transaction)) {
			  $user_reference = $row['reference_number'];	
			}
		  }
		  
		//Check if the current users reference number is in the email
		if (strpos($body, $user_reference) !== false) {
		
        preg_match_all("/R(\d+[.]?\d+)/", $body, $output_array);
        $amount = $output_array[1][0];
       
		preg_match_all("/\bLB(.+?)\b./", $body, $output_array);
        $reference = strtoupper("LB".$output_array[1][0]);
		
		//Please find this reference first or else simply discard the transaction
		$transaction = mysql_query("SELECT * FROM transaction WHERE reference_number='$reference'");
			$numrows = mysql_num_rows($transaction);
 		  		if ($numrows == 0) {
		  			imap_clearflag_full($inbox, $msgno, "\\Seen"); 
					header ("Location: /complete/".$_GET['transaction_id']);
		  		}	
		
		
		
		$balance = payment_balance($reference) + $amount;
		//This is a valid payment - register it into the DB
		mysql_query("INSERT INTO payment VALUES ('', '$reference', 'Payment Received', 'ABSA Bank', '', '$amount', '$balance','$time')");
		$payment_id = mysql_insert_id();
		
		//Check the payments balance
		$balance = payment_balance($reference);
		
		//Check if this Reference number and Amount match any pending transaction
		$transaction = mysql_query("SELECT * FROM transaction WHERE reference_number='$reference' AND deposit_amount<='$balance' ORDER BY id DESC LIMIT 1");
		$numrows = mysql_num_rows($transaction);
 		  if ($numrows > 0) {
    		while ($row = mysql_fetch_assoc($transaction)) {
			  $transaction_id = $row['id'];	
			  $merchant_id = $row['merchant_id'];
              $transaction_key = $row['transaction_key'];
			  $total_amount = $row['amount'];
			  $order_id = $row['order_id'];
			  $description = $row['description'];
			  $product_description = $row['sku'];
			  $time = $row['time'];
			  }
		
			  $deposit_amount = deposit_amount($total_amount);
			  $installment_amount = installment_amount($total_amount, $merchant_id);
				
			  //surplus($amount, $reference, $deposit_amount);
			 
			  //Register the layby
  			  mysql_query("INSERT INTO layby VALUES (
													  '', 
													  '$reference', 
													  '$merchant_id', 
													  '$transaction_id', 
													  '$order_id', 
													  '$description',
													  '$product_description', 
													  '$total_amount', 
													  '$deposit_amount', 
													  '$installment_amount', 
													  '0', 
													  '', 
													  '$time')");  
			  
			  $layby_id = mysql_insert_id();

			  mysql_query("UPDATE transaction SET process_code='1' WHERE id ='$transaction_id'");	
			  
			  
			  
			  //Retrieve Merchant Details
			  
			  $merchant_details = mysql_query("SELECT * FROM merchant WHERE id='$merchant_id' LIMIT 1");
				$numrows = mysql_num_rows($merchant_details);
 		 		 if ($numrows > 0) {
    				while ($row = mysql_fetch_assoc($merchant_details)) {
			 			 $merchant_name = $row['merchant_name'];
						 $merchant_email = $row['email'];
			  			}
					}
			  
			  
			  //Retrieve Buyer Details
			  $buyer_details = mysql_query("SELECT * FROM buyer WHERE reference_number='$reference' LIMIT 1");
				$numrows = mysql_num_rows($buyer_details);
 		 		 if ($numrows > 0) {
    				while ($row = mysql_fetch_assoc($buyer_details)) {
			 			 $buyer_name = $row['first_name']." ".$row['last_name'];
						 $buyer_email = $row['email'];
			  			}
					}

			  
			  //Register the transaction in accounts
			  mysql_query("INSERT INTO account VALUES (	'', 
														  '$reference', 
														  '$merchant_id', 
														  '$layby_id',
														  '0',
														  '$description', 
														  '0', 
														  '0', 
														  '$total_amount', 
														  '$time')");
			  
			  
			  //Prepare to make a deposit payment
			  $payment_description = "Deposit Paid * ".$description;
			  $new_balance = payment_balance($reference) - $deposit_amount;
			  mysql_query("INSERT INTO payment VALUES ('', '$reference', '$payment_description', '', '$deposit_amount', '0', '$new_balance','$time')");
			  $payment_id = mysql_insert_id();
			  
			  //Prepare to make a account deposit
			  $deposit_description = "Deposit Paid * ".$description;
			  $layby_balance  = layby_balance($layby_id) - $amount;
			  mysql_query("INSERT INTO account VALUES (	'', 
														  '$reference', 
														  '$merchant_id', 
														  '$layby_id',
														  '$payment_id',
														  '$deposit_description', 
														  '$deposit_amount', 
														  '', 
														  '$layby_balance', 
														  '$time')");
		
			//Send an email to the customer telling them that the deposit has been paid
			$to = $buyer_email;

			$subject = 'A deposit for '.$description.' has been received';

			$headers = "From: Layby Cafe <support@laybycafe.co.za>\r\n";
			$headers .= "Reply-To: support@laybycafe.co.za\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			
			$body_message ='Hi '.$buyer_name.',</p>
					  <p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">This serves as a confirmation that we have received a deposit for the order you have made with '.$merchant_name.' through Layby Cafe with the following information:</p>
						<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">&nbsp;</p>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;"><hr/>&nbsp;
					<table border="0">
					  <tr>
					    <td width="212"><strong>Recipient</strong></td>
					    <td width="389">'.$merchant_name.'</td>
				      </tr>
					  <tr>
					    <td><strong>Description</strong></td>
					    <td>'.$description.'</td>
				      </tr>
					  <tr>
					    <td><strong>Total Amount</strong></td>
					    <td>R '.$total_amount.'</td>
				      </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
				      </tr>
					  <tr>
					    <td><strong>Amount Paid (Deposit)</strong></td>
					    <td>R '.$amount.'</td>
				      </tr>
				    </table>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;"><hr/>&nbsp;</p>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">'.$merchant_name.' now has your order on lay-by; Continue making installments with the reference number <strong>'.strtoupper($reference).'</strong> to ensure that all your payments are captured correctly. ';
					
			$message = email_notification($body_message);
			mail($to, $subject, $message, $headers);
			
			$body_message = 'Hi,</p>
					  <p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">This serves as a confirmation that we have received a deposit for an order that has been  made with '.$merchant_name.' through Layby Cafe with the following information:</p>
						<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">&nbsp;</p>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;"><hr/>&nbsp;
					<table border="0">
					  <tr>
					    <td width="212"><strong>Recipient</strong></td>
					    <td width="389">'.$merchant_name.'</td>
				      </tr>
					  <tr>
					    <td><strong>Description</strong></td>
					    <td>'.$description.'</td>
				      </tr>
					  <tr>
					    <td><strong>Total Amount</strong></td>
					    <td>R '.$total_amount.'</td>
				      </tr>
				    </table>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;"><hr/>&nbsp;</p>
					<p style="margin:0px;padding:0px;color:#7b8392;font-size:14px;line-height:18px;">This simply means the customer has paid a deposit towards this order and they will continue making installment payments towards the order until they pay the full amount. Only release goods when we inform you that the order has been fully paid off.';
					
					
					$message = email_notification($body_message);
					mail($merchant_email, $subject, $message, $headers);
		  } 
		  else 
		  {
			imap_clearflag_full($inbox, $msgno, "\\Seen");  
		  }
		  } 
				  else 
				  {
					imap_clearflag_full($inbox, $msgno, "\\Seen");  
				  }
		
        //imap_mail_move($inbox, $e, 'INBOX.Archive', CP_UID);
    }
  }

imap_close($inbox, CL_EXPUNGE);
header ("Location: /complete/".$_GET['transaction_id']);
?>
