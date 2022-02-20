<?php
$mvc = new MVCcontroller();
if(!isset($_SESSION['calculator'])){
    $_SESSION['calculator'] = true;
}
if($_GET['method'] == 'delete'){
    //
    $_SESSION['calculator'] = false;
    $mvc->API_response(200, '"DISABLE"');
}elseif($_GET['method'] == 'post'){
    //
    $_SESSION['calculator'] = true;
    $mvc->API_response(200, '"ACTIVE"');
}