<?php
require_once("../connect.php");
$order_id  = $_REQUEST[order_id];
$amount  = ceil($_REQUEST[amount]);

$layby_transaction = mysql_query("SELECT * FROM layby WHERE order_id='$order_id' AND total_amount='$amount' ORDER BY id DESC");
		$numrows = mysql_num_rows($layby_transaction);
 		  if ($numrows > 0) {
    		while ($row = mysql_fetch_assoc($layby_transaction)) {
              $status = $row['status'];
			  }
			  if ($status > 0) {
			  	echo "paid";
			  } else {
			  	echo "layby";
			  }
			} else {
				echo "pending";
			}

?>