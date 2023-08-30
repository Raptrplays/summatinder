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
</head>

<body>
    <?php
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

            $userid = 4;

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

                echo "<div class='event-block'>
                        <h3>$name</h3>
                        <p>$desc</p>
                        <p>$location</p>
                        <p class=cntpple>$count people are joining this event.</p>
                        <form action='event.php' method='POST'>
                        <input type='hidden' value='$userid' name='user'>
                        <input type='hidden' value='$eventid' name='event'>
                        <input class='joinbtn' type='submit' value='Join' name='JoinEvent'>
                        <input class='leavebtn' type='submit' value='Leave' name='LeaveEvent'>
                        </form>";
                        
                        
                         
                    
                echo "</div>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        ?>
    

</body>

</html>