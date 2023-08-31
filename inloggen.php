<?php
    require_once "dbHandler.php";
        //session_start();
        $db = new dbHandler();
        
    if(isset($_POST['create'])) {
        $user = $_POST['name'];
        $password = $_POST['password'];
        $db->createUser($user, $password);
    }
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inlog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
    <title>Inloggen</title>
</head>

<?php
    session_start();
    require_once 'DBhandler.php';
 
    if (isset($_POST['submit'])) {
        $username = $_POST['naam'];
        $password = $_POST['password'];

        $db = new dbHandler();
        
        $user = $db->getUser($username, $password);
        $GebruikersId = $db->getGebruikersId($naam, $password);

        if ($user && $GebruikersId) {
            $_SESSION['naam'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['GebruikersId'] = $GebruikersId; 
            header("Location: index.php");
            
            exit;
        } else {
            header("Location: inloggen.php?error=1");
            echo "test";
            var_dump($username, $password);
            exit;
        }
    }
    ?>

<body>
    <h1>Summa Tinder</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="event.php">Events</a></li>
            <li><a href="inlog.php">Inloggen</a></li>
        </ul>
    </nav>
        <div class="form-container">
            <div id="inlog-form">
                <header>Log hier in!</header>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="name">Naam:</label>
                        <input type="text" name="name" placeholder="Naam:" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Password:" required>
                    </div>
                        <input type="submit" value="Login" name="create">
                </form>
                deeeeeeeeeeeeeeeeeeeeee
                <div>
                </div>
            </div>
        </div>
</body>

</html>