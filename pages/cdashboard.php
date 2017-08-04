<section class="page-section">
            <div class="container">
                <div class="row">
                    <h1>Dashboard</h1>
                </div>
                <div class="row">

<table class="table">
					  <caption></caption>
					  <thead>
						<tr>
						  <th>Date</th>
						  <th>Store</th>
						  <th>Monthly Installment</th>
                          <th>Next Payment Due Installment</th>
						  <th>Total Amount</th>
					    </tr>
					  </thead>
					  <tbody>
 <tr>
						  
                          
                          <th scope="row"><a href="/acc/view-transaction?id=<?php echo $layby_id; ?>">12 Jan 2016</a></th>
						  <td><a href="/acc/view-transaction?id=<?php echo $layby_id; ?>">Zando - #457838</a></td>
						  <td>R450</td>
                          <td>14 Days (End of November)</td>
						  <td><strong>R5000</strong></td>
</tr>


                        
                        
                        
                       
	    </tbody>

   				  </table>   
                                             
 <hr /></p>
                  <div class="row responsive-features top-pad-20">
                              <!-- Features 1 -->
                              <div class="col-md-4">
                                <!-- Title And Content -->
                                <span class="text-color"></span>
                             
                              
                              </div>
                              <!-- Features 1 -->
                              <!-- Features 2 -->
                              <div class="col-md-4">
                                <!-- Title And Content -->
                                <span class="text-color"></span>
                                <h5>&nbsp;</h5>
                              </div>
                              <!-- Features 2 -->
                              <!-- Features 3 -->
                              <div class="col-md-4">
                                <!-- Title And Content -->
                                <p align="right"><strong>Wallet Balance: R<?php echo floor(available_balance($merchant_id) - (available_balance($merchant_id) * 0.035)); ?></strong></p>
                    </div>
                              <!-- Features 3 -->
                  </div>
                  <p>&nbsp;</p>
              </div>
            </div>
        </section>


