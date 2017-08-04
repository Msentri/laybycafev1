<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 9/6/2016
 * Time: 3:21 PM
 */

if(isset($_POST['upload'])){

    include 'includes/form_upload.php';
}

if(isset($_POST['btn-update'])) {

    $businessName = @$_POST['business_name'];
    $businessType = @$_POST['business_type'];
    $vatNumber = @$_POST['vat_number'];
    $regNumber = @$_POST['reg_number'];
    $website = @$_POST['website'];
    $phone = @$_POST['phone'];
    $businessAddress = @$_POST['businessAddress'];
    $logo = @$_FILES['logo'];



    $errors= array();
    $file_name = @$_FILES['logo']['name'];
    if($file_name!=null){
    $file_size = @$_FILES['logo']['size'];
    $file_tmp = @$_FILES['logo']['tmp_name'];
    $file_type= @$_FILES['logo']['type'];
    $file_ext = substr( strrchr(@$file_name, '.'), 1);

    $expensions= array("jpeg","jpg","png");

    if(in_array(@$file_ext,@$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true){

        if (!is_dir('uploads/logo/'.$consumerID.'')) {

            mkdir('uploads/logo/'.$consumerID.'', 0777, true);
            move_uploaded_file($file_tmp,"uploads/logo/".$consumerID."/".$file_name);
        }
        else{
            move_uploaded_file($file_tmp,"uploads/logo/".$consumerID."/".$file_name);
        }

    }

    if($roleSession=='merchant'){      $data = Array(
        'merchant_id' => $consumerID,
        'business_name' => $businessName,
        'business_type' => $businessType,
        'vat_number' => $vatNumber,
        'reg_number' => $regNumber,
        'phone' => $phone,
        'business_address' => $businessAddress,
        'website' => $website,
        'logo' => 'uploads/logo/'.@$consumerID.'/'. @$file_name .''
    );

        $addBusiness = $api->post("/merchant/business",$data);}


    }

    else{
            $data = Array(
                'merchant_id' => $consumerID,
                'business_name' => $businessName,
                'business_type' => $businessType,
                'vat_number' => $vatNumber,
                'reg_number' => $regNumber,
                'phone' => $phone,
                'business_address' => $businessAddress,
                'website' => $website
            );

        $addBusiness = $api->post("/merchant/business",$data);

    }




}

if(isset($_POST['changePass'])) {

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];




        $data = Array(
            'merchant_id' => $consumerID,
            'password' => $pass2
        );


    if($pass2==$pass1){
        $changePass = $api->post("/password/change",$data);

      $changePassCode = json_decode($changePass->response);


    }
    else{

        print_r("password not match");
    }

}

if(isset($_POST['confirmPass'])) {

    $code = $_POST['conlfirmCode'];


    $data = Array(
        'merchant_id' => $consumerID,
        'code' => $code
    );


    $confirmChange = $api ->post('/password/verify',$data);

    $confirmCode = json_decode($confirmChange->response);

}
//add email notification account//
if(isset($_POST['addEmail'])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $type = $_POST['type'];


    $data = array(

        'merchant_id' => $consumerID,
        'email' => $email,
        'type' => $type,
        'full_name' => $full_name
    );

    $addNotification = $result = $api->post("/merchant/notify",$data);



 // $notificationCode = $addNotification->response;
    $MailerrorCode = json_decode($addNotification->response);

  $emailErrorCode = $MailerrorCode->code;


}

if(isset($_POST['period'])) {

    $period = $_POST['period'];

    $data = array(

        'merchant_id'=>$consumerID,
        'maximum_period'=>$period
    );

    $updatePeriod = $api->put("/merchants/period",$data);

    // $notificationCode = $addNotification->response;
    $PeriodErrorCode = json_decode($updatePeriod->response);



}

//add Store//
if(isset($_POST['addStore'])) {

    $store_name = $_POST['store_name'];
    $store_url = $_POST['store_url'];


    $data = Array (
        'merchant_id' => $consumerID,
        'store_name' => $store_name,
        'store_url' =>  $store_url,
    );

    $addStore= $result = $api->post("/merchant/stores",$data);

 // $notificationCode = $addNotification->response;
    $storeError = json_decode($addStore->response);


    $storeErrorCode = $storeError->code;



}

//add email notification account//
if(isset($_POST['addBranch'])) {

    $branch_name = $_POST['Storebranch_name'];
    $email = $_POST['email'];
    $branch_tel = $_POST['branch_tel'];
    $address = $_POST['address'];


    $data = array(

        'merchant_id' => $consumerID,
        'branch_name' => $branch_name,
        'email' => $email,
        'branch_tel' => $branch_tel,
        'address' => $address
    );

    $data2 = array(

        'first_name' => @$account_holder,
        'merchant_' => @$consumerID,
        'branch_name' => @$branch_name,
        'email' => @$email,
        'phone' => @$branch_tel,
        'user' => @$email
    );

    $address = $result = $api->post("/merchants/branches",$data);

    // $notificationCode = $addNotification->response;

    $MailerrorCode = json_decode($address->response);

    $emailErrorCode = $MailerrorCode->code;


    if($MailerrorCode->code=='209'){
        $result = $api->post("/merchant/instore", $data2);

        var_dump($result->response);
    }



}

//add Bank Account//

if(isset($_POST['addBank'])){

    $bank_name = $_POST['bank_name'];
    $bank_account = $_POST['bank_account'];
    $branch_name = $_POST['branch_name'];
    $account_holder = $_POST['account_holder'];
    $branch_code = $_POST['branch_code'];

    $data = Array (
        'merchant_id' => $consumerID,
        'bank_name' => $bank_name,
        'bank_account' =>  $bank_account,
        'account_holder' => $account_holder,
        'branch_code' => $branch_code
    );


    $result = $api->post("/merchants/bank/",$data);

}

//Create Schedule//

if(isset($_POST['addSchedule'])){

    $payoutFrequency = $_POST['payoutFrequency'];
    $minAmount = $_POST['amount'];

    $data = Array (
        'merchant_id' => $consumerID,
        'payout_frequency' => $payoutFrequency,
        'min_amount' => $minAmount,
    );


    $payout = $api ->post('/payment/payout',$data);

    $confirmCode = json_decode($payout->response);

}

if(isset($_POST['payOut'])){

    $amount = $_POST['amount'];

    $data = Array (
        'merchant_id' => $consumerID,
        'amount' => $amount
    );

    $payout = $api ->post("/payout",$data);
    $payoutData = json_decode($payout->response);

}

if(isset($_POST['passChange'])){

    $data = Array (
        'merchant_id' => $consumerID

    );

$passChange = $api->get("/password/request", $data);

$getCode  = json_decode($passChange->response);
}
//-------------------------------------------Gets Business Information----------------------------------------------//
if($roleSession=='merchant') {
    $getBusiness = $api->get("/merchants/business/$consumerID");

    $businessInfo = json_decode(@$getBusiness->response);

    $businessName = @$businessInfo->business_name;
    $businessType = @$businessInfo->business_type;
    $vatNumber = @$businessInfo->vat_number;
    $regNumber = @$businessInfo->reg_number;
    $phone = @$businessInfo->phone;
    $businessAddress = @$businessInfo->business_address;
    $website = @$businessInfo->website;
    $logo = @$businessInfo->logo;
}
else{

}
//-------------------------------------------Gets Bank Information----------------------------------------------//
$getBank = $api->get("/merchants/$consumerID/bank");
$bankData = json_decode(@$getBank->response);
$accountHolder =@$bankData->account_holder;
$bankName =@$bankData->bank_name;
$bankAccount =@$bankData->bank_account;
//-------------------------------------------Gets Profile Information----------------------------------------------//
$username = array(
    'username'=>$consumerID
);
$profile = $api->get("/searchprofile",$username);

$userInfo = json_decode(@$profile->response);

$contact = @$userInfo->userName;
$merchantKey = @$userInfo->merchant_key;
$customerID = @$userInfo->merchant_id;
$id_no = @$userInfo->id_no;
$first_name = @$userInfo->first_name;
$last_name = @$userInfo->last_name;
$email = @$userInfo->email;
$passChange = @$userInfo->passwordChange;
$maximumPeriod = @$userInfo->maximum_period;
$verifiedAccount = @$userInfo->verified_account;
$activeAccount = @$userInfo->active_account;
$cellNo = @$userInfo->cellNo;

//----------------------------------------------------Get laybys for calculations-------------------------------//

$dataLaybys = array(
    'merchant_id' => $consumerID,
);

$laybys = $api->get("/merchants/laybys",$dataLaybys);

$calculateLayby = json_decode(@$laybys->response);

foreach(@$calculateLayby as $key=>$data){

    $layby_data = [];
    $layby_data['price'] = filter_var(@$data->price, FILTER_SANITIZE_STRING);
    $layby_data['balance'] = filter_var(@$data->balance, FILTER_SANITIZE_STRING);
    $layby_data['special_price'] = filter_var(@$data->special_price, FILTER_SANITIZE_STRING);
    $layby_data['status'] = filter_var(@$data->status, FILTER_SANITIZE_STRING);
    $layby_data['paid_out'] = filter_var(@$data->paid_out, FILTER_SANITIZE_STRING);
    $layby_data['depositMade'] = filter_var(@$data->depositMade, FILTER_SANITIZE_STRING);
    $layby_data['instalment'] = filter_var(@$data->instalment, FILTER_SANITIZE_STRING);
    $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $layby_data['createdAt'] = filter_var(@$data->createdAt, FILTER_SANITIZE_STRING);
    $layby_data['lastPayment'] = filter_var(@$data->lastPayment, FILTER_SANITIZE_STRING);
    $date_to_pay = $layby_data['nextPayment'] = filter_var(@$data->nextPayment, FILTER_SANITIZE_STRING);
    $layby_data['description'] = filter_var(@$data->description, FILTER_SANITIZE_STRING);


   // print_r($layby_data['price']);

    if($layby_data['status']=="completed" and $layby_data['depositMade']=='Yes' and $layby_data['paid_out']=='0'){

        $completeLaybysAmount = 0;

        $completeLaybysAmount += $layby_data["price"];

    }

    if($layby_data['status']=="inprocess" and $layby_data['depositMade']=='Yes'){

        @$balance += @$layby_data["balance"];
        @$price += @$layby_data["price"];

        $inprocess = $price - $balance;

    }

}

//-----------------------------------Gets Branches-------------------------//
$branches = $api->get("/merchants/$consumerID/branches");

//---------------------------------Gets wallet-------------------------//

$wallet = $api->get("/consumers/$consumerID/wallet");

$walletData= json_decode(@$wallet->response);

$walletAmount = @$walletData->amount;
$walletBalance = @$walletData->balance;


if($roleSession=='merchant'){

    $dataLaybys = array(
        'merchant_id' => $consumerID,
    );

    $merchantBalance = $api->get("/merchants/laybys",$dataLaybys);

$getBalanceDetails = json_decode($merchantBalance->response);

foreach (@$getBalanceDetails as $key=>$data){

}

if(@$data->depositMade=='Yes' and @$data->status=='inprocess' and @$data->status==0){
    $price = 0;
    $balance = 0;
    $inprocess = 0;
    $price += $data->price;
    $balance += $data->balance;

    $inprocess = round($price-$balance);
}



//--------------------------------Gets Payout Schedule------------------------//
$payout = $api ->get('/payment/'.$consumerID.'/payout');

$payoutSchedule = json_decode($payout->response);

$frequency =@$payoutSchedule->payout_frequency;
$amount = @$payoutSchedule->min_amount;
$date = @$payoutSchedule->payout_date;

//-----get instore accounts-------//

$getInStoreUsers = $api->get("/merchant/$consumerID/instore");

$inStoreUsers = json_decode($getInStoreUsers->response);


//-------------------------------------------Gets Profile Information----------------------------------------------//
    $files = $api->get("/merchant/documents/$consumerID");

    $emailNotifications = $api->get("/merchant/$consumerID/notify");

//---------------------------------------------Get Stores------------------------------------------------//


    $stores = $api->get("/merchants/$consumerID/stores");

    $storeError = json_decode($stores->response);

    $storeErrorCode = @$storeError->code;

//gets Bank Account//

    $profile = $api->get("/merchants/$consumerID/bank");

    $bankInfo = json_decode($profile->response);

    $accountHolder = @$bankInfo->account_holder;
    $bankAccount = @$bankInfo->bank_account;
    $bankName = @$bankInfo->bank_name;
    $branchName = @$bankInfo->branch_name;
    $branchCode = @$bankInfo->branch_code;

}
if($roleSession=='merchant'){
$storeData = json_decode($stores->response);


foreach($storeData as $key=>$data){

    $layby_data = [];
    $store_name = $layby_data['store_name'] = filter_var(@$data->store_name, FILTER_SANITIZE_STRING);
    $store_url = $layby_data['store_url'] = filter_var(@$data->store_url, FILTER_SANITIZE_STRING);
    $platform = $layby_data['platform'] = filter_var(@$data->platform, FILTER_SANITIZE_STRING);
    $module = $layby_data['module'] = filter_var(@$data->module, FILTER_SANITIZE_STRING);

}}
if($roleSession=='instore'){

    $emailNotifications = $api->get("/merchant/$consumerID/notify");
}
?>