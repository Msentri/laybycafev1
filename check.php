<?php
require 'vendor/autoload.php';
$deploy = 'live';

if($deploy=="live")
{

    $api = new RestClient([
        'base_url' => "http://api.laybycafe.com/v1.1",

    ]);
}

if($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}

 $paymentCheck = @substr($_GET['reference'],2);
$result = $api->get("/payment");

$paymentGet = json_decode($result->response);


if(@$paymentCheck!=null){

    $data = array(
            'consumer_id'=>$paymentCheck

    );
    $product = $api->get("/check/layby/payment",$data);


    $checkProduct = json_decode($product->response);

    if($checkProduct->code==501){

    if(@$checkProduct!=null) {
        foreach (@$checkProduct->data as $key => $data) {

            $lastPayment = $data->lastPayment_verified;

            if(@$lastPayment =='false'){

                $msg = '<div style="border:1px dotted orange;padding:2%;">
        <h3><b>Awaiting Payment</b></h3>
        <p>Please wait while we verify your transaction in real-time. 
        If you are not automatically redirected in 60 seconds, 
        please click on the Redirect Now button below.<br/><br/>
        <center>
        <a class="btn btn-default" href="dashboard">Redirect Now</a></center></p>
    </div>';
            }
        }

    }
    }else{

        $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


        print_r($redirect);

        $msg = '
                    <div style="border:1px dotted green;padding:2%;">

                  <h3><b>Payment Successful</b></h3>

                  <p>We have received a confirmation for your payment, you will be redirected back in 5 seconds. Should
                      the redirection not happen automatically, click <a href="dashboard"> "Redirect
                          Manually"</a>.</p>
              </div>
                ';
    }

    print_r($msg);

}
?>