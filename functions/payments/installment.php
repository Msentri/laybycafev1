<?php 
session_start();
ob_start();
require_once("../connect.php");
require_once("../functions.php");

$time = time();

	  $onlayby = mysql_query("SELECT * FROM layby WHERE status='0' ORDER BY id DESC");
		$numrows = mysql_num_rows($onlayby);
 		  if ($numrows > 0) {
    		while ($row = mysql_fetch_assoc($onlayby)) {
			  $layby_id = $row['id'];
			  $merchant_id = $row['merchant_id'];
			  $reference_number	 = $row['reference_number'];
			  $total_amount	 = $row['total_amount'];
			  $installment_amount	 = $row['installment_amount'];
			  $description	 = $row['description'];
			  
			  $balance = payment_balance($reference_number);
			  
			  if ($installment_amount <= $balance) {
				  //Descrease the balance in the payments
				  $payment_description = "Installment * ".$description;
				  $new_balance = payment_balance($reference_number) - $installment_amount;
				  mysql_query("INSERT INTO payment VALUES ('', '$reference_number', '$payment_description', '', '$installment_amount', '0', '$new_balance','$time')");
				  $payment_id = mysql_insert_id();
				  
				  //Credit the transaction into the payment/accounts
				 $account_description = "Installment * ".$description;
			  	 $layby_balance  = layby_balance($layby_id) - $installment_amount;
			  	 mysql_query("INSERT INTO account VALUES ('', 
														  '$reference_number', 
														  '$merchant_id', 
														  '$layby_id',
														  '$payment_id',
														  '$account_description', 
														  '$installment_amount', 
														  '', 
														  '$layby_balance', 
														  '$time')");
														  
				  $account_id = mysql_insert_id();
				
				if ($layby_balance <= 0) {
						mysql_query("UPDATE account SET balance ='00.00' WHERE  id ='$account_id'");
						mysql_query("UPDATE layby SET status ='1' WHERE id ='$layby_id'");
				}
		
				  
				  }
			  
			  }
			}

?>