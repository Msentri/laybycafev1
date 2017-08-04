<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';

if($roleSession=='branch'){
    $username = array(
        'username'=>$_SESSION['inStore_Session']
    );
}else{
    $username = array(
        'username'=>$consumerID
    );
}

$profile = $api->get("/searchprofile",$username);

$monthsInfo = json_decode($profile->response);

$period = @$monthsInfo->maximum_period;

require 'functions/searchUser.php';
require 'functions/merchantCreateLayby.php';

$error = @$userInfo->code;
$contact = @$userInfo->userName;
$customerID = @$userInfo->merchant_id;
$id_no = @$userInfo->id_no;
$first_name = @$userInfo->first_name;
$last_name = @$userInfo->last_name;
$email = @$userInfo->email;
$cellNo = @$userInfo->cellNo;
$isRoleMerchant = @$userInfo->role;

if(@$isRoleMerchant=='instore'){
    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="retail";
                                    }
                                    setTimeout(\'Redirect()\', 500);
                                    </script>';

    print_r($redirect);
}
?>

<section class="page-section" xmlns="http://www.w3.org/1999/html">
	<?php
if($storeErrorCode==606){

		print_r('<div class="alert alert-info" role="alert">
				  Please add the store name to create new laybys, click <a href="profile" class="alert-link">profile</a> to add a store
				</div>');
	}else{
	if(@$verifiedAccount == "Y" or $isRoleMerchant != 'branch'){
	?>
		<div class="container">
			<div class="remodal-bg">

				<?php if(@$storeErrorCode==602){

					$popup ='
    <div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>

		<h2>Add Failed</h2>
		<p>
			email<strong> '.@$email.'</strong> already exists, please use another email
			<br>

			<button data-remodal-action="cancel" class="btn btn-default"><strong>Close</strong></button>

	</div>
    ';

					print_r($popup);

				}?>
			<div class="row">
				<div class="content col-sm-12 col-md-4">

				</div>

				<div class="col-sm-10 col-md-4">

					<?php
					if(@$error == '501' and $isRoleMerchant != 'merchant'){
						?>
						<form class="light-bg contact-form pad-40" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
							<div class="row" role="form">
								<div class="col-md-4"><b>Step 2</b></div>
								<div class="col-md-6">Create Customer</div>
							</div>
							<label>First Name</label>
							<input required class="form-control" type="text" name="first_name" placeholder="Name *" id="register_name" />
							<label>Last Name *</label>
							<input required class="form-control" type="text" name="last_name" placeholder="Surname *" id="register_surname" />
							<label>ID Number/Passport *</label>
							<input required name="id_no" type="text" value="" class="form-control" id="id_no" placeholder="ID Number *" />
							<div class="row" role="form">
								<div class="col-md-6">
									<label>Contact *</label>
									<input required name="user" readonly type="text" value="<?php print_r($contact); ?>" class="form-control" id="user" placeholder="user *" />
								</div>
							</div>
							<?php
							if(filter_var(@$contact, FILTER_VALIDATE_EMAIL)){
							?>
							<div class="row" role="form">
								<div class="col-md-6">
									<label>Phone </label>
									<input required type="text"  class="form-control"  value="" name="phone"/>
								</div>
							</div>
								<?php }else{
								 ?>
								<div class="row" role="form">
									<div class="col-md-6">
										<label>email </label>
										<input type="text"  class="form-control"  value="" name="email"/>
									</div>
								</div>
								<?php } ?>

							<div class="row" role="form">
								<div class="col-md-6">
									<input required name="role" type="hidden" class="form-control"  value="consumer"/>
								</div>
							</div>
							<div class="clearfix"></div>
							<button type="submit" name="register" class="btn btn-default">Continue</button>
							<!-- .buttons-box --></form>

						<?php
					}else{
					if(@$customerID == null and @$ref_no == null){ ?>
						<form class="light-bg contact-form pad-40" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
							<div class="row" role="form">
								<div class="col-md-4"><b> Step 1</b></div>
								<div class="col-md-6">Phone/Email</div>
							</div>

							<p align="center">
								<input name="username" type="text" class="form-control" value="">
								<button type="submit" class="btn btn-default" name="searchUser">Search</button>
							</p></form>

					<?php }
					elseif($customerID != null and $isRoleMerchant != 'merchant' and $isRoleMerchant != 'instore'and $isRoleMerchant != 'branch'){
						?>
						<div id="success"></div>
						<form class="light-bg contact-form pad-40" action="retail?consumer_id=<?php print_r($customerID);?>&trans=<?php print_r($OTP);?>" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
							<div class="row" role="form">
								<div class="col-md-4"><b>Step 2</b></div>
								<div class="col-md-6">Customer Details</div>
								<input type="hidden" readonly value="<?php print_r($consumerID);?>" name="consumer_id"/>
								<label>First Name *</label>
								<p><?php print_r($first_name);?></p>
								<!--<input type="hidden" readonly class="form-control"  value="<?php /*print_r($first_name);*/?>" name="first_name"/>-->
								<label>Last Name *</label>
								<p><?php print_r($last_name);?></p>
								<!--<input type="hidden" readonly class="form-control"  value="<?php /*print_r($last_name);*/?>" name="last_name"/>-->
								<label>ID Number/Passport *</label>
								<?php
								if($id_no == Null){
									?>
									<input type="text"  class="form-control"  value="" name="id_no"/>
									<?php
								} else{?>
									<p><?php print_r($id_no);?></p>
									<!--<input type="hidden" readonly class="form-control"  value="<?php /*print_r($id_no);*/?>" name="id_no"/>-->
									<?php
								}
								?>
								<label>Phone *</label>
								<?php
								if($cellNo == Null){
									?>
									<input type="text"  class="form-control"  value="" name="phone"/>
									<?php
								} else{?>
									<p><?php print_r($cellNo);?></p>
									<!--<input type="hidden" readonly class="form-control"  value="<?php /*print_r($cellNo);*/?>" name="phone"/>-->
									<?php
								}
								?>
								<label>Email </label>
								<?php
								if($email == Null){
									?>
									<input type="text"  class="form-control"  value="" name="email"/>
									<?php
								} else{?>
									<p><?php print_r($email);?></p>
<!--									<input type="hidden" readonly class="form-control"  value="<?php /*print_r($email);*/?>" name="email"/>
-->									<?php
								}
								?>

								<p style="font-size:12px" align="center"><b>Note:</b> The customer details as listed above must appear as per ID document.</p>
								<div class="row" role="form">

									<div align="center">
										<button type="submit" class="btn btn-default" name="next">Next</button>
									</div>
								</div></form>

						<?php
					}
					elseif($isRoleMerchant != 'merchant'){

					?>
					<form class="light-bg contact-form pad-40" action="retail?#modal" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
						<div class="row" role="form">
                            <div class="col-md-12"><h5><?php print_r(@$userUpdateMessage) ?></h5></div>
							<div class="col-md-4"><b><a name="step4" id="step4"> Step 3</a></b></div>
							<div class="col-md-8">Product Details</div>
						</div>
						<br/>
						<label>Order ID (Invoice Number) *</label>
						<input type="hidden" readonly value="<?php print_r($customerKey);?>" name="consumer_id"/>
						<input name="order_id" required type="text" class="form-control" id="exampleInputEmail2" value="" />
						<input name="store" type="hidden" class="form-control" id="exampleInputEmail2" value="<?php print_r($store_name);?>" />
						<label>Product Description *</label>
						<textarea required name="std" type="text" class="form-control" id="exampleInputEmail2" ols="" rows=""></textarea>
						<label>Total Amount *</label>
						<input name="sum1" required class="form-control" id="op1" value="" onChange="calc(this.value,'op2','result')">
						<p ><input type="hidden"  name="sum2" class="form-control" value="0.20" id="op2" onChange="calc(this.value,'op1','result')"></p>
						<p style="font-size:20px; text-align: center;" align="center">R<input name="deposit"  value="" id="result" readonly style="border:0px;"></p>
						<p style="font-size:10px" align="center">Deposit amount.</p>
						<div class="row" role="form">
							<div align="center">
								<button type="submit" class="btn btn-default" name="cart">Process Transaction</button>
							</div></div>
						<?php

						}}?>


					</form></div>
			</div></div>
	<?php }
	else{
		?>
			<div class="container">

				<div class="row">
					<div class="content col-sm-12 col-md-8">
						<div class="alert alert-danger" role="alert">Please <strong>update</strong> your Business Information.
							<a href="profile" class="alert-link">Click Here</a> to get started.
						</div>
					</div>
				</div>
			</div>
		<?php
	}
	}?>

			</div>
</section>

	<?php


include_once 'footer.php';
?>
<script>
	function myFunction() {
		document.getElementById("cancelForm").submit();
	}
</script>

<script type="text/javascript">
	var lol = document.getElementById('lolz');
	function kk() {
		document.getElementById('deposit_value').innerHTML = 'R'+ Math.round(lol.value * 0.2);
	}

</script>

<script type="text/javascript"><!--
	function updatesum() {
		document.form.sum.value = (document.form.sum1.value -0) * (document.form.sum2.value -0);
	}
	//--></script>