<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/25
 * Time: 2:00 PM
 */
//Gets Profile//

$user = @$api->get("/profile/@$merchant_id");

$ConsumerInfo = json_decode(@$user->response);

foreach($ConsumerInfo as $key=>$data){

    $layby_data = [];

    $first_name = $layby_data['first_name'] = filter_var(@$data->first_name, FILTER_SANITIZE_STRING);

    $last_name = $layby_data['last_name'] = filter_var(@$data->last_name, FILTER_SANITIZE_STRING);

    $email = $layby_data['email'] = filter_var(@$data->email, FILTER_SANITIZE_STRING);

    $cellNo = $layby_data['cellNo'] = filter_var(@$data->cellNo, FILTER_SANITIZE_STRING);



}