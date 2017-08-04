<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/05/08
 * Time: 10:10 AM
 */
//----------------------Adds user to the branch------------------//
if(isset($_POST['addUser'])){

    $addUserData = Array (
        'merchant_id' => $consumerID,
        'user_name' => $_POST['username'],
        'branch_name' => $_SESSION['branchName_Session'],
        'password' => $_POST['password'],

    );

    $users = $api ->post("/braches/users",$addUserData);
}

$data = array(
    'merchant_id' => $consumerID,
);

$getBranchUsers = $api->get("/braches/users", $data);

$usersInfo = json_decode($getBranchUsers->response);


if(@$usersInfo->code!=822){

    foreach (@$usersInfo->user_data as $key=>$inStoreUsersData) {

        $users_data = [];
    $users_data['branch_name'] = filter_var(@$inStoreUsersData->branch_name, FILTER_SANITIZE_STRING);
    $users_data['user_name'] = filter_var(@$inStoreUsersData->user_name, FILTER_SANITIZE_STRING);
    $users_data['createdAt'] = filter_var(@$inStoreUsersData->createdAt, FILTER_SANITIZE_STRING);
        $users = '
    <tr>
    <td> 
    '.@$users_data['branch_name'].'
    </td>
       <td> 
    '.@$users_data['user_name'].'
    </td>
       <td> 
    '.@ $users_data['createdAt'].'
    </td>
    <td>
    <a href="edit_user?branch='.$users_data['branch_name'].'&username='.$users_data['user_name'].'">edit</a>
    </td>
    </tr>
    ';
        print_r($users);
    }
}
//

