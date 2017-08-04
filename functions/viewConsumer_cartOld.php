<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';



$jsonData = json_decode($result->response);


foreach($jsonData as $key=>$data){

    $layby_data = [];
    $layby_data['consumer_id'] = filter_var($data->consumer_id, FILTER_SANITIZE_STRING);
    $layby_data['product_ref'] = filter_var($data->product_ref, FILTER_SANITIZE_STRING);
    $layby_data['product_name'] = filter_var($data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var($data->product_name, FILTER_SANITIZE_STRING);
    $layby_data['sku'] = filter_var($data->sku, FILTER_SANITIZE_STRING);
    $layby_data['price'] = filter_var($data->price, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var($data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['period'] = filter_var($data->period, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var($data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['depositMade'] = filter_var($data->depositMade, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var($data->status, FILTER_SANITIZE_STRING);
    $layby_data['deposit'] = filter_var($data->deposit, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var($data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var($data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var($data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['nextPayment'] = filter_var($data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var($data->description, FILTER_SANITIZE_STRING);


    if($layby_data['status']=='awaiting payment'){

        if($layby_data['canPay']=='Yes'){
            $PayForm = '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <div class="form-group input-group">
                       <input required type="checkbox" name="canPay" CHECKED value="Yes" class="form-control">
                          </form>';
        }else{
            $PayForm = '<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                      <div class="form-group input-group">
                       <input required type="checkbox" name="canPay" value="No" class="form-control">
                          </form>';
        }

    $tableInprocess='
    <tr>


                                                <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["store_name"].'</a></td>
                                                 <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["product_name"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["price"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["instalment"].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["price"].'</a></td>
                                               <td>'.$PayForm.'</td>
                                               <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data['depositMade'].'</a></td>
                                                <td><a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.$layby_data["period"].'</a></td>

                                                <td>
                                                    <a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'">'.date("M j, Y", strtotime($layby_data["lastPayment"])).'</a>
                                                 </td>
                                                   <td> <a href="getConsumer_transaction.php?consumer_id='.$layby_data["consumer_id"].'&transaction_id='.$layby_data["product_ref"].'"> R '.$layby_data["instalment"].' at '.date("M j", strtotime($layby_data["nextPayment"])).'</a></td>
                                        </tr>
                                       </tbody>


        ';

        //calculations//

        if($layby_data['canPay']='Yes'){

            $totalPayment = $walletBalance - $instalment - $Firstdeposit;

            $products = $layby_data['product_name'];

        }


        if($refOnTopUp!=NULL){
        }else{
            print_r($tableInprocess);
        }


    }


}
$topUpForm ='<form autocomplete="off" action='.htmlspecialchars($_SERVER["PHP_SELF"]).'?topup='.base64_encode('LB'.$layby_data['consumer_id'].'').'&amount='.base64_encode(''.-1*$totalPayment.'').' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
<button type="submit" class="btn btn-danger" name="topUp">Pay</button>

                                                            </form>



';


if($refOnTopUp!=NULL){
}else {
    if ($totalPayment > 0) {
        $walletTopUp = '<div class="col-xs-13">
									<small class="stat-label">Total wallet balance after payment</small>
									<h5 id="myTargetElement1.2">R ' . $totalPayment . '</h5>
								</div>

								';
    } else {
        $walletTopUp = '<div class="col-xs-13 text-right">
									<small class="stat-label warning" >Top Up wallet with</small>
									<h5 id="myTargetElement1.2">R ' . -1 * $totalPayment . '</h5>
								</div>
									' . $topUpForm . '
								';
    }
    $total = '
<thead>
    <th valign="right"><strong>Total</strong></th>
    </thead>
    <tbody><tr><td colspan="4">
    <div class="row">
						<div class="col-xs-13 col-md-8">
							<h4>Due Instalment</h4>
							<h5>R ' . $instalment . '</h5>
</div>
        <div class="col-xs-13">
							<h4>Pending Deposit</h4>
							<h5>R ' . $Firstdeposit . '</h5>
							</div>
							<div class="row">
								<div class="col-xs-13 col-md-8">
									<small class="stat-label">Current Wallet balance</small>
                                    <h5 id="myTargetElement1.2">R ' . $walletBalance . '</h5>
								</div>
								' . $walletTopUp . '
								</div>
							</div>
						</div>
					</div>
		</tbody>
    ';
    print_r($total);

}