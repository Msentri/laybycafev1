<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';

function nextPayment($date_to_pay)
{
    if(empty($date_to_pay)) {
        return "No date provided";
    }

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date_to_pay);

    // check validity of date
    if(empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {
        $difference     = $now - $unix_date;
        $tense         = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}
//Consumer Laybys//

if (@$roleSession=='merchant'){

    //Merchant Instore Laybys//

    //var_dump($MerchantResult);
    $oneUserLayby = json_decode($MerchantResult->response);

    if(@$oneUserLayby->data->main_branch!=null) {

        $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = count($oneUserLayby->data->main_branch); //total items in array
        $limit = 40; //per page
        $totalPages = ceil($total / $limit); //calculate total pages
        $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
        $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
        $offset = ($page - 1) * $limit;
        if ($offset < 0) $offset = 0;

        if (@$oneUserLayby->code != '502' and $oneUserLayby != null) {
            arsort($oneUserLayby->data->main_branch);
            $main_branchMenuItems = array_slice(@$oneUserLayby->data->main_branch, $offset, $limit);
            //var_dump($oneUserLayby->data->main_branch);
            foreach (@$main_branchMenuItems as $key => $data) {

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
                $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);
                $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
                $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
                $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
                $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
                $date_to_pay = $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
                $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);
                $layby_data['lastPayment_verified'] = filter_var(@$data->lastPayment_verified, FILTER_SANITIZE_STRING);


                if ($layby_data['status'] != 'cancelled' and $layby_data['depositMade'] != 'No') {

                    $LaybysBalance += $layby_data["balance"];
                    $LaybysAmount += $layby_data["price"];

                }

                $BalanceHeld = $LaybysAmount - $LaybysBalance;

                $nextPayment = nextPayment($date_to_pay);

                $fee = round(@$layby_data["price"] * 0.035);

                if ($layby_data['status'] == "complete") {

                    $completeLaybysAmount += $layby_data["price"];
                }

                if ($nextPayment != 'Bad date') {

                    $payMonth = '<strong>' . date("M", strtotime(@$date_to_pay)) . '</strong>';
                } else {

                }
                if (@$layby_data['status'] == 'inprocess' and $layby_data['depositMade'] != 'No') {
                    $tableInprocess = '
                                             <tr>
                                               <td><strong><a href="transactions?id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . date("j M Y", strtotime(@$layby_data["createdAt"])) . '</a></strong></td>
                                                <td>' . @$layby_data['product_ref'] . '</td>
                                                 <td>' . @$layby_data["store_name"] . '</td>
                                                 <td>R' . round(@$layby_data["price"]) . '</td>
                                             
                                             </tr>

';
                    print_r($tableInprocess);
                }


            }

        }


    }


}
