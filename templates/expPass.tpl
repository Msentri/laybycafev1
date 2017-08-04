<?php
if(@$passInfo->code=='015'){

?>
<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">
            <h5><?php print_r(@$passInfo->message);?></h5>
            <br/>

        </div>
    </div>
</div>

<?php

}else{

?>
<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">
            <h5><?php print_r(@$getCode->message);?></h5>
            <br/>
            <script type="text/javascript">
                function Redirect()
                {
                    window.location="logout";
                }
                setTimeout('Redirect()', 5000);
            </script>
        </div>
    </div>
</div>
<?php
}
?>