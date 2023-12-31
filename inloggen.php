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

<style>
    body{
        background-color: #111111;
    }
</style>

<?php
    session_start();
    require_once 'DBhandler.php';
 
    /*if (isset($_POST['inloggen'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        
        $db = new dbHandler();
        $db->createUser($username, $password);
    }*/

    if (isset($_POST['inloggen'])) {
        $username = $_POST['naam'];
        $password = $_POST['password'];

        $db = new dbHandler();
        
        $user = $db->getUser($username, $password);
        $GebruikersId = $db->getGebruikersId($username, $password); 
        if ($user && $GebruikersId) {
            $_SESSION['naam'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['GebruikersId'] = $GebruikersId; 
            header("Location: index.php");
            exit;
        } else {
            header("Location: inloggen.php?error=1");
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
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Naam:</label>
                        <input type="text" name="naam" placeholder="Naam:" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" placeholder="Password:" required>
                    </div>
                        <input type="submit" value="Login" name="inloggen">
                </form>
                <div>
                </div>
            </div>
        </div>
</body>

</html>