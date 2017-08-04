<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */
$LaybysAmount = 0;
$LaybysBalance = 0;
$BalanceHeld = 0;
$completeLaybysAmount = 0;


include 'header.php';

include 'functions/dashboard.php';

if($roleSession=='consumer'){
    include 'templates/consumer/consumerDashboard.tpl';
}
elseif($roleSession=='merchant') {
    include 'templates/merchant/merchantDashboard.tpl';
}elseif($roleSession=='instore'){

    include 'templates/branch/admin/instoreDash.tpl';
}else{
    include 'templates/branch/branchDashboard.tpl';
}
include_once 'footer.php';
?>