<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/12/06
 * Time: 2:31 PM
 */

include 'vendor/autoload.php';

$deploy = 'live';

if($deploy=="live")

{

    $api = new RestClient([
        'base_url' => "http://api.laybycafe.com/v1.1",

    ]);
}
elseif($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}
else{

    $api = new RestClient([
        'base_url' => "http://localhost/api/v1.1",

    ]);
}

if(isset($_POST['forgot'])){


    $data = array(
        'merchant_id'=>$_POST['email']
    );

    $result = $api->get("/password/forgot",$data);


    $getCode = json_decode($result->response);

    var_dump($getCode);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Layby Cafe| Forgot Password</title>
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
</head>
<body>
<div id="page">
    <!-- Page Loader -->
    <div id="pageloader">
        <div class="loader-item fa fa-spin text-color"></div>
    </div>
    <!-- Sticky Navbar -->
    <header id="sticker" class="sticky-navigation dark-header">
        <!-- Sticky Menu -->
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

                                <a class="navbar-brand" href="/">
                                    <img class="site_logo" alt="Site Logo"src="img/logo.png" />
                                </a></div>
                            <!-- Navbar Collapse -->
                            <div class="navbar-collapse collapse">
                                <!-- nav -->
                                <ul class="nav navbar-nav">
                                    <!-- Home  Mega Menu -->

                                    <li class="mega-menu">
                                        <a href="sign-up">Apply</a>
                                    </li>

                                    <li class="mega-menu">
                                        <a href="login">Login</a>
                                    </li>

                                </ul>
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
        <!-- Sticky Menu -->
    </header>
    <section class="page-section">
<?php
if(@$getCode->code!='842'){
include 'templates/forgotPassword.tpl';
}
else{
    include 'templates/expPass.tpl';
}
?>
    </section>
    <?php
    require_once 'footer.php';
    ?>

</body>
</html>