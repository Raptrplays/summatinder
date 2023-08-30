<?php
    require_once "dbHandler.php";
        //session_start();
        $db = new dbHandler();
        
    if(isset($_POST)) {
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
            <header>Registreer hier!</header>
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" name="name" placeholder="Naam:">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password:">
                </div>
                <div class="form-group">
                    <label for="repeat_password">Herhaal password</label>
                    <input type="password" name="repeat_password" placeholder="Herhaal password:">
                </div>
                    <input type="submit" value="Registreer" name="submit">
            </form>
            <div>
                <div>
                    <p>Al geregistreerd?<a href="login.php">Log hier in!</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>