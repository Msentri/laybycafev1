<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/11/29
 * Time: 9:25 AM
 */



if(isset($_POST['payNow'])){

    $walletid = $_POST['walletid'];

    $amount= $_POST['amount'];

    $walletBalance= $_POST['walletBalance'];
    $Itembalance= $_POST['balance'];

    $transaction_type= $_POST['transaction_type'];

    $data = array(
        'walletid' => $walletid,
        'walletBalance' => $walletBalance,
        'balance' => $Itembalance,
        'transaction_type' => $transaction_type,
        'amount' => $amount
    );


    $result = $api->post("/payment", $data);

    print_r($result->response);


}
