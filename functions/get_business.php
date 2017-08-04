<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

$db->where ("merchant_id", $merchantID);

$business = $db->getOne ("merchant_business");

$businessName = $business['business_name'];
$businessPhone = $business['phone'];
$businessType = $business['business_type'];
$businessVat_number = $business['vat_number'];
$businessReg_number = $business['reg_number'];
$businessAddress = $business['business_address'];
$businessWebsite = $business['website'];
$businessLogo = $business['logo'];

$db->where ("merchant_id", $merchantID);
$files = $db->getOne ("files");
$fileName = $files['name'];
$fileUpload = $files['file'];
$fileReplaced = $files['replaced'];
$fileSize = $files['size2'];
$fileType = $files['type'];
$fileExtension = $files['extension'];