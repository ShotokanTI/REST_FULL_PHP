<?php

use App\Helpers\Json;

header('Content-Type: application/json');

require_once '../vendor/autoload.php';
// api/users/1
if ($_GET['url']) {
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'api') {
        array_shift($url);

        $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';
        array_shift($url);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        try {
            $response = call_user_func_array(array(new $service, $method), $url);
            if (method_exists(new $service, $method)) {
                http_response_code(200);
                echo Json::Format(array('status' => 'sucess', 'data' => $response));
                exit;
            } else {
                http_response_code(404);
                echo Json::Format(array('status' => 'error', 'data' => 'URL '.$method.' não existe'));
                exit;
            }
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
