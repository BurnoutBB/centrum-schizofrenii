<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Centrum schizofrenii</title>
        <link rel="icon" type="image/x-icon" href="img/ikona.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Żyjemy w centrum schizofrenii">
        <meta name="keywords" content="shizofrenia">
        <link rel="stylesheet" href="css/nowypost.css">
    </head>
    <body>
        <div id="post">
            
            
        <?php
// Rozpocznij sesję

// Dołącz plik łączący z bazą danych
include 'db_connect.php';

// Pobierz post_id z adresu URL
$post_id = $_GET['post_id'] ?? 0;

// Pobierz id użytkownika z sesji (zmodyfikuj według rzeczywistego mechanizmu uwierzytelniania)


// Zapytanie do bazy danych o informacje na temat konkretnego posta
$sql = "SELECT posty.tytul, posty.tresc, logowanie.Nazwa_uzytkownika, logowanie.profile_picture 
        FROM posty 
        INNER JOIN logowanie ON posty.id_uzytkownika = logowanie.id_uzytkownika
        WHERE posty.post_id = $post_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // ... (wcześniejszy kod)

    // Wyświetlanie treści, tytułu, nazwy użytkownika oraz zdjęcia
    echo '<div id="userinfo">';
    echo '<img id="profile_picture" src="' . htmlspecialchars($row['profile_picture']) . '" height="160px" width="160px">';
    echo '<h3 id="username">' . htmlspecialchars($row['Nazwa_uzytkownika']) . '</h3>';
    echo '</div>';

    echo '<div id="post-content">';
    echo '<h2 id="tytul">' . nl2br(htmlspecialchars($row['tytul'])) . '</h2>';
    echo '<p id="tresc">' . nl2br(htmlspecialchars($row['tresc'])) . '</p>';
    echo '</div>';
} else {
    echo '<p>Post o podanym identyfikatorze nie istnieje.</p>';
}
?>
        
</div>
        </div>
        <div id="powrut">
           <a href="index.php"><img src="img/logo3.png" height="80px"></a>
        </div>
        <?php
// Pobierz komentarze dla konkretnego posta
$post_id = $_GET['post_id'] ?? ''; // Zakładam, że post_id przesyłane jest jako parametr w URL
$sql = "SELECT komentarze.*, logowanie.Nazwa_uzytkownika, logowanie.profile_picture
        FROM komentarze
        JOIN logowanie ON komentarze.id_uzytkownika = logowanie.id_uzytkownika
        WHERE komentarze.post_id = '$post_id'
        ORDER BY komentarze.id_komentarza ASC"; // Sortowanie od najstarszego do najnowszeg

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nazwa_uzytkownika = $row['Nazwa_uzytkownika'];
        $profile_picture = $row['profile_picture'];
        $tresc_komentarza = $row['komentarz'];

        // Wygeneruj HTML dla każdego komentarza
        echo '<div class="nowykomentarz">';
        echo '<div class="uzytkownik">';
        echo '<img style="border-radius: 25px;" src="' . $profile_picture . '" height="80px" width="80px"><br>';
        echo '<p id="nazwauzytkownika">' . $nazwa_uzytkownika . '</p>';
        echo '</div>';
        echo '<div class="tresckomentarza">';
        echo '<p id="tresc_komentarza">' . $tresc_komentarza . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Brak komentarzy.';
}

$conn->close();
?>
        
        
        <div id="komentarz">
        <form action="handle_comment.php" method="post">
    <div id="tekst">
        <textarea name="komentarz" required maxlength="445"></textarea>
        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'] ?? ''; ?>">
    </div>
    <div id="dodaj">
        <input type="submit" value="+">
    </div>
</form>
        </div>
    </body>
</html>