<?php
if(isset($_POST['d']) && filter_var($_POST['d'], FILTER_VALIDATE_EMAIL)){
    $mvc = new MVCcontroller();
    $response = $mvc->verify_email_account($_POST['c'], $_POST['d']); //c for 'code' and d for destination where is the email address
    switch ($response) {
        case 0:
            $mvc->API_response(500, '"ERROR"');
            break;
        case 1:
            if($mvc->isset_account_session()){
                $_SESSION['account']['data']['verify_account'] = 0;
            }
            $mvc->API_response(200, '"VERIFIED_CORRECTLY"');
        case 2:
            $mvc->API_response(900, '"VERIFIED_BEFORE"');
            break;
        case 3:
            $mvc->API_response(901, '"NOT_REGISTERED"'); //901 = NOT SET, 900 = ISSET
            break;
    }
    // 0 => error server, 1 => ok, 2 => verified, 3 => wrong email (not registered)
}else{
    $mvc->API_response(400, '"EMAIL_REQUIRED"');
}