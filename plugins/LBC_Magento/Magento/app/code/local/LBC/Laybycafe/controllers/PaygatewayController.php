<?php
 class LBC_Laybycafe_PaygatewayController extends Mage_Core_Controller_Front_Action
{
   
   
    // redirect action method 
	  public function redirectAction() {
	    $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template','laybycafetemplate',array('template' => 'laybycafetemplate/redirect.phtml'));
		$this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
	}

	
	  public function  successAction()
    {


		$_order = new Mage_Sales_Model_Order(); //object to get all order information
		$orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
		$_order->loadByIncrementId($orderId);
		$total_amount = number_format($_order->getBaseGrandTotal() , 2, '.','');
	   	
		$transaction_url = "https://www.laybycafe.co.za/application/transaction.php?order_id=".$orderId."&amount=".$total_amount;
		
		$ch = curl_init();  
	 
		curl_setopt($ch,CURLOPT_URL,$transaction_url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	 
		$output=curl_exec($ch);
	 
		curl_close($ch);
		$transaction_valid = $output;

		$order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
	   
	   if ($transaction_valid =='pending') {
		  $order->setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT, true)->save();
	   } else if ($transaction_valid =='layby') {
		  $order->addStatusHistoryComment("Customer has paid deposit towards the order.");
		  $order->setState(Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW, true)->save();
	   } else if ($transaction_valid =='paid') {
		  $order->addStatusHistoryComment("Customer has paid FULL amounts towards the order.");
		  $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
	   } 
	   $this->_redirect('checkout/onepage/success', array('_secure'=>true));
    }


public function cancelAction()
{
    $session = Mage::getSingleton('checkout/session');
    if ($session->getLastRealOrderId())
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
        if ($order->getId())
        {
            //Cancel order
            if ($order->getState() != Mage_Sales_Model_Order::STATE_CANCELED)
            {
                $order->registerCancellation("Canceled by Payment Provider")->save();
            }
            $quote = Mage::getModel('sales/quote')
                ->load($order->getQuoteId());
            //Return quote
            if ($quote->getId())
            {
                $quote->setIsActive(1)
                    ->setReservedOrderId(NULL)
                    ->save();
                $session->replaceQuote($quote);
            }

            //Unset data
            $session->unsLastRealOrderId();
        }
    }

    return $this->getResponse()->setRedirect( Mage::getUrl('checkout/onepage'));
}


		
	// cancel action will hit when some one cancel the order and state changes to canceled	
/*	 public function cancelAction() {
        if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
			
            if($order->getId()) {
				// Flag the order as 'cancelled' and save it
				$order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Gateway has declined the payment.')->save();
			}
        }
	}*/
	
}
?>