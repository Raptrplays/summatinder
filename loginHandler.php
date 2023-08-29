<?php
class dbHandler
{
    private $dataSource = "mysql:dbname=eindproject;host=localhost;";
    private $userName = "root";
    private $password = "";

    public function createUser($naam, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("INSERT INTO gebruikers (Naam, Wachtwoord) VALUES (:naam, :password)");
            $statement->bindParam(":naam", $naam, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();
            $id = $pdo->lastInsertId();

            return $id;
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }


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
    public function getGebruikersId($naam, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT GebruikersId FROM gebruikers WHERE Naam = :naam AND Wachtwoord = :password");
            $statement->bindParam(":naam", $naam, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();

            $userRow = $statement->fetch(PDO::FETCH_ASSOC);

            if ($userRow === false) {
                return null; 
            }

            $gebruikersId = $userRow['GebruikersId'];

            return $gebruikersId !== false ? intval($gebruikersId) : null;
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }
    public function deleteUser($naam)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("DELETE FROM gebruikers WHERE Naam = :naam");
            $statement->bindParam(":naam", $naam, PDO::PARAM_STR);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            var_dump($e);
            die();
        }
    }
    public function updateUsername($Naam, $Nieuwenaam)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("UPDATE gebruikers SET Naam = :Nieuwenaam WHERE Naam = :Naam");
            $statement->bindParam(":Naam", $Naam, PDO::PARAM_STR);
            $statement->bindParam(":Nieuwenaam", $Nieuwenaam, PDO::PARAM_STR);
            $statement->execute();

            $rowCount = $statement->rowCount();
            return ($rowCount > 0);
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }
}