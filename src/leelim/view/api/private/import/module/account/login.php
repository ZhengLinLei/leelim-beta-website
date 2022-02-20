<?php
$mvc = new MVCcontroller();
if(isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    if(isset($_POST['password']) && !empty($_POST['password'])){
        if($mvc->select_account($_POST['email'], $_POST['password'], true, true)){
            $mvc->API_response(200, '{"location": "/cuenta/"}');
        }else{
            $mvc->API_response(404, '"USER_NOT_FOUND"');
        }
    }else{
        $mvc->API_response(400, '"PASSWORD_REQUIRED"');
    }
}else{
    $mvc->API_response(400, '"EMAIL_REQUIRED"');
}
