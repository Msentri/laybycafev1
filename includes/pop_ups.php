<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/11/22
 * Time: 3:38 PM
 *
 */
if(@$message->code ==402){
    $popup ='
    <div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>

		<h2>Layby Created</h2>
		<p>
			Layby #<strong> '.@$product_ref.'</strong> created successfully
			<br>
			<a href="dashboard"   class="btn btn-default btn-lg"><strong>Go To Dashboard</strong></a>
			<button data-remodal-action="cancel" class="btn btn-default btn-lg"><strong>Create Another Layby</strong></button>

	</div>
    ';

    print_r($popup);

}

if(@$getCode->code ==842){
    $popup ='
    <div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>

		<h2>Password Request</h2>
		<p>Change Password request sent to the registered e-mail ('.$getCode->data->email.')</p>
			<br>

			<button data-remodal-action="cancel" class="btn btn-default btn-lg"><strong>Close</strong></button>

	</div>
    ';

    print_r($popup);

}

if(@$message->code ==401){
    $popup ='
    <div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>

		<h2>Layby #'.@$product_ref.'</h2>
		<p>
			'.$message->message.'</p>
			<br>
			<a href="dashboard"   class="btn btn-default btn-lg"><strong>Go To Dashboard</strong></a>
			<button data-remodal-action="cancel" class="btn btn-default btn-lg"><strong>Create Another Layby</strong></button>

	</div>
    ';

    print_r($popup);

}
//Password change code//
if(@$changePassCode->code ==112){
    $popup ='
  <script type="text/javascript">

            $.Zebra_Dialog(\''.$changePassCode->message.'\',
            {
               \'auto_close\': 5000
            }
            );


            </script>
    ';

    print_r($popup);

}
//Password change Success Message //
if(@$confirmCode->code ==113){
    $popup ='
  <script type="text/javascript">

            $.Zebra_Dialog(\''.$confirmCode->message.'\',
            {
               \'auto_close\': 5000
            }
            );


            </script>
    ';

    print_r($popup);

}

//Password change fail Message //
if(@$confirmCode->code ==112){
    $popup ='
  <script type="text/javascript">

            $.Zebra_Dialog(\''.$confirmCode->message.'\',
            {
               \'auto_close\': 5000
            }
            );


            </script>
    ';

    print_r($popup);

}


if(@$code->code==301) {

    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="'.$url_data['return_url'].'";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


    print_r($redirect);
}


if(@$code->code==300) {

    $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="'.$url_data['return_url'].'";
                                    }
                                    setTimeout(\'Redirect()\', 5000);
                                    </script>';


    print_r($redirect);
}

//payment declined//
if(@$payoutData->code !=null){
    $popup ='
    <div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>

		<h2>Payout Request</h2>
		<p>
			'.@$payoutData->message.'
			<br>
		
			<button data-remodal-action="cancel" class="btn btn-default btn-lg"><strong>Close</strong></button>

	</div>
    ';

    print_r($popup);

}