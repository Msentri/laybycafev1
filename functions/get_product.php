<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/08/29
 * Time: 10:04 AM
 */

use FastSimpleHTMLDom\Document;
// Create DOM from URL
$trans_number = @base64_decode($_GET['layby']);
$stepGet = @$_GET['step'];
if(isset($_POST['addLayby'])){

    $Url = $_POST['url'];


    $html = Document::file_get_html($Url);

    //print_r(@$Url);
// Find all post blocks
    //HI COP//
    if (strpos($Url, 'https://www.hificorp.co.za') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $str = $html->find('div[class=regular-price]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $std = $html->find('div[class=std]');
        $priceSpecial0 = @$html->find('p[class=special-price]', 0)->plaintext;
        $priceSpecial = substr( filter_var($priceSpecial0, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var(@$html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $img= $html->find('div[id=main-image-default]');
        $img2= $html->find('div[id=main-image-default]', 0)->plaintext;
        $moreInfo= $html->find('div[id=more-info-tab]');
        $storeName = 'Hificorp';
    }

    //Sleep Masters//
    if (strpos($Url, 'https://www.sleepmasters.co.za') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $str = $html->find('span[class=price]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $std = $html->find('div[class=std]');
        $SpecialPrice = $html->find('p[class=special-price]', 0)->plaintext;
        $priceSpecial = substr(filter_var($SpecialPrice, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('div[class=product-image]');
        $moreInfo= $html->find('div[id=more-info-tab]');
        $storeName = 'Sleepmasters';
    }
    //incredible//
    if (strpos($Url, 'http://www.incredible.co.za') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var($html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $str = $html->find('div[class=price-box]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $priceSpecial = $html->find('p[class=special-price]', 0)->plaintext;
        $std = $html->find('div[class=std]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $aboutItem= $html->find('div[class=tab-pane]', 0)->plaintext;
        $img= $html->find('div[class=product-image]');
        $moreInfo= $html->find('div[id=more-info-tab]');
        $storeName = 'Incredible';
    }
    //bradlows//
    if (strpos($Url, 'http://www.bradlows.co.za/') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $str = $html->find('span[class=price]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $priceSpecial = $html->find('p[class=special-price]', 0)->plaintext;
        $std = $html->find('div[class=std]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var($html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $img= $html->find('p[class=product-image]');
        $storeName = 'Bradlows';
    }
    //russells//
    if (strpos($Url, 'http://www.russells.co.za/') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $str = $html->find('div[class=price-box]', 0)->plaintext;
        $price = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
        $priceSpecial = $html->find('p[class=special-price]', 0)->plaintext;
        $std = $html->find('div[class=std]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var($html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $img= $html->find('div[class=product-image]');
        $storeName = 'Russells';
    }
    //andthreads//

    if (strpos($Url, 'http://www.andthreads.co.za/') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $str = $html->find('div[class=product-type-data]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $priceSpecial = @$html->find('p[class=special-price]', 0)->plaintext;
        $std = $html->find('div[class=std]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var(@$html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $img= $html->find('div[class=product-image]');
        $moreInfo= $html->find('div[id=more-info-tab]');
        $storeName = 'Andthreads';
    }
    //andthreads//

    if (strpos($Url, 'https://www.myistore.co.za') !== false) {

        $title = filter_var($html->find('div[class=product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= substr( filter_var(@$html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $str = $html->find('span[class=price]', 0)->plaintext;

        $price = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
        $SpecialPrice = @$html->find('p[class=special-price]', 0)->plaintext;
        $priceSpecial = filter_var($SpecialPrice, FILTER_SANITIZE_NUMBER_INT);
        $std = $html->find('div[class=product-short-description]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('div[class=media-wrapper]');
        $moreInfo= $html->find('div[id=tech-specs-tab]');
        $storeName = 'Myistore';
    }
    //Zando//

    if (strpos($Url, 'https://www.zando.co.za') !== false) {

        $title = filter_var($html->find('h1[class=catalog-detail__product-name]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= @substr( filter_var($html->find('div[class=by-sku-name]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT),0);
        $str = $html->find('div[data-selenium=price-main]', 0)->plaintext;
        $priceSpecial = @$html->find('p[class=special-price]', 0)->plaintext;
        $price = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
        $std = $html->find('div[id=productDetail]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('div [class=product-image]');
        $moreInfo= $html->find('div[id=tech-specs-tab]');
        $storeName = 'Zando';
    }
    //Game//

    if (strpos($Url, 'http://www.game.co.za') !== false) {

        $brand = filter_var($html->find('h2[class=product-brand]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $title = $brand. filter_var($html->find('li[class=product]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= filter_var($html->find('h2[class=product-sku]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT);
        $str = $html->find('span[class=price]', 0)->plaintext;
        $priceSpecial = $html->find('p[class=special-price]', 0)->plaintext;
        $price = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
        $std = $html->find('div[class=tab-content]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('div [class=product-image-gallery]');
        $moreInfo= $html->find('div[id=product-info-block]');
        $storeName = 'Game';
    }

    //Makro
    if (strpos($Url, 'https://www.makro.co.za') !== false) {

        $title = filter_var($html->find('h2[id=divProductName]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= filter_var($html->find('h2[class=product-sku]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT);
        $str = $html->find('div[class=price]', 0)->plaintext;
        $priceSpecial = $html->find('p[class=special-price]', 0)->plaintext;
        $price = substr( filter_var($str, FILTER_SANITIZE_NUMBER_INT),0, -2);
        $std = $html->find('div[id=details]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('div [id=ulImage]');
        $moreInfo= $html->find('div[id=products-packaging]');
        $storeName = 'Makro';
    }

    //superbalist
    if (strpos($Url, 'https://superbalist.com') !== false) {


        $title = filter_var($html->find('h1[class=headline-tight]', 0)->plaintext, FILTER_SANITIZE_STRING);
        $sku= filter_var(@$html->find('h2[class=product-sku]', 0)->plaintext, FILTER_SANITIZE_NUMBER_INT);
        $str = $html->find('span[itemprop=price]', 0)->plaintext;
        $priceSpecial = @$html->find('p[class=special-price]', 0)->plaintext;
        $price = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
        $std = $html->find('div[itemprop=description]');
        $std2 = filter_var($std, FILTER_SANITIZE_STRING);
        $img= $html->find('img[itemprop=image]');
        $moreInfo= $html->find('div[id=products-packaging]');
        $storeName = 'Superbalist';
    }



//Deposit //

    if(@$priceSpecial!=Null){
        $deposit = @$priceSpecial * 0.15;
       $price = filter_var(@$priceSpecial, FILTER_SANITIZE_NUMBER_INT);
    }
    else{

        if($price == '1000' or $price >= '550'){

            $deposit = round (@$price * 0.2);
        }
        if($price >= '1001' or $price == '5000'){

            $deposit = round (@$price * 0.15);
        }

        if($price >= '5001'){

            $deposit = round (@$price * 0.1);
        }
    }


// instalment 3 months//
    if($price == '1000' or $price >= '550'){

        $amount = round ($price - $deposit);
        $instalment = round ($amount/3);
        $months = "3 months";
        $amount = round($deposit + $instalment*3);

    }
    else{
        print_r('Price too low for layby, please select laybys above R550');
    }

    // instalment 6 months//
    if($price >= '1001' or $price == '5000'){

        $amount = $price - $deposit;
        $instalment = round ($amount/6, 2);
        $months = "6 months";
        $amount = round($deposit) + round($instalment*6);

    }

    // instalment 12 months//
    if($price >= '5001'){

        $amount = round($price - $deposit);
        $instalment = round ($amount/12, 2);
        $months = "12 months";
        $amount = round($deposit + $instalment*12);

    }

}

if(isset($_POST['cart'])){

    $title = $_POST['title'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $product_ref = $_POST['product_ref'];
    $priceSpecial = $_POST['priceSpecial'];
    $deposit = $_POST['deposit'];
    $instalment = $_POST['instalment'];
    $std = $_POST['std'];
    $Period = $_POST['months'];
    $store = $_POST['store'];

    $data = Array (
        'consumer_id' => @$consumerID,
        'product_ref' => @$product_ref,
        'product_name' => @$title,
        'sku' => @$sku,
        'sku' => 1,
        'price' => @$price,
        'special_price' => @$priceSpecial,
        'period' => @$Period,
        'deposit' => @$deposit,
        'instalment' => @$instalment,
        'store_name' => @$store,
        'description' =>@$std
    );


  $result = $api->post("consumers/laybys",$data);



   $message = json_decode($result->response);
    $errorCode = @$message->code;

   // include 'send_email.php';
    //include 'functions/za-send_sms.php';
}

if(isset($_POST['bank'])){

    $randomPostString = $_POST['randomString'];
    $title = $_POST['title'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $bank = $_POST['bank'];
    $priceSpecial = $_POST['priceSpecial'];
    $deposit = $_POST['deposit'];
    $instalment = $_POST['instalment'];
    $std = $_POST['std'];
    $months = $_POST['months'];
    $store = $_POST['store'];
}

?>