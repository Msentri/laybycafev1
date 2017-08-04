<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/19
 * Time: 1:46 PM
 */

if($roleSession == 'merchant'){

    $stores = $api->get("/merchants/$consumerID/stores");

    $storeError = json_decode($stores->response);


    $storeData = json_decode($stores->response);

    foreach($storeData as $key=>$data) {

        $layby_data = [];
        $store_name = $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);

    }
}elseif($roleSession == 'instore'){
    $stores = $api->get("/merchants/$merchant_Session/stores");

    $storeError = json_decode($stores->response);

    $store_name = $storeNameSession;

}

$storeErrorCode = @$storeError->code;

if(isset($_POST['cart'])){

    $customerKey = @$_POST['consumer_id'];
    $sku = @$_POST['sku'];
    $price = $_POST['sum1'];
    $product_ref = @$_POST['order_id'];
    $priceSpecial = 0;
    $deposit = @$_POST['deposit'];
    $instalment = @$_POST['deposit'];
    $std = @$_POST['std'];
    //$Period = $_POST['months'];
    $store = @$_POST['store'];

    // instalment 2 months//
    include 'includes/payment_logic.php';


    $title = 'In-store layby for store - '.$store.'';

    $instoreRef = $product_ref;

    if($roleSession=='branch'){
        $data = Array (
            'consumer_id' => @$customerKey,
            'merchant_id' => @$_SESSION['inStore_Session'],
            'product_ref' => @$instoreRef,
            'product_name' => @$title,
            'sku' => @$sku,
            'price' => @$price,
            'special_price' => @$priceSpecial,
            'period' => @$months,
            'deposit' => @$deposit,
            'instalment' => @$instalment,
            'store_name' => @$store,
            'description' =>@$std
        );
    }else{
        $data = Array (
            'consumer_id' => @$customerKey,
            'merchant_id' => @$consumerID,
            'product_ref' => @$instoreRef,
            'product_name' => @$title,
            'sku' => @$sku,
            'price' => @$price,
            'special_price' => @$priceSpecial,
            'period' => @$months,
            'deposit' => @$deposit,
            'instalment' => @$instalment,
            'store_name' => @$store,
            'description' =>@$std
        );
    }

    if($price >= '550'){
        $result = $api->post("merchant/laybys",$data);
    }




    $message = json_decode($result->response);

    //$errorCode = @$message->code;


    // include 'send_email.php';
    //include 'functions/za-send_sms.php';
}
