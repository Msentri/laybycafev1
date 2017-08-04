<?php

class LBC_Laybycafe_Helper_Data extends Mage_Core_Helper_Abstract
{

public function getPaymentmethodLaybycafeurl()
{
return Mage::getStoreConfig("payment/laybycafe/cgi_url");
}

public function getPaymentmethodLaybycafeMerchantID()
{
return Mage::getStoreConfig("payment/laybycafe/merchant_id");
}

public function getPaymentmethodLaybycafeMerchantKey()
{
return Mage::getStoreConfig("payment/laybycafe/merchant_key");
}

public function getPaymentmethodLaybycafeIsTest()
{
return Mage::getStoreConfig("payment/laybycafe/is_test");
}
   
    
}