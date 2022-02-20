<?php
$mvc = new MVCcontroller();
if(isset($_GET['type']) && isset($_GET['method'])){
    //
    if($_GET['type'] == 'credit-card'){
        //INCLUDE STRIPE API SDK
        require '../../../model/stripe-php/init.php';
        //PRIVATE KEY
        $key = 'sk_test_51Ihgw6J9HHZbmVICIuwN4usvDGSSNbxx9GPkaygf0ubDdGFrWPJOAy69awPaNz5en3bdBZnyjQa3MEHfqOhBHVp600bp1L****'; // ! PUT YOUR STRPE PRIVATE KEY
        //DEFINE
        $stripe = new \Stripe\StripeClient($key);
        if($_GET['method'] == 'get'){
            if(isset($_SESSION['stripe_payment_info']) && $_SESSION['stripe_payment_info']['total_amount'] == $_SESSION['order_info']['total']){
                //RETURN SET BEFORE CÑLIENT_SECRET 
                $output = ['clientSecret' => $_SESSION['stripe_payment_info']['client_secret']];
            }else{
                try {
                    $total_amount = ($_SESSION['order_info']['total'] * 100);
    
                    $paymentIntent = $stripe->paymentIntents->create([
                        'amount' => $total_amount,
                        'currency' => 'eur',
                        'payment_method_types' => ['card'],
                        'statement_descriptor_suffix' => 'LEE LIM - Online'
                    ]);
                    //SAVE TO SESSION
                    //REMEMBER TO CLEAN THE SESSION ADATA AFTER PAYYMENT 
                    $_SESSION['stripe_payment_info'] = ['total_amount' => $_SESSION['order_info']['total'], 'client_secret' => $paymentIntent->client_secret, 'id' => $paymentIntent->id];
                    //
                    $output = ['clientSecret' => $paymentIntent->client_secret];
                } catch (Error $e) {
                    $mvc->API_response(500, '"SERVER_ERROR"');
                }
            }
            $mvc->API_response(200, json_encode($output)); 
        }else if($_GET['method'] == 'post'){
            if(isset($_POST['payment_itents_id']) && isset($_POST['billing_format'])){
                //
                $id = $_POST['payment_itents_id'];
                //
                try {
                    //BILLING ADDRESS
                    if($_POST['billing_format'] == 'same'){
                        $arr = [];

                        $key_billing_address = ['name', 'surname', 'street', 'number', 'postal_code', 'city'];
                        foreach ($key_billing_address as $value) {
                            $arr[$value] = $_SESSION['order_address']['address']->$value;
                        }
                        
                        $_SESSION['order_billing_address'] = $arr;
                    }else{
                        try{
                            $_SESSION['order_billing_address'] = json_decode($_POST['billing_address']);
                        }catch (Error $e){
                            $mvc->API_response(901, '"OTHER_BILLING_ADDRESS_REQUIRED"'); //901 = NOT SET, 900 = ISSET
                        }
                    }
                    //---------
                    $payment = $stripe->paymentIntents->retrieve(
                        $id,
                        []
                    );
                    //check if payment succeded
                    if($payment->status == 'succeeded'){
                        $order_code = $mvc->save_order_history($_GET['type'], $_POST['order_details'], $payment, $mvc->isset_account_session());

                        if($order_code){
                            try{
                                $response = $stripe->paymentIntents->update(
                                    $id,
                                    ['metadata' => ['order_id' => $order_code, 'client_email' => $_SESSION['order_address']['email']]]
                                );
                                if($response){
                                    if($mvc->order_completed_save($order_code)){ //SEND EMAIL AND RESET
                                        $mvc->API_response(200, '{"order_code": "'.$order_code.'"}');
                                    }
                                    $mvc->API_response(500, '"EMAIL_SECTION_ERROR"');
                                }else{
                                    $mvc->API_response(500, '"GETTING_UPDATE_ERROR"');
                                }
                            }catch (Error $e){
                                $mvc->API_response(500, '"UPDATING_PAYMENT_ERROR"');
                            }
                        }else{
                            $mvc->API_response(500, '"SAVING_ORDER_ERROR"');
                        }
                    }else{
                        $mvc->API_response(500, '"PAYMENT_INTENTS_ID_ERROR"');
                    }
                } catch (Error $e) {
                    $mvc->API_response(500, '"SERVER_TO_GET_PAYMENT_INTENTS_ID_ERROR"');
                }
            }else{
                $mvc->API_response(400, '"PAYMENT_INTETS_ID_REQUIRED"');
            }
        }
    }elseif($_GET['type'] == 'paypal'){
        $key_id = 'AWiyKSXaWWWBVzIxwzpRiYERzrxf7VjtQ9lDzojx9Qr1nA3ff3g4LjgwPDYCQ2uJGg2W4ci08649****'; // ! YOUR PAYPAL ID KEY
        //PRIVATE KEY
        $key = 'EPbI_vnbeCedt41gb-C20euY6mbi7v3BvAQGeF2CoXTH3i0Z-mKse-nIk9kxrA_urpnrACUaqeKb****'; // ! YOUR PAYPAL PRIVATE KEY
        if($_GET['method'] == 'post'){
            if(isset($_POST['payment_itents_id']) && isset($_POST['billing_format'])){
                //
                $id = $_POST['payment_itents_id'];
                //
                function validate($paymentID, $pk, $sk){ 
                    $ch = curl_init(); 
                    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token'); 
                    curl_setopt($ch, CURLOPT_HEADER, false); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
                    curl_setopt($ch, CURLOPT_POST, true); 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_USERPWD, $pk.":".$sk); 
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); 
                    $response = curl_exec($ch); 
                    curl_close($ch); 
                    
                    if(empty($response)){ 
                        return false; 
                    }else{ 
                        $jsonData = json_decode($response); 
                        $curl = curl_init('https://api.sandbox.paypal.com/v2/checkout/orders/'.$paymentID); 
                        curl_setopt($curl, CURLOPT_POST, false); 
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
                        curl_setopt($curl, CURLOPT_HEADER, false); 
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array( 
                            'Authorization: Bearer ' . $jsonData->access_token, 
                            'Accept: application/json', 
                            'Content-Type: application/xml' 
                        )); 
                        $response = curl_exec($curl); 
                        curl_close($curl); 
                        
                        // Transaction data
                        $result = json_decode($response); 
                        
                        if(isset($result->debug_id)){ //IF DEBUG_ID ISSET, IS BECAUSE THERE ARE AN ERROR
                            return false;
                        }
                        return $result; 
                    }
                }
                try {
                    //BILLING ADDRESS
                    if($_POST['billing_format'] == 'same'){
                        $arr = [];

                        $key_billing_address = ['name', 'surname', 'street', 'number', 'postal_code', 'city'];
                        foreach ($key_billing_address as $value) {
                            $arr[$value] = $_SESSION['order_address']['address']->$value;
                        }
                        
                        $_SESSION['order_billing_address'] = $arr;
                    }else{
                        try{
                            $_SESSION['order_billing_address'] = json_decode($_POST['billing_address']);
                        }catch (Error $e){
                            $mvc->API_response(901, '"OTHER_BILLING_ADDRESS_REQUIRED"'); //901 = NOT SET, 900 = ISSET
                        }
                    }
                    //-------
                    $payment = validate($id, $key_id, $key);
                    //check if payment succeded
                    if($payment->status == 'COMPLETED'){
                        $order_code = $mvc->save_order_history($_GET['type'], $_POST['order_details'], $payment, $mvc->isset_account_session());
                        if($order_code){
                            try{
                                if($mvc->order_completed_save($order_code)){ //SEND EMAIL AND RESET
                                    $mvc->API_response(200, '{"order_code": "'.$order_code.'"}');
                                }
                                $mvc->API_response(500, '"EMAIL_SECTION_ERROR"');
                            }catch (Error $e){
                                $mvc->API_response(500, '"UPDATING_PAYMENT_ERROR"');
                            }
                        }else{
                            $mvc->API_response(500, '"SAVING_ORDER_ERROR"');
                        }
                    }else{
                        $mvc->API_response(500, '"PAYMENT_INTENTS_ID_ERROR"');
                    }
                } catch (Error $e) {
                    $mvc->API_response(500, '"SERVER_TO_GET_PAYMENT_INTENTS_ID_ERROR"'.$e.'');
                }
            }else{
                $mvc->API_response(400, '"PAYMENT_INTETS_ID_REQUIRED"');
            }
        }
    }elseif($_GET['type'] == 'wallet'){
        if($_GET['method'] == 'post'){
            if($_SESSION['order_info']['total'] <= $_SESSION['account']['data']['wallet']){
                try {
                    //BILLING ADDRESS
                    if($_POST['billing_format'] == 'same'){
                        $arr = [];

                        $key_billing_address = ['name', 'surname', 'street', 'number', 'postal_code', 'city'];
                        foreach ($key_billing_address as $value) {
                            $arr[$value] = $_SESSION['order_address']['address']->$value;
                        }
                        
                        $_SESSION['order_billing_address'] = $arr;
                    }else{
                        try{
                            $_SESSION['order_billing_address'] = json_decode($_POST['billing_address']);
                        }catch (Error $e){
                            $mvc->API_response(901, '"OTHER_BILLING_ADDRESS_REQUIRED"'); //901 = NOT SET, 900 = ISSET
                        }
                    }
                    //-------
                    $payment = ['id' => 'PAY'.time().$_SESSION['account']['data']['id'].'ES', 'payer_id' => $_SESSION['account']['data']['id']];
                    $order_code = $mvc->save_order_history($_GET['type'], $_POST['order_details'], $payment, $mvc->isset_account_session());
                    if($order_code){
                        try{
                            if($mvc->save_use_wallet_history($order_code, $payment)){ //CALCULATE ALL AND SAVE TO DB
                                if($mvc->order_completed_save($order_code)){ //SEND EMAIL AND RESET
                                    $mvc->API_response(200, '{"order_code": "'.$order_code.'"}');
                                }
                                $mvc->API_response(500, '"EMAIL_SECTION_ERROR"');
                            }else{
                                $mvc->API_response(500, '"ORDER_WALLET_HISTORY_NOT_SAVED"');
                            }
                        }catch (Error $e){
                            $mvc->API_response(500, '"UPDATING_PAYMENT_ERROR"');
                        }
                    }else{
                        $mvc->API_response(500, '"SAVING_ORDER_ERROR"');
                    }
                } catch (Error $e) {
                    $mvc->API_response(500, '"SERVER_TO_GET_PAYMENT_INTENTS_ID_ERROR"'.$e.'');
                }
            }else{
                $response = ['total' => number_format($_SESSION['order_info']['total'], 2, '.', ''), 'wallet' => number_format($_SESSION['account']['data']['wallet'], 2, '.', '')];
                $mvc->API_response(901, json_encode($response)); //901 = NOT SET, 900 = ISSET
            }
        }
    }
}else{
    $mvc->API_response(400, '"TYPE&METHOD_REQUIRED"');
}