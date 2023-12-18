<?php
session_start();
include('db_connect.php'); // Załącz plik z połączeniem do bazy danych

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: logowanie.html'); // Przekieruj go do strony logowania, jeśli nie jest zalogowany
    exit();
}

$user_id = $_SESSION['user_id'];

// Pobierz informacje o zalogowanym użytkowniku
$stmt = $conn->prepare("SELECT Nazwa_uzytkownika, email FROM logowanie WHERE id_uzytkownika = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
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
    <link rel="stylesheet" href="css/styl2.css">
</head>
<body>
    <div id="gura">
        <a href="index.html"><img src="img/logo2.png"  height="50px"></a>
        <p>Twoje konto:</p>
    </div>
    <div id="lewo"></div>

    <div id="userimg">
        <img src="img/user.png" height="300px">
    </div>

    <div id="uzytkownik">
        <h1>Nazwa użytkownika: <?php echo $username; ?></h1>
        <h2>Email: <?php echo $email; ?></h2><br/>
        <a href="logout.php"><h3> Wyloguj sie!</h3></a>
    </div>
    
    <div id="prawo"></div>
</body>
</html>