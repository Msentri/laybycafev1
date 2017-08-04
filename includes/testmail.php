<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/05/12
 * Time: 9:16 AM
 */
include_once '../vendor/autoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'soxentp@gmail.com';                 // SMTP username
$mail->Password = 'sakhile1989';                           // SMTP password
$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$email = "demos@laybycafe.com";

$message = 'FNB :-) R200.00 paid from cheq a/c..633843 @ Online Banking. Avail R2771. Ref.Po395240'; // TCP port to connect to

$mail->setFrom('noreply@laybycafe.com', 'inContact@fnb.co.za');
$mail->addAddress($email, 'Sakhile Matsimela');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Demo Funds';
$mail->Body    = $message;
$mail->AltBody = 'FNB :-) R200.00 paid from cheq a/c..633843 @ Online Banking. Avail R2771. Ref.Po395240';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';

}