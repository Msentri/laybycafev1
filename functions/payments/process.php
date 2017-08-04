<?php
require_once("../connect.php");
require_once("../functions.php");
session_start();

$merchant_id  = $_GET['merchant_id'];
$merchant_key  = $_GET['merchant_key'];


//Clearing the amount of Shopping Carts
	$amount = $_GET['amount'];
	
	if ($_GET['shopping_system'] == "bigcommerce") {
		$vowels = array("ZAR", " ", ",", "R");
		$amount = str_replace($vowels, "", $amount);
	} 
	
	if ($_GET['shopping_system'] == "shopify") {
		$amount = $amount/100;
	} 
	
	if ($amount <= 550) {
		echo "ERROR: We can only process transactions above R550 on lay-by. <strong><a href='".$_GET['cancel_url']."'>Return to site!</a></strong>";
		exit;
	}



if (isset($merchant_id) && isset($merchant_key)) {
  //check if the merchant id and key correspond
  	$merchant_details = mysql_query("SELECT * FROM merchant WHERE id='$merchant_id' AND merchant_key='$merchant_key' LIMIT 1");
				$numrows = mysql_num_rows($merchant_details);
 		 		 if ($numrows == 0) {
						echo "ERROR: Please contact Layby Cafe for your merchant credentials. <strong><a href='".$_GET['cancel_url']."'>Return to site!</a></strong>";
						exit;
					}
				} else {
						echo "ERROR: We are unable to pull your merchant credentials. <strong><a href='".$_GET['cancel_url']."'>Return to site!</a></strong>";
						exit;
				}

if ($_GET['is_test'] != "yes") {

$first_name = ucfirst(strtolower($_GET['first_name']));
$last_name = ucfirst(strtolower($_GET['last_name']));
$email_address = $_GET['email_address'];
$cell_number = $_GET['cell_number'];
$shopping_system = $_GET['shopping_system'];

//Clearing the phone number
$remove_character = array(" ", "-",);
$digit_number = str_replace($remove_character, "", $cell_number);
$cell_number = "27".substr($digit_number, -9);

if (strlen($cell_number) != 11) $cell_number = "";

	$order_id  = $_GET['order_id'];
	$description = $_GET['desc'];
	$product_desc = $_GET['sku'];
	
	
	$return_url = $_GET['return_url'];
	$layby_url = $_GET['layby_url'];
	$cancel_url = $_GET['cancel_url'];
	
	$time = time();
	
	$deposit_amount = deposit_amount($amount);


//Check if this user/buyer exits within our database

	$buyer_information = mysql_query("SELECT * FROM buyer WHERE email='$email_address' ORDER BY id DESC LIMIT 1");
		  $numrows = mysql_num_rows($buyer_information);
 		    if ($numrows > 0) {
		      while ($row = mysql_fetch_assoc($buyer_information)) {
                $user_id = $row['id'];
				$reference = $row['reference_number'];
			  }
			  //User found within the database
			  


mysql_query("INSERT INTO transaction VALUES (
														'', 
														'', 
														'$merchant_id', 
														'$order_id', 
														'$description',
														'$product_desc', 
														'$amount',
														'$deposit_amount', 
														'$layby_url',
														'$return_url', 
														'$cancel_url', 
														'$reference', 
														'0',
														'$shopping_system', 
														'$time')");
														
$transaction_id = mysql_insert_id();
			  
	} else {
		
mysql_query("INSERT INTO buyer VALUES (
														'',
														'', 
														'$first_name', 
														'$last_name',
														'0', 
														'$email_address', 
														'$cell_number', 
														'', 
														'',
														'$time')");
$user_id = mysql_insert_id();


$reference = clean(strtoupper(crypt($user_id,'LB')));

	
mysql_query("UPDATE buyer SET reference_number='$reference' WHERE id ='$user_id'");	



mysql_query("INSERT INTO transaction VALUES (
														'', 
														'', 
														'$merchant_id', 
														'$order_id', 
														'$description', 
														'$product_desc',
														'$amount',
														'$deposit_amount', 
														'$layby_url',
														'$return_url', 
														'$cancel_url', 
														'$reference', 
														'0',
														'$shopping_system', 
														'$time')");

$transaction_id = mysql_insert_id();  
 } 


//Generate a
$date = date("d");
$crypt_text = $transaction_id ."-". $day;
$key = clean(strtoupper(crypt($crypt_text,'LB'))); 

mysql_query("UPDATE transaction SET transaction_key='$key' WHERE id ='$transaction_id'");
$_SESSION['user_id'] = $user_id;
$_SESSION['transaction_method'] = 0;

header("Location: /payment/".$key);	}

else 

{
$_SESSION['amount'] = $_GET[amount];
$_SESSION['desc'] = $_GET[desc];
$_SESSION['success_url'] = $_GET[return_url];

header("Location: /test-payment/XXXXXXXXXX");	} 
?>