<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/19
 * Time: 10:22 AM
 */

$ref_no = @$_GET['trans'];

$customerKey = @$_GET['consumer_id'];

if(isset($_POST['searchUser'])) {

    $username = array(
        'username'=>$_POST['username']
    );
    $retriveUserInfo = $api->get("/searchprofile",$username);

    $userInfo = json_decode($retriveUserInfo->response);

}
//-----------------------------------------Creates New User--------------------------------------------//
if(isset($_POST['register']))
{

    $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  Merchant already exists , Please Try another email/Phone Number
			  </div>";
    //Sends info to the script bellow
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $user = $_POST['user'];
    $role = $_POST['role'];
    $email = @$_POST['email'];
    $phone = @$_POST['phone'];
    $id = $_POST['id_no'];

    if(filter_var(@$user, FILTER_VALIDATE_EMAIL)) {
        $data = array(

            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user,
            'phone' => @$phone,
            'user' => $user,
            'id_no' => $id,
            'role' => $role
        );
    }else{

        $data = array(

            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => @$email,
            'phone' => $user,
            'user' => $user,
            'id_no' => $id,
            'role' => $role
        );
    }

    $result = $api->post("/merchant/users", $data);

    $message = json_decode($result->response);

    $customerID =@$message->consumer_id;
    $error = @$message->code;

    if($customerID !=null){

        $username = array(
            'username'=>$customerID
        );
        $retriveUserInfo = $api->get("/searchprofile",$username);

        $userInfo = json_decode($retriveUserInfo->response);


    }
    if(@$message->code==210){

        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry ! $message->message</strong>
			  </div>";
        print_r($msg);


    }

    if(@$message->code==209){

       // include 'send_email.php';


        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$message->message </strong>
			  </div>";
        print_r($msg);


    }





}

//------------------------------------------updates User Info----------------------------------------//

if(isset($_POST['next'])){

     $email = @$_POST['email'];
     $phone = @$_POST['phone'];
     $id = @$_POST['id_no'];

     if(@$email!=null or @$phone!=null or @$id!=null){

         $data = array(
             'consumer_id' => @$customerKey,
             'email' => @$email,
             'phone' => @$phone,
             'id_no' => $id,
         );
         $results = $api ->get("/merchants/users",$data);

         $updateUserData = json_decode($results->response);
         $userUpdateMessage = $updateUserData->message;
     }

}
//$getBusiness = $api ->get("/merchants/business/$consumerID");

//$businessInfo = json_decode($getBusiness->response);

?>