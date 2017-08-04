<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 9/6/2016
 * Time: 3:21 PM
 */

//require 'config/config.php';
$merchant = $_SESSION['userSession'];

$db->where ("merchant_id", $merchant);
$merchantInfo = $db->getAll ("fees");
$merchantID = $merchantInfo['merchant_id'];

if ($merchantID==$merchant){


    $sql = "SELECT * FROM fees WHERE merchant_id = $merchant";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) {


            $table ='
                            <tr>
                           
                            
                                                <td>
                                                
                                               <a href="#">'.$row["merchant_id"].'</a>
                                                </td>
                                                
                                                
                                                 <td>
                                                
                                               <a href="#">'.$row["fee_type"].'</a>
                                                </td>
                                                
                                                 <td>
                                                
                                               <a href="#">'.$row["no_of_trns"].'</a>
                                                </td>
                                                
                                                <td>
                                                '.$row["vat_rate"].'
                                                </td>
                                                
                                                <td>
                                                    '.$row["fee"].'
                                                </td>
                                                <td>
                                                     '.$row["vat"].'
                                                </td>
                                                  <td>
                                                     '.$row["total"].'
                                                </td> 
                                                
                                              <td>
                                                '.$row["createdAt"].'
                                                </td>
                                                
                                            </tr>
                              ';

            print_r($table);
        }
    } else {
        echo "0 results";
    }
    $conn->close();


}

if(isset($_POST['fees'])) {



    $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong> Bank account already exists
			  </div>";
    //Sends info to the script bellow
   $merchantIDs=$_POST['merchant_id'];
    $feetype= $_POST['fee_type'];
    $no_of_trns= $_POST['no_of_trns'];
    $vat_rate= $_POST['vat_rate'];
    $fee= $_POST['fee'];
    $vat= $_POST['vat'];
    $total= $_POST['total'];


    $db->where ("merchant_id", $merchantID);

    $merchantIDs = $db->getOne ("fees");


    $data = Array(


        'merchant_id' => "$merchantIDs",
        'fee_type'=>$feetype,
        'no_of_trns' =>$no_of_trns,
        'vat_rate' =>  $vat_rate,
        'fee' => $fee,
        'vat' => $vat,
        'total' => $total,
        'creditedAt'  => $db->now()



    );


    $id = $db->insert('fees', $data);

    $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Congrats !</strong> account details has been added
			  </div>";
    if ($id)
        echo $msg;
    else
        echo 'insert failed: ' . $db->getLastError();



}
?>