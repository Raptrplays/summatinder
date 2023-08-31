<?php
class DbHandler
{
    private $dataSource = "mysql:dbname=tinder;host=localhost;";
    private $userName = "root";
    private $password = "";


    public function createUser($user, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement1 = $pdo->prepare("SELECT * FROM user WHERE username = :name AND password = :password");
            $statement1->bindParam(":name", $user, PDO::PARAM_STR);
            $statement1->bindParam(":password", $password, PDO::PARAM_STR);
            $statement1->execute();
            
            if ($statement1->rowCount() == 0) 
            { 
                $statement = $pdo->prepare("INSERT INTO user (username, password) VALUES(:name, :password)");
                $statement->bindParam(":name", $user, PDO::PARAM_STR);
                $statement->bindParam(":password", $password, PDO::PARAM_STR);
                $statement->execute();
            }
            else
            {
                echo ("user bestaat al");
            }
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }


    public function selectAllEvents()
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * FROM `events`;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }
    public function selectAllJoinedEvents()
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * FROM `joinedevents`;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function SelectAllWithJoinedCount()
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * ,(SELECT COUNT(userID) FROM `joinedevents` WHERE events.eventID = joinedevents.eventID) as joinedcount FROM `events`;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function CheckJoinedEvents($userid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * FROM `joinedevents` INNER JOIN events on joinedevents.eventID = events.eventID WHERE userID = :userid;");
            $statement->bindParam("userid", $userid, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    //SELECT * ,(SELECT COUNT(userID) FROM `joinedevents` WHERE events.eventID = joinedevents.eventID) as joinedcount FROM `events`;


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

    public function CountEventNumber($EventID)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT COUNT(userID) FROM `joinedevents` WHERE eventID = :EventID");
            $statement->bindParam("EventID", $EventID, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function InsertEvent($eventname, $eventdesc, $eventlocation, $userid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("INSERT INTO `events`(`eventName`, `eventDesc`, `eventLocation`, `UserID`) VALUES (:EventName,:EventDesc,:EventLocation,:UserID)");
            $statement->bindParam("EventName", $eventname, PDO::PARAM_STR);
            $statement->bindParam("EventDesc", $eventdesc, PDO::PARAM_STR);
            $statement->bindParam("EventLocation", $eventlocation, PDO::PARAM_STR);
            $statement->bindParam("UserID", $userid, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function deleteEvent($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("DELETE FROM `events` WHERE eventID = :EventID AND UserID = :UserID;");
            $statement->bindParam("EventID", $eventid, PDO::PARAM_INT);
            $statement->bindParam("UserID", $userid, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch(PDOException $e){
            var_dump($e);
            return false;
        }
    }

    public function CheckCreatedEvent($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT COUNT(*) FROM `events` WHERE eventID = :EVENTID AND UserID = :USERID;");
            $statement->bindParam("EVENTID", $eventid, PDO::PARAM_INT);
            $statement->bindParam("USERID", $userid, PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($count[0]['COUNT(*)'] < 1){
                return false;
            }
            else{
                return true;
            }
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    /*
    public function InsertJoin($userid, $eventid)
    {
        $count = null;
        try{
        $pdo = new PDO($this->dataSource, $this->userName, $this->password);
        $statement = $pdo->prepare("SELECT COUNT(*) FROM `joinedevents` WHERE userID = :USERID AND eventID = :EVENTID");
        $statement->bindParam("USERID", $userid, PDO::PARAM_INT);
        $statement->bindParam("EVENTID", $eventid, PDO::PARAM_INT);
        $statement->execute();
        $count = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
        
    }*/
    

    public function InsertJoin123($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT COUNT(*) FROM `joinedevents` WHERE userID = :USERID AND eventID = :EVENTID");
            $statement->bindParam("USERID", $userid, PDO::PARAM_INT);
            $statement->bindParam("EVENTID", $eventid, PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($count[0]['COUNT(*)'] < 1){
                $pdo = new PDO($this->dataSource, $this->userName, $this->password);
                $statement = $pdo->prepare("INSERT INTO `joinedevents`(`userID`, `eventID`) VALUES (:UserID,:EventID)");
                $statement->bindParam("UserID", $userid, PDO::PARAM_INT);
                $statement->bindParam("EventID", $eventid, PDO::PARAM_INT);
                $statement->execute();
                return true;
            }
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function CheckJoined($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT COUNT(*) FROM `joinedevents` WHERE userID = :USERID AND eventID = :EVENTID");
            $statement->bindParam("USERID", $userid, PDO::PARAM_INT);
            $statement->bindParam("EVENTID", $eventid, PDO::PARAM_INT);
            $statement->execute();
            $count = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($count[0]['COUNT(*)'] < 1){
                return false;
            }
            else{
                return true;
            }
        }
        catch(PDOException $exception){
            var_dump($exception);
            return false;
        }
    }
    
    public function deleteJoinAll($eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("DELETE FROM `joinedevents` WHERE eventID = :EventID;");
            $statement->bindParam("EventID", $eventid, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch(PDOException $e){
            var_dump($e);
            return false;
        }
    }

    public function deleteJoin($userid, $eventid)
    {
        try{
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("DELETE FROM `joinedevents` WHERE userID = :UserID and eventID = :EventID;");
            $statement->bindParam("UserID", $userid, PDO::PARAM_INT);
            $statement->bindParam("EventID", $eventid, PDO::PARAM_INT);
            $statement->execute();
            return true;
        }
        catch(PDOException $e){
            var_dump($e);
            return false;
        }
    }






    public function getUser($username, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
            $statement->bindParam(":username", $username, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();

            $user1 = $statement->fetch(PDO::FETCH_ASSOC);
            return $user1;
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }
    public function getGebruikersId($username, $password)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->userName, $this->password);
            $statement = $pdo->prepare("SELECT userID FROM user WHERE username = :username AND password = :password");
            $statement->bindParam(":username", $username, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->execute();
            
            $userRow = $statement->fetch(PDO::FETCH_ASSOC);
            
            if ($userRow === false) {
                return null; 
            }
            
            $gebruikersId = $userRow['userID'];
            
            return $gebruikersId !== false ? intval($gebruikersId) : null;
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }

}
?>
