<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';



$jsonData = json_decode($result->response);


foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var(@$data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
    $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var(@$data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var(@$data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);

    if(@$layby_data['status']=='processing'){
    $tableInprocess='
    <tr>

                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">LB'.@$layby_data["consumer_id"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.@$layby_data["store_name"].'</a></td>
                                                 <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.@$layby_data["product_name"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.@$layby_data["price"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.@$layby_data["balance"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.@$layby_data["period"].'</a></td>

                                                <td>
                                                    <a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.@$layby_data["product_ref"].'">'.date("M j, Y", strtotime(@$layby_data["lastPayment"])).'</a>
                                                 </td>
                                                   <td> <a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.@$layby_data["product_ref"].'"> '.date("M j", strtotime(@$layby_data["nextPayment"])).'</a></td>
                                        </tr>

';
    print_r($tableInprocess);
    }


}

print_r('</table>
 <table class="table table-striped table-advance table-hover">

 <caption></caption>
                            <thead>
                            <tr ><td  class="btn-black text-center" colspan="8" valign="central"><h6>Completed Laybys</h6></td></tr>
                            <tr>
								<th>Oder Number </th>
                                <th>Store</th>
								<th>Product Name</th>
								<th>Status</th>

							</tr>

');
foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var(@$data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var(@$data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var(@$data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);

if(@$layby_data['status']=='complete'){
    $tableComplete='
    <tr>

                                                <td><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.@$layby_data["product_ref"].'">'.@$layby_data["product_ref"].'</td>
                                                <td>'.@$layby_data["store_name"].'</td>
                                                <td>'.@$layby_data["product_name"].'</td>

                                                   <td>Layby Completed</a></td>
                                        </tr>

';
    print_r($tableComplete);
}
}