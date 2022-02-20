<?php
$mvc = new MVCcontroller();
if($_GET['method'] == 'delete'){
    if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1 && isset($_POST['product_code'])){
        if($mvc->delete_product($_POST['id'], $_POST['product_code'])){
            $mvc->API_response(200, '"ITEM_DELETED"');
        }else{
            $mvc->API_response(500, '"SERVER_ERROR"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_ID"');
    }
}else if($_GET['method'] == 'post'){
    function validate(){
        $key_l = ['product_code', 'name', 'description', 'material', 'season', 'category', 'gender', 'price', 'color', 'size'];
        $count = 0;
        foreach ($key_l as $key => $value) {
            if(isset($_POST[$value]) && !empty($_POST[$value])){
                $count = $count +1;
            }
        }
        //
        if($count == count($key_l)){
            return true;
        }
        return false;
    }
    function validate_file(){
        $key_l = ['color_img', 'size_img', 'cover_img', 'hover_img'];
        $count = 0;
        foreach ($key_l as $key => $value) {
            if(file_exists($_FILES[$value]['tmp_name']) && is_uploaded_file($_FILES[$value]['tmp_name']) && $_FILES[$value]['error'] == 0){
                $count = $count +1;
            }
        }
        //
        if($count == count($key_l)){
            return true;
        }
        return false;
    }
    if(validate() && validate_file() && !empty($_FILES['extra_img'])){
        //CREATE ITEM NAD SAVE IT LATER
        $new_item = [];
        //SEASON
        if(empty($mvc->isset_season_tag($_POST['season']))){
            $mvc->API_response(400, '"SEASON_TAG_NOT_ISSET: [ES] La temporada seleccionada no esta disponible"');
        }else{
            $new_item['season'] = $_POST['season'];
        }
        //PRODUCT NAME AND CODE AND DESCRIPTION
        $new_item['name'] = $_POST['name'];
        $new_item['code'] = $_POST['product_code'];
        $new_item['description'] = $_POST['description'];
        $new_item['material'] = $_POST['material'];
        //CATEGORY AND GENDER
        $key_category = ['clothing', 'accessory', 'bag', 'shoe'];
        if(!in_array($_POST['category'], $key_category)){
            $mvc->API_response(400, '"ERROR_CATEGORY_TYPE"');
        }else{
            $new_item['category'] = $_POST['category'];
        }
        $key_gender = ['unisex', 'man', 'woman'];
        if(!in_array($_POST['gender'], $key_gender)){
            $mvc->API_response(400, '"ERROR_GENDER_TYPE"');
        }else{
            $new_item['gender'] = $_POST['gender'];
        }
        //PRICE
        if(!is_numeric($_POST['price'])){
            $mvc->API_response(400, '"ERROR_PRICE_NUMBER"');
        }else{
            $new_item['price'] = floatval($_POST['price']);
        }
        //OPTION
        //COLOR----
        $new_item['option'] = [];
        try {
            $array = array_map('trim', explode(',', $_POST['color']));
            $new_item['option']['color'] = $array;
        } catch (\Throwable $th) {
            $mvc->API_response(400, '"ERROR_COLOR_ENTRY -> '.$th.'"');
        }
        //SIZE----
        try {
            $array = array_map('trim', explode(',', $_POST['size']));
            $new_item['option']['size'] = $array;
        } catch (\Throwable $th) {
            $mvc->API_response(400, '"ERROR_SIZE_ENTRY -> '.$th.'"');
        }
        //================
        //  IMAGE
        //================
        $new_item['image'] = [];
        //SERVER PATH
        chdir('../../../../');
        // $image_server_path = "/httpdocs/view/resource/img/database/";
        $image_server_path = "leelim/view/resource/img/database/product/";
        //SAVE IN DB
        $image_client_path = '/static/img/database/product/';
        //Real image file name
        $real_fileName = $new_item['code'];
        //FOLDER
        $date_now = date("Ymd");
        if(!is_dir($image_server_path.$date_now)){
            mkdir($image_server_path.$date_now, 0777);
            chmod($image_server_path.$date_now, 0777);
        }
        //==============
        //IMAGE KEY
        $img_key = ['color', 'size', 'cover', 'hover'];
        //FOREACH
        foreach ($img_key as $key => $value) {
            $file_name = $_FILES[$value.'_img']['name'];;
            $file_tmp = $_FILES[$value.'_img']['tmp_name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            //--- SAVING
            //REAL PATH TO SAVE IN DB
            $image_pathDB = $image_client_path.$date_now."/".$real_fileName.time()."_".$value.".".$ext;
            //REAL PATH TO SAVE IN SERVER
            $image_path = $image_server_path.$date_now."/".$real_fileName.time()."_".$value.".".$ext;
            if(move_uploaded_file($file_tmp, $image_path)){
                $new_item['image'][$value.'_img'] = $image_pathDB;
            }else{
                $mvc->API_response(500, '"ERROR_SAVING_IMAGE: '.strtoupper($vlue).'"');
            }
        }
        //===============
        //EXTRA
        $extra_img_arr = [];
        foreach($_FILES["extra_img"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["extra_img"]["name"][$key];
            $file_tmp = $_FILES["extra_img"]["tmp_name"][$key];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);
            
            //--- SAVING
            //REAL PATH TO SAVE IN DB
            $image_pathDB = $image_client_path.$date_now."/".$real_fileName.time()."_extra_".$key.".".$ext;
            //REAL PATH TO SAVE IN SERVER
            $image_path = $image_server_path.$date_now."/".$real_fileName.time()."_extra_".$key.".".$ext;
            if(move_uploaded_file($file_tmp, $image_path)){
                array_push($extra_img_arr, $image_pathDB);
            }else{
                $mvc->API_response(500, '"ERROR_SAVING_EXTRA_IMAGE_'.$key.'"');
            }
        }
        $new_item['image']['extra_img'] = $extra_img_arr;

        if($mvc->save_product_new_item($new_item)){
            $mvc->API_response(200, '"ADDED_TO_LIST"');
        }else{
            $mvc->API_response(500, '"ERROR_SAVING_IN_DB"');
        }
    }else{
        $mvc->API_response(400, '"EMPTY_FIELDS_OR_ERROR_UPLOADING"');
    }
}