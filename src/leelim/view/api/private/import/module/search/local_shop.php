<?php
$mvc = new MVCcontroller();
if(isset($_GET['query']) && !empty($_GET['query'])){
    $response = $mvc->get_local_shop($_GET['query']);
    $json = json_encode($response);
    $mvc->API_response(200, '{"data": '.$json.', "total": '.count($response).'}');
}else{
    $mvc->API_response(400, '"QUERY_REQUIRED"');
}