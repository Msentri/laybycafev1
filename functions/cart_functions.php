<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/03/08
 * Time: 3:26 PM
 */

$walletID = $consumerID;
if(isset($_POST['useWallet'])){

    $useWallet = $_POST['useWallet'];

    $data = array(
        'wallet_id' => $walletID,
        'useWallet' => $useWallet
    );

    $useWallet = $api->put("/consumers/wallet/$walletID&$useWallet");

}
// Dont use wallet post//

if(isset($_POST['dontUseWallet'])){

    $walletID = $_POST['walletId'];
    $useWallet = $_POST['dontUseWallet'];

    $data = array(
        'wallet_id' => $walletID,
        'useWallet' => $useWallet
    );



    $dontUseWallet = $api->put("/consumers/wallet/$walletID&$useWallet");

    $jsonData = json_decode($dontUseWallet->response);



    $walletStatus = $jsonData->message;

}
//use wallet post//

if(isset($_POST['canPay'])){

    $canPay = $_POST['canPay'];

    $oderId= $_POST['oderId'];

    if($canPay==1){

        $dataPay = [
            'consumer_id'=>$consumerID,
            'layby_ref'=>$oderId,
            'canPay'=>$canPay,
        ];

        $Pay = $api->get("consumers/laybys/canPay",$dataPay);

        $responceMessage = json_decode($Pay->response);


    }
}

if(isset($_POST['canNotPay'])){

    $canPay = $_POST['canNotPay'];
    $oderId= $_POST['oderId'];

    if(@$canNotPay==0){
        $dataPay = [
            'consumer_id'=>$consumerID,
            'layby_ref'=>$oderId,
            'canPay'=>$canPay,
        ];

        $Pay = $api->get("consumers/laybys/canPay",$dataPay);
        $responceMessage = json_decode($Pay->response);
    }
}

if(isset($_POST['payNow'])){

    $walletid = $consumerID;

    $amount= $_POST['amount'];

    $wallet = $api->get("/consumers/$walletid/wallet");

    $walletData = json_decode($wallet->response);

    $walletBalance = @$walletData->amount;

    $walletBalance= $_POST['walletBalance'];
    $Itembalance= $_POST['balance'];

    $transaction_type= $_POST['transaction_type'];

    $data = array(
        'walletid' => $walletid,
        'walletBalance' => $walletData->amount,
        'balance' => $Itembalance,
        'transaction_type' => $transaction_type,
        'amount' => $amount
    );

    $payNowCall = $api->post("/payment", $data);

    $dataPaynow = json_decode($payNowCall->response);


}