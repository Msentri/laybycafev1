<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/30
 * Time: 1:09 PM
 */


if(@$inStoreUsers->coce !=502){

    foreach (@$inStoreUsers as $key=>$inStoreUsersData) {

        $users_data = [];
        $storeName = $users_data['branch_name'] = filter_var(@$inStoreUsersData->branch_name, FILTER_SANITIZE_STRING);
        $first_name= $users_data['first_name'] = filter_var(@$inStoreUsersData->first_name, FILTER_SANITIZE_STRING);
        $email = $users_data['email'] = filter_var(@$inStoreUsersData->email, FILTER_SANITIZE_STRING);
        $cellNo = $users_data['cellNo'] = filter_var(@$inStoreUsersData->cellNo, FILTER_SANITIZE_STRING);
        $users = '
    <tr>
    <td> 
    '.@$storeName.'
    </td>
       <td> 
    '.@$first_name.'
    </td>
       <td> 
    '.@$email.'
    </td>
       <td> 
    '.@$cellNo.'
    </td>
    </tr>
    ';
        print_r($users);
    }
}



?>