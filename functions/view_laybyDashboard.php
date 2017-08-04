<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/06
 * Time: 10:31 AM
 */

//require 'config/config.php';
$merchant = $_SESSION['userSession'];

$db->where ("merchant_id", $merchant);
$merchantInfo = $db->getAll ("onlayby");
$merchantID = $merchantInfo['merchant_id'];


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
    'url' => 'laybys.php?page=*VAR*',
    'db_handle' => $dbh
);


/*
 * Create the pagination object
 */
try
{
    $paginate = new pagination($page, "SELECT * FROM onlayby WHERE merchant_id='$merchant' ORDER BY id", $options);
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

    foreach($result as $row)
    {
        $table ='
                            <tr>
                                                <td>
                                               <a href="get_transaction.php?reference_number='.@$row["reference_number"].'&transaction_id='.@$row["transaction_id"].'">'.@$row["reference_number"].'</a>
                                                </td>
                                                <td>'.$row["order_id"].'</td>
                                                <td>
                                                    '.$row["description"].'
                                                 </td>

                                                </td>
                                                <td>
                                                '.$row["total_amount"].'
                                                </td>

                                            </tr>
                              ';
        print_r($table);
    }

}}