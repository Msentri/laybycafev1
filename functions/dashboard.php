<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 9/6/2016
 * Time: 3:21 PM
 */

if(@$roleSession!='branch' or @$roleSession!='instore') {

    if(isset($_POST['searchLayby'])){

        $dataLaybys = array(
            'merchant_id' => $consumerID,
            'search' => @$_POST['search']
        );

        $MerchantResult = $api->get("/merchants/laybys",$dataLaybys);


    }

    $wallet = $api->get("/consumers/$consumerID/wallet");

    if(@$MerchantResult!=Null){}else{

    if ($roleSession == 'consumer') {

        $user = ['consumer_id'=>$consumerID];

        $resultLaybys = $api->get("/laybys",$user);

        $walletData = json_decode($wallet->response);

        $walletBalance = @$walletData->amount;
        $useWallet = @$walletData->useWallet;
        $walletID = @$walletData->consumer_id;

        $jsonData = json_decode($resultLaybys->response);




        $instalment = 0;
        $Firstdeposit = 0;
        $pay_now_amount =0;
        $outstandingPayment =0;

        if($jsonData == null){

        }else {
            foreach ($jsonData->laybys as $l => $data) {

            }

            require 'laybys/proccessing.php';
            require 'laybys/awaiting_dep.php';
            require 'laybys/cancelled.php';

            $outstandingPayment = $processingAmount+$awaitingAmount;


            $laybyDataFormat = [@$processing_data,@$awaiting_data];

            $consumer_laybys = [
                'processing'=>@$laybyDataFormat,
            ];

        }
        $consumers = $api->get("/consumers/$consumerID");
        $getRole = json_decode($consumers->response);

//$getRole->role;


    }

    //gets merchant Data//
    else
    {

        $dataLaybys = array(
            'merchant_id' => $consumerID,
            'search' => ''
        );

        $MerchantResult = $api->get("/merchants/laybys",$dataLaybys);


        if($roleSession == 'merchant'){

        $stores = $api->get("/merchants/$consumerID/stores");

        $storeError = json_decode($stores->response);
        }
        else{
            $stores = $api->get("/merchants/$merchant_Session/stores");

            $storeError = json_decode($stores->response);
        }

        $storeErrorCode = @$storeError->code;


    }
}
}
else{
    if(@$roleSession!='branch'){

        if(isset($_POST['searchLayby'])){

            $value = $_POST['search'];
            $data = array(
                'search' => $value,
                'branch_name' => $_SESSION['branchName_Session']
            );

            //var_dump($data);
            $getLaybys = $api->get("/braches/laybys", $data);

        }


    }

}
if(@$roleSession=='instore'){
    if(isset($_POST['searchLayby'])){

        $value = $_POST['search'];
        $data = array(
            'search' => $value,
            'role' => $roleSession,
            'branch_name' => $_SESSION['branchName_Session']
        );

        $getLaybys = $api->get("/braches/laybys", $data);

    }else{

        $data = array(
            'role' => $roleSession,
            'branch_name' => @$_SESSION['branchName_Session']
        );
        $getLaybys = $api->get("/braches/laybys", $data);
    }

}
elseif($roleSession=='branch'){
    if(isset($_POST['searchLayby'])){

        $value = $_POST['search'];
        $data = array(
            'search' => $value,
            'role' => $roleSession,
            'branch_name' => $_SESSION['branchName_Session']
        );

        $getLaybys = $api->get("/braches/laybys", $data);

    }
}

?>