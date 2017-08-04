<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/01/30
 * Time: 1:09 PM
 */

$fileData = json_decode(@$files->response);

if(@$fileData!=null){
foreach(@$fileData as $key=>$data){

    $layby_data = [];
    $name = $layby_data['name'] = filter_var(@$data->name, FILTER_SANITIZE_STRING);
    $replaced = $layby_data['replaced'] = filter_var(@$data->replaced, FILTER_SANITIZE_STRING);
    $size = $layby_data['size2'] = filter_var(@$data->size2, FILTER_SANITIZE_STRING);
    $type = $layby_data['type'] = filter_var(@$data->type, FILTER_SANITIZE_STRING);
    $extension = $layby_data['extension'] = filter_var(@$data->extension, FILTER_SANITIZE_STRING);
    $date = $layby_data['date'] = filter_var(@$data->date, FILTER_SANITIZE_STRING);

    $table ='
                            <tr>
                                                <td>
                                                '.@$name.'
                                               </td>
                                               <td>
                                                '.@$replaced.'
                                               </td>
                                               <td>
                                                '.@$size.'
                                               </td>
                                               <td>
                                                '.@$type.'
                                               </td>
                                               <td>
                                                '.@$extension.'
                                               </td>
                                               <td>
                                                '.@$date.'
                                               </td>
                                             </tr>
                              ';
    print_r($table);

}

}
?>