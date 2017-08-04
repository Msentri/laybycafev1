<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/10/17
 * Time: 11:05 AM
 */

require("Fnb.php");

$fnb = new Fnb\Fnb(
    array(
        'username' => 'soxitosakhile',
        'password' => 'S@khile19891109',
        'verbose' => false,
        'write' => false
    )
);

$fnb->pull();

print "<pre>"; print_r($r); print "</pre>";