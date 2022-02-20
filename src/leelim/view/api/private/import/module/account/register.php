<?php
$mvc = new MVCcontroller();
if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    if(isset($_POST['password']) && !empty($_POST['password'])){
        if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['surname']) && !empty($_POST['surname']) && (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']))){
            if($mvc->birthday_control($_POST['day'], $_POST['month'], $_POST['year'])){
                if(isset($_POST['term-accept']) && $_POST['term-accept'] === 'on'){
                    if(!$mvc->isset_account($_POST['email'])){
                        if($mvc->create_account($_POST)){
                            $mvc->API_response(200, '{"location": "/cuenta/verify-account/?to='.$_POST['email'].'"}');
                        }else{
                            $mvc->API_response(500, '"CREATING_ACCOUNT_SECTION_WRONG"');
                        }
                    }else{
                        $mvc->API_response(900, '"EMAIL_REGISTERED"'); // INNER STATUS 900 = isset
                    }
                }else{
                    $mvc->API_response(400, '"CHECKBOX_MISS[TERMS]"');
                }
            }else{
                $mvc->API_response(400, '"BIRTHDAY_ERROR"');
            }
        }else{
            $mvc->API_response(400, '"NAME&SURNAME&BIRTHDAY_REQUIRED"');
        }
    }else{
        $mvc->API_response(400, '"PASSWORD_REQUIRED"');
    }
}else{
    $mvc->API_response(400, '"EMAIL_REQUIRED"');
}