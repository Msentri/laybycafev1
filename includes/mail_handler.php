<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/12/07
 * Time: 10:11 AM
 */
//include_once '../vendor/autoload.php';


if(@$deploy=='demo' or @$deploy=='debug'){

    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;   // Enable verbose debug output
    if($deploy=='demo' or @$deploy=='debug'){

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'laybycafe.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@laybycafe.com';                 // SMTP username
        $mail->Password = 'mNr7!?UP}*{n';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                // TCP port to connect to

    }else{
        $mail->Host = 'laybycafe.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@laybycafe.com';                 // SMTP username
        $mail->Password = 'mNr7!?UP}*{n';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    }



    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
//for GODADDY//
    /*$mail->isSMTP();
    $mail->Host = 'n3plcpnl0079.prod.ams3.secureserver.net';
    $mail->Username = 'demos@laybycafe.com';                 // SMTP username
    $mail->Password = 'D3mos2016';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'TLS';*/

    $email = "demos@laybycafe.com";
    if(@$bankNameDeposit=="fnb"){

        $message = 'FNB :-) R'.@$amountTopUp.' paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.''; // TCP port to connect to

        $mail->setFrom('noreply@laybycafe.com', 'inContact@fnb.co.za');
        $mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Demo Funds';
        $mail->Body    = $message;
        $mail->AltBody = 'FNB :-) R'.@$amountTopUp.'.00 paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.'';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';

        }
    }

    if(@$bankNameDeposit=="capitec"){

        $message = 'FNB :-) R'.@$amountTopUp.'.00 paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.''; // TCP port to connect to

        $mail->setFrom('noreply@laybycafe.com', 'inContact@fnb.co.za');
        $mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Demo Funds';
        $mail->Body    = $message;
        $mail->AltBody = 'FNB :-) R'.@$amountTopUp.'.00 paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.'';

        if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Message has been sent';
        }
    }

    if(@$bankNameDeposit=="nedbank"){

        $message = 'FNB :-) R'.@$amountTopUp.'.00 paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.''; // TCP port to connect to

        $mail->setFrom('noreply@laybycafe.com', 'inContact@fnb.co.za');
        $mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Demo Funds';
        $mail->Body    = $message;
        $mail->AltBody = 'FNB :-) R'.@$amountTopUp.'.00 paid to cheq a/c..363873 @ Online Banking. Ref.'.@$refOnTopUp.'';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

//ABSA EMAIL//
    if(@$bankNameDeposit=="absa"){

        $htmlMessage ='
Dear LAYBY CAFE FINANCIAL SERVICES

Account    : CHEQ6485
Date       : '.date('Y,m,d').'
Transaction: SETTLEMENT CENTRE - IBANK PAYMENT FROM
Reference  : ABSA BANK '.@$refOnTopUp.'
Amount     : R'.@$amountTopUp.'
Available  : R'.@$amountTopUp.'

For assistance please call 0860040302

Kind regards

The NotifyMe team

Ref: '.@$refOnTopUp.'  ';
        $message = $htmlMessage; // TCP port to connect to

        $mail->setFrom('noreply@laybycafe.com', 'NotifyMe@absa.co.za');
        $mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Demo Funds';
        $mail->Body    = $message;
        $mail->AltBody = $htmlMessage;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

//Starndard Bank EMAIL//
    if(@$bankNameDeposit=="standardbank"){

        $htmlMessage ='
Dear null LAYBYE CAFE (PTY)LTD,

An amount of R'.@$amountTopUp.' was paid to Standard Bank account ending in 6025 from '.@$refOnTopUp.' on 2016-06-12.

The actual balance at the time of the above transaction was R44.65.

Regards,
Standard Bank';
        $message = $htmlMessage; // TCP port to connect to

        $mail->setFrom('noreply@laybycafe.com', 'information@standardbank.co.za');
        $mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Demo Funds';
        $mail->Body    = $message;
        $mail->AltBody = $htmlMessage;

        if(!$mail->send()) {
            //echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}

