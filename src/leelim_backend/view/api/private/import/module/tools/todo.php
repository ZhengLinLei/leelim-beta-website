<?php
$mvc = new MVCcontroller();
if(isset($_GET['type']) && $_GET['type'] == 'status'){
    if($_GET['method'] == 'put'){
        if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1 && isset($_POST['value'])){
            if($mvc->update_account_todo_list_status($_POST['id'], intval($_POST['value']))){
                $mvc->API_response(200, '"ITEM_STATUS_UPDATE"');
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        }else{
            $mvc->API_response(400, '"WRONG_ID"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_METHOD"');
    }
}else{
    if($_GET['method'] == 'delete'){
        if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1){
            if($mvc->delete_account_todo_list($_POST['id'])){
                $mvc->API_response(200, '"ITEM_DELETED"');
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        }else{
            $mvc->API_response(400, '"WRONG_ID"');
        }
    }else
    if($_GET['method'] == 'post' || $_GET['method'] == 'put'){
        function isset_all(){
            $key = ['name', 'description'];
            for ($i = 0; $i < count($key); $i++) { 
                if(!isset($_POST[$key[$i]]) || empty($_POST[$key[$i]])){
                    return false;
                }
            }
            return true;
        }
        if(isset_all()){
            $json = $mvc->prepare_account_todo_list_json($_POST);
            if($_GET['method'] == 'put'){
                if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1){
                    if(!$mvc->modify_account_todo_list($json, $_POST['id'])){
                        $mvc->API_response(500, '"SERVER_ERROR"');
                    }else{
                        $id = $_POST['id'];
                    }
                }else{
                    $mvc->API_response(400, '"WRONG_ID"');
                }
            }else{
                if(!$mvc->add_account_todo_list($json)){
                    $mvc->API_response(500, '"SERVER_ERROR"');
                }else{
                    $id = count($_SESSION['employer_account']['data']['todo_list'])-1;
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