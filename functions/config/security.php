<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:17 AM
 */

include 'vendor/autoload.php';

$factory = new RandomLib\Factory;
$generator = $factory->getHighStrengthGenerator();
$randomString = $generator->generateString(32,'abcdefghijklmnopqrstuvwxyz');
$session_factory = new \Aura\Session\SessionFactory;
// assume $response is a framework response object.
// this will be used to delete the session cookie.

$session = $session_factory->newInstance($_COOKIE);
$session->setCookieParams(array('lifetime' => '1209600'));
$session->regenerateId();
$unsafe = $_SERVER['REQUEST_METHOD'] == 'POST'
    || $_SERVER['REQUEST_METHOD'] == 'PUT'
    || $_SERVER['REQUEST_METHOD'] == 'DELETE';