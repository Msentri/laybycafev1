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
if(isset($_POST['referral'])) {

    //Sends info to the script bellow
    $Referee = $_POST['referee'];

    $db->where ("email", $Referee);
    $stats = $db->getOne ("referral", "sum(id), count(*) as cnt");



if($stats['cnt']==0){



    $data = Array(
        'merchant_id' => "$merchant",
        'email' =>$Referee,
        'registerd' =>'No',
        'createdAt' =>  $db->now()

    );




    $id = $db->insert('referral', $data);

    $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Congrats !</strong> you have referred $Referee account has been added
			  </div>";
    echo $msg;
}

    else{


        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong> $Referee already Referred
			  </div>";

        echo $msg;
    }




}

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
    $paginate = new pagination($page, "SELECT * FROM referral WHERE merchant_id='$merchant' ORDER BY id", $options);
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
                            <tr>                <td>
                                                    '.$row["email"].'
                                                 </td>

                                                </td>
                                                <td>
                                                '.$row["registerd"].'
                                                </td>
                                                <td>
                                                '.date("M j, Y", strtotime($row["createdAt"] )).'
                                                </td>
                                            </tr>
                              ';
        print_r($table);
    }

}}
