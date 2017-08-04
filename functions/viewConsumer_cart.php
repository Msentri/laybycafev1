<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';

//$jsonData = json_decode($result->response);
use Base32\Base32;
if(@$consumer_laybys!=null){

foreach($consumer_laybys['processing'] as $key=>$data){
    if($consumer_laybys['processing'][$key]!=null) {
        foreach ($consumer_laybys['processing'][$key] as $i => $data) {
            $layby_data = [];
            $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
            $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
            $layby_data['product_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['store_name'] = filter_var(@$data->product_name, FILTER_SANITIZE_STRING);
            $layby_data['sku'] = filter_var(@$data->sku, FILTER_SANITIZE_STRING);
            $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
            $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
            $layby_data['period'] = filter_var(@$data->period, FILTER_SANITIZE_STRING);
            $canPay = $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
            $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);
            $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
            $layby_data['deposit'] = filter_var(@$data->deposit, FILTER_SANITIZE_STRING);
            $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
            $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
            $layby_data['pay_now'] = filter_var(@$data->pay_now, FILTER_SANITIZE_STRING);
            $layby_data['pay_now_amount'] = filter_var(@$data->pay_now_amount, FILTER_SANITIZE_STRING);
            $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
            $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
            $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
            $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);
            $lastPayment_verified = $layby_data['lastPayment_verified'] = filter_var(@$data->lastPayment_verified, FILTER_SANITIZE_STRING);


            if ($layby_data['status'] == 'inprocess' and $layby_data['lastPayment_verified'] == 'false' and $layby_data['balance'] != 0 and $layby_data['pay_now'] == 'Yes') {
                $transaction_id = $layby_data['product_ref'];

                $paymentDone = $layby_data['lastPayment_verified'];
                if ($layby_data['depositMade'] == 'Yes') {
                    $monthlyPayment = round($layby_data['pay_now_amount']);
                    $paymentType = 'Pay Now';
                } else {
                    $monthlyPayment = round($layby_data['pay_now_amount']);
                    $paymentType = 'Pay Now';
                }

                if ($transaction_id == $layby_data['product_ref']) {


                    $deleteForm = '<form  autocomplete="off" action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                 <input required type="text" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                 <button type="submit" name="deleteLayby" class="btn btn-default"><strong>Yes</strong></button>
                 <button data-remodal-action="cancel" class="btn btn-default"><strong>Dont Cancel</strong></button>

                 </form>';

                    $modalCancel = '<a data-remodal-target="modal"><img src="img/delete.png" /></a>';
                    $modal = '
                        <div class="remodal" data-remodal-id="modal">
                        <button data-remodal-action="close" class="remodal-close"></button>
                        <h2>Cancel Layby</h2>
                        <p>
                         

                                Are you sure that you want to cancel <strong>Layby ' . @$transaction_id . '</strong>

                 
                        </p>
                        <br>
                ' . @$deleteForm . '
</div>
';
                }

                if ($layby_data['canPay'] == '1') {
                    $PayForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="canNotPay" value="0" class="form-control">
                      <input required type="hidden" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                     <input onChange=\'submit();\'  type="checkbox" value="0" checked name="canNotPay">
                          </form>';
                } else {
                    $PayForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                     <input required type="hidden" name="canPay" value="1" class="form-control">
                      <input required type="hidden" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                      <input onChange=\'submit();\' type="checkbox" value="1" name="canPay" >
                          </form>';
                }

                $tableInprocess = '
    <tr>


                                                 <td><p align="left"><a href="transactions?id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . $layby_data['product_name'] . ' #' . $layby_data['product_ref'] . '</a></td>
                                                  <td valign="right"><p align="right"><strong>' . $paymentType . '</strong></p></td>
                                                <td valign="right"><p align="right"><strong>R ' . round(@$monthlyPayment) . '.00</strong></p></td>
                                                <th scope="row" valign="right"><p align="right">' . $PayForm . '</p></th>
   </th>
                                                <th scope="row" valign="right"><p></p><p></p><p></p>'/*$modalCancel*/ . '</th>
                                     </tr>

        ';

                //calculations//


                if ($layby_data['canPay'] = 'Yes') {

                    $totalDuePayment = round($processingAmount + $awaitingAmount);

                    $walletRemaining = $walletBalance - $totalDuePayment;

                    $products = $layby_data['product_name'];

                    $balance = $layby_data['balance'] - $processingAmount - $awaitingAmount;


                    if ($useWallet == 1) {

                        $paymentDue = $processingAmount + $awaitingAmount;
                        $paymentVerified = $lastPayment_verified;
                        $outstandingPayment = round($walletBalance - $paymentDue, 2);


                        if ($outstandingPayment >= 0) {


                            $outstandingPayment = 0;

                        } else {

                            $outstandingPayment = -1 * $outstandingPayment;
                            $paymentVerified = $lastPayment_verified;
                        }

                        $useWalletForm = '<form autocomplete="off"  method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="' . $walletID . '">
                       <input required type="hidden" name="dontUseWallet" value="0" >
                     <input onChange=\'submit();\' type="checkbox" checked value="0" name="dontUseWallet">
                          </form>';


                    } else {

                        $useWalletForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="' . $walletID . '" >
                      <input required type="hidden" name="useWallet" value="1" class="form-control">
                    <input onChange=\'submit();\' type="checkbox" value="1" name="useWallet">
                          </form>';

                        $paymentVerified = $lastPayment_verified;

                    }

                }


                if ($refOnTopUp != NULL) {
                } else {

                    print_r($tableInprocess);
                }
                $verified = $layby_data['lastPayment_verified'];

            } elseif ($layby_data['status'] == 'inprocess' and $layby_data['lastPayment_verified'] == 'false' and $layby_data['balance'] != 0) {

                $transaction_id = $layby_data['product_ref'];

                $paymentDone = $layby_data['lastPayment_verified'];
                if ($layby_data['depositMade'] == 'Yes') {
                    $monthlyPayment = round($layby_data['instalment']);
                    $paymentType = 'instalment';
                } else {
                    $monthlyPayment = round($layby_data['deposit']);
                    $paymentType = 'deposit';
                }

                if ($transaction_id == $layby_data['product_ref']) {


                    $deleteForm = '<form  autocomplete="off" action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                 <input required type="text" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                 <button type="submit" name="deleteLayby" class="btn btn-default"><strong>Yes</strong></button>
                 <button data-remodal-action="cancel" class="btn btn-default"><strong>Dont Cancel</strong></button>

                 </form>';

                    $modalCancel = '<a data-remodal-target="modal"><img src="img/delete.png" /></a>';
                    $modal = '
                        <div class="remodal" data-remodal-id="modal">
                        <button data-remodal-action="close" class="remodal-close"></button>
                        <h2>Cancel Layby</h2>
                        <p>
                         

                                Are you sure that you want to cancel <strong>Layby ' . @$transaction_id . '</strong>

                 
                        </p>
                        <br>
                ' . @$deleteForm . '
</div>
';
                }

                if ($layby_data['canPay'] == '1') {
                    $PayForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="canNotPay" value="0" class="form-control">
                      <input required type="hidden" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                     <input onChange=\'submit();\'  type="checkbox" value="0" checked name="canNotPay">
                          </form>';
                } else {
                    $PayForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                     <input required type="hidden" name="canPay" value="1" class="form-control">
                      <input required type="hidden" name="oderId" value="' . $layby_data['product_ref'] . '" class="form-control">
                      <input onChange=\'submit();\' type="checkbox" value="1" name="canPay" >
                          </form>';
                }

                $tableInprocess = '
    <tr>


                                                 <td><p align="left"><a href="transactions?id=' . @base64_encode($layby_data["consumer_id"]) . '&transaction_id=' . @base64_encode($layby_data["product_ref"]) . '">' . $layby_data['product_name'] . ' #' . $layby_data['product_ref'] . '</a></td>
                                                  <td valign="right"><p align="right"><strong>' . $paymentType . '</strong></p></td>
                                                <td valign="right"><p align="right"><strong>R ' . round(@$monthlyPayment) . '.00</strong></p></td>
                                                <th scope="row" valign="right"><p align="right">' . $PayForm . '</p></th>
   </th>
                                                <th scope="row" valign="right"><p></p><p></p><p></p>'/*$modalCancel*/ . '</th>
                                     </tr>

        ';

                //calculations//


                if ($layby_data['canPay'] = 'Yes') {

                    $totalDuePayment = round($processingAmount + $awaitingAmount);

                    $walletRemaining = $walletBalance - $totalDuePayment;

                    $products = $layby_data['product_name'];

                    $balance = $layby_data['balance'] - $processingAmount - $awaitingAmount;


                    if ($useWallet == 1) {

                        $paymentDue = $processingAmount + $awaitingAmount;
                        $paymentVerified = $lastPayment_verified;
                        $outstandingPayment = round($walletBalance - $paymentDue, 2);


                        if ($outstandingPayment >= 0) {


                            $outstandingPayment = 0;

                        } else {

                            $outstandingPayment = -1 * $outstandingPayment;
                            $paymentVerified = $lastPayment_verified;
                        }

                        $useWalletForm = '<form autocomplete="off"  method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="' . $walletID . '">
                       <input required type="hidden" name="dontUseWallet" value="0" >
                     <input onChange=\'submit();\' type="checkbox" checked value="0" name="dontUseWallet">
                          </form>';


                    } else {

                        $useWalletForm = '<form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <input required type="hidden" name="walletId" value="' . $walletID . '" >
                      <input required type="hidden" name="useWallet" value="1" class="form-control">
                    <input onChange=\'submit();\' type="checkbox" value="1" name="useWallet">
                          </form>';

                        $paymentVerified = $lastPayment_verified;

                        $outstandingPayment = round($awaitingAmount + $processingAmount, 2);
                    }

                }


                if ($refOnTopUp != NULL) {
                } else {

                    print_r($tableInprocess);
                }
                $verified = $layby_data['lastPayment_verified'];

            } else {
                $paymentDone = 'true';
            }


        }
    }
}
}
$transDetails = array(
    'topup'=>'Lb'.$consumerID,
    'amount'=>$outstandingPayment,
);
$encoded = Base32::encode(json_encode($transDetails));
$topUpForm ='<form autocomplete="off" action=choose_payment?options='.@$encoded.' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
<button type="submit" class="btn btn-default" name="topUp">Pay</button></form>
';
$payNowForm ='<form autocomplete="off"  method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
 <input required type="hidden" name="walletid" value="'.@$walletID.'" class="form-control">
 <input required type="hidden" name="amount" value="'.@$totalDuePayment.'" class="form-control">
 <input required type="hidden" name="balance" value="'.@$balance.'" class="form-control">
 <input required type="hidden" name="transaction_type" value="payment" class="form-control">
 <input required type="hidden" name="walletBalance" value="'.@$walletRemaining.'" class="form-control">
<button type="submit" class="btn btn-default" name="payNow">Pay Now</button></form>
';

$complete ='<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'?usewallet=yes&amount='.base64_encode(''.@$outstandingPayment.'').' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
 <input required type="hidden" name="walletid" value="'.@$walletID.'" class="form-control">
<button type="submit" class="btn btn-default" name="complete">Ship</button></form>
';