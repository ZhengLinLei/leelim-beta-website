<?php
$arr_accept = ['tag', 'gallery'];
//VERIFYY
if(isset($_GET['page']) && !empty($_GET['page']) && in_array($_GET['page'], $arr_accept)){
    $mvc = new MVCcontroller();
    $mvc->include_modules_api('season/'.$_GET['page']);
}else{
    header('HTTP/1.0 400 Bad Request', true, 400);
    die();
}