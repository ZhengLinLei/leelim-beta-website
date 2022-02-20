<?php
$mvc = new MVCcontroller();
if(isset($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['old_password']) && !empty($_POST['new_password'])){
    if($_POST['old_password'] == $_SESSION['employer_account']['data']['password']){
        if($mvc->change_account_password($_POST['new_password'])){
            $_SESSION['employer_account']['data']['password'] = $_POST['new_password'];
            $mvc->API_response(200, '"PASSWORD_CHANGED"');
        }else{
            $mvc->API_response(500, '"SERVER_ERROR"');
        }
    }else{
        $mvc->API_response(400, '"OLD_PASSWORD_NOT_SAME"');
    }
}else{
    $mvc->API_response(400, '"EMPTY_FIELDS"');
}
