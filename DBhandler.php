<?php
class DbHandler
{
    private $dataSource = "mysql:dbname=tinder;host=localhost;";
    private $userName = "root";
    private $password = "";

    public function AcreateUser($user, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("INSERT INTO user (username, password) VALUES(:name, :password");
            $statement->bindColumn(":name", $user, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();
            $id = $pdo->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }
}
