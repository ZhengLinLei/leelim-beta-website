<?php
session_start();

header('Content-type:application/json;charset=utf-8'); 

include_once "../../../controller/controller.php";
include_once "../../../model/model.php";

if(isset($_POST) || isset($_GET)){
    $mvc = new MVCcontroller();
    if(((isset($_POST['keycode']) && $_POST['keycode'] == $_SESSION['csrf_keycode']) || isset($_GET['keycode']) && $_GET['keycode'] == $_SESSION['csrf_keycode']) && (isset($_GET['template']) && !empty($_GET['template']))){
        $mvc->include_template_api($_GET['template']);
    }else{
        header('HTTP/1.0 401 Unauthorized', true, 401);
        $mvc->API_response(401, '"TOKEN_EXPIRED_PLEASE_RELOAD"');
    }
}