<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/05/18
 * Time: 11:23 AM
 */


/**
 * ------------
 * BEGIN CONFIG
 * ------------
 * Edit the configuraion
 */
function base321_decode($b32) {
    $lut = array("A" => 0,       "B" => 1,
        "C" => 2,       "D" => 3,
        "E" => 4,       "F" => 5,
        "G" => 6,       "H" => 7,
        "I" => 8,       "J" => 9,
        "K" => 10,      "L" => 11,
        "M" => 12,      "N" => 13,
        "O" => 14,      "P" => 15,
        "Q" => 16,      "R" => 17,
        "S" => 18,      "T" => 19,
        "U" => 20,      "V" => 21,
        "W" => 22,      "X" => 23,
        "Y" => 24,      "Z" => 25,
        "2" => 26,      "3" => 27,
        "4" => 28,      "5" => 29,
        "6" => 30,      "7" => 31
    );

    $b32    = strtoupper($b32);
    $l      = strlen($b32);
    $n      = 0;
    $j      = 0;
    $binary = "";

    for ($i = 0; $i < $l; $i++) {

        $n = $n << 5;
        $n = $n + $lut[$b32[$i]];
        $j = $j + 5;

        if ($j >= 8) {
            $j = $j - 8;
            $binary .= chr(($n & (0xFF << $j)) >> $j);
        }
    }

    return $binary;
}

function get_timestamp2() {
    return floor(microtime(true)/30);
}


function binary_key2($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$trans = binary_key2();

$binary_key = $trans;

$todayDate = date("i:s");

$binary_timestamp = pack('N*', 0) . pack('N*', $todayDate);

$hash = hash_hmac('sha1', $binary_timestamp, $binary_key, true);

$offset = ord($hash[19]) & 0xf;

$OTP = (
        ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
        ((ord($hash[$offset+1]) & 0xff) << 16 ) |
        ((ord($hash[$offset+2]) & 0xff) << 8 ) |
        (ord($hash[$offset+3]) & 0xff)
    ) % pow(10, 6);
?>