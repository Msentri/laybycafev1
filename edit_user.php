<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/05/08
 * Time: 11:31 AM
 */

include 'header.php';

$user_name = @$_GET['username'];
$branch = @$_GET['branch'];

if(isset($_POST['changePass'])){

    if($_POST['password']!= $_POST['password2']){

        print_r('wrong Password');
    }
    else{
    $data = Array (
        'merchant_id' => $consumerID,
        'user_name' => $user_name,
        'branch_name' => $branch,
        'password' => $_POST['password2']

    );


    $passchange = $api->post("/braches/users/password", $data);

$getMessage = json_decode($passchange->response);

$message = $getMessage->message;
    }
}
include 'templates/branch/edit_user.tpl';

include_once 'footer.php';
?>
