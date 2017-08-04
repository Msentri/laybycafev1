<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';

include 'functions/cart_functions.php';
include 'functions/dashboard.php';

$refOnTopUp = @base64_decode($_GET['topup']);
$amountTopUp = @base64_decode($_GET['amount']);

$paid = @$_GET['paid'];
$useWallet = @$_GET['usewallet'];

if(@$useWallet==0){
    $walletMessge = 'Outstanding Payment';

}else{
    $walletMessge = 'Payment Needed Including Wallet';
}

if($roleSession=='consumer'){
?>
            <section class="page-section">
                <div class="remodal-bg">
                <div class="container">
                    <div class="row">

                        <h1>Cart</h1>

                    </div>

                    <?php
                    require 'templates/cart/payment_option.tpl';
                            if($refOnTopUp!=null){
                                print_r($paymentOption);
                            }

                            else{

                                 if($useWallet=='yes'){

                                }

                                else{
                                    //$wallet = $api->get("/consumers/$consumerID/wallet");
                                    $useWallet = @$walletData->useWallet;
                                    if(@$paid==null){print_r($cartOption);
                                    }else{
                                    $paymentInfo='<p class="text-info">Payment Processed</p>';
                                    print_r($paymentInfo);
                                    }

                                    include 'functions/viewConsumer_cart.php';


                                    if(@$verified==null){

                                    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }
                                    setTimeout(\'Redirect()\', 0500);
                                    </script>';

                                   print_r($redirect);
                                    }

							?>
                    <?php
                    $totalOptions = '
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><strong>Total Amount</strong></td>
                        <th>&nbsp;</th>
                        <td><p align="right">R '.round(@$totalDuePayment).'.00</p></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><strong>Available In Wallet</strong></td>
                        <th>&nbsp;</th>
                        <td><p align="right">R '.@$walletBalance.'</p></td>
                        <td><p align="right">Use Wallet

                            </p></td>
                        <td>
                           <p align="right"> '.@$useWalletForm.'</p>
                           </td>
                    </tr>
                    <tr>
                        <td><strong>'.@$walletMessge.'</strong></td>
                        <th>&nbsp;</th>
                        <td><strong><p align="right">R '.round(@$outstandingPayment,2).'</p></strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>';
                    if(@$paid==null){
                       print_r(@$totalOptions);
                    }

                            }?>
							</tbody>

						</table>
                    <?php

                    if(@$lastPayment_verified=='true'){
                            $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }
                                    setTimeout(\'Redirect()\', 1000);
                                    </script>';

                           //print_r($redirect);
                    }

                    if($refOnTopUp!=NULL){
                    }else {
                         if (@$outstandingPayment>0) {

                            if(@$totalDuePayment>0){

                            print_r(@$topUpForm);
                            }
                        } else {
                            if(@$totalDuePayment!=0){
                            print_r(@$payNowForm);}
                        }


                    }}

                    ?>
					</div>
                 <?php
                 print_r(@$modal)
                 ?>
				</div>
			</section>

<?php }

else{

    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }
                                    setTimeout(\'Redirect()\', 0500);
                                    </script>';

    print_r($redirect);
}?>
<?php
require_once 'footer.php';
?>
</body>
</html>