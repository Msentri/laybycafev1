<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:43 AM
 */
require 'config/config.php';


// Password 3D encryption//
$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
$salt = base64_encode($salt);
$salt = str_replace('+', '.', $salt);
$userPassword = md5('123456');
$password3d = crypt($userPassword, '$2y$10$'.$salt.'$');

$data = Array (
    'merchant_id' => $OTP,
    'id_number' => '729778',
    'cell' => '0842110120',
    'tel' => '0119303636',
    'postal_address' => '1448b Mavi Street White City Jabavu 1868',
    'maximum_period' => '12'
    // expires = NOW() + interval 1 year
    // Supported intervals [s]econd, [m]inute, [h]hour, [d]day, [M]onth, [Y]ear
);

$id = $db->insert ('merchant_info', $data);
if ($id)
    echo 'info was updated. Id=' . $id;
else
    echo 'insert failed: ' . $db->getLastError();
?>