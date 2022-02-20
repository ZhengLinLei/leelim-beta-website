<?php
$mvc = new MVCcontroller();
function isset_all(){
    $key = ['name', 'title', 'content'];
    for ($i = 0; $i < count($key); $i++) { 
        if(!isset($_POST[$key[$i]]) || empty($_POST[$key[$i]])){
            return false;
        }
    }
    return true;
}
function check_time(){
    if(isset($_SESSION['contact_submit']['unix'])){
        if((time() - $_SESSION['contact_submit']['unix']) < 180){
            return false;
        }
    }
    $_SESSION['contact_submit']['unix'] = time();
    return true;
}
if((isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (isset($_POST['phone-number']) && preg_match("/^[6-9]{1}[0-9]{8}$/", $_POST['phone-number']))){
    if(isset_all()){
        if(check_time()){
            if($mvc->contact_message($_POST)){
                $mvc->API_response(200, '"ACCEPTED"');
            }else{
                $mvc->API_response(500, '"SERVER_DENIED"');
            }
        }else{
            $mvc->API_response(900, '"WAIT_3_MINUTES"'); // INNER STATUS 900 = isset
        }
    }else{
        $mvc->API_response(400, '"SOME_FIELD_EMPTY"');
    }
}else{
    $mvc->API_response(400, '"EMAIL_PHONE_INCORRECT"');
}
