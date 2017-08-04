<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';


if(@$roleSession=='consumer'){

    if(@$awaiting_dep!="No laybys" and $awaiting_dep!=null){

    foreach($awaiting_dep as $key=>$data){

        $layby_data = [];
        $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
        $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
        $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
        $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
        $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
        $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
        $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
        $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
        $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
        $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
        $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

        $transactionStatus = 'Awaiting Deposit';

if($data->product_ref == $transaction_id){

    $price = $layby_data['price'];
    $ProductName = $layby_data['product_name'];
    $status = $layby_data['status'];
    $store = $layby_data['store'];

    $dataCancel = array(
        'price'=>$price,
        'product_name'=>$ProductName,
        'status'=>$status,
        'store'=>$store
    );
}

    }
    }
    if(@$processing_data!="No laybys" and $processing!=null){
        foreach($processing as $key=>$data){

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
            $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

            $transactionStatus = 'Processing';

            if($data->product_ref == $transaction_id){

                $price = $layby_data['price'];
                $ProductName = $layby_data['product_name'];
                $status = $layby_data['status'];
                $store = $layby_data['store'];

                $dataCancel = array(
                    'price'=>$price,
                    'product_name'=>$ProductName,
                    'status'=>$status,
                    'store'=>$store
                );
            }

        }
    }
    if(@$cancelled!="No laybys" and $cancelled!=null){
        foreach($cancelled as $key=>$data){

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
            $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

            $transactionStatus = 'Processing';

            if($data->product_ref == $transaction_id){

                $price = $layby_data['price'];
                $ProductName = $layby_data['product_name'];
                $status = $layby_data['status'];
                $store = $layby_data['store'];

                $dataCancel = array(
                    'price'=>$price,
                    'product_name'=>$ProductName,
                    'status'=>$status,
                    'store'=>$store
                );
            }

        }
    }
}

elseif (@$roleSession=='merchant'){

    $user = ['consumer_id'=>$consumer_id];

    $resultConsumeLaybys = $api->get("/laybys",$user);
    $jsonData = json_decode($resultConsumeLaybys->response);

    foreach ($jsonData->laybys as $l => $data) {

    }
    require 'laybys/proccessing.php';
    require 'laybys/awaiting_dep.php';
    require 'laybys/cancelled.php';

    if(@$awaiting_dep!="No laybys" and $awaiting_dep!=null){

        foreach($awaiting_dep as $key=>$data){

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
            $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

            $transactionStatus = 'Awaiting Deposit';

            if($data->product_ref == $transaction_id){

                $price = $layby_data['price'];
                $ProductName = $layby_data['product_name'];
                $status = $layby_data['status'];
                $store = $layby_data['store'];

                $dataCancel = array(
                    'price'=>$price,
                    'product_name'=>$ProductName,
                    'status'=>$status,
                    'store'=>$store
                );
            }

        }
    }
    if(@$processing_data!="No laybys" and $processing!=null){
        foreach($processing as $key=>$data){

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
            $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

            $transactionStatus = 'Processing';

            if($data->product_ref == $transaction_id){

                $price = $layby_data['price'];
                $ProductName = $layby_data['product_name'];
                $status = $layby_data['status'];
                $store = $layby_data['store'];

                $dataCancel = array(
                    'price'=>$price,
                    'product_name'=>$ProductName,
                    'status'=>$status,
                    'store'=>$store
                );
            }

        }
    }
    if(@$cancelled!="No laybys" and $cancelled!=null){
        foreach($cancelled as $key=>$data){

            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $merchant_id = $layby_data['merchant_id'] = filter_var(@$data->merchant_id, FILTER_SANITIZE_STRING);
            $ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['store'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['credit'] = filter_var(@$data->credit, FILTER_SANITIZE_STRING);
            $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
            $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

            $transactionStatus = 'Cancelled';

            if($data->product_ref == $transaction_id){

                $price = $layby_data['price'];
                $ProductName = $layby_data['product_name'];
                $status = $layby_data['status'];
                $store = $layby_data['store'];

                $dataCancel = array(
                    'price'=>$price,
                    'product_name'=>$ProductName,
                    'status'=>$status,
                    'store'=>$store
                );
            }

        }
    }
}
else{
        $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }

                                    setTimeout(\'Redirect()\', 1000);
                                    </script>';

        //print_r($redirect);

}
