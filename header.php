<?php
/**
 * Created by PhpStorm.
 * User: Sakhile
 * Date: 2016/09/07
 * Time: 12:14 PM
 * Add the payment id from the email to the transaction log
 */
session_start();

date_default_timezone_set("Africa/Johannesburg");

if(@$source!=null){

 ?>
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
<?php }

else{
    if(!isset($_SESSION['userSession']))
    {
        header("Location: login");
    }
}
require 'vendor/autoload.php';
require 'functions/config/keygen.php';

//$deploy = "debug";
$deploy = "live";

if($deploy=="live") {
$api = new RestClient([
    //'base_url' => "http://api.laybycafe.com/v1.1",
    'base_url' => "http://v2.laybycafe.com/v2.0",
]);
}

if($deploy=="demo"){
    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",
    ]);
}

if($deploy=="debug"){
    $api = new RestClient([
        'base_url' => "http://localhost/v2/v2.0",
    ]);
}

$consumerID  = @$_SESSION['userSession'];
$merchant_Session = @$_SESSION['inStore_Session'];
$storeNameSession = @$_SESSION['branchName_Session'];
$store_name = @$_SESSION['branchName_Session'];
$roleSession = @$_SESSION['roleSession'];

if($roleSession=='merchant' or $roleSession=='instore'){

    $profile = $api->get("/searchprofile/$consumerID");

    $merchantInfo = json_decode($profile->response);

    $verifiedAccount = @$merchantInfo->verified_account;

}

$update = $api->get("/store/update/order");
$process = $api->get("/store/process/order");

?>
<?php if(@$_SESSION['userSession']!=null)
    {
        if($roleSession=='merchant'){
        if (!is_dir('uploads/documents/'.$consumerID.'')) {

            mkdir('uploads/documents/'.$consumerID.'', 0777, true);}
        }
        if (!is_dir('includes/serratus/test/fixtures/ean/'.$consumerID.'')) {

            mkdir('includes/serratus/test/fixtures/ean/'.$consumerID.'', 0777, true);}
        ?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="css/style.tabs.css">
    <link rel="stylesheet" href="css/main.styles.css">
    <script type="text/javascript">
        function calc(A,B,deposit) {

            var one = Number(A);
            if (isNaN(one)) { alert('Invalid entry: '+A); one=0; }
            var two = Number(document.getElementById(B).value);
            if (isNaN(two)) { alert('Invalid entry: '+B); two=0; }

            if(one <= 220){

                alert('Invalid amount laybys must be above R: '+A);
            }

            else if(one > 220 && one < 550){
                document.getElementById(deposit).value = Math.round(one * 0.50);
            }
            else if(one > 549 && one < 1000){

                document.getElementById(deposit).value = Math.round(one * 0.20);
            }

            else if(one > 999 && one <= 4999){

                document.getElementById(deposit).value = Math.round(one * 0.15);
            }

            else if(one >= 5000){

                document.getElementById(deposit).value = Math.round(one * 0.1);
            }


        }
    </script>
    <link href="includes/jQuery.filer-master/css/jquery.filer.css" rel="stylesheet">

</head>
<body>
<div id="page"><script src="includes/jQuery.filer-master/js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="includes/jQuery.filer-master/js/custom.js" type="text/javascript"></script>
    <!-- Page Loader -->
    <div id="pageloader">
        <div class="loader-item fa fa-spin text-color"></div>
    </div>
    <!-- Sticky Navbar -->
    <header id="sticker" class="sticky-navigation dark-header">
        <!-- Sticky Menu -->
        <?php
        if(@$refOnTopUp==null and $roleSession=='consumer'){
            $payments = $api->get("/payment");
        ?>
        <div class="sticky-menu relative">
            <!-- navbar -->
            <div class="navbar navbar-default navbar-bg-light" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-header">
                                <!-- Button For Responsive toggle -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span></button>
                                <!-- Logo -->

                                <a class="navbar-brand" href="index.php">
                                    <img class="site_logo" alt="Site Logo" src="img/logo.png" />
                                </a></div>
                            <!-- Navbar Collapse -->
                            <div class="navbar-collapse collapse">
                                <!-- nav -->
                                <ul class="nav navbar-nav">
                                    <!-- Home  Mega Menu -->
                                    <li class="mega-menu">
                                        <a href="dashboard">Dashboard</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="http://store.laybycafe.com/">Shop</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="cart">Cart</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="profile">Profile</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="wallet">Wallet</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="logout">Logout</a>
                                    </li>
                                    <li class="hidden-767">
                                        <a href="#" class="header-search">
													<span>
														<i class="fa fa-search"></i>
													</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Right nav -->
                                <!-- Header Search Content -->
                                <div class="bg-white hide-show-content no-display header-search-content">
                                    <form role="search" class="navbar-form vertically-absolute-middle">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter your text &amp; Search Here" class="form-control" id="s" name="s" value="" />
                                        </div>
                                    </form>
                                    <button class="close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <!-- Header Search Content -->
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- navbar -->
        </div>
        <?php
        }
        if(@$refOnTopUp==null and $roleSession=='merchant'){

        ?>
        <!-- Merchant Menu -->
            <div class="sticky-menu relative">
                <!-- navbar -->
                <div class="navbar navbar-default navbar-bg-light" role="navigation">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="navbar-header">
                                    <!-- Button For Responsive toggle -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span></button>
                                    <!-- Logo -->

                                    <a class="navbar-brand" href="index.php">
                                        <img class="site_logo" alt="Site Logo" src="img/logo.png" />
                                    </a></div>
                                <!-- Navbar Collapse -->
                                <div class="navbar-collapse collapse">
                                    <!-- nav -->
                                    <ul class="nav navbar-nav">
                                        <!-- Home  Mega Menu -->
                                        <li class="mega-menu">
                                            <a href="retail">Create Layby</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="dashboard">Dashboard</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="profile">Profile</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="logout">Logout</a>
                                        </li>
                                        <li class="hidden-767">
                                            <a href="#" class="header-search">
													<span>
														<i class="fa fa-search"></i>
													</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Right nav -->
                                    <!-- Header Search Content -->
                                    <div class="bg-white hide-show-content no-display header-search-content">
                                        <form role="search" class="navbar-form vertically-absolute-middle">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter your text &amp; Search Here" class="form-control" id="s" name="s" value="" />
                                            </div>
                                        </form>
                                        <button class="close">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- Header Search Content -->
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container -->
                </div>
                <!-- navbar -->
            </div>
<?php }
        if(@$refOnTopUp==null and $roleSession=='instore'){
?>
                <!-- Merchant Menu -->
                <div class="sticky-menu relative">
                    <!-- navbar -->
                    <div class="navbar navbar-default navbar-bg-light" role="navigation">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="navbar-header">
                                        <!-- Button For Responsive toggle -->
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span></button>
                                        <!-- Logo -->

                                        <a class="navbar-brand" href="index.php">
                                            <img class="site_logo" alt="Site Logo" src="img/logo.png" />
                                        </a></div>
                                    <!-- Navbar Collapse -->
                                    <div class="navbar-collapse collapse">
                                        <!-- nav -->
                                            <ul class="nav navbar-nav">
                                                <!-- Home  Mega Menu -->
                                                <li class="mega-menu">
                                                    <a href="retail">Create Layby</a>
                                                </li>
                                                <li class="mega-menu">
                                                    <a href="dashboard">Dashboard</a>
                                                </li>
                                                <li class="mega-menu">
                                                    <a href="profile">Profile</a>
                                                </li>
                                                <li class="mega-menu">
                                                    <a href="logout">Logout</a>
                                                </li>
                                                <li class="hidden-767">
                                                    <a href="#" class="header-search">
													<span>
														<i class="fa fa-search"></i>
													</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        <!-- Right nav -->
                                        <!-- Header Search Content -->
                                        <div class="bg-white hide-show-content no-display header-search-content">
                                            <form role="search" class="navbar-form vertically-absolute-middle">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Enter your text &amp; Search Here" class="form-control" id="s" name="s" value="" />
                                                </div>
                                            </form>
                                            <button class="close">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <!-- Header Search Content -->
                                    </div>
                                    <!-- /.navbar-collapse -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container -->
                    </div>
                    <!-- navbar -->
                </div>
           <?php  }
        if(@$refOnTopUp==null and $roleSession=='branch'){
            ?>
            <!-- Merchant Menu -->
            <div class="sticky-menu relative">
                <!-- navbar -->
                <div class="navbar navbar-default navbar-bg-light" role="navigation">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="navbar-header">
                                    <!-- Button For Responsive toggle -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span></button>
                                    <!-- Logo -->

                                    <a class="navbar-brand" href="index.php">
                                        <img class="site_logo" alt="Site Logo" src="img/logo.png" />
                                    </a></div>
                                <!-- Navbar Collapse -->
                                <div class="navbar-collapse collapse">
                                    <!-- nav -->
                                    <ul class="nav navbar-nav">
                                        <!-- Home  Mega Menu -->
                                        <li class="mega-menu">
                                            <a href="retail">Create Layby</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="dashboard">Dashboard</a>
                                        </li>
                                        <li class="mega-menu">
                                            <a href="logout">Logout</a>
                                        </li>
                                        <li class="hidden-767">
                                            <a href="#" class="header-search">
													<span>
														<i class="fa fa-search"></i>
													</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Right nav -->
                                    <!-- Header Search Content -->
                                    <div class="bg-white hide-show-content no-display header-search-content">
                                        <form role="search" class="navbar-form vertically-absolute-middle">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter your text &amp; Search Here" class="form-control" id="s" name="s" value="" />
                                            </div>
                                        </form>
                                        <button class="close">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- Header Search Content -->
                                </div>
                                <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container -->
                </div>
                <!-- navbar -->
            </div>
        <?php  }


           ?>



        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-64787743-1', 'auto');
            ga('send', 'pageview');

        </script>


        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                document,'script','https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '603167136507064');
            fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=603167136507064&ev=PageView&noscript=1"
            /></noscript>
        <!-- End Facebook Pixel Code -->

    </header>
    <?php
}?>