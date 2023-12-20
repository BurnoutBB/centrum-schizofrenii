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
      <script>
        // Skrypt JavaScript do aktualizacji komunikatów
        var phpKomunikat = "<?php echo isset($_SESSION['phpKomunikat']) ? $_SESSION['phpKomunikat'] : ''; ?>";
        if (phpKomunikat) {
            document.getElementById('bledyphp').innerHTML = phpKomunikat;
            <?php unset($_SESSION['phpKomunikat']); ?>
        }
    </script>
</head>
<body>
    <div id="gura">
        <a href="index.php"><img src="img/logo2.png"  height="50px"></a>
        <h2>Twoje konto:</h2>
    </div>
    <div id="lewo"></div>

    <div id="userimg">
    <?php
    // Sprawdź, czy użytkownik już ma przypisaną ścieżkę do zdjęcia profilowego w bazie danych
    $stmt_picture = $conn->prepare("SELECT profile_picture FROM logowanie WHERE id_uzytkownika = ?");
    $stmt_picture->bind_param("i", $user_id);
    $stmt_picture->execute();
    $stmt_picture->bind_result($profile_picture);
    $stmt_picture->fetch();
    $stmt_picture->close();

    // Jeśli użytkownik ma przypisaną ścieżkę do zdjęcia, wyświetl to zdjęcie
    if (!empty($profile_picture)) {
        echo '<img id="zdjecie" style="border-radius: 25px;" src="' . $profile_picture . '" height="300px" width="300px">';
    } else {
        echo '<img  src="img/user.png" height="300px" width="300px">';
    }
    ?>
    
</div>

    <div id="uzytkownik">
        <h1>Nazwa użytkownika: <?php echo $username; ?></h1>
        <h2>Email: <?php echo $email; ?></h2><br/>
        <a href="logout.php"><h3> Wyloguj sie!</h3></a>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/*" id="dodajzdjecie" >
        <input type="submit" value="Prześlij zdjęcie" name="submit" id="przeslijzdjecie">
    </form>
    <p id="bledyphp"></p>
    <script>
    var phpKomunikat = "<?php echo isset($_SESSION['phpKomunikat']) ? $_SESSION['phpKomunikat'] : ''; ?>";
    if (phpKomunikat) {
        document.getElementById('bledyphp').innerHTML = phpKomunikat;
        <?php unset($_SESSION['phpKomunikat']); ?>
    }
</script>
    </div>
    
    <div id="prawo"></div>
</body>
</html>