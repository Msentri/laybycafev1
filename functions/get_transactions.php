<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/05/22
 * Time: 06:41 PM
 */
//include('objsql/config.php');


$contractor = $_SESSION['userSession'];


function paymentOut($date_to_pay)
{
    if(empty($date_to_pay)) {
        return "No date provided";
    }

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date_to_pay);

    // check validity of date
    if(empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {
        $difference     = $now - $unix_date;
        $tense         = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}
$resultDay = paymentOut($date_to_pay);

try {
    $output = '';
    $limit = (isset($_GET["limit"])) ? $_GET["limit"] : 5;
    $offset = (isset($_GET["page"]) && $_GET["page"] > 0) ? $_GET["page"] : 1;

    $rs = $dbh->obj_paging("transactions", "*", "assigned_user='$contractor'", "matures_date", $limit, $offset);
    $result = $rs[0];
    $last_page = $rs[1];
echo "<h4><u>All Donations</u></h4>";
    if ($dbh->obj_error())
        throw new Exception($dbh->obj_error_message());

    while ($row2 = $result->obj_fetch_object())




                echo '
       <table class="table table-hover table-striped" width="100%">
                                    <thead>
                                       <th width="15%">Transaction ID</th>
                                       <th width="10%">amount</th>
                                    	<th width="10%">future amount</th>
                                    	<th width="15%">Paid to</th>
                                    	<th width="10%">Paid by ID</th>
                                    	<th width="20%">status</th>
                                    	<th width="20%">Payout date</th>

                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td> '.$row2->transaction_id.'</td>
                                            <td> '.$row2->amount.'</td>
                                        	<td> '.$row2->future_amount.'</td>
                                        	<td>'.$row2->account_holder.'</td>
                                        	<td>'.$row2->assigned_user.'</td>
                                        	<td> '. $row2->status .'</td>
                                        	<td> '.paymentOut($date_to_pay = $row2->matures_date).'</td>


                                        </tr>
                                    </tbody>
                                </table>';

            if ( $offset == 1 )
            {
                $output .= "&lt;&lt;&nbsp;&nbsp;&lt;&nbsp;";
            }
            else
            {
                $output .= "<a href=transactions.php?page=1>&lt;&lt;&nbsp;&nbsp;</a>";
                $prev    = $offset - 1;
                $output .= "<a href=transactions.php?page=$prev>&lt;&nbsp;</a>";
            }

            $output .= " [ Page $offset of $last_page ] ";

            if ( $offset == $last_page )
            {
                $output .= "&nbsp;&gt;&nbsp;&nbsp;&gt;&gt;";
            }
            else
            {
                $next    = $offset + 1;
                $output .=  "<a href=transactions.php?page=$next>&nbsp;&gt;</a>";
                $output .=  "<a href=transactions.php?page=$last_page>&nbsp;&nbsp;&gt;&gt;</a>";
            }

            echo "<p>$output</p>";
            $result->obj_free_result();

        }
        catch ( Exception $e )
        {
            //log error and/or redirect user to error page
        }

try {
    $output = '';
    $limit = (isset($_GET["limit"])) ? $_GET["limit"] : 5;
    $offset = (isset($_GET["page"]) && $_GET["page"] > 0) ? $_GET["page"] : 1;

    $rs = $dbh->obj_paging("transactions", "*", "user_id='$contractor' AND type2='withdraw'", "matures_date", $limit, $offset);
    $result = $rs[0];
    $last_page = $rs[1];

echo "<h4><u>All Withdrawals</u></h4>";
    if ($dbh->obj_error())
        throw new Exception($dbh->obj_error_message());

    while ($row2 = $result->obj_fetch_object())




                echo '
                
       <table class="table table-hover table-striped" width="100%">
                                    <thead>
                                       <th width="15%">Transaction ID</th>
                                       <th width="10%">amount</th>
                                    	<th width="15%">Paid to</th>
                                    	<th width="10%">Paid by ID</th>
                                    	<th width="20%">status</th>
                                    	<th width="20%">Payout date</th>

                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td> '.$row2->transaction_id.'</td>
                                            <td> '.$row2->amount.'</td>
                                            <td>'.$row2->account_holder.'</td>
                                        	<td>'.$row2->assigned_user.'</td>
                                        	<td> '. $row2->status .'</td>
                                        	<td> '.paymentOut($date_to_pay = $row2->matures_date).'</td>


                                        </tr>
                                    </tbody>
                                </table>';

            if ( $offset == 1 )
            {
                $output .= "&lt;&lt;&nbsp;&nbsp;&lt;&nbsp;";
            }
            else
            {
                $output .= "<a href=transactions.php?page=1>&lt;&lt;&nbsp;&nbsp;</a>";
                $prev    = $offset - 1;
                $output .= "<a href=transactions.php?page=$prev>&lt;&nbsp;</a>";
            }

            $output .= " [ Page $offset of $last_page ] ";

            if ( $offset == $last_page )
            {
                $output .= "&nbsp;&gt;&nbsp;&nbsp;&gt;&gt;";
            }
            else
            {
                $next    = $offset + 1;
                $output .=  "<a href=transactions.php?page=$next>&nbsp;&gt;</a>";
                $output .=  "<a href=transactions.php?page=$last_page>&nbsp;&nbsp;&gt;&gt;</a>";
            }

            echo "<p>$output</p>";
            $result->obj_free_result();

        }
        catch ( Exception $e )
        {
            //log error and/or redirect user to error page
        }




