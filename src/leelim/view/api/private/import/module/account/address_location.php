<?php
$mvc = new MVCcontroller();

if($_GET['method'] == 'delete'){
    if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1){
        if($mvc->delete_account_address_location($_POST['id'])){
            $mvc->API_response(200, '"ADDRESS_DELETED"');
        }else{
            $mvc->API_response(500, '"SERVER_ERROR"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_ID"');
    }
}else{
    if($_GET['method'] == 'post' || $_GET['method'] == 'put'){
        function isset_all(){
            $key = ['name', 'surname', 'phone-number', 'street', 'number', 'city', 'postal-code'];
            for ($i = 0; $i < count($key); $i++) { 
                if(!isset($_POST[$key[$i]]) || empty($_POST[$key[$i]])){
                    return false;
                }
            }
            return true;
        }
        if(isset_all()){
            $json = $mvc->prepare_account_address_json($_POST);
            if($_GET['method'] == 'put'){
                if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1){
                    if(!$mvc->modify_account_address_location($json, $_POST['id'])){
                        $mvc->API_response(500, '"SERVER_ERROR"');
                    }else{
                        $id = $_POST['id'];
                    }
                }else{
                    $mvc->API_response(400, '"WRONG_ID"');
                }
            }else{
                if(!$mvc->add_account_address_location($json)){
                    $mvc->API_response(500, '"SERVER_ERROR"');
                }else{
                    $id = count($_SESSION['account']['data']['address_location'])-1;
                }
            }
            $response = ["index" => $id, "json" => $json];
            $mvc->API_response(200, json_encode($response));
        }else{
            $mvc->API_response(400, '"SOME_FIELD_EMPTY"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_METHOD"');
    }
}