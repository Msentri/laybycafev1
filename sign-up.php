<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2016/12/06
 * Time: 2:31 PM
 */
session_start();
require_once 'functions/class.user.php';
require 'vendor/autoload.php';

$deploy = '';
if($deploy=="live")

{

    $api = new RestClient([
        'base_url' => "https://api.laybycafe.com/v1.1",

    ]);
}

if($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}
else{

    $api = new RestClient([
        'base_url' => "http://localhost/v2/v2.0",

    ]);}

include_once'functions/create_merchant.php';

$role = @$_GET['role'];

if(@$_GET['reg']!=null){

if($role=='merchant'){

    $role='merchant';
}

}else{

    $role='consumer';
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
    <?php if(@$_SESSION['verified']!='N'){

    ?>
    <section class="page-section">
        <div class="container">
            <div class="row">
                <div class="content col-sm-12 col-md-8">
                    <form autocomplete="off" method="post" accept-charset="UTF-8" role="form" class="form-horizontal">

                        <?php if($role=='merchant'){?>
                            <h3 class="title">Don't have a Merchant Account? Register Now.</h3>
                        <?php  }else{ ?>
                            <h3 class="title">Don't have an Account? Register Now.</h3>
                        <?php }?>

                        <label>First Name</label>
                        <input required class="form-control" type="text" name="first_name" placeholder="Name *" id="register_name" />
                        <label>Last Name</label>
                        <input required class="form-control" type="text" name="last_name" placeholder="Surname *" id="register_surname" />
                        <?php
                        if($role=='consumer'){
                        ?>
                        <label>ID/Passport Number</label>
                        <input required name="id_no" type="text" class="form-control" id="id_no" placeholder="ID Number *" />
                        <?php }?>
                        <div class="row" role="form">
                            <div class="col-md-6">
                                <label>Primary Email</label>
                                <input required name="email" type="text" class="form-control" id="email" placeholder="Email *" />
                            </div>
                            <div class="col-md-6">
                                <label>Cell Number</label>
                                <input required name="cell" type="text" class="form-control" id="cell" placeholder="Cell Number *" />
                            </div>
                        </div>
                        <div class="row" role="form">
                            <div class="col-md-6">
                                <label>Unique Password</label>
                                <input required  name="password1" type="password" class="form-control" id="password1" placeholder="Password *" />
                            </div>
                            <div class="col-md-6">
                                <label>Retype Unique Password</label>
                                <input required name="password1" type="password" class="form-control" id="password1" placeholder="Re-Enter Password *" />
                            </div>
                            <div class="col-md-2">
                                <input readonly required name="role" type="hidden" class="form-control" id="exampleInputPassword2" value="<?php print_r($role);?>"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button type="submit" name="register" class="btn btn-default">Continue</button>
                        <!-- .buttons-box --></form>
                </div>
                <!-- .content -->
                <div class="col-sm-12 col-md-4"></div>
            </div>
        </div>
    </section>
    <?php }else{

        $consumerID = $_SESSION['userSession'];
        $profile = $api->get("/searchprofile/$consumerID");

        $getProfile = json_decode($profile->response);

        if (isset($_POST['register_button'])) {

            //---------------company Details--------------//
            $trading_name = $_POST['trading_name'];
            $company_name = $_POST['company_name'];
            $website_url = $_POST['website_url'];
            $business_type = $_POST['business_type'];
            $company_reg_number = $_POST['company_reg_number'];
            $company_vat_number = $_POST['company_vat_number'];
            $physical_address = $_POST['physical_address'];
            $phone = @$_POST['phone'];
            $data = Array(
                'merchant_id' => $consumerID,
                'business_name' => $company_name,
                'trading_name' => $trading_name,
                'business_type' => $business_type,
                'vat_number' => $company_vat_number,
                'reg_number' => $company_reg_number,
                'phone' => $phone,
                'business_address' => $physical_address,
                'website' => $website_url
            );

            $addBusiness = $api->post("/merchant/business",$data);

            $GetBusiness = json_decode($addBusiness->response);

            //---------------------Banking details------------//
            $bank_name = $_POST['bank_name'];
            $branch_code = $_POST['branch_code'];
            $account_holder = $_POST['account_holder'];
            $account_number = $_POST['account_number'];

            $data = Array (
                'merchant_id' => $consumerID,
                'bank_name' => $bank_name,
                'bank_account' =>  $account_number,
                'account_holder' => $account_holder,
                'branch_code' => $branch_code
            );

            $bank = $api->post("/merchants/bank/",$data);

            $data = Array (
                'merchant_id' => $consumerID,
                'store_name' => $trading_name,
                'store_url' =>  $website_url
            );

            $addStore= $result = $api->post("/merchant/stores",$data);
            $full_name = $getProfile->first_name .' '.$getProfile->last_name;
            $data = array(

                'merchant_id' => $consumerID,
                'email' => $getProfile->email,
                'type' => 'admin',
                'full_name' => $full_name
            );

            $addNotification = $api->post("/merchant/notify",$data);

            if($GetBusiness->code=='601'){

                $redirect ='<script type="text/javascript">
                                    function Redirect()
                                    {
                                    window.location="dashboard";
                                    }
                                    setTimeout(\'Redirect()\', 0500);
                                    </script>';

               print_r($redirect);
            }

        }

    ?>
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="content col-sm-12 col-md-8">
                        <form autocomplete="off"  method="post" accept-charset="UTF-8" role="form" class="form-horizontal">
                            <h3 class="title">Just few more details...</h3>
                            <div id="success"></div>
                            <label>Trading Name</label>
                            <input required class="form-control" type="text" name="trading_name" placeholder="Trading Name *" id="trading_name" /> 					<label>Company Reg. Name</label>
                            <input required class="form-control" type="text" name="company_name" placeholder="Registered Name *" id="company_name" />
                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>Website URL</label>
                                    <input name="website_url" type="text" class="form-control" id="exampleInputEmail2" placeholder="Website URL *" />
                                </div>
                                <div class="col-md-6">
                                    <label>Company Type</label>
                                    <select required class="form-control"  name="business_type" id="business_type">
                                        <option value="Private Company">Private Company</option>
                                        <option value="Close Corporation">Close Corporation</option>
                                        <option value="Public Company">Public Company</option>
                                        <option value="Sole Proprietor">Sole Proprietor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>Company Reg. Number</label>
                                    <input name="company_reg_number" type="text" class="form-control" id="exampleInputEmail" placeholder="Company Reg Number *" />
                                </div>
                                <div class="col-md-6">
                                    <label>Company VAT Number</label>
                                    <input name="company_vat_number" type="text" class="form-control" id="exampleInputPassword" placeholder="Company VAT Number" />
                                </div>
                            </div>

                            <h4>Contact  Information</h4>

                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input required name="first_name" type="text" disabled="disabled" class="form-control" id="exampleInputEmail3" placeholder="Name *" value="<?php echo $getProfile->first_name; ?>" readonly="readonly" />
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                    <input name="last_name" type="text" disabled="disabled" class="form-control" id="exampleInputPassword3" placeholder="Surname *" value="<?php echo $getProfile->last_name; ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>Contact Number</label>
                                    <input required name="phone" type="text" class="form-control" id="phone" placeholder="Contact Number *" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label>Physical Address</label>
                                    <textarea required name="physical_address" class="form-control" id="exampleInputPassword4" placeholder="Physical Address *" >
                                    </textarea>
                                </div>
                            </div>


                            <h4>Banking Information</h4>
                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>Bank Name</label>
                                    <select required class="form-control"  name="bank_name" id="bank_name">
                                        <option value="ABSA">ABSA</option>
                                        <option value="FNB">FNB</option>
                                        <option value="Standard Bank">Standard Bank</option>
                                        <option value="Nedbank">Nedbank</option>
                                        <option value="Capitec">Capitec</option>
                                        <option value="Investec">Investec</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Branch Code</label>
                                    <input required name="branch_code" type="text" class="form-control" id="exampleInputPassword3" placeholder="Branch Code *" />
                                </div>
                            </div>
                            <div class="row" role="form">
                                <div class="col-md-6">
                                    <label>Account Holder</label>
                                    <input required name="account_holder" type="text" class="form-control" id="exampleInputEmail4" placeholder="Account Holder *" />
                                </div>
                                <div class="col-md-6">
                                    <label>Account Number</label>
                                    <input required name="account_number" type="text" class="form-control" id="exampleInputPassword4" placeholder="Account Number *" />
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <input name="register_button" type="submit" class="btn btn-default" value="Register Now" />
                            <!-- .buttons-box --></form>
                    </div>
                    <!-- .content -->
                    <div class="col-sm-12 col-md-4">
                        <form action="/login" method="post" class="light-bg contact-form pad-40" id="contact-form2">
                            <h3 class="title"><strong>Did You Know?</strong></h3>
                            <p>&nbsp;</p>
                            <p class="title">We dont charge any <strong>setup fees or monthly fees</strong> for our service</p>
                            <p class="title">We can only accept payments made in <strong>South African rands</strong></p>
                            <p class="title">We charge a fixed <strong>3.5% transaction fee </strong>on all transactions we process on your behalf.</p>
                            <div class="clearfix"></div>
                            <!-- .buttons-box -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php }?>
    <?php
    require_once 'footer.php';
    ?>

</body>
</html>