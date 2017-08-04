<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/25
 * Time: 11:07 AM
 */

$processing = $jsonData->laybys->processing;
//Processing Laybys with dep-paid//
$instalmentProcessing = 0;
$pay_now_amountProcessing = 0;
$processingAmount = 0;
if(@$processing!="No laybys"){
    $processing_data =[];

foreach ($processing as $i =>$processing_laybys){

    $processing_data[]=$processing_laybys;
    $processing_data['status'] = filter_var(@$processing_laybys->status, FILTER_SANITIZE_STRING);
    $processing_data['instalment'] = filter_var(@$processing_laybys->instalment, FILTER_SANITIZE_STRING);
    $processing_data['canPay'] = filter_var(@$processing_laybys->canPay, FILTER_SANITIZE_STRING);
    $processing_data['depositMade'] = filter_var(@$processing_laybys->depositMade, FILTER_SANITIZE_STRING);
    $processing_data['deposit'] = filter_var(@$processing_laybys->deposit, FILTER_SANITIZE_STRING);
    $processing_data['pay_now'] = filter_var(@$processing_laybys->pay_now, FILTER_SANITIZE_STRING);
    $processing_data['pay_now_amount'] = filter_var(@$processing_laybys->pay_now_amount, FILTER_SANITIZE_STRING);

    if ($processing_data['status'] == 'inprocess') {
        //checks the amount of can pay laybys//
        if ($processing_data['canPay'] == '1' and $processing_data['pay_now']!='Yes') {

             $instalmentProcessing += $processing_data['instalment'];

        }
        elseif($processing_data['canPay'] == '1' and $processing_data['pay_now'] == "Yes") {

            $pay_now_amountProcessing  += $processing_data['pay_now_amount'];
        }


    }

}
}

$processingAmount = $instalmentProcessing + $pay_now_amountProcessing;


