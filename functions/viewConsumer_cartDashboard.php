<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';
$merchant = $_SESSION['userSession'];



if(isset($_POST['updatePayment'])){

    //Upadates all the checked values
    $canPay =  $_POST['canPay'];
    $product_ref =  $_POST['product_ref'];
    foreach($_POST['product_ref'] as $ref)
    {
        echo $ref;
    }
    if($canPay!=NULL){
        $data = array(
            'canPay'=>$canPay
        );
    }else{
        $data = array(
            'canPay'=>'no'
        );
    }
    $db->where ("product_ref", $product_ref);
    if ($db->update ('consumer_layby', $data));


    //Upadate Query follows
}

$db->where ("consumer_id", $merchant);
$merchantInfo = $db->getAll ("consumer_layby");
$merchantID = $merchantInfo['consumer_id'];


if ($merchantID==$merchant){
    /*
     * Get and/or set the page number we are on
     */
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }


    /*
     * Set a few of the basic options for the class, replacing the URL with your own of course
     */
    $options = array(
        'results_per_page' => 10,
        'url' => 'consumer_laybys.php?page=*VAR*',
        'db_handle' => $dbh
    );


    /*
     * Create the pagination object
     */
    try
    {
        $paginate = new pagination($page, "SELECT * FROM consumer_layby WHERE consumer_id='$merchant' AND status='pending' ORDER BY id", $options);
    }
    catch(paginationException $e)
    {
        echo $e;
        exit();
    }


    /*
     * If we get a success, carry on
     */
    if($paginate->success == true)
    {

        /*
         * Fetch our results
         */
        $result = $paginate->resultset->fetchAll();

        /*
         * Echo out the UL with the page links


        /*
         * Echo out the total number of results
         */

        /*
         * Work with our data rows
         */
        foreach($result as $row)
        {

            if($row["status"]=='awaiting payment'){

                $status ='<td class="goldbg">awaiting payment</td>';

            }
            if($row["status"]=='pending'){

                $status ='<td class="redbg">Pending</td>';

            }

            if($row["status"]=='verified'){

                $status ='<td class="palebluecolorbg">Verified</td>';

            }

            if($row["status"]=='complete'){

                $status ='<td class="lightbluebg">Complete</td>';

            }


            $table ='
                            <tr>
                                            <td>
                                               <a href="getConsumer_transaction.php?consumer_id='.$row["consumer_id"].'&transaction_id='.$row["product_ref"].'">'.$row["consumer_id"].'</a>
                                                </td>
                                                <td>'.$row["product_name"].'</td>
                                                <td>'.$row["store_name"].'</td>
                                                <td>
                                                    '.$row["price"].'
                                                 </td>
                                                '.$status.'
                                        </tr>

                              ';
            print_r($table);
        }

    }}


//Gets Wallet Balance//

$db->where("consumer_id", $merchant);

$wallet = $db->getOne ("consumer_wallet");
$WalletBalance = $wallet['amount'];

//Get instalments//
$sth = $dbh->prepare("SELECT instalment FROM consumer_layby WHERE consumer_id =$merchant AND canPay='yes'");
$sth->execute();
$instalmentsBalance = 0;
while($instalment = $sth->fetch(PDO::FETCH_ASSOC)) {
    $instalmentsBalance += $instalment['instalment'];
}

$diff = $instalmentsBalance - $WalletBalance;
$diff2 = $WalletBalance - ($instalmentsBalance);