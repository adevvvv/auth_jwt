<?php
include_once "./config/Database.php";
include_once "./objects/User.php";

header("Access-Control-Allow-Origin: http://auth-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->password = $data->password;

// Проверка, что данного пользователя нет в БД
$emailExists = $user->emailExists();
// Проверка надежности пароля
$checkPass = $user->checkPass($user->password);
// Обновить данные пользователя если он существует
$user->updateUser($user->password);

// Создание пользователя
if (
    !empty($user->email) &&
    $emailExists == 0 &&
    !empty($user->password) &&
    $user->createUser()
) {
    
    http_response_code(200);

    echo json_encode(array("user_id: " => $user->getId(), "password_check_status: " => $checkPass));
}
else echo json_encode(array("Пользователь существует"));