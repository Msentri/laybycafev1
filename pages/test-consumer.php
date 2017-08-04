<?php
session_start();
if (isset($_POST['submit'])) {
	header ("Location: /test-complete/XXXXXXXXX");
}

	$merchant_logo = "/files/logo/demo-store-logo.png";
	
	$filename = "https://www.laybycafe.co.za".$merchant_logo;
	$data = getimagesize($filename);
	$width = $data[0];
	$height = ceil($data[1]/2);
	
	if ($width > 450) {
		$width_max = "width:180px !important";
		}

	$amount = $_SESSION['amount'];
	$success_url = $_SESSION['success_url'];
	$description = $_SESSION['desc'];

?>  


<map name="banks">
    <area shape="rect" coords="9,6,75,70" onclick="window.open('https://ib.absa.co.za/absa-online/login.jsp','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=absa#step2" title="ABSA" alt="ABSA" />
    
    <area shape="rect" coords="74,6,136,70" onclick="window.open('https://www.fnb.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=fnb#step2" title="FNB" alt="FNB" />
    
    
    <area shape="rect" coords="137,6,203,70" onclick="window.open('https://netbank.nedsecure.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=nedbank#step2" title="Nedbank" alt="Nedbank" />
    
    <area shape="rect" coords="200,3,243,70" onclick="window.open('https://www.encrypt.standardbank.co.za/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=standardbank#step2" title="Standard Bank" alt="Standard Bank" />


   <area shape="rect" coords="240,6,338,70" onclick="window.open('https://direct.capitecbank.co.za/ibank/','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');" href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=capitec#step2" title="Capitec" alt="Capitec" /> 

	
    <area shape="default" nohref="nohref" title="Default" alt="Default"/>
</map>


    <!-- Sticky Navbar -->
    <div class="page-header" style="background-color:#FFF">
      <div class="container"><img src="<?php echo $merchant_logo; ?>" alt="" style="height:<?php echo $height ?>px !important; <?php echo $width_max; ?>" /> <span style="float:right"><img src="/img/secure-payments-by.png" alt="" width="120" height="50" /></span> </div>
    </div>
    <!-- page-header -->
        <section class="page-section">
            <div class="container">
                
                
                <div class="row">
                    <div class="content col-sm-12 col-md-4">
                      
                     <?php if (empty($_GET['tm']) || $_GET['tm'] ==0) {  ?>
                     
                     <?php } else { ?>
                      
                      <form id="contact-form" class="contact-form" method="post">
                        <h3 class="title"><?php echo $description; ?> </h3>
                        
						
                        <div class="clearfix"> </div>
                        <!-- .buttons-box -->
                      </form>
                      
                      <?php } ?>
                      
                      
                    </div>
                    
                    
                    <!-- .content -->
                    <div align="center" class="col-md-4">
                    
                    
                
                    
                        <form id="contact-form" class="light-bg contact-form pad-40" method="post">
						 <div class="row" role="form">
                         
                    <p align="center" style="font-size:10px"><strong>Posh Patterns</strong></p>
                    <div class="row" role="form" align="left" style="font-size:10px">
                         <div class="col-md-8"> Once Off Deposit <span class="pull-right"><strong> R120</strong></span></div>
                    </div>
                    <div class="row" role="form" align="left" style="font-size:10px">
                         <div class="col-md-8"> Monthly Installment  <span class="pull-right"><strong> R240</strong></span></div>
                    </div>
                    <div class="row" role="form" align="left" style="font-size:10px">
                         <div class="col-md-8"> Total Amount<span class="pull-right"><strong> R1200</strong></span></div>
                    </div>
                    <p align="center"><hr/></p>
                    
                          <div class="col-md-4"><b> Step 1</b></div>
                          <div class="col-md-6">Select Your Bank</div>
                       
						</div>
						 <h6><br/>
						   
						   
						   
						   <p align="center">
						   <img src="/content/images/bank-icons.png"   usemap="#banks"  />
						   
                           <a name="step2" id="step2"></a>
						   <a name="step3" id="step3"> </a>
						   </p>
					      
						 <p>
						
            
                        
                           <?php 
						
						 if (isset($_GET['bank'])) {
						 ?>
					      </p>
						 <div class="row" role="form">
                          <div class="col-md-4"><b>Step 2</b></div>
                          <div class="col-md-6">Make  payment</div>
                        </div>
						
						<br/>
						
						
						
						
  <?php if ($_GET['bank'] == 'absa') { ?>
						 
			<table width="283" border="0">
  <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Laybye Cafe </td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>9309249112</td>
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
    <td><strong><?php echo $reference_number; ?></strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R <?php 
						if (empty($_GET['tm']) || $_GET['tm'] ==0)
							echo deposit_amount($amount);
						else 
							echo $amount;
							
				 ?> </strong></td>
  </tr>
</table>			  
<?php } else if ($_GET['bank'] == 'standardbank') {?>
						 
			<table width="283" border="0">
  <tr>
    <td width="110"><strong>Recipient</strong></td>
    <td width="163">Laybye Cafe </td>
  </tr>
  <tr>
    <td><strong>Account</strong></td>
    <td>000446025</td>
  </tr>
  <tr>
    <td><strong>Branch</strong></td>
    <td>00480502</td>
  </tr>
  <tr>
    <td><strong>Bank</strong></td>
    <td>Standard Bank</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Cheque</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong><?php echo $reference_number; ?></strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R 
      <?php 
						if (empty($_GET['tm']) || $_GET['tm'] ==0)
							echo deposit_amount($amount);
						else 
							echo $amount;
							
				 ?>
    </strong></td>
  </tr>
</table>
            <p>
              <?php } else if ($_GET['bank'] == 'nedbank') {?>
            </p>
            <p style="font-size:12px" align="center">Instant EFT verification from <strong>Nedbank</strong> are not supported - payment will be verified within 24hrs.</p>
            <table width="283" border="0">
              <tr>
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
                <td>FNB</td>
              </tr>
              <tr>
                <td><strong>Acc Type </strong></td>
                <td>Cheque</td>
              </tr>
              <tr>
                <td><strong>Reference</strong></td>
                <td><strong><?php echo $reference_number; ?></strong></td>
              </tr>
              <tr>
                <td><strong>Amount</strong></td>
                <td><strong>R
                  <?php 
						if (empty($_GET['tm']) || $_GET['tm'] ==0)
							echo deposit_amount($amount);
						else 
							echo $amount;
							
				 ?>
                </strong></td>
              </tr>
            </table>
            <?php } else if ($_GET['bank'] == 'capitec') {?>
            <p style="font-size:12px" align="center">Instant EFT verification from <strong>Capitec Bank</strong> are not supported -  payment will be verified within 24hrs.</p>
            <table width="283" border="0">
              <tr>
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
                <td>FNB</td>
              </tr>
              <tr>
                <td><strong>Acc Type </strong></td>
                <td>Cheque</td>
              </tr>
              <tr>
                <td><strong>Reference</strong></td>
                <td><strong><?php echo $reference_number; ?></strong></td>
              </tr>
              <tr>
                <td><strong>Amount</strong></td>
                <td><strong>R
                  <?php 
						if (empty($_GET['tm']) || $_GET['tm'] ==0)
							echo deposit_amount($amount);
						else 
							echo $amount;
							
				 ?>
                </strong></td>
              </tr>
            </table>
            <?php } else if ($_GET['bank'] == 'fnb') {?>
            <table width="283" border="0">
              <tr>
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
    <td>FNB</td>
  </tr>
  <tr>
    <td><strong>Acc Type </strong></td>
    <td>Cheque</td>
  </tr>
  <tr>
    <td><strong>Reference</strong></td>
    <td><strong><?php echo $reference_number; ?></strong></td>
  </tr>
  <tr>
    <td><strong>Amount</strong></td>
    <td><strong>R 
      <?php 
						if (empty($_GET['tm']) || $_GET['tm'] ==0)
							echo deposit_amount($amount);
						else 
							echo $amount;
							
				 ?>
    </strong></td>
  </tr>
</table>
					      <p>
					        <?php } ?>						
					</p>
					                  <p style="font-size:12px" align="center"><b>Note:</b> You can also make a cash deposit at your bank's nearest branch or at any cash accepting ATM..</p>
                                      <div class="row" role="form">
                      	
                          <div align="center"><strong><a href="/test-consumer/<?php echo $_GET['transaction_id']; ?>&bank=<?php echo $_GET['bank']; ?>&paid=1#step4" style="color:#FFC400">Continue</a></strong></div>
                        </div>

<br/>


<?php  } ?>

<?php 
						
						 if (isset($_GET['bank']) && isset($_GET['paid'])) {
						 ?>
<div class="row" role="form">
                          <div class="col-md-4"><b><a name="step4" id="step4"> Step 3</a></b></div>
                          <div class="col-md-6">Finally!</div>
                        </div>

						
		
                        <div class="clearfix"></div>
						<br/>
                          <input type="submit" name="submit" class="btn btn-default" value="Complete transaction" />
						
                        <?php } ?>
						 <span class="pull-right">
                         <a href="/test-consumer/<?php echo $_GET['transaction_id']; ?>" class="text-success">Start over!</a>                        </span> 
                        <!-- .buttons-box --></form>
                        
                    </div>
              </div>
                
				<br/>
				<hr />
				 <div class="col-md-12">Laybye Cafe handles secure online payments on behalf of <?php echo $merchant_name; ?>. By transacting with <?php echo $merchant_name; ?>, you acknowledge that you have read and agree to the terms of our End User Agreement.</div>
				
            </div>
        </section>