<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';
$deduct = 0;
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

if($roleSession=='consumer'){

    $result = $api->get("/payments/$consumer_id&$transaction_id");
    $jsonDataMerchant = json_decode($result->response);
if($jsonDataMerchant!=null){

    foreach($jsonDataMerchant as $key=>$data){


        $layby_data = [];
        $layby_data['transaction_id'] = filter_var(@$data->transaction_id, FILTER_SANITIZE_STRING);
        $layby_data['details'] = filter_var(@$data->details, FILTER_SANITIZE_STRING);
        $deduct += $layby_data['debit'] = filter_var(@$data->debit, FILTER_SANITIZE_STRING);
        $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
        $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
        $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);

        if(@$layby_data['transaction_id']!=Null){
            $tableInprocess='
    <tr>

                                                <td><strong>'.date("j M Y", strtotime(@$layby_data["createdAt"])).'</td>
                                                  <td>'.@$layby_data["details"].'</td>
                                                    <td>R'.round(@$layby_data["debit"]).' </td>
                                                    <td>R'.round(@$layby_data["credit"]).' </td>
                                                <td>R'.round(@$layby_data["balance"]).' </td>


                                             </tr>

';
    print_r($tableInprocess);
    }


}}}
else{

    $result = $api->get("/payments/$consumer_id&$transaction_id");
    $jsonDataMerchant = json_decode($result->response);


    if($jsonDataMerchant==null){}else{

    foreach($jsonDataMerchant as $key=>$data){

        $layby_data = [];
        $layby_data['transaction_id'] = filter_var(@$data->transaction_id, FILTER_SANITIZE_STRING);
        $layby_data['details'] = filter_var(@$data->details, FILTER_SANITIZE_STRING);
        $deduct += $layby_data['debit'] = filter_var(@$data->debit, FILTER_SANITIZE_STRING);
        $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
        $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
        $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);

        if(@$layby_data['transaction_id']!=Null){
            $tableInprocess='
    <tr>

                                                  <td><strong>'.date("j M Y", strtotime(@$layby_data["createdAt"])).'</td>
                                                  <td>'.@$layby_data["details"].'</td>
                                                    <td>R'.round(@$layby_data["debit"]).' </td>
                                                    <td>R'.round(@$layby_data["credit"]).' </td>
                                                <td>R'.round(@$layby_data["balance"]).' </td>


                                             </tr>

';
            print_r($tableInprocess);
        }


    } }
}

