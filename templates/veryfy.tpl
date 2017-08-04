<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">
            <h5><?php print_r($getCode->message);?></h5>
            <script type="text/javascript">
                function Redirect()
                {
                    window.location="dashboard";
                }
                setTimeout('Redirect()', 0500);
            </script>
        </div>
    </div>
</div>