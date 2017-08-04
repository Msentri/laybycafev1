<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';


$converter = new CurrencyConverter\CurrencyConverter;

if(isset($_POST['barcode'])){

    $barcode = $_POST['barcode'];
    $product = $api->get("/barcode/$barcode");

    $productDetails = json_decode($product->response);


    $code = @$productDetails ->code;
    if(@$code!=01){

    $singleBarcode = $productDetails->barcode;
    $title = $productDetails->title;
    $currency = $productDetails->currency;
    $price = $productDetails->lowest_recorded_price;
    $description= $productDetails->description;

    if($currency==null){
        $currency=='USD';
    }else{
        $currency = $currency;
    }
    $rate = $converter->convert($currency, 'ZAR');

    $total = round($price*$rate,0);
    $images = $api->get("/product/images/$singleBarcode");

    $imageData = json_decode($images->response);
    }


    //include 'includes/barcode_upload.php';
}

?>      <div class="page-header">
    <?php

    if(@$title==NULL){
        $pageTittle = ' <div class="container"><h1 class="title">Search Product</h1></div>';
        print_r($pageTittle);
    }else{
        print_r('<div class="container"><h1 class="title">'.@$title.'</h1></div>');
    }

    ?>
</div>
<link rel="stylesheet" type="text/css" href="includes/serratus/example/css/styles.css"/>
</div>
    </div>

<?php
if(@$singleBarcode==null){
?>
<section class="page-section">
    <div class="container">
        <div class="remodal-bg">
            <div class="row">    <div class="col-lg-3"></div>
                <div class="col-lg-6">

                    <h3>Creating Layby With Barcode</h3>

                    <p>This function let's you select/scan an image from your local/mobile filesystem.
                        then tries to decode the barcode using
                        the preferred method (<strong>Code128</strong> or <strong>EAN</strong>).</p>

                    <p>This also works great on a wide range of mobile-phones is still very limited.</p>

                    <div id="result_strip">
                        <ul class="thumbnails"></ul>
                    </div>
                    <div class="controls" class="col-md-12">
                        <fieldset class="input-group">
                            <input type="file" accept="image/*" capture="camera"/>
                            <button class="btn btn-default">Rerun</button>
                        </fieldset>
                        <fieldset class="reader-config-group">
                            <div class="col-md-6">
                            <label>
                                <span>Barcode-Type</span>
                                <select class="form-control" name="decoder_readers">
                                    <option value="code_128">Code 128</option>
                                    <option value="code_39">Code 39</option>
                                    <option value="code_39_vin">Code 39 VIN</option>
                                    <option value="ean" selected="selected">EAN</option>
                                    <option value="ean_extended">EAN-extended</option>
                                    <option value="ean_8">EAN-8</option>
                                    <option value="upc">UPC</option>
                                    <option value="upc_e">UPC-E</option>
                                    <option value="codabar">Codabar</option>
                                    <option value="i2of5">ITF</option>
                                </select>
                            </label>
                            <label>
                                <span>Patch-Size</span>
                                <select class="form-control" name="locator_patch-size">
                                    <option value="x-small">x-small</option>
                                    <option value="small">small</option>
                                    <option value="medium">medium</option>
                                    <option selected="selected" value="large">large</option>
                                    <option value="x-large">x-large</option>
                                </select>
                            </label>
                            <label>
                                    <span>Workers</span>
                                    <select class="form-control" name="numOfWorkers">
                                        <option value="0">0</option>
                                        <option selected="selected" value="1">1</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-md-6">
                             <label>
                                    <span>Resolution</span>
                                    <select class="form-control" name="input-stream_size">
                                        <option value="320">320px</option>
                                        <option value="640">640px</option>
                                        <option selected="selected" value="800">800px</option>
                                        <option value="1280">1280px</option>
                                        <option value="1600">1600px</option>
                                        <option value="1920">1920px</option>
                                    </select>
                                </label>
                            <label>
                                <span>Half-Sample</span>
                                <input class="form-control" type="checkbox" name="locator_half-sample" />
                            </label>
                            <label>
                                <span>Single Channel</span>
                                <input class="form-control" type="checkbox" name="input-stream_single-channel" />
                            </label>
                            </div>
                        </fieldset>
                    </div>
                    <div id="interactive" class="viewport"></div>
        <div id="debug" class="detection"></div>
                </div></div></div></div>


</section>
<?php }
else {

?>
<section class="page-section">
    <div class="container">
        <div class="container shop">
            <div class="row">
                <div class="col-md-12 product-page">

<?php
if(@$imageData->message==null){
    foreach ($imageData as $key=>$images){


        $img = '<img src="'.$images->image.'"><br/>';}

}
else{$img = ''.$imageData->message.'';}
?>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-product">
                            <p id="zoom-product" width="500" height="600" ><?php print_r(@$img);?></p>

                            <div id="zoom-product-thumb" class="zoom-product-thumb">
                                <div class="owl-carousel navigation-shop dark-switch lr-pad-20" data-pagination="true" data-autoplay="true" data-navigation="true" data-items="3" data-tablet="4" data-mobile="3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="product-rating pull-right">
                            <div class="star-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i></div>
                        </div>
                        <div class="price-details">
                            <span class="price">R <?php print_r($total);?> </span></div>
                        <div class="description">
                            <div class="product-meta-info-wrapper"><div class="row"><div class="col-md-4"><div class="product-meta-item clearfix"><i class="icomoon2 icomoon2-alarmclock2"></i><div class="product-meta-content">
                                                <p class="product-meta-title">
                                                    <?php print_r($title);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-8 col-sm-6">
                    <div class="row top-pad-80">
                        <div class="description">
                        <div class="col-md-12">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#merchants" aria-controls="merchants" role="tab" data-toggle="tab">Merchants</a>
                                    </li>
                                </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="description">
                                            <?php print_r(@$description);?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="merchants">
                                            merchants
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

</section>
</div>
<?php
}
?>
<?php
include_once 'footer.php';
?>
