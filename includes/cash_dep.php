<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/10
 * Time: 9:34 AM
 */

if(isset($_GET['bank'])){

    //FNB//
    if(@$_GET['bank']=='fnb'){

        $data = array(
            'recipient' => 'Layby Cafe',
            'account' => '62597633843',
            'branch' => '230145',
            'bank' => 'FNB',
            'acc_type' => 'Cheque',
            'reference' => base64_decode($_GET['topup']),
            'amount' => base64_decode($_GET['amount']),
        );
    }
    if(@$_GET['bank']=='capitec'){

        $data = array(
            'recipient' => 'Layby Cafe',
            'account' => '62597633843',
            'branch' => '230145',
            'bank' => 'FNB',
            'acc_type' => 'Cheque',
            'reference' => base64_decode($_GET['topup']),
            'amount' => base64_decode($_GET['amount']),
        );
    }
    if(@$_GET['bank']=='nedbank'){

        $data = array(
            'recipient' => 'Layby Cafe',
            'account' => '62597633843',
            'branch' => '230145',
            'bank' => 'FNB',
            'acc_type' => 'Cheque',
            'reference' => base64_decode($_GET['topup']),
            'amount' => base64_decode($_GET['amount']),
        );
    }
    if(@$_GET['bank']=='standardbank'){

        $data = array(
            'recipient' => 'Layby Cafe',
            'account' => '302155546',
            'branch' => '012645',
            'bank' => 'Standard Bank',
            'acc_type' => 'Current',
            'reference' => base64_decode($_GET['topup']),
            'amount' => base64_decode($_GET['amount']),
        );
    }
    if(@$_GET['bank']=='absa'){

        $data = array(
            'recipient' => 'Layby Cafe',
            'account' => '4089766485',
            'branch' => '632005',
            'bank' => 'ABSA',
            'acc_type' => 'Savings',
            'reference' => base64_decode($_GET['topup']),
            'amount' => base64_decode($_GET['amount']),
        );
    }

    $result = $api->post("/payment/cash",@$data);

    $cashDepRes = json_decode($result->response);
}
