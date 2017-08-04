<?php
date_default_timezone_set("Africa/Johannesburg");
use Base32\Base32;
$refOnTopUp = @base64_decode($_GET['topup']);
$amountTopUp = @round(base64_decode($_GET['amount']));
$source = @(base64_decode($_GET['source']));
$sourcePost = @$_POST['source'];
$store = @$_GET['store'];
$product_ref = @$_GET['prodID'];
$paid = @$_GET['paid'];
$store_url= @$_GET['store_url'];
$storeUrl= @$_POST['store_url'];
$logo= @$_POST['logo'];
$step= @$_POST['step'];
$cancel_url= @rawurlencode($_POST['cancel_url']);

$type = @$_GET['type'];
$processCash = @$_GET['process'];


if(@$amountTopUp==Null){

    $amountTopUp = @$_POST['deposit'];
    $refOnTopUp = 'Lb'.@$_POST['consumer_id'];
    $source= @$_POST['source'];
    $product_ref= @$_POST['product_ref'];
    $store= @$_POST['store_name'];
    $store_url= @$_POST['store_url'];

    $data = Array (

        'consumer_id' => @$refOnTopUp,
        'price' => @$amountTopUp
    );


    $source= @$_POST['source'];
    $paid= @$_POST['paid'];

    $condumerId = @$_POST['consumer_id'];
    $merchant_id = @$_POST['merchant_id'];


}
include 'header.php';

if(@$type=='cash_dep')
{
    $options = @$_GET['options'];
    $decoded = Base32::decode($options);
    $getTransaction = json_decode($decoded);

    $amountTopUp = $getTransaction->amount;
    $refOnTopUp = $getTransaction->topup;

    $cashFees = '<small><div class="col-md-12"><p><i>Cash deposits may incur delays and charges.</i></p></div></small>';
}
if(@$processCash=='cash_dep')
{
    include 'includes/cash_dep.php';
}
require 'includes/banks.php';


if(@$logo==null) {

    if($product_ref==null){
       $product_ref = @$_POST['product_ref'];
    }


    $product = $api->get("/merchants/$product_ref/layby");
    $checkProduct = json_decode($product->response);

    if($checkProduct!=null){

        foreach (@$checkProduct as $key => $data) {

            $merchant_id = $data->merchant_id;}
    }


//gets Logo//
    if(@$merchant_id!=null){
    $getBusiness = $api->get("/merchants/business/$merchant_id");
    $businessInfo = json_decode($getBusiness->response);
    $logo = @$businessInfo->logo;}
}
if($paid=='true' and $source=='online stores'){

    $return_url = @$_POST['return_url'];
    $code = @$_POST['code'];


?>
<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
    <!-- page-header -->
<!-- Sticky Navbar -->
<div class="page-header" style="background-color:#FFF">
    <div class="container">
        <?php
        if(@$logo!=null){

            ?>
            <img src="<?php print_r($logo)?>" alt="" style="height:50px !important; 120px" />
            <?php
        }
        else{


            ?>
            <img src="img/logo.png" alt="" style="height:50px !important; 120px" />
            <?php
        }
        ?>
        <span style="float:right"><img src="img/secure-payments.png" alt="" width="120" height="50" /></span></div>
</div>
    <div class="page-header" style="background-color:#FFF" xmlns="http://www.w3.org/1999/html">
    <section class="page-section">

        <div class="container">
            <div class="row">
<?php

if(@$code==300){

    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="'.$return_url.'";
                                    }
                                    setTimeout(\'Redirect()\', 2000);
                                    </script>';


    print_r($redirect);


?>
    <div style="border:1px dotted green;padding:2%;">

        <h3><b>Payment Successful</b></h3>
        <p>We have received a confirmation for your payment, you will be redirected back to <strong><?php print_r($store); ?></strong> in 5 seconds. Should the redirection not happen automatically, click <a href="<?php print_r($return_url)?>" "Redirect Manually"</a>.</p>
    </div>
<?php
}
if(@$code==301)
{
?>

    <?php

                $product_ref = @$_POST['product_ref'];

    $data = Array (

        'store_url' => @$store_url,
        'ref' => $product_ref

    );
    $x = curl_init("https://app.laybycafe.com/cron");
    curl_setopt($x, CURLOPT_HTTPHEADER, array());
    curl_setopt($x, CURLOPT_HEADER, 0);
    curl_setopt($x, CURLOPT_POST, 1);
    curl_setopt($x, CURLOPT_POSTFIELDS, $data);
    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($x, CURLOPT_REFERER, "https://app.laybycafe.com/engine");
    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
    $checkPayment = curl_exec($x);
    curl_close($x);

    $check ='<script>
            $(document).ready(function(){
                setInterval(function() {
                    $("#load_results").load("'.@print_r($checkPayment).'");
                }, 1000);
            });

        </script>';


    print_r($check);

                //require 'cron.php';

                    ?>
                    <div id = "load_results">
                      </div>
                    <?php
                }
                else{


                   print_r('	     <div align="center" class="col-md-12">
<p align="center"><p> click continue to complete transaction</p>'.$finalBTN.'</div>')
                ?>

<?php
                }
?>
            </div>

            <br>
            <hr>
            <div class="col-md-12">Laybye Cafe handles secure online payments on behalf of <strong><?php print_r($store); ?></strong>. By transacting with , you acknowledge that you have read and agree to the terms of our End User Agreement.</div>
        </div>



    </section>

<?php
}

else{
?>
        <div class="page-header" style="background-color:#FFF">
            <div class="container">
                <?php
                if(@$logo!=null){

                    ?>
                    <img src="<?php print_r($logo)?>" alt="" style="height:50px !important; 120px" />
                    <?php
                }else{


                    ?>
                    <img src="img/logo.png" alt="" style="height:50px !important; 120px" />
                    <?php
                }
                ?>
                <span style="float:right"><img src="img/secure-payments.png" alt="" width="120" height="50" /></span></div>
        </div>
<!-- page-header -->
<section class="page-section">

    <div class="container">


        <div class="row">
            <div class="content col-sm-12 col-md-4">

                <?php if (empty($_GET['tm']) || $_GET['tm'] ==0) {  ?>

                <?php } else { ?>

                    <form id="contact-form" class="contact-form" method="post">
                        <h3 class="title"><?php echo $description; ?> </h3>


                        <div class="clearfix"> </div>
                        <!-- .buttons-box -->
                    </form>

                <?php } ?>


            </div>

            <!-- .content -->
            <div align="center" class="col-md-4">


                    <?php

                    $code = @$_POST['code'];
                    $email = @$_POST['email'];
                    $cancel_url = @$_POST['cancel_url'];

                    if($bankNameDeposit==Null){

                    if(@$code!=505){

                    ?>

                    <br/>
                        <p align="center">
                            <?php
                            if($code==998){
                                $cancel= '
<a href="'.$cancel_url.'" class="btn btn-default">Retun to Store</a>
';
                                print_r('<p>Cant Process layby for <strong>'.$email.'</strong> please contact support</p>');
                                print_r($cancel);

                            ?>

                            <?php
                            }else{


                            ?>
                            <div class="row" role="form">
                                <div class="row" role="form" align="left" style="font-size:14px">

                                    <?php
                                    if(@$sourcePost=='online stores'){
                                    ?>

                <p><div class="col-md-12">Please note that your order will only be reserved once the due deposit has been received.</div></p>

                                        <div class="col-md-8">Deposit Due<span class="pull-right"><strong> R<?php print_r($amountTopUp);?></strong></span></div>
                                        <div class="col-md-8">Monthly Installment (<?php print_r(@$_POST['period']);?>)<span class="pull-right"><strong> R<?php print_r(@$_POST['instalment']);?></strong></span></div>
                                        <div class="col-md-8"><strong>TOTAL AMOUNT</strong><span class="pull-right"><strong> R<?php print_r(@$_POST['price']);?></strong></span></div>

                                    <?php }

                                    else{
                                        ?>
                                        <p><div class="col-md-12">Please note that your order will only be reserved once the due deposit has been received.</div></p>
                                        <?php
                                        if(@$type=='cash_dep')
                                        {
                                            print_r($cashFees);
                                        }
                                        ?>
            <br/>
            <br/>
                <div class="col-md-8">Payment Due<span class="pull-right"><strong> R<?php print_r($amountTopUp);?></strong></span></div>

                                    <?php }

                                    ?>
                                </div>
                        <p align="center"><hr/></p>
                        <div class="col-md-4"><b> Step 1</b></div>
                        <div class="col-md-6">Select Your Bank</div>

                    </div>
                            <?php
                            if(@$type=='cash_dep'){

                                include 'templates/engine/cashdep.tpl';
                            }else{
                                include 'templates/engine/eft.tpl';
                            }
                            ?>
            <span class="pull-right">
                         <a href="cart.php" class="text-success">Start over!</a>
                            <?php
                            }
                            ?>

                        </p>

                            <?php
                            }
                            else{
                                print_r('Your order has been declined please contact your merchant. You will be redirected');

                                $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="'.$cancel_url.'";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


                                //print_r($redirect);

                            }

                            }
                            else{

                            ?>
                        <?php

                        print_r(@$paymentOption);}
                        ?></span>
                        <!-- .buttons-box --></form>

            </div>
        </div>

        <br/>
        <hr />
        <div class="col-md-12">Layby Cafe handles secure online payments. By transacting with Layby cafe, you acknowledge that you have read and agree to the terms of our End User Agreement.</div>

    </div>
</section>

    <?php
}

?>
<?php
require_once 'footer.php';
?>
</body>
</html>