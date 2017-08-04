<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';

if(isset($_POST['complete'])){

     $walletID = $_POST['walletId'];

    $result = $api->put("/laybys/ship/$walletID");

    $code = json_decode($result->response);


}

include 'functions/dashboard.php';

$refOnTopUp = @base64_decode($_GET['topup']);
$amountTopUp = @base64_decode($_GET['amount']);
$paid = @$_GET['paid'];
$useWallet = @$_GET['usewallet'];

?>
            <section class="page-section">
                <div class="container">
                    <div class="row">

                        <h1>Ship</h1>

                    </div>

<?php

include_once 'includes/banks.php';


$cartOption = '
<div class="row">
            <table class="table">
	        <caption></caption>
					  <thead>
						<tr>
						  <th>Description</th>
						  <th valign="right"><p align="right">Amount</p></th>
						  <th>&nbsp;</th>
						  <th>&nbsp;</th>
					    </tr>
					  </thead>
					  <tbody>
							';?>
							<?php
                            if($refOnTopUp!=null){
                                print_r($paymentOption);
                            }
                            else{
                                if($paid=='true'){


                                $result = $api->get("/payment");

                                $code = json_decode($result->response);


                                }  if($useWallet=='yes'){

                                    require 'includes/wallet.php';


                                }

                                else{
                                    $wallet = $api->get("/consumers/$consumerID/wallet");
                                    $useWallet = $walletData->useWallet;
                                    if(@$paid==null){print_r($cartOption);
                                    }else{
                                    $paymentInfo='<p class="text-info">Payment Processed</p>';
                                    print_r($paymentInfo);
                                    }

                                    include 'functions/viewConsumer_shipment.php'

							?>
                    <?php

                    if(@$paid==null){
                       print_r(@$totalOptions);
                    }

                            }?>
							</tbody>

						</table>
                    <?php

                    if($refOnTopUp!=NULL){
                    }else {

                    if(@$outstandingPayment==0){
                    print_r(@$complete);
                    }else{
                        if (@$outstandingPayment>0) {

                            if(@$totalDuePayment>0){

                            print_r(@$topUpForm);
                            }
                        } else {
                            if(@$totalDuePayment!=0){
                            print_r(@$payNowForm);}
                        }}


                    }}?>
					</div>
				</div>
			</section>


<?php
require_once 'footer.php';
?>
</body>
</html>