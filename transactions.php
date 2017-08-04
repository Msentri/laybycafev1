<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';
$consumer_id = @base64_decode($_GET['id']);
$transaction_id = @base64_decode($_GET['transaction_id']);

include 'functions/update_transaction.php';

include 'functions/dashboard.php';

include_once 'functions/transactionsMoreInfo.php';

if($roleSession=='consumer'){


?>
<section class="page-section" xmlns="http://www.w3.org/1999/html">
	<div class="remodal-bg">
	<div id="divToPrint" class="container">
		<div class="row">


			<h1>Transaction Details - #<?php print_r(@$transaction_id); ?>
            <?php

				//Gets Profile//

				$user = @$api->get("/profile/@$merchant_id");

				$ConsumerInfo = json_decode(@$user->response);

				foreach($ConsumerInfo as $key=>$data){

					$layby_data = [];
					$first_name = $layby_data['first_name'] = filter_var(@$data->first_name, FILTER_SANITIZE_STRING);
					$last_name = $layby_data['last_name'] = filter_var(@$data->last_name, FILTER_SANITIZE_STRING);
					$email = $layby_data['email'] = filter_var(@$data->email, FILTER_SANITIZE_STRING);
					$cellNo = $layby_data['cellNo'] = filter_var(@$data->cellNo, FILTER_SANITIZE_STRING);

				}
				?></h1>
		</div>
		<div class="row">
			<div class="row responsive-features top-pad-20">
				<!-- Features 1 -->
				<div class="col-md-4">
					<!-- Title And Content -->
					<span class="text-color"></span>
					<p><strong>Merchant Details</strong>&nbsp;</p>
					<p>Store Name: <?php print_r(@$store);?></p>
					<p>Contact Number: <?php print_r(@$cellNo);?></p>

				</div>
				<!-- Features 1 -->
				<!-- Features 2 -->
				<div class="col-md-4">
					<!-- Title And Content -->
					<span class="text-color"></span>
					<h5>&nbsp;</h5>
				</div>
				<!-- Features 2 -->
				<!-- Features 3 -->
				<div class="col-md-4">
					<!-- Title And Content -->
					<span class="text-color"></span>
					<p align="right"><strong>Product Details</strong></p>
					<p align="right"><?php print_r(@$ProductName);?> @ R<?php print_r(@$price);?></p>
					<p align="right"><strong>Status: <?php
							if(@$status=='inprocess' and $depositMade=='No'){
								print_r('Awaiting Deposit');

							}
							if(@$status=='cancelled'){

								print_r('Cancelled');
							}
							if(@$status=='inprocess' and @$depositMade=='Yes'){
								print_r('Processing');
							}elseif(@$status=='completed' and @$depositMade=='Yes'){

								print_r('Completed');
							}
							?></strong></p>
					<p align="right"><strong>TOTAL: R<?php print_r(@$price);?></strong></p>
				</div>
				<!-- Features 3 -->
			</div>
			<table class="table">
				<caption></caption>
				<thead>
				<tr>
					<th>Date</th>
					<th>Description</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Balance</th>
				</tr>
				</thead>
							<?php
							include 'functions/viewTransactions.php';

							$cancelForm = '
						      <form autocomplete="off" name="cancelForm" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                            <input required type="hidden" name="product_ref" value="'.@$transaction_id.'" class="form-control">
                            <input required type="hidden" name="refund" value="'.round(@$deduct).'" class="form-control">
                            <input required type="hidden" name="ismerchant" value="0" class="form-control">
                            <textarea required type="" placeholder="Please type cancellation message" name="cancelMessage" value="" rows="3" class="form-control"></textarea>
                            <input required type="hidden" name="consumer_id" value="'.@$consumer_id.'" class="form-control">
                            <h5><button  type="submit" name="cancelLayby" class="btn btn-default"><strong>Yes</strong></button></h5>
                            </form>
                           ';


							$forwardPaymentForm = '
							<!-- <form autocomplete="off" name="forwardPaymentForm" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
							    <input type="text" name="forwardAmount" class="form-control" placeholder="Amount" />
							    <h5><button  type="submit" name="forwardPayemnt" class="btn btn-default"><strong>FORWARD PAYMENT</strong></button></h5>
							</form> -->
							
							
							
							<div class="panel panel-warning" style="padding: 20px;border-color: #ffc400;">
                                
                                <div class="panel-body">
                                    <form name="forwardPaymentForm" class="form-horizontal" method="post" autocomplete="off" accept-charset="UTF-8" role="form">
                                        <div class="form-group">
                                        
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <label style="text-align: left;" for="forwardPayemnt" class="col-sm-8 control-label text-left">Amount</label>
                                                <div class="col-sm-4" style="text-align: left;">
                                                    <input type="text" name="forwardPayemnt" class="form-control" id="forwardPayemnt" placeholder="Amount">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12" style="padding-left: 0px;border-color: #ffc400;color: #fff;text-align: left;">
                                                <button  type="submit" name="forwardPayemnt" class="btn btn-default">Pay now</button> <button data-remodal-action="cancel" class="btn btn-default">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
            
            
							';

							?>
				</tr>
</tbody>

			</table>
			<div class="row responsive-features top-pad-20">
				<!-- Features 1 -->

				<?php if(@$status!='cancelled'){

					if(@$status!='completed'){

						?>
						<div class="col-md-12">
							<!-- Title And Content -->
<!--							<span class="text-color"></span>-->
                            <?php
                        if(@$status=='inprocess'){
                            ?>
                            <h5><a data-remodal-target="modal-forward-payment" class="btn btn-default">Pay Now</a></h5>
							<h5 style="float: right;"><a data-remodal-target="modal" class="btn btn-default">Cancel Transaction</a></h5>
                            <?php } ?>
                            <h5 style="float: right;margin-right: 5px;"><a href="javascript:history.go(-1)" class="btn btn-default">Back</a></h5>
                            <h5 style="float: right;margin-right: 5px;"><input type="button" value="Print" class="btn btn-default" onclick="PrintDiv();" /></a></h5>
							</span>
						</div>
					<?php } else { ?>

<!--						<div class="col-md-3">-->
							<!-- Title And Content -->
<!--							<span class="text-color"></span>-->

<!--							</span>-->
<!--						</div>   -->
                        <?php }?>
					<!-- Features 1 -->
					<!-- Features 2 -->
<!--					<div class="col-md-3">-->
						<!-- Title And Content -->
<!--						<span class="text-color"></span>-->

<!--					</div>-->
					<!-- Features 2 -->
					<!-- Features 3 -->
					<?php if(@$status=='completed'){?>
						<div class="col-md-4" align="right">
							<!-- Title And Content -->
							<span class="text-color"></span>
							<h5><a href="/acc/generate-button" class="btn btn-default">Get Release Code</a></h5>                               </h5>
						</div>
					<?php }?>
				<?php }else{
				    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }

                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';

                    print_r($redirect);}?>

				<div class="remodal" data-remodal-id="modal">
					<button data-remodal-action="close" class="remodal-close"></button>
					<p>
						<?php

						if(@$status=='inprocess'){
							print_r('Are you sure that you want to cancel <strong>Layby#'. $transaction_id.'</strong>');
						}else{
							print_r('<strong>Layby#'. $transaction_id.' </strong>Cancelled');
						}?>
						<?php ;?>
					</p>
					<br>

					<?php
					if(@$status=='inprocess'){
						print_r($cancelForm);
						?>
						<button data-remodal-action="cancel" class="btn btn-default"><strong>Don't Cancel</strong></button>
						<?php
					}else{
						?>
						<button data-remodal-action="cancel" class="btn btn-default"><strong>Close</strong></button>
						<?php

					}?>

				</div>

                <!-- ####################################################### -->
                <div class="remodal" data-remodal-id="modal-forward-payment">
                    <button data-remodal-action="close" class="remodal-close"></button>
                    <p>
                        <?php
                        if (@$forwardPaymentResponds!= null){
                            if(@$fail_message!=null){
                                print_r('<strong>'.@$fail_message.'</strong>');
                            }

                        }
                        elseif(@$status=='inprocess'){
                            print_r('You are about to forward amount for transaction <strong>Layby#'. $transaction_id.'</strong>');
                        }else{
                            print_r('<strong>Layby#'. $transaction_id.' </strong>Cancelled');
                        }?>
                        <?php ;?>
                    </p>
                    <br>

                    <?php
                    if (@$forwardPaymentResponds != null){

                        print_r('<button data-remodal-action="cancel" class="btn btn-default"><strong>Close</strong></button>');

                    }
                    elseif(@$status=='inprocess'){
                        print_r($forwardPaymentForm);
                        ?>
                        <button data-remodal-action="cancel" class="btn btn-default"><strong>CLOSE</strong></button>
                        <?php
                    }else{
                        ?>
<!--                        <button data-remodal-action="cancel" class="btn btn-default"><strong>Close</strong></button>-->
                        <?php

                    }?>

                </div>
                <!-- ####################################################### -->

				<!-- Features 3 -->
			</div>
			<hr /></p>
				<!-- Features 3 -->
			</div>
			<p>&nbsp;</p>
		</div>
	</div>
</section>
<?php
}
else {


	?>
	<section class="page-section">
		<div  id="divToPrint" class="container">
			<div class="row">

				<h1>Transaction Details - #<?php print_r($layby_data['product_ref']);?></h1>


			</div>
			<div class="row">
				<div class="row responsive-features top-pad-20">
					<!-- Features 1 -->
					<div class="col-md-4">
						<!-- Title And Content -->
						<span class="text-color"></span>
						<p><strong>Customer Details</strong>&nbsp;</p>
						<p>Name: <?php print_r($first_name);?> <?php print_r($last_name);?></p>
						<p>Cell Number: <?php print_r($cellNo);?></p>
						<p>Email Address: <?php print_r($email);?> </p>
					</div>
					<!-- Features 1 -->
					<!-- Features 2 -->
					<div class="col-md-4">
						<!-- Title And Content -->
						<span class="text-color"></span>
						<h5>&nbsp;</h5>
					</div>
					<!-- Features 2 -->
					<!-- Features 3 -->
					<div class="col-md-4">
						<!-- Title And Content -->
						<span class="text-color"></span>
						<p align="right"><strong>Product Details</strong></p>
						<p align="right"><?php print_r($ProductName);?> @ R<?php print_r($price);?></p>
						<p align="right"><strong>Status: <?php
								if(@$status=='inprocess' and $depositMade=='No'){
									print_r('Awaiting Deposit');

								}
								if(@$status=='cancelled'){

									print_r('Cancelled');
								}
								if(@$status=='inprocess' and $depositMade=='Yes'){
									print_r('Processing');
								}elseif(@$status=='completed' and @$depositMade=='Yes'){

									print_r('Completed');
								}
								?></strong></p>
						<p align="right"><strong>TOTAL: R<?php print_r($price);?></strong></p>
					</div>
					<!-- Features 3 -->
				</div>
				<p>&nbsp;</p>
				<p>&nbsp; </p>
				<p></p>
				<table class="table">
					<caption>
					</caption>
					<thead>
					<tr>
						<th>Date</th>
						<th>Description</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Balance</th>
					</tr>
					</thead>
					<tbody>


					<tr>

						<?php
						include 'functions/viewTransactions.php';

						$cancelForm = '
						      <form autocomplete="off" name="cancelForm" action="transactions?id='.@base64_encode($consumer_id).'&transaction_id='.@base64_encode($transaction_id).'&status=cancelled#modal" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                            <input required type="hidden" name="product_ref" value="'.$transaction_id.'" class="form-control">
                            <input required type="hidden" name="refund" value="'.round($deduct).'" class="form-control">
                            <input required type="hidden" name="ismerchant" value="1" class="form-control">
                            <textarea required type="" placeholder="Please type cancellation message" name="cancelMessage" value="" rows="3" class="form-control"></textarea>
                            <input required type="hidden" name="consumer_id" value="'.$consumer_id.'" class="form-control">
                            <button  type="submit" name="cancelLayby" class="btn btn-default"><strong>Yes</strong></button>
                           </h5>';
						?>


					</tr>
					</tbody>
				</table>
				<hr /></p>
				<p>&nbsp;</p>

				<div class="row responsive-features top-pad-20">
					<!-- Features 1 -->

					<?php if($status!='cancelled'){

						if(@$status!='completed'){

						?>
					<div class="col-md-4">
						<!-- Title And Content -->
						<span class="text-color"></span>
						<h5><a data-remodal-target="modal" class="btn btn-default">CANCEL TRANSACTION</a></h5>
						<h5><a href="javascript:history.go(-1)" class="btn btn-default">BACK</a></h5>
						<h5><input type="button" value="PRINT" class="btn btn-default" onclick="PrintDiv();" /></a></h5>
						</span>
					</div>
							<?php	}else{?>

						<div class="col-md-4">
							<!-- Title And Content -->
							<span class="text-color"></span>

							</span>
						</div><?php }?>
					<!-- Features 1 -->
					<!-- Features 2 -->
					<div class="col-md-4">
						<!-- Title And Content -->
						<span class="text-color"></span>

					</div>
					<!-- Features 2 -->
					<!-- Features 3 -->
					<?php if($status=='completed'){?>
					<div class="col-md-4" align="right">
						<!-- Title And Content -->
						<span class="text-color"></span>
						<h5><a href="/acc/generate-button" class="btn btn-default">RELEASE GOODS</a></h5>
					</div>
					<?php }?>
					<?php }?>

					<div class="remodal" data-remodal-id="modal">
						<button data-remodal-action="close" class="remodal-close"></button>
						<?php

						$status = @$_GET['status'];

						if(@$status!='cancelled'){
							print_r('<h2>Cancel Layby</h2>');}
						else{

							$redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }

                                    setTimeout(\'Redirect()\', 3000);
                                    </script>';

							print_r($redirect);

							?>
						<?php print_r('<h2>Success</h2>');}?>
						<p>
							<?php
							if(@$status!='cancelled' or @$cancelCode!="325"){
								print_r('Are you sure that you want to cancel <strong>Layby#'. $transaction_id.'</strong>');
							}else{
								print_r('Layby#'. $transaction_id.' Cancelled');
							}?>
							 <?php ;?>
						</p>
						<br>

						<?php
						if(@$status!='cancelled'){
							print_r($cancelForm);
					?>
							<button data-remodal-action="cancel" class="btn btn-default"><strong>Don't Cancel</strong></button>
						<?php
						}else{
						?>
							<button data-remodal-action="cancel" class="btn btn-default"><strong>Close</strong></button>
							<?php

						}?>

					</div>
					<!-- Features 3 -->
				</div>

			</div>
		</div>
	</section>

	<?php
}

include_once 'footer.php';
?>
<script>
	function myFunction() {
		document.getElementById("cancelForm").submit();
	}
</script>