<?php

header("Access-Control-Allow-Origin: http://auth-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "libs/php-jwt-main/src/SignatureInvalidException.php";
include_once "libs/php-jwt-main/src/JWT.php";
include_once "libs/php-jwt-main/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$data = json_decode(file_get_contents("php://input"));

// Получаем JWT
$jwt = isset($data->jwt) ? $data->jwt : "";

if ($jwt) {
    $key = '5i7O76KoU31b';
    try {
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        http_response_code(200);
        echo json_encode(array(
            "message" => "Доступ разрешен"
        ));
    }

    catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Доступ закрыт",
        ));
    }
}

else {
    http_response_code(401);
    echo json_encode(array("message" => "Доступ запрещён"));
}