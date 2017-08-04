

<map name="banks">
    <area shape="rect" coords="9,6,75,70" onclick="window.open('https://ib.absa.co.za/absa-online/login.jsp','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="search.php?bank=absa&step=step2" title="ABSA" alt="ABSA">

    <area shape="rect" coords="74,6,136,70" onclick="window.open('https://www.fnb.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="search.php?bank=fnb&step=step2" title="FNB" alt="FNB">


    <area shape="rect" coords="137,6,203,70" onclick="window.open('https://netbank.nedsecure.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="search.php?bank=nedbank&step=step2" title="Nedbank" alt="Nedbank">

    <area shape="rect" coords="200,3,243,70" onclick="window.open('https://www.encrypt.standardbank.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="search.php?bank=standardbank&step=step2" title="Standard Bank" alt="Standard Bank">


    <area shape="rect" coords="240,6,338,70" onclick="window.open('https://direct.capitecbank.co.za/ibank/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="search.php?bank=capitec&step=step2" title="Capitec" alt="Capitec">


    <area shape="default" nohref="nohref" title="Default" alt="Default">
</map>
<?php

// get bank info//
if(@$str!=null){
$step1='
        <div class="row">

            <!-- .content -->
            <div class="col-sm-8 col-md-3">
                    <div class="row" role="form">
             <form autocomplete="off" action="create?type=addcart#modal"  method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                    <div class="col-md-4"></div>
                     <input hidden type="hidden" name="randomString" value="'.@$randomString.'" class="form-control">
                     <input hidden type="hidden" name="product_ref" value="'.@$trans_number.'" class="form-control">
                         <input hidden type="hidden" name="title" value="'.@$title.'" class="form-control">
                         <input hidden type="hidden" name="sku" value="'.@$sku.'" class="form-control">
                        <input hidden type="hidden" name="price" value="'.@round($price).'" class="form-control">
                        <input hidden type="hidden" name="balance" value="'.@round($price).'" class="form-control">
                         <input hidden type="hidden" name="priceSpecial" value="'.@round($priceSpecial).'" class="form-control">
                         <input hidden type="hidden" name="deposit" value="'.@round($deposit).'" class="form-control">
                         <input hidden type="hidden" name="instalment" value="'.@round($instalment).'" class="form-control">
                          <input hidden type="hidden" name="store" value="'.@$storeName.'" class="form-control">
                          <input hidden type="hidden" name="std" value="'.@$std2.'" class="form-control">
                             <input hidden type="hidden" name="months" value="'.@$months.'" class="form-control">
                            <button type="submit" name="cart" class="btn btn-default btn-lg">Add to cart</button>


                                                            </form>

                    </div>
               </form></div>
        </div>
        <br>';}

//step 2//

$step2='
        <div class="row">
            <div class="content col-sm-4 col-md-12">
            <div class="panel panel-default">
            <div class="panel-body">

                    <h3 class="title">'.@$title.', Order '.@$trans_number.'</h3>
                    <div class="row" role="form">
                        <div class="col-md-12"> Deposit Required <span class="pull-right"><strong> R '.number_format(@$deposit, 2, ',', ' ').'</strong></span></div>
                    </div>
                    <div class="row" role="form">
                        <div class="col-md-12"> Monthly Installment <strong>('.@$months.')<span class="pull-right"></span></strong><span class="pull-right"><strong> R '.number_format(@$instalment, 2, ',', ' ').'</strong></span></div>
                    </div>
                    <div class="row" role="form">
                        <div class="col-md-12">
                            <hr>
                            <h6><strong> TOTAL AMOUNT <span class="pull-right">R '.number_format(@$price, 2, ',', ' ').'</span></strong></h6>
                            <hr>
                        </div>
                    </div></form></div></div>
                    <div class="clearfix"> </div>



            </div>
            <!-- .content -->
            <div class="col-sm-18 col-md-4">
             <div class="panel panel-default">
                <form class="light-bg contact-form pad-40" method="post">
                    <div class="row" role="form">
                        <div class="col-md-4"><b> Step 2</b></div>
                        <div class="col-md-6">Make payment</div>
                        <div class="panel-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                    <tbody><tr>
                           <td width="110"><strong>Recipient</strong></td>
                            <td width="163">Laybye Cafe </td>
                          </tr>
                          <tr>
                            <td><strong>Account</strong></td>
                            <td>62544363873</td>
                          </tr>
                          <tr>
                            <td><strong>Branch</strong></td>
                            <td>256505</td>
                          </tr>
                          <tr>
                            <td><strong>Bank</strong></td>
                            <td>'.@$bank.'</td>
                          </tr>
                          <tr>
                            <td><strong>Acc Type </strong></td>
                            <td>Cheque</td>
                          </tr>
                          <tr>
                            <td><strong>Reference</strong></td>
                            <td><strong>LB'.$consumerID.'</strong></td>
                          </tr>
                          <tr>
                            <td><strong>Amount</strong></td>
                            <td><strong>R
                              '.number_format(@$deposit, 2, ',', ' ').'    </strong></td>
                          </tr>
                        </tbody></table></div>
                    </div>

						 <span class="pull-right">
                            <a href="#" class="text-success">Start over!</a>                        </span>
                            <!-- .buttons-box --></p>
                    </h6></form></div></div>
        </div>
        <br>

        <div class="table-scrollable">
                                                    <table class="table table-striped table-bordered table-advance table-hover">
                                                        <tr>
                                                            <th>
                                                                <i class="fa "></i>
                                                                Title
                                                            </th>
                                                            <th>
                                                                <i class="fa "></i>
                                                                Store
                                                            </th>
                                                            <th>
                                                                <i class="fa "></i>
                                                                Oder ID
                                                            </th>
                                                            <th>
                                                                <i class="fa "></i>
                                                                Price R
                                                            </th>

                                                            <th>
                                                                <i class="fa fa-bookAiri Satou"></i>
                                                                Special Price R
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-bookAiri Satou"></i>
                                                                Deposit
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-bookAiri Satou"></i>
                                                                Instalment
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-bookAiri Satou"></i>
                                                                Layby Period
                                                            </th>

                                                        </tr>
                                                        <tr>
                                                        <td>'.@$_SESSION['title'].'</td>
                                                        <td>'.@$store.'</td>
                                                        <td>'.@$trans_number.'</td>
                                                        <td>'.@$price.'.00</td>
                                                        <td>'.@$priceSpecial.'.00</td>
                                                        <td>'.@$deposit.'</td>
                                                        <td>'.@$instalment.'</td>
                                                        <td>'.@$months.'</td>

                                                        </tr>

                                                        </table>
                                                            <form autocomplete="off"  method="post" action="create?status=complete" accept-charset="UTF-8" role="form" class="form-horizontal">
                                                            <input hidden type="hidden" name="randomString" value="'.@$randomString.'" class="form-control">
                                                            <input hidden type="hidden" name="title" value="'.@$title.'" class="form-control">
                                                            <input hidden type="hidden" name="product_ref" value="'.@$trans_number.'" class="form-control">
                                                            <input hidden type="hidden" name="sku" value="'.@$sku.'" class="form-control">
                                                            <input hidden type="hidden" name="price" value="'.@$price.'" class="form-control">
                                                            <input hidden type="hidden" name="priceSpecial" value="'.@$priceSpecial.'" class="form-control">
                                                            <input hidden type="hidden" name="deposit" value="'.@$deposit.'" class="form-control">
                                                            <input hidden type="hidden" name="instalment" value="'.@$instalment.'" class="form-control">
                                                            <input hidden type="hidden" name="store" value="'.@$store.'" class="form-control">
                                                            <input hidden type="hidden" name="std" value="'.@$std.'" class="form-control">
                                                            <input hidden type="hidden" name="months" value="'.@$months.'" class="form-control">
                                                            <button type="submit" name="layby" class="btn btn-primary">Process Layby</button>
                                                            </form>
        ';
?>