<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/07/27
 * Time: 10:56 AM
 */
if(isset($_POST['pay_now'])){
$sendMultipleData = [

    'consumer_id' => $consumerID,

    'processing'=>json_encode(@$pushMultipleData),

    'awaiting'=>json_encode(@$pushMultipleDataAwaiting)

];

$multiUpdate = $api->post("/payment/push/multi",$sendMultipleData);
$multiResponse = json_decode($multiUpdate->response);

//echo '<pre>';
//var_dump($multiResponse);
//echo '<pre>';

foreach ($multiResponse as $r =>$message){

    $serverMSG = preg_match_all("/Your new/", $message->message, $outputRef_array);

    if($outputRef_array[0]!=null){
        $multiResponseMessage = $outputRef_array[0][0];

        if($multiResponseMessage=='Your new'){

            $redirect ='<script type="text/javascript">

                                    function Redirect()
                                    {
                                    window.location="cart";
                                    }
                                    setTimeout(\'Redirect()\', 5000);

                                    </script>';
            //print_r($redirect);

        }
    }

}
}


//print_r($pushMultipleData);