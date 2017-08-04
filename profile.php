<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */
include 'header.php';
include 'functions/profile.php';
if($roleSession=='consumer'){

    include 'templates/consumer/profileConsumer.tpl';

}
elseif($roleSession=='merchant')
    {
    include 'templates/merchant/profileMerchant.tpl';
}else
    {
    include 'templates/branch/profileBranch.tpl';
}
include_once 'footer.php';
    ?>
