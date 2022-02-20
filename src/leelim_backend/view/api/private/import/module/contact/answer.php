<?php
$mvc = new MVCcontroller();

$accept_answer = ['email', 'tel'];
if(isset($_POST['answer']) && in_array($_POST['answer'], $accept_answer) && isset($_POST['id']) && is_numeric($_POST['id'])){
    if($mvc->update_contact_status($_POST['id'], $_POST['answer'])){
        $_SESSION['contact_message_unseen']['count'] = $_SESSION['contact_message_unseen']['count'] -1;
        //
        foreach ($_SESSION['contact_message_unseen']['data'] as $key => $value) {
            if($value['id'] == $_POST['id']){
                $id = $key;
            }
        }
        //
        if(isset($id)){
            array_splice($_SESSION['contact_message_unseen']['data'], $id, 1);
        }
        $mvc->API_response(200, '"UPDATED_CORRECTLY"');
    }else{
        $mvc->API_response(500, '"SERVER_ERROR"');
    }
}else{
    $mvc->API_response(400, '"SOME_EMPTY_FIELDS"');
}