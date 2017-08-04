<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/05
 * Time: 11:43 AM
 */
require 'config/config.php';


if(isset($_POST['register']))

                    {

                        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  Consumer already exists , Please Try another email
			  </div>";
                        //Sends info to the script bellow
                        $firstName = $_POST['first_name'];
                        $lastName = $_POST['last_name'];
                        $email = $_POST['email'];
                        $upass = $_POST['password1'];
                        $db->where ("email", $email);
                        $user = $db->getOne ("buyer");
                        $user['email'];

                        if ($user['email']==$email){
                            print_r($msg);

                        }
                        else{

                            function generateRandomString($length = 10) {
                                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                $charactersLength = strlen($characters);
                                $randomString = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                }
                                return $randomString;
                            }
                            // Password 3D encryption//
                            $salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
                            $salt = base64_encode($salt);
                            $salt = str_replace('+', '.', $salt);
                            $ref = generateRandomString();
                            $password3d = crypt($upass, '$2y$10$'.$salt.'$');

                            $data = Array (
                                'merchant_id' => $OTP,
                                'consumer_id' => $ref,
                                'first_name' => $firstName,
                                'last_name' => $lastName,
                                'email' => $email,
                                'role' => 'consumer',
                                'code' => $code,
                                'active_account' => 'N',
                                'salt' => $salt,
                                'password' => $password3d,
                                // password = SHA1('secretpassword+salt')
                                'createdAt' => $db->now()
                                // expires = NOW() + interval 1 year
                                // Supported intervals [s]econd, [m]inute, [h]hour, [d]day, [M]onth, [Y]ear
                            );


                            $id = $db->insert ('merchant', $data);

                            $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Congrats !</strong> $firstName $lastName, your account was created , Please check your inbox to confirm your account
			  </div>";
                            // To send HTML mail, the Content-type header must be set
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $message ='
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0;padding:0;height:100%!important;width:100%!important">
    <tbody><tr>
        <td valign="top" align="center">
            <table width="600" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #dddddd;background-color:white">
                <tbody><tr>
                    <td valign="top" align="center">

                        <table width="600" cellspacing="0" cellpadding="0" border="0" style="background-color:#ffffff;border-bottom:0">
                            <tbody><tr>
                                <td>

                                    <img width="140" align="left" style="border:none;padding:30px;min-height:auto;line-height:100%;outline:none;text-decoration:none" src="http://laybycafe.co.za/img/logo.png" class="CToWUd">

                                </td>
                            </tr>
                            </tbody></table>

                    </td>
                </tr>
                <tr>
                    <td valign="top" align="center">

                        <table width="600" cellspacing="0" cellpadding="10" border="0">
                            <tbody><tr>
                                <td valign="top" style="background-color:white">

                                    <table width="100%" cellspacing="0" cellpadding="10" border="0">
                                        <tbody><tr>
                                            <td valign="top" style="padding-top:0">
                                                <div style="color:#505050;font-family:Arial;font-size:14px;line-height:150%;text-align:left">
                                                    <p style="margin-top:0">Hi '.$firstName.' '. $lastName.'</p>


                                                    <p>Thank you for submitting your Registration form.</p>

                                                    <p>We have successfully created your account, please click the button below to ferify your account.</p>

                                                    <br>
                                                    <center>
                                                        <a style="background-color:#fff;border:1px solid #355898;padding:10px;text-align:center;border-radius:5px;max-width:270px;color:#000;font-weight:bold;text-decoration:none;display:block" href="http://localhost/laybycafe/verify.php?id='.base64_encode($id).'&code='.$code.'">Activate Account</a>
                                                    </center>
                                                    <br><p>Regards<br>The team at Laybycafe</p>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="center">

                        <table width="600" cellspacing="0" cellpadding="10" border="0" style="margin-top:30px;border-top:0">
                            <tbody><tr>
                                <td valign="top">


                                    <table width="100%" cellspacing="0" cellpadding="10" border="0">
                                        <tbody><tr>
                                            <td valign="middle" style="border-top:1px solid #f5f5f5" colspan="2">
                                                <div style="color:#959595;font-family:Arial;font-size:11px;line-height:125%;text-align:center">


                                                    You received this email because an account was registered for Laybycafe using the address '.$email.'.


                                                </div>
                                            </td>
                                        </tr>
                                        </tbody></table>


                                </td>
                            </tr>
                            </tbody></table>

                    </td>
                </tr>
                </tbody></table>
            <br>
        </td>
    </tr>
    </tbody></table>';

                            $subject = "Confirm Registration";

                            $db ->send_mail($email,$message,$subject,$headers);

                            if ($id)
                                echo $msg;
                            else
                                echo 'insert failed: ' . $db->getLastError();
                        }


            }



?>