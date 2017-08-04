<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

$consumerID = $_SESSION['userSession'];

$result = $api->get("consumers/laybys/$consumerID");

$jsonData = json_decode($result->response);



foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var(@$data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var(@$data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var(@$data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);

    if(@$layby_data['status']=='pending'){
        $tablePending='
    <tr>

                                                <td>'.@$layby_data["product_ref"].'</td>

                                                <td>
                                                    '.@$layby_data["store_name"].'
                                                 </td>
                                                   <td> '.@$layby_data['product_name'].'</td>
                                        </tr>

';
    print_r(@$tablePending);}

    if(@$layby_data){

        $tableInprocess='
    <tr>

                                                <td>'.@$layby_data["product_name"].'</td>

                                                <td>
                                                    '.@$layby_data["price"].'
                                                 </td>
                                                   <td> '.@$layby_data['status'].'</td>
                                        </tr>

';
    }


}
