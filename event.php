<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Events</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/event.css">
    <script src="./popup.js" defer></script>
</head>

<body>
    <?php
    session_start();
    $existence= 0;
        if(isset($_POST['JoinEvent']))
        {
            require_once 'DBhandler.php';
        $dbHandler = new dbHandler();
            if(isset($_POST['user']) && isset($_POST['event']))
            {
                $dbHandler->InsertJoin123($_POST['user'], $_POST['event']);
            }
            else{
                echo "error";
            }
        }
        if(isset($_POST['LeaveEvent']))
        {
            require_once 'DBhandler.php';
        $dbHandler = new dbHandler();
        if(isset($_POST['user']) && isset($_POST['event']))
            {
                $dbHandler->DeleteJoin($_POST['user'], $_POST['event']);
            }
            else{
                echo "error2";
            }

        }
        if(isset($_POST['DeleteEvent']))
        {
            require_once 'DBhandler.php';
        $dbHandler = new dbHandler();
        if(isset($_POST['user']) && isset($_POST['event']))
            {
                $dbHandler->deleteJoinAll($_POST['event']);
                $dbHandler->DeleteEvent($_POST['user'], $_POST['event']);
            }
            else{
                echo "error2";
            }
        }
        if(isset($_POST['CreateEvent']))
        {
            require_once 'DBhandler.php';
        $dbHandler = new dbHandler();
        if(isset($_POST['eventName']) && isset($_POST['eventDesc']) && isset($_POST['eventLocation']) && isset($_POST['user']))
            {
                //InsertEvent($eventname, $eventdesc, $eventlocation, $userid)
                $dbHandler->InsertEvent($_POST['eventName'], $_POST['eventDesc'], $_POST['eventLocation'], $_POST['user']);
            }
            else{
                echo "error2";
            }
        }
        
    ?>
    <h1>Summa Tinder</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home </a></li>
            <li><a href="event.php">Events</a></li>
            <li><a href="inlog.php">Inloggen</a></li>
        </ul>
    </nav>
    <div class="grid-container">
        <?php
        // Include the database connection file
        require_once 'DBhandler.php';
        $dbHandler = new dbHandler();

        try {
            // Perform database operations using $pdo

            // Example query
            $rows = $dbHandler->SelectAllWithJoinedCount();
            $rows = $dbHandler->SelectAllEVents();
            

            if(isset($_SESSION['GebruikersId']))
            {
            $userid = $_SESSION['GebruikersId'];
            }
            else{
                $userid = 0;
            }
            /*
            if(isset($_SESSION['$GebruikersId']))
            {
                $userid = $_SESSION['GebruikersId'];
            }
            else{
                $userid =0;
            }*/
            
            $data = array();
            
            // Output the results
            foreach ($rows as $row) {
                $eventid = $row['eventID'];
                $name = $row['eventName'];
                $desc = $row['eventDesc'];
                $location = $row['eventLocation'];
                //$rows = count($dbHandler->selectAllJoinedEvents());
                //$count = $row['joinedcount'];
                $count1 = $dbHandler->CountEventNumber($eventid);
                $count = $count1[0]['COUNT(userID)'];
                $joined = $dbHandler->CheckJoined($userid, $eventid);
                $created = $dbHandler->CheckCreatedEvent($userid, $eventid);
                $item;
                $delete;

                if($joined == true)
                {
                  $item = true;
                }
                else
                {
                  $item = false;
                }
                
                    $cssClass = $item ? 'green-eventblock' : 'gray-eventblock';

                    if($created == true)
                {
                  $delete = true;
                }
                else
                {
                  $delete = false;
                }
                if($userid == 0)
                {
                    echo "<div class='$cssClass'>
                        <h3>$name</h3>
                        <p>$desc</p>
                        <p>$location</p>
                        <p class=cntpple>$count people are joining this event.</p>";
                        echo "</div>";
                }
                else{
                    $DeleteClass = $delete ? 'vis-deletebtn' : 'invis-deletebtn';

                    echo "<div class='$cssClass'>
                        <h3>$name</h3>
                        <p>$desc</p>
                        <p>$location</p>
                        <p class=cntpple>$count people are joining this event.</p>
                        <form action='event.php' method='POST'>
                        <input type='hidden' value='$userid' name='user'>
                        <input type='hidden' value='$eventid' name='event'>
                        <input class='joinbtn' type='submit' value='Join' name='JoinEvent'>
                        <input class='leavebtn' type='submit' value='Leave' name='LeaveEvent'>
                        <input class='$DeleteClass' type='submit' value='Delete' name='DeleteEvent'>
                        </form>";
                        
                        
                         
                    
                echo "</div>";
                }
                
                    
            }
            
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
        

        ?>
        <button class="button-forum" onclick="openPopup()">Toevoegen</button>

<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <form method="post" action='event.php'>
            <label for="eventName">Naam van evenement:</label>
            <input type="text" id="eventName" name="eventName" required><br><br>

            <label for="eventDesc">Event description:</label>
            <input type="text" id="eventDesc" name="eventDesc" required><br><br>

            <label for="eventLocation">Evenement locatie:</label>
            <input type="text" id="eventLocation" name="eventLocation" required><br><br>

            <input type='hidden' value='$userid' name='user'>

            <input class="button-forum" type="submit" value="Create" name='CreateEvent'>
        </form>
    </div>
</div>
    

</body>

</html>