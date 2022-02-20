<?php
$mvc = new MVCcontroller();
if(isset($_GET['d']) && isset($_GET['c'])){
    if($mvc->isset_recovery_account_password($_GET['d'], $_GET['c'])){
        $mvc->include_modules('login/recovery/verify');
    }else{
        $mvc->include_modules('login/recovery/not_allowed');
    }
}else{
    $mvc->include_modules('login/recovery/empty');
}