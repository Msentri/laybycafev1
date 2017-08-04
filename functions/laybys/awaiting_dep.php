<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/25
 * Time: 11:07 AM
 */

$awaiting_dep = $jsonData->laybys->awaiting_dep;
//Processing Laybys with dep-paid//
$instalmentAwaiting = 0;
$pay_now_amountAwaiting = 0;
$awaitingAmount = 0;

if(@$awaiting_dep!="No laybys"){

    $awaiting_data = [];

    foreach ($awaiting_dep as $i =>$awaiting_laybys){
        $awaiting_data[]=$awaiting_laybys;
        $awaiting_data['status'] = filter_var(@$awaiting_laybys->status, FILTER_SANITIZE_STRING);
        $awaiting_data['instalment'] = filter_var(@$awaiting_laybys->instalment, FILTER_SANITIZE_STRING);
        $awaiting_data['canPay'] = filter_var(@$awaiting_laybys->canPay, FILTER_SANITIZE_STRING);
        $awaiting_data['depositMade'] = filter_var(@$awaiting_laybys->depositMade, FILTER_SANITIZE_STRING);
        $awaiting_data['deposit'] = filter_var(@$awaiting_laybys->deposit, FILTER_SANITIZE_STRING);
        $awaiting_data['pay_now'] = filter_var(@$awaiting_laybys->pay_now, FILTER_SANITIZE_STRING);
        $awaiting_data['pay_now_amount'] = filter_var(@$awaiting_laybys->pay_now_amount, FILTER_SANITIZE_STRING);

        if ($awaiting_data['status'] == 'inprocess' and $awaiting_data['canPay']=='1') {
            //checks the amount of can pay laybys//
            if ($awaiting_data['canPay'] == '1' and $awaiting_data['pay_now']!='Yes') {

                $instalmentAwaiting += $awaiting_data['deposit'];

            }
            elseif($awaiting_data['canPay'] == '1' and $awaiting_data['pay_now'] == "Yes") {

                $pay_now_amountAwaiting  += $awaiting_data['pay_now_amount'];
            }else{
                $instalmentAwaiting = 0;
            }


        }

    }
}

$awaitingAmount = $instalmentAwaiting + $pay_now_amountAwaiting;


