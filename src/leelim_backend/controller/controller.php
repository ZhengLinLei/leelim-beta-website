<?php
class MVCcontroller{
    function __construct(){
        $this->MVCmodel = new MVCmodelDB();
        $this->MVCmodelClient = new MVCmodelDBClient();
    }
    function account_middleware(){
        if($this->isset_account_session()){
            return true;
        }
        header('Location: /login/');
        die();
    }
    function imap_login(){
        $user = 'account@test.com'; //EMAL ADDRESS
        $pass = '12345678'; //ACCOUNT PASSWORD
        return (imap_open("{imap.gmail.com:993/imap/ssl}INBOX",$user,$pass)); // EXAMPLE OF GMAIL IMAP ADDRESS
    }
    function isset_account_session(){
        if(isset($_SESSION['employer_account']) && $_SESSION['employer_account']['active'] && !empty($_SESSION['employer_account']['data'])){
            return true;
        }
        return false;
    }
    function include_template($type="home"){
        //Include public template 加入文件标题
        include_once "./view/template/$type.php";
    }
    function include_modules($module="component/nav_side"){
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
    //EARNING
    function get_earning_month(){
        $query = 'SELECT SUM(JSON_EXTRACT(`total_value`, "$.total")) as `sum` FROM `order_history` WHERE MONTH(`date_create`) = MONTH(CURRENT_DATE()) AND YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_earning_year(){
        $query = 'SELECT SUM(JSON_EXTRACT(`total_value`, "$.total")) as `sum` FROM `order_history` WHERE YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_earning_day(){
        $query = 'SELECT SUM(JSON_EXTRACT(`total_value`, "$.total")) as `sum` FROM `order_history` WHERE DAY(`date_create`) = DAY(CURRENT_DATE()) AND MONTH(`date_create`) = MONTH(CURRENT_DATE()) AND YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_earning_per_month_annual($year){
        $query = 'SELECT MONTH(`date_create`) AS `month`, SUM(JSON_EXTRACT(`total_value`, "$.total")) AS `sum` FROM `order_history` WHERE YEAR(`date_create`) = :year GROUP BY MONTH(`date_create`) ORDER BY MONTH(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':year' => $year], true);
    }
    function get_earning_per_day_mensual($month, $year){
        $month = intval($month);
        $query = 'SELECT DAY(`date_create`) AS `day`, SUM(JSON_EXTRACT(`total_value`, "$.total")) AS `sum` FROM `order_history` WHERE MONTH(`date_create`) = :month AND YEAR(`date_create`) = :year GROUP BY DAY(`date_create`) ORDER BY DAY(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':month' => $month, ':year' => $year], true);
    }
    function get_earning_per_hour_daily($day, $month, $year){
        $day = intval($day);
        $month = intval($month);
        $query = 'SELECT HOUR(`date_create`) AS `hour`, SUM(JSON_EXTRACT(`total_value`, "$.total")) AS `sum` FROM `order_history` WHERE DAY(`date_create`) = :day AND MONTH(`date_create`) = :month AND YEAR(`date_create`) = :year GROUP BY HOUR(`date_create`) ORDER BY HOUR(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':day' => $day, ':month' => $month, ':year' => $year], true);
    }
    function get_last_id($column, $type){
        $query = "SELECT `id` FROM `$column` ORDER BY `id` DESC LIMIT 1";
        
        if($type == 'client'){
            return $this->MVCmodelClient->runQuerySQL($query, [], true);
        }
        return $this->MVCmodel->runQuerySQL($query, [], true);
    }
    //ORDER
    function get_order_month(){
        $query = 'SELECT COUNT(*) as `sum` FROM `order_history` WHERE MONTH(`date_create`) = MONTH(CURRENT_DATE()) AND YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_order_year(){
        $query = 'SELECT COUNT(*) as `sum` FROM `order_history` WHERE YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_order_day(){
        $query = 'SELECT COUNT(*) as `sum` FROM `order_history` WHERE DAY(`date_create`) = DAY(CURRENT_DATE()) AND MONTH(`date_create`) = MONTH(CURRENT_DATE()) AND YEAR(`date_create`) = YEAR(CURRENT_DATE())';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_order_per_month_annual($year){
        $query = 'SELECT MONTH(`date_create`) AS `month`, COUNT(*)  AS `sum` FROM `order_history` WHERE YEAR(`date_create`) = :year GROUP BY MONTH(`date_create`) ORDER BY MONTH(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':year' => $year], true);
    }
    function get_order_per_day_mensual($month, $year){
        $month = intval($month);
        $query = 'SELECT DAY(`date_create`) AS `day`, COUNT(*) AS `sum` FROM `order_history` WHERE MONTH(`date_create`) = :month AND YEAR(`date_create`) = :year GROUP BY DAY(`date_create`) ORDER BY DAY(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':month' => $month, ':year' => $year], true);
    }
    function get_order_per_hour_daily($day, $month, $year){
        $day = intval($day);
        $month = intval($month);
        $query = 'SELECT HOUR(`date_create`) AS `hour`, COUNT(*) AS `sum` FROM `order_history` WHERE DAY(`date_create`) = :day AND MONTH(`date_create`) = :month AND YEAR(`date_create`) = :year GROUP BY HOUR(`date_create`) ORDER BY HOUR(`date_create`);';
        return $this->MVCmodelClient->runQuerySQL($query, [':day' => $day, ':month' => $month, ':year' => $year], true);
    }
    //USER ACCOUNT
    function get_total_user_account(){
        $query = 'SELECT COUNT(*) AS `sum` FROM `user_account`';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_total_not_verified_user_account(){
        $query = 'SELECT COUNT(*) AS `sum` FROM `user_account` WHERE `verify_account` != 0';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    function get_total_not_recovery_user_account(){
        $query = 'SELECT COUNT(*) AS `sum` FROM `password_recovery`';
        return $this->MVCmodelClient->runQuerySQL($query, [], true);
    }
    //ACCOUNT
    function select_account($id, $password, $save_session = false){
        $query = "SELECT * FROM `account_employer` WHERE `id_employer` = :id AND `password` = :password_key LIMIT 1";
        $param = [':id' => $id, ':password_key' => $password];
            
        $response = $this->MVCmodel->runQuerySQL($query, $param, true);

        if(!empty($response)){
            //
            $query = "SELECT * FROM `role_employer` WHERE `role_name` = :name LIMIT 1";
            $param = [':name' => $response[0]['role']];
                
            $role = $this->MVCmodel->runQuerySQL($query, $param, true);
            if(!empty($role)){
                if($save_session){
                    return $this->prepare_account_session($response[0], $role[0]);
                }
                return true;
            }
        }
        return false;
    }
    function change_account_password($password){
        $query = 'UPDATE `account_employer` SET `password` = :password WHERE `id` = :id AND `id_employer` = :id_employer AND `email` = :email AND `password` = :old_pass'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        $response = $this->MVCmodel->runQuerySQL($query, [':password' => $password, ':id' => $_SESSION['employer_account']['data']['id'], ':id_employer' =>  $_SESSION['employer_account']['data']['id_employer'], ':email' =>  $_SESSION['employer_account']['data']['email'], ':old_pass' =>  $_SESSION['employer_account']['data']['password']]);
        return $response;
    }
    function clear_account_session(){
        $_SESSION['employer_account']['active'] = false;
        unset($_SESSION['account']);

        return true;
    }
    //DATABASE
    public function prepare_account_session($data, $role){
        //-----------
        $_SESSION['employer_account'] = ['active' => true, 'data' => $data, 'role' => $role];
        //json
        $to_json_key = ['todo_list'];
        foreach ($to_json_key as $value) {
            $_SESSION['employer_account']['data'][$value] = json_decode($_SESSION['employer_account']['data'][$value]);
        }
        //---
        return true;
    }
    //API
    //--------------------
    //--------
    //SAVE JSON TO DB
    function save_json_to_db($column, $value){
        $id = $_SESSION['employer_account']['data']['id_employer'];
        $password = $_SESSION['employer_account']['data']['password'];
        //
        $json = json_encode($value);
        //
        $query = "UPDATE `account_employer` SET `$column`= :json WHERE `id_employer` = :id AND `password` = :password";
        $param = [':json' => $json, ':id' => $id, ':password' => $password];
        return $this->MVCmodel->runQuerySQL($query, $param);
    }
    //TOOLS
    //------
    //TODOLIST
    function delete_account_todo_list($id){
        array_splice($_SESSION['employer_account']['data']['todo_list'], $id, 1);
        //
        return $this->save_json_to_db('todo_list', $_SESSION['employer_account']['data']['todo_list']);
    }
    function prepare_account_todo_list_json($data){
        $arr = (object)['name' => $data['name'], 'description' => $data['description'], 'status' => 0];

        return $arr;
    }
    function add_account_todo_list($json){
        array_push($_SESSION['employer_account']['data']['todo_list'], $json);
        //
        return $this->save_json_to_db('todo_list', $_SESSION['employer_account']['data']['todo_list']);
    }
    function modify_account_todo_list($json, $index){
        $_SESSION['employer_account']['data']['todo_list'][$index] = $json;
        //
        return $this->save_json_to_db('todo_list', $_SESSION['employer_account']['data']['todo_list']);
    }
    function update_account_todo_list_status($id, $value){
        $_SESSION['employer_account']['data']['todo_list'][$id]->status = $value;
        //
        return $this->save_json_to_db('todo_list', $_SESSION['employer_account']['data']['todo_list']);
    }
    function get_peding_todo(){
        $peding_arr = [];
        foreach ($_SESSION['employer_account']['data']['todo_list'] as $key => $value) {
            if(!$value->status){
                array_push($peding_arr, $value);
            }
        }
        return $peding_arr;
    }
    //ORDER
    function get_individual_order_history($order_code){
        $query = 'SELECT * FROM `order_history` WHERE `order_code` = :order_code LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':order_code' => $order_code], true);
        return $response;
    }
    function get_individual_order_history_by_shipping($code){
        $query = 'SELECT * FROM `order_history` WHERE `shipping_code` = :shipping_code LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':shipping_code' => $code], true);
        return $response;
    }
    function get_pending_pack_order(){
        $query = 'SELECT * FROM `order_history` WHERE `status_code` = 1'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function get_pending_send_order(){
        $query = 'SELECT * FROM `order_history` WHERE `status_code` = 2'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function update_order_pack_status($id, $order_code){
        $query = 'UPDATE `order_history` SET `status_code` = :status, `status` = "packed" WHERE `id` = :id AND `order_code` = :code'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        $response = $this->MVCmodelClient->runQuerySQL($query, [':status' => 2, ':id' => $id, ':code' => $order_code]);
        return $response;
    }
    function update_order_send_status($shipping_code, $id, $order_code){
        $query = 'UPDATE `order_history` SET `status_code` = :status, `status` = "sent" , `shipping_code` = :shipping WHERE `id` = :id AND `order_code` = :code'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        if($this->MVCmodelClient->runQuerySQL($query, [':status' => 3, ':shipping' => $shipping_code, ':id' => $id, ':code' => $order_code])){
            return $this->send_update_shipping_order_email($id);
        }
        return false;
    }

    function send_update_shipping_order_email($id){
        $query = 'SELECT * FROM `order_history` WHERE `id` = :id'; //0 = NULL, 1 = PAID, 2 = PACKED, 3 = SENT
        $response = $this->MVCmodelClient->runQuerySQL($query, [':id' => $id], true);

        $html = file_get_contents("./html/email_template/shipping_completed.html");
        //SIMPLIFY
        $arr_data = ["order_code" => $response[0]['order_code'], "shipping_code" => $response[0]['shipping_code'], "actual_date" => date('Y-m-d h:i', time()), "order_date" => date('Y-m-d h:i', strtotime($response[0]['date_create']))];

        foreach ($arr_data as $key => $value) {
            $html =  str_replace("**&".$key."&**", $value, $html);
        }
        if($this->sendMail(json_decode($response[0]['address'])->email, "noreply@leelim.es", "LEE LIM", "LEE LIM - Pedido: ".$response[0]['order_code']." - ENVIADO", $html)){
            return true;
        }else{
            return false;
        }
    }
    
    //WALLET
    function get_wallet_payment($code){
        $query = 'SELECT `id`,`email`, `name`, `surname` FROM `user_account` WHERE `wallet_history` LIKE "%'.$code.'%" LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    //EMAIL
    function get_email_count($text){
        $imap = $this->imap_login();
        // return count(imap_search($imap, $text));
        return 2;
    }
    function get_email_list(){
        $query = 'SELECT * FROM `email_list`';
        $response = $this->MVCmodel->runQuerySQL($query, [], true);
        return $response;
    }
    //CONTACT
    function get_contact_count(){
        $query = 'SELECT COUNT(*) AS `sum` FROM `contact_message` WHERE `answered` = 0';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        if(empty($response)){
            return 0;
        }
        return $response[0]['sum'];
    }
    function get_contact_data(){
        $query = 'SELECT * FROM `contact_message` WHERE `answered` = 0 ORDER BY `id` DESC LIMIT 3';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function get_all_contact_data(){
        $query = 'SELECT * FROM `contact_message` WHERE `answered` = 0 ORDER BY `id` DESC';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function update_contact_status($id, $via){
        $query = 'UPDATE `contact_message` SET `answered` = 1, `answered_by` = :answer WHERE `id` = :id';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':answer' => $via, ':id' => $id]);
        return $response;
    }
    function send_inner_email($to, $from, $fromName, $subject, $content){
        $html = file_get_contents("./html/email_template/email_template.html");
        //SIMPLIFY
        $arr_data = ["subject" => $subject, "content" => $content];

        foreach ($arr_data as $key => $value) {
            $html =  str_replace("**&".$key."&**", $value, $html);
        }

        return $this->sendMail($to, $from, $fromName, 'LEE LIM - '.$subject, $html);
    }
    //SEND EMAIL
    function sendMail($to, $from, $name, $title, $body){
        $header = 'From: '.$name.' <'.$from.'> ' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion(). "\r\n";
        $header .= 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $title = "=?utf-8?B?".base64_encode($title)."?=\n";

        return mail($to, $title, $body, $header);
    }
    //SEASON
    //TAG
    function get_season_tag(){
        $query = 'SELECT * FROM `gallery_season` LIMIT 10';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function delete_season_tag($id, $name){
        $query = 'DELETE FROM `gallery_season` WHERE `id` = :id AND `name` = :name LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':id' => $id, ':name' => $name]);
        return $response;
    }
    function post_season_tag($name, $img){
        $query = 'INSERT INTO `gallery_season` (`name`, `cover_img`) VALUES (:name, :img);';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':name' => $name, ':img' => $img]);
        return $response;
    }
    function isset_season_tag($name){
        $query = 'SELECT * FROM `gallery_season` WHERE `name` = :name LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':name' => $name], true);
        return $response;
    }
    function save_gallery_new_item($item){
        $query = 'INSERT INTO `gallery_album_list`(`season`, `name`, `description`, `color_list`, `image`, `product_list`) VALUES (:season, :name, :description, :color, :image, :product)';
        $param = [];

        $key_l = ['season', 'name', 'description'];

        foreach ($key_l as $key => $value) {
            $param[':'.$value] = $item[$value];
        }
        $param[':color'] = json_encode($item['color']);
        $param[':image'] = json_encode($item['image']);
        $param[':product'] = json_encode($item['product']);
        //
        $response = $this->MVCmodelClient->runQuerySQL($query, $param);
        return $response;
    }
    //PRODUCT
    function get_product_by_code($code){
        $query = 'SELECT *  FROM `product_list` WHERE `product_code` LIKE "%'.$code.'%"';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;   
    }
    function get_product_strict_by_code($code){
        $query = 'SELECT *  FROM `product_list` WHERE `product_code` = :code LIMIT 1';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':code' => $code], true);
        return $response;   
    }
    function get_best_product(){
        $query = 'SELECT *  FROM `product_list` ORDER BY `order_times` DESC LIMIT 10';
        $response = $this->MVCmodelClient->runQuerySQL($query, [], true);
        return $response;
    }
    function delete_product($id, $code){
        $query = 'DELETE FROM `product_list` WHERE `id` = :id AND `product_code` = :code';
        $response = $this->MVCmodelClient->runQuerySQL($query, [':id' => $id, ':code' => $code]);
        return $response;
    }
    function save_product_new_item($item){
        $query = 'INSERT INTO `product_list`(`product_code`, `name`, `description`, `material`, `season`, `category`, `gender`, `price`, `image`, `option`) VALUES (:code, :name, :description, :material, :season, :category, :gender, :price, :image, :option)';
        $param = [];

        $key_l = ['code', 'name', 'description', 'material', 'season', 'category', 'gender', 'price'];

        foreach ($key_l as $key => $value) {
            $param[':'.$value] = $item[$value];
        }
        $param[':image'] = json_encode($item['image']);
        $param[':option'] = json_encode($item['option']);
        //
        $response = $this->MVCmodelClient->runQuerySQL($query, $param);
        return $response;
    }
}