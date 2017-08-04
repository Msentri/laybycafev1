<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/30
 * Time: 1:09 PM
 */

$branchesData = json_decode($branches->response);


foreach($branchesData as $key=>$data){

    $branch_data = [];
    $branch_name = $branch_data['branch_name'] = filter_var(@$data->branch_name, FILTER_SANITIZE_STRING);
    $email = $branch_data['email'] = filter_var(@$data->email, FILTER_SANITIZE_STRING);
    $branch_tel = $branch_data['branch_tel'] = filter_var(@$data->branch_tel, FILTER_SANITIZE_STRING);
    $address = $branch_data['address'] = filter_var(@$data->address, FILTER_SANITIZE_STRING);
    $account_holder = $branch_data['account_holder'] = filter_var(@$data->account_holder, FILTER_SANITIZE_STRING);
    $bank_branch_name = $branch_data['bank_branch_name'] = filter_var(@$data->bank_branch_name, FILTER_SANITIZE_STRING);
    $branch_code = $branch_data['branch_code'] = filter_var(@$data->branch_code, FILTER_SANITIZE_STRING);
    $bank_account = $branch_data['bank_account'] = filter_var(@$data->bank_account, FILTER_SANITIZE_STRING);
    $bank_name = $branch_data['bank_name'] = filter_var(@$data->bank_name, FILTER_SANITIZE_STRING);

    $table ='
                            <tr>
                                                <td>
                                                '.@$branch_name.'
                                               </td>
                                               <td>
                                                '.@$email.'
                                               </td>
                                               <td>
                                                '.@$branch_tel.'
                                               </td>
                                               <td>
                                                '.@$address.'
                                               </td>
                                                <td>
                                                '.@$account_holder.'
                                               </td>
                                                <td>
                                                '.@$bank_name.'
                                               </td>
                                                <td>
                                                '.@$bank_account.'
                                               </td>
                                                <td>
                                                '.@$branch_code.'
                                               </td>
                                                <td>
                                                '.@$bank_branch_name.'
                                               </td>

                                             </tr>
                              ';
    print_r($table);

}


?>