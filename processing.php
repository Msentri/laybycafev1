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

    if($_POST != null){

        if($deploy=="live"){

            $api = new RestClient([
               // 'base_url' => "https://api.laybycafe.com/v1.1",
               // 'base_url' => "http://localhost/api/v1.1",
              // 'base_url' => "http://localhost/apiv2/v2.0",
               'base_url' => "http://v2.laybycafe.com/v2.0",


            ]);

         $merchant_id = @$_POST['merchant_id'];
        $merchant_key = @$_POST['merchant_key'];
        $return_url = @$_POST['return_url'];
        $cancel_url = @$_POST['cancel_url'];
        $notify_url = @$_POST['notify_url'];
        $product_ref = @$_POST['m_payment_id'];
        $product_id = @$_POST['product_ref'];
        $price = @round($_POST['amount']);
        $title = @$_POST['item_name'];
        $name = @$_POST['item_name'];
        $std = @$_POST['item_description'];
        $signature = @$_POST['signature'];


        if(@$_POST['user_agent']=='LaybyCafe-store-plugin') {

          
            //print_r($_POST['Order_Product_data']);

            $cafeItems = json_decode($_POST['Order_Product_data']);


         

        }else if(@$_POST['user_agent']!=null){
            $user_agent = @$_POST['user_agent'];
        }
        else{
             $user_agent = @$_POST['source'];
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

            $data = Array (
                'merchant_id' => @$merchant_id,
                'merchant_key' => @$merchant_key,
                'search' => $email,
            );

            $result = $api ->get("/merchants/getuser/gateway",$data);

            $consumerDetails = json_decode($result->response);
            $condumerId = @$consumerDetails->consumer_id;
            $code = @$consumerDetails->code;
            $role = @$consumerDetails->role;

            $message = @$consumerDetails->message;
            $store = @$consumerDetails->store;
            $store_url = @$consumerDetails->store_url;

            $username = array(
                'username'=>$merchant_id
            );
            $profile = $api->get("/searchprofile",$username);

            //gets Logo//
            $getBusiness = $api ->get("/merchants/business/$merchant_id");
            $businessInfo = json_decode($getBusiness->response);
            $logo = @$businessInfo->logo;


            $monthsInfo = json_decode($profile->response);

            $period = @$monthsInfo->maximum_period;

            if(@$_POST['user_agent']!='LaybyCafe-store-plugin') {
                // instalment 2 months//
                include 'includes/payment_logic.php';
                }
            }
            if($code == 998){


                $data = Array (

                    'code' => 998,
                    'email' => @$email,
                    'logo' => @$logo,
                    'cancel_url' => $cancel_url,

                );

                $x = curl_init("https://app.laybycafe.com/engine");
                curl_setopt($x, CURLOPT_HTTPHEADER, array());
                curl_setopt($x, CURLOPT_HEADER, 0);
                curl_setopt($x, CURLOPT_POST, 1);
                curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                curl_setopt($x, CURLOPT_REFERER, "https://app.laybycafe.com/processing");
                curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                $data = curl_exec($x);
                curl_close($x);
                echo $data;
            }
            else

                {

                if(@$code != 505){

                    if($code==501){



                        $shipping = json_decode($_POST['billing_address']);

                        $phone = $shipping->phone;

                        $data = array(

                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'phone' => @$phone,
                            'user' => $email,
                            'step' => 2,
                            'role' => 'consumer'
                        );


                        $result = $api->post("/merchant/users", $data);

                        $message = json_decode($result->response);

                        $code =@$message->code;

                        if($code==209){


                            $data = Array (
                                'merchant_id' => @$merchant_id,
                                'merchant_key' => @$merchant_key,
                                'search' => $email,
                            );

                            $result = $api ->get("/merchants/getuser/gateway",$data);

                            $consumerDetails = json_decode($result->response);

                            $condumerId = @$consumerDetails->consumer_id;
                            $role = @$consumerDetails->role;
                            $code = @$consumerDetails->code;

                            $store = @$consumerDetails->store;

                            if(@$code==999){

                                //Creates laybys for each item //
                                if(@$_POST['user_agent']=='LaybyCafe-store-plugin'){
                                    include 'includes/keygen.php';
                                    $shipping = json_decode($_POST['billing_address']);
                                    //add consumer address//
                                    $address = '';
                                    $address .= $shipping->address_1.' ';
                                    $address .= $shipping->address_2.' ';
                                    $address .= $shipping->city.' ';
                                    $address .= $shipping->state.' ';
                                    $address .= $shipping->postcode.' ';
                                    $address .= $shipping->country;
                                    $consumerAddress = Array(
                                        'consumer_id' => $condumerId,
                                        'address' => $address,
                                        'billing' => json_encode([
                                            'first_name' => $shipping->first_name,
                                            'last_name' => $shipping->last_name,
                                            'company' => $shipping->company,
                                            'address_1' => $shipping->address_1,
                                            'address_2' => $shipping->address_2,
                                            'city' => $shipping->city,
                                            'state' => $shipping->state,
                                            'postcode' => $shipping->postcode,
                                            'country' => $shipping->country,
                                            'email' => $shipping->email,
                                            'phone' => $shipping->phone
                                        ]),
                                    );


                                    $addAddress = $api->post("/address",$consumerAddress);


                                    foreach ($cafeItems as $item){


                                        if(@$item->quantity!=null){

                                            $numbers = range(1, @$item->quantity);
                                            foreach ($numbers as $number) {

                                                $product_ref = $number.'-'.$item->product_ref;


                                                if($item->product_ref==$item->product_ref){

                                                    $key = ref();
                                                    $price = $item->product_price;
                                                    $period = $item->maximum_period_months;
                                                    $product_id = @$item->product_id_product_id;
                                                    $oder_no = @$_POST['m_payment_id'];
                                                    $store_user_id = @$_POST['user_id'];

                                                    // wooCommerce link up Data//
                                                    $wooData = array(
                                                        'consumer_id' => @$condumerId,
                                                        'merchant_id' => @$merchant_id,
                                                        'store_user_id' => @$store_user_id,
                                                        'product_ref' => @$product_ref,
                                                        'product_id' => @$product_id,
                                                        'oder_no' => @$oder_no,
                                                    );


                                                    $wooDataResult = $api->post("store/capture/order",$wooData);
                                                    //   var_dump($wooDataResult->response);
                                                    include 'includes/payment_logic.php';

                                                    $urlData = array(
                                                        'product_ref'=>$product_ref,
                                                        'return_url'=>$return_url,
                                                        'cancel_url'=>$cancel_url,
                                                        'notify_url'=>$notify_url,
                                                        'platform'=>@$user_agent

                                                    );

                                                    $data = Array (

                                                        'consumer_id' => @$condumerId,
                                                        'merchant_id' => @$merchant_id,
                                                        'product_ref' => @$product_ref,
                                                        'product_name' => @$item->product_name,
                                                        'sku' => @$sku,
                                                        'price' => @$item->product_price,
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
                                                        'description' =>@$item-> product_description
                                                    );
                                                }
                                                $result = $api->post("merchant/laybys",$data);

                                                $layby_data = json_decode($result->response);


                                                if(@$layby_data->code!=401){

                                                    $url = $api->post("/merchants/stores/url",$urlData);

                                                }
                                            }
                                        }else{

                                            //Items with 1 in the cart//
                                            $product_ref = $item->product_ref;
                                            if($item->product_ref==$item->product_ref){

                                                $key = ref();
                                                $price = $item->product_price;
                                                $period = $item->maximum_period_months;
                                                $product_id = @$item->product_id_product_id;
                                                $oder_no = @$_POST['m_payment_id'];
                                                $store_user_id = @$_POST['user_id'];

                                                // wooCommerce link up Data//
                                                $wooData = array(
                                                    'consumer_id' => @$condumerId,
                                                    'merchant_id' => @$merchant_id,
                                                    'store_user_id' => @$store_user_id,
                                                    'product_ref' => @$product_ref,
                                                    'product_id' => @$product_id,
                                                    'oder_no' => @$oder_no,
                                                );


                                                $wooDataResult = $api->post("store/capture/order",$wooData);
                                                //   var_dump($wooDataResult->response);
                                                include 'includes/payment_logic.php';

                                                $urlData = array(
                                                    'product_ref'=>$product_ref,
                                                    'return_url'=>$return_url,
                                                    'cancel_url'=>$cancel_url,
                                                    'notify_url'=>$notify_url,
                                                    'platform'=>@$user_agent

                                                );

                                                $data = Array (

                                                    'consumer_id' => @$condumerId,
                                                    'merchant_id' => @$merchant_id,
                                                    'product_ref' => @$product_ref,
                                                    'product_name' => @$item->product_name,
                                                    'sku' => @$sku,
                                                    'price' => @$item->product_price,
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
                                                    'description' =>@$item-> product_description
                                                );



                                            }
                                            $result = $api->post("merchant/laybys",$data);

                                            $layby_data = json_decode($result->response);


                                            if(@$layby_data->code!=401){

                                                $url = $api->post("/merchants/stores/url",$urlData);


                                            }

                                        }

                                    }

                                    session_start();

                                    $_SESSION['userSession'] = $condumerId;
                                    $_SESSION['roleSession'] = $role;


                                    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="cart";
                                    }
                                    setTimeout(\'Redirect()\', 0500);
                                    </script>';

                                    print_r($redirect);


                                }
                                else{
                                    $urlData = array(
                                        'product_ref'=>$product_ref,
                                        'return_url'=>$return_url,
                                        'cancel_url'=>$cancel_url,
                                        'notify_url'=>$notify_url,
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

                    }

                    else{

                        if(@$code==999){

                            //Creates laybys for each item //
                            if(@$_POST['user_agent']=='LaybyCafe-store-plugin'){
                            include 'includes/keygen.php';
                                $shipping = json_decode($_POST['billing_address']);
                                //add consumer address//
                                $address = '';
                                $address .= $shipping->address_1.' ';
                                $address .= $shipping->address_2.' ';
                                $address .= $shipping->city.' ';
                                $address .= $shipping->state.' ';
                                $address .= $shipping->postcode.' ';
                                $address .= $shipping->country;
                                $consumerAddress = Array(
                                    'consumer_id' => $condumerId,
                                    'address' => $address,
                                    'billing' => json_encode([
                                        'first_name' => $shipping->first_name,
                                        'last_name' => $shipping->last_name,
                                        'company' => $shipping->company,
                                        'address_1' => $shipping->address_1,
                                        'address_2' => $shipping->address_2,
                                        'city' => $shipping->city,
                                        'state' => $shipping->state,
                                        'postcode' => $shipping->postcode,
                                        'country' => $shipping->country,
                                        'email' => $shipping->email,
                                        'phone' => $shipping->phone
                                    ]),
                                );


                                $addAddress = $api->post("/address",$consumerAddress);


                                foreach ($cafeItems as $item){


                                    if(@$item->quantity!=null){

                                        $numbers = range(1, @$item->quantity);
                                        foreach ($numbers as $number) {

                                             $product_ref = $number.'-'.$item->product_ref;


                                    if($item->product_ref==$item->product_ref){

                                        $key = ref();
                                        $price = $item->product_price;
                                        $period = $item->maximum_period_months;
                                        $product_id = @$item->product_id_product_id;
                                        $oder_no = @$_POST['m_payment_id'];
                                        $store_user_id = @$_POST['user_id'];

                                        // wooCommerce link up Data//
                                        $wooData = array(
                                            'consumer_id' => @$condumerId,
                                            'merchant_id' => @$merchant_id,
                                            'store_user_id' => @$store_user_id,
                                            'product_ref' => @$product_ref,
                                            'product_id' => @$product_id,
                                            'oder_no' => @$oder_no,
                                        );


                                        $wooDataResult = $api->post("store/capture/order",$wooData);
                                     //   var_dump($wooDataResult->response);
                                        include 'includes/payment_logic.php';

                                        $urlData = array(
                                            'product_ref'=>$product_ref,
                                            'return_url'=>$return_url,
                                            'cancel_url'=>$cancel_url,
                                            'notify_url'=>$notify_url,
                                            'platform'=>@$user_agent

                                        );

                                        $data = Array (

                                            'consumer_id' => @$condumerId,
                                            'merchant_id' => @$merchant_id,
                                            'product_ref' => @$product_ref,
                                            'product_name' => @$item->product_name,
                                            'sku' => @$sku,
                                            'price' => @$item->product_price,
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
                                            'description' =>@$item-> product_description
                                        );



                                    }
                                   $result = $api->post("merchant/laybys",$data);

                                    $layby_data = json_decode($result->response);


                                    if(@$layby_data->code!=401){

                                        $url = $api->post("/merchants/stores/url",$urlData);


                                    }
                                }
                                    }else{

                                        //Items with 1 in the cart//
                                      $product_ref = $item->product_ref;
                                        if($item->product_ref==$item->product_ref){

                                            $key = ref();
                                            $price = $item->product_price;
                                            $period = $item->maximum_period_months;
                                            $product_id = @$item->product_id_product_id;
                                            $oder_no = @$_POST['m_payment_id'];
                                            $store_user_id = @$_POST['user_id'];

                                            // wooCommerce link up Data//
                                            $wooData = array(
                                                'consumer_id' => @$condumerId,
                                                'merchant_id' => @$merchant_id,
                                                'store_user_id' => @$store_user_id,
                                                'product_ref' => @$product_ref,
                                                'product_id' => @$product_id,
                                                'oder_no' => @$oder_no,
                                            );


                                            $wooDataResult = $api->post("store/capture/order",$wooData);
                                            //   var_dump($wooDataResult->response);
                                            include 'includes/payment_logic.php';

                                            $urlData = array(
                                                'product_ref'=>$product_ref,
                                                'return_url'=>$return_url,
                                                'cancel_url'=>$cancel_url,
                                                'notify_url'=>$notify_url,
                                                'platform'=>@$user_agent

                                            );

                                            $data = Array (

                                                'consumer_id' => @$condumerId,
                                                'merchant_id' => @$merchant_id,
                                                'product_ref' => @$product_ref,
                                                'product_name' => @$item->product_name,
                                                'sku' => @$sku,
                                                'price' => @$item->product_price,
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
                                                'description' =>@$item-> product_description
                                            );



                                        }
                                        $result = $api->post("merchant/laybys",$data);

                                        $layby_data = json_decode($result->response);


                                        if(@$layby_data->code!=401){

                                            $url = $api->post("/merchants/stores/url",$urlData);


                                        }

                                    }

                                }

                                session_start();

                                $_SESSION['userSession'] = $condumerId;
                                $_SESSION['roleSession'] = $role;


                                $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="cart";
                                    }
                                    setTimeout(\'Redirect()\', 0500);
                                    </script>';

                             print_r($redirect);


                            }
                            else{
                                $urlData = array(
                                    'product_ref'=>$product_ref,
                                    'return_url'=>$return_url,
                                    'cancel_url'=>$cancel_url,
                                    'notify_url'=>$notify_url,
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

                    foreach($_POST as $key => $val){
                        $key = $val;
                    }
                    $n = "\n\n";

                    $inputdata = @$data;

                    $x = curl_init("https://app.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $inputdata);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://app.laybycafe.com/processing");
                    curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($x);
                    curl_close($x);
                    echo $data;

                }else{

                    $data = Array (

                        'code' => 505,
                        'cancel_url' => $cancel_url,

                    );


                    $x = curl_init("https://app.laybycafe.com/engine");
                    curl_setopt($x, CURLOPT_HTTPHEADER, array());
                    curl_setopt($x, CURLOPT_HEADER, 0);
                    curl_setopt($x, CURLOPT_POST, 1);
                    curl_setopt($x, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
                    curl_setopt($x, CURLOPT_REFERER, "https://app.laybycafe.com/processing");
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


        if($code->code==300){

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


            $x = curl_init("http://demo.laybycafe.com/engine");
            curl_setopt($x, CURLOPT_HTTPHEADER, array());
            curl_setopt($x, CURLOPT_HEADER, 0);
            curl_setopt($x, CURLOPT_POST, 1);
            curl_setopt($x, CURLOPT_POSTFIELDS, $data);
            curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($x, CURLOPT_REFERER, "http://demo.laybycafe.com/processing");
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


            $x = curl_init("http://demo.laybycafe.com/engine");
            curl_setopt($x, CURLOPT_HTTPHEADER, array());
            curl_setopt($x, CURLOPT_HEADER, 0);
            curl_setopt($x, CURLOPT_POST, 1);
            curl_setopt($x, CURLOPT_POSTFIELDS, $data);
            curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($x, CURLOPT_REFERER, "http://demo.laybycafe.com/processing");
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

        $x = curl_init("https://app.laybycafe.com/engine");
        curl_setopt($x, CURLOPT_HTTPHEADER, array());
        curl_setopt($x, CURLOPT_HEADER, 0);
        curl_setopt($x, CURLOPT_POST, 1);
        curl_setopt($x, CURLOPT_POSTFIELDS, $data);
        curl_setopt($x, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($x, CURLOPT_REFERER, "https://app.laybycafe.com/processing");
        curl_setopt($x, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($x);
        curl_close($x);
        echo $data;

}


?>
