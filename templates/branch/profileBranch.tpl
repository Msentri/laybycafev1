<section id="container" class="page-section container">
    <div class="container">
        <div class="remodal-bg">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav  nav-tabs ">

                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                                Branch Profile</a>
                        </li>

                        <li><?php 	if(@$verifiedAccount == "Y") {
						?>
                            <a href="#tab2" data-toggle="tab">
                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>

                                <?php
						if(@$passChange=='1'){
							print_r('Confirm Password');
						}else{
							print_r('Change Password');
						}
						?>
                            </a>
                        </li><?php }?>
                        <li>
                            <a href="#tab3" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Branch Details</a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Bank and Wallet</a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Branch Documents</a>
                        </li>
                        <li>
                            <a href="#tab6" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Notification</a>
                        </li>
                        <li>
                            <a href="#tab7" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Branch Users</a>
                        </li>
                    </ul>
                    <div  class="tab-content mar-top">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">

                                                Branch Profile
                                            </h3>

                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-4">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail img-max"">
                                                    <img data-src="<?php print_r(@$logo)?>" alt="..." src="<?php print_r(@$logo)?>">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>Full Name</td>
                                                            <td>
                                                                <?php print_r(@$first_name." ". @$last_name)?>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Business Name</td>
                                                            <td>
                                                                <?php print_r(@$businessName)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Type</td>
                                                            <td>
                                                                <?php print_r(@$businessType)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Vat Number</td>
                                                            <td>
                                                                <?php print_r(@$vatNumber)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reg Number</td>
                                                            <td>
                                                                <?php print_r(@$regNumber)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>E-mail</td>
                                                            <td>
                                                                <?php print_r(@$email)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>
                                                                <?php print_r(@$phone)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                <?php print_r(@$businessAddress)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>
                                                                <?php

															if(@$activeAccount == "Y")
															{
																print_r('Active');
															}
															else{

																print_r('Not Active');
															}
															?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Verified</td>
                                                            <td>
                                                                <?php

															if(@$verifiedAccount == "Y")
															{
																print_r('Yes');
															}
															else{

																print_r('No');
															}
															?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Max Period</td>
                                                            <td>
                                                                <?php

															if(@$verifiedAccount == "Y")
															{
																$periodForm ='
															<form method="post">
                                                                <select name="period" class="form-control" onchange="this.form.submit()">
                                                                    <option selected value="'.$maximumPeriod.'">'.$maximumPeriod.'</option>
                                                                    <option value="'.$maximumPeriod.'">----------</option>
                                                                    <option value="2 Months">2 Months</option>
                                                                    <option value="3 Months">3 Months</option>
                                                                    <option value="6 Months">6 Months</option>
                                                                    <option value="12 Months">12 Months</option>

                                                                </select>
                                                                </form>
                                                                ';
                                                                print_r($periodForm);
                                                                }
                                                                else{

                                                                print_r('account not verified');
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">								<div class="form-body">

                                        <div class="form-actions">
                                            <div class="col-md-offset-3 col-md-9">

                                                <button name="passChange" type="submit" class="btn btn-default">Change Password</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">

                                            Branch Details
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="business_name" class="control-label col-md-3">Business Name:</label>
                                                        <div class="col-md-9">
                                                            <?php if(@$businessName != null){
															?>
                                                            <input required type="text" readonly placeholder="Business Name" name="business_name" value="<?php print_r(@$businessName) ?>" class="form-control">
                                                            <?php }else
														{?>
                                                            <input type="text" required placeholder="Business Name" name="business_name" value="" class="form-control">

                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="business_type" class="control-label col-md-3">Business Type:</label>
                                                        <div class="col-md-9">
                                                            <?php if(@$businessType != null){
															?>
                                                            <input type="text" required readonly placeholder="Business Type" name="business_type" value="<?php print_r(@$businessType) ?>" class="form-control">
                                                            <?php }else
														{?>
                                                            <input required type="text" placeholder="Business Type" name="business_type" value="" class="form-control">

                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vat_number" class="control-label col-md-3">Vat Number:</label>
                                                        <div class="col-md-9">
                                                            <?php if(@$vatNumber != null){
															?>
                                                            <input type="text" required readonly placeholder="Vat Number" name="vat_number" value="<?php print_r(@$vatNumber) ?>" class="form-control">
                                                            <?php }else
														{?>
                                                            <input type="text" required placeholder="Vat Number" name="vat_number" value="" class="form-control">

                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_number" class="control-label col-md-3">Reg Number:</label>
                                                        <div class="col-md-9">
                                                            <?php if(@$regNumber != null){
															?>
                                                            <input type="text" required readonly placeholder="Reg Number" name="reg_number" value="<?php print_r(@$regNumber) ?>" class="form-control">

                                                            <?php }else
														{?>
                                                            <input type="text" required placeholder="Reg Number" name="reg_number" value="" class="form-control">

                                                            <?php }?>
                                                        </div></div>
                                                    <div class="form-group">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <label class="checkbox-inline mar-left5">
                                                                <input type="checkbox" value="news">Send me latest news and updates.</label>
                                                        </div>
                                                    </div>

                                                    <br>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName" class="control-label col-md-3">Website:</label>
                                                    <div class="col-md-9">
                                                        <?php if(@$website != null){
													?>
                                                        <input type="text" placeholder="website" name="website" value="<?php print_r(@$website) ?>" class="form-control">
                                                        <?php }else{?>
                                                        <input type="text" placeholder="website" name="website" value="" class="form-control">

                                                        <?php }?>

                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="phoneNumber" class="control-label col-md-3">Phone:</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" required placeholder="Phone Number" name="phone" value="<?php print_r(@$phone) ?>" class="form-control"></div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="businessAddress" class="control-label col-md-3">Business Address:</label>
                                                    <div class="col-md-9">
                                                        <textarea required placeholder="Business Address" name="businessAddress" class="form-control" rows="3"><?php print_r(@$businessAddress) ?></textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <div class="col-md-offset-3 col-md-9">
                                                            <span class="btn btn-default btn-file">
                                                                <?php if(@$logo!=null){
                                                                ?>
                                                                <span class="fileinput-new">Replace logo(Optional)</span>
                                                                <input type="file" name="logo"></span>
                                                        <?php }
                                                                else{
                                                                    ?>
                                                        <span class="fileinput-new">Select logo</span>
                                                        <input required type="file" name="logo"></span>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <label class="checkbox-inline mar-left5">
                                                            <?php if(@$logo!=null){ ?>
                                                            <input checked required type="checkbox" value="agree">
                                                            <?php }
                                                                else{ ?>
                                                            <input required type="checkbox" value="agree">
                                                            <?php }?>
                                                            I agree to the <a href="#">Terms and Conditions</a>.
                                                        </label>
                                                    </div>
                                                </div>
                                                <button name="btn-update" type="submit" class="btn btn-default">Confirm</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            Payout Details
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <?php

									$bankDetails = '
<div class="row responsive-features top-pad-20 panel panel-default">
                                        <!-- Features 1 -->
                                        <div class="col-md-6">
                                            <p>Account Holder: <strong>'.@$accountHolder.'</strong></p>
                                            <p>Bank: <strong>'.@$bankName.'</strong></p>
                                            <p>Account: <strong>'.@$bankAccount.'</strong></p>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Title And Content -->
                                            <span class="text-color"></span>
                                            <p align="right">&nbsp;</p>
                                            <p align="right">&nbsp;</p>
                                            <p align="right"><strong>Balance: R'.@$inprocess.'</strong></p>
                                            <p align="right"><strong>Available Balance: R'.@$walletAmount.' </strong></p>

                                        </div>
                                        <!-- Features 3 -->
                                    </div></div>';


                                ?>
                                <div class="row">
                                    <div class="col-md-6">


                                        <?php
											if(@$accountHolder == null){
											?>
                                         </div>

                                    </form>
                                    <?php }else{
											print_r(@$bankDetails);
										}?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                <?php
                                    $bankDetails = '
                                <div class="panel-heading">
                                <h3 class="panel-title">
                                    Payout Schedule
                                </h3>
                            </div>
                            <div class="row responsive-features top-pad-20 panel panel-default">
                                <!-- Features 1 -->
                                <div class="col-md-6">
                                    <form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                                        <select name="payoutFrequency" class="form-control">
                                            <option selected value="'.@$frequency.'">'.@$frequency.'</option>
                                            <option value="'.@$maximumPeriod.'">----------</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Fortnightly">Fortnightly</option>
                                            <option value="Monthly">Months</option>
                                        </select>
                                        <input name="amount" required type="text" class="form-control" placeholder="amount">
                                        <button name="addSchedule" type="submit" class="btn btn-default">Add Schedule</button>


                                    </form>


                                </div>

                                <div class="col-md-6">
                                    <!-- Title And Content -->

                                    <p>Payout frequency: '.@$frequency.' </p>
                                    <p>Min amount: '.@$amount.'</p>
                                    <p>Payout date: '.@$date.'</p>
                                    <p>Payment will only be triggered once the selected minimum amount of R'.@$amount.' becomes available.</p>


                                </div>
                                <!-- Features 3 -->
                            </div></div>';


                        ?>
                        <div class="row">
                            <div class="col-md-6">


                                <?php
                                            if(@$accountHolder == null){
                                            ?>
                                <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">

                                    <div class="form-group">
                                        <label for="lastName" class="control-label col-md-3">Account Holder:</label>
                                        <div class="col-md-9">
                                            <?php if(@$accountHolder != null){
                                                            ?>
                                            <input type="text" readonly placeholder="Account Holder" name="account_holder" value="<?php print_r(@$accountHolder) ?>" class="form-control">
                                            <?php }else{?>
                                            <input type="text" placeholder="Account Holder" name="account_holder" value="" class="form-control">

                                            <?php }?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_type" class="control-label col-md-3">Bank Account:</label>
                                        <div class="col-md-9">
                                            <?php if(@$bankAccount != null){
                                                            ?>
                                            <input type="text" required readonly placeholder="Bank Account" name="bank_account" value="<?php print_r(@$bankAccount) ?>" class="form-control">
                                            <?php }else
                                                        {?>
                                            <input required type="text" placeholder="Bank Account" name="bank_account" value="" class="form-control">

                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="business_name" class="control-label col-md-3">Bank Name:</label>
                                        <div class="col-md-9">
                                            <?php if(@$bankName != null){
                                                            ?>
                                            <input required type="text" readonly placeholder="Bank Name" name="bank_name" value="<?php print_r(@$bankName) ?>" class="form-control">
                                            <?php }else
                                                        {?>
                                            <input type="text" required placeholder="Bank Name" name="bank_name" value="" class="form-control">

                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_number" class="control-label col-md-3">Branch Name:</label>
                                        <div class="col-md-9">
                                            <?php if(@$branchName != null){
                                                            ?>
                                            <input type="text" required readonly placeholder="Branch Name" name="branch_name" value="<?php print_r(@$branchName) ?>" class="form-control">

                                            <?php }else
                                                        {?>
                                            <input type="text" required placeholder="Branch Name" name="branch_name" value="" class="form-control">

                                            <?php }?>
                                        </div></div>
                                    <div class="form-group">
                                        <label for="vat_number" class="control-label col-md-3">Branch Code:</label>
                                        <div class="col-md-9">
                                            <?php if(@$branchCode != null){
                                                            ?>
                                            <input type="text" required readonly placeholder="Branch Code" name="branch_code" value="<?php print_r(@$branchCode) ?>" class="form-control">
                                            <?php }else
                                                        {?>
                                            <input type="text" required placeholder="Branch Code" name="branch_code" value="" class="form-control">

                                            <?php }?>
                                        </div>
                                    </div>



                                    <br>
                                    <div class="form-group">
                                        <button name="addBank" type="submit" class="btn btn-default">Add</button>
                                    </div>

                            </div>

                            </form>
                            <?php }else{
                                            print_r(@$bankDetails);
                                        }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tab5" class="tab-pane fade">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">

                            Branch Documents
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <div id="content">

                                        <tr>
                                            <th>
                                                <i class="fa "></i>
                                                File Name
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                File Replaced
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                Size
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                Type
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                Extension
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                File Date
                                            </th>

                                        </tr>


                                        <?php include 'functions/getFiles.php'; ?>
                                </table>
                                <form  method="post" enctype="multipart/form-data">
                                    <input required type="file" name="files[]" id="filer_input" multiple="multiple">
                                    <input type="submit" name="upload" class="btn btn-default" value="Submit">
                                </form>
                            </div>
                            <div class="panel panel-default">
                                <h3 class="panel-title">Notes</h3>
                                <div class="panel-body">
                                    <ul>
                                        <li>The maximum file size for uploads is <strong>5000 KB</strong> .</li>
                                        <li>Only image and PDF files (<strong>JPG, PNG, PDF</strong>) are allowed.</li>
                                        <li>Uploaded files will be verified after <strong>30 minutes or less</strong> .</li>
                                        <li>You can upload up to 4 files from your desktop on this webpage.</li>
                                        <li>Please upload the following documents :
                                            <p>
                                            <ol>
                                                <strong><li>ID Document</li></strong>
                                                <strong><li>Bank Statement</li></strong>
                                                <strong><li>Proof Of Residence</li></strong>
                                                <strong><li>Business Reg e.g CKS Documents</li></strong>

                                            </ol></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tab6" class="tab-pane fade">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">

                            Notification Emails
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <div id="content">

                                        <tr>
                                            <th>
                                                <i class="fa "></i>
                                                Full Name
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                Email
                                            </th>
                                            <th>
                                                <i class="fa fa-bookAiri Satou"></i>
                                                Notification Type
                                            </th>

                                        </tr>


                                        <?php include 'functions/getNotifications.php'; ?>
                                </table>
                                <form action="profile?tab=6" method="post" enctype="multipart/form-data">
                                    <div class="row" role="form">
                                        <label for="vat_number" class="control-label col-md-3">Full Name:</label>
                                        <div class="col-md-6">
                                            <input required type="text" placeholder="Full Name" class="form-control" name="full_name" id="full_name" >
                                        </div>
                                    </div>
                                    <div class="row" role="form">
                                        <label for="vat_number" class="control-label col-md-3">email:</label>
                                        <div class="col-md-6">
                                            <input required type="text" name="email" placeholder="email" id="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row" role="form">
                                        <label for="vat_number" class="control-label col-md-3">Notification Type:</label>
                                        <div class="col-md-6">
                                            <select required name="type" class="form-control">
                                                <option selected value="admin">All Transaction Notifications</option>
                                                <option value="payment">Deposit Paid</option>
                                                <option value="layby complete">Transaction  complete</option>
                                                <option value="layby canceled">Transaction  canceled</option>

                                            </select>
                                        </div>
                                    </div>
                                    <input type="submit" name="addEmail" class="btn btn-default" value="Add Email">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tab7" class="tab-pane fade">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">

                            Users
                        </h3>

                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="users">

                                        <tr>
                                            <th>Branch Name</th>
                                            <th>User Name</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                include 'functions/branch_/getBranchUsers.php';
                                                ?>
                                        </tbody>
                                    </table>
                                </div></div>
                                <div class="col-md-4">
                                <form autocomplete="off" method="post" accept-charset="UTF-8" class="form-horizontal">
                                    <input name="username" required type="text" class="form-control" placeholder="username">
                                    <input name="password" required type="password" class="form-control" placeholder="password">
                                    <button name="addUser" type="submit" class="btn btn-default">Add User</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>