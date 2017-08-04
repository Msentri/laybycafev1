<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

if(isset($_POST['canPay'])){

    $canPay = $_POST['canPay'];

    $oderId= $_POST['oderId'];

    if($canPay==1){

        $Pay = $api->put("consumers/laybys/$oderId&$canPay");
        $responceMessage = json_decode($Pay->response);

    }
}
if(isset($_POST['canNotPay'])){

    $canPay = $_POST['canNotPay'];
    $oderId= $_POST['oderId'];

    if(@$canNotPay==0){

        $Pay = $api->put("consumers/laybys/$oderId&$canPay");
        $responceMessage = json_decode($Pay->response);
    }
}
include 'functions/dashboard.php';
$refOnTopUp = @base64_decode($_GET['topup']);
$amountTopUp = @base64_decode($_GET['amount']);
if($refOnTopUp!=null){
$jsonData = json_decode($result->response);


foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var($data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var($data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var($data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var($data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var($data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var($data->price, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var($data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var($data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var($data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var($data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var($data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var($data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var($data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var($data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['nextPayment'] = filter_var($data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var($data->description, FILTER_SANITIZE_STRING);

    if($layby_data['canPay']=='yes'){
        $products = "<strong>".$layby_data['product_name']."</strong><br/>";

    }
}

}

?>
<section class="page-section">
                <div class="container">
                    <div class="row">

                        <h1>Cart</h1>


                    </div>

<?php

include_once 'includes/banks.php';
$cartOption = '

					                <div class="row">
                  <p>&nbsp;</p>
            <table class="table">
	        <caption></caption>
					  <thead>
						<tr>
						  <th>Description</th>
						  <th><p align="right">Amount</p></th>
						  <th>&nbsp;</th>
						  <th>&nbsp;</th>
					    </tr>
					  </thead>
					  <tbody>
							';?>
							<?php
                            if($refOnTopUp!=null){
                                print_r($paymentOption);
                            }
                            else{
                            print_r($cartOption);}
							include 'functions/viewConsumer_cart.php'
							?>
							</tbody>

						</table>
					</div>
				</div>
			</section>
