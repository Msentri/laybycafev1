<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/12/08
 * Time: 1:57 PM
 */

function nextPayment($date_to_pay)
{
    if(empty($date_to_pay)) {
        return "No date provided";
    }

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date_to_pay);

    // check validity of date
    if(empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {
        $difference     = $now - $unix_date;
        $tense         = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}

require 'vendor/autoload.php';


$paymentCheck = @$_POST['ref'];
$storeUrl = @$_POST['store_url'];
function pendingID($length = 5, $add_dashes = false, $available_sets = 'luds')
{
    $sets = array();
    //if(strpos($available_sets, 'l') !== false)
    // $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    // if(strpos($available_sets, 'u') !== false)
    //  $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if(strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    // if(strpos($available_sets, 's') !== false)
    // $sets[] = '!@#$%&*?';
    $all = '';
    $password = '';
    foreach($sets as $set)
    {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }
    $all = str_split($all);
    for($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];
    $password = str_shuffle($password);
    if(!$add_dashes)
        return $password;
    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while(strlen($password) > $dash_len)
    {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}

$deploy = 'live';

if($deploy=="live")

{

    $api = new RestClient([
       // 'base_url' => "http://api.laybycafe.com/v1.1",
        'base_url' => "https://v2.laybycafe.com/v2.0",

    ]);
}

if($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}

if($deploy=="debug"){

    $api = new RestClient([
        'base_url' => "http://localhost/api/v1.1",

    ]);

}
$result = $api->get("/payment");

$paymentGet = json_decode($result->response);


if(@$paymentCheck!=null){

$product = $api->get("/merchants/$paymentCheck/layby");


$checkProduct = json_decode($product->response);

if(@$checkProduct!=null) {
    foreach (@$checkProduct as $key => $data) {
      $depositMade = $data->depositMade;
      $productref = $data->product_ref;
      if($productref==$paymentCheck){
          $productref = $data->product_ref;
          if (@$depositMade == 'No')
          {

              if($storeUrl!=null){
                  $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="http://'.$storeUrl.'";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


                  print_r($redirect);

                  $dataAwaiting = '<div style="border:1px dotted orange;padding:2%;">
        <h3><b>Awaiting Payment</b></h3>

        <p>We are unable to verify payments through our real-time verification system but we will certainly
            process the transaction in a while and notify you, you will now be redirected back in 5 seconds. Should the redirection not happen
            automatically click <a href="https://'.@$storeUrl.'"> "Redirect Manually"</a>.</p>
    </div>';

                  print_r($dataAwaiting);
              }
              ?>
          <?php }
          else {

              $getURL = $api->get("/merchants/stores/url/$paymentCheck");
              $url = json_decode($getURL->response);

              foreach (@$url as $key => $data) {

                  $return_url = $data->return_url;


              }

              $redirect = '<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="' .@$return_url . '";
                                    }
                                    setTimeout(\'Redirect()\', 1000);
                                    </script>';


              print_r($redirect);

              ?>

              <div style="border:1px dotted green;padding:2%;">

                  <h3><b>Payment Successful</b></h3>

                  <p>We have received a confirmation for your payment, you will be redirected back in 5 seconds. Should
                      the redirection not happen automatically, click <a href="<?php print_r(@$return_url) ?>"> "Redirect
                          Manually"</a>.</p>
              </div>


          <?php }
      }



    }

}
}

$pendingID = pendingID();

$laybyPending = $api ->get("/admin/$pendingID/laybys/pending");

$pending = json_decode($laybyPending->response);


foreach (@$pending as $item=>$data){


    $layby_data = [];
    $product_ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $lastPayment = $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
    $layby_data['canPay'] = filter_var(@$data->canPay, FILTER_SANITIZE_STRING);
    $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);




    $lastDate  = date("M", strtotime(@$lastPayment));

    $now = date("M");

    if($layby_data['canPay']=='0' and $layby_data['depositMade']=='Yes'){

        $dataUpdate = array(
            'product_ref'=>$product_ref,
            'lastPayment_verified'=>'false',
            'canPay'=>1

        );

        if(preg_match_all("/$now/", $lastDate, $outputRef_array)){

        }else{
            $updateLayby = $api ->post("/admin/laybys/pending",$dataUpdate);
            $update = json_decode($updateLayby->response);
            var_dump($update);
        }

        if($now<$lastDate){




        }

    }

}

//print_r($updateLayby);

//----------------------cron to cancel laybys after one week of no payment---------------//
$laybyToCancel = $api ->get("/admin/$pendingID/laybys/cancel");
foreach (json_decode(@$laybyToCancel->response) as $item=>$data) {

    $layby_data = [];
    $product_ref = $layby_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
    $consumer_id = $layby_data['consumer_id'] = filter_var(@$data->consumer_id, FILTER_SANITIZE_STRING);
    $createdAt = $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
    $depositMade = $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);

    $cancelDate = nextPayment($createdAt);

    if( preg_match_all("/14 days ago/", $cancelDate, $outputRef_array)){


        $dataUpdate = array(
            'consumer_id'=>$consumer_id,
            'product_ref'=>$product_ref

        );

        $updateLayby = $api ->post("/admin/laybys/cancel",$dataUpdate);

        ($updateLayby->response);

    }

    if( preg_match("/2 weeks ago/", $cancelDate, $outputRef_array)){


        $dataUpdate = array(
            'consumer_id'=>$consumer_id,
            'product_ref'=>$product_ref

        );

        $updateLayby = $api ->post("/admin/laybys/cancel",$dataUpdate);

    }

    if( preg_match_all("/2 weeks ago/", $cancelDate, $outputRef_array)){


        $dataUpdate = array(
            'consumer_id'=>$consumer_id,
            'product_ref'=>$product_ref

        );

        $updateLayby = $api ->post("/admin/laybys/cancel",$dataUpdate);

    }

}

?>
