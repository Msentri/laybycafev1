<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

include 'header.php';
include 'functions/dashboard.php';
include 'functions/get_product.php';
include 'functions/payment.php';

$transact = random_int(1000,99999999);
$GetLaybyID = @$_GET['layby'];
?>      <div class="page-header">
    <?php

    if(@$GetLaybyID==NULL){
        $pageTittle = ' <div class="container"><h1 class="title">create layby</h1></div>';
        print_r($pageTittle);
    }else{

        $itemTittle =' <div class="container"><h1 class="title">'.@$title.'</h1></div>';
        print_r($itemTittle);
    }



    ?>
</div>

</div>
    </div>
    <div class="container">
			<section class="page-section">
                <div class="remodal-bg">
				<div class="container">
					<div class="row">
                        <div class="panel col-md-12">
                            <?php

                            if(@$std2==NULL)
                            {



                                $layby ='

<div class="container who-we-are pad-60">
				<div class="row">
					<div class="col-md-4 animated fadeInRight visible" data-animation="fadeInRight">
						<h5 class="no-margin">Create New Layby</h5>

					</div>
					<form autocomplete="off" action=create?layby='.base64_encode(@$transact).' method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                        <div class="col-md-8 animated fadeInLeft visible" data-animation="fadeInLeft">
						<div class="input-group domain-search" id="Domain-search">
							<input name="url" required type="text" class="form-control" placeholder="http://www.zando.co.za/Jordan-Axcel-White-138989.html">
							<div class="input-group-btn">
								<div class="btn-group" role="group">

									<button name="addLayby" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</div>
							</div>       </form>
						</div>
					</div>
				</div>';

                            }
                            else{
                            ?>


                            <div class="container shop">
                                <div class="row">
                                    <div class="col-md-12 product-page">
                                        <?php

                                        if(@$priceSpecial!=null){
                                            $priceSpecial = number_format(@$priceSpecial, 2, ',', ' ');
                                        }
                                        else{
                                            $priceSpecial =0;
                                        }
                                        if($price == '1000' or $price >= '550'){

                                            $getStep1 = $step1;
                                        }
                                        $item ='


                     <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="single-product">
                                <p id="zoom-product" width="500" height="600" >'.@$img.'</p>

										<div id="zoom-product-thumb" class="zoom-product-thumb">
											<div class="owl-carousel navigation-shop dark-switch lr-pad-20" data-pagination="false" data-autoplay="true" data-navigation="true" data-items="3" data-tablet="4" data-mobile="3"></div>
										</div>
                                </div>
                            </div>
                            <!-- .product -->
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
                                <span class="price">R '.number_format(round(@$price)).'</span></div>
                                <div class="description">
                                    <p>'.@$std.'</p>
                                    <div class="product-meta-info-wrapper"><div class="row"><div class="col-md-4"><div class="product-meta-item clearfix"><i class="icomoon2 icomoon2-alarmclock2"></i><div class="product-meta-content">
                                      <p class="product-meta-title">DEPOSIT</p>
                                      <h5 class="product-meta-value">R'.number_format(round(@$deposit)).'</h5></div></div></div><div class="col-md-4"><div class="product-meta-item clearfix"><i class="icomoon2 icomoon2-medal2"></i><div class="product-meta-content">
                                        <p class="product-meta-title">MONTHLY INSTALLMENT</p>
                                        <h5 class="product-meta-value">R'.number_format(round(@$instalment)).'</h5></div></div></div><div class="col-md-4"><div class="product-meta-item clearfix"><i class="icomoon2 icomoon2-library"></i><div class="product-meta-content">
                                          <p class="product-meta-title">PERIOD</p>
                                  <h5 class="product-meta-value">'.@$months.'</h5></div></div></div></div></div>
                                </div>
                                <div class="product-regulator">
                                   '.$getStep1.'
                                </div>

                               <div class="product-meta-details">
                                <span class="product-code">SKU: '.@$sku.'</span></div>
                            </div>
                        </div>
                        <div class="row top-pad-80">
                            <div class="col-md-12">
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Additional Info</a>
                                        </li>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
                                            <h5>Additional Info</h5>
                                            '.@$moreInfo.'
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                        print_r($item);

                                      if(@$instalment!=NULL){
                                            if(@$payment=='paid'){
                                                print_r($laybyForm);}
                                        }
                                        else{
                                            print_r('Price too low for layby, please select laybys above R550');
                                        }
                                        }
                                        if(@$stepGet != NULL){

                                            print_r(@$step2);


                                        }
                                        else{
                                            print_r(@$layby);
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
                <div class="remodal" data-remodal-id="modal">
                    <button data-remodal-action="close" class="remodal-close"></button>

                   <h2>Order Added</h2>
                    <p>
                        Order<strong> <?php print_r(@$product_ref);?></strong> created successfully
                    <br>
                        <a href="cart"   class="btn btn-default btn-lg"><strong>Go To Cart</strong></a>
                        <button data-remodal-action="cancel" class="btn btn-default btn-lg"><strong>Continue Shopping</strong></button>

                </div>
            </section>

<?php
include_once 'footer.php';
?>
