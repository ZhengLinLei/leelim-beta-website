<?php
$mvc = new MVCcontroller();
if(isset($_POST['id_employer']) && !empty($_POST['id_employer'])){
    if(isset($_POST['password']) && !empty($_POST['password'])){
        if($mvc->select_account($_POST['id_employer'], $_POST['password'], true, true)){
            $mvc->API_response(200, '{"location": "/"}');
        }else{
            $mvc->API_response(404, '"USER_NOT_FOUND"');
        }
    }else{
        $mvc->API_response(400, '"PASSWORD_REQUIRED"');
    }
}else{
    $mvc->API_response(400, '"ID_REQUIRED"');
}
