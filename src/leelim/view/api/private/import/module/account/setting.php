<?php
$mvc = new MVCcontroller();
switch ($_GET['option']) {
    case 'email':
        if(isset($_POST['value']) && ($_POST['value'] == 0 || $_POST['value'] == 1)){
            if($mvc->save_value_to_db('receive_information', $_POST['value'])){
                $_SESSION['account']['data']['receive_information'] = $_POST['value'];
                $mvc->API_response(200, $_POST['value']);
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        }else{
            $mvc->API_response(400, '"EMPTY_VALUE"');
        }
        break;
    case 'personal-data':
        if(isset($_POST['name']) && isset($_POST['surname'])){
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);

            if($mvc->save_value_to_db('name', $name) && $mvc->save_value_to_db('surname', $surname)){
                $_SESSION['account']['data']['name'] = $name;
                $_SESSION['account']['data']['surname'] = $surname;

                $response_arr = ['name' => $name, 'surname' => $surname];
                $mvc->API_response(200, json_encode($response_arr));
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        }else{
            $mvc->API_response(400,'"NAME&SURNAME_REQUIRED"');
        }
        break;
    case 'new-password':
        if(isset($_POST['old-password']) && isset($_POST['new-password'])){
            if($_POST['old-password'] === $_SESSION['account']['data']['password']){
                if($_POST['new-password'] === $_SESSION['account']['data']['password']){
                    if($mvc->modify_account_password($_POST['new-password'])){
                        $_SESSION['account']['data']['new-password'] = $_POST['new-password'];
        
                        $mvc->API_response(200, '"PASSWORD_CHANGED_CORRECTLY"');
                    }else{
                        $mvc->API_response(500, '"SERVER_ERROR"');
                    }
                }else{
                    $mvc->API_response(900,'"NEWPASSWORD_SAME_AS_OLD"');  //901 = NOT SET, 900 = ISSET, 902 = NOT SAME
                }
            }else{
                $mvc->API_response(902,'"OLDPASSWORD_NOT_SAME"');  //901 = NOT SET, 900 = ISSET, 902 = NOT SAME
            }
        }else{
            $mvc->API_response(400,'"NAME&SURNAME_REQUIRED"');
        }
        break;
    default:
        $mvc->API_response(400, '"WRONG_OPTION"');
        break;
}