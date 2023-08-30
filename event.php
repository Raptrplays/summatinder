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
    <div class="grid-container">
        <?php
        // Include the database connection file
        require_once 'DBhandler.php';
        $dbHandler = new dbHandler();

        try {
            // Perform database operations using $pdo

            // Example query
            $countrows = $dbHandler->selectAllJoinedEvents();
            $rows = $dbHandler->SelectAllEVents();

            // Output the results
            foreach ($rows as $row) {
                $eventid = $row['eventID'];
                $name = $row['eventName'];
                $desc = $row['eventDesc'];
                $location = $row['eventLocation'];

                echo "<div class='event-block'>
                        <h3>$name</h3>
                        <p>$desc</p>
                        <p>$location</p>
                        <p><p>";
                echo "</div>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        ?>
    

</body>

</html>