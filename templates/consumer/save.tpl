<div class="remodal lb-modal" data-remodal-id="pay-now-modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="panel panel-warning lb-panel">
        <div class="panel-heading lb-panel-heading">
            <strong>
                Choose the amount that you would like to pay now for each layby
            </strong>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" autocomplete="off" accept-charset="UTF-8" role="form">
                <div class="form-group">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Current Layby's</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Awaiting Payments</a></li>
                        </ul>
                        <div class="tab-content">
                            <?php require 'functions/pay_now_function.php'; ?>
                        </div>
                    </div>
                    <div class="col-sm-12 lb-panel-col">
                        <button type="submit" class="btn btn-default" name="pay_now" >Pay now</button> <button data-remodal-action="cancel" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#c" aria-controls="home" role="tab" data-toggle="tab">Current Layby's</a></li>
        <li role="presentation"><a href="#currentlayby" aria-controls="currentlayby" role="tab" data-toggle="tab">Current Layby's</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Awaiting Payments</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?php var_dump($processing); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <?php var_dump($awaiting_dep); ?>
        </div>
        <?php ?>
    </div>
</div>