<?php
$mvc = new MVCcontroller();
function validate(){
    $count = 0;
    $arr = ['id_order', 'order_code'];

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
    if($mvc->update_order_pack_status($_POST['id_order'], $_POST['order_code'])){
        $mvc->API_response(200, '"UPDATED_CORRECTLY"');
    }else{
        $mvc->API_response(500, '"SERVER_ERROR"');
    }
}else{
    $mvc->API_response(400, '"SOME_EMPTY_FIELDS"');
}