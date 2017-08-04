<?php

    include('jQuery.filer-master/php/class.uploader.php');
    $info['metas'][2] ="";
    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'merchant_id'=>$consumerID,
        'limit' => 1, //Maximum Limit of files. {null, Number}
        'maxSize' => 5, //Maximum Size of files {null, Number(in MB's)}
        'extensions' =>array('jpg', 'png','pdf'), //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => 'uploads/documents/'.$consumerID.'/', //Upload directory {String}
        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'replace' => true, //Replace the file if it already exists  {Boolean}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));

if($data['isComplete']){

    $info = $data['data'];

    $data = Array(
        'merchant_id' => $consumerID,
        'file' => $info['metas'][0]['file'],
        'name' => $info['metas'][0]['name'],
        'old_name' => $info['metas'][0]['old_name'],
        'replaced' => $info['metas'][0]['replaced'],
        'size' => $info['metas'][0]['size'],
        'size2' => $info['metas'][0]['size2'],
        'type' => $info['metas'][0]['type'],
        'extension' => $info['metas'][0]['extension'],
        'date' => $info['metas'][0]['date'],
        'type' => $info['metas'][0]['type'][0]

    );


$result = $api->post("/merchant/documents", $data);

}





?>
