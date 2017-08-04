<head>
    </html>
    <meta charset="utf-8">
    <title>Layby Cafe</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Layby Cafe">
    <meta name="description" content="Layby Cafe">
    <meta name="author" content="Layby Cafe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:300,400,700,400italic,700italic">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/hover-dropdown-menu.css" rel="stylesheet">
    <!-- Icomoon Icons -->
    <link href="css/icons.css" rel="stylesheet">
    <!-- Revolution Slider -->
    <link href="css/revolution-slider.css" rel="stylesheet">
    <link href="rs-plugin/css/settings.css" rel="stylesheet">
    <!-- Animations -->
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel Slider -->
    <link href="css/owl/owl.carousel.css" rel="stylesheet">
    <link href="css/owl/owl.theme.css" rel="stylesheet">
    <link href="css/owl/owl.transitions.css" rel="stylesheet">
    <!-- PrettyPhoto Popup -->
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!-- Color Scheme -->
    <link href="css/color.css" rel="stylesheet">
    <link rel="stylesheet" href="Zebra_Dialog-master/public/css/flat/zebra_dialog.css" type="text/css">
    <link rel="stylesheet" href="Zebra_Dialog-master/examples/public/css/style.css" type="text/css">
    <link rel="stylesheet" href="Zebra_Dialog-master/examples/libraries/highlight/public/css/ir_black.css" type="text/css">
    <link rel="stylesheet" href="includes/Remodal-master/dist/remodal.css">
    <link rel="stylesheet" href="includes/Remodal-master/dist/remodal-default-theme.css">
    <script type="text/javascript">
        function calc(A,B,deposit) {
            var one = Number(A);
            if (isNaN(one)) { alert('Invalid entry: '+A); one=0; }
            var two = Number(document.getElementById(B).value);
            if (isNaN(two)) { alert('Invalid entry: '+B); two=0; }
            document.getElementById(deposit).value = Math.round(one * two);
        }
    </script>
    <link href="includes/jQuery.filer-master/css/jquery.filer.css" rel="stylesheet">

</head>
<?php
date_default_timezone_set("Africa/Johannesburg");

$source = @base64_decode($_GET['source']);
$paid = @$_GET['paid'];
$store= @$_GET['store'];
$step= @$_GET['step'];
$product_ref = @$_GET['prodID'];
$store_url= @$_GET['store_url'];

include 'vendor/autoload.php';


$deploy = "live";

if($deploy=="live")

{
    $api = new RestClient([
        'base_url' => "https://api.saitws.co.za/v1.1",

    ]);


    if(@$_POST != null){

        $merchant_id = @$_POST['merchant_id'];
        $merchant_key = @$_POST['merchant_key'];
        $return_url = @$_POST['return_url'];
        $cancel_url = @$_POST['cancel_url'];
        $notify_url = @$_POST['notify_url'];
        $product_ref = @$_POST['m_payment_id'];
        $price = @round($_POST['amount']);
        $title = @$_POST['item_name'];
        $name = @$_POST['item_name'];
        $std = @$_POST['item_description'];
        $signature = @$_POST['signature'];
        if(@$_POST['user_agent']!=null){
            $user_agent = @$_POST['user_agent'];
        }else{
            echo $user_agent = @$_POST['source'];
        }



        $first_name = @$_POST['first_name'];
        $last_name= @$_POST['last_name'];


        $email= @$_POST['email'];
        $phone= @$_POST['phone'];

        //end of user information//
        if(@$priceSpecial!=Null){
            $deposit = @$priceSpecial * 0.15;
            $price = filter_var(@$priceSpecial, FILTER_SANITIZE_NUMBER_INT);
        }
        else{

            if($price == '1000' or $price >= '550'){

                $deposit = round(@$price * 0.2);
            }
            if($price >= '1001' or $price == '5000'){

                $deposit = round (@$price * 0.15);
            }

            if($price >= '5001'){

                $deposit = round(@$price * 0.1);
            }
        }



        if($price == '1000' or $price >= '550'){

            $result = $api->get("/merchants/$merchant_id&$merchant_key/getuser/$email/gateway");

            $consumerDetails = json_decode($result->response);


            $condumerId = @$consumerDetails->consumer_id;
            $code = @$consumerDetails->code;
            $message = @$consumerDetails->message;
            $store = @$consumerDetails->store;
            $store_url = @$consumerDetails->store_url;
            $profile = $api->get("/searchprofile/$merchant_id");
            //gets Logo//
            $getBusiness = $api ->get("/merchants/business/$merchant_id");
            $businessInfo = json_decode($getBusiness->response);
            $logo = @$businessInfo->logo;


            $monthsInfo = json_decode($profile->response);

            $period = @$monthsInfo->maximum_period;

            // instalment 2 months//
            if($period=='2 Months' and $price >= '550'){

                $amount = round ($price - $deposit);
                $instalment = round ($amount/1);
                $months = "1 months";
                $amount = round ($deposit + $instalment*1);

            }

            // instalment 3 months//
            if($period=='3 Months' and $price >= '550'){

                $amount = round ($price - $deposit);
                $instalment = round ($amount/2);
                $months = "2 months";
                $amount = round ($deposit + $instalment*2);

            }

            // instalment 6 months//
            if($period=='6 Months' and $price >= '550'){

                $amount = $price - $deposit;
                $instalment = round ($amount/5);
                $months = "5 months";
                $amount = round ($deposit + $instalment*5);

            }
            // instalment 12 months//
            if($period=='12 Months' and $price >= '550'){

                $amount = $price - $deposit;
                $instalment = round ($amount/11);
                $months = "11 months";
                $amount = round ($deposit + $instalment*11);

            }



            if($code == 998){



                $data = Array (

                    'code' => 998,
                    'email' => @$email,
                    'logo' => @$logo,
                    'cancel_url' => $cancel_url,

                );


                $x = curl_init("https://demo.laybycafe.com/engine");
                curl_setopt($x, CURLOPT_HTTPHEADER, array());
                curl_setopt($x, CURLOPT_HEADER, 0);
                curl_setopt($x, CURLOPT_POST, 1);
                curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($x);
                curl_close($x);
                echo $data;
            }else{


                if(@$code != 505){
                    if($code==501){



                        $data = array(

                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'phone' => @$phone,
                            'user' => $email,
                            'id_no' => @$id,
                            'logo' => @$logo,
                            'step' => 2,
                            'role' => 'consumer'
                        );

                        $result = $api->post("/merchant/users", $data);

                        $message = json_decode($result->response);


                        $code =@$message->code;




                        if($code==209){

                            $result = $api->get("/merchants/$merchant_id&$merchant_key/getuser/$email/gateway");

                            $consumerDetails = json_decode($result->response);



                            $condumerId = @$consumerDetails->consumer_id;
                            $code = @$consumerDetails->code;


                            $store = @$consumerDetails->store;

                            if(@$code==999){

                                $urlData = array(
                                    'product_ref'=>@$product_ref,
                                    'return_url'=>@$return_url,
                                    'cancel_url'=>@$cancel_url,
                                    'notify_url'=>@$notify_url,
                                    'platform'=>@$user_agent

                                );

                                $data = Array (

                                    'consumer_id' => @$condumerId,
                                    'merchant_id' => @$merchant_id,
                                    'product_ref' => @$product_ref,
                                    'product_name' => $store .' - '.@$title,
                                    'sku' => @$sku,
                                    'price' => @$price,
                                    'source' => 'online stores',
                                    'special_price' => @$priceSpecial,
                                    'period' => @$months,
                                    'deposit' => @$deposit,
                                    'instalment' => @$instalment,
                                    'store_name' => @$store,
                                    'store_url' => @$store_url,
                                    'cancel_url'=>@$cancel_url,
                                    'logo' => @$logo,
                                    'step' => 2,
                                    'description' =>@$std
                                );

                                $result = $api->post("merchant/laybys",$data);

                                $layby_data = json_decode($result->response);


                                if(@$layby_data->code!=401){

                                    $url = $api->post("/merchants/stores/url",$urlData);
                                }

                            }

                        }

                    }

                    else{
                        if(@$code==999){

                            $urlData = array(
                                'product_ref'=>$product_ref,
                                'return_url'=>$return_url,
                                'cancel_url'=>$cancel_url,
                                'notify_url'=>$notify_url,
                                'platform'=>$user_agent

                            );

                            $data = Array (

                                'consumer_id' => @$condumerId,
                                'merchant_id' => @$merchant_id,
                                'product_ref' => @$product_ref,
                                'product_name' => $store .' - '.@$title,
                                'sku' => @$sku,
                                'price' => @$price,
                                'source' => 'online stores',
                                'special_price' => @$priceSpecial,
                                'period' => @$months,
                                'deposit' => @$deposit,
                                'instalment' => @$instalment,
                                'store_name' => @$store,
                                'store_url' => @$store_url,
                                'cancel_url'=>@$cancel_url,
                                'logo' => @$logo,
                                'step' => 2,
                                'description' =>@$std
                            );

                            $result = $api->post("merchant/laybys",$data);

                            $layby_data = json_decode($result->response);


                            if(@$layby_data->code!=401){

                                $url = $api->post("/merchants/stores/url",$urlData);
                            }



                        }

                    }

                    foreach($_POST as $key => $val){
                        $key = $val;
                    }
                    $n = "\n\n";

                    $inputdata = @$data;

                    $x = curl_init("https://demo.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $inputdata);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($x);
                    curl_close($x);
                    echo $data;

                }else{

                    $data = Array (

                        'code' => 505,
                        'cancel_url' => $cancel_url,

                    );


                    $x = curl_init("https://demo.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($x);
                    curl_close($x);
                    echo $data;
                }

            }


        }
    }

    if(@$_GET['merchant_key'] != null){

        $merchant_id = @$_GET['merchant_id'];
        $merchant_key = @$_GET['merchant_key'];
        $return_url = @$_GET['return_url'];
        $cancel_url = @$_GET['cancel_url'];
        $notify_url = @$_GET['notify_url'];
        $product_ref = @$_GET['item_name'];
        $price = @substr(round($_GET['amount']), 0 , -2);
        $title = @$_GET['item_name'];
        $name = @$_GET['item_name'];
        $std = @$_GET['item_description'];
        $signature = @$_GET['signature'];
        if(@$_POST['user_agent']!=null){
            $user_agent = @$_POST['user_agent'];
        }else{
            echo $user_agent = @$_POST['source'];
        }


        $first_name = @$_GET['first_name'];
        $last_name= @$_GET['last_name'];


        $email= @$_GET['email_address'];
        $phone= @$_GET['phone'];

        //end of user information//
        if(@$priceSpecial!=Null){
            $deposit = @$priceSpecial * 0.15;
            $price = filter_var(@$priceSpecial, FILTER_SANITIZE_NUMBER_INT);
        }
        else{

            if($price == '1000' or $price >= '550'){

                $deposit = round(@$price * 0.2);
            }
            if($price >= '1001' or $price == '5000'){

                $deposit = round (@$price * 0.15);
            }

            if($price >= '5001'){

                $deposit = round(@$price * 0.1);
            }
        }



        if($price == '1000' or $price >= '550'){

            $result = $api->get("/merchants/$merchant_id&$merchant_key/getuser/$email/gateway");

            $consumerDetails = json_decode($result->response);

            $condumerId = @$consumerDetails->consumer_id;
            $code = @$consumerDetails->code;
            $message = @$consumerDetails->message;
            $store = @$consumerDetails->store;
            $store_url = @$consumerDetails->store_url;
            $profile = $api->get("/searchprofile/$merchant_id");

            //gets Logo//
            $getBusiness = $api ->get("/merchants/business/$merchant_id");
            $businessInfo = json_decode($getBusiness->response);
            $logo = @$businessInfo->logo;


            $monthsInfo = json_decode($profile->response);

            $period = @$monthsInfo->maximum_period;

            // instalment 2 months//
            if($period=='2 Months' and $price >= '550'){

                $amount = round ($price - $deposit);
                $instalment = round ($amount/2);
                $months = "3 months";
                $amount = round ($deposit + $instalment*2);

            }

            // instalment 3 months//
            if($period=='3 Months' and $price >= '550'){

                $amount = round ($price - $deposit);
                $instalment = round ($amount/3);
                $months = "3 months";
                $amount = round ($deposit + $instalment*3);

            }

            // instalment 6 months//
            if($period=='6 Months' and $price >= '550'){

                $amount = $price - $deposit;
                $instalment = round ($amount/6);
                $months = "6 months";
                $amount = round ($deposit + $instalment*6);

            }
            // instalment 12 months//
            if($period=='12 Months' and $price >= '550'){

                $amount = $price - $deposit;
                $instalment = round ($amount/12);
                $months = "12 months";
                $amount = round ($deposit + $instalment*12);

            }



            if($code == 998){



                $data = Array (

                    'code' => 998,
                    'email' => @$email,
                    'logo' => @$logo,
                    'cancel_url' => $cancel_url,

                );


                $x = curl_init("https://demo.laybycafe.com/engine");
                curl_setopt($x, CURLOPT_HTTPHEADER, array());
                curl_setopt($x, CURLOPT_HEADER, 0);
                curl_setopt($x, CURLOPT_POST, 1);
                curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($x);
                curl_close($x);
                echo $data;
            }else{


                if(@$code != 505){
                    if($code==501){


                        $data = array(

                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'phone' => @$phone,
                            'user' => $email,
                            'id_no' => @$id,
                            'logo' => @$logo,
                            'step' => 2,
                            'role' => 'consumer'
                        );


                        $result = $api->post("/merchant/users", $data);

                        $message = json_decode($result->response);

                        $code =@$message->code;




                        if($code==209){

                            $result = $api->get("/merchants/$merchant_id&$merchant_key/getuser/$email/gateway");

                            $consumerDetails = json_decode($result->response);



                            $condumerId = @$consumerDetails->consumer_id;
                            $code = @$consumerDetails->code;


                            $store = @$consumerDetails->store;

                            if(@$code==999){

                                $urlData = array(
                                    'product_ref'=>@$product_ref,
                                    'return_url'=>@$return_url,
                                    'cancel_url'=>@$cancel_url,
                                    'notify_url'=>@$notify_url,
                                    'platform'=>@$user_agent

                                );

                                $data = Array (

                                    'consumer_id' => @$condumerId,
                                    'merchant_id' => @$merchant_id,
                                    'product_ref' => @$product_ref,
                                    'product_name' => $store .' - '.@$title,
                                    'sku' => @$sku,
                                    'price' => @$price,
                                    'source' => 'online stores',
                                    'special_price' => @$priceSpecial,
                                    'period' => @$months,
                                    'deposit' => @$deposit,
                                    'instalment' => @$instalment,
                                    'store_name' => @$store,
                                    'store_url' => @$store_url,
                                    'cancel_url'=>@$cancel_url,
                                    'logo' => @$logo,
                                    'step' => 2,
                                    'description' =>@$std
                                );

                                $result = $api->post("merchant/laybys",$data);

                                $layby_data = json_decode($result->response);


                                if(@$layby_data->code!=401){

                                    $url = $api->post("/merchants/stores/url",$urlData);
                                }

                            }

                        }

                    }

                    else{
                        if(@$code==999){

                            $urlData = array(
                                'product_ref'=>$product_ref,
                                'return_url'=>$return_url,
                                'cancel_url'=>$cancel_url,
                                'notify_url'=>$notify_url,
                                'platform'=>$user_agent

                            );

                            $data = Array (

                                'consumer_id' => @$condumerId,
                                'merchant_id' => @$merchant_id,
                                'product_ref' => @$product_ref,
                                'product_name' => $store .' - '.@$title,
                                'sku' => @$sku,
                                'price' => @$price,
                                'source' => 'online stores',
                                'special_price' => @$priceSpecial,
                                'period' => @$months,
                                'deposit' => @$deposit,
                                'instalment' => @$instalment,
                                'store_name' => @$store,
                                'store_url' => @$store_url,
                                'cancel_url'=>@$cancel_url,
                                'logo' => @$logo,
                                'step' => 2,
                                'description' =>@$std
                            );

                            $result = $api->post("merchant/laybys",$data);

                            $layby_data = json_decode($result->response);


                            if(@$layby_data->code!=401){

                                $url = $api->post("/merchants/stores/url",$urlData);
                            }



                        }

                    }

                    foreach($_POST as $key => $val){
                        $key = $val;
                    }
                    $n = "\n\n";

                    $inputdata = @$data;

                    $x = curl_init("https://demo.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $inputdata);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($x);
                    curl_close($x);
                    echo $data;

                }else{

                    $data = Array (

                        'code' => 505,
                        'cancel_url' => $cancel_url,

                    );


                    $x = curl_init("https://demo.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($x);
                    curl_close($x);
                    echo $data;
                }

            }


        }
    }

    if($paid=='true' and $source=='online stores' and $step!=3){

        $paynentResult = $api->get("/payment");

        $code = json_decode($paynentResult->response);


        if(@$code->code==300){

            $URLresult = $api->get("/merchants/stores/url/$product_ref");
            $URL = json_decode($URLresult->response);

            foreach(@$URL as $key=>$data){

                $url_data = [];
                $url_data['product_ref'] = filter_var(@$data->product_ref, FILTER_SANITIZE_STRING);
                $url_data['return_url'] = filter_var(@$data->return_url, FILTER_SANITIZE_STRING);
                $url_data['cancel_url'] = filter_var(@$data->return_url, FILTER_SANITIZE_STRING);
                $url_data['notify_url'] = filter_var(@$data->return_url, FILTER_SANITIZE_STRING);
            }

            $data = Array (


                'source' => 'online stores',
                'store_name' => $store,
                'product_ref' => $product_ref,
                'code' => 300,
                'return_url' => $url_data['return_url'],
                'store_url' => @$store_url,
                'cancel_url'=>@$cancel_url,
                'logo' => @$logo,
                'paid' => 'true'

            );


            $x = curl_init("https://demo.laybycafe.com/engine");
            curl_setopt($x, CURLOPT_HTTPHEADER, array());
            curl_setopt($x, CURLOPT_HEADER, 0);
            curl_setopt($x, CURLOPT_POST, 1);
            curl_setopt($x, CURLOPT_POSTFIELDS, $data);
            curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
            curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($x);
            curl_close($x);
            echo $data;


        }
        else {
            $data = Array (


                'source' => 'online stores',
                'store_name' => $store,
                'store_url' => @$store_url,
                'cancel_url'=>@$cancel_url,
                'product_ref' => $product_ref,
                'logo' => @$logo,
                'code' => 301,
                'paid' => 'true'

            );


            $x = curl_init("https://demo.laybycafe.com/engine");
            curl_setopt($x, CURLOPT_HTTPHEADER, array());
            curl_setopt($x, CURLOPT_HEADER, 0);
            curl_setopt($x, CURLOPT_POST, 1);
            curl_setopt($x, CURLOPT_POSTFIELDS, $data);
            curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
            curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($x);
            curl_close($x);
            echo $data;
        }
    }
    if($step==3){

        $data = Array (


            'source' => 'online stores',
            'store_name' => $store,
            'product_ref' => @$product_ref,
            'store_url' => @$store_url,
            'step' => 3,
            'code' => 0,
            'logo' => @$logo,
            'paid' => 'true'

        );


        $x = curl_init("https://demo.laybycafe.com/engine");
        curl_setopt($x, CURLOPT_HTTPHEADER, array());
        curl_setopt($x, CURLOPT_HEADER, 0);
        curl_setopt($x, CURLOPT_POST, 1);
        curl_setopt($x, CURLOPT_POSTFIELDS, $data);
        curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($x, CURLOPT_REFERER, "https://demo.laybycafe.com/process_demo");
        curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($x);
        curl_close($x);
        echo $data;
    }
}


?>
