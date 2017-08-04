<?php


$deploy = 'live';

if($deploy=="live")

{

    $api = new RestClient([
       // 'base_url' => "http://api.laybycafe.com/v1.1",
        'base_url' => "https://v2.laybycafe.com/v2.0",

    ]);
}
if($deploy=="demo"){

    $api = new RestClient([
        'base_url' => "http://api.saitws.co.za/v1.1",

    ]);

}

if($deploy=="debug"){

    $api = new RestClient([
        'base_url' => "http://localhost/api/v1.1",

    ]);
}

define('CLEF_BASE_URL', 'https://clef.io/api/v1/');
define('APP_ID', 'e2357a69c1192d2772fde06121071a07');
define('APP_SECRET', '9657b7ad20803109a304dce082452337');


function validate_state($state) {
    $is_valid = isset($_SESSION['state']) && strlen($_SESSION['state']) > 0 && $_SESSION['state'] == $state;
    if (!$is_valid) {
        header('HTTP/1.0 403 Forbidden');
        echo "The state parameter didn't match what was passed in to the Clef button.";
        exit;
    } else {
        unset($_SESSION['state']);
    }
    return $is_valid;
}
if (!session_id()) {
    session_start();
}
if (isset($_GET["code"]) && $_GET["code"] != "") {
    validate_state($_GET["state"]);
    \Clef\Clef::initialize(APP_ID, APP_SECRET);

    try {
        $response = \Clef\Clef::get_login_information($_GET["code"]);

        $result = $response->info;

        // reset the user's session
        if (isset($result->id) && ($result->id != '')) {
            //remove all the variables in the session
            session_unset();
            // destroy the session
            session_destroy();
            if (!session_id())
                session_start();

            $clef_id = $result->id;
            $first_name     = $result->first_name .' '. $result->last_name;
            $email    = $result->email;

            $data = array(
                'clef_id' => $clef_id,
                'email' => $email,
            );

            $result = $api->post("/clef", $data);

            $user = $result->response;

            $userInfo = json_decode($user);
            //Gets ID//
            $MerchantId = $userInfo->merchant_id;
            //Gets Role//
            $role = $userInfo->role;

            $code = @$error->code;

            // send them to the member's area!

            if($code == 500){
                $user_login->redirect('login?error');
            }
            else
            {
                $_SESSION['userSession'] = $MerchantId;
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
    } catch (Exception $e) {
        echo "Login with Clef failed: " . $e->getMessage();
    }
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function generate_state_parameter() {
    if (isset($_SESSION['state'])) {
        return $_SESSION['state'];
    } else {
        $state = base64url_encode(openssl_random_pseudo_bytes(32));
        $_SESSION['state'] = $state;
        return $state;
    }
}
if (!session_id()) {
    session_start();
}
$state = generate_state_parameter();
?>