<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 9/6/2016
 * Time: 3:21 PM
 */

$merchant = $_SESSION['userSession'];


$db->where ("merchant_id", $merchant);
$bankInfo = $db->getAll ("bank_account");

$bankName = $bankInfo['bank_name'];
$bankAccount = $bankInfo['bank_account'];
$branchCode = $bankInfo['branch_code'];
$branchName = $bankInfo['branch_name'];
$accountHolder = $bankInfo['account_holder'];

//Gets funds//

$db->where ("merchant_id", $merchant);
$funds = $db->getAll ("funds");

$balanceAvailable = $funds['balance_available'];
$balanceRetained = $funds['balance_retained'];
$balanceRetained = $funds['balance_retained'];
$balanceTotal = $funds['balance_total'];
$withdraw_limit_balance = $funds['withdraw_limit_balance'];

$db->where ("merchant_id", $merchant);
$schedule = $db->getAll ("payout_schedule");

$payoutFrequency= $schedule['payout_frequency'];
$minAmount= $schedule['min_amount'];
$payoutDate = date("M j, Y, H:s:i", strtotime($schedule['payout_date']));


?>