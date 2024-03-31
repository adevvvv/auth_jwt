<?php

class User
{
    private $connect;
    private $tableName = "vk";
    public $id;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getId()
    {
        $query = "SELECT id, password
            FROM " . $this->tableName . "
            WHERE email = ?";

        $stmt = $this->connect->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->id = $row["id"];
    }

    function createUser(): bool
    {
        $query = "INSERT INTO " . $this->tableName . "
                SET
                    email = :email,
                    password = :password";

        $stmt = $this->connect->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(":email", $this->email);

        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $passwordHash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function emailExists():bool
    {
        $query = "SELECT id, password
            FROM " . $this->tableName . "
            WHERE email = ?
            LIMIT 0,1";

        $stmt = $this->connect->prepare($query);
        $this->email=htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $quantity = $stmt->rowCount();

        if ($quantity > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row["id"];
            $this->password = $row["password"];

            return true;
        }

        return false;
    }
    public function updateUser($password):bool
    {
        $password=!empty($this->password) ? ", password = :password" : "";

        $query = "UPDATE " . $this->tableName . "
            SET
                email = :email
                {$password}
            WHERE id = :id";

        $stmt = $this->connect->prepare($query);
        $this->email=htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);

        if(!empty($this->password)){
            $this->password=htmlspecialchars(strip_tags($this->password));
            $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $passwordHash);
        }

        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function checkPass($password):string
    {
        $number = preg_match('@[0-9]@', $password);
        $upperCase = preg_match('@[A-Z]@', $password);
        $lowerCase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w,!]@', $password);

        if (strlen($password) > 8 && $number && $lowerCase && !$upperCase && !$specialChars) return "good";
        elseif (strlen($password) > 8 && $number && $upperCase && $lowerCase && $specialChars) return "perfect";
        else return "weak_password";
    }
}