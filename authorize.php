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

if ($email_exists && password_verify($data->password, $user->password)) {

    $key = '5i7O76KoU31b';
    $token = [
        'iss' => 'http://auth-jwt',
        'aud' => 'http://auth-jwt',
        'iat' => 1356999524,
        'nbf' => 1357000000
    ];

    // Создание jwt
    $jwt = JWT::encode($token, $key, 'HS256');
    echo json_encode(array('jwt' => $jwt));
}
