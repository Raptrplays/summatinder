<?php
class DbHandler
{
    private $dataSource = "mysql:dbname=tinder;host=localhost;";
    private $userName = "root";
    private $password = "";

    public function getUser($naam, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * FROM gebruikers WHERE Naam = :naam AND Wachtwoord = :password");
            $statement->bindParam(":naam", $naam, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();

            $user1 = $statement->fetch(PDO::FETCH_ASSOC);
            return $user1;
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }

    public function createUser($username, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("INSERT INTO gebruikers (username, password) VALUES (:naam, :password)");
            $statement->bindParam(":username", $userName, PDO::PARAM_STR);
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