<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 9/6/2016
 * Time: 3:21 PM
 */

$merchant = $_SESSION['userSession'];


$db->where ("merchant_id", $merchant);
$bankInfo = $db->getAll ("bank_account");

$bankName = $bankInfo['bank_name'];
$bankAccount = $bankInfo['bank_account'];
$branchCode = $bankInfo['branch_code'];
$branchName = $bankInfo['branch_name'];
$accountHolder = $bankInfo['account_holder'];

$table ='
                            <tr>
                                                <td>
                                                '.$bankName.'
                                               </td>
                                                <td>
                                                    '.$bankAccount.'
                                                 </td>

                                                </td>
                                                <td>
                                                '.$branchCode.'
                                                </td>
                                                <td>
                                                '.$branchName.'
                                                </td>
                                                <td>
                                                '.$accountHolder.'
                                                </td>
                                          </tr>
                              ';
print_r($table);

if(isset($_POST['AddAccount']))

{

    if($bankName==TRUE){

        $msg= "<div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong> You can only add one Bank Account
			  </div>";
        print_r($msg);
    }
    else{

        $bank_name = $_POST['bank_name'];
        $bank_account = $_POST['bank_account'];
        $branch_code = $_POST['branch_code'];
        $branch_name = $_POST['branch_name'];
        $account_holder = $_POST['account_holder'];


        $data = Array (

            'merchant_id' => $merchant,
            'bank_name' => $bank_name,
            'bank_account' => $bank_account,
            'branch_code' => $branch_code,
            'branch_name' => $branch_name,
            'account_holder' => $account_holder
        );

        $id = $db->insert ('bank_account', $data);

        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Congrats !</strong> The bank account $bank_account was successfully added to your profile.
			  </div>";


            echo $msg;
    }






    }


?>