<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */

$merchantID;

if($businessName==NULL){

    if(isset($_POST['btn-update'])) {

        $businessName = @$_POST['business_name'];
        $businessType = @$_POST['business_type'];
        $vatNumber = @$_POST['vat_number'];
        $regNumber = @$_POST['reg_number'];
        $website = @$_POST['website'];
        $phone = @$_POST['phone'];
        $businessAddress = @$_POST['businessAddress'];

        $logo = $_FILES['logo'];
        $errors= array();
        $file_name = $_FILES['logo']['name'];
        $file_size =$_FILES['logo']['size'];
        $file_tmp =$_FILES['logo']['tmp_name'];
        $file_type=$_FILES['logo']['type'];
        $file_ext = substr( strrchr($file_name, '.'), 1);

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }

        if(empty($errors)==true){

            if (!is_dir('uploads/logo/'.$merchantID.'')) {

                mkdir('uploads/logo/'.$merchantID.'', 0777, true);
                move_uploaded_file($file_tmp,"uploads/logo/".$merchantID."/".$file_name);
            }
            else{
                move_uploaded_file($file_tmp,"uploads/logo/".$merchantID."/".$file_name);
            }



            $data = Array(
                'merchant_id' => @$merchantID,
                'business_name' => @$businessName,
                'business_type' => @$businessType,
                'vat_number' => @$vatNumber,
                'reg_number' => @$regNumber,
                'phone' => @$phone,
                'business_address' => @$businessAddress,
                'website' => @$website,
                'logo' => 'uploads/logo/'.$merchantID.'/'. $file_name .''
            );

            echo "Success";
        }else{
            print_r($errors[0]);
        }
        if($errors==NULL){
            $id = $db->insert('merchant_business', $data);
            if ($id)
                echo 'Business info was added.';
        }

        else{

            echo ' Insert failed';
        }

    }
}
else{

    if(isset($_POST['btn-update'])) {

        $businessName = $_POST['business_name'];
        $businessType = $_POST['business_type'];
        $vatNumber = $_POST['vat_number'];
        $regNumber = $_POST['reg_number'];
        $website = $_POST['website'];
        $phone = $_POST['phone'];
        $businessAddress = $_POST['businessAddress'];

        $logo = $_FILES['logo'];
        $errors = array();
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $file_ext = substr(strrchr($file_name, '.'), 1);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {

            if (!is_dir('uploads/logo/' . $merchantID . '')) {

                mkdir('uploads/logo/' . $merchantID . '', 0777, true);
                move_uploaded_file($file_tmp, "uploads/logo/" . $merchantID . "/" . $file_name);
            } else {
                move_uploaded_file($file_tmp, "uploads/logo/" . $merchantID . "/" . $file_name);
            }


            $data = Array(
                'merchant_id' => $merchantID,
                'business_name' => $businessName,
                'business_type' => $businessType,
                'vat_number' => $vatNumber,
                'reg_number' => $regNumber,
                'phone' => $phone,
                'business_address' => $businessAddress,
                'website' => $website,
                'logo' => 'uploads/logo/' . $merchantID . '/' . $file_name . ''
            );

            echo "Success";
        } else {
            print_r($errors[0]);
        }

        if($errors[0]==NULL){
            $db->where ('merchant_id', $merchantID);
            if ($db->update ('merchant_business', $data))
                'Profile updated';
        }

        else{
            echo ' update failed';
        }

    }

}

