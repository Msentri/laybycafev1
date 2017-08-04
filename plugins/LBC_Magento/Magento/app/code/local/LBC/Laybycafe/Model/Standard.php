<?php

class LBC_Laybycafe_Model_Standard extends Mage_Payment_Model_Method_Abstract
{

     /*new added payment method code define here*/
	 protected $_code  = 'laybycafe';
     
	 protected $_isInitializeNeeded      = true;
     
	 protected $_canUseInternal          = false;
     
	 protected $_canUseForMultishipping  = false;
     
	 /*set redirect url after order place */
	 
	 public function getOrderPlaceRedirectUrl()
	 {
	   return Mage::getUrl("laybycafe/paygateway/redirect");
	 }
	 
}