<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';

//Consumer Laybys//
if($roleSession=='consumer') {

    $oneUserLayby = json_decode($result->response);

    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $total = count($jsonDataConsumer); //total items in array
    $limit = 10; //per page
    $totalPages = ceil($total / $limit); //calculate total pages
    $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
    $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
    $offset = ($page - 1) * $limit;
    if ($offset < 0) $offset = 0;
    if(@$jsonDataConsumer->code != '502' and $jsonDataConsumer!=null){
        $menuItems = array_slice($jsonDataConsumer, $offset, $limit);

        foreach ($menuItems as $key => $data) {

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['store_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['collection_code'] = filter_var(@$data->collection_code, FILTER_SANITIZE_STRING);


            if (@$layby_data['status'] == 'completed') {
                $tableInprocess = '
    <tr>

                                                <td><strong><a href="transactions?id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . date("j M Y", strtotime(@$layby_data["createdAt"])) . '</a></strong></td>
                                                <td><a href="transactions?id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . @$layby_data["store_name"] . '</td>
                                                 <td>' .@$layby_data["product_ref"]. '</td>
                                                 <td>' .@$layby_data["collection_code"] . '</td>
                                                <td>R' . @$layby_data["price"] . '</td>
                                          </tr>

';
                print_r($tableInprocess);
            }


        }
    }
}

