<?php

class Database
{
    private $host = "localhost";
    private $dbName = "authentication_jwt";
    private $userName = "root";
    private $password = "";
    public $connect;

    // Получаем соединение с базой данных
    public function getConnection(): ?PDO
    {
        $this->connect = null;

        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
        } catch (PDOException $exception) {
            echo "Ошибка соединения с БД: " . $exception->getMessage();
        }

        return $this->connect;
    }
}
