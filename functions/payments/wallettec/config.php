<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/10/17
 * Time: 9:07 AM
 */
include "../../../vendor/autoload.php";
$main_key='2e3fea0b-585e-44b3-81f5-17fd2698d5f8';

include "functions/config/config.php";
$api = new OtherCode\Rest\Rest();
$api->configuration->url = "https://api.wallettec.com:443/integrate";
$api->setDecoder("json");
//$response = $api->get("/rest/payment/v2");
//$response = $api->get("/rest/general/2e3fea0b-585e-44b3-81f5-17fd2698d5f8/query/174830");
$wallets = $api->get("/rest/payment/v2/'.$main_key.'/active/wallets");
//$ping = $api->get("/rest/general/ping");

if ($api->getError()->hasError() !== 0) {
    echo $api->getError()->message;
}

//$ping->body->date;
//$ping->body->descr;
print_r($wallets);
?>