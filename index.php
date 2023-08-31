<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;800&display=swap" rel="stylesheet">
    <title>Home</title>
</head>


<body>

<?php
    session_start();
    function destroySession() {  
        session_unset();
        session_destroy();
    }
 
    if (isset($_POST['logout'])) {
        destroySession();
    }

    if (isset($_SESSION['naam'])) {
        $username = $_SESSION['naam'];
        $password = $_SESSION['password'];
        $GebruikersId = $_SESSION['GebruikersId'];
    }


   /*
    ?>

        <div class="container">
            <div class="box">
                Welkom, <?php echo $username; ?>!<br>
                Uw Password: <?php echo $password; ?><br>
                Jou Id: <?php echo $GebruikersId; ?><br>
            </div>
            <form action="index.php" method="post">
                 <input type="submit" name="logout" id="logout" value="Uitloggen" class="button">
            </form>
        </div>

<?php
*/
?>

<?php if (isset($_SESSION['naam'])): ?>
    <div class="container">
        <div class="box">
            Welkom, <?php echo $username; ?>!<br>
            Uw Password: <?php echo $password; ?><br>
            Jou Id: <?php echo $GebruikersId; ?><br>
        </div>
        <form action="index.php" method="post">
            <input type="submit" name="logout" id="logout" value="Uitloggen" class="button">
        </form>
    </div>
    <?php endif; ?>

    <h1>Summa Tinder</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="event.php">Events</a></li>
            <li><a href="inlog.php">Inloggen</a></li>
        </ul>
    </nav>

    <div class="section">
        <h3>Ben jij klaar om mensen bij elkaar te brengen en overgetelijke ervaringen te creëren?</h3>
        <img src="images/huisfeest1.jpg" alt="huisfeestfoto">
        <p>Ga naar events of maak nu een account aan!</p>
        <div class="buttons">
            <a href="event.php"><button>Events</button></a>
            <a href="inlog.php"><button>Account aanmaken</button></a>
        </div>
    </div>





</body>

</html>