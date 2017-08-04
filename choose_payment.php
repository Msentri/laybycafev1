<?php
date_default_timezone_set("Africa/Johannesburg");

include 'header.php';
use Base32\Base32;

$encoded = $_GET['options'];
$decoded = Base32::decode($encoded);

$getTransaction = json_decode($decoded);
$refOnTopUp = $getTransaction->topup;
$amount = $getTransaction->amount;

?>
<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
    <!-- page-header -->
    <div class="page-header" style="background-color:#FFF" xmlns="http://www.w3.org/1999/html">
    <section class="page-section">

        <div class="container">
            <div class="text-center">

                    <h3>Choose your Payment Method</h3>
            </div>

            <div class="col-lg-12 text-center" style="padding:2%;">
                <div class="row justify-content-center">
                <div class="col-lg-4">
                <a href="engine?type=cash_dep&options=<?php print_r($encoded)?>"><img width="120px" src="img/cash_dep.png">
                    <h5>Cash Deposit</h5>
                </a>
                </div>
                <div class="col-lg-4">
                    <a href="engine?topup=<?php print_r(base64_encode($refOnTopUp));?>&amount=<?php print_r(base64_encode($amount));?>">
                    <img src="img/instant_eft.png">
                        <br/>
                        <br/>
                        <h5 class="text-center">Instant Eft</h5>
                    </a>
                </div>
                <div class="col-lg-4">
                    <img src="img/Bitcoin_Accepted_Here_Business_Sign_Horizontal-2400px.png">
                    <br/>
                    <h5>Bitcoin Coming Soon</h5>
                </div>
                </div>
            </div>

            </div>
        </div>

    </section>
    </div>
<?php
require_once 'footer.php';
?>
</body>
</html>