<?php
session_start();
include('db_connect.php'); // Załącz plik z połączeniem do bazy danych

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: logowanie.html'); // Przekieruj go do strony logowania, jeśli nie jest zalogowany
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Centrum schizofrenii</title>
        <link rel="icon" type="image/x-icon" href="img/ikona.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Żyjemy w centrum schizofrenii">
        <meta name="keywords" content="shizofrenia">
        <link rel="stylesheet" href="css/post.css">
    </head>
    <body>
        <div id="gura">

        </div>
        <div id="lewo">

            <div id="post">
                <form id="post-form" action="dodaj_post.php" method="post">
                    <br/><a href="index.php"><img src="img/logo2.png" id="logowanieimg" height="50px"></a>
                    <p>TYTUL POSTA</p>
                    <input id="tytul" type="text" required name="tytul" value="<?php echo htmlspecialchars($_POST['tytul'] ?? ''); ?>">
                    <p> TRESC</p>
                    <textarea id="tresc" required name="tresc" maxlength="1000" value="<?php echo htmlspecialchars($_POST['tresc'] ?? ''); ?>"></textarea>
                    <input id="udostepnij" type="submit" value="UDOSTEPNIJ">
                </form>
            </div>
        
        <div id="prawo">

        </div>
    </body>