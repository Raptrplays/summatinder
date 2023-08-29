<?php
<<<<<<< HEAD
final class dbHandler
{
    private $dataSource = "mysql:dbname=tinder;host=localhost;";
    private $username = "root";
    private $password = "";


    public function selectAllEvents()
    {
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM `events`;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }
    /*
    public function selectOneEvent($EventID){
        try{

            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM `events` WHERE eventID = :EventID;");
            $statement->bindParam("EventID", $EventID, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }*/

    public function InsertEvent($eventname, $eventdesc, $eventlocation)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("INSERT INTO `events`(`eventName`, `eventDesc`, `eventLocation`) VALUES (:EventName,:EventDesc,:EventLocation)");
            $statement->bindParam("EventName", $eventname, PDO::PARAM_STR);
            $statement->bindParam("EventDesc", $eventdesc, PDO::PARAM_STR);
            $statement->bindParam("EventLocation", $eventlocation, PDO::PARAM_STR);
            $statement->execute();
            return true;
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function InsertJoin($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("INSERT INTO `joinedevents`(`userID`, `eventID`) VALUES (:UserID,:EventID)");
            $statement->bindParam("UserID", $userid, PDO::PARAM_INT);
            $statement->bindParam("EventID", $eventid, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

}
?>
=======
class DbHandler
{
    private $dataSource = "mysql:dbname=tinder;host=localhost;";
    private $userName = "root";
    private $password = "";

   
}
>>>>>>> 7d17a2e328f2b5006d02d2fdb457904b70e571c8
