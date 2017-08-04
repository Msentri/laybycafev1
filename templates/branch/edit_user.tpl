<?php
if(@$message==null){
?>
<section id="container" class="page-section container">
    <div class="container">
        <div class="remodal-bg">
            <div class="row">
                <div class="col-lg-4 center-block"></div>
                <div class="col-lg-4 center-block">
                    <h6 class="center">Change Password for <?php print_r(@$user_name)?></h6>
                    <form autocomplete="off" method="post" accept-charset="UTF-8" class="form-horizontal">
                        <input name="password" required type="password" class="form-control" placeholder="password">
                        <input name="password2" required type="password" class="form-control" placeholder="Repeat Password">
                        <button name="changePass" type="submit" class="btn btn-default">Change Pass</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }else{
?>
<section id="container" class="page-section container">
    <div class="container">
        <div class="remodal-bg">
            <div class="row">
                <div class="col-lg-4 center-block"></div>
                <div class="col-lg-4 center-block">
                    <h6 class="center">Password Changed for <?php print_r(@$user_name)?></h6>
                    <a href="profile" class="btn btn-default">Return</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
?>