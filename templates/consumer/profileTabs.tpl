<?php
if(@$_GET['tab'] == null){
?>
<div id="tab1" class="tab-pane fade active in">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                        Consumer Profile
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
                                    <td>E-mail</td>
                                    <td>
                                        <?php print_r(@$email)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>
                                        <?php print_r(@$cellNo)?>
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
            <form method="post" action="profile?tab=2#modal"  accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">								<div class="form-body">

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

                        Update Details
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">

                                <br>
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label col-md-3">Phone:</label>
                                    <div class="col-md-9">
                                        <input type="tel" required placeholder="Phone Number" name="phone" value="<?php print_r(@$cellNo) ?>" class="form-control"></div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="businessAddress" class="control-label col-md-3">Address:</label>
                                    <div class="col-md-9">
                                        <textarea required placeholder="Address" name="businessAddress" class="form-control" rows="3"><?php print_r(@$businessAddress) ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select Picture</span>
                                                                <?php if($logo!=null){
                                                                ?>
                                                                <input type="file" name="logo"></span>
                                        <?php }
                                            else{
                                                ?>
                                        <input type="file" name="logo"></span>
                                        <?php }?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <label class="checkbox-inline mar-left5">
                                            <input required type="checkbox" value="agree">
                                            I agree to the <a href="#">Terms and Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <button name="btn-update" type="submit" class="btn btn-default">Confirm</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <label class="checkbox-inline mar-left5">
                                        <input type="checkbox" value="news">Send me latest news and updates.</label>
                                </div>
                            </div>

                            <br>
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
                        <p align="right"><strong>Balanced: R'.@$walletBalance.'</strong></p>
                        <p align="right"><strong>Available Balance: R'.@$walletAmount.'.00 </strong></p>

                    </div>
                    <!-- Features 3 -->
                </div></div>

            <div class="col-md-4">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Request Payout
                    </h3>

                </div>
                <form method="post" action="profile?tab=4#modal" accept-charset="UTF-8" enctype="multipart/form-data" role="form"class="form-horizontal">
                    <input type="text" placeholder="Request Amount" name="amount" value="" class="form-control">
                    <button name="payOut" type="submit" class="btn btn-default">Pay Out</button>
                </form>
            </div>
            ';

            ?>
            <div class="row">
                <div class="col-md-6">


                    <?php

                                         if(@$accountHolder == null){
                                                    ?>
                    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="business_name" class="control-label col-md-3">Bank Name:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Bank Name" name="bank_name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="control-label col-md-3">Account Holder:</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Account Holder" name="account_holder" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_type" class="control-label col-md-3">Account No:</label>
                            <div class="col-md-9">
                                <input required type="text" placeholder="Bank Account" name="bank_account" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vat_number" class="control-label col-md-3">Branch Code:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Branch Code" name="branch_code" value="" class="form-control">
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
<?php
    //Gets tab 2//
}
elseif(@$_GET['tab']==2){

  ?>
<div id="tab1" class="tab-pane fade">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                        Consumer Profile
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
                                    <td>E-mail</td>
                                    <td>
                                        <?php print_r(@$email)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>
                                        <?php print_r(@$cellNo)?>
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
<div id="tab2" class="tab-pane active fade in">
    <div class="row">
        <div class="col-md-12 pd-top">
            <form method="post" action="profile?tab=2#modal"  accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">								<div class="form-body">

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

                        Update Details
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">

                                <br>
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label col-md-3">Phone:</label>
                                    <div class="col-md-9">
                                        <input type="tel" required placeholder="Phone Number" name="phone" value="<?php print_r(@$cellNo) ?>" class="form-control"></div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="businessAddress" class="control-label col-md-3">Address:</label>
                                    <div class="col-md-9">
                                        <textarea required placeholder="Address" name="businessAddress" class="form-control" rows="3"><?php print_r(@$businessAddress) ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select Picture</span>
                                                                <?php if($logo!=null){
                                                                ?>
                                                                <input type="file" name="logo"></span>
                                        <?php }
                                            else{
                                                ?>
                                        <input type="file" name="logo"></span>
                                        <?php }?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <label class="checkbox-inline mar-left5">
                                            <input required type="checkbox" value="agree">
                                            I agree to the <a href="#">Terms and Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <button name="btn-update" type="submit" class="btn btn-default">Confirm</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <label class="checkbox-inline mar-left5">
                                        <input type="checkbox" value="news">Send me latest news and updates.</label>
                                </div>
                            </div>

                            <br>
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
                        <p align="right"><strong>Balance: R'.@$walletBalance.'</strong></p>
                        <p align="right"><strong>Available Balance: R'.@$walletAmount.'.00 </strong></p>

                    </div>
                    <!-- Features 3 -->
                </div></div>

            <div class="col-md-4">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Request Payout
                    </h3>

                </div>
                <form method="post" action="profile?tab=4#modal" accept-charset="UTF-8" enctype="multipart/form-data" role="form"class="form-horizontal">
                    <input type="text" placeholder="Request Amount" name="amount" value="" class="form-control">
                    <button name="payOut" type="submit" class="btn btn-default">Pay Out</button>
                </form>
            </div>
            ';

            ?>
            <div class="row">
                <div class="col-md-6">


                    <?php

                                         if(@$accountHolder == null){
                                                    ?>
                    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="business_name" class="control-label col-md-3">Bank Name:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Bank Name" name="bank_name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="control-label col-md-3">Account Holder:</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Account Holder" name="account_holder" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_type" class="control-label col-md-3">Account No:</label>
                            <div class="col-md-9">
                                <input required type="text" placeholder="Bank Account" name="bank_account" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vat_number" class="control-label col-md-3">Branch Code:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Branch Code" name="branch_code" value="" class="form-control">
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
<?php
    //Gets tab 3//
}elseif(@$_GET['tab']==3){
    ?>
<div id="tab1" class="tab-pane fade">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                        Consumer Profile
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
                                    <td>E-mail</td>
                                    <td>
                                        <?php print_r(@$email)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>
                                        <?php print_r(@$cellNo)?>
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
            <form method="post" action="profile?tab=2#modal"  accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">								<div class="form-body">

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
<div id="tab3" class="tab-pane fade active in">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                        Update Details
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">

                                <br>
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label col-md-3">Phone:</label>
                                    <div class="col-md-9">
                                        <input type="tel" required placeholder="Phone Number" name="phone" value="<?php print_r(@$cellNo) ?>" class="form-control"></div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="businessAddress" class="control-label col-md-3">Address:</label>
                                    <div class="col-md-9">
                                        <textarea required placeholder="Address" name="businessAddress" class="form-control" rows="3"><?php print_r(@$businessAddress) ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select Picture</span>
                                                                <?php if($logo!=null){
                                                                ?>
                                                                <input type="file" name="logo"></span>
                                        <?php }
                                            else{
                                                ?>
                                        <input type="file" name="logo"></span>
                                        <?php }?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <label class="checkbox-inline mar-left5">
                                            <input required type="checkbox" value="agree">
                                            I agree to the <a href="#">Terms and Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <button name="btn-update" type="submit" class="btn btn-default">Confirm</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <label class="checkbox-inline mar-left5">
                                        <input type="checkbox" value="news">Send me latest news and updates.</label>
                                </div>
                            </div>

                            <br>
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
                        <p align="right"><strong>Balance: R'.@$walletBalance.'</strong></p>
                        <p align="right"><strong>Available Balance: R'.@$walletAmount.'.00 </strong></p>

                    </div>
                    <!-- Features 3 -->
                </div></div>

            <div class="col-md-4">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Request Payout
                    </h3>

                </div>
                <form method="post" action="profile?tab=4#modal" accept-charset="UTF-8" enctype="multipart/form-data" role="form"class="form-horizontal">
                    <input type="text" placeholder="Request Amount" name="amount" value="" class="form-control">
                    <button name="payOut" type="submit" class="btn btn-default">Pay Out</button>
                </form>
            </div>
            ';

            ?>
            <div class="row">
                <div class="col-md-6">


                    <?php

                                         if(@$accountHolder == null){
                                                    ?>
                    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="business_name" class="control-label col-md-3">Bank Name:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Bank Name" name="bank_name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="control-label col-md-3">Account Holder:</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Account Holder" name="account_holder" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_type" class="control-label col-md-3">Account No:</label>
                            <div class="col-md-9">
                                <input required type="text" placeholder="Bank Account" name="bank_account" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vat_number" class="control-label col-md-3">Branch Code:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Branch Code" name="branch_code" value="" class="form-control">
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
<?php
}elseif(@$_GET['tab']==4){
?>
<div id="tab1" class="tab-pane fade">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">

                        Consumer Profile
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
                                    <td>E-mail</td>
                                    <td>
                                        <?php print_r(@$email)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>
                                        <?php print_r(@$cellNo)?>
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
            <form method="post" action="profile?tab=2#modal"  accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">								<div class="form-body">

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

                        Update Details
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">

                                <br>
                                <div class="form-group">
                                    <label for="phoneNumber" class="control-label col-md-3">Phone:</label>
                                    <div class="col-md-9">
                                        <input type="tel" required placeholder="Phone Number" name="phone" value="<?php print_r(@$cellNo) ?>" class="form-control"></div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="businessAddress" class="control-label col-md-3">Address:</label>
                                    <div class="col-md-9">
                                        <textarea required placeholder="Address" name="businessAddress" class="form-control" rows="3"><?php print_r(@$businessAddress) ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileinput-new">Select Picture</span>
                                                                <?php if($logo!=null){
                                                                ?>
                                                                <input type="file" name="logo"></span>
                                        <?php }
                                            else{
                                                ?>
                                        <input type="file" name="logo"></span>
                                        <?php }?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <label class="checkbox-inline mar-left5">
                                            <input required type="checkbox" value="agree">
                                            I agree to the <a href="#">Terms and Conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <button name="btn-update" type="submit" class="btn btn-default">Confirm</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <label class="checkbox-inline mar-left5">
                                        <input type="checkbox" value="news">Send me latest news and updates.</label>
                                </div>
                            </div>

                            <br>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tab4" class="tab-pane fade active in">
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
                        <p align="right"><strong>Balance: R'.@$walletBalance.'</strong></p>
                        <p align="right"><strong>Available Balance: R'.@$walletAmount.'.00 </strong></p>

                    </div>
                    <!-- Features 3 -->
                </div></div>

            <div class="col-md-4">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Request Payout
                    </h3>

                </div>
                <form method="post" action="profile?tab=4#modal" accept-charset="UTF-8" enctype="multipart/form-data" role="form"class="form-horizontal">
                    <input type="text" placeholder="Request Amount" name="amount" value="" class="form-control">
                    <button name="payOut" type="submit" class="btn btn-default">Pay Out</button>
                </form>
            </div>
            ';

            ?>
            <div class="row">
                <div class="col-md-6">


                    <?php

                                         if(@$accountHolder == null){
                                                    ?>
                    <form method="post" accept-charset="UTF-8" enctype="multipart/form-data" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="business_name" class="control-label col-md-3">Bank Name:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Bank Name" name="bank_name" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastName" class="control-label col-md-3">Account Holder:</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Account Holder" name="account_holder" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_type" class="control-label col-md-3">Account No:</label>
                            <div class="col-md-9">
                                <input required type="text" placeholder="Bank Account" name="bank_account" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vat_number" class="control-label col-md-3">Branch Code:</label>
                            <div class="col-md-9">
                                <input type="text" required placeholder="Branch Code" name="branch_code" value="" class="form-control">
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
<?php
}
?>
