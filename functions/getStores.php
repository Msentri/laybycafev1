<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/30
 * Time: 1:09 PM
 */

$storeData = json_decode($stores->response);


foreach($storeData as $key=>$data){

    $layby_data = [];
    $store_name = $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $store_url = $layby_data['store_url'] = filter_var(@$data->store_url, FILTER_SANITIZE_STRING);
    $platform = $layby_data['platform'] = filter_var(@$data->platform, FILTER_SANITIZE_STRING);
    $module = $layby_data['module'] = filter_var(@$data->module, FILTER_SANITIZE_STRING);

}


?>