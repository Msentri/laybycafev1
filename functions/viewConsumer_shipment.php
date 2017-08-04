<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';

$jsonData = json_decode($result->response);

if($jsonData!=null){
foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var(@$data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var(@$data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var(@$data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment_verified'] = filter_var(@$data->lastPayment_verified, FILTER_SANITIZE_STRING);



    if($layby_data['status']=='awaiting payment' and $layby_data['lastPayment_verified']=='true' and $layby_data['balance']==0){

        if($layby_data['balance']==0){
            $monthlyPayment = $layby_data['price'];
        }else{
            if($layby_data['depositMade']=='Yes'){
                $monthlyPayment =  $layby_data['instalment'];
            }else{
                $monthlyPayment = $layby_data['deposit'];
            }
        }


        $deleteForm = '<form  autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                 <input required type="hidden" name="oderId" value="'.$layby_data['product_ref'].'" class="form-control">
                 <button type="submit" name="deleteLayby"><img src="img/delete.png" /></button>
                 </form>';

        if($layby_data['canPay']=='1'){
            $PayForm = '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="canNotPay" value="0" class="form-control">
                      <input required type="hidden" name="oderId" value="'.$layby_data['product_ref'].'" class="form-control">
                     <input onChange=\'submit();\'  type="checkbox" value="0" checked name="canNotPay">
                          </form>';
        }else{
            $PayForm = '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                     <input required type="hidden" name="canPay" value="1" class="form-control">
                      <input required type="hidden" name="oderId" value="'.$layby_data['product_ref'].'" class="form-control">
                      <input onChange=\'submit();\' type="checkbox" value="1" name="canPay" >
                          </form>';
        }

    $tableInprocess='
    <tr>


                                                 <td><p align="left"><a href="getConsumer_transaction.php?consumer_id='.@$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["store_name"].'# '.$layby_data['product_ref'].' -  '.$layby_data["product_name"].'</a></td>
                                                <td valign="right"><p align="right"><strong>R '.$monthlyPayment.'</strong></p></td>
                                                    </th>
                                                   <th scope="row" valign="right"><p></p><p></p><p></p>'.$deleteForm.'</th>
                                                </tr>

        ';

        //calculations//


        if($layby_data['canPay']='Yes'){


            if($layby_data['balance']==0){

                $totalDuePayment = round($layby_data['balance']);}
            else{

                $totalDuePayment = round($instalment+$Firstdeposit);

            }

            $walletRemaining = $walletBalance - $totalDuePayment;

            $products = $layby_data['product_name'];

            $balance = $layby_data['balance'] - $instalment-$Firstdeposit;


            if($useWallet==1){

                if($layby_data['balance']==0){

                    $outstandingPayment = $layby_data['balance'];

                }
                else{

                $paymentDue = $instalment + $Firstdeposit;

               $outstandingPayment = round($walletBalance - $paymentDue , 2);


                if($outstandingPayment>=0){


                    $outstandingPayment = 0;

                }else{

                    $outstandingPayment = -1*$outstandingPayment;
                }
                }
                $useWalletForm= '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="'.$walletID.'" >
                       <input required type="hidden" name="dontUseWallet" value="0" >
                     <input onChange=\'submit();\' type="checkbox" checked value="0" name="dontUseWallet">
                          </form>';



            }else{

                $useWalletForm = '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="'.$walletID.'" >
                      <input required type="hidden" name="useWallet" value="1" class="form-control">
                    <input onChange=\'submit();\' type="checkbox" value="1" name="useWallet">
                          </form>';
                if($layby_data['balance']==0){

                    $outstandingPayment = round($layby_data['balance']);

                }
                else{
                $outstandingPayment = round($Firstdeposit + $instalment,2);}
            }



        }


        if($refOnTopUp!=NULL){
        }else{
            print_r($tableInprocess);
        }


    }


}}
$topUpForm ='<form autocomplete="off" action=engine.php?topup='.base64_encode('LB'.@$layby_data['consumer_id'].'').'&amount='.base64_encode(''.@$outstandingPayment.'').' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
<button type="submit" class="btn btn-default" name="topUp">Pay</button></form>
';
$payNowForm ='<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'?usewallet=yes&amount='.base64_encode(''.@$outstandingPayment.'').' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
 <input required type="hidden" name="walletid" value="'.@$walletID.'" class="form-control">
 <input required type="hidden" name="amount" value="'.@$totalDuePayment.'" class="form-control">
 <input required type="hidden" name="balance" value="'.@$balance.'" class="form-control">
 <input required type="hidden" name="transaction_type" value="payment" class="form-control">
 <input required type="hidden" name="walletBalance" value="'.@$walletRemaining.'" class="form-control">
<button type="submit" class="btn btn-default" name="payNow">Pay Now</button></form>
';

$complete ='<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
 <input required type="hidden" name="walletId" value="'.@$walletID.'" class="form-control">
<button type="submit" class="btn btn-default" name="complete">Ship</button></form>
';