<?php
if(isset($_GET['to']) || (isset($_GET['d']) && isset($_GET['c']))){
    $mvc = new MVCcontroller();
    if(isset($_GET['to'])){
        $mvc->include_modules('login/verify_account/empty');
    }else{
        $mvc->include_modules('login/verify_account/verify');
    }
}else{
    header('Location: /cuenta/login/');
}