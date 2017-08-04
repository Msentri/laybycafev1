<?php
/**
 * Created by PhpStorm.
 * User: Sandile
 * Date: 2017/08/02
 * Time: 1:55 PM
 */


//***************************SANDILE PROCESSING*****************************//


//Processing Laybys//
if(@$processing!=Null && @$processing!='No laybys') {

    if (!empty(@$processing)) {

        print_r('<div role="tabpanel" class="tab-pane active" id="home">');

        foreach ($processing as $i => $data) {

            $product_ref = $data->product_ref;
            $product_name = $data->product_name;
            $status = $data->status;
            $depositMade = $data->depositMade;

            $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT = $product_ref;

            if ($status != 'cancelled ') {

                // FORM BUILDER
                $pay_now_inputs = "

                    <div class='form-group' style='margin-bottom: 0px;'>
                        <label style='text-align: left;' for='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='col-sm-8 control-label text-left'>$product_name</label>
                        <div class='col-sm-4' style='text-align: left;'>
                            <input type='text' name='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='form-control' id='inputPassword3' placeholder='Amount'>
                        </div>
                    </div>
                   
            ";

                // FORM SUBMISSION
                if (isset($_POST['pay_now'])) {

                    $pushMultipleData[] = [
                        'product_ref' => $product_ref,
                        'consumer_id' => $consumerID,
                        'pay_now_amount' => $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT]
                    ];

                }

                print_r($pay_now_inputs);

            }

        }//$resultForwardPayment = $api->post("/payment/push",$pushMultipleData);
        print_r('</div>')  ;
    }
}else{
    print_r('<div role="tabpanel" class="tab-pane active" id="home">');
    print_r("<label style='text-transform: uppercase;'>No Current Payments.</label>");
    print_r('</div>')  ;
}

//Awaiting Laybys//
if(@$awaiting_dep!=Null and @$awaiting_dep!='No laybys') {
    if (!empty(@$awaiting_dep)) {

        print_r('<div role="tabpanel" class="tab-pane" id="profile">');
        foreach ($awaiting_dep as $i => $data) {

            $product_ref = $data->product_ref;
            $product_name = $data->product_name;
            $status = $data->status;
            $depositMade = $data->depositMade;

            $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT = $product_ref;

            if ($status != 'cancelled') {

                // FORM BUILDER
                $pay_now_inputs = "

                    <div class='form-group' style='margin-bottom: 0px;'>
                        <label style='text-align: left;' for='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='col-sm-8 control-label text-left'>$product_name</label>
                        <div class='col-sm-4' style='text-align: left;'>
                            <input type='text' name='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='form-control' id='inputPassword3' placeholder='Amount'>
                        </div>
                    </div>
                   
            ";

                // FORM SUBMISSION
                if (isset($_POST['pay_now'])) {

                    $pushMultipleDataAwaiting[] = [
                        'product_ref' => $product_ref,
                        'consumer_id' => $consumerID,
                        'pay_now_amount' => $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT]
                    ];



                }

                print_r($pay_now_inputs);

            }

        }
        //$resultForwardPayment = $api->post("/payment/push",$pushMultipleData);

        $sendMultipleData = [
            'processing' => $pushMultipleData,
            'awaiting' => $pushMultipleDataAwaiting
        ];
        //var_dump($sendMultipleData);
        //print_r($pushMultipleData);

        print_r('</div>');
    }
}else{
    print_r('<div role="tabpanel" class="tab-pane active" id="home">');
    print_r("<label>No Awaiting Payments.</label>");
    print_r('</div>')  ;
}