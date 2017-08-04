<?php
/**
 * Crehated by PpStorm.
 * User: Layby Cafe
 * Date: 2016/11/14
 * Time: 10:04 AM
 */

$bankNameDeposit = @$_GET['bank'];
$banks = "bank's";
if(@$source==null and $type!='cash_dep' and $processCash !='cash_dep' ){

    $map = '
<map name="banks">
    <area shape="rect" coords="9,6,75,70" onclick="window.open(\'https://ib.absa.co.za/absa-online/login.jsp\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&amount='.base64_encode($amountTopUp).'&bank=absa" title="ABSA" alt="ABSA">

    <area shape="rect" coords="74,6,136,70" onclick="window.open(\'https://www.fnb.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&amount='.base64_encode($amountTopUp).'&bank=fnb" title="FNB" alt="FNB">


    <area shape="rect" coords="137,6,203,70" onclick="window.open(\'https://netbank.nedsecure.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=nedbank" title="Nedbank" alt="Nedbank">

    <area shape="rect" coords="200,3,243,70" onclick="window.open(\'https://www.encrypt.standardbank.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=standardbank" title="Standard Bank" alt="Standard Bank">


    <area shape="rect" coords="240,6,338,70" onclick="window.open(\'https://direct.capitecbank.co.za/ibank/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=capitec" title="Capitec" alt="Capitec">
<area shape="default" nohref="nohref" title="Default" alt="Default">
</map>
';

}
elseif(@$type=='cash_dep'){
    $map = '
<map name="cash">
    <area shape="rect" coords="9,6,75,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=absa" title="ABSA" alt="ABSA">

    <area shape="rect" coords="74,6,136,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=fnb" title="FNB" alt="FNB">


    <area shape="rect" coords="137,6,203,70"  href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=nedbank" title="Nedbank" alt="Nedbank">

    <area shape="rect" coords="200,3,243,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=standardbank" title="Standard Bank" alt="Standard Bank">


    <area shape="rect" coords="240,6,338,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=capitec" title="Capitec" alt="Capitec">
<area shape="default" nohref="nohref" title="Default" alt="Default">
</map>
';
}
elseif(@$processCash=='cash_dep'){
    $map = '
<map name="cash">
    <area shape="rect" coords="9,6,75,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=absa" title="ABSA" alt="ABSA">

    <area shape="rect" coords="74,6,136,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=fnb" title="FNB" alt="FNB">


    <area shape="rect" coords="137,6,203,70"  href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=nedbank" title="Nedbank" alt="Nedbank">

    <area shape="rect" coords="200,3,243,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=standardbank" title="Standard Bank" alt="Standard Bank">


    <area shape="rect" coords="240,6,338,70" href="engine?process=cash_dep&topup='.base64_encode($refOnTopUp).'&amount='.base64_encode($amountTopUp).'&bank=capitec" title="Capitec" alt="Capitec">
<area shape="default" nohref="nohref" title="Default" alt="Default">
</map>
';
}
else{
    $map = '
<map name="banks">
    <area shape="rect" coords="9,6,75,70" onclick="window.open(\'https://ib.absa.co.za/absa-online/login.jsp\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&cancel='.@$cancel_url.'&store_url='.@$store_url.'&amount='.base64_encode($amountTopUp).'&bank=absa&source='.base64_encode(@$source).'&store='.@$store.'&prodID='.@$product_ref.'" title="ABSA" alt="ABSA">

    <area shape="rect" coords="74,6,136,70" onclick="window.open(\'https://www.fnb.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&store_url='.@$store_url.'&cancel='.@$cancel_url.'&amount='.base64_encode($amountTopUp).'&bank=fnb&source='.base64_encode(@$source).'&store='.@$store.'&prodID='.@$product_ref.'" title="FNB" alt="FNB">


    <area shape="rect" coords="137,6,203,70" onclick="window.open(\'https://netbank.nedsecure.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&store_url='.@$store_url.'&cancel='.@$cancel_url.'&amount='.base64_encode($amountTopUp).'&bank=nedbank&source='.base64_encode(@$source).'&store='.@$store.'&prodID='.@$product_ref.'" title="Nedbank" alt="Nedbank">

    <area shape="rect" coords="200,3,243,70" onclick="window.open(\'https://www.encrypt.standardbank.co.za/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&store_url='.@$store_url.'&cancel='.@$cancel_url.'&amount='.base64_encode($amountTopUp).'&bank=standardbank&source='.base64_encode(@$source).'&store='.@$store.'&prodID='.@$product_ref.'" title="Standard Bank" alt="Standard Bank">


    <area shape="rect" coords="240,6,338,70" onclick="window.open(\'https://direct.capitecbank.co.za/ibank/\',\'popUpWindow\',\'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes\');" href="engine?topup='.base64_encode($refOnTopUp).'&store='.@$store.'&store_url='.@$store_url.'&cancel='.@$cancel_url.'&amount='.base64_encode($amountTopUp).'&bank=capitec&source='.base64_encode(@$source).'&store='.@$store.'&prodID='.@$product_ref.'" title="Capitec" alt="Capitec">
<area shape="default" nohref="nohref" title="Default" alt="Default">
</map>
';
}



print_r($map);


if(@$source=='online stores' and @$step!=3){



    $finalBTN = '<a href="process?paid=true&source='.base64_encode(@$source).'&store='.@$store.'&store_url='.@$store_url.'&prodID='.@$product_ref.'&step=3" class="btn btn-default">Complete Transaction</a>';


     $product_ref = @$_GET['prodID'];
     $amount=0;
     $ismerchant=0;
     $consumer_id = ltrim ($refOnTopUp,'Lb');
    if(isset($_POST['cancelLayby'])) {

        $cancelResult = $api->put("/consumers/$consumer_id/cancel/$product_ref/ismerchant/$ismerchant/amount/$amount");

        $data = json_decode($cancelResult->response);


        if($data->code==325){

            print_r('Layby Cancelled You will be redirected to the store in 5 Seconds');

            $cancel_url= @$_GET['cancel'];

            $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="'.$cancel_url.'";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


            print_r($redirect);
        }

    }
    $cancel= '
    <form method="post" accept-charset="UTF-8">
    <button  type="submit" name="cancelLayby" class="">Cancel</button>
    </form>
';
}else{

    if(@$step==3){

        $finalBTN = '<a href="process?paid=true&source='.base64_encode(@$source).'&store='.@$store.'&store_url='.@$store_url.'&prodID='.@$product_ref.'" class="btn btn-default">Continue</a>';

    }else{

        $finalBTN = '<a href="check_payment?reference='.@$refOnTopUp.'" class="btn btn-default">Continue</a>';
    }


}

if(@$processCash!='cash_dep'){
    if($bankNameDeposit=="fnb"){
        $paymentOption ='
<div class="row">
<div>
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>

						</div>
						 <h6><br>



						   <p align="center">
						   <img src="img/bank-icons.png" usemap="#banks">

                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>

						 <p>



                           					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                                                    <br>
                        </div>

						<br>
              <table class="table">
              <tbody>
                </td></tr>
              <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Layby Cafe</td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>62597633843</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>230145</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>FNB</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Cheque</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong>'.$refOnTopUp.'</strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R '.$amountTopUp.'</strong></td>
  </tr>
  <tr><td colspan="2"><p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your '.$banks.' nearest branch or at any cash accepting ATM..</p></td></tr>
</tbody></table>
<p></p>

					            </form>
					            <div class="row" role="form">
					        <div class="col-md-6" align="center"><strong>'.$finalBTN.'</strong></div>
                      <div class="col-md-4" align="center"><strong>'.@$cancel.'</strong></div>

                          
                        </div>
					            </div></div>';

    }
    if($bankNameDeposit=="nedbank"){
        $paymentOption ='
<div class="row">
<div>
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>

						</div>
						 <h6><br>



						   <p align="center">
						   <img src="img/bank-icons.png" usemap="#banks">

                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>

						 <p>



                           					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                                                    <br>
                        </div>

						<br>
              <table class="table">
              <tbody>
               <tr><td colspan="2"><p style="font-size:12px" align="center">Instant EFT verification from <strong>Nedbank</strong> is not supported - payment will be verified within 24hrs.</p>                          <br>
</td></tr>
              <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Layby Cafe</td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>62597633843</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>230145</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>FNB</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Cheque</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong>'.$refOnTopUp.'</strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R '.$amountTopUp.'</strong></td>
  </tr>
  <tr><td colspan="2"><p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your '.$banks.' nearest branch or at any cash accepting ATM..</p></td></tr>
</tbody></table>
<p></p>

					            </form>
                        <div class="row" role="form">
                           <div class="col-md-6" align="center"><strong>'.$finalBTN.'</strong></div>
                      <div class="col-md-4" align="center"><strong>'.@$cancel.'</strong></div>
               
                        </div>
					            </div>
                    </div>';

    }
    if($bankNameDeposit=="capitec"){
        $paymentOption ='
<div class="row">
<div>
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>

						</div>
						 <h6><br>



						   <p align="center">
						   <img src="img/bank-icons.png" usemap="#banks">

                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>

						 <p>



                           					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                                                    <br>
                        </div>

						<br>
              <table class="table">
              <tbody>
               <tr><td colspan="2"><p style="font-size:12px" align="center">Instant EFT verification from <strong>Capitec Bank</strong> is not supported - payment will be verified within 24hrs.</p>                          <br>
</td></tr>
              <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Layby Cafe</td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>62597633843</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>230145</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>FNB</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Cheque</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong>'.$refOnTopUp.'</strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R '.$amountTopUp.'</strong></td>
  </tr>
  <tr>
  <td colspan="2"><p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your '.$banks.' nearest branch or at any cash accepting ATM..</p></td></tr>
</tbody></table>
<p></p>

					            </form>
					            <div class="row" role="form">
					         <div class="col-md-6" align="center"><strong>'.$finalBTN.'</strong></div>
                         <div class="col-md-4" align="center"><strong>'.@$cancel.'</strong></div>
                        
                                </div>
					            </div>

                    </div>';

    }
    if($bankNameDeposit=="absa"){
        $paymentOption ='
<div class="row">

<div >
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>

						</div>
						 <h6><br>



						   <p align="center">
						   <img src="img/bank-icons.png" usemap="#banks">

                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>

						 <p>



                           					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                          <br>
                          <br>
                        </div>

						<br>

              <table class="table">
              <tbody><tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Layby Cafe</td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>4089766485</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>632005</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>ABSA</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Savings</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong>'.$refOnTopUp.'</strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R '.$amountTopUp.'</strong></td>
  </tr>
    <tr><td colspan="2"><p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your '.$banks.' nearest branch or at any cash accepting ATM..</p></td></tr>

</tbody></table>


                        <div class="row" role="form">
                            <div class="col-md-6" align="center"><strong>'.$finalBTN.'</strong></div>
                      <div class="col-md-4" align="center"><strong>'.@$cancel.'</strong></div>
               
                                </form></div>
                    </div></div>';

    }
    if($bankNameDeposit=="standardbank"){
        $paymentOption ='
<div class="row">
<div>
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>

						</div>
						 <h6><br>



						   <p align="center">
						   <img src="img/bank-icons.png" usemap="#banks">

                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>

						 <p>



                           					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                                                    <br>
                        </div>

						<br>
              <table class="table">
              <tbody>
               <tr><td colspan="2"><p style="font-size:12px" align="center">Instant EFT verification from <strong>Standard Bank</strong> is not supported - payment will be verified within 24hrs.</p>                          <br>
</td></tr>
              <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Layby Cafe</td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>302155546</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>012645</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>Standard Bank</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Current</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong>'.$refOnTopUp.'</strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R '.$amountTopUp.'</strong></td>
  </tr>
  <tr>
  <td colspan="2"><p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your '.$banks.' nearest branch or at any cash accepting ATM..</p></td></tr>
</tbody></table>
<p></p>

					            </form>
					            <div class="row" role="form">
					         <div class="col-md-6" align="center"><strong>'.$finalBTN.'</strong></div>
                         <div class="col-md-4" align="center"><strong>'.@$cancel.'</strong></div>
                        
                                </div>
					            </div>

                    </div>';

    }
}else{
    $paymentOption =
        "
<div class='row'>

<h4>$cashDepRes->message</h4>
                            <script type='text/javascript'>
                                    function Redirect()
                                    {
                                    window.location='dashboard';
                                    }
                                    setTimeout('Redirect()', 5000);
                                    </script>
</div>"
;
}

if(@$refOnTopUp!=NULL){

  require_once 'mail_handler.php';

}