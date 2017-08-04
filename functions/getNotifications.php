<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/30
 * Time: 1:09 PM
 */

$notificationData = json_decode($emailNotifications->response);


if(@$notificationData->code!='362'){
foreach($notificationData as $key=>$data){

    $layby_data = [];
    $name = $layby_data['full_name'] = filter_var(@$data->full_name, FILTER_SANITIZE_STRING);
    $email = $layby_data['email'] = filter_var(@$data->email, FILTER_SANITIZE_STRING);
    $type = $layby_data['type'] = filter_var(@$data->type, FILTER_SANITIZE_STRING);

    $table ='
                            <tr>
                                                <td>
                                                '.@$name.'
                                               </td>
                                               <td>
                                                '.@$email.'
                                               </td>
                                               <td>
                                                '.@$type.'
                                               </td>

                                             </tr>
                              ';
    print_r($table);

}
}


?>