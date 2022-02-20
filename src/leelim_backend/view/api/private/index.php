<?php
session_start();

header('Content-type:application/json;charset=utf-8'); 

include_once "../../../controller/controller.php";
include_once "../../../model/model.php";

if(isset($_POST) || isset($_GET)){
    if(((isset($_POST['keycode']) && $_POST['keycode'] == $_SESSION['csrf_keycode_backend']) || isset($_GET['keycode']) && $_GET['keycode'] == $_SESSION['csrf_keycode_backend']) && (isset($_GET['template']) && !empty($_GET['template']))){
        $mvc = new MVCcontroller();
        $mvc->include_template_api($_GET['template']);
    }else{
        header('HTTP/1.0 401 Unauthorized', true, 401);
    }
}