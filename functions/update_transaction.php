<?php
/**
 * Created by PhpStorm.
 * User: Sandile
 * Date: 2017/07/19
 * Time: 1:22 PM
 */
if(isset($_POST['cancelLayby'])) {

    $amount = $_POST['refund'];
    $ismerchant = $_POST['ismerchant'];
    $cancelLayby = $api->put("/consumers/$consumer_id/cancel/$transaction_id/ismerchant/$ismerchant/amount/$amount");

    $getCancellation = json_decode($cancelLayby->response);


}

if(isset($_POST['forwardPayemnt'])) {

    $amount = $_POST['forwardAmount'];

    $pushData = array(
        'product_ref' => $transaction_id,
        'consumer_id' => $consumerID,
        'pay_now_amount' => $amount
    );

    $resultForwardPayment = $api->post("/payment/push",$pushData);

    $forwardPaymentResponds = json_decode($resultForwardPayment->response);

    $fail_message = $forwardPaymentResponds->message;

//    echo '<pre>';
//    var_dump($forwardPaymentResponds);
//    echo '</pre>';


}
$cancelCode = @$getCancellation->code;

if(isset($_POST['cancelLayby'])) {

    $product_ref = $_POST['product_ref'];
    $amount = $_POST['refund'];
    $ismerchant = $_POST['ismerchant'];
    $message = @$_POST['cancelMessage'];

    $data = Array (
        'consumer_id' => @$consumer_id,
        'merchant_id' => @$consumerID,
        'product_ref' => @$product_ref,
        'refund' => @$amount,
        'message' => @$message,
    );

    if(@$ismerchant!='0'){


        $results = $api ->post("/merchant/cancel/message",$data);


    }else{

        $results = $api ->post("/consumer/cancel/message",$data);



    }

}

if($roleSession=='consumer'){


//$result = $api->get("/consumers/onelayby/$consumer_id&$transaction_id");}else{
    $result = $api->get("/consumers/$consumer_id/laybys/");


}
else
{
    //Gets Profile//

    $user = $api->get("/profile/$consumer_id");

    $ConsumerInfo = json_decode($user->response);


    foreach($ConsumerInfo as $key=>$data){

        $layby_data = [];
        $first_name = $layby_data['first_name'] = filter_var(@$data->first_name, FILTER_SANITIZE_STRING);
        $last_name = $layby_data['last_name'] = filter_var(@$data->last_name, FILTER_SANITIZE_STRING);
        $email = $layby_data['email'] = filter_var(@$data->email, FILTER_SANITIZE_STRING);
        $cellNo = $layby_data['cellNo'] = filter_var(@$data->cellNo, FILTER_SANITIZE_STRING);

    }

    $result = $api->get("/consumers/onelayby/$consumer_id&$transaction_id");
}