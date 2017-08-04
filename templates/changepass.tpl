<?php
if(@$passInfo->code=='015'){

?>
<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">

                <h6 class="text-success"><?php         print_r(@$passInfo->message);?></h6>
                <!-- .buttons-box -->

            <br/>

        </div>
    </div>
</div>
<?php }
else{
?>
<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">
            <form method="post" accept-charset="UTF-8" role="form">
                <h6 class="text-warning"><?php         print_r(@$passInfo->message);?></h6>
                <h3 class="title">Change Password Now</h3>
                <div id="success"></div>
                <label>New Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="New Password *" />
                <label>Confirm New Password</label>
                <input name="password2" type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm New Password *" />
                <div class="clearfix"></div>
                <button type="submit" name="btn-change" class="btn btn-default">Confirm</button>

                <!-- .buttons-box -->
            </form>
            <br/>

        </div>
    </div>
</div>
<?php }?>