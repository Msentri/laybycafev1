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
    <link href="includes/jQuery.filer-master/css/jquery.filer.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
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
<div class="page-header" style="background-color:#FFF" xmlns="http://www.w3.org/1999/html">
    <section class="page-section">
        <div class="container">
            <div class="row">
<?php

    $refOnTopUp = @$_GET['reference'];

    $check ='<script>
            $(document).ready(function(){
                setInterval(function() {
                    $("#load_results").load("check.php?reference='.$refOnTopUp.'");
                }, 1000);
            });

        </script>';

    print_r($check);

?>
                <div id = "load_results"></div>
            </div>
        </div>
    </section>
</div>
<?php
require_once 'footer.php';
?>
</body></html>
