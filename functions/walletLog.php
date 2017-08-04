<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';
$deduct = 0;
if($roleSession=='consumer'){

    $result = $api->get("/consumers/$consumerID/walletlog");
    $consumerWalletLog = json_decode($result->response);
    
        $page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
    $total = count(@$consumerWalletLog ); //total items in array
    $limit = 30; //per page
    $totalPages = ceil( $total/ $limit ); //calculate total pages
    $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
    $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
    $offset = ($page - 1) * $limit;
    if( $offset < 0 ) $offset = 0;

    if(@$consumerWalletLog!=null){
        
    $menuItems = array_slice(@$consumerWalletLog, @$offset, @$limit );

    foreach($menuItems as $key=>$data){

        $log_data = [];
        $log_data['transaction_type'] = filter_var(@$data->transaction_type, FILTER_SANITIZE_STRING);
        $log_data['log_info'] = filter_var(@$data->log_info, FILTER_SANITIZE_STRING);
        $log_data['amount'] = filter_var(@$data->amount, FILTER_SANITIZE_STRING);
        $log_data['available'] = filter_var(@$data->available, FILTER_SANITIZE_STRING);
        $log_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
        $log_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);


        if(@$log_data['transaction_type']!=Null){
            $tableInprocess='
    <tr>


                                                    <td>'.$log_data["log_info"].' </td>
                                                  <td>'.@$log_data["transaction_type"].'</td>
                                                  <td>R'.round(@$log_data["amount"]).' </td>
                                                    <td>R'.round(@$log_data["balance"]).' </td>
                                            <td><strong>'.date("j M Y", strtotime(@$log_data["createdAt"])).'</td>
                                             </tr>

';
    print_r($tableInprocess);
    }


}
}}
else{

    $result = $api->get("/payments/$consumer_id&$transaction_id");
    $jsonDataMerchant = json_decode($result->response);


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


                                                    <td>'.$log_data["log_info"].' </td>
                                                  <td>'.@$log_data["transaction_type"].'</td>
                                                  <td>R'.round(@$log_data["amount"]).' </td>
                                                    <td>R'.round(@$log_data["balance"]).' </td>
                                                  <td>R'.round(@$log_data['available']).' </td>
                                            <td><strong>'.date("j M Y", strtotime(@$log_data["createdAt"])).'</td>
                                             </tr>

';
            print_r($tableInprocess);
        }


    }
}

