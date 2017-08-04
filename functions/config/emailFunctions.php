<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/10/10
 * Time: 9:28 AM
 */

include '../../vendor/autoload.php';

$db = new MysqliDb (Array (
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db'=> 'laybycafe',
    'port' => 3306,
    'prefix' => '',
    'charset' => 'utf8'));

//Email Functions//
@$merchantID;
$date = strtotime(date('Y-m-d H:i:s') . ' -30 day');
$date = date('j F Y', $date);
$username = 'soxentp';
$password = 'sakhile1989';
$amount = 0;
// $connection is instance of \Ddeboer\Imap\Connection
// 4. argument is the directory into which attachments are to be saved:
//$mailbox = new PhpImap\Mailbox('{laybycafe-testing.co.za:993/imap/ssl}INBOX', $username, $password, __DIR__);


$imap_server = "{imap.gmail.com:993/imap/ssl}";
//$imap_server = "{laybycafe-testing.co.za:993/imap/ssl}";

$mbox = imap_open("{$imap_server}INBOX", $username, $password);

$emails  = imap_search($mbox, 'FROM "Malesela Thubakgale" UNSEEN SINCE "'.$date.'"', SE_UID);

if ($emails)
    foreach($emails as $e) {
        $msgno = imap_msgno($mbox, $e);
       $header = imap_headerinfo($mbox, $msgno);
       $num = imap_num_msg($mbox);
       $body= json_encode(imap_body($mbox, $msgno));

       imap_qprint($body);


        $date = $header->date;
        $MailDate = $header->MailDate;
        $mid = md5($header->subject . $header->date . $header->MailDate);
        $pos = true;

        preg_match_all("/R(\d+[.]?\d+)/", $body, $output_array);

        $walletTopUpAmount = $output_array[1][0];

        preg_match_all("/Ref.\b(.+?)\b./", $body, $outputRef_array);
       // $reference = strtoupper($outputRef_array[1][0]);

        preg_match_all("/\bLb(.+?)\b./", $body, $output_array);
       echo  $reference = strtoupper($output_array[1][0]);
        //gets the email Body/
        //close the stream
        imap_close($mbox);
    }

//checks if wallet exists and gets the wallet balance//

if(@$walletTopUpAmount!=NULL){

    $db->where ("consumer_id", $reference);
    $wallet = $db->getOne ("consumer_wallet");
    $consumer_id = $wallet['consumer_id'];
    $walletBalance = $wallet['amount'];


    //Gets Last Payment//
    $db->where ("consumer_id", $reference);
    $paymentLog = $db->getOne ("payments_log");
    $checkSum = $paymentLog['checkSum'];

    if($checkSum==$mid){

        echo "Payment already Processed";
    }else{
    //Tops up Wallet and loads payment log//
        $data = Array (
            'consumer_id' => $reference,
            'amount' => $walletTopUpAmount,
            'checkSum' => $mid,
            'ref' => $reference,
            'mailDate' => $MailDate,
            'date' => $date
        );

        $payment_Log= $db->insert ('payments_log', $data);

    if($consumer_id==$reference){

        $amount = $walletTopUpAmount + $walletBalance;
        $data = Array (
            'amount' => $amount
        );
        $db->where ('consumer_id', $reference);
        if ($db->update ('consumer_wallet', $data))
            echo 'Thank you for the deposit, the wallet has been topped up, please choose the layby you would like to process';

         }
    }



}else{

    print_r('Wallet will be topped up once the payment confirmation reflects on our side');
}








