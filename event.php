<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <title>Events</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="grid-container">
        <?php
        // Include the database connection file
        require_once 'DBHandler.php';

        try {
            // Perform database operations using $pdo

            // Example query
            $statement = $pdo->query("SELECT * FROM events");
            $statement = $pdo->query("SELECT * FROM joinedevents");

            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Output the results
            foreach ($rows as $row) {
                $eventid = $row['eventID'];
                $name = $row['eventName'];
                $desc = $row['eventDesc'];
                $location = $row['eventLocation'];
                
                $counter = $row['count(userid)'];

                echo "<div class='event-block'>
                        <h3>$name</h3>
                        <p>$desc</p>
                        <p>$location</p>
                        <p>$counter<p>
                    </div>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        ?>
    

</body>

</html>