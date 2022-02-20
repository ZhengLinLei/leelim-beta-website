<?php
class MVCcontroller{
    function __construct(){
        $this->MVCmodel = new MVCmodelDB();
    }
    //get ip
    function get_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
    function prepare_all($type = false){
        //CART
        if($type){
            if(!isset($_SESSION['cart'])){
                if($this->isset_account_session()){
                    $_SESSION['cart'] = $_SESSION['account']['data']['cart'];
                }else{
                    $_SESSION['cart'] = [];
                }
            }
        }else{
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = $_SESSION['account']['data']['cart'];
            }
        }
        
        return true;
    }
    function clear_cookies($name){
        unset($_COOKIE[$name]); 
        setcookie($name, null, -1, '/'); 
        return true;
    }
    function account_middleware($type){
        //检查账号开启
        if($type){
            if($this->isset_account_session()){
                return true;
            }
            header('Location: /cuenta/login/?r='.urlencode($_SERVER['REQUEST_URI']));
            die();
        }else{
            if($this->isset_account_session()){
                header('Location: /cuenta/');
                die();
            }
            return true;
        }
        return false;   
    }
    function return_status_not_found(){
        header("HTTP/1.0 404 Not Found", true, 404);
        http_response_code(404);

        die();
    }
    function isset_account_session(){
        if(isset($_SESSION['account']) && $_SESSION['account']['active'] && !empty($_SESSION['account']['data'])){
            return true;
        }
        return false;
    }
    function include_template($type="home"){
        //Include public template 加入文件标题
        include_once "./view/template/$type.php";
    }
    function include_modules($module="component/header"){
        //Include public modules 加入模块
        include_once "./view/import/$module.php";
    }
    function API_response($status, $response){
        die('{"client": {"POST": '.json_encode($_POST).', "GET": "'.implode('/', $_GET).'"}, "server": {"status": '.$status.', "response": '.$response.'}}');
    }
    //API
    function include_template_api($template){
        //Include api template 加入文件标题
        include_once "./import/template/$template.php";
    }
    function include_modules_api($module){
        //Include api modules 加入模块
        include_once "./import/module/$module.php";
    }
    //DATABASE
    public function prepare_account_session($data, $save_cookies = false){
        //-----------
        $_SESSION['account'] = ['active' => true, 'data' => $data];
        //json
        $to_json_key = ['cart', 'address_location', 'wallet_history'];
        foreach ($to_json_key as $value) {
            $_SESSION['account']['data'][$value] = json_decode($_SESSION['account']['data'][$value]);
        }
        if($save_cookies){
            //SAVE EMAIL
            $arr = [base64_encode('email') => base64_encode($data['email']), base64_encode('password') => base64_encode($data['password'])];
            $arr_json = json_encode($arr);
            $arr_json_encode = base64_encode($arr_json);

            setcookie ('login_information' , $arr_json_encode , strtotime( '+30 days' ), '/', '', false, true);
        }
        //PREPARE CART SESSION
        $this->prepare_all();
        //---
        return true;
    }
    function select_account($email, $password, $save_session = false, $save_cookies = false){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM `user_account` WHERE `email` = :email AND `password` = :password_key LIMIT 1";
            $param = [':email' => $email, ':password_key' => $password];
            
            $response = $this->MVCmodel->runQuerySQL($query, $param, true);

            if(!empty($response)){
                if($save_session){
                    return $this->prepare_account_session($response[0], $save_cookies);
                }
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function isset_account($email){
        $query = "SELECT * FROM `user_account` WHERE `email` = :email LIMIT 1";
        $param = [':email' => $email];
        
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);

        if(!empty($response)){
            return $response[0];
        }else{
            return false;
        }
    }
    //LOGIN FROM COOKIES
    function login_from_cookies($cookie){
        try {
            $json = (array) json_decode(base64_decode($cookie));
            $email = base64_decode($json[base64_encode('email')]);
            $password = base64_decode($json[base64_encode('password')]);
            //LOGIN
            if(!$this->select_account($email, $password, true)){
                throw new Exception('ERROR_LOGIN_FROM_COOKIES');
            }
        } catch (Exception $e) {
            $this->clear_cookies('login_information');
            return false;
        }
    }
    function clear_account_session(){
        $_SESSION['account']['active'] = false;
        unset($_SESSION['account']);
        $this->clear_cookies('login_information');

        return true;
    }
    //REGISTER
    function birthday_control($dd, $mm, $yyyy){
        $actual = date('Y.md');
        $user_date = $yyyy.'.'.$dd.$mm;

        $age = round($actual - $user_date);
        if($age >= 14 && $age < 150){
            return true;
        }else{
            return false;
        }
    }
    function create_account($data_arr){
        $user_date = $data_arr['year'].'-'.$data_arr['month'].'-'.$data_arr['day'];
        $verify_code = rand();

        $query = 'INSERT INTO `user_account`(`name`, `surname`, `email`, `password`, `birthday`, `receive_information`, `verify_account`, `user_location`) VALUES (:name, :surname, :email, :password, :birthday, :receive_information, :verify_account, :user_location)';
        $param = [':name' => strip_tags($data_arr['name']), ':surname' => strip_tags($data_arr['surname']), ':email' => $data_arr['email'], ':password' => $data_arr['password'], ':birthday' => $user_date, 'receive_information' => ((isset($data_arr['receive-info-accept']) && $data_arr['receive-info-accept'] == 'on')?1:0), ':verify_account' => $verify_code, ':user_location' => $this->get_ip()];

        if($this->MVCmodel->runQuerySQL($query, $param)){
            return $this->send_verify_email($data_arr['name'], $data_arr['email'], $verify_code);
        }else{
            return false;
        }
    
    }
    //EMAIL
    function send_verify_email($name, $email, $code){
        $html = file_get_contents("./html/email_template/verify_account.html");
        $arr_data = ["email" => $email, "code" => $code];

        foreach ($arr_data as $key => $value) {
            $html =  str_replace("**&".$key."&**", $value, $html);
        }

        if($this->sendMail($email, "LEE LIM", "Bienvenidos a LEELIM, $name", $html)){
            return true;
        }else{
            return false;
        }
    }
    function send_order_completed_email(){
        $html = file_get_contents("./html/email_template/order_completed.html");
        //SIMPLIFY
        $val = $_SESSION['order_success'];
        $arr_data = ["order_code" => $val['order_code'], "name" => $val['address']['address']->name, "surname" => $val['address']['address']->surname, "street" => $val['address']['address']->street, 'number' => $val['address']['address']->number, 'postal_code' => $val['address']['address']->postal_code, 'city' => $val['address']['address']->city,
                     'subtotal' => $val['total']['subtotal'], 'extra' => $val['total']['extra'], 'total' => $val['total']['total']];

        foreach ($arr_data as $key => $value) {
            $html =  str_replace("**&".$key."&**", $value, $html);
        }

        if($this->sendMail($_SESSION['order_success']['email'], "LEE LIM", "LEE LIM - Pedido: ".$_SESSION['order_success']['order_code']." - COMPLETADO", $html)){
            return true;
        }else{
            return false;
        }
    }
    //SEND MAIL
    function sendMail($to, $name, $title, $body){
        $header = 'From: '.$name.' <noreply@leelim.es> ' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion(). "\r\n";
        $header .= 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $title = "=?utf-8?B?".base64_encode($title)."?=\n";

        return mail($to, $title, $body, $header);
    }
    //GET LOCAL SHOP
    function get_local_shop($query){
        $query = "SELECT `name`, `address`, `city`, `latitude` AS `lat`, `longitude` AS `long`, `province`, `postal_code` FROM `local_shop` WHERE `address` LIKE '%$query%' OR `city` LIKE '%$query%' OR `province` LIKE '%$query%' OR `postal_code` LIKE '%$query%'";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    //SUBMIT CONTACT MESSAGE
    function contact_message($data_arr){
        $query = 'INSERT INTO `contact_message`(`name`, `email`, `phone_number`, `title`, content) VALUES (:name, :email, :phone_number, :title, :content)';
        $param = [':name' => $data_arr['name'], ':email' => $data_arr['email'], ':phone_number' => $data_arr['phone-number'], ':title' => $data_arr['title'], ':content' => $data_arr['content']];
        if($this->MVCmodel->runQuerySQL($query, $param)){
            return true;
        }else{
            return false;
        }
    
    }
    //VERIFY EMAIL
    function verify_email_account($code, $email){
        $param = [':email' => $email, ':code' => $code];

        $query = "SELECT * FROM `user_account` WHERE `email` = :email AND `verify_account` = :code LIMIT 1";
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);

        if(!empty($response)){
            $query = "UPDATE `user_account` SET `verify_account`= 0 WHERE `email` = :email AND `verify_account` = :code LIMIT 1";
            if($this->MVCmodel->runQuerySQL($query, $param)){
                return 1;
            }else{
                return 0;
            }
        }else{
            if($this->isset_account($email)){
                return 2;
            }else{
                return 3;
            }
        }
        // 0 => error server, 1 => ok, 2 => verified, 3 => wrong email (not registered)
    }
    //GET ITEM
    //GET INDIVIDUAL ITEM
    function get_individual_product_item($code){
        $query = "SELECT * FROM `product_list` WHERE `product_code` = :code LIMIT 1";
        $param = [':code' => $code];
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);
        return $response;
    }
    function get_group_product_item($codes, $limit){
        $query = 'SELECT * FROM `product_list` WHERE `product_code` IN ("'.$codes.'") LIMIT '.$limit;
        echo $query;
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    //GET ALL ITEM
    function get_search_product_item($search, $pag, $param, $sort, $save_count_in_session){
        //
        $item_per_page = 40;
        //-------
        $master_query = "WHERE (`name` LIKE '%$search%' OR `description` LIKE '%$search%' OR `season` LIKE '%$search%')";
        $key = ['gender', 'group'];
        $db_key = ['gender', 'category'];
        foreach ($key as $index_key => $value_key) {
            if(!empty($param[$value_key])){
                foreach($param[$value_key] as $index => $value){
                    if($index == 0){
                        $master_query .= " AND (`$db_key[$index_key]` = '$value'";
                    }else{
                        $master_query .= " OR `$db_key[$index_key]` = '$value'";
                    }
                }
                $master_query .= ")";
            }
        }
        switch ($sort) {
            case 'best':
                $master_query .= " ORDER BY `order_times` DESC";
                break;
            case 'newest':
                $master_query .= " ORDER BY `id` DESC";
                break;
            case 'priceDesc';
                $master_query .= " ORDER BY `price` DESC";
                break;
            case 'priceAsc';
                $master_query .= " ORDER BY `price` ASC";
                break;
            default:
            case 'priceDesc';
                $master_query .= " ORDER BY `order_times` DESC";
                break;
        }
        //SAVE IN SESSION DATA
        if($save_count_in_session){
            $query = "SELECT count(*) as total_results FROM `product_list` $master_query";
            $response = $this->MVCmodel->runQuerySQL($query, [], true);
            $total_results = $response[0]['total_results'];
            $page = ceil($total_results/$item_per_page);

            $_SESSION['count_search_result'] = ['query' => $search, 'gender' => $param['gender'], 'group' => $param['group'], 'sort' => $sort, 'data' => ['total' => $total_results, 'page' => $page]];
        }
        //------
        $start_item = (($pag == 1)?0:(($pag-1) * $item_per_page));
        //------
        $query = "SELECT * FROM `product_list` $master_query LIMIT $start_item, $item_per_page";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;

        // select count(*) as total_number from product_list
    }
    //GET SUBTOTAL AND TOTAL
    function cart_total_count(){
        $subtotal = 0;
        $extra = 0;
        $total = 0;

        foreach ($_SESSION['cart'] as $key => $value) {
            $subtotal += round(($value->item->price*$value->amount), 2);
        }
        $extra = round($subtotal * (21/100), 2);
        $total = $subtotal + $extra;

        return ['subtotal' => $subtotal, 'extra' => $extra, 'total' => $total];
    }
    //GET RELATED
    function get_related_item($id){
        $query = "SELECT * FROM `product_list` WHERE `id` IN (".($id-2).",".($id-1).",".($id+1).",".($id+2).") LIMIT 4";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    //GET GENDER TOP AND RECENT
    function get_top_recent_gender_item($gender, $type){
        $query = "SELECT * FROM `product_list` WHERE `gender` = :gender";
        if($type == 'top'){
            $query .= " ORDER BY `order_times` DESC";
        }else{
            $query .= " ORDER BY `id` DESC";
        }
        $query .= " LIMIT 4";
        $param = [':gender' => $gender];
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);
        return $response;
    }
    //GET GENDER ALL ITEM
    function get_gender_product_item($gender, $category, $pag, $save_count_in_session){
        //
        $item_per_page = 40;
        //-------
        $master_query = "WHERE `gender` = :gender AND `category` = :category";
        $master_param = [':gender' => $gender, ':category' => $category];
        //SAVE IN SESSION DATA
        if($save_count_in_session){
            $query = "SELECT count(*) as total_results FROM `product_list` $master_query";
            $response = $this->MVCmodel->runQuerySQL($query, $master_param, true);

            $total_results = $response[0]['total_results'];
            $page = ceil($total_results/$item_per_page);

            $_SESSION['count_gender_result'] = ['gender' => $gender, 'group' => $category, 'data' => ['total' => $total_results, 'page' => $page]];
        }
        //------
        $start_item = (($pag == 1)?0:(($pag-1) * $item_per_page));
        //------
        $query = "SELECT * FROM `product_list` $master_query ORDER BY `id` DESC LIMIT $start_item, $item_per_page";
        $response = $this->MVCmodel->runQuerySQL($query, $master_param, true);
        return $response;

        // select count(*) as total_number from product_list
    }
    //--------
    //SAVE JSON TO DB
    function save_json_to_db($column, $value){
        $email = $_SESSION['account']['data']['email'];
        $password = $_SESSION['account']['data']['password'];
        //
        $json = json_encode($value);
        //
        $query = "UPDATE `user_account` SET `$column`= :json WHERE `email` = :email AND `password` = :password";
        $param = [':json' => $json, ':email' => $email, ':password' => $password];
        return $this->MVCmodel->runQuerySQL($query, $param);
    }
    //------
    //CART
    //SAVE CART TO ACCOUNT
    function save_cart_to_account(){
        if($this->isset_account_session()){
            return $this->save_json_to_db('cart', $_SESSION['cart']);
        }
        return true;
    }
    //ADDED BEFORE IN CART
    function added_in_cart($json){
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value->item->id === $json->item->id && $value->color === $json->color && $value->size === $json->size){
                return $key;
            }
        }
        return -1;
    }
    //ADD ITEM TO CART
    function add_cart_item($json){
        $added = $this->added_in_cart($json);

        if($added == -1){
            array_unshift($_SESSION['cart'], $json);
        }else{
            $_SESSION['cart'][$added]->amount += $json->amount;
        }
        //
        return $this->save_cart_to_account();
    }
    function delete_cart_item($id){
        array_splice($_SESSION['cart'], $id, 1);
        //
        return $this->save_cart_to_account();
    }
    function update_cart_item($id, $amount){
        $_SESSION['cart'][$id]->amount = $amount;
        //
        return $this->save_cart_to_account();
    }
    function clean_all_cart_item(){
        $_SESSION['cart'] = [];
        //
        return $this->save_cart_to_account();
    }
    //ACCOUNT
    function save_value_to_db($column, $value){
        $email = $_SESSION['account']['data']['email'];
        $password = $_SESSION['account']['data']['password'];
        //
        $query = "UPDATE `user_account` SET `$column`= :value WHERE `email` = :email AND `password` = :password";
        $param = [':value' => $value, ':email' => $email, ':password' => $password];
        return $this->MVCmodel->runQuerySQL($query, $param);
    }
    //----ADDRESS LOCATION
    function prepare_account_address_json($data){
        $arr = (object)[];
        $key = ['name', 'surname', 'tel', 'street', 'number', 'city', 'postal_code'];
        $index_post = ['name', 'surname', 'phone-number', 'street', 'number', 'city', 'postal-code'];

        foreach ($key as $key => $value) {
            $arr->$value = $data[$index_post[$key]];
        }

        return $arr;
    }
    function delete_account_address_location($id){
        array_splice($_SESSION['account']['data']['address_location'], $id, 1);
        //
        return $this->save_json_to_db('address_location', $_SESSION['account']['data']['address_location']);
    }
    function add_account_address_location($json){
        array_push($_SESSION['account']['data']['address_location'], $json);
        //
        return $this->save_json_to_db('address_location', $_SESSION['account']['data']['address_location']);
    }
    function modify_account_address_location($json, $index){
        $_SESSION['account']['data']['address_location'][$index] = $json;
        //
        return $this->save_json_to_db('address_location', $_SESSION['account']['data']['address_location']);
    }
    //GET ALL ORDERS
    function get_order_history($limit){
        $id = $_SESSION['account']['data']['id'];

        $query = 'SELECT * FROM `order_history` WHERE `account_id` = :id ORDER BY `id` DESC LIMIT '.$limit;
        $response = $this->MVCmodel->runQuerySQL($query, [':id' => $id], true);
        return $response;
    }
    function get_individual_order_history($order_code){
        $id = $_SESSION['account']['data']['id'];

        $query = 'SELECT * FROM `order_history` WHERE `account_id` = :id AND `order_code` = :order_code LIMIT 1';
        $response = $this->MVCmodel->runQuerySQL($query, [':id' => $id, ':order_code' => $order_code], true);
        return $response;
    }
    function save_order_history($paymentMethod, $orderDetails, $paymentDetails, $issetAccount){
        $order_code = (($issetAccount)?'LL':'AN').time().chr(rand(65,90)).chr(rand(65,90)).rand(0,9).'ES'; //(AN) OR (LL)+unix_actual+random_two_letter+random(0,9)+ES
        $payment_data = json_encode(['payment_method' => $paymentMethod, 'data' => $paymentDetails]);
        //
        $param = [':account_id' => ($issetAccount)?$_SESSION['account']['data']['id']:0, ':order' => json_encode($_SESSION['cart']), ':order_details' => trim($orderDetails), ':address' => json_encode($_SESSION['order_address']),
                  ':billing_address' => json_encode($_SESSION['order_billing_address']), ':total_value' => json_encode($_SESSION['order_info']), ':order_code' => $order_code, ':payment_data' => $payment_data];
        
        $query = 'INSERT INTO `order_history` (`account_id`, `order`, `order_details`, `address`, `billing_address`, `total_value`, `order_code`, `payment_data`) VALUES (:account_id, :order, :order_details, :address, :billing_address, :total_value, :order_code, :payment_data)';
        if($this->MVCmodel->runQuerySQL($query, $param)){
            return $order_code;
        }else{
            return false;
        }
    }
    function add_one_buy_times_product($cart){
        $key = [];

        foreach ($cart as $key => $value) {
            array_push($key, $value['item']['id']);
        }

        $str_key = implode(',', $key);
        $query = 'UPDATE `product_list` SET `order_times`= `order_times`+1 WHERE `id` IN ('.$str_key.')';
        return $this->MVCmodel->runQuerySQL($query, []);
    }
    function order_completed_save($order_code){
        //ADD +1 IN EACH PRODUCT BOUGHT
        $this->add_one_buy_times_product($_SESSION['cart']);
        //SET SUCCESS ORDER
        $_SESSION['order_success'] = ['order_code' => $order_code, 'email' => $_SESSION['order_address']['email'], 'address' => $_SESSION['order_address'], 'total' => $_SESSION['order_info']];
        //UNSET ALL TEMPORAL CART SESSION VARIABLE
        unset($_SESSION['order_address']);
        unset($_SESSION['order_billing_address']);
        unset($_SESSION['order_info']);

        if($this->isset_account_session() && $_SESSION['cart'] != $_SESSION['account']['data']['cart']){
            $_SESSION['cart'] = $_SESSION['account']['data']['cart'];
        }else{
            $this->clean_all_cart_item();
        }
        
        //UNSET STRIPE SESSION INFO
        if(isset($_SESSION['stripe_payment_info'])){
            unset($_SESSION['stripe_payment_info']);
        }
        //SEND EMAIL
        return $this->send_order_completed_email();
    }
    //WALLET PAY
    function save_use_wallet_history($order_code, $payment){
        $_SESSION['account']['data']['wallet'] = $_SESSION['account']['data']['wallet'] - $_SESSION['order_info']['total'];
        $this->save_value_to_db('wallet', $_SESSION['account']['data']['wallet']);

        $template = (object)["datetime" => time(), "type" => 0, "value" => $_SESSION['order_info']['total'], "wallet" => $_SESSION['account']['data']['wallet'], "message" => "Pago pedido: $order_code", "extra" => $payment];
        array_unshift($_SESSION['account']['data']['wallet_history'], $template);

        return $this->save_json_to_db('wallet_history', $_SESSION['account']['data']['wallet_history']); 
    }
    //GALLERY
    //-----
    //GET GALLERY ALL ITEM
    function get_gallery($pag, $save_count_in_session){
        //
        $item_per_page = 40;
        //-------
        //SAVE IN SESSION DATA
        if($save_count_in_session){
            $query = "SELECT count(*) as total_results FROM `gallery_season`";
            $response = $this->MVCmodel->runQuerySQL($query, [], true);

            $total_results = $response[0]['total_results'];
            $page = ceil($total_results/$item_per_page);

            $_SESSION['count_gallery_result'] = ['data' => ['total' => $total_results, 'page' => $page]];
        }
        //------
        $start_item = (($pag == 1)?0:(($pag-1) * $item_per_page));
        //------
        $query = "SELECT * FROM `gallery_season` ORDER BY `id` DESC LIMIT $start_item, $item_per_page";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;

        // select count(*) as total_number from product_list
    }
    //GET GALLERY ALBUM ALL PHOTOS
    function get_album($album, $pag, $save_count_in_session){
        //
        $item_per_page = 40;
        //-------
        $master_query = "WHERE `season` = :season";
        $master_param = [':season' => $album];
        //SAVE IN SESSION DATA
        if($save_count_in_session){
            $query = "SELECT count(*) as total_results FROM `gallery_album_list` $master_query";
            $response = $this->MVCmodel->runQuerySQL($query, $master_param, true);

            $total_results = $response[0]['total_results'];
            $page = ceil($total_results/$item_per_page);

            $_SESSION['count_album_result'] = ['album' => $album, 'data' => ['total' => $total_results, 'page' => $page]];
        }
        //------
        $start_item = (($pag == 1)?0:(($pag-1) * $item_per_page));
        //------
        $query = "SELECT * FROM `gallery_album_list` $master_query ORDER BY `id` DESC LIMIT $start_item, $item_per_page";
        $response = $this->MVCmodel->runQuerySQL($query, $master_param, true);
        return $response;

        // select count(*) as total_number from product_list
    }
    function get_individual_collection_item($album, $collection_name){
        $query = "SELECT * FROM `gallery_album_list` WHERE `season` = :album AND `name` = :name_coll LIMIT 1";
        $param = [':album' => $album, ":name_coll" => $collection_name];
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);
        return $response;
    }
    //--------------
    //GET SEARCH ENGINE
    function get_last_search_keywords(){
        $query = "SELECT * FROM `search_engine` ORDER BY `search_times` DESC LIMIT 10";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    function get_query_result_search($query){
        $query = "SELECT * FROM `search_engine` WHERE `keyword` LIKE '%$query%' ORDER BY `search_times` DESC LIMIT 10";
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    function update_query_result_search($query){
        $query = "UPDATE `search_engine` SET `search_times`= `search_times`+1, `date_update`= CURRENT_TIMESTAMP() WHERE `keyword` LIKE '%".$query."%' ";
        $response = $this->MVCmodel->runQuerySQL($query, []);
        return $response;
    }
    //------
    //PASSWORD
    function modify_account_password($password){
        if($this->save_value_to_db('password', $password)){
            $html = file_get_contents("./html/email_template/modify_password.html");
            //SIMPLIFY
            $ip = $this->get_ip();
            $url = "http://ip-api.com/json/$ip?fields=status,country,regionName,city";
            //JSON
            $json = json_decode(file_get_contents($url));
            $arr_data = ["ip" => $ip, "location" => (($json->status == 'success')?($json->country.', '.$json->regionName.', '.$json->city):'Undefined')];

            foreach ($arr_data as $key => $value) {
                $html =  str_replace("**&".$key."&**", $value, $html);
            }

            if($this->sendMail($_SESSION['account']['data']['email'], "LEE LIM", "LEE LIM - Cambio de Contraseña", $html)){
                return true;
            }
        }
        return false;
    }
    //RECOVERY PASSWORD
    function recovery_account_password($account){
        //code
        $verify_code = rand();
        $query = 'INSERT INTO `password_recovery`(`id_account`, `email_account`, `verify_code`) VALUES (:id, :email, :verify_code)';
        $param = [':id' => $account['id'], ':email' => $account['email'], ':verify_code' => $verify_code];
        if($this->MVCmodel->runQuerySQL($query, $param)){
            if($this->send_verify_recovery_password($account, $verify_code)){
                return true;
            }
        }
        return false;
    }
    function send_verify_recovery_password($account, $code){
        $html = file_get_contents("./html/email_template/recovery_password.html");
        $arr_data = ["email" => $account['email'], "code" => $code];

        foreach ($arr_data as $key => $value) {
            $html =  str_replace("**&".$key."&**", $value, $html);
        }

        if($this->sendMail($account['email'], "LEE LIM", "LEE LIM - Contraseña Olvidada", $html)){
            return true;
        }else{
            return false;
        }
    }
    function isset_recovery_account_password($email, $code){
        $query = "SELECT * FROM `password_recovery` WHERE `email_account` = :email AND `verify_code` = :code ORDER BY `id` DESC LIMIT 1";
        $response = $this->MVCmodel->runQuerySQL($query, [':email' => $email, ':code' => $code], true);
        if(empty($response)){
            return false;
        }
        return $response[0];
    }
    function change_recovery_account_password($email, $code, $password){
        $account = $this->isset_recovery_account_password($email, $code);
        if($account){
            $query = "UPDATE `user_account` SET `password`= :password WHERE `email` = :email AND `id` = :id";
            $param = [':password' => $password, ':email' => $email, ':id' => $account['id_account']];
            return $this->MVCmodel->runQuerySQL($query, $param);
        }
        return false;
    }
}