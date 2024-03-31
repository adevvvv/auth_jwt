<?php

header("Access-Control-Allow-Origin: http://auth-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "./config/Database.php";
include_once "./objects/User.php";
include_once "libs/php-jwt-main/src/JWT.php";
use Firebase\JWT\JWT;

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$email_exists = $user->emailExists();

// Существует ли электронная почта и соответствует ли пароль тому, что находится в базе данных
if ($email_exists && password_verify($data->password, $user->password)) {

    $key = '5i7O76KoU31b';
    $token = [
        'iss' => 'http://vk',
        'aud' => 'http://vk',
        'iat' => 1356999524,
        'nbf' => 1357000000
    ];

    http_response_code(200);

    // Создание jwt
    $jwt = JWT::encode($token, $key, 'HS256');
    return [
        'jwt' => $jwt
    ];
}
else http_response_code(401);
