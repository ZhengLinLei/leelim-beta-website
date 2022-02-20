<?php
$mvc = new MVCcontroller();
if (isset($_GET['method'])) {
    if (isset($_POST['query']) && !empty($_POST['query'])) {
        if ($_GET['method'] == 'get') {
            $response = $mvc->get_query_result_search($_POST['query']);
            if (empty($response)) {
                $mvc->API_response(901, '"EMPTY"');
            }
            $return = [];

            foreach ($response as $value) {
                array_push($return, $value['keyword']);
            }
            $mvc->API_response(200, json_encode($return));
        } else if ($_GET['method'] == 'put') {
            $response = $mvc->update_query_result_search($_POST['query']);

            $mvc->API_response(200, '"UPDATED_SEARCHED_TIMES"');
        }
    } else {
        $mvc->API_response(400, '"QUERY_REQUIRED"');
    }
} else {
    $mvc->API_response(400, '"METHOD_REQUIRED"');
}
