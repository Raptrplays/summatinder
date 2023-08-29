<?php
  require_once "dbHandler.php";
    session_start();
    $db = new dbHandler();
    function destroySession() {
        session_unset();
        session_destroy();
    }

    if (isset($_POST['logout'])) {
        destroySession();
    }

    if (isset($_POST["submit"])) {
        $username = $_POST['naam'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

        if (empty($username) || empty($password) || empty($repeat_password)) {
            echo "Vul alles in";
            exit;
        }

        if ($password !== $repeat_password) {
            echo "Passwords zijn niet gelijk";
            exit;
        }

        $result = $db->createUser($username, $password);

        if ($result) {
            $_SESSION['naam'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['GebruikersId'] = $id;
            header("Location: account.php");
            exit;
        } else {
            echo "Error!!!";
        }
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
<div id="inlog-form">
        <header>Registreer hier!</header>
        <form action="" method="post">
            <div class="form-group">
                <label for="naam">Naam:</label>
                <input type="text" name="naam" placeholder="Naam:">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <label for="repear_password">Herhaal password</label>
                <input type="password" name="repeat_password" placeholder="Herhaal passwoord:">
            </div>
            <div class="form-btn">
                <input type="submit" gvalue="Register" name="submit">
            </div>
        </form>
        <div>
            <div>
                <p>Al geregistreerd?<a href="login.php">Log hier in!</a></p>
            </div>
        </div>
    </div>  
</body>
</html>