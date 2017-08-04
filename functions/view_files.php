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
$merchantInfo = $db->getAll ("files");
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
    'url' => 'merchant.php?page=*VAR*',
    'db_handle' => $dbh
);


/*
 * Create the pagination object
 */
try
{
    $paginate = new pagination($page, "SELECT * FROM files WHERE merchant_id='$merchant' ORDER BY id", $options);
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

    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>
<p>File History Upload</p>
';

    /*
     * Work with our data rows
     */
    foreach($result as $row)
    {
        $table ='
                            <tr>
                                                <td>
                                                '.$row["name"].'
                                               </td>
                                                <td>
                                                    '.$row["replaced"].'
                                                 </td>

                                                </td>
                                                <td>
                                                '.$row["size2"].'
                                                </td>
                                                <td>
                                                '.$row["type"].'
                                                </td>
                                                <td>
                                                '.$row["extension"].'
                                                </td>
                                                <td>
                                                '.$row["date"].'
                                                </td>

                                            </tr>
                              ';
        print_r($table);
    }

}}