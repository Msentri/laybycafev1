<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/12/06
 * Time: 2:31 PM
 */
session_start();

include 'vendor/autoload.php';

require_once 'functions/class.user.php';
$user_login = new USER();
include 'includes/clef.php';

$_SERVER['REMOTE_ADDR'];
$computerName = gethostbyaddr($_SERVER['REMOTE_ADDR']);

if(isset($_SESSION['userSession']))
{
    $error = $_SESSION['userSession'];

    if(@$error->code==600){
        $user_login->redirect('logout');
    }
    elseif($_SESSION['roleSession']=='merchant'){

        $user_login->redirect('dashboard');
    }
    elseif($_SESSION['roleSession']=='consumer')
    {

        $user_login->redirect('cart');
    }
    else{

        $user_login->redirect('dashboard');
    }

}

if(isset($_POST['btn-login']))
{
    $email = html_entity_decode(trim($_POST['email']));
    $upass = html_entity_decode(trim($_POST['password']));

    $data = array(
        'email' => $email,
        'password' => $upass
    );

    $result = $api->post("/login", $data);


    $user = $result->response;
    $error = json_decode($user);
    $userInfo = json_decode($user);

    //Gets ID//
    $MerchantId = @$userInfo->merchant_id;
    $merchant_ = @$userInfo->merchant_;
    $branch_name = @$userInfo->branch_name;
    //Gets Role//
    $role = @$userInfo->role;

    $code = @$error->code;

    if($code == 500){
        $user_login->redirect('login?error');
    }
    else
    {

        $_SESSION['userSession'] = $MerchantId;
        $_SESSION['inStore_Session'] = @$merchant_;
        $_SESSION['branchName_Session'] = @$branch_name;
        $_SESSION['roleSession'] = $role;

        $error = $_SESSION['userSession'];

        if(@$error->code==600){
            $user_login->redirect('logout');
        }
        elseif($_SESSION['roleSession']=='merchant'){

            $user_login->redirect('dashboard');
        }
        elseif($_SESSION['roleSession']=='consumer')
        {

            $user_login->redirect('cart');
        }
        else{

            $user_login->redirect('dashboard');
        }
    }

}
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
                                        <a href="https://laybycafe.com">Home</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="http://shop.laybycafe.com-up">Shop</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="login">Login</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="sign-up">Register Now</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="https://business.laybycafe.com">For Merchants</a>
                                    </li>
                                    <li class="mega-menu">
                                        <a href="https://laybycafe.com/contact/">Contact</a>
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
        <div class="container">
            <div class="row">
                <div class="content col-sm-12 col-md-4"></div>
                <!-- .content -->
                <div class="col-sm-12 col-md-4">
                    <form method="post" accept-charset="UTF-8" role="form">
                        <h3 class="title">Login Now</h3>
                        <div id="success"></div>
                        <label>Your Email Address or Cell Number</label>
                        <input name="email" type="text" class="form-control" id="exampleInputEmail2" placeholder="Your Email Address or Cell Number *" />
                        <label>Your Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Your Password *" />
                        <div class="clearfix"></div>
                        <button type="submit" name="btn-login" class="btn btn-default">Login</button>
                        <span class="pull-right">
                            <a href="forgot" class="text-success">Forgot Password?</a>
                        </span>
                        <!-- .buttons-box -->
                    </form>
                    <br/>

                </div>
            </div>
        </div>
    </section>
    <?php
    require_once 'footer.php';
    ?>

</body>
</html>