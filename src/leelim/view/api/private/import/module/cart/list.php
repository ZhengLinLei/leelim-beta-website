<?php
$mvc = new MVCcontroller();

if($_GET['method'] == 'delete'){
    if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1){
        if($mvc->delete_cart_item($_POST['id'])){
            $mvc->API_response(200, '"ITEM_DELETED_FROM_CART"');
        }else{
            $mvc->API_response(500, '"SERVER_ERROR"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_ID"');
    }
}else{
    if($_GET['method'] == 'post' || $_GET['method'] == 'put'){
        if($_GET['method'] == 'post'){
            //{id, code, image, name, price], amount, size, color
            $json = json_decode($_POST['data']);
            if($mvc->add_cart_item($json)){
                $return_response = [];
                //
                foreach ($_SESSION['cart'] as $key => $value) {
                    $arr = ['image' => $value->item->image, 'amount' => $value->amount];
                    array_push($return_response, $arr);
                }
                //
                $json = json_encode($return_response);
                $mvc->API_response(200, $json);
            }else{
                $mvc->API_response(500, '"SERVER_ERROR"');
            }
        }
        if($_GET['method'] == 'put'){
            if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1 && isset($_POST['amount']) && is_numeric($_POST['amount']) && $_POST['amount'] > -1){
                if($mvc->update_cart_item($_POST['id'], $_POST['amount'])){
                    $mvc->API_response(200, $_SESSION['cart'][$_POST['id']]->item->price);
                }else{
                    $mvc->API_response(500, '"SERVER_ERROR"');
                }
            }else{
                $mvc->API_response(400, '"WRONG_ID&AMOUNT"');
            }
        }
    }else{
        $mvc->API_response(400, '"WRONG_METHOD"');
    }
}