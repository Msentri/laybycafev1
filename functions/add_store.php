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
$merchantInfo = $db->getAll ("stores");
$merchantID = $merchantInfo['merchant_id'];


if(isset($_POST['addStore']))

{
    $msg= "<div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong> You can only add one store per platform
			  </div>";
    //Sends info to the script bellow
    //$merchant_id =  $_POST[$merchant];
    $store_name = $_POST['store_name'];
    $store_url = $_POST['store_url'];
    $platform = $_POST['platform'];

    $db->where ("merchant_id", $merchant);
    $db->where ("platform", $platform);
    $merchantIDs = $db->getOne ("stores");
    $merchantIDs['platform'];

    if($platform == 'Magento '){
        $module = "<a class='btn btn-primary' href='store_plugins/mod-opencart-master.zip'>Download</a>";
    }
    if($platform == 'Wordpress-WooCommerce'){
        $module = "<a class='btn btn-primary' href='store_plugins/woocommerce-gateway-layby-cafe.zip'>Download</a>";
    }
    if($platform == 'Opencart1.5.x'){
        $module = "<a class='btn btn-primary' href='store_plugins/mod-opencart-master.zip'>Download</a>";

    }
    if($platform == 'Joomla'){
        $module = "<a class='btn btn-primary' href='store_plugins/mod-opencart-master.zip'>Download</a>";
    }
    if($platform == 'Opencart2'){
        $module = "<a class='btn btn-primary' href='store_plugins/mod-opencart_2-master.zip'>Download</a>";
    }else{}

    if($merchantIDs['platform']==$platform){
        print_r($msg ,$db->getLastError());
    }else{
        $data = Array (
            'merchant_id' => "$merchant",
            'store_name' => $store_name,
            'store_url' => $store_url,
            'platform' => $platform,
            'module' => $module

        );


        $id = $db->insert ('stores', $data);

        $msg= "
               <div class='nav-top clearfix'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Congrats !</strong> The $store_name was successfully added to your profile.
			  </div>";
        if ($id)
            echo $msg;
        else
            echo 'insert failed: ' . $db->getLastError();



    }
}

if ($merchantID==$merchant){


    $store = $merchantInfo['store_name'];
    $merchant_id = $merchantInfo['merchant_id'];
    $platform = $merchantInfo['platform'];
    $store_url = $merchantInfo['store_url'];


    $sql = "SELECT * FROM stores WHERE merchant_id = $merchant";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) {


            $table ='
                            <tr>
                                                <td>
                                               <a href="#">'.$row["merchant_id"].'</a>
                                                </td>
                                                <td>'.$row["store_name"].'</td>
                                                <td>
                                                    '.$row["platform"].'

                                                </td>
                                                <td>
                                                    <a href="http://'.$row["store_url"].'">'.$row["store_url"].'</a>
                                                </td>
                                              <td>
                                                '.$row["module"].'
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
