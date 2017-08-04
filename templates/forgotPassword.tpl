<div class="container">
    <div class="row">
        <div class="content col-sm-12 col-md-4"></div>
        <!-- .content -->
        <div class="col-sm-12 col-md-4">
            <form method="post" accept-charset="UTF-8" role="form">
                <h6 class="text-warning"><?php         print_r(@$passInfo->message);?></h6>
                <h3 class="title">Forgot Password</h3>
                <div id="success"></div>
                <label>Your Email Address or Cell Number</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail2" placeholder="Your Email Address or Cell Number *" />
              <div class="clearfix"></div>
                <button type="submit" name="forgot" class="btn btn-default">Confirm</button>
                <!-- .buttons-box -->
                <span class="pull-right">
                            <a href="login" class="text-success">login</a>
            </span>
            </form>
            <br/>

        </div>
    </div>
</div>