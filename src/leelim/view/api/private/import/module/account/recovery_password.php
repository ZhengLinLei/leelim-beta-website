<?php
$mvc = new MVCcontroller();
if (isset($_GET['method'])) {
    if ($_GET['method'] == 'get') {
        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $account = $mvc->isset_account($_POST['email']);
            if ($account) {
                if ($mvc->recovery_account_password($account)) {
                    $mvc->API_response(200, '"RECOVERY_EMAIL_SENT"');
                }
                $mvc->API_response(500, '"SERVER_ERROR"');
            } else {
                $mvc->API_response(901, '"EMAIL_NOT_FOUND"'); //901 = NOT SET, 900 = ISSET
            }
        } else {
            $mvc->API_response(400, '"EMAIL_REQUIRED"');
        }
    } else if ($_GET['method'] == 'post') {
        if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['code'])) {
            if($mvc->change_recovery_account_password($_POST['email'], $_POST['code'], $_POST['password'])){
                $mvc->API_response(200, '"PASSWORD_CHANGED"');
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        } else {
            $mvc->API_response(400, '"PASSWORD_REQUIRED"');
        }
    }
} else {
    $mvc->API_response(400, '"METHOD_REQUIRED"');
}
