<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/25
 * Time: 11:07 AM
 */

$cancelled = $jsonData->laybys->cancelled;

if(@$cancelled!="No laybys"){

    $cancelled_data = [];

    foreach ($cancelled as $i =>$cancelled_laybys){
        $cancelled_data[]=$cancelled_laybys;
        $cancelled_data['status'] = filter_var(@$cancelled_laybys->status, FILTER_SANITIZE_STRING);
        $cancelled_data['instalment'] = filter_var(@$cancelled_laybys->instalment, FILTER_SANITIZE_STRING);
        $cancelled_data['canPay'] = filter_var(@$cancelled_laybys->canPay, FILTER_SANITIZE_STRING);
        $cancelled_data['depositMade'] = filter_var(@$cancelled_laybys->depositMade, FILTER_SANITIZE_STRING);
        $cancelled_data['deposit'] = filter_var(@$cancelled_laybys->deposit, FILTER_SANITIZE_STRING);
        $cancelled_data['pay_now'] = filter_var(@$cancelled_laybys->pay_now, FILTER_SANITIZE_STRING);
        $cancelled_data['pay_now_amount'] = filter_var(@$cancelled_laybys->pay_now_amount, FILTER_SANITIZE_STRING);

    }
}


