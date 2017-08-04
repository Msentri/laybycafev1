<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';

//Consumer Laybys//
if($roleSession=='consumer'){

    if(@$awaiting_dep!= 'No laybys') {

        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = count($awaiting_dep); //total items in array
        $limit = 20; //per page
        $totalPages = ceil($total / $limit); //calculate total pages
        $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
        $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
        $offset = ($page - 1) * $limit;
        if ($offset < 0) $offset = 0;

        if (@$jsonDataConsumer->code != '502' and $jsonDataConsumer != null) {
            $menuItems = array_slice($awaiting_dep, $offset, $limit);

            foreach ($menuItems as $key => $data) {


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
                $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
                $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);
                $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
                $date_to_pay = $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
                $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);
                $layby_data['lastPayment_verified'] = filter_var(@$data->lastPayment_verified, FILTER_SANITIZE_STRING);

                $nextPayment = nextPayment($date_to_pay);

                if ($nextPayment != 'Bad date') {

                    $payMonth = '<strong>' . date("M", strtotime(@$date_to_pay)) . '</strong>';
                } else {

                    $payMonth = '<strong>Please Pay Deposit</strong>';
                }
                if (@$layby_data['status'] == 'inprocess' and $layby_data['depositMade'] == 'No') {
                    $tableInprocess = '
    <tr>

                                                <td><strong><a href="transactions?status=awaiting_dep&id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . date("j M Y", strtotime(@$layby_data["createdAt"])) . '</a></strong></td>
                                                <td><a href="transactions?status=awaiting_dep&id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . @$layby_data["store_name"] . '</td>
                                                <td>' . @$layby_data["product_ref"] . '</td>
                                                 <td>R' . round(@$layby_data["deposit"]) . '</td>
                                                <td>R' . @$layby_data["price"] . '</td>
                                          </tr>

';
                    print_r($tableInprocess);
                }


            }
        }
    }
}

