<?php
/**
 * Created by PhpStorm.
 * User: Sandile
 * Date: 2017/07/21
 * Time: 12:02 PM
 */


$pushMultipleData = [];
$pushMultipleDataAwaiting = [];

$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT = "";
$product_name="";


//***************************SANDILE PROCESSING*****************************//
?>
    <div class="remodal lb-modal" data-remodal-id="pay-now-modal">
        <div class="panel panel-warning lb-panel">
            <div class="panel-heading lb-panel-heading">
                <strong>
                    Choose the amount that you would like to pay now for each layby
                </strong>
            </div>
            <div class="panel-body">
                <button data-remodal-action="close" class="remodal-close"></button>
                <form class="form-horizontal" method="post" autocomplete="off" accept-charset="UTF-8" role="form">
                    <div class="container lb-new-tabs">
                        <ul class="tabs">
                            <li class="tab-link current" data-tab="tab-1">Current Layby's</li>
                            <li class="tab-link" data-tab="tab-2">Awaiting Layby's</li>
                        </ul>
                        <div id="tab-1" class="tab-content current">
                            <?php
                            //Processing Laybys//


                            if(@$processing!=null && @$processing!='No laybys') {
                                foreach ($processing as $i => $data) {

                                    $product_ref = $data->product_ref;
                                    $product_name = $data->product_name;
                                    $status = $data->status;
                                    $depositMade = $data->depositMade;

                                    $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT = $product_ref;

                                    if ($status != 'cancelled ') {

                                        // FORM BUILDER
                                        ?>
                                        <div class='form-group' style='margin-bottom: 0px;'>
                                            <label style='text-align: left;' for='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='col-sm-8 control-label text-left'>$product_name</label>
                                            <div class='col-sm-4' style='text-align: left;'>
                                                <input type='text' name='$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT' class='form-control' id='inputPassword3' placeholder='Amount'>
                                            </div>
                                        </div>
                                        <?php
                                        // FORM SUBMISSION
                                        if (isset($_POST['pay_now'])) {
                                            if($_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT] == 0 or $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT] == null){

                                            }else {

                                                $pushMultipleData[] = [
                                                    'product_ref' => $product_ref,
                                                    'consumer_id' => $consumerID,
                                                    'pay_now_amount' => $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT]
                                                ];
                                            }
                                        }
                                    }
                                }
                            }else{
                                ?>
                                <label class="lb-label-error">No Current Payments.</label>
                            <?php }
                            ?>
                        </div>
                        <div id="tab-2" class="tab-content">
                            <?php //Awaiting Laybys//
                            if(@$awaiting_dep!=null and @$awaiting_dep!='No laybys') {

                                foreach ($awaiting_dep as $i => $data) {

                                    $product_ref = $data->product_ref;
                                    $product_name = $data->product_name;
                                    $status = $data->status;
                                    $depositMade = $data->depositMade;

                                    $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT = $product_ref;

                                    if ($status != 'cancelled') { ?>
                                        <div class='form-group' style='margin-bottom: 0px;'>
                                            <label style='text-align: left;' for='<?php echo $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT;?>' class='col-sm-8 control-label text-left'><?php echo $product_name; ?></label>
                                            <div class='col-sm-4' style='text-align: left;'>
                                                <input type='text' name='<?php echo $UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT ?>' class='form-control' id='inputPassword3' placeholder='Amount'>
                                            </div>
                                        </div>
                                        <?php  // FORM SUBMISSION
                                        if (isset($_POST['pay_now'])) {
                                           if($_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT] == 0 or $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT] == null){

                                           }else{

                                               $pushMultipleDataAwaiting[] = [
                                                   'product_ref' => $product_ref,
                                                   'consumer_id' => $consumerID,
                                                   'pay_now_amount' => $_POST[$UNIQUE_PRODUCT_REF_FOR_IN_PUT_AMOUNT]
                                               ];
                                           }

                                        }
                                    }
                                }

                            }else{
                                ?>
                                <label class="lb-label-error">No Awaiting Payments.</label>
                            <?php }?>
                        </div>
                    </div>
                    <!-- *** end container *** -->
                    <div class="col-sm-12 lb-panel-col">
                        <button type="submit" class="btn btn-default" name="pay_now" >Pay now</button>
                        <button data-remodal-action="cancel" class="btn btn-default" onclick="javascript:window.location='dashboard'">Cancel</button>
                    </div>
                </form>
                <!-- *** end form *** -->
                <?php require_once 'laybys/update_multi.php';
                if(!empty(@$multiResponse) || @$multiResponse != null){
                    ?>
                    <div class="lb-modal-footer">
                        <div class="alert alert-info" role="alert">
                            <ul>
                                <?php foreach ($multiResponse as $data){
                                    ?>
                                    <li>
                                        <?php
                                        echo $data->message; ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }

                ?>
            </div>
            <!-- *** end panel body *** -->
        </div>
    </div>
    <!-- *** end modal *** -->
<?php
//print_r($pushMultipleData);