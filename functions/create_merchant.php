<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:43 AM
 */

if(isset($_POST['register']))

                    {

                        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  User already exists , Please Try another email
			  </div>";
                        //Sends info to the script bellow
                        $firstName = $_POST['first_name'];
                        $lastName = $_POST['last_name'];
                        $email = $_POST['email'];
                        $role = $_POST['role'];
                        $id_no = @$_POST['id_no'];
                        $upass = $_POST['password1'];
                        $cell = $_POST['cell'];


                        $data = array(

                            'first_name' => $firstName,
                            'last_name' => $lastName,
                            'email' => $email,
                            'sales_id' => @$_GET['reg'],
                            'id_no' => $id_no,
                            'cell' => $cell,
                            'role' => $role,
                            'password' => $upass
                        );


                        $result = $api->post("/users", $data);

                        var_dump($result);

                        $message = json_decode($result->response);

                     if(@$message->code==210){

                         $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry ! $message->message , Please Try another email</strong>
			  </div>";
                         //print_r($msg);


                     }

                        if(@$message->code==209){

                            if($message->merchant_id !=Null){
                                $_SESSION['userSession'] = @$message->merchant_id;
                                $_SESSION['roleSession'] = @$message->role;
                                $_SESSION['verified'] = @$message->verified_account;


                            }


                     }

            }



?>