<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/11/02
 * Time: 1:08 PM
 */
require 'vendor/autoload.php';

//message for products//
if(@$product_ref!=NULL){

include_once 'emails/products.php';


    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'soxentp@gmail.com';                 // SMTP username
    $mail->Password = 'sakhile1989';                           // SMTP password
    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('noreply@laybycafe.com', 'Layby Cafe');
    $mail->addAddress('sakhile@laybycafe.co.za', 'Sakhile Matsimela');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Product Added';
    $mail->Body    = $message;
    $mail->AltBody = 'Your Item has been added successfully';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}