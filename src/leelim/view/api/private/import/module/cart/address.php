<?php
$mvc = new MVCcontroller();
if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    if(isset($_POST['data'])){
        $json = json_decode($_POST['data']);
        //
        $_SESSION['order_address'] = ["address" => $json, "email" => $_POST['email']];
        $mvc->API_response(200, '"/carrito/pagar/?c='.$_SESSION['order_code'].'"');
    }else{
        $mvc->API_response(400, '"JSON_REQUIRED"');
    }
}else{
    $mvc->API_response(400, '"EMAIL_REQUIRED"');
}