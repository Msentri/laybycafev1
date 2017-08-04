<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';
$merchant = $_SESSION['userSession'];
$reference_number = @$_GET['consumer_id'];
$reference_number = @$_GET['reference_number'];
$transaction_id = @$_GET['transaction_id'];



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
    'results_per_page' => 6,
    'url' => 'get_transaction.php?page=*VAR*&reference_number='.$reference_number.'&transaction_id='.$transaction_id.'',
    'db_handle' => $dbh
);


/*
 * Create the pagination object
 */
try
{
    $paginate = new pagination($page, "SELECT * FROM consumer_payments WHERE consumer_id='$reference_number' AND transaction_id='$transaction_id' AND merchant_id='$merchant' ORDER BY id", $options);
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
    echo '<p style="clear: left; padding-top: 10px;">Total Results: '.$paginate->total_results.'</p>';

    /*
     * Echo out the total number of pages
     */
    echo '<p>Total Pages: '.$paginate->total_pages.'</p>';

    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>';

    /*
     * Work with our data rows
     */

    foreach($result as $row)
    {
        $table ='
                            <tr>
                                                <td>
                                              '.$row["consumer_id"].'
                                                </td>
                                                <td>'.$row["transaction_id"].'</td>
                                                <td>
                                                    '.$row["details"].'
                                                 </td>
                                                 <td>
                                                    '.$row["debit"].'
                                                 </td>
                                                 <td>
                                                    '.$row["credit"].'
                                                 </td>
                                                 <td>
                                                    '.$row["balance"].'
                                                 </td>
                                               <td>
                                                '.date("M j, Y", strtotime($row["createdAt"])).'
                                                </td>
                                            </tr>
                              ';

        if($paginate->total_results > 0){
            print_r($table);
        }

        else{
            $msg = "No Transactions";
            print_r($msg);
        }



    }

}}