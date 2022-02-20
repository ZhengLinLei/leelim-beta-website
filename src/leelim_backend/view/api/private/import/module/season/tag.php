<?php
$mvc = new MVCcontroller();
if($_GET['method'] == 'delete'){
    if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > -1 && isset($_POST['name'])){
        if($mvc->delete_season_tag($_POST['id'], $_POST['name'])){
            foreach ($_SESSION['season']['tag'] as $key => $value) {
                if($value['id'] == $_POST['id'] && $value['name'] == $_POST['name']){
                    array_splice($_SESSION['season']['tag'], $key, 1);
                }
            }
            $mvc->API_response(200, '"ITEM_DELETED"');
        }else{
            $mvc->API_response(500, '"SERVER_ERROR"');
        }
    }else{
        $mvc->API_response(400, '"WRONG_ID"');
    }
}else if($_GET['method'] == 'post'){
    if(file_exists($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']) && $_POST['name']){
        if($_FILES['file']['error'] == 0){
            //SERVER PATH
            chdir('../../../../');
            // $image_server_path = "/httpdocs/view/resource/img/database/gallery/tag/";
            $image_server_path = "leelim/view/resource/img/database/gallery/tag/";
            //SAVE IN DB
            $image_client_path = '/static/img/database/gallery/tag/';
            //Real image file name
            $real_fileName = str_replace(' ', '_', $_POST["name"]);
            //
            $file_name = $_FILES['file']['name'];;
            $file_tmp =$_FILES['file']['tmp_name'];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);

            $date_now = date("Ymd");
            //create folder with actual date
            if(!is_dir($image_server_path.$date_now)){
                mkdir($image_server_path.$date_now, 0777);
                chmod($image_server_path.$date_now, 0777);
            }
            //REAL PATH TO SAVE IN DB
            $image_pathDB = $image_client_path.$date_now."/".$real_fileName.time().".".$ext;
            //REAL PATH TO SAVE IN SERVER
            $image_path = $image_server_path.$date_now."/".$real_fileName.time().".".$ext;
            if(move_uploaded_file($file_tmp, $image_path)){
                if($mvc->post_season_tag($_POST['name'], $image_pathDB)){
                    $id = $mvc->get_last_id('gallery_season', 'client')[0]['id'];
                    array_push($_SESSION['season']['tag'], ['id' => $id, 'name' => $_POST['name'], 'cover_img' => $image_pathDB]);
                    //
                    $mvc->API_response(200, '{"id": '.$id.',"name":"'.$_POST['name'].'", "url": "'.$image_pathDB.'"}');
                }else{
                    $mvc->API_response(500, '"ERROR_DB"');
                }
            }else{
                $mvc->API_response(500, '"ERROR_SAVING_IMAGE"');
            }
        }else{
            $mvc->API_response(500, '"ERROR_UPLOADING"');
        }
    }else{
        $mvc->API_response(400, '"EMPTY_IMAGE_OR_NAME"');
    }
}