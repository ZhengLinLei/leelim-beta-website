<?php
$mvc = new MVCcontroller();
function validate(){
    $count = 0;
    $arr = ['from', 'fromName', 'to', 'subject', 'content'];

    foreach ($arr as $key => $value) {
        if(isset($_POST[$value])){
            $count = $count +1;
        }
    }
    if($count == count($arr)){
        return true;
    }
    return false;
}
if(validate()){
    if($mvc->send_inner_email($_POST['to'], $_POST['from'], $_POST['fromName'], $_POST['subject'], $_POST['content'])){
        $mvc->API_response(200, '"EMAIL_SENDED_CORRECTLY"');
    }else{
        $mvc->API_response(500, '"SERVER_ERROR"');
    }
}else{
    $mvc->API_response(400, '"SOME_EMPTY_FIELDS"');
}