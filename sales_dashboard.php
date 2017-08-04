<head>
    <meta charset="utf-8">
    <title>Layby Cafe</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Layby Cafe">
    <meta name="description" content="Layby Cafe">
    <meta name="author" content="Layby Cafe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:300,400,700,400italic,700italic">
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/hover-dropdown-menu.css" rel="stylesheet">
    <!-- Icomoon Icons -->
    <link href="css/icons.css" rel="stylesheet">
    <!-- Revolution Slider -->
    <link href="css/revolution-slider.css" rel="stylesheet">
    <link href="rs-plugin/css/settings.css" rel="stylesheet">
    <!-- Animations -->
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel Slider -->
    <link href="css/owl/owl.carousel.css" rel="stylesheet">
    <link href="css/owl/owl.theme.css" rel="stylesheet">
    <link href="css/owl/owl.transitions.css" rel="stylesheet">
    <!-- PrettyPhoto Popup -->
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!-- Color Scheme -->
    <link href="css/color.css" rel="stylesheet">
    <link rel="stylesheet" href="Zebra_Dialog-master/public/css/flat/zebra_dialog.css" type="text/css">
    <link rel="stylesheet" href="Zebra_Dialog-master/examples/public/css/style.css" type="text/css">
    <link rel="stylesheet" href="Zebra_Dialog-master/examples/libraries/highlight/public/css/ir_black.css" type="text/css">
    <link rel="stylesheet" href="includes/Remodal-master/dist/remodal.css">
    <link rel="stylesheet" href="includes/Remodal-master/dist/remodal-default-theme.css">
    <script type="text/javascript">
        function calc(A,B,deposit) {
            var one = Number(A);
            if (isNaN(one)) { alert('Invalid entry: '+A); one=0; }
            var two = Number(document.getElementById(B).value);
            if (isNaN(two)) { alert('Invalid entry: '+B); two=0; }
            document.getElementById(deposit).value = Math.round(one * two);
        }
    </script>
    <link href="includes/jQuery.filer-master/css/jquery.filer.css" rel="stylesheet">

</head>
<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 */
require 'vendor/autoload.php';
require 'functions/config/keygen.php';
$deploy = "live";
$LaybysAmount = 0;
$LaybysBalance = 0;
$BalanceHeld = 0;
$completeLaybysAmount = 0;
if(isset($_POST[''])){

    $merchant_id = $_POST['merchant_id'];
    $data = array(
        'merchant_id' => $merchant_id
    );

    $result = $api->get("/sales/laybys", $data);
}
if($deploy=="live")

{

    $api = new RestClient([
        'base_url' => "http://api.laybycafe.com/v1.1",

    ]);
}

if($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}
$result = $api->get("/sales/laybys");

	?>
    <section class="page-section">
        <div class="row">
            <div class="container">

                <div class="row">

                    <?php if(@$storeErrorCode==606){

                        ?>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Please add the store name to create new laybys, click <a href="profile" class="alert-link">profile</a> to add a store
                        </div>
                    <?php }?>
                    <h1>Sales</h1>
                    <?php
                    if(@$verifiedAccount == "N"){
                        ?>
                        <div class="alert alert-danger" role="alert">Please <strong>UPDATE</strong> your Business Information.
                            <a href="profile" class="alert-link">Click Here</a> to get started.
                        </div>
                        <?php
                    }else{

                    }
                    ?>


                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div  class="container who-we-are pad-60">
                                <div class="row">
                                    <div class="col-md-4 animated fadeInRight visible" data-animation="fadeInRight">
                                        <h5 class="no-margin">Search Transactions</h5>
                                        <p><strong>View all transactions <span class="text-color">per customer!</span></strong></p>
                                    </div>
                                    <form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                                        <div class="col-md-8 animated fadeInLeft visible" data-animation="fadeInLeft">
                                            <div class="input-group domain-search" id="Domain-search">
                                                <input name="search" type="text" class="form-control" placeholder="Search by merchant ID">
                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">

                                                        <button type="submit" name="searchLayby" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                    </div></form>
                                </div>
                            </div>

                        </div></div></div></div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav  nav-tabs ">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                                Processing</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">
                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Awaiting Deposit</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Cancelled</a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">
                                <i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Completed</a>
                        </li>
                    </ul>
                    <div  class="tab-content mar-top">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-md-12 pd-top">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref No.</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        include 'functions/viewConsumer_dashboard.php'
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-4" align="left">
                                        <!-- Title And Content -->
                                        <span class="text-color"></span>
                                        <?php
                                        $link = 'sales_dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                        if( $totalPages != 0 )
                                        {
                                            if( $page == 1 )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                            }
                                            $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                            if( $page == $totalPages )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                            }
                                        }
                                        $pagerContainer .= '</div>';

                                        echo $pagerContainer;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12 pd-top">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref No.</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>
                                            <th>Fee Est.</th>
                                            <th>Net</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            include 'functions/viewAwaitingDep.php'
                                            ?>

                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-4" align="left">
                                        <!-- Title And Content -->
                                        <span class="text-color"></span>
                                        <?php
                                        $link = 'sales_dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                        if( $totalPages != 0 )
                                        {
                                            if( $page == 1 )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                            }
                                            $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                            if( $page == $totalPages )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                            }
                                        }
                                        $pagerContainer .= '</div>';

                                        echo $pagerContainer;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12 pd-top">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref No.</th>
                                            <th>Store</th>
                                            <th>Total Amount</th>
                                            <th>Fee Est.</th>
                                            <th>Net</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            include 'functions/viewCancelledLayby.php'
                                            ?>

                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-4" align="left">
                                        <!-- Title And Content -->
                                        <span class="text-color"></span>
                                        <?php
                                        $link = 'sales_dashboard?page=%d';
                                        $pagerContainer = '<div style="width: 300px;">';
                                        if( $totalPages != 0 )
                                        {
                                            if( $page == 1 )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                            }
                                            $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                            if( $page == $totalPages )
                                            {
                                                $pagerContainer .= '';
                                            }
                                            else
                                            {
                                                $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                            }
                                        }
                                        $pagerContainer .= '</div>';

                                        echo $pagerContainer;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab4" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12 pd-top">
                                    <div class="col-md-12 pd-top">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Ref No.</th>
                                                <th>Store</th>
                                                <th>Total Amount</th>
                                                <th>Fee Est.</th>
                                                <th>Net</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php
                                                include 'functions/viewCompletedLayby.php'
                                                ?>

                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-4" align="left">
                                            <!-- Title And Content -->
                                            <span class="text-color"></span>
                                            <?php
                                            $link = 'sales_dashboard?page=%d';
                                            $pagerContainer = '<div style="width: 300px;">';
                                            if( @$totalPages != 0 )
                                            {
                                                if( $page == 1 )
                                                {
                                                    $pagerContainer .= '';
                                                }
                                                else
                                                {
                                                    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
                                                }
                                                $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>';
                                                if( $page == $totalPages )
                                                {
                                                    $pagerContainer .= '';
                                                }
                                                else
                                                {
                                                    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
                                                }
                                            }
                                            $pagerContainer .= '</div>';

                                            echo $pagerContainer;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
	<?php

include_once 'footer.php';
?>
